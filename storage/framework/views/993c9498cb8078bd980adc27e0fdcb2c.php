
<!DOCTYPE html>
<html lang="es" dir="ltr">

<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title><?php echo $__env->yieldContent('title'); ?></title>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="icon" type="image/x-icon" href="<?php echo e(asset('img/isotipo.png')); ?>" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link rel="stylesheet" type="text/css" media="screen"
        href="<?php echo e(url('themes/vristo/css/perfect-scrollbar.min.css')); ?>" />
    <link rel="stylesheet" type="text/css" media="screen" href="<?php echo e(url('themes/vristo/css/style.css')); ?>" />
    <link defer rel="stylesheet" type="text/css" media="screen" href="<?php echo e(url('themes/vristo/css/animate.css')); ?>" />

</head>

<body class="relative overflow-x-hidden font-nunito text-sm font-normal antialiased">
    <?php echo $__env->yieldContent('message'); ?>
</body>

</html>
<?php /**PATH D:\laragon\www\globalcpa\resources\views/errors/minimal.blade.php ENDPATH**/ ?>