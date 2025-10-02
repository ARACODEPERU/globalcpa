<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Meta tags  -->
    <meta name="facebook-domain-verification" content="3qhwpfunszdc5ag3cwum3r70v123vo" />

    {{-- @php
        $parameters = new \App\Models\Parameter();
        $P000022 = $parameters->where('parameter_code', 'P000022')->value('value_default') ?? '';

        // 1. Decodificar el nivel más externo (&amp; a &)
        $cadena_decodificada_parcial = htmlspecialchars_decode($P000022, ENT_QUOTES);

        // 2. Decodificar el nivel interno (de &lt; a <, &quot; a " y &#039; a ')
        $cadena_decodificada = html_entity_decode($cadena_decodificada_parcial);
    @endphp
    {!! $cadena_decodificada !!} --}}

    @php
    $parameters = new \App\Models\Parameter();
    $P000022=$parameters->where('parameter_code', 'P000022')->value('value_default')?? "";
    $cadena_decodificada = htmlspecialchars_decode($P000022, ENT_QUOTES);
    @endphp
    {!! $cadena_decodificada !!}

    {{-- <meta name="csrf-token" content="{{ csrf_token() }}"> --}}
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0" />


    <title>Global CPA - Business School @yield('title')</title>
    <link rel="icon" type="image/png" href="{{ asset('themes/webpage/images/Logo_isotipo.png') }}" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>


    {{-- <link rel="stylesheet" href="{{ asset('themes/webpage/bootstrap-5.3.3/css/bootstrap-grid.css') }}" /> --}}
    <link rel="stylesheet" href="{{ asset('themes/webpage/bootstrap-5.3.3/css/bootstrap.css') }}" />
    <!-- CSS Assets -->
    <link rel="stylesheet" href="{{ asset('themes/webpage/css/app.css') }}" />

    <!-- Javascript Assets -->
    <!-- Carrito JS -->
    <script src="{{ asset('themes/globalcpa/carrito.js') }}" defer></script>
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

    {{-- <div id="root" class="min-h-100vh flex grow bg-slate-100 dark:bg-navy-900" x-cloak>
        @yield('content')
        <x-whatsapp />
    </div> --}}





    <div id="x-teleport-target"></div>
    <script>
        window.addEventListener("DOMContentLoaded", () => Alpine.start());
    </script>


    {{--

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}

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
    {{-- <script src="{{ asset('themes/webpage/assets/js/notify/index.js') }}"></script> --}}
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
    {{-- <script src="themes/webpage/assets/js/theme-customizer/customizer.js"></script>  --}}
    {{-- <script>new WOW().init();</script> --}}






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
    {{-- <script src="{{ asset('themes/webpage/assets/js/notify/index.js') }}"></script> --}}
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
    {{-- <script src="themes/webpage/assets/js/theme-customizer/customizer.js"></script>  --}}
    {{-- <script>new WOW().init();</script> --}}




</body>


</html>
