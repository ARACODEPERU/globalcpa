<script setup>
    import { computed, onMounted, ref, watch } from 'vue';
    import axios from 'axios';
    import Swal from 'sweetalert2';
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
    import HelpTip from '../../Components/HelpTip.vue';

    const props = defineProps({
        tabs: { type: Array, default: () => [] },
        thresholds: { type: Object, default: () => ({}) },
        quality: { type: Object, default: () => ({}) },
    });

    const activeTab = ref(props.tabs[0]?.key ?? 'pages');
    const items = ref([]);
    const loading = ref(false);
    const error = ref('');
    const search = ref('');
    const onlyHeavy = ref(false);
    const sortKey = ref('bytes');
    const selected = ref([]);
    const detail = ref(null);
    const page = ref(1);
    const perPage = ref(24);
    const resizing = ref(false);
    const onlyOrphans = ref(false);
    const duplicates = ref([]);
    const duplicatesLoading = ref(false);
    const showDuplicates = ref(false);
    const bulkAction = ref('');

    const form = ref({
        mode: 'percent',
        percent: 80,
        width: 1600,
        quality: props.quality?.default ?? 82,
    });

    const activeTabMeta = computed(
        () => props.tabs.find((tab) => tab.key === activeTab.value) || {}
    );

    const load = async () => {
        loading.value = true;
        error.value = '';
        selected.value = [];
        page.value = 1;

        try {
            const { data } = await axios.get(route('perf_images_data'), {
                params: { tab: activeTab.value },
            });
            items.value = data.items || [];
        } catch (exception) {
            items.value = [];
            error.value = 'No se pudieron cargar las imágenes de esta pestaña.';
            console.error(exception);
        } finally {
            loading.value = false;
        }
    };

    const formatBytes = (bytes) => {
        if (!bytes) return '0 B';
        const units = ['B', 'KB', 'MB', 'GB'];
        let size = bytes;
        let unit = 0;
        while (size >= 1024 && unit < units.length - 1) {
            size = size / 1024;
            unit++;
        }
        return `${size.toFixed(size >= 10 || unit === 0 ? 0 : 1)} ${units[unit]}`;
    };

    const filtered = computed(() => {
        let list = items.value;

        if (search.value.trim() !== '') {
            const term = search.value.trim().toLowerCase();
            list = list.filter(
                (item) =>
                    item.file.toLowerCase().includes(term) ||
                    item.root_label.toLowerCase().includes(term) ||
                    item.usages.some((usage) =>
                        `${usage.label} ${usage.record}`.toLowerCase().includes(term)
                    )
            );
        }

        if (onlyHeavy.value) {
            list = list.filter((item) => item.needs_attention);
        }

        if (onlyOrphans.value) {
            list = list.filter((item) => item.usages.length === 0);
        }

        return [...list].sort((a, b) => {
            if (sortKey.value === 'name') return a.name.localeCompare(b.name);
            if (sortKey.value === 'width') return (b.width || 0) - (a.width || 0);
            return b.bytes - a.bytes;
        });
    });

    const paged = computed(() => {
        const start = (page.value - 1) * perPage.value;
        return filtered.value.slice(start, start + perPage.value);
    });

    const totalPages = computed(() =>
        Math.max(1, Math.ceil(filtered.value.length / perPage.value))
    );

    const totals = computed(() => {
        const bytes = filtered.value.reduce((carry, item) => carry + item.bytes, 0);
        const heavy = filtered.value.filter((item) => item.needs_attention);
        return {
            count: filtered.value.length,
            bytes,
            heavy: heavy.length,
            heavyBytes: heavy.reduce((carry, item) => carry + item.bytes, 0),
        };
    });

    const isSelected = (item) =>
        selected.value.some((entry) => entry.id === item.id);

    const toggleSelect = (item) => {
        if (isSelected(item)) {
            selected.value = selected.value.filter((entry) => entry.id !== item.id);
            return;
        }
        selected.value.push({ id: item.id, root: item.root, file: item.file });
    };

    const allVisibleSelected = computed(
        () => paged.value.length > 0 && paged.value.every((item) => isSelected(item))
    );

    const toggleAllVisible = () => {
        if (allVisibleSelected.value) {
            const visibleIds = paged.value.map((item) => item.id);
            selected.value = selected.value.filter(
                (entry) => !visibleIds.includes(entry.id)
            );
            return;
        }

        paged.value.forEach((item) => {
            if (!isSelected(item)) {
                selected.value.push({ id: item.id, root: item.root, file: item.file });
            }
        });
    };

    const selectHeavy = () => {
        selected.value = filtered.value
            .filter((item) => item.needs_attention && item.resizable)
            .map((item) => ({ id: item.id, root: item.root, file: item.file }));
    };

    const selectAllFiltered = () => {
        selected.value = filtered.value.map((item) => ({
            id: item.id,
            root: item.root,
            file: item.file,
        }));
    };

    const allFilteredSelected = computed(
        () =>
            filtered.value.length > 0 &&
            selected.value.length === filtered.value.length
    );

    const resizeSelected = async () => {
        if (selected.value.length === 0) return;

        const label =
            form.value.mode === 'percent'
                ? `reducir al ${form.value.percent}% de su ancho`
                : `reducir a un ancho máximo de ${form.value.width}px`;

        const confirmation = await Swal.fire({
            icon: 'warning',
            title: '¿Redimensionar imágenes?',
            html: `Se van a ${label} <b>${selected.value.length}</b> imagen(es). Se mantiene el mismo nombre y extensión, y se guarda una copia en <code>storage/app/performance-backups</code>.`,
            showCancelButton: true,
            confirmButtonText: 'Sí, redimensionar',
            cancelButtonText: 'Cancelar',
        });

        if (!confirmation.isConfirmed) return;

        resizing.value = true;

        try {
            const { data } = await axios.post(route('perf_images_resize'), {
                targets: selected.value.map((entry) => ({
                    root: entry.root,
                    file: entry.file,
                })),
                mode: form.value.mode,
                percent: Number(form.value.percent),
                width: Number(form.value.width),
                quality: Number(form.value.quality),
            });

            const saved = data.before - data.after;

            await Swal.fire({
                icon: data.processed > 0 ? 'success' : 'info',
                title: data.processed > 0 ? 'Imágenes optimizadas' : 'Sin cambios',
                html:
                    `<b>${data.processed}</b> imagen(es) redimensionada(s).<br>` +
                    `Ahorro: <b>${formatBytes(saved)}</b><br>` +
                    `Omitidas: <b>${data.skipped.length}</b>`,
                customClass: { popup: 'sweet-alerts' },
            });

            selected.value = [];
            await load();
        } catch (exception) {
            Swal.fire({
                icon: 'error',
                title: 'No se pudo redimensionar',
                text:
                    exception?.response?.data?.message ||
                    'Ocurrió un error al procesar las imágenes.',
            });
        } finally {
            resizing.value = false;
        }
    };

    const loadDuplicates = async () => {
        duplicatesLoading.value = true;

        try {
            const { data } = await axios.get(route('perf_images_duplicates'), {
                params: { tab: activeTab.value },
            });
            duplicates.value = data.groups || [];
            showDuplicates.value = true;
        } catch (exception) {
            Swal.fire({
                icon: 'error',
                title: 'No se pudo analizar',
                text: 'Ocurrió un error al calcular los duplicados.',
            });
        } finally {
            duplicatesLoading.value = false;
        }
    };

    const targetsOf = (entries) =>
        entries.map((entry) => ({ root: entry.root, file: entry.file }));

    const generateWebp = async () => {
        if (selected.value.length === 0) return;

        bulkAction.value = 'webp';

        try {
            const { data } = await axios.post(route('perf_images_webp'), {
                targets: targetsOf(selected.value),
                quality: Number(form.value.quality),
            });

            await Swal.fire({
                icon: 'success',
                title: 'Copias WebP generadas',
                html:
                    `Creadas: <b>${data.created}</b><br>` +
                    `Omitidas: <b>${data.skipped.length}</b><br>` +
                    `Ahorro potencial: <b>${formatBytes(Math.max(0, data.before - data.after))}</b>`,
            });

            selected.value = [];
            await load();
        } catch (exception) {
            Swal.fire({
                icon: 'error',
                title: 'No se pudo generar WebP',
                text: exception?.response?.data?.message || 'Error inesperado.',
            });
        } finally {
            bulkAction.value = '';
        }
    };

    const CHUNK_SIZE = 200;

    const quarantine = async (entries, description) => {
        if (!entries.length) return;

        const confirmation = await Swal.fire({
            icon: 'warning',
            title: '¿Mover a cuarentena?',
            html:
                `${description}<br><br>` +
                'Los archivos se mueven a <code>storage/app/performance-quarantine</code>: se pueden recuperar, no se borran.<br><br>' +
                '<b>Escribe tu contraseña para confirmar.</b>',
            input: 'password',
            inputPlaceholder: 'Contraseña de tu usuario',
            inputAttributes: { autocomplete: 'current-password' },
            inputValidator: (value) =>
                !value || value.trim() === '' ? 'La contraseña es obligatoria' : undefined,
            showCancelButton: true,
            confirmButtonText: 'Mover a cuarentena',
            cancelButtonText: 'Cancelar',
        });

        if (!confirmation.isConfirmed) return;

        const password = confirmation.value;
        const chunks = [];

        for (let index = 0; index < entries.length; index += CHUNK_SIZE) {
            chunks.push(entries.slice(index, index + CHUNK_SIZE));
        }

        bulkAction.value = 'quarantine';

        let moved = 0;
        let skipped = [];

        try {
            for (const chunk of chunks) {
                const { data } = await axios.post(route('perf_images_quarantine'), {
                    targets: targetsOf(chunk),
                    password,
                });

                moved += data.moved || 0;
                skipped = skipped.concat(data.skipped || []);
            }

            await Swal.fire({
                icon: 'success',
                title: 'Archivos en cuarentena',
                html: `Movidos: <b>${moved}</b><br>Omitidos: <b>${skipped.length}</b>`,
            });

            selected.value = [];
            showDuplicates.value = false;
            await load();
        } catch (exception) {
            const message =
                exception?.response?.data?.message || 'No se pudo completar la cuarentena.';

            Swal.fire({
                icon: 'error',
                title: moved > 0 ? 'Proceso incompleto' : 'No se movió nada',
                html:
                    (moved > 0 ? `Se movieron <b>${moved}</b> archivo(s) antes del error.<br><br>` : '') +
                    message,
            });

            if (moved > 0) {
                selected.value = [];
                await load();
            }
        } finally {
            bulkAction.value = '';
        }
    };

    const quarantineSelected = () =>
        quarantine(selected.value, `Se moverán <b>${selected.value.length}</b> imagen(es) seleccionada(s).`);

    const quarantineGroup = (group) =>
        quarantine(
            group.slice(1),
            `Se moverán <b>${group.length - 1}</b> copia(s) de <code>${group[0].name}</code> y se conservará la primera.`
        );

    const openDetail = (item) => {
        detail.value = item;
    };

    watch(activeTab, load);
    watch(search, () => (page.value = 1));
    watch(onlyHeavy, () => (page.value = 1));
    watch(onlyOrphans, () => (page.value = 1));

    onMounted(load);
</script>

<template>
    <AppLayout title="Performance">
        <Navigation :routeModule="route('perf_images')" titleModule="Performance"
            :data="[{ title: 'Imágenes' }]" />

        <div class="mt-5 space-y-5">
            <div class="flex flex-wrap items-center justify-between gap-4">
                <div>
                    <h2 class="text-xl">
                        Rendimiento · Imágenes
                        <HelpTip text="Cada pestaña agrupa carpetas reales del proyecto. La tabla muestra peso, resolución y los lugares donde se usa cada archivo; todo es de solo lectura hasta que seleccionas imágenes y eliges una acción." />
                    </h2>
                    <p class="text-sm text-slate-500 dark:text-slate-400">
                        Revisa peso, resolución y dónde se muestra cada imagen antes de optimizarla.
                    </p>
                </div>
                <div class="flex flex-wrap gap-3 text-sm">
                    <div class="rounded-lg bg-white px-4 py-2 shadow dark:bg-slate-800">
                        <span class="text-slate-500 dark:text-slate-400">Archivos:</span>
                        <b class="ml-1">{{ totals.count }}</b>
                    </div>
                    <div class="rounded-lg bg-white px-4 py-2 shadow dark:bg-slate-800">
                        <span class="text-slate-500 dark:text-slate-400">Peso:</span>
                        <b class="ml-1">{{ formatBytes(totals.bytes) }}</b>
                    </div>
                    <div class="rounded-lg bg-white px-4 py-2 shadow dark:bg-slate-800">
                        <span class="text-slate-500 dark:text-slate-400">Pesadas:</span>
                        <b class="ml-1 text-amber-600">{{ totals.heavy }}</b>
                        <span class="text-xs text-slate-400">({{ formatBytes(totals.heavyBytes) }})</span>
                    </div>
                </div>
            </div>

            <!-- Pestañas -->
            <div class="flex flex-wrap gap-2">
                <button v-for="tab in tabs" :key="tab.key" type="button"
                    class="rounded-lg px-4 py-2 text-sm font-medium transition"
                    :class="activeTab === tab.key
                        ? 'bg-primary text-white shadow'
                        : 'bg-white text-slate-600 hover:bg-slate-100 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700'"
                    @click="activeTab = tab.key">
                    {{ tab.label }}
                </button>
            </div>

            <p class="text-xs text-slate-500 dark:text-slate-400">
                {{ activeTabMeta.description }}
                <span v-if="activeTabMeta.roots?.length">
                    · Carpetas:
                    <span v-for="root in activeTabMeta.roots" :key="root.key"
                        class="mr-2 inline-block rounded bg-slate-100 px-1.5 py-0.5 font-mono text-[11px] dark:bg-slate-800">
                        {{ root.label }}
                    </span>
                </span>
            </p>

            <div class="grid grid-cols-1 gap-5 xl:grid-cols-4">
                <!-- Tabla -->
                <div class="xl:col-span-3">
                    <div class="panel">
                        <div class="mb-4 flex flex-wrap items-center gap-3">
                            <input v-model="search" type="text" placeholder="Buscar archivo, curso, artículo…"
                                class="form-input w-full sm:w-64" />
                            <label class="flex items-center gap-2 text-sm">
                                <input v-model="onlyHeavy" type="checkbox" class="form-checkbox" />
                                Solo pesadas
                                <HelpTip text="Muestra solo las imágenes que superan 300 KB o 1920 px de ancho: son las que más pesan en la página." />
                            </label>
                            <label class="flex items-center gap-2 text-sm">
                                <input v-model="onlyOrphans" type="checkbox" class="form-checkbox" />
                                Solo huérfanas
                                <HelpTip text="Imágenes sin ninguna referencia en la base de datos ni en plantillas. Ojo: puede usarse desde CSS o HTML generado, revísalo antes de moverlas." />
                            </label>
                            <button type="button" class="btn btn-sm btn-outline-dark"
                                title="Compara el contenido (MD5) de los archivos de esta pestaña y agrupa los idénticos."
                                :disabled="duplicatesLoading" @click="loadDuplicates">
                                {{ duplicatesLoading ? 'Analizando…' : 'Buscar duplicadas' }}
                            </button>
                            <select v-model="sortKey" class="form-select w-auto">
                                <option value="bytes">Ordenar por peso</option>
                                <option value="width">Ordenar por ancho</option>
                                <option value="name">Ordenar por nombre</option>
                            </select>
                            <button type="button" class="btn btn-sm btn-outline-primary ml-auto"
                                :disabled="!totals.heavy" @click="selectHeavy">
                                Seleccionar pesadas ({{ totals.heavy }})
                            </button>
                            <button type="button" class="btn btn-sm btn-outline-dark"
                                title="Marca todas las imágenes que cumplen los filtros actuales, incluidas las de otras páginas."
                                :disabled="totals.count === 0 || allFilteredSelected"
                                @click="selectAllFiltered">
                                Seleccionar todas ({{ totals.count }})
                            </button>
                        </div>

                        <div v-if="error"
                            class="mb-4 rounded-lg bg-red-50 px-4 py-3 text-sm text-red-700 dark:bg-red-900/30 dark:text-red-300">
                            {{ error }}
                        </div>

                        <div class="overflow-x-auto">
                            <table class="w-full table-auto text-sm">
                                <thead>
                                    <tr class="text-left text-xs uppercase text-slate-500 dark:text-slate-400">
                                        <th class="w-10 px-2 py-3">
                                            <input type="checkbox" class="form-checkbox"
                                                :checked="allVisibleSelected" @change="toggleAllVisible" />
                                        </th>
                                        <th class="px-2 py-3">Imagen</th>
                                        <th class="px-2 py-3">Resolución</th>
                                        <th class="px-2 py-3">
                                            Peso
                                            <HelpTip text="Tamaño real en disco. En ámbar: supera 300 KB o 1920 px de ancho." />
                                        </th>
                                        <th class="px-2 py-3">
                                            WebP
                                            <HelpTip text="✓ significa que ya existe una copia .webp junto al original. — significa que aún no se ha generado." />
                                        </th>
                                        <th class="px-2 py-3">
                                            Dónde se muestra
                                            <HelpTip text="Registros de la base de datos y plantillas que usan el archivo, con enlace a la página real. Si no hay coincidencias dice 'sin referencias'." />
                                        </th>
                                        <th class="px-2 py-3"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-if="loading">
                                        <td colspan="7" class="py-6 text-center text-slate-500">
                                            Leyendo archivos…
                                        </td>
                                    </tr>
                                    <tr v-else-if="paged.length === 0">
                                        <td colspan="7" class="py-6 text-center text-slate-500">
                                            No hay imágenes con esos filtros.
                                        </td>
                                    </tr>
                                    <tr v-for="item in paged" :key="item.id"
                                        class="border-t border-slate-100 align-top dark:border-slate-700">
                                        <td class="px-2 py-3">
                                            <input type="checkbox" class="form-checkbox"
                                                :checked="isSelected(item)" @change="toggleSelect(item)" />
                                        </td>
                                        <td class="px-2 py-3">
                                            <div class="flex items-start gap-3">
                                                <a :href="item.url" target="_blank" rel="noopener"
                                                    class="flex h-12 w-12 shrink-0 items-center justify-center overflow-hidden rounded border border-slate-200 bg-slate-50 dark:border-slate-700 dark:bg-slate-900">
                                                    <img :src="item.url" :alt="item.name"
                                                        class="max-h-12 max-w-12 object-contain" loading="lazy" />
                                                </a>
                                                <div class="min-w-0">
                                                    <p class="truncate font-medium" :title="item.file">
                                                        {{ item.name }}
                                                    </p>
                                                    <p class="truncate font-mono text-[11px] text-slate-500 dark:text-slate-400"
                                                        :title="item.root_label + '/' + item.file">
                                                        {{ item.root_label }}/{{ item.file }}
                                                    </p>
                                                    <p class="text-[11px] text-slate-400">
                                                        .{{ item.extension }} · {{ item.modified }}
                                                    </p>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="whitespace-nowrap px-2 py-3">
                                            <span v-if="item.width">{{ item.width }}×{{ item.height }} px</span>
                                            <span v-else class="text-slate-400">—</span>
                                        </td>
                                        <td class="whitespace-nowrap px-2 py-3">
                                            <span :class="item.needs_attention ? 'font-semibold text-amber-600' : ''">
                                                {{ formatBytes(item.bytes) }}
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-2 py-3">
                                            <span v-if="item.webp" class="text-emerald-600" title="Existe una copia WebP">✓</span>
                                            <span v-else class="text-slate-300 dark:text-slate-600" title="Sin copia WebP">—</span>
                                        </td>
                                        <td class="px-2 py-3">
                                            <div v-if="item.usages.length" class="space-y-1">
                                                <div v-for="(usage, index) in item.usages.slice(0, 2)"
                                                    :key="index" class="text-[11px] leading-tight">
                                                    <span class="text-slate-500 dark:text-slate-400">
                                                        {{ usage.label }}:
                                                    </span>
                                                    <a v-if="usage.url" :href="usage.url" target="_blank"
                                                        rel="noopener" class="text-primary hover:underline">
                                                        {{ usage.record }}
                                                    </a>
                                                    <span v-else class="font-mono">{{ usage.record }}</span>
                                                </div>
                                                <button v-if="item.usages.length > 2" type="button"
                                                    class="text-[11px] text-primary hover:underline"
                                                    @click="openDetail(item)">
                                                    +{{ item.usages.length - 2 }} más
                                                </button>
                                            </div>
                                            <span v-else class="text-[11px] text-slate-400">
                                                Sin referencias detectadas
                                            </span>
                                        </td>
                                        <td class="whitespace-nowrap px-2 py-3 text-right">
                                            <button type="button" class="btn btn-sm btn-outline-primary"
                                                @click="openDetail(item)">
                                                Ver
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="mt-4 flex flex-wrap items-center justify-between gap-3 text-sm">
                            <span class="text-slate-500 dark:text-slate-400">
                                Página {{ page }} de {{ totalPages }} · {{ totals.count }} archivo(s)
                            </span>
                            <div class="flex gap-2">
                                <button type="button" class="btn btn-sm btn-outline-dark"
                                    :disabled="page <= 1" @click="page--">
                                    Anterior
                                </button>
                                <button type="button" class="btn btn-sm btn-outline-dark"
                                    :disabled="page >= totalPages" @click="page++">
                                    Siguiente
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Panel de optimización -->
                <div class="xl:col-span-1">
                    <div class="panel sticky top-20">
                        <h3 class="mb-1 text-base font-semibold">
                            Optimizar selección
                            <HelpTip text="Los cambios se aplican solo a las imágenes marcadas. Ninguna acción cambia el nombre ni la extensión de los archivos." />
                        </h3>
                        <p class="mb-4 text-xs text-slate-500 dark:text-slate-400">
                            <b>{{ selected.length }}</b> de {{ totals.count }} filtrada(s) seleccionada(s).
                            Se conserva el nombre y la extensión del archivo.
                            <HelpTip text="El contador de filtradas incluye las imágenes de todas las páginas, no solo las visibles." />
                        </p>

                        <ul class="mb-4 space-y-1 rounded-lg bg-slate-50 p-3 text-[11px] leading-relaxed text-slate-600 dark:bg-slate-800 dark:text-slate-300">
                            <li><b>Redimensionar:</b> reduce el ancho y recomprime; guarda copia del original en backups.</li>
                            <li><b>Generar WebP:</b> crea un archivo .webp al lado, sin tocar el original.</li>
                            <li><b>Cuarentena:</b> mueve el archivo a una carpeta aparte; es reversible, no borra y pide tu contraseña.</li>
                        </ul>

                        <div class="space-y-4">
                            <div>
                                <label class="mb-1 block text-xs font-semibold uppercase text-slate-500">
                                    Modo
                                    <HelpTip text="Porcentaje: reduce el ancho actual en ese %. Ancho máximo: fija un límite en píxeles y nunca agranda la imagen." />
                                </label>
                                <select v-model="form.mode" class="form-select">
                                    <option value="percent">Porcentaje del ancho</option>
                                    <option value="width">Ancho máximo (px)</option>
                                </select>
                            </div>

                            <div v-if="form.mode === 'percent'">
                                <label class="mb-1 block text-xs font-semibold uppercase text-slate-500">
                                    Reducir al {{ form.percent }}%
                                </label>
                                <input v-model.number="form.percent" type="range" min="10" max="95"
                                    step="5" class="w-full" />
                            </div>

                            <div v-else>
                                <label class="mb-1 block text-xs font-semibold uppercase text-slate-500">
                                    Ancho máximo (px)
                                </label>
                                <input v-model.number="form.width" type="number" min="120" max="6000"
                                    step="80" class="form-input" />
                            </div>

                            <div>
                                <label class="mb-1 block text-xs font-semibold uppercase text-slate-500">
                                    Calidad ({{ form.quality }})
                                    <HelpTip text="Calidad de recompresión (55-95). Bajar de 75 puede notarse en fotos; en capturas y gráficos el cambio suele ser invisible." />
                                </label>
                                <input v-model.number="form.quality" type="range" :min="quality.min ?? 55"
                                    :max="quality.max ?? 95" step="1" class="w-full" />
                            </div>

                            <div class="rounded-lg bg-slate-50 p-3 text-[11px] leading-relaxed text-slate-500 dark:bg-slate-800 dark:text-slate-400">
                                Las imágenes que ya son iguales o más pequeñas que el tamaño solicitado se
                                omiten. Antes de sobrescribir se guarda una copia en
                                <code>storage/app/performance-backups</code>.
                            </div>

                            <button type="button" class="btn btn-primary w-full"
                                title="Redimensiona y recomprime las imágenes marcadas manteniendo nombre y extensión. Guarda una copia del original en storage/app/performance-backups."
                                :disabled="selected.length === 0 || resizing" @click="resizeSelected">
                                {{ resizing ? 'Procesando…' : `Redimensionar ${selected.length} imagen(es)` }}
                            </button>

                            <button type="button" class="btn btn-outline-primary w-full"
                                title="Crea una copia .webp junto a cada imagen marcada. No modifica ni reemplaza el archivo original."
                                :disabled="selected.length === 0 || bulkAction === 'webp'" @click="generateWebp">
                                {{ bulkAction === 'webp' ? 'Generando WebP…' : 'Generar copia WebP' }}
                            </button>

                            <button type="button" class="btn btn-outline-danger w-full"
                                title="Mueve las imágenes marcadas a storage/app/performance-quarantine. No las borra: puedes recuperarlas. Pide tu contraseña antes de ejecutar."
                                :disabled="selected.length === 0 || bulkAction === 'quarantine'"
                                @click="quarantineSelected">
                                Mover a cuarentena
                            </button>

                            <button v-if="selected.length" type="button"
                                class="btn btn-outline-danger w-full" @click="selected = []">
                                Limpiar selección
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Duplicados -->
        <div v-if="showDuplicates"
            class="fixed inset-0 z-[60] flex items-center justify-center bg-black/50 p-4"
            @click.self="showDuplicates = false">
            <div class="max-h-[90vh] w-full max-w-3xl overflow-y-auto rounded-xl bg-white p-5 shadow-xl dark:bg-slate-800">
                <div class="mb-4 flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold">Archivos duplicados</h3>
                        <p class="text-xs text-slate-500 dark:text-slate-400">
                            Mismo contenido con distinto nombre. Se conserva la primera copia de cada grupo.
                        </p>
                    </div>
                    <button type="button" class="text-slate-400 hover:text-slate-600"
                        @click="showDuplicates = false">
                        ✕
                    </button>
                </div>

                <p v-if="duplicates.length === 0" class="text-sm text-slate-500">
                    No se encontraron duplicados en esta pestaña.
                </p>

                <div v-for="(group, index) in duplicates" :key="index"
                    class="mb-4 rounded-lg border border-slate-200 p-3 dark:border-slate-700">
                    <div class="mb-2 flex flex-wrap items-center justify-between gap-2">
                        <div class="text-sm font-medium">
                            {{ group.length }} copias · {{ formatBytes(group[0].bytes) }} cada una
                        </div>
                        <button type="button" class="btn btn-sm btn-outline-danger"
                            :disabled="bulkAction === 'quarantine'" @click="quarantineGroup(group)">
                            Mover copias a cuarentena
                        </button>
                    </div>
                    <ul class="space-y-1 text-xs">
                        <li v-for="entry in group" :key="entry.id" class="flex flex-wrap items-center gap-2">
                            <a :href="entry.url" target="_blank" rel="noopener"
                                class="truncate font-mono text-primary hover:underline">
                                {{ entry.root_label }}/{{ entry.file }}
                            </a>
                            <span :class="entry.usages > 0 ? 'text-amber-600' : 'text-slate-400'">
                                {{ entry.usages }} uso(s)
                            </span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Detalle -->
        <div v-if="detail"
            class="fixed inset-0 z-[60] flex items-center justify-center bg-black/50 p-4"
            @click.self="detail = null">
            <div class="max-h-[90vh] w-full max-w-2xl overflow-y-auto rounded-xl bg-white p-5 shadow-xl dark:bg-slate-800">
                <div class="mb-4 flex items-start justify-between gap-4">
                    <div>
                        <h3 class="text-lg font-semibold">{{ detail.name }}</h3>
                        <p class="font-mono text-xs text-slate-500 dark:text-slate-400">
                            {{ detail.root_label }}/{{ detail.file }}
                        </p>
                    </div>
                    <button type="button" class="text-slate-400 hover:text-slate-600"
                        @click="detail = null">
                        ✕
                    </button>
                </div>

                <div class="mb-4 flex justify-center rounded-lg bg-slate-50 p-3 dark:bg-slate-900">
                    <img :src="detail.url" :alt="detail.name" class="max-h-64 object-contain" />
                </div>

                <dl class="mb-4 grid grid-cols-2 gap-3 text-sm sm:grid-cols-4">
                    <div>
                        <dt class="text-xs text-slate-500">Resolución</dt>
                        <dd class="font-semibold">
                            {{ detail.width ? `${detail.width}×${detail.height}` : '—' }}
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-500">Peso</dt>
                        <dd class="font-semibold">{{ formatBytes(detail.bytes) }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-500">Formato</dt>
                        <dd class="font-semibold">.{{ detail.extension }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs text-slate-500">Modificado</dt>
                        <dd class="font-semibold">{{ detail.modified }}</dd>
                    </div>
                </dl>

                <a :href="detail.url" target="_blank" rel="noopener"
                    class="mb-4 inline-block break-all text-xs text-primary hover:underline">
                    {{ detail.url }}
                </a>

                <h4 class="mb-2 text-sm font-semibold">Dónde se muestra</h4>
                <ul v-if="detail.usages.length" class="space-y-2 text-sm">
                    <li v-for="(usage, index) in detail.usages" :key="index"
                        class="rounded-lg border border-slate-200 p-2 dark:border-slate-700">
                        <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">
                            {{ usage.label }}
                            <span v-if="usage.column" class="ml-1 font-mono normal-case">({{ usage.column }})</span>
                            <HelpTip v-if="usage.type === 'database'" text="Referencia encontrada en la base de datos. El enlace abre la página pública donde se muestra." />
                            <HelpTip v-else text="Archivo del proyecto que menciona esta imagen. Ábrelo para confirmar cómo se usa antes de moverla." />
                        </p>
                        <a v-if="usage.url" :href="usage.url" target="_blank" rel="noopener"
                            class="text-primary hover:underline">
                            {{ usage.record }}
                        </a>
                        <span v-else class="break-all font-mono text-xs">{{ usage.record }}</span>
                    </li>
                </ul>
                <p v-else class="text-sm text-slate-500">
                    No se encontraron referencias a este archivo en la base de datos ni en las plantillas.
                </p>

                <button type="button" class="btn btn-primary mt-5 w-full"
                    @click="selected = [{ id: detail.id, root: detail.root, file: detail.file }]; detail = null">
                    Seleccionar esta imagen para optimizar
                </button>
            </div>
        </div>
    </AppLayout>
</template>
