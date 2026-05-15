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
    @vite(['resources/js/webpage.js'])

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
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>CPA Academy @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('themes/webpage/images/Logo_isotipo.png') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>

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

    <!-- Plugins css Ends-->

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/vendors/bootstrap.css') }}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/style.css') }}">
    <link id="color" rel="stylesheet" href="{{ asset('themes/webpage/assets/css/color-1.css') }}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('themes/webpage/assets/css/responsive.css') }}">

    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />


    <script>
        /**
         * PREVENCIÓN DE PARPADEO Y SINCRONIZACIÓN DE MODO OSCURO
         */
        (function() {
            if (localStorage.getItem("_x_darkMode_on") === "true") {
                document.documentElement.classList.add("dark");
                // Aplicamos al body inmediatamente si ya existe, si no, lo haremos en un listener
                window.addEventListener('DOMContentLoaded', () => document.body.classList.add("dark-only"));
            }
        })();
    </script>
    @yield('etiquetasmeta')
</head>

<body>

    @yield('content')
    <x-whatsapp />

    <div id="x-teleport-target"></div>

    <!-- latest jquery-->
    <script src="{{ asset('themes/webpage/assets/js/jquery.min.js') }}"></script>
    <!-- Bootstrap js-->
    <script src="{{ asset('themes/webpage/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <!-- feather icon js-->
    <script src="{{ asset('themes/webpage/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/icons/feather-icon/feather-icon.js') }}"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
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

    <script src="{{ asset('themes/webpage/assets/js/custom-card/custom-card.js') }}"></script>
    <script src="{{ asset('themes/webpage/assets/js/notify/bootstrap-notify.min.js') }}"></script>

    {{-- Carga condicional recomendada para scripts de Datatables y Typeahead --}}
    @if (!Route::is(['course_url_slug', 'landing_preview']))
        <script src="{{ asset('themes/webpage/assets/js/datatable/datatables/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('themes/webpage/assets/js/animation/wow/wow.min.js') }}"></script>
    @endif

    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{ asset('themes/webpage/assets/js/script.js') }}"></script>

    @stack('content_after')
    @yield('javascripts')

    <script src="{{ asset('themes/webpage/assets/js/modalpage/validation-modal.js') }}"></script>
    <script src="{{ asset('themes/globalcpa/carrito.js') }}" defer></script>
    @stack('modals')

</body>


</html>
