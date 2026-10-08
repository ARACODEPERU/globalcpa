@extends('layouts.webpage')

@section('title', ' - Términos y Condiciones')

@section('etiquetasmeta')
    <x-seo
        title="Términos y Condiciones - CPA Academy"
        description="Términos y condiciones de uso de CPA Academy: plataforma, cuentas, acceso a cursos, pagos, propiedad intelectual, privacidad y contacto."
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
        ['label' => 'Términos y Condiciones'],
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
                                        <i class="fa fa-sync-alt"></i> Términos y Condiciones
                                    </span>
                                    <h1 class="display-4 fw-bold mb-3 text-white" style="text-transform:uppercase; letter-spacing:1px;">
                                        TERMINOS Y CONDICIONES
                                    </h1>
                                    <p class="text-white mb-4" style="font-size:1.05rem; max-width:800px; margin:0 auto;">
                                        Última actualización: 8 de octubre de 2026
                                    </p>
                                    <p class="text-white mb-4" style="font-size:1rem; opacity:0.95;">
                                        Bienvenido a CPA Academy. Al acceder o utilizar nuestra plataforma, aceptas cumplir con estos términos y condiciones. Te recomendamos leerlos detenidamente antes de registrarte o adquirir cualquier servicio.
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
                                Información clave de los términos
                            </p>
                            <h2 class="h1 mb-4 text-navy-custom" style="font-size:2rem;">Qué debes saber sobre el uso de la plataforma</h2>
                        </div>
                    </div>

                    <div class="row g-4 mb-3">
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>10</h3>
                                <p>Secciones clave de los términos</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>5</h3>
                                <p>Días hábiles para atención de solicitudes</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>15</h3>
                                <p>Días hábiles para gestiones de reembolso</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secciones de los términos -->
            <div id="terminos" class="why-section">
                <div class="container">
                    <div class="why-list-title mb-4">
                        Términos y Condiciones de Uso
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">1</span>
                            USO DE LA PLATAFORMA
                        </div>
                        <div class="why-list-body">
                            <p>El propósito principal de este sitio es proporcionar acceso a programas de capacitación y recursos educativos. Al hacer uso de la plataforma, confirmas tu aceptación de nuestras políticas.</p>
                            <p>No somos responsables por daños indirectos derivados del uso o imposibilidad de uso de nuestros servicios. Nos reservamos el derecho de actualizar, modificar o descontinuar cursos, precios o políticas en cualquier momento. En caso de cambios significativos, se notificará a los usuarios registrados a través de correo electrónico o mediante la misma plataforma.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">2</span>
                            CUENTAS DE USUARIO
                        </div>
                        <div class="why-list-body">
                            <p>Para acceder a los cursos y servicios, es necesario crear una cuenta de usuario. Es tu responsabilidad:</p>
                            <ul>
                                <li>Mantener la confidencialidad de tus datos de acceso.</li>
                                <li>Proporcionar información veraz y actualizada.</li>
                            </ul>
                            <p>El uso indebido de la cuenta o el registro con datos falsos podrá derivar en la suspensión o cancelación de la misma sin derecho a reembolso.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">3</span>
                            ACCESO A CURSOS Y SERVICIOS
                        </div>
                        <div class="why-list-body">
                            <p>Los cursos y programas se ofrecen en modalidad digital y/u otra modalidad según corresponda.</p>
                            <ul>
                                <li>El acceso a contenidos digitales se otorga de manera electrónica y estará disponible en tu cuenta dentro de los plazos establecidos.</li>
                                <li>No nos hacemos responsables de retrasos o interrupciones ocasionados por factores externos a nuestro control (fallas técnicas, problemas de conexión, etc.).</li>
                                <li>En caso de inconvenientes, puedes comunicarte con nuestro equipo de soporte para buscar una solución.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">4</span>
                            PAGOS, CANCELACIONES Y DEVOLUCIONES
                        </div>
                        <div class="why-list-body">
                            <p>Los pagos realizados por cursos o programas son finales, salvo disposición contraria en las políticas específicas de cada servicio.</p>
                            <p>Nos reservamos el derecho de cancelar inscripciones en caso de detectar irregularidades en el pago o incumplimiento de estos términos. Si aplica, se emitirá el reembolso correspondiente conforme a la política de devoluciones.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">5</span>
                            ENLACES A TERCEROS
                        </div>
                        <div class="why-list-body">
                            <p>Nuestra plataforma puede contener enlaces a sitios web de terceros (por ejemplo, proveedores de contenido o pasarelas de pago). No somos responsables por el contenido, prácticas o políticas de dichos sitios. Recomendamos revisar sus términos y condiciones de manera independiente.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">6</span>
                            PROPIEDAD INTELECTUAL
                        </div>
                        <div class="why-list-body">
                            <p>Todos los cursos, materiales y contenidos educativos disponibles en la plataforma son propiedad de la empresa o de sus respectivos autores y están protegidos por derechos de autor. Queda prohibida su reproducción, distribución o uso con fines distintos a los autorizados.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">7</span>
                            DERECHOS SOBRE LOS DATOS PERSONALES
                        </div>
                        <div class="why-list-body">
                            <p>El manejo de tus datos personales se realiza conforme a nuestra Política de Privacidad. Ahí encontrarás información detallada sobre cómo recopilamos, usamos, modificamos o eliminamos tus datos.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">8</span>
                            CAMBIOS EN LOS TÉRMINOS
                        </div>
                        <div class="why-list-body">
                            <p>Nos reservamos el derecho de actualizar estos términos y condiciones en cualquier momento. Te recomendamos revisar esta página de manera periódica.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">9</span>
                            LÍMITE DE RESPONSABILIDAD
                        </div>
                        <div class="why-list-body">
                            <p>No seremos responsables por pérdidas de datos, interrupciones del servicio, ganancias perdidas u otros daños derivados del uso de nuestra plataforma.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">10</span>
                            INFORMACIÓN DE CONTACTO
                        </div>
                        <div class="why-list-body">
                            <div class="why-highlight-box" style="background:none; border:1px solid #002060; color:#002060; padding:18px 20px;">
                                <p style="margin:0 0 8px; font-size:0.9rem; font-weight:600; text-transform:uppercase; letter-spacing:0.6px;">Contactos oficiales</p>
                                <p style="margin:0; font-size:1rem;">
                                    Correo: <a href="mailto:capacitacion@globalcpaperu.com">capacitacion@globalcpaperu.com</a> |
                                    WhatsApp: <a href="tel:+51967052506">+51 967 052 506</a> |
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
