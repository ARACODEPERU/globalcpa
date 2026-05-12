<script setup>
import { ref, reactive, watch, computed } from 'vue';
import { useForm, router } from '@inertiajs/vue3';

const props = defineProps({
    isEditing: Boolean,
    connection: { type: Object, default: null },
});

const activeTab = ref('basic');

const tabs = [
    { id: 'basic', label: 'Configuracion Basica' },
    { id: 'auth', label: 'Autenticacion' },
    { id: 'headers', label: 'Headers' },
    { id: 'parameters', label: 'Parametros' },
    { id: 'body', label: 'Body / Contenido' },
    { id: 'test', label: 'Probar Conexion' },
];

const authTypes = [
    { value: 'none', label: 'Sin Autenticacion', icon: '🔓' },
    { value: 'basic', label: 'HTTP Basic', icon: '🔑' },
    { value: 'bearer', label: 'Bearer Token', icon: '🎫' },
    { value: 'jwt', label: 'JWT Auth / JSON Web Token', icon: '🪙' },
    { value: 'api_key', label: 'API Key', icon: '🔐' },
    { value: 'digest', label: 'Digest', icon: '🔒' },
    { value: 'oauth2', label: 'OAuth 2.0', icon: '🔄' },
    { value: 'ntlm', label: 'NTLM', icon: '🏢' },
    { value: 'hawk', label: 'Hawk', icon: '🛡️' },
];

const form = useForm({
    name: props.connection?.name || '',
    description: props.connection?.description || '',
    base_url: props.connection?.base_url || '',
    endpoint_path: props.connection?.endpoint_path || '',
    method: props.connection?.method || 'GET',
    auth_type: props.connection?.auth_type || 'none',
    auth_config: props.connection?.auth_config ? JSON.parse(props.connection.auth_config) : {},
    body_type: props.connection?.body_type || 'none',
    body_template: props.connection?.body_template || '',
    response_type: props.connection?.response_type || 'json',
    timeout: props.connection?.timeout || 30,
    retry_count: props.connection?.retry_count || 0,
    status: props.connection?.status ?? true,
    send_extra_params: props.connection?.send_extra_params ?? false,
});

const localHeaders = ref(
    props.connection?.headers
        ? JSON.parse(JSON.stringify(props.connection.headers)).map((h, i) => ({ ...h, _key: h._key || `hdr_${i}` }))
        : []
);

const localParameters = ref(
    props.connection?.parameters?.map((p, i) => ({
        _key: p.id || `new_${i}`,
        id: p.id || null,
        name: p.name || '',
        label: p.label || '',
        type: p.type || 'string',
        location: p.location || 'query',
        required: p.required || false,
        default_value: p.default_value || '',
        description: p.description || '',
        validation_rules: p.validation_rules || '',
        sort_order: p.sort_order ?? i,
    })) || []
);

const headerPresets = [
    { name: 'Content-Type', value: 'application/json' },
    { name: 'Accept', value: 'application/json' },
    { name: 'Authorization', value: '' },
    { name: 'Cache-Control', value: 'no-cache' },
    { name: 'User-Agent', value: 'GlobalCPA-ApiConnector/1.0' },
];

const bodyTypes = [
    { value: 'none', label: 'Sin Body' },
    { value: 'json', label: 'JSON' },
    { value: 'xml', label: 'XML' },
    { value: 'form_data', label: 'Form Data' },
    { value: 'form_urlencoded', label: 'Form URL-Encoded' },
    { value: 'graphql', label: 'GraphQL' },
    { value: 'soap', label: 'SOAP' },
    { value: 'binary', label: 'Binary' },
];

const responseTypes = [
    { value: 'json', label: 'JSON' },
    { value: 'xml', label: 'XML' },
    { value: 'text', label: 'Texto Plano' },
    { value: 'binary', label: 'Binario' },
];

const paramTypes = [
    { value: 'string', label: 'String' },
    { value: 'integer', label: 'Integer' },
    { value: 'boolean', label: 'Boolean' },
    { value: 'number', label: 'Number' },
    { value: 'date', label: 'Date' },
    { value: 'file', label: 'File' },
];

const paramLocations = [
    { value: 'query', label: 'Query Param ?', icon: '?' },
    { value: 'header', label: 'Header', icon: '📋' },
    { value: 'body_json', label: 'Body JSON', icon: '📦' },
    { value: 'body_xml', label: 'Body XML', icon: '📄' },
    { value: 'body_form', label: 'Body Form', icon: '📝' },
    { value: 'path', label: 'URL Path', icon: '🔗' },
];

const authConfigFields = computed(() => {
    const type = form.auth_type;
    const config = form.auth_config || {};

    switch (type) {
        case 'basic':
            return [
                { key: 'username', label: 'Usuario', type: 'text', value: config.username || '' },
                { key: 'password', label: 'Contrasena', type: 'password', value: config.password || '' },
            ];
        case 'bearer':
            return [
                { key: 'token', label: 'Token', type: 'text', value: config.token || '' },
            ];
        case 'jwt':
            return [
                { key: 'mode', label: 'Modo', type: 'select', options: [
                    { value: 'token', label: 'Token manual' },
                    { value: 'generate', label: 'Generar con secreto' },
                ], value: config.mode || 'token' },
                ...(config.mode === 'generate' ? [
                    { key: 'secret', label: 'Secreto / Passphrase', type: 'password', value: config.secret || '' },
                    { key: 'algorithm', label: 'Algoritmo', type: 'select', options: [
                        { value: 'HS256', label: 'HS256' },
                        { value: 'HS384', label: 'HS384' },
                        { value: 'HS512', label: 'HS512' },
                    ], value: config.algorithm || 'HS256' },
                    { key: 'claims', label: 'Claims (payload)', type: 'textarea', value: typeof config.claims === 'object' ? JSON.stringify(config.claims, null, 2) : (config.claims || '{\n  "sub": "123",\n  "name": "Usuario"\n}') },
                ] : [
                    { key: 'token', label: 'JWT Token', type: 'text', value: config.token || '' },
                ]),
                { key: 'prefix', label: 'Prefijo', type: 'select', options: [{ value: 'Bearer', label: 'Bearer' }, { value: 'JWT', label: 'JWT' }], value: config.prefix || 'Bearer' },
            ];
        case 'api_key':
            return [
                { key: 'key_name', label: 'Nombre del Key', type: 'text', value: config.key_name || 'X-API-Key' },
                { key: 'key_value', label: 'Valor del Key', type: 'text', value: config.key_value || '' },
                { key: 'in', label: 'Ubicacion', type: 'select', options: [{ value: 'header', label: 'Header' }, { value: 'query', label: 'Query Param' }], value: config.in || 'header' },
            ];
        case 'digest':
            return [
                { key: 'username', label: 'Usuario', type: 'text', value: config.username || '' },
                { key: 'password', label: 'Contrasena', type: 'password', value: config.password || '' },
            ];
        case 'oauth2':
            return [
                { key: 'grant_type', label: 'Grant Type', type: 'select', options: [{ value: 'client_credentials', label: 'Client Credentials' }, { value: 'password', label: 'Password' }], value: config.grant_type || 'client_credentials' },
                { key: 'token_url', label: 'Token URL', type: 'text', value: config.token_url || '' },
                { key: 'client_id', label: 'Client ID', type: 'text', value: config.client_id || '' },
                { key: 'client_secret', label: 'Client Secret', type: 'password', value: config.client_secret || '' },
                { key: 'scopes', label: 'Scopes', type: 'text', value: config.scopes || '' },
            ];
        case 'ntlm':
            return [
                { key: 'username', label: 'Usuario', type: 'text', value: config.username || '' },
                { key: 'password', label: 'Contrasena', type: 'password', value: config.password || '' },
                { key: 'domain', label: 'Dominio', type: 'text', value: config.domain || '' },
            ];
        case 'hawk':
            return [
                { key: 'id', label: 'Hawk ID', type: 'text', value: config.id || '' },
                { key: 'key', label: 'Hawk Key', type: 'text', value: config.key || '' },
                { key: 'algorithm', label: 'Algoritmo', type: 'select', options: [{ value: 'sha256', label: 'SHA-256' }], value: config.algorithm || 'sha256' },
            ];
        default:
            return [];
    }
});

watch(() => form.auth_type, () => {
    form.auth_config = {};
});

function updateAuthConfig(fieldKey, value) {
    const config = { ...form.auth_config };
    config[fieldKey] = value;
    form.auth_config = config;
}

function addHeader() {
    localHeaders.value = [...localHeaders.value, { name: '', value: '', _key: `hdr_${Date.now()}` }];
}

function removeHeader(index) {
    localHeaders.value = localHeaders.value.filter((_, i) => i !== index);
}

function addParameter() {
    localParameters.value = [...localParameters.value, {
        _key: `new_${Date.now()}`,
        id: null,
        name: '',
        label: '',
        type: 'string',
        location: 'query',
        required: false,
        default_value: '',
        description: '',
        validation_rules: '',
        sort_order: localParameters.value.length,
    }];
}

function removeParameter(index) {
    localParameters.value = localParameters.value.filter((_, i) => i !== index);
}

function addHeaderPreset(preset) {
    localHeaders.value = [...localHeaders.value, { name: preset.name, value: preset.value, _key: `hdr_${Date.now()}` }];
}

const testResult = ref(null);
const testLoading = ref(false);
const testParams = ref({});

watch(localParameters, () => {
    const tp = {};
    localParameters.value.forEach(p => {
        tp[p.name] = p.default_value || '';
    });
    testParams.value = tp;
}, { immediate: true, deep: true });

async function runTest() {
    testLoading.value = true;
    testResult.value = null;

    const params = {};
    Object.entries(testParams.value).forEach(([key, value]) => {
        if (value !== '') params[key] = value;
    });

    try {
        let url = route('api_connector_test', props.connection?.id || 0);
        if (!props.isEditing) {
            testResult.value = { success: false, error: 'Guarda la conexion primero antes de probar.' };
            testLoading.value = false;
            return;
        }

        const response = await fetch(url, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')?.content || ''
            },
            body: JSON.stringify({ params })
        });
        testResult.value = await response.json();
    } catch (err) {
        testResult.value = { success: false, error: err.message };
    }
    testLoading.value = false;
}

function submit() {
    form.transform((data) => ({
        ...data,
        headers: JSON.stringify(localHeaders.value),
        auth_config: JSON.stringify(form.auth_config),
        parameters: localParameters.value.map((p, i) => ({
            id: p.id,
            name: p.name,
            label: p.label,
            type: p.type,
            location: p.location,
            required: p.required,
            default_value: p.default_value,
            description: p.description,
            validation_rules: p.validation_rules,
            sort_order: i,
        })),
    }));

    if (props.isEditing) {
        form.put(route('api_connector_update', props.connection.id));
    } else {
        form.post(route('api_connector_store'));
    }
}

const methodBadge = (m) => {
    const colors = { GET: 'bg-green-500', POST: 'bg-blue-500', PUT: 'bg-orange-500', PATCH: 'bg-gray-500', DELETE: 'bg-red-500' };
    return colors[m] || 'bg-gray-500';
};

const phpExample = computed(() => {
    const name = form.name || 'mi-conexion';
    const params = localParameters.value.filter(p => p.required || p.default_value);
    const paramsStr = params.map(p => `    '${p.name}' => '${p.default_value || 'valor'}'`).join(',\n');
    const hasBody = form.body_type !== 'none';

    return `<?php

use Modules\\ApiConnector\\Facades\\ApiConnector;

$response = ApiConnector::connection('${name}')->call([
${paramsStr || '    // parametros opcionales aqui'}
]);

// Resultado:
echo $response->response_status;   // ${form.method === 'GET' ? '200' : '201'}
echo $response->response_body;     // Respuesta de la API
echo $response->response_time_ms;  // Tiempo en ms
`;
});

const vueExample = computed(() => {
    const name = form.name || 'mi-conexion';
    const method = form.method.toLowerCase();
    const params = localParameters.value.filter(p => p.required || p.default_value);
    const bodyCode = (form.body_type === 'json' && params.length)
        ? `body: JSON.stringify({\n${params.map(p => `      ${p.name}: '${p.default_value || 'valor'}'`).join(',\n')}\n    })`
        : '';
    const queryCode = params.filter(p => p.location === 'query').length
        ? params.filter(p => p.location === 'query').map(p => `${p.name}=${p.default_value || 'valor'}`).join('&')
        : '';
    const url = form.base_url + (form.endpoint_path ? '/' + form.endpoint_path : '');

    // Generate auth header code with placeholders (no real secrets exposed)
    let authHeaders = '';
    const authCfg = form.auth_config || {};
    switch (form.auth_type) {
        case 'basic':
            authHeaders += '        // Nota: Basic Auth se maneja en el backend, no en el frontend\n';
            authHeaders += "        // Debes usar la facade de PHP o tu propio endpoint intermedio\n";
            break;
        case 'bearer':
            authHeaders += "        'Authorization': 'Bearer TOKEN_CONFIGURADO',\n";
            break;
        case 'jwt':
            authHeaders += "        'Authorization': 'Bearer JWT_CONFIGURADO',\n";
            break;
        case 'api_key':
            authHeaders += `        '${authCfg.key_name || 'X-API-Key'}': 'API_KEY_CONFIGURADA',\n`;
            break;
        case 'oauth2':
            authHeaders += "        'Authorization': 'Bearer OAUTH_TOKEN',\n";
            break;
    }

    // Add parameter-based headers (non-sensitive)
    const headerParams = params.filter(p => p.location === 'header' && !['Authorization', 'authorization'].includes(p.name.toLowerCase()));
    headerParams.forEach(p => {
        authHeaders += `        '${p.name}': '${p.default_value || 'valor'}',\n`;
    });

    return `// Ejemplo con fetch desde Vue/JS
// IMPORTANTE: Las credenciales van en el backend.
// Para produccion, llama a un endpoint de Laravel que use ApiConnector.
const response = await fetch('${url}${queryCode ? '?' + queryCode : ''}', {
    method: '${form.method}',
    headers: {\n${authHeaders}        'Content-Type': 'application/json',
        'Accept': 'application/json',
    },${bodyCode ? `\n    ${bodyCode}` : ''}
});

const data = await response.json();
console.log(data);
`;
});

function formatBody(body) {
    if (!body) return '(sin contenido)';
    if (typeof body === 'string') {
        try { return JSON.stringify(JSON.parse(body), null, 2); } catch { return body; }
    }
    return JSON.stringify(body, null, 2);
}
</script>

<template>
    <div>
        <!-- Tab Navigation -->
        <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
            <ul class="flex flex-wrap -mb-px text-sm font-medium text-center">
                <li v-for="tab in tabs" :key="tab.id" class="mr-2">
                    <button @click="activeTab = tab.id"
                        class="inline-block p-4 border-b-2 rounded-t-lg transition-colors"
                        :class="activeTab === tab.id ? 'border-primary text-primary' : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300'">
                        {{ tab.label }}
                    </button>
                </li>
            </ul>
        </div>

        <!-- Basic Tab -->
        <div v-show="activeTab === 'basic'" class="space-y-4">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-medium">Nombre de la conexion *</label>
                    <input v-model="form.name" type="text" class="form-input w-full" placeholder="Ej: API SUNAT, Mercado Pago, etc" />
                    <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
                </div>
                <div>
                    <label class="block mb-1 font-medium">Metodo HTTP</label>
                    <div class="flex gap-2 flex-wrap">
                        <button v-for="m in ['GET','POST','PUT','PATCH','DELETE']" :key="m" @click="form.method = m"
                            class="px-4 py-2 rounded text-white text-sm font-semibold transition transform hover:scale-105"
                            :class="[methodBadge(m), form.method === m ? 'ring-2 ring-offset-2 ring-primary' : 'opacity-60']">
                            {{ m }}
                        </button>
                    </div>
                </div>
            </div>
            <div>
                <label class="block mb-1 font-medium">Descripcion</label>
                <textarea v-model="form.description" class="form-input w-full" rows="2" placeholder="Descripcion opcional de la conexion"></textarea>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-medium">URL Base *</label>
                    <input v-model="form.base_url" type="text" class="form-input w-full" placeholder="https://api.example.com" />
                    <div v-if="form.errors.base_url" class="text-red-500 text-sm mt-1">{{ form.errors.base_url }}</div>
                </div>
                <div>
                    <label class="block mb-1 font-medium">Endpoint Path</label>
                    <input v-model="form.endpoint_path" type="text" class="form-input w-full" placeholder="v2/students (opcional)" />
                </div>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div>
                    <label class="block mb-1 font-medium">Timeout (segundos)</label>
                    <input v-model="form.timeout" type="number" min="1" max="300" class="form-input w-full" />
                </div>
                <div>
                    <label class="block mb-1 font-medium">Reintentos</label>
                    <input v-model="form.retry_count" type="number" min="0" max="10" class="form-input w-full" />
                </div>
                <div>
                    <label class="block mb-1 font-medium">Formato Respuesta Esperada</label>
                    <select v-model="form.response_type" class="form-select w-full">
                        <option v-for="rt in responseTypes" :key="rt.value" :value="rt.value">{{ rt.label }}</option>
                    </select>
                </div>
            </div>
            <div class="flex items-center gap-2">
                <input v-model="form.status" type="checkbox" id="conn-status" class="form-checkbox" />
                <label for="conn-status" class="font-medium">Conexion activa</label>
            </div>
        </div>

        <!-- Auth Tab -->
        <div v-show="activeTab === 'auth'" class="space-y-6">
            <label class="block mb-2 font-medium">Tipo de Autenticacion</label>
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <button v-for="at in authTypes" :key="at.value" @click="form.auth_type = at.value"
                    class="p-4 rounded-lg border-2 text-center transition-all hover:shadow-md"
                    :class="form.auth_type === at.value ? 'border-primary bg-primary/10 shadow-md' : 'border-gray-200 dark:border-gray-600'">
                    <div class="text-2xl mb-1">{{ at.icon }}</div>
                    <div class="text-sm font-medium">{{ at.label }}</div>
                </button>
            </div>

            <div v-if="authConfigFields.length > 0" class="mt-6 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg space-y-4">
                <h4 class="font-semibold">Configuracion {{ authTypes.find(a => a.value === form.auth_type)?.label }}</h4>
                <div v-for="field in authConfigFields" :key="field.key" class="grid grid-cols-1 md:grid-cols-2 gap-2 items-center">
                    <label class="font-medium">{{ field.label }}</label>
                    <div v-if="field.type === 'select'">
                        <select @change="updateAuthConfig(field.key, $event.target.value)" class="form-select w-full">
                            <option v-for="opt in field.options" :key="opt.value" :value="opt.value" :selected="field.value === opt.value">{{ opt.label }}</option>
                        </select>
                    </div>
                    <div v-else-if="field.type === 'textarea'">
                        <textarea :value="field.value" @input="updateAuthConfig(field.key, $event.target.value)"
                            class="form-input w-full font-mono text-sm" rows="5" :placeholder="field.label"></textarea>
                    </div>
                    <div v-else>
                        <input :type="field.type" :value="field.value" @input="updateAuthConfig(field.key, $event.target.value)"
                            class="form-input w-full" :placeholder="field.label" />
                    </div>
                </div>
            </div>

            <div v-if="form.auth_type === 'api_key' && form.auth_config?.in === 'query'" class="mt-2 text-sm text-yellow-600 bg-yellow-50 dark:bg-yellow-900/20 p-3 rounded">
                API Key se enviara como query param en la URL, no como header.
            </div>
        </div>

        <!-- Headers Tab -->
        <div v-show="activeTab === 'headers'" class="space-y-4">
            <div class="flex gap-2 flex-wrap mb-4">
                <span class="text-sm font-medium mr-2 self-center">Presets:</span>
                <button v-for="preset in headerPresets" :key="preset.name" @click="addHeaderPreset(preset)"
                    class="text-xs px-3 py-1 bg-gray-100 dark:bg-gray-700 rounded-full hover:bg-gray-200 dark:hover:bg-gray-600 transition">
                    {{ preset.name }}
                </button>
            </div>

            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-sm">
                            <th class="w-8"></th>
                            <th class="p-2">Header Name</th>
                            <th class="p-2">Header Value</th>
                            <th class="w-12"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(header, index) in localHeaders" :key="header._key || index" class="border-t border-gray-100 dark:border-gray-700">
                            <td class="p-2 text-center text-gray-400">⠿</td>
                            <td class="p-2">
                                <input v-model="header.name" type="text" class="form-input w-full" placeholder="Header-Name" />
                            </td>
                            <td class="p-2">
                                <input v-model="header.value" type="text" class="form-input w-full" placeholder="Header Value" />
                            </td>
                            <td class="p-2">
                                <button @click="removeHeader(index)" class="text-red-500 hover:text-red-700">&times;</button>
                            </td>
                        </tr>
                        <tr v-if="!localHeaders.length">
                            <td colspan="4" class="p-4 text-center text-gray-400 text-sm">No hay headers definidos</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button @click="addHeader" class="btn btn-secondary btn-sm">+ Anadir Header</button>
        </div>

        <!-- Parameters Tab -->
        <div v-show="activeTab === 'parameters'" class="space-y-4">
            <p class="text-sm text-gray-500">Define los parametros que la API espera. Puedes arrastrar las filas para reordenarlas.</p>
            <div class="overflow-x-auto">
                <table class="w-full">
                    <thead>
                        <tr class="text-left text-sm">
                            <th class="w-8"></th>
                            <th class="p-2">Nombre</th>
                            <th class="p-2">Tipo</th>
                            <th class="p-2">Ubicacion</th>
                            <th class="p-2 text-center">Req.</th>
                            <th class="p-2">Valor Default</th>
                            <th class="p-2">Descripcion</th>
                            <th class="w-12"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="(param, index) in localParameters" :key="param._key || index" class="border-t border-gray-100 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-800/50">
                            <td class="p-2 text-center text-gray-400">⠿</td>
                            <td class="p-2">
                                <input v-model="param.name" type="text" class="form-input w-full text-sm" placeholder="param_name" />
                            </td>
                            <td class="p-2">
                                <select v-model="param.type" class="form-select w-full text-sm">
                                    <option v-for="pt in paramTypes" :key="pt.value" :value="pt.value">{{ pt.label }}</option>
                                </select>
                            </td>
                            <td class="p-2">
                                <select v-model="param.location" class="form-select w-full text-sm">
                                    <option v-for="pl in paramLocations" :key="pl.value" :value="pl.value">{{ pl.icon }} {{ pl.label }}</option>
                                </select>
                            </td>
                            <td class="p-2 text-center">
                                <input v-model="param.required" type="checkbox" class="form-checkbox" />
                            </td>
                            <td class="p-2">
                                <input v-model="param.default_value" type="text" class="form-input w-full text-sm" placeholder="Valor default" />
                            </td>
                            <td class="p-2">
                                <input v-model="param.description" type="text" class="form-input w-full text-sm" placeholder="Descripcion" />
                            </td>
                            <td class="p-2">
                                <button @click="removeParameter(index)" class="text-red-500 hover:text-red-700">&times;</button>
                            </td>
                        </tr>
                        <tr v-if="!localParameters.length">
                            <td colspan="8" class="p-4 text-center text-gray-400 text-sm">No hay parametros definidos</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <button @click="addParameter" class="btn btn-secondary btn-sm">+ Anadir Parametro</button>
        </div>

        <!-- Body Tab -->
        <div v-show="activeTab === 'body'" class="space-y-4">
            <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                <button v-for="bt in bodyTypes" :key="bt.value" @click="form.body_type = bt.value"
                    class="p-3 rounded-lg border-2 text-center transition-all hover:shadow-md"
                    :class="form.body_type === bt.value ? 'border-primary bg-primary/10 shadow-md' : 'border-gray-200 dark:border-gray-600'">
                    <div class="text-sm font-medium">{{ bt.label }}</div>
                </button>
            </div>

            <div v-if="form.body_type === 'json'" class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                <p class="text-sm text-gray-500 mb-2">Los parametros con ubicacion "Body JSON" se enviaran automaticamente como JSON.</p>
                <pre class="bg-gray-900 text-green-300 p-3 rounded text-xs overflow-x-auto">{
    <span v-for="(p, i) in localParameters.filter(p => p.location === 'body_json')" :key="i">
    "{{ p.name }}": "{{ p.default_value || 'valor' }}"<span v-if="i < localParameters.filter(p2 => p2.location === 'body_json').length - 1">,</span>
    </span>
    <span v-if="!localParameters.filter(p => p.location === 'body_json').length" class="text-gray-500">// No hay parametros body_json definidos en la pestana Parametros</span>
}</pre>
            </div>

            <div v-if="form.body_type === 'xml' || form.body_type === 'soap'" class="space-y-2">
                <label class="block font-medium">Template {{ form.body_type === 'soap' ? 'SOAP Envelope' : 'XML' }}</label>
                <p class="text-sm text-gray-500">Usa <code>{<!-- -->{param_name}}</code> como placeholder para los parametros con ubicacion "Body XML".</p>
                <textarea v-model="form.body_template" class="form-input w-full font-mono text-sm" rows="12"
                    :placeholder="form.body_type === 'soap'
                        ? '<soap:Envelope xmlns:soap=&quot;http://schemas.xmlsoap.org/soap/envelope/&quot;>\n  <soap:Body>\n    <GetUser>\n      <id>{user_id}</id>\n    </GetUser>\n  </soap:Body>\n</soap:Envelope>'
                        : '<root>\n  <item>{param_name}</item>\n</root>'" />
            </div>

            <div v-if="form.body_type === 'form_data' || form.body_type === 'form_urlencoded'" class="p-4 bg-gray-50 dark:bg-gray-800 rounded-lg">
                <p class="text-sm text-gray-500 mb-2">Los parametros con ubicacion "Body Form" se enviaran como {{ form.body_type === 'form_data' ? 'multipart/form-data' : 'application/x-www-form-urlencoded' }}.</p>
                <div class="overflow-x-auto">
                    <table class="w-full text-sm">
                        <thead>
                            <tr class="text-left">
                                <th class="p-2">Parametro</th>
                                <th class="p-2">Location</th>
                                <th class="p-2">Valor Default</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="p in localParameters.filter(p => p.location === 'body_form')" :key="p._key" class="border-t border-gray-200">
                                <td class="p-2">{{ p.name }}</td>
                                <td class="p-2"><span class="text-xs bg-gray-200 dark:bg-gray-600 px-2 py-0.5 rounded">{{ p.location }}</span></td>
                                <td class="p-2 text-gray-500">{{ p.default_value || '(vacio)' }}</td>
                            </tr>
                            <tr v-if="!localParameters.filter(p => p.location === 'body_form').length">
                                <td colspan="3" class="p-2 text-gray-400 text-center">No hay parametros con ubicacion "Body Form" en la pestana Parametros</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div v-if="form.body_type === 'graphql'" class="space-y-2">
                <label class="block font-medium">GraphQL Query</label>
                <p class="text-sm text-gray-500">Usa <code>{<!-- -->{variable}}</code> para placeholders. Las variables se toman de los parametros con ubicacion "Body JSON".</p>
                <textarea v-model="form.body_template" class="form-input w-full font-mono text-sm" rows="8"
                    placeholder="query GetUser($id: ID!) {\n  user(id: $id) {\n    name\n    email\n  }\n}" />
            </div>

            <div v-if="form.body_type === 'binary'" class="p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg">
                <p class="text-sm text-yellow-700 dark:text-yellow-300">Para binary se enviara el contenido del parametro como cuerpo binario. Define un parametro file en la pestana Parametros.</p>
            </div>

            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-4">
                <div class="flex items-center gap-2">
                    <input v-model="form.send_extra_params" type="checkbox" id="send-extra" class="form-checkbox" />
                    <label for="send-extra" class="font-medium text-sm">Enviar parametros adicionales en el body</label>
                </div>
                <p v-if="form.body_type === 'json'" class="text-xs text-gray-500 mt-1 ml-6">
                    Si activas esto, cualquier parametro extra que pases al llamar la API se incluira automaticamente en el body JSON,
                    aunque no este configurado en la pestana Parametros.
                </p>
            </div>
        </div>

        <!-- Test Tab -->
        <div v-show="activeTab === 'test'" class="space-y-4">
            <div v-if="!props.isEditing" class="p-4 bg-yellow-50 dark:bg-yellow-900/20 rounded-lg text-center">
                <p class="text-yellow-700 dark:text-yellow-300 mb-3">Guarda la conexion primero para poder probarla.</p>
                <button @click="submit" :disabled="form.processing" class="btn btn-primary" :class="{ 'opacity-50': form.processing }">
                    {{ form.processing ? 'Guardando...' : 'Guardar Conexion' }}
                </button>
            </div>

            <div v-else>
                <div v-if="localParameters.length" class="space-y-3 mb-4">
                    <h4 class="font-medium">Parametros para la Prueba</h4>
                    <div v-for="p in localParameters" :key="p._key" class="grid grid-cols-1 md:grid-cols-3 gap-2 items-center">
                        <label class="font-medium text-sm">{{ p.label || p.name }}<span v-if="p.required" class="text-red-500"> *</span>
                            <span class="text-xs text-gray-400 ml-1">({{ p.location }})</span>
                        </label>
                        <div class="md:col-span-2">
                            <input v-model="testParams[p.name]" type="text" class="form-input" :placeholder="p.description || p.name" />
                        </div>
                    </div>
                </div>
                <p v-else class="text-sm text-gray-500 mb-4">No hay parametros definidos. Agrega parametros en la pestana Parametros.</p>

                <button @click="runTest" :disabled="testLoading" class="btn btn-primary" :class="{ 'opacity-50': testLoading }">
                    <template v-if="testLoading">Probando...</template>
                    <template v-else>▶ Ejecutar Prueba</template>
                </button>

                <div v-if="testResult" class="space-y-4 mt-4">
                    <div :class="testResult.success ? 'bg-green-50 dark:bg-green-900/20 border-green-300' : 'bg-red-50 dark:bg-red-900/20 border-red-300'" class="p-3 rounded border">
                        <span v-if="testResult.success" class="text-green-700 dark:text-green-300 font-semibold">Status: {{ testResult.response.status }} ({{ testResult.response.time_ms }}ms)</span>
                        <span v-else class="text-red-700 dark:text-red-300 font-semibold">Error: {{ testResult.error }}</span>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-2 text-sm">Request</h4>
                        <div class="bg-gray-900 text-gray-100 p-3 rounded text-xs font-mono overflow-x-auto max-h-40 overflow-y-auto">
                            <div><span class="text-blue-400">{{ testResult.request.method }}</span> <span class="text-green-400">{{ testResult.request.url }}</span></div>
                            <div v-for="(val, key) in testResult.request.headers" :key="key" class="text-gray-300">{{ key }}: {{ val }}</div>
                            <div v-if="testResult.request.body" class="mt-1 text-gray-400">{{ formatBody(testResult.request.body) }}</div>
                        </div>
                    </div>

                    <div>
                        <h4 class="font-semibold mb-2 text-sm">Response</h4>
                        <div class="bg-gray-900 text-gray-100 p-3 rounded text-xs font-mono overflow-x-auto max-h-60 overflow-y-auto">
                            <pre class="whitespace-pre-wrap">{{ formatBody(testResult.response?.body) }}</pre>
                        </div>
                    </div>

                    <div v-if="testResult.curl">
                        <h4 class="font-semibold mb-2 text-sm">Equivalente cURL</h4>
                        <div class="bg-gray-900 text-yellow-300 p-3 rounded text-xs font-mono overflow-x-auto">
                            <pre>{{ testResult.curl }}</pre>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Usage Examples -->
            <div class="border-t border-gray-200 dark:border-gray-700 pt-4 mt-6">
                <details>
                    <summary class="cursor-pointer font-semibold text-sm text-primary">📖 Ejemplos de uso en codigo</summary>
                    <div class="mt-3 space-y-4">
                        <div>
                            <h4 class="font-semibold mb-1 text-sm">PHP (Laravel)</h4>
                            <div class="bg-gray-900 text-green-300 p-3 rounded text-xs font-mono overflow-x-auto">
                                <pre>{{ phpExample }}</pre>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold mb-1 text-sm">JavaScript / Vue</h4>
                            <div class="bg-gray-900 text-yellow-300 p-3 rounded text-xs font-mono overflow-x-auto">
                                <pre>{{ vueExample }}</pre>
                            </div>
                        </div>
                    </div>
                </details>
            </div>
        </div>

        <!-- Submit -->
        <div class="mt-8 pt-4 border-t border-gray-200 dark:border-gray-700 flex justify-between">
            <a :href="route('api_connector')" class="btn btn-secondary">Cancelar</a>
            <button @click="submit" :disabled="form.processing" class="btn btn-primary" :class="{ 'opacity-50': form.processing }">
                {{ form.processing ? 'Guardando...' : (props.isEditing ? 'Actualizar Conexion' : 'Crear Conexion') }}
            </button>
        </div>
    </div>
</template>

