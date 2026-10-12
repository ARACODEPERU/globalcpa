<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
    import { computed, ref } from 'vue';
    import VueCollapsible from 'vue-height-collapsible/vue3';
    import iconPencil from '@/Components/vristo/icon/icon-pencil.vue';
    import iconTrashLines from '@/Components/vristo/icon/icon-trash-lines.vue';
    import iconSearch from '@/Components/vristo/icon/icon-search.vue';
    import { useForm, Link, router } from '@inertiajs/vue3';
    import Swal2 from 'sweetalert2';

    const props = defineProps({
        ibanks: {
            type: [Array, Object],
            default: () => ([])
        }
    });

    const searchText = ref('');
    const openedItems = ref([]);

    const formIbank = useForm({
        question_text: null,
        response_text: null,
        status: true,
    });

    // Las preguntas y respuestas se guardan como HTML (editor), por eso las
    // limpiamos antes de usarlas para buscar o contar caracteres.
    const plainText = (value) => {
        if (value === null || value === undefined) {
            return '';
        }

        return String(value)
            .replace(/<[^>]*>/g, ' ')
            .replace(/&nbsp;/g, ' ')
            .replace(/&amp;/g, '&')
            .replace(/\s+/g, ' ')
            .trim();
    };

    const items = computed(() => Object.values(props.ibanks ?? {}).filter(Boolean));

    const filteredItems = computed(() => {
        const term = searchText.value.trim().toLowerCase();

        if (!term) {
            return items.value;
        }

        return items.value.filter((item) => {
            const haystack = `${plainText(item.question_text)} ${plainText(item.response_text)}`;

            return haystack.toLowerCase().includes(term);
        });
    });

    const isOpen = (id) => openedItems.value.includes(id);

    const toggleItem = (id) => {
        if (isOpen(id)) {
            openedItems.value = openedItems.value.filter((itemId) => itemId !== id);

            return;
        }

        openedItems.value = [...openedItems.value, id];
    };

    const allOpened = computed(
        () => filteredItems.value.length > 0 && filteredItems.value.every((item) => isOpen(item.id))
    );

    const toggleAll = () => {
        openedItems.value = allOpened.value ? [] : filteredItems.value.map((item) => item.id);
    };

    const updateIbank = (item) => {
        formIbank.question_text = item.question_text;
        formIbank.response_text = item.response_text;
        formIbank.status = !item.status;

        formIbank.put(route('crm_common_questions_update', item.id), {
            preserveScroll: true,
            onSuccess: () => formIbank.reset(),
        });
    }

    const destroyIbank = (id) => {
        Swal2.fire({
            title: '¿Estas seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: '¡Sí, Eliminar!',
            cancelButtonText: 'Cancelar',
            showLoaderOnConfirm: true,
            padding: '2em',
            customClass: 'sweet-alerts',
            preConfirm: () => {
                return axios.delete(route('crm_common_questions_destroy', id)).then((res) => {
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
                openedItems.value = openedItems.value.filter((itemId) => itemId !== id);
                router.visit(route('crm_common_questions'), {
                    method: 'GET',
                    replace: false,
                    preserveState: true,
                    preserveScroll: true,
                    onFinish: visit => {},
                });
            }
        });
    }
</script>
<template>
    <AppLayout title="Banco de Consultas">
        <Navigation :routeModule="route('crm_dashboard')" :titleModule="'CRM'">
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Banco de Consultas</span>
            </li>
        </Navigation>
        <div class="mt-5">
            <div class="mx-auto grid w-full grid-cols-6 gap-6 lg:gap-8">
                <!-- Encabezado / Buscador -->
                <div class="col-span-6 md:col-span-2">
                    <div class="space-y-4 md:sticky md:top-24">
                        <div class="panel">
                            <div class="flex items-start gap-3">
                                <div class="hidden h-11 w-11 shrink-0 place-content-center rounded-xl bg-primary/10 text-primary sm:grid dark:bg-primary/20">
                                    <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M4 19.5A2.5 2.5 0 0 1 6.5 17H20" />
                                        <path d="M6.5 2H20v20H6.5A2.5 2.5 0 0 1 4 19.5v-15A2.5 2.5 0 0 1 6.5 2z" />
                                        <path d="M10 7h6M10 11h4" />
                                    </svg>
                                </div>
                                <div class="min-w-0">
                                    <h1 class="text-xl font-bold leading-tight text-gray-800 md:text-2xl dark:text-white-light">Banco de Consultas</h1>
                                    <p class="mt-1.5 text-sm leading-relaxed text-gray-500 dark:text-gray-400">
                                        Respuestas a las preguntas más frecuentes. Haz clic en una pregunta para ver su respuesta.
                                    </p>
                                </div>
                            </div>

                            <!-- Buscador -->
                            <div class="relative mt-5 group">
                                <input
                                    v-model="searchText"
                                    type="text"
                                    class="form-input pr-10 peer font-normal"
                                    placeholder="Buscar una consulta..."
                                    aria-label="Buscar una consulta"
                                />
                                <div class="pointer-events-none absolute top-1/2 -translate-y-1/2 text-gray-400 ltr:right-3.5 rtl:left-3.5 peer-focus:text-primary">
                                    <icon-search class="h-4 w-4" />
                                </div>
                            </div>

                            <div class="mt-4 flex flex-wrap items-center justify-between gap-3">
                                <span class="inline-flex items-center gap-1.5 rounded-full bg-primary/10 px-3 py-1 text-xs font-semibold text-primary dark:bg-primary/20">
                                    <svg class="h-3.5 w-3.5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
                                        <path fill="currentColor" d="M80 160c0-35.3 28.7-64 64-64h32c35.3 0 64 28.7 64 64v3.6c0 21.8-11.1 42.1-29.4 53.8l-42.2 27.1c-25.2 16.2-40.4 44.1-40.4 74v1.4c0 17.7 14.3 32 32 32s32-14.3 32-32v-1.4c0-8.2 4.2-15.8 11-20.2l42.2-27.1c36.6-23.6 58.8-64.1 58.8-107.7V160c0-70.7-57.3-128-128-128h-32C73.3 32 16 89.3 16 160c0 17.7 14.3 32 32 32s32-14.3 32-32zm80 320a40 40 0 1 0 0-80 40 40 0 1 0 0 80z"/>
                                    </svg>
                                    {{ filteredItems.length }}
                                    {{ filteredItems.length === 1 ? 'consulta' : 'consultas' }}
                                </span>

                                <button
                                    v-if="filteredItems.length"
                                    type="button"
                                    class="text-xs font-semibold text-gray-500 underline decoration-dotted transition-colors hover:text-primary dark:text-gray-400"
                                    @click="toggleAll"
                                >
                                    {{ allOpened ? 'Contraer todo' : 'Expandir todo' }}
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End Col -->

                <div class="col-span-6 md:col-span-4">
                    <!-- Acordeón -->
                    <div v-if="filteredItems.length" class="space-y-3">
                        <div
                            v-for="(ibank, index) in filteredItems"
                            :key="ibank.id"
                            class="group overflow-hidden rounded-xl bg-white shadow-sm ring-1 transition-all duration-200 dark:bg-[#0e1726]"
                            :class="isOpen(ibank.id)
                                ? 'ring-primary/40 shadow-md'
                                : 'ring-gray-200 hover:shadow-md hover:ring-primary/30 dark:ring-[#1b2e4b]'"
                        >
                            <button
                                type="button"
                                class="flex w-full items-start gap-3 px-4 py-4 text-left sm:px-5 sm:py-5"
                                :aria-expanded="isOpen(ibank.id) ? 'true' : 'false'"
                                @click="toggleItem(ibank.id)"
                            >
                                <span
                                    class="mt-0.5 grid h-7 w-7 shrink-0 place-content-center rounded-lg text-xs font-bold transition-colors"
                                    :class="isOpen(ibank.id)
                                        ? 'bg-primary text-white'
                                        : 'bg-primary/10 text-primary group-hover:bg-primary group-hover:text-white dark:bg-primary/20'"
                                >
                                    {{ index + 1 }}
                                </span>

                                <div class="min-w-0 flex-1">
                                    <h2
                                        class="question-content text-base font-bold leading-snug text-gray-800 sm:text-lg dark:text-white-light"
                                        v-html="ibank.question_text"
                                    ></h2>

                                    <span
                                        v-if="!ibank.status"
                                        v-can="'crm_dudas_comunes_edicion'"
                                        class="badge badge-outline-warning mt-1.5 inline-block"
                                    >
                                        Oculta para los alumnos
                                    </span>
                                </div>

                                <svg
                                    class="mt-1 h-5 w-5 shrink-0 text-gray-400 transition-transform duration-300 group-hover:text-primary"
                                    :class="{ 'rotate-180 text-primary': isOpen(ibank.id) }"
                                    xmlns="http://www.w3.org/2000/svg"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                >
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </button>

                            <vue-collapsible :isOpen="isOpen(ibank.id)">
                                <div class="border-t border-gray-100 bg-gray-50/70 px-4 py-4 sm:px-5 dark:border-[#1b2e4b] dark:bg-white/[0.02]">
                                    <div class="mb-3 flex flex-wrap items-center justify-between gap-2">
                                        <span class="inline-flex items-center gap-1.5 text-xs font-semibold uppercase tracking-wide text-primary">
                                            <svg class="h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round">
                                                <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z" />
                                            </svg>
                                            Respuesta
                                        </span>

                                        <div v-can="'crm_dudas_comunes_edicion'" class="flex items-center gap-2">
                                            <button
                                                @click="updateIbank(ibank)"
                                                type="button"
                                                class="btn btn-sm"
                                                :class="ibank.status ? 'btn-outline-primary' : 'btn-outline-warning'"
                                                v-tippy="{ content: ibank.status ? 'Visible para los alumnos' : 'Los alumnos no pueden verlo', placement: 'bottom'}"
                                            >
                                                <svg v-if="ibank.status" class="mr-1.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512">
                                                    <path fill="currentColor" d="M288 32c-80.8 0-145.5 36.8-192.6 80.6C48.6 156 17.3 208 2.5 243.7c-3.3 7.9-3.3 16.7 0 24.6C17.3 304 48.6 356 95.4 399.4C142.5 443.2 207.2 480 288 480s145.5-36.8 192.6-80.6c46.8-43.5 78.1-95.4 93-131.1c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C433.5 68.8 368.8 32 288 32zM144 256a144 144 0 1 1 288 0 144 144 0 1 1 -288 0zm144-64c0 35.3-28.7 64-64 64c-7.1 0-13.9-1.2-20.3-3.3c-5.5-1.8-11.9 1.6-11.7 7.4c.3 6.9 1.3 13.8 3.2 20.7c13.7 51.2 66.4 81.6 117.6 67.9s81.6-66.4 67.9-117.6c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3z"/>
                                                </svg>
                                                <svg v-else class="mr-1.5 h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 512">
                                                    <path fill="currentColor" d="M38.8 5.1C28.4-3.1 13.3-1.2 5.1 9.2S-1.2 34.7 9.2 42.9l592 464c10.4 8.2 25.5 6.3 33.7-4.1s6.3-25.5-4.1-33.7L525.6 386.7c39.6-40.6 66.4-86.1 79.9-118.4c3.3-7.9 3.3-16.7 0-24.6c-14.9-35.7-46.2-87.7-93-131.1C465.5 68.8 400.8 32 320 32c-68.2 0-125 26.3-169.3 60.8L38.8 5.1zM223.1 149.5C248.6 126.2 282.7 112 320 112c79.5 0 144 64.5 144 144c0 24.9-6.3 48.3-17.4 68.7L408 294.5c8.4-19.3 10.6-41.4 4.8-63.3c-11.1-41.5-47.8-69.4-88.6-71.1c-5.8-.2-9.2 6.1-7.4 11.7c2.1 6.4 3.3 13.2 3.3 20.3c0 10.2-2.4 19.8-6.6 28.3l-90.3-70.8zM373 389.9c-16.4 6.5-34.3 10.1-53 10.1c-79.5 0-144-64.5-144-144c0-6.9 .5-13.6 1.4-20.2L83.1 161.5C60.3 191.2 44 220.8 34.5 243.7c-3.3 7.9-3.3 16.7 0 24.6c14.9 35.7 46.2 87.7 93 131.1C174.5 443.2 239.2 480 320 480c47.8 0 89.9-12.9 126.2-32.5L373 389.9z"/>
                                                </svg>
                                                {{ ibank.status ? 'Visible' : 'Oculta' }}
                                            </button>

                                            <Link
                                                :href="route('crm_common_questions_edit', ibank.id)"
                                                class="btn btn-sm btn-outline-success"
                                                v-tippy="{ content: 'Editar', placement: 'bottom'}"
                                            >
                                                <icon-pencil class="mr-1.5 h-4 w-4" />
                                                Editar
                                            </Link>

                                            <button
                                                @click="destroyIbank(ibank.id)"
                                                type="button"
                                                class="btn btn-sm btn-outline-danger"
                                                v-tippy="{ content: 'Eliminar', placement: 'bottom'}"
                                            >
                                                <icon-trash-lines class="h-4 w-4" />
                                            </button>
                                        </div>
                                    </div>

                                    <div class="answer-content prose prose-sm max-w-none dark:prose-invert" v-html="ibank.response_text"></div>
                                </div>
                            </vue-collapsible>
                        </div>
                    </div>
                    <!-- End Acordeón -->

                    <!-- Sin resultados -->
                    <div v-else class="panel grid place-content-center gap-2 py-14 text-center">
                        <div class="mx-auto grid h-12 w-12 place-content-center rounded-full bg-primary/10 text-primary dark:bg-primary/20">
                            <icon-search class="h-5 w-5" />
                        </div>
                        <p class="text-base font-semibold text-gray-700 dark:text-white-light">
                            {{ searchText.trim() ? 'No se encontraron consultas' : 'Aún no hay consultas registradas' }}
                        </p>
                        <p class="text-sm text-gray-500 dark:text-gray-400">
                            {{ searchText.trim() ? 'Prueba con otras palabras clave o limpia la búsqueda.' : 'Las consultas frecuentes aparecerán aquí.' }}
                        </p>
                        <button
                            v-if="searchText.trim()"
                            type="button"
                            class="btn btn-sm btn-outline-primary mx-auto mt-1"
                            @click="searchText = ''"
                        >
                            Limpiar búsqueda
                        </button>
                    </div>
                </div>
                <!-- End Col -->
            </div>
        </div>
    </AppLayout>
</template>

<style scoped>
    /* Normaliza el HTML que viene del editor dentro del título de la pregunta */
    .question-content :deep(p) {
        margin: 0;
    }
    .question-content :deep(p + p) {
        margin-top: 2px;
    }
    .question-content :deep(h1),
    .question-content :deep(h2),
    .question-content :deep(h3),
    .question-content :deep(h4),
    .question-content :deep(h5),
    .question-content :deep(h6) {
        margin: 0;
        font-size: inherit;
        font-weight: inherit;
        line-height: inherit;
    }
    .question-content :deep(img) {
        display: inline-block;
        max-height: 1.5rem;
        vertical-align: middle;
    }

    /* Ajustes de lectura para la respuesta */
    .answer-content :deep(h1),
    .answer-content :deep(h2),
    .answer-content :deep(h3),
    .answer-content :deep(h4) {
        font-size: 1.05rem;
        font-weight: 700;
        margin-bottom: 0.5rem;
        margin-top: 1rem;
    }
    .answer-content :deep(p) {
        font-size: 15px;
        line-height: 1.75;
    }
    .answer-content :deep(p:last-child) {
        margin-bottom: 0;
    }
    .answer-content :deep(img) {
        border-radius: 0.5rem;
    }
</style>
