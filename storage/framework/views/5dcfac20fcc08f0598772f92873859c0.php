

<?php $__env->startSection('title', ' - Testimonios'); ?>

<?php $__env->startSection('etiquetasmeta'); ?>
    <?php if (isset($component)) { $__componentOriginal42da61123f891e63201d7be28f403427 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42da61123f891e63201d7be28f403427 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo','data' => ['title' => 'Testimonios - CPA Academy','description' => 'Historias reales de profesionales que transformaron su carrera con CPA Academy. Conoce los testimonios de nuestros egresados en LATAM.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Testimonios - CPA Academy','description' => 'Historias reales de profesionales que transformaron su carrera con CPA Academy. Conoce los testimonios de nuestros egresados en LATAM.']); ?>
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

    
    <?php if(!empty($schema)): ?>
        <script type="application/ld+json">
            <?php echo json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>

        </script>
    <?php endif; ?>

    <style>
        /* =========================================
               PÁGINA TESTIMONIOS
               ========================================= */

        .text-navy-custom {
            color: #002060 !important;
        }

        :is(.dark, .dark-only) .text-navy-custom {
            color: #f6f7fb !important;
        }

        .text-muted-custom {
            color: #6b7280;
        }

        :is(.dark, .dark-only) .text-muted-custom {
            color: #9ca3af !important;
        }

        .bg-card-custom {
            background-color: #ffffff !important;
            border: 1px solid #eef2f7;
        }

        :is(.dark, .dark-only) .bg-card-custom {
            background-color: #1d273a !important;
            border-color: #374558 !important;
        }

        .tst-section {
            padding: 70px 0;
        }

        .tst-section-alt {
            background-color: #f8f9fa;
        }

        :is(.dark, .dark-only) .tst-section-alt {
            background-color: #111827;
        }

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

        .tst-stat {
            text-align: center;
            color: #ffffff;
        }

        .tst-stat i {
            font-size: 28px;
            color: #ffc107;
            margin-bottom: 10px;
            display: block;
        }

        .tst-stat strong {
            display: block;
            font-size: 2.2rem;
            font-weight: 800;
            line-height: 1.1;
        }

        .tst-stat span {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.75);
            font-weight: 600;
        }

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

        .tst-featured-name {
            font-weight: 700;
            font-size: 1.1rem;
            margin-bottom: 2px;
        }

        .tst-featured-role {
            font-size: 0.9rem;
            color: rgba(255, 255, 255, 0.7);
        }

        .tst-featured-stars {
            color: #ffc107;
            font-size: 1rem;
        }

        .tst-featured-program {
            font-size: 1.05rem;
            font-weight: 800;
            text-transform: uppercase;
            letter-spacing: 0.6px;
            color: #ffc107;
            margin-bottom: 12px;
            position: relative;
            z-index: 1;
        }

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

        :is(.dark, .dark-only) .tst-card .tst-text {
            color: #9ca3af;
        }

        .tst-card .tst-stars {
            color: #ffc107;
            font-size: 0.85rem;
            margin-bottom: 15px;
        }

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

        .tst-card .tst-name {
            font-weight: 700;
            font-size: 0.98rem;
            margin-bottom: 2px;
        }

        .tst-card .tst-role {
            font-size: 0.82rem;
        }

        /* El titulo (producto, servicio o curso) abre la tarjeta, antes del comentario. */
        .tst-card .tst-card-title {
            font-size: 1.02rem;
            font-weight: 800;
            line-height: 1.35;
            color: #002060;
            margin-bottom: 14px;
        }

        :is(.dark, .dark-only) .tst-card .tst-card-title {
            color: #93c5fd;
        }

        .tst-mini-card .tst-mini-title {
            font-weight: 700;
            font-size: 0.82rem;
            line-height: 1.3;
            color: #002060;
            margin-bottom: 8px;
        }

        :is(.dark, .dark-only) .tst-mini-card .tst-mini-title {
            color: #93c5fd;
        }

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

        .tst-marquee-viewport:hover .tst-marquee-track {
            animation-play-state: paused;
        }

        @keyframes tst-scroll {
            0% {
                transform: translateX(0);
            }

            50% {
                transform: translateX(-50%);
            }
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

        .tst-mini-card .tst-mini-author {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .tst-mini-card .tst-mini-avatar {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e30613;
        }

        .tst-mini-card .tst-mini-name {
            font-weight: 700;
            font-size: 0.9rem;
            margin-bottom: 1px;
        }

        .tst-mini-card .tst-mini-role {
            font-size: 0.78rem;
        }

        /* --- Video / portada de la tarjeta --- */
        .tst-card-media {
            position: relative;
            height: 165px;
            border-radius: 14px;
            overflow: hidden;
            margin-bottom: 18px;
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
        }

        .tst-card-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .tst-play {
            position: absolute;
            inset: 0;
            margin: auto;
            width: 54px;
            height: 54px;
            border-radius: 50%;
            border: none;
            background: rgba(227, 6, 19, 0.92);
            color: #ffffff;
            font-size: 19px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: 0 10px 24px rgba(0, 0, 0, 0.3);
            transition: transform 0.25s ease, background 0.25s ease;
        }

        .tst-play:hover {
            transform: scale(1.08);
            background: #e30613;
            color: #ffffff;
        }

        .tst-video-tag {
            position: absolute;
            top: 10px;
            left: 10px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 4px 10px;
            border-radius: 50px;
            background: rgba(0, 0, 0, 0.55);
            color: #ffffff;
            font-size: 0.72rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 0.4px;
        }

        .tst-read-more {
            background: none;
            border: none;
            padding: 0;
            margin-top: 8px;
            color: #002060;
            font-weight: 700;
            font-size: 0.82rem;
        }

        .tst-read-more:hover {
            color: #e30613;
        }

        .tst-read-more i {
            display: inline-block;
            transition: transform 0.2s ease;
        }

        .tst-read-more[aria-expanded="true"] i {
            transform: rotate(180deg);
        }

        /* Toggle CSS-only para el texto largo del testimonio (sin depender de Bootstrap). */
        .tst-quote-details {
            margin-top: 8px;
            padding: 0;
            border: 0;
            cursor: pointer;
            outline: none;
            color: #002060;
            font-weight: 700;
            font-size: 0.82rem;
        }

        .tst-quote-details .tst-quote-summary {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 12px;
            padding: 6px 0;
            cursor: pointer;
        }

        .tst-quote-details .tst-quote-summary::-webkit-details-marker {
            display: none;
        }

        .tst-quote-details .tst-read-more.tst-read-more-summary {
            background: none;
            border: none;
            padding: 0;
            margin: 0;
            color: #002060;
            font-weight: 700;
            font-size: 0.82rem;
            cursor: pointer;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: color 0.2s ease;
        }

        .tst-quote-details .tst-read-more.tst-read-more-summary:hover {
            color: #e30613;
        }

        .tst-quote-details .tst-read-more.tst-read-more-summary i {
            display: inline-block;
            transition: transform 0.2s ease;
        }

        .tst-quote-details[open] .tst-read-more.tst-read-more-summary i {
            transform: rotate(180deg);
        }

        :is(.dark, .dark-only) .tst-quote-details .tst-read-more.tst-read-more-summary {
            color: #93c5fd;
        }

        :is(.dark, .dark-only) .tst-quote-details .tst-read-more.tst-read-more-summary:hover {
            color: #f87171;
        }

        :is(.dark, .dark-only) .tst-read-more {
            color: #93c5fd;
        }

        .tst-featured-video {
            margin-top: 18px;
        }

        .tst-featured-video .btn {
            border-radius: 50px;
            font-weight: 700;
            padding: 9px 22px;
            background: #e30613;
            border: none;
            color: #ffffff;
        }

        .tst-featured-video .btn:hover {
            background: #c00511;
            color: #ffffff;
        }

        .modal-content {
            border: none;
            border-radius: 16px;
            overflow: hidden;
        }

        .modal-header {
            background: #002060;
            color: #ffffff;
            border-bottom: 0;
        }

        .modal-header .btn-close {
            filter: invert(1);
            opacity: 0.85;
        }

        /* Forzar que el iframe de video llene el contenedor ratio */
        .ratio {
            position: relative;
        }

        .ratio>* {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            border: 0;
        }

        /* Vimeo: eliminar espacio negro arriba y forzar dimensiones */
        .ratio iframe {
            position: absolute !important;
            top: 0 !important;
            left: 0 !important;
            width: 100% !important;
            height: 100% !important;
            border: 0 !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        /* Modal header siempre legible */
        .modal-header,
        .modal-header .modal-title {
            color: #ffffff !important;
        }

        body.dark-only .modal-header {
            background: #002060 !important;
            color: #ffffff !important;
            border-color: #004080 !important;
        }

        body.dark-only .modal-header .modal-title {
            color: #ffffff !important;
        }

        body.dark-only .modal-header .btn-close {
            filter: invert(1);
            opacity: 0.85;
        }

        body.dark-only .page-wrapper .modal-content {
            background-color: #1d273a !important;
        }

        /* --- Filtros --- */
        .tst-filter-chip {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 7px 16px;
            border-radius: 50px;
            border: 1px solid rgba(128, 128, 128, 0.3);
            background: #ffffff;
            color: #4b5563;
            font-size: 0.85rem;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.25s ease;
        }

        .tst-filter-chip:hover {
            border-color: #002060;
            color: #002060;
        }

        .tst-filter-chip.is-active {
            background: #002060;
            border-color: #002060;
            color: #ffffff;
        }

        :is(.dark, .dark-only) .tst-filter-chip {
            background: #1d273a;
            border-color: #374558;
            color: #cbd5e1;
        }

        :is(.dark, .dark-only) .tst-filter-chip.is-active {
            background: #e30613;
            border-color: #e30613;
            color: #ffffff;
        }

        .tst-group-title {
            font-weight: 700;
            font-size: 1.15rem;
            display: flex;
            align-items: center;
            gap: 10px;
            margin-bottom: 18px;
        }

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
            .tst-section {
                padding: 45px 0;
            }

            .tst-cta {
                padding: 40px 25px;
            }

            .tst-featured {
                padding: 35px 25px;
            }

            .tst-featured blockquote {
                font-size: 1.1rem;
            }

            .tst-stat strong {
                font-size: 1.7rem;
            }
        }
    </style>

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <?php if (isset($component)) { $__componentOriginal2a2e454b2e62574a80c8110e5f128b60 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60 = $attributes; } ?>
<?php $component = App\View\Components\Header::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
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

            <div class="page-body" style="padding-bottom: 40px;">

                
                
                
                <div class="container-fluid mt-5">
                    <div class="card tst-hero shadow mb-4" data-aos="fade-in">
                        <div class="card-body p-4 p-lg-5 position-relative">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <nav aria-label="breadcrumb" class="mb-3">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item">
                                                <a href="<?php echo e(route('index_main')); ?>"
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
                                            <i class="fa fa-star text-warning"></i>
                                            <?php echo e($stats['total']); ?> testimonios
                                        </span>
                                        
                                        <span class="tst-hero-tag">
                                            <i class="fa fa-globe text-warning"></i> +10 países de LATAM
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                
                
                <section class="tst-section pt-0">
                    <div class="container">
                        <div class="tst-stats-band shadow" data-aos="fade-up">
                            <div class="row  g-4 position-relative">
                                <div class="col-4 tst-stat">
                                    <i class="fa fa-thumbs-up"></i>
                                    <strong><?php echo e($stats['recommend']); ?>%</strong>
                                    <span>Nos recomiendan</span>
                                </div>
                                <div class="col-4 tst-stat">
                                    <i class="fa fa-comments"></i>
                                    <strong><?php echo e(number_format($stats['total'])); ?></strong>
                                    <span>Testimonios publicados</span>
                                </div>
                                <div class="col-4 tst-stat">
                                    <i class="fa fa-star"></i>
                                    <strong><?php echo e($stats['average'] ?: '—'); ?>/5</strong>
                                    <span>Puntuación promedio</span>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="tst-cta text-center" data-aos="fade-up">
                                    <div class="d-flex flex-wrap justify-content-center gap-3">
                                        <a href="<?php echo e(route('web_courses')); ?>" class="btn-cta-white text-decoration-none">
                                            <i class="fa fa-graduation-cap me-2"></i>Ver programas
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                
                
                
                <?php if($featured): ?>
                    <section class="tst-section pt-0">
                        <div class="container">
                            <div class="tst-featured shadow" data-aos="zoom-in">
                                <div class="row align-items-center position-relative">
                                    <div class="col-lg-9">
                                        <?php if($featured['program']): ?>
                                            <p class="tst-featured-program">
                                                <?php echo e(\Illuminate\Support\Str::limit($featured['program'], 90)); ?>

                                            </p>
                                        <?php endif; ?>
                                        <div class="tst-featured-stars mb-3">
                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                <i class="fa fa-star<?php echo e($i <= $featured['rating'] ? '' : '-o'); ?>"></i>
                                            <?php endfor; ?>
                                        </div>
                                        <blockquote>
                                            "<?php echo e($featured['quote']); ?>"
                                        </blockquote>
                                        <div class="d-flex align-items-center gap-3">
                                            <img src="<?php echo e($featured['photo'] ?: $featured['avatar']); ?>"
                                                alt="<?php echo e($featured['author']); ?>" class="tst-featured-avatar">
                                            <div>
                                                <p class="tst-featured-name mb-0"><?php echo e($featured['author']); ?></p>
                                                <p class="tst-featured-role mb-0"><?php echo e($featured['role']); ?></p>
                                            </div>
                                        </div>
                                        <?php if($featured['video']): ?>
                                            <?php
                                                $featuredTarget = $testimonies->pluck('id')->contains($featured['id'])
                                                    ? 'tstVideo' . $featured['id']
                                                    : 'tstVideoFeatured';
                                            ?>
                                            <div class="tst-featured-video">
                                                <button type="button" class="btn" data-bs-toggle="modal"
                                                    data-bs-target="#<?php echo e($featuredTarget); ?>">
                                                    <i class="fa fa-play-circle me-2"></i>Ver video testimonio
                                                </button>
                                            </div>
                                        <?php endif; ?>
                                    </div>
                                    <div class="col-lg-3 text-center d-none d-lg-block">
                                        <i class="fa fa-quote-right" style="font-size: 7rem; opacity: 0.15;"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                
                
                
                <section class="tst-section tst-section-alt">
                    <div class="container">
                        <div class="text-center mb-4" data-aos="fade-up">
                            <h2 class="fw-bold text-navy-custom">Lo que dicen nuestros egresados</h2>
                            <p class="text-muted-custom mx-auto" style="max-width: 700px;">
                                <?php if($total > 0): ?>
                                    <?php echo e(number_format($total)); ?>

                                    <?php echo e(\Illuminate\Support\Str::plural('testimonio', $total)); ?> de profesionales que
                                    confiaron en CPA Academy para dar el siguiente paso.
                                <?php else: ?>
                                    Muy pronto verás aquí las opiniones de nuestros egresados.
                                <?php endif; ?>
                            </p>
                        </div>

                        <?php if($categoryOptions->count() > 0): ?>
                            <div class="d-flex flex-wrap justify-content-center gap-2 mb-3" data-aos="fade-up">
                                <a href="<?php echo e(route('web_testimonials')); ?>"
                                    class="tst-filter-chip <?php echo e(!$filters['categoria'] && !$filters['curso'] ? 'is-active' : ''); ?>">
                                    Todas las categorías
                                </a>
                                <?php $__currentLoopData = $categoryOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <a href="<?php echo e(route('web_testimonials', ['categoria' => $option->category])); ?>"
                                        class="tst-filter-chip <?php echo e($filters['categoria'] === $option->category ? 'is-active' : ''); ?>">
                                        <?php echo e($option->category); ?> (<?php echo e($option->total); ?>)
                                    </a>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <?php if($courseOptions->count() > 0): ?>
                                <form method="GET" action="<?php echo e(route('web_testimonials')); ?>"
                                    class="d-flex justify-content-center mb-4" data-aos="fade-up">
                                    <?php if($filters['categoria']): ?>
                                        <input type="hidden" name="categoria" value="<?php echo e($filters['categoria']); ?>">
                                    <?php endif; ?>
                                    <select name="curso" class="form-select w-auto" onchange="this.form.submit()">
                                        <option value="">Todos los cursos</option>
                                        <?php $__currentLoopData = $courseOptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $option): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php if($option->slug): ?>
                                                <option value="<?php echo e($option->slug); ?>"
                                                    <?php echo e($filters['curso'] === $option->slug ? 'selected' : ''); ?>>
                                                    <?php echo e($option->description); ?> (<?php echo e($option->total); ?>)
                                                </option>
                                            <?php endif; ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </select>
                                </form>
                            <?php endif; ?>
                        <?php endif; ?>

                        <?php if($testimonies->count() === 0): ?>
                            <div class="text-center py-5 bg-card-custom rounded-4" data-aos="fade-up">
                                <i class="fa fa-comments-o" style="font-size: 3rem; color: #cbd5e1;"></i>
                                <h3 class="h5 fw-bold text-navy-custom mt-3">Todavía no hay testimonios publicados</h3>
                                <p class="text-muted-custom mb-0">
                                    Los testimonios de nuestros alumnos pasan por revisión antes de publicarse.
                                </p>
                            </div>
                        <?php else: ?>
                            <?php $__currentLoopData = $groups; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $group): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="mb-5" data-aos="fade-up">
                                    <h3 class="tst-group-title text-navy-custom">
                                        <i class="fa fa-folder-open text-warning"></i>
                                        <?php echo e($group['category']); ?>

                                        <span class="badge bg-secondary"><?php echo e($group['testimonies']->count()); ?></span>
                                    </h3>
                                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                                        <?php $__currentLoopData = $group['testimonies']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $quote = (string) $t['quote'];
                                                $quoteLimit = 220;
                                                $isLongQuote = mb_strlen($quote) > $quoteLimit;
                                                $quoteShort = $isLongQuote
                                                    ? \Illuminate\Support\Str::substr($quote, 0, $quoteLimit)
                                                    : $quote;
                                                $quoteRest = $isLongQuote
                                                    ? \Illuminate\Support\Str::substr($quote, $quoteLimit)
                                                    : '';
                                            ?>
                                            <div class="col">
                                                <div class="tst-card bg-card-custom shadow-sm">
                                                    <?php if($t['program']): ?>
                                                        <h3 class="tst-card-title">
                                                            <?php echo e(\Illuminate\Support\Str::limit($t['program'], 90)); ?>

                                                        </h3>
                                                    <?php endif; ?>
                                                    <?php if($t['cover'] || $t['video']): ?>
                                                        <div class="tst-card-media">
                                                            <?php if($t['cover']): ?>
                                                                <img src="<?php echo e($t['cover']); ?>"
                                                                    alt="<?php echo e(\Illuminate\Support\Str::limit($t['program'], 50)); ?>"
                                                                    loading="lazy">
                                                            <?php endif; ?>
                                                            <?php if($t['video']): ?>
                                                                <span class="tst-video-tag">
                                                                    <i class="fa fa-video-camera"></i> Video
                                                                </span>
                                                                <button type="button" class="tst-play"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#tstVideo<?php echo e($t['id']); ?>"
                                                                    title="Ver video testimonio">
                                                                    <i class="fa fa-play"></i>
                                                                </button>
                                                            <?php endif; ?>
                                                        </div>
                                                    <?php endif; ?>
                                                    <div>
                                                        <div class="tst-stars">
                                                            <?php for($i = 1; $i <= 5; $i++): ?>
                                                                <i
                                                                    class="fa fa-star<?php echo e($i <= $t['rating'] ? '' : '-o'); ?>"></i>
                                                            <?php endfor; ?>
                                                        </div>
                                                        <div class="tst-quote-mark">"</div>
                                                        <p class="tst-text">
                                                            <?php echo e($quoteShort); ?><?php if($isLongQuote): ?>
                                                                <details class="tst-quote-details"
                                                                    id="tstQuote<?php echo e($t['id']); ?>" open>
                                                                    <summary class="tst-quote-summary">
                                                                        <span class="tst-text"><?php echo e($quoteRest); ?></span>
                                                                        <span class="tst-read-more tst-read-more-summary">
                                                                            <i class="fa fa-chevron-down"></i> Leer más
                                                                        </span>
                                                                    </summary>
                                                                </details>
                                                            <?php endif; ?>
                                                        </p>
                                                    </div>
                                                    <div class="tst-author">
                                                        <img src="<?php echo e($t['photo'] ?: $t['avatar']); ?>"
                                                            alt="<?php echo e($t['author']); ?>" class="tst-avatar" loading="lazy">
                                                        <div>
                                                            <p class="tst-name text-navy-custom mb-0"><?php echo e($t['author']); ?>

                                                            </p>
                                                            <p class="tst-role text-muted-custom mb-0"><?php echo e($t['role']); ?>

                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            <?php if($hasMore): ?>
                                <div class="text-center mt-4" data-aos="fade-up">
                                    <a href="<?php echo e(route(
                                        'web_testimonials',
                                        array_filter([
                                            'categoria' => $filters['categoria'],
                                            'curso' => $filters['curso'],
                                            'rating' => $filters['rating'],
                                            'page' => $page + 1,
                                        ]),
                                    )); ?>"
                                        class="tst-filter-chip is-active" style="padding: 12px 28px;">
                                        <i class="fa fa-chevron-down"></i> Ver más testimonios
                                    </a>
                                    <p class="text-muted-custom mt-2 mb-0" style="font-size: 0.85rem;">
                                        Mostrando <?php echo e($testimonies->count()); ?> de <?php echo e($total); ?> testimonios.
                                    </p>
                                </div>
                            <?php endif; ?>
                        <?php endif; ?>
                    </div>
                </section>

                
                
                
                <?php
                    $videoModals = collect();

                    foreach ($testimonies as $t) {
                        if (!empty($t['video'])) {
                            $videoModals->push(['modal_id' => 'tstVideo' . $t['id'], 'data' => $t]);
                        }
                    }

                    if (
                        $featured &&
                        !empty($featured['video']) &&
                        !$testimonies->pluck('id')->contains($featured['id'])
                    ) {
                        $videoModals->push(['modal_id' => 'tstVideoFeatured', 'data' => $featured]);
                    }
                ?>

                <?php $__currentLoopData = $videoModals; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $videoModal): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <div class="modal fade" id="<?php echo e($videoModal['modal_id']); ?>" tabindex="-1"
                        aria-labelledby="<?php echo e($videoModal['modal_id']); ?>Label" aria-hidden="true">
                        <div class="modal-dialog modal-lg modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title h6" id="<?php echo e($videoModal['modal_id']); ?>Label">
                                        <?php echo e($videoModal['data']['author']); ?> ·
                                        <?php echo e(\Illuminate\Support\Str::limit($videoModal['data']['program'], 70)); ?>

                                    </h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Cerrar"></button>
                                </div>
                                <div class="modal-body p-0 bg-black">
                                    <div class="ratio ratio-16x9">
                                        <?php echo $videoModal['data']['video']; ?>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                
                
                
                <?php if($testimonies->count() > 0): ?>
                    <section class="tst-section">
                        <div class="container-fluid">
                            <div class="text-center mb-4" data-aos="fade-up">
                                <h2 class="fw-bold text-navy-custom">Palabras que nos impulsan</h2>
                            </div>
                            <div class="tst-marquee-viewport" data-aos="fade-up">
                                <div class="tst-marquee-track">
                                    <?php
                                        $miniTestimonials = $testimonies->take(6);
                                        $loopSet = $miniTestimonials->concat($miniTestimonials);
                                    ?>

                                    <?php $__currentLoopData = $loopSet; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="tst-mini-card bg-card-custom shadow-sm">
                                            <?php if($t['program']): ?>
                                                <p class="tst-mini-title">
                                                    <?php echo e(\Illuminate\Support\Str::limit($t['program'], 45)); ?>

                                                </p>
                                            <?php endif; ?>
                                            <p class="tst-mini-quote text-muted-custom">
                                                "<?php echo e(\Illuminate\Support\Str::limit($t['quote'], 150)); ?>"
                                            </p>
                                            <div class="tst-mini-author">
                                                <img src="<?php echo e($t['photo'] ?: $t['avatar']); ?>" alt="<?php echo e($t['author']); ?>"
                                                    class="tst-mini-avatar" loading="lazy">
                                                <div>
                                                    <p class="tst-mini-name text-navy-custom mb-0"><?php echo e($t['author']); ?></p>
                                                    <p class="tst-mini-role text-muted-custom mb-0">
                                                        <?php echo e(\Illuminate\Support\Str::limit($t['program'], 40)); ?>

                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        </div>
                    </section>
                <?php endif; ?>

                
                
                
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
                                <a href="<?php echo e(route('web_courses')); ?>" class="btn-cta-white text-decoration-none">
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
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascripts'); ?>
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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.webpage', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\globalcpa\resources\views/pages/testimonios.blade.php ENDPATH**/ ?>