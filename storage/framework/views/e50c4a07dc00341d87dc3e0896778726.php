<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['testimonials' => [], 'course' => null, 'schema' => null]));

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

foreach (array_filter((['testimonials' => [], 'course' => null, 'schema' => null]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<?php
    $items = collect($testimonials);
?>


<?php if(!empty($schema)): ?>
    <script type="application/ld+json">
        <?php echo json_encode($schema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT); ?>

    </script>
<?php endif; ?>

<?php if($items->isNotEmpty()): ?>
    <style>
        .ct-section .text-navy-custom { color: #002060 !important; }
        :is(.dark, .dark-only) .ct-section .text-navy-custom { color: #f6f7fb !important; }

        .ct-card {
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid #edf2f7;
            border-radius: 18px;
            padding: 26px 24px;
            background: #ffffff;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        :is(.dark, .dark-only) .ct-card {
            background: #1d273a;
            border-color: #374558;
        }
        .ct-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 15px 35px rgba(0, 32, 96, 0.12);
        }
        .ct-card .ct-stars { color: #ffc107; font-size: 0.9rem; margin-bottom: 12px; }
        .ct-card .ct-quote-mark {
            color: #e30613;
            font-size: 1.9rem;
            line-height: 1;
            font-family: Georgia, serif;
            margin-bottom: 8px;
        }
        .ct-card .ct-text {
            font-size: 0.95rem;
            line-height: 1.7;
            color: #4b5563;
            font-style: italic;
            flex: 1;
        }
        :is(.dark, .dark-only) .ct-card .ct-text { color: #9ca3af; }
        .ct-card .ct-read-more {
            background: none;
            border: none;
            padding: 0;
            margin-top: 8px;
            color: #002060;
            font-weight: 700;
            font-size: 0.82rem;
        }
        :is(.dark, .dark-only) .ct-card .ct-read-more { color: #93c5fd; }
        .ct-card .ct-read-more:hover { color: #e30613; }
        .ct-card .ct-author {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-top: 20px;
            padding-top: 18px;
            border-top: 1px dashed rgba(128, 128, 128, 0.25);
        }
        .ct-card .ct-avatar {
            width: 52px;
            height: 52px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #002060;
            flex-shrink: 0;
        }
        :is(.dark, .dark-only) .ct-card .ct-avatar { border-color: #93c5fd; }
        .ct-card .ct-name { font-weight: 700; font-size: 0.96rem; margin-bottom: 2px; }
        .ct-card .ct-role { font-size: 0.82rem; color: #6b7280; }
        :is(.dark, .dark-only) .ct-card .ct-role { color: #9ca3af; }
        .ct-card .ct-video-btn {
            margin-top: 14px;
            align-self: flex-start;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            border: none;
            border-radius: 50px;
            padding: 8px 18px;
            background: #e30613;
            color: #ffffff;
            font-weight: 700;
            font-size: 0.82rem;
        }
        .ct-card .ct-video-btn:hover { background: #c00511; color: #ffffff; }
        .ct-video-modal .modal-content { border: none; border-radius: 16px; overflow: hidden; }
        .ct-video-modal .modal-header { background: #002060; color: #ffffff; border-bottom: 0; }
        .ct-video-modal .modal-header .btn-close { filter: invert(1); opacity: 0.85; }
    </style>

    <div class="container-fluid card border-0 shadow-sm mt-5 ct-section" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-4">
                        <span class="badge rounded-pill bg-badge-custom text-navy-custom px-3 py-2 mb-3 shadow-sm border"
                            style="font-size: 14px; font-weight: 600;">
                            <i class="fa-solid fa-star me-1"></i>
                            Opiniones de alumnos
                        </span>
                        <h2 class="fw-bold display-6 text-navy-custom">Lo que dicen de este curso</h2>
                        <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">
                            Testimonios reales de alumnos que ya llevaron
                            <?php echo e($course?->description ?: 'este programa'); ?>.
                        </p>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $quote = (string) ($t['quote'] ?? '');
                                $quoteLimit = 260;
                                $isLongQuote = mb_strlen($quote) > $quoteLimit;
                                $quoteShort = $isLongQuote ? \Illuminate\Support\Str::substr($quote, 0, $quoteLimit) : $quote;
                                $quoteRest = $isLongQuote ? \Illuminate\Support\Str::substr($quote, $quoteLimit) : '';
                            ?>
                            <div class="col">
                                <div class="ct-card shadow-sm">
                                    <div class="ct-stars">
                                        <?php for($i = 1; $i <= 5; $i++): ?>
                                            <i class="fa fa-star<?php echo e($i <= ($t['rating'] ?? 5) ? '' : '-o'); ?>"></i>
                                        <?php endfor; ?>
                                    </div>
                                    <div class="ct-quote-mark">"</div>
                                    <p class="ct-text">
                                        <?php echo e($quoteShort); ?><?php if($isLongQuote): ?><span class="collapse" id="ctQuote<?php echo e($t['id']); ?>"><?php echo e($quoteRest); ?></span><?php endif; ?>
                                    </p>
                                    <?php if($isLongQuote): ?>
                                        <button type="button"
                                            class="ct-read-more"
                                            data-bs-toggle="collapse"
                                            data-bs-target="#ctQuote<?php echo e($t['id']); ?>"
                                            aria-expanded="false">
                                            <i class="fa fa-chevron-down"></i> Leer más
                                        </button>
                                    <?php endif; ?>

                                    <div class="ct-author">
                                        <img src="<?php echo e($t['photo'] ?: $t['avatar']); ?>"
                                            alt="<?php echo e($t['author']); ?>" class="ct-avatar" loading="lazy" decoding="async">
                                        <div>
                                            <p class="ct-name text-navy-custom mb-0"><?php echo e($t['author']); ?></p>
                                            <p class="ct-role mb-0"><?php echo e($t['role']); ?></p>
                                        </div>
                                    </div>

                                    <?php if(!empty($t['video'])): ?>
                                        <button type="button"
                                            class="ct-video-btn"
                                            data-bs-toggle="modal"
                                            data-bs-target="#ctVideo<?php echo e($t['id']); ?>">
                                            <i class="fa fa-play"></i> Ver video
                                        </button>
                                    <?php endif; ?>
                                </div>
                            </div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>

    
    <?php $__currentLoopData = $items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php if(!empty($t['video'])): ?>
            <div class="modal fade ct-video-modal" id="ctVideo<?php echo e($t['id']); ?>" tabindex="-1"
                aria-labelledby="ctVideo<?php echo e($t['id']); ?>Label" aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title h6" id="ctVideo<?php echo e($t['id']); ?>Label">
                                <?php echo e($t['author']); ?> · <?php echo e(\Illuminate\Support\Str::limit($t['program'], 70)); ?>

                            </h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body p-0 bg-black">
                            <div class="ratio ratio-16x9">
                                <?php echo \App\Support\LazyContent::process($t['video']); ?>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endif; ?>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH C:\laragon\www\globalcpa\resources\views\components\courselanding\course-testimonials.blade.php ENDPATH**/ ?>