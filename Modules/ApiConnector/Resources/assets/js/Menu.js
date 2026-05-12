import {
    faPlug,
    faPlus,
} from "@fortawesome/free-solid-svg-icons";

const menuApiConnector = {
    status: false,
    text: "Api Connector",
    icom: faPlug,
    route: null,
    permissions: "api_connector_listar",
    items: [
        {
            route: route("api_connector"),
            status: false,
            text: "Conexiones",
            icom: faPlug,
            permissions: "api_connector_listar",
            info: {
                title: "Api Connector",
                content: `
                    <p class="text-sm text-gray-500 mb-3">
                        Gestión de conexiones API con múltiples tipos de autenticación y formatos.
                    </p>
                    <ul class="space-y-2 text-sm text-gray-700">
                        <li>➕ <span>Nueva Conexión.</span></li>
                        <li>✏️ <span>Editar Conexión.</span></li>
                        <li>🗑️ <span>Eliminar Conexión.</span></li>
                        <li>▶ <span>Probar Conexión.</span></li>
                    </ul>
                `,
                placement: 'right'
            }
        },
    ],
};

export default menuApiConnector;
