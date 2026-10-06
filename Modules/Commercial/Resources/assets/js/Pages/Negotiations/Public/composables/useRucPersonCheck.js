import { ref } from "vue";
import Swal2 from "sweetalert2";

/**
 * RUC del cliente principal en el formulario publico de negociacion.
 *
 * Equivalente RUC del composable de DNI/RENIEC: al consultar el RUC en SUNAT se
 * llena la razon social (y la direccion/ubicacion disponibles) y se habilita el
 * campo para que el cliente lo edite. La razon social solo se escribe cuando la
 * respuesta fue aceptada por SUNAT.
 *
 * @param {object}   options
 * @param {object}   options.form          Formulario de Inertia.
 * @param {string}   options.token         Token publico de la negociacion.
 * @param {object}   options.isRuc         Computed: el documento elegido es RUC.
 * @param {Array}    options.ubigeoOptions Ciudades (ubigeo) para intentar ubicar el
 *                                         distrito devuelto por SUNAT.
 * @param {Function} options.selectUbigeo  Aplica la ciudad resuelta ({district_id,
 *                                         ubigeo_description}) o null si no hubo match.
 */
export function useRucPersonCheck({ form, token, isRuc, ubigeoOptions, selectUbigeo }) {
    const personRucLoading = ref(false);
    const personRucValidated = ref(false);
    const personRucNotice = ref("");

    /** Descarta la validacion del RUC (cambio de documento o de numero). */
    const resetPersonRucCheck = () => {
        personRucValidated.value = false;
        personRucNotice.value = "";
    };

    const validatePersonRuc = () => {
        if (personRucLoading.value) return;

        const ruc = String(form.number || "").trim();

        if (ruc.length !== 11) {
            Swal2.fire({
                title: "RUC invalido",
                text: "El RUC debe tener 11 digitos.",
                icon: "warning",
                padding: "2em",
                customClass: "sweet-alerts",
            });
            return;
        }

        personRucLoading.value = true;
        personRucNotice.value = "";
        form.clearErrors?.(["number", "full_name"]);

        axios.post(route("comm_negotiations_public_validate_ruc", token), { ruc })
            .then((res) => {
                if (!res.data || !res.data.success) {
                    resetPersonRucCheck();
                    personRucNotice.value = res.data?.error || "No se pudo validar el RUC.";
                    return;
                }

                const person = res.data.person || {};

                form.full_name = person.razon_social || form.full_name;

                if (person.direccion && person.direccion !== "-") {
                    form.address = person.direccion;
                }

                // Ubicacion: se arma "Departamento-Provincia-Distrito" y se busca en el
                // ubigeo peruano para dejar la ciudad seleccionada; si no hay match
                // queda la descripcion y el cliente elige la ciudad.
                const description = [person.departamento, person.provincia, person.distrito]
                    .map((value) => (value ? String(value).trim() : ""))
                    .filter(Boolean)
                    .join("-");

                if (description) {
                    const match = (ubigeoOptions || []).find((item) => {
                        const label = String(item.ubigeo_description || "").trim().toUpperCase();
                        return label === description.toUpperCase();
                    }) ?? null;

                    form.ubigeo_description = match ? match.ubigeo_description : description;
                    selectUbigeo?.(match);
                }

                personRucValidated.value = true;
                personRucNotice.value = "";

                Swal2.fire({
                    title: "RUC validado",
                    text: "La razon social fue cargada desde SUNAT. Verificala antes de continuar.",
                    icon: "success",
                    padding: "2em",
                    customClass: "sweet-alerts",
                });
            })
            .catch(() => {
                resetPersonRucCheck();
                personRucNotice.value = "No se pudo validar el RUC en este momento. Intenta nuevamente.";
            })
            .finally(() => {
                personRucLoading.value = false;
            });
    };

    // Al cambiar el numero de documento se invalida la validacion anterior.
    const onPersonRucInput = () => {
        if (!isRuc.value) return;
        resetPersonRucCheck();
    };

    return {
        personRucLoading,
        personRucValidated,
        personRucNotice,
        validatePersonRuc,
        onPersonRucInput,
        resetPersonRucCheck,
    };
}
