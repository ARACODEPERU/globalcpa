<?php $__env->startSection('title', ' - Blog'); ?>

<?php $__env->startSection('etiquetasmeta'); ?>
    <?php if (isset($component)) { $__componentOriginal42da61123f891e63201d7be28f403427 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal42da61123f891e63201d7be28f403427 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.seo','data' => ['title' => 'Blog de CPA Academy','description' => 'Artículos y novedades de CPA Academy sobre contabilidad, finanzas, auditoría, NIIF y actualización profesional, escritos por expertos en activo.']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('seo'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Blog de CPA Academy','description' => 'Artículos y novedades de CPA Academy sobre contabilidad, finanzas, auditoría, NIIF y actualización profesional, escritos por expertos en activo.']); ?>
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

    <style>
        .loader-wrapper {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            z-index: 999999;
        }

        .loader-logo {
            width: 220px;
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

            0%,
            100% {
                content: '';
            }

            25% {
                content: '.';
            }

            50% {
                content: '..';
            }

            75% {
                content: '...';
            }
        }

        @keyframes pulse-logo {
            0% {
                transform: scale(0.9);
                opacity: 0.8;
            }

            50% {
                transform: scale(1.05);
                opacity: 1;
            }

            100% {
                transform: scale(0.9);
                opacity: 0.8;
            }
        }

        .blog-hero {
            background: linear-gradient(135deg, #002060 0%, #1a3a7a 100%);
            color: #fff;
            padding: 60px 0 40px;
            text-align: center;
        }
        .blog-hero h1 {
            font-size: 2.2rem;
            font-weight: 700;
            text-transform: uppercase;
            text-align: center;
            color: #fff;
        } 

        .blog-hero p {
            font-size: 1.1rem;
            opacity: 0.85;
        }

        .blog-card {
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s ease;
            background: #fff;
            height: 100%;
            display: flex;
            flex-direction: column;
        }

        .blog-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 12px 24px rgba(0, 0, 0, 0.1);
        }

        .blog-card .card-img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .blog-card .card-body {
            padding: 20px;
            flex: 1;
            display: flex;
            flex-direction: column;
        }

        .blog-card .card-category {
            display: inline-block;
            background: #eef2ff;
            color: #4338ca;
            font-size: 0.75rem;
            font-weight: 600;
            padding: 3px 10px;
            border-radius: 20px;
            margin-bottom: 10px;
            text-transform: uppercase;
        }

        .blog-card .card-title {
            font-size: 1.1rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
            line-height: 1.4;
        }

        .blog-card .card-title a {
            color: inherit;
            text-decoration: none;
        }

        .blog-card .card-title a:hover {
            color: #e30613;
        }

        .blog-card .card-desc {
            font-size: 0.9rem;
            color: #6b7280;
            line-height: 1.5;
            flex: 1;
        }

        .blog-card .card-meta {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 15px;
            padding-top: 12px;
            border-top: 1px solid #f3f4f6;
            font-size: 0.8rem;
            color: #9ca3af;
        }

        .blog-card .card-meta .author {
            font-weight: 500;
            color: #374151;
        }

        .blog-sidebar-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .blog-sidebar-box h5 {
            font-size: 1rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e30613;
        }

        .blog-sidebar-box ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .blog-sidebar-box ul li {
            margin-bottom: 8px;
        }

        .blog-sidebar-box ul li a {
            color: #4b5563;
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.2s;
        }

        .blog-sidebar-box ul li a:hover {
            color: #e30613;
        }

        .blog-latest-item {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
            align-items: center;
        }

        .blog-latest-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .blog-latest-item .latest-info a {
            font-size: 0.85rem;
            font-weight: 500;
            color: #1f2937;
            text-decoration: none;
            line-height: 1.3;
            display: block;
        }

        .blog-latest-item .latest-info a:hover {
            color: #e30613;
        }

        .blog-latest-item .latest-info span {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        .blog-pagination .pagination {
            justify-content: center;
            gap: 6px;
        }

        .blog-pagination .page-link {
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            padding: 8px 14px;
            color: #374151;
            font-size: 0.9rem;
            transition: all 0.2s;
        }

        .blog-pagination .page-link:hover {
            background: #e30613;
            color: #fff;
            border-color: #e30613;
        }

        .blog-pagination .page-item.active .page-link {
            background: #e30613;
            color: #fff;
            border-color: #e30613;
        }

        body.dark-only .blog-card {
            background: #1f2937;
            border-color: #374155;
        }

        body.dark-only .blog-card .card-title {
            color: #f3f4f6;
        }

        body.dark-only .blog-card .card-title a:hover {
            color: #e30613;
        }

        body.dark-only .blog-card .card-desc {
            color: #9ca3af;
        }

        body.dark-only .blog-sidebar-box {
            background: #111827;
            border-color: #374558;
        }

        body.dark-only .blog-sidebar-box h5 {
            color: #f3f4f6;
        }

        body.dark-only .blog-sidebar-box ul li a {
            color: #d1d5db;
        }

        body.dark-only .blog-sidebar-box details.blog-cat {
            border-bottom-color: #374558;
        }

        body.dark-only .blog-sidebar-box details.blog-cat summary {
            color: #f3f4f6;
        }

        body.dark-only .blog-sidebar-box details.blog-cat .cat-article-item a {
            color: #d1d5db;
        }

        body.dark-only .blog-sidebar-box details.blog-cat .cat-article-item a:hover {
            color: #e30613;
        }

        body.dark-only .blog-sidebar-box .blog-latest-item .latest-info a {
            color: #d1d5db;
        }

        body.dark-only .blog-card .card-meta .author {
            color: #d1d5db;
        }

        body.dark-only .blog-hero {
            background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
        }
    </style>

    <!-- Loader -->
    <div class="loader-wrapper">
        <img src="<?php echo e(asset('themes/webpage/images/Logo_cpa_modificado.png')); ?>" alt="CPA Logo" class="loader-logo">
        <p class="loader-text">Cargando</p>
    </div>

    <!-- tap on top -->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>

    <div class="page-wrapper" id="pageWrapper">
        <!-- Header -->
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

        <div class="page-body-wrapper">
            <!-- Sidebar -->
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

            <div class="page-body">
                <br>

                <!-- Hero Banner -->
                <div class="blog-hero" data-aos="fade-in">
                    <div class="container">
                        <h1>Blog CPA Academy</h1>
                        <p>Artículos, noticias y recursos para tu formación profesional</p>
                    </div>
                </div>

                <div class="container mt-5">
                    <div class="row g-4">
                        <!-- Columna Principal: Artículos -->
                        <div class="col-lg-8 col-md-8">
                            <div class="row g-4" data-aos="fade-up">
                                <?php $__empty_1 = true; $__currentLoopData = $articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $article): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <div class="col-lg-6 col-md-6">
                                        <div class="blog-card">
                                            <a href="<?php echo e(route('blog_article_by_url', $article->url)); ?>">
                                                <img src="<?php echo e($article->imagen); ?>" alt="<?php echo e($article->title); ?>"
                                                    class="card-img">
                                            </a>
                                            <div class="card-body">
                                                <?php if($article->category): ?>
                                                    <span class="card-category"><?php echo e($article->category->description); ?></span>
                                                <?php endif; ?>
                                                <h3 class="card-title">
                                                    <a
                                                        href="<?php echo e(route('blog_article_by_url', $article->url)); ?>"><?php echo e($article->title); ?></a>
                                                </h3>
                                                <p class="card-desc">
                                                    <?php echo e(Str::limit(strip_tags(html_entity_decode($article->short_description ?? $article->content_text, ENT_QUOTES, "UTF-8")), 120)); ?>

                                                </p>
                                                <div class="card-meta">
                                                    <span class="author">
                                                        <?php if($article->author): ?>
                                                            <i class="fa fa-user me-1"></i><?php echo e($article->author->name); ?>

                                                        <?php endif; ?>
                                                    </span>
                                                    <span>
                                                        <i
                                                            class="fa fa-calendar me-1"></i><?php echo e(\Carbon\Carbon::parse($article->created_at)->format('d M Y')); ?>

                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <div class="col-12 text-center py-5">
                                        <i class="fa fa-newspaper fa-3x text-muted mb-3"></i>
                                        <h4 class="text-muted">No hay artículos publicados</h4>
                                        <p class="text-muted">Próximamente publicaremos contenido interesante.</p>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Paginación -->
                            <?php if($articles->hasPages()): ?>
                                <div class="blog-pagination mt-4" data-aos="fade-up">
                                    <?php echo e($articles->links()); ?>

                                </div>
                            <?php endif; ?>
                        </div>

                        <!-- Sidebar Derecho -->
                        <div class="col-lg-4 col-md-4">

                            <style>
                                #blogCategoriesAccordion .accordion-button::after {
                                    display: none !important;
                                }

                                #blogCategoriesAccordion .accordion-button:not(.collapsed) {
                                    background-color: transparent;
                                    color: #1f2937;
                                }

                                #blogCategoriesAccordion .accordion-button:focus {
                                    box-shadow: none;
                                }
                            </style>

                            <!-- Categorías -->
                            <div class="blog-sidebar-box" data-aos="fade-up">
                                <h5><i class="fa fa-folder-open me-2"></i>Categorías</h5>
                                <style>
                                    details.blog-cat {
                                        border-bottom: 1px solid #f3f4f6;
                                    }

                                    details.blog-cat summary {
                                        cursor: pointer;
                                        padding: 10px 0;
                                        font-size: 0.9rem;
                                        font-weight: 600;
                                        color: #1f2937;
                                        list-style: none;
                                        display: flex;
                                        align-items: center;
                                        justify-content: space-between;
                                    }

                                    details.blog-cat summary::-webkit-details-marker {
                                        display: none;
                                    }

                                    details.blog-cat summary::after {
                                        content: "\25B6";
                                        font-size: 0.6rem;
                                        color: #9ca3af;
                                        transition: transform 0.2s;
                                    }

                                    details.blog-cat[open] summary::after {
                                        transform: rotate(90deg);
                                    }

                                    details.blog-cat .cat-articles {
                                        padding: 5px 0 10px 0;
                                    }

                                    details.blog-cat .cat-article-item {
                                        display: flex;
                                        align-items: start;
                                        gap: 10px;
                                        margin-bottom: 8px;
                                    }

                                    details.blog-cat .cat-article-item img {
                                        width: 40px;
                                        height: 40px;
                                        object-fit: cover;
                                        border-radius: 6px;
                                        flex-shrink: 0;
                                    }

                                    details.blog-cat .cat-article-item a {
                                        font-size: 0.8rem;
                                        font-weight: 500;
                                        color: #1f2937;
                                        line-height: 1.3;
                                        text-decoration: none;
                                        display: block;
                                    }

                                    details.blog-cat .cat-article-item a:hover {
                                        color: #e30613;
                                    }

                                    details.blog-cat .cat-article-item span {
                                        font-size: 0.7rem;
                                        color: #9ca3af;
                                    }

                                    details.blog-cat .ver-mas-btn {
                                        display: block;
                                        padding: 8px 0 0 0;
                                        font-size: 0.8rem;
                                        font-weight: 600;
                                        color: #e30613;
                                        cursor: pointer;
                                        border: none;
                                        background: none;
                                        text-decoration: none;
                                    }

                                    details.blog-cat .ver-mas-btn:hover {
                                        text-decoration: underline;
                                    }

                                    details.blog-cat .cat-badge {
                                        font-size: 0.7rem;
                                        min-width: 22px;
                                        text-align: center;
                                        background: #e30613;
                                        color: #fff;
                                        border-radius: 10px;
                                        padding: 1px 6px;
                                    }
                                </style>
                                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <details class="blog-cat">
                                        <summary>
                                            <span style="flex:1;"><?php echo e($category->description); ?></span>
                                            <span
                                                class="cat-badge"><?php echo e($articlesByCategory[$category->id]->count()); ?></span>
                                        </summary>
                                        <div class="cat-articles">
                                            <?php $catArticles = $articlesByCategory[$category->id]; ?>
                                            <?php $__empty_1 = true; $__currentLoopData = $catArticles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $catArticle): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                                <div class="cat-article-item cat-article-<?php echo e($category->id); ?>"
                                                    <?php if($index >= 5): ?> style="display:none;" <?php endif; ?>>
                                                    <img src="<?php echo e($catArticle->imagen); ?>" alt="">
                                                    <div>
                                                        <a
                                                            href="<?php echo e(route('blog_article_by_url', $catArticle->url)); ?>"><?php echo e(Str::limit($catArticle->title, 45)); ?></a>
                                                        <span><?php echo e(\Carbon\Carbon::parse($catArticle->created_at)->format('d M Y')); ?></span>
                                                    </div>
                                                </div>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                                <p class="text-muted" style="font-size:0.8rem;">No hay artículos</p>
                                            <?php endif; ?>
                                            <?php if(count($catArticles) > 5): ?>
                                                <a href="javascript:void(0);" class="ver-mas-btn"
                                                    onclick="toggleVerMas(this, <?php echo e($category->id); ?>, <?php echo e(count($catArticles)); ?>)">
                                                    Ver más... <span
                                                        style="font-size:0.7rem; color:#9ca3af;">(<?php echo e(count($catArticles) - 5); ?>

                                                        más)</span>
                                                </a>
                                            <?php endif; ?>
                                        </div>
                                    </details>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>

                            <!-- Últimos Artículos -->
                            <div class="blog-sidebar-box" data-aos="fade-up" data-aos-delay="100">
                                <h5><i class="fa fa-clock me-2"></i>Últimos Artículos</h5>
                                <?php $__currentLoopData = $latest_articles; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $latest): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <div class="blog-latest-item">
                                        <a href="<?php echo e(route('blog_article_by_url', $latest->url)); ?>">
                                            <img src="<?php echo e($latest->imagen); ?>" alt="<?php echo e($latest->title); ?>">
                                        </a>
                                        <div class="latest-info">
                                            <a
                                                href="<?php echo e(route('blog_article_by_url', $latest->url)); ?>"><?php echo e(Str::limit($latest->title, 50)); ?></a>
                                            <span><?php echo e(\Carbon\Carbon::parse($latest->created_at)->format('d M Y')); ?></span>
                                        </div>
                                    </div>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                        </div>
                    </div>
                </div>

                <br>
            </div>
        </div>

        <!-- Footer -->


        <script>
            function toggleVerMas(btn, catId, total) {
                var items = document.querySelectorAll('.cat-article-' + catId);
                var hidden = btn.dataset.expanded === 'true';
                if (!hidden) {
                    items.forEach(function(item) {
                        item.style.display = '';
                    });
                    btn.dataset.expanded = 'true';
                    btn.innerHTML = 'Ver menos <span style="font-size:0.7rem; color:#9ca3af;">(ocultar)</span>';
                } else {
                    items.forEach(function(item, i) {
                        if (i >= 5) item.style.display = 'none';
                    });
                    btn.dataset.expanded = 'false';
                    btn.innerHTML = 'Ver más... <span style="font-size:0.7rem; color:#9ca3af;">(' + (total - 5) +
                    ' más)</span>';
                }
            }
        </script>

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
            if (window.AOS !== undefined) {
                AOS.init({
                    mirror: false,
                    duration: 800,
                    once: true
                });
            }
            setTimeout(function() {
                $('.loader-wrapper').fadeOut('slow', function() {
                    $(this).remove();
                    if (window.AOS !== undefined) {
                        AOS.refresh();
                    }
                });
            }, 2500);
        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.webpage', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\globalcpa\resources\views/pages/blog.blade.php ENDPATH**/ ?>