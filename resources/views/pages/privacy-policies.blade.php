@extends('layouts.webpage')

@section('content')




    <!-- Loader starts-->
    <!-- <div class="loader-wrapper">
                                                                      <div class="loader"></div>
                                                                    </div> -->
    <!-- Loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->




    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <x-header />
        <!-- Page Header Ends-->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <x-sidebar />

            <!-- Page Sidebar Ends-->
            <div class="page-body" style="padding: 80px 0px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title_aracode" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                                POLITICAS DE PRIVACIDAD
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">

                            <div
                                class="items-center space-y-4 border-b border-slate-200 
                            p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                                <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                    Última actualización: 06/07/2025
                                </h2>
                                <p>
                                    En <b>GLOBAL CPA </b> (en adelante, "nosotros", "nuestro" o "la empresa"), valoramos tu
                                    privacidad y
                                    nos comprometemos a proteger la información personal que compartes con nosotros. Esta
                                    política de privacidad
                                    describe cómo recopilamos, usamos y protegemos tus datos personales cuando accedes a
                                    nuestros cursos en línea a
                                    través de nuestro sitio web <b>https://academy.globalcpaperu.com/</b>.
                                </p>
                                <br>
                                <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                    1. Información que Recopilamos
                                </h2>
                                <p>
                                    1.1 Información de Registro: Cuando te registras en nuestro sitio para acceder a
                                    nuestros cursos,
                                    recopilamos información básica como tu nombre, dirección de correo electrónico, número
                                    de teléfono y
                                    cualquier otra información que decidas proporcionar.
                                </p>
                                <p>
                                    1.3 Información de Navegación: Podemos recopilar automáticamente datos sobre tu
                                    interacción con nuestro sitio,
                                    como la dirección IP, el tipo de navegador, las páginas visitadas y el tiempo pasado en
                                    nuestro sitio,
                                    utilizando cookies y tecnologías similares.
                                </p>
                                <br>
                                <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                    2. Uso de la Información
                                </h2>
                                <p>
                                    2.1 Prestación de Servicios: Utilizamos la información que nos proporcionas para
                                    administrar tu cuenta,
                                    ofrecerte acceso a nuestros cursos, procesar pagos y comunicarnos contigo sobre
                                    cualquier aspecto
                                    relacionado con nuestros servicios.
                                </p>
                                <p>
                                    2.2 Mejora de los Servicios: Analizamos los datos de uso para mejorar la funcionalidad y
                                    la experiencia del usuario en nuestro sitio, así como para desarrollar nuevos productos
                                    y servicios.
                                </p>
                                <p>
                                    2.3 Marketing: Con tu consentimiento, podemos utilizar tu información de contacto para
                                    enviarte boletines informativos, promociones y actualizaciones sobre nuevos cursos y
                                    servicios que ofrecemos.
                                </p>
                                <br>
                                <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                    3. Compartir tu Información
                                </h2>
                                <p>
                                    3.1 Proveedores de Servicios: Podemos compartir tu información con terceros que prestan
                                    servicios
                                    en nuestro nombre, como procesadores de pagos, plataformas de correo electrónico y
                                    proveedores de
                                    análisis de datos. Estos terceros están obligados a proteger tu información y solo la
                                    utilizan en
                                    la medida en que sea necesario para realizar sus funciones.
                                </p>
                                <p>
                                    3.2 Cumplimiento Legal: Podemos divulgar tu información si es necesario para cumplir con
                                    la ley,
                                    responder a una orden judicial, o proteger los derechos, la propiedad o la seguridad de
                                    [Nombre de
                                    tu Empresa/Sitio Web], nuestros usuarios u otros.
                                </p>
                                <br>
                                <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                    4. Seguridad de la Información
                                </h2>
                                <p>
                                    Tomamos medidas razonables para proteger tu información personal de accesos no
                                    autorizados, uso indebido,
                                    pérdida o divulgación. Sin embargo, debes saber que ningún método de transmisión por
                                    Internet o
                                    de almacenamiento electrónico es 100% seguro.
                                </p>
                                <br>
                                <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                    5. Tus Derechos
                                </h2>
                                <p>
                                    5.1 Acceso y Rectificación: Tienes derecho a acceder a la información personal que
                                    tenemos sobre ti
                                    y a solicitar su rectificación si es incorrecta o está desactualizada.
                                </p>
                                <p>
                                    5.2 Cancelación y Oposición: Puedes solicitar la eliminación de tu información personal
                                    o limitar
                                    el uso que hacemos de ella en cualquier momento. Sin embargo, esto puede afectar nuestra
                                    capacidad
                                    para proporcionarte algunos de nuestros servicios.
                                </p>
                                <p>
                                    5.3 Retiro del Consentimiento: Si has dado tu consentimiento para que usemos tu
                                    información para
                                    fines de marketing, puedes retirarlo en cualquier momento utilizando el enlace de
                                    "cancelar suscripción"
                                    en nuestros correos electrónicos.
                                </p>
                                <br>
                                <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                    6. Cambios a Esta Política de Privacidad
                                </h2>
                                <p>
                                    Nos reservamos el derecho de actualizar esta política de privacidad en cualquier
                                    momento.
                                    Cualquier cambio será publicado en esta página y, si los cambios son significativos, te
                                    lo notificaremos
                                    a través de un aviso en nuestro sitio web o por correo electrónico.
                                </p>
                                <br>
                                <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                    7. Contacto
                                </h2>
                                <p>
                                    Si tienes preguntas o inquietudes sobre nuestra política de privacidad o el manejo de tu
                                    información personal,
                                    puedes contactarnos a través de <b> informes@globalcpaperu.com</b>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer start-->
            <x-footer />
        </div>

    </div>



    <script>
        let currentIndex = 0;
        const slides = document.querySelector('.slides');
        const totalSlides = document.querySelectorAll('.slide').length;

        function showNextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            const offset = -currentIndex * 100;
            slides.style.transform = `translateX(${offset}%)`;
        }

        setInterval(showNextSlide, 3000); // Cambia cada 3 segundos
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

@stop
