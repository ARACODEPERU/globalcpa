@extends('layouts.webpage')

@section('title', ' - Política de Privacidad')

@section('etiquetasmeta')
    <x-seo
        title="Política de Privacidad - CPA Academy"
        description="Política de Privacidad de CPA Academy: cómo recopilamos, usamos, conservamos y protegemos los datos personales de nuestros usuarios, alumnos, interesados y visitantes conforme a la Ley N.° 29733 y normativa peruana aplicable."
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
        ['label' => 'Política de Privacidad'],
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
                                        <i class="fa fa-lock"></i> Política de Privacidad
                                    </span>
                                    <h1 class="display-4 fw-bold mb-3 text-white" style="text-transform:uppercase; letter-spacing:1px;">
                                        POLITICAS DE PRIVACIDAD
                                    </h1>
                                    <p class="text-white mb-4" style="font-size:1.05rem; max-width:800px; margin:0 auto;">
                                        Última actualización: 06 de octubre de 2026
                                    </p>
                                    <p class="text-white mb-4" style="font-size:1rem; opacity:0.95;">
                                        En CPA ACADEMY (en adelante, "nosotros", "nuestro" o "la empresa"), valoramos tu privacidad y nos comprometemos a proteger la información personal que compartes con nosotros. Esta política de privacidad describe cómo recopilamos, usamos y protegemos tus datos personales cuando accedes a nuestros cursos en línea a través de nuestro sitio web https://academy.globalcpaeru.com/.
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
                                Información clave de la privacidad
                            </p>
                            <h2 class="h1 mb-4 text-navy-custom" style="font-size:2rem;">Cómo protegemos tu información personal</h2>
                        </div>
                    </div>

                    <div class="row g-4 mb-3">
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>10</h3>
                                <p>Secciones clave de la privacidad</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>3</h3>
                                <p>Bloques principales de información</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>5</h3>
                                <p>Derechos del usuario</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secciones de la política -->
            <div id="privacidad" class="why-section">
                <div class="container">
                    <div class="why-list-title mb-4">
                        Política de Privacidad
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">1</span>
                            RESPONSABLE DEL TRATAMIENTO
                        </div>
                        <div class="why-list-body">
                            <p>CPA Academy es responsable del tratamiento de los datos personales que recopila a través de sus canales y servicios. Para consultas, solicitudes relacionadas con datos personales o ejercicio de derechos, puedes comunicarte a:</p>
                            <ul>
                                <li>Correo: <strong>informes@globalcpaperu.com</strong></li>
                                <li>Sitio web: <a href="https://academy.globalcpaperu.com" target="_blank">academy.globalcpaperu.com</a></li>
                            </ul>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">2</span>
                            DATOS PERSONALES QUE PODEMOS RECOPILAR
                        </div>
                        <div class="why-list-body">
                            <p>Dependiendo de la interacción que mantengas con CPA Academy, podemos recopilar:</p>
                            <ul>
                                <li>Nombres y apellidos.</li>
                                <li>Documento de identidad, cuando resulte necesario para determinados servicios.</li>
                                <li>Correo electrónico, número de teléfono y WhatsApp.</li>
                                <li>Información profesional, académica o laboral que decidas proporcionar.</li>
                                <li>Información relacionada con tu matrícula, participación, evaluaciones y certificaciones.</li>
                                <li>Información necesaria para procesar pagos y gestionar operaciones comerciales.</li>
                                <li>Información proporcionada mediante formularios, consultas, encuestas o comunicaciones.</li>
                                <li>Información técnica y de navegación, como dirección IP, navegador, dispositivo, páginas visitadas y comportamiento de navegación.</li>
                            </ul>
                            <p>No solicitamos datos personales que no sean necesarios para las finalidades informadas.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">3</span>
                            FINALIDADES DEL TRATAMIENTO
                        </div>
                        <div class="why-list-body">
                            <p>Podemos utilizar los datos personales para las siguientes finalidades:</p>
                            <ul>
                                <li><strong>Prestación de servicios:</strong> Gestionar consultas, registros y matrículas. Procesar pagos y operaciones relacionadas con los servicios contratados. Proporcionar acceso a programas, clases, plataformas, materiales y recursos. Gestionar asistencia, evaluaciones y certificaciones. Brindar soporte académico, administrativo y tecnológico. Comunicar cambios, reprogramaciones, incidencias y demás información relacionada con los servicios contratados.</li>
                                <li><strong>Gestión comercial:</strong> Cuando corresponda y conforme a la normativa aplicable, podemos utilizar los datos para atender solicitudes de información, realizar seguimiento comercial y gestionar procesos de admisión o inscripción.</li>
                                <li><strong>Marketing y prospección comercial:</strong> Con el consentimiento que corresponda, podremos utilizar los datos de contacto para enviar información sobre programas, eventos, promociones, novedades y otros servicios. El titular podrá retirar su consentimiento u oponerse a comunicaciones comerciales.</li>
                                <li><strong>Mejora de nuestros servicios:</strong> Podemos utilizar información de uso y navegación para analizar el funcionamiento de nuestros canales digitales.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">4</span>
                            COOKIES Y TECNOLOGÍAS SIMILARES
                        </div>
                        <div class="why-list-body">
                            <p>Nuestro sitio web puede utilizar cookies, píxeles, etiquetas y tecnologías similares para permitir el funcionamiento del sitio, recordar preferencias y obtener estadísticas. El usuario puede gestionar determinadas preferencias de cookies desde su navegador.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">5</span>
                            COMPARTICIÓN Y ENCARGADOS DEL TRATAMIENTO
                        </div>
                        <div class="why-list-body">
                            <p>CPA Academy podrá utilizar proveedores especializados para operar sus servicios (plataformas educativas, procesadores de pago, etc.).</p>
                            <p><strong>Uso del Servicio de Resultados de ACCA:</strong> Informamos a los estudiantes de los programas de la cualificación ACCA que sus datos personales serán compartidos directamente con ACCA (Association of Chartered Certified Accountants) para el uso de su Servicio de Resultados. Este servicio es el mecanismo mediante el cual ACCA recopila datos de los estudiantes para permitir el análisis de las tasas de aprobación. Cuando corresponda, podremos realizar transferencias nacionales o internacionales de datos, adoptando las medidas exigidas por la normativa. Podremos comunicar información cuando exista una obligación legal.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">6</span>
                            CONSERVACIÓN DE LOS DATOS
                        </div>
                        <div class="why-list-body">
                            <p>Conservaremos los datos personales durante el tiempo necesario para cumplir las finalidades para las cuales fueron recopilados, atender obligaciones legales o resolver controversias.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">7</span>
                            SEGURIDAD DE LA INFORMACIÓN
                        </div>
                        <div class="why-list-body">
                            <p>Adoptamos medidas técnicas, organizativas y de seguridad razonables destinadas a proteger los datos personales. Ningún sistema electrónico puede garantizar una seguridad absoluta.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">8</span>
                            DERECHOS DEL TITULAR DE LOS DATOS
                        </div>
                        <div class="why-list-body">
                            <p>El titular puede ejercer los derechos de información, acceso, rectificación, cancelación/supresión, oposición y revocación del consentimiento. Las solicitudes podrán enviarse a: <strong>informes@globalcpaperu.com</strong>.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">9</span>
                            COMUNICACIONES COMERCIALES
                        </div>
                        <div class="why-list-body">
                            <p>El titular puede solicitar en cualquier momento dejar de recibir comunicaciones comerciales. Esto no afecta las comunicaciones indispensables para la prestación del servicio.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">10</span>
                            MENORES DE EDAD
                        </div>
                        <div class="why-list-body">
                            <p>Nuestros servicios están dirigidos a mayores de edad. Si se recopilan datos de menores, se aplicarán las condiciones exigidas por la normativa vigente.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">11</span>
                            ENLACES Y SERVICIOS DE TERCEROS
                        </div>
                        <div class="why-list-body">
                            <p>Nuestro sitio web puede contener enlaces a terceros. CPA Academy no controla sus políticas de privacidad.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">12</span>
                            CAMBIOS EN ESTA POLÍTICA
                        </div>
                        <div class="why-list-body">
                            <p>CPA Academy podrá actualizar esta Política, publicando la versión vigente en el sitio web.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">13</span>
                            CONTACTO
                        </div>
                        <div class="why-list-body">
                            <div class="why-highlight-box" style="background:none; border:1px solid #002060; color:#002060; padding:18px 20px;">
                                <p style="margin:0 0 8px; font-size:0.9rem; font-weight:600; text-transform:uppercase; letter-spacing:0.6px;">Contacto</p>
                                <p style="margin:0; font-size:1rem;">
                                    Correo: <strong>informes@globalcpaperu.com</strong> |
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
