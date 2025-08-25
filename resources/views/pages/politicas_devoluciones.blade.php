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
                    POLITICAS DE DEVOLUCIONES
                </h1>
            </div>
        </div>

        <div class="mt-1 grid lg:grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12 space-y-4 sm:space-y-5 lg:col-span-8 lg:space-y-6 xl:col-span-9">

                <div
                    class="items-center space-y-4 border-b border-slate-200
                            p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                        Última actualización: 21/08/2025
                    </h2>
                    <h1 style="color: #1a1a1a; border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-top: 25px;">Política de Devoluciones - Global CPA</h1>

                    <div class="section">
                        <h2 style="color: #1a1a1a; border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-top: 25px;">1. Derecho de desistimiento</h2>
                        <p style="margin-bottom: 10px;">El usuario podrá ejercer su derecho de desistimiento dentro de los <strong>7 días calendario</strong> posteriores a la compra, siempre que el curso no haya iniciado.</p>
                        <p style="margin-bottom: 10px;">En este caso, se realizará la devolución íntegra del monto pagado, utilizando el mismo medio de pago empleado en la transacción.</p>
                    </div>

                    <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

                    <div class="section">
                        <h2 style="color: #1a1a1a; border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-top: 25px;">2. Cursos ya iniciados</h2>
                        <p style="margin-bottom: 10px;">Una vez iniciado el curso o si el usuario ha accedido a los materiales digitales, no procederá la devolución, salvo en casos de cancelación o reprogramación atribuibles a Global CPA.</p>
                    </div>

                    <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

                    <div class="section">
                        <h2 style="color: #1a1a1a; border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-top: 25px;">3. Cancelación o reprogramación del curso</h2>
                        <p style="margin-bottom: 10px;">Si por causas de fuerza mayor o decisión institucional el curso no pudiera dictarse en la fecha programada, Global CPA ofrecerá al usuario:</p>
                        <ul style="margin-top: 5px; margin-bottom: 15px; padding-left: 25px;">
                            <li style="margin-bottom: 5px;">La reprogramación del curso en nuevas fechas, o</li>
                            <li style="margin-bottom: 5px;">La devolución del monto abonado en un plazo máximo de <strong>15 días hábiles</strong>.</li>
                        </ul>
                    </div>

                    <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

                    <div class="section">
                        <h2 style="color: #1a1a1a; border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-top: 25px;">4. Procedimiento para solicitar devoluciones</h2>
                        <p style="margin-bottom: 10px;">El usuario deberá enviar su solicitud al correo <strong><a href="mailto:jsuclupe@globalcpaperu.com">jsuclupe@globalcpaperu.com</a></strong>, indicando sus datos personales, comprobante de pago y motivo de la solicitud.</p>
                        <p style="margin-bottom: 10px;">El área administrativa evaluará el caso y dará respuesta en un plazo máximo de <strong>5 días hábiles</strong>.</p>
                    </div>

                    <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

                    <div class="section">
                        <h2 style="color: #1a1a1a; border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-top: 25px;">5. Medios de reembolso</h2>
                        <p style="margin-bottom: 10px;">El reembolso se realizará únicamente a través del mismo medio de pago utilizado en la compra (tarjeta de crédito, débito u otro medio electrónico).</p>
                    </div>

                    <hr style="border: 0; border-top: 1px solid #eee; margin: 20px 0;">

                    <div class="section">
                        <h2 style="color: #1a1a1a; border-bottom: 2px solid #ddd; padding-bottom: 5px; margin-top: 25px;">6. Contacto</h2>
                        <p style="margin-bottom: 10px;">Para consultas, reclamos o soporte, puede contactarnos a través de:</p>
                        <ul style="margin-top: 5px; margin-bottom: 15px; padding-left: 25px;">
                            <li style="margin-bottom: 5px;"><strong>Correo:</strong> <a href="mailto:capacitacion@globalcpaperu.com">capacitacion@globalcpaperu.com</a></li>
                            <li style="margin-bottom: 5px;"><strong>Teléfono:</strong> <a href="tel:+51967052506">+51 967 052 506</a></li>
                            <li style="margin-bottom: 5px;"><strong>Web:</strong> <a href="https://academy.globalcpaperu.com" target="_blank">https://academy.globalcpaperu.com</a></li>
                        </ul>
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
