<script setup>
    import { computed, onBeforeUnmount, onMounted, ref } from 'vue';

    const props = defineProps({
        // Limite configurado para el agente (parametro IA-00005), en segundos.
        maxSeconds: {
            type: Number,
            default: 360,
        },
        message: {
            type: String,
            default: 'La consulta a un Agente puede tomar 5 minutos aproximadamente.',
        },
    });

    // Paquetes de datos que recorren las pistas del circuito de un lado a otro.
    const horizontalParts = [
        { top: '16%', width: '54px', color: '#22d3ee', animationDuration: '4.2s', animationDelay: '0s' },
        { top: '38%', width: '26px', color: '#a78bfa', animationDuration: '5.8s', animationDelay: '1.1s' },
        { top: '62%', width: '68px', color: '#34d399', animationDuration: '3.6s', animationDelay: '0.6s' },
        { top: '84%', width: '34px', color: '#38bdf8', animationDuration: '6.4s', animationDelay: '2.2s' },
    ];

    const verticalParts = [
        { left: '14%', height: '38px', color: '#22d3ee', animationDuration: '5.4s', animationDelay: '0.4s' },
        { left: '86%', height: '52px', color: '#a78bfa', animationDuration: '4.6s', animationDelay: '1.8s' },
    ];

    // Chips y capacitores que "flotan" sobre la placa.
    const chips = [
        { top: '14%', left: '10%', animationDelay: '0s' },
        { top: '70%', left: '20%', animationDelay: '0.8s' },
        { top: '22%', left: '78%', animationDelay: '1.4s' },
        { top: '74%', left: '72%', animationDelay: '0.3s' },
    ];

    const leds = [0, 1, 2, 3, 4, 5];

    const elapsed = ref(0);
    let timer = null;

    onMounted(() => {
        timer = window.setInterval(() => {
            elapsed.value += 1;
        }, 1000);
    });

    onBeforeUnmount(() => {
        if (timer) {
            window.clearInterval(timer);
        }
    });

    const limitSeconds = computed(() => Math.max(1, Number(props.maxSeconds) || 360));
    const progress = computed(() => Math.min(100, (elapsed.value / limitSeconds.value) * 100));
    const limitLabel = computed(() => {
        const seconds = limitSeconds.value;

        return seconds % 60 === 0 ? `${seconds / 60} min` : `${seconds} s`;
    });
    const clock = computed(() => {
        const minutes = String(Math.floor(elapsed.value / 60)).padStart(2, '0');
        const seconds = String(elapsed.value % 60).padStart(2, '0');

        return `${minutes}:${seconds}`;
    });
</script>

<template>
    <Teleport to="body">
        <div
            class="fixed inset-0 z-[120] flex items-center justify-center bg-slate-950/85 px-4 backdrop-blur-md"
            role="status"
            aria-live="polite"
        >
            <div class="ai-agent-loader w-full max-w-2xl overflow-hidden rounded-3xl border border-cyan-400/30 bg-[#050d1b] shadow-[0_0_70px_-12px_rgba(34,211,238,0.6)]">
                <!-- Barra superior: estado del agente y cronometro -->
                <div class="flex items-center justify-between gap-3 border-b border-cyan-400/15 px-5 py-3">
                    <div class="flex items-center gap-2 font-mono text-[10px] uppercase tracking-[0.28em] text-cyan-300/80 sm:text-[11px]">
                        <span class="h-2 w-2 animate-pulse rounded-full bg-emerald-400 shadow-[0_0_10px_#34d399]"></span>
                        Agente de OpenAI · en línea
                    </div>
                    <div class="font-mono text-[11px] tabular-nums text-cyan-300/60">{{ clock }}</div>
                </div>

                <!-- Placa de circuito animada -->
                <div class="pcb-board relative h-52 w-full overflow-hidden sm:h-56">
                    <svg class="absolute inset-0 h-full w-full" viewBox="0 0 600 220" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
                        <g fill="none" stroke="rgba(34, 211, 238, 0.18)" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M0 34 H150 L192 76 H420 L468 34 H600" />
                            <path d="M0 104 H86 L128 146 H332" />
                            <path d="M600 92 H432 L388 132 H236 L196 172 H0" />
                            <path d="M600 178 H498 L458 138 H330" />
                            <path d="M248 0 V42 L206 84" />
                            <path d="M372 0 V52 L414 94" />
                            <path d="M40 220 V150 L82 108" />
                            <path d="M556 220 V156 L514 114" />
                        </g>
                        <!-- Energia que recorre las pistas -->
                        <g fill="none" stroke="rgba(103, 232, 249, 0.75)" stroke-width="1.6" stroke-linecap="round">
                            <path class="pcb-trace-flow" d="M0 34 H150 L192 76 H420 L468 34 H600" />
                            <path class="pcb-trace-flow" style="animation-delay: 0.9s" d="M600 92 H432 L388 132 H236 L196 172 H0" />
                            <path class="pcb-trace-flow" style="animation-delay: 1.7s" d="M0 104 H86 L128 146 H332" />
                        </g>
                        <g fill="rgba(34, 211, 238, 0.45)">
                            <circle cx="150" cy="34" r="2.5" />
                            <circle cx="420" cy="76" r="2.5" />
                            <circle cx="86" cy="104" r="2.5" />
                            <circle cx="236" cy="132" r="2.5" />
                            <circle cx="498" cy="178" r="2.5" />
                            <circle cx="248" cy="42" r="2.5" />
                            <circle cx="372" cy="52" r="2.5" />
                        </g>
                    </svg>

                    <div class="pcb-scanline"></div>

                    <!-- Piezas electronicas moviendose de un lado a otro -->
                    <span
                        v-for="(part, index) in horizontalParts"
                        :key="'h-' + index"
                        class="pcb-packet"
                        :style="part"
                    ></span>
                    <span
                        v-for="(part, index) in verticalParts"
                        :key="'v-' + index"
                        class="pcb-packet pcb-packet-v"
                        :style="part"
                    ></span>

                    <span
                        v-for="(chip, index) in chips"
                        :key="'chip-' + index"
                        class="pcb-chip"
                        :style="chip"
                    ></span>

                    <!-- Nucleo: chip que gira y pulsa en el centro -->
                    <div class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2">
                        <div class="chip-core">
                            <span class="chip-ring chip-ring-1"></span>
                            <span class="chip-ring chip-ring-2"></span>
                            <span class="chip-ring chip-ring-3"></span>
                            <div class="chip-body">
                                <span class="chip-pins chip-pins-left"></span>
                                <span class="chip-pins chip-pins-right"></span>
                                <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.6" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                                    <rect x="4" y="4" width="16" height="16" rx="2" />
                                    <rect x="9" y="9" width="6" height="6" />
                                    <path d="M15 2v2M9 2v2M15 20v2M9 20v2M2 15h2M2 9h2M20 15h2M20 9h2" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    <!-- Luces de actividad -->
                    <div class="absolute bottom-2 left-1/2 flex -translate-x-1/2 items-center gap-1.5">
                        <span
                            v-for="led in leds"
                            :key="'led-' + led"
                            class="pcb-led"
                            :style="{ animationDelay: (led * 0.18) + 's' }"
                        ></span>
                    </div>
                </div>

                <!-- Mensaje y progreso -->
                <div class="px-5 pb-5 pt-4">
                    <p class="text-center text-sm font-semibold tracking-wide text-cyan-100 sm:text-base">
                        {{ message }}
                    </p>

                    <div class="mx-auto mt-3 h-1.5 w-full max-w-sm overflow-hidden rounded-full bg-cyan-400/10 ring-1 ring-inset ring-cyan-400/20">
                        <div
                            class="h-full rounded-full bg-gradient-to-r from-cyan-400 via-sky-400 to-violet-500 shadow-[0_0_12px_rgba(56,189,248,0.9)] transition-[width] duration-1000 ease-linear"
                            :style="{ width: progress + '%' }"
                        ></div>
                    </div>
                    <div class="mx-auto mt-2 flex w-full max-w-sm justify-between font-mono text-[10px] uppercase tracking-widest text-cyan-300/60">
                        <span>{{ clock }} transcurridos</span>
                        <span>límite {{ limitLabel }}</span>
                    </div>

                    <p class="mt-3 text-center text-[11px] text-slate-400">
                        El agente está analizando la consulta. No cierres esta ventana.
                    </p>
                </div>
            </div>
        </div>
    </Teleport>
</template>

<style scoped>
    .pcb-board {
        background:
            radial-gradient(circle at 50% 50%, rgba(14, 165, 233, 0.22), transparent 62%),
            linear-gradient(160deg, #030913 0%, #06172b 55%, #040b18 100%);
    }

    /* Rejilla de placa madre */
    .pcb-board::before {
        content: '';
        position: absolute;
        inset: 0;
        background-image:
            linear-gradient(rgba(34, 211, 238, 0.08) 1px, transparent 1px),
            linear-gradient(90deg, rgba(34, 211, 238, 0.08) 1px, transparent 1px);
        background-size: 22px 22px;
        -webkit-mask-image: radial-gradient(circle at 50% 50%, #000 35%, transparent 85%);
        mask-image: radial-gradient(circle at 50% 50%, #000 35%, transparent 85%);
    }

    .pcb-trace-flow {
        stroke-dasharray: 12 90;
        animation: pcb-trace-flow 3.4s linear infinite;
        filter: drop-shadow(0 0 4px rgba(103, 232, 249, 0.9));
    }

    @keyframes pcb-trace-flow {
        to {
            stroke-dashoffset: -204;
        }
    }

    /* Paquete de datos horizontal: viaja de izquierda a derecha y vuelve */
    .pcb-packet {
        position: absolute;
        left: 0;
        height: 3px;
        border-radius: 999px;
        background: linear-gradient(90deg, transparent, currentColor);
        color: #22d3ee;
        box-shadow: 0 0 10px currentColor, 0 0 20px currentColor;
        transform: translateX(-100%);
        opacity: 0;
        animation-name: pcb-run-x;
        animation-timing-function: linear;
        animation-iteration-count: infinite;
        animation-direction: alternate;
    }

    /* Paquete vertical: sube y baja por las pistas laterales */
    .pcb-packet-v {
        top: 0;
        left: auto;
        width: 3px;
        height: 40px;
        background: linear-gradient(180deg, transparent, currentColor);
        transform: translateY(-100%);
        animation-name: pcb-run-y;
    }

    @keyframes pcb-run-x {
        0% {
            left: 0%;
            opacity: 0;
        }
        10% {
            opacity: 1;
        }
        90% {
            opacity: 1;
        }
        100% {
            left: 100%;
            opacity: 0;
        }
    }

    @keyframes pcb-run-y {
        0% {
            top: 0%;
            opacity: 0;
        }
        12% {
            opacity: 1;
        }
        88% {
            opacity: 1;
        }
        100% {
            top: 100%;
            opacity: 0;
        }
    }

    .pcb-chip {
        position: absolute;
        width: 28px;
        height: 17px;
        border-radius: 3px;
        border: 1px solid rgba(165, 243, 252, 0.55);
        background: linear-gradient(145deg, rgba(14, 165, 233, 0.4), rgba(2, 6, 23, 0.95));
        box-shadow: 0 0 12px rgba(34, 211, 238, 0.3), inset 0 0 7px rgba(34, 211, 238, 0.3);
        animation: pcb-chip-bob 3.6s ease-in-out infinite;
    }

    .pcb-chip::before,
    .pcb-chip::after {
        content: '';
        position: absolute;
        top: 3px;
        bottom: 3px;
        width: 2px;
        background: repeating-linear-gradient(to bottom, rgba(226, 246, 255, 0.85) 0 2px, transparent 2px 5px);
    }

    .pcb-chip::before {
        left: -4px;
    }

    .pcb-chip::after {
        right: -4px;
    }

    @keyframes pcb-chip-bob {
        0%,
        100% {
            transform: translateY(0);
        }
        50% {
            transform: translateY(-4px);
        }
    }

    .chip-core {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 96px;
        height: 96px;
    }

    .chip-ring {
        position: absolute;
        border-radius: 9999px;
    }

    .chip-ring-1 {
        inset: 0;
        border: 2px dashed rgba(34, 211, 238, 0.55);
        animation: chip-spin 7s linear infinite;
    }

    .chip-ring-2 {
        inset: -11px;
        border: 2px solid rgba(167, 139, 250, 0.5);
        border-top-color: transparent;
        border-bottom-color: transparent;
        animation: chip-spin 3.2s linear infinite reverse;
    }

    .chip-ring-3 {
        inset: -22px;
        border: 2px dotted rgba(52, 211, 153, 0.35);
        animation: chip-spin 12s linear infinite;
    }

    .chip-body {
        position: relative;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 58px;
        height: 58px;
        border-radius: 14px;
        border: 1px solid rgba(103, 232, 249, 0.8);
        background: linear-gradient(150deg, #0e7490, #082f49 70%);
        color: #cffafe;
        animation: chip-pulse 2.4s ease-in-out infinite;
    }

    .chip-pins {
        position: absolute;
        top: 8px;
        bottom: 8px;
        width: 4px;
        background: repeating-linear-gradient(to bottom, rgba(207, 250, 254, 0.9) 0 3px, transparent 3px 8px);
    }

    .chip-pins-left {
        left: -6px;
    }

    .chip-pins-right {
        right: -6px;
    }

    @keyframes chip-spin {
        to {
            transform: rotate(360deg);
        }
    }

    @keyframes chip-pulse {
        0%,
        100% {
            box-shadow: 0 0 14px rgba(34, 211, 238, 0.45), inset 0 0 10px rgba(34, 211, 238, 0.25);
        }
        50% {
            box-shadow: 0 0 32px rgba(34, 211, 238, 0.9), inset 0 0 18px rgba(34, 211, 238, 0.55);
        }
    }

    .pcb-scanline {
        position: absolute;
        left: 0;
        right: 0;
        height: 45%;
        background: linear-gradient(180deg, transparent, rgba(34, 211, 238, 0.18), transparent);
        mix-blend-mode: screen;
        animation: pcb-scan 4.2s ease-in-out infinite;
    }

    @keyframes pcb-scan {
        0% {
            top: -45%;
        }
        100% {
            top: 100%;
        }
    }

    .pcb-led {
        width: 6px;
        height: 6px;
        border-radius: 9999px;
        background: #34d399;
        box-shadow: 0 0 8px #34d399;
        animation: pcb-led-blink 1.6s ease-in-out infinite;
    }

    @keyframes pcb-led-blink {
        0%,
        100% {
            opacity: 0.25;
            transform: scale(0.85);
        }
        50% {
            opacity: 1;
            transform: scale(1.15);
        }
    }

    @media (prefers-reduced-motion: reduce) {
        .pcb-trace-flow,
        .pcb-packet,
        .pcb-chip,
        .chip-ring,
        .chip-body,
        .pcb-scanline,
        .pcb-led {
            animation: none;
        }

        .pcb-packet {
            opacity: 0.8;
        }
    }
</style>
