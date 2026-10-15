@extends('layouts.webpage')

@section('title', ' - Política de Cookies')

@section('etiquetasmeta')
    <x-seo
        title="Política de Cookies - CPA Academy"
        description="Política de Cookies de CPA Academy: qué son las cookies, cuáles usamos (propias y de terceros), con qué finalidad, cómo gestionarlas y cómo protegemos tu privacidad conforme a la Ley N.° 29733 y la normativa aplicable."
    />
@endsection

@section('content')

<style>
    .text-navy-custom { color:#002060 !important; }
    :is(.dark, .dark-only) .text-navy-custom { color:#f6f7fb !important; }

    .text-muted-custom { color:#6b7280; }
    :is(.dark, .dark-only) .text-muted-custom { color:#9ca3af !important; }

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

    .cookie-table-wrap {
        overflow-x:auto;
        margin-top:12px;
    }
    .cookie-table {
        width:100%;
        border-collapse:collapse;
        font-size:0.9rem;
    }
    .cookie-table th,
    .cookie-table td {
        border:1px solid #e2e8f0;
        padding:10px 12px;
        text-align:left;
        vertical-align:top;
    }
    .cookie-table thead th {
        background:#002060;
        color:#ffffff;
        font-weight:600;
    }
    .cookie-table tbody tr:nth-child(even) {
        background:#f8fafc;
    }
    :is(.dark, .dark-only) .cookie-table th,
    :is(.dark, .dark-only) .cookie-table td {
        border-color:#334155;
        color:#cbd2e1;
    }
    :is(.dark, .dark-only) .cookie-table tbody tr:nth-child(even) {
        background:#0f172a;
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
        ['label' => 'Política de Cookies'],
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
                                        <i class="fa fa-shield"></i> Política de Cookies
                                    </span>
                                    <h1 class="display-4 fw-bold mb-3 text-white" style="text-transform:uppercase; letter-spacing:1px;">
                                        POLÍTICA DE COOKIES
                                    </h1>
                                    <p class="text-white mb-4" style="font-size:1.05rem; max-width:800px; margin:0 auto;">
                                        Última actualización: 15 de octubre de 2026
                                    </p>
                                    <p class="text-white mb-4" style="font-size:1rem; opacity:0.95;">
                                        En CPA ACADEMY (en adelante, "nosotros", "nuestro" o "la empresa") utilizamos cookies y
                                        tecnologías similares en nuestro sitio web https://academy.globalcpaperu.com/ para que
                                        funcione correctamente, recordar tus preferencias y entender cómo lo utilizas. En esta
                                        política te explicamos de forma clara qué son las cookies, cuáles usamos, con qué finalidad
                                        y cómo puedes gestionarlas. <strong class="text-white">Nuestro compromiso permanente es proteger tu
                                        privacidad y tratar tus datos de forma transparente, lícita y segura.</strong>
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
                                Información clave sobre cookies
                            </p>
                            <h2 class="h1 mb-4 text-navy-custom" style="font-size:2rem;">Transparencia y control sobre tu navegación</h2>
                        </div>
                    </div>

                    <div class="row g-4 mb-3">
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>4</h3>
                                <p>Tipos de cookies según su finalidad</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>3</h3>
                                <p>Categorías de proveedores externos</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>100%</h3>
                                <p>Compromiso con tu privacidad</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secciones de la política -->
            <div id="cookies" class="why-section">
                <div class="container">
                    <div class="why-list-title mb-4">
                        Política de Cookies
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">1</span>
                            ¿QUÉ SON LAS COOKIES?
                        </div>
                        <div class="why-list-body">
                            <p>
                                Las cookies son pequeños archivos de texto que se almacenan en tu dispositivo (ordenador,
                                tablet o teléfono) cuando visitas un sitio web. Permiten que el sitio recuerde tus acciones y
                                preferencias durante un tiempo, facilitan la navegación, habilitan funciones esenciales y
                                aportan información estadística sobre el uso del sitio.
                            </p>
                            <p>
                                Junto a las cookies, podemos utilizar otras tecnologías equivalentes como <strong>píxeles de
                                seguimiento</strong>, <strong>etiquetas</strong>, almacenamiento local (localStorage) y
                                <strong>scripts</strong> de medición. Cuando en esta política hablamos de "cookies" nos
                                referimos a todas ellas.
                            </p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">2</span>
                            TIPOS DE COOKIES QUE UTILIZAMOS
                        </div>
                        <div class="why-list-body">
                            <p>Clasificamos las cookies según su finalidad:</p>
                            <ul>
                                <li>
                                    <strong>Cookies necesarias o técnicas:</strong> imprescindibles para el funcionamiento del
                                    sitio y de sus servicios (seguridad, sesión, carrito de compras, preferencias de
                                    accesibilidad). No requieren consentimiento porque sin ellas el sitio no funciona.
                                </li>
                                <li>
                                    <strong>Cookies de preferencias:</strong> recuerdan tus ajustes, como el idioma, el tema
                                    visual (modo claro u oscuro) o el consentimiento de este mismo aviso de cookies.
                                </li>
                                <li>
                                    <strong>Cookies analíticas:</strong> nos permiten medir y analizar de forma agregada la
                                    navegación (páginas visitadas, tiempo en el sitio, origen del tráfico), para entender el uso
                                    del sitio y mejorarlo.
                                </li>
                                <li>
                                    <strong>Cookies de publicidad y marketing:</strong> utilizadas para mostrarte contenido y
                                    anuncios relevantes en nuestras plataformas y en sitios de terceros, y para medir la
                                    eficacia de nuestras campañas.
                                </li>
                            </ul>
                            <p class="mt-2">
                                Y según quién las gestiona, pueden ser <strong>propias</strong> (gestionadas por CPA Academy) o
                                <strong>de terceros</strong> (gestionadas por proveedores externos).
                            </p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">3</span>
                            COOKIES DE TERCEROS Y PROVEEDORES EXTERNOS
                        </div>
                        <div class="why-list-body">
                            <p>
                                Algunas cookies son instaladas por servicios de terceros que utilizamos para operar y
                                optimizar el sitio. Estos proveedores actúan como encargados del tratamiento y solo acceden a
                                la información en la medida necesaria para prestar su servicio. Los principales son:
                            </p>
                            <div class="cookie-table-wrap">
                                <table class="cookie-table">
                                    <thead>
                                        <tr>
                                            <th>Proveedor</th>
                                            <th>Finalidad</th>
                                            <th>Categoría</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>Google Analytics / Google Tag</td>
                                            <td>Medición y análisis estadístico del tráfico y del comportamiento de navegación.</td>
                                            <td>Analítica</td>
                                        </tr>
                                        <tr>
                                            <td>Meta (Facebook Pixel)</td>
                                            <td>Medición de campañas y publicidad personalizada en plataformas Meta.</td>
                                            <td>Publicidad y marketing</td>
                                        </tr>
                                        <tr>
                                            <td>Google Fonts</td>
                                            <td>Carga de tipografías para mostrar correctamente el diseño del sitio.</td>
                                            <td>Funcional / técnica</td>
                                        </tr>
                                        <tr>
                                            <td>Redes de distribución de contenido (jsDelivr, Cloudflare, unpkg)</td>
                                            <td>Entrega de librerías y recursos que el sitio necesita para funcionar.</td>
                                            <td>Técnica</td>
                                        </tr>
                                        <tr>
                                            <td>Pasarelas de pago y plataformas de contacto</td>
                                            <td>Procesar pagos y habilitar canales de atención (por ejemplo, mensajería).</td>
                                            <td>Necesaria / funcional</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <p class="mt-3">
                                Estos terceros cuentan con sus propias políticas de privacidad y de cookies, que puedes
                                consultar en sus respectivos sitios web. CPA Academy no controla las cookies que ellos
                                instalan, pero selecciona proveedores que ofrecen garantías adecuadas de seguridad y
                                confidencialidad.
                            </p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">4</span>
                            FINALIDAD DEL USO DE COOKIES
                        </div>
                        <div class="why-list-body">
                            <p>Utilizamos cookies para las siguientes finalidades:</p>
                            <ul>
                                <li>Garantizar el correcto funcionamiento, seguridad y estabilidad del sitio web.</li>
                                <li>Recordar tus preferencias y el consentimiento otorgado sobre este aviso.</li>
                                <li>Medir el uso del sitio y elaborar estadísticas agregadas para mejorar contenidos y servicios.</li>
                                <li>Gestionar procesos de matrícula, carrito de compras y pagos en línea.</li>
                                <li>Mostrar y medir campañas publicitarias cuando hayas prestado tu consentimiento.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">5</span>
                            BASE LEGAL Y CONSENTIMIENTO
                        </div>
                        <div class="why-list-body">
                            <p>
                                El uso de cookies se rige por la <strong>Ley N.° 29733, Ley de Protección de Datos
                                Personales</strong>, su Reglamento aprobado por <strong>D.S. N.° 003-2013-JUS</strong> y las
                                disposiciones de la Autoridad Nacional de Protección de Datos Personales, así como por los
                                estándares internacionales de consentimiento (por ejemplo, el RGPD de la Unión Europea) que
                                tomamos como referencia de buenas prácticas.
                            </p>
                            <p>
                                Las cookies necesarias se instalan sobre la base del <strong>interés legítimo</strong> y de la
                                necesidad de prestar el servicio solicitado. Las cookies analíticas, de preferencias y de
                                publicidad se utilizan solo con tu <strong>consentimiento</strong>, que debe ser libre, previo,
                                expreso e informado.
                            </p>
                            <p>
                                Al ingresar por primera vez al sitio te mostramos un aviso en la parte inferior de la pantalla.
                                Si pulsas <strong>"Aceptar"</strong>, guardamos tu decisión en el almacenamiento local de tu
                                navegador y el aviso no vuelve a mostrarse. Puedes retirar tu consentimiento en cualquier
                                momento eliminando los datos de navegación o gestionando las cookies como se explica en el
                                punto 6.
                            </p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">6</span>
                            CÓMO GESTIONAR O DESACTIVAR LAS COOKIES
                        </div>
                        <div class="why-list-body">
                            <p>
                                Puedes administrar, bloquear o eliminar las cookies desde la configuración de tu navegador. A
                                continuación, algunos enlaces de ayuda:
                            </p>
                            <ul>
                                <li><strong>Google Chrome:</strong> Configuración &rarr; Privacidad y seguridad &rarr; Cookies y otros datos de sitios.</li>
                                <li><strong>Mozilla Firefox:</strong> Preferencias &rarr; Privacidad y seguridad &rarr; Cookies y datos del sitio.</li>
                                <li><strong>Safari:</strong> Preferencias &rarr; Privacidad &rarr; Gestionar datos de sitios web.</li>
                                <li><strong>Microsoft Edge:</strong> Configuración &rarr; Cookies y permisos del sitio.</li>
                            </ul>
                            <p>
                                Ten en cuenta que si desactivas las cookies necesarias algunas funciones del sitio podrían no
                                operar correctamente. La desactivación de cookies publicitarias y analíticas no impide el uso
                                del sitio, pero puede afectar a la personalización de contenidos.
                            </p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">7</span>
                            CONSERVACIÓN Y SEGURIDAD DE LA INFORMACIÓN
                        </div>
                        <div class="why-list-body">
                            <p>
                                Las cookies pueden ser de sesión (se eliminan al cerrar el navegador) o persistentes (permanecen
                                durante un periodo determinado). Conservamos la información asociada únicamente durante el tiempo
                                necesario para cumplir las finalidades descritas y aplicando medidas técnicas y organizativas
                                razonables para protegerla frente a accesos no autorizados.
                            </p>
                            <p>
                                <strong>Nunca vendemos tu información personal ni la utilizamos para fines distintos a los
                                informados en esta política.</strong>
                            </p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">8</span>
                            TU PRIVACIDAD, SIEMPRE PROTEGIDA
                        </div>
                        <div class="why-list-body">
                            <p>
                                Las cookies que utilizamos no revelan por sí solas tu identidad y no afectan a tu privacidad más
                                allá de lo descrito. Puedes ejercer en cualquier momento tus derechos de información, acceso,
                                rectificación, cancelación/supresión, oposición y revocación del consentimiento escribiendo a
                                nuestro correo de contacto.
                            </p>
                            <p>
                                Para conocer en detalle cómo tratamos tus datos personales, te invitamos a revisar nuestra
                                <a href="{{ route('politicas_privacidad') }}">Política de Privacidad</a>.
                            </p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">9</span>
                            ACTUALIZACIONES DE ESTA POLÍTICA
                        </div>
                        <div class="why-list-body">
                            <p>
                                Podemos actualizar esta Política de Cookies para reflejar cambios normativos, técnicos u
                                operativos. Publicaremos siempre la versión vigente en esta misma página, indicando la fecha de
                                su última actualización.
                            </p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">10</span>
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
