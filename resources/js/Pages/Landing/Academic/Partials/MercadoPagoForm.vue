<script setup>
import { onMounted, ref } from "vue";
import { router, usePage } from '@inertiajs/vue3'

// Url del SDK y clave de cache propia: https://sdk.mercadopago.com/js/v2 se sirve
// con Cache-Control max-age=86400, por lo que un navegador puede quedarse dias con
// una build antigua del SDK que apunta a hosts de assets ya inexistentes
// (p.ej. http-2.mlstatic.com) y el Brick falla al inicializar. Al cambiar esta
// clave se fuerza la descarga de una copia nueva.
const MERCADOPAGO_SDK_URL = 'https://sdk.mercadopago.com/js/v2';
const MERCADOPAGO_SDK_CACHE_KEY = '2026-11-19';

const cardPaymentBrickContainer = ref(null);
const brickError = ref('');

const props = defineProps({
    preference: {
        type: String,
        default: null,
    },
    publicKey: {
        type: String,
        default: null,
    },
    subscription:{
        type: Object,
        default: () => ({}),
    },
    samount: {
        type: Number,
        default: null,
    },
    personInvoice:{
        type: [Object, Array],
        default: () => ({}),
    }
});

const page = usePage();

const loadMercadoPagoSdk = () => new Promise((resolve, reject) => {
    if (window.MercadoPago) {
        resolve(window.MercadoPago);
        return;
    }

    const script = document.createElement('script');
    script.src = `${MERCADOPAGO_SDK_URL}?v=${MERCADOPAGO_SDK_CACHE_KEY}`;
    script.async = true;
    script.onload = () => {
        if (window.MercadoPago) {
            resolve(window.MercadoPago);
        } else {
            reject(new Error('MercadoPago.js no está disponible'));
        }
    };
    script.onerror = () => reject(new Error('No se pudo cargar el SDK de Mercado Pago'));

    document.head.appendChild(script);
});

onMounted(async () => {
    if (!props.publicKey) {
        brickError.value = 'Falta la llave pública de Mercado Pago (MERCADOPAGO_KEY).';
        return;
    }

    try {
        await loadMercadoPagoSdk();

        const mp = new window.MercadoPago(props.publicKey, { locale: "es" });
        const bricksBuilder = mp.bricks();

        await renderCardPaymentBrick(bricksBuilder);
    } catch (error) {
        console.error("No se pudo inicializar el formulario de pago:", error);
        brickError.value = 'No se pudo cargar el formulario de pago. Recarga la página para intentarlo de nuevo.';
    }
});

const reloadPage = () => window.location.reload();

const penAmount = () => {
    const prices = Array.isArray(props.subscription?.prices) ? props.subscription.prices : [];
    const pen = prices.find((price) => (price?.currency ?? price?.currency_id) === 'PEN');

    return Number(pen?.amount ?? 0);
};

const renderCardPaymentBrick = async (bricksBuilder) => {
    // El Brick cardPayment solo inicializa con "amount" (y "payer" opcional).
    const settings = {
        initialization: {
            amount: Number(props.samount) || penAmount(),
        },
        locale: "es",
        customization: {
            visual: {
                style: {
                    customVariables: {
                        theme: "bootstrap",
                    },
                },
            },
            paymentMethods: {
                maxInstallments: page.props.MERCADOPAGO_MAX_INSTALLMENTS,
            },
        },
        callbacks: {
            onReady: () => {
                brickError.value = '';
            },
            onSubmit: (cardFormData) => {
                cardFormData.personInvoice = props.personInvoice
                // Adjuntar datos de tráfico (UTM, fbclid, gclid, referrer, origen) capturados en localStorage
                let _tt = {};
                try { _tt = JSON.parse(localStorage.getItem('traffic_tracking') || '{}') || {}; } catch (e) {}
                Object.assign(cardFormData, _tt);
                return axios({
                        method: 'PUT',
                        url: route("aca_mercadopago_processpayment", props.subscription.id),
                        data: cardFormData
                    }).then((response) => {
                        return response.data;
                    }).then((data) => {
                        if (data.status === "approved") {
                            router.visit(data.url, {
                                method: 'get',
                                replace: true,
                                preserveState: false,
                                preserveScroll: false,
                            });
                        } else {
                            alert(data.message);
                            router.visit(route('academic_step_verification',props.subscription.id), {
                                method: 'get',
                            });
                        }
                    }).catch((error) => {
                        alert(error.response?.data?.error || error.message || "Error al procesar el pago.");
                        router.visit(route('academic_step_verification',props.subscription.id), {
                            method: 'get',
                        });
                    });
            },
            onError: (error) => {
                // Aquí llega, por ejemplo, "Bricks component initialization failed"
                // cuando el navegador no puede descargar los assets del Brick.
                console.error("Error en Brick:", error?.message, error?.cause, error);
                brickError.value = 'No se pudo cargar el formulario de pago. Recarga la página para intentarlo de nuevo.';
            },
        },
    };

    const container = cardPaymentBrickContainer.value;
    if (!container) {
        brickError.value = 'No se encontró el contenedor del formulario de pago.';
        return;
    }

    window.cardPaymentBrickController = await bricksBuilder.create(
        "cardPayment",
        "cardPaymentBrick_container",
        settings
    );
};
</script>

<template>
    <div class="w-full">
        <div id="cardPaymentBrick_container" ref="cardPaymentBrickContainer"></div>

        <div v-if="brickError" class="mt-4 rounded-lg border border-red-200 bg-red-50 p-4 text-center text-sm text-red-700">
            <p>{{ brickError }}</p>
            <button
                type="button"
                class="mt-3 rounded-md bg-red-600 px-4 py-2 text-white hover:bg-red-700"
                @click="reloadPage"
            >
                Recargar pago
            </button>
        </div>
    </div>
</template>
