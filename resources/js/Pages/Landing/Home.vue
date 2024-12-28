<script setup>
import { ref, onMounted, onUnmounted } from 'vue';
import '@Public/themes/personalLanding/assets/css/style.css';
import TopBanner from './Components/TopBanner.vue';
import Header from './Components/Header.vue';
import Footer from './Components/Footer.vue';
import { Head, Link } from '@inertiajs/vue3';
const xassetUrl = assetUrl;
import { initFlowbite } from 'flowbite'; // Importar desde Flowbite, previa instalación

// Inicializando Flowbite
onMounted(() => {
    initFlowbite();
}) 

defineProps({
    dataHome: {
        type: Object,
        default: () => ({})
    }
});

    // Estado para controlar la visibilidad del botón
    const isVisible = ref(false);

    // Función para controlar el scroll
    const handleScroll = () => {
        isVisible.value = window.scrollY > 300;
    };

    // Función para desplazarse al inicio de la página
    const scrollToTop = () => {
        window.scrollTo({ top: 0, behavior: 'smooth' });
    };

    // Configurar el evento de scroll al montar el componente
    onMounted(() => {
        window.addEventListener('scroll', handleScroll);
    });

    // Limpiar el evento al desmontar el componente
    onUnmounted(() => {
        window.removeEventListener('scroll', handleScroll);
    });


</script>

<template>
    <Head>
        <title>Home</title>
        <!-- Meta para Facturación Electrónica -->
        <meta name="description" content="Simplifica tu facturación electrónica con nuestra solución. Envía facturas y boletas electrónicas a SUNAT de forma rápida, segura y eficiente.">
        <meta name="keywords" content="facturación electrónica, enviar facturas SUNAT, boletas electrónicas, software SUNAT, sistema de facturación Perú, boletas Perú, SUNAT online">

        <!-- Meta para Desarrollo Web a Medida -->
        <meta name="description" content="Desarrollamos sitios web a medida y aplicaciones personalizadas según las necesidades de tu negocio. Soluciones modernas y adaptadas a tus objetivos.">
        <meta name="keywords" content="desarrollo web a medida, diseño web profesional, creación de sitios web, aplicaciones personalizadas, desarrollo de software, soluciones digitales, páginas web empresariales, desarrollo web Perú">

        <meta name="author" content="Aracode">
        <meta name="robots" content="index, follow">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
    </Head>
    <TopBanner />

    <Header />
    
    <section>
        <h1>Hola</h1>
    </section>


    

    
    
    <Footer />
    <!-- scroll Top -->
    <div id="scrollup"
        @click="scrollToTop" 
        :class="{ show: isVisible }"
        class="fixed bg-[#0188ee] text-white rounded-full flex justify-center 
        text-center items-center p-2 right-6 cursor-pointer bottom-6 h-10 w-10 z-20
        font-bold">
        <icon-arrow-left class="-rotate-90 font-bold" />
    </div>
</template>
