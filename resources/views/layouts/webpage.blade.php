<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ env('APP_NAME') }} - @yield('title')</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        
            <!--========== BOX ICONS ==========-->
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">

            <!--========== CSS ==========-->
            <link rel="stylesheet" href="themes/webpage/slidebar/css/styles.css">

            <style>
                /* Estilo para el enlace sin atributo href */
                a:not([href]) {
                    cursor: pointer; /* Cambia el cursor a una mano */
                }
            </style>
        <!--=============== REMIXICONS ===============-->
    </head>
    <body>
        <img src="{{ asset('themes/webpage/bannerTop.jpg') }}" alt="" style="width: 100%; top:0pc;">
        <x-header />
        <x-navbar />
        @yield('content')
        
        
        <!--========== MAIN JS ==========-->
        <script src="themes/webpage/slidebar/js/main.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>