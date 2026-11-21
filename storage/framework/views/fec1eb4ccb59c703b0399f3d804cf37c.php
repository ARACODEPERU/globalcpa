<?php $__env->startSection('content'); ?>
    
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


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
            <div class="page-body" x-data>

                <!-- Propuesta de Diseño Moderno Opción 4 (Más avatares) -->
                <div class="container-fluid mt-5">
                    <div class="card border-0 overflow-hidden shadow mb-4"
                        style="background: linear-gradient(135deg, #002060 0%, #004080 100%); border-radius: 20px;"
                        data-aos="fade-up">
                        
                        <div class="card-body p-4 p-lg-5 position-relative">
                            <div class="row align-items-center">
                                <div class="col-lg-7">
                                    <nav aria-label="breadcrumb" class="mb-3">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item">
                                                <a href="/" class="text-white-50 text-decoration-none text-uppercase small fw-bold" style="letter-spacing: 1px;">
                                                    <i class="fa fa-home me-1"></i> Inicio
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active text-white text-uppercase small fw-bold" style="letter-spacing: 1px;" aria-current="page">
                                                Docentes
                                            </li>
                                        </ol>
                                    </nav>
                                    
                                    <h1 class="display-4 fw-bold text-white mb-3">
                                        Nuestro Equipo de <span class="text-warning">Expertos</span>
                                    </h1>
                                    <p class="lead text-white-50 mb-4" style="max-width: 600px; line-height: 1.6;">
                                        Conoce a los profesionales que lideran la formación. Docentes con amplia experiencia y pasión por enseñar.
                                    </p>
                                    
                                    <div class="d-flex gap-3">
                                        <div class="d-flex align-items-center text-white-50 small">
                                            <i class="fa fa-check-circle text-success me-2"></i> Líderes en su Campo
                                        </div>
                                        <div class="d-flex align-items-center text-white-50 small">
                                            <i class="fa fa-check-circle text-success me-2"></i> Enfoque Práctico
                                        </div>
                                    </div>
                                </div>
                                
                                <div class="col-lg-5 d-none d-lg-block">
                                    <div class="teacher-avatar-cloud-4 position-relative" style="min-height: 280px;">
                                        <!-- Avatares flotantes de docentes (más cantidad) -->
                                        <img loading="lazy" decoding="async" src="https://i.pravatar.cc/150?img=12" class="avatar-item item-1 shadow-lg" alt="Docente 1">
                                        <img loading="lazy" decoding="async" src="https://i.pravatar.cc/150?img=28" class="avatar-item item-2 shadow" alt="Docente 2">
                                        <img loading="lazy" decoding="async" src="https://i.pravatar.cc/150?img=35" class="avatar-item item-3 shadow" alt="Docente 3">
                                        <img loading="lazy" decoding="async" src="https://i.pravatar.cc/150?img=45" class="avatar-item item-4 shadow" alt="Docente 4">
                                        <img loading="lazy" decoding="async" src="https://i.pravatar.cc/150?img=5" class="avatar-item item-5 shadow" alt="Docente 5">
                                        <img loading="lazy" decoding="async" src="https://i.pravatar.cc/150?img=52" class="avatar-item item-6 shadow" alt="Docente 6">
                                        <img loading="lazy" decoding="async" src="https://i.pravatar.cc/150?img=56" class="avatar-item item-7 shadow" alt="Docente 7">
                                        <img loading="lazy" decoding="async" src="https://i.pravatar.cc/150?img=68" class="avatar-item item-8 shadow" alt="Docente 8">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .teacher-avatar-cloud-4 .avatar-item {
                        position: absolute;
                        border-radius: 50%;
                        border: 3px solid rgba(255, 255, 255, 0.5);
                        animation: float-avatars-4 6s ease-in-out infinite;
                    }
                    .teacher-avatar-cloud-4 .item-1 { width: 110px; height: 110px; top: 50%; left: 50%; z-index: 5; animation-name: float-avatars-center-4; animation-duration: 5s; }
                    .teacher-avatar-cloud-4 .item-2 { width: 70px; height: 70px; top: 10%; left: 25%; animation-delay: -1s; }
                    .teacher-avatar-cloud-4 .item-3 { width: 80px; height: 80px; top: 20%; left: 75%; animation-delay: -2.5s; animation-duration: 7s; }
                    .teacher-avatar-cloud-4 .item-4 { width: 60px; height: 60px; top: 70%; left: 15%; animation-delay: -4s; }
                    .teacher-avatar-cloud-4 .item-5 { width: 90px; height: 90px; top: 65%; left: 65%; animation-delay: -0.5s; animation-duration: 8s; }
                    .teacher-avatar-cloud-4 .item-6 { width: 55px; height: 55px; top: 5%; left: 5%; animation-delay: -2s; animation-duration: 6.5s; }
                    .teacher-avatar-cloud-4 .item-7 { width: 75px; height: 75px; top: 80%; left: 90%; animation-delay: -3s; animation-duration: 7.5s; }
                    .teacher-avatar-cloud-4 .item-8 { width: 65px; height: 65px; top: 15%; left: 95%; animation-delay: -5s; animation-duration: 6s; }

                    @keyframes float-avatars-4 {
                        0%, 100% { transform: translateY(0px) rotate(5deg); }
                        50% { transform: translateY(-15px) rotate(-5deg); }
                    }
                    @keyframes float-avatars-center-4 {
                        0%, 100% { transform: translate(-50%, -50%) translateY(0px) rotate(5deg); }
                        50% { transform: translate(-50%, -50%) translateY(-15px) rotate(-5deg); }
                    }
                </style>

                <div data-aos="fade-up"><?php if (isset($component)) { $__componentOriginald80914e1e35240de06da1cadf0b21e75 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginald80914e1e35240de06da1cadf0b21e75 = $attributes; } ?>
<?php $component = App\View\Components\TeachersAll::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('teachers-all'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\TeachersAll::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginald80914e1e35240de06da1cadf0b21e75)): ?>
<?php $attributes = $__attributesOriginald80914e1e35240de06da1cadf0b21e75; ?>
<?php unset($__attributesOriginald80914e1e35240de06da1cadf0b21e75); ?>
<?php endif; ?>
<?php if (isset($__componentOriginald80914e1e35240de06da1cadf0b21e75)): ?>
<?php $component = $__componentOriginald80914e1e35240de06da1cadf0b21e75; ?>
<?php unset($__componentOriginald80914e1e35240de06da1cadf0b21e75); ?>
<?php endif; ?></div>

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




    
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            mirror: true, // This makes animations trigger on scroll up as well
            duration: 800, // Animation duration
            once: false // Ensures animation happens every time you scroll to it
        });
    </script>



<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.webpage', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\globalcpa\resources\views\pages\teachers.blade.php ENDPATH**/ ?>