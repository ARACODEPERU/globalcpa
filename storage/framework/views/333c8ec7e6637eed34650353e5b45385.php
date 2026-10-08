<?php $__env->startSection('title', ' - Términos y Condiciones'); ?>

<?php $__env->startSection('etiquetasmeta'); ?>
    <?php if (isset($component)) { $__componentOriginal42da61123f891e63201d7be28f403427 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42da61123f891e63201d7be28f403427 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo','data' => ['title' => 'Términos y Condiciones - CPA Academy','description' => 'Términos y condiciones de uso de CPA Academy: registro, matrícula, requisitos técnicos, servicios académicos, pagos, propiedad intelectual y canales de contacto.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Términos y Condiciones - CPA Academy','description' => 'Términos y condiciones de uso de CPA Academy: registro, matrícula, requisitos técnicos, servicios académicos, pagos, propiedad intelectual y canales de contacto.']); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal42da61123f891e63201d7be28f403427)): ?>
<?php $attributes = $__attributesOriginal42da61123f891e63201d7be28f403427; ?>
<?php unset($__attributesOriginal42da61123f891e63201d7be28f403427); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal42da61123f891e63201d7be28f403427)): ?>
<?php $component = $__componentOriginal42da61123f891e63201d7be28f403427; ?>
<?php unset($__componentOriginal42da61123f891e63201d7be28f403427); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

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
    <img src="<?php echo e(asset('themes/webpage/images/Logo_cpa_modificado.png')); ?>" alt="CPA Logo" class="loader-logo">
    <p class="loader-text">Cargando</p>
</div>
<!-- Loader ends-->
<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on top ends-->

<!-- page-wrapper Start-->
<div class="page-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <?php if (isset($component)) { $__componentOriginal2a2e454b2e62574a80c8110e5f128b60 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60 = $attributes; } ?>
<?php $component = App\View\Components\Header::resolve(['breadcrumb' => [
        ['label' => 'Términos y Condiciones'],
    ]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('header'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Header::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal2a2e454b2e62574a80c8110e5f128b60)): ?>
<?php $attributes = $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60; ?>
<?php unset($__attributesOriginal2a2e454b2e62574a80c8110e5f128b60); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal2a2e454b2e62574a80c8110e5f128b60)): ?>
<?php $component = $__componentOriginal2a2e454b2e62574a80c8110e5f128b60; ?>
<?php unset($__componentOriginal2a2e454b2e62574a80c8110e5f128b60); ?>
<?php endif; ?>
    <!-- Page Header Ends-->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <?php if (isset($component)) { $__componentOriginald31f0a1d6e85408eecaaa9471b609820 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald31f0a1d6e85408eecaaa9471b609820 = $attributes; } ?>
<?php $component = App\View\Components\Sidebar::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('sidebar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Sidebar::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald31f0a1d6e85408eecaaa9471b609820)): ?>
<?php $attributes = $__attributesOriginald31f0a1d6e85408eecaaa9471b609820; ?>
<?php unset($__attributesOriginald31f0a1d6e85408eecaaa9471b609820); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald31f0a1d6e85408eecaaa9471b609820)): ?>
<?php $component = $__componentOriginald31f0a1d6e85408eecaaa9471b609820; ?>
<?php unset($__componentOriginald31f0a1d6e85408eecaaa9471b609820); ?>
<?php endif; ?>
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
                                        TÉRMINOS Y CONDICIONES
                                    </h1>
                                    <p class="text-white mb-4" style="font-size:1.05rem; max-width:800px; margin:0 auto;">
                                        Última actualización: 6 de octubre de 2026
                                    </p>
                                    <p class="text-white mb-4" style="font-size:1rem; opacity:0.95;">
                                        Bienvenido a CPA Academy. Estos Términos y Condiciones regulan el uso de academy.globalcpaperu.com y la contratación de nuestros programas académicos.
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
                                <h3>9</h3>
                                <p>Secciones clave de los términos</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>5</h3>
                                <p>Puntos técnicos de acceso</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>1</h3>
                                <p>Política de devoluciones asociada</p>
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
                            ALCANCE Y SERVICIOS
                        </div>
                        <div class="why-list-body">
                            <p>CPA Academy ofrece servicios de formación y capacitación profesional. Estos Términos regulan el uso del sitio, pagos, accesos a plataformas, evaluaciones y certificaciones.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">2</span>
                            REGISTRO, MATRÍCULA Y CUENTAS DE USUARIO
                        </div>
                        <div class="why-list-body">
                            <p>El participante deberá proporcionar información verdadera. Las cuentas son personales e intransferibles.</p>
                            <p><strong>Aviso Legal de Inscripción:</strong> Para concretar la matrícula, el estudiante debe marcar la casilla obligatoria habilitada en el formulario de inscripción virtual, mediante la cual confirma expresamente que ha leído y comprendido todos los presentes Términos y Condiciones, así como nuestras políticas asociadas.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">3</span>
                            REQUISITOS TÉCNICOS Y DE ACCESO (MODALIDAD EN LÍNEA Y MIXTA)
                        </div>
                        <div class="why-list-body">
                            <p>Previo a la matrícula, el estudiante debe asegurar que cumple con los siguientes requisitos técnicos para acceder a la plataforma de aprendizaje:</p>
                            <ul>
                                <li><strong>Requisitos de software:</strong> El uso de la plataforma puede requerir acceso a software ofimático básico como Microsoft Excel o Word, y un lector de PDF.</li>
                                <li><strong>Navegadores compatibles:</strong> Nuestra plataforma de aprendizaje está optimizada para funcionar en navegadores específicos, preferentemente Google Chrome, Mozilla Firefox o Safari en sus versiones más recientes.</li>
                                <li><strong>Velocidad de Internet:</strong> Se requiere una conexión a Internet de banda ancha (velocidad mínima recomendada de 5 Mbps a 10 Mbps) para utilizar todos los recursos, participar en clases en directo sin interrupciones y reproducir las clases grabadas.</li>
                                <li><strong>Fechas de inicio y caducidad:</strong> Al momento de adquirir el acceso a la plataforma de aprendizaje en línea, se le notificará claramente al estudiante (en la página de pago y/o vía correo electrónico de confirmación) la fecha exacta en la que podrá acceder a todos los materiales de su curso, así como la fecha de caducidad y cierre de dicho acceso.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">4</span>
                            SOLICITUDES DE VISADO
                        </div>
                        <div class="why-list-body">
                            <p>CPA Academy imparte formación en modalidad presencial, virtual y mixta. Para estudiantes extranjeros que deseen asistir presencialmente a nuestras instalaciones, informamos que CPA Academy no asume ninguna responsabilidad ni brinda asistencia respecto a las solicitudes de visado. Es de plena y exclusiva responsabilidad del estudiante gestionar y cumplir con cualquier requisito de visado aplicable. Si la solicitud de visado de un estudiante es rechazada, esto no le otorga derecho a un reembolso extraordinario, rigiéndose estrictamente por nuestra Política de Devoluciones.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">5</span>
                            PROGRAMAS ACADÉMICOS
                        </div>
                        <div class="why-list-body">
                            <p>Cada programa tendrá condiciones particulares. CPA Academy podrá realizar ajustes razonables en docentes o metodologías para garantizar la calidad.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">6</span>
                            PRECIOS, PAGOS Y PROMOCIONES
                        </div>
                        <div class="why-list-body">
                            <p>Los precios serán comunicados en los canales oficiales y el costo de acceso a la matrícula se aclarará antes de que el estudiante realice cualquier pago. CPA Academy podrá modificar precios para futuras matrículas.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">7</span>
                            REPROGRAMACIONES, CANCELACIONES Y DEVOLUCIONES
                        </div>
                        <div class="why-list-body">
                            <p>CPA Academy podrá reprogramar sesiones por razones de fuerza mayor. Las devoluciones, cancelaciones o transferencias se regirán por nuestra Política de Devoluciones, Reembolsos y Transferencias, que forma parte íntegra de estos Términos.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">8</span>
                            GRABACIONES, MATERIALES Y PROPIEDAD INTELECTUAL
                        </div>
                        <div class="why-list-body">
                            <p>Los contenidos están protegidos por derechos de autor. Queda prohibido compartir credenciales, copiar, reproducir, comercializar o grabar clases sin autorización.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">9</span>
                            PLATAFORMAS, SERVICIOS DE TERCEROS Y FUERZA MAYOR
                        </div>
                        <div class="why-list-body">
                            <p>Algunos servicios dependen de plataformas de terceros. CPA Academy realizará esfuerzos razonables para mantener la continuidad del servicio, pero no será responsable por interrupciones ajenas a su control.</p>
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
        <?php if (isset($component)) { $__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa = $attributes; } ?>
<?php $component = App\View\Components\Footer::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('footer'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Footer::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa)): ?>
<?php $attributes = $__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa; ?>
<?php unset($__attributesOriginal99051027c5120c83a2f9a5ae7c4c3cfa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa)): ?>
<?php $component = $__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa; ?>
<?php unset($__componentOriginal99051027c5120c83a2f9a5ae7c4c3cfa); ?>
<?php endif; ?>
    </div>
</div>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.webpage', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\globalcpa\resources\views/pages/terminos-y-condiciones.blade.php ENDPATH**/ ?>