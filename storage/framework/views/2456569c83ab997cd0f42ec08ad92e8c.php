<?php $__env->startSection('title', ' - Políticas de Devoluciones'); ?>

<?php $__env->startSection('etiquetasmeta'); ?>
    <?php if (isset($component)) { $__componentOriginal42da61123f891e63201d7be28f403427 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42da61123f891e63201d7be28f403427 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo','data' => ['title' => 'Políticas de Devoluciones - CPA Academy','description' => 'Lee las políticas de devoluciones, reembolsos y transferencias de CPA Academy: condiciones de cancelación, acceso a contenidos, reprogramación y canales de atención.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Políticas de Devoluciones - CPA Academy','description' => 'Lee las políticas de devoluciones, reembolsos y transferencias de CPA Academy: condiciones de cancelación, acceso a contenidos, reprogramación y canales de atención.']); ?>
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
<!-- tap on tap ends-->

<!-- page-wrapper Start-->
<div class="page-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <?php if (isset($component)) { $__componentOriginal2a2e454b2e62574a80c8110e5f128b60 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60 = $attributes; } ?>
<?php $component = App\View\Components\Header::resolve(['breadcrumb' => [
        ['label' => 'Políticas de Devoluciones'],
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
                                        <i class="fa fa-shield-alt"></i> Políticas de Devoluciones
                                    </span>
                                    <h1 class="display-4 fw-bold mb-3 text-white" style="text-transform:uppercase; letter-spacing:1px;">
                                        POLITICAS DE DEVOLUCIONES
                                    </h1>
                                    <p class="text-white mb-4" style="font-size:1.05rem; max-width:800px; margin:0 auto;">
                                        Última actualización: 6 de octubre de 2026
                                    </p>
                                    <p class="text-white mb-4" style="font-size:1rem; opacity:0.95;">
                                        La presente Política establece las condiciones aplicables a la cancelación, devolución, transferencia de matrícula y saldo a favor de los programas académicos, cursos, especializaciones, talleres y demás servicios ofrecidos por CPA Academy. Esta Política forma parte de nuestros Términos y Condiciones y se aplica conjuntamente con ellos.
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
                                Información clave de la política
                            </p>
                            <h2 class="h1 mb-4 text-navy-custom" style="font-size:2rem;">Todo lo que necesitas saber sobre devoluciones y reembolsos</h2>
                        </div>
                    </div>

                    <div class="row g-4 mb-3">
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>7</h3>
                                <p>Días calendario para solicitar cancelación</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>5</h3>
                                <p>Días hábiles para la evaluación de la solicitud</p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="why-count-box">
                                <h3>15</h3>
                                <p>Días hábiles para reembolso en reprogramaciones</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Secciones de la política -->
            <div id="politicas" class="why-section">
                <div class="container">
                    <div class="why-list-title mb-4">
                        Política de Devoluciones y Reembolsos
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">1</span>
                            CANCELACIÓN Y SOLICITUD DE DEVOLUCIÓN
                        </div>
                        <div class="why-list-body">
                            <p>El participante podrá solicitar la cancelación de su matrícula y la devolución del importe abonado cuando:</p>
                            <ul>
                                <li>La solicitud se realice con una anticipación mínima de <strong>siete (7) días calendario</strong> antes de la fecha de inicio del programa.</li>
                                <li>El programa aún no haya iniciado.</li>
                                <li>No se haya iniciado la prestación del servicio ni habilitado el acceso a contenidos o recursos digitales del programa. Las solicitudes que cumplan estas condiciones serán evaluadas por CPA Academy conforme al procedimiento establecido. El costo de acceso a la matrícula es transparente y se detalla al momento de la compra; no existen comisiones ocultas que afecten el importe base del reembolso.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">2</span>
                            PROGRAMAS INICIADOS Y ACCESO A CONTENIDOS
                        </div>
                        <div class="why-list-body">
                            <p>Una vez iniciado el programa, o cuando se haya habilitado al participante el acceso a la plataforma o recursos, no procederá la devolución por desistimiento voluntario, salvo que corresponda conforme a la legislación aplicable. La habilitación del acceso a contenidos digitales podrá considerarse inicio de la prestación del servicio. CPA Academy podrá revocar los accesos en caso de devolución.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">3</span>
                            ALTERNATIVAS A LA DEVOLUCIÓN Y TRANSFERENCIAS
                        </div>
                        <div class="why-list-body">
                            <p>Antes del inicio del programa, el participante podrá solicitar, sujeto a aprobación de CPA Academy:</p>
                            <ul>
                                <li><strong>Saldo a favor:</strong> el importe abonado podrá aplicarse a un futuro programa.</li>
                                <li><strong>Transferencia a otra persona:</strong> la matrícula podrá transferirse a otra persona, siempre que cumpla los requisitos académicos.</li>
                                <li><strong>Transferencias de curso o sesión de examen:</strong> El participante podrá solicitar la transferencia de su matrícula a otro curso o a una sesión de examen distinta una vez que ha pagado, siempre y cuando la solicitud se envíe por escrito con una anticipación mínima de siete (7) días calendario antes del inicio original del curso o acceso a la plataforma. Si el participante no cumple con este plazo o si el curso ya ha comenzado, la institución no permitirá la transferencia de curso ni de sesión de examen.</li>
                            </ul>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">4</span>
                            REPROGRAMACIÓN O CANCELACIÓN POR CPA ACADEMY
                        </div>
                        <div class="why-list-body">
                            <p>Si CPA Academy no pudiera desarrollar un programa, podrá reprogramarlo o cancelarlo y gestionar la devolución del importe abonado en un plazo máximo de <strong>quince (15) días hábiles</strong>.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">5</span>
                            INASISTENCIA DEL PARTICIPANTE
                        </div>
                        <div class="why-list-body">
                            <p>La inasistencia a clases o actividades académicas no genera automáticamente derecho a devolución.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">6</span>
                            PROMOCIONES, DESCUENTOS Y BECAS
                        </div>
                        <div class="why-list-body">
                            <p>Las matrículas realizadas mediante promociones podrán estar sujetas a condiciones particulares que serán comunicadas antes de confirmar la matrícula.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">7</span>
                            PROCEDIMIENTO PARA SOLICITAR UNA DEVOLUCIÓN
                        </div>
                        <div class="why-list-body">
                            <p>Las solicitudes deberán enviarse a: <strong>capacitacion@globalcpaperu.com</strong> indicando <strong>Nombres</strong>, <strong>Programa</strong>, <strong>Comprobante de pago</strong> y <strong>Motivo</strong>. Se evaluará en un máximo de <strong>cinco (5) días hábiles</strong>.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">8</span>
                            MEDIO Y PLAZO DEL REEMBOLSO
                        </div>
                        <div class="why-list-body">
                            <p>Las devoluciones aprobadas se realizarán, de ser posible, mediante el mismo medio de pago utilizado.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">9</span>
                            DERECHOS DEL PARTICIPANTE
                        </div>
                        <div class="why-list-body">
                            <p>Esta Política no limita los derechos conforme a la legislación peruana aplicable.</p>
                        </div>
                    </div>

                    <div class="why-list-item">
                        <div class="why-list-head">
                            <span class="why-list-num">10</span>
                            CANALES DE ATENCIÓN
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

<?php echo $__env->make('layouts.webpage', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\globalcpa\resources\views/pages/politicas_devoluciones.blade.php ENDPATH**/ ?>