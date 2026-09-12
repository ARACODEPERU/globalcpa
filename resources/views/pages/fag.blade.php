@extends('layouts.webpage')

@section('title', ' - FAG')

@section('etiquetasmeta')
    <x-seo
        title="FAG - Formación Académica Guía - CPA Academy"
        description="FAG (Formación Académica Guía) de CPA Academy: programa de especialización para profesionales en contabilidad, finanzas y auditoría con estándares internacionales ACCA."
    />
@endsection

@section('content')

    <style>
        /* =========================================
           PÁGINA FAG
           ========================================= */

        .text-navy-custom { color: #002060 !important; }
        :is(.dark, .dark-only) .text-navy-custom { color: #f6f7fb !important; }

        .text-muted-custom { color: #6b7280; }
        :is(.dark, .dark-only) .text-muted-custom { color: #9ca3af !important; }

        .bg-card-custom {
            background-color: #ffffff !important;
            border: 1px solid #eef2f7;
        }
        :is(.dark, .dark-only) .bg-card-custom {
            background-color: #1d273a !important;
            border-color: #374558 !important;
        }

        .fag-section { padding: 70px 0; }
        .fag-section-alt {
            background-color: #f8f9fa;
        }
        :is(.dark, .dark-only) .fag-section-alt {
            background-color: #111827;
        }

        /* --- Hero --- */
        .fag-hero {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 20px;
            border: 0;
            overflow: hidden;
            position: relative;
        }
        .fag-hero::after {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.25) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .fag-hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
        }
        .fag-hero .btn-cta-white {
            background: #ffffff;
            color: #002060;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
            display: inline-block;
        }
        .fag-hero .btn-cta-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            color: #e30613;
        }

        /* --- Qué es FAG: tarjeta flotante de datos --- */
        .fag-image-frame {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 32, 96, 0.25);
        }
        .fag-image-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .fag-stats-float {
            position: absolute;
            left: 20px;
            bottom: 20px;
            right: 20px;
            display: flex;
            gap: 15px;
        }
        .fag-stats-float .float-stat {
            flex: 1;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 14px;
            padding: 14px 10px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .fag-stats-float .float-stat strong {
            display: block;
            font-size: 1.4rem;
            font-weight: 800;
            color: #e30613;
            line-height: 1.2;
        }
        .fag-stats-float .float-stat span {
            font-size: 0.78rem;
            color: #4b5563;
            font-weight: 600;
        }
        :is(.dark, .dark-only) .fag-stats-float .float-stat {
            background: rgba(17, 24, 39, 0.92);
        }
        :is(.dark, .dark-only) .fag-stats-float .float-stat span {
            color: #d1d5db;
        }

        /* --- Objetivos del programa --- */
        .fag-obj-card {
            height: 100%;
            padding: 35px 28px;
            border-radius: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .fag-obj-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(0, 32, 96, 0.12);
        }
        .fag-obj-card .obj-icon {
            width: 74px;
            height: 74px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #ffffff;
            margin-bottom: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.18);
        }
        .fag-obj-card h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .fag-obj-card p {
            font-size: 0.95rem;
            line-height: 1.65;
            margin-bottom: 0;
        }

        /* --- Módulos del programa --- */
        .fag-mod-card {
            height: 100%;
            padding: 28px 25px;
            border-radius: 20px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
            border: 1px solid transparent;
        }
        .fag-mod-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 30px rgba(0, 32, 96, 0.1);
            border-color: #e30613;
        }
        .fag-mod-card .mod-number {
            width: 42px;
            height: 42px;
            border-radius: 12px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            font-weight: 800;
            color: #ffffff;
            margin-bottom: 15px;
        }
        .fag-mod-card h4 {
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .fag-mod-card p {
            font-size: 0.9rem;
            line-height: 1.65;
            margin-bottom: 0;
        }

        /* --- Beneficios --- */
        .fag-benefit-item {
            display: flex;
            align-items: flex-start;
            gap: 14px;
            padding: 18px 0;
            border-bottom: 1px dashed rgba(128, 128, 128, 0.25);
        }
        .fag-benefit-item:last-child { border-bottom: none; }
        .fag-benefit-item i { margin-top: 4px; }
        .fag-benefit-item .benefit-text { font-size: 0.98rem; line-height: 1.6; }
        .fag-benefit-item strong { display: block; margin-bottom: 4px; }

        /* --- Franja de números --- */
        .fag-stats-band {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 24px;
            padding: 45px 30px;
            position: relative;
            overflow: hidden;
        }
        .fag-stats-band::before {
            content: '';
            position: absolute;
            bottom: -100px;
            right: -100px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.2) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .fag-stat { text-align: center; color: #ffffff; }
        .fag-stat i { font-size: 28px; color: #ffc107; margin-bottom: 10px; display: block; }
        .fag-stat strong { display: block; font-size: 2.2rem; font-weight: 800; line-height: 1.1; }
        .fag-stat span { font-size: 0.9rem; color: rgba(255, 255, 255, 0.75); font-weight: 600; }

        /* --- CTA final --- */
        .fag-cta {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 24px;
            padding: 55px 40px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }
        .fag-cta::before {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.2) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .fag-cta .btn-cta-white {
            background: #ffffff;
            color: #002060;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }
        .fag-cta .btn-cta-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            color: #e30613;
        }
        .fag-cta .btn-cta-wa {
            background: #25d366;
            color: #ffffff;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }
        .fag-cta .btn-cta-wa:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.35);
            background: #1fb959;
            color: #ffffff;
        }

        @media (max-width: 767.98px) {
            .fag-section { padding: 45px 0; }
            .fag-cta { padding: 40px 25px; }
            .fag-stat strong { font-size: 1.7rem; }
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

            <div class="page-body" style="padding-bottom: 40px;">

                {{-- ============================================ --}}
                {{-- 1. HERO --}}
                {{-- ============================================ --}}
                <div class="container-fluid mt-5">
                    <div class="card fag-hero shadow mb-4" data-aos="fade-in">
                        <div class="card-body p-4 p-lg-5 position-relative">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <nav aria-label="breadcrumb" class="mb-3">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item">
                                                <a href="{{ route('index_main') }}"
                                                    class="text-white-50 text-decoration-none text-uppercase small fw-bold"
                                                    style="letter-spacing: 1px;">
                                                    <i class="fa fa-home me-1"></i> Inicio
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active text-white text-uppercase small fw-bold"
                                                style="letter-spacing: 1px;" aria-current="page">
                                                FAG
                                            </li>
                                        </ol>
                                    </nav>

                                    <h1 class="display-4 fw-bold text-white mb-3">
                                        Formación Académica <span class="text-warning">Guía</span>
                                    </h1>
                                    <p class="lead text-white-50 mb-4" style="max-width: 620px; line-height: 1.6;">
                                        Programa de especialización diseñado para profesionales que buscan
                                        liderar con conocimiento aplicable, estándares internacionales y
                                        metodología práctica en contabilidad, finanzas y auditoría.
                                    </p>

                                    <div class="d-flex flex-wrap gap-3">
                                        <span class="fag-hero-tag">
                                            <i class="fa fa-certificate text-warning"></i> Respaldo ACCA
                                        </span>
                                        <span class="fag-hero-tag">
                                            <i class="fa fa-graduation-cap text-warning"></i> +5,000 alumnos formados
                                        </span>
                                        <span class="fag-hero-tag">
                                            <i class="fa fa-globe text-warning"></i> +10 países de LATAM
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ============================================ --}}
                {{-- 2. QUÉ ES FAG --}}
                {{-- ============================================ --}}
                <section class="fag-section">
                    <div class="container">
                        <div class="row align-items-center g-5">
                            <div class="col-lg-6" data-aos="fade-right">
                                <h2 class="fw-bold text-navy-custom mb-4">
                                    Un programa pensado para el profesional <span style="color: #e30613;">que avanza</span>
                                </h2>
                                <p class="text-muted-custom" style="line-height: 1.8; font-size: 1.02rem;">
                                    <strong>FAG (Formación Académica Guía)</strong> es la respuesta de CPA Academy
                                    a una necesidad real del mercado: profesionales que necesitan actualizarse,
                                    especializarse y demostrar valor desde el primer día.
                                </p>
                                <p class="text-muted-custom" style="line-height: 1.8; font-size: 1.02rem;">
                                    Combinamos la experiencia de docentes de Big Four, banca y organismos
                                    internacionales con metodologías de aprendizaje que convierten el conocimiento
                                    en resultados visibles en tu trabajo y en tu carrera.
                                </p>
                                <p class="text-muted-custom mb-0" style="line-height: 1.8; font-size: 1.02rem;">
                                    Porque formar profesionales no es solo transmitir teoría: es guiar, orientar
                                    y acompañar el crecimiento de cada alumno hacia su siguiente nivel.
                                </p>
                            </div>
                            <div class="col-lg-6" data-aos="fade-left">
                                <div class="fag-image-frame" style="min-height: 380px;">
                                    <img src="{{ asset('themes/webpage/images/soluciones-equipo.jpg') }}"
                                        alt="Profesionales de CPA Academy en clase">
                                    <div class="fag-stats-float">
                                        <div class="float-stat">
                                            <strong>+10</strong>
                                            <span>Años formando profesionales</span>
                                        </div>
                                        <div class="float-stat">
                                            <strong>+25</strong>
                                            <span>Programas de especialización</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 3. OBJETIVOS DEL PROGRAMA --}}
                {{-- ============================================ --}}
                <section class="fag-section fag-section-alt">
                    <div class="container">
                        <div class="text-center mb-5" data-aos="fade-up">
                            <h2 class="fw-bold text-navy-custom">Objetivos del programa</h2>
                            <p class="text-muted-custom mx-auto" style="max-width: 700px;">
                                Cada módulo está diseñado para alcanzar objetivos claros y medibles.
                            </p>
                        </div>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4">
                            <div class="col" data-aos="fade-up" data-aos-delay="100">
                                <div class="fag-obj-card bg-card-custom shadow-sm">
                                    <div class="obj-icon" style="background: linear-gradient(135deg, #e30613 0%, #a0040d 100%);">
                                        <i class="fa fa-bullseye"></i>
                                    </div>
                                    <h3 class="text-navy-custom">Especialización técnica</h3>
                                    <p class="text-muted-custom">
                                        Domina los temas que realmente demanda el mercado: NIIF, auditoría,
                                        finanzas, tributación y costos con profundidad aplicable.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="200">
                                <div class="fag-obj-card bg-card-custom shadow-sm">
                                    <div class="obj-icon" style="background: linear-gradient(135deg, #002060 0%, #004080 100%);">
                                        <i class="fa fa-briefcase"></i>
                                    </div>
                                    <h3 class="text-navy-custom">Preparación profesional</h3>
                                    <p class="text-muted-custom">
                                        Aprende con casos reales de empresas peruanas y latinoamericanas,
                                        con criterios y herramientas que usan los profesionales de hoy.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="300">
                                <div class="fag-obj-card bg-card-custom shadow-sm">
                                    <div class="obj-icon" style="background: linear-gradient(135deg, #2c3e50 0%, #4b6584 100%);">
                                        <i class="fa fa-certificate"></i>
                                    </div>
                                    <h3 class="text-navy-custom">Certificación con respaldo</h3>
                                    <p class="text-muted-custom">
                                        Obtén tu certificado con verificación en línea y el reconocimiento de
                                        ACCA como Approved Learning Partner.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="400">
                                <div class="fag-obj-card bg-card-custom shadow-sm">
                                    <div class="obj-icon" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">
                                        <i class="fa fa-link"></i>
                                    </div>
                                    <h3 class="text-navy-custom">Orientación profesional</h3>
                                    <p class="text-muted-custom">
                                        Recibe guía personalizada para elegir el programa adecuado y planear
                                        tu siguiente paso dentro de la comunidad CPA Academy.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 4. MÓDULOS DEL PROGRAMA --}}
                {{-- ============================================ --}}
                <section class="fag-section">
                    <div class="container">
                        <div class="text-center mb-5" data-aos="fade-up">
                            <h2 class="fw-bold text-navy-custom">Módulos del programa</h2>
                            <p class="text-muted-custom mx-auto" style="max-width: 700px;">
                                Contenido estructurado y actualizado, revisado por expertos de la práctica.
                            </p>
                        </div>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            <div class="col" data-aos="fade-up" data-aos-delay="100">
                                <div class="fag-mod-card bg-card-custom shadow-sm">
                                    <div class="mod-number" style="background: linear-gradient(135deg, #e30613 0%, #a0040d 100%);">1</div>
                                    <h4 class="text-navy-custom">NIIF y Normativa Internacional</h4>
                                    <p class="text-muted-custom">
                                        Normas Internacionales de Información Financiera aplicadas a empresas
                                        peruanas y multinacionales, con ejemplos de las firmas.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="200">
                                <div class="fag-mod-card bg-card-custom shadow-sm">
                                    <div class="mod-number" style="background: linear-gradient(135deg, #002060 0%, #004080 100%);">2</div>
                                    <h4 class="text-navy-custom">Auditoría y Control Interno</h4>
                                    <p class="text-muted-custom">
                                        Procesos de auditoría, evaluación de controles internos y criteria
                                        reales de las firmas para el trabajo de auditoría.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="300">
                                <div class="fag-mod-card bg-card-custom shadow-sm">
                                    <div class="mod-number" style="background: linear-gradient(135deg, #2c3e50 0%, #4b6584 100%);">3</div>
                                    <h4 class="text-navy-custom">Finanzas Corporativas</h4>
                                    <p class="text-muted-custom">
                                        Análisis financiero, presupuesto, flujo de caja y toma de decisiones
                                        con herramientas utilizadas por los profesionales de la industria.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="100">
                                <div class="fag-mod-card bg-card-custom shadow-sm">
                                    <div class="mod-number" style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);">4</div>
                                    <h4 class="text-navy-custom">Tributación y Fiscalidad</h4>
                                    <p class="text-muted-custom">
                                        Obligaciones tributarias, RUC, régimen tributario y planificación fiscal
                                        para empresas y profesionales independientes.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="200">
                                <div class="fag-mod-card bg-card-custom shadow-sm">
                                    <div class="mod-number" style="background: linear-gradient(135deg, #f7971e 0%, #ffd200 100%);">5</div>
                                    <h4 class="text-navy-custom">Presupuestos y Costos</h4>
                                    <p class="text-muted-custom">
                                        Control de costos, presupuesto por proyectos y análisis de rentabilidad
                                        para industrias como manufactura, minería y construcción.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="300">
                                <div class="fag-mod-card bg-card-custom shadow-sm">
                                    <div class="mod-number" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">6</div>
                                    <h4 class="text-navy-custom">Tecnología Financiera</h4>
                                    <p class="text-muted-custom">
                                        Herramientas y software de gestión contable, automatización de procesos
                                        y transformación digital en la función financiera.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 5. BENEFICIOS PARA EL PROFESIONAL --}}
                {{-- ============================================ --}}
                <section class="fag-section fag-section-alt">
                    <div class="container">
                        <div class="row align-items-center g-5">
                            <div class="col-lg-6" data-aos="fade-right">
                                <h2 class="fw-bold text-navy-custom mb-4">
                                    Lo que obtienes con <span style="color: #e30613;">FAG</span>
                                </h2>
                                <div class="fag-benefit-item">
                                    <i class="fa fa-check-circle" style="color: #4ade80; font-size: 1.1rem;"></i>
                                    <div class="benefit-text">
                                        <strong>Programa de especialización con certificado</strong>
                                        Reconoce tu formación con un certificado verificable y respaldado por ACCA.
                                    </div>
                                </div>
                                <div class="fag-benefit-item">
                                    <i class="fa fa-check-circle" style="color: #4ade80; font-size: 1.1rem;"></i>
                                    <div class="benefit-text">
                                        <strong>Docentes de Big Four y banca en activo</strong>
                                        Aprende directamente de quienes lideran en las firmas y bancos más importantes.
                                    </div>
                                </div>
                                <div class="fag-benefit-item">
                                    <i class="fa fa-check-circle" style="color: #4ade80; font-size: 1.1rem;"></i>
                                    <div class="benefit-text">
                                        <strong>Metodología práctica y aplicable</strong>
                                        Casos reales y herramientas que generan impacto desde la primera clase.
                                    </div>
                                </div>
                                <div class="fag-benefit-item">
                                    <i class="fa fa-check-circle" style="color: #4ade80; font-size: 1.1rem;"></i>
                                    <div class="benefit-text">
                                        <strong>Comunidad LATAM de profesionales</strong>
                                        Conecta con egresados y compañeros de más de 10 países de la región.
                                    </div>
                                </div>
                                <div class="fag-benefit-item">
                                    <i class="fa fa-check-circle" style="color: #4ade80; font-size: 1.1rem;"></i>
                                    <div class="benefit-text">
                                        <strong>Flexibilidad para tu vida profesional</strong>
                                        Clases en vivo y en línea, diseñadas para compatibilizar con tu trabajo.
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6" data-aos="fade-left">
                                <img src="{{ asset('themes/webpage/images/soluciones-equipo.jpg') }}"
                                    alt="Beneficios del programa FAG"
                                    class="img-fluid rounded-4 shadow-sm"
                                    style="border: 1px solid #eef2f7; max-width: 100%;">
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 6. CPA EN NÚMEROS --}}
                {{-- ============================================ --}}
                <section class="fag-section">
                    <div class="container">
                        <div class="fag-stats-band shadow" data-aos="fade-up">
                            <div class="row row-cols-2 row-cols-lg-4 g-4 position-relative">
                                <div class="col fag-stat">
                                    <i class="fa fa-graduation-cap"></i>
                                    <strong>+5,000</strong>
                                    <span>Alumnos formados</span>
                                </div>
                                <div class="col fag-stat">
                                    <i class="fa fa-globe-americas"></i>
                                    <strong>+10</strong>
                                    <span>Países de LATAM</span>
                                </div>
                                <div class="col fag-stat">
                                    <i class="fa fa-chalkboard-teacher"></i>
                                    <strong>+40</strong>
                                    <span>Docentes expertos</span>
                                </div>
                                <div class="col fag-stat">
                                    <i class="fa fa-book-open"></i>
                                    <strong>+25</strong>
                                    <span>Programas de especialización</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 7. CTA FINAL --}}
                {{-- ============================================ --}}
                <section class="fag-section pt-0">
                    <div class="container">
                        <div class="fag-cta text-center" data-aos="fade-up">
                            <h2 class="fw-bold text-white mb-3" style="font-size: 2.2rem;">
                                Da el siguiente paso con <span class="text-warning">FAG</span>
                            </h2>
                            <p class="text-white-50 mx-auto mb-4" style="max-width: 640px; line-height: 1.6;">
                                Únete a la comunidad de profesionales que están impulsando su carrera con
                                CPA Academy y el respaldo de ACCA.
                            </p>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="{{ route('web_courses') }}" class="btn-cta-white text-decoration-none">
                                    <i class="fa fa-graduation-cap me-2"></i>Ver programas
                                </a>
                                <a href="https://wa.me/51967052506?text=/Agente%20Principal" target="_blank"
                                    class="btn-cta-wa text-decoration-none">
                                    <i class="fa-brands fa-whatsapp me-2"></i>Hablar con un experto
                                </a>
                            </div>
                        </div>
                    </div>
                </section>

            </div>
        </div>

        <!-- footer start-->
        <x-footer />
    </div>
@endsection

@section('javascripts')
    <script>
        $(document).ready(function() {
            // Inicializar AOS si la librería está disponible
            if (window.AOS !== undefined) {
                AOS.init({
                    mirror: false,
                    duration: 800,
                    once: true
                });
                AOS.refresh();
            }
        });
    </script>
@endsection
