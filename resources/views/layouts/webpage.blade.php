<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>{{ env('APP_NAME') }} - @yield('title')</title>
        
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
        <x-header />
        <x-navbar />
        @yield('content')
        
        
        <!--========== MAIN JS ==========-->
        <script src="themes/webpage/slidebar/js/main.js"></script>
    </body>
</html>