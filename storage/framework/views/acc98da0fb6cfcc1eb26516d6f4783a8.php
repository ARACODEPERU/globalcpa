<div>
    <div class="sidebar-wrapper" data-layout="stroke-svg">
        <div>
            <div class="logo-wrapper">
                <a href="<?php echo e(route('index_main')); ?>">
                    <img class="img-fluid"
                        src="<?php echo e(asset('themes/webpage/images/Logo_isotipo_negativo.png')); ?>" alt="">
                </a>
                <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
            </div>
            <nav class="sidebar-main">
                <div id="sidebar-menu">
                    <ul class="sidebar-links" id="simple-bar">
                        <li class="back-btn">
                            <a href=""></a>
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                    aria-hidden="true"></i></div>
                        </li>
                        <li class="sidebar-main-title">
                            <div></div>
                        </li>
                        <li class="sidebar-list" style="padding: 15px 0px;">
                            <a class="sidebar-link sidebar-title" href="<?php echo e(route('index_main')); ?>">
                                <span>
                                    <i class="fa fa-home" aria-hidden="true" style="font-size: 26px;"></i><br>
                                    Home
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-list" style="padding: 15px 0px;">
                            <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                <span>
                                    <i class="fa fa-graduation-cap" aria-hidden="true" style="font-size: 26px;"></i><br>
                                    Formación
                                </span>
                            </a>
                            <ul class="sidebar-submenu custom-scrollbar">
                                <li class="sidebar-head">Formación</li>
                                <?php $__currentLoopData = $types; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $type): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <li class="main-submenu">
                                        <a class="d-flex sidebar-menu" href="javascript:void(0)">
                                            <svg class="stroke-icon">
                                                <use
                                                    href="<?php echo e(asset('themes/webpage/assets/svg/icon-sprite.svg#stroke-others')); ?>">
                                                </use>
                                            </svg>
                                            <svg class="fill-icon">
                                                <use
                                                    href="<?php echo e(asset('themes/webpage/assets/svg/icon-sprite.svg#stroke-others')); ?>">
                                                </use>
                                            </svg><?php echo e($type == 'Programas de Especialización' ? 'Especialización' : $type); ?>

                                            <svg class="arrow">
                                                <use
                                                    href="<?php echo e(asset('themes/webpage/assets/svg/icon-sprite.svg#Arrow-right')); ?>">
                                                </use>
                                            </svg>
                                        </a>
                                        <ul class="submenu-wrapper">
                                            <?php
                                                $x = 0;
                                            ?>
                                            <?php $__currentLoopData = $courses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $course): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if(strtolower($course->additional) == strtolower($type) && $x < $p): ?>
                                                    <li>
                                                        <?php
                                                            $landing = $course->course?->landing;
                                                            $hasPublishedLanding = filled($landing?->url_slug) && ($landing?->is_published ?? false);
                                                        ?>
                                                        <a class="truncated-link"
                                                            href="<?php echo e($hasPublishedLanding ? route('course_url_slug', $landing->url_slug) : route('web_course_description', $course->id)); ?>"
                                                            title="<?php echo e($course->name); ?>"><?php echo e($course->name); ?></a>
                                                    </li>
                                                    <?php
                                                        $x++;
                                                    ?>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                            <li>
                                                <div class="btn-showcase" style="text-align: center;">
                                                    <a href="<?php echo e(route('web_courses')); ?>">
                                                        <button class="btn btn-pill btn-primary btn-air-primary btn-sm"
                                                            type="button"
                                                            data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                                            <i class="fa fa-graduation-cap" aria-hidden="true"
                                                                style="font-size: 18px;"></i>
                                                            &nbsp; Ver Todos
                                                        </button>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

                            </ul>
                        </li>
                        

                        
                        
                        <li class="sidebar-list" style="padding: 15px 0px;">
                            <a class="sidebar-link sidebar-title" href="<?php echo e(route('web_book_amauta')); ?>">
                                <span>
                                    <i class="fa fa-book" aria-hidden="true" style="font-size: 26px;"></i><br>
                                    Publicación
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <style>
        /* Clase principal para truncar el texto */
        .truncated-link:first-letter {
            display: block;
            max-height: <?php echo e(1.2 * $lines); ?>em;
            /* Altura de 2 líneas (1.2em * 2) */
            line-height: 1.2em;
            overflow: hidden;
            position: relative;
            text-decoration: none;
            color: inherit;
            /* Agrega la transición a la altura máxima para una animación suave */
            transition: max-height 0.2s ease-in-out;
            text-transform: uppercase;
        }

        /* Pseudo-elemento para los puntos suspensivos */
        .truncated-link::after {
            content: "...";
            position: absolute;
            bottom: 0;
            right: 0;
            padding: 0 5px;
            background: transparent;
            color: inherit;
            transition: opacity 0.2s ease-in-out;
            opacity: 1;
        }

        /* Clase para mostrar el texto completo */
        .truncated-link.show-full {
            max-height: 200px;
            /* Un valor lo suficientemente grande para mostrar todo el texto */
            overflow: visible;
        }

        /* Oculta los puntos suspensivos y les da una transición suave cuando el texto se muestra completo */
        .truncated-link.show-full::after {
            content: none;
            opacity: 0;
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Selecciona todos los elementos que tengan la clase 'truncated-link'
            const links = document.querySelectorAll('.truncated-link');

            links.forEach(link => {
                link.addEventListener('mouseenter', () => {
                    // Agrega la clase 'show-full' al pasar el mouse
                    link.classList.add('show-full');
                });

                link.addEventListener('mouseleave', () => {
                    // Elimina la clase 'show-full' al salir el mouse
                    link.classList.remove('show-full');
                });
            });
        });
    </script>
</div>
<?php /**PATH D:\laragon\www\globalcpa\resources\views/components/sidebar.blade.php ENDPATH**/ ?>