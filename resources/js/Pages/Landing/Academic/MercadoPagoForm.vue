<script setup>
import { onMounted, ref } from "vue";
import { usePage } from '@inertiajs/vue3';

const page = usePage();

const publicKey = page.props.MERCADOPAGO_KEY;

const props = defineProps({
    preference: {
        type: String,
        default: null,
    },
});

const paymentBrickContainer = ref(null);

onMounted(() => {
    const script = document.createElement('script');
    script.src = 'https://sdk.mercadopago.com/js/v2';
    script.async = true;
    script.onload = () => {
        const mp = new MercadoPago(publicKey, { locale: 'es' });
        // Inicializa los bricks aquí
    };
    document.body.appendChild(script);
});

onMounted(() => {
    const mp = new MercadoPago(publicKey, { locale: "es" });
    const bricksBuilder = mp.bricks();

    const renderPaymentBrick = async () => {
        const settings = {
        initialization: {
            amount: 10000,
            preferenceId: props.preference,
            payer: {
            firstName: "",
            lastName: "",
            email: "",
            },
        },
        customization: {
            visual: {
            style: {
                theme: "default",
            },
            },
            paymentMethods: {
            creditCard: "all",
            debitCard: "all",
            ticket: "all",
            bankTransfer: "all",
            atm: "all",
            onboarding_credits: "all",
            wallet_purchase: "all",
            maxInstallments: 1,
            },
        },
        callbacks: {
            onReady: () => {
            // Callback llamado cuando el Brick está listo
            console.log("Payment Brick está listo");
            },
            onSubmit: ({ selectedPaymentMethod, formData }) => {
            // Callback llamado al hacer clic en el botón de envío
            return new Promise((resolve, reject) => {
                fetch("/process_payment", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                },
                body: JSON.stringify(formData),
                })
                .then((response) => response.json())
                .then((response) => {
                    console.log("Pago procesado con éxito", response);
                    resolve();
                })
                .catch((error) => {
                    console.error("Error al procesar el pago", error);
                    reject();
                });
            });
            },
            onError: (error) => {
            console.error("Error en Payment Brick", error);
            },
        },
        };

        window.paymentBrickController = await bricksBuilder.create(
        "payment",
        paymentBrickContainer.value,
        settings
        );
    };

    renderPaymentBrick();
});
</script>

<template>
  <div>
    <div ref="paymentBrickContainer" id="paymentBrick_container"></div>
  </div>
</template>

