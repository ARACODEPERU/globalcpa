<script setup>
    import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
    import Pagination from '@/Components/Pagination.vue';
    import Swal2 from "sweetalert2";
    import { Link, router, useForm } from '@inertiajs/vue3';
    import { faXmark, faGears, faTrashAlt, faCheck, faSpellCheck, faDownload, faPlay, faFile, faFilm } from "@fortawesome/free-solid-svg-icons";
    import ModalLarge from '@/Components/ModalLarge.vue';
    import { ref } from 'vue';
    import DangerButton from '@/Components/DangerButton.vue';
    import InputError from '@/Components/InputError.vue';
    import { ConfigProvider, Dropdown,Menu,MenuItem,Button } from 'ant-design-vue';
    import IconPlus from '@/Components/vristo/icon/icon-plus.vue';
    import IconSearch from '@/Components/vristo/icon/icon-search.vue';

    const props = defineProps({
        courses: {
            type: Object,
            default: () => ({}),
        },
        institutions: {
            type: Object,
            default: () => ({}),
        },
        filters: {
            type: Object,
            default: () => ({}),
        },
    });

    const form = useForm({
        search: props.filters.search,
    });

    const destroyCourse = (id) => {
        Swal2.fire({
            title: '¿Estas seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, Eliminar!',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            padding: '2em',
            customClass: 'sweet-alerts',
            preConfirm: () => {
                return axios.delete(route('aca_courses_destroy', id)).then((res) => {
                    if (!res.data.success) {
                        Swal2.showValidationMessage(res.data.message)
                    }
                    return res
                });
            },
            allowOutsideClick: () => !Swal2.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal2.fire({
                    title: 'Enhorabuena',
                    text: 'Se Eliminó correctamente',
                    icon: 'success',
                });
                router.visit(route('aca_courses_list'), {
                    replace: false,
                    method: 'get',
                    preserveState: true,
                    preserveScroll: true,
                });
            }
        });
    }

    const destroyAgreement = (id) => {
        Swal2.fire({
            title: '¿Estas seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, Eliminar!',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            padding: '2em',
            customClass: 'sweet-alerts',
            preConfirm: () => {
                return axios.delete(route('aca_agreements_destroy', id)).then((res) => {
                    if (!res.data.success) {
                        Swal2.showValidationMessage(res.data.message)
                    }
                    return res
                });
            },
            allowOutsideClick: () => !Swal2.isLoading()
        }).then((result) => {
            if (result.isConfirmed) {
                Swal2.fire({
                    title: 'Enhorabuena',
                    text: 'Se Eliminó correctamente',
                    icon: 'success',
                    padding: '2em',
                    customClass: 'sweet-alerts',
                });
                getAgreements(formAgreement.course_id);
            }
        });
    }

    const formAgreement = useForm({
        course_id: null,
        course_name: null,
        institution_id: null,
        start_date: null,
        end_date: null,
        status: null,
        details:[]
    });

    const displayModalAgreements = ref(false);
    const arrayAgreements = ref([]);

    const openModalAgreements = (course) => {
        formAgreement.course_id = course.id;
        formAgreement.course_name = course.description;

        getAgreements(course.id);

        displayModalAgreements.value = true;
    }

    const closeModalAgreements = () => {
        displayModalAgreements.value = false;
        formAgreement.reset();
    }

    const saveAgreements = () => {
        formAgreement.progress = true;
        axios.post(route('aca_agreements_store'), formAgreement ).then((res) => {

            formAgreement.progress = false;
            Swal2.fire({
                title: 'Enhorabuena',
                text: 'Se registró correctamente',
                icon: 'success',
                padding: '2em',
                customClass: 'sweet-alerts',
            });
            getAgreements(formAgreement.course_id);
            formAgreement.reset('institution_id', 'start_date','end_date')
            formAgreement.clearErrors();
        }).catch(function (error) {
            if (error.response.status === 422) {
                // Obtén los errores del objeto de respuesta JSON
                const errors = error.response.data.errors;

                for (let field in errors) {
                    formAgreement.setError(field, errors[field][0]);
                }

            }
            formAgreement.progress = false;
        });
    }

    const getAgreements = (id) => {
        axios.get(route('aca_agreements_list', id) ).then((res) => {
            arrayAgreements.value = res.data.agreements;
        });
    }

const dataModule = ref({});


const baseUrl = assetUrl;

const getImage = (path) => {
    return baseUrl + 'storage/'+ path;
}

const dataModalContent = ref(null);

</script>

<template>
    <AppLayout title="Cursos">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Académico</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Cursos</span>
            </li>
        </ul>
        <div class="pt-5">
            <div class="flex items-center justify-between flex-wrap gap-4">
                <h2 class="text-xl">Cursos</h2>
                <div class="flex sm:flex-row flex-col sm:items-center sm:gap-3 gap-4 w-full sm:w-auto">
                    <div class="flex gap-3">
                        <div>
                            <Link :href="route('aca_courses_create')" type="button" class="btn btn-primary">
                                <icon-plus class="ltr:mr-2 rtl:ml-2" />
                                Nuevo
                            </Link>
                        </div>
                    </div>
                    <!-- Clear Filters -->
                    <div class="mt-4 flex justify-end">
                        <button
                            @click="clearSearch"
                            class="px-4 py-2 text-gray-600 dark:text-gray-400 hover:text-gray-800 dark:hover:text-gray-200 transition-colors"
                        >
                            Limpiar filtros
                        </button>
                    </div>
                </div>

            </div>

            <!-- Visual Gallery View (Image-focused design) -->
            <div class="mt-6">
                <!-- Active Courses Gallery -->
                <div>
                    <div class="grid sm:grid-cols-2 gap-6 w-full mb-6">
                        <div class="flex items-center justify-between">
                            <div class="flex items-center gap-3">
                                <div class="w-4 h-4 bg-green-500 rounded-full"></div>
                                <h3 class="text-xl font-bold text-gray-900 dark:text-white">Cursos Activos</h3>
                                <span class="bg-green-100 dark:bg-green-900 text-green-800 dark:text-green-200 px-3 py-1 rounded-full text-sm font-medium">
                                    {{ coursesActive }}
                                </span>
                            </div>
                        </div>
                        <div class="flex items-center justify-end">
                            <div class="flex items-center gap-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400">
                                    Mostrando <span class="font-medium text-gray-900 dark:text-white">{{ courses.total }}</span> cursos
                                </p>
                                <div v-if="form.category || form.status !== '' || form.modality" class="flex items-center gap-2">
                                    <span class="text-xs bg-blue-100 text-blue-600 dark:bg-blue-900 dark:text-blue-300 px-2 py-1 rounded-full">
                                        Con filtros aplicados
                                    </span>
                                    <button
                                        @click="form.reset()"
                                        class="text-xs text-gray-500 hover:text-gray-700 dark:text-gray-400 dark:hover:text-gray-200 underline"
                                    >
                                        Limpiar
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-3 gap-6">
                        <div v-for="course in courses.data" :key="course.id"
                             class="group relative bg-white dark:bg-gray-800 rounded-2xl overflow-hidden shadow-lg hover:shadow-2xl transition-all duration-300 hover:scale-[1.02] flex flex-col h-full">
                            <!-- Course Image -->
                            <div class="relative h-48 overflow-hidden bg-gradient-to-br from-blue-50 to-purple-50 dark:from-gray-700 dark:to-gray-600">
                                <img :src="course.image ? getImage(course.image) : fallbackImage"
                                     :alt="course.description"
                                     class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500"
                                     @error="$event.target.src = fallbackImage" />

                                <!-- Overlay with Quick Actions -->
                                <div class="absolute inset-0 bg-gradient-to-t from-black/70 via-transparent to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300">
                                    <div class="absolute bottom-4 left-4 right-4 flex gap-2">
                                        <Link :href="route('aca_courses_edit', course.id)"
                                              class="flex-1 bg-white/90 backdrop-blur-sm text-gray-900 px-3 py-2 rounded-lg text-sm font-medium hover:bg-white transition-colors flex items-center justify-center gap-1">
                                            <font-awesome-icon :icon="faEdit" class="text-xs" />
                                            Editar
                                        </Link>
                                        <Link v-can="'aca_cursos_listado_estudiantes'" :href="route('aca_enrolledstudents_list', course.id)"
                                              class="flex-1 bg-blue-500/90 backdrop-blur-sm text-white px-3 py-2 rounded-lg text-sm font-medium hover:bg-blue-600 transition-colors flex items-center justify-center gap-1">
                                            <font-awesome-icon :icon="faUsers" class="text-xs" />
                                            Alumnos
                                        </Link>
                                    </div>
                                </div>

                                <!-- Status Badge -->
                                <div class="absolute top-4 right-4">
                                    <span v-if="course.status" class="bg-green-500 text-white px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                                        <span class="w-2 h-2 bg-white rounded-full"></span>
                                        Activo
                                    </span>
                                    <span v-else class="bg-red-500 text-white px-2 py-1 rounded-full text-xs font-medium flex items-center gap-1">
                                        <span class="w-2 h-2 bg-white rounded-full"></span>
                                        Inactivo
                                    </span>
                                </div>
                            </div>

                            <!-- Course Info -->
                            <div class="p-4 flex flex-col flex-grow">
                                <h4 class="font-bold text-gray-900 dark:text-white mb-2 line-clamp-2 group-hover:text-blue-600 dark:group-hover:text-blue-400 transition-colors">
                                    {{ course.description }}
                                </h4>

                                <div class="flex flex-wrap gap-1.5 mb-3">
                                    <span v-if="course.category" class="text-xs bg-blue-100 text-blue-700 dark:bg-blue-900 dark:text-blue-300 px-2 py-1 rounded-full">
                                        {{ course.category.description }}
                                    </span>
                                    <span v-if="course.modality" class="text-xs bg-purple-100 text-purple-700 dark:bg-purple-900 dark:text-purple-300 px-2 py-1 rounded-full">
                                        {{ course.modality.description }}
                                    </span>
                                </div>

                                <div class="text-xs text-gray-500 dark:text-gray-400 space-y-1 mb-4">
                                    <div class="flex items-center gap-1">
                                        <font-awesome-icon :icon="faBook" class="text-gray-400" />
                                        {{ course.sector_description || 'N/A' }}
                                    </div>
                                    <div class="flex items-center gap-1">
                                        <font-awesome-icon :icon="faFile" class="text-gray-400" />
                                        {{ course.type_description || 'N/A' }}
                                    </div>
                                </div>

                                <!-- Indicador de examen configurado -->
                                <div v-if="course.exam" class="mb-3">
                                    <Link :href="route('aca_course_exam_view_details', [course.id, course.exam.id])"
                                        class="inline-flex items-center gap-1 text-xs bg-green-100 text-green-700 dark:bg-green-900 dark:text-green-300 px-2 py-1 rounded-full hover:bg-green-200 dark:hover:bg-green-800 transition-colors cursor-pointer">
                                        <font-awesome-icon :icon="faClipboardCheck" class="w-3 h-3" />
                                        Ver preguntas del examen
                                    </Link>
                                </div>

                                <!-- Spacer to push action bar to bottom -->
                                <div class="flex-grow"></div>

                                <!-- Action Bar -->
                                <div class="mt-auto pt-3 border-t border-gray-200 dark:border-gray-700 flex items-center justify-between">
                                    <div class="flex gap-1">
                                        <button @click="openModalAgreements(course)"
                                            class="p-2 text-orange-600 hover:bg-orange-50 dark:text-orange-400 dark:hover:bg-orange-900 rounded-lg transition-colors"
                                            title="Convenios"
                                            v-tippy="{content: 'Convenios', placement: 'top'}"
                                        >
                                            <font-awesome-icon :icon="faHandshake" class="text-sm" />
                                        </button>
                                        <Link :href="route('aca_courses_information', course.id)"
                                            class="p-2 text-purple-600 hover:bg-purple-50 dark:text-purple-400 dark:hover:bg-purple-900 rounded-lg transition-colors"
                                            title="Información"
                                            v-tippy="{content: 'Información', placement: 'top'}"
                                        >
                                            <font-awesome-icon :icon="faEye" class="text-sm" />
                                        </Link>
                                        <Link :href="route('aca_courses_module_panel', course.id)"
                                            class="p-2 text-indigo-600 hover:bg-indigo-50 dark:text-indigo-400 dark:hover:bg-indigo-900 rounded-lg transition-colors"
                                            title="Módulos"
                                            v-tippy="{content: 'Módulos', placement: 'top'}"
                                        >
                                            <font-awesome-icon :icon="faLayerGroup" class="text-sm" />
                                        </Link>
                                        <!-- Botón Examen Final del Curso -->
                                        <template v-if="course.exam">
                                            <button @click="openCourseExamModal(course)"
                                                class="p-2 text-green-600 hover:bg-green-50 dark:text-green-400 dark:hover:bg-green-900 rounded-lg transition-colors"
                                                title="Editar Examen Final"
                                                v-tippy="{content: 'Editar Examen Final', placement: 'top'}"
                                            >
                                                <font-awesome-icon :icon="faClipboardCheck" class="text-sm" />
                                            </button>
                                        </template>
                                        <template v-else>
                                            <button @click="openCourseExamModal(course)"
                                                class="p-2 text-gray-500 hover:bg-gray-50 dark:text-gray-400 dark:hover:bg-gray-700 rounded-lg transition-colors"
                                                title="Crear Examen Final"
                                                v-tippy="{content: 'Crear Examen Final', placement: 'top'}"
                                            >
                                                <font-awesome-icon :icon="faClipboardCheck" class="text-sm" />
                                            </button>
                                        </template>
                                    </div>
                                    <button
                                        @click="destroyCourse(course.id)"
                                        class="p-2 text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-900 rounded-lg transition-colors"
                                        v-tippy="{content: 'Eliminar', placement: 'top'}"
                                    >
                                        <font-awesome-icon :icon="faTrashAlt" />
                                    </button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-5 panel p-0 border-0 overflow-hidden">
                <div class="table-responsive">
                    <ConfigProvider>
                        <table class="table-striped table-hover">
                            <thead>
                                <tr class="!text-center">
                                    <th>
                                        Acciones
                                    </th>
                                    <th>
                                        Nombre
                                    </th>
                                    <th>
                                        Categoría
                                    </th>
                                    <th>
                                        Sector
                                    </th>
                                    <th>
                                        Tipo
                                    </th>
                                    <th>
                                        Modalidad
                                    </th>
                                    <th>
                                        Estado
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <template v-for="(course, index) in courses.data" :key="course.id">
                                    <tr>
                                        <td class="text-center">
                                            <Dropdown :placement="'bottomLeft'">
                                                <button class="border py-1.5 px-2 dropdown-button inline-block text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm" type="button">
                                                    <font-awesome-icon :icon="faGears" />
                                                </button>
                                                <template #overlay>
                                                <Menu>
                                                    <MenuItem>
                                                        <Link :href="route('aca_courses_edit',course.id)" >Editar</Link>
                                                    </MenuItem>
                                                    <MenuItem>
                                                        <Link :href="route('aca_enrolledstudents_list',course.id)" >Alumnos</Link>
                                                    </MenuItem>
                                                    <MenuItem>
                                                        <Link :href="route('aca_courses_information',course.id)" >Información</Link>
                                                    </MenuItem>
                                                    <MenuItem>
                                                        <a @click="openModalAgreements(course)" href="#" >Convenios</a>
                                                    </MenuItem>
                                                    <MenuItem>
                                                        <Link :href="route('aca_courses_module_panel',course.id)" >Módulos</Link>
                                                    </MenuItem>
                                                    <MenuItem>
                                                        <a @click="destroyCourse(course.id)" href="#" >Eliminar</a>
                                                    </MenuItem>
                                                </Menu>
                                                </template>
                                            </Dropdown>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ course.description }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ course.category.description }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ course.sector_description }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            {{ course.type_description }}
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <template v-if="course.modality">
                                                {{ course.modality.description }}
                                            </template>
                                        </td>
                                        <td class="whitespace-nowrap">
                                            <span v-if="course.status" class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 border border-blue-400">Activo</span>
                                            <span v-else class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-red-400 border border-red-400">Inactivo</span>
                                        </td>
                                    </tr>
                                </template>
                            </tbody>
                        </table>
                        <Pagination :data="courses" />
                    </ConfigProvider>
                </div>

            </div>
        </div>

        <ModalLarge
            :onClose = "closeModalAgreements"
            :show="displayModalAgreements"
            :icon="'/img/convenio.png'"
        >
            <template #title>
                Convenio
            </template>
            <template #message>{{ formAgreement.course_name }}</template>
            <template #content>
                <div class="grid grid-cols-6 gap-6">
                    <div class="col-span-6 sm:col-span-2">
                        <label for="institution" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">institución</label>
                        <select v-model="formAgreement.institution_id" id="institution" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option v-for="(institution) in institutions" :value="institution.id">{{ institution.name }}</option>
                        </select>
                        <InputError :message="formAgreement.errors.institution_id" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="star_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Incio</label>
                        <input v-model="formAgreement.start_date" type="date" id="star_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required>
                        <InputError :message="formAgreement.errors.start_date" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Fecha Termino</label>
                        <input v-model="formAgreement.end_date" type="date" id="end_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="John" required>
                        <InputError :message="formAgreement.errors.end_date" class="mt-2" />
                    </div>
                </div>

                <div class="mt-4">
                    <div class="grid grid-cols-2 md:grid-cols-3 gap-4">
                        <div class="border p-4" v-for="(xagreement) in arrayAgreements">
                            <div class="flex justify-end">
                                <button @click="destroyAgreement(xagreement.id)" type="button" class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-full text-sm p-2.5 text-center inline-flex items-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <font-awesome-icon :icon="faTrashAlt" />
                                </button>
                            </div>
                            <img class="h-auto max-w-full rounded-lg" :src="xagreement.institution.image" :alt="xagreement.institution.name">
                        </div>
                    </div>
                </div>
            </template>
            <template #buttons>
                <progress v-if="formAgreement.progress" :value="formAgreement.progress.percentage" max="100" class="mr-2">
                    {{ formAgreement.progress.percentage }}%
                </progress>
                <DangerButton
                    :class="{ 'opacity-25': formAgreement.processing }" :disabled="formAgreement.processing"
                    class="mr-3"
                    @click="saveAgreements()"
                >
                Guardar
            </DangerButton>
            </template>
        </ModalLarge>
    </AppLayout>
</template>
