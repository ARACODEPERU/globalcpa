@extends('layouts.webpage')

@section('title', ' - Preguntas Frecuentes')

@section('etiquetasmeta')
    <meta name="description"
        content="CPA Academy - Preguntas Frecuentes: resolución de dudas sobre programas, inscripciones, pagos, certificados y más. Consulta aquí tus preguntas sobre la formación contable y financiera." />
@endsection

@section('content')

    <style>
        /* =========================================
           PÁGINA PREGUNTAS FRECUENTES (FAQ)
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

        .faq-section { padding: 70px 0; }
        .faq-section-alt { background-color: #f8f9fa; }
        :is(.dark, .dark-only) .faq-section-alt { background-color: #111827; }

        /* --- Hero --- */
        .faq-hero {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 20px;
            border: 0;
            overflow: hidden;
            position: relative;
        }
        .faq-hero::after {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.25) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .faq-hero-tag {
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

        /* --- Buscador --- */
        .faq-search-box {
            background: #ffffff;
            border-radius: 16px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0, 32, 96, 0.08);
            border: 1px solid #eef2f7;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }
        .faq-search-box:focus-within {
            border-color: #e30613;
            box-shadow: 0 10px 40px rgba(227, 6, 19, 0.1);
        }
        .faq-search-input {
            border: none;
            outline: none;
            font-size: 1rem;
            padding: 14px 20px;
            width: 100%;
            background: transparent;
            border-radius: 8px;
        }
        .faq-search-btn {
            background: linear-gradient(135deg, #e30613 0%, #a0040d 100%);
            color: #ffffff;
            border: none;
            border-radius: 50px;
            padding: 12px 28px;
            font-weight: 700;
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }
        .faq-search-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(227, 6, 19, 0.3);
        }

        /* --- Acordeones por categoría --- */
        .faq-category-header {
            text-transform: uppercase;
            letter-spacing: 0.05em;
            font-size: 1.1rem;
            font-weight: 800;
            padding-bottom: 15px;
            margin-bottom: 20px;
            border-bottom: 3px solid #e30613;
            display: inline-block;
        }
        .faq-accordion {
            margin-bottom: 20px;
        }
        .faq-accordion-item {
            border: 1px solid #eef2f7;
            border-radius: 12px;
            overflow: hidden;
            margin-bottom: 12px;
            transition: box-shadow 0.3s ease;
        }
        .faq-accordion-item:hover {
            box-shadow: 0 5px 15px rgba(0, 32, 96, 0.05);
        }
        .faq-accordion-button {
            width: 100%;
            padding: 18px 20px;
            background: #ffffff;
            border: none;
            border-radius: 12px;
            text-align: left;
            font-size: 0.98rem;
            font-weight: 600;
            color: #4b5563;
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
        }
        .faq-accordion-button:hover { background: #fafbfc; }
        .faq-accordion-button .faq-question-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 28px;
            height: 28px;
            border-radius: 50%;
            background: #002060;
            color: #ffffff;
            font-size: 0.75rem;
            font-weight: 800;
            flex-shrink: 0;
        }
        .faq-accordion-button .faq-question-text { flex: 1; line-height: 1.5; }
        .faq-accordion-button svg { flex-shrink: 0; color: #9ca3af; }
        :is(.dark, .dark-only) .faq-accordion-button { color: #d1d5db; }

        .faq-accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(0, 32, 96, 0.15);
        }
        .faq-accordion-button:not(.collapsed) .faq-question-number {
            background: #e30613;
        }
        :is(.dark, .dark-only) .faq-accordion-button:not(.collapsed) {
            background: linear-gradient(135deg, #1d273a 0%, #374558 100%);
        }

        .faq-accordion-body {
            padding: 0 20px;
            max-height: 0;
            overflow: hidden;
            transition: max-height 0.35s ease, padding 0.35s ease;
        }
        .faq-accordion-body p {
            padding: 16px 0 20px 0;
            font-size: 0.95rem;
            line-height: 1.7;
            color: #6b7280;
            margin: 0;
        }
        :is(.dark, .dark-only) .faq-accordion-body p { color: #9ca3af; }

        /* --- Franja de números --- */
        .faq-stats-band {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 24px;
            padding: 45px 30px;
            position: relative;
            overflow: hidden;
        }
        .faq-stats-band::before {
            content: '';
            position: absolute;
            bottom: -100px;
            right: -100px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.2) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .faq-stat { text-align: center; color: #ffffff; }
        .faq-stat i { font-size: 28px; color: #ffc107; margin-bottom: 10px; display: block; }
        .faq-stat strong { display: block; font-size: 2.2rem; font-weight: 800; line-height: 1.1; }
        .faq-stat span { font-size: 0.9rem; color: rgba(255, 255, 255, 0.75); font-weight: 600; }

        /* --- CTA final --- */
        .faq-cta {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 24px;
            padding: 55px 40px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }
        .faq-cta::before {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.2) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .faq-cta .btn-cta-white {
            background: #ffffff;
            color: #002060;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }
        .faq-cta .btn-cta-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            color: #e30613;
        }
        .faq-cta .btn-cta-wa {
            background: #25d366;
            color: #ffffff;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }
        .faq-cta .btn-cta-wa:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.35);
            background: #1fb959;
            color: #ffffff;
        }

        @media (max-width: 767.98px) {
            .faq-section { padding: 45px 0; }
            .faq-cta { padding: 40px 25px; }
            .faq-stat strong { font-size: 1.7rem; }
            .faq-search-box { padding: 20px; }
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
                    <div class="card faq-hero shadow mb-4" data-aos="fade-in">
                        <div class="card-body p-4 p-lg-5 position-relative">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
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
                                                Preguntas Frecuentes
                                            </li>
                                        </ol>
                                    </nav>

                                    <h1 class="display-4 fw-bold text-white mb-3">
                                        <span class="text-warning">Resolvemos</span> tus dudas
                                    </h1>
                                    <p class="lead text-white-50 mb-4" style="max-width: 620px; line-height: 1.6;">
                                        Encuentra respuestas rápidas sobre nuestros programas, inscripciones,
                                        pagos, certificados y más. ¿No encuentras lo que buscas? Habla directamente
                                        con un experto.
                                    </p>

                                    <div class="d-flex flex-wrap gap-3">
                                        <span class="faq-hero-tag">
                                            <i class="fas fa-question-circle text-warning"></i> Dudas frecuentes
                                        </span>
                                        <span class="faq-hero-tag">
                                            <i class="fas fa-graduation-cap text-warning"></i> +5,000 alumnos
                                        </span>
                                        <span class="faq-hero-tag">
                                            <i class="fas fa-certificate text-warning"></i> Respaldo ACCA
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                {{-- ============================================ --}}
                {{-- 2. BUSCADOR --}}
                {{-- ============================================ --}}
                <section class="faq-section">
                    <div class="container">
                        <div class="faq-search-box text-center" data-aos="fade-up">
                            <h4 class="fw-bold text-navy-custom mb-3">¿Buscas algo específico?</h4>
                            <p class="text-muted-custom mb-4" style="font-size: 0.9rem; max-width: 500px; margin: 0 auto 20px;">
                                Escribe una palabra clave y encuentra la pregunta que necesitas.
                            </p>
                            <form class="d-flex gap-3 justify-content-center">
                                <input type="text"
                                    class="faq-search-input"
                                    id="faqSearchInput"
                                    placeholder="Ej: certificado, ACCA, inscripción..."
                                    aria-label="Buscar en preguntas frecuentes">
                                <button type="button" class="faq-search-btn" id="faqSearchBtn">
                                    <i class="fas fa-search me-2"></i>Buscar
                                </button>
                            </form>
                        </div>
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 3. PREGUNTAS POR CATEGORÍA --}}
                {{-- ============================================ --}}
                <section class="faq-section faq-section-alt">
                    <div class="container">

                        <div class="row g-5">
                            <div class="col-lg-4">
                                {{-- Navegación por categorías --}}
                                <div class="list-group list-group-flush bg-card-custom shadow-sm rounded-4 p-3 sticky-lg-top" style="top: 20px;">
                                    <small class="text-muted-custom text-uppercase fw-bold" style="font-size: 0.7rem; letter-spacing: 1px;">Categorías</small>
                                    <a href="#cat-programas" class="list-group-item list-group-item-action list-group-item-dark bg-transparent py-2 px-3 rounded-3 fw-semibold text-navy-custom text-decoration-none d-flex align-items-center gap-2 border-0">
                                        <i class="far fa-bookpen" style="color: #002060;"></i>
                                        <span class="d-none d-md-inline">Programas y cursos</span>
                                    </a>
                                    <a href="#cat-inscripcion" class="list-group-item list-group-item-action list-group-item-dark bg-transparent py-2 px-3 rounded-3 fw-semibold text-navy-custom text-decoration-none d-flex align-items-center gap-2 border-0">
                                        <i class="fas fa-pen" style="color: #002060;"></i>
                                        <span class="d-none d-md-inline">Inscripción y pagos</span>
                                    </a>
                                    <a href="#cat-certificados" class="list-group-item list-group-item-action list-group-item-dark bg-transparent py-2 px-3 rounded-3 fw-semibold text-navy-custom text-decoration-none d-flex align-items-center gap-2 border-0">
                                        <i class="fas fa-certificate" style="color: #002060;"></i>
                                        <span class="d-none d-md-inline">Certificados</span>
                                    </a>
                                    <a href="#cat-general" class="list-group-item list-group-item-action list-group-item-dark bg-transparent py-2 px-3 rounded-3 fw-semibold text-navy-custom text-decoration-none d-flex align-items-center gap-2 border-0">
                                        <i class="fas fa-comments" style="color: #002060;"></i>
                                        <span class="d-none d-md-inline">General</span>
                                    </a>
                                </div>
                            </div>

                            <div class="col-lg-8">

                                {{-- Categoría 1: Programas y cursos --}}
                                <div id="cat-programas" class="mt-4" data-aos="fade-up">
                                    <h3 class="fw-bold text-navy-custom mb-3">
                                        <i class="far fa-bookpen me-2" style="color: #002060;"></i>Programas y cursos
                                    </h3>
                                    <h5 class="text-muted-custom fw-normal mb-4 text-sm">
                                        Respuestas sobre los programas de especialización, modalidades y estructura.
                                    </h5>

                                    <div class="faq-accordion" id="faq-section-programas">
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="100">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-programas-0" aria-expanded="false" aria-controls="faq-programas-0">
                                                <span class="faq-question-number">1</span>
                                                <span class="faq-question-text">¿Qué programas ofrece CPA Academy?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-programas-0">
                                                <p>CPA Academy ofrece programas de especialización en NIIF, Auditoría, Finanzas Corporativas, Tributación, Presupuestos y Costos, Tecnología Financiera, y más. Cada programa está diseñado para profesionales que buscan avanzar en su carrera con conocimiento aplicable y estándares internacionales.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="150">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-programas-1" aria-expanded="false" aria-controls="faq-programas-1">
                                                <span class="faq-question-number">2</span>
                                                <span class="faq-question-text">¿Cuál es la duración de los programas?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-programas-1">
                                                <p>La duración varía según el programa y la modalidad. Los programas presenciales suelen durar entre 4 y 8 semanas, mientras que los programas en línea ofrecen flexibilidad para avanzar a tu ritmo. Consulta la información específica de cada programa en /cursos.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="200">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-programas-2" aria-expanded="false" aria-controls="faq-programas-2">
                                                <span class="faq-question-number">3</span>
                                                <span class="faq-question-text">¿En qué modalidades puedo estudiar?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-programas-2">
                                                <p>Ofrecemos modalidades presenciales en Lima y en línea (virtual en vivo y auto-dirigido). Cada programa indica la modalidad disponible. La modalidad flexible permite compatibilizar tu formación con tu trabajo y vida personal.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="250">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-programas-3" aria-expanded="false" aria-controls="faq-programas-3">
                                                <span class="faq-question-number">4</span>
                                                <span class="faq-question-text">¿Necesito experiencia previa para inscribirme?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-programas-3">
                                                <p>No necesitas ser contador para muchos de nuestros programas. Están diseñados para profesionales de diversas áreas que desean especializarse. Sin embargo, algunos programas recomiendan conocimientos básicos previos — verifica los requisitos de cada uno en /cursos.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="300">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-programas-4" aria-expanded="false" aria-controls="faq-programas-4">
                                                <span class="faq-question-number">5</span>
                                                <span class="faq-question-text">¿Cómo accedo a la plataforma virtual?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-programas-4">
                                                <p>Una vez inscrito, recibes las credenciales de acceso a nuestra plataforma virtual donde encontrarás las grabaciones de las clases, material descargable, ejercicios prácticos y recursos de apoyo. El acceso es permanente durante todo el programa.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Categoría 2: Inscripción y pagos --}}
                                <div id="cat-inscripcion" class="mt-5" data-aos="fade-up">
                                    <h3 class="fw-bold text-navy-custom mb-3">
                                        <i class="fas fa-pen me-2" style="color: #002060;"></i>Inscripción y pagos
                                    </h3>
                                    <h5 class="text-muted-custom fw-normal mb-4 text-sm">
                                        Información sobre precios, métodos de pago, facturas, promociones y procesos de inscripción.
                                    </h5>

                                    <div class="faq-accordion" id="faq-section-inscripcion">
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="100">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-inscripcion-0" aria-expanded="false" aria-controls="faq-inscripcion-0">
                                                <span class="faq-question-number">1</span>
                                                <span class="faq-question-text">¿Cuánto cuestan los programas?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-inscripcion-0">
                                                <p>Los precios varían según el programa, la modalidad y las promociones vigentes. En /cursos encontrarás los programas disponibles con su información de precios. También puedes hablar con un experto vía WhatsApp para conocer las opciones y descuentos disponibles.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="150">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-inscripcion-1" aria-expanded="false" aria-controls="faq-inscripcion-1">
                                                <span class="faq-question-number">2</span>
                                                <span class="faq-question-text">¿Qué métodos de pago aceptan?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-inscripcion-1">
                                                <p>Aceptamos tarjeta de crédito/débito a través de MercadoPago, y también puedes pagar en efectivo en nuestras instalaciones. Para información detallada de los métodos disponibles, visita /metodos-de-pago.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="200">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-inscripcion-2" aria-expanded="false" aria-controls="faq-inscripcion-2">
                                                <span class="faq-question-number">3</span>
                                                <span class="faq-question-text">¿Puedo pagar en cuotas o a plazos?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-inscripcion-2">
                                                <p>Sí, ofrecemos opciones de pago a plazos para la mayoría de los programas. La disponibilidad de cuotas depende del programa y el método de pago. Al momento de inscribirte, verás las opciones de cuotas disponibles para tu elección.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="250">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-inscripcion-3" aria-expanded="false" aria-controls="faq-inscripcion-3">
                                                <span class="faq-question-number">4</span>
                                                <span class="faq-question-text">¿Emiten factura o boleta de pago?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-inscripcion-3">
                                                <p>Sí, emitimos boleta de pago o factura según tu necesidad. Durante el proceso de pago puedes elegir el tipo de comprobante (boleta o factura) e indicar los datos necesarios para su emisión.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="300">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-inscripcion-4" aria-expanded="false" aria-controls="faq-inscripcion-4">
                                                <span class="faq-question-number">5</span>
                                                <span class="faq-question-text">¿Tienen promociones o descuentos vigentes?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-inscripcion-4">
                                                <p>Sí, periódicamente ofrecemos promociones, descuentos por inscripción anticipada, y beneficios para empresas e instituciones. Contacta a un experto vía WhatsApp o revisa /cursos para conocer las promociones activas en este momento.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="350">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-inscripcion-5" aria-expanded="false" aria-controls="faq-inscripcion-5">
                                                <span class="faq-question-number">6</span>
                                                <span class="faq-question-text">¿Qué pasa si cancelo mi inscripción?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-inscripcion-5">
                                                <p>Consulta nuestras Políticas de Devoluciones para conocer los términos y condiciones sobre cancelaciones, reembolsos y derechos del alumno. Están disponibles en el pie de página del sitio web bajo "Políticas de Devolución".</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Categoría 3: Certificados --}}
                                <div id="cat-certificados" class="mt-5" data-aos="fade-up">
                                    <h3 class="fw-bold text-navy-custom mb-3">
                                        <i class="fas fa-certificate me-2" style="color: #002060;"></i>Certificados
                                    </h3>
                                    <h5 class="text-muted-custom fw-normal mb-4 text-sm">
                                        Todo sobre certificación, verificación, validez y el respaldo ACCA.
                                    </h5>

                                    <div class="faq-accordion" id="faq-section-certificados">
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="100">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-certificados-0" aria-expanded="false" aria-controls="faq-certificados-0">
                                                <span class="faq-question-number">1</span>
                                                <span class="faq-question-text">¿Qué obtengo al finalizar el programa?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-certificados-0">
                                                <p>Al finalizar un programa de especialización, recibes un certificado de especialización con verificación en línea. Este certificado acredita tu formación con CPA Academy y el respaldo de ACCA como Approved Learning Partner.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="150">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-certificados-1" aria-expanded="false" aria-controls="faq-certificados-1">
                                                <span class="faq-question-number">2</span>
                                                <span class="faq-question-text">¿Cómo verifico mi certificado?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-certificados-1">
                                                <p>Cada certificado tiene un código de verificación único. Puedes validar la autenticidad de tu certificado ingresando el código en /certificado-validar. Esto garantiza que tu certificado es genuino y verificable públicamente.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="200">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-certificados-2" aria-expanded="false" aria-controls="faq-certificados-2">
                                                <span class="faq-question-number">3</span>
                                                <span class="faq-question-text">¿Tiene validez el certificado de CPA Academy?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-certificados-2">
                                                <p>El certificado tiene validez académica y profesional. Al ser CPA Academy reconocida por ACCA como Approved Learning Partner, los programas cuentan con el respaldo de uno de los organismos contables más importantes del mundo. La validez específica depende del programa y del uso que le des.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="250">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-certificados-3" aria-expanded="false" aria-controls="faq-certificados-3">
                                                <span class="faq-question-number">4</span>
                                                <span class="faq-question-text">¿Qué diferencia hay entre el certificado de CPA Academy y otros?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-certificados-3">
                                                <p>El certificado de CPA Academy se diferencia por: (1) respaldo de ACCA como Approved Learning Partner, (2) docentes de Big Four y banca en activo, (3) metodología práctica con casos reales, y (4) verificación en línea de su autenticidad. Esto da un valor diferencial a tu formación.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                {{-- Categoría 4: General --}}
                                <div id="cat-general" class="mt-5" data-aos="fade-up">
                                    <h3 class="fw-bold text-navy-custom mb-3">
                                        <i class="fas fa-comments me-2" style="color: #002060;"></i>General
                                    </h3>
                                    <h5 class="text-muted-custom fw-normal mb-4 text-sm">
                                        Contacto, horarios, ubicaciones, reclamos y soporte al alumno.
                                    </h5>

                                    <div class="faq-accordion" id="faq-section-general">
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="100">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-general-0" aria-expanded="false" aria-controls="faq-general-0">
                                                <span class="faq-question-number">1</span>
                                                <span class="faq-question-text">¿Dónde encuentro CPA Academy?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-general-0">
                                                <p>Nuestras instalaciones están en Lima, Perú. El sitio web incluye información de contacto: teléfono 967 052 506, email informes@globalcpaperu.com, y horarios de atención. También puedes escribirnos directamente por WhatsApp al +51 967 052 506.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="150">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-general-1" aria-expanded="false" aria-controls="faq-general-1">
                                                <span class="faq-question-number">2</span>
                                                <span class="faq-question-text">¿Cómo puedo contactarlos?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-general-1">
                                                <p>Puedes contactarnos por: teléfono 967 052 506, WhatsApp +51 967 052 506, email informes@globalcpaperu.com. También estás disponible en nuestras redes sociales: Facebook, Instagram, TikTok, YouTube y LinkedIn.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="200">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-general-2" aria-expanded="false" aria-controls="faq-general-2">
                                                <span class="faq-question-number">3</span>
                                                <span class="faq-question-text">¿Cuáles son los horarios de atención?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-general-2">
                                                <p>Los horarios de atención al público están disponibles en nuestra ubicación y por los canales de contacto. Para una respuesta rápida, recomendamos WhatsApp (+51 967 052 506) o escríbenos a informes@globalcpaperu.com y te responderemos pronto.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="250">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-general-3" aria-expanded="false" aria-controls="faq-general-3">
                                                <span class="faq-question-number">4</span>
                                                <span class="faq-question-text">¿Cómo presento un reclamo o sugerencia?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-general-3">
                                                <p>Puedes presentar reclamos o sugerencias a través del Libro de Reclamaciones disponible en el sitio web. Para resolver dudas sobre este proceso, consulta la sección de Libro de Reclamaciones en el footer de la página principal.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="300">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-general-4" aria-expanded="false" aria-controls="faq-general-4">
                                                <span class="faq-question-number">5</span>
                                                <span class="faq-question-text">¿CPA Academy es una institución reconocida?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-general-4">
                                                <p>Sí, CPA Academy es la única escuela de negocios peruana reconocida oficialmente por ACCA (Association of Chartered Certified Accountants) como Approved Learning Partner, uno de los organismos contables más prestigiosos a nivel internacional. Además, formamos a +5,000 alumnos en más de 10 países de LATAM.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>

                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 4. FRANJA DE ESTADÍSTICAS --}}
                {{-- ============================================ --}}
                <section class="faq-section">
                    <div class="container">
                        <div class="faq-stats-band shadow" data-aos="fade-up">
                            <div class="row row-cols-2 row-cols-lg-4 g-4 position-relative">
                                <div class="col faq-stat">
                                    <i class="fas fa-graduation-cap"></i>
                                    <strong>+5,000</strong>
                                    <span>Alumnos formados</span>
                                </div>
                                <div class="col faq-stat">
                                    <i class="fas fa-globe-americas"></i>
                                    <strong>+10</strong>
                                    <span>Países de LATAM</span>
                                </div>
                                <div class="col faq-stat">
                                    <i class="fas fa-chalkboard-teacher"></i>
                                    <strong>+40</strong>
                                    <span>Docentes expertos</span>
                                </div>
                                <div class="col faq-stat">
                                    <i class="far fa-bookpen"></i>
                                    <strong>+25</strong>
                                    <span>Programas de especialización</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                {{-- ============================================ --}}
                {{-- 5. CTA FINAL --}}
                {{-- ============================================ --}}
                <section class="faq-section pt-0">
                    <div class="container">
                        <div class="faq-cta text-center" data-aos="fade-up">
                            <h2 class="fw-bold text-white mb-3" style="font-size: 2.2rem;">
                                ¿Todavía tienes <span class="text-warning">dudas</span>?
                            </h2>
                            <p class="text-white-50 mx-auto mb-4" style="max-width: 640px; line-height: 1.6;">
                                Nuestro equipo de expertos está listo para ayudarte a encontrar el programa
                                ideal para tu carrera profesional.
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

            // Inicializar Bootstrap Collapse para acordeones (si Bootstrap JS está disponible)
            if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                document.querySelectorAll('.faq-accordion-button').forEach(function(btn) {
                    const target = document.getElementById(btn.getAttribute('data-bs-target').replace('#', ''));
                    new bootstrap.Collapse(target, { parent: btn.closest('.faq-accordion'), toggle: false });
                });
            }

            // Acordeón con toggle de +/- icono
            document.querySelectorAll('.faq-accordion-button').forEach(function(button) {
                button.addEventListener('click', function() {
                    const target = document.getElementById(this.getAttribute('data-bs-target').replace('#', ''));
                    const svg = this.querySelector('svg');
                    if (target && target.classList.contains('show')) {
                        svg.innerHTML = '<path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>';
                        svg.setAttribute('style', 'color: #4ade80;');
                    } else {
                        svg.innerHTML = '<path d="M6 6l12 12M18 6l-12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>';
                        svg.setAttribute('style', 'color: #9ca3af;');
                    }
                });
            });

            // Buscador simple de preguntas (filtra en la vista)
            const searchInput = document.getElementById('faqSearchInput');
            const searchBtn = document.getElementById('faqSearchBtn');
            if (searchInput && searchBtn) {
                function filterQuestions(query) {
                    const accordionItems = document.querySelectorAll('.faq-accordion-item');
                    let hasVisible = false;

                    accordionItems.forEach(function(item) {
                        const questionText = (item.querySelector('.faq-question-text')?.textContent || '').toLowerCase();
                        const answerText = (item.querySelector('.faq-accordion-body p')?.textContent || '').toLowerCase();
                        const match = questionText.includes(query.toLowerCase()) || answerText.includes(query.toLowerCase());

                        item.style.display = match ? '' : 'none';
                        if (match) hasVisible = true;
                    });

                    // Mensaje si no hay resultados
                    let noResultsMsg = document.getElementById('faq-no-results');
                    if (!hasVisible && query.trim() !== '') {
                        if (!noResultsMsg) {
                            noResultsMsg = document.createElement('div');
                            noResultsMsg.id = 'faq-no-results';
                            noResultsMsg.className = 'faq-no-results text-center py-4 text-muted-custom';
                            document.querySelector('.faq-section')?.prepend(noResultsMsg);
                        }
                        noResultsMsg.innerHTML = '<p class="fw-semibold">No encontramos resultados para "<strong>' + query + '</strong>". Prueba con otros términos.</p>';
                        noResultsMsg.style.display = '';
                    } else if (noResultsMsg) {
                        noResultsMsg.style.display = 'none';
                    }
                }

                searchBtn.addEventListener('click', function() {
                    const query = searchInput.value.trim();
                    if (query) {
                        filterQuestions(query);
                        document.querySelector('.faq-section')?.scrollIntoView({ behavior: 'smooth', block: 'start' });
                    }
                });

                searchInput.addEventListener('keypress', function(e) {
                    if (e.key === 'Enter') {
                        searchBtn.click();
                    }
                });

                searchInput.addEventListener('input', function() {
                    if (this.value.trim() === '') {
                        filterQuestions('');
                    }
                });
            }
        });
    </script>
@endsection
