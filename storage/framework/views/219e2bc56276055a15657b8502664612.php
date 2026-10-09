<div>
    <div class="container-fluid">
        <section class="bg-gray-100 flex items-center justify-center  w-full">
            <div class="slider w-full rounded-lg shadow-lg">
                <div class="slides">
                    <?php $__currentLoopData = $sliders; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $slide): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <div class="slide">
                            <a href="<?php echo e($slide->item->items[1]->content); ?>">
                                <img src="<?php echo e(asset('storage/' . $slide->item->items[0]->content)); ?>" alt="Imagen"
                                    class="w-full">
                            </a>
                        </div>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </div>
            </div>
        </section>
    </div>
</div>
<?php /**PATH D:\laragon\www\globalcpa\resources\views/components/slider.blade.php ENDPATH**/ ?>