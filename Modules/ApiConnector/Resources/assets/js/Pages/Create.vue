<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import Navigation from '@/Components/vristo/layout/Navigation.vue';
import ConnectionForm from './Partials/ConnectionForm.vue';

</script>

<template>
    <AppLayout title="Nueva Conexion API">
        <Navigation :routeModule="route('api_connector')" :titleModule="'Api Connector'">
            <li><a :href="route('api_connector')">Conexiones</a></li>
            <li>Nueva</li>
        </Navigation>

        <div class="mt-5">
            <div class="panel">
                <ConnectionForm :is-editing="false" />
            </div>
        </div>
    </AppLayout>
</template>
