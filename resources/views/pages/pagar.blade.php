@extends('layouts.webpage')

@section('content')
    <script src="https://sdk.mercadopago.com/js/v2"></script>



    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">

        <div class="card space-y-4 p-5">
            <table class="spacing-table text-center">
                <thead>
                    <tr>
                        <th class="col-md-2"> - </th>
                        <th class="col-md-4">Producto</th>
                        <th class="col-md-2">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($products) > 0)
                        @foreach ($products as $product)
                            <tr>
                                <td class="td-img text-left">
                                    <div style="display: flex; align-items: center;">
                                        <a href="#" style="margin-right: 10px;">
                                            <img style="width: 100px;" src="{{ $product['image'] }}" alt="course_img" />
                                        </a>

                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <p>
                                            <a href="#">{{ $product['name'] }}</a><br>
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    S/ {{ $product['total'] }}
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>

        <div class="row mt-4">
            <div style="padding: 20px; background: #f8f8f8;">
                <h3>Registra tu pago</h3>
                <p>Agradecemos su preferencia por nuestros cursos. Por favor, proceda a registrar los datos del pagador para
                    confirmar la compra.</p>
                <br>
                <h4>Total:</h4>
                <p style="color: orange; font-size: 16px;"><b>S/ {{ $total }}</b></p>
            </div>
            <div id="cardPaymentBrick_container"></div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card space-y-4 p-5">
                    <h1><!-- cart page content section end -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                        @if ($preference)
                            <script>
                                const mp = new MercadoPago("{{ env('MERCADOPAGO_KEY') }}", {
                                    locale: 'es-PE'
                                });
                                const bricksBuilder = mp.bricks();
                                const renderCardPaymentBrick = async (bricksBuilder) => {
                                    const settings = {
                                        initialization: {
                                            preferenceId: "{{ $preference }}",
                                            amount: {{ $total }},
                                        },
                                        customization: {
                                            visual: {
                                                style: {
                                                    customVariables: {
                                                        theme: 'bootstrap',
                                                    }
                                                }
                                            },
                                            paymentMethods: {
                                                maxInstallments: 1,
                                            }
                                        },
                                        callbacks: {
                                            onReady: () => {
                                                // callback llamado cuando Brick esté listo
                                            },
                                            onSubmit: (cardFormData) => {
                                                //  callback llamado cuando el usuario haga clic en el botón enviar los datos
                                                //  ejemplo de envío de los datos recolectados por el Brick a su servidor
                                                let products = @json($products);
                                                return new Promise((resolve, reject) => {
                                                    cardFormData.products = products;
                                                    fetch("{{ route('web_process_payment', [$sale_id, $student_id]) }}", {
                                                            method: "PUT",
                                                            headers: {
                                                                "Content-Type": "application/json",
                                                                "X-CSRF-TOKEN": "{{ csrf_token() }}"
                                                            },
                                                            body: JSON.stringify(cardFormData)
                                                        }).then((response) => {
                                                            if (!response.ok) {
                                                                return response.json().then(error => {
                                                                    throw new Error(error.error);
                                                                });
                                                            }
                                                            return response.json();

                                                        })
                                                        .then((data) => {
                                                            if (data.status == 'approved') {
                                                                window.location.href = data.url;
                                                            } else {
                                                                alert('No se pudo continuar el proceso');
                                                                window.location.href = data.url;
                                                            }
                                                        })
                                                        .catch((error) => {
                                                            if (error instanceof SyntaxError) {
                                                                // Si hay un error de sintaxis al analizar la respuesta JSON
                                                                alert('Error al procesar el pago.');
                                                            } else {
                                                                // Mostrar la alerta con el mensaje de error devuelto por el backend
                                                                alert(error.message);
                                                            }
                                                        })
                                                });
                                            },
                                            onError: (error) => {
                                                console.log(error)
                                            },
                                        },
                                    };
                                    window.cardPaymentBrickController = await bricksBuilder.create('cardPayment',
                                        'cardPaymentBrick_container', settings);
                                };
                                renderCardPaymentBrick(bricksBuilder);
                            </script>
                        @endif
                        <br><br>
                    </h1>
                </div>
            </div>
            <div class="col-md-4"></div>
        </div>


    </main>

    <br>
    <br>
    <br>



    <div id="whatsapp">
        <a href="https://wa.link/54k2g9" class="wtsapp" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa fa-whatsapp" aria-hidden="true"></i>
        </a>
    </div>

    <style type="text/css">
        #whatsapp .wtsapp {
            position: fixed;
            transform: all .5s ease;
            background-color: #25D366;
            display: block;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            border-radius: 50px;
            border-right: none;
            color: #fff;
            font-weight: 700;
            font-size: 30px;
            bottom: 40px;
            right: 20px;
            border: 0;
            z-index: 9999;
            width: 50px;
            height: 50px;
            line-height: 50px;
        }

        #whatsapp .wtsapp:before {
            content: "";
            position: absolute;
            z-index: -1;
            left: 50%;
            top: 50%;
            transform: translateX(-50%) translateY(-50%);
            display: block;
            width: 60px;
            height: 60px;
            background-color: #25D366;
            border-radius: 50%;
            -webkit-animation: pulse-border 1500ms ease-out infinite;
            animation: pulse-border 1500ms ease-out infinite;
        }

        #whatsapp .wtsapp:focus {
            border: none;
            outline: none;
        }

        @keyframes pulse-border {
            0% {
                transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1);
                opacity: 1;
            }

            100% {
                transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1.5);
                opacity: 0;
            }
        }



        .slider {
            position: relative;
            overflow: hidden;
        }

        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }

        .slide {
            min-width: 100%;
        }
    </style>

    <script>
        // let currentIndex = 0;
        // const slides = document.querySelector('.slides');
        // const totalSlides = document.querySelectorAll('.slide').length;

        // function showNextSlide() {
        //     currentIndex = (currentIndex + 1) % totalSlides;
        //     const offset = -currentIndex * 100;
        //     slides.style.transform = `translateX(${offset}%)`;
        // }

        // setInterval(showNextSlide, 3000); // Cambia cada 3 segundos
    </script>


    <script>
        const headers = document.querySelectorAll('.accordion-header-aracode');
        headers.forEach(header => {
            header.addEventListener('click', function() {
                const content = this.nextElementSibling;
                const isVisible = content.style.maxHeight;

                // Ocultar todos los contenidos y resetear iconos
                document.querySelectorAll('.accordion-content-aracode').forEach(item => {
                    item.style.maxHeight = null;
                    item.style.padding = '0';
                    item.setAttribute('aria-hidden', 'true');
                });
                headers.forEach(h => {
                    h.classList.remove('active');
                    h.querySelector('.accordion-icon-aracode').textContent =
                        '►'; // Restablecer icono
                    h.setAttribute('aria-expanded', 'false');
                });

                // Mostrar el contenido del header clicado
                if (!isVisible) {
                    content.style.maxHeight = content.scrollHeight + "px";
                    content.style.padding = '15px';
                    this.classList.add('active'); // Añadir clase activa al encabezado clicado
                    this.querySelector('.accordion-icon-aracode').textContent =
                        '▼'; // Cambiar icono al expandido
                    this.setAttribute('aria-expanded', 'true');
                    content.setAttribute('aria-hidden', 'false');
                }
            });
        });
    </script>
    {{-- codigo de recapcha --}}
    <script type="text/javascript">
        function callbackThen(response) {

            // read HTTP status

            console.log(response.status);

            // read Promise object

            response.json().then(function(data) {

                console.log(data);

            });

        }

        function callbackCatch(error) {

            console.error('Error:', error)

        }
    </script>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        cargarItemsCarritoBD();

        function cargarItemsCarritoBD() {
            document.getElementById('cart').innerHTML =
                ""; // BORRAR contenido de la vista, antes de cargar de la base de datos
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            myIds = [];
            carrito.forEach(function(item) {
                // Hacer algo con cada elemento del carrito

                myIds.push(parseInt(item.id));
            });

            btnCrear = document.getElementById("btn-crear-cuenta");
            btnCrear.setAttribute("disabled", "disabled");
            realizarConsulta(myIds);
        }

        function realizarConsulta(ids) {
            // Realizar la petición Ajax
            var csrfToken = "{{ csrf_token() }}";


            $.ajax({
                url: "{{ route('onlineshop_get_item_carrito') }}",
                type: 'POST',
                data: {
                    ids: ids
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                success: function(respuesta) {
                    // Obtén una referencia al elemento div por su ID
                    var divCartHidden = document.getElementById("divCartHidden");

                    respuesta.items.forEach(function(item) {
                        // Accede a las propiedades del objeto
                        renderProducto(item);
                        // Crea un elemento input oculto
                        let inputHidden = document.createElement("input");
                        // Establece los atributos del input
                        inputHidden.type = "hidden";
                        inputHidden.name = "item_id[]"; // Asigna el nombre que desees
                        inputHidden.value = item.id; // Asigna el valor que desees
                        // Agrega el input al div
                        divCartHidden.appendChild(inputHidden);
                    });

                    btnCrear = document.getElementById("btn-crear-cuenta");
                    btnCrear.removeAttribute("disabled");

                },
                error: function(xhr) {
                    // Ocurrió un error al realizar la consulta
                    console.log(xhr.responseText);
                    // Aquí puedes manejar el error de alguna manera
                }
            });

        }

        function renderProducto(respuesta) {

            var cart = document.getElementById('cart');
            if (cart != null) {
                var id = respuesta.id;
                var teacher = respuesta.teacher;
                var teacher_id = respuesta.teacher_id;
                var avatar = respuesta.avatar;
                var image = respuesta.image;
                var name = respuesta.name;
                var price = respuesta.price;
                var modalidad = respuesta.additional;
                var url_campus = "";
                var url_descripcion_programa = "/descripcion-programa/" +
                    id; // esta ruta deberá corregirse si se cambia el el get de la RUTA :S

                /*
                   <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500" id="` + id + `_pc">
                                                <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                    <div class="flex items-center space-x-4">
                                                        <div class="avatar">
                                                        <img
                                                            class="rounded-full"
                                                            src="` + image + `"
                                                            alt="avatar"
                                                        />
                                                        </div>

                                                        <span class="font-medium text-slate-700 dark:text-navy-100">
                                                            <a href="`+url_descripcion_programa+`" target="_blank">` + name + `</a>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td
                                                class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                                <b>` + modalidad + `</b>
                                                </td>
                                                <td
                                                class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                                <b>S/ ` + price + `</b>
                                                </td>
                                                <td class="whitespace-nowrap px-4 py-3 text-slate-700 dark:text-navy-100 sm:px-5">
                                                    <button class="boton-degradado-trash">
                                                            <i class="fa fa-trash" aria-hidden="true" style="font-size: 16px;">
                                                                <a title="Eliminar este Curso" class="remove" onclick="eliminarproducto({ id: ` + id + `, nombre: '` +
                          name + `', precio: ` + price + ` });">X</a>
                                      </i>
                                                    </button>
                                                </td>
                                            </tr>
                    */

                cart.innerHTML += `
        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500" id="` + id + `_pc">
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                            <div class="flex items-center space-x-4">
                                                <div class="avatar">
                                                <img
                                                    class="rounded-full"
                                                    src="` + image + `"
                                                    alt="avatar"
                                                />
                                                </div>

                                                <span class="font-medium text-slate-700 dark:text-navy-100">
                                                    <a href="` + url_descripcion_programa + `" target="_blank">` +
                    name + `</a>
                                                </span>
                                            </div>
                                        </td>
                                        <td
                                        class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                        <b>` + modalidad + `</b>
                                        </td>
                                        <td
                                        class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                        <b>S/ ` + price + `</b>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 text-slate-700 dark:text-navy-100 sm:px-5">
                                            <button class="boton-degradado-trash" onclick="eliminarproducto({ id: ` +
                    id + `, nombre: '` +
                    name + `', precio: ` + price + ` });">
                                                    <i class="fa fa-trash" aria-hidden="true" style="font-size: 16px;">
                                                        <a title="Eliminar este Curso" class="remove"></a>
                              </i>
                                            </button>
                                        </td>
                                    </tr>
                    `;
            }
        }
    </script>

    <script>
        function confirmSubmit(event) {
            event.preventDefault(); // Evita que el formulario se envíe automáticamente
            carrito = JSON.parse(localStorage.getItem("carrito")) || [];
            console.log(carrito);
            if (carrito.length > 0) {
                console.log(event);
                event.target.form.submit();
            } else
                alert("No has elegido ningún curso");

        }
    </script>


    <script>
        function onSubmit(token) {
            document.getElementById("CartForm").submit();
        }
    </script>
    {!! htmlScriptTagJsApi([
        'callback_then' => 'callbackThen',
    
        'callback_catch' => 'callbackCatch',
    ]) !!}

@stop
