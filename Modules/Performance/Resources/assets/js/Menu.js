import {
    faGaugeHigh,
    faImages,
    faCode,
    faDatabase,
    faBolt,
    faListCheck,
    faGauge,
    faBroom,
    faImage,
    faHeading,
} from "@fortawesome/free-solid-svg-icons";

const menuPerformance = {
    status: false,
    text: "Performance",
    icom: faGaugeHigh,
    route: 'module',
    permissions: "perf_images",
    items: [
        {
            route: route("perf_images"),
            status: false,
            text: "Imágenes",
            permissions: "perf_images",
            icom: faImages,
        },
        {
            route: route("perf_lazy_audit"),
            status: false,
            text: "Auditoría de <img>",
            permissions: "perf_images",
            icom: faImage,
        },
        {
            route: route("perf_head_audit"),
            status: false,
            text: "Auditoría de <head>",
            permissions: "perf_images",
            icom: faHeading,
        },
        {
            route: route("perf_frontend"),
            status: false,
            text: "Peso del frontend",
            permissions: "perf_images",
            icom: faCode,
        },
        {
            route: route("perf_database"),
            status: false,
            text: "Base de datos",
            permissions: "perf_images",
            icom: faDatabase,
        },
        {
            route: route("perf_cache"),
            status: false,
            text: "Caché y build",
            permissions: "perf_images",
            icom: faBolt,
        },
        {
            route: route("perf_queues"),
            status: false,
            text: "Colas y errores",
            permissions: "perf_images",
            icom: faListCheck,
        },
        {
            route: route("perf_pages"),
            status: false,
            text: "Carga de páginas",
            permissions: "perf_images",
            icom: faGauge,
        },
        {
            route: route("perf_cleanup"),
            status: false,
            text: "Limpieza",
            permissions: "perf_images",
            icom: faBroom,
        },
    ],
};

export default menuPerformance;
