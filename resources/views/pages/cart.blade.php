<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function cargarItemsCarritoBD() {
        let cartElement = document.getElementById('cart');
        if (cartElement) cartElement.innerHTML = "";
        
        let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
        let myIds = [];
        carrito.forEach(function(item) {
            myIds.push(parseInt(item.id));
        });

        let btnCrear = document.getElementById("btn-crear-cuenta");
        if (btnCrear) btnCrear.setAttribute("disabled", "disabled");
        
        if (myIds.length > 0) {
            realizarConsulta(myIds);
        }
    }

    function realizarConsulta(ids) {
        let token_csrf = $('meta[name="csrf-token"]').attr('content');
        if (!token_csrf) token_csrf = "{{ csrf_token() }}";

        $.ajax({
            url: "{{ route('onlineshop_get_item_carrito') }}",
            type: 'POST',
            data: { ids: ids },
            dataType: 'json',
            headers: { 'X-CSRF-TOKEN': token_csrf },
            success: function(respuesta) {
                let divCartHidden = document.getElementById("divCartHidden");
                
                respuesta.items.forEach(function(item) {
                    renderProducto(item);
                    if (divCartHidden) {
                        let inputHidden = document.createElement("input");
                        inputHidden.type = "hidden";
                        inputHidden.name = "item_id[]";
                        inputHidden.value = item.id;
                        divCartHidden.appendChild(inputHidden);
                    }
                });

                let btnCrear = document.getElementById("btn-crear-cuenta");
                if (btnCrear) btnCrear.removeAttribute("disabled");
            },
            error: function(xhr) {
                console.log('Error cargando carrito:', xhr.responseText);
            }
        });
    }

    function renderProducto(respuesta) {
        let cart = document.getElementById('cart');
        if (cart) {
            let id = respuesta.id;
            let image = respuesta.image;
            let name = respuesta.name;
            let price = respuesta.price;
            let modalidad = respuesta.additional;
            let url_descripcion_programa = "{{ url('curso-descripcion') }}/" + id;

            cart.innerHTML += `
                <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500" id="${id}_pc">
                    <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                        <div class="flex items-center space-x-4">
                            <div class="avatar">
                                <img class="rounded-full" src="${image}" alt="avatar" />
                            </div>
                            <span class="font-medium text-slate-700 dark:text-navy-100">
                                <a href="${url_descripcion_programa}" target="_blank">${name}</a>
                            </span>
                        </div>
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                        <b>${modalidad}</b>
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                        <b>S/ ${price}</b>
                    </td>
                    <td class="whitespace-nowrap px-4 py-3 text-slate-700 dark:text-navy-100 sm:px-5">
                        <button class="boton-degradado-trash" onclick="eliminarproducto({ id: ${id}, nombre: '${name}', precio: ${price} });">
                            <i class="fa fa-trash" aria-hidden="true" style="font-size: 16px;">
                                <a title="Eliminar este Curso" class="remove"></a>
                            </i>
                        </button>
                    </td>
                </tr>
            `;
        }
    }

    function confirmSubmit(event) {
        event.preventDefault();
        let carrito = JSON.parse(localStorage.getItem("carrito")) || [];
        if (carrito.length > 0) {
            event.target.form.submit();
        } else {
            alert("No has elegido ningún curso");
        }
    }

    function onSubmit(token) {
        let form = document.getElementById("CartForm");
        if(form) form.submit();
    }

    document.addEventListener("DOMContentLoaded", function() {
        cargarItemsCarritoBD();
    });
</script>