<script setup>
import AppLayout from "@/Layouts/Vristo/AppLayout.vue";
import EditForm from './Partials/EditForm.vue';
import { Link } from '@inertiajs/vue3';

const props = defineProps({
    course: {
        type: Object,
        default: () => ({}),
    },
    modalities: {
        type: Object,
        default: () => ({}),
    },
    categories: {
        type: Object,
        default: () => ({}),
    },
    types: {
        type: Object,
        default: () => ({}),
    },
    sectors: {
        type: Object,
        default: () => ({}),
    },
    P000018: {
        type: Boolean,
        default: false,
    }
});

</script>

<template>
    <AppLayout title="Editar Curso">
        <ul class="flex space-x-2 rtl:space-x-reverse">
            <li>
                <a href="javascript:;" class="text-primary hover:underline">Académico</a>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <Link :href="route('aca_courses_list')" class="text-primary hover:underline">Cursos</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-1 rtl:before:ml-1">
                <span>Editar</span>
            </li>
        </ul>
        <div class="pt-5">
            <EditForm
                :course="course"
                :modalities="modalities"
                :categories="categories"
                :types="types"
                :sectors="sectors"
                :P000018="P000018"
            />
        </div>
    </AppLayout>
</template>
