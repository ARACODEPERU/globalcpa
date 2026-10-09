<div>
    <section style="padding: 0px 0px 10px 0px;">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-3 pe-0">
                    </div>
                    <div class="col-sm-6 ps-0">
                        <h1 class="ara_title">Formación que transforma tu talento en resultados reales</h1>
                    </div>
                    <div class="col-sm-3 pe-0">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card height-equal" style="background: none;">
                        <div class="card-body">
                            <ul class="nav nav-pills nav-primary" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="f-w-600 nav-link active" id="todos-tab" data-bs-toggle="pill"
                                        onclick="show_paginator()" href="#todos" role="tab" aria-controls="todos"
                                        aria-selected="false" tabindex="-1">Todos
                                    </a>
                                </li>
                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="nav-item" role="presentation">
                                        <a class="f-w-600 nav-link "
                                            onclick="unhidden('<?php echo e(str_replace(' ', '', $type)); ?>')"
                                            id="<?php echo e(str_replace(' ', '', $type)); ?>-tab" data-bs-toggle="pill"
                                            href="#<?php echo e(str_replace(' ', '', $type)); ?>" role="tab"
                                            aria-controls="<?php echo e(str_replace(' ', '', $type)); ?>" aria-selected="true">
                                            <?php echo e($type); ?>

                                        </a>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane fade show active" id="todos" role="tabpanel"
                                    aria-labelledby="todos-tab">
                                    <br>
                                    <div class="row widget-grid">
                                        <?php $__currentLoopData = $courses->take($p); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php
                                                $price = (float) ($item->price ?? 0);
                                                $priceLabel = $price <= 0 ? 'Gratis' : 'S/ ' . number_format($price, 2);
                                                $hasPublishedLanding = filled($item->course?->landing?->url_slug) && ($item->course?->landing?->is_published ?? false);
                                            ?>

                                            <div class="col-xl-4 col-md-6 col-sm-12 box-col-4">
                                                <div class="card weekend-card">
                                                    <div class="card-body">
                                                        <?php if($hasPublishedLanding): ?>
                                                            <a href="<?php echo e(route('course_url_slug', $item->course?->landing?->url_slug)); ?>">
                                                                <img class="w-100 mb-3"
                                                                    src="<?php echo e(asset('storage/' . $item->course->image)); ?>"
                                                                    alt="">
                                                            </a>
                                                        <?php else: ?>
                                                            <a href="<?php echo e(route('web_course_description', $item->id)); ?>">
                                                                <img class="w-100 mb-3"
                                                                    src="<?php echo e(asset('storage/' . $item->course->image)); ?>"
                                                                    alt="">
                                                            </a>
                                                        <?php endif; ?>

                                                        <span style="color: #e30613;"><?php echo e($item->additional); ?></span>
                                                        <br>
                                                        <?php if($hasPublishedLanding): ?>
                                                        <a href="<?php echo e(route('course_url_slug', $item->course?->landing?->url_slug)); ?>"
                                                            style="text-decoration: none;">
                                                            <h4 style=" height: 30px;"><?php echo e($item->name); ?>

                                                            </h4>
                                                        </a>
                                                        <?php else: ?>
                                                        <a href="<?php echo e(route('web_course_description', $item->id)); ?>"
                                                            style="text-decoration: none;">
                                                            <h4 style=" height: 30px;"><?php echo e($item->name); ?>

                                                            </h4>
                                                        </a>
                                                        <?php endif; ?>
                                                        <br>
                                                        <div class="card">
                                                            <div class="">
                                                                <div class="btn-showcase">
                                                                    <?php if($hasPublishedLanding): ?>
                                                                        <a
                                                                            href="<?php echo e(route('course_url_slug', $item->course?->landing?->url_slug)); ?>">
                                                                            <button
                                                                                class="btn btn-pill btn-light btn-air-light btn-sm"
                                                                                type="button"
                                                                                data-bs-original-title="btn btn-pill btn-light btn-air-light btn-sm">
                                                                                Leer Más
                                                                            </button>
                                                                        </a>
                                                                <?php else: ?>
                                                                        <a
                                                                            href="<?php echo e(route('web_course_description', $item->id)); ?>">
                                                                            <button
                                                                                class="btn btn-pill btn-light btn-air-light btn-sm"
                                                                                type="button"
                                                                                data-bs-original-title="btn btn-pill btn-light btn-air-light btn-sm">
                                                                                Leer Más
                                                                            </button>
                                                                        </a>
                                                                <?php endif; ?>

                                                                    <a
                                                                        onclick="agregarAlCarrito({ id: <?php echo e($item->id); ?>, nombre: '<?php echo e($item->name); ?>', precio: <?php echo e($item->price); ?> })">
                                                                        <button
                                                                            class="btn btn-pill btn-primary btn-air-primary btn-sm"
                                                                            type="button"
                                                                            data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                                                            <i class="fa fa-cart-plus"
                                                                                aria-hidden="true"
                                                                                style="font-size: 18px;"></i>
                                                                            &nbsp; <?php echo e($priceLabel); ?>

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
                                </div>
                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div hidden class="tab-pane fade show active"
                                        id="<?php echo e(str_replace(' ', '', $type)); ?>" role="tabpanel"
                                        aria-labelledby="<?php echo e(str_replace(' ', '', $type)); ?>-tab">
                                        <br>
                                        <div class="row widget-grid">
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(strtolower($item->additional) == strtolower($type)): ?>
                                                    <?php
                                                        $price = (float) ($item->price ?? 0);
                                                        $priceLabel = $price <= 0 ? 'Gratis' : 'S/ ' . number_format($price, 2);
                                                        $hasPublishedLanding = filled($item->course?->landing?->url_slug) && ($item->course?->landing?->is_published ?? false);
                                                    ?>
                                                    <div class="col-xl-4 col-md-6 col-sm-12 box-col-4">
                                                        <div class="card weekend-card">
                                                            <div class="card-body">
                                                                <?php if($hasPublishedLanding): ?>
                                                                <a
                                                                    href="<?php echo e(route('course_url_slug', $item->course?->landing?->url_slug)); ?>">
                                                                    <?php if($item->course?->image): ?>
                                                                        <img class="w-100 mb-3" src="<?php echo e(asset('storage/' . $item->course->image)); ?>" alt="">
                                                                    <?php endif; ?>
                                                                </a>
                                                                <?php else: ?>
                                                                    <a
                                                                        href="<?php echo e(route('web_course_description', $item->id)); ?>">
                                                                        <?php if($item->course?->image): ?>
                                                                            <img class="w-100 mb-3" src="<?php echo e(asset('storage/' . $item->course->image)); ?>" alt="">
                                                                        <?php endif; ?>
                                                                    </a>
                                                                <?php endif; ?>

                                                                <br>
                                                                <span
                                                                    style="color: #6a4c93;"><?php echo e($item->additional); ?></span>
                                                                <br>
                                                                <a href="<?php echo e(route('web_course_description', $item->id)); ?>"
                                                                    style="text-decoration: none;">
                                                                    <h4 style=" height: 30px; color: #000;">
                                                                        <?php echo e($item->name); ?></h4>
                                                                </a>
                                                                <br>
                                                                <div class="card">
                                                                    <div class="">
                                                                        <div class="btn-showcase">
                                                                            <?php if($hasPublishedLanding): ?>
                                                                                <a
                                                                                    href="<?php echo e(route('course_url_slug', $item->course?->landing?->url_slug)); ?>">
                                                                                    <button
                                                                                        class="btn btn-pill btn-light btn-air-light btn-sm"
                                                                                        type="button"
                                                                                        data-bs-original-title="btn btn-pill btn-light btn-air-light btn-sm">
                                                                                        Leer Más
                                                                                    </button>
                                                                                </a>
                                                                            <?php else: ?>
                                                                            <a
                                                                                href="<?php echo e(route('web_course_description', $item->id)); ?>">
                                                                                <button
                                                                                    class="btn btn-pill btn-light btn-air-light btn-sm"
                                                                                    type="button"
                                                                                    data-bs-original-title="btn btn-pill btn-light btn-air-light btn-sm">
                                                                                    Leer Más
                                                                                </button>
                                                                            </a>
                                                                            <?php endif; ?>

                                                                            <a
                                                                                onclick="agregarAlCarrito({ id: <?php echo e($item->id); ?>, nombre: '<?php echo e($item->name); ?>', precio: <?php echo e($item->price); ?> })">
                                                                                <button
                                                                                    class="btn btn-pill btn-primary btn-air-primary btn-sm"
                                                                                    type="button"
                                                                                    data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                                                                    <i class="fa fa-cart-plus"
                                                                                        aria-hidden="true"
                                                                                        style="font-size: 18px;"></i>
                                                                                    &nbsp; <?php echo e($priceLabel); ?>

                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="btn-showcase" style="text-align: center;">
                                        <a href="<?php echo e(route('web_courses')); ?>">
                                            <button class="btn btn-pill btn-primary btn-air-primary btn-sm"
                                                type="button"
                                                data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                                <i class="fa fa-graduation-cap" aria-hidden="true"
                                                    style="font-size: 18px;"></i>
                                                &nbsp; Ver Toda Nuestra Formación
                                            </button>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-4"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <script>
                // window.onload = function() {
                //     // Espera 1 segundo para mejorar la experiencia de usuario
                //     setTimeout(function() {
                //         // Redirecciona a la misma URL con el fragmento #todos al final
                //         window.location.href = window.location.href.split('#')[0] + '#todos';
                //     }, 500);
                // };

                function unhidden(id) {
                    // 1. Obtener el elemento por su ID
                    const miElemento = document.getElementById(id);

                    // 2. Eliminar el atributo 'hidden'
                    miElemento.removeAttribute('hidden');
                    document.getElementById('paginator').hidden = true;
                }

                function show_paginator() {
                    document.getElementById('paginator').removeAttribute('hidden');
                }
            </script>
        </div>
    </section>
</div>
<?php /**PATH D:\laragon\www\globalcpa\resources\views/components/courses/list-card.blade.php ENDPATH**/ ?>