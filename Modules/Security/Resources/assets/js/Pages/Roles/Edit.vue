<script setup>
    import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
    import EditForm from './Pertials/editForm.vue';
    import VueCollapsible from 'vue-height-collapsible/vue3';


    const props = defineProps({
        role: {
            type: Object,
            default: () => ({}),
        },
        permissions: {
            type: Object,
            default: () => ({}),
        },
        sorted: {
            type: Object,
            default: () => ({}),
        },
        roleHasPermissions: {
            type: Object,
            default: () => ({}),
        }
    });
</script>

<template>
    <AppLayout title="Editar Rol">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Editar Rol
            </h2>
        </template>

        <div>
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <EditForm
                    :role="role"
                    :permissions="permissions"
                    :roleHasPermissions="roleHasPermissions"
                    :sorted="sorted"
                >
                </EditForm>
            </div>
        </div>
    </AppLayout>
</template>
