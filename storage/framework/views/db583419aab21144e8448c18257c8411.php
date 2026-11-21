<?php $__env->startSection('title', ' - Buscar cursos'); ?>

<?php $__env->startSection('etiquetasmeta'); ?>
    <meta name="description" content="Busca cursos de contabilidad, tributaria y más en CPA Academy." />
<?php $__env->stopSection(); ?>

<?php $__env->startSection('styles'); ?>
    <style>
        /* Paginación - Modo Claro */
        .tst-pagination .page-item .page-link {
            color: #002060;
            border: 1px solid #d1d5db;
            margin: 0 3px;
            border-radius: 10px;
            padding: 8px 14px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.25s ease;
            background: #ffffff;
        }
        .tst-pagination .page-item .page-link:hover {
            background: #002060;
            color: #ffffff;
            border-color: #002060;
        }
        .tst-pagination .page-item.active .page-link {
            background: #e30613;
            color: #ffffff;
            border-color: #e30613;
            box-shadow: 0 4px 12px rgba(227, 6, 19, 0.3);
        }
        .tst-pagination .page-item.disabled .page-link {
            color: #9ca3af;
            background: #f3f4f6;
            border-color: #e5e7eb;
            cursor: not-allowed;
        }

        /* Paginación - Modo Oscuro */
        body.dark-only .tst-pagination .page-item .page-link {
            color: #d1d5db;
            background: #1f2937;
            border-color: #374558;
        }
        body.dark-only .tst-pagination .page-item .page-link:hover {
            background: #e30613;
            color: #ffffff;
            border-color: #e30613;
        }
        body.dark-only .tst-pagination .page-item.active .page-link {
            background: #e30613;
            color: #ffffff;
            border-color: #e30613;
            box-shadow: 0 4px 12px rgba(227, 6, 19, 0.4);
        }
        body.dark-only .tst-pagination .page-item.disabled .page-link {
            color: #4b5563;
            background: #111827;
            border-color: #1f2937;
        }
    </style>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on top ends-->

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
                <div class="container-fluid">
                    <br><br><br>

                    
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card" style="background: linear-gradient(135deg, #002060 0%, #004080 100%); border-radius: 16px; border: none;">
                                <div class="card-body p-4 p-lg-5">
                                    <nav aria-label="breadcrumb" class="mb-3">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item">
                                                <a href="<?php echo e(route('index_main')); ?>" class="text-white-50 text-decoration-none">
                                                    <i class="fa fa-home me-1"></i> Inicio
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active text-white" aria-current="page">
                                                Resultados de búsqueda
                                            </li>
                                        </ol>
                                    </nav>

                                    <h1 class="h3 fw-bold text-white mb-2">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="vertical-align: middle; margin-right: 8px;"><path d="M16.66,10.08c0,3.63-2.95,6.58-6.58,6.58s-6.58-2.95-6.58-6.58S6.45,3.5,10.08,3.5s6.58,2.95,6.58,6.58Z"/><line x1="14.76" y1="14.71" x2="20.49" y2="20.49"/></svg>
                                        Resultados de búsqueda
                                    </h1>

                                    <?php if($query): ?>
                                        <p class="text-white-50 mb-3" style="font-size: 1.05rem;">
                                            Se encontraron <strong class="text-white"><?php echo e($total); ?></strong>
                                            <?php echo e(Str::plural('resultado', $total)); ?>

                                            para "<em class="text-warning"><?php echo e($query); ?></em>"
                                        </p>
                                    <?php else: ?>
                                        <p class="text-white-50 mb-3" style="font-size: 1.05rem;">
                                            Mostrando todos los cursos disponibles
                                        </p>
                                    <?php endif; ?>

                                    
                                    <form action="<?php echo e(route('web_search_courses')); ?>" method="GET" class="d-flex" style="max-width: 500px;">
                                        <div class="input-group">
                                            <input type="text" name="q" value="<?php echo e($query); ?>"
                                                   class="form-control form-control-lg"
                                                   placeholder="Buscar por nombre, categoría..."
                                                   style="border-radius: 25px 0 0 25px; border: none;"
                                                   autocomplete="off">
                                            <button class="btn btn-warning btn-lg" type="submit"
                                                    style="border-radius: 0 25px 25px 0; color: #002060; font-weight: 700; display: flex; align-items: center; gap: 6px;">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16.66,10.08c0,3.63-2.95,6.58-6.58,6.58s-6.58-2.95-6.58-6.58S6.45,3.5,10.08,3.5s6.58,2.95,6.58,6.58Z"/><line x1="14.76" y1="14.71" x2="20.49" y2="20.49"/></svg> Buscar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    
                    <?php if($courses->count() > 0): ?>
                        <div class="row widget-grid">
                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <?php
                                    $courseUrl = route('course_url_slug', $item->course->landing->url_slug);
                                ?>
                                <div class="col-xl-4 col-md-6 col-sm-12 box-col-4">
                                    <div class="card weekend-card">
                                        <div class="card-body">
                                            <a href="<?php echo e($courseUrl); ?>">
                                                <?php if($item->course?->image): ?>
                                                    <img loading="lazy" decoding="async" class="w-100 mb-3"
                                                         src="<?php echo e(asset('storage/' . $item->course->image)); ?>"
                                                         alt="<?php echo e($item->course->name ?? 'Imagen'); ?>">
                                                <?php endif; ?>
                                            </a>
                                            <br>
                                            <span style="color: #e30613;"><?php echo e($item->additional); ?></span>
                                            <?php if($item->course?->category?->description): ?>
                                                <span class="ms-1" style="font-size: 0.72rem; font-weight: 600; padding: 3px 10px; border-radius: 20px; background: #002060; color: #ffffff; display: inline-block;">
                                                    <?php echo e($item->course->category->description); ?>

                                                </span>
                                            <?php endif; ?>
                                            <br>
                                            <a href="<?php echo e($courseUrl); ?>" style="text-decoration: none;">
                                                <h4 style="height: 30px;"><?php echo e($item->name); ?></h4>
                                            </a>
                                            <br>
                                            <div class="card">
                                                <div class="">
                                                    <div class="btn-showcase">
                                                        <a href="<?php echo e($courseUrl); ?>">
                                                            <button class="btn btn-pill btn-light btn-air-light btn-sm" type="button">
                                                                Leer Más
                                                            </button>
                                                        </a>
                                                        <a onclick="agregarAlCarrito({ id: <?php echo e($item->id); ?>, nombre: '<?php echo e($item->name); ?>', precio: <?php echo e($item->price); ?> })">
                                                            <button class="btn btn-pill btn-primary btn-air-primary btn-sm" type="button">
                                                                <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 18px;"></i>
                                                                &nbsp; <?php echo e((float) $item->price <= 0 ? 'Gratis' : 'S/ ' . $item->price); ?>

                                                            </button>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>

                        
                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="tst-pagination">
                                    <?php echo e($courses->links()); ?>

                                </div>
                            </div>
                        </div>
                    <?php else: ?>
                        
                        <div class="row">
                            <div class="col-12">
                                <div class="card" style="border-radius: 16px;">
                                    <div class="card-body text-center py-5">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="60" height="60" viewBox="0 0 24 24" fill="none" stroke="#cbd5e1" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"><path d="M16.66,10.08c0,3.63-2.95,6.58-6.58,6.58s-6.58-2.95-6.58-6.58S6.45,3.5,10.08,3.5s6.58,2.95,6.58,6.58Z"/><line x1="14.76" y1="14.71" x2="20.49" y2="20.49"/></svg>
                                        <h3 class="h5 fw-bold mt-3" style="color: #374151;">
                                            No se encontraron cursos
                                        </h3>
                                        <p style="color: #6b7280; max-width: 400px; margin: 0 auto;">
                                            <?php if($query): ?>
                                                No hay resultados para "<strong><?php echo e($query); ?></strong>".
                                                Intenta con otros términos de búsqueda.
                                            <?php else: ?>
                                                Escribe un término de búsqueda para encontrar cursos.
                                            <?php endif; ?>
                                        </p>
                                        <a href="<?php echo e(route('web_courses')); ?>" class="btn btn-primary mt-3" style="border-radius: 25px;">
                                            <i class="fa-solid fa-arrow-left me-1"></i> Ver todos los cursos
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <?php endif; ?>

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
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.webpage', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\globalcpa\resources\views\pages\search-results.blade.php ENDPATH**/ ?>