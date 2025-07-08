// Obtener el carrito actual del almacenamiento local
carrito = JSON.parse(localStorage.getItem("carrito")) || [];
document.addEventListener("DOMContentLoaded", function() {
    getTotal();
cargarContadorCarrito();
  });

//Tiene que hacer una consulta con los datos de la variable carrito para que llene los espacios necesarios de los cursos elegidos

function eliminarproducto(producto) {
    Swal.fire({
        title: "¿Estás seguro?",
        text:
            '¿Deseas quitar "' +
            producto.nombre +
            '" de tu Carrito de compras?',
        icon: "question",
        showCancelButton: true,
        confirmButtonText: "Sí",
        cancelButtonText: "No",
    }).then((result) => {
        if (result.isConfirmed) {
            let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
            let indice = carrito.findIndex((item) => item.id === producto.id);
            if (indice >= 0) {
                // Elimina el producto del carrito utilizando el índice
                carrito.splice(indice, 1);
                localStorage.setItem("carrito", JSON.stringify(carrito));

                //codigo que elimine el producto o curso de la vista
                // Seleccionar el elemento con el ID "1pc" el id + la cadena ya especificada en la BD ejemplo id+"pc"
                const elemento = document.getElementById(producto.id + "_pc");

                // Verificar si el elemento existe antes de eliminarlo
                if (elemento) {
                    // Eliminar el elemento y su contenido
                    elemento.remove();
                }
            }
            carrito = JSON.parse(localStorage.getItem("carrito")) || [];
            if(carrito.length<1){
                document.getElementById("btn-crear-cuenta").setAttribute("disabled", "disabled");
            }
            getTotal();
            cargarContadorCarrito();
        } else if (result.dismiss === Swal.DismissReason.cancel) {
            // Acción a realizar si el usuario hace clic en "No" o cierra el diálogo
            console.log("El usuario ha cancelado.");
        }
    });

    //Aquí el producto ya fue eliminado del localstorage y de la vista
    // ahora debería luego de que ya eliminó del localstorage "el producto o curso" verificar si está logueado y si lo está eliminar de la base de datos tambien
}

function agregarAlCarrito(producto) {
    carritoTemp = obtenerCarrito();

    var agregar = true;
    for (let i = 0; i < carritoTemp.length; i++) {
        //consulta si ya exist el artículo en el carrito
        if (carritoTemp[i].id == producto.id) {
            Swal.fire({
                title: "Estimado Usuario",
                text:
                    producto.nombre +
                    " ya se encuentra en su carrito de compras.",
                icon: "warning",
                confirmButtonText: "Aceptar",
            });

            agregar = false;
            break;
        }
    }

    if (agregar) {
        Swal.fire({
            title: "Estas a punto de Aprender",
            text: '¿Deseas agregar "' + producto.nombre + '" al Carrito?',
            icon: "success",
            showCancelButton: true,
            confirmButtonText: "Sí",
            cancelButtonText: "No",
        }).then((result) => {
            if (result.isConfirmed) {
                // Obtener el carrito actual del almacenamiento local
                let carrito = JSON.parse(localStorage.getItem("carrito")) || [];

                // Agregar el producto al carrito
                carrito.push(producto);

                // Guardar el carrito actualizado en el almacenamiento local
                localStorage.setItem("carrito", JSON.stringify(carrito));
                getTotal();
                cargarContadorCarrito();
                cargarItemsCarritoBD();
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                // Acción a realizar si el usuario hace clic en "No" o cierra el diálogo
                console.log("El usuario ha cancelado.");
            }
        }).catch((error) => {
            // Manejo de errores
            console.error("Se produjo un error al mostrar la alerta: ", error);
        });
    }
}

// Obtener el carrito actual
function obtenerCarrito() {
    return JSON.parse(localStorage.getItem("carrito")) || [];
}

function eliminarCarrito() {
    //ELiminar por completo el carrito de Compras
    localStorage.removeItem("carrito");
    getTotal();
    cargarContadorCarrito();
}

function getTotal() {
    var elemento = document.getElementById("totalid");

    if (elemento !== null) {
        // El elemento con el ID 'totalid' existe
        // Puedes realizar operaciones en el elemento aquí
        carritoTemp = JSON.parse(localStorage.getItem("carrito")) || [];
        total = 0;
        for (let i = 0; i < carritoTemp.length; i++) {
            total += carritoTemp[i].precio;
        }
        document.getElementById("totalid").textContent = "S/ " + total + ".00";
        total_productos = carritoTemp.length;
        document.getElementById("total_productos").innerHTML =
            total_productos + " programas en el carrito.";
    }
}
function cargarContadorCarrito() {
    // Obtener el carrito actual del almacenamiento local
    carrito = JSON.parse(localStorage.getItem("carrito")) || [];

    actualizarContador(carrito.length);
}
// Actualizar el valor del contador
function actualizarContador(valor) {
    try {
        // Obtener el elemento del contador
    var contadorCarritoMovil = document.getElementById("contadorCarritoMovil");
    var contadorCarritoWeb = document.getElementById("contadorCarritoWeb");

    if (valor == 0) {
        contadorCarritoMovil.setAttribute("hidden", true); // Ocultar el contador
        contadorCarritoWeb.setAttribute("hidden", true); // Ocultar el contador
    } else {
        contadorCarritoMovil.removeAttribute("hidden"); // Mostrar el contador
        contadorCarritoWeb.removeAttribute("hidden"); // Mostrar el contador
    }
    contadorCarritoMovil.innerHTML = valor;
    contadorCarritoWeb.innerHTML = valor;
    } catch (error) {
        console.log("Error al actualizar el contador del carrito: " + error);
    }
}



function actualizarCamposOcultos(tipo){
    document.getElementById("nombreCompleto-d").value = document.getElementById('nombre').value;
    document.getElementById("dni-d").value = document.getElementById('dni').value;
    if(tipo==1){ //1 es RUC!°!!!
        document.getElementById("email-d").value = document.getElementById('email-ruc').value;
    }else{
        document.getElementById("email-d").value = document.getElementById('email-dni').value;
    }
    document.getElementById("ruc-d").value = document.getElementById('ruc').value
    document.getElementById("razon-social-d").value = document.getElementById('razon-social').value;
    document.getElementById("statusRuc-d").value = document.getElementById('statusRuc').checked;
    document.getElementById("conditionRuc-d").value = document.getElementById('conditionRuc').checked;
}

function document_type(tipo){
    document.getElementById("document_type-d").value = tipo;
    if(tipo==2){ //2 es dni q es RUC
        document.getElementById("ruc-d").value = null;
        document.getElementById("razon-social-d").value = null;
        document.getElementById('razon-social').value = null;
        document.getElementById("email-ruc").value=null;
    }else{
        document.getElementById("email-dni").value=null;
        document.getElementById('nombre').value = null;
    }
}


function searchPerson(documentType, number) {
    // Validación básica de parámetros
    if (!documentType || !number) {
        console.error('Faltan parámetros requeridos');
        alert('Tipo de documento y número son requeridos');
        return;
    }

    // Mostrar carga/espera
    const searchButton = document.querySelector('#search-button');
    const originalButtonHTML = searchButton ? searchButton.innerHTML : '';

    if (searchButton) {
        searchButton.innerHTML = '<i class="fas fa-spinner fa-spin mr-2"></i> Buscando...';
        searchButton.disabled = true;
    }

    // Configurar la petición AJAX
    $.ajax({
        url: window.searchPersonRoute || '{{ route("sales_search_person_apies") }}', // Mejor práctica para rutas
        type: 'POST',
        dataType: 'json',
        data: {
            document_type: documentType,
            number: number
        },
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        success: function(response) {
            if (!response) {
                console.error('Respuesta vacía del servidor');
                return;
            }

            // Actualizar campos con la respuesta
            if (response.person) {
                // Razón Social/Nombre
                if (response.person.razonSocial) {
                    $('#razon-social').val(response.person.razonSocial).trigger('change');
                }

                // Estado (Activo)
                updateCheckboxStatus('#activo', response.person.estado, 'text-green-600', 'text-red-600');

                // Condición (Habido)
                updateCheckboxStatus('#habido', response.person.condicion, 'text-green-600', 'text-red-600');
            }
        },
        error: function(xhr, status, error) {
            console.error('Error en la búsqueda:', error, xhr.responseText);
            showErrorAlert('No se pudo obtener la información. Por favor intente nuevamente.');
        },
        complete: function() {
            // Restaurar botón a estado original
            if (searchButton) {
                searchButton.innerHTML = originalButtonHTML;
                searchButton.disabled = false;
            }
        }
    });
}

// Función auxiliar para actualizar checkboxes
function updateCheckboxStatus(selector, value, successClass, errorClass) {
    const checkbox = $(selector);
    const isChecked = value === true || value === 'true';

    checkbox.prop('checked', isChecked);

    const label = checkbox.next('label');
    label.removeClass('text-gray-700');

    if (isChecked) {
        label.addClass(successClass).removeClass(errorClass);
    } else {
        label.addClass(errorClass).removeClass(successClass);
    }
}

// Función auxiliar para mostrar errores
function showErrorAlert(message) {
    // Puedes reemplazar esto con tu sistema de notificaciones preferido
    alert(message);
}
