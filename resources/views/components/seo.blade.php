@props([
    'title' => null,
    'description' => null,
    'image' => null,
    'url' => null,
    'type' => 'website',
])

@php
    $siteName = config('app.name', 'CPA Academy');
    $title = $title ?? $siteName;
    $description = $description
        ?? 'Formación profesional en contabilidad, finanzas y auditoría con respaldo ACCA, docentes de Big Four y programas prácticos en más de 10 países de LATAM.';
    $image = $image ?? asset('themes/webpage/images/Logo_cpa_blanco.png');
    $url = $url ?? url()->current();
@endphp

<meta name="description" content="{{ $description }}">
<meta name="robots" content="index, follow">

<meta property="og:type" content="{{ $type }}">
<meta property="og:title" content="{{ $title }}">
<meta property="og:description" content="{{ $description }}">
<meta property="og:image" content="{{ $image }}">
<meta property="og:url" content="{{ $url }}">
<meta property="og:site_name" content="{{ $siteName }}">

<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="{{ $title }}">
<meta name="twitter:description" content="{{ $description }}">
<meta name="twitter:image" content="{{ $image }}">
