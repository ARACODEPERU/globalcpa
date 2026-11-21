<?php $__env->startSection('content'); ?>
    <h1>Hello World</h1>

    <p>
        This view is loaded from module: <?php echo config('health.name'); ?>

    </p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('health::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\globalcpa\Modules\Health\Resources\views\index.blade.php ENDPATH**/ ?>