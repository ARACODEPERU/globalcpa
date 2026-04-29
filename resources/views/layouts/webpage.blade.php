<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Meta tags  -->
    <meta name="facebook-domain-verification" content="3qhwpfunszdc5ag3cwum3r70v123vo" />




    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-WXX1QVD5Y0"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-WXX1QVD5Y0');
    </script>


    <!-- Meta Pixel Code -->

    @vite(['resources/js/app.js'])

    <script>
        ! function(f, b, e, v, n, t, s) {
            if (f.fbq) return;
            n = f.fbq = function() {
                n.callMethod ?
                    n.callMethod.apply(n, arguments) : n.queue.push(arguments)
            };
            if (!f._fbq) f._fbq = n;
            n.push = n;
            n.loaded = !0;
            n.version = '2.0';
            n.queue = [];
            t = b.createElement(e);
            t.async = !0;
            t.src = v;
            s = b.getElementsByTagName(e)[0];
            s.parentNode.insertBefore(t, s)
        }(window, document, 'script',
            'https://connect.facebook.net/en_US/fbevents.js');
        fbq('init', '791233956872790');
        fbq('track', 'PageView');
    </script>
    <noscript><img height="1" width="1" style="display:none"
            src="https://www.facebook.com/tr?id=791233956872790&ev=PageView&noscript=1" /></noscript>
    <!-- End Meta Pixel Code -->




    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />


    <title>CPA Academy @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('themes/webpage/images/Logo_isotipo.png') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    <link rel="stylesheet" href="{{ asset('themes/webpage/bootstrap-5.3.3/css/bootstrap.css') }}" />
    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('themes/webpage/css/app.css') }}" />

    <!-- Javascript Assets -->
    <!-- Carrito JS -->
    <script src="{{ asset('themes/webpage/js/app.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap"
        rel="stylesheet" />


    <link rel="stylesheet" href="{{ asset('themes/webpage/font-awesome-4.7.0/css/font-awesome.min.css') }}">













    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/vendors/themify.css') }}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/vendors/flag-icon.css') }}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/vendors/feather-icon.css') }}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/vendors/slick.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/vendors/slick-theme.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/vendors/animate.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/vendors/datatables.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('themes/webpage/assets/css/vendors/datatable/select.dataTables.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/vendors/prism.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/vendors/vector-map.css') }}">
    <!-- Plugins css Ends-->

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('themes/webpage/assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/responsive.css') }}">




    {{-- ARACODE --}}
    <link rel="stylesheet" href="{{ asset('themes/webpage/css/aracode.css') }}" />



    {{-- Ideally, this CSS should be in the <head> of your main layout file (e.g., layouts/webpage.blade.php) --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .transition-all {
            transition: all 0.3s ease-in-out !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease !important;
        }

        .transition-all:hover {
            transform: translateY(-12px);
            box-shadow: 0 15px 30px rgba(0, 32, 96, 0.15) !important;
            box-shadow: 0 15px 30px rgba(0, 32, 96, 0.15);
            border-color: #ffc107 !important;
            /* Un sutil borde dorado al resaltar */
        }

        /* Estilos del Carrusel Infinito */
        .carousel-viewport {
            overflow: hidden;
            padding: 100px 0 50px 0;
            /* Espacio para que las imágenes y sombras no se corten */
            position: relative;
            width: 100%;
        }

        .carousel-track {
            display: flex;
            gap: 30px;
            width: max-content;
            animation: scroll-infinite 40s linear infinite;
        }

        .carousel-track:hover {
            animation-play-state: paused;
        }

        @keyframes scroll-infinite {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-50%));
            }
        }

        .teacher-carousel-item {
            width: 300px;
            flex-shrink: 0;
        }

        /* Estilos para FAQ Moderna */
        .faq-modern .accordion-item {
            border: 1px solid #edf2f7 !important;
            margin-bottom: 1rem;
            border-radius: 15px !important;
            overflow: hidden;
            transition: all 0.3s ease;
            /* background: #ffffff; */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background: #ffffff;
        }

        .faq-modern .accordion-item:has(.show) {
            border-color: #002060 !important;
            box-shadow: 0 15px 30px rgba(0, 32, 96, 0.08);
        }

        .faq-modern .accordion-button {
            padding: 1.5rem;
            font-weight: 600;
            /* background-color: white !important; */
            background-color: white !important;
            color: #002060;
            font-size: 1.05rem;
        }

        .faq-modern .accordion-button:focus {
            box-shadow: none;
            box-shadow: none !important;
            border-color: transparent;
        }

        .faq-modern .accordion-button:not(.collapsed) {
            background-color: rgba(0, 32, 96, 0.02) !important;
            color: #002060;
            border-bottom: 1px solid #f1f5f9;
        }

        .faq-modern .accordion-button:not(.collapsed) {
            color: #002060;
            box-shadow: none;
        }

        .faq-modern .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23002060'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
            transition: transform 0.3s ease;
        }

        /* Ajustes para Select2 y flags SVG */
        .select2-container--default .select2-selection--single {
            border: 1px solid #dee2e6 !important;
            border-left: 0 !important;
            height: 38px !important;
            display: flex;
            align-items: center;
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-selection__arrow {
            top: 6px !important;
        }

        /* Botones Modernos UX */
        .btn-modern {
            padding: 12px 28px;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50px !important;
        }

        .btn-modern-primary {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
            color: #002060 !important;
            border: none;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }

        .btn-modern-primary:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.5);
        }

        .btn-modern-outline {
            background: transparent;
            color: #002060 !important;
            border: 2px solid #002060 !important;
        }

        .btn-modern-outline:hover {
            background: #002060 !important;
            color: #ffffff !important;
            transform: translateY(-2px);
        }
    </style>





















    



    <script>
        /**
         * THIS SCRIPT REQUIRED FOR PREVENT FLICKERING IN SOME BROWSERS
         */
        localStorage.getItem("_x_darkMode_on") === "true" &&
            document.documentElement.classList.add("dark");
    </script>
    @yield('etiquetasmeta')
</head>

<body>

    @yield('content')
    <x-whatsapp />




    <div id="x-teleport-target"></div>
    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>

    <script src="{{ asset('themes/webpage/bootstrap-5.3.3/js/bootstrap.js') }}"></script>



    <!-- latest jquery-->
    <script src="{{ asset('themes/webpage/assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('themes/webpage/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('themes/webpage/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <!-- scrollbar js-->
    <script src="{{ asset('themes/webpage/assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/scrollbar/custom.js') }}"></script>
    <!-- Sidebar jquery-->
    <script src="{{ asset('themes/webpage/assets/js/config.js') }}"></script>
    <!-- Plugins JS start-->
    <script src="{{ asset('themes/webpage/assets/js/sidebar-menu.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/slick/slick.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/header-slick.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/prism/prism.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/clipboard/clipboard.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/custom-card/custom-card.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/notify/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/vector-map/jquery-jvectormap-2.0.2.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/vector-map/map/jquery-jvectormap-world-mill-en.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/vector-map/map/jquery-jvectormap-us-aea-en.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/vector-map/map/jquery-jvectormap-uk-mill-en.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/vector-map/map/jquery-jvectormap-au-mill.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/vector-map/map/jquery-jvectormap-chicago-mill-en.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/vector-map/map/jquery-jvectormap-in-mill.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/vector-map/map/jquery-jvectormap-asia-mill.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/datatable/datatables/datatable.custom.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/datatable/datatables/dataTables.select.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/typeahead/handlebars.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/typeahead/typeahead.bundle.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/typeahead/typeahead.custom.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/typeahead-search/handlebars.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/typeahead-search/typeahead-custom.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/animation/wow/wow.min.js') }}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('themes/webpage/assets/js/script.js') }}"></script>


    @yield('javascripts')

    <script src="{{ asset('themes/webpage/assets/js/modalpage/validation-modal.js') }}"></script>

    <script>
        var myModal = document.getElementById('myModal')
        var myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', function() {
            myInput.focus()
        })
    </script>

<script src="{{ asset('themes/globalcpa/carrito.js') }}" defer></script>
    @stack('modals')

    <!-- Scripts Globales Comunes (Slider y Acordeón) -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Lógica del Slider
            const slides = document.querySelector('.slides');
            if (slides) {
                let currentIndex = 0;
                const totalSlides = document.querySelectorAll('.slide').length;

                function showNextSlide() {
                    currentIndex = (currentIndex + 1) % totalSlides;
                    const offset = -currentIndex * 100;
                    slides.style.transform = `translateX(${offset}%)`;
                }
                setInterval(showNextSlide, 3000);
            }

            // Lógica del Acordeón
            const headers = document.querySelectorAll('.accordion-header-aracode');
            if (headers.length > 0) {
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
                            const icon = h.querySelector('.accordion-icon-aracode');
                            if(icon) icon.textContent = '►';
                            h.setAttribute('aria-expanded', 'false');
                        });

                        // Mostrar el contenido del header clicado
                        if (!isVisible) {
                            content.style.maxHeight = content.scrollHeight + "px";
                            content.style.padding = '15px';
                            this.classList.add('active');
                            const icon = this.querySelector('.accordion-icon-aracode');
                            if(icon) icon.textContent = '▼';
                            this.setAttribute('aria-expanded', 'true');
                            content.setAttribute('aria-hidden', 'false');
                        }
                    });
                });
            }
        });
    </script>
</body>


</html>
