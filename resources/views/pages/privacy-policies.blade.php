@extends('layouts.webpage')

@section('content')


    <!-- App Header Wrapper-->
    <x-nav />

    <!-- Sidebar -->
    <x-slidebar />

    <main class="main-content w-full px-[var(--margin-x)] pb-8">

        <div class="mt-5 w-full transition-all duration-[.25s] sm:mt-5 lg:mt-6">

            <div style="text-align:center;">
                <h1 class="title_aracode" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                    NUESTRA FORMACIÓN ACADÉMICA
                </h1>
            </div>

        </div>

        <div class="mt-1 grid lg:grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12 space-y-4 sm:space-y-5 lg:col-span-8 lg:space-y-6 xl:col-span-9">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12 align-self-center">
                            <div class="section-title mb-0">
                                {{-- <h2><b>POLÍTICAS DE PRIVACIDAD</b></h2> --}}
                                <h5>Última actualización: 06/07/2025</h5>
                                <p>
                                    En <b>CAPPERU</b> (en adelante, "nosotros", "nuestro" o "la empresa"), valoramos tu
                                    privacidad y
                                    nos comprometemos a proteger la información personal que compartes con nosotros. Esta
                                    política de privacidad
                                    describe cómo recopilamos, usamos y protegemos tus datos personales cuando accedes a
                                    nuestros cursos en línea a
                                    través de nuestro sitio web <b>https://capperu.com/</b>.
                                </p>
                                <br>
                                <h5>1. Información que Recopilamos</h5>
                                <p>
                                    1.1 Información de Registro: Cuando te registras en nuestro sitio para acceder a
                                    nuestros cursos,
                                    recopilamos información básica como tu nombre, dirección de correo electrónico, número
                                    de teléfono y
                                    cualquier otra información que decidas proporcionar.
                                </p>
                                <p>
                                    1.2 Información de Pago: Si realizas una compra en nuestro sitio, recopilamos
                                    información necesaria para
                                    procesar la transacción, como los detalles de tu tarjeta de crédito o débito y tu
                                    dirección de facturación.
                                    Utilizamos proveedores de servicios de pago seguros para garantizar la protección de tus
                                    datos financieros.
                                </p>
                                <p>
                                    1.3 Información de Navegación: Podemos recopilar automáticamente datos sobre tu
                                    interacción con nuestro sitio,
                                    como la dirección IP, el tipo de navegador, las páginas visitadas y el tiempo pasado en
                                    nuestro sitio,
                                    utilizando cookies y tecnologías similares.
                                </p>
                                <br>
                                <h5>2. Uso de la Información</h5>
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
                                <h5>3. Compartir tu Información</h5>
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
                                <h5>4. Seguridad de la Información</h5>
                                <p>
                                    Tomamos medidas razonables para proteger tu información personal de accesos no
                                    autorizados, uso indebido,
                                    pérdida o divulgación. Sin embargo, debes saber que ningún método de transmisión por
                                    Internet o
                                    de almacenamiento electrónico es 100% seguro.
                                </p>
                                <br>
                                <h5>5. Tus Derechos</h5>
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
                                <h5>6. Cambios a Esta Política de Privacidad</h5>
                                <p>
                                    Nos reservamos el derecho de actualizar esta política de privacidad en cualquier
                                    momento.
                                    Cualquier cambio será publicado en esta página y, si los cambios son significativos, te
                                    lo notificaremos
                                    a través de un aviso en nuestro sitio web o por correo electrónico.
                                </p>
                                <br>
                                <h5>7. Contacto</h5>
                                <p>
                                    Si tienes preguntas o inquietudes sobre nuestra política de privacidad o el manejo de tu
                                    información personal,
                                    puedes contactarnos a través de <b>capperuacademica@gmail.com</b> o <b>Sede Chimbote:
                                        Av. Francisco Boleognesi N°549 oficina 210-119</b>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <br>
        <div class="mt-4 w-full transition-all duration-[.25s] sm:mt-5 lg:mt-6">
            <x-social-networks />
        </div>

    </main>

    <br>
    <br>


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
