@extends('layouts.webpage')

@section('content')
    {{-- Ideally, this CSS should be in the <head> of your main layout file (e.g., layouts/webpage.blade.php) --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">

    <style>
        .transition-all {
            transition: all 0.3s ease-in-out !important;
        }

        .transition-all:hover {
            transform: translateY(-12px);
            box-shadow: 0 15px 30px rgba(0, 32, 96, 0.15) !important;
            border-color: #ffc107 !important;
            /* Un sutil borde dorado al resaltar */
        }

        /* Estilos del Carrusel Infinito */
        .carousel-viewport {
            overflow: hidden;
            padding: 100px 0 50px 0; /* Espacio para que las imágenes y sombras no se corten */
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
            0% { transform: translateX(0); }
            100% { transform: translateX(calc(-50%)); }
        }

        .teacher-carousel-item {
            width: 300px;
            flex-shrink: 0;
        }

        /* Estilos para FAQ Moderna */
        .faq-modern .accordion-item {
            border: 1px solid #e9ecef !important;
            margin-bottom: 1.5rem;
            border-radius: 12px !important;
            overflow: hidden;
            transition: all 0.3s ease;
        }
        .faq-modern .accordion-item:has(.show) {
            border-color: #002060 !important;
            box-shadow: 0 10px 25px rgba(0,32,96,0.1);
        }
        .faq-modern .accordion-button {
            padding: 1.5rem;
            font-weight: 600;
            background-color: white !important;
            color: #002060;
        }
        .faq-modern .accordion-button:not(.collapsed) {
            color: #002060;
            box-shadow: none;
        }
        .faq-modern .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23002060'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
            transition: transform 0.3s ease;
        }
    </style>

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

                <div class="container-fluid mt-4">
                    {{-- Hero Section --}}
                    <div class="card border-0 overflow-hidden shadow mb-4"
                        style="background: linear-gradient(135deg, #002060 0%, #004080 100%); border-radius: 15px;"
                        data-aos="fade-in">
                        <div class="card-body p-4 p-lg-5 text-white">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="badge bg-warning text-dark me-2">Texto</span>
                                        <div class="text-warning small">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>

                                            <span class="text-white ms-1">(4.8/5 de {{ rand(30, 120) }} alumnos
                                                activos)</span>
                                        </div>
                                    </div>
                                    <h1 class="display-5 fw-bold mb-3" style="color: #fff;">Especialización en Inteligencia
                                        Artificial aplicada a la Contabilidad y Finanzas</h1>

                                    <div class="d-flex align-items-center text-white-50">
                                        <span class="me-3"><i class="fa fa-clock-o me-1"></i>
                                            Inicio: 17 abril | Duración: 3 meses | Modalidad: En vivo</span>
                                        <span><i class="fa fa-globe me-1"></i> Español</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-center d-none d-lg-block position-relative"
                                    style="min-height: 250px;">
                                    <img src="{{ asset('themes/molde.jpeg') }}"
                                        alt="Especialización en IA para Contabilidad" class="img-fluid"
                                        style="max-height: 250px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="container-fluid card aos-animate" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body p-4 p-lg-5">
                                <div class="mb-4">
                                    <span class="badge rounded-pill bg-light text-primary px-3 py-2 mb-3 shadow-sm border"
                                        style="color: #002060 !important;">
                                        <i class="fa fa-refresh me-1"></i> ACTUALIZACIÓN PROFESIONAL
                                    </span>
                                    <h2 class="fw-bold display-6" style="color: #002060;">Lidera la era de la Contabilidad
                                        Inteligente</h2>
                                    <p class="text-muted fs-5">No solo aprendas a usar herramientas; domina la estrategia
                                        detrás de la Inteligencia Artificial para convertirte en un asesor financiero de
                                        alto valor.</p>
                                </div>

                                <div class="row g-4 mt-2">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 bg-warning-light p-3 rounded-circle me-3"
                                                style="background-color: rgba(255, 193, 7, 0.1);">
                                                <i class="fa fa-line-chart text-warning fs-4"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-0 fw-bold" style="color: #002060;">Eficiencia</h5>
                                                <small class="text-muted">Automatiza tareas repetitivas.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 bg-info-light p-3 rounded-circle me-3"
                                                style="background-color: rgba(0, 204, 255, 0.1);">
                                                <i class="fa fa-database text-info fs-4"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-0 fw-bold" style="color: #002060;">Data Driven</h5>
                                                <small class="text-muted">Análisis predictivo financiero.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body p-4 p-lg-5">
                                <div class="mb-4">
                                    <h2 class="fw-bold" style="color: #002060;">¿Listo para empezar?</h2>
                                    <p class="text-muted">Completa tus datos para descargar el brochure detallado y recibir
                                        información sobre promociones exclusivas del programa.</p>
                                </div>

                                <form id="pageContactForm">
                                    @csrf
                                    <input type="hidden" name="subject" value="Solicitud de Brochure - Especialización IA">
                                    <input type="hidden" name="message"
                                        value="El usuario ha solicitado el temario desde la landing de Academy.">

                                    <div class="mb-3">
                                        <label class="form-label fw-bold" style="color: #002060;">Nombres y
                                            Apellidos</label>
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-white border-end-0"><i
                                                    class="fa fa-user text-muted"></i></span>
                                            <input type="text" name="full_name" class="form-control border-start-0 ps-0"
                                                placeholder="Ingresa tu nombre completo" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold" style="color: #002060;">WhatsApp</label>
                                            <div class="input-group shadow-sm">
                                                <span class="input-group-text bg-white border-end-0"><i
                                                        class="fa fa-whatsapp text-muted"></i></span>
                                                <input type="text" name="phone"
                                                    class="form-control border-start-0 ps-0" placeholder="Ej: 999 888 777"
                                                    required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold" style="color: #002060;">Correo
                                                Electrónico</label>
                                            <div class="input-group shadow-sm">
                                                <span class="input-group-text bg-white border-end-0"><i
                                                        class="fa fa-envelope text-muted"></i></span>
                                                <input type="email" name="email"
                                                    class="form-control border-start-0 ps-0"
                                                    placeholder="ejemplo@correo.com" required>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button type="submit" id="submitPageContactButton"
                                            class="btn btn-warning btn-lg w-100 fw-bold shadow-sm py-3"
                                            style="color: #002060; border-radius: 12px; transition: all 0.3s ease;">
                                            <i class="fa fa-file-pdf-o me-2"></i> DESCARGAR BROCHURE
                                        </button>
                                    </div>
                                    <div id="messagePageContact" class="mt-3"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="container-fluid card aos-animate" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body p-4 p-lg-5">
                                <div class="text-center mb-5">
                                    <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                                        style="background-color: rgba(220, 53, 69, 0.1); color: #dc3545;">
                                        <i class="fa fa-exclamation-triangle me-1"></i> EL PROBLEMA
                                    </span>
                                    <h2 class="fw-bold display-6" style="color: #002060;">Tu equipo está saturado y
                                        pierdes ventas todos los días</h2>
                                    <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">No es solo traer tráfico,
                                        es atender rápido sin multiplicar tu equipo.</p>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                                        <div
                                            class="h-100 p-4 rounded-4 border shadow-sm text-center bg-white transition-all">
                                            <div class="mb-4">
                                                <i class="fa fa-clock-o text-warning" style="font-size: 3.5rem;"></i>
                                            </div>
                                            <h4 class="fw-bold mb-3" style="color: #002060;">No ofreces atención 24/7</h4>
                                            <p class="text-muted mb-0">en canales como WhatsApp e Instagram y eso te hace
                                                perder ventas todos los días</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                                        <div
                                            class="h-100 p-4 rounded-4 border shadow-sm text-center bg-white transition-all">
                                            <div class="mb-4">
                                                <i class="fa fa-users text-warning" style="font-size: 3.5rem;"></i>
                                            </div>
                                            <h4 class="fw-bold mb-3" style="color: #002060;">Equipo saturado en post-venta
                                            </h4>
                                            <p class="text-muted mb-0">y eso consume el 70% de su tiempo</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                                        <div
                                            class="h-100 p-4 rounded-4 border shadow-sm text-center bg-white transition-all">
                                            <div class="mb-4">
                                                <i class="fa fa-commenting-o text-warning" style="font-size: 3.5rem;"></i>
                                            </div>
                                            <h4 class="fw-bold mb-3" style="color: #002060;">Tu Chatbot no vende</h4>
                                            <p class="text-muted mb-0">Chatbots básicos que responden, pero no convierten
                                                ni miden impacto.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container-fluid card aos-animate" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body p-4 p-lg-5">
                                <!-- Header de Sección -->
                                <div class="text-center mb-5">
                                    <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                                        style="background-color: rgba(0, 32, 96, 0.1); color: #002060;">
                                        <i class="fa fa-list-ul me-1"></i> PLAN DE ESTUDIOS
                                    </span>
                                    <h2 class="fw-bold display-6" style="color: #002060;">Lo que vas a aprender</h2>
                                    <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">Un temario diseñado para
                                        transformar tu perfil profesional con habilidades prácticas y de alta demanda.</p>
                                </div>

                                <div class="row align-items-center">
                                    <!-- Columna de Imagen -->
                                    <div class="col-lg-5 mb-4 mb-lg-0" data-aos="fade-right">
                                        <div class="position-relative">
                                            <img src="https://images.unsplash.com/photo-1591453089816-0fbb971b454c?q=80&w=2070&auto=format&fit=crop"
                                                alt="Temario Especializado" class="img-fluid rounded-4 shadow-lg"
                                                style="border: 8px solid #f8f9fa;">
                                            <div
                                                class="position-absolute bottom-0 start-0 m-3 p-3 bg-warning rounded-3 shadow d-none d-sm-block">
                                                <span class="fw-bold text-dark">Módulos 100% Actualizados</span>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Columna de Temas -->
                                    <div class="col-lg-7" data-aos="fade-left">
                                        <div class="ps-lg-4">
                                            <div class="d-flex mb-4">
                                                <div class="flex-shrink-0">
                                                    <span
                                                        class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center shadow"
                                                        style="width: 45px; height: 45px; background-color: #002060 !important; font-size: 1.1rem;">1</span>
                                                </div>
                                                <div class="ms-3">
                                                    <h5 class="fw-bold" style="color: #002060;">Fundamentos de IA y Prompt
                                                        Engineering</h5>
                                                    <p class="text-muted">Domina el arte de comunicarte con modelos de
                                                        lenguaje para generar análisis técnicos precisos.</p>
                                                </div>
                                            </div>

                                            <div class="d-flex mb-4">
                                                <div class="flex-shrink-0">
                                                    <span
                                                        class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center shadow"
                                                        style="width: 45px; height: 45px; background-color: #002060 !important; font-size: 1.1rem;">2</span>
                                                </div>
                                                <div class="ms-3">
                                                    <h5 class="fw-bold" style="color: #002060;">Automatización de Procesos
                                                        Financieros</h5>
                                                    <p class="text-muted">Conecta tus estados financieros con herramientas
                                                        de IA para detectar errores y tendencias automáticamente.</p>
                                                </div>
                                            </div>

                                            <div class="d-flex mb-4">
                                                <div class="flex-shrink-0">
                                                    <span
                                                        class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center shadow"
                                                        style="width: 45px; height: 45px; background-color: #002060 !important; font-size: 1.1rem;">3</span>
                                                </div>
                                                <div class="ms-3">
                                                    <h5 class="fw-bold" style="color: #002060;">Análisis Predictivo y
                                                        Auditoría Inteligente</h5>
                                                    <p class="text-muted">Aprende a proyectar flujos de caja y realizar
                                                        auditorías basadas en algoritmos de aprendizaje automático.</p>
                                                </div>
                                            </div>

                                            <div class="d-flex">
                                                <div class="flex-shrink-0">
                                                    <span
                                                        class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center shadow"
                                                        style="width: 45px; height: 45px; background-color: #002060 !important; font-size: 1.1rem;">4</span>
                                                </div>
                                                <div class="ms-3">
                                                    <h5 class="fw-bold" style="color: #002060;">Estrategia y Consultoría
                                                        de Alto Valor</h5>
                                                    <p class="text-muted">Transforma tus entregables contables en asesoría
                                                        estratégica utilizando visualización de datos avanzada.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                {{-- <div>
                    <section style="padding: 10px 0px;">
                        <div class="container-fluid">
                            <div class="page-title">
                                <div class="row">
                                    <div class="col-sm-3 pe-0">
                                    </div>
                                    <div class="col-sm-6 ps-0">
                                        <h1 class="ara_title">Aprende de quienes lideran en las firmas más reconocidas</h1>
                                    </div>
                                    <div class="col-sm-3 pe-0">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>

                    <style>
                        .teachers-section-opt3 {
                            padding: 60px 0;
                            /* background-color: #f4f7f9; */
                            /* Un fondo ligeramente diferente para la sección */
                        }

                        .teacher-card-opt3 {
                            position: relative;
                            background: #fff;
                            border-radius: 15px;
                            padding: 20px;
                            padding-top: 100px;
                            /* Espacio para la imagen que sobresale */
                            text-align: center;
                            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
                            transition: all 0.4s ease;
                            overflow: visible;
                            /* Permitir que la imagen se salga */
                            margin-top: 80px;
                            /* Margen para la imagen */
                            cursor: pointer;
                        }

                        .teacher-card-opt3:hover {
                            transform: translateY(-10px);
                            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
                        }

                        .teacher-img-wrapper-opt3 {
                            position: absolute;
                            top: -80px;
                            /* Posicionar la imagen arriba */
                            left: 50%;
                            transform: translateX(-50%);
                            width: 160px;
                            height: 160px;
                            border-radius: 50%;
                            padding: 7px;
                            /* Espacio para el borde degradado */
                            background: linear-gradient(45deg, #1f2f3e 0%, #000000 100%);
                            /* Degradado */
                            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
                            transition: all 0.4s ease;
                        }

                        .teacher-card-opt3:hover .teacher-img-wrapper-opt3 {
                            transform: translateX(-50%) translateY(-20px) scale(1.05);
                            /* Efecto hover para la imagen */
                        }

                        .teacher-img-opt3 {
                            width: 100%;
                            height: 100%;
                            object-fit: cover;
                            border-radius: 50%;
                            border: 4px solid #fff;
                            /* Borde blanco interior */
                        }

                        .teacher-name-opt3 {
                            font-size: 1.3rem;
                            font-weight: 700;
                            color: #2c3e50;
                            margin-top: 10px;
                            margin-bottom: 8px;
                        }

                        .teacher-role-opt3 {
                            font-size: 0.8rem;
                            color: #e30613;
                            /* color: #575656; */
                            font-weight: 400;
                            text-transform: uppercase;
                            letter-spacing: 0.1px;
                        }
                    </style>

                    <section class="teachers-section-opt3">
                        <div class="carousel-viewport">
                            <div class="carousel-track">
                                @php
                                    $teachers_demo = [
                                        ['name' => 'Dr. Julian Arancibia', 'role' => 'Especialista en IA'],
                                        ['name' => 'Mag. Carmen Luz', 'role' => 'Auditoría Digital'],
                                        ['name' => 'Dr. Roberto Mendoza', 'role' => 'Finanzas Tech'],
                                        ['name' => 'Dra. Elena Ramos', 'role' => 'Estrategia Fiscal'],
                                        ['name' => 'Mag. Luis Torres', 'role' => 'Data Analytics'],
                                        ['name' => 'Dr. Julian Arancibia', 'role' => 'Especialista en IA'],
                                        ['name' => 'Mag. Carmen Luz', 'role' => 'Auditoría Digital'],
                                    ];
                                @endphp

                                @foreach(array_merge($teachers_demo, $teachers_demo) as $teacher)
                                    <div class="teacher-carousel-item">
                                        <div class="teacher-card-opt3 m-0">
                                            <div class="teacher-img-wrapper-opt3">
                                                <img src="https://images.unsplash.com/photo-1508214751196-bcfd4ca60f91?q=80&w=2070&auto=format&fit=crop"
                                                    alt="{{ $teacher['name'] }}" class="teacher-img-opt3">
                                            </div>
                                            <div class="teacher-content-opt3">
                                                <h4 class="teacher-name-opt3">{{ $teacher['name'] }}</h4>
                                                <p class="teacher-role-opt3">{{ $teacher['role'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </section>

                </div> --}}

                {{-- Nueva Propuesta: Grilla de Expertos (Opción 4) --}}
                {{-- <div class="container-fluid card aos-animate mt-5" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body p-4 p-lg-5">
                                <!-- Header de Sección -->
                                <div class="text-center mb-5">
                                    <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                                        style="background-color: rgba(255, 193, 7, 0.1); color: #002060;">
                                        <i class="fa fa-graduation-cap me-1"></i> STAFF ACADÉMICO
                                    </span>
                                    <h2 class="fw-bold display-6" style="color: #002060;">Expertos que Guiarán tu Aprendizaje</h2>
                                    <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">
                                        Nuestra plana docente está conformada por líderes de opinión y especialistas activos en la implementación de IA en las firmas contables más importantes.
                                    </p>
                                </div>

                                <div class="row g-4">
                                    @php
                                        $teachers_grid = [
                                            ['name' => 'Dr. Julian Arancibia', 'role' => 'Especialista en IA', 'img' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=2070&auto=format&fit=crop'],
                                            ['name' => 'Mag. Carmen Luz', 'role' => 'Auditoría Digital', 'img' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=1974&auto=format&fit=crop'],
                                            ['name' => 'Dr. Roberto Mendoza', 'role' => 'Finanzas Tech', 'img' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?q=80&w=1974&auto=format&fit=crop'],
                                            ['name' => 'Dra. Elena Ramos', 'role' => 'Estrategia Fiscal', 'img' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1976&auto=format&fit=crop'],
                                        ];
                                    @endphp

                                    @foreach($teachers_grid as $teacher)
                                        <div class="col-md-6 col-lg-3" data-aos="zoom-in" data-aos-delay="{{ $loop->index * 100 }}">
                                            <div class="card border-0 shadow-sm h-100 transition-all rounded-4 overflow-hidden bg-white">
                                                <div style="height: 280px; overflow: hidden; position: relative;">
                                                    <img src="{{ $teacher['img'] }}" 
                                                         class="card-img-top h-100 w-100" 
                                                         style="object-fit: cover; transition: transform 0.5s ease;" 
                                                         onmouseover="this.style.transform='scale(1.1)'" 
                                                         onmouseout="this.style.transform='scale(1)'" 
                                                         alt="{{ $teacher['name'] }}">
                                                    <div class="position-absolute bottom-0 start-0 w-100 p-3" 
                                                         style="background: linear-gradient(transparent, rgba(0,32,96,0.8));">
                                                        <p class="text-white small mb-0 fw-light">Socio Consultor</p>
                                                    </div>
                                                </div>
                                                <div class="card-body text-center p-4">
                                                    <h5 class="fw-bold mb-1" style="color: #002060;">{{ $teacher['name'] }}</h5>
                                                    <p class="text-warning small fw-bold mb-0">{{ $teacher['role'] }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                
                {{-- Propuesta de Diseño: Carrusel de Expertos Premium (Opción 5) --}}
                <div class="container-fluid card aos-animate mt-5" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body p-4 p-lg-5">
                                <!-- Header de Sección -->
                                <div class="text-center mb-4">
                                    <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                                        style="background-color: rgba(0, 32, 96, 0.05); color: #002060;">
                                        <i class="fa fa-users me-1"></i> NUESTRO STAFF (DINÁMICO)
                                    </span>
                                    <h2 class="fw-bold display-6" style="color: #002060;">Líderes de la Industria</h2>
                                    <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">
                                        Desliza para conocer a los profesionales que transformarán tu carrera.
                                    </p>
                                </div>

                                <div class="carousel-viewport" style="padding: 40px 0;">
                                    <div class="carousel-track" style="animation-duration: 50s;">
                                        @php
                                            $teachers_premium = [
                                                ['name' => 'Dr. Julian Arancibia', 'role' => 'Especialista en IA', 'img' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?q=80&w=2070&auto=format&fit=crop'],
                                                ['name' => 'Mag. Carmen Luz', 'role' => 'Auditoría Digital', 'img' => 'https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=1974&auto=format&fit=crop'],
                                                ['name' => 'Dr. Roberto Mendoza', 'role' => 'Finanzas Tech', 'img' => 'https://images.unsplash.com/photo-1519085360753-af0119f7cbe7?q=80&w=1974&auto=format&fit=crop'],
                                                ['name' => 'Dra. Elena Ramos', 'role' => 'Estrategia Fiscal', 'img' => 'https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?q=80&w=1976&auto=format&fit=crop'],
                                                ['name' => 'Mag. Luis Torres', 'role' => 'Data Analytics', 'img' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=1974&auto=format&fit=crop'],
                                            ];
                                        @endphp

                                        {{-- Se duplica el contenido para el loop infinito --}}
                                        @foreach(array_merge($teachers_premium, $teachers_premium) as $teacher)
                                            <div class="teacher-carousel-item" style="width: 280px;">
                                                <div class="card border-0 shadow-sm h-100 transition-all rounded-4 overflow-hidden bg-white mx-2">
                                                    <div style="height: 240px; overflow: hidden; position: relative;">
                                                        <img src="{{ $teacher['img'] }}" 
                                                             class="card-img-top h-100 w-100" 
                                                             style="object-fit: cover;" 
                                                             alt="{{ $teacher['name'] }}">
                                                        <div class="position-absolute bottom-0 start-0 w-100 p-3" 
                                                             style="background: linear-gradient(transparent, rgba(0,32,96,0.8));">
                                                            <p class="text-white small mb-0 fw-light">Socio Consultor</p>
                                                        </div>
                                                    </div>
                                                    <div class="card-body text-center p-3">
                                                        <h5 class="fw-bold mb-1" style="color: #002060; font-size: 1.1rem;">{{ $teacher['name'] }}</h5>
                                                        <p class="text-warning small fw-bold mb-0" style="font-size: 0.8rem;">{{ $teacher['role'] }}</p>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="container-fluid card aos-animate" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body p-4 p-lg-5">
                                <div class="text-center mb-5">
                                    <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                                        style="background-color: rgba(40, 167, 69, 0.1); color: #28a745;">
                                        <i class="fa fa-check-circle me-1"></i> RESULTADOS DEL PROGRAMA
                                    </span>
                                    <h2 class="fw-bold display-6" style="color: #002060;">
                                        Transforma tu Práctica Contable
                                    </h2>
                                    <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">
                                        Al finalizar esta especialización, habrás adquirido competencias críticas para liderar departamentos financieros modernos.
                                    </p>
                                </div>

                                <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                                    @php
                                        $achievements = [
                                            ['title' => 'Automatización Total', 'desc' => 'Reduce hasta un 80% el tiempo en tareas de registro y conciliación bancaria.', 'icon' => 'fa-magic', 'color' => '#6f42c1'],
                                            ['title' => 'Análisis Predictivo', 'desc' => 'Anticipa flujos de caja y riesgos financieros con modelos de Machine Learning.', 'icon' => 'fa-bar-chart', 'color' => '#007bff'],
                                            ['title' => 'Auditoría con IA', 'desc' => 'Identifica anomalías y fraudes de manera instantánea en grandes volúmenes de datos.', 'icon' => 'fa-search-plus', 'color' => '#e83e8c'],
                                            ['title' => 'Consultoría Estratégica', 'desc' => 'Eleva tu valor cobrando por insights estratégicos, no por horas de digitación.', 'icon' => 'fa-rocket', 'color' => '#fd7e14'],
                                        ];
                                    @endphp

                                    @foreach($achievements as $item)
                                        <div class="col" data-aos="fade-up" data-aos-delay="{{ 100 * ($loop->index + 1) }}">
                                            <div class="h-100 p-4 rounded-4 border-0 shadow-sm text-center bg-white transition-all position-relative overflow-hidden" 
                                                 style="border-top: 5px solid {{ $item['color'] }} !important;">
                                                
                                                {{-- Círculo decorativo de fondo --}}
                                                <div class="position-absolute opacity-0 transition-all" 
                                                     style="width: 100px; height: 100px; background-color: {{ $item['color'] }}; border-radius: 50%; top: -20px; right: -20px; opacity: 0.05 !important;">
                                                </div>

                                                <div class="mb-4 d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm" 
                                                     style="width: 70px; height: 70px; background-color: white; border: 1px solid #f1f1f1;">
                                                    <i class="fa {{ $item['icon'] }}" style="font-size: 2rem; color: {{ $item['color'] }};"></i>
                                                </div>
                                                
                                                <h4 class="fw-bold mb-3" style="color: #002060;">{{ $item['title'] }}</h4>
                                                <p class="text-muted mb-0 small" style="line-height: 1.6;">
                                                    {{ $item['desc'] }}
                                                </p>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                
    {{-- Nueva Propuesta: Sección de Testimonios en Carrusel (Opción 6) --}}
                <div class="container-fluid card aos-animate mt-5" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body p-4 p-lg-5">
                                <!-- Header de Sección -->
                                <div class="text-center mb-4">
                                    <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                                        style="background-color: rgba(0, 123, 255, 0.05); color: #007bff;">
                                        <i class="fa fa-quote-right me-1"></i> TESTIMONIOS
                                    </span>
                                    <h2 class="fw-bold display-6" style="color: #002060;">Lo que dicen nuestros alumnos</h2>
                                    <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">
                                        Historias de éxito que inspiran y demuestran el impacto de nuestra formación.
                                    </p>
                                </div>

                                <style>
                                    .testimonial-carousel-viewport {
                                        overflow: hidden;
                                        padding: 20px 0; /* Espacio para sombras */
                                        position: relative;
                                        width: 100%;
                                    }

                                    .testimonial-carousel-track {
                                        display: flex;
                                        gap: 30px;
                                        width: max-content;
                                        animation: scroll-infinite-testimonials 60s linear infinite; /* Velocidad ajustada */
                                    }

                                    .testimonial-carousel-track:hover {
                                        animation-play-state: paused;
                                    }

                                    @keyframes scroll-infinite-testimonials {
                                        0% { transform: translateX(0); }
                                        100% { transform: translateX(calc(-50%)); }
                                    }

                                    .testimonial-card {
                                        width: 350px; /* Ancho fijo para las tarjetas de testimonio */
                                        flex-shrink: 0;
                                        background: #fff;
                                        border-radius: 15px;
                                        padding: 30px;
                                        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
                                        transition: all 0.3s ease;
                                        display: flex;
                                        flex-direction: column;
                                        justify-content: space-between;
                                        min-height: 250px; /* Altura mínima para uniformidad */
                                    }

                                    .testimonial-card:hover {
                                        transform: translateY(-8px);
                                        box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
                                    }

                                    .testimonial-quote {
                                        font-size: 1.1rem;
                                        line-height: 1.6;
                                        color: #343a40;
                                        margin-bottom: 20px;
                                        font-style: italic;
                                    }

                                    .testimonial-author-info {
                                        display: flex;
                                        align-items: center;
                                        margin-top: auto; /* Empuja la info del autor hacia abajo */
                                    }

                                    .testimonial-avatar {
                                        width: 60px;
                                        height: 60px;
                                        border-radius: 50%;
                                        object-fit: cover;
                                        margin-right: 15px;
                                        border: 3px solid #007bff;
                                    }

                                    .testimonial-name {
                                        font-weight: 700;
                                        color: #002060;
                                        font-size: 1rem;
                                    }

                                    .testimonial-title {
                                        font-size: 0.85rem;
                                        color: #6c757d;
                                    }
                                </style>

                                <div class="testimonial-carousel-viewport">
                                    <div class="testimonial-carousel-track">
                                        @php
                                            $testimonials = [
                                                [
                                                    'quote' => 'La especialización en IA transformó mi forma de trabajar. Ahora puedo automatizar tareas que antes me tomaban horas y enfocarme en el análisis estratégico.',
                                                    'author' => 'Ana María López',
                                                    'title' => 'Contadora Senior, Deloitte',
                                                    'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop',
                                                ],
                                                [
                                                    'quote' => 'El contenido es de vanguardia y los docentes son expertos reales. Pude aplicar lo aprendido desde la primera semana, generando un impacto directo en mi empresa.',
                                                    'author' => 'Roberto Carlos Vargas',
                                                    'title' => 'Gerente de Finanzas, PwC',
                                                    'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=1974&auto=format&fit=crop',
                                                ],
                                                [
                                                    'quote' => 'Nunca pensé que la IA podría ser tan accesible para el área contable. Este programa me dio las herramientas y la confianza para innovar en mi rol.',
                                                    'author' => 'Sofía Hernández',
                                                    'title' => 'Auditora Interna, EY',
                                                    'avatar' => 'https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=1961&auto=format&fit=crop',
                                                ],
                                                [
                                                    'quote' => 'Una inversión que vale cada centavo. La capacidad de predecir tendencias financieras con IA es un game-changer para cualquier profesional de las finanzas.',
                                                    'author' => 'Miguel Ángel Quispe',
                                                    'title' => 'Analista Financiero, KPMG',
                                                    'avatar' => 'https://images.unsplash.com/photo-1544723795-3fb6469e0453?q=80&w=1974&auto=format&fit=crop',
                                                ],
                                                [
                                                    'quote' => 'La especialización en IA transformó mi forma de trabajar. Ahora puedo automatizar tareas que antes me tomaban horas y enfocarme en el análisis estratégico.',
                                                    'author' => 'Ana María López',
                                                    'title' => 'Contadora Senior, Deloitte',
                                                    'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=2070&auto=format&fit=crop',
                                                ],
                                                [
                                                    'quote' => 'El contenido es de vanguardia y los docentes son expertos reales. Pude aplicar lo aprendido desde la primera semana, generando un impacto directo en mi empresa.',
                                                    'author' => 'Roberto Carlos Vargas',
                                                    'title' => 'Gerente de Finanzas, PwC',
                                                    'avatar' => 'https://images.unsplash.com/photo-1500648767791-00dcc994a43e?q=80&w=1974&auto=format&fit=crop',
                                                ],
                                            ];
                                        @endphp

                                        {{-- Duplicamos los testimonios para el efecto de carrusel infinito --}}
                                        @foreach(array_merge($testimonials, $testimonials) as $testimonial)
                                            <div class="testimonial-carousel-item">
                                                <div class="testimonial-card mx-2">
                                                    <p class="testimonial-quote">"{{ $testimonial['quote'] }}"</p>
                                                    <div class="testimonial-author-info">
                                                        <img src="{{ $testimonial['avatar'] }}" alt="{{ $testimonial['author'] }}" class="testimonial-avatar">
                                                        <div>
                                                            <h5 class="testimonial-name">{{ $testimonial['author'] }}</h5>
                                                            <p class="testimonial-title">{{ $testimonial['title'] }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                {{-- Nueva Sección: Planes de Inversión --}}
                <div class="container-fluid card aos-animate mt-5" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body p-4 p-lg-5">
                                <div class="text-center mb-5">
                                    <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                                        style="background-color: rgba(255, 193, 7, 0.1); color: #002060;">
                                        <i class="fa fa-money me-1"></i> INVERSIÓN
                                    </span>
                                    <h2 class="fw-bold display-6" style="color: #002060;">Planes de Inversión</h2>
                                    <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">
                                        Elige el plan que mejor se adapte a tus necesidades y comienza tu transformación profesional hoy mismo.
                                    </p>
                                </div>

                                <div class="row g-4 justify-content-center">
                                    <!-- Plan Pronto Pago -->
                                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                                        <div class="card h-100 border-0 shadow-sm transition-all rounded-4 overflow-hidden bg-white text-center">
                                            <div class="p-4 border-bottom bg-light">
                                                <h4 class="fw-bold mb-0" style="color: #002060;">Pronto Pago</h4>
                                                <small class="text-muted">Válido hasta el 15 de abril</small>
                                            </div>
                                            <div class="card-body p-4">
                                                <div class="mb-4">
                                                    <span class="display-4 fw-bold" style="color: #002060;">S/ 450</span>
                                                    <span class="text-muted">/ pago único</span>
                                                </div>
                                                <ul class="list-unstyled text-start mb-4">
                                                    <li class="mb-2"><i class="fa fa-check text-success me-2"></i> Acceso total al programa</li>
                                                    <li class="mb-2"><i class="fa fa-check text-success me-2"></i> Material digital descargable</li>
                                                    <li class="mb-2"><i class="fa fa-check text-success me-2"></i> Certificado de participación</li>
                                                </ul>
                                                <a href="#pageContactForm" class="btn btn-outline-warning w-100 fw-bold py-2" style="color: #002060; border-radius: 10px;">Inscribirse ahora</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Plan Regular (Destacado) -->
                                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                                        <div class="card h-100 border-0 shadow-lg transition-all rounded-4 overflow-hidden bg-white border-top border-warning border-5" style="border-top: 5px solid #ffc107 !important;">
                                            <div class="p-4 border-bottom" style="background-color: rgba(255, 193, 7, 0.05);">
                                                <span class="badge bg-warning text-dark mb-2">RECOMENDADO</span>
                                                <h4 class="fw-bold mb-0" style="color: #002060;">Inversión Regular</h4>
                                                <small class="text-muted">Precio estándar</small>
                                            </div>
                                            <div class="card-body p-4 text-center">
                                                <div class="mb-4">
                                                    <span class="display-4 fw-bold" style="color: #002060;">S/ 600</span>
                                                    <span class="text-muted">/ pago único</span>
                                                </div>
                                                <ul class="list-unstyled text-start mb-4">
                                                    <li class="mb-2"><i class="fa fa-check text-success me-2"></i> <b>Todo lo del plan Pronto Pago</b></li>
                                                    <li class="mb-2"><i class="fa fa-check text-success me-2"></i> Sesiones de Q&A en vivo</li>
                                                    <li class="mb-2"><i class="fa fa-check text-success me-2"></i> Soporte prioritario vía WhatsApp</li>
                                                </ul>
                                                <a href="#pageContactForm" class="btn btn-warning w-100 fw-bold py-2 shadow-sm" style="color: #002060; border-radius: 10px;">Inscribirse ahora</a>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Plan Corporativo -->
                                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                                        <div class="card h-100 border-0 shadow-sm transition-all rounded-4 overflow-hidden bg-white text-center">
                                            <div class="p-4 border-bottom bg-light">
                                                <h4 class="fw-bold mb-0" style="color: #002060;">Corporativo</h4>
                                                <small class="text-muted">Desde 3 inscritos</small>
                                            </div>
                                            <div class="card-body p-4">
                                                <div class="mb-4">
                                                    <span class="display-4 fw-bold" style="color: #002060;">S/ 400</span>
                                                    <span class="text-muted">/ por persona</span>
                                                </div>
                                                <ul class="list-unstyled text-start mb-4">
                                                    <li class="mb-2"><i class="fa fa-check text-success me-2"></i> Beneficios del plan regular</li>
                                                    <li class="mb-2"><i class="fa fa-check text-success me-2"></i> Sesión privada para el equipo</li>
                                                    <li class="mb-2"><i class="fa fa-check text-success me-2"></i> Facturación personalizada</li>
                                                </ul>
                                                <a href="#pageContactForm" class="btn btn-outline-warning w-100 fw-bold py-2" style="color: #002060; border-radius: 10px;">Contactar ventas</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                {{-- Propuesta 2: Preguntas Frecuentes (Diseño Moderno de Tarjetas) --}}
                <div class="container-fluid card aos-animate mt-5" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body p-4 p-lg-5">
                                <div class="text-center mb-5">
                                    <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                                        style="background-color: rgba(111, 66, 193, 0.1); color: #6f42c1;">
                                        <i class="fa fa-magic me-1"></i> FAQ - VERSIÓN MODERNA
                                    </span>
                                    <h2 class="fw-bold display-6" style="color: #002060;">Preguntas Frecuentes</h2>
                                    <p class="text-muted fs-5 mx-auto" style="max-width: 700px;">
                                        Todo lo que necesitas saber sobre la Especialización en IA.
                                    </p>
                                </div>

                                <div class="row justify-content-center">
                                    <div class="col-lg-10">
                                        <div class="accordion faq-modern" id="modernFaqAccordion">
                                            
                                            <!-- Pregunta 1 -->
                                            <div class="accordion-item shadow-sm" data-aos="fade-up">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mCollapseOne">
                                                        ¿Cuál es la duración de la especialización?
                                                    </button>
                                                </h2>
                                                <div id="mCollapseOne" class="accordion-collapse collapse" data-bs-parent="#modernFaqAccordion">
                                                    <div class="accordion-body py-4 text-muted">
                                                        El programa está diseñado para completarse en <strong>3 meses</strong>. Las sesiones son intensivas y prácticas, asegurando que puedas aplicar lo aprendido inmediatamente.
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Pregunta 2 -->
                                            <div class="accordion-item shadow-sm" data-aos="fade-up" data-aos-delay="100">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mCollapseTwo">
                                                        ¿Necesito conocimientos previos en programación o IA?
                                                    </button>
                                                </h2>
                                                <div id="mCollapseTwo" class="accordion-collapse collapse" data-bs-parent="#modernFaqAccordion">
                                                    <div class="accordion-body py-4 text-muted">
                                                        <strong>Absolutamente no.</strong> Esta especialización inicia desde los conceptos más básicos. Está optimizada para contadores y financieros, no para programadores.
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Pregunta 3 -->
                                            <div class="accordion-item shadow-sm" data-aos="fade-up" data-aos-delay="200">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mCollapseThree">
                                                        ¿Qué tipo de certificado obtendré al finalizar?
                                                    </button>
                                                </h2>
                                                <div id="mCollapseThree" class="accordion-collapse collapse" data-bs-parent="#modernFaqAccordion">
                                                    <div class="accordion-body py-4 text-muted">
                                                        Obtendrás un <strong>Certificado de Especialización</strong> emitido por Global CPA. Este documento cuenta con un código QR único de verificación para validar tu autenticidad ante cualquier empleador.
                                                    </div>
                                                </div>
                                            </div>

                                            <!-- Pregunta 4 -->
                                            <div class="accordion-item shadow-sm" data-aos="fade-up" data-aos-delay="300">
                                                <h2 class="accordion-header">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#mCollapseFour">
                                                        ¿Hay opciones de pago a plazos?
                                                    </button>
                                                </h2>
                                                <div id="mCollapseFour" class="accordion-collapse collapse" data-bs-parent="#modernFaqAccordion">
                                                    <div class="accordion-body py-4 text-muted">
                                                        Sí, contamos con financiamiento directo. Puedes dividir tu inversión en cuotas mensuales sin intereses bancarios. Consulta con un asesor para armar tu plan.
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                        <div class="text-center mt-5 p-4 rounded-4" style="background-color: #f8f9fa; border: 1px dashed #dee2e6;">
                                            <p class="mb-3 fw-bold" style="color: #002060;">¿Aún tienes dudas específicas?</p>
                                            <a href="https://wa.me/tu-numero" class="btn btn-success rounded-pill px-4 shadow-sm">
                                                <i class="fa fa-whatsapp me-2"></i> Hablar con un Asesor
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                
                




                <div class="container-fluid card aos-init aos-animate" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <div style="padding: 20px 20px;">
                                <div class="page-title">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h1 class="ara_title">¡Comparte tus logros con un certificado!</h1>
                                        </div>
                                    </div>
                                </div>
                                <p style="font-size: 17px; line-height: 1.3; margin-top: 10px;">
                                    Cuando termines el curso tendrás acceso al certificado digital para
                                    compartirlo con tu
                                    familia, amigos, empleadores y la comunidad.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="place-items: center; padding: 40px 20px;">
                                <img style="width: 100%;"
                                    src="https://academy.globalcpaperu.com/themes/webpage/images/certificado.jpg"
                                    alt="">
                                <p style="font-size: 17px; line-height: 1.3; margin-top: 10px;">
                                    <b>* IMAGEN REFERENCIAL</b>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
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



    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>

    <script>
        let form = document.getElementById('pageContactForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            var formulario = document.getElementById('pageContactForm');
            var formData = new FormData(formulario);

            var submitButton = document.getElementById('submitPageContactButton');
            submitButton.disabled = true;
            submitButton.style.opacity = 0.25;

            var xhr = new XMLHttpRequest();

            xhr.open('POST', "{{ route('apisubscriber') }}", true);

            xhr.onload = function() {
                submitButton.disabled = false;
                submitButton.style.opacity = 1;
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    Swal.fire({
                        icon: 'success',
                        title: 'Enhorabuena',
                        text: response.message,
                        customClass: {
                            container: 'sweet-modal-zindex'
                        }
                    });
                    formulario.reset();
                } else if (xhr.status === 422) {
                    var errorResponse = JSON.parse(xhr.responseText);
                    var errorMessages = errorResponse.errors;
                    var errorMessageContainer = document.getElementById('messagePageContact');
                    errorMessageContainer.innerHTML = 'Errores de validación:<br>';
                    for (var field in errorMessages) {
                        if (errorMessages.hasOwnProperty(field)) {
                            errorMessageContainer.innerHTML += field + ': ' + errorMessages[field].join(', ') +
                                '<br>';
                        }
                    }
                } else {
                    console.error('Error en la solicitud: ' + xhr.status);
                }
                const downloadUrl = "";
                window.open(downloadUrl, '_blank');

            };

            xhr.send(formData);
        });
    </script>



@stop
