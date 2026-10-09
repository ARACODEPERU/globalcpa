<!DOCTYPE html>
<html lang="<?php echo e(str_replace('_', '-', app()->getLocale())); ?>">
<?php
    $company = \App\Models\Company::first();
?>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title inertia><?php echo e(config('app.name', 'Laravel')); ?></title>
    <?php if($company && $company->isotipo): ?>
        <link rel="icon" href="<?php echo e(asset('storage/' . $company->isotipo)); ?>">
    <?php else: ?>
        <link rel="icon" href="<?php echo e(asset('img/isotipo.png')); ?>">
    <?php endif; ?>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />

    

    <meta name="csrf-token" content="<?php echo e(csrf_token()); ?>">

    
    <script src="<?php echo e(asset('js/traffic-tracking.js')); ?>"></script>
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
    <style>
        .swal2-container {
            z-index: 99999999 !important;
        }
    </style>
</head>

<body>
    <?php if (!isset($__inertiaSsrDispatched)) { $__inertiaSsrDispatched = true; $__inertiaSsrResponse = app(\Inertia\Ssr\Gateway::class)->dispatch($page); }  if ($__inertiaSsrResponse) { echo $__inertiaSsrResponse->body; } else { ?><div id="app" data-page="<?php echo e(json_encode($page)); ?>"></div><?php } ?>
    <script>
        window.assetUrl = <?php echo json_encode(asset(''), 15, 512) ?>;
    </script>

</body>

</html>
<?php /**PATH D:\laragon\www\globalcpa\resources\views/app.blade.php ENDPATH**/ ?>