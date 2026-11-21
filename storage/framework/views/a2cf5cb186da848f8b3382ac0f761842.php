<div class="subscriptions-wrap">

    <style>
        /* Modo oscuro: el CSS de .title_aracode y .boton-degradado-courses no se
           carga en las páginas públicas, así que los títulos heredan el color de
           encabezado de Bootstrap (#1F2F3E) -> oscuro sobre oscuro. */
        body.dark-only .subscriptions-wrap h1.title_aracode,
        body.dark-only .subscriptions-wrap h3.title_aracode,
        body.dark-only .subscriptions-wrap h2 b.title_aracode {
            color: #f3f4f6;
        }

        body.dark-only .subscriptions-wrap .tabs-list button.btn {
            color: #f3f4f6;
            background-color: transparent;
        }

        body.dark-only .subscriptions-wrap .boton-degradado-courses b {
            color: #ffffff;
        }

        body.dark-only .subscriptions-wrap .card {
            background-color: #1f2937;
            border-color: #374558;
            color: #d1d5db;
        }
    </style>

    <br>
    <div class="mt-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 lg:mt-6">
        <div style="text-align:center;">
            <h1 class="title_aracode" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                NUESTRAS SUSCRIPCIONES
            </h1>
        </div>
        <br>
        <div x-data="{ activeTab: 'tabAnual' }" class="tabs flex flex-col">
            <div
                class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200">
                <div class="tabs-list flex px-1.5 py-1">
                    <button @click="activeTab = 'tabAnual'"
                        :class="activeTab === 'tabAnual' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' :
                            'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                        class="btn shrink-0 px-3 py-1.5 font-medium">
                        Anual
                    </button>
                </div>
            </div>

            <div class="container">
                <br>
                <div class="row" x-show="activeTab === 'tabAnual'">
                    <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($subscription->period == 'Anual'): ?>
                            <?php
                                // Decodificar el JSON a un array de PHP
                                $prices = is_string($subscription->prices) ? json_decode($subscription->prices, true) : $subscription->prices;
                                $details = is_string($subscription->details) ? json_decode($subscription->details, true) : $subscription->details;
                            ?>
                            <div class="col-md-4">
                                <div class="card" style="width: 90%; padding: 10px 15px;">
                                    <div class="card-body">
                                        <h3 class="title_aracode"
                                            style="font-size: 25px; line-height: 1.1; font-weight: 700; padding: 10px;">
                                            <?php echo e($subscription->title); ?>

                                        </h3>
                                        <h4 style="text-align: center; font-weight: 500;">
                                            <?php echo e($subscription->description); ?><br>
                                            <b><?php echo e($subscription->period); ?></b>
                                        </h4>
                                        <br>
                                        <ul style="height: auto;">
                                            <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li style="padding: 3px 0px;">
                                                    <i class="fa fa-circle" style="font-size: 12px;"></i>
                                                    &nbsp;<?php echo e($detail['label']); ?>

                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <br>
                                        <h2 style="text-align: center;">
                                            <b  class="title_aracode"
                                            style="font-size: 35px; line-height: 1.1; font-weight: 700; padding: 10px;">
                                            S/ <?php echo e($prices[0]['amount']); ?>

                                            </b> 
                                            / <?php echo e($prices[0]['detail']); ?>

                                        </h2>
                                        <br>
                                        <a href="<?php echo e(route('academic_step_account', $subscription->id)); ?>">
                                            <button class="boton-degradado-courses">
                                                <b style="font-size: 18px;">
                                                    <i class="fa fa-edit" aria-hidden="true"
                                                        style="font-size: 20px;"></i>
                                                    &nbsp; Suscribirme
                                                </b>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
                <br>
                <div class="row" x-show="activeTab === 'tabMensual'"
                    x-transition:enter="transition-all duration-500 easy-in-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                    <?php $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $subscription): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($subscription->period == 'Mensual'): ?>
                            <?php
                                // Decodificar el JSON a un array de PHP
                                $prices = is_string($subscription->prices) ? json_decode($subscription->prices, true) : $subscription->prices;
                                $details = is_string($subscription->details) ? json_decode($subscription->details, true) : $subscription->details;
                            ?>
                            <div class="col-md-4">
                                <div class="card" style="width: 90%; padding: 10px 15px;">
                                    <div class="card-body">
                                        <h3 class="title_aracode"
                                            style="font-size: 25px; line-height: 1.1; font-weight: 700; padding: 10px;">
                                            <?php echo e($subscription->title); ?>

                                        </h3>
                                        <h4 style="text-align: center; font-weight: 500;">
                                            <?php echo e($subscription->description); ?><br>
                                            <b><?php echo e($subscription->period); ?></b>
                                        </h4>
                                        <br>
                                        <ul style="height: auto;">
                                            <?php $__currentLoopData = $details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $detail): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <li style="padding: 3px 0px;">
                                                    <i class="fa fa-circle" style="font-size: 12px;"></i>
                                                    &nbsp;<?php echo e($detail['label']); ?>

                                                </li>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        </ul>
                                        <br>
                                        <h2 style="text-align: center;">
                                            <b  class="title_aracode"
                                            style="font-size: 35px; line-height: 1.1; font-weight: 700; padding: 10px;">
                                            S/ <?php echo e($prices[0]['amount']); ?>

                                            </b> 
                                            / <?php echo e($prices[0]['detail']); ?>

                                        </h2>
                                        <br>
                                        <a href="<?php echo e(route('academic_step_account', $subscription->id)); ?>">
                                            <button class="boton-degradado-courses">
                                                <b style="font-size: 18px;">
                                                    <i class="fa fa-edit" aria-hidden="true"
                                                        style="font-size: 20px;"></i>
                                                    &nbsp; Suscribirme
                                                </b>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>

            <br>
            <br>
        </div>
    </div>
</div>
<?php /**PATH C:\laragon\www\globalcpa\resources\views\components\subscriptions.blade.php ENDPATH**/ ?>