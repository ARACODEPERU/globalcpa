<script setup>
    import { ref } from 'vue';
    import axios from 'axios';
    import Swal from 'sweetalert2';
    import { router } from '@inertiajs/vue3';
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
    import HelpTip from '../Components/HelpTip.vue';

    const props = defineProps({
        report: { type: Object, required: true },
    });

    const running = ref(false);

    const statusClass = (status) => {
        if (status === 'bad') return 'text-red-600 dark:text-red-400';
        if (status === 'warn') return 'text-amber-600 dark:text-amber-400';
        return 'text-emerald-600 dark:text-emerald-400';
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

    const runAction = async () => {
        const action = props.report.action;

        if (!action) return;

        const confirmation = await Swal.fire({
            icon: 'warning',
            title: '¿Continuar?',
            text: action.confirm || 'Esta acción no se puede deshacer.',
            showCancelButton: true,
            confirmButtonText: 'Sí, continuar',
            cancelButtonText: 'Cancelar',
        });

        if (!confirmation.isConfirmed) return;

        running.value = true;

        try {
            const { data } = await axios.post(action.url);
            await Swal.fire({
                icon: 'success',
                title: 'Listo',
                html: `Se eliminaron <b>${data.deleted}</b> archivo(s) y se liberaron <b>${formatBytes(data.bytes)}</b>.`,
            });
            router.reload();
        } catch (exception) {
            Swal.fire({
                icon: 'error',
                title: 'No se pudo ejecutar',
                text: exception?.response?.data?.message || 'Ocurrió un error inesperado.',
            });
        } finally {
            running.value = false;
        }
    };
</script>

<template>
    <AppLayout :title="report.title">
        <Navigation routeModule="/performance/images" titleModule="Performance"
            :data="[{ title: report.title }]" />

        <div class="mt-5 space-y-5">
            <div>
                <h2 class="text-xl">
                    {{ report.title }}
                    <HelpTip text="Este reporte es de solo lectura: analiza el proyecto y muestra hallazgos con su archivo o métrica. Nada se modifica desde aquí." />
                </h2>
                <p class="text-sm text-slate-500 dark:text-slate-400">{{ report.description }}</p>
            </div>

            <div v-if="report.help"
                class="rounded-lg border border-blue-200 bg-blue-50 px-4 py-3 text-sm text-blue-800 dark:border-blue-800 dark:bg-blue-900/30 dark:text-blue-200">
                {{ report.help }}
            </div>

            <div v-if="report.action" class="flex flex-wrap items-center justify-end gap-3">
                <span class="text-xs text-slate-500 dark:text-slate-400">
                    Acción puntual · requiere el permiso {{ 'perf_maintenance' }}
                    <HelpTip :text="report.action.confirm || 'Acción irreversible: revisa la tabla antes de ejecutarla.'" />
                </span>
                <button type="button" class="btn btn-outline-danger" :title="report.action.confirm"
                    :disabled="running" @click="runAction">
                    {{ running ? 'Procesando…' : report.action.label }}
                </button>
            </div>

            <p class="text-xs text-slate-500 dark:text-slate-400">
                <span class="font-semibold text-emerald-600 dark:text-emerald-400">Verde</span> = correcto ·
                <span class="font-semibold text-amber-600 dark:text-amber-400">Ámbar</span> = conviene revisar ·
                <span class="font-semibold text-red-600 dark:text-red-400">Rojo</span> = problema que afecta a los usuarios.
                <HelpTip text="El color de cada tarjeta compara el valor con un umbral recomendado para ese indicador." />
            </p>

            <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">
                <div v-for="card in report.cards" :key="card.label" class="panel">
                    <p class="text-xs uppercase tracking-wide text-slate-500 dark:text-slate-400">
                        {{ card.label }}
                    </p>
                    <p class="mt-1 text-2xl font-semibold" :class="statusClass(card.status)">
                        {{ card.value }}
                    </p>
                    <p class="mt-1 text-xs text-slate-500 dark:text-slate-400">{{ card.hint }}</p>
                </div>
            </div>

            <div v-for="section in report.sections" :key="section.title" class="panel">
                <h3 class="mb-4 text-base font-semibold">
                    {{ section.title }}
                    <HelpTip text="Datos calculados al abrir la página. Recarga para volver a analizar después de aplicar cambios." />
                </h3>

                <p v-if="!section.rows || section.rows.length === 0"
                    class="text-sm text-slate-500 dark:text-slate-400">
                    {{ section.empty || 'Sin datos.' }}
                </p>

                <div v-else class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left text-xs uppercase text-slate-500 dark:text-slate-400">
                                <th v-for="column in section.columns" :key="column.key" class="px-2 py-3">
                                    {{ column.label }}
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(row, index) in section.rows" :key="index"
                                class="border-t border-slate-100 dark:border-slate-700">
                                <td v-for="(column, columnIndex) in section.columns" :key="column.key"
                                    class="px-2 py-2"
                                    :class="columnIndex === 0 ? 'font-medium' : 'text-slate-600 dark:text-slate-300'">
                                    {{ row[column.key] }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div v-if="report.notes && report.notes.length" class="panel">
                <h3 class="mb-2 text-base font-semibold">Notas</h3>
                <ul class="list-disc space-y-1 pl-5 text-sm text-slate-600 dark:text-slate-300">
                    <li v-for="(note, index) in report.notes" :key="index">{{ note }}</li>
                </ul>
            </div>
        </div>
    </AppLayout>
</template>
