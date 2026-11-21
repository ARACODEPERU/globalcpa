<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['landing', 'colors']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['landing', 'colors']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(filled($landing->results_section ?? null)): ?>
    <style>
        .text-navy-custom { color: #002060 !important; }
        :is(.dark, .dark-only) .text-navy-custom { color: #f6f7fb !important; }

        .bg-item-custom { background-color: #ffffff !important; }
        :is(.dark, .dark-only) .bg-item-custom {
            background-color: #1d273a !important;
            border-color: #374558 !important;
        }

        .fa-solid, .fas {
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
        }
            /* Insignia verde legible tambien en modo oscuro */
        .badge-green-custom {
            background-color: rgba(40, 167, 69, 0.1) !important;
            color: #28a745 !important;
        }
        :is(.dark, .dark-only) .badge-green-custom {
            background-color: rgba(40, 167, 69, 0.22) !important;
            color: #86efac !important;
        }
    </style>

    <div class="container-fluid card border-0 shadow-sm aos-animate" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-5">
                        <span class="badge badge-green-custom rounded-pill px-3 py-2 mb-3 shadow-sm border"
                            style="font-size: 14px; font-weight: 600;">
                            <i class="fa-solid fa-circle-check me-1"></i> <?php echo e($landing->results_section['name']); ?>

                        </span>
                        <h2 class="fw-bold display-6 text-navy-custom">
                            <?php echo e($landing->results_section['title']); ?>

                        </h2>
                        <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">
                            <?php echo e($landing->results_section['description']); ?>

                        </p>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-center">

                        <?php if(filled($landing->results_section['items'] ?? null)): ?>
                            <?php $__currentLoopData = $landing->results_section['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="col" data-aos="fade-up"
                                    data-aos-delay="<?php echo e(100 * ($loop->index + 1)); ?>">
                                    <div class="h-100 p-4 rounded-4 border-0 shadow-sm text-center bg-item-custom transition-all position-relative overflow-hidden"
                                        style="border-top: 5px solid <?php echo e($colors[$loop->index]); ?> !important;">

                                        
                                        <div class="position-absolute opacity-0 transition-all"
                                            style="width: 100px; height: 100px; background-color: <?php echo e($colors[$loop->index]); ?>; border-radius: 50%; top: -20px; right: -20px; opacity: 0.05 !important;">
                                        </div>

                                        <div class="mb-4 d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm"
                                            style="width: 70px; height: 70px; background-color: rgba(255,255,255,0.8); border: 1px solid #f1f1f1;">
                                            <i class="fa-solid fa-<?php echo e(str_replace('fa-', '', $item['icon'])); ?>"
                                                style="font-size: 2rem; color: <?php echo e($colors[$loop->index]); ?>;"></i>
                                        </div>

                                        <h4 class="fw-bold mb-2 text-navy-custom" style="font-size: 20px;">
                                            <?php echo e($item['title']); ?></h4>
                                        <p class="text-muted mb-0 small" style="line-height: 1.6; font-size: 15px;">
                                            <?php echo e($item['description']); ?>

                                        </p>
                                    </div>
                                </div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH C:\laragon\www\globalcpa\resources\views\components\courselanding\results.blade.php ENDPATH**/ ?>