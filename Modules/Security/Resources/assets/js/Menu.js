
import {
    faGear,
    faBuilding,
    faDiamond,
    faBookmark,
    faLockOpen,
    faUser,
    faDna,
    faClock
} from "@fortawesome/free-solid-svg-icons";


const menuConfig = {
    status: false,
    text: "Configuraciones",
    icom: faGear,
    route: null,
    permissions: "configuracion",
    items: [
        {
            route: route("company_show"),
            status: false,
            text: "Empresa",
            permissions: "empresa",
        },
        {
            route: route("modulos.index"),
            status: false,
            text: "Modulos",
            permissions: "modulos",
        },
        {
            route: route("roles.index"),
            status: false,
            text: "Roles",
            permissions: "roles",
        },
        {
            route: route("permissions.index"),
            status: false,
            text: "Permisos",
            permissions: "permisos",
        },
        {
            route: route("users.index"),
            status: false,
            text: "usuarios",
            permissions: "usuarios",
        },
        {
            route: route("parameters"),
            status: false,
            text: "Parámetros del sistema",
            permissions: "parametros",
        },
        {
            route: route("user_activity_logs"),
            status: false,
            text: "Historial de Actividades",
            icom: faClock,
            permissions: "conf_historial_actividades",
        },

    ],
};
export default menuConfig;
