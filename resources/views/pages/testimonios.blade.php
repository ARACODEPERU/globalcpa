@extends('layouts.webpage')

@section('title', ' - Testimonios')

@section('etiquetasmeta')
    <meta name="description"
        content="Historias reales de profesionales que transformaron su carrera con CPA Academy. Conoce los testimonios de nuestros egresados en LATAM." />
@endsection

@section('content')

    <style>
        /* =========================================
           PÁGINA TESTIMONIOS
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

        .tst-section { padding: 70px 0; }
        .tst-section-alt { background-color: #f8f9fa; }
        :is(.dark, .dark-only) .tst-section-alt { background-color: #111827; }

        /* --- Hero --- */
        .tst-hero {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 20px;
            border: 0;
            overflow: hidden;
            position: relative;
        }
        .tst-hero::after {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.25) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .tst-hero-tag {
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

        /* --- Franja de estadísticas --- */
        .tst-stats-band {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 24px;
            padding: 45px 30px;
            position: relative;
            overflow: hidden;
        }
        .tst-stats-band::before {
            content: '';
            position: absolute;
            bottom: -100px;
            right: -100px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.2) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .tst-stat { text-align: center; color: #ffffff; }
        .tst-stat i { font-size: 28px; color: #ffc107; margin-bottom: 10px; display: block; }
        .tst-stat strong { display: block; font-size: 2.2rem; font-weight: 800; line-height: 1.1; }
        .tst-stat span { font-size: 0.9rem; color: rgba(255, 255, 255, 0.75); font-weight: 600; }

        /* --- Testimonio destacado --- */
        .tst-featured {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 24px;
            padding: 50px 45px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }
        .tst-featured::before {
            content: '\201C';
            position: absolute;
            top: -30px;
            left: 15px;
            font-size: 14rem;
            font-weight: 800;
            color: rgba(255, 255, 255, 0.07);
            font-family: Georgia, serif;
            line-height: 1;
            pointer-events: none;
        }
        .tst-featured blockquote {
            font-size: 1.35rem;
            line-height: 1.7;
            font-weight: 500;
            font-style: italic;
            margin-bottom: 25px;
            position: relative;
            z-index: 1;
            /* Reset del estilo de blockquote del tema */
            background: transparent !important;
            border: none !important;
            padding: 0 !important;
            margin-top: 0;
            color: #ffffff;
        }
        .tst-featured-avatar {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ffc107;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.3);
        }
        .tst-featured-name { font-weight: 700; font-size: 1.1rem; margin-bottom: 2px; }
        .tst-featured-role { font-size: 0.9rem; color: rgba(255, 255, 255, 0.7); }
        .tst-featured-stars { color: #ffc107; font-size: 1rem; }

        /* --- Muro de testimonios --- */
        .tst-card {
            height: 100%;
            border-radius: 20px;
            padding: 30px 28px;
            display: flex;
            flex-direction: column;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .tst-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(0, 32, 96, 0.12);
        }
        .tst-card .tst-quote-mark {
            color: #e30613;
            font-size: 2rem;
            line-height: 1;
            font-family: Georgia, serif;
            margin-bottom: 10px;
        }
        .tst-card .tst-text {
            font-size: 0.98rem;
            line-height: 1.7;
            color: #4b5563;
            flex: 1;
            font-style: italic;
        }
        :is(.dark, .dark-only) .tst-card .tst-text { color: #9ca3af; }
        .tst-card .tst-stars { color: #ffc107; font-size: 0.85rem; margin-bottom: 15px; }
        .tst-card .tst-author {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 20px;
            padding-top: 20px;
            border-top: 1px dashed rgba(128, 128, 128, 0.25);
        }
        .tst-card .tst-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #002060;
            flex-shrink: 0;
        }
        .tst-card .tst-name { font-weight: 700; font-size: 0.98rem; margin-bottom: 2px; }
        .tst-card .tst-role { font-size: 0.82rem; }

        /* --- Marquee --- */
        .tst-marquee-viewport {
            overflow: hidden;
            padding: 10px 0;
            width: 100%;
        }
        .tst-marquee-track {
            display: flex;
            gap: 30px;
            width: max-content;
            animation: tst-scroll 50s linear infinite;
        }
        .tst-marquee-viewport:hover .tst-marquee-track { animation-play-state: paused; }
        @keyframes tst-scroll {
            0% { transform: translateX(0); }
            50% { transform: translateX(-50%); }
        }
        .tst-mini-card {
            width: 320px;
            flex-shrink: 0;
            border-radius: 15px;
            padding: 25px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 180px;
        }
        .tst-mini-card .tst-mini-quote {
            font-size: 0.92rem;
            line-height: 1.6;
            font-style: italic;
            margin-bottom: 15px;
        }
        .tst-mini-card .tst-mini-author { display: flex; align-items: center; gap: 12px; }
        .tst-mini-card .tst-mini-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e30613;
        }
        .tst-mini-card .tst-mini-name { font-weight: 700; font-size: 0.9rem; margin-bottom: 1px; }
        .tst-mini-card .tst-mini-role { font-size: 0.78rem; }

        /* --- CTA final --- */
        .tst-cta {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 24px;
            padding: 55px 40px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }
        .tst-cta::before {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.2) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .tst-cta .btn-cta-white {
            background: #ffffff;
            color: #002060;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }
        .tst-cta .btn-cta-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            color: #e30613;
        }
        .tst-cta .btn-cta-wa {
            background: #25d366;
            color: #ffffff;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }
        .tst-cta .btn-cta-wa:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.35);
            background: #1fb959;
            color: #ffffff;
        }

        @media (max-width: 767.98px) {
            .tst-section { padding: 45px 0; }
            .tst-cta { padding: 40px 25px; }
            .tst-featured { padding: 35px 25px; }
            .tst-featured blockquote { font-size: 1.1rem; }
            .tst-stat strong { font-size: 1.7rem; }
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
                    <div class="card tst-hero shadow mb-4" data-aos="fade-in">
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
                                                Testimonios
                                            </li>
                                        </ol>
                                    </nav>

                                    <h1 class="display-4 fw-bold text-white mb-3">
                                        Historias que <span class="text-warning">inspiran</span>
                                    </h1>
                                    <p class="lead text-white-50 mb-4" style="max-width: 620px; line-height: 1.6;">
                                        Profesionales de Latinoamérica transformaron su carrera con CPA Academy.
                                        Estos son sus relatos, en sus propias palabras.
                                    </p>

                                    <div class="d-flex flex-wrap gap-3">
                                        <span class="tst-hero-tag">
                                            <i class="fa fa-star text-warning"></i> Egresados reales
                                        </span>
                                        <span class="tst-hero-tag">
                                            <i class="fa fa-globe text-warning"></i> +10 países de LATAM
                                        </span>
                                        <span class="tst-hero-tag">
                                            <i class="fa fa-briefcase text-warning"></i> En las mejores empresas
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ============================================ --}}
                {{-- 2. ESTADÍSTICAS --}}
                {{-- ============================================ --}}
                <section class="tst-section pt-0">
                    <div class="container">
                        <div class="tst-stats-band shadow" data-aos="fade-up">
                            <div class="row row-cols-2 row-cols-lg-4 g-4 position-relative">
                                <div class="col tst-stat">
                                    <i class="fa fa-thumbs-up"></i>
                                    <strong>98%</strong>
                                    <span>Nos recomiendan</span>
                                </div>
                                <div class="col tst-stat">
                                    <i class="fa fa-graduation-cap"></i>
                                    <strong>+5,000</strong>
                                    <span>Alumnos formados</span>
                                </div>
                                <div class="col tst-stat">
                                    <i class="fa fa-star"></i>
                                    <strong>4.9/5</strong>
                                    <span>Puntuación promedio</span>
                                </div>
                                <div class="col tst-stat">
                                    <i class="fa fa-briefcase"></i>
                                    <strong>+85%</strong>
                                    <span>Promueven o mejoran su empleo</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 3. TESTIMONIO DESTACADO --}}
                {{-- ============================================ --}}
                <section class="tst-section pt-0">
                    <div class="container">
                        <div class="tst-featured shadow" data-aos="zoom-in">
                            <div class="row align-items-center position-relative">
                                <div class="col-lg-9">
                                    <div class="tst-featured-stars mb-3">
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                        <i class="fa fa-star"></i>
                                    </div>
                                    <blockquote>
                                        "Llegué a CPA Academy buscando actualizar mis conocimientos en NIIF y
                                        encontré mucho más: docentes que trabajan en las firmas donde siempre
                                        quise estar, casos reales de empresas peruanas y una comunidad que me
                                        abrió las puertas a mi puesto actual. Fue el punto de quiebre de mi
                                        carrera."
                                    </blockquote>
                                    <div class="d-flex align-items-center gap-3">
                                        <img src="https://ui-avatars.com/api/?name=Maria+Fernandez&size=140&rounded=true&background=002060&color=ffffff&bold=true"
                                            alt="María Fernández" class="tst-featured-avatar">
                                        <div>
                                            <p class="tst-featured-name mb-0">María Fernández</p>
                                            <p class="tst-featured-role mb-0">
                                                Supervisora de Auditoría · Big Four · Egresada del Programa de
                                                Especialización en NIIF
                                            </p>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-3 text-center d-none d-lg-block">
                                    <i class="fa fa-quote-right" style="font-size: 7rem; opacity: 0.15;"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 4. MURO DE TESTIMONIOS --}}
                {{-- ============================================ --}}
                <section class="tst-section tst-section-alt">
                    <div class="container">
                        <div class="text-center mb-5" data-aos="fade-up">
                            <h2 class="fw-bold text-navy-custom">Lo que dicen nuestros egresados</h2>
                            <p class="text-muted-custom mx-auto" style="max-width: 700px;">
                                Testimonios de profesionales que confiaron en CPA Academy para dar el
                                siguiente paso.
                            </p>
                        </div>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            @php
                                $wallTestimonials = [
                                    [
                                        'name' => 'Carlos Ramírez',
                                        'role' => 'Gerente de Contabilidad · Retail',
                                        'program' => 'Especialización en NIIF',
                                        'quote' => 'Los docentes no solo dominan el tema: saben transmitirlo con casos que viví la misma semana en mi trabajo. Pase de preparar papeles de trabajo a liderar el cierre contable de mi empresa.',
                                    ],
                                    [
                                        'name' => 'Lucía Torres',
                                        'role' => 'Analista Financiero · Sector Bancario',
                                        'program' => 'Finanzas Corporativas',
                                        'quote' => 'La plataforma es muy práctica: puedo repasar las clases a mi ritmo y el material queda disponible siempre. Aprobé mi certificación interna del banco con lo aprendido aquí.',
                                    ],
                                    [
                                        'name' => 'Jorge Salazar',
                                        'role' => 'Auditor Senior · Firma Regional',
                                        'program' => 'Auditoría Interna',
                                        'quote' => 'Lo que más valoro es la honestidad académica: te enseñan lo que se aplica hoy, con las normas vigentes y los criterios reales de las firmas. Sin relleno.',
                                    ],
                                    [
                                        'name' => 'Ana Paula Céspedes',
                                        'role' => 'Jefa de Presupuestos · Minería',
                                        'program' => 'Presupuestos y Costos',
                                        'quote' => 'Vengo de otra academia y la diferencia es enorme. En CPA el seguimiento es personal: notaron mis fortalezas y me recomendaron el programa perfecto para mi siguiente paso.',
                                    ],
                                    [
                                        'name' => 'Diego Mendoza',
                                        'role' => 'Contador General · Agroexportación',
                                        'program' => 'Tributación',
                                        'quote' => 'Los módulos de tributación me ayudaron a reestructurar los procesos de mi empresa. Recuperé la inversión del programa en el primer trimestre, solo con multas evitadas.',
                                    ],
                                    [
                                        'name' => 'Valeria Núñez',
                                        'role' => 'Socia · Estudio Contable',
                                        'program' => 'Programa para Empresas',
                                        'quote' => 'Capacité a todo mi equipo con los programas in-company. Ahora hablamos el mismo idioma técnico y la calidad de nuestros informes a clientes mejoró notablemente.',
                                    ],
                                ];
                            @endphp

                            @foreach ($wallTestimonials as $t)
                                <div class="col" data-aos="fade-up" data-aos-delay="{{ 100 * (($loop->index % 3) + 1) }}">
                                    <div class="tst-card bg-card-custom shadow-sm">
                                        <div>
                                            <div class="tst-stars">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </div>
                                            <div class="tst-quote-mark">"</div>
                                            <p class="tst-text">{{ $t['quote'] }}</p>
                                        </div>
                                        <div class="tst-author">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($t['name']) }}&size=104&rounded=true&background=e30613&color=ffffff&bold=true"
                                                alt="{{ $t['name'] }}" class="tst-avatar" loading="lazy">
                                            <div>
                                                <p class="tst-name text-navy-custom mb-0">{{ $t['name'] }}</p>
                                                <p class="tst-role text-muted-custom mb-0">{{ $t['role'] }}</p>
                                                <p class="tst-role mb-0" style="color: #e30613; font-weight: 600;">
                                                    {{ $t['program'] }}
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 5. CARRUSEL MARQUEE --}}
                {{-- ============================================ --}}
                <section class="tst-section">
                    <div class="container-fluid">
                        <div class="text-center mb-4" data-aos="fade-up">
                            <h2 class="fw-bold text-navy-custom">Palabras que nos impulsan</h2>
                        </div>
                        <div class="tst-marquee-viewport" data-aos="fade-up">
                            <div class="tst-marquee-track">
                                @php
                                    $miniTestimonials = [
                                        ['name' => 'Ricardo Quispe', 'role' => 'Controller · Manufactura', 'quote' => 'La inversión se pagó sola con mi promoción.'],
                                        ['name' => 'Gabriela Ríos', 'role' => 'Auditora · Big Four', 'quote' => 'Entré al banco de talentos de la firma gracias a la especialización.'],
                                        ['name' => 'Martín Villanueva', 'role' => 'CFO · Pyme', 'quote' => 'Como dueño de negocio, las clases de NIIF me cambiaron la forma de ver mis estados financieros.'],
                                        ['name' => 'Cristina Paredes', 'role' => 'Supervisora Tributaria', 'quote' => 'Docentes que responden tus dudas reales, no de manual.'],
                                        ['name' => 'Luis Arana', 'role' => 'Jefe de Costos · Construcción', 'quote' => 'Los casos de la construcción eran exactamente los de mis obras.'],
                                        ['name' => 'Fiorella Castro', 'role' => 'Analista de Tesorería', 'quote' => 'Pase de asistente a analista en un año. La clave: aplicar cada clase.'],
                                    ];
                                    $loopSet = array_merge($miniTestimonials, $miniTestimonials);
                                @endphp

                                @foreach ($loopSet as $t)
                                    <div class="tst-mini-card bg-card-custom shadow-sm">
                                        <p class="tst-mini-quote text-muted-custom">"{{ $t['quote'] }}"</p>
                                        <div class="tst-mini-author">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($t['name']) }}&size=88&rounded=true&background=002060&color=ffffff&bold=true"
                                                alt="{{ $t['name'] }}" class="tst-mini-avatar" loading="lazy">
                                            <div>
                                                <p class="tst-mini-name text-navy-custom mb-0">{{ $t['name'] }}</p>
                                                <p class="tst-mini-role text-muted-custom mb-0">{{ $t['role'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 6. CTA FINAL --}}
                {{-- ============================================ --}}
                <section class="tst-section pt-0">
                    <div class="container">
                        <div class="tst-cta text-center" data-aos="fade-up">
                            <h2 class="fw-bold text-white mb-3" style="font-size: 2.2rem;">
                                Tu historia puede ser la <span class="text-warning">próxima</span>
                            </h2>
                            <p class="text-white-50 mx-auto mb-4" style="max-width: 640px;">
                                Miles de profesionales ya transformaron su carrera con CPA Academy.
                                Empieza hoy el tuyo.
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
