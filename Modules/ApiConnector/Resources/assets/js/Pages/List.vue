<script setup>
import AppLayout from '@/Layouts/Vristo/AppLayout.vue';
import Navigation from '@/Components/vristo/layout/Navigation.vue';
import Keypad from '@/Components/Keypad.vue';
import Pagination from '@/Components/Pagination.vue';
import { Link, useForm } from '@inertiajs/vue3';
import { ref } from 'vue';
import { faPlug, faPlus, faPlay, faPencilAlt, faTrashAlt, faCircle, faCheckCircle, faTimesCircle, faClock, faCog } from '@fortawesome/free-solid-svg-icons';
import swal from 'sweetalert';

const props = defineProps({
    connections: Object,
    filters: Object,
});

const form = useForm({ search: props.filters?.search || '' });
const formDelete = useForm({});
const testModal = ref(null);
const testResult = ref(null);
const testing = ref(false);
const testFormParams = ref({});

const authLabels = {
    none: 'Sin Auth',
    basic: 'Basic Auth',
    bearer: 'Bearer Token',
    jwt: 'JWT Auth',
    api_key: 'API Key',
    digest: 'Digest',
    oauth2: 'OAuth2',
    ntlm: 'NTLM',
    hawk: 'Hawk',
};

const methodColors = {
    GET: 'bg-green-500',
    POST: 'bg-blue-500',
    PUT: 'bg-orange-500',
    PATCH: 'bg-gray-500',
    DELETE: 'bg-red-500',
};

function search() {
    form.get(route('api_connector'));
}

function confirmDelete(id, name) {
    swal({
        title: 'Eliminar conexion',
        text: `¿Estas seguro de eliminar "${name}"?`,
        icon: 'warning',
        buttons: ['Cancelar', 'Eliminar'],
        dangerMode: true,
    }).then((willDelete) => {
        if (willDelete) {
            formDelete.delete(route('api_connector_destroy', id));
        }
    });
}

function openTest(connection) {
    testModal.value = connection;
    testResult.value = null;
    testing.value = false;
    // Initialize test params with default values
    const params = {};
    (connection.parameters || []).forEach(p => {
        params[p.name] = p.default_value || '';
    });
    testFormParams.value = params;
}

function runTest() {
    if (!testModal.value) return;
    testing.value = true;
    testResult.value = null;

    const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

    fetch(route('api_connector_test', testModal.value.id), {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': csrfToken
        },
        body: JSON.stringify({ params: testFormParams.value })
    })
    .then(async r => {
        const text = await r.text();
        if (!r.ok) {
            throw new Error(`Error ${r.status}: ${text.substring(0, 200)}`);
        }
        try {
            return JSON.parse(text);
        } catch (e) {
            throw new Error(`Respuesta invalida del servidor: ${text.substring(0, 200)}`);
        }
    })
    .then(data => {
        testResult.value = data;
        testing.value = false;
        if (testModal.value) {
            testModal.value.last_test_status = data.response?.status || null;
            testModal.value.last_tested_at = new Date().toISOString();
        }
    })
    .catch(err => {
        testResult.value = { success: false, error: err.message };
        testing.value = false;
    });
}

function closeTest() {
    testModal.value = null;
    testResult.value = null;
}

function formatBody(body) {
    if (!body) return '(sin contenido)';
    if (typeof body === 'string') {
        try { return JSON.stringify(JSON.parse(body), null, 2); } catch { return body; }
    }
    return JSON.stringify(body, null, 2);
}
</script>

<template>
    <AppLayout title="Api Connector">
        <Navigation :routeModule="route('api_connector')" :titleModule="'Api Connector'">
            <li>Conexiones</li>
        </Navigation>

        <div class="mt-5">
            <div class="panel p-0">
                <div class="w-full p-4">
                    <div class="grid grid-cols-1 sm:grid-cols-3 gap-4 items-end">
                        <div>
                            <form @submit.prevent="search">
                                <input v-model="form.search" type="text" placeholder="Buscar conexion..." class="form-input w-full" />
                            </form>
                        </div>
                        <div class="sm:col-span-2 text-right">
                            <Keypad>
                                <template #botones>
                                    <Link :href="route('api_connector_create')" class="btn btn-primary">
                                        <font-awesome-icon :icon="faPlus" class="mr-1" /> Nueva Conexion
                                    </Link>
                                </template>
                            </Keypad>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table>
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>URL Base</th>
                                <th>Metodo</th>
                                <th>Auth</th>
                                <th>Estado</th>
                                <th>Ultima Prueba</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="conn in connections.data" :key="conn.id">
                                <td>
                                    <div class="font-semibold">{{ conn.name }}</div>
                                    <div v-if="conn.description" class="text-xs text-gray-500">{{ conn.description }}</div>
                                </td>
                                <td class="text-sm">
                                    <code>{{ conn.base_url }}{{ conn.endpoint_path ? '/' + conn.endpoint_path : '' }}</code>
                                </td>
                                <td>
                                    <span class="badge text-white" :class="methodColors[conn.method] || 'bg-gray-500'">
                                        {{ conn.method }}
                                    </span>
                                </td>
                                <td>
                                    <span class="text-xs px-2 py-1 rounded bg-gray-100 dark:bg-gray-700">
                                        {{ authLabels[conn.auth_type] || conn.auth_type }}
                                    </span>
                                </td>
                                <td>
                                    <font-awesome-icon v-if="conn.status" :icon="faCheckCircle" class="text-green-500" />
                                    <font-awesome-icon v-else :icon="faTimesCircle" class="text-red-500" />
                                </td>
                                <td class="text-sm">
                                    <template v-if="conn.last_tested_at">
                                        <div>{{ new Date(conn.last_tested_at).toLocaleDateString() }}</div>
                                        <div v-if="conn.last_test_status" class="text-xs">
                                            Status: <span :class="conn.last_test_status < 400 ? 'text-green-600' : 'text-red-600'">{{ conn.last_test_status }}</span>
                                        </div>
                                    </template>
                                    <span v-else class="text-xs text-gray-400">Nunca</span>
                                </td>
                                <td>
                                    <div class="flex gap-2 items-center">
                                        <button @click="openTest(conn)" class="btn btn-sm btn-info p-1" title="Probar conexion">
                                            <font-awesome-icon :icon="faPlay" />
                                        </button>
                                        <Link :href="route('api_connector_edit', conn.id)" class="btn btn-sm btn-warning p-1" title="Editar">
                                            <font-awesome-icon :icon="faPencilAlt" />
                                        </Link>
                                        <button @click="confirmDelete(conn.id, conn.name)" class="btn btn-sm btn-danger p-1" title="Eliminar">
                                            <font-awesome-icon :icon="faTrashAlt" />
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            <tr v-if="!connections.data.length">
                                <td colspan="7" class="text-center py-8 text-gray-500">
                                    <font-awesome-icon :icon="faPlug" class="text-4xl mb-2" />
                                    <p>No hay conexiones API configuradas</p>
                                    <Link :href="route('api_connector_create')" class="text-primary hover:underline">Crear primera conexion</Link>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="p-4">
                    <Pagination :data="connections" />
                </div>
            </div>
        </div>

        <!-- Test Modal -->
        <teleport to="body">
            <div v-if="testModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50" @click.self="closeTest">
                <div class="bg-white dark:bg-gray-800 rounded-lg shadow-xl w-full max-w-3xl max-h-[90vh] overflow-y-auto m-4">
                    <div class="p-4 border-b border-gray-200 dark:border-gray-700 flex justify-between items-center">
                        <h3 class="text-lg font-semibold">Probar: {{ testModal.name }}</h3>
                        <button @click="closeTest" class="text-gray-500 hover:text-gray-800 text-2xl">&times;</button>
                    </div>
                    <div class="p-4 space-y-4">
                        <div class="bg-gray-50 dark:bg-gray-700 p-3 rounded">
                            <code class="text-sm">{{ testModal.method }} {{ testModal.base_url }}/{{ testModal.endpoint_path }}</code>
                        </div>

                        <!-- Parameter inputs -->
                        <div v-if="testModal.parameters && testModal.parameters.length" class="space-y-3">
                            <h4 class="font-medium text-sm">Parametros de la Prueba</h4>
                            <div v-for="p in testModal.parameters" :key="p.id || p.name" class="grid grid-cols-1 md:grid-cols-3 gap-2 items-center">
                                <label class="text-sm font-medium">{{ p.label || p.name }}<span v-if="p.required" class="text-red-500"> *</span>
                                    <span class="text-xs text-gray-400 ml-1">({{ p.location }})</span>
                                </label>
                                <div class="md:col-span-2">
                                    <input v-model="testFormParams[p.name]" type="text" class="form-input text-sm"
                                        :placeholder="p.description || p.name" />
                                </div>
                            </div>
                        </div>

                        <button @click="runTest" :disabled="testing" class="btn btn-primary" :class="{ 'opacity-50': testing }">
                            <template v-if="testing">Probando...</template>
                            <template v-else><font-awesome-icon :icon="faPlay" class="mr-1" /> Ejecutar Prueba</template>
                        </button>

                        <div v-if="testResult" class="space-y-4">
                            <!-- Request -->
                            <div v-if="testResult.request">
                                <h4 class="font-semibold mb-2 flex items-center gap-2">
                                    <font-awesome-icon :icon="faCog" /> Request
                                </h4>
                                <div class="bg-gray-900 text-gray-100 p-3 rounded text-xs font-mono overflow-x-auto">
                                    <div class="mb-2"><span class="text-blue-400">{{ testResult.request.method }}</span> <span class="text-green-400">{{ testResult.request.url }}</span></div>
                                    <div v-for="(val, key) in testResult.request.headers" :key="key" class="text-gray-300">{{ key }}: {{ val }}</div>
                                    <div v-if="testResult.request.body" class="mt-2 text-gray-400">{{ formatBody(testResult.request.body) }}</div>
                                </div>
                            </div>

                            <!-- Response -->
                            <div v-if="testResult.response">
                                <h4 class="font-semibold mb-2">Response</h4>
                                <div class="bg-gray-900 text-gray-100 p-3 rounded text-xs font-mono overflow-x-auto">
                                    <div class="mb-1">
                                        Status:
                                        <span v-if="testResult.response.status"
                                            :class="testResult.response.status < 400 ? 'text-green-400' : 'text-red-400'">
                                            {{ testResult.response.status }}
                                        </span>
                                        <span v-else class="text-red-400">Error</span>
                                        <span class="text-gray-500 ml-2">{{ testResult.response.time_ms }}ms</span>
                                    </div>
                                    <pre class="whitespace-pre-wrap">{{ formatBody(testResult.response.body) }}</pre>
                                </div>
                            </div>

                            <!-- Error fallback -->
                            <div v-if="testResult.error && !testResult.response" class="p-3 bg-red-50 dark:bg-red-900/20 rounded border border-red-300">
                                <pre class="whitespace-pre-wrap text-red-700 dark:text-red-300">{{ testResult.error }}</pre>
                            </div>

                            <!-- cURL -->
                            <div v-if="testResult.curl">
                                <h4 class="font-semibold mb-2">Equivalente cURL</h4>
                                <div class="bg-gray-900 text-yellow-300 p-3 rounded text-xs font-mono overflow-x-auto">
                                    <pre>{{ testResult.curl }}</pre>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </teleport>
    </AppLayout>
</template>
