<?php $__env->startSection('title', ' - ' . ($landing->course->name ?? $landing->course->description ?? 'Curso')); ?>

<?php $__env->startSection('etiquetasmeta'); ?>
    <?php
        $seoCourseName = $landing->course->name ?? $landing->course->description ?? 'Curso de especialización';
        $seoDescription = \Illuminate\Support\Str::limit(trim(strip_tags((string) ($landing->course->description ?? ''))), 155) ?: null;
        $seoImage = !empty($landing->course->image) ? asset('storage/' . $landing->course->image) : null;
    ?>
    <?php if (isset($component)) { $__componentOriginal42da61123f891e63201d7be28f403427 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42da61123f891e63201d7be28f403427 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo','data' => ['title' => ''.e($seoCourseName).' - CPA Academy','description' => $seoDescription,'image' => $seoImage]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => ''.e($seoCourseName).' - CPA Academy','description' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoDescription),'image' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($seoImage)]); ?>
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

    <?php if(!isset($landing) || empty($landing) || !isset($landing->course) || empty($landing->course)): ?>
        <div class="container-fluid py-5 text-center"><div class="alert alert-warning">Landing o curso no encontrado.</div></div>
    <?php else: ?>

    <style>
        /* Estilos para el Loader con Logotipo */
        .loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ffffff; /* Fondo blanco para que resalte el logo */
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            z-index: 999999;
        }
        .loader-logo {
            width: 220px; /* Tamaño ajustable del logo */
            height: auto;
            animation: pulse-logo 1.5s infinite ease-in-out;
        }
        .loader-text {
            margin-top: 20px;
            font-family: 'Poppins', sans-serif;
            font-weight: 600;
            color: #002060;
            letter-spacing: 1px;
            text-transform: uppercase;
            display: flex;
            align-items: center;
        }
        body.dark-only .loader-text { color: #ffffff; }
        /* Modo oscuro: logo del loader en blanco (el asset ya es 100% blanco) */
        body.dark-only .loader-logo { content: url("<?php echo e(asset('themes/webpage/images/Logo_cpa_blanco.png')); ?>"); }
        .loader-text::after {
            content: '';
            animation: typing-dots 1.5s infinite;
            width: 15px;
            text-align: left;
        }
        @keyframes typing-dots {
            0%, 100% { content: ''; }
            25% { content: '.'; }
            50% { content: '..'; }
            75% { content: '...'; }
        }
        @keyframes pulse-logo {
            0% { transform: scale(0.9); opacity: 0.8; }
            50% { transform: scale(1.05); opacity: 1; }
            100% { transform: scale(0.9); opacity: 0.8; }
        }
    </style>

    <!-- Loader starts-->
    <div class="loader-wrapper">
        <img src="<?php echo e(asset('themes/webpage/images/Logo_cpa_modificado.png')); ?>" alt="CPA Logo" class="loader-logo">
        <p class="loader-text">Cargando</p>
    </div>
    <!-- Loader ends-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <?php if (isset($component)) { $__componentOriginal2a2e454b2e62574a80c8110e5f128b60 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal2a2e454b2e62574a80c8110e5f128b60 = $attributes; } ?>
<?php $component = App\View\Components\Header::resolve(['breadcrumb' => [
            ['label' => 'Cursos', 'url' => route('web_courses')],
            ['label' => $landing->course->name ?? ($landing->course->description ?? 'Curso de especialización')],
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
            <div class="page-body dark:bg-[#111c2d] transition-colors duration-300">

                
                <?php if (isset($component)) { $__componentOriginal6858eb7279ef6930bc317cdff80ef298 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal6858eb7279ef6930bc317cdff80ef298 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.courselanding.hero','data' => ['landing' => $landing]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('courselanding.hero'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['landing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($landing)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal6858eb7279ef6930bc317cdff80ef298)): ?>
<?php $attributes = $__attributesOriginal6858eb7279ef6930bc317cdff80ef298; ?>
<?php unset($__attributesOriginal6858eb7279ef6930bc317cdff80ef298); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal6858eb7279ef6930bc317cdff80ef298)): ?>
<?php $component = $__componentOriginal6858eb7279ef6930bc317cdff80ef298; ?>
<?php unset($__componentOriginal6858eb7279ef6930bc317cdff80ef298); ?>
<?php endif; ?>

                
                
                
                
                <?php if (isset($component)) { $__componentOriginal76a05560ff8f87767ebb67bcc0189c1b = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal76a05560ff8f87767ebb67bcc0189c1b = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.courselanding.professional-development-info','data' => ['landing' => $landing]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('courselanding.professional-development-info'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['landing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($landing)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal76a05560ff8f87767ebb67bcc0189c1b)): ?>
<?php $attributes = $__attributesOriginal76a05560ff8f87767ebb67bcc0189c1b; ?>
<?php unset($__attributesOriginal76a05560ff8f87767ebb67bcc0189c1b); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal76a05560ff8f87767ebb67bcc0189c1b)): ?>
<?php $component = $__componentOriginal76a05560ff8f87767ebb67bcc0189c1b; ?>
<?php unset($__componentOriginal76a05560ff8f87767ebb67bcc0189c1b); ?>
<?php endif; ?>

                
                <?php if (isset($component)) { $__componentOriginalffb191a6d0814a9d41433eb030b358c3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalffb191a6d0814a9d41433eb030b358c3 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.courselanding.the-problem','data' => ['landing' => $landing]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('courselanding.the-problem'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['landing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($landing)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalffb191a6d0814a9d41433eb030b358c3)): ?>
<?php $attributes = $__attributesOriginalffb191a6d0814a9d41433eb030b358c3; ?>
<?php unset($__attributesOriginalffb191a6d0814a9d41433eb030b358c3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalffb191a6d0814a9d41433eb030b358c3)): ?>
<?php $component = $__componentOriginalffb191a6d0814a9d41433eb030b358c3; ?>
<?php unset($__componentOriginalffb191a6d0814a9d41433eb030b358c3); ?>
<?php endif; ?>

                
                <?php if (isset($component)) { $__componentOriginalb2297547cda8a9458a1c5c0e5ddadabe = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalb2297547cda8a9458a1c5c0e5ddadabe = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.courselanding.study-plan','data' => ['landing' => $landing]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('courselanding.study-plan'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['landing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($landing)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalb2297547cda8a9458a1c5c0e5ddadabe)): ?>
<?php $attributes = $__attributesOriginalb2297547cda8a9458a1c5c0e5ddadabe; ?>
<?php unset($__attributesOriginalb2297547cda8a9458a1c5c0e5ddadabe); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalb2297547cda8a9458a1c5c0e5ddadabe)): ?>
<?php $component = $__componentOriginalb2297547cda8a9458a1c5c0e5ddadabe; ?>
<?php unset($__componentOriginalb2297547cda8a9458a1c5c0e5ddadabe); ?>
<?php endif; ?>

                
                <?php if (isset($component)) { $__componentOriginal4cad9e62bc28f15c0e171e9dba42ba32 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4cad9e62bc28f15c0e171e9dba42ba32 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.courselanding.staff','data' => ['landing' => $landing,'teachersPremium' => $teachers_premium]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('courselanding.staff'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['landing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($landing),'teachers-premium' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($teachers_premium)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4cad9e62bc28f15c0e171e9dba42ba32)): ?>
<?php $attributes = $__attributesOriginal4cad9e62bc28f15c0e171e9dba42ba32; ?>
<?php unset($__attributesOriginal4cad9e62bc28f15c0e171e9dba42ba32); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4cad9e62bc28f15c0e171e9dba42ba32)): ?>
<?php $component = $__componentOriginal4cad9e62bc28f15c0e171e9dba42ba32; ?>
<?php unset($__componentOriginal4cad9e62bc28f15c0e171e9dba42ba32); ?>
<?php endif; ?>

                
                <?php if (isset($component)) { $__componentOriginal86051bf77578d8460ffc54ee15a6f869 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal86051bf77578d8460ffc54ee15a6f869 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.courselanding.results','data' => ['landing' => $landing,'colors' => $colors]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('courselanding.results'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['landing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($landing),'colors' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($colors)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal86051bf77578d8460ffc54ee15a6f869)): ?>
<?php $attributes = $__attributesOriginal86051bf77578d8460ffc54ee15a6f869; ?>
<?php unset($__attributesOriginal86051bf77578d8460ffc54ee15a6f869); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal86051bf77578d8460ffc54ee15a6f869)): ?>
<?php $component = $__componentOriginal86051bf77578d8460ffc54ee15a6f869; ?>
<?php unset($__componentOriginal86051bf77578d8460ffc54ee15a6f869); ?>
<?php endif; ?>

                
                <?php if (isset($component)) { $__componentOriginal7c3354ed1a1bbebad40d88dffc1ff830 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7c3354ed1a1bbebad40d88dffc1ff830 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.courselanding.testimonials','data' => ['landing' => $landing]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('courselanding.testimonials'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['landing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($landing)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7c3354ed1a1bbebad40d88dffc1ff830)): ?>
<?php $attributes = $__attributesOriginal7c3354ed1a1bbebad40d88dffc1ff830; ?>
<?php unset($__attributesOriginal7c3354ed1a1bbebad40d88dffc1ff830); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7c3354ed1a1bbebad40d88dffc1ff830)): ?>
<?php $component = $__componentOriginal7c3354ed1a1bbebad40d88dffc1ff830; ?>
<?php unset($__componentOriginal7c3354ed1a1bbebad40d88dffc1ff830); ?>
<?php endif; ?>

                
                <?php if (isset($component)) { $__componentOriginal159ec694000142034922c8106a7feba7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal159ec694000142034922c8106a7feba7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.courselanding.investment','data' => ['landing' => $landing,'onliItemId' => $onli_item_id]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('courselanding.investment'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['landing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($landing),'onli-item-id' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($onli_item_id)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal159ec694000142034922c8106a7feba7)): ?>
<?php $attributes = $__attributesOriginal159ec694000142034922c8106a7feba7; ?>
<?php unset($__attributesOriginal159ec694000142034922c8106a7feba7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal159ec694000142034922c8106a7feba7)): ?>
<?php $component = $__componentOriginal159ec694000142034922c8106a7feba7; ?>
<?php unset($__componentOriginal159ec694000142034922c8106a7feba7); ?>
<?php endif; ?>

                
                <?php if (isset($component)) { $__componentOriginal027f2e95c382bc9f2667e9e8a7aa2ff7 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal027f2e95c382bc9f2667e9e8a7aa2ff7 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.courselanding.faq','data' => ['landing' => $landing]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('courselanding.faq'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['landing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($landing)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal027f2e95c382bc9f2667e9e8a7aa2ff7)): ?>
<?php $attributes = $__attributesOriginal027f2e95c382bc9f2667e9e8a7aa2ff7; ?>
<?php unset($__attributesOriginal027f2e95c382bc9f2667e9e8a7aa2ff7); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal027f2e95c382bc9f2667e9e8a7aa2ff7)): ?>
<?php $component = $__componentOriginal027f2e95c382bc9f2667e9e8a7aa2ff7; ?>
<?php unset($__componentOriginal027f2e95c382bc9f2667e9e8a7aa2ff7); ?>
<?php endif; ?>

                
                <?php if (isset($component)) { $__componentOriginal477af015db96330ad92e15f962dacf06 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal477af015db96330ad92e15f962dacf06 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.courselanding.professional-development-form','data' => ['landing' => $landing]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('courselanding.professional-development-form'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['landing' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($landing)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal477af015db96330ad92e15f962dacf06)): ?>
<?php $attributes = $__attributesOriginal477af015db96330ad92e15f962dacf06; ?>
<?php unset($__attributesOriginal477af015db96330ad92e15f962dacf06); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal477af015db96330ad92e15f962dacf06)): ?>
<?php $component = $__componentOriginal477af015db96330ad92e15f962dacf06; ?>
<?php unset($__componentOriginal477af015db96330ad92e15f962dacf06); ?>
<?php endif; ?>

                <?php if (isset($component)) { $__componentOriginal583c4d6ece4014d53cb4e0fc05a71764 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal583c4d6ece4014d53cb4e0fc05a71764 = $attributes; } ?>
<?php $component = App\View\Components\Courselanding\CertificateTemplate::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('courselanding.certificate-template'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Courselanding\CertificateTemplate::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal583c4d6ece4014d53cb4e0fc05a71764)): ?>
<?php $attributes = $__attributesOriginal583c4d6ece4014d53cb4e0fc05a71764; ?>
<?php unset($__attributesOriginal583c4d6ece4014d53cb4e0fc05a71764); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal583c4d6ece4014d53cb4e0fc05a71764)): ?>
<?php $component = $__componentOriginal583c4d6ece4014d53cb4e0fc05a71764; ?>
<?php unset($__componentOriginal583c4d6ece4014d53cb4e0fc05a71764); ?>
<?php endif; ?>

                
                <?php if (isset($component)) { $__componentOriginaldaa85791ccbacea410a85078af7bab88 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginaldaa85791ccbacea410a85078af7bab88 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.courselanding.course-testimonials','data' => ['testimonials' => $course_testimonials ?? [],'course' => $landing->course,'schema' => $course_schema ?? null]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('courselanding.course-testimonials'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['testimonials' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($course_testimonials ?? []),'course' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($landing->course),'schema' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($course_schema ?? null)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginaldaa85791ccbacea410a85078af7bab88)): ?>
<?php $attributes = $__attributesOriginaldaa85791ccbacea410a85078af7bab88; ?>
<?php unset($__attributesOriginaldaa85791ccbacea410a85078af7bab88); ?>
<?php endif; ?>
<?php if (isset($__componentOriginaldaa85791ccbacea410a85078af7bab88)): ?>
<?php $component = $__componentOriginaldaa85791ccbacea410a85078af7bab88; ?>
<?php unset($__componentOriginaldaa85791ccbacea410a85078af7bab88); ?>
<?php endif; ?>


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

    <?php endif; ?>

<?php $__env->startSection('javascripts'); ?>
    <script>
        $(document).ready(function() {
            // 1. Inicializar AOS
            if (window.AOS !== undefined) {
                AOS.init({
                    mirror: false,
                    duration: 800,
                    once: true
                });
            }

            // 2. Ocultar el loader y refrescar AOS
            setTimeout(function() {
                $('.loader-wrapper').fadeOut('slow', function() {
                    $(this).remove(); // Eliminar del DOM para evitar interferencias
                    if (window.AOS !== undefined) {
                        AOS.refresh();
                    }
                });
            }, 2500);
        });

        function procederInscripcion() {
            if (window.Swal === undefined) {
                console.error("SweetAlert2 (Swal) no está cargado.");
                return;
            }

            var precioCurso = <?php echo json_encode($landing->investment_section['items'][0]['price_now'] ?? 0, 15, 512) ?>;
            var esGratis = parseFloat(precioCurso) <= 0;

            var titulo = esGratis ? '¿Inscribirme gratis?' : '¿Confirmar inscripción?';
            var mensaje = esGratis
                ? 'Este curso es gratuito. Se agregará a tu carrito para completar la inscripción sin costo.'
                : '¿Estás seguro de que deseas proceder con la compra?';
            var textoBtn = esGratis ? 'Sí, inscribirme' : 'Sí, continuar';

            Swal.fire({
                title: titulo,
                text: mensaje,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: textoBtn,
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    // 1. Limpiar el carrito
                    localStorage.removeItem('carrito');

                    // 2. Crear objeto del producto
                    var producto = {
                        id: <?php echo json_encode($onli_item_id ?? 0, 15, 512) ?>,
                        nombre: <?php echo json_encode($landing->course->description ?? 'Curso', 15, 512) ?>,
                        precio: precioCurso,
                        image: "<?php echo e($landing->course->image ?? ''); ?>"
                    };

                    // 3. Agregar directamente al localStorage
                    var carrito = [];
                    carrito.push(producto);
                    localStorage.setItem('carrito', JSON.stringify(carrito));

                    if (esGratis) {
                        // 4a. Para cursos gratis: mostrar mensaje y ofrecer ir al carrito
                        Swal.fire({
                            title: '¡Inscripción gratuita!',
                            html: '<strong>' + producto.nombre + '</strong> se agregó a tu carrito.<br><br>' +
                                  '<span style="color: #16a34a; font-weight: 600;">Este curso es gratuito. Ve al carrito para completar tu inscripción sin costo.</span>',
                            icon: 'success',
                            showCancelButton: true,
                            confirmButtonText: 'Ir al Carrito',
                            cancelButtonText: 'Seguir navegando',
                            reverseButtons: true,
                        }).then((result2) => {
                            if (result2.isConfirmed) {
                                window.location.href = "<?php echo e(route('web_carrito')); ?>";
                            }
                        });
                    } else {
                        // 4b. Para cursos de pago: redireccionar directamente al carrito
                        window.location.href = "<?php echo e(route('web_carrito')); ?>";
                    }
                }
            });
        }

        function initContactForm(formId, buttonId, messageId, countrySelectId) {
            let formElement = document.getElementById(formId);
            if(!formElement) return;

            formElement.addEventListener('submit', function(e) {
                e.preventDefault();

                // --- Validación Frontend ---
                var errorMessageContainer = document.getElementById(messageId);
                errorMessageContainer.innerHTML = '';

                var phoneInput = formElement.querySelector('input[name="phone"]');
                var emailInput = formElement.querySelector('input[name="email"]');
                var errors = [];

                // Validar teléfono: solo dígitos y mínimo 8
                if (phoneInput) {
                    var phoneValue = phoneInput.value.replace(/\s/g, '');
                    if (phoneValue && !/^[0-9]+$/.test(phoneValue)) {
                        errors.push('El teléfono solo debe contener números.');
                    } else if (phoneValue.length < 8) {
                        errors.push('El teléfono debe tener al menos 8 dígitos.');
                    }
                }

                // Validar correo electrónico
                if (emailInput) {
                    var emailValue = emailInput.value.trim();
                    if (emailValue && !/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(emailValue)) {
                        errors.push('Ingresa un correo electrónico válido.');
                    }
                }

                if (errors.length > 0) {
                    errorMessageContainer.innerHTML = '<div class="alert alert-danger py-2">' + errors.join('<br>') + '</div>';
                    return;
                }
                // --- Fin Validación Frontend ---

                var formData = new FormData(formElement);
                const countrySelect = document.getElementById(countrySelectId);
                const prefix = countrySelect.value; // Ej: "+51"

                // Obtener el valor del teléfono del input
                var rawPhone = formData.get('phone') || '';

                // Extraer el código numérico del prefijo (ej: "+51" → "51", "+591" → "591")
                var numericCode = prefix.replace(/[^0-9]/g, '');

                // Limpiar el número: eliminar todo lo que no sean dígitos
                var cleanedPhone = rawPhone.replace(/[^0-9]/g, '');

                // Si el número ya contiene el código de país al inicio, quitarlo para evitar duplicación
                while (cleanedPhone.startsWith(numericCode)) {
                    cleanedPhone = cleanedPhone.substring(numericCode.length);
                }

                // Argentina: si el número no empieza con 9, agregarlo automáticamente
                if (numericCode === '54' && cleanedPhone.length > 0 && !cleanedPhone.startsWith('9')) {
                    cleanedPhone = '9' + cleanedPhone;
                }

                // Asignar el teléfono completo: prefijo + número limpio (sin código duplicado)
                formData.set('phone', prefix + cleanedPhone);

                var submitButton = document.getElementById(buttonId);
                submitButton.disabled = true;
                submitButton.style.opacity = 0.25;

                var xhr = new XMLHttpRequest();
                xhr.open('POST', "<?php echo e(route('apisubscriber')); ?>", true);

                xhr.onload = function() {
                    submitButton.disabled = false;
                    submitButton.style.opacity = 1;

                    if (xhr.status === 200) {
                        var response = JSON.parse(xhr.responseText);

                        // Define la función que muestra SweetAlert y las acciones posteriores
                        const showSweetAlertAndContinue = () => {
                            if (window.Swal === undefined) return;
                            Swal.fire({
                                icon: 'success',
                                title: 'Registro exitoso, estas a un paso de asegurar tu vacante',
                                text: 'Tu brochure está listo para descargar. Un asesor está disponible ahora mismo en WhatsApp para resolver tus dudas finales y brindarte las mejores condiciones para tu inscripción.',
                                // La descarga del brochure ya ocurrió antes de enviar los datos al endpoint
                            });
                        };

                        // 1. Intentar cerrar el modal de Bootstrap de forma segura
                        const modalElement = document.getElementById('modalFinanciamiento');
                        if (modalElement && window.bootstrap !== undefined) {
                            const modalInstance = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
                            modalInstance.hide();
                        }

                        // 2. LIMPIEZA FORZADA: Eliminamos manualmente el fondo negro y desbloqueamos el scroll
                        // Esto elimina cualquier "backdrop" huérfano que Bootstrap haya dejado
                        document.querySelectorAll('.modal-backdrop').forEach(el => el.remove());
                        document.body.classList.remove('modal-open');
                        document.body.style.overflow = '';
                        document.body.style.paddingRight = '';

                        // 3. Mostrar la alerta
                        showSweetAlertAndContinue();

                        // 4. Conversión: solo con respuesta 200 del servidor (nunca en 422 ni en error).
                        if (typeof window.cpaTrack === 'function') {
                            window.cpaTrack('Lead', {
                                content_name: <?php echo json_encode($landing->course->description ?? 'Curso', 15, 512) ?>,
                                content_category: formId === 'modalContactForm' ? 'curso_modal_brochure' :
                                    'curso_landing_form',
                                <?php if(((float) ($landing->investment_section['items'][0]['price_now'] ?? $landing->course->price ?? 0)) > 0): ?>
                                value: <?php echo e((float) ($landing->investment_section['items'][0]['price_now'] ?? $landing->course->price ?? 0)); ?>,
                                currency: 'PEN',
                                <?php endif; ?>
                            }, 'generate_lead');
                        }

                    } else if (xhr.status === 422) {
                        var errorResponse = JSON.parse(xhr.responseText);
                        var errorMessageContainer = document.getElementById(messageId);
                        errorMessageContainer.innerHTML = ''; // Limpiar mensajes anteriores
                        errorMessageContainer.innerHTML = 'Errores de validación:<br>';
                        for (var field in errorResponse.errors) {
                            errorMessageContainer.innerHTML += field + ': ' + errorResponse.errors[field].join(', ') + '<br>';
                        }
                    }
                };
                var _t = JSON.parse(localStorage.getItem('traffic_tracking') || '{}');
                ['utm_source','utm_medium','utm_campaign','utm_term','utm_content','utm_id','fbclid','gclid','referer','landing_url','traffic_source'].forEach(function(k){ if(_t[k]) formData.set(k, _t[k]); });

                // Descarga del brochure ANTES de enviar los datos al endpoint (con o sin flow_id)
                var brochureUrl = <?php echo json_encode(isset($landing->course->brochure) ? ($landing->course->brochure->path_file ?? '') : '', 15, 512) ?>;
                if (brochureUrl) {
                    var brochureLink = document.createElement('a');
                    brochureLink.href = brochureUrl;
                    brochureLink.download = ''; // fuerza la descarga; si el navegador lo ignora, se abre en pestaña
                    brochureLink.rel = 'noopener';
                    brochureLink.style.display = 'none';
                    document.body.appendChild(brochureLink);
                    brochureLink.click();
                    brochureLink.remove();
                }

                xhr.send(formData);
            });
        }

        // Inicializar ambos formularios
        initContactForm('pageContactForm', 'submitPageContactButton', 'messagePageContact', 'countryPhoneSelect');
        initContactForm('modalContactForm', 'submitModalContactButton', 'messageModalContact', 'modalCountryPhoneSelect');
    </script>
    <script>
        $(document).ready(function() {
            if ($.fn.select2) {
                function formatCountry(country) {
                    if (!country.id) {
                        return country.text;
                    }
                    var code = $(country.element).data('code');
                    var $country = $(
                        '<span><img src="https://flagcdn.com/w20/' + (code ? code.toLowerCase() : 'pe') +
                        '.png" class="me-2" style="vertical-align: middle; border: 1px solid #eee; width: 20px;">' +
                        country.text + '</span>'
                    );
                    return $country;
                };

                $('#countryPhoneSelect').select2({
                    templateResult: formatCountry,
                    templateSelection: formatCountry,
                    dropdownParent: $('#countryPhoneSelect').parent()
                });

                $('#modalCountryPhoneSelect').select2({
                    templateResult: formatCountry,
                    templateSelection: formatCountry,
                    dropdownParent: $('#modalFinanciamiento')
                });
            }
        });

        // Toggle FAQ Manual - abrir al entrar, cerrar al salir
        window.toggleFaq = function(index) {
            const $answer = $('#faq-answer-' + index);
            const $icon = $('#faq-icon-' + index);

            if (!$answer.is(':visible')) {
                $answer.slideDown(300);
                $icon.css('transform', 'rotate(180deg)');
            } else {
                $answer.slideUp(300);
                $icon.css('transform', 'rotate(0deg)');
            }
        };
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.webpage', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\globalcpa\resources\views/pages/course-landing.blade.php ENDPATH**/ ?>