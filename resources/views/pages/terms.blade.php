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
                    TÉRMINOS Y CONDICIONES
                </h1>
            </div>
        </div>

        <div class="mt-1 grid lg:grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12 space-y-4 sm:space-y-5 lg:col-span-8 lg:space-y-6 xl:col-span-9">

                <div
                    class="items-center space-y-4 border-b border-slate-200 
                            p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        Última actualización: 06/07/2025
                    </h2>
                    <p>
                        Bienvenido a nuestra <b>GLOBAL CPA</b> (en adelante, "nosotros", "nuestro" o "la
                        plataforma"). A través de nuestro sitio web ofrecemos servicios de formación virtual y presencial,
                        cursos, programas de especialización, acceso a contenidos educativos y herramientas digitales de
                        aprendizaje.

                        Al acceder o utilizar nuestra plataforma, aceptas cumplir con estos términos y condiciones. Te
                        recomendamos leerlos detenidamente antes de registrarte o adquirir cualquier servicio.
                    </p>
                    <br>
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        1. Uso de la Plataforma
                    </h2>
                    <p>
                        El propósito principal de este sitio es proporcionar acceso a programas de capacitación y recursos
                        educativos. Al hacer uso de la plataforma, confirmas tu aceptación de nuestras políticas.

                        No somos responsables por daños indirectos derivados del uso o imposibilidad de uso de nuestros
                        servicios. Nos reservamos el derecho de actualizar, modificar o descontinuar cursos, precios o
                        políticas en cualquier momento. En caso de cambios significativos, se notificará a los usuarios
                        registrados a través de correo electrónico o mediante la misma plataforma.
                    </p>
                    <br>
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        2. Cuentas de Usuario
                    </h2>
                    <p>
                        Para acceder a los cursos y servicios, es necesario crear una cuenta de usuario. Es tu
                        responsabilidad:
                        <br>
                    <ul>
                        <li>* Mantener la confidencialidad de tus datos de acceso.</li>
                        <li>* Proporcionar información veraz y actualizada.</li>
                    </ul>
                    El uso indebido de la cuenta o el registro con datos falsos podrá derivar en la suspensión o
                    cancelación de la misma sin derecho a reembolso.
                    </p>
                    <br>
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        3. Acceso a Cursos y Servicios
                    </h2>
                    <p>
                        * Los cursos y programas se ofrecen en modalidad digital y/o presencial según corresponda. <br>

                        * El acceso a contenidos digitales se otorga de manera electrónica y estará disponible en tu cuenta
                        de
                        usuario dentro de los plazos establecidos. <br>

                        * No nos hacemos responsables de retrasos o interrupciones ocasionados por factores externos a
                        nuestro
                        control (fallas técnicas, problemas de conexión, etc.). <br>

                        * En caso de inconvenientes, puedes comunicarte con nuestro equipo de soporte para buscar una
                        solución.
                    </p>
                    <br>
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        4. Pagos y Cancelaciones
                    </h2>
                    <p>
                        * Los pagos realizados por cursos o programas son finales, salvo disposición contraria en las
                        políticas específicas de cada servicio. <br>

                        * Nos reservamos el derecho de cancelar inscripciones en caso de detectar irregularidades en el pago
                        o
                        incumplimiento de estos términos. Si aplica, se emitirá el reembolso correspondiente.
                    </p>
                    <br>
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        5. Enlaces a Terceros
                    </h2>
                    <p>
                        Nuestra plataforma puede contener enlaces a sitios web de terceros (por ejemplo, proveedores de
                        contenido o pasarelas de pago). No somos responsables por el contenido, prácticas o políticas de
                        dichos sitios. Recomendamos revisar sus términos y condiciones de manera independiente.
                    </p>
                    <br>
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        6. Propiedad Intelectual
                    </h2>
                    <p>
                        Todos los cursos, materiales y contenidos educativos disponibles en la plataforma son propiedad de
                        la empresa o de sus respectivos autores y están protegidos por derechos de autor. Queda prohibida su
                        reproducción, distribución o uso con fines distintos a los autorizados.
                    </p>
                    <br>
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        7. Derechos sobre los Datos Personales
                    </h2>
                    <p>
                        El manejo de tus datos personales se realiza conforme a nuestra [Política de Privacidad]. Ahí
                        encontrarás información detallada sobre cómo recopilamos, usamos, modificamos o eliminamos tus
                        datos.
                    </p>
                    <br>
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        8. Cambios en los Términos
                    </h2>
                    <p>
                        Nos reservamos el derecho de actualizar estos términos y condiciones en cualquier momento. Te
                        recomendamos revisar esta página de manera periódica.
                    </p>
                    <br>
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        9. Límite de Responsabilidad
                    </h2>
                    <p>
                        No seremos responsables por pérdidas de datos, interrupciones del servicio, ganancias perdidas u
                        otros daños derivados del uso de nuestra plataforma.
                    </p>
                    <br>
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        10. Información de Contacto
                    </h2>
                    <p>
                        Si tienes consultas sobre estos términos, puedes comunicarte con nosotros a través del formulario de
                        contacto disponible en nuestro sitio web o mediante nuestros canales oficiales de atención.
                    </p>
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
