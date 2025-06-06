<script setup>
import { ref, onMounted } from 'vue';
import { useForm, Link, router } from '@inertiajs/vue3';
import PrimaryButton from '@/Components/PrimaryButton.vue';
import { FileInput } from 'flowbite-vue'
import { Select } from 'ant-design-vue';
import Keypad from '@/Components/Keypad.vue';
import InputLabel from '@/Components/InputLabel.vue';
import InputError from '@/Components/InputError.vue';
import Swal2 from 'sweetalert2';
import ImageCompressorjs from '@/Components/ImageCompressorjs.vue';
import { ConfigProvider, Image } from 'ant-design-vue';
import esES from 'ant-design-vue/es/locale/es_ES';
import TextInput from '@/Components/TextInput.vue';

const props = defineProps({
    student:{
        type: Object,
        default : () => ({})
    },
    courses:{
        type: Object,
        default : () => ({})
    },
    certificates:{
        type: Object,
        default : () => ({})
    },
    faTrashAlt:{
        type: Object,
        default : () => ({})
    },
    P000016: {
        type: String,
        default: null
    }
});

const dataCourses = ref([]);

onMounted(() => {
    dataCourses.value = props.courses.map((obj) => ({
        value: obj.id,
        label: obj.description
    }));
});

const form = useForm({
    image: null,
    course_id: null,
    student_id: props.student.id,
    image_pre: null,
    certificate: true
})

const saveCertificate = () => {
    form.post(route('aca_students_certificates_store'), {
        forceFormData: true,
        errorBag: 'saveCertificate',
        preserveScroll: true,
        onSuccess: () => {
            Swal2.fire({
                title: 'Enhorabuena',
                text: 'Se registró correctamente',
                icon: 'success',
                padding: '2em',
                customClass: 'sweet-alerts',
            });
            form.reset()
        },
    });
}

const filterOption = (input, option) => {
  return option.label.toLowerCase().indexOf(input.toLowerCase()) >= 0;
};

const destroyCertificate = (id) => {
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
            return axios.delete(route('aca_students_certificates_destroy', id)).then((res) => {
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
            router.visit(route('aca_students_certificates_create',props.student.id), {
                replace: false,
                method: 'get',
                preserveState: true,
                preserveScroll: true,
            });
        }
    });
};
const handleImageCompressed = (file) => {
    form.image = file;
    form.image_pre = file;
};
const baseUrl = assetUrl;

const getImage = (path) => {
    return baseUrl + 'storage/'+ path;
}
</script>
<template>
    <ConfigProvider :locale="esES">
        <div class="grid grid-cols-6 gap-6">
            <div class="col-span-6 sm:col-span-3">

                <div
                    v-for="certificate in certificates"
                    class="relative bg-white border border-gray-200 rounded-lg shadow p-4 mb-2"
                >
                    <div class="flex items-center gap-4">
                        <template v-if="P000016 == 1">
                            <div class="flex-1 font-medium dark:text-white">
                                <div>{{ certificate.course.description }}</div>
                                <a :href="certificate.image" type="button" class="mt-4 btn btn-outline-info text-xs btn-sm w-[140px]" target="_blank">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M320 0c-17.7 0-32 14.3-32 32s14.3 32 32 32l82.7 0L201.4 265.4c-12.5 12.5-12.5 32.8 0 45.3s32.8 12.5 45.3 0L448 109.3l0 82.7c0 17.7 14.3 32 32 32s32-14.3 32-32l0-160c0-17.7-14.3-32-32-32L320 0zM80 32C35.8 32 0 67.8 0 112L0 432c0 44.2 35.8 80 80 80l320 0c44.2 0 80-35.8 80-80l0-112c0-17.7-14.3-32-32-32s-32 14.3-32 32l0 112c0 8.8-7.2 16-16 16L80 448c-8.8 0-16-7.2-16-16l0-320c0-8.8 7.2-16 16-16l112 0c17.7 0 32-14.3 32-32s-14.3-32-32-32L80 32z"/>
                                    </svg>
                                    Link del archivo
                                </a>
                            </div>
                        </template>
                        <template v-if="P000016 == 2">
                            <Image :src="getImage(certificate.image)" :width="100" class="rounded-md object-cover" />
                            <div class="flex-1 font-medium dark:text-white">
                                <div>{{ certificate.course.description }}</div>
                            </div>
                        </template>
                        <button
                            @click="destroyCertificate(certificate.id)"
                            type="button"
                            class="absolute top-2 right-2 px-3 py-2 text-xs font-medium text-center text-white bg-red-700 rounded-lg hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800"
                        >
                            <font-awesome-icon :icon="faTrashAlt" />
                        </button>
                    </div>
                </div>

            </div>
            <div class="col-span-6 sm:col-span-3">
                <div class="p-2 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <form @submit.prevent="saveCertificate">
                        <div class="space-y-6 mb-4">
                            <div class="mb-2">
                                <InputLabel for="course_date" value="Curso *" />
                                <Select
                                    show-search
                                    v-model:value="form.course_id"
                                    class="w-full mb-2"
                                    placeholder="Seleccionar"
                                    :options="dataCourses"
                                    :filter-option="filterOption"
                                />
                                <InputError :message="form.errors.course_id" class="mt-1" />
                                <InputError :message="form.errors.student_id" class="mt-1" />
                            </div>
                            <div v-if="P000016 == 1">
                                <InputLabel for="linkImage" value="Link de archivo *" />
                                <!-- <FileInput
                                    id="image"
                                    v-model="form.image"
                                    label="Subir archivo"
                                    dropzone
                                /> -->
                                <TextInput
                                    v-model="form.image"
                                    id="linkImage"
                                />
                                <InputError :message="form.errors.image" class="mt-1" />
                            </div>
                            <template v-if="P000016 == 2">
                                <div class="col-span-6">
                                    <label class="inline-flex">
                                        <input v-model="form.certificate" type="checkbox" class="form-checkbox rounded-full peer" />
                                        <span class="peer-checked:text-primary">Certificado generado automáticamente</span>
                                    </label>
                                </div>
                                <div v-if="!form.certificate" class="col-span-6">
                                    <InputLabel for="image" value="Imagen *" />
                                    <div v-if="form.image_pre" class="flex justify-center space-x-2">
                                        <figure class="max-w-lg">
                                            <img class="h-auto max-w-full rounded-lg" :src="form.image_pre">
                                            <figcaption class="mt-2 text-sm text-center text-gray-500 dark:text-gray-400">Imagen Actual</figcaption>
                                        </figure>
                                    </div>
                                    <!-- <input @input="form.image = $event.target.files[0]" accept=".svg, .png, .jpg, .jpeg, .gif" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" aria-describedby="file_input_help" id="file_input" type="file"> -->
                                    <ImageCompressorjs :onImageCompressed="handleImageCompressed" />
                                    <InputError :message="form.errors.image" class="mt-2" />
                                </div>
                            </template>
                        </div>

                        <Keypad>
                            <template #botones>
                                <PrimaryButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                    <svg v-show="form.processing" aria-hidden="true" role="status" class="inline w-4 h-4 mr-3 text-gray-200 animate-spin dark:text-gray-600" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                                        <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="#1C64F2"/>
                                    </svg>
                                    Guardar
                                </PrimaryButton>
                                <Link :href="route('aca_students_list')"  class="ml-2 inline-block px-6 py-2.5 bg-green-500 text-white font-medium text-xs leading-tight uppercase rounded shadow-md hover:bg-green-600 hover:shadow-lg focus:bg-green-600 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-green-700 active:shadow-lg transition duration-150 ease-in-out">Ir al Listado</Link>
                            </template>
                        </Keypad>

                    </form>
                </div>
            </div>

        </div>
    </ConfigProvider>
</template>
