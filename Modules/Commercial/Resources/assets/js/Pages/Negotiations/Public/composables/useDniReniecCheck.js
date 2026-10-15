import { computed, ref } from "vue";
import Swal2 from "sweetalert2";

/**
 * DNI del cliente principal en el formulario publico de negociacion.
 *
 * Al completar los 8 digitos se consulta RENIEC y se autollenan nombres y apellidos.
 * Los datos que devuelve la API (o una busqueda interna / cuenta existente) quedan
 * de SOLO LECTURA: si estan correctos no se editan. Los campos solo se habilitan
 * cuando la consulta no devolvio datos, para que el cliente los escriba a mano.
 *
 * @param {object}   options
 * @param {object}   options.form            Formulario de Inertia (fuente del DNI).
 * @param {string}   options.token           Token publico de la negociacion.
 * @param {object}   options.isDni           Computed: el documento elegido es DNI.
 * @param {Function} options.normalizeNumber Deja solo digitos en el numero de documento.
 */
export function useDniReniecCheck({ form, token, isDni, normalizeNumber }) {
    // 'idle'      : aun no se consulto (campos bloqueados y vacios).
    // 'found'     : RENIEC/migo devolvio datos (campos bloqueados y autollenados).
    // 'verified'  : los datos vienen de una fuente interna confiable (bloqueados).
    // 'not_found' : la consulta no devolvio datos (campos editables a mano).
    const dniStatus = ref("idle");
    const dniLoading = ref(false);
    const dniNotice = ref("");

    // Nombres y apellidos: de solo lectura mientras haya datos verificados. Solo se
    // habilitan cuando la busqueda no encontro nada.
    const dniLocked = computed(() => dniStatus.value !== "not_found");

    // Datos confiables cargados (RENIEC o fuente interna): habilita el envio.
    const dniValidated = computed(() =>
        dniStatus.value === "found" || dniStatus.value === "verified"
    );

    /** Descarta la validacion del DNI (cambio de documento o de numero). */
    const resetDniCheck = () => {
        dniStatus.value = "idle";
        dniNotice.value = "";
    };

    /** Los datos ya estan verificados (busqueda interna o cuenta existente): no hace falta RENIEC. */
    const markPersonVerified = () => {
        dniStatus.value = "verified";
        dniNotice.value = "";
    };

    /** Al cambiar el numero se descartan los datos autollenados: hay que volver a buscar. */
    const clearReniecNames = () => {
        form.names = null;
        form.father_lastname = null;
        form.mother_lastname = null;
    };

    const applyReniecNames = (person) => {
        if (person.names) form.names = person.names;
        if (person.father_lastname) form.father_lastname = person.father_lastname;
        if (person.mother_lastname) form.mother_lastname = person.mother_lastname;

        // Fallback (migo): devuelve "APELLIDOS NOMBRES" en un solo campo; se reparte.
        if (!person.names && person.full_name) {
            const parts = String(person.full_name).trim().split(/\s+/);
            if (parts.length >= 3) {
                form.father_lastname = parts[0];
                form.mother_lastname = parts[1];
                form.names = parts.slice(2).join(" ");
            } else if (parts.length === 2) {
                form.father_lastname = parts[0];
                form.names = parts[1];
            } else {
                form.names = person.full_name;
            }
        }
    };

    // Consulta el DNI del cliente principal en la API.
    const validateDni = () => {
        if (dniLoading.value) return;

        if (!form.number || String(form.number).length !== 8) {
            Swal2.fire({
                title: "DNI invalido",
                text: "El DNI debe tener 8 digitos.",
                icon: "warning",
                padding: "2em",
                customClass: "sweet-alerts",
            });
            return;
        }

        dniLoading.value = true;
        dniNotice.value = "";

        axios.post(route("comm_negotiations_public_validate_dni", token), {
            dni: form.number,
        }).then((res) => {
            if (!res.data?.success) {
                // Sin datos: los campos quedan editables para escribir a mano.
                dniStatus.value = "not_found";
                dniNotice.value = res.data?.error || "No se encontro el DNI en RENIEC. Completa tus datos manualmente.";
                return;
            }

            applyReniecNames(res.data.person || {});

            // Datos cargados: los campos de nombres quedan bloqueados.
            dniStatus.value = "found";
            dniNotice.value = "";

            Swal2.fire({
                title: "DNI validado",
                text: "Tus datos fueron cargados desde RENIEC y no son editables. Si algo esta mal, vuelve a buscar por DNI.",
                icon: "success",
                padding: "2em",
                customClass: "sweet-alerts",
            });
        }).catch(() => {
            dniStatus.value = "not_found";
            dniNotice.value = "No se pudo validar el DNI en este momento. Completa tus datos manualmente.";
        }).finally(() => {
            dniLoading.value = false;
        });
    };

    // Al cambiar el DNI manualmente se limpian y re-bloquean los datos anteriores y,
    // al completar los 8 digitos, se consulta RENIEC automaticamente.
    const onNumberInput = () => {
        normalizeNumber();
        resetDniCheck();
        clearReniecNames();

        if (!isDni.value) return;

        const dni = String(form.number || "");

        if (dni.length !== 8 || dniLoading.value) return;

        validateDni();
    };

    return {
        dniStatus,
        dniLoading,
        dniValidated,
        dniLocked,
        dniNotice,
        onNumberInput,
        validateDni,
        resetDniCheck,
        markPersonVerified,
    };
}
