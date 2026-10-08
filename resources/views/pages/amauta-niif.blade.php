@extends('layouts.webpage')

@section('title', ' - El Amauta de las NIIF')

@section('etiquetasmeta')
    <x-seo
        title="El Amauta de las NIIF - CPA Academy"
        description="El Amauta de las NIIF: guía práctica y visual para dominar las normas internacionales de información financiera, con enfoque directo al grano para contadores, auditores y directivos."
    />
@endsection

@section('content')

<style>
    .text-navy-custom { color:#002060 !important; }
    :is(.dark, .dark-only) .text-navy-custom { color:#f6f7fb !important; }

    .text-muted-custom { color:#6b7280; }
    :is(.dark, .dark-only) .text-muted-custom { color:#9ca3af !important; }

    .bg-card-custom {
        background-color:#ffffff !important;
        border:1px solid #eef2f7;
    }
    :is(.dark, .dark-only) .bg-card-custom {
        background-color:#1d273a !important;
        border-color:#374558 !important;
    }

    .why-section { padding:10px 0px 70px 0; }
    .why-section-alt { background-color:#f8f9fa; }
    :is(.dark, .dark-only) .why-section-alt { background-color:#111827; }

    .why-hero {
        background:linear-gradient(135deg, #002060 0%, #004080 100%);
        border-radius:20px;
        border:0;
        overflow:hidden;
        position:relative;
    }
    .why-hero::after {
        content:'';
        position:absolute;
        top:-80px;
        right:-80px;
        width:300px;
        height:300px;
        background:radial-gradient(circle, rgba(227,6,19,0.25) 0%, rgba(0,32,96,0) 70%);
        pointer-events:none;
    }
    .why-hero-tag {
        display:inline-flex;
        align-items:center;
        gap:8px;
        padding:8px 16px;
        border-radius:50px;
        background:rgba(255,255,255,0.08);
        border:1px solid rgba(255,255,255,0.15);
        color:#ffffff;
        font-size:14px;
        font-weight:600;
    }
    .why-hero .btn-cta-white {
        background:#ffffff;
        color:#002060;
        font-weight:700;
        padding:12px 30px;
        border-radius:50px;
        border:none;
        transition:all .3s ease;
        display:inline-block;
    }
    .why-hero .btn-cta-white:hover {
        transform:translateY(-3px);
        box-shadow:0 10px 25px rgba(0,0,0,0.25);
        color:#e30613;
    }

    .why-feature-card {
        height:100%;
        padding:30px 25px;
        border-radius:20px;
        text-align:center;
        position:relative;
        overflow:hidden;
        transition:transform .3s ease, box-shadow .3s ease;
    }
    .why-feature-card:hover {
        transform:translateY(-6px);
        box-shadow:0 15px 35px rgba(0,32,96,0.12);
    }
    .why-feature-card .feature-icon {
        width:70px;
        height:70px;
        border-radius:18px;
        display:inline-flex;
        align-items:center;
        justify-content:center;
        font-size:28px;
        color:#ffffff;
        margin-bottom:18px;
        box-shadow:0 8px 20px rgba(0,0,0,0.18);
    }
    .why-feature-card h3 {
        font-size:1.15rem;
        font-weight:700;
        margin-bottom:10px;
    }
    .why-feature-card p {
        font-size:0.92rem;
        line-height:1.65;
        margin-bottom:0;
    }

    .why-count-box {
        background:rgba(0,32,96,0.08);
        border-radius:18px;
        padding:18px 22px;
        text-align:center;
        border:1px solid rgba(0,32,96,0.15);
    }
    .why-count-box h3 {
        color:#002060;
        font-size:3rem;
        font-weight:800;
        margin:0 0 4px;
    }
    .why-count-box p {
        font-size:0.85rem;
        color:#6b7280;
        margin:0;
        text-transform:uppercase;
        letter-spacing:0.6px;
    }

    .why-list-title {
        background:#002060;
        color:#ffffff;
        padding:10px 18px;
        border-radius:12px;
        font-weight:700;
        text-align:center;
        margin-bottom:16px;
    }

    .why-list-item {
        background:#ffffff;
        border:1px solid #eef2f7;
        border-radius:16px;
        padding:20px 22px;
        margin-bottom:16px;
        transition:background .2s ease, border-color .2s ease;
    }
    .why-list-item:hover {
        background:#f6f8fc;
        border-color:#d8e0ef;
    }
    :is(.dark, .dark-only) .why-list-item {
        background:#1d273a;
        border-color:#374558;
    }
    :is(.dark, .dark-only) .why-list-item:hover {
        background:#22304c;
        border-color:#3f4f6c;
    }
    .why-list-num {
        display:inline-flex;
        align-items:center;
        justify-content:center;
        width:34px;
        height:34px;
        border-radius:50%;
        background:#002060;
        color:#ffffff;
        font-weight:700;
        font-size:1rem;
        margin-right:12px;
        flex-shrink:0;
    }
    .why-list-head {
        display:flex;
        align-items:center;
        font-size:1.1rem;
        font-weight:700;
        color:#002060;
        margin-bottom:12px;
    }
    .why-list-body {
        font-size:0.98rem;
        line-height:1.7;
        color:#41464b;
    }
    .why-list-body ul {
        margin:8px 0 0 0;
        padding-left:24px;
    }
    .why-list-body li {
        margin-bottom:8px;
    }
    .why-list-body strong {
        color:#002060;
    }
    .why-list-body a {
        color:#002060;
        text-decoration:underline;
    }
    .why-list-body a:hover {
        color:#e30613;
    }
    :is(.dark, .dark-only) .why-list-body {
        color:#cbd2e1;
    }
    :is(.dark, .dark-only) .why-list-body strong {
        color:#fff;
    }

    .why-highlight-box {
        background:linear-gradient(135deg, #ffc107 0%, #ffb600 100%);
        border-radius:18px;
        padding:22px 26px;
        color:#002060;
    }
    .why-highlight-box h3 {
        font-size:1.05rem;
        font-weight:700;
        margin:0 0 6px;
    }
    .why-highlight-box p, .why-highlight-box a {
        margin:0;
    }

    .why-page pre {
        white-space:pre-wrap;
        background:#f1f5f9;
        border:1px solid #e2e8f0;
        border-radius:12px;
        padding:16px 18px;
        font-size:0.9rem;
        color:#334155;
        max-height:340px;
        overflow:auto;
    }
    :is(.dark, .dark-only) .why-page pre {
        background:#0f172a;
        border-color:#334155;
        color:#e2e8f0;
    }

    .why-grid-3 {
        display:grid;
        grid-template-columns:repeat(3, 1fr);
        gap:24px;
    }

    @media (max-width: 991px) {
        .why-grid-3 { grid-template-columns:1fr; }
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
    <x-header :breadcrumb="[
        ['label' => 'El Amauta de las NIIF'],
    ]" />
    <!-- Page Header Ends-->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <x-sidebar />
        <!-- Page Sidebar Ends-->
        <div class="page-body">

            <!-- Hero -->
            <div class="why-section">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-lg-12">
                            <div class="why-hero text-center">
                                <div class="position-relative" style="z-index:2;">
                                    <span class="why-hero-tag mb-3 mt-3">
                                        <i class="fa fa-book-open"></i> El Amauta de las NIIF
                                    </span>
                                    <h1 class="display-4 fw-bold mb-3 text-white" style="text-transform:uppercase; letter-spacing:1px;">
                                        EL AMAUTA DE LAS NIIF
                                    </h1>
                                    <p class="text-white mb-4" style="font-size:1.05rem; max-width:800px; margin:0 auto;">
                                        Última actualización: 6 de octubre de 2026
                                    </p>
                                    <p class="text-white mb-4" style="font-size:1rem; opacity:0.95;">
                                        Domina la normativa internacional con un enfoque visual, práctico y directo al grano. Una guía pensada para que entiendas las NIIF como nunca te lo han explicado.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Datos clave -->
            <div class="why-section-alt">
                <div class="container">
                    <div class="row text-center mb-5">
                        <div class="col-lg-8 mx-auto">
                            <p class="text-muted-custom mb-2" style="text-transform:uppercase; letter-spacing:1px; font-size:0.85rem;">
                                Información clave del recurso
                            </p>
                            <h2 class="h1 mb-4 text-navy-custom" style="font-size:2rem;">Qué encontrarás en esta obra</h2>
                        </div>
                    </div>

                    <div class="row g-4 mb-3">
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>1</h3>
                                <p>Edición actualizada</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>3</h3>
                                <p>Áreas clave de formación</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>3</h3>
                                <p>Ediciones disponibles</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secciones del producto -->
            <div id="amauta" class="why-section">
                <div class="container">
                    <div class="why-list-title mb-4">
                        El Amauta de las NIIF
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">1</span>
                            QUÉ ES EL AMAUTA DE LAS NIIF
                        </div>
                        <div class="why-list-body">
                            <p>El Amauta de las NIIF es una obra dirigida a contadores públicos, auditores, consultores, directivos y gerentes financieros, así como a estudiantes de facultades de Contabilidad que necesitan comprender la normativa internacional de información financiera con claridad y práctica.</p>
                            <p>Su propósito es explicar las NIIF de forma visual y directa, con el nivel de detalle que exige el ejercicio profesional sin perder el enfoque en lo que realmente importa para la toma de decisiones.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">2</span>
                            EDICIÓN Y APLICACIÓN
                        </div>
                        <div class="why-list-body">
                            <p><strong>El Amauta de las NIIF | Edición 2025</strong> está dirigido a:</p>
                            <ul>
                                <li>Contadores públicos y auditores que necesitan una referencia actualizada.</li>
                                <li>Consultores, directivos y gerentes financieros de empresas obligadas a aplicar las NIIF Plenas o las NIIF para PYMES.</li>
                                <li>Funcionarios públicos de la alta dirección de empresas del Estado sujetas a las NICSP.</li>
                                <li>Estudiantes de facultades de Contabilidad.</li>
                            </ul>
                            <p>En cada edición se consideran las novedades normativas, los enfoques prácticos y los temas que más incidencia tienen en la labor profesional.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">3</span>
                            ENFOQUE Y METODOLOGÍA
                        </div>
                        <div class="why-list-body">
                            <p>El libro combina explicación teórica y aplicación práctica. No se limita a repetir el texto normativo: traduce los criterios a situaciones reales y ayuda a la rápida identificación de lo que importa en cada tema.</p>
                            <p><strong>Algunos pilares del formato:</strong></p>
                            <ul>
                                <li>Explicación clara y directa al grano.</li>
                                <li>Ejemplos visuales y comparaciones prácticas.</li>
                                <li>Enfoque en la aplicación, no solo en la teoría.</li>
                                <li>Material de soporte pensado para el estudio y la consulta rápida.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">4</span>
                            PROGRAMAS Y MODALIDADES
                        </div>
                        <div class="why-list-body">
                            <p>La obra se presenta en ediciones actualizadas y puede estar disponible en distintas modalidades según la promoción o el programa de formación. CPA Academy informa las opciones disponibles en los canales oficiales.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">5</span>
                            PREÇIOS, PAGOS Y PROMOCIONES
                        </div>
                        <div class="why-list-body">
                            <p>Los precios se comunican en los canales oficiales. El costo de acceso o adquisición se aclara antes de realizar cualquier pago. CPA Academy puede modificar precios para futuras ediciones o promociones.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">6</span>
                            REPROGRAMACIONES, CANCELACIONES Y DEVOLUCIONES
                        </div>
                        <div class="why-list-body">
                            <p>Las condiciones de acceso, reprogramación, cancelación y devolución se regirán por nuestra Política de Devoluciones, Reembolsos y Transferencias, que forma parte íntegra de los Términos y Condiciones.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">7</span>
                            MATERIALES Y PROPIEDAD INTELECTUAL
                        </div>
                        <div class="why-list-body">
                            <p>Los contenidos de El Amauta de las NIIF están protegidos por derechos de autor. Queda prohibido compartir credenciales, copiar, reproducir, comercializar o grabar clases sin autorización.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">8</span>
                            PLATAFORMAS Y SERVICIOS DE TERCEROS
                        </div>
                        <div class="why-list-body">
                            <p>Algunos servicios o accesos complementarios pueden depender de plataformas de terceros. CPA Academy realizará esfuerzos razonables para mantener la continuidad del servicio, pero no será responsable por interrupciones ajenas a su control.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">9</span>
                            CONTACTO
                        </div>
                        <div class="why-list-body">
                            <div class="why-highlight-box" style="background:none; border:1px solid #002060; color:#002060; padding:18px 20px;">
                                <p style="margin:0 0 8px; font-size:0.9rem; font-weight:600; text-transform:uppercase; letter-spacing:0.6px;">Contacto</p>
                                <p style="margin:0; font-size:1rem;">
                                    Correo: <strong>capacitacion@globalcpaperu.com</strong><br>
                                    WhatsApp: <strong>+51 967 052 506</strong><br>
                                    Web: <a href="https://academy.globalcpaperu.com" target="_blank">academy.globalcpaperu.com</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <!-- footer start-->
        <x-footer />
    </div>
</div>

@stop
