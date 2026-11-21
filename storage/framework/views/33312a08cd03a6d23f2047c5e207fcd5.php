<?php $__env->startSection('content'); ?>
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <!-- App Header Wrapper-->
    <?php if (isset($component)) { $__componentOriginal3d4e3f5369e04c2cf115b9f764b9480e = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal3d4e3f5369e04c2cf115b9f764b9480e = $attributes; } ?>
<?php $component = App\View\Components\Nav::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('nav'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Nav::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal3d4e3f5369e04c2cf115b9f764b9480e)): ?>
<?php $attributes = $__attributesOriginal3d4e3f5369e04c2cf115b9f764b9480e; ?>
<?php unset($__attributesOriginal3d4e3f5369e04c2cf115b9f764b9480e); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal3d4e3f5369e04c2cf115b9f764b9480e)): ?>
<?php $component = $__componentOriginal3d4e3f5369e04c2cf115b9f764b9480e; ?>
<?php unset($__componentOriginal3d4e3f5369e04c2cf115b9f764b9480e); ?>
<?php endif; ?>

    <!-- Sidebar -->
    <?php if (isset($component)) { $__componentOriginalc60bdca5d23c5e7086af350679f705d6 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalc60bdca5d23c5e7086af350679f705d6 = $attributes; } ?>
<?php $component = App\View\Components\Slidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('slidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Slidebar::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalc60bdca5d23c5e7086af350679f705d6)): ?>
<?php $attributes = $__attributesOriginalc60bdca5d23c5e7086af350679f705d6; ?>
<?php unset($__attributesOriginalc60bdca5d23c5e7086af350679f705d6); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalc60bdca5d23c5e7086af350679f705d6)): ?>
<?php $component = $__componentOriginalc60bdca5d23c5e7086af350679f705d6; ?>
<?php unset($__componentOriginalc60bdca5d23c5e7086af350679f705d6); ?>
<?php endif; ?>

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
                    <?php if(count($products) > 0): ?>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <td class="td-img text-left">
                                    <div style="display: flex; align-items: center;">
                                        <a href="#" style="margin-right: 10px;">
                                            <img loading="lazy" decoding="async" style="width: 100px;" src="<?php echo e($product['image']); ?>" alt="course_img" />
                                        </a>

                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <p>
                                            <a href="#"><?php echo e($product['name']); ?></a><br>
                                        </p>
                                    </div>
                                </td>
                                <td>
                                    S/ <?php echo e($product['total']); ?>

                                </td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>
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
                <p style="color: orange; font-size: 16px;"><b>S/ <?php echo e($total); ?></b></p>
            </div>
            <div id="cardPaymentBrick_container"></div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4"></div>
            <div class="col-md-4">
                <div class="card space-y-4 p-5">
                    <h1><!-- cart page content section end -->
                        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

                        <?php if($preference): ?>
                            <script>
                                const mp = new MercadoPago("<?php echo e(config('services.mercadopago.key')); ?>", {
                                    locale: 'es-PE'
                                });
                                const bricksBuilder = mp.bricks();
                                const renderCardPaymentBrick = async (bricksBuilder) => {
                                    const settings = {
                                        initialization: {
                                            preferenceId: "<?php echo e($preference); ?>",
                                            amount: <?php echo e($total); ?>,
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
                                                maxInstallments: <?php echo e(config('services.mercadopago.max_installments')); ?>,
                                            }
                                        },
                                        callbacks: {
                                            onReady: () => {
                                                // callback llamado cuando Brick esté listo
                                            },
                                            onSubmit: (cardFormData) => {
                                                //  callback llamado cuando el usuario haga clic en el botón enviar los datos
                                                //  ejemplo de envío de los datos recolectados por el Brick a su servidor
                                                let products = <?php echo json_encode($products, 15, 512) ?>;
                                                return new Promise((resolve, reject) => {
                                                    cardFormData.products = products;
                                                    const personInvoice = <?php echo json_encode($personInvoice ?? null, 15, 512) ?>;
                                                    fetch("<?php echo e(route('web_process_payment', [$sale_id, $student_id])); ?>", {
                                                            method: "PUT",
                                                            headers: {
                                                                "Content-Type": "application/json",
                                                                "X-CSRF-TOKEN": "<?php echo e(csrf_token()); ?>"
                                                            },
                                                            body: JSON.stringify({ // Envía un único objeto con ambos datos
                                                                                    cardFormData: cardFormData,
                                                                                    personInvoice: personInvoice
                                                                                })
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
                        <?php endif; ?>
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

    <script>
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
            var csrfToken = "<?php echo e(csrf_token()); ?>";


            $.ajax({
                url: "<?php echo e(route('onlineshop_get_item_carrito')); ?>",
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

                cart.innerHTML += `
        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500" id="` + id + `_pc">
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                            <div class="flex items-center space-x-4">
                                                <div class="avatar">
                                                <img loading="lazy" decoding="async"
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
    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo e(env('RECAPTCHA_SITE_KEY')); ?>"></script>
    <script>
        function callbackThen(response) {
            // Tu lógica existente para éxito
            console.log("Token generado:", response);
        }

        function callbackCatch(error) {
            // Tu lógica existente para error
            console.error("Error en reCAPTCHA:", error);
        }

        // Esta es la función que llama tu formulario
        function onSubmit(e) {
            if (e) e.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute("<?php echo e(env('RECAPTCHA_SITE_KEY')); ?>", {action: 'submit'}).then(function(token) {
                    // Añadimos el token al formulario y lo enviamos
                    let form = document.getElementById("CartForm");
                    let input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'g-recaptcha-response';
                    input.value = token;
                    form.appendChild(input);
                    form.submit();
                });
            });
        }
    </script>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.webpage', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\globalcpa\resources\views\pages\pagar.blade.php ENDPATH**/ ?>