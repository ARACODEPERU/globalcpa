@extends('layouts.webpage')

@section('content')

<style>
    /* Estilos para el Loader con Logotipo */
    .loader-wrapper {
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: #ffffff; /* Fondo blanco para que resalte el logo */
        display: flex;
        align-items: center;
        justify-content: center;
        flex-direction: column;
        z-index: 999999;
    }
    .loader-logo {
        width: 220px; /* Tamaño ajustable del logo */
        height: auto;
        animation: pulse-logo 1.5s infinite ease-in-out;
    }
    .loader-text {
        margin-top: 20px;
        font-family: 'Poppins', sans-serif;
        font-weight: 600;
        color: #002060;
        letter-spacing: 1px;
        text-transform: uppercase;
        display: flex;
        align-items: center;
    }
    .loader-text::after {
        content: '';
        animation: typing-dots 1.5s infinite;
        width: 15px; /* Espacio reservado para que el texto no se mueva */
        text-align: left;
    }
    @keyframes typing-dots {
        0%, 100% { content: ''; }
        25% { content: '.'; }
        50% { content: '..'; }
        75% { content: '...'; }
    }
    @keyframes pulse-logo {
        0% { transform: scale(0.9); opacity: 0.8; }
        50% { transform: scale(1.05); opacity: 1; }
        100% { transform: scale(0.9); opacity: 0.8; }
    }
</style>

    <!-- Loader starts-->
    <div class="loader-wrapper">
        <img src="{{ asset('themes/webpage/images/Logo_cpa_modificado.png') }}" alt="CPA Logo" class="loader-logo">
        <p class="loader-text">Cargando</p>
    </div>
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
            <div class="page-body">
                    <br><br>
                <div data-aos="fade-in">
                     <x-slider />
                </div>
                <div data-aos="fade-up"><x-courses.list-card /></div>
                <div data-aos="fade-up"><x-eleva /></div>
                <div data-aos="fade-up"><x-teachers /></div>
                <div data-aos="fade-up"><x-solutions /></div>
                <div data-aos="fade-up"><x-clients-logo /></div>
                <br>
            </div>
        </div>
        <!-- footer start-->
        <x-footer />
    </div>
@stop

@section('javascripts')
    {{-- Script de inicialización y control de carga --}}
    <script>
        $(document).ready(function() {
            // 1. Inicializar AOS si la librería está disponible
            if (window.AOS !== undefined) {
                AOS.init({
                    mirror: false,
                    duration: 800,
                    once: true
                });
            }

            // 2. Ocultar el loader y activar el contenido
            setTimeout(function() {
                $('.loader-wrapper').fadeOut('slow', function() {
                    $(this).remove(); // Eliminar del DOM para evitar interferencias
                    
                    // 3. IMPORTANTE: Refrescar AOS para que las animaciones de la página se disparen
                    if (window.AOS !== undefined) {
                        AOS.refresh();
                    }
                });
            }, 2500);
        });
    </script>
@endsection
