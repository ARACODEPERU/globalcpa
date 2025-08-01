<script setup>
    import { useForm } from '@inertiajs/vue3';
    import ModalLargeX from '@/Components/ModalLargeX.vue';
    import { ref, watch } from 'vue';
    import InputError from '@/Components/InputError.vue';
    import InputLabel from '@/Components/InputLabel.vue';
    import PrimaryButton from '@/Components/PrimaryButton.vue';
    import GreenButton from '@/Components/GreenButton.vue';
    import RedButton from '@/Components/RedButton.vue';
    import TextInput from '@/Components/TextInput.vue';
    import { faShareFromSquare } from "@fortawesome/free-solid-svg-icons";
    import Swal2 from 'sweetalert2';
    import Multiselect from "@suadelabs/vue3-multiselect";
    import "@suadelabs/vue3-multiselect/dist/vue3-multiselect.css";
    import iconDatabaseSearch from '@/Components/vristo/icon/icon-database-search.vue';
    import iconCompany from '@/Components/vristo/icon/icon-company.vue';
    import iconLoader from '@/Components/vristo/icon/icon-loader.vue';

    const props = defineProps({
        clientDefault: {
            type: Object,
            default: () => ({})
        },
        documentTypes: {
            type: Object,
            default: () => ({})
        },
        display:{
            type: Boolean,
            default: () => ({})
        },
        closeModalClient: {
            type: Function,
            default: () => ({})
        },
        saleDocumentTypes: {
            type: null,
            default: () => ({})
        },
        ubigeo: {
            type: Object,
            default: () => ({})
        },
    })

    const form = useForm({
        id: '',
        document_type: '',
        number: '',
        telephone: '',
        full_name: '',
        email: '',
        address: '',
        ubigeo: '',
        ubigeo_description: '',
        presentations: false,
        is_client: true
    });

    const disabledBtnSelect = ref(true);
    const person = ref({});

    const modalNewSearchClient = () => {
        axios.post(route('search_person_number'), form).then((res) => {
            if (res.data.status) {
                form.id = res.data.person.id;
                form.number = res.data.person.number;
                form.telephone = res.data.person.telephone;
                form.full_name = res.data.person.full_name;
                form.email = res.data.person.email;
                form.address = res.data.person.address;
                form.ubigeo_description = res.data.person.city
                form.ubigeo = res.data.ubigeo
                disabledBtnSelect.value = false;
                person.value = res.data.person;
            } else {
                form.errors.document_type = res.data.document_type;
                form.errors.number = res.data.number;
                Swal2.fire({
                    title: 'Información Importante',
                    text: res.data.alert,
                    icon: 'info',
                    padding: '2em',
                    customClass: 'sweet-alerts',
                });
                disabledBtnSelect.value = true;
            }

        });
    }

    const emit = defineEmits(['clientId']);

    const saveNewSearchClient = () => {
        axios.post(route('save_person_update_create'), form).then((res) => {
            disabledBtnSelect.value = false;
            Swal2.fire({
                title: 'Enhorabuena',
                text: 'Se registró correctamente',
                icon: 'success',
                padding: '2em',
                customClass: 'sweet-alerts',
            });
            person.value = res.data;
        }).catch(error => {
            let validationErrors = error.response.data.errors;
            if (validationErrors && validationErrors.number) {
                const numberErrors = validationErrors.number;

                for (let i = 0; i < numberErrors.length; i++) {
                    form.setError('number', numberErrors[i]);
                }
            }
            if (validationErrors && validationErrors.telephone) {
                const telephoneErrors = validationErrors.telephone;

                for (let i = 0; i < telephoneErrors.length; i++) {
                    form.setError('telephone', telephoneErrors[i]);
                }
            }
            if (validationErrors && validationErrors.full_name) {
                const fullNameErrors = validationErrors.full_name;

                for (let i = 0; i < fullNameErrors.length; i++) {
                    form.setError('full_name', fullNameErrors[i]);
                }
            }
            if (validationErrors && validationErrors.email) {
                const emailErrors = validationErrors.email;

                for (let i = 0; i < emailErrors.length; i++) {
                    form.setError('email', emailErrors[i]);
                }
            }
            if (validationErrors && validationErrors.address) {
                const addressErrors = validationErrors.address;

                for (let i = 0; i < addressErrors.length; i++) {
                    form.setError('address', addressErrors[i]);
                }
            }
            if (validationErrors && validationErrors.ubigeo) {
                const ubigeoErrors = validationErrors.ubigeo;

                for (let i = 0; i < ubigeoErrors.length; i++) {
                    form.setError('ubigeo', ubigeoErrors[i]);
                }
            }
            if (validationErrors && validationErrors.ubigeo_description) {
                const ubigeoDescriptionErrors = validationErrors.ubigeo_description;

                for (let i = 0; i < ubigeoDescriptionErrors.length; i++) {
                    form.setError('ubigeo_description', ubigeoDescriptionErrors[i]);
                }
            }
            form.processing = false;
        });
    }
    watch(() => props.saleDocumentTypes, (id) => {
        if(id == 1){
            form.document_type = 6
        }else{
            form.document_type = 1
        }
        disabledBtnSelect.value = true;
    });
    const selectPersonNew = () => {
        form.reset();
        emit('clientId', person.value);
    }
    const displayResultUbigeo = ref(false);


    const searchUbigeos = ref([]); // Inicializa searchUbigeos como una matriz vacía en lugar de null

    const filterCities = () => {
        if (form.ubigeo_description.trim() === '') {
            searchUbigeos.value = [];
            return;
        }

        searchUbigeos.value = props.ubigeo.filter(row =>
            row.district_name.toLowerCase().includes(form.ubigeo_description.toLowerCase())
        );
    }
    const selectCity = (item) => {
        form.ubigeo_description = item.department_name+'-'+item.province_name+'-'+item.district_name;
        form.ubigeo = item.district_id;
        searchUbigeos.value = []; // Limpiar la lista de búsqueda después de seleccionar una ciudad
    }

    const apiesLoading = ref(false);

    const searchApispe = () => {
        apiesLoading.value = true;
        axios.post(route('sales_search_person_apies'), form).then((res) => {

            if(res.data.success){
                form.full_name =  res.data.person['razonSocial'];
                form.email = null;
                form.address = null;
                //form.search = res.data.person['razonSocial'];
            }else{
                console.log(res.data)
                Swal2.fire({
                    icon: 'error',
                    text: res.data.error,
                    padding: '2em',
                    customClass: 'sweet-alerts',
                })
            }

        }).finally(()=> {
            apiesLoading.value = false;
        });
    }
</script>

<template>
    <div>
        <ModalLargeX :show="display" :onClose="closeModalClient" :icon="'/img/comunidad.png'">
            <template #title>
                Cliente
            </template>
            <template #message>
                Registrar nuevo o editar buscando por su numero de documento
            </template>
            <template #content>
                <div class="grid grid-cols-4 gap-4">
                    <div class="col-span-6 sm:col-span-1">
                        <InputLabel value="Tipo de Documento" />
                        <select :disabled="saleDocumentTypes==1 ? true : false"
                            class="form-select text-white-dark"
                            v-model="form.document_type">
                            <option value="">Seleccionar</option>
                            <template v-for="(documentType, index) in documentTypes">
                                <option :value="documentType.id">{{ documentType.description }}</option>
                            </template>
                        </select>
                        <InputError :message="form.errors.document_type" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-1">
                        <InputLabel for="number" value="Número de Doc." />
                        <TextInput id="number" v-model="form.number" type="number"
                            autofocus />
                        <InputError :message="form.errors.number" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <InputLabel v-if="form.document_type == 6" for="full_name" value="Razón Social" />
                        <InputLabel v-else for="full_name" value="Nombres" />
                        <TextInput id="full_name" v-model="form.full_name" type="text" />
                        <InputError :message="form.errors.full_name" class="mt-2" />
                    </div>
                    <div class="col-span-6 sm:col-span-1">
                        <InputLabel for="telephone" value="Teléfono" />
                        <TextInput id="telephone" v-model="form.telephone" type="text" />
                        <InputError :message="form.errors.telephone" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-1">
                        <InputLabel for="email" value="Email" />
                        <TextInput id="email" v-model="form.email" type="email" />
                        <InputError :message="form.errors.email" class="mt-2" />
                    </div>

                    <div class="col-span-6 sm:col-span-2">
                        <InputLabel for="city" value="Ciudad" />
                        <multiselect
                            id="city"
                            v-model="form.ubigeo"
                            :options="ubigeo"
                            class="custom-multiselect"
                            :searchable="true"
                            placeholder="Buscar ciudad"
                            selected-label="seleccionado"
                            select-label="Elegir"
                            deselect-label="Quitar"
                            label="city_name"
                            track-by="district_id"
                        ></multiselect>
                        <div>
                            <InputError :message="form.errors.ubigeo" class="mt-2" />
                        </div>
                    </div>
                    <div class="col-span-6 sm:col-span-2">
                        <InputLabel for="address" value="Dirección" />
                        <TextInput id="address" v-model="form.address" type="text" />
                        <InputError :message="form.errors.address" class="mt-2" />
                    </div>
                </div>
            </template>
            <template #buttons>
                <button @click="searchApispe" v-if="form.document_type != 0" type="button" class="btn btn-primary text-xs uppercase">
                    <icon-loader v-if="apiesLoading" class="animate-spin mr-1" />
                    <icon-company v-else class="w-4 h-4 mr-1" />
                    <span v-if="form.document_type == 6">SUNAT</span>
                    <span v-else-if="form.document_type == 1">RENIEC</span>
                </button>
                <RedButton @click="modalNewSearchClient()" >Buscar</RedButton>
                <PrimaryButton @click="saveNewSearchClient()" >
                    Guardar
                </PrimaryButton>
                <GreenButton
                    :disabled="disabledBtnSelect"
                    @click="selectPersonNew"
                >
                    <font-awesome-icon :icon="faShareFromSquare" />
                    Seleccionar
                </GreenButton>
            </template>
        </ModalLargeX>
    </div>
</template>
