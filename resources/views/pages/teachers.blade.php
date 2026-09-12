@extends('layouts.webpage')

@section('content')
    {{-- Ideally, this CSS should be in the <head> of your main layout file (e.g., layouts/webpage.blade.php) --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


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
            <div class="page-body" x-data>

                <!-- Propuesta de Diseño Moderno Opción 4 (Más avatares) -->
                <div class="container-fluid mt-5">
                    <div class="card border-0 overflow-hidden shadow mb-4"
                        style="background: linear-gradient(135deg, #002060 0%, #004080 100%); border-radius: 20px;"
                        data-aos="fade-up">
                        
                        <div class="card-body p-4 p-lg-5 position-relative">
                            <div class="row align-items-center">
                                <div class="col-lg-7">
                                    <nav aria-label="breadcrumb" class="mb-3">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item">
                                                <a href="/" class="text-white-50 text-decoration-none text-uppercase small fw-bold" style="letter-spacing: 1px;">
                                                    <i class="fa fa-home me-1"></i> Inicio
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active text-white text-uppercase small fw-bold" style="letter-spacing: 1px;" aria-current="page">
                                                Docentes
                                            </li>
                                        </ol>
                                    </nav>
                                    
                                    <h1 class="display-4 fw-bold text-white mb-3">
                                        Nuestro Equipo de <span class="text-warning">Expertos</span>
                                    </h1>
                                    <p class="lead text-white-50 mb-4" style="max-width: 600px; line-height: 1.6;">
                                        Conoce a los profesionales que lideran la formación. Docentes con amplia experiencia y pasión por enseñar.
                                    </p>
                                    
                                    <div class="d-flex gap-3">
                                        <div class="d-flex align-items-center text-white-50 small">
                                            <i class="fa fa-check-circle text-success me-2"></i> Líderes en su Campo
                                        </div>
                                        <div class="d-flex align-items-center text-white-50 small">
                                            <i class="fa fa-check-circle text-success me-2"></i> Enfoque Práctico
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-5 d-none d-lg-block">
                                    <div class="teacher-avatar-cloud-4 position-relative" style="min-height: 280px;">
                                        <!-- Avatares flotantes de docentes (más cantidad) -->
                                        <img src="https://i.pravatar.cc/150?img=12" class="avatar-item item-1 shadow-lg" alt="Docente 1">
                                        <img src="https://i.pravatar.cc/150?img=28" class="avatar-item item-2 shadow" alt="Docente 2">
                                        <img src="https://i.pravatar.cc/150?img=35" class="avatar-item item-3 shadow" alt="Docente 3">
                                        <img src="https://i.pravatar.cc/150?img=45" class="avatar-item item-4 shadow" alt="Docente 4">
                                        <img src="https://i.pravatar.cc/150?img=5" class="avatar-item item-5 shadow" alt="Docente 5">
                                        <img src="https://i.pravatar.cc/150?img=52" class="avatar-item item-6 shadow" alt="Docente 6">
                                        <img src="https://i.pravatar.cc/150?img=56" class="avatar-item item-7 shadow" alt="Docente 7">
                                        <img src="https://i.pravatar.cc/150?img=68" class="avatar-item item-8 shadow" alt="Docente 8">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .teacher-avatar-cloud-4 .avatar-item {
                        position: absolute;
                        border-radius: 50%;
                        border: 3px solid rgba(255, 255, 255, 0.5);
                        animation: float-avatars-4 6s ease-in-out infinite;
                    }
                    .teacher-avatar-cloud-4 .item-1 { width: 110px; height: 110px; top: 50%; left: 50%; z-index: 5; animation-name: float-avatars-center-4; animation-duration: 5s; }
                    .teacher-avatar-cloud-4 .item-2 { width: 70px; height: 70px; top: 10%; left: 25%; animation-delay: -1s; }
                    .teacher-avatar-cloud-4 .item-3 { width: 80px; height: 80px; top: 20%; left: 75%; animation-delay: -2.5s; animation-duration: 7s; }
                    .teacher-avatar-cloud-4 .item-4 { width: 60px; height: 60px; top: 70%; left: 15%; animation-delay: -4s; }
                    .teacher-avatar-cloud-4 .item-5 { width: 90px; height: 90px; top: 65%; left: 65%; animation-delay: -0.5s; animation-duration: 8s; }
                    .teacher-avatar-cloud-4 .item-6 { width: 55px; height: 55px; top: 5%; left: 5%; animation-delay: -2s; animation-duration: 6.5s; }
                    .teacher-avatar-cloud-4 .item-7 { width: 75px; height: 75px; top: 80%; left: 90%; animation-delay: -3s; animation-duration: 7.5s; }
                    .teacher-avatar-cloud-4 .item-8 { width: 65px; height: 65px; top: 15%; left: 95%; animation-delay: -5s; animation-duration: 6s; }

                    @keyframes float-avatars-4 {
                        0%, 100% { transform: translateY(0px) rotate(5deg); }
                        50% { transform: translateY(-15px) rotate(-5deg); }
                    }
                    @keyframes float-avatars-center-4 {
                        0%, 100% { transform: translate(-50%, -50%) translateY(0px) rotate(5deg); }
                        50% { transform: translate(-50%, -50%) translateY(-15px) rotate(-5deg); }
                    }
                </style>

                <div data-aos="fade-up"><x-teachers-all /></div>

            </div>
        </div>
        <!-- footer start-->
        <x-footer />
    </div>




    {{-- Ideally, this JS should be at the end of your <body> in the main layout file --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            mirror: true, // This makes animations trigger on scroll up as well
            duration: 800, // Animation duration
            once: false // Ensures animation happens every time you scroll to it
        });
    </script>



@stop
