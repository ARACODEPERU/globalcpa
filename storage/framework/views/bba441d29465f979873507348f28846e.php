<?php $__env->startSection('content'); ?>

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
    .loader-text::after {
        content: '';
        animation: typing-dots 1.5s infinite;
        width: 15px; /* Espacio reservado para que el texto no se mueva */
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
            <div class="page-body">
                    <br />
                <div data-aos="fade-in">
                     <?php if (isset($component)) { $__componentOriginala02b71ca7fa3d8670dc711f95469e1f3 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginala02b71ca7fa3d8670dc711f95469e1f3 = $attributes; } ?>
<?php $component = App\View\Components\Slider::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('slider'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Slider::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginala02b71ca7fa3d8670dc711f95469e1f3)): ?>
<?php $attributes = $__attributesOriginala02b71ca7fa3d8670dc711f95469e1f3; ?>
<?php unset($__attributesOriginala02b71ca7fa3d8670dc711f95469e1f3); ?>
<?php endif; ?>
<?php if (isset($__componentOriginala02b71ca7fa3d8670dc711f95469e1f3)): ?>
<?php $component = $__componentOriginala02b71ca7fa3d8670dc711f95469e1f3; ?>
<?php unset($__componentOriginala02b71ca7fa3d8670dc711f95469e1f3); ?>
<?php endif; ?>
                </div>
                <div data-aos="fade-up"><?php if (isset($component)) { $__componentOriginal804ed11c2e144744bdf8d4be0813ff63 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal804ed11c2e144744bdf8d4be0813ff63 = $attributes; } ?>
<?php $component = App\View\Components\Courses\ListCard::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('courses.list-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Courses\ListCard::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal804ed11c2e144744bdf8d4be0813ff63)): ?>
<?php $attributes = $__attributesOriginal804ed11c2e144744bdf8d4be0813ff63; ?>
<?php unset($__attributesOriginal804ed11c2e144744bdf8d4be0813ff63); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal804ed11c2e144744bdf8d4be0813ff63)): ?>
<?php $component = $__componentOriginal804ed11c2e144744bdf8d4be0813ff63; ?>
<?php unset($__componentOriginal804ed11c2e144744bdf8d4be0813ff63); ?>
<?php endif; ?></div>
                <div data-aos="fade-up"><?php if (isset($component)) { $__componentOriginal7e01abc08e7a37244d5233bb49692f65 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal7e01abc08e7a37244d5233bb49692f65 = $attributes; } ?>
<?php $component = App\View\Components\Eleva::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('eleva'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Eleva::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal7e01abc08e7a37244d5233bb49692f65)): ?>
<?php $attributes = $__attributesOriginal7e01abc08e7a37244d5233bb49692f65; ?>
<?php unset($__attributesOriginal7e01abc08e7a37244d5233bb49692f65); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal7e01abc08e7a37244d5233bb49692f65)): ?>
<?php $component = $__componentOriginal7e01abc08e7a37244d5233bb49692f65; ?>
<?php unset($__componentOriginal7e01abc08e7a37244d5233bb49692f65); ?>
<?php endif; ?></div>
                <div data-aos="fade-up"><?php if (isset($component)) { $__componentOriginal707a56286bf9ae6f3609992841846927 = $component; } ?>
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
<?php endif; ?></div>
                <div data-aos="fade-up"><?php if (isset($component)) { $__componentOriginal4b22bf506ae47a00f709260ab388e480 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal4b22bf506ae47a00f709260ab388e480 = $attributes; } ?>
<?php $component = App\View\Components\Solutions::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('solutions'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\Solutions::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal4b22bf506ae47a00f709260ab388e480)): ?>
<?php $attributes = $__attributesOriginal4b22bf506ae47a00f709260ab388e480; ?>
<?php unset($__attributesOriginal4b22bf506ae47a00f709260ab388e480); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal4b22bf506ae47a00f709260ab388e480)): ?>
<?php $component = $__componentOriginal4b22bf506ae47a00f709260ab388e480; ?>
<?php unset($__componentOriginal4b22bf506ae47a00f709260ab388e480); ?>
<?php endif; ?></div>
                <div data-aos="fade-up"><?php if (isset($component)) { $__componentOriginal9a18448ac5531d2b3c97d0119a14634b = $component; } ?>
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
<?php endif; ?></div>
                <br>
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
            // 1. Inicializar AOS si la librería está disponible
            if (window.AOS !== undefined) {
                AOS.init({
                    mirror: false,
                    duration: 800,
                    once: true
                });
            }

            // 2. Ocultar el loader y activar el contenido
            setTimeout(function() {
                $('.loader-wrapper').fadeOut('slow', function() {
                    $(this).remove(); // Eliminar del DOM para evitar interferencias
                    
                    // 3. IMPORTANTE: Refrescar AOS para que las animaciones de la página se disparen
                    if (window.AOS !== undefined) {
                        AOS.refresh();
                    }
                });
            }, 2500);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.webpage', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\laragon\www\globalcpa\resources\views/pages/home.blade.php ENDPATH**/ ?>