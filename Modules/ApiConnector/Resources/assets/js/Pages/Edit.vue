<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import Navigation from '@/Components/vristo/layout/Navigation.vue';
import ConnectionForm from './Partials/ConnectionForm.vue';

const props = defineProps({
    connection: Object,
});
</script>

<template>
    <AppLayout title="Editar Conexion API">
        <Navigation :routeModule="route('api_connector')" :titleModule="'Api Connector'">
            <li><a :href="route('api_connector')">Conexiones</a></li>
            <li>Editar: {{ connection?.name }}</li>
        </Navigation>

        <div class="mt-5">
            <div class="panel">
                <ConnectionForm :is-editing="true" :connection="connection" />
            </div>
        </div>
    </AppLayout>
</template>
