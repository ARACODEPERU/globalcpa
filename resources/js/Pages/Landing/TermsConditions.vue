<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { ref } from 'vue'; // Importa 'ref' para crear datos reactivos
import iconUser from '@/Components/vristo/icon/icon-user.vue';
import { useAppStore } from '@/stores/index';

const company = usePage().props.company;
const xassetUrl = assetUrl;
const store = useAppStore();

// Define los datos de los términos y condiciones usando `ref`
const terms = ref([
    {
        id: 1,
        title: 'Objeto',
        description: 'Los presentes Términos y Condiciones establecen las reglas de inscripción, pago, acceso y uso de los cursos ofrecidos por Global CPA, a través de nuestra plataforma educativa y pasarela de pagos autorizada.'
    },
    {
        id: 2,
        title: 'Inscripciones y pagos',
        content: [
            'La inscripción queda confirmada únicamente tras la validación del pago mediante la pasarela habilitada.',
            'Los precios de los cursos se muestran en la moneda indicada en la web e incluyen los impuestos aplicables.',
            'Los pagos pueden realizarse con tarjeta de crédito, débito u otros medios electrónicos disponibles.',
            'La emisión de comprobantes de pago se realizará conforme a la normativa tributaria vigente en el Perú.'
        ]
    },
    {
        id: 3,
        title: 'Acceso a los cursos',
        content: [
            'Una vez confirmado el pago, el usuario recibirá las credenciales de acceso en un plazo máximo de 24 horas.',
            'El acceso es personal e intransferible y no podrá compartirse con terceros.',
            'Global CPA se reserva el derecho de suspender el acceso en caso de incumplimiento de estos Términos.'
        ]
    },
    {
        id: 4,
        title: 'Derecho de desistimiento',
        content: [
            'De acuerdo con el Código de Protección y Defensa del Consumidor (Ley N.º 29571), el usuario podrá ejercer su derecho de desistimiento en un plazo de 7 días calendario posteriores a la compra, siempre que el curso no haya iniciado.',
            'En caso de desistimiento válido, Global CPA devolverá el monto pagado utilizando el mismo medio de pago.'
        ]
    },
    {
        id: 5,
        title: 'Información del servicio',
        content: [
            'Global CPA se compromete a brindar información clara y veraz sobre cada curso, incluyendo:',
            [
                'Modalidad (virtual o presencial).',
                'Duración y carga horaria.',
                'Requisitos técnicos mínimos (en caso de cursos virtuales).',
                'Certificación a otorgar.'
            ]
        ]
    },
    {
        id: 6,
        title: 'Propiedad intelectual',
        content: [
            'Todo el contenido de los cursos (videos, presentaciones, materiales, guías, etc.) es propiedad de Global CPA y está protegido por las leyes de derechos de autor.',
            'Queda prohibida la reproducción, distribución o uso no autorizado de los materiales con fines distintos al aprendizaje personal.'
        ]
    },
    {
        id: 8,
        title: 'Protección de datos personales',
        content: [
            'Los datos personales brindados por los usuarios serán tratados conforme a la Ley N.º 29733 – Ley de Protección de Datos Personales.',
            'La información será utilizada para la gestión de inscripciones, acceso a cursos, emisión de certificados y comunicaciones relacionadas al servicio contratado.',
            'Con el consentimiento expreso del usuario, Global CPA podrá utilizar los datos para enviar información sobre nuevos cursos, promociones y programas similares.',
            'El usuario podrá ejercer sus derechos de acceso, rectificación, cancelación u oposición escribiendo a capacitacion@globalcpaperu.com'
        ]
    },
    {
        id: 9,
        title: 'Libro de Reclamaciones',
        description: 'En cumplimiento de la normativa peruana, Global CPA cuenta con un Libro de Reclamaciones Virtual disponible en nuestra web para cualquier queja o reclamo sobre el servicio.'
    },
    {
        id: 10,
        title: 'Modificaciones',
        description: 'Global CPA se reserva el derecho de modificar estos Términos y Condiciones en cualquier momento. Las modificaciones entrarán en vigencia a partir de su publicación en esta página web.'
    },
    {
        id: 11,
        title: 'Contacto',
        content: [
            'Para consultas, reclamos o soporte, puede contactarnos a través de:',
            [
                'Correo: capacitacion@globalcpaperu.com',
                'Teléfono: +51 967 052 506',
                'Web: https://academy.globalcpaperu.com'
            ]
        ]
    }
]);
</script>

<template>
    <div class="relative h-screen">
        <div class="py-10 lg:py-14">
            <div class="max-w-4xl px-4 sm:px-6 lg:px-8 mx-auto text-center">
                <template v-if="store.theme === 'light'">
                    <Link :href="route('index_main')" class="inline-block mb-4 flex-none focus:outline-none focus:opacity-80" aria-label="Preline">
                        <img v-if="company.logo == '/img/logo176x32.png'" :src="company.logo" class=" h-auto mx-auto" style="width: 250px;">
                        <img v-else :src="`${xassetUrl}storage/${company.logo}` " class="h-auto mx-auto" style="width: 250px;">
                    </Link>
                </template>
                <template v-else>
                    <Link :href="route('index_main')" class="inline-block mb-4 flex-none focus:outline-none focus:opacity-80" aria-label="Preline">
                        <img v-if="company.logo == '/img/logo176x32.png'" :src="company.logo" class=" h-auto mx-auto" style="width: 250px;">
                        <img v-else :src="`${xassetUrl}storage/${company.isotipo_dark}` " class="h-auto mx-auto" style="width: 250px;">
                    </Link>
                </template>
                <h1 class="text-3xl font-bold text-gray-800 sm:text-4xl dark:text-white">
                    Términos y condiciones
                </h1>
                <p class="mt-3 text-gray-600 dark:text-neutral-400">
                    Última actualización: 20 de agosto de 2025
                </p>
            </div>
            <div class="px-4 py-4 sm:px-32 sm:py-8">
                <div class="max-w-4xl mx-auto p-8 font-sans leading-relaxed text-gray-800 dark:text-gray-200">
                    <p class="mb-6 text-justify">
                        Bienvenido a la plataforma de Global CPA Business School. Al acceder, registrarse y realizar una compra en nuestra web, usted acepta los presentes Términos y Condiciones, los cuales regulan la inscripción y participación en nuestros cursos de formación profesional.
                    </p>
                    <div v-for="item in terms" :key="item.id">
                        <h2 class="text-xl font-semibold mt-6 mb-2">{{ item.id }}. {{ item.title }}</h2>
                        <ul v-if="item.content" class="list-disc ml-6 space-y-2">
                            <li v-for="(point, index) in item.content" :key="index" class="text-justify">
                                <p v-if="typeof point === 'string'">{{ point }}</p>
                                <ul v-if="Array.isArray(point)" class="list-disc ml-6 space-y-1">
                                    <li v-for="(subpoint, subIndex) in point" :key="subIndex">
                                        {{ subpoint }}
                                    </li>
                                </ul>
                            </li>
                        </ul>
                        <p v-else class="text-justify">{{ item.description }}</p>
                    </div>
                </div>
                <div class="mt-6 sm:mt-16 items-center flex justify-center">
                    <Link :href="route('index_main')" class="py-3 px-4 inline-flex justify-center items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none">Regresar</Link>
                </div>
            </div>
        </div>
    </div>
</template>
