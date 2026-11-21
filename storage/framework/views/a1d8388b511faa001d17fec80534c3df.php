<?php $__env->startSection('content'); ?>
    <h1>Hello World</h1>

    <p>Module: <?php echo config('integrationhub.name'); ?></p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('integrationhub::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\globalcpa\Modules\Integrationhub\Resources\views\index.blade.php ENDPATH**/ ?>