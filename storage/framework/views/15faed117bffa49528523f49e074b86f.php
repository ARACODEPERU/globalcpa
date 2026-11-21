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

<?php if(filled($landing->testimonials_section ?? null)): ?>
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
    </style>

    <div class="container-fluid card border-0 shadow-sm aos-animate mt-5" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <!-- Header de Sección -->
                    <div class="text-center mb-4">
                        <span class="badge rounded-pill bg-badge-custom text-navy-custom px-3 py-2 mb-3 shadow-sm border"
                            style="font-size: 14px; font-weight: 600;">
                            <i class="fa-solid fa-quote-right me-1"></i>
                            <?php echo e($landing->testimonials_section['name']); ?>

                        </span>
                        <h2 class="fw-bold display-6 text-navy-custom">
                            <?php echo e($landing->testimonials_section['title']); ?></h2>
                        <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">
                            <?php echo e($landing->testimonials_section['description']); ?>

                        </p>
                    </div>

                    <style>
                        .testimonial-carousel-viewport {
                            overflow: hidden;
                            padding: 20px 0;
                            /* Espacio para sombras */
                            position: relative;
                            width: 100%;
                        }

                        .testimonial-carousel-track {
                            display: flex;
                            gap: 30px;
                            width: max-content;
                            animation: scroll-infinite-testimonials 60s linear infinite;
                            /* Velocidad ajustada */
                        }

                        .testimonial-carousel-track:hover {
                            animation-play-state: paused;
                        }

                        @keyframes scroll-infinite-testimonials {
                            0% {
                                transform: translateX(0);
                            }

                            50% {
                                transform: translateX(-50%);
                            }
                        }

                        .testimonial-card {
                            width: 350px;
                            /* Ancho fijo para las tarjetas de testimonio */
                            flex-shrink: 0;
                            border-radius: 15px;
                            padding: 30px;
                            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
                            border: 1px solid #edf2f7;
                            transition: all 0.3s ease;
                            display: flex;
                            flex-direction: column;
                            justify-content: space-between;
                            min-height: 250px;
                            /* Altura mínima para uniformidad */
                        }

                        :is(.dark, .dark-only) .testimonial-card {
                            border-color: #374558;
                            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
                        }

                        .testimonial-card:hover {
                            transform: translateY(-8px);
                            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
                        }

                        .testimonial-quote {
                            font-size: 1.1rem;
                            line-height: 1.6;
                            color: #343a40;
                            margin-bottom: 20px;
                            font-style: italic;
                        }
                        
                        :is(.dark, .dark-only) .testimonial-quote {
                            color: #b4b7c5;
                        }

                        .testimonial-author-info {
                            display: flex;
                            align-items: center;
                            margin-top: auto;
                            /* Empuja la info del autor hacia abajo */
                        }

                        .testimonial-avatar {
                            width: 60px;
                            height: 60px;
                            border-radius: 50%;
                            object-fit: cover;
                            margin-right: 15px;
                            border: 3px solid #007bff;
                        }

                        .testimonial-name {
                            font-weight: 700;
                            color: #002060;
                            font-size: 1rem;
                        }
                        
                        :is(.dark, .dark-only) .testimonial-name {
                            color: #f6f7fb;
                        }

                        .testimonial-title {
                            font-size: 0.85rem;
                            color: #6c757d;
                        }

                        :is(.dark, .dark-only) .testimonial-title {
                            color: #8a94ad;
                        }
                    </style>

                    <div class="testimonial-carousel-viewport">
                        <div class="testimonial-carousel-track">
                            <?php if(filled($landing->testimonials_section['items'] ?? null)): ?>
                                <?php
                                    $testimonials = $landing->testimonials_section['items'];
                                ?>
                                <?php $__currentLoopData = array_merge($testimonials, $testimonials); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $testimonial): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="testimonial-carousel-item">
                                        <div class="testimonial-card bg-item-custom mx-2">
                                            <p class="testimonial-quote">
                                                "<?php echo e($testimonial['description'] ?? ''); ?>"</p>
                                            <div class="testimonial-author-info">
                                                <?php if(isset($testimonial['image']) && !empty($testimonial['image'])): ?>
                                                    <img loading="lazy" decoding="async" src="<?php echo e(asset('storage/' . $testimonial['image'])); ?>"
                                                        alt="<?php echo e($testimonial['name'] ?? 'Usuario'); ?>"
                                                        class="testimonial-avatar">
                                                <?php endif; ?>
                                                <div>
                                                    <h5 class="testimonial-name" style="font-size: 20px;">
                                                        <?php echo e($testimonial['name'] ?? ''); ?></h5>
                                                    <p class="testimonial-title" style="font-size: 15px;">
                                                        <?php echo e($testimonial['presentation'] ?? ''); ?></p>
                                                </div>
                                            </div>
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
<?php endif; ?><?php /**PATH C:\laragon\www\globalcpa\resources\views\components\courselanding\testimonials.blade.php ENDPATH**/ ?>