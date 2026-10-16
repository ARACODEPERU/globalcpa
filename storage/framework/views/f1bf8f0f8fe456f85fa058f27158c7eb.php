<?php $__env->startSection('title', ' - Nosotros'); ?>

<?php $__env->startSection('etiquetasmeta'); ?>
    <?php if (isset($component)) { $__componentOriginal42da61123f891e63201d7be28f403427 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42da61123f891e63201d7be28f403427 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo','data' => ['title' => 'Nosotros - CPA Academy','description' => 'Conoce CPA Academy: escuela de negocios con respaldo ACCA, formando contadores y financieros líderes en más de 10 países de LATAM.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Nosotros - CPA Academy','description' => 'Conoce CPA Academy: escuela de negocios con respaldo ACCA, formando contadores y financieros líderes en más de 10 países de LATAM.']); ?>
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
        /* =========================================
           PÁGINA NOSOTROS
           ========================================= */

        /* Texto navy institucional (compatible modo oscuro) */
        .text-navy-custom { color: #002060 !important; }
        :is(.dark, .dark-only) .text-navy-custom { color: #f6f7fb !important; }

        .text-muted-custom { color: #6b7280; }
        :is(.dark, .dark-only) .text-muted-custom { color: #9ca3af !important; }

        /* Fondo de tarjetas claras (compatible modo oscuro) */
        .bg-card-custom {
            background-color: #ffffff !important;
            border: 1px solid #eef2f7;
        }
        :is(.dark, .dark-only) .bg-card-custom {
            background-color: #1d273a !important;
            border-color: #374558 !important;
        }

        /* Secciones alternadas */
        .nos-section { padding: 70px 0; }
        .nos-section-alt {
            background-color: #f8f9fa;
        }
        :is(.dark, .dark-only) .nos-section-alt {
            background-color: #111827;
        }

        /* --- Hero --- */
        .nos-hero {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 20px;
            border: 0;
            overflow: hidden;
            position: relative;
        }
        .nos-hero::after {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.25) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .nos-hero-tag {
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

        /* --- Quiénes somos: tarjeta flotante de datos --- */
        .nos-image-frame {
            position: relative;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 20px 50px rgba(0, 32, 96, 0.25);
        }
        .nos-image-frame img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
        .nos-stats-float {
            position: absolute;
            left: 20px;
            bottom: 20px;
            right: 20px;
            display: flex;
            gap: 15px;
        }
        .nos-stats-float .float-stat {
            flex: 1;
            background: rgba(255, 255, 255, 0.95);
            border-radius: 14px;
            padding: 14px 10px;
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
        }
        .nos-stats-float .float-stat strong {
            display: block;
            font-size: 1.4rem;
            font-weight: 800;
            color: #e30613;
            line-height: 1.2;
        }
        .nos-stats-float .float-stat span {
            font-size: 0.78rem;
            color: #4b5563;
            font-weight: 600;
        }
        :is(.dark, .dark-only) .nos-stats-float .float-stat {
            background: rgba(17, 24, 39, 0.92);
        }
        :is(.dark, .dark-only) .nos-stats-float .float-stat span {
            color: #d1d5db;
        }

        /* --- Misión / Visión / Valores --- */
        .nos-value-card {
            height: 100%;
            padding: 35px 28px;
            border-radius: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .nos-value-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(0, 32, 96, 0.12);
        }
        .nos-value-card .value-icon {
            width: 74px;
            height: 74px;
            border-radius: 50%;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #ffffff;
            margin-bottom: 20px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.18);
        }
        .nos-value-card h3 {
            font-size: 1.3rem;
            font-weight: 700;
            margin-bottom: 12px;
        }
        .nos-value-card p {
            font-size: 0.95rem;
            line-height: 1.65;
            margin-bottom: 0;
        }

        /* --- CPA en números --- */
        .nos-counter {
            text-align: center;
            padding: 25px 10px;
            border-radius: 18px;
            height: 100%;
        }
        .nos-counter i {
            font-size: 30px;
            margin-bottom: 12px;
            display: block;
        }
        .nos-counter strong {
            display: block;
            font-size: 2.2rem;
            font-weight: 800;
            line-height: 1.1;
        }
        .nos-counter span {
            font-size: 0.9rem;
            font-weight: 600;
        }
        .nos-counter.red { color: #e30613; }
        .nos-counter.navy { color: #002060; }
        :is(.dark, .dark-only) .nos-counter.navy { color: #f6f7fb; }

        /* --- Banda ACCA --- */
        .nos-acca {
            display: flex;
            align-items: center;
            gap: 25px;
            padding: 35px;
            border-radius: 20px;
        }
        .nos-acca img {
            width: 150px;
            flex-shrink: 0;
        }

        /* --- CTA final --- */
        .nos-cta {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 24px;
            padding: 55px 40px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }
        .nos-cta::before {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.2) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .nos-cta .btn-cta-white {
            background: #ffffff;
            color: #002060;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }
        .nos-cta .btn-cta-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            color: #e30613;
        }
        .nos-cta .btn-cta-wa {
            background: #25d366;
            color: #ffffff;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }
        .nos-cta .btn-cta-wa:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.35);
            background: #1fb959;
            color: #ffffff;
        }

        @media (max-width: 767.98px) {
            .nos-section { padding: 45px 0; }
            .nos-acca { flex-direction: column; text-align: center; }
            .nos-cta { padding: 40px 25px; }
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
                    <div class="card nos-hero shadow mb-4" data-aos="fade-in">
                        <div class="card-body p-4 p-lg-5 position-relative">
                            <div class="row align-items-center">
                                <div class="col-lg-7">
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
                                                Nosotros
                                            </li>
                                        </ol>
                                    </nav>

                                    <h1 class="display-4 fw-bold text-white mb-3">
                                        Somos <span class="text-warning">CPA Academy</span>
                                    </h1>
                                    <p class="lead text-white-50 mb-4" style="max-width: 600px; line-height: 1.6;">
                                        Aceleramos tu carrera profesional. Especialízate en contabilidad, finanzas y auditoría con 
                                        estándares globales y metodologías 100% prácticas que puedes aplicar desde 
                                        tu primer día.
                                    </p>

                                    <div class="d-flex flex-wrap gap-3">
                                        <span class="nos-hero-tag">
                                            <i class="fa fa-certificate text-warning"></i> Respaldo ACCA
                                        </span>
                                        <span class="nos-hero-tag">
                                            <i class="fa fa-globe text-warning"></i> Alumnos en +10 países de LATAM
                                        </span>
                                        <span class="nos-hero-tag">
                                            <i class="fa fa-users text-warning"></i> Docentes expertos
                                        </span>
                                    </div>
                                </div>

                                <div class="col-lg-5 d-none d-lg-block text-center">
                                    <img src="<?php echo e(asset('themes/webpage/images/Logo_cpa_blanco.png')); ?>"
                                        alt="CPA Academy" class="img-fluid" style="max-width: 320px; opacity: 0.95;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                
                
                <section class="nos-section">
                    <div class="container">
                        <div class="row align-items-center g-5">
                            <div class="col-lg-6" data-aos="fade-right">
                                <h2 class="fw-bold text-navy-custom mb-4">
                                    Formamos al talento que transforma empresas
                                </h2>
                                <p class="text-muted-custom" style="line-height: 1.8; font-size: 1.02rem;">
                                    Impulsamos tu carrera con conocimiento 100% aplicable. Aprenderás de líderes 
                                    activos en las Big Four y la banca mediante metodologías diseñadas para resolver 
                                    retos del mundo real.
                                </p>
                                <p class="text-muted-custom" style="line-height: 1.8; font-size: 1.02rem;">
                                    Estudia con la garantía de ser la <b> única escuela peruana reconocida como Approved Learning Partner 
                                    por la ACCA, </b>y únete a una red de profesionales en más de 10 países. Prepárate para 
                                    liderar las áreas financieras de las corporaciones más exigentes.
                                </p>
                            </div>
                            <div class="col-lg-6" data-aos="fade-left">
                                <div class="nos-image-frame" style="min-height: 380px;">
                                    <img src="<?php echo e(asset('themes/webpage/images/alumnos.jpeg')); ?>"
                                        alt="Equipo de profesionales de CPA Academy">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                
                
                
                

                
                
                
                <section class="nos-section">
                    <div class="container">
                        <div class="text-center mb-5" data-aos="fade-up">
                            <h2 class="fw-bold text-navy-custom">CPA en números</h2>
                        </div>
                        <div class="row row-cols-2 row-cols-lg-4 g-4">
                            <div class="col" data-aos="zoom-in" data-aos-delay="100">
                                <div class="nos-counter bg-card-custom shadow-sm red">
                                    <i class="fa fa-graduation-cap"></i>
                                    <strong>+1,000</strong>
                                    <span class="text-muted-custom">Alumnos formados</span>
                                </div>
                            </div>
                            <div class="col" data-aos="zoom-in" data-aos-delay="200">
                                <div class="nos-counter bg-card-custom shadow-sm navy">
                                    <i class="fa fa-globe-americas"></i>
                                    <strong>+10</strong>
                                    <span class="text-muted-custom">Países en LATAM</span>
                                </div>
                            </div>
                            <div class="col" data-aos="zoom-in" data-aos-delay="300">
                                <div class="nos-counter bg-card-custom shadow-sm red">
                                    <i class="fa fa-chalkboard-teacher"></i>
                                    <strong>+40</strong>
                                    <span class="text-muted-custom">Docentes referentes</span>
                                </div>
                            </div>
                            <div class="col" data-aos="zoom-in" data-aos-delay="400">
                                <div class="nos-counter bg-card-custom shadow-sm navy">
                                    <i class="fa fa-book-open"></i>
                                    <strong>+50</strong>
                                    <span class="text-muted-custom">Programas académicos</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                
                
                
                <section class="nos-section nos-section-alt">
                    <div class="container-fluid" data-aos="fade-up">
                        <?php if (isset($component)) { $__componentOriginalf7e1758e067711df8344c65ed72dc5e3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf7e1758e067711df8344c65ed72dc5e3 = $attributes; } ?>
<?php $component = App\View\Components\Visionaries::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('visionaries'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Visionaries::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf7e1758e067711df8344c65ed72dc5e3)): ?>
<?php $attributes = $__attributesOriginalf7e1758e067711df8344c65ed72dc5e3; ?>
<?php unset($__attributesOriginalf7e1758e067711df8344c65ed72dc5e3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf7e1758e067711df8344c65ed72dc5e3)): ?>
<?php $component = $__componentOriginalf7e1758e067711df8344c65ed72dc5e3; ?>
<?php unset($__componentOriginalf7e1758e067711df8344c65ed72dc5e3); ?>
<?php endif; ?>
                    </div>
                </section>

                
                
                
                <section class="nos-section">
                    <div class="container">
                        <div class="nos-acca bg-card-custom shadow-sm mb-5" data-aos="fade-up">
                            <img style="width: 280px;" src="<?php echo e(asset('themes/webpage/images/acca.png')); ?>" alt="ACCA Approved Learning Partner">
                            <div>
                                <h3 class="fw-bold text-navy-custom mb-2">
                                    
                                    Respaldo ACCA
                                </h3>
                                <p class="text-muted-custom mb-0" style="line-height: 1.7;">
                                    Somos la única escuela de negocios peruana reconocida oficialmente por la
                                    <strong>Association of Chartered Certified Accountants (ACCA)</strong> como
                                    <em>Approved Learning Partner</em>, el respaldo internacional más importante
                                    para la formación contable y financiera.
                                </p>
                            </div>
                        </div>

                        <?php if (isset($component)) { $__componentOriginal9a18448ac5531d2b3c97d0119a14634b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9a18448ac5531d2b3c97d0119a14634b = $attributes; } ?>
<?php $component = App\View\Components\ClientsLogo::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('clients-logo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\ClientsLogo::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9a18448ac5531d2b3c97d0119a14634b)): ?>
<?php $attributes = $__attributesOriginal9a18448ac5531d2b3c97d0119a14634b; ?>
<?php unset($__attributesOriginal9a18448ac5531d2b3c97d0119a14634b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9a18448ac5531d2b3c97d0119a14634b)): ?>
<?php $component = $__componentOriginal9a18448ac5531d2b3c97d0119a14634b; ?>
<?php unset($__componentOriginal9a18448ac5531d2b3c97d0119a14634b); ?>
<?php endif; ?>
                    </div>
                </section>

                
                
                
                <section class="nos-section pt-0">
                    <div class="container">
                        <div class="nos-cta text-center" data-aos="fade-up">
                            <h2 class="fw-bold text-white mb-3" style="font-size: 2.2rem;">
                                Impulsa tu carrera con <span class="text-warning">CPA Academy</span>
                            </h2>
                            <p class="text-white-50 mx-auto mb-4" style="max-width: 640px;">
                                Únete a la comunidad de profesionales que están transformando su futuro con
                                programas de especialización de estándares internacionales.
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

<?php echo $__env->make('layouts.webpage', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\globalcpa\resources\views/pages/nosotros.blade.php ENDPATH**/ ?>