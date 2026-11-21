<?php $__env->startSection('content'); ?>
    <h1>Hello World</h1>

    <p>Module: <?php echo config('crm.name'); ?></p>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('crm::layouts.master', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH C:\laragon\www\globalcpa\Modules\CRM\Resources\views\index.blade.php ENDPATH**/ ?>