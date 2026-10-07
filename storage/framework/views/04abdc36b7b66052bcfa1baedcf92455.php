<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames(([
    'title' => null,
    'description' => null,
    'image' => null,
    'url' => null,
    'type' => 'website',
]));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter(([
    'title' => null,
    'description' => null,
    'image' => null,
    'url' => null,
    'type' => 'website',
]), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars); ?>

<?php
    $siteName = config('app.name', 'CPA Academy');
    $title = $title ?? $siteName;
    $description = $description
        ?? 'Formación profesional en contabilidad, finanzas y auditoría con respaldo ACCA, docentes de Big Four y programas prácticos en más de 10 países de LATAM.';
    $image = $image ?? asset('themes/webpage/images/Logo_cpa_blanco.png');
    $url = $url ?? url()->current();
?>

<meta name="description" content="<?php echo e($description); ?>">
<meta name="robots" content="index, follow">

<meta property="og:type" content="<?php echo e($type); ?>">
<meta property="og:title" content="<?php echo e($title); ?>">
<meta property="og:description" content="<?php echo e($description); ?>">
<meta property="og:image" content="<?php echo e($image); ?>">
<meta property="og:url" content="<?php echo e($url); ?>">
<meta property="og:site_name" content="<?php echo e($siteName); ?>">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?php echo e($title); ?>">
<meta name="twitter:description" content="<?php echo e($description); ?>">
<meta name="twitter:image" content="<?php echo e($image); ?>">
<?php /**PATH C:\laragon\www\globalcpa\resources\views/components/seo.blade.php ENDPATH**/ ?>