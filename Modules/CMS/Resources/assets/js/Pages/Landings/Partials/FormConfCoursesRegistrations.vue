<script setup>
    import { computed, ref } from 'vue';
    import axios from 'axios';
    import FlatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';
    import { Spanish } from 'flatpickr/dist/l10n/es.js';

    const props = defineProps({
        landing: {
            type: Object,
            default: () => ({})
        },
        menuId: {
            type: String,
            default: '01'
        }
    });

    const open = ref(false);
    const loading = ref(false);
    const loaded = ref(false);
    const dates = ref(null);
    const data = ref({ rows: [], total: 0, current_page: 1, last_page: 1, per_page: 20 });

    const configFlatPickr = {
        dateFormat: 'Y-m-d',
        mode: 'range',
        locale: Spanish,
    };

    const origins = {
        organic: 'Orgánico',
        social: 'Social',
        cpc: 'CPC',
        referrer: 'Otra página',
        email: 'Email',
        facebook_ads: 'Facebook Ads',
        google_ads: 'Google Ads',
    };

    const originLabel = (key) => origins[key] || key || 'Desconocido';

    const load = (page = 1) => {
        if (!props.landing?.id) return;

        loading.value = true;
        axios.get(route('cms_landing_course_free_registrations', { menu_id: props.menuId }), {
            params: { dates: dates.value || undefined, page },
        })
            .then((res) => {
                data.value = res.data;
                loaded.value = true;
            })
            .catch(() => {})
            .finally(() => { loading.value = false; });
    };

    const toggle = () => {
        open.value = !open.value;
        if (open.value && !loaded.value) load(1);
    };

    const filterByDates = () => load(1);

    const clearDates = () => {
        dates.value = null;
        load(1);
    };

    const rows = computed(() => data.value.rows || []);
    const total = computed(() => Number(data.value.total || 0));

    const hasPrev = computed(() => Number(data.value.current_page) > 1);
    const hasNext = computed(() => Number(data.value.current_page) < Number(data.value.last_page));

    const exportUrl = (format) => {
        const query = dates.value ? `?dates=${encodeURIComponent(dates.value)}` : '';

        return route('cms_landing_course_free_registrations_export', {
            menu_id: props.menuId,
            format,
        }) + query;
    };
</script>

<template>
    <div class="mt-4 border-t border-blue-200 pt-3 dark:border-gray-700">
        <button type="button" class="flex w-full items-start justify-between gap-3 text-left" @click="toggle">
            <span>
                <span class="text-sm font-semibold">Datos obtenidos por los registros</span>
                <span class="block text-xs text-gray-500 dark:text-gray-400">
                    Consulta en tabla los datos que dejaron los usuarios y descárgalos en Excel o PDF.
                </span>
            </span>
            <span class="flex shrink-0 items-center gap-2">
                <span v-if="loaded" class="rounded bg-blue-100 px-2 py-0.5 text-xs font-bold text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">
                    {{ total }}
                </span>
                <svg class="mt-1 h-4 w-4 text-gray-500 transition-transform duration-200 dark:text-gray-400"
                    :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                </svg>
            </span>
        </button>

        <div v-show="open" class="mt-4 space-y-3">
            <div class="flex flex-wrap items-center justify-between gap-2">
                <div class="flex items-center gap-2">
                    <div class="relative">
                        <FlatPickr v-model="dates" :config="configFlatPickr" class="form-input w-48"
                            placeholder="Rango de fechas" @on-change="filterByDates" />
                        <button v-if="dates" type="button" class="absolute right-2 top-2 text-gray-500"
                            @click="clearDates" aria-label="Limpiar fechas">
                            <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                        </button>
                    </div>
                    <button type="button" class="rounded bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-200 disabled:opacity-50 dark:bg-gray-700 dark:text-gray-300"
                        :disabled="loading || !landing?.id" @click="load(data.current_page || 1)">
                        {{ loading ? 'Cargando…' : 'Actualizar' }}
                    </button>
                </div>
                <div class="flex items-center gap-2">
                    <a :href="exportUrl('excel')" class="btn btn-outline-success text-xs uppercase"
                        :class="{ 'pointer-events-none opacity-40': !landing?.id }">
                        Exportar Excel
                    </a>
                    <a :href="exportUrl('pdf')" class="btn btn-outline-danger text-xs uppercase"
                        :class="{ 'pointer-events-none opacity-40': !landing?.id }">
                        Exportar PDF
                    </a>
                </div>
            </div>

            <p v-if="!landing?.id" class="rounded bg-amber-50 p-2 text-xs text-amber-700 dark:bg-amber-900/20 dark:text-amber-400">
                Guarda la landing para ver los registros obtenidos.
            </p>

            <div v-else class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200 text-xs dark:divide-gray-700">
                    <thead class="bg-gray-50 dark:bg-gray-800/60">
                        <tr>
                            <th class="px-2 py-1.5 text-left font-semibold text-gray-500 dark:text-gray-400">Fecha</th>
                            <th class="px-2 py-1.5 text-left font-semibold text-gray-500 dark:text-gray-400">Nombre</th>
                            <th class="px-2 py-1.5 text-left font-semibold text-gray-500 dark:text-gray-400">Correo</th>
                            <th class="px-2 py-1.5 text-left font-semibold text-gray-500 dark:text-gray-400">Teléfono</th>
                            <th class="px-2 py-1.5 text-left font-semibold text-gray-500 dark:text-gray-400">Áreas de interés</th>
                            <th class="px-2 py-1.5 text-left font-semibold text-gray-500 dark:text-gray-400">Origen</th>
                            <th class="px-2 py-1.5 text-left font-semibold text-gray-500 dark:text-gray-400">Campaña</th>
                            <th class="px-2 py-1.5 text-left font-semibold text-gray-500 dark:text-gray-400">Referer</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                        <tr v-for="(row, index) in rows" :key="index">
                            <td class="whitespace-nowrap px-2 py-1.5 text-gray-500 dark:text-gray-400">{{ row.fecha }}</td>
                            <td class="px-2 py-1.5 text-gray-700 dark:text-gray-200">{{ row.nombre || '—' }}</td>
                            <td class="px-2 py-1.5 text-gray-600 dark:text-gray-300">{{ row.email || '—' }}</td>
                            <td class="px-2 py-1.5 text-gray-600 dark:text-gray-300">{{ row.telefono || '—' }}</td>
                            <td class="max-w-[280px] px-2 py-1.5 text-gray-600 dark:text-gray-300">{{ row.intereses || '—' }}</td>
                            <td class="px-2 py-1.5 text-gray-600 dark:text-gray-300">
                                <span class="block">{{ originLabel(row.origen) }}</span>
                                <span class="block text-[11px] text-gray-400">
                                    {{ [row.utm_source, row.utm_medium].filter(Boolean).join(' / ') || '—' }}
                                </span>
                            </td>
                            <td class="px-2 py-1.5 font-mono text-[11px] text-gray-500 dark:text-gray-400">{{ row.utm_campaign || '—' }}</td>
                            <td class="max-w-[220px] truncate px-2 py-1.5 text-[11px] text-gray-500 dark:text-gray-400" :title="row.referer">
                                {{ row.referer || '—' }}
                            </td>
                        </tr>
                        <tr v-if="!rows.length">
                            <td colspan="8" class="px-2 py-3 text-center text-gray-400">
                                {{ loading ? 'Cargando registros…' : 'Todavía no hay registros desde esta landing.' }}
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>

            <div v-if="landing?.id && total > 0" class="flex flex-wrap items-center justify-between gap-2 text-xs text-gray-500 dark:text-gray-400">
                <span>
                    Página {{ data.current_page }} de {{ data.last_page }} · {{ total }} registros
                </span>
                <div class="flex items-center gap-2">
                    <button type="button" class="rounded bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 hover:bg-gray-200 disabled:opacity-40 dark:bg-gray-700 dark:text-gray-300"
                        :disabled="!hasPrev || loading" @click="load(Number(data.current_page) - 1)">
                        Anterior
                    </button>
                    <button type="button" class="rounded bg-gray-100 px-3 py-1 text-xs font-medium text-gray-600 hover:bg-gray-200 disabled:opacity-40 dark:bg-gray-700 dark:text-gray-300"
                        :disabled="!hasNext || loading" @click="load(Number(data.current_page) + 1)">
                        Siguiente
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>
