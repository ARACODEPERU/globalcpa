<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import EditUserForm from '@/Pages/Users/Partials/EditUserForm.vue';
    import Navigation from '@/Components/vristo/layout/Navigation.vue';
    import { Link } from '@inertiajs/vue3';

    const props = defineProps({
        establishments: {
            type: Object,
            default: () => ({}),
        },
        xuser:{
            type: Object,
            default: () => ({}),
        },
		xrole:{
            type: Object,
            default: () => ({}),
        },
        roles:{
            type: Object,
            default: () => ({}),
        },
        person:{
            type: Object,
            default: () => ({}),
        },
        identityDocumentTypes: {
            type: Object,
            default: () => ({}),
        },
        ubigeo: {
            type: Object,
            default: () => ({})
        },
    });

</script>

<template>
    <AppLayout title="Editar Usuario">
        <Navigation >
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Configuraciones</span>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <Link :href="route('users.index')" class="text-primary hover:underline">Usuarios</Link>
            </li>
            <li class="before:content-['/'] ltr:before:mr-2 rtl:before:ml-2">
                <span>Editar</span>
            </li>
        </Navigation>
       <div class="mt-5">
            <EditUserForm
                :roles = "roles"
                :establishments = "establishments"
                :xuser = "xuser"
                :xrole = "xrole"
                :person ="person"
                :identityDocumentTypes = "identityDocumentTypes"
                :ubigeo = "ubigeo"
            />
        </div>
    </AppLayout>
</template>
