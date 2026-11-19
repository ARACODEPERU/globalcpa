@extends('layouts.webpage')

@section('title', ' - Suscripciones')

@section('etiquetasmeta')
    <x-seo
        title="Suscripciones CPA Academy - Planes anuales y mensuales"
        description="Conoce los planes de suscripción de CPA Academy: formación en vivo, videoteca, asesoría especializada y automatización. Detalles y precios en soles y dólares."
    />
@endsection

@section('styles')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,400;0,500;0,600;0,700;0,800;0,900;1,500;1,700&display=swap">
@endsection

@section('content')

<style>
    /* =========================================
       PÁGINA DE SUSCRIPCIONES
       Basada en la plantilla de LandingSuscripcion: bandas navy con grilla,
       títulos Montserrat, acentos rojos y tarjetas de plan con la inversión
       en soles y, si el plan lo habilita, su precio en dólares.
       Todo va prefijado con .subsx para no chocar con el tema (Bootstrap).
       ========================================= */
    .subsx {
        font-family: 'Montserrat', 'Poppins', Arial, sans-serif;
        color: #15152E;
        padding: 22px 4px 46px;
    }
    .subsx *,
    .subsx *::before,
    .subsx *::after { box-sizing: border-box; }
    .subsx h1,
    .subsx h2,
    .subsx h3 { margin: 0; line-height: 1.12; font-weight: 900; letter-spacing: -0.01em; overflow-wrap: break-word; }
    .subsx p { margin: 0; }
    .subsx-wrap { max-width: 1160px; margin: 0 auto; }

    /* Portada */
    .subsx-hero {
        position: relative;
        overflow: hidden;
        border-radius: 22px;
        background-color: #00005A;
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.05) 1px, transparent 1px);
        background-size: 44px 44px;
        color: #FFFFFF;
        padding: 46px 40px;
    }
    .subsx-kicker {
        display: flex;
        align-items: center;
        gap: 10px;
        font-size: 12.5px;
        font-weight: 800;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: #ED1B26;
    }
    .subsx-kicker::before {
        content: "";
        width: 12px;
        height: 12px;
        background: #ED1B26;
        flex: none;
    }
    .subsx-hero .subsx-kicker { color: #FF5A62; }
    .subsx-hero h1 {
        font-size: clamp(28px, 4.4vw, 54px);
        margin-top: 14px;
        color: #FFFFFF;
    }
    .subsx-hero h1 em { font-style: normal; color: #ED1B26; }
    .subsx-lead {
        font-size: 17px;
        line-height: 1.6;
        color: #C9CAF0;
        max-width: 64ch;
        margin-top: 16px;
    }
    .subsx-checks {
        list-style: none;
        padding: 0;
        margin: 22px 0 0;
        display: grid;
        gap: 10px;
    }
    .subsx-checks li {
        display: flex;
        gap: 12px;
        align-items: flex-start;
        font-weight: 600;
        font-size: 15px;
        line-height: 1.45;
    }
    .subsx-checks li::before {
        content: "";
        flex: none;
        width: 22px;
        height: 22px;
        margin-top: 1px;
        border-radius: 50%;
        background: #ED1B26 url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M6 12.5l4 4L18 8' fill='none' stroke='white' stroke-width='3' stroke-linecap='round' stroke-linejoin='round'/%3E%3C/svg%3E") center/16px no-repeat;
    }
    .subsx-actions {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        margin-top: 26px;
    }
    .subsx-btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        font: 800 15px/1 'Montserrat', 'Poppins', Arial, sans-serif;
        padding: 16px 24px;
        border-radius: 12px;
        text-decoration: none;
        border: 2px solid transparent;
        background: #ED1B26;
        color: #FFFFFF;
        box-shadow: 0 10px 24px rgba(237, 27, 38, 0.32);
        transition: transform 0.15s, box-shadow 0.15s;
    }
    .subsx-btn:hover {
        transform: translateY(-2px);
        color: #FFFFFF;
        text-decoration: none;
    }
    .subsx-btn:focus-visible {
        outline: 3px solid #FFB800;
        outline-offset: 3px;
    }
    .subsx-btn svg { width: 20px; height: 20px; flex: none; }
    .subsx-btn--ghost {
        background: transparent;
        border-color: rgba(255, 255, 255, 0.55);
        box-shadow: none;
        color: #FFFFFF;
    }
    .subsx-btn--ghost:hover { background: rgba(255, 255, 255, 0.08); color: #FFFFFF; }
    .subsx-claim {
        display: flex;
        flex-wrap: wrap;
        gap: 12px;
        align-items: center;
        margin-top: 26px;
        padding-left: 14px;
        border-left: 4px solid #ED1B26;
        font-size: 13.5px;
        line-height: 1.5;
        color: #C9CAF0;
        max-width: 540px;
    }
    .subsx-claim img { height: 30px; width: auto; max-width: min(180px, 60%); object-fit: contain; }
    .subsx-claim b { display: block; color: #FFFFFF; font-size: 14.5px; }

    /* Planes */
    .subsx-plans {
        margin-top: 20px;
        scroll-margin-top: 90px;
        background: #F5F5F7;
        border-radius: 22px;
        padding: 40px 34px;
    }
    .subsx-plans h2 {
        font-size: clamp(26px, 3.4vw, 40px);
        margin-top: 12px;
        color: #15152E;
    }
    .subsx-plans h2 em { font-style: normal; color: #ED1B26; }
    .subsx-tabs {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
        margin-top: 24px;
    }
    .subsx-tab {
        appearance: none;
        border: 1px solid #E1E2EC;
        background: #FFFFFF;
        color: #4A4C66;
        font: 800 13.5px/1 'Montserrat', 'Poppins', Arial, sans-serif;
        padding: 12px 18px;
        border-radius: 999px;
        cursor: pointer;
        transition: background 0.15s, border-color 0.15s, color 0.15s;
    }
    .subsx-tab:hover { border-color: #00005A; color: #00005A; }
    .subsx-tab.is-active { background: #00005A; border-color: #00005A; color: #FFFFFF; }
    .subsx-grid {
        display: grid;
        grid-template-columns: repeat(3, minmax(0, 1fr));
        gap: 18px;
        margin-top: 26px;
        align-items: stretch;
    }
    .subsx-plan {
        display: flex;
        flex-direction: column;
        background: #FFFFFF;
        border: 1px solid #E1E2EC;
        border-radius: 20px;
        padding: 26px 24px;
        box-shadow: 0 1px 0 rgba(0, 0, 60, 0.03);
    }
    .subsx-flag {
        align-self: flex-start;
        background: #FDEBEC;
        color: #C3121B;
        font-size: 11px;
        font-weight: 800;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        padding: 6px 10px;
        border-radius: 6px;
    }
    .subsx-plan h3 {
        font-size: 23px;
        color: #00005A;
        margin-top: 14px;
        text-transform: uppercase;
    }
    .subsx-for {
        font-size: 14px;
        line-height: 1.55;
        color: #4A4C66;
        margin-top: 8px;
        min-height: 44px;
    }
    .subsx-price {
        border-top: 1px solid #E1E2EC;
        margin-top: 18px;
        padding-top: 16px;
    }
    .subsx-amt {
        font-size: 42px;
        font-weight: 900;
        color: #00005A;
        line-height: 1.05;
        letter-spacing: -0.02em;
        font-variant-numeric: tabular-nums;
        word-break: break-word;
    }
    .subsx-amt small {
        font-size: 18px;
        font-weight: 800;
        letter-spacing: 0;
    }
    .subsx-amt--text { font-size: 22px; }
    /* Texto libre encima del precio ("Antes S/ 1800", aviso de aumento...).
       Si el administrador no aplico formato, se muestra subrayado por defecto. */
    .subsx-before {
        font-size: 13px;
        line-height: 1.45;
        font-weight: 600;
        color: #6C6E86;
        margin-bottom: 8px;
        overflow-wrap: break-word;
    }
    .subsx-before--plain { text-decoration: underline; }
    .subsx-before b,
    .subsx-before strong { font-weight: 800; }
    /* Texto libre debajo del precio (vigencia, condiciones, avisos...). */
    .subsx-after {
        font-size: 13px;
        line-height: 1.45;
        font-weight: 600;
        color: #6C6E86;
        margin-top: 10px;
        overflow-wrap: break-word;
    }
    .subsx-after b,
    .subsx-after strong { font-weight: 800; }
    .subsx-per {
        font-size: 13px;
        font-weight: 600;
        color: #4A4C66;
        margin-top: 4px;
    }
    .subsx-usd {
        display: flex;
        flex-wrap: wrap;
        align-items: center;
        justify-content: space-between;
        gap: 10px;
        background: #ECECF6;
        border-radius: 10px;
        padding: 10px 12px;
        margin-top: 12px;
    }
    .subsx-usd b {
        font-size: 19px;
        font-weight: 900;
        color: #00005A;
        font-variant-numeric: tabular-nums;
        line-height: 1.2;
    }
    .subsx-usd b small { font-size: 12px; font-weight: 800; }
    .subsx-usd span {
        font-size: 12px;
        font-weight: 700;
        color: #4A4C66;
        text-align: right;
        line-height: 1.3;
    }
    .subsx-details {
        list-style: none;
        padding: 0;
        margin: 18px 0 0;
        display: grid;
        gap: 10px;
        flex: 1;
    }
    .subsx-details li {
        display: flex;
        gap: 10px;
        font-size: 14px;
        line-height: 1.5;
        color: #15152E;
    }
    .subsx-details li::before {
        content: "";
        flex: none;
        width: 9px;
        height: 9px;
        background: #ED1B26;
        margin-top: 6px;
    }
    .subsx-plan .subsx-btn {
        margin-top: 22px;
        width: 100%;
        box-shadow: none;
        padding: 15px 18px;
    }
    .subsx-note {
        font-size: 12.5px;
        line-height: 1.65;
        color: #4A4C66;
        margin-top: 22px;
    }
    .subsx-empty {
        background: #FFFFFF;
        border: 1px dashed #C9CADB;
        border-radius: 16px;
        padding: 28px;
        margin-top: 26px;
        font-size: 15px;
        color: #4A4C66;
    }

    /* Preguntas frecuentes */
    .subsx-faq h2 {
        font-size: clamp(26px, 3.4vw, 40px);
        margin-top: 12px;
        color: #15152E;
    }
    .subsx-faq h2 em { font-style: normal; color: #ED1B26; }
    .subsx-faq {
        margin-top: 20px;
        scroll-margin-top: 90px;
        background: #F5F5F7;
        border-radius: 22px;
        padding: 40px 34px;
    }
    .subsx-faq-list {
        display: grid;
        gap: 12px;
        margin-top: 26px;
        max-width: 900px;
    }
    .subsx-faq details {
        background: #FFFFFF;
        border: 1px solid #E1E2EC;
        border-radius: 14px;
    }
    .subsx-faq summary {
        list-style: none;
        cursor: pointer;
        padding: 18px 54px 18px 20px;
        font-size: 15.5px;
        font-weight: 800;
        color: #00005A;
        position: relative;
        border-radius: 14px;
    }
    .subsx-faq summary::-webkit-details-marker { display: none; }
    .subsx-faq summary::after {
        content: "+";
        position: absolute;
        right: 20px;
        top: 50%;
        transform: translateY(-50%);
        font-size: 24px;
        line-height: 1;
        color: #ED1B26;
        font-weight: 700;
    }
    .subsx-faq details[open] summary::after { content: "–"; }
    .subsx-faq details p {
        padding: 0 20px 18px;
        color: #4A4C66;
        font-size: 14.5px;
        line-height: 1.65;
    }
    .subsx-faq summary:focus-visible {
        outline: 3px solid #ED1B26;
        outline-offset: -3px;
    }

    /* Modo oscuro del sitio */
    body.dark-only .subsx { color: #E5E7EF; }
    body.dark-only .subsx-plans { background: #141c2f; }
    body.dark-only .subsx-plans h2 { color: #F3F4F6; }
    body.dark-only .subsx-plan {
        background: #1b2537;
        border-color: #2a3650;
    }
    body.dark-only .subsx-plan h3,
    body.dark-only .subsx-amt,
    body.dark-only .subsx-usd b { color: #FFFFFF; }
    body.dark-only .subsx-before,
    body.dark-only .subsx-after { color: #A7ABC4; }
    body.dark-only .subsx-details li { color: #CBD5E1; }
    body.dark-only .subsx-tab { background: #1b2537; border-color: #2a3650; color: #CBD5E1; }
    body.dark-only .subsx-tab.is-active { background: #ED1B26; border-color: #ED1B26; color: #FFFFFF; }
    body.dark-only .subsx-usd { background: #22304a; }
    body.dark-only .subsx-usd span { color: #CBD5E1; }
    body.dark-only .subsx-empty { background: #1b2537; border-color: #2a3650; color: #CBD5E1; }
    body.dark-only .subsx-faq h2 { color: #F3F4F6; }
    body.dark-only .subsx-faq { background: #141c2f; }
    body.dark-only .subsx-faq details { background: #1b2537; border-color: #2a3650; }
    body.dark-only .subsx-faq summary { color: #FFFFFF; }
    body.dark-only .subsx-faq details p { color: #CBD5E1; }

    [data-subsx-period][hidden] { display: none !important; }

    @media (max-width: 1200px) {
        .subsx-grid { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
    @media (max-width: 600px) {
        /* En celular la página usa todo el ancho: el riel fijo del tema le quita
           100 px de contenido y no aporta nada en esta vista. */
        body .page-wrapper .page-body-wrapper .sidebar-wrapper { display: none !important; }
        body .page-wrapper .page-body-wrapper .page-body { margin-left: 0 !important; }
    }
    @media (max-width: 820px) {
        .subsx { padding: 14px 0 34px; }
        .subsx-hero { padding: 32px 22px; border-radius: 18px; }
        .subsx-plans { padding: 28px 20px; border-radius: 18px; }
        .subsx-grid { grid-template-columns: minmax(0, 1fr); }
        .subsx-faq { padding: 28px 20px; border-radius: 18px; }
        .subsx-faq summary { font-size: 15px; padding: 16px 46px 16px 18px; }
        .subsx-faq details p { padding: 0 18px 16px; }
        .subsx-for { min-height: 0; }
        .subsx-actions .subsx-btn { width: 100%; }
        .subsx-amt { font-size: 38px; }
    }
</style>

<style>
    /* =========================================
       Secciones de la plantilla LandingSuscripcion:
       confianza, contexto, pilares, agentes, automatización,
       regalos, docentes y testimonios.
       Van acotadas a #suscx para no chocar con el tema.
       ========================================= */
    #suscx {
        --navy: #00005A; --red: #ED1B26; --red2: #C3121B; --gray: #F5F5F7;
        --ink: #15152E; --muted: #4A4C66; --line: #E1E2EC; --pink: #FDEBEC;
        --soft: #ECECF6; --onnavy: #C9CAF0;
        font-family: 'Montserrat', 'Poppins', Arial, sans-serif;
        color: var(--ink);
        font-size: 16px;
        line-height: 1.6;
        margin-top: 16px;
    }
    #suscx *, #suscx *::before, #suscx *::after { box-sizing: border-box; }
    #suscx h2, #suscx h3, #suscx h4 { margin: 0; line-height: 1.12; font-weight: 900; overflow-wrap: break-word; }
    #suscx p { margin: 0; }
    #suscx img { display: block; max-width: 100%; }
    #suscx section { border-radius: 22px; margin-top: 16px; overflow: hidden; scroll-margin-top: 90px; }
    #suscx .sx-wrap { max-width: 1160px; margin: 0 auto; padding-left: 24px; padding-right: 24px; }
    #suscx section .sx-wrap { padding-block: 64px; }
    #suscx .sx-kicker { display: flex; align-items: center; gap: 10px; font-size: 12.5px; font-weight: 800; letter-spacing: 0.16em; text-transform: uppercase; color: var(--red); }
    #suscx .sx-kicker::before { content: ""; width: 12px; height: 12px; background: var(--red); flex: none; }
    #suscx h2 { font-size: clamp(26px, 3.4vw, 40px); margin-top: 14px; color: var(--ink); }
    #suscx h2 em { font-style: normal; color: var(--red); }
    #suscx .sx-lead { font-size: 16.5px; color: var(--muted); max-width: 72ch; margin-top: 14px; }
    #suscx .sx-lead b { color: var(--ink); }
    #suscx .sx-gray { background: var(--gray); }
    #suscx .sx-navy { background: var(--navy); color: #FFFFFF; }
    #suscx .sx-navy h2, #suscx .sx-navy h3 { color: #FFFFFF; }
    #suscx .sx-navy .sx-lead { color: var(--onnavy); }
    #suscx .sx-navy .sx-lead b { color: #FFFFFF; }
    #suscx .sx-gridbg { background-image: linear-gradient(rgba(255,255,255,.045) 1px, transparent 1px), linear-gradient(90deg, rgba(255,255,255,.045) 1px, transparent 1px); background-size: 44px 44px; }
    #suscx .sx-btn { display: inline-flex; align-items: center; justify-content: center; gap: 10px; font: 800 15px/1 'Montserrat', 'Poppins', Arial, sans-serif; padding: 16px 24px; border-radius: 12px; text-decoration: none; border: 2px solid transparent; cursor: pointer; }
    #suscx .sx-btn-red { background: var(--red); color: #FFFFFF; box-shadow: 0 10px 24px rgba(237,27,38,.32); }
    #suscx .sx-btn-red:hover { color: #FFFFFF; transform: translateY(-2px); }
    #suscx .sx-btn svg { width: 20px; height: 20px; flex: none; }
    #suscx .sx-ctas { display: flex; flex-wrap: wrap; gap: 12px; margin-top: 24px; }
    #suscx.v-noacca .acca { display: none !important; }
    #suscx .sx-note { display: none !important; }

    /* Confianza */
    #suscx .sx-trust .sx-wrap { padding-block: 48px; }
    #suscx .sx-trust h4 { font-size: 12.5px; letter-spacing: 0.16em; color: var(--navy); text-transform: uppercase; font-weight: 800; text-align: center; margin: 0; }
    #suscx .sx-logos { display: grid; grid-template-columns: repeat(9, minmax(0, 1fr)); gap: 12px; margin-top: 22px; }
    #suscx .sx-logos div { background: #FFFFFF; border: 1px solid var(--line); border-radius: 10px; height: 60px; display: grid; place-items: center; padding: 8px; }
    #suscx .sx-logos img { max-height: 38px; max-width: 100%; width: auto; height: auto; object-fit: contain; }
    #suscx .sx-stats { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; margin-top: 26px; }
    #suscx .sx-stat { border-radius: 14px; padding: 20px 22px; color: #FFFFFF; background: var(--navy); }
    #suscx .sx-stat:nth-child(2) { background: var(--red); }
    #suscx .sx-stat b { display: block; font-size: clamp(21px, 6vw, 28px); font-weight: 900; line-height: 1.1; overflow-wrap: anywhere; }
    #suscx .sx-stat span { display: block; margin-top: 6px; font-size: 13.5px; color: rgba(255,255,255,.85); }

    /* Contexto */
    #suscx .sx-ctx-top { display: grid; grid-template-columns: minmax(0, 1.3fr) minmax(0, 1fr); gap: 36px; margin-top: 20px; align-items: start; }
    #suscx .sx-ctx-top p { font-size: 16.5px; color: var(--muted); }
    #suscx .sx-quote { border-left: 4px solid var(--red); padding-left: 16px; font-size: 18px; font-weight: 800; color: var(--navy); line-height: 1.4; }
    #suscx .sx-pains { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 16px; margin-top: 34px; }
    #suscx .sx-pain { background: var(--gray); border-radius: 14px; padding: 20px; }
    #suscx .sx-pain .sx-n { font-size: 28px; font-weight: 900; color: var(--red); }
    #suscx .sx-pain h3 { font-size: 16px; color: var(--navy); margin-top: 6px; }
    #suscx .sx-pain p { font-size: 13.5px; color: var(--muted); margin-top: 8px; }
    #suscx .sx-bigband { margin-top: 34px; background: var(--navy); color: #FFFFFF; border-radius: 18px; padding: 28px 30px; display: grid; grid-template-columns: auto minmax(0, 1fr); gap: 30px; align-items: center; }
    #suscx .sx-bigband .sx-h { font-size: 64px; font-weight: 900; line-height: 0.9; }
    #suscx .sx-bigband .sx-h small { display: block; font-size: 15px; color: #FF5A62; margin-top: 8px; }
    #suscx .sx-bigband p { color: var(--onnavy); font-size: 15.5px; }
    #suscx .sx-bigband p b { color: #FFFFFF; }
    #suscx .sx-bigband .sx-br { color: #FFFFFF; font-weight: 800; font-size: 18px; margin-top: 10px; }

    /* Pilares */
    #suscx .sx-pillars { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; margin-top: 34px; }
    #suscx .sx-pil { background: #FFFFFF; border: 1px solid var(--line); border-radius: 18px; padding: 26px; }
    #suscx .sx-pil .sx-ic { width: 50px; height: 50px; border-radius: 12px; background: var(--navy); display: grid; place-items: center; color: #FFFFFF; }
    #suscx .sx-pil .sx-ic svg { width: 25px; height: 25px; }
    #suscx .sx-pil h3 { font-size: 22px; letter-spacing: 0.06em; margin-top: 16px; color: var(--navy); text-transform: uppercase; }
    #suscx .sx-pil .sx-why { font-style: italic; font-size: 14px; color: var(--muted); margin-top: 4px; }
    #suscx .sx-pil ul { margin: 16px 0 0; padding: 0; list-style: none; display: grid; gap: 10px; }
    #suscx .sx-pil li { display: flex; gap: 10px; font-size: 14px; }
    #suscx .sx-pil li::before { content: ""; flex: none; width: 8px; height: 8px; background: var(--red); margin-top: 7px; }
    #suscx .sx-pil.sx-hot { background: var(--navy); color: #FFFFFF; border-color: var(--navy); box-shadow: 0 18px 40px rgba(0,0,90,.25); }
    #suscx .sx-pil.sx-hot h3 { color: #FFFFFF; }
    #suscx .sx-pil.sx-hot .sx-why { color: var(--onnavy); }
    #suscx .sx-pil.sx-hot .sx-ic { background: var(--red); }
    #suscx .sx-excl { margin-top: 18px; background: var(--red); color: #FFFFFF; border-radius: 12px; padding: 12px 14px; font-weight: 800; font-size: 13px; }

    /* Agentes */
    #suscx .sx-agents { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 16px; margin-top: 32px; }
    #suscx .sx-ag { background: var(--gray); border-radius: 14px; padding: 20px; border-top: 4px solid var(--navy); }
    #suscx .sx-ag:nth-child(2) { border-top-color: var(--red); }
    #suscx .sx-ag .sx-t { font-size: 12px; font-weight: 800; letter-spacing: 0.14em; color: var(--red); }
    #suscx .sx-ag h3 { font-size: 21px; color: var(--navy); margin-top: 6px; }
    #suscx .sx-ag p { font-size: 14.5px; color: var(--muted); margin-top: 8px; }
    #suscx .sx-ag-row { display: grid; grid-template-columns: minmax(0, 1.1fr) minmax(0, 1fr); gap: 22px; margin-top: 22px; }
    #suscx .sx-chatcard { border: 1px solid var(--line); border-radius: 16px; overflow: hidden; background: #FFFFFF; }
    #suscx .sx-chatcard .sx-hd { background: var(--navy); color: #FFFFFF; display: flex; flex-wrap: wrap; justify-content: space-between; gap: 4px 10px; padding: 14px 18px; font-weight: 800; font-size: 14px; }
    #suscx .sx-chatcard .sx-hd span { color: #7EE2A8; font-size: 12px; }
    #suscx .sx-chatcard .sx-bd { padding: 20px; display: grid; gap: 12px; }
    #suscx .sx-cb { max-width: 88%; padding: 12px 15px; border-radius: 14px; font-size: 14.5px; line-height: 1.5; }
    #suscx .sx-cb.sx-me { justify-self: end; background: var(--navy); color: #FFFFFF; border-bottom-right-radius: 4px; }
    #suscx .sx-cb.sx-ai { background: var(--pink); border-bottom-left-radius: 4px; }
    #suscx .sx-cb .sx-lw { display: block; margin-top: 8px; font-size: 13px; font-weight: 800; color: var(--red2); }
    #suscx .sx-spec { background: var(--pink); border-radius: 16px; padding: 22px; }
    #suscx .sx-spec h3 { font-size: 20px; color: var(--navy); }
    #suscx .sx-spec ol { list-style: none; margin: 16px 0 0; padding: 0; display: grid; gap: 12px; counter-reset: s; }
    #suscx .sx-spec li { counter-increment: s; display: grid; grid-template-columns: 30px minmax(0, 1fr); gap: 10px; font-size: 14px; }
    #suscx .sx-spec li::before { content: counter(s); width: 28px; height: 28px; border-radius: 50%; background: var(--red); color: #FFFFFF; font-weight: 800; display: grid; place-items: center; font-size: 13px; }
    #suscx .sx-disc { font-size: 12.5px; color: var(--muted); margin-top: 18px; }

    /* Automatización */
    #suscx .sx-ribbon { display: inline-block; background: var(--red); color: #FFFFFF; font-size: 12.5px; font-weight: 800; letter-spacing: 0.14em; padding: 8px 14px; border-radius: 6px; }
    #suscx .sx-steps { display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 14px; margin-top: 32px; }
    #suscx .sx-step { border: 1px solid rgba(255,255,255,.16); background: rgba(255,255,255,.05); border-radius: 14px; padding: 20px; }
    #suscx .sx-step b { font-size: 30px; font-weight: 900; color: var(--red); }
    #suscx .sx-step h3 { font-size: 18px; margin-top: 6px; }
    #suscx .sx-step p { font-size: 14px; color: var(--onnavy); margin-top: 6px; }
    #suscx .sx-chips-lab { font-size: 12.5px; font-weight: 800; letter-spacing: 0.14em; color: #FF5A62; margin-top: 34px; }
    #suscx .sx-chips { display: flex; flex-wrap: wrap; gap: 10px; margin-top: 14px; }
    #suscx .sx-chip { background: #FFFFFF; color: var(--navy); font-weight: 700; font-size: 13.5px; padding: 10px 16px; border-radius: 999px; }
    #suscx .sx-chip.sx-o { background: transparent; color: #FFFFFF; border: 1.5px dashed rgba(255,255,255,.6); font-style: italic; }
    #suscx .sx-math { display: grid; grid-template-columns: minmax(0, 1.6fr) minmax(0, 1fr); gap: 16px; margin-top: 34px; }
    #suscx .sx-mcard { background: #FFFFFF; color: var(--ink); border-radius: 18px; padding: 26px; display: grid; grid-template-columns: auto minmax(0, 1fr); gap: 24px; align-items: center; }
    #suscx .sx-mcard .sx-h { font-size: 60px; font-weight: 900; color: var(--red); line-height: 0.95; }
    #suscx .sx-mcard .sx-h small { display: block; font-size: 14px; color: var(--navy); margin-top: 6px; }
    #suscx .sx-mcard .sx-k { font-size: 12.5px; font-weight: 800; letter-spacing: 0.14em; color: var(--red); }
    #suscx .sx-mcard p { font-size: 14.5px; color: var(--muted); margin-top: 6px; }
    #suscx .sx-mcard p b { color: var(--ink); }
    #suscx .sx-mcard2 { border: 1px solid rgba(255,255,255,.2); border-radius: 18px; padding: 26px; }
    #suscx .sx-mcard2 b { display: block; font-size: 40px; font-weight: 900; }
    #suscx .sx-mcard2 p { color: var(--onnavy); font-size: 14.5px; margin-top: 6px; }
    #suscx .sx-mcard2 p strong { color: #FFFFFF; }
    #suscx .sx-scope { font-size: 12.5px; color: var(--onnavy); margin-top: 22px; max-width: 100ch; }
    #suscx .sx-scope b { color: #FFFFFF; }

    /* Regalos */
    #suscx .sx-gifts { display: grid; grid-template-columns: minmax(0, 1fr) minmax(0, 1.25fr); gap: 18px; margin-top: 32px; }
    #suscx .sx-gift { border-radius: 18px; padding: 28px; background: var(--gray); position: relative; overflow: hidden; }
    #suscx .sx-gift .sx-num { display: inline-grid; place-items: center; width: 38px; height: 38px; border-radius: 50%; background: var(--red); color: #FFFFFF; font-weight: 900; }
    #suscx .sx-gift h3 { font-size: 22px; color: var(--navy); margin-top: 14px; }
    #suscx .sx-gift p { color: var(--muted); margin-top: 8px; font-size: 15px; }
    #suscx .sx-gift.sx-book { background: var(--navy); color: #FFFFFF; display: grid; grid-template-columns: minmax(0, 1fr) auto; gap: 10px; align-items: end; padding-bottom: 0; }
    #suscx .sx-gift.sx-book h3 { color: #FFFFFF; }
    #suscx .sx-gift.sx-book h3 em { font-style: normal; color: #FF5A62; }
    #suscx .sx-gift.sx-book p { color: var(--onnavy); }
    #suscx .sx-gift.sx-book .sx-txt { padding-bottom: 28px; }
    #suscx .sx-gift.sx-book .sx-pics { display: flex; align-items: flex-end; }
    #suscx .sx-gift.sx-book .sx-alex { height: 230px; width: auto; }
    #suscx .sx-gift.sx-book .sx-covers { height: 190px; width: auto; margin-left: -30px; }

    /* Docentes */
    #suscx .sx-faces { display: grid; grid-template-columns: repeat(7, minmax(0, 1fr)); gap: 22px 14px; margin-top: 32px; }
    #suscx .sx-face { text-align: center; }
    #suscx .sx-face img { width: min(96px, 100%); height: auto; aspect-ratio: 1 / 1; border-radius: 50%; margin: 0 auto; border: 3px solid var(--red); object-fit: cover; background: #FFFFFF; }
    #suscx .sx-face b { display: block; font-size: 13.5px; color: var(--navy); margin-top: 8px; line-height: 1.25; }
    #suscx .sx-face span { display: block; font-size: 12px; color: var(--muted); line-height: 1.35; margin-top: 2px; }
    #suscx .sx-dirs { margin-top: 40px; background: var(--navy); border-radius: 18px; padding: 22px 26px; display: grid; grid-template-columns: auto repeat(3, minmax(0, 1fr)); gap: 20px; align-items: center; color: #FFFFFF; }
    #suscx .sx-dirs h4 { font-size: 12px; letter-spacing: 0.16em; color: #FF5A62; }
    #suscx .sx-dirs h4 span { display: block; font-size: 21px; letter-spacing: 0; color: #FFFFFF; margin-top: 4px; }
    #suscx .sx-dir { display: flex; gap: 14px; align-items: center; }
    #suscx .sx-dir img { width: 70px; height: 70px; border-radius: 50%; border: 3px solid #FFFFFF; object-fit: cover; background: #E9E9F4; }
    #suscx .sx-dir b { display: block; font-size: 14.5px; }
    #suscx .sx-dir span { font-size: 12.5px; color: var(--onnavy); }

    /* Testimonios */
    #suscx .sx-tests { display: grid; grid-template-columns: repeat(3, minmax(0, 1fr)); gap: 18px; margin-top: 56px; }
    #suscx .sx-tcard { background: #FFFFFF; border-radius: 18px; padding: 64px 26px 26px; position: relative; border-top: 5px solid var(--red); box-shadow: 0 1px 0 var(--line); }
    #suscx .sx-tcard img { position: absolute; top: -46px; left: 26px; width: 96px; height: 96px; border-radius: 50%; border: 4px solid var(--red); background: #FFFFFF; object-fit: cover; }
    #suscx .sx-tcard .sx-qm { position: absolute; top: 18px; right: 24px; font-size: 64px; font-weight: 900; color: var(--red); line-height: 1; }
    #suscx .sx-tcard p { font-style: italic; font-size: 16px; line-height: 1.6; }
    #suscx .sx-tcard p b { color: var(--navy); }
    #suscx .sx-tcard .sx-who { border-top: 1px solid var(--line); margin-top: 18px; padding-top: 14px; }
    #suscx .sx-tcard .sx-who b { display: block; color: var(--navy); font-size: 16px; }
    #suscx .sx-tcard .sx-who span { font-size: 13.5px; color: var(--muted); }

    @media (max-width: 980px) {
        #suscx .sx-logos { grid-template-columns: repeat(5, minmax(0, 1fr)); }
        #suscx .sx-pains, #suscx .sx-steps { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        #suscx .sx-pillars, #suscx .sx-agents, #suscx .sx-tests { grid-template-columns: minmax(0, 1fr); }
        #suscx .sx-ag-row, #suscx .sx-math, #suscx .sx-gifts, #suscx .sx-ctx-top { grid-template-columns: minmax(0, 1fr); }
        #suscx .sx-faces { grid-template-columns: repeat(4, minmax(0, 1fr)); }
        #suscx .sx-dirs { grid-template-columns: minmax(0, 1fr); }
        #suscx .sx-tests { gap: 62px; }
    }
    @media (max-width: 600px) {
        #suscx section .sx-wrap { padding-block: 44px; }
        #suscx .sx-logos { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        #suscx .sx-stats { grid-template-columns: minmax(0, 1fr); }
        #suscx .sx-pains, #suscx .sx-steps { grid-template-columns: minmax(0, 1fr); }
        #suscx .sx-faces { grid-template-columns: repeat(3, minmax(0, 1fr)); }
        #suscx .sx-face img { width: min(80px, 100%); height: auto; }
        #suscx .sx-bigband { grid-template-columns: minmax(0, 1fr); gap: 14px; padding: 22px; }
        #suscx .sx-bigband .sx-h { font-size: 54px; }
        #suscx .sx-mcard { grid-template-columns: minmax(0, 1fr); gap: 12px; }
        #suscx .sx-gift.sx-book { grid-template-columns: minmax(0, 1fr); }
        #suscx .sx-gift.sx-book .sx-pics { max-width: 100%; overflow: hidden; justify-content: flex-start; }
        #suscx .sx-gift.sx-book .sx-alex { width: 50%; height: auto; max-height: 170px; object-fit: contain; object-position: left bottom; }
        #suscx .sx-gift.sx-book .sx-covers { width: 55%; height: auto; max-height: 140px; margin-left: -12px; object-fit: contain; object-position: left bottom; }
        #suscx .sx-ctas .sx-btn { width: 100%; }
    }
    @media (max-width: 380px) {
        #suscx .sx-faces { grid-template-columns: repeat(2, minmax(0, 1fr)); }
        #suscx .sx-logos { grid-template-columns: repeat(2, minmax(0, 1fr)); }
    }
</style>

@php
    $subscriptions = $subscriptions ?? collect();
    $periods = collect($subscriptions)->pluck('period')->filter()->unique()->values();

    // Formato de montos: sin decimales cuando el monto es entero (1,250) y con
    // dos decimales cuando trae centavos.
    $formatAmount = function ($value) {
        if (!is_numeric($value)) {
            return $value;
        }

        $number = (float) $value;
        $decimals = fmod($number, 1.0) === 0.0 ? 0 : 2;

        return number_format($number, $decimals, '.', ',');
    };
@endphp

<!-- tap on top starts-->
<div class="tap-top"><i data-feather="chevrons-up"></i></div>
<!-- tap on tap ends-->

<!-- page-wrapper Start-->
<div class="page-wrapper" id="pageWrapper">
    <!-- Page Header Start-->
    <x-header />
    <!-- Page Header Ends-->
    <!-- Page Body Start-->
    <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <x-sidebar />
        <!-- Page Sidebar Ends-->
        <div class="page-body">
            <div class="container-fluid pt-4">
                <div class="subsx">
                    <!-- 1 · Portada -->
                    <section class="subsx-hero gridbg" id="inicio">
                        <div class="subsx-wrap">
                            <div class="subsx-kicker">Suscripciones CPA Academy</div>
                            <h1>Elige el plan que <em>acompaña</em> tu año profesional</h1>
                            <p class="subsx-lead">
                                Formación continua, consultas especializadas y automatización en una sola
                                suscripción. Aquí encuentras los planes vigentes con sus detalles y su
                                inversión en soles; los planes habilitados muestran también su precio en dólares.
                            </p>
                            <ul class="subsx-checks">
                                <li>Formación en vivo y videoteca bajo demanda</li>
                                <li>Certificados, materiales y contenido actualizado</li>
                                <li>Asesoría especializada según el plan que elijas</li>
                            </ul>
                            <div class="subsx-actions">
                                <a class="subsx-btn" href="#planes">Ver planes</a>
                                <a class="subsx-btn subsx-btn--ghost"
                                    href="https://wa.me/51967052506?text=Hola%2C%20quiero%20informaci%C3%B3n%20sobre%20la%20Suscripci%C3%B3n%20CPA%20Academy%20%5BWEB-SUS%5D"
                                    target="_blank" rel="noopener">
                                    <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8s-.4-.1-.6.1-.6.8-.8 1-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.3-.4.3-.4.7-1.4.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.7 11.8 11.8 0 0 0 4.5 4c1.7.7 2.3.8 3.2.6a2.7 2.7 0 0 0 1.8-1.3 2.2 2.2 0 0 0 .2-1.3c-.1-.1-.3-.2-.5-.3z"/></svg>
                                    Escríbenos por WhatsApp
                                </a>
                            </div>
                            <div class="subsx-claim">
                                <img src="{{ asset('themes/webpage/images/suscripciones/gcpa_white.webp') }}"
                                    alt="Global CPA">
                                <div>
                                    <b>Respaldada por Global CPA</b>
                                    Firma de consultoría contable y financiera, asesoría tributaria,
                                    auditoría y transformación digital.
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- 2 · Secciones de la plantilla antes de los planes -->
                    <div id="suscx" class="v-noacca">
                        {{-- Confianza --}}
                        <section class="sx-trust">
                            <div class="sx-wrap">
                                <h4>Profesionales de estas empresas ya se capacitan con nosotros</h4>
                                <div class="sx-logos">
                                    @foreach (['alicorp', 'bcp', 'bbva', 'interbank', 'pichincha', 'antamina', 'minsur', 'entel', 'prima', 'horizonte', 'finanty', 'redinter', 'san-pablo', 'epsel', 'eps-grau', 'eps-maranon', 'electro-puno'] as $logo)
                                        <div><img loading="lazy" src="{{ asset('img/suscripcion/c_' . $logo . '.webp') }}" alt=""></div>
                                    @endforeach
                                </div>
                                <div class="sx-stats">
                                    <div class="sx-stat"><b>Sobresaliente</b><span>calificación de nuestros alumnos (91.5 sobre 100)</span></div>
                                    <div class="sx-stat"><b>NPS +65</b><span>recomendación de nivel excelente</span></div>
                                    <div class="sx-stat"><b>640</b><span>evaluaciones respaldan estos resultados</span></div>
                                </div>
                            </div>
                        </section>

                        {{-- Contexto --}}
                        <section id="contexto">
                            <div class="sx-wrap">
                                <div class="sx-kicker">El contexto del profesional contable</div>
                                <h2>Más exigencias normativas. <em>El mismo tiempo.</em></h2>
                                <div class="sx-ctx-top">
                                    <p>Cierres mensuales, vencimientos tributarios, cambios normativos constantes y consultas que exigen respuesta inmediata. La carga del profesional contable crece cada año, con el mismo tiempo disponible.</p>
                                    <p class="sx-quote">La responsabilidad técnica siempre recae en tu firma. Por eso necesitas respaldo, no solo información.</p>
                                </div>
                                <div class="sx-pains">
                                    <div class="sx-pain"><div class="sx-n">01</div><h3>Actualización normativa permanente</h3><p>Cada cambio que no se incorpora a tiempo puede convertirse en una contingencia para la empresa o el cliente.</p></div>
                                    <div class="sx-pain"><div class="sx-n">02</div><h3>Consultas que requieren respuesta inmediata</h3><p>Las decisiones necesitan sustento legal verificable, no opiniones sin respaldo.</p></div>
                                    <div class="sx-pain"><div class="sx-n">03</div><h3>Procesos operativos que consumen horas</h3><p>Registros, conciliaciones y cuadres que pueden automatizarse para dedicar ese tiempo al análisis y la asesoría.</p></div>
                                    <div class="sx-pain"><div class="sx-n">04</div><h3>Capacitación con aplicación práctica</h3><p>Formación que se traduce en criterio aplicado a los casos reales del día a día.</p></div>
                                </div>
                                <div class="sx-bigband">
                                    <div class="sx-h">240 h<small>al año</small></div>
                                    <div>
                                        <p>Es el tiempo que destina a tareas repetitivas quien les dedica <b>5 horas por semana</b>: <b>30 jornadas</b> que podrían orientarse al análisis y la asesoría.</p>
                                        <p class="sx-br">La Suscripción CPA Academy integra formación, respaldo técnico y automatización.</p>
                                    </div>
                                </div>
                            </div>
                        </section>

                        {{-- Tres pilares --}}
                        <section class="sx-gray" id="pilares">
                            <div class="sx-wrap">
                                <div class="sx-kicker">Todo en un solo plan</div>
                                <h2>Aprende – Resuelve – <em>Automatiza</em></h2>
                                <p class="sx-lead">Te mantenemos al día, resolvemos tus consultas y, además, <b>trabajamos contigo.</b> Tres pilares que cubren todo tu año profesional.</p>
                                <div class="sx-pillars">
                                    <div class="sx-pil">
                                        <div class="sx-ic"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linejoin="round"><path d="M2 9l10-5 10 5-10 5z"/><path d="M6 11v5c3 2 9 2 12 0v-5"/></svg></div>
                                        <h3>APRENDE</h3>
                                        <div class="sx-why">Para estar al día sin perder tus noches.</div>
                                        <ul>
                                            <li>Formación continua: 9 horas académicas al mes de talleres en vivo (108 al año)</li>
                                            <li>Videoteca con más de 200 horas de cursos</li>
                                            <li>Materiales y certificados</li>
                                            <li>15 % de inversión preferencial en programas de especialización</li>
                                            <li class="acca">Condiciones preferenciales en programas ACCA · CPA Academy</li>
                                            <li class="noacca">Condiciones preferenciales en certificaciones internacionales</li>
                                        </ul>
                                    </div>
                                    <div class="sx-pil">
                                        <div class="sx-ic"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2" stroke-linejoin="round"><path d="M4 4h16v12H8l-4 4z"/><path d="M8 9h8M8 12h5"/></svg></div>
                                        <h3>RESUELVE</h3>
                                        <div class="sx-why">Para no quedarte nunca con la duda.</div>
                                        <ul>
                                            <li>3 agentes expertos 24/7: Tributario, NIIF y Laboral</li>
                                            <li>Banco de consultas especializadas 24/7</li>
                                            <li>1 hora mensual de asesoría con un especialista</li>
                                            <li>Boletines quincenales de actualización</li>
                                            <li>Normas legales del día, todos los días</li>
                                        </ul>
                                    </div>
                                    <div class="sx-pil sx-hot">
                                        <div class="sx-ic"><svg viewBox="0 0 24 24" fill="none" stroke="#fff" stroke-width="2"><circle cx="12" cy="12" r="3.2"/><path d="M12 2v3M12 19v3M2 12h3M19 12h3M4.9 4.9l2.1 2.1M17 17l2.1 2.1M4.9 19.1L7 17M17 7l2.1-2.1"/></svg></div>
                                        <h3>AUTOMATIZA</h3>
                                        <div class="sx-why">Para recuperar tus horas.</div>
                                        <ul>
                                            <li>Un proceso contable o tributario de tu trabajo, automatizado por nuestro equipo cada año</li>
                                            <li>Diagnóstico, diseño, implementación y capacitación incluidos</li>
                                        </ul>
                                        <div class="sx-excl">EXCLUSIVO DE CPA ACADEMY: automatización incluida en tu suscripción.</div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        {{-- Agentes --}}
                        <section id="agentes">
                            <div class="sx-wrap">
                                <div class="sx-kicker">Resuelve · Consultas 24/7</div>
                                <h2>Tres especialistas que no duermen. <em>Y no improvisan.</em></h2>
                                <p class="sx-lead">Entrenados con legislación peruana, RTF, casaciones e informes de SUNAT; con las NIIF, NIC y demás normas contables y financieras; y con las consultas atendidas por nuestra firma de consultoría y su equipo experto. Cada respuesta cita su base legal.</p>
                                <div class="sx-agents">
                                    <div class="sx-ag"><div class="sx-t">AGENTE 01</div><h3>Tributario</h3><p>Normativa tributaria peruana, con los criterios de SUNAT y del Tribunal Fiscal.</p></div>
                                    <div class="sx-ag"><div class="sx-t">AGENTE 02</div><h3>NIIF y Contabilidad</h3><p>NIIF y NIC: reconocimiento, medición, presentación y revelación.</p></div>
                                    <div class="sx-ag"><div class="sx-t">AGENTE 03</div><h3>Laboral</h3><p>Legislación laboral peruana, con los criterios de SUNAFIL.</p></div>
                                </div>
                                <div class="sx-ag-row">
                                    <div class="sx-chatcard">
                                        <div class="sx-hd">Así responde el Agente NIIF <span>● 24/7</span></div>
                                        <div class="sx-bd">
                                            <div class="sx-cb sx-me">La empresa tiene un juicio laboral. ¿Registro una provisión o solo lo revelo en notas?</div>
                                            <div class="sx-cb sx-ai">Depende de la probabilidad. Si es <b>probable</b> que la empresa pague y puedes estimar el monto con fiabilidad, registra una provisión. Si solo es <b>posible</b>, revela un pasivo contingente en notas.<span class="sx-lw">Base: NIC 37, párrafos 14 y 86</span></div>
                                        </div>
                                    </div>
                                    <div class="sx-spec">
                                        <h3>¿Y cuando el caso es complejo? Pasa a un especialista.</h3>
                                        <ol>
                                            <li>Envías tu caso con sus documentos.</li>
                                            <li>Un especialista lo analiza con sustento legal.</li>
                                            <li>Recibes una respuesta escrita y estructurada en hasta 24 horas hábiles.</li>
                                            <li>Lunes a viernes, de 9:00 a. m. a 5:00 p. m. Una hora equivale a un caso analizado.</li>
                                        </ol>
                                    </div>
                                </div>
                                <p class="sx-disc">Las respuestas de los agentes son orientativas y no reemplazan el análisis profesional de un caso concreto.</p>
                            </div>
                        </section>

                        {{-- Automatización --}}
                        <section class="sx-navy sx-gridbg" id="automatizacion">
                            <div class="sx-wrap">
                                <span class="sx-ribbon">EXCLUSIVO DE CPA ACADEMY</span>
                                <h2>Tu suscripción incluye <em>un proceso de tu trabajo, automatizado.</em></h2>
                                <p class="sx-lead">No te enseñamos a automatizar. <b>Lo automatizamos contigo.</b> Eliges el proceso que más horas te quita y el equipo de transformación digital de Global CPA lo diseña, lo construye y te lo entrega funcionando.</p>
                                <div class="sx-steps">
                                    <div class="sx-step"><b>01</b><h3>Diagnóstico</h3><p>Eliges el proceso y nos muestras cómo lo haces hoy.</p></div>
                                    <div class="sx-step"><b>02</b><h3>Diseño</h3><p>Proponemos la solución y acordamos el alcance por escrito.</p></div>
                                    <div class="sx-step"><b>03</b><h3>Implementación</h3><p>Construimos y probamos con tus datos.</p></div>
                                    <div class="sx-step"><b>04</b><h3>Entrega</h3><p>Te capacitamos para que lo uses desde el día uno.</p></div>
                                </div>
                                <div class="sx-chips-lab">PROCESOS QUE PUEDES ELEGIR</div>
                                <div class="sx-chips">
                                    <span class="sx-chip">Registro de compras y ventas · cuadre con SIRE</span>
                                    <span class="sx-chip">Conciliación bancaria</span>
                                    <span class="sx-chip">Estados financieros automáticos</span>
                                    <span class="sx-chip">Semáforos de riesgo tributario</span>
                                    <span class="sx-chip">Control de detracciones y retenciones</span>
                                    <span class="sx-chip">Cálculo de pagos a cuenta</span>
                                    <span class="sx-chip">Análisis de cuentas</span>
                                    <span class="sx-chip">Cuentas por cobrar y cobranzas</span>
                                    <span class="sx-chip">Dashboards financieros y gerenciales</span>
                                    <span class="sx-chip sx-o">y 21 procesos más</span>
                                </div>
                                <div class="sx-math">
                                    <div class="sx-mcard">
                                        <div class="sx-h">153 h<small>recuperadas al año</small></div>
                                        <div>
                                            <div class="sx-k">HAZ LA CUENTA</div>
                                            <p>Si cuadrar compras y ventas con SIRE y conciliar bancos te toma 4 horas por semana y lo automatizamos en un 80 %, recuperas <b>19 jornadas de trabajo</b> al año. Con las 3 automatizaciones del Plan Empresa, <b>más de 450 horas.</b></p>
                                        </div>
                                    </div>
                                    <div class="sx-mcard2"><b>hasta 93 %</b><p>menos tiempo midieron <strong>nuestros alumnos de IA Contable</strong> en los procesos que automatizaron en sus proyectos finales.</p></div>
                                </div>
                                <div class="sx-ctas">
                                    <a class="sx-btn sx-btn-red" href="https://wa.me/51967052506?text=Hola%2C%20quiero%20elegir%20mi%20proceso%20para%20automatizar%20con%20la%20Suscripci%C3%B3n%20CPA%20Academy%20%5BWEB-SUS-AUTO%5D" target="_blank" rel="noopener">
                                        <svg viewBox="0 0 24 24" aria-hidden="true"><path fill="currentColor" d="M12 2a10 10 0 0 0-8.6 15.1L2 22l5-1.3A10 10 0 1 0 12 2zm0 18.2a8.2 8.2 0 0 1-4.2-1.2l-.3-.2-3 .8.8-2.9-.2-.3A8.2 8.2 0 1 1 12 20.2zm4.5-6.1c-.2-.1-1.5-.7-1.7-.8s-.4-.1-.6.1-.6.8-.8 1-.3.2-.5.1a6.7 6.7 0 0 1-3.3-2.9c-.3-.4.3-.4.7-1.4.1-.2 0-.3 0-.4l-.8-1.8c-.2-.5-.4-.4-.6-.4h-.5a1 1 0 0 0-.7.3 3 3 0 0 0-.9 2.2 5.2 5.2 0 0 0 1.1 2.7 11.8 11.8 0 0 0 4.5 4c1.7.7 2.3.8 3.2.6a2.7 2.7 0 0 0 1.8-1.3 2.2 2.2 0 0 0 .2-1.3c-.1-.1-.3-.2-.5-.3z"/></svg>
                                        Elegir mi proceso
                                    </a>
                                </div>
                                <p class="sx-scope"><b>Alcance:</b> Plan Profesional, 1 proceso al año · Plan Equipo, 2 · Plan Empresa, 3. Procesos del catálogo; condiciones en los términos del servicio. Cupos de inicio limitados cada mes. <b>No incluye:</b> desarrollo de ERP, RPA complejo, software a medida ni integraciones empresariales complejas.</p>
                            </div>
                        </section>

                        {{-- Regalos --}}
                        <section id="regalos">
                            <div class="sx-wrap">
                                <div class="sx-kicker">De regalo con tu suscripción en preventa</div>
                                <h2>Te llevas <em>dos regalos.</em></h2>
                                <div class="sx-gifts">
                                    <div class="sx-gift"><span class="sx-num">1</span><h3>Automatizamos un proceso de tu trabajo</h3><p>Tú eliges cuál, de los 30 procesos del catálogo. Hasta 153 horas al año de vuelta.</p></div>
                                    <div class="sx-gift sx-book">
                                        <div class="sx-txt"><span class="sx-num">2</span><h3>Los 3 tomos del ebook <em>El Amauta de las NIIF</em></h3><p>Escritos por Alex Cuzcano, nuestro director académico.</p></div>
                                        <div class="sx-pics">
                                            <img class="sx-alex" src="{{ asset('img/suscripcion/alex_gift.webp') }}" alt="Alex Cuzcano">
                                            <img class="sx-covers" src="{{ asset('img/suscripcion/amauta_covers.webp') }}" alt="Portadas de los 3 tomos de El Amauta de las NIIF">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </section>

                        {{-- Docentes --}}
                        <section class="sx-gray" id="docentes">
                            <div class="sx-wrap">
                                <div class="sx-kicker">Aprende · Formación continua en vivo</div>
                                <h2>Aprendes de quienes <em>auditan, firman y defienden casos</em> cada semana.</h2>
                                <p class="sx-lead">29 especialistas: exsocios y gerentes de Big Four, socios de estudios tributarios y líderes financieros de grandes empresas.</p>
                                @php
                                    $faces = [
                                        ['f_pintado', 'Enrique Pintado', 'Socio en Pintado Espinoza & Asociados'],
                                        ['f_malva', 'Mario Alva', 'Subdirector de la revista Actualidad Empresarial'],
                                        ['f_opicon', 'Oscar Picón', 'Socio en Picón & Asociados'],
                                        ['f_bobadilla', 'Miguel Bobadilla', 'Gerente corporativo en Auna'],
                                        ['f_roca', 'Marco Roca', 'Exsocio de auditoría en Deloitte Perú'],
                                        ['f_velarde', 'Andrés Velarde', 'Gerente de auditoría en Big Four'],
                                        ['f_haytan', 'Karina Haytán', 'Gerente senior en Big Four'],
                                        ['f_valdivia', 'Jefferson Valdivia', 'Gerente senior en Big Four'],
                                        ['f_cordoba', 'Thatiana Córdoba', 'Gerente senior en Big Four, Luxemburgo'],
                                        ['f_palian', 'Jaime Palian', 'Gerente senior en Big Four, EE. UU.'],
                                        ['f_ptorres', 'Pamela Torres', 'Gerente de Impuestos en KPMG Perú'],
                                        ['f_iman', 'Mario Iman', 'Exgerente en Deloitte Perú'],
                                        ['f_esquivel', 'Jhonny Esquivel', 'Exsenior de impuestos en PwC'],
                                        ['f_castro', 'Luis Castro', 'Socio de impuestos en Picón & Asociados'],
                                        ['f_byrne', 'Mónica Byrne', 'Directora de Impuestos en Valderrama Abogados'],
                                        ['f_caceres', 'Christian Cáceres', 'Socio en Gálvez, Risso, Zegarra & Asociados'],
                                        ['f_pretel', 'Jessica Pretel', 'Asociada principal en BZ Tax & Legal'],
                                        ['f_bravo', 'Oscar Bravo', 'Gerente de contabilidad corporativa en AENZA'],
                                        ['f_brito', 'Jesús Brito', 'Gerente de Contabilidad y Tributos en Cálidda'],
                                        ['f_cabrera', 'Milagritos Cabrera', 'Gerente de contabilidad en Terpel'],
                                        ['f_rebolledo', 'Estrella Rebolledo', 'Especialista en contabilidad, sector energía'],
                                        ['f_serna', 'Oscar Serna', 'Especialista en derecho tributario, España'],
                                        ['f_benites', 'Vanessa Benites', 'Especialista en Asesoría Laboral y Tributaria, Global CPA'],
                                        ['f_herrera', 'Luz Herrera', 'Especialista en Automatización Contable y Tributaria, Global CPA'],
                                        ['f_perez', 'Patricia Pérez', 'Especialista en Asesoría Tributaria, Global CPA'],
                                        ['f_ozuna', 'Giovanna Ozuna', 'Coach internacional'],
                                        ['f_ponce', 'Manuel Ponce', 'CEO del Centro de Desarrollo de Habilidades'],
                                        ['f_castillo', 'Jorge Castillo', 'Especialista en derecho laboral'],
                                    ];
                                @endphp
                                <div class="sx-faces">
                                    @foreach ($faces as [$face, $name, $role])
                                        <div class="sx-face">
                                            <img loading="lazy" src="{{ asset('img/suscripcion/' . $face . '.webp') }}" alt="{{ $name }}">
                                            <b>{{ $name }}</b>
                                            <span>{{ $role }}</span>
                                        </div>
                                    @endforeach
                                </div>


                            </div>
                        </section>

                        {{-- Testimonios --}}
                        <section id="testimonios">
                            <div class="sx-wrap">
                                <div class="sx-kicker">Lo que dicen nuestros suscriptores</div>
                                <h2>Quien la prueba, <em>la renueva.</em></h2>
                                <div class="sx-tests">
                                    <div class="sx-tcard">
                                        <img loading="lazy" src="{{ asset('img/suscripcion/t_roger.webp') }}" alt="Roger Grandy">
                                        <span class="sx-qm" aria-hidden="true">“</span>
                                        <p>La membresía anual me da cursos de NIIF, tributación, IA y liderazgo <b>a un precio accesible.</b> Con ella voy a cumplir todas mis metas. La recomiendo.</p>
                                        <div class="sx-who"><b>Roger Grandy</b><span>Consultor contable y tributario independiente</span></div>
                                    </div>
                                    <div class="sx-tcard">
                                        <img loading="lazy" src="{{ asset('img/suscripcion/t_miryam.webp') }}" alt="Miryam Raygada">
                                        <span class="sx-qm" aria-hidden="true">“</span>
                                        <p>Incorporé la IA en mis tareas contables, financieras y de auditoría y <b>mejoré mi productividad.</b> Con la suscripción sigo avanzando. La recomiendo.</p>
                                        <div class="sx-who"><b>Miryam Raygada</b><span>UR Auditores &amp; Consultores</span></div>
                                    </div>
                                    <div class="sx-tcard">
                                        <img loading="lazy" src="{{ asset('img/suscripcion/t_marjiory.webp') }}" alt="Marjiory Adriano">
                                        <span class="sx-qm" aria-hidden="true">“</span>
                                        <p>Atienden mis consultas con rapidez y los cursos tributarios me aportaron mucho valor. <b>Renové mi suscripción</b> porque la atención es de primera.</p>
                                        <div class="sx-who"><b>Marjiory Adriano</b><span>Contador de obra · HV Salfacorp S.A.</span></div>
                                    </div>
                                </div>
                            </div>
                        </section>
                    </div>

                    <!-- 3 · Planes -->
                    <section class="subsx-plans" id="planes">
                        <div class="subsx-wrap">
                            <div class="subsx-kicker">Elige tu plan</div>
                            <h2>Todos los planes, con sus <em>detalles y precios.</em></h2>

                            @if ($periods->count() > 1)
                                <div class="subsx-tabs" role="tablist" aria-label="Filtrar planes por periodo">
                                    <button type="button" class="subsx-tab is-active" data-subsx-tab="todos"
                                        role="tab" aria-selected="true">Todos</button>
                                    @foreach ($periods as $period)
                                        <button type="button" class="subsx-tab" data-subsx-tab="{{ $period }}"
                                            role="tab" aria-selected="false">{{ $period }}</button>
                                    @endforeach
                                </div>
                            @endif

                            @if ($subscriptions->isEmpty())
                                <div class="subsx-empty">
                                    Aún no hay suscripciones disponibles. Escríbenos por WhatsApp y te
                                    contamos las novedades.
                                </div>
                            @else
                                <div class="subsx-grid">
                                    @foreach ($subscriptions as $subscription)
                                        @php
                                            $prices = collect($subscription->prices ?? []);
                                            $pen = $prices->firstWhere('currency', 'PEN') ?? $prices->first();
                                            $usd = $prices->firstWhere('currency', 'USD');
                                            $details = collect($subscription->details ?? []);

                                            $priceNote = $subscription->price_note ?? null;
                                            $priceNoteBelow = $subscription->price_note_below ?? null;
                                            // Sin formato guardado se subraya, como se pidio por defecto.
                                            $priceNoteIsPlain = filled($priceNote) && strip_tags($priceNote) === $priceNote;

                                            $penAmount = $pen['amount'] ?? null;
                                            $penDetail = $pen['detail'] ?? $subscription->period;

                                            $usdAmount = $usd['amount'] ?? null;
                                            $usdDetail = $usd['detail'] ?? null;
                                            $showUsd = $usd
                                                && ($subscription->show_dollar_price ?? true)
                                                && (filled($usdAmount) || filled($usdDetail));
                                        @endphp
                                        <article class="subsx-plan" data-subsx-period="{{ $subscription->period }}">
                                            <span class="subsx-flag">{{ $subscription->period }}</span>
                                            <h3>{{ $subscription->title }}</h3>
                                            <p class="subsx-for">{{ $subscription->description }}</p>

                                            <div class="subsx-price">
                                                @if (filled($priceNote))
                                                    <div class="subsx-before{{ $priceNoteIsPlain ? ' subsx-before--plain' : '' }}">{!! $priceNote !!}</div>
                                                @endif

                                                @if (filled($penAmount))
                                                    <div class="subsx-amt"><small>S/</small> {{ $formatAmount($penAmount) }}</div>
                                                    <div class="subsx-per">{{ $penDetail }}</div>
                                                @else
                                                    <div class="subsx-amt subsx-amt--text">{{ $penDetail ?: 'Cotizar por interno' }}</div>
                                                    <div class="subsx-per">Precio en soles</div>
                                                @endif

                                                @if ($showUsd)
                                                    <div class="subsx-usd">
                                                        @if (filled($usdAmount))
                                                            <b><small>US$</small> {{ $formatAmount($usdAmount) }}</b>
                                                            <span>{{ $usdDetail ?: 'Precio en dólares' }}</span>
                                                        @else
                                                            <b>{{ $usdDetail ?: 'Cotizar por interno' }}</b>
                                                            <span>Precio en dólares</span>
                                                        @endif
                                                    </div>
                                                @endif

                                                @if (filled($priceNoteBelow))
                                                    <div class="subsx-after">{!! $priceNoteBelow !!}</div>
                                                @endif
                                            </div>

                                            @if ($details->isNotEmpty())
                                                <ul class="subsx-details">
                                                    @foreach ($details as $detail)
                                                        @if (filled($detail['label'] ?? null))
                                                            <li>{{ $detail['label'] }}</li>
                                                        @endif
                                                    @endforeach
                                                </ul>
                                            @endif

                                            <a class="subsx-btn"
                                                data-subsx-plan-link="{{ $subscription->id }}"
                                                data-subsx-plan-title="{{ $subscription->title }}"
                                                href="{{ route('academic_step_account', $subscription->id) }}">Suscribirme</a>
                                        </article>
                                    @endforeach
                                </div>
                            @endif

                            <p class="subsx-note">
                                Los importes se muestran tal como se registraron en cada plan. Si resides fuera
                                del Perú y el plan que te interesa no muestra precio en dólares, escríbenos por
                                WhatsApp y coordinamos la forma de pago.
                            </p>
                        </div>
                    </section>

                    <!-- 4 · Preguntas frecuentes -->
                    <section class="subsx-faq" id="preguntas">
                        <div class="subsx-wrap">
                            <div class="subsx-kicker">Últimas dudas</div>
                            <h2>Lo que nos preguntan <em>antes de suscribirse</em></h2>
                            <div class="subsx-faq-list">
                                <details open>
                                    <summary>¿Y si no tengo tiempo para los talleres en vivo?</summary>
                                    <p>Quedan grabados en la videoteca, junto con más de 200 horas de cursos. Y los agentes te responden en minutos, a la hora que sea.</p>
                                </details>
                                <details>
                                    <summary>¿La IA reemplaza al especialista?</summary>
                                    <p>No. Los agentes resuelven lo rápido y citan la base legal para que la verifiques. Lo complejo va a tu hora mensual de asesoría, con un especialista que te responde por escrito en hasta 24 horas hábiles.</p>
                                </details>
                                <details>
                                    <summary>¿Qué proceso pueden automatizar y cuándo empieza?</summary>
                                    <p>Uno de los 30 procesos de nuestro catálogo: registros, conciliaciones, estados financieros, semáforos de riesgo, dashboards y más. Cada mes iniciamos un número limitado de automatizaciones: quien se suscribe primero, automatiza primero. No incluye ERP, RPA complejo ni software a medida.</p>
                                </details>
                                <details>
                                    <summary>¿Puedo pagar en cuotas o mes a mes?</summary>
                                    <p>Sí. El pago anual se puede hacer en cuotas sin intereses con Visa, Mastercard, Diners Club o American Express. También existe el plan mensual (S/ 295, S/ 450 o S/ 750), pero el precio de preventa aplica solo al pago anual.</p>
                                </details>
                                <details>
                                    <summary>¿Mi empresa puede pagarla?</summary>
                                    <p>Sí. Emitimos factura a su nombre. Si son 2 o más personas, los planes Equipo y Empresa bajan el costo por usuario.</p>
                                </details>
                                <details>
                                    <summary>¿Por qué el cobro aparece como Global CPA Business School?</summary>
                                    <p>Es la empresa titular de CPA Academy: GLOBAL CPA BUSINESS SCHOOL S.A.C., RUC 20613668323. Ese es el nombre que verás en tu estado de cuenta y en tu comprobante.</p>
                                </details>
                                <details>
                                    <summary>¿Cuándo recibo mis accesos y los regalos?</summary>
                                    <p>Al confirmar tu pago recibes por WhatsApp y correo tus accesos y los 3 tomos de El Amauta de las NIIF. Al día siguiente te enviamos el enlace para agendar el diagnóstico de tu automatización.</p>
                                </details>
                                <details>
                                    <summary>¿Qué pasa después del 15 de diciembre?</summary>
                                    <p>Termina el precio de preventa. Desde el 16 de diciembre rige el precio de la siguiente etapa.</p>
                                </details>
                                <details>
                                    <summary>Vivo fuera del Perú, ¿puedo suscribirme?</summary>
                                    <p>Sí. Escríbenos por WhatsApp y te enviamos el precio en dólares y la forma de pago.</p>
                                </details>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
        <!-- footer start-->
        <x-footer />
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var tabs = Array.prototype.slice.call(document.querySelectorAll('[data-subsx-tab]'));
        var plans = Array.prototype.slice.call(document.querySelectorAll('[data-subsx-period]'));

        if (!tabs.length) {
            return;
        }

        function applyTab(tab) {
            var target = tab.getAttribute('data-subsx-tab');

            tabs.forEach(function (item) {
                var active = item === tab;
                item.classList.toggle('is-active', active);
                item.setAttribute('aria-selected', active ? 'true' : 'false');
            });

            plans.forEach(function (plan) {
                var show = target === 'todos' || plan.getAttribute('data-subsx-period') === target;
                plan.hidden = !show;
            });
        }

        tabs.forEach(function (tab) {
            tab.addEventListener('click', function () {
                applyTab(tab);
            });
        });
    });
</script>

<script>
    /**
     * Atribucion de la pagina de suscripciones: registra la vista de la pagina y
     * el clic en "Suscribirme" de cada plan junto con las variables UTM.
     */
    (function () {
        var endpoint = @json(route('web_subscriptions_track'));
        var meta = document.querySelector('meta[name="csrf-token"]');
        var token = meta ? meta.getAttribute('content') : '';
        var params = new URLSearchParams(window.location.search);
        var keys = ['utm_source', 'utm_medium', 'utm_campaign', 'utm_term', 'utm_content',
            'utm_id', 'fbclid', 'gclid', 'referer', 'landing_url', 'traffic_source'];

        function stored() {
            try {
                return JSON.parse(localStorage.getItem('traffic_tracking')) || {};
            } catch (e) {
                return {};
            }
        }

        function classify(source, medium) {
            source = (source || '').toLowerCase();
            medium = (medium || '').toLowerCase();
            var paid = /(paid|cpc|ppc|ads)/.test(medium);

            if (/(facebook|^fb$)/.test(source) && paid) return 'facebook_ads';
            if (source.indexOf('google') !== -1 && paid) return 'google_ads';
            if (/(facebook|instagram|tiktok|youtube|linkedin|twitter|threads|whatsapp|^x$)/.test(source) || (source === 'spotify' && !paid)) return 'social';
            if (paid) return 'cpc';
            if (/social/.test(medium)) return 'social';
            if (/(email|newsletter|mail)/.test(source) || /(email|newsletter|mail)/.test(medium)) return 'email';

            return 'organic';
        }

        function send(event, planId) {
            var data = stored();
            var url = {};
            var hasUrlUtm = false;

            keys.forEach(function (key) {
                var value = params.get(key);
                if (value) {
                    url[key] = value;
                    if (key.indexOf('utm_') === 0) hasUrlUtm = true;
                }
            });

            var payload = new FormData();
            payload.append('_token', token);
            payload.append('event', event);

            if (planId) payload.append('subscription_type_id', planId);

            keys.forEach(function (key) {
                var value = url[key] || data[key];
                if (value) payload.append(key, value);
            });

            var source = url.utm_source || data.utm_source || '';
            var medium = url.utm_medium || data.utm_medium || '';
            var trafficSource = hasUrlUtm ? classify(source, medium) : (data.traffic_source || classify(source, medium));

            payload.append('traffic_source', trafficSource);
            payload.append('landing_url', data.landing_url || window.location.href);
            payload.append('referer', data.referer || document.referrer || '');

            if (navigator.sendBeacon) {
                navigator.sendBeacon(endpoint, payload);
                return;
            }

            fetch(endpoint, {
                method: 'POST',
                body: payload,
                credentials: 'same-origin',
                keepalive: true,
            }).catch(function () {});
        }

        send('view');

        document.querySelectorAll('[data-subsx-plan-link]').forEach(function (link) {
            link.addEventListener('click', function () {
                send('click', link.getAttribute('data-subsx-plan-link'));
            });
        });
    })();
</script>

@endsection
