<script setup>
import { computed, reactive, ref } from 'vue';
import axios from 'axios';
import Swal from 'sweetalert2';
import FlatPickr from 'vue-flatpickr-component';
import 'flatpickr/dist/flatpickr.css';
import { Spanish } from 'flatpickr/dist/l10n/es.js';

const props = defineProps({
    utmConfig: { type: Object, default: () => ({}) },
    utmStats: { type: Object, default: null },
    subscriptionsUrl: { type: String, required: true },
});

const DEFAULT_CAMPAIGN = 'suscripciones';

// Canales alineados con el clasificador de tráfico (traffic-tracking.js)
const baseChannels = [
    // Facebook
    { id: 'facebook_reel', label: 'Facebook Reel', icon: 'fa-brands fa-facebook', color: '#1877F2', utm_source: 'facebook', utm_medium: 'reel', origen: 'Social' },
    { id: 'facebook_estado', label: 'Facebook Estado', icon: 'fa-brands fa-facebook', color: '#1877F2', utm_source: 'facebook', utm_medium: 'estado', origen: 'Social' },
    { id: 'facebook_historia', label: 'Facebook Historia', icon: 'fa-brands fa-facebook', color: '#1877F2', utm_source: 'facebook', utm_medium: 'historia', origen: 'Social' },
    { id: 'facebook_live', label: 'Facebook Live', icon: 'fa-brands fa-facebook', color: '#1877F2', utm_source: 'facebook', utm_medium: 'live', origen: 'Social' },
    { id: 'facebook_post', label: 'Facebook Post', icon: 'fa-brands fa-facebook', color: '#1877F2', utm_source: 'facebook', utm_medium: 'post', origen: 'Social' },
    // YouTube
    { id: 'youtube_shorts', label: 'YouTube Shorts', icon: 'fa-brands fa-youtube', color: '#FF0000', utm_source: 'youtube', utm_medium: 'shorts', origen: 'Social' },
    { id: 'youtube_video', label: 'YouTube Video', icon: 'fa-brands fa-youtube', color: '#FF0000', utm_source: 'youtube', utm_medium: 'video', origen: 'Social' },
    { id: 'youtube_live', label: 'YouTube Live', icon: 'fa-brands fa-youtube', color: '#FF0000', utm_source: 'youtube', utm_medium: 'live', origen: 'Social' },
    // Instagram
    { id: 'instagram_reel', label: 'Instagram Reel', icon: 'fa-brands fa-instagram', color: '#E4405F', utm_source: 'instagram', utm_medium: 'reel', origen: 'Social' },
    { id: 'instagram_historia', label: 'Instagram Historia', icon: 'fa-brands fa-instagram', color: '#E4405F', utm_source: 'instagram', utm_medium: 'historia', origen: 'Social' },
    { id: 'instagram_post', label: 'Instagram Post', icon: 'fa-brands fa-instagram', color: '#E4405F', utm_source: 'instagram', utm_medium: 'post', origen: 'Social' },
    { id: 'instagram_live', label: 'Instagram Live', icon: 'fa-brands fa-instagram', color: '#E4405F', utm_source: 'instagram', utm_medium: 'live', origen: 'Social' },
    // X (Twitter)
    { id: 'x_post', label: 'X (Twitter) Post', icon: 'fa-brands fa-x-twitter', color: '#000000', utm_source: 'twitter', utm_medium: 'post', origen: 'Social' },
    { id: 'x_live', label: 'X (Twitter) Live', icon: 'fa-brands fa-x-twitter', color: '#000000', utm_source: 'twitter', utm_medium: 'live', origen: 'Social' },
    // Threads
    { id: 'threads_post', label: 'Threads Post', icon: 'fa-brands fa-threads', color: '#000000', utm_source: 'threads', utm_medium: 'post', origen: 'Social' },
    // LinkedIn
    { id: 'linkedin_post', label: 'LinkedIn Post', icon: 'fa-brands fa-linkedin', color: '#0A66C2', utm_source: 'linkedin', utm_medium: 'post', origen: 'Social' },
    { id: 'linkedin_video', label: 'LinkedIn Video', icon: 'fa-brands fa-linkedin', color: '#0A66C2', utm_source: 'linkedin', utm_medium: 'video', origen: 'Social' },
    { id: 'linkedin_live', label: 'LinkedIn Live', icon: 'fa-brands fa-linkedin', color: '#0A66C2', utm_source: 'linkedin', utm_medium: 'live', origen: 'Social' },
    // WhatsApp
    { id: 'whatsapp', label: 'WhatsApp', icon: 'fa-brands fa-whatsapp', color: '#25D366', utm_source: 'whatsapp', utm_medium: 'whatsapp', origen: 'WhatsApp' },
    { id: 'whatsapp_canal', label: 'WhatsApp Canal', icon: 'fa-brands fa-whatsapp', color: '#25D366', utm_source: 'whatsapp', utm_medium: 'canal', origen: 'WhatsApp' },
    { id: 'whatsapp_estado', label: 'WhatsApp Estado', icon: 'fa-brands fa-whatsapp', color: '#25D366', utm_source: 'whatsapp', utm_medium: 'estado', origen: 'WhatsApp' },
    { id: 'whatsapp_mensaje', label: 'WhatsApp Mensaje', icon: 'fa-brands fa-whatsapp', color: '#25D366', utm_source: 'whatsapp', utm_medium: 'mensaje', origen: 'WhatsApp' },
    // TikTok
    { id: 'tiktok_video', label: 'TikTok Video', icon: 'fa-brands fa-tiktok', color: '#000000', utm_source: 'tiktok', utm_medium: 'video', origen: 'Social' },
    { id: 'tiktok_live', label: 'TikTok Live', icon: 'fa-brands fa-tiktok', color: '#000000', utm_source: 'tiktok', utm_medium: 'live', origen: 'Social' },
    // Spotify
    { id: 'spotify_bio', label: 'Spotify Bio', icon: 'fa-brands fa-spotify', color: '#1DB954', utm_source: 'spotify', utm_medium: 'social', origen: 'Social' },
    { id: 'spotify_playlist', label: 'Spotify Playlist', icon: 'fa-brands fa-spotify', color: '#1DB954', utm_source: 'spotify', utm_medium: 'referral', origen: 'Social' },
    { id: 'spotify_ads', label: 'Spotify Ads', icon: 'fa-brands fa-spotify', color: '#1DB954', utm_source: 'spotify', utm_medium: 'cpc', origen: 'Spotify' },
    // Email
    { id: 'email_marketing', label: 'Email Marketing', icon: 'fa-solid fa-envelope', color: '#EA4335', utm_source: 'email', utm_medium: 'email', origen: 'Email' },
];

// ---------- Configuración compartida (aca_subscription_utm_settings) ----------
const config = reactive({ campaign: '', channels: {} });

const initConfig = () => {
    config.campaign = props.utmConfig?.campaign || '';

    baseChannels.forEach((channel) => {
        const saved = (props.utmConfig?.channels || []).find((item) => item.id === channel.id);

        config.channels[channel.id] = {
            term: saved?.term || '',
            content: saved?.content || '',
            active: saved?.active !== false,
        };
    });
};

initConfig();

const isOpen = ref(false);

const effectiveCampaign = computed(() => (config.campaign || '').trim() || DEFAULT_CAMPAIGN);

const channels = computed(() =>
    baseChannels.map((channel) => ({
        ...channel,
        term: config.channels[channel.id]?.term || '',
        content: config.channels[channel.id]?.content || '',
        active: config.channels[channel.id]?.active !== false,
    }))
);

const buildUrl = (channel) => {
    if (channel.active === false) return null;

    const params = new URLSearchParams({
        utm_source: channel.utm_source,
        utm_medium: channel.utm_medium,
        utm_campaign: effectiveCampaign.value,
    });

    if (channel.term) params.set('utm_term', channel.term);
    if (channel.content) params.set('utm_content', channel.content);

    return `${props.subscriptionsUrl}?${params.toString()}`;
};

const saving = ref(false);
const saveConfig = () => {
    saving.value = true;

    axios
        .put(route('aca_subscriptions_utm_config'), {
            campaign: effectiveCampaign.value,
            channels: baseChannels.map((channel) => ({
                id: channel.id,
                term: config.channels[channel.id]?.term || '',
                content: config.channels[channel.id]?.content || '',
                active: config.channels[channel.id]?.active !== false,
            })),
        })
        .then(() => {
            config.campaign = effectiveCampaign.value;
            Swal.fire({
                icon: 'success',
                title: 'Guardado',
                text: 'Configuración UTM guardada.',
                timer: 1500,
                showConfirmButton: false,
            });
            loadStats();
        })
        .catch(() => {
            Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo guardar la configuración.' });
        })
        .finally(() => {
            saving.value = false;
        });
};

// ---------- Copiar enlaces ----------
const expandedIndex = ref(null);

const toggleExpand = (index) => {
    expandedIndex.value = expandedIndex.value === index ? null : index;
};

const copyText = async (text) => {
    try {
        if (navigator.clipboard && window.isSecureContext) {
            await navigator.clipboard.writeText(text);
        } else {
            const textarea = document.createElement('textarea');
            textarea.value = text;
            textarea.style.cssText = 'position:fixed;left:-9999px;top:-9999px';
            document.body.appendChild(textarea);
            textarea.focus();
            textarea.select();
            document.execCommand('copy');
            document.body.removeChild(textarea);
        }

        return true;
    } catch {
        return false;
    }
};

const copyUrl = async (url) => {
    if (!url) {
        Swal.fire({ icon: 'warning', title: 'Canal inactivo', text: 'Activa el canal para generar el enlace.' });
        return;
    }

    const ok = await copyText(url);

    Swal.fire({
        icon: ok ? 'success' : 'error',
        title: ok ? 'Copiado' : 'Error',
        text: ok ? '' : 'No se pudo copiar',
        timer: ok ? 1500 : 2000,
        showConfirmButton: !ok,
    });
};

const copyAllUrls = async () => {
    const activeChannels = channels.value.filter((channel) => channel.active !== false);

    if (activeChannels.length === 0) {
        Swal.fire({ icon: 'warning', title: 'Sin canales activos', text: 'Activa al menos un canal.' });
        return;
    }

    const lines = ['Canal\tOrigen\tURL'];
    activeChannels.forEach((channel) => lines.push(`${channel.label}\t${channel.origen}\t${buildUrl(channel)}`));

    const ok = await copyText(lines.join('\n'));

    Swal.fire({
        icon: ok ? 'success' : 'error',
        title: ok ? 'Todas las URLs copiadas' : 'Error',
        text: ok ? 'Formato de tabla (canal / origen / url), pega directo en Excel.' : 'No se pudieron copiar',
        timer: ok ? 2500 : 2000,
        showConfirmButton: !ok,
    });
};

// ---------- Atribución ----------
const stats = ref(props.utmStats || null);
const loadingStats = ref(false);
const dates = ref(null);
const month = ref('');

const flatpickrConfig = {
    dateFormat: 'Y-m-d',
    mode: 'range',
    locale: Spanish,
};

const totals = computed(() => stats.value?.totals || { views: 0, clicks: 0, subscriptions: 0 });
const origins = computed(() => stats.value?.origins || []);
const chosenPlans = computed(() => stats.value?.plans || []);
const affiliations = computed(() => stats.value?.affiliations || []);
const rangeLabel = computed(() => stats.value?.range?.label || 'Todo el historial');

const loadStats = () => {
    loadingStats.value = true;

    axios
        .get(route('aca_subscriptions_utm_stats'), {
            params: {
                dates: dates.value || undefined,
                month: month.value || undefined,
            },
        })
        .then((res) => {
            stats.value = res.data;
        })
        .catch(() => {})
        .finally(() => {
            loadingStats.value = false;
        });
};

const onDatesChange = () => {
    if (dates.value) month.value = '';
    loadStats();
};

const onMonthChange = () => {
    if (month.value) dates.value = null;
    loadStats();
};

const clearFilters = () => {
    dates.value = null;
    month.value = '';
    loadStats();
};

const exportQuery = computed(() => {
    const params = new URLSearchParams();

    if (dates.value) params.set('dates', dates.value);
    if (month.value) params.set('month', month.value);

    const query = params.toString();

    return query ? `?${query}` : '';
});

const excelUrl = computed(() => route('aca_subscriptions_utm_export_excel') + exportQuery.value);
const pdfUrl = computed(() => route('aca_subscriptions_utm_export_pdf') + exportQuery.value);
</script>

<template>
    <div class="panel">
        <!-- Cabecera desplegable -->
        <button
            type="button"
            class="w-full flex items-center justify-between px-5 py-4 text-left"
            @click="isOpen = !isOpen"
        >
            <div>
                <h5 class="font-semibold text-lg dark:text-white-light">Enlaces UTM y atribución</h5>
                <p class="text-xs text-gray-500 dark:text-gray-400 mt-0.5">
                    Un solo enlace para todos los planes en {{ subscriptionsUrl }}. Aquí ves de dónde llegaron y a qué plan se afilió cada persona.
                </p>
            </div>
            <svg
                class="w-4 h-4 text-gray-400 transition-transform duration-200 shrink-0"
                :class="isOpen ? 'rotate-180' : ''"
                fill="none"
                stroke="currentColor"
                viewBox="0 0 24 24"
            >
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div v-show="isOpen" class="px-5 pb-5 border-t border-gray-100 dark:border-gray-700">
            <!-- Campaña compartida -->
            <div class="flex flex-wrap items-end gap-3 mt-4">
                <div class="flex-1 min-w-[220px]">
                    <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                        Nombre de campaña (utm_campaign)
                    </label>
                    <input
                        v-model="config.campaign"
                        type="text"
                        class="form-input"
                        :placeholder="DEFAULT_CAMPAIGN"
                    />
                    <p class="mt-1 text-xs text-gray-400">
                        Se usa en todos los enlaces y estadísticas. Si lo dejas vacío se usa
                        <code class="font-mono">{{ DEFAULT_CAMPAIGN }}</code>.
                    </p>
                </div>
                <button
                    type="button"
                    class="btn btn-primary text-xs uppercase"
                    :class="{ 'opacity-25': saving }"
                    :disabled="saving"
                    @click="saveConfig"
                >
                    <span v-if="saving">Guardando…</span>
                    <span v-else>Guardar configuración</span>
                </button>
                <button type="button" class="btn btn-outline-primary text-xs uppercase" @click="copyAllUrls">
                    Copiar todas
                </button>
            </div>

            <!-- URL base -->
            <div class="mt-4 p-3 bg-gray-50 dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700">
                <span class="text-xs font-medium text-gray-500 dark:text-gray-400">URL base de suscripciones:</span>
                <p class="text-sm font-mono text-gray-700 dark:text-gray-300 mt-1 break-all">{{ subscriptionsUrl }}</p>
            </div>

            <!-- Enlaces por canal -->
            <div class="mt-4 space-y-2">
                <div
                    v-for="(channel, index) in channels"
                    :key="channel.id"
                    class="border border-gray-200 dark:border-gray-700 rounded-lg overflow-hidden"
                >
                    <div class="flex items-center justify-between px-3 py-2 cursor-pointer bg-white dark:bg-gray-800" @click="toggleExpand(index)">
                        <div class="flex items-center gap-2">
                            <div
                                class="w-7 h-7 rounded-full flex items-center justify-center text-white text-xs"
                                :style="{ backgroundColor: channel.color }"
                            >
                                <i :class="channel.icon"></i>
                            </div>
                            <div>
                                <span class="text-sm font-semibold text-gray-800 dark:text-white">{{ channel.label }}</span>
                                <span class="ml-2 text-[10px] font-medium px-1.5 py-0.5 rounded bg-gray-100 text-gray-500 dark:bg-gray-700 dark:text-gray-400">
                                    {{ channel.origen }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center gap-2">
                            <label class="relative inline-flex items-center cursor-pointer" @click.stop title="Activar/desactivar canal">
                                <input v-model="config.channels[channel.id].active" type="checkbox" class="sr-only peer" />
                                <div class="w-9 h-5 bg-gray-200 peer-focus:outline-none rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:left-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-4 after:w-4 after:transition-all peer-checked:bg-primary"></div>
                            </label>
                            <button
                                type="button"
                                @click.stop="copyUrl(buildUrl(channel))"
                                :class="{ 'opacity-40 pointer-events-none': config.channels[channel.id].active === false }"
                                class="px-2.5 py-1 text-xs font-medium rounded bg-blue-50 text-blue-600 hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-400"
                            >
                                Copiar
                            </button>
                            <svg
                                class="w-3.5 h-3.5 text-gray-400 transition-transform duration-200"
                                :class="expandedIndex === index ? 'rotate-180' : ''"
                                fill="none"
                                stroke="currentColor"
                                viewBox="0 0 24 24"
                            >
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <div v-if="expandedIndex === index" class="px-3 pb-3 bg-gray-50 dark:bg-gray-900/50 border-t border-gray-100 dark:border-gray-700">
                        <div class="mt-3 grid grid-cols-1 md:grid-cols-2 gap-3">
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    utm_term <span class="font-normal">(palabra clave)</span>
                                </label>
                                <input v-model="config.channels[channel.id].term" type="text" class="form-input" placeholder="Opcional" />
                            </div>
                            <div>
                                <label class="block text-xs font-medium text-gray-500 dark:text-gray-400 mb-1">
                                    utm_content <span class="font-normal">(anuncio / variante)</span>
                                </label>
                                <input v-model="config.channels[channel.id].content" type="text" class="form-input" placeholder="Opcional" />
                            </div>
                        </div>
                        <div class="flex flex-wrap gap-2 text-xs mt-3">
                            <span class="px-2 py-1 rounded bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-300 font-mono">utm_source={{ channel.utm_source }}</span>
                            <span class="px-2 py-1 rounded bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-300 font-mono">utm_medium={{ channel.utm_medium }}</span>
                            <span class="px-2 py-1 rounded bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-300 font-mono">utm_campaign={{ effectiveCampaign }}</span>
                            <span v-if="channel.term" class="px-2 py-1 rounded bg-yellow-100 text-yellow-700 font-mono">utm_term={{ channel.term }}</span>
                            <span v-if="channel.content" class="px-2 py-1 rounded bg-pink-100 text-pink-700 font-mono">utm_content={{ channel.content }}</span>
                        </div>
                        <div class="mt-3 p-2 bg-white dark:bg-gray-800 rounded border border-gray-200 dark:border-gray-700">
                            <code class="text-xs text-gray-600 dark:text-gray-300 break-all">{{ buildUrl(channel) }}</code>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Atribución -->
            <div class="mt-6">
                <div class="flex flex-wrap items-center justify-between gap-3 mb-3">
                    <div>
                        <h6 class="font-semibold text-base dark:text-white-light">De dónde llegaron y qué planes eligieron</h6>
                        <p class="text-xs text-gray-500 dark:text-gray-400">{{ rangeLabel }} · campaña <code class="font-mono">{{ stats?.campaign || effectiveCampaign }}</code></p>
                    </div>

                    <div class="flex flex-wrap items-center gap-2">
                        <div class="w-52">
                            <FlatPickr
                                v-model="dates"
                                :config="flatpickrConfig"
                                class="form-input"
                                placeholder="Rango de fechas"
                                @on-change="onDatesChange"
                            />
                        </div>
                        <input v-model="month" type="month" class="form-input w-40" @change="onMonthChange" />
                        <button
                            v-if="dates || month"
                            type="button"
                            class="px-2.5 py-1.5 text-xs rounded bg-gray-100 text-gray-600 hover:bg-gray-200 dark:bg-gray-700 dark:text-gray-300"
                            @click="clearFilters"
                        >
                            Limpiar
                        </button>
                    </div>
                </div>

                <div class="flex flex-wrap items-center gap-2 mb-3">
                    <a :href="excelUrl" target="_blank" rel="noopener" class="btn btn-primary btn-sm text-xs uppercase">
                        Exportar Excel
                    </a>
                    <a :href="pdfUrl" target="_blank" rel="noopener" class="btn btn-outline-primary btn-sm text-xs uppercase">
                        Exportar PDF
                    </a>
                    <button
                        type="button"
                        class="btn btn-outline-secondary btn-sm text-xs uppercase"
                        :disabled="loadingStats"
                        @click="loadStats"
                    >
                        <span v-if="loadingStats">Actualizando…</span>
                        <span v-else>Actualizar</span>
                    </button>
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-3 gap-3 mb-3">
                    <div class="p-3 rounded border border-gray-200 dark:border-gray-700">
                        <div class="text-[11px] font-medium text-gray-500 dark:text-gray-400 uppercase">Vistas de la página</div>
                        <div class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ totals.views }}</div>
                    </div>
                    <div class="p-3 rounded border border-gray-200 dark:border-gray-700">
                        <div class="text-[11px] font-medium text-gray-500 dark:text-gray-400 uppercase">Clics en planes</div>
                        <div class="mt-1 text-2xl font-bold text-gray-900 dark:text-white">{{ totals.clicks }}</div>
                    </div>
                    <div class="p-3 rounded border border-gray-200 dark:border-gray-700">
                        <div class="text-[11px] font-medium text-gray-500 dark:text-gray-400 uppercase">Suscripciones</div>
                        <div class="mt-1 text-2xl font-bold text-emerald-600 dark:text-emerald-400">{{ totals.subscriptions }}</div>
                        <div class="text-[10px] text-gray-400 mt-0.5">{{ totals.attributed || 0 }} con UTM de esta campaña</div>
                    </div>
                </div>

                <div class="grid grid-cols-1 lg:grid-cols-2 gap-3">
                    <div class="overflow-x-auto rounded border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-800/60">
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Origen</th>
                                    <th class="px-3 py-2 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Vistas</th>
                                    <th class="px-3 py-2 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Clics</th>
                                    <th class="px-3 py-2 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Suscrip.</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                <tr v-for="origin in origins" :key="origin.traffic_source">
                                    <td class="px-3 py-2 text-gray-700 dark:text-gray-300">{{ origin.label }}</td>
                                    <td class="px-3 py-2 text-right text-gray-900 dark:text-white">{{ origin.views }}</td>
                                    <td class="px-3 py-2 text-right text-gray-900 dark:text-white">{{ origin.clicks }}</td>
                                    <td class="px-3 py-2 text-right font-semibold text-emerald-600 dark:text-emerald-400">{{ origin.subscriptions }}</td>
                                </tr>
                                <tr v-if="!origins.length">
                                    <td colspan="4" class="px-3 py-3 text-center text-gray-400">Sin tráfico registrado en el rango.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                    <div class="overflow-x-auto rounded border border-gray-200 dark:border-gray-700">
                        <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                            <thead class="bg-gray-50 dark:bg-gray-800/60">
                                <tr>
                                    <th class="px-3 py-2 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Plan elegido</th>
                                    <th class="px-3 py-2 text-right text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Suscripciones</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                <tr v-for="plan in chosenPlans" :key="plan.subscription_id">
                                    <td class="px-3 py-2 text-gray-700 dark:text-gray-300">{{ plan.title }}</td>
                                    <td class="px-3 py-2 text-right font-semibold text-gray-900 dark:text-white">{{ plan.total }}</td>
                                </tr>
                                <tr v-if="!chosenPlans.length">
                                    <td colspan="2" class="px-3 py-3 text-center text-gray-400">Sin suscripciones en el rango.</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-3 overflow-x-auto rounded border border-gray-200 dark:border-gray-700">
                    <table class="min-w-full divide-y divide-gray-200 dark:divide-gray-700 text-sm">
                        <thead class="bg-gray-50 dark:bg-gray-800/60">
                            <tr>
                                <th class="px-3 py-2 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Fecha</th>
                                <th class="px-3 py-2 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Alumno</th>
                                <th class="px-3 py-2 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Plan al que se afilió</th>
                                <th class="px-3 py-2 text-left text-xs font-semibold text-gray-500 dark:text-gray-400 uppercase">Origen</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                            <tr v-for="(row, index) in affiliations" :key="index">
                                <td class="px-3 py-2 text-gray-600 dark:text-gray-300 whitespace-nowrap">{{ row.date }}</td>
                                <td class="px-3 py-2 text-gray-700 dark:text-gray-300">{{ row.student }}</td>
                                <td class="px-3 py-2 font-medium text-gray-900 dark:text-white">{{ row.plan }}</td>
                                <td class="px-3 py-2 text-gray-700 dark:text-gray-300">{{ row.origin }}</td>
                            </tr>
                            <tr v-if="!affiliations.length">
                                <td colspan="4" class="px-3 py-3 text-center text-gray-400">Sin afiliaciones en el rango.</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <p class="mt-2 text-xs text-gray-400">
                    Las visitas y clics se capturan en la página pública con la campaña compartida. Las suscripciones muestran el plan al que se afilió cada persona y su origen (la venta en línea conserva la UTM; las altas manuales aparecen como “Directo / manual”).
                </p>
            </div>
        </div>
    </div>
</template>
