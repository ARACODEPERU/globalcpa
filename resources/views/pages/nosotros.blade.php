@extends('layouts.webpage')

@section('title', ' - Nosotros')

@section('etiquetasmeta')
    <meta name="description"
        content="Conoce CPA Academy: escuela de negocios con respaldo ACCA, formando contadores y financieros líderes en más de 10 países de LATAM." />
@endsection

@section('content')

    <style>
        /* =========================================
           PÁGINA NOSOTROS
           ========================================= */

        /* Texto navy institucional (compatible modo oscuro) */
        .text-navy-custom { color: #002060 !important; }
        :is(.dark, .dark-only) .text-navy-custom { color: #f6f7fb !important; }

        .text-muted-custom { color: #6b7280; }
        :is(.dark, .dark-only) .text-muted-custom { color: #9ca3af !important; }

        /* Fondo de tarjetas claras (compatible modo oscuro) */
        .bg-card-custom {
            background-color: #ffffff !important;
            border: 1px solid #eef2f7;
        }
        :is(.dark, .dark-only) .bg-card-custom {
            background-color: #1d273a !important;
            border-color: #374558 !important;
        }

        /* Secciones alternadas */
        .nos-section { padding: 70px 0; }
        .nos-section-alt {
            background-color: #f8f9fa;
        }
        :is(.dark, .dark-only) .nos-section-alt {
            background-color: #111827;
        }

        /* --- Hero --- */
        .nos-hero {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 20px;
            border: 0;
            overflow: hidden;
            position: relative;
        }
        .nos-hero::after {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.25) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .nos-hero-tag {
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

        /* --- Quiénes somos: tarjeta flotante de datos --- */
        .nos-image-frame {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 32, 96, 0.25);
        }
        .nos-image-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .nos-stats-float {
            position: absolute;
            left: 20px;
            bottom: 20px;
            right: 20px;
            display: flex;
            gap: 15px;
        }
        .nos-stats-float .float-stat {
            flex: 1;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 14px;
            padding: 14px 10px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .nos-stats-float .float-stat strong {
            display: block;
            font-size: 1.4rem;
            font-weight: 800;
            color: #e30613;
            line-height: 1.2;
        }
        .nos-stats-float .float-stat span {
            font-size: 0.78rem;
            color: #4b5563;
            font-weight: 600;
        }
        :is(.dark, .dark-only) .nos-stats-float .float-stat {
            background: rgba(17, 24, 39, 0.92);
        }
        :is(.dark, .dark-only) .nos-stats-float .float-stat span {
            color: #d1d5db;
        }

        /* --- Misión / Visión / Valores --- */
        .nos-value-card {
            height: 100%;
            padding: 35px 28px;
            border-radius: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .nos-value-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(0, 32, 96, 0.12);
        }
        .nos-value-card .value-icon {
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
        .nos-value-card h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .nos-value-card p {
            font-size: 0.95rem;
            line-height: 1.65;
            margin-bottom: 0;
        }

        /* --- CPA en números --- */
        .nos-counter {
            text-align: center;
            padding: 25px 10px;
            border-radius: 18px;
            height: 100%;
        }
        .nos-counter i {
            font-size: 30px;
            margin-bottom: 12px;
            display: block;
        }
        .nos-counter strong {
            display: block;
            font-size: 2.2rem;
            font-weight: 800;
            line-height: 1.1;
        }
        .nos-counter span {
            font-size: 0.9rem;
            font-weight: 600;
        }
        .nos-counter.red { color: #e30613; }
        .nos-counter.navy { color: #002060; }
        :is(.dark, .dark-only) .nos-counter.navy { color: #f6f7fb; }

        /* --- Banda ACCA --- */
        .nos-acca {
            display: flex;
            align-items: center;
            gap: 25px;
            padding: 35px;
            border-radius: 20px;
        }
        .nos-acca img {
            width: 150px;
            flex-shrink: 0;
        }

        /* --- CTA final --- */
        .nos-cta {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 24px;
            padding: 55px 40px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }
        .nos-cta::before {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.2) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .nos-cta .btn-cta-white {
            background: #ffffff;
            color: #002060;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }
        .nos-cta .btn-cta-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            color: #e30613;
        }
        .nos-cta .btn-cta-wa {
            background: #25d366;
            color: #ffffff;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }
        .nos-cta .btn-cta-wa:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.35);
            background: #1fb959;
            color: #ffffff;
        }

        @media (max-width: 767.98px) {
            .nos-section { padding: 45px 0; }
            .nos-acca { flex-direction: column; text-align: center; }
            .nos-cta { padding: 40px 25px; }
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
                    <div class="card nos-hero shadow mb-4" data-aos="fade-in">
                        <div class="card-body p-4 p-lg-5 position-relative">
                            <div class="row align-items-center">
                                <div class="col-lg-7">
                                    <nav aria-label="breadcrumb" class="mb-3">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item">
                                                <a href="{{ route('index_main') }}"
                                                    class="text-white-50 text-decoration-none text-uppercase small fw-bold"
                                                    style="letter-spacing: 1px;">
                                                    <i class="fas fa-home me-1"></i> Inicio
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active text-white text-uppercase small fw-bold"
                                                style="letter-spacing: 1px;" aria-current="page">
                                                Nosotros
                                            </li>
                                        </ol>
                                    </nav>

                                    <h1 class="display-4 fw-bold text-white mb-3">
                                        Somos <span class="text-warning">CPA Academy</span>
                                    </h1>
                                    <p class="lead text-white-50 mb-4" style="max-width: 600px; line-height: 1.6;">
                                        Escuela de negocios dedicada a la formación de profesionales en contabilidad,
                                        finanzas y auditoría, con estándares internacionales y aprendizaje aplicable
                                        al mundo real.
                                    </p>

                                    <div class="d-flex flex-wrap gap-3">
                                        <span class="nos-hero-tag">
                                            <i class="fas fa-certificate text-warning"></i> Respaldo ACCA
                                        </span>
                                        <span class="nos-hero-tag">
                                            <i class="fas fa-globe text-warning"></i> Alumnos en +10 países de LATAM
                                        </span>
                                        <span class="nos-hero-tag">
                                            <i class="fas fa-users text-warning"></i> Docentes expertos
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-5 d-none d-lg-block text-center">
                                    <img src="{{ asset('themes/webpage/images/Logo_cpa_blanco.png') }}"
                                        alt="CPA Academy" class="img-fluid" style="max-width: 320px; opacity: 0.95;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ============================================ --}}
                {{-- 2. QUIÉNES SOMOS --}}
                {{-- ============================================ --}}
                <section class="nos-section">
                    <div class="container">
                        <div class="row align-items-center g-5">
                            <div class="col-lg-6" data-aos="fade-right">
                                <h2 class="fw-bold text-navy-custom mb-4">
                                    Formamos al talento que <span style="color: #e30613;">transforma</span> empresas
                                </h2>
                                <p class="text-muted-custom" style="line-height: 1.8; font-size: 1.02rem;">
                                    En <strong>CPA Academy</strong> creemos que el crecimiento profesional se construye
                                    con conocimiento aplicable. Por eso diseñamos programas de especialización que
                                    combinan la experiencia de docentes de Big Four, banca y organismos
                                    internacionales con metodologías de aprendizaje prácticas.
                                </p>
                                <p class="text-muted-custom" style="line-height: 1.8; font-size: 1.02rem;">
                                    Somos la única escuela de negocios peruana reconocida oficialmente por
                                    <strong>ACCA</strong> como <em>Approved Learning Partner</em>, y nuestra comunidad
                                    de alumnos se extiende por más de 10 países de Latinoamérica.
                                </p>
                                <p class="text-muted-custom mb-0" style="line-height: 1.8; font-size: 1.02rem;">
                                    Desde Lima, formamos al equipo de profesionales que las empresas más importantes
                                    del país confían para liderar sus áreas de contabilidad, finanzas y auditoría.
                                </p>
                            </div>
                            <div class="col-lg-6" data-aos="fade-left">
                                <div class="nos-image-frame" style="min-height: 380px;">
                                    <img src="{{ asset('themes/webpage/images/soluciones-equipo.jpg') }}"
                                        alt="Equipo de profesionales de CPA Academy">
                                    <div class="nos-stats-float">
                                        <div class="float-stat">
                                            <strong>+10</strong>
                                            <span>Años formando profesionales</span>
                                        </div>
                                        <div class="float-stat">
                                            <strong>+10</strong>
                                            <span>Países de LATAM</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 3. MISIÓN, VISIÓN Y VALORES --}}
                {{-- ============================================ --}}
                <section class="nos-section nos-section-alt">
                    <div class="container">
                        <div class="text-center mb-5" data-aos="fade-up">
                            <h2 class="fw-bold text-navy-custom">Misión, Visión y Valores</h2>
                            <p class="text-muted-custom mx-auto" style="max-width: 700px;">
                                Los principios que guían cada programa, cada clase y cada logro de nuestra comunidad.
                            </p>
                        </div>
                        <div class="row row-cols-1 row-cols-md-3 g-4">
                            <div class="col" data-aos="fade-up" data-aos-delay="100">
                                <div class="nos-value-card bg-card-custom shadow-sm">
                                    <div class="value-icon" style="background: linear-gradient(135deg, #e30613 0%, #a0040d 100%);">
                                        <i class="fas fa-bullseye"></i>
                                    </div>
                                    <h3 class="text-navy-custom">Misión</h3>
                                    <p class="text-muted-custom">
                                        Formar profesionales de clase mundial en contabilidad, finanzas y auditoría,
                                        con programas prácticos y estándares internacionales que generan impacto
                                        inmediato en su carrera y en sus organizaciones.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="200">
                                <div class="nos-value-card bg-card-custom shadow-sm">
                                    <div class="value-icon" style="background: linear-gradient(135deg, #002060 0%, #004080 100%);">
                                        <i class="fas fa-eye"></i>
                                    </div>
                                    <h3 class="text-navy-custom">Visión</h3>
                                    <p class="text-muted-custom">
                                        Ser la escuela de negocios de referencia en Latinoamérica para la formación
                                        del talento contable y financiero, reconocida por la excelencia académica y
                                        el respaldo de organismos internacionales.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="300">
                                <div class="nos-value-card bg-card-custom shadow-sm">
                                    <div class="value-icon" style="background: linear-gradient(135deg, #2c3e50 0%, #4b6584 100%);">
                                        <i class="fas fa-handshake"></i>
                                    </div>
                                    <h3 class="text-navy-custom">Valores</h3>
                                    <p class="text-muted-custom">
                                        Excelencia académica, compromiso con el alumno, ética profesional,
                                        innovación constante y aprendizaje aplicable que convierte el conocimiento
                                        en resultados reales.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 4. CPA EN NÚMEROS --}}
                {{-- ============================================ --}}
                <section class="nos-section">
                    <div class="container">
                        <div class="text-center mb-5" data-aos="fade-up">
                            <h2 class="fw-bold text-navy-custom">CPA en números</h2>
                        </div>
                        <div class="row row-cols-2 row-cols-lg-4 g-4">
                            <div class="col" data-aos="zoom-in" data-aos-delay="100">
                                <div class="nos-counter bg-card-custom shadow-sm red">
                                    <i class="fas fa-graduation-cap"></i>
                                    <strong>+5,000</strong>
                                    <span class="text-muted-custom">Alumnos formados</span>
                                </div>
                            </div>
                            <div class="col" data-aos="zoom-in" data-aos-delay="200">
                                <div class="nos-counter bg-card-custom shadow-sm navy">
                                    <i class="fas fa-globe-americas"></i>
                                    <strong>+10</strong>
                                    <span class="text-muted-custom">Países de LATAM</span>
                                </div>
                            </div>
                            <div class="col" data-aos="zoom-in" data-aos-delay="300">
                                <div class="nos-counter bg-card-custom shadow-sm red">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <strong>+40</strong>
                                    <span class="text-muted-custom">Docentes expertos</span>
                                </div>
                            </div>
                            <div class="col" data-aos="zoom-in" data-aos-delay="400">
                                <div class="nos-counter bg-card-custom shadow-sm navy">
                                    <i class="far fa-bookpen"></i>
                                    <strong>+25</strong>
                                    <span class="text-muted-custom">Programas de especialización</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 5. EQUIPO DIRECTIVO --}}
                {{-- ============================================ --}}
                <section class="nos-section nos-section-alt">
                    <div class="container-fluid" data-aos="fade-up">
                        <x-visionaries />
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 6. RESPALDO Y ALIANZAS --}}
                {{-- ============================================ --}}
                <section class="nos-section">
                    <div class="container">
                        <div class="nos-acca bg-card-custom shadow-sm mb-5" data-aos="fade-up">
                            <img src="{{ asset('themes/webpage/images/acca.png') }}" alt="ACCA Approved Learning Partner">
                            <div>
                                <h3 class="fw-bold text-navy-custom mb-2">
                                    <i class="fas fa-certificate" style="color: #e30613;"></i>
                                    Respaldo ACCA
                                </h3>
                                <p class="text-muted-custom mb-0" style="line-height: 1.7;">
                                    Somos la única escuela de negocios peruana reconocida oficialmente por la
                                    <strong>Association of Chartered Certified Accountants (ACCA)</strong> como
                                    <em>Approved Learning Partner</em>, el respaldo internacional más importante
                                    para la formación contable y financiera.
                                </p>
                            </div>
                        </div>

                        <x-clients-logo />
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 7. CTA FINAL --}}
                {{-- ============================================ --}}
                <section class="nos-section pt-0">
                    <div class="container">
                        <div class="nos-cta text-center" data-aos="fade-up">
                            <h2 class="fw-bold text-white mb-3" style="font-size: 2.2rem;">
                                Impulsa tu carrera con <span class="text-warning">CPA Academy</span>
                            </h2>
                            <p class="text-white-50 mx-auto mb-4" style="max-width: 640px;">
                                Únete a la comunidad de profesionales que están transformando su futuro con
                                programas de especialización de estándares internacionales.
                            </p>
                            <div class="d-flex flex-wrap justify-content-center gap-3">
                                <a href="{{ route('web_courses') }}" class="btn-cta-white text-decoration-none">
                                    <i class="fas fa-graduation-cap me-2"></i>Ver programas
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
