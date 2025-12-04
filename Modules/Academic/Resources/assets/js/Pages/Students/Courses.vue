<script setup>
    import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import { Link } from '@inertiajs/vue3';
    import { ref, onMounted, computed } from 'vue'; // 👈 Importamos 'computed'
    import { usePage } from '@inertiajs/vue3';
    import { useAppStore } from '@/stores/index';
    import Swal from "sweetalert2";
    import shortVideos from "../../Components/shortVideos.vue";
    import { TabGroup, TabList, Tab, TabPanels, TabPanel } from '@headlessui/vue';

    const page = usePage();
    const store = useAppStore();
    const publicKey = ref(null);


    const props = defineProps({
        courses: {
            type: Object,
            default: () => ({}),
        },
        certificates:{
            type: Object,
            default: () => ({}),
        },
        studentSubscribed: {
            type: Object,
            default: () => ({}),
        },
        mycourses: {
            type: Object,
            default: () => ({}),
        },
        courseTypes: {
            type: Object,
            default: () => ({}),
        },
        P000019: {
            type: Boolean,
            default: null
        }
    });

    onMounted(() => {
        publicKey.value = page.props.MERCADOPAGO_KEY;
    });

    const baseUrl = assetUrl;

    const getImage = (path) => {
        return baseUrl + 'storage/'+ path;
    }

    const formatDate = (dateString) => {
        const date = new Date(dateString.replace(' ', 'T')); // Convierte a formato válido
        return new Intl.DateTimeFormat('es-ES', {
            day: '2-digit',
            month: '2-digit',
            year: 'numeric'
        }).format(date);
    };

    const addBuyCourse = (course) => {
        let price = course.price;
        let price_old = 0;
        let discount = 0;

        if(course.price || course.price > 0){
            if(course.discount || course.discount > 0){
                if(course.discount_applies == '01'){
                    price = (course.price - (course.price * course.discount / 100)).toFixed(2);
                    price_old = course.price;
                    discount = parseFloat(course.discount) % 1 === 0 ? parseInt(course.discount) : parseFloat(course.discount).toFixed(2);
                }else if(course.discount_applies == '02'){
                    if(props.studentSubscribed && props.studentSubscribed.status == 1){
                        price = (course.price - (course.price * course.discount / 100)).toFixed(2);
                        price_old = course.price;
                        discount = parseFloat(course.discount) % 1 === 0 ? parseInt(course.discount) : parseFloat(course.discount).toFixed(2);
                    }else{
                        price = course.price;
                    }
                }
            }


            let product = {
                id: course.id,
                name: course.description,
                price: price,
                quantity: 1,
                entity: 'AcaCourse',
                image: getImage(course.image),
                price_old: price_old,
                discount: discount
            };
            store.addToCart(product);
            showAlertToast('Curso agregado al carrito', 'success', 'top');
        }else{
            showAlertToast('No puedes agregar cursos que son gratis')
        }
    }

    const showAlertToast = async (text, iconType = null, xposition = 'top-end') => {
        const toast = Swal.mixin({
            toast: true,
            position: xposition,
            showConfirmButton: false,
            timer: 3000,
            padding: '2em',
            customClass: 'sweet-alerts',
        });
        toast.fire({
            icon: iconType,
            title: text,
            padding: '2em',
            customClass: 'sweet-alerts',
        });
    }

    // 1. Renombramos a selectedCourses para mantener el estado actual de la selección
    const selectedCourses = ref(null);

    // 2. Propiedad Computada para ordenar la lista mostrada
    const orderedCoursesData = computed(() => {
        if (!selectedCourses.value || selectedCourses.value.length === 0) {
            return [];
        }

        // Función auxiliar para asignar la prioridad
        const getPriority = (course) => {
            // 1. Máxima prioridad: Cursos a los que tiene acceso
            if (course.can_view) {
                return 1;
            }

            // 2. Segunda prioridad: Cursos gratuitos (sin costo y sin acceso)
            if (course.price === null || course.price <= 0) {
                return 2;
            }

            // 3. Mínima prioridad: Cursos pagados (sin acceso)
            return 3;
        };

        // Clonamos el array para no mutar el original y luego ordenamos
        return [...selectedCourses.value].sort((a, b) => {
            const priorityA = getPriority(a);
            const priorityB = getPriority(b);

            // Orden ascendente por prioridad (1 antes que 2, 2 antes que 3)
            return priorityA - priorityB;
        });
    });


    // 3. Modificamos la función changeSelectCourses para usar selectedCourses
    const changeSelectCourses = (courses, index = 0) => {
        // Usamos el valor directamente
        if(index != 99){
            selectedCourses.value = courses;
        }else{
            selectedCourses.value = props.mycourses;
        }
    }

    // Inicialización: Al montar, mostramos todos los cursos (props.mycourses)
    onMounted(() => {
        // Usamos el valor 99 para seleccionar 'Todos' (props.mycourses)
        changeSelectCourses(props.mycourses, 99);
    });
</script>

<template>
    <AppLayout title="Mis Cursos">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Académico</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Cursos Disponibles</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="grid gap-6"
                :class="P000019 == true ? 'grid-cols-6' : ''"
            >
                <section :class="P000019 == true ? 'col-span-6 sm:col-span-4' : 'w-full'">
                    <div class="w-[40%] mb-6">
                        <select class="form-select px-4 py-3 text-base">
                            <option :value="'Todos'" @click="changeSelectCourses(props.mycourses, 99)">Todos</option>
                            <template v-for="(type, key) in courses">
                                <option :value="type.type_description" @click="changeSelectCourses(type.courses, key)">{{ type.type_description }}</option>
                            </template>
                        </select>
                    </div>
                    <div class="grid sm:grid-cols-3 lg:grid-cols-4 2xl:grid-cols-6 sm:gap-6 lg:gap-4">

                        <template v-for="(course, index) in orderedCoursesData" :key="course.id">
                            <article class="rounded-xl bg-white p-3 shadow-lg hover:shadow-xl hover:transform hover:scale-105 duration-300 dark:bg-gray-900">
                                <template v-if="course.can_view">
                                    <Link :href="route('aca_mycourses_lessons',course.id)">
                                        <div class="relative flex items-end overflow-hidden rounded-xl">
                                            <img :src="getImage(course.image)" :alt="course.description" />
                                        </div>

                                        <div class="mt-1 p-2">
                                            <p class="mt-1 text-sm text-slate-400">{{ course.modality.description }}</p>
                                            <h2 class="text-slate-700 dark:text-slate-400">{{ course.description }}</h2>
                                        </div>
                                    </Link>
                                </template>
                                <template v-else>
                                    <div class="relative flex items-end overflow-hidden justify-center rounded-xl">
                                        <img :src="getImage(course.image)" :alt="course.description" class="max-h-[105.05px]" />
                                    </div>
                                    <div class="mt-1 p-2">
                                        <p class="mt-1 text-sm text-slate-400">{{ course.modality.description }}</p>
                                        <p class="mt-1 text-sm text-slate-400">{{ course.type_description }}</p>
                                        <h2 class="text-slate-700 dark:text-slate-400">{{ course.description }}</h2>
                                    </div>

                                    <div class="space-y-4">
                                        <div v-if="course.price && course.price > 0">
                                            <div class="etiquet-price relative">
                                                <template v-if="course.discount && course.discount > 0">
                                                    <template v-if="course.discount_applies == '01'">
                                                        <p class="price-new">
                                                            S./ {{ (course.price - (course.price * course.discount / 100)).toFixed(2) }}
                                                        </p>
                                                        <p class="price-old line-through">S./ {{ course.price }}</p>
                                                        <span class="badge absolute ltr:right-2 rtl:left-0 -top-4 bg-danger p-0.5 px-1.5 rounded-full">
                                                            -{{ parseFloat(course.discount) % 1 === 0 ? parseInt(course.discount) : parseFloat(course.discount).toFixed(2) }}%
                                                        </span>
                                                    </template>
                                                    <template v-else-if="course.discount_applies == '02'">
                                                        <template v-if="studentSubscribed && studentSubscribed.status == 1">
                                                            <p class="price-new">
                                                                S./ {{ (course.price - (course.price * course.discount / 100)).toFixed(2) }}
                                                            </p>
                                                            <p class="price-old line-through">S./ {{ course.price }}</p>
                                                            <span class="badge absolute ltr:right-2 rtl:left-0 -top-4 bg-danger p-0.5 px-1.5 rounded-full">
                                                                -{{ parseFloat(course.discount) % 1 === 0 ? parseInt(course.discount) : parseFloat(course.discount).toFixed(2) }}%
                                                            </span>
                                                        </template>
                                                        <template v-else>
                                                            <p class="price-new">S./ {{ course.price }}</p>
                                                        </template>
                                                    </template>
                                                </template>
                                                <template v-else>
                                                    <p class="price-new">S./ {{ course.price }}</p>
                                                </template>
                                            </div>
                                            <button v-on:click="addBuyCourse(course)" type="button" class="btn btn-primary w-full mt-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="h-4 w-4 mr-2">
                                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 3h1.386c.51 0 .955.343 1.087.835l.383 1.437M7.5 14.25a3 3 0 00-3 3h15.75m-12.75-3h11.218c1.121-2.3 2.1-4.684 2.924-7.138a60.114 60.114 0 00-16.536-1.84M7.5 14.25L5.106 5.272M6 20.25a.75.75 0 11-1.5 0 .75.75 0 011.5 0zm12.75 0a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                                                </svg>
                                                Comprar curso
                                            </button>
                                        </div>

                                        <div v-else-if="course.price === null || course.price <= 0">
                                             <div class="etiquet-price relative bg-success-light dark:bg-success">
                                                 <p class="price-new text-success dark:text-white">Gratis</p>
                                             </div>
                                            <Link :href="route('aca_mycourses_lessons',course.id)" class="btn btn-outline-success w-full mt-2">
                                                Ver Contenido
                                            </Link>
                                        </div>
                                    </div>

                                </template>
                            </article>
                        </template>
                    </div>
                </section>
                <section v-if="P000019" class="col-span-6 sm:col-span-2 rounded-md">
                    <shortVideos />
                </section>
            </div>
        </div>

    </AppLayout>
</template>
<style>
.etiquet-price {
    background: #fdbd4a;
    width: 100%;
    padding: .2rem 1.2rem;
    border-radius: 0.3rem;
}

.etiquet-price .price-new {
    margin: 0;
    padding-top: .4rem;
    font-size: 1.5rem;
    font-weight: 400;
}
.etiquet-price .price-old {
    margin: 0;
    padding-top: .4rem;
    font-size: 0.9rem;
    font-weight: 400;
}
</style>
