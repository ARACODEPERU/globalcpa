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

<br>

<div class="container-fluid mt-8">
    <div class="card border-0 overflow-hidden shadow mb-4"
        style="background: linear-gradient(135deg, #002060 0%, #004080 100%); border-radius: 15px;"
        data-aos="fade-in">

        <div class="card-body text-white">
            <div class="row align-items-center">

                <div class="col-lg-8 p-4 p-lg-5">

                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-warning text-dark me-2">
                            <?php echo e($landing->course->category->description ?? 'Categoría'); ?>

                        </span>

                        <div class="text-warning small">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                    </div>

                    <h1 class="display-5 fw-bold mb-3 text-white">
                        <?php echo e($landing->course->description ?? 'Curso'); ?>

                    </h1>

                    <?php
                        $startDate = $landing->banner_start_date
                            ? \Carbon\Carbon::parse($landing->banner_start_date)
                            : now();

                        $endDate = $landing->banner_end_date
                            ? \Carbon\Carbon::parse($landing->banner_end_date)
                            : now()->addMonths(1);

                        $totalDays = $startDate->diffInDays($endDate) + 1;

                        if ($totalDays < 30) {
                            $daysRounded = ceil($totalDays);
                            $duration = $daysRounded . ' día(s)';
                        } elseif ($totalDays < 365) {
                            $totalMonths = $startDate->diffInMonths($endDate);
                            $monthsRounded = ceil($totalMonths);
                            $duration = $monthsRounded . ' mes(es)';
                        } else {
                            $totalYears = floor($totalDays / 365);
                            $remainingMonths = floor(($totalDays % 365) / 30);

                            if ($remainingMonths > 0) {
                                $duration = $totalYears . ' año(s) ' . $remainingMonths . ' mes(es)';
                            } else {
                                $duration = $totalYears . ' año(s)';
                            }
                        }
                    ?>

                    <div class="d-flex flex-wrap align-items-center text-white-50">

                        <span class="me-3 mb-2">
                            <i class="fa-solid fa-clock me-1"></i>

                            Inicio:
                            <?php echo e($startDate->locale('es')->isoFormat('D [de] MMMM')); ?>


                            |

                            Duración:
                            <?php echo e($duration); ?>


                            |

                            Modalidad:
                            <?php echo e($landing->course->modality->description ?? 'Modalidad'); ?>

                        </span>

                        <span class="mb-2">
                            <i class="fa-solid fa-earth-americas me-1"></i>

                            <?php echo e([
                                    'es' => 'Español',
                                    'en' => 'Inglés',
                                    'zh' => 'Mandarín'
                                ][$landing->banner_language] ?? $landing->banner_language); ?>

                        </span>

                    </div>

                </div>

                <div class="col-12 col-lg-4 d-flex align-items-center justify-content-center p-3 pt-0 pt-lg-3">

                    <?php if(filled($landing->banner_video_link ?? null)): ?>

                        <div class="w-100">
                            <div class="ratio ratio-16x9 rounded overflow-hidden">
                                <?php echo \App\Support\LazyContent::process($landing->banner_video_link); ?>

                            </div>
                        </div>

                    <?php else: ?>

                        <img
                            fetchpriority="high"
                            src="<?php echo e(asset('storage/'.$landing->course->image)); ?>"
                            alt="<?php echo e($landing->course->description ?? 'Curso'); ?>"
                            class="img-fluid rounded"
                            style="
                                width: 100%;
                                height: auto;
                                max-width: 100%;
                                object-fit: contain;
                                display: block;
                            "
                            loading="lazy"
                            decoding="async"
                        >

                    <?php endif; ?>

                </div>

            </div>
        </div>

    </div>
</div>
<?php /**PATH C:\laragon\www\globalcpa\resources\views\components\courselanding\hero.blade.php ENDPATH**/ ?>