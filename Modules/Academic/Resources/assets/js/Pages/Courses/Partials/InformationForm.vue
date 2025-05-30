<script setup>
import { useForm, Link } from '@inertiajs/vue3';
import FormSection from '@/Components/FormSection.vue';
import InputError from '@/Components/InputError.vue';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import Keypad from '@/Components/Keypad.vue';
import Swal2 from 'sweetalert2';
import { ref, watch, onMounted } from 'vue';
import InputLabel from '@/Components/InputLabel.vue';

import Editor from '@tinymce/tinymce-vue';

const props = defineProps({
    brochure:{
        type: Object,
        default: () => ({}),
    },
    course: {
        type: Object,
        default: () => ({}),
    },
    tiny_api_key: {
        type: String,
        default: () => ({}),
    },
    teachers: {
        type: Array,
        default: () => ({}),
    },
    faCheck: {
        type: Object,
        default: () => ({}),
    },
    course_teachers: {
        type: Object,
        default: () => ({}),
    },
    faTrashAlt: {
        type: Object,
        default: () => ({}),
    }
});

const form = useForm({
    course_id: props.course.id,
    resolution: null,
    presentation: null,
    benefits: null,
    teaching_plan: props.course_teachers,
    frequent_questions: null,
    path_file: null,
    path_file_preview: null,
    curriculum_plan: null
});

if(props.brochure){
    form.course_id= props.course.id;
    form.resolution= props.brochure?.resolution || null;
    form.presentation= props.brochure?.presentation || null;
    form.benefits = props.brochure?.benefits || null;
    form.frequent_questions = props.brochure?.frequent_questions || null;
    form.path_file_preview = props.brochure?.path_file;
    form.curriculum_plan = props.brochure?.curriculum_plan;
}


const saveInformation = () => {
    form.post(route('aca_brochure_store'), {
        forceFormData: true,
        errorBag: 'saveInformation',
        preserveScroll: true,
        onSuccess: () => {
            Swal2.fire({
                title: 'Enhorabuena',
                text: 'Se registró correctamente',
                icon: 'success',
                padding: '2em',
                customClass: 'sweet-alerts',
            });
            //form.reset()
        },
    });
}

const uploadImage = (blobInfo, progress) => {
        return new Promise((resolve, reject) => {
            const formData = new FormData();
            formData.append('file', blobInfo.blob(), blobInfo.filename());

            axios.post(route('aca_upload_image_tiny'), formData, {
                withCredentials: false,
                onUploadProgress: (e) => {
                    progress(e.loaded / e.total * 100);
                }
            }).then(response => {
                if (response.status === 403) {
                    reject({ message: 'HTTP Error: ' + response.status, remove: true });
                    return;
                }

                if (response.status < 200 || response.status >= 300) {
                    reject('HTTP Error: ' + response.status);
                    return;
                }

                const json = response.data;

                if (!json || typeof json.location !== 'string') {
                    reject('Invalid JSON: ' + JSON.stringify(json));
                    return;
                }
                resolve(json.location);
            }).catch(error => {
                reject('Image upload failed due to a XHR Transport error. Error: ' + error.message);
            });
        });
    };
    // codigo para pre visualizacvion de imagenes
    // watch(() => form.path_file, (newValue) => {
    //     if (newValue instanceof File) {
    //         const reader = new FileReader();
    //         reader.onload = (e) => {
    //             form.path_file_preview = e.target.result;
    //         };
    //         reader.readAsDataURL(newValue);
    //     } else {
    //         // Puedes manejar el caso en el que newValue no sea un objeto File válido
    //         console.error("El objeto no es un archivo válido.");
    //     }
    // });

    const teacherSelected = ref(null);

    const Toast = Swal2.mixin({
        toast: true,
        position: "top-end",
        showConfirmButton: false,
        timer: 3000,
        timerProgressBar: true,
        didOpen: (toast) => {
            toast.onmouseenter = Swal2.stopTimer;
            toast.onmouseleave = Swal2.resumeTimer;
        },
        iconColor: 'white',
        customClass: {
            popup: 'colored-toast',
        }
    });

    const addTeacher = () => {
        let index = teacherSelected.value;
        let tmpTeacher = props.teachers[index];
        const foundObject = form.teaching_plan.find(item => item.teacher.id === tmpTeacher.id);

        if (!foundObject) {
            let newTeacher = {
                course_id:props.course.id,
                created_at:null,
                id: null,
                teacher: tmpTeacher,
                teacher_id: tmpTeacher.id,
                updated_at: null,
                is_main: false
            }
            form.teaching_plan.push(newTeacher);
        }else{
            Toast.fire({
                icon: 'error',
                title: 'El docente ya fue agregado',
            });
        }
        teacherSelected.value = null;
    }

    const removeTeacher = (index) => {
        form.teaching_plan.splice(index,1);
    }

    const isMain = () => {
        form.teaching_plan = form.teaching_plan.map(obj => ({ ...obj, is_main: (props.course.teacher_id == obj.teacher_id ? true : false) }));
    }

    onMounted(() => {
        isMain();
    });

    const checkChanged = (selectedIndex) => {
        form.teaching_plan.forEach((checkbox, index) => {
            if (index !== selectedIndex) {
                checkbox.is_main = false;
            }
        });
    }

    const baseUrl = assetUrl;

    const getImage = (path) => {
        return baseUrl + 'storage/'+ path;
    }
</script>

<template>
    <FormSection @submitted="saveInformation" class="">
        <template #title>
            Información Detalles
        </template>

        <template #description>
            Editar Información, Los campos con * son obligatorios
        </template>

        <template #form>
            <div class="col-span-6 ">
                <InputLabel for="resolution" value="Resolución" />
                <Editor
                    id="resolution"
                    :api-key="tiny_api_key"
                    v-model="form.resolution"
                    :init="{
                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                        images_upload_handler: uploadImage,
                        language: 'es',
                    }"
                    :images_file_types="'jpg,svg,webp'"
                    :images_upload_url="route('aca_upload_image_tiny')"
                />
                <InputError :message="form.errors.resolution" class="mt-2" />
            </div>
            <div class="col-span-6 ">
                <InputLabel for="presentation">Presentación</InputLabel>
                <Editor
                    id="presentation"
                    :api-key="tiny_api_key"
                    v-model="form.presentation"
                    :init="{
                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                        images_upload_handler: uploadImage,
                        language: 'es',
                    }"
                    :images_file_types="'jpg,svg,webp'"
                    :images_upload_url="route('aca_upload_image_tiny')"
                />
                <InputError :message="form.errors.presentation" class="mt-2" />
            </div>
            <div class="col-span-6 ">
                <InputLabel for="benefits">Beneficios</InputLabel>
                <Editor
                    id="benefits"
                    :api-key="tiny_api_key"
                    v-model="form.benefits"
                    :init="{
                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                        images_upload_handler: uploadImage,
                        language: 'es',
                    }"
                    :images_file_types="'jpg,svg,webp'"
                    :images_upload_url="route('aca_upload_image_tiny')"
                />
                <InputError :message="form.errors.benefits" class="mt-2" />
            </div>
            <div class="col-span-6 ">
                <InputLabel for="curriculum_plan" >Plan Curricular</InputLabel>
                <Editor
                    id="curriculum_plan"
                    :api-key="tiny_api_key"
                    v-model="form.curriculum_plan"
                    :init="{
                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                        images_upload_handler: uploadImage,
                        language: 'es',
                    }"
                    :images_file_types="'jpg,svg,webp'"
                    :images_upload_url="route('aca_upload_image_tiny')"
                />
                <InputError :message="form.errors.curriculum_plan" class="mt-2" />
            </div>
            <div class="col-span-6 ">
                <InputLabel for="frequent_questions" >Preguntas Frecuentes</InputLabel>
                <Editor
                    id="frequent_questions"
                    :api-key="tiny_api_key"
                    v-model="form.frequent_questions"
                    :init="{
                        plugins: 'anchor autolink charmap codesample emoticons image link lists media searchreplace table visualblocks wordcount',
                        images_upload_handler: uploadImage,
                        language: 'es',
                    }"
                    :images_file_types="'jpg,svg,webp'"
                    :images_upload_url="route('aca_upload_image_tiny')"
                />
                <InputError :message="form.errors.frequent_questions" class="mt-2" />
            </div>

            <div class="col-span-6 ">
                <InputLabel>Docente</InputLabel>
                <div class="flex items-center">
                    <div class="relative w-full">
                        <select v-model="teacherSelected" id="teacher_id" class="form-select text-white-dark">
                            <option selected>Seleccionar</option>
                            <option v-for="(te,k) in teachers" :value="k">{{ te.person.father_lastname+" "+te.person.mother_lastname+" "+te.person.names }}</option>
                        </select>
                    </div>
                    <button @click="addTeacher" type="button" class="btn btn-primary ml-2">
                        <font-awesome-icon :icon="faCheck" class="mr-1" />
                        Agregar
                    </button>
                </div>
                <InputError :message="form.errors.teaching_plan" class="mt-2" />
                <div class="mt-4 relative overflow-x-auto shadow-md sm:rounded-lg">
                    <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-2">
                                    Principal
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    Nombre Completo
                                </th>
                                <th scope="col" class="px-6 py-2">
                                    Action
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(tea, ke) in form.teaching_plan ">
                                <td class="px-6 py-4 text-center">
                                    <input v-model="tea.is_main" @change="checkChanged(ke)" :id="'checkbox-'+ke" type="checkbox" class="w-4 h-4 text-blue-600 bg-gray-100 border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                </td>
                                <td scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <div class="flex items-center space-x-4">
                                        <div>
                                            <img v-if="tea.teacher.person.image" class="w-16 h-16 rounded" :src="getImage(tea.teacher.person.image)" alt="Medium avatar" >
                                            <img v-else :src="'https://ui-avatars.com/api/?name='+tea.teacher.person.full_name+'&size=500&rounded=true'" class="w-16 h-16 rounded" :alt="tea.teacher.person.full_name"/>
                                        </div>
                                        <div>
                                            <h4>{{ tea.teacher.person.father_lastname+" "+ tea.teacher.person.mother_lastname+" "+ tea.teacher.person.names }}</h4>

                                            <p class="text-white-dark overflow-hidden min-w-[300px] line-clamp-1">
                                                DNI: {{ tea.teacher.person.number }}
                                            </p>
                                            <p class="text-white-dark overflow-hidden min-w-[300px] line-clamp-1">
                                                Email: {{ tea.teacher.person.email }}
                                            </p>
                                            <p class="text-white-dark overflow-hidden min-w-[300px] line-clamp-1">
                                                Teléfono: {{ tea.teacher.person.telephone }}
                                            </p>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    <button @click="removeTeacher(ke)" type="button" class="btn btn-danger">
                                        <font-awesome-icon :icon="faTrashAlt" />
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-span-6 ">
                <label for="path_file" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">PDF</label>

                <!-- <div class="flex justify-center space-x-2">
                    <figure class="max-w-lg">
                        <img class="h-auto max-w-full rounded-lg" :src="form.path_file_preview">
                        <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Imagen Actual</figcaption>
                    </figure>
                </div> -->
                <!-- <input @input="form.path_file = $event.target.files[0]" accept=".svg, .png, .jpg, .jpeg, .gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="path_file" type="file"> -->

                <a :href="form.path_file_preview" v-if="form.path_file_preview" target="_blank" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Ver PDF Actual</a>

                <input @input="form.path_file = $event.target.files[0]" accept=".pdf" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="path_file" type="file">
                <InputError :message="form.errors.path_file" class="mt-2" />
            </div>
        </template>

        <template #actions>

            <Keypad>
                <template #botones>
                    <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                        <svg v-show="form.processing" aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                            <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                        </svg>
                        Guardar
                    </PrimaryButton>
                    <Link :href="route('aca_courses_list')"  class="ml-2 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Ir al Listado</Link>
                </template>
            </Keypad>
        </template>
    </FormSection>
</template>
