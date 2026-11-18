<script setup>
    import { computed, reactive, ref } from 'vue';
    import axios from 'axios';
    import Swal from 'sweetalert2';
    import FlatPickr from 'vue-flatpickr-component';
    import 'flatpickr/dist/flatpickr.css';
    import { Spanish } from 'flatpickr/dist/l10n/es.js';

    const props = defineProps({
        landing: {
            type: Object,
            default: () => ({})
        },
        landingUrl: {
            type: String,
            default: ''
        },
        menuId: {
            type: String,
            default: '01'
        }
    });

    // Mismo listado de canales que la pestaña "Enlaces UTM" de las landing de cursos.
    const channels = [
        { id: 'facebook_reel', label: 'Facebook Reel', icon: 'fa-brands fa-facebook', color: '#1877F2', utm_source: 'facebook', utm_medium: 'reel', origen: 'Social' },
        { id: 'facebook_estado', label: 'Facebook Estado', icon: 'fa-brands fa-facebook', color: '#1877F2', utm_source: 'facebook', utm_medium: 'estado', origen: 'Social' },
        { id: 'facebook_historia', label: 'Facebook Historia', icon: 'fa-brands fa-facebook', color: '#1877F2', utm_source: 'facebook', utm_medium: 'historia', origen: 'Social' },
        { id: 'facebook_live', label: 'Facebook Live', icon: 'fa-brands fa-facebook', color: '#1877F2', utm_source: 'facebook', utm_medium: 'live', origen: 'Social' },
        { id: 'facebook_post', label: 'Facebook Post', icon: 'fa-brands fa-facebook', color: '#1877F2', utm_source: 'facebook', utm_medium: 'post', origen: 'Social' },
        { id: 'youtube_shorts', label: 'YouTube Shorts', icon: 'fa-brands fa-youtube', color: '#FF0000', utm_source: 'youtube', utm_medium: 'shorts', origen: 'Social' },
        { id: 'youtube_video', label: 'YouTube Video', icon: 'fa-brands fa-youtube', color: '#FF0000', utm_source: 'youtube', utm_medium: 'video', origen: 'Social' },
        { id: 'youtube_live', label: 'YouTube Live', icon: 'fa-brands fa-youtube', color: '#FF0000', utm_source: 'youtube', utm_medium: 'live', origen: 'Social' },
        { id: 'instagram_reel', label: 'Instagram Reel', icon: 'fa-brands fa-instagram', color: '#E4405F', utm_source: 'instagram', utm_medium: 'reel', origen: 'Social' },
        { id: 'instagram_historia', label: 'Instagram Historia', icon: 'fa-brands fa-instagram', color: '#E4405F', utm_source: 'instagram', utm_medium: 'historia', origen: 'Social' },
        { id: 'instagram_post', label: 'Instagram Post', icon: 'fa-brands fa-instagram', color: '#E4405F', utm_source: 'instagram', utm_medium: 'post', origen: 'Social' },
        { id: 'instagram_live', label: 'Instagram Live', icon: 'fa-brands fa-instagram', color: '#E4405F', utm_source: 'instagram', utm_medium: 'live', origen: 'Social' },
        { id: 'x_post', label: 'X (Twitter) Post', icon: 'fa-brands fa-x-twitter', color: '#000000', utm_source: 'twitter', utm_medium: 'post', origen: 'Social' },
        { id: 'x_live', label: 'X (Twitter) Live', icon: 'fa-brands fa-x-twitter', color: '#000000', utm_source: 'twitter', utm_medium: 'live', origen: 'Social' },
        { id: 'threads_post', label: 'Threads Post', icon: 'fa-brands fa-threads', color: '#000000', utm_source: 'threads', utm_medium: 'post', origen: 'Social' },
        { id: 'linkedin_post', label: 'LinkedIn Post', icon: 'fa-brands fa-linkedin', color: '#0A66C2', utm_source: 'linkedin', utm_medium: 'post', origen: 'Social' },
        { id: 'linkedin_video', label: 'LinkedIn Video', icon: 'fa-brands fa-linkedin', color: '#0A66C2', utm_source: 'linkedin', utm_medium: 'video', origen: 'Social' },
        { id: 'linkedin_live', label: 'LinkedIn Live', icon: 'fa-brands fa-linkedin', color: '#0A66C2', utm_source: 'linkedin', utm_medium: 'live', origen: 'Social' },
        { id: 'whatsapp', label: 'WhatsApp', icon: 'fa-brands fa-whatsapp', color: '#25D366', utm_source: 'whatsapp', utm_medium: 'whatsapp', origen: 'WhatsApp' },
        { id: 'whatsapp_canal', label: 'WhatsApp Canal', icon: 'fa-brands fa-whatsapp', color: '#25D366', utm_source: 'whatsapp', utm_medium: 'canal', origen: 'WhatsApp' },
        { id: 'whatsapp_estado', label: 'WhatsApp Estado', icon: 'fa-brands fa-whatsapp', color: '#25D366', utm_source: 'whatsapp', utm_medium: 'estado', origen: 'WhatsApp' },
        { id: 'whatsapp_mensaje', label: 'WhatsApp Mensaje', icon: 'fa-brands fa-whatsapp', color: '#25D366', utm_source: 'whatsapp', utm_medium: 'mensaje', origen: 'WhatsApp' },
        { id: 'tiktok_video', label: 'TikTok Video', icon: 'fa-brands fa-tiktok', color: '#000000', utm_source: 'tiktok', utm_medium: 'video', origen: 'Social' },
        { id: 'tiktok_live', label: 'TikTok Live', icon: 'fa-brands fa-tiktok', color: '#000000', utm_source: 'tiktok', utm_medium: 'live', origen: 'Social' },
        { id: 'spotify_bio', label: 'Spotify Bio', icon: 'fa-brands fa-spotify', color: '#1DB954', utm_source: 'spotify', utm_medium: 'social', origen: 'Social' },
        { id: 'spotify_playlist', label: 'Spotify Playlist', icon: 'fa-brands fa-spotify', color: '#1DB954', utm_source: 'spotify', utm_medium: 'referral', origen: 'Social' },
        { id: 'spotify_ads', label: 'Spotify Ads', icon: 'fa-brands fa-spotify', color: '#1DB954', utm_source: 'spotify', utm_medium: 'cpc', origen: 'Spotify' },
        { id: 'email_marketing', label: 'Email Marketing', icon: 'fa-solid fa-envelope', color: '#EA4335', utm_source: 'email', utm_medium: 'email', origen: 'Email' },
    ];

    const open = ref(false);
    const expandedChannel = ref(null);
    const saving = ref(false);
    const loading = ref(false);
    const dates = ref(null);

    const defaultCampaign = computed(() => {
        const slug = (props.landing?.slug || '').trim();
        return slug ? 'gratis_' + slug.replace(/-/g, '_') : 'landing_curso_gratis';
    });

    const config = reactive({ campaign: '', channels: {} });

    const loadConfig = () => {
        const saved = props.landing?.utm_config || {};
        config.campaign = saved.campaign || defaultCampaign.value;
        channels.forEach((ch) => {
            const savedChannel = (saved.channels || []).find((c) => c.id === ch.id);
            config.channels[ch.id] = {
                term: savedChannel?.term || '',
                content: savedChannel?.content || '',
                active: savedChannel?.active !== false,
            };
        });
    };
    loadConfig();

    const campaignName = () => (config.campaign || '').trim() || defaultCampaign.value;

    const buildUrl = (channel) => {
        if (!props.landingUrl) return '';
        if (channel.active === false) return null;

        const params = new URLSearchParams({
            utm_source: channel.utm_source,
            utm_medium: channel.utm_medium,
            utm_campaign: campaignName(),
        });
        if (channel.term) params.set('utm_term', channel.term);
        if (channel.content) params.set('utm_content', channel.content);

        return `${props.landingUrl}?${params.toString()}`;
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
        } catch (error) {
            return false;
        }
    };

    const copyUrl = async (channel) => {
        const url = buildUrl(channel);
        if (!url) {
            Swal.fire({ icon: 'warning', title: 'Canal inactivo', text: 'Activa el canal para generar el enlace.' });
            return;
        }
        const ok = await copyText(url);
        Swal.fire({
            icon: ok ? 'success' : 'error',
            title: ok ? 'Copiado' : 'Error',
            text: ok ? '' : 'No se pudo copiar el enlace.',
            timer: ok ? 1200 : 2000,
            showConfirmButton: !ok,
        });
    };

    const copyAllUrls = async () => {
        const active = channels.filter((ch) => config.channels[ch.id]?.active !== false);
        if (!active.length) {
            Swal.fire({ icon: 'warning', title: 'Sin canales activos', text: 'Activa al menos un canal.' });
            return;
        }

        const lines = ['Canal\tOrigen\tURL'];
        active.forEach((ch) => lines.push(`${ch.label}\t${ch.origen}\t${buildUrl(ch)}`));

        const ok = await copyText(lines.join('\n'));
        Swal.fire({
            icon: ok ? 'success' : 'error',
            title: ok ? 'Todas las URLs copiadas' : 'Error',
            text: ok ? 'Formato de tabla (canal / origen / url), pega directo en Excel.' : 'No se pudieron copiar',
            timer: ok ? 2500 : 2000,
            showConfirmButton: !ok,
        });
    };

    const saveConfig = () => {
        saving.value = true;
        axios.post(route('cms_landing_course_free_utm_config', { menu_id: props.menuId }), {
            campaign: campaignName(),
            channels: channels.map((ch) => ({
                id: ch.id,
                term: config.channels[ch.id]?.term || '',
                content: config.channels[ch.id]?.content || '',
                active: config.channels[ch.id]?.active !== false,
            })),
        })
            .then(() => {
                config.campaign = campaignName();
                Swal.fire({ icon: 'success', title: 'Guardado', text: 'Configuración UTM guardada.', timer: 1500, showConfirmButton: false });
            })
            .catch(() => {
                Swal.fire({ icon: 'error', title: 'Error', text: 'No se pudo guardar la configuración UTM.' });
            })
            .finally(() => { saving.value = false; });
    };

    // ---------- Llegadas (registros) por origen ----------
    const stats = ref({ total: 0, by_source: [], social_detail: [], campaigns: [], referrers: [], leads: [] });
    const loaded = ref(false);

    const configFlatPickr = {
        dateFormat: 'Y-m-d',
        mode: 'range',
        locale: Spanish,
    };

    const loadStats = () => {
        if (!props.landing?.id) return;

        loading.value = true;
        axios.get(route('cms_landing_course_free_utm_stats', { menu_id: props.menuId }), {
            params: { dates: dates.value || undefined },
        })
            .then((res) => {
                stats.value = res.data;
                loaded.value = true;
            })
            .catch(() => {})
            .finally(() => { loading.value = false; });
    };

    const clearDates = () => {
        dates.value = null;
        loadStats();
    };

    const toggle = () => {
        open.value = !open.value;
        if (open.value && !loaded.value) loadStats();
    };

    const originRows = [
        { key: 'facebook_ads', label: 'Facebook Ads' },
        { key: 'google_ads', label: 'Google Ads' },
        { key: 'cpc', label: 'CPC' },
        { key: 'social', label: 'Social' },
        { key: 'organic', label: 'Orgánico' },
        { key: 'email', label: 'Email' },
        { key: 'referrer', label: 'Otra página' },
    ];

    const total = computed(() => Number(stats.value.total || 0));

    const countFor = (key) => (stats.value.by_source || [])
        .filter((row) => row.traffic_source === key)
        .reduce((acc, row) => acc + Number(row.total || 0), 0);

    const countOthers = computed(() => {
        const known = originRows.reduce((acc, row) => acc + countFor(row.key), 0);
        return total.value - known;
    });

    const channelMeta = (utm_source, utm_medium) => {
        const key = `${utm_source || ''}_${utm_medium || ''}`;
        const channel = channels.find((ch) => `${ch.utm_source}_${ch.utm_medium}` === key);
        if (channel) return channel;

        const label = [utm_source, utm_medium].filter(Boolean).join(' / ');

        return { label: label || 'Social', icon: 'fa-solid fa-share-nodes', color: '#6B7280' };
    };

    const socialRows = computed(() => (stats.value.social_detail || []).map((row) => ({
        ...channelMeta(row.utm_source, row.utm_medium),
        key: `${row.utm_source || ''}_${row.utm_medium || ''}`,
        total: Number(row.total || 0),
    })));

    const referrerRows = computed(() => (stats.value.referrers || []).map((row) => ({
        host: row.host || 'Desconocido',
        total: Number(row.total || 0),
    })));

    const campaignRows = computed(() => (stats.value.campaigns || []).map((row) => ({
        campaign: row.utm_campaign || 'Sin campaña',
        total: Number(row.total || 0),
    })));

    const leads = computed(() => stats.value.leads || []);

    const originLabel = (key) => originRows.find((row) => row.key === key)?.label || key || 'Desconocido';

    const formatDate = (value) => {
        if (!value) return '';
        const parsed = new Date(value);

        return isNaN(parsed.getTime()) ? '' : parsed.toLocaleString('es-PE', { dateStyle: 'short', timeStyle: 'short' });
    };
</script>

<template>
    <div class="mt-4 border-t border-blue-200 pt-3 dark:border-gray-700">
        <button type="button" class="flex w-full items-start justify-between gap-3 text-left" @click="toggle">
            <span>
                <span class="text-sm font-semibold">Enlaces UTM y llegadas de la campaña</span>
                <span class="block text-xs text-gray-500 dark:text-gray-400">
                    Genera los enlaces con UTM por canal y revisa quiénes llegaron y de dónde.
                </span>
            </span>
            <svg class="mt-1 h-4 w-4 shrink-0 text-gray-500 transition-transform duration-200 dark:text-gray-400"
                :class="open ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
            </svg>
        </button>

        <div v-show="open" class="mt-4 space-y-5">
            <p v-if="!landingUrl" class="rounded bg-amber-50 p-2 text-xs text-amber-700 dark:bg-amber-900/20 dark:text-amber-400">
                Escribe el título para generar la ruta de la landing y poder armar los enlaces UTM.
            </p>

            <!-- Configuración de campaña -->
            <div class="flex flex-wrap items-end gap-3">
                <div class="min-w-[220px] flex-1">
                    <label class="mb-1 block text-xs font-medium text-gray-500 dark:text-gray-400">Nombre de campaña (utm_campaign)</label>
                    <input v-model="config.campaign" type="text" class="form-input" :placeholder="defaultCampaign" />
                </div>
                <button type="button" class="btn btn-primary text-xs uppercase" :disabled="saving"
                    :class="{ 'opacity-25': saving }" @click="saveConfig">
                    Guardar configuración
                </button>
                <button type="button" class="btn btn-outline-primary text-xs uppercase" :disabled="!landing?.id"
                    @click="copyAllUrls">
                    Copiar todas
                </button>
            </div>
            <p class="text-xs text-gray-400">El nombre de campaña se usa en todos los enlaces. Guarda antes de copiar los links.</p>

            <!-- Canales -->
            <div class="grid grid-cols-1 gap-2 lg:grid-cols-2">
                <div v-for="channel in channels" :key="channel.id"
                    class="rounded-lg border border-gray-200 dark:border-gray-700">
                    <div class="flex items-center justify-between gap-2 px-3 py-2">
                        <div class="flex min-w-0 cursor-pointer items-center gap-2" @click="expandedChannel = expandedChannel === channel.id ? null : channel.id">
                            <span class="flex h-6 w-6 shrink-0 items-center justify-center rounded-full text-xs text-white"
                                :style="{ backgroundColor: channel.color }">
                                <i :class="channel.icon"></i>
                            </span>
                            <span class="truncate text-xs font-semibold">{{ channel.label }}</span>
                            <span class="shrink-0 rounded bg-gray-100 px-1.5 py-0.5 text-[10px] text-gray-500 dark:bg-gray-700 dark:text-gray-300">
                                {{ channel.origen }}
                            </span>
                        </div>
                        <div class="flex shrink-0 items-center gap-2">
                            <label class="relative inline-flex cursor-pointer items-center" @click.stop title="Activar/desactivar canal">
                                <input type="checkbox" v-model="config.channels[channel.id].active" class="peer sr-only" />
                                <span class="h-4 w-8 rounded-full bg-gray-200 after:absolute after:left-[2px] after:top-[2px] after:h-3 after:w-3 after:rounded-full after:bg-white after:transition-all after:content-[''] peer-checked:bg-blue-600 peer-checked:after:translate-x-4 dark:bg-gray-700"></span>
                            </label>
                            <button type="button" class="rounded bg-blue-50 px-2 py-1 text-[11px] font-medium text-blue-600 hover:bg-blue-100 dark:bg-blue-900/30 dark:text-blue-400"
                                :class="{ 'pointer-events-none opacity-40': config.channels[channel.id].active === false }"
                                @click.stop="copyUrl(channel)">
                                Copiar
                            </button>
                            <svg class="h-3 w-3 text-gray-400 transition-transform duration-200"
                                :class="expandedChannel === channel.id ? 'rotate-180' : ''" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>

                    <div v-if="expandedChannel === channel.id" class="border-t border-gray-100 px-3 pb-3 dark:border-gray-700">
                        <div class="mt-2 grid grid-cols-1 gap-2 md:grid-cols-2">
                            <div>
                                <label class="mb-1 block text-[11px] font-medium text-gray-500 dark:text-gray-400">utm_term <span class="font-normal">(palabra clave)</span></label>
                                <input v-model="config.channels[channel.id].term" type="text" class="form-input" placeholder="Opcional" />
                            </div>
                            <div>
                                <label class="mb-1 block text-[11px] font-medium text-gray-500 dark:text-gray-400">utm_content <span class="font-normal">(anuncio / variante)</span></label>
                                <input v-model="config.channels[channel.id].content" type="text" class="form-input" placeholder="Opcional" />
                            </div>
                        </div>
                        <div class="mt-2 flex flex-wrap gap-1 text-[10px]">
                            <span class="rounded bg-blue-100 px-1.5 py-0.5 font-mono text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">utm_source={{ channel.utm_source }}</span>
                            <span class="rounded bg-green-100 px-1.5 py-0.5 font-mono text-green-700 dark:bg-green-900/30 dark:text-green-300">utm_medium={{ channel.utm_medium }}</span>
                            <span class="rounded bg-purple-100 px-1.5 py-0.5 font-mono text-purple-700 dark:bg-purple-900/30 dark:text-purple-300">utm_campaign={{ campaignName() }}</span>
                            <span v-if="channel.term" class="rounded bg-yellow-100 px-1.5 py-0.5 font-mono text-yellow-700 dark:bg-yellow-900/30 dark:text-yellow-300">utm_term={{ channel.term }}</span>
                            <span v-if="channel.content" class="rounded bg-pink-100 px-1.5 py-0.5 font-mono text-pink-700 dark:bg-pink-900/30 dark:text-pink-300">utm_content={{ channel.content }}</span>
                        </div>
                        <code class="mt-2 block break-all rounded border border-gray-200 bg-gray-50 p-2 text-[11px] text-gray-600 dark:border-gray-700 dark:bg-gray-800 dark:text-gray-300">
                            {{ buildUrl(channel) || 'Escribe el título para generar la ruta' }}
                        </code>
                    </div>
                </div>
            </div>

            <!-- Llegadas -->
            <div class="rounded-lg border border-gray-200 dark:border-gray-700">
                <div class="flex flex-wrap items-center justify-between gap-2 border-b border-gray-100 px-3 py-2 dark:border-gray-700">
                    <div>
                        <span class="text-sm font-semibold">Quiénes llegaron y de dónde</span>
                        <span class="ml-2 rounded bg-blue-100 px-2 py-0.5 text-xs font-bold text-blue-700 dark:bg-blue-900/30 dark:text-blue-300">{{ total }} registros</span>
                    </div>
                    <div class="flex items-center gap-2">
                        <div class="relative">
                            <FlatPickr v-model="dates" :config="configFlatPickr" class="form-input w-48" placeholder="Rango de fechas" @on-change="loadStats" />
                            <button v-if="dates" type="button" class="absolute right-2 top-2 text-gray-500" @click="clearDates" aria-label="Limpiar fechas">
                                <svg class="h-4 w-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                                </svg>
                            </button>
                        </div>
                        <button type="button" class="rounded bg-gray-100 px-3 py-1.5 text-xs font-medium text-gray-600 hover:bg-gray-200 disabled:opacity-50 dark:bg-gray-700 dark:text-gray-300"
                            :disabled="loading || !landing?.id" @click="loadStats">
                            {{ loading ? 'Cargando…' : 'Actualizar' }}
                        </button>
                    </div>
                </div>

                <div v-if="!landing?.id" class="p-3 text-xs text-gray-500 dark:text-gray-400">
                    Guarda la landing para empezar a contar las llegadas.
                </div>

                <div v-else class="space-y-4 p-3">
                    <div class="grid grid-cols-1 gap-3 md:grid-cols-2">
                        <div>
                            <p class="mb-1 text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Por origen</p>
                            <table class="min-w-full text-xs">
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    <tr v-for="row in originRows" :key="row.key">
                                        <td class="py-1.5 pr-2 text-gray-600 dark:text-gray-300">
                                            {{ row.label }}
                                            <span v-if="row.key === 'social' && socialRows.length" class="text-gray-400">({{ socialRows.length }} canales)</span>
                                            <span v-if="row.key === 'referrer' && referrerRows.length" class="text-gray-400">({{ referrerRows.length }} páginas)</span>
                                        </td>
                                        <td class="py-1.5 text-right font-semibold" :class="countFor(row.key) > 0 ? 'text-blue-600 dark:text-blue-400' : 'text-gray-400'">
                                            {{ countFor(row.key) }}
                                        </td>
                                    </tr>
                                    <tr v-if="countOthers > 0">
                                        <td class="py-1.5 pr-2 text-gray-600 dark:text-gray-300">Otros / Desconocido</td>
                                        <td class="py-1.5 text-right font-semibold text-gray-700 dark:text-gray-200">{{ countOthers }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div>
                            <p class="mb-1 text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Por campaña</p>
                            <table class="min-w-full text-xs">
                                <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                    <tr v-for="row in campaignRows" :key="row.campaign">
                                        <td class="truncate py-1.5 pr-2 font-mono text-gray-600 dark:text-gray-300">{{ row.campaign }}</td>
                                        <td class="py-1.5 text-right font-semibold text-gray-700 dark:text-gray-200">{{ row.total }}</td>
                                    </tr>
                                    <tr v-if="!campaignRows.length">
                                        <td class="py-1.5 text-gray-400">Sin registros todavía.</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div v-if="socialRows.length || referrerRows.length" class="flex flex-wrap gap-1 text-[11px]">
                        <span v-for="row in socialRows" :key="'social-' + row.key"
                            class="rounded bg-gray-100 px-2 py-0.5 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                            <i :class="row.icon" class="mr-1" :style="{ color: row.color }"></i>{{ row.label }}: <strong>{{ row.total }}</strong>
                        </span>
                        <span v-for="row in referrerRows" :key="'ref-' + row.host"
                            class="rounded bg-gray-100 px-2 py-0.5 text-gray-600 dark:bg-gray-700 dark:text-gray-300">
                            <i class="fa-solid fa-arrow-up-right-from-square mr-1 text-gray-400"></i>{{ row.host }}: <strong>{{ row.total }}</strong>
                        </span>
                    </div>

                    <div class="overflow-x-auto">
                        <p class="mb-1 text-xs font-semibold uppercase text-gray-500 dark:text-gray-400">Últimos registros</p>
                        <table class="min-w-full divide-y divide-gray-200 text-xs dark:divide-gray-700">
                            <thead class="bg-gray-50 dark:bg-gray-800/60">
                                <tr>
                                    <th class="px-2 py-1.5 text-left font-semibold text-gray-500 dark:text-gray-400">Nombre</th>
                                    <th class="px-2 py-1.5 text-left font-semibold text-gray-500 dark:text-gray-400">Contacto</th>
                                    <th class="px-2 py-1.5 text-left font-semibold text-gray-500 dark:text-gray-400">Origen</th>
                                    <th class="px-2 py-1.5 text-left font-semibold text-gray-500 dark:text-gray-400">Campaña</th>
                                    <th class="px-2 py-1.5 text-left font-semibold text-gray-500 dark:text-gray-400">Fecha</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-100 dark:divide-gray-700">
                                <tr v-for="(lead, index) in leads" :key="index">
                                    <td class="px-2 py-1.5 text-gray-700 dark:text-gray-200">{{ lead.name || '—' }}</td>
                                    <td class="px-2 py-1.5 text-gray-600 dark:text-gray-300">
                                        <span class="block">{{ lead.email || '—' }}</span>
                                        <span class="block text-[11px] text-gray-400">{{ lead.phone }}</span>
                                    </td>
                                    <td class="px-2 py-1.5 text-gray-600 dark:text-gray-300">
                                        <span class="block">{{ originLabel(lead.traffic_source) }}</span>
                                        <span class="block text-[11px] text-gray-400">
                                            {{ [lead.utm_source, lead.utm_medium].filter(Boolean).join(' / ') || '—' }}
                                        </span>
                                    </td>
                                    <td class="px-2 py-1.5 font-mono text-[11px] text-gray-500 dark:text-gray-400">{{ lead.utm_campaign || '—' }}</td>
                                    <td class="px-2 py-1.5 text-gray-500 dark:text-gray-400">{{ formatDate(lead.created_at) }}</td>
                                </tr>
                                <tr v-if="!leads.length">
                                    <td colspan="5" class="px-2 py-3 text-center text-gray-400">
                                        Todavía no hay registros desde esta landing.
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>
