<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">

<head>
    <?php
        $gtm = \App\Support\PageSnippet::parts();
    ?>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    
    <?php echo $gtm['head']; ?>


    <title inertia><?php echo e(config('app.name', 'Laravel')); ?></title>
    <link rel="icon" href="<?php echo e(asset('img/isotipo.png')); ?>">
    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">
    <!-- Scripts -->
    <?php echo app('Tightenco\Ziggy\BladeRouteGenerator')->generate(); ?>
    <?php
        $parts = explode('::', $page['component']);
    ?>
    <?php if(count($parts) > 1): ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js', "Modules/{$parts[0]}/Resources/assets/js/Pages/{$parts[1]}.vue"]); ?>
    <?php else: ?>
        <?php echo app('Illuminate\Foundation\Vite')(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"]); ?>
    <?php endif; ?>
    <?php if (!isset($__inertiaSsrDispatched)) { $__inertiaSsrDispatched = true; $__inertiaSsrResponse = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsrResponse) { echo $__inertiaSsrResponse->head; } ?>
    <link rel="stylesheet" href="<?php echo e(asset('themes/personalLanding/assets/font/css/all.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('themes/personalLanding/assets/css/aos.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('themes/personalLanding/assets/css/owl.carousel.min.css')); ?>">
    <link rel="stylesheet" href="<?php echo e(asset('themes/personalLanding/assets/css/jquery.fancybox.min.css')); ?>">

    <!-- main style -->
    <link rel="stylesheet" href="<?php echo e(asset('themes/personalLanding/assets/css/style.css')); ?>">
</head>

<body class="overflow-x-hidden">
    
    <?php echo $gtm['body']; ?>

    <?php if (!isset($__inertiaSsrDispatched)) { $__inertiaSsrDispatched = true; $__inertiaSsrResponse = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsrResponse) { echo $__inertiaSsrResponse->body; } elseif (config('inertia.use_script_element_for_initial_page')) { ?><script data-page="app" type="application/json"><?php echo json_encode($page); ?></script><div id="app"></div><?php } else { ?><div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div><?php } ?>
    <script>
        window.assetUrl = <?php echo json_encode(asset(''), 15, 512) ?>;
    </script>

</body>

</html>
<?php /**PATH C:\laragon\www\globalcpa\resources\views\layouts\landing.blade.php ENDPATH**/ ?>