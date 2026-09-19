@extends('layouts.webpage')

@section('title', ' - Preguntas Frecuentes')

@section('etiquetasmeta')
    <x-seo
        title="Preguntas Frecuentes - CPA Academy"
        description="Resuelve tus dudas sobre programas, inscripciones, pagos, certificados y más en CPA Academy. Respuestas rápidas sobre formación contable y financiera."
    />
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
        :is(.dark, .dark-only) .faq-search-box {
            background: #1d273a;
            border-color: #374558;
        }
        :is(.dark, .dark-only) .faq-search-input { color: #e5e7eb; }
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

        /* --- Tabs de categorías (escritorio: una categoría a la vez) --- */
        .faq-cat-tabs {
            display: flex;
            flex-direction: column;
            gap: 8px;
        }
        .faq-cat-tab {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 14px 16px;
            border-radius: 12px;
            border: 1px solid #eef2f7;
            background: #ffffff;
            color: #002060 !important;
            font-weight: 600;
            font-size: 0.95rem;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.25s ease;
            width: 100%;
            text-align: left;
        }
        .faq-cat-tab i { color: #002060; font-size: 1rem; width: 20px; text-align: center; flex-shrink: 0; }
        .faq-cat-tab .faq-cat-count {
            margin-left: auto;
            background: #eef2f7;
            color: #002060;
            font-size: 0.75rem;
            font-weight: 800;
            padding: 2px 10px;
            border-radius: 50px;
            flex-shrink: 0;
        }
        .faq-cat-tab:hover { border-color: #002060; transform: translateX(4px); }
        .faq-cat-tab.active {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-color: transparent;
            color: #ffffff !important;
            box-shadow: 0 8px 20px rgba(0, 32, 96, 0.25);
        }
        .faq-cat-tab.active i { color: #ffc107; }
        .faq-cat-tab.active .faq-cat-count { background: rgba(255, 255, 255, 0.15); color: #ffffff; }
        :is(.dark, .dark-only) .faq-cat-tab { background: #1d273a; border-color: #374558; color: #d1d5db !important; }
        :is(.dark, .dark-only) .faq-cat-tab i { color: #ffc107; }
        :is(.dark, .dark-only) .faq-cat-tab .faq-cat-count { background: #374558; color: #e5e7eb; }
        :is(.dark, .dark-only) .faq-cat-tab:hover { border-color: #ffc107; }
        :is(.dark, .dark-only) .faq-cat-tab.active {
            background: linear-gradient(135deg, #1d273a 0%, #374558 100%);
            border-color: #ffc107;
            color: #ffffff !important;
        }

        @media (min-width: 992px) {
            /* Escritorio: solo se muestra la categoría activa */
            .faq-cat-pane { display: none; }
            .faq-cat-pane.active { display: block; }
        }
        @media (max-width: 991.98px) {
            /* Tablet/móvil: las tabs se vuelven chips y todo se apila */
            .faq-cat-tabs { flex-direction: row; flex-wrap: wrap; }
            .faq-cat-tab { flex: 1 1 calc(50% - 8px); justify-content: flex-start; }
            .faq-cat-tab:hover { transform: none; }
            .faq-cat-tab .faq-cat-count { display: none; }
        }
        @media (max-width: 575.98px) {
            .faq-cat-tab { flex: 1 1 100%; }
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
            background: #ffffff;
        }
        :is(.dark, .dark-only) .faq-accordion-item {
            background: #1d273a;
            border-color: #374558;
        }
        .faq-accordion-item:hover {
            box-shadow: 0 5px 15px rgba(0, 32, 96, 0.05);
        }
        :is(.dark, .dark-only) .faq-accordion-item:hover {
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.4);
        }
        .faq-accordion-button {
            width: 100%;
            padding: 18px 20px;
            background: transparent;
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
        :is(.dark, .dark-only) .faq-accordion-button:hover { background: #232f45; }
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
        .faq-accordion-button svg {
            flex-shrink: 0;
            color: #9ca3af;
            transition: transform 0.3s ease, color 0.3s ease;
        }
        /* El "+" rota 45° para convertirse en "×" cuando el item está abierto.
           Manejado por CSS con la clase .collapsed de Bootstrap: siempre sincronizado. */
        .faq-accordion-button:not(.collapsed) svg {
            transform: rotate(45deg);
            color: #ffffff;
        }
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
            /* Bootstrap maneja el colapso (.collapse/.collapsing/.show).
               Sin max-height propio: un max-height:0 taparía la respuesta aun con .show.
               IMPORTANTE: el tema carga Tailwind, que define .collapse { visibility: collapse }.
               Eso deja el cuerpo ocupando espacio pero invisible. Forzamos visibilidad. */
            overflow: hidden;
            visibility: visible !important;
        }
        .faq-accordion-body p {
            padding: 16px 20px 20px 20px;
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
            .faq-hero h1.display-4 { font-size: 2rem; }
            .faq-accordion-button { padding: 15px 16px; }
            .faq-accordion-body p { padding: 14px 16px 18px 16px; }
            /* Buscador apilado en móvil: input arriba, botón abajo ocupando el ancho */
            .faq-search-box form { flex-direction: column; }
            .faq-search-btn { width: 100%; }
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
                                                    <i class="fa fa-home me-1"></i> Inicio
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active text-white text-uppercase small fw-bold"
                                                style="letter-spacing: 1px;" aria-current="page">
                                                Preguntas Frecuentes
                                            </li>
                                        </ol>
                                    </nav>

                                    <h1 class="display-4 fw-bold text-white mb-3">
                                        <span class="text-warning">¿En qué</span>  podemos ayudarte hoy?
                                    </h1>
                                    <p class="lead text-white-50 mb-4" style="max-width: 620px; line-height: 1.6;">
                                        Encuentra respuestas rápidas sobre nuestros programas, pagos y certificaciones. 
                                        Si tienes una consulta específica, nuestro equipo está a un clic de distancia.
                                    </p>

                                    {{-- <div class="d-flex flex-wrap gap-3">
                                        <span class="faq-hero-tag">
                                            <i class="fa fa-question-circle text-warning"></i> Dudas frecuentes
                                        </span>
                                        <span class="faq-hero-tag">
                                            <i class="fa fa-graduation-cap text-warning"></i> +5,000 alumnos
                                        </span>
                                        <span class="faq-hero-tag">
                                            <i class="fa fa-certificate text-warning"></i> Respaldo ACCA
                                        </span>
                                    </div> --}}
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
                                    <i class="fa fa-search me-2"></i>Buscar
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
                                {{-- Tabs de categorías --}}
                                <div class="bg-card-custom shadow-sm rounded-4 p-3 sticky-lg-top" style="top: 20px;">
                                    <small class="text-muted-custom text-uppercase fw-bold d-block mb-2" style="font-size: 0.7rem; letter-spacing: 1px;">Categorías</small>
                                    <div class="faq-cat-tabs">
                                        <button type="button" class="faq-cat-tab active" data-faq-cat="programas">
                                            <i class="fa fa-book-open"></i>
                                            <span>Programas y Cursos</span>
                                            <span class="faq-cat-count">4</span>
                                        </button>
                                        <button type="button" class="faq-cat-tab" data-faq-cat="certificados">
                                            <i class="fa fa-certificate"></i>
                                            <span>Certificados y Respaldo</span>
                                            <span class="faq-cat-count">3</span>
                                        </button>
                                        <button type="button" class="faq-cat-tab" data-faq-cat="inscripcion">
                                            <i class="fa fa-pen"></i>
                                            <span>Inscripciones y Pagos</span>
                                            <span class="faq-cat-count">3</span>
                                        </button>
                                        <button type="button" class="faq-cat-tab" data-faq-cat="comunidad">
                                            <i class="fa fa-comments"></i>
                                            <span>Comunidad y Soporte</span>
                                            <span class="faq-cat-count">2</span>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-8">

                                <div class="faq-cat-pane active" data-faq-pane="programas">
                                {{-- Categoría 1: Programas y Cursos --}}
                                <div id="cat-programas" class="mt-4" data-aos="fade-up">
                                    <h3 class="fw-bold text-navy-custom mb-3">
                                        <i class="fa fa-book-open me-2" style="color: #002060;"></i>Programas y Cursos
                                    </h3>
                                    <h5 class="text-muted-custom fw-normal mb-4 text-sm">
                                        Respuestas sobre los programas de especialización, modalidades y estructura.
                                    </h5>

                                    <div class="faq-accordion" id="faq-section-programas">
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="100">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-programas-0" aria-expanded="false" aria-controls="faq-programas-0">
                                                <span class="faq-question-number">1</span>
                                                <span class="faq-question-text">¿Qué especializaciones ofrecen?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-programas-0">
                                                <p>Programas de alto nivel en NIIF de contabilidad, finanzas, Normas Internacionales de auditoría, tributación, habilidades humanas, legislación laboral y tecnología (IA). Diseñados con enfoque 100% práctico por reconocidos expertos.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="150">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-programas-1" aria-expanded="false" aria-controls="faq-programas-1">
                                                <span class="faq-question-number">2</span>
                                                <span class="faq-question-text">¿Cuál es la modalidad de estudio?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-programas-1">
                                                <p>100% online en vivo. Nuestros horarios están diseñados estratégicamente para no interferir con las exigencias de tu labor profesional.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="200">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-programas-2" aria-expanded="false" aria-controls="faq-programas-2">
                                                <span class="faq-question-number">3</span>
                                                <span class="faq-question-text">¿Necesito experiencia previa?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-programas-2">
                                                <p>Empezamos desde los fundamentos hasta llegar al nivel gerencial. No necesitas experiencia avanzada, solo conocimientos base en tu área.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="250">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-programas-3" aria-expanded="false" aria-controls="faq-programas-3">
                                                <span class="faq-question-number">4</span>
                                                <span class="faq-question-text">¿Cómo accedo a las clases?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-programas-3">
                                                <p>Al inscribirte, ingresas a nuestro Campus Virtual donde encontrarás las clases en vivo, grabaciones y herramientas de aplicación inmediata.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>{{-- /pane programas --}}

                                <div class="faq-cat-pane" data-faq-pane="certificados">
                                {{-- Categoría 2: Certificados y Respaldo --}}
                                <div id="cat-certificados" class="mt-5" data-aos="fade-up">
                                    <h3 class="fw-bold text-navy-custom mb-3">
                                        <i class="fa fa-certificate me-2" style="color: #002060;"></i>Certificados y Respaldo
                                    </h3>
                                    <h5 class="text-muted-custom fw-normal mb-4 text-sm">
                                        Validez, verificación y el respaldo de ACCA detrás de cada certificado.
                                    </h5>

                                    <div class="faq-accordion" id="faq-section-certificados">
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="100">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-certificados-0" aria-expanded="false" aria-controls="faq-certificados-0">
                                                <span class="faq-question-number">1</span>
                                                <span class="faq-question-text">¿Por qué su certificado pesa más en el mercado?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-certificados-0">
                                                <p>Porque somos la única escuela en Perú reconocida como Approved Learning Partner por la ACCA. Es un estándar global exigido por las mejores corporaciones.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="150">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-certificados-1" aria-expanded="false" aria-controls="faq-certificados-1">
                                                <span class="faq-question-number">2</span>
                                                <span class="faq-question-text">¿Qué competencias valida mi certificado?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-certificados-1">
                                                <p>Demuestra que dominas normativas internacionales (NIIF, NIA) y herramientas tecnológicas aplicables, dándote un perfil listo para el liderazgo.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="200">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-certificados-2" aria-expanded="false" aria-controls="faq-certificados-2">
                                                <span class="faq-question-number">3</span>
                                                <span class="faq-question-text">¿Cómo verifica mi empresa que el certificado es real?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-certificados-2">
                                                <p>Cada certificado incluye un código QR único que los reclutadores pueden validar al instante en nuestra plataforma web.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>{{-- /pane certificados --}}

                                <div class="faq-cat-pane" data-faq-pane="inscripcion">
                                {{-- Categoría 3: Inscripciones y Pagos --}}
                                <div id="cat-inscripcion" class="mt-5" data-aos="fade-up">
                                    <h3 class="fw-bold text-navy-custom mb-3">
                                        <i class="fa fa-certificate me-2" style="color: #002060;"></i>Inscripciones y Pagos
                                    </h3>
                                    <h5 class="text-muted-custom fw-normal mb-4 text-sm">
                                        Métodos de pago, facilidades, descuentos y comprobantes electrónicos.
                                    </h5>

                                    <div class="faq-accordion" id="faq-section-inscripcion">
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="100">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-inscripcion-0" aria-expanded="false" aria-controls="faq-inscripcion-0">
                                                <span class="faq-question-number">1</span>
                                                <span class="faq-question-text">¿Qué métodos de pago aceptan?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-inscripcion-0">
                                                <p>Tarjetas de crédito/débito, transferencias y medios internacionales a través de una pasarela 100% segura.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="150">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-inscripcion-1" aria-expanded="false" aria-controls="faq-inscripcion-1">
                                                <span class="faq-question-number">2</span>
                                                <span class="faq-question-text">¿Tienen facilidades de pago?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-inscripcion-1">
                                                <p>Sí. Ofrecemos precios de preventa, descuentos corporativos (2 a más alumnos) y cuotas sin intereses (sujeto a tu banco).</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="200">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-inscripcion-2" aria-expanded="false" aria-controls="faq-inscripcion-2">
                                                <span class="faq-question-number">3</span>
                                                <span class="faq-question-text">¿Emiten factura para empresas?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-inscripcion-2">
                                                <p>Por supuesto. Emitimos boleta o factura electrónica al momento de tu inscripción.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>{{-- /pane inscripcion --}}

                                <div class="faq-cat-pane" data-faq-pane="comunidad">
                                {{-- Categoría 4: Comunidad y Soporte --}}
                                <div id="cat-comunidad" class="mt-5" data-aos="fade-up">
                                    <h3 class="fw-bold text-navy-custom mb-3">
                                        <i class="fa fa-comments me-2" style="color: #002060;"></i>Comunidad y Soporte
                                    </h3>
                                    <h5 class="text-muted-custom fw-normal mb-4 text-sm">
                                        Estudia desde cualquier país y recibe soporte académico en tiempo real.
                                    </h5>

                                    <div class="faq-accordion" id="faq-section-comunidad">
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="100">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-comunidad-0" aria-expanded="false" aria-controls="faq-comunidad-0">
                                                <span class="faq-question-number">1</span>
                                                <span class="faq-question-text">¿Puedo estudiar desde fuera de Perú?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-comunidad-0">
                                                <p>Sí. Nuestra enseñanza se basa en normativas globales, conectando a profesionales de varios países de Latinoamérica.</p>
                                            </div>
                                        </div>
                                        <div class="faq-accordion-item" data-aos="fade-up" data-aos-delay="150">
                                            <button class="faq-accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq-comunidad-1" aria-expanded="false" aria-controls="faq-comunidad-1">
                                                <span class="faq-question-number">2</span>
                                                <span class="faq-question-text">¿A quién acudo si tengo dudas técnicas?</span>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor" viewBox="0 0 16 16">
                                                    <path d="M12 5v14M5 12h14" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                                                </svg>
                                            </button>
                                            <div class="faq-accordion-body collapse" id="faq-comunidad-1">
                                                <p>Tendrás acceso directo a un asesor académico vía WhatsApp para resolver cualquier consulta en tiempo real.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                </div>{{-- /pane comunidad --}}

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
                                    <i class="fa fa-graduation-cap"></i>
                                    <strong>+5,000</strong>
                                    <span>Alumnos formados</span>
                                </div>
                                <div class="col faq-stat">
                                    <i class="fa fa-globe-americas"></i>
                                    <strong>+10</strong>
                                    <span>Países de LATAM</span>
                                </div>
                                <div class="col faq-stat">
                                    <i class="fa fa-chalkboard-teacher"></i>
                                    <strong>+40</strong>
                                    <span>Docentes expertos</span>
                                </div>
                                <div class="col faq-stat">
                                    <i class="fa fa-book-open"></i>
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

            // Inicializar Bootstrap Collapse para acordeones (si Bootstrap JS está disponible)
            if (typeof bootstrap !== 'undefined' && bootstrap.Collapse) {
                document.querySelectorAll('.faq-accordion-button').forEach(function(btn) {
                    const target = document.getElementById(btn.getAttribute('data-bs-target').replace('#', ''));
                    new bootstrap.Collapse(target, { parent: btn.closest('.faq-accordion'), toggle: false });
                });
            }

            // Acordeón con toggle de +/- icono
            // El icono +/× se maneja por CSS (rotación del SVG con la clase .collapsed
            // que Bootstrap alterna automáticamente). No se necesita JS.

            // Tabs de categorías: en escritorio (>=992px) muestra un panel a la vez;
            // en móvil/tablet los paneles van apilados y el botón hace scroll suave.
            const catTabs = document.querySelectorAll('.faq-cat-tab');
            const catPanes = document.querySelectorAll('.faq-cat-pane');
            if (catTabs.length && catPanes.length) {
                const faqIsDesktop = () => window.matchMedia('(min-width: 992px)').matches;
                const faqActivatePane = function(key) {
                    catPanes.forEach(function(p) {
                        p.classList.toggle('active', p.getAttribute('data-faq-pane') === key);
                    });
                    if (typeof AOS !== 'undefined') { AOS.refresh(); }
                };
                catTabs.forEach(function(tab) {
                    tab.addEventListener('click', function() {
                        const key = this.getAttribute('data-faq-cat');
                        catTabs.forEach(function(t) { t.classList.toggle('active', t === tab); });
                        if (faqIsDesktop()) {
                            faqActivatePane(key);
                        } else {
                            const pane = document.querySelector('[data-faq-pane="' + key + '"]');
                            if (pane) { pane.scrollIntoView({ behavior: 'smooth', block: 'start' }); }
                        }
                    });
                });
                window.addEventListener('resize', function() {
                    if (faqIsDesktop()) {
                        const activeTab = document.querySelector('.faq-cat-tab.active');
                        faqActivatePane(activeTab ? activeTab.getAttribute('data-faq-cat') : catTabs[0].getAttribute('data-faq-cat'));
                    }
                });
            }

            // Buscador simple de preguntas (filtra en la vista)
            const searchInput = document.getElementById('faqSearchInput');
            const searchBtn = document.getElementById('faqSearchBtn');
            if (searchInput && searchBtn) {
                function filterQuestions(query) {
                    const accordionItems = document.querySelectorAll('.faq-accordion-item');
                    let hasVisible = false;

                    // Al buscar, muestra las 4 categorías para que los resultados
                    // sean visibles sin importar el tab activo (solo afecta escritorio).
                    if (typeof catPanes !== 'undefined' && catPanes.length) {
                        if (query.trim() !== '') {
                            catPanes.forEach(function(p) { p.classList.add('active'); });
                        } else {
                            const activeTab = document.querySelector('.faq-cat-tab.active');
                            const key = activeTab ? activeTab.getAttribute('data-faq-cat') : null;
                            if (key) {
                                catPanes.forEach(function(p) { p.classList.toggle('active', p.getAttribute('data-faq-pane') === key); });
                            }
                        }
                    }

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
