<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['landing']));

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

foreach (array_filter((['landing']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php if(filled($landing->study_plan_section ?? null)): ?>
    <style>
        .text-navy-custom { color: #002060 !important; }
        :is(.dark, .dark-only) .text-navy-custom { color: #f6f7fb !important; }

        .bg-badge-custom { background-color: rgba(0, 32, 96, 0.1) !important; }
        :is(.dark, .dark-only) .bg-badge-custom { background-color: rgba(246, 247, 251, 0.1) !important; }

        .img-border-custom { border: 8px solid #f8f9fa !important; }
        :is(.dark, .dark-only) .img-border-custom { border: 8px solid #1d273a !important; }

        .iteration-badge {
            width: 45px;
            height: 45px;
            background-color: #002060 !important;
            font-size: 1.1rem;
        }
        :is(.dark, .dark-only) .iteration-badge {
            background-color: #ffc107 !important;
            color: #002060 !important;
        }
    </style>

    <div class="container-fluid card aos-animate border-0 shadow-sm" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <!-- Header de Sección -->
                    <div class="text-center mb-5">
                        <span class="badge rounded-pill bg-badge-custom text-navy-custom px-3 py-2 mb-3 shadow-sm border"
                            style="font-size: 14px; font-weight: 600;">
                            <i class="fa-solid fa-list-ul me-1"></i> <?php echo e($landing->study_plan_section['name']); ?>

                        </span>
                        <h2 class="fw-bold display-6 text-navy-custom"><?php echo e($landing->study_plan_section['title']); ?></h2>
                        <p class="text-muted fs-5 mx-auto" style="max-width: 800px;"><?php echo e($landing->study_plan_section['description']); ?></p>
                    </div>

                    <div class="row align-items-center">
                        <!-- Columna de Imagen -->
                        <div class="col-lg-5 mb-4 mb-lg-0" data-aos="fade-right">
                            <div class="position-relative">
                                <img loading="lazy" decoding="async" src="<?php echo e(asset("storage/".$landing->study_plan_section['image'])); ?>"
                                    alt="Temario Especializado" class="img-fluid rounded-4 shadow-lg img-border-custom">
                                <div
                                    class="position-absolute bottom-0 start-0 m-3 p-3 bg-warning rounded-3 shadow d-none d-sm-block">
                                    <span class="fw-bold text-dark" style="font-size: 15px;">Módulos 100% Actualizados</span>
                                </div>
                            </div>
                        </div>

                        <!-- Columna de Temas -->
                        <div class="col-lg-7" data-aos="fade-left">
                            <div class="ps-lg-4">

                                <?php if(filled($landing->study_plan_section['items'] ?? null)): ?>
                                    <?php $__currentLoopData = $landing->study_plan_section['items']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <div class="d-flex mb-4">
                                            <div class="flex-shrink-0">
                                                <span
                                                    class="badge rounded-circle d-flex align-items-center justify-content-center shadow iteration-badge"><?php echo e($loop->iteration); ?></span>
                                            </div>
                                            <div class="ms-3">
                                                <h5 class="fw-bold text-navy-custom" style="font-size: 20px;"><?php echo e($item['title']); ?></h5>
                                                <p class="text-muted" style="font-size: 15px;"><?php echo e($item['description']); ?></p>
                                            </div>
                                        </div>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endif; ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH C:\laragon\www\globalcpa\resources\views\components\courselanding\study-plan.blade.php ENDPATH**/ ?>