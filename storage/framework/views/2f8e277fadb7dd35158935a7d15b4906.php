<?php $__env->startSection('title', ' - ¿Por qué CPA Academy?'); ?>

<?php $__env->startSection('etiquetasmeta'); ?>
    <?php if (isset($component)) { $__componentOriginal42da61123f891e63201d7be28f403427 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42da61123f891e63201d7be28f403427 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo','data' => ['title' => '¿Por qué CPA Academy?','description' => 'Descubre por qué elegir CPA Academy: respaldo ACCA, docentes de Big Four, metodología práctica y alumnos en más de 10 países de LATAM.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => '¿Por qué CPA Academy?','description' => 'Descubre por qué elegir CPA Academy: respaldo ACCA, docentes de Big Four, metodología práctica y alumnos en más de 10 países de LATAM.']); ?>
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
           PÁGINA ¿POR QUÉ CPA ACADEMY?
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

        .why-section { padding: 70px 0; }
        .why-section-alt { background-color: #f8f9fa; }
        :is(.dark, .dark-only) .why-section-alt { background-color: #111827; }

        /* --- Hero --- */
        .why-hero {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 20px;
            border: 0;
            overflow: hidden;
            position: relative;
        }
        .why-hero::after {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.25) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .why-hero-tag {
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
        .why-hero .btn-cta-white {
            background: #ffffff;
            color: #002060;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
            display: inline-block;
        }
        .why-hero .btn-cta-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            color: #e30613;
        }

        /* --- Diferenciales --- */
        .why-feature-card {
            height: 100%;
            padding: 30px 25px;
            border-radius: 20px;
            text-align: center;
            position: relative;
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        .why-feature-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(0, 32, 96, 0.12);
        }
        .why-feature-card .feature-icon {
            width: 70px;
            height: 70px;
            border-radius: 18px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-size: 28px;
            color: #ffffff;
            margin-bottom: 18px;
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.18);
        }
        .why-feature-card h3 {
            font-size: 1.15rem;
            font-weight: 700;
            margin-bottom: 10px;
        }
        .why-feature-card p {
            font-size: 0.92rem;
            line-height: 1.65;
            margin-bottom: 0;
        }

        /* --- Franja de números --- */
        .why-stats-band {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 24px;
            padding: 45px 30px;
            position: relative;
            overflow: hidden;
        }
        .why-stats-band::before {
            content: '';
            position: absolute;
            bottom: -100px;
            right: -100px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.2) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .why-stat { text-align: center; color: #ffffff; }
        .why-stat i { font-size: 28px; color: #ffc107; margin-bottom: 10px; display: block; }
        .why-stat strong { display: block; font-size: 2.2rem; font-weight: 800; line-height: 1.1; }
        .why-stat span { font-size: 0.9rem; color: rgba(255, 255, 255, 0.75); font-weight: 600; }

        /* --- Comparativa --- */
        .why-compare-card {
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 15px 40px rgba(0, 32, 96, 0.12);
        }
        .why-compare-col {
            padding: 40px 35px;
            height: 100%;
        }
        .why-compare-us {
            background: linear-gradient(180deg, #002060 0%, #00306e 100%);
            color: #ffffff;
            position: relative;
        }
        .why-compare-us::after {
            content: 'RECOMENDADO';
            position: absolute;
            top: 45px;
            right: -44px;
            transform: rotate(50deg);
            background: #e30613;
            color: #fff;
            font-size: 0.7rem;
            font-weight: 800;
            letter-spacing: 1px;
            padding: 5px 40px;
        }
        .why-compare-them {
            background-color: #ffffff;
            border: 1px solid #eef2f7;
        }
        :is(.dark, .dark-only) .why-compare-them {
            background-color: #1d273a;
            border-color: #374558;
        }
        .why-compare-title { font-size: 1.25rem; font-weight: 800; margin-bottom: 5px; }
        .why-compare-sub { font-size: 0.85rem; opacity: 0.75; margin-bottom: 25px; }
        .why-compare-item {
            display: flex;
            align-items: flex-start;
            gap: 12px;
            padding: 11px 0;
            border-bottom: 1px dashed rgba(128, 128, 128, 0.25);
            font-size: 0.95rem;
            line-height: 1.5;
        }
        .why-compare-item:last-child { border-bottom: none; }
        .why-compare-item i { margin-top: 3px; }
        .why-compare-us .why-compare-item i { color: #4ade80; }
        .why-compare-them .why-compare-item i { color: #e30613; }
        .why-compare-them .why-compare-item { color: #4b5563; }
        :is(.dark, .dark-only) .why-compare-them .why-compare-item { color: #9ca3af; }

        /* --- Metodología --- */
        .why-step {
            text-align: center;
            position: relative;
            padding: 0 10px;
        }
        .why-step .step-number {
            width: 64px;
            height: 64px;
            border-radius: 50%;
            background: linear-gradient(135deg, #e30613 0%, #a0040d 100%);
            color: #ffffff;
            font-size: 1.5rem;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 18px;
            box-shadow: 0 8px 20px rgba(227, 6, 19, 0.35);
            position: relative;
            z-index: 2;
        }
        .why-step h4 { font-weight: 700; font-size: 1.05rem; margin-bottom: 8px; }
        .why-step p { font-size: 0.9rem; line-height: 1.6; margin-bottom: 0; }
        @media (min-width: 768px) {
            .why-steps-row { position: relative; }
            .why-steps-row::before {
                content: '';
                position: absolute;
                top: 32px;
                left: 12%;
                right: 12%;
                height: 2px;
                background: repeating-linear-gradient(90deg, #e30613 0 10px, transparent 10px 20px);
                opacity: 0.4;
                z-index: 1;
            }
        }

        /* --- CTA final --- */
        .why-cta {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 24px;
            padding: 55px 40px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
        }
        .why-cta::before {
            content: '';
            position: absolute;
            bottom: -100px;
            left: -100px;
            width: 350px;
            height: 350px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.2) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .why-cta .btn-cta-white {
            background: #ffffff;
            color: #002060;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }
        .why-cta .btn-cta-white:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.25);
            color: #e30613;
        }
        .why-cta .btn-cta-wa {
            background: #25d366;
            color: #ffffff;
            font-weight: 700;
            padding: 12px 30px;
            border-radius: 50px;
            border: none;
            transition: all 0.3s ease;
        }
        .why-cta .btn-cta-wa:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(37, 211, 102, 0.35);
            background: #1fb959;
            color: #ffffff;
        }

        @media (max-width: 767.98px) {
            .why-section { padding: 45px 0; }
            .why-cta { padding: 40px 25px; }
            .why-compare-col { padding: 30px 25px; }
            .why-stat strong { font-size: 1.7rem; }
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
                    <div class="card why-hero shadow mb-4" data-aos="fade-in">
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
                                                ¿Por qué CPA Academy?
                                            </li>
                                        </ol>
                                    </nav>

                                    <h1 class="display-4 fw-bold text-white mb-3">
                                        ¿Por qué elegir <span class="text-warning">CPA Academy</span>?
                                    </h1>
                                    <p class="lead text-white-50 mb-4" style="max-width: 620px; line-height: 1.6;">
                                        Porque un certificado tradicional ya no basta. Con nosotros obtienes la visión de líderes 
                                        del sector, el prestigio internacional de la ACCA y una red en +10 países. Deja de competir y 
                                        comienza a liderar.
                                    </p>

                                    

                                    <a href="<?php echo e(route('web_courses')); ?>" class="btn-cta-white text-decoration-none">
                                        <i class="fa fa-graduation-cap me-2"></i>Explorar programas
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                
                
                <section class="why-section">
                    <div class="container">
                        <div class="text-center mb-5" data-aos="fade-up">
                            <h2 class="fw-bold text-navy-custom">Lo que nos hace diferentes</h2>
                            <p class="text-muted-custom mx-auto" style="max-width: 700px;">
                                Seis razones por las que profesionales y empresas eligen CPA Academy
                                para su formación contable y financiera.
                            </p>
                        </div>
                        <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                            <div class="col" data-aos="fade-up" data-aos-delay="100">
                                <div class="why-feature-card bg-card-custom shadow-sm">
                                    <div class="feature-icon" style="background: linear-gradient(135deg, #e30613 0%, #a0040d 100%);">
                                        <i class="fa fa-certificate"></i>
                                    </div>
                                    <h3 class="text-navy-custom">Respaldo Global ACCA</h3>
                                    <p class="text-muted-custom">
                                        Única escuela de negocios en Perú con el reconocimiento oficial Approved Learning Partner. 
                                        Tu certificado con peso internacional.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="200">
                                <div class="why-feature-card bg-card-custom shadow-sm">
                                    <div class="feature-icon" style="background: linear-gradient(135deg, #002060 0%, #004080 100%);">
                                        <i class="fa fa-briefcase"></i>
                                    </div>
                                    <h3 class="text-navy-custom">Líderes de Big Four y Banca</h3>
                                    <p class="text-muted-custom">
                                        Aprende las estrategias que usan hoy los socios y gerentes activos de KPMG, 
                                        Deloitte y las corporaciones top.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="300">
                                <div class="why-feature-card bg-card-custom shadow-sm">
                                    <div class="feature-icon" style="background: linear-gradient(135deg, #002060 0%, #004080 100%);">
                                        <i class="fa fa-line-chart"></i>
                                    </div>
                                    <h3 class="text-navy-custom">100% Práctico y Aplicable</h3>
                                    <p class="text-muted-custom">
                                        Olvida el relleno teórico. Resuelve casos reales y domina herramientas que generarán impacto en tu trabajo desde la clase uno.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="100">
                                <div class="why-feature-card bg-card-custom shadow-sm">
                                    <div class="feature-icon" style="background: linear-gradient(135deg, #002060 0%, #004080 100%);">
                                        <i class="fa fa-clock"></i>
                                    </div>
                                    <h3 class="text-navy-custom">Diseñado para Ejecutivos</h3>
                                    <p class="text-muted-custom">
                                        Clases online en vivo adaptadas a la exigencia de tu profesión. 
                                        Acelera tu carrera sin que tus cierres contables te detengan.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="200">
                                <div class="why-feature-card bg-card-custom shadow-sm">
                                    <div class="feature-icon" style="background: linear-gradient(135deg, #002060 0%, #004080 100%);">
                                        <i class="fa fa-users"></i>
                                    </div>
                                    <h3 class="text-navy-custom">Comunidad LATAM</h3>
                                    <p class="text-muted-custom">
                                        Conecta con profesionales y líderes financieros de toda Latinoamérica para expandir tus oportunidades.
                                    </p>
                                </div>
                            </div>
                            <div class="col" data-aos="fade-up" data-aos-delay="300">
                                <div class="why-feature-card bg-card-custom shadow-sm">
                                    <div class="feature-icon" style="background: linear-gradient(135deg, #002060 0%, #004080 100%);">
                                        <i class="fa fa-book"></i>
                                    </div>
                                    <h3 class="text-navy-custom">Vanguardia Normativa y Tech</h3>
                                    <p class="text-muted-custom">
                                        Domina las últimas actualizaciones en NIIF, auditoría e Inteligencia Artificial financiera antes que el resto del mercado.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>


                
                
                
                <section class="why-section why-section-alt">
                    <div class="container">
                        <div class="text-center mb-5" data-aos="fade-up">
                            <h2 class="fw-bold text-navy-custom">La diferencia se nota</h2>
                            <p class="text-muted-custom mx-auto" style="max-width: 700px;">
                                Compara lo que obtienes con CPA Academy frente a la formación tradicional.
                            </p>
                        </div>
                        <div class="row g-4 justify-content-center" data-aos="fade-up" data-aos-delay="150">
                            <div class="col-lg-5">
                                <div class="why-compare-card h-100">
                                    <div class="why-compare-col why-compare-us h-100">
                                        <h3 class="why-compare-title text-white">CPA Academy</h3>
                                        <p class="why-compare-sub text-white-50">Formación con estándares internacionales</p>
                                        <div class="why-compare-item">
                                            <i class="fa fa-check-circle"></i>
                                            <span>Docentes socios y gerentes de Big Four y banca en activo</span>
                                        </div>
                                        <div class="why-compare-item">
                                            <i class="fa fa-check-circle"></i>
                                            <span>Respaldo internacional ACCA (Approved Learning Partner)</span>
                                        </div>
                                        <div class="why-compare-item">
                                            <i class="fa fa-check-circle"></i>
                                            <span>Casos prácticos reales aplicables desde el primer día</span>
                                        </div>
                                        <div class="why-compare-item">
                                            <i class="fa fa-check-circle"></i>
                                            <span>Certificado con validez y verificación en línea</span>
                                        </div>
                                        <div class="why-compare-item">
                                            <i class="fa fa-check-circle"></i>
                                            <span>Comunidad de profesionales en +10 países</span>
                                        </div>
                                        <div class="why-compare-item">
                                            <i class="fa fa-check-circle"></i>
                                            <span>Plataforma virtual con acceso permanente</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5">
                                <div class="why-compare-card h-100">
                                    <div class="why-compare-col why-compare-them h-100">
                                        <h3 class="why-compare-title text-navy-custom">Formación tradicional</h3>
                                        <p class="why-compare-sub text-muted-custom">Lo que suele ofrecerte el mercado</p>
                                        <div class="why-compare-item">
                                            <i class="fa fa-times-circle"></i>
                                            <span>Docentes con experiencia limitada o desactualizada</span>
                                        </div>
                                        <div class="why-compare-item">
                                            <i class="fa fa-times-circle"></i>
                                            <span>Sin respaldo de organismos internacionales</span>
                                        </div>
                                        <div class="why-compare-item">
                                            <i class="fa fa-times-circle"></i>
                                            <span>Teoría genérica, alejada de la práctica real</span>
                                        </div>
                                        <div class="why-compare-item">
                                            <i class="fa fa-times-circle"></i>
                                            <span>Certificados sin verificación ni valor diferencial</span>
                                        </div>
                                        <div class="why-compare-item">
                                            <i class="fa fa-times-circle"></i>
                                            <span>Red de contactos limitada al aula</span>
                                        </div>
                                        <div class="why-compare-item">
                                            <i class="fa fa-times-circle"></i>
                                            <span>Material que caduca al terminar el curso</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                
                
                
                
                <section class="why-section pt-0">
                    <div class="container">
                        <div class="why-stats-band shadow" data-aos="fade-up">
                            <div class="row row-cols-2 row-cols-lg-4 g-4 position-relative">
                                <div class="col why-stat">
                                    <i class="fa fa-graduation-cap"></i>
                                    <strong>+1,000</strong>
                                    <span>Alumnos formados</span>
                                </div>
                                <div class="col why-stat">
                                    <i class="fa fa-globe-americas"></i>
                                    <strong>+10</strong>
                                    <span>Países de LATAM</span>
                                </div>
                                <div class="col why-stat">
                                    <i class="fa fa-chalkboard-teacher"></i>
                                    <strong>+40</strong>
                                    <span>Docentes expertos</span>
                                </div>
                                <div class="col why-stat">
                                    <i class="fa fa-book-open"></i>
                                    <strong>+50</strong>
                                    <span>Programas de especialización</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>

                
                
                
                

                
                
                
                <section class="why-section why-section-alt">
                    <div class="container-fluid" data-aos="fade-up">
                        <?php if (isset($component)) { $__componentOriginal707a56286bf9ae6f3609992841846927 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal707a56286bf9ae6f3609992841846927 = $attributes; } ?>
<?php $component = App\View\Components\Teachers::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('teachers'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Teachers::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal707a56286bf9ae6f3609992841846927)): ?>
<?php $attributes = $__attributesOriginal707a56286bf9ae6f3609992841846927; ?>
<?php unset($__attributesOriginal707a56286bf9ae6f3609992841846927); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal707a56286bf9ae6f3609992841846927)): ?>
<?php $component = $__componentOriginal707a56286bf9ae6f3609992841846927; ?>
<?php unset($__componentOriginal707a56286bf9ae6f3609992841846927); ?>
<?php endif; ?>
                    </div>
                </section>

                
                
                
                <section class="why-section pt-0">
                    <div class="container">
                        <div class="why-cta text-center" data-aos="fade-up">
                            <h2 class="fw-bold text-white mb-3" style="font-size: 2.2rem;">
                                Da el siguiente paso en tu <span class="text-warning">carrera profesional</span>
                            </h2>
                            <p class="text-white-50 mx-auto mb-4" style="max-width: 640px;">
                                Miles de profesionales ya transformaron su futuro con CPA Academy.
                                El siguiente lugar es tuyo.
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

<?php echo $__env->make('layouts.webpage', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\globalcpa\resources\views/pages/por-que-cpa-academy.blade.php ENDPATH**/ ?>