<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <style>
        @page {
            margin: 12px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            color: #24324b;
            font-size: 10px;
            margin: 0;
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .watermark {
            position: fixed;
            top: 40%;
            left: 12%;
            font-size: 92px;
            color: rgba(239, 68, 68, 0.14);
            transform: rotate(-24deg);
            font-weight: bold;
            z-index: 1;
        }

        .page {
            position: relative;
            z-index: 2;
            padding-bottom: 28px;
        }

        .muted {
            color: #64748b;
        }

        .header-band {
            background: #5b6df6;
            color: #ffffff;
            border-radius: 22px 22px 0 0;
            overflow: hidden;
        }

        .header-band td {
            vertical-align: top;
        }

        .header-content {
            padding: 14px 18px 10px 18px;
        }

        .header-accent {
            height: 4px;
            background: #d9ddff;
        }

        .logo {
            max-width: 84px;
            max-height: 34px;
        }

        .brand-kicker {
            font-size: 11px;
            letter-spacing: 0.16em;
            text-transform: uppercase;
            font-weight: bold;
            opacity: 0.86;
        }

        .brand-title {
            margin-top: 4px;
            font-size: 24px;
            line-height: 0.95;
            font-weight: bold;
            text-transform: uppercase;
        }

        .brand-web {
            margin-top: 4px;
            font-size: 10px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #9df7b9;
            font-weight: bold;
        }

        .brand-meta {
            display: none;
        }

        .brand-visual {
            margin-left: auto;
            width: 200px;
            height: 86px;
            padding: 0;
        }

        .visual-stage {
            position: relative;
            width: 100%;
            height: 86px;
        }

        .visual-panel {
            position: absolute;
            left: 18px;
            top: 20px;
            width: 78px;
            height: 44px;
            border-radius: 6px;
            background: rgba(255, 255, 255, 0.3);
            border: 2px solid rgba(255, 255, 255, 0.22);
        }

        .visual-desk {
            position: absolute;
            left: 8px;
            right: 16px;
            bottom: 16px;
            height: 8px;
            border-radius: 999px;
            background: #3741b7;
        }

        .visual-avatar {
            position: absolute;
            right: 18px;
            top: 10px;
            width: 54px;
            height: 54px;
            border-radius: 16px;
            background: #86efe2;
        }

        .visual-avatar::before {
            content: '';
            position: absolute;
            top: 7px;
            left: 17px;
            width: 20px;
            height: 20px;
            border-radius: 999px;
            background: #1e293b;
        }

        .visual-avatar::after {
            content: '';
            position: absolute;
            left: 12px;
            bottom: 8px;
            width: 30px;
            height: 18px;
            border-radius: 14px 14px 10px 10px;
            background: #ff7a59;
        }

        .visual-dot {
            position: absolute;
            width: 6px;
            height: 6px;
            border-radius: 999px;
            background: rgba(255, 255, 255, 0.55);
        }

        .visual-dot.dot-a {
            left: 122px;
            top: 12px;
        }

        .visual-dot.dot-b {
            left: 132px;
            top: 24px;
        }

        .visual-dot.dot-c {
            left: 144px;
            top: 16px;
        }

        .brand-visual img {
            position: absolute;
            left: 22px;
            top: 24px;
        }

        .brand-chip {
            display: none;
        }

        .doc-strip {
            border: 1px solid #dbe5ff;
            border-top: none;
            border-radius: 0 0 22px 22px;
            background: #ffffff;
            padding: 12px 16px;
        }

        .doc-title {
            font-size: 18px;
            font-weight: bold;
            color: #2d3ea8;
            text-transform: uppercase;
        }

        .doc-number {
            margin-top: 2px;
            font-size: 11px;
            font-weight: bold;
            color: #5b6df6;
        }

        .doc-meta-label {
            font-size: 9px;
            letter-spacing: 0.12em;
            text-transform: uppercase;
            color: #7b88a8;
            font-weight: bold;
        }

        .doc-meta-value {
            margin-top: 2px;
            font-size: 11px;
            font-weight: bold;
            color: #24324b;
        }

        .doc-meta-note {
            margin-top: 2px;
            font-size: 9px;
            color: #6b7280;
        }

        .doc-box {
            width: 265px;
            margin-left: auto;
            background: #f8fbff;
            color: #24324b;
            border-radius: 18px;
            padding: 18px;
            text-align: center;
            border: 2px solid #c7d2fe;
        }

        .doc-box .ruc {
            font-size: 12px;
            color: #5b6b84;
            font-weight: bold;
        }

        .doc-box .title {
            margin-top: 8px;
            font-size: 18px;
            font-weight: bold;
            color: #3347c7;
        }

        .doc-box .subtitle {
            font-size: 12px;
            color: #64748b;
            margin-top: 3px;
        }

        .doc-box .serie {
            margin-top: 12px;
            font-size: 16px;
            color: #4f46e5;
            font-weight: bold;
            background: #eef2ff;
            border-radius: 12px;
            padding: 8px 10px;
        }

        .section {
            margin-top: 10px;
        }

        .card {
            background: #fcfdff;
            border: 1px solid #dbe5ff;
            border-radius: 0;
            padding: 10px 12px;
        }

        .section-title {
            font-size: 9px;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            color: #4f46e5;
            font-weight: bold;
            margin-bottom: 6px;
        }

        .meta-table td {
            vertical-align: top;
            padding: 2px 0;
            font-size: 10px;
        }

        .meta-label {
            width: 100px;
            color: #6b7280;
        }

        .items thead td {
            background: #ede9fe;
            color: #3730a3;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 7px 7px;
            border-bottom: 1px solid #d8d4fe;
        }

        .items tbody td {
            border-bottom: 1px solid #dbe5ff;
            padding: 7px 7px;
            font-size: 10px;
            vertical-align: top;
        }

        .amount {
            text-align: right;
            white-space: nowrap;
        }

        .item-code {
            color: #64748b;
            font-size: 11px;
        }

        .discount-note {
            margin-top: 4px;
            color: #4f46e5;
            font-size: 9px;
        }

        .summary-box {
            width: 290px;
            margin-left: auto;
            background: #f8fbff;
            color: #24324b;
            border-radius: 0;
            padding: 8px 10px;
            border: 1px solid #c7d2fe;
            border-top: 3px solid #5b6df6;
        }

        .summary-box table td {
            padding: 3px 0;
            font-size: 10px;
        }

        .summary-box .grand-total td {
            border-top: 1px solid #c7d2fe;
            padding-top: 6px;
            font-size: 11px;
            font-weight: bold;
            color: #3347c7;
        }

        .info-card {
            border: 1px solid #dbe5ff;
            border-radius: 0;
            padding: 10px 12px;
            background: #ffffff;
        }

        .binary-strip {
            margin-top: 8px;
            font-size: 18px;
            letter-spacing: 0.06em;
            color: #eef2ff;
            font-weight: bold;
            line-height: 1;
            word-break: break-all;
        }

        .footer-note {
            color: #5b6b84;
            font-size: 9px;
            line-height: 1.6;
        }

        .qr-box {
            text-align: center;
        }

        .qr-box img {
            width: 90px;
            height: 90px;
        }

        .payments-table thead td,
        .mini-table thead td {
            background: #ede9fe;
            color: #3730a3;
            font-size: 9px;
            font-weight: bold;
            text-transform: uppercase;
            padding: 6px;
        }

        .payments-table tbody td,
        .mini-table tbody td {
            border-bottom: 1px solid #dbe5ff;
            padding: 6px;
            font-size: 9px;
        }

        .bank-cell {
            width: 50%;
            vertical-align: top;
            padding: 8px 6px 0 0;
        }

        .bank-card {
            border: 1px solid #dbe5ff;
            border-radius: 14px;
            padding: 12px;
            min-height: 72px;
            background: #ffffff;
            border-top: 3px solid #a5b4fc;
        }

        .bank-logo-cell {
            width: 54px;
            vertical-align: top;
        }

        .bank-logo {
            max-width: 40px;
            max-height: 40px;
        }

        .bank-title {
            font-size: 12px;
            font-weight: bold;
        }

        .bank-subtitle,
        .bank-detail {
            font-size: 9px;
            color: #5b6b84;
        }
        .example-header {
            padding: 6px 0;
            margin-bottom: 10px;
            border-bottom: 1px solid #aaaaaa;
        }

        .example-header #logo {
            float: left;
            margin-top: 8px;
        }

        .example-header #logo img {
            height: 52px;
            max-width: 150px;
            object-fit: contain;
        }

        .example-header #company {
            float: right;
            text-align: right;
            font-size: 9px;
            color: #555555;
        }

        .example-header #company .name {
            margin: 0 0 3px 0;
            color: #0087c3;
            font-size: 18px;
            font-weight: normal;
        }

        .example-details {
            margin-bottom: 10px;
        }

        .example-details #client {
            float: left;
            width: 56%;
            padding-left: 2px;
            border-left: 4px solid #0087c3;
        }

        .example-details #client .to {
            color: #777777;
            font-size: 9px;
            margin-bottom: 1px;
        }

        .example-details #client .name {
            font-size: 14px;
            font-weight: normal;
            margin: 0 0 2px 0;
            color: #333333;
        }

        .example-details #client .line {
            font-size: 9px;
            color: #666666;
            line-height: 1.1;
            margin: 0;
        }

        .example-details #invoice {
            float: right;
            width: 38%;
            text-align: right;
        }

        .example-details #invoice h1 {
            color: #0087c3;
            font-size: 20px;
            line-height: 1.05;
            font-weight: normal;
            margin: 0 0 2px 0;
        }

        .example-details #invoice .date {
            font-size: 9px;
            color: #777777;
            line-height: 1.1;
            margin: 0;
        }

        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 10px;
        }

        .invoice-table th,
        .invoice-table td {
            padding: 6px 5px;
            background: #eeeeee;
            border-bottom: 1px solid #ffffff;
        }

        .invoice-table thead th {
            white-space: nowrap;
            font-weight: normal;
            font-size: 9px;
            text-align: center;
            color: #555555;
        }

        .invoice-table tbody td {
            text-align: right;
            font-size: 9px;
            color: #555555;
        }

        .invoice-table tbody tr:last-child td {
            border-bottom: none;
        }

        .invoice-table .no {
            width: 28px;
            color: #ffffff;
            font-size: 11px;
            text-align: center;
            background: #57b223;
        }

        .invoice-table .desc {
            text-align: left;
        }

        .invoice-table .unit {
            background: #dddddd;
            text-align: center;
        }

        .invoice-table .qty {
            text-align: center;
        }

        .invoice-table .total {
            background: #57b223;
            color: #ffffff;
        }

        .invoice-table .desc-title {
            color: #57b223;
            font-size: 11px;
            font-weight: normal;
            margin: 0 0 2px 0;
        }

        .invoice-table .desc-sub {
            font-size: 8px;
            color: #666666;
            line-height: 1.2;
        }

        .invoice-table tfoot td {
            padding: 4px 5px;
            background: #ffffff;
            border-bottom: none;
            font-size: 9px;
            white-space: nowrap;
            border-top: 1px solid #aaaaaa;
            text-align: right;
            color: #555555;
        }

        .invoice-table tfoot tr:first-child td {
            border-top: none;
        }

        .invoice-table tfoot tr:last-child td {
            color: #57b223;
            font-size: 11px;
            border-top: 1px solid #57b223;
        }

        .invoice-table tfoot tr td:first-child {
            border: none;
            background: transparent;
        }

        .aux-grid {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }

        .aux-grid td {
            vertical-align: top;
            background: transparent;
            border: none;
            padding: 0;
        }

        #thanks {
            font-size: 18px;
            margin-bottom: 8px;
            color: #333333;
        }

        #notices {
            padding-left: 5px;
            border-left: 4px solid #0087c3;
        }

        #notices .label {
            font-size: 9px;
            color: #777777;
            margin-bottom: 4px;
        }

        #notices .notice {
            font-size: 8px;
            line-height: 1.25;
            color: #555555;
        }

        .section-stack {
            margin-top: 6px;
        }

        .notice-card {
            margin-top: 6px;
            padding-left: 5px;
            border-left: 4px solid #0087c3;
        }

        .notice-card:first-child {
            margin-top: 0;
        }

        .notice-card .title {
            font-size: 9px;
            color: #777777;
            margin-bottom: 4px;
        }

        .notice-card .body {
            font-size: 8px;
            line-height: 1.25;
            color: #555555;
        }

        .notice-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 4px;
        }

        .notice-table td,
        .notice-table th {
            border: 1px solid #dddddd;
            padding: 3px 4px;
            background: #ffffff;
            font-size: 8px;
            text-align: left;
            color: #555555;
        }

        .notice-table th {
            background: #f5f5f5;
            font-weight: normal;
        }

        .qr-card {
            border: 1px solid #dddddd;
            padding: 6px;
            text-align: center;
        }

        .qr-card img {
            width: 76px;
            height: 76px;
            object-fit: contain;
        }

        .qr-card .title {
            font-size: 9px;
            color: #777777;
            margin-bottom: 4px;
        }

        .qr-card .body {
            font-size: 8px;
            line-height: 1.2;
            color: #666666;
            margin-top: 4px;
        }

        .document-footer {
            color: #777777;
            width: 100%;
            border-top: 1px solid #aaaaaa;
            padding: 5px 0;
            text-align: center;
            font-size: 9px;
            position: fixed;
            left: 0;
            right: 0;
            bottom: 0;
            background: #f1f5f9;
        }

        .document-footer .sep {
            color: #cbd5e1;
            padding: 0 8px;
        }
    </style>
</head>

<?php
    $company = \App\Models\Company::first();

    // Simbolo de moneda del comprobante (PEN -> S/, USD -> US$)
    $currencySymbol = ($document->getTipoMoneda() ?? 'PEN') === 'USD' ? 'US$' : 'S/';

    $brandImage = $company->isotipo === '/img/isotipo.png'
        ? public_path($company->isotipo)
        : public_path('storage' . DIRECTORY_SEPARATOR . $company->isotipo);
    if (!is_file($brandImage)) {
        $brandImage = $company->logo_document === '/img/logo176x32.png'
            ? public_path($company->logo_document)
            : public_path('storage' . DIRECTORY_SEPARATOR . $company->logo_document);
    }

    $bankAccounts = \App\Models\BankAccount::with('bank')->where('invoice_show', true)->get();

    $documentCredito = \App\Models\Sale::whereHas('document', function ($query) use ($document) {
            $query->where('invoice_serie', $document->getSerie())
                ->where('invoice_correlative', $document->getCorrelativo())
                ->where('forma_pago', 'Credito');
        })
        ->with('document.quotas.payments')
        ->first();

    $paymentMethods = \App\Models\PaymentMethod::get();

    function getPaymentMethodByIdV2($id, $paymentMethods)
    {
        foreach ($paymentMethods as $method) {
            if (isset($method->id) && $method->id == $id) {
                return $method->description;
            }
        }

        return '-';
    }

    $documentDiscountTotal = 0;
    foreach ($document->getDetails() as $detail) {
        $documentDiscountTotal += method_exists($detail, 'getDescuento') ? (float) ($detail->getDescuento() ?? 0) : 0;
    }

    $hasAnyPaymentsToShow = false;
    if ($documentCredito) {
        if ($documentCredito->document->single_payment) {
            foreach ($documentCredito->document->quotas as $quota) {
                if (count($quota->payments) > 0) {
                    $hasAnyPaymentsToShow = true;
                }
            }
            if ($documentCredito->payments) {
                $hasAnyPaymentsToShow = true;
            }
        } else {
            foreach ($documentCredito->document->quotas as $quota) {
                if (count($quota->payments) > 0) {
                    $hasAnyPaymentsToShow = true;
                }
            }
        }
    }
?>

<body>
    <?php if($status == 3): ?>
        <div class="watermark">ANULADO</div>
    <?php endif; ?>

    <?php
        $clientAddress = $document->getClient()->getAddress();
        $clientAddressText = is_object($clientAddress) && method_exists($clientAddress, 'getDireccion')
            ? $clientAddress->getDireccion()
            : ($clientAddress ?? '');
        $clientLocationText = is_object($clientAddress) && method_exists($clientAddress, 'getDepartamento')
            ? trim(($clientAddress->getDepartamento() ?? '') . '-' . ($clientAddress->getProvincia() ?? '') . '-' . ($clientAddress->getDistrito() ?? ''), '-')
            : '';
        $companyAddress = $document->getCompany()->getAddress();
    ?>

    <div class="page">
        <header class="example-header clearfix">
            <div id="logo">
                <?php if(is_file($brandImage)): ?>
                    <img src="<?php echo e($brandImage); ?>">
                <?php endif; ?>
            </div>
            <div id="company">
                <h2 class="name"><?php echo e($document->getCompany()->getRazonSocial()); ?></h2>
                <div>RUC <?php echo e($document->getCompany()->getRuc()); ?></div>
                <div><?php echo e($companyAddress->getDireccion()); ?></div>
                <div><?php echo e($companyAddress->getDepartamento()); ?>-<?php echo e($companyAddress->getProvincia()); ?>-<?php echo e($companyAddress->getDistrito()); ?></div>
                <div><?php echo e(env('APP_URL')); ?></div>
            </div>
        </header>

        <main>
            <div id="details" class="example-details clearfix">
                <div id="client">
                    <div class="to">CLIENTE:</div>
                    <h2 class="name"><?php echo e($document->getClient()->getRznSocial()); ?></h2>
                    <div class="line"><?php echo e($document->getTipoDoc() == '01' ? 'RUC' : 'Documento'); ?>: <?php echo e($document->getClient()->getNumDoc()); ?></div>
                    <?php if($clientAddressText): ?>
                        <div class="line"><?php echo e($clientAddressText); ?></div>
                    <?php endif; ?>
                    <?php if($clientLocationText): ?>
                        <div class="line"><?php echo e($clientLocationText); ?></div>
                    <?php endif; ?>
                </div>
                <div id="invoice">
                    <h1><?php echo e($document->getTipoDoc() == '01' ? 'FACTURA ELECTRÓNICA' : 'BOLETA ELECTRÓNICA'); ?></h1>
                    <div class="date">Nro: <?php echo e($document->getSerie()); ?>-<?php echo e($document->getCorrelativo()); ?></div>
                    <div class="date">Fecha de emisión: <?php echo e($document->getFechaEmision()->format('d/m/Y')); ?></div>
                    <?php if($document->getFecVencimiento()): ?>
                        <div class="date">Fecha de vencimiento: <?php echo e($document->getFecVencimiento()->format('d/m/Y')); ?></div>
                    <?php endif; ?>
                    <div class="date">Moneda: PEN</div>
                </div>
            </div>

            <table class="invoice-table">
                <thead>
                    <tr>
                        <th class="no">#</th>
                        <th class="desc">DESCRIPCION</th>
                        <th class="unit">UNIDAD</th>
                        <th class="qty">CANT.</th>
                        <th class="total">TOTAL</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $document->getDetails(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $itemDiscount = method_exists($item, 'getDescuento')
                                ? (float) ($item->getDescuento() ?? 0)
                                : 0;
                        ?>
                        <tr>
                            <td class="no"><?php echo e(str_pad((string) ($index + 1), 2, '0', STR_PAD_LEFT)); ?></td>
                            <td class="desc">
                                <div class="desc-title"><?php echo e($item->getDescripcion()); ?></div>
                                <div class="desc-sub">Codigo: <?php echo e($item->getCodProducto() ?: '-'); ?></div>
                                <?php if($itemDiscount > 0): ?>
                                    <div class="desc-sub">Descuento SUNAT: <?php echo e($currencySymbol); ?> <?php echo e(number_format($itemDiscount, 2, '.', ',')); ?></div>
                                <?php endif; ?>
                            </td>
                            <td class="unit"><?php echo e($item->getUnidad()); ?></td>
                            <td class="qty"><?php echo e($item->getCantidad()); ?></td>
                            <td class="total"><?php echo e($currencySymbol); ?> <?php echo e(number_format($item->getMtoPrecioUnitario(), 2, '.', ',')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">OP. GRAVADAS</td>
                        <td><?php echo e($currencySymbol); ?> <?php echo e(number_format($document->getMtoOperGravadas(), 2, '.', ',')); ?></td>
                    </tr>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">I.G.V.</td>
                        <td><?php echo e($currencySymbol); ?> <?php echo e(number_format($document->getMtoIGV(), 2, '.', ',')); ?></td>
                    </tr>
                    <?php if($documentDiscountTotal > 0): ?>
                        <tr>
                            <td colspan="2"></td>
                            <td colspan="2">DESCUENTO</td>
                            <td><?php echo e($currencySymbol); ?> <?php echo e(number_format($documentDiscountTotal, 2, '.', ',')); ?></td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td colspan="2"></td>
                        <td colspan="2">TOTAL</td>
                        <td><?php echo e($currencySymbol); ?> <?php echo e(number_format($document->getMtoImpVenta(), 2, '.', ',')); ?></td>
                    </tr>
                </tfoot>
            </table>

            <table class="aux-grid">
                <tr>
                    <td style="width: 64%; padding-right: 16px;">
                        <div id="thanks">Gracias</div>
                        <div id="notices">
                            <div class="label">INFORMACION ADICIONAL:</div>
                            <div class="notice">
                                <strong>Importe en letras:</strong> <?php echo e($document->getLegends()[0]->getValue()); ?><br>
                                <?php $__currentLoopData = $params['user']['extras']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <strong><?php echo e($extra['name']); ?>:</strong> <?php echo e($extra['value']); ?><br>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                Consulte su comprobante en <strong><?php echo e(env('APP_URL')); ?></strong>.<br>
                                Representación impresa de la <?php echo e($document->getTipoDoc() == '01' ? 'factura' : 'boleta de venta'); ?> electrónica.
                            </div>
                        </div>
                    </td>
                    <td style="width: 36%;">
                        <div class="qr-card">
                            <div class="title">CODIGO QR</div>
                            <img src="<?php echo e($qr_path); ?>">
                            <div class="body">
                                <?php echo e($document->getSerie()); ?>-<?php echo e($document->getCorrelativo()); ?><br>
                                <?php echo e(env('APP_URL')); ?>

                            </div>
                        </div>
                    </td>
                </tr>
            </table>

            <div class="section-stack">
                <?php if($hasAnyPaymentsToShow): ?>
                    <div class="notice-card">
                        <div class="title">PAGOS</div>
                        <div class="body">
                            <table class="notice-table">
                                <thead>
                                    <tr>
                                        <th>Descripcion</th>
                                        <th>Fecha</th>
                                        <th>Metodo</th>
                                        <th>Referencia</th>
                                        <th>Monto</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php if($documentCredito->document->single_payment): ?>
                                        <?php $__currentLoopData = $documentCredito->document->quotas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $quota->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <?php if($pay->estado): ?>
                                                    <tr>
                                                        <td>Pago cuota <?php echo e($quota->quota_number); ?> <?php echo e($pay->description); ?></td>
                                                        <td><?php echo e($pay->payment_date); ?></td>
                                                        <td><?php echo e(getPaymentMethodByIdV2($pay->payment_method_id, $paymentMethods)); ?></td>
                                                        <td><?php echo e($pay->reference); ?></td>
                                                        <td><?php echo e(number_format($pay->amount_applied, 2, '.', '')); ?></td>
                                                    </tr>
                                                <?php endif; ?>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php $__currentLoopData = $documentCredito->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <tr>
                                                <td><?php echo e($pay['description']); ?></td>
                                                <td><?php echo e($pay['payment_date']); ?></td>
                                                <td><?php echo e(getPaymentMethodByIdV2($pay['type'], $paymentMethods)); ?></td>
                                                <td><?php echo e($pay['reference']); ?></td>
                                                <td><?php echo e(number_format($pay['amount'], 2, '.', '')); ?></td>
                                            </tr>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php else: ?>
                                        <?php $__currentLoopData = $documentCredito->document->quotas; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $quota): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <?php $__currentLoopData = $quota->payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $pay): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                                <tr>
                                                    <td>Pago cuota <?php echo e($quota->quota_number); ?> <?php echo e($pay->description); ?></td>
                                                    <td><?php echo e($pay->payment_date); ?></td>
                                                    <td><?php echo e(getPaymentMethodByIdV2($pay->payment_method_id, $paymentMethods)); ?></td>
                                                    <td><?php echo e($pay->reference); ?></td>
                                                    <td><?php echo e(number_format($pay->amount_applied, 2, '.', '')); ?></td>
                                                </tr>
                                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($document->getMtoImpVenta() > 0 && $document->getDetraccion()): ?>
                    <?php
                        $netPayment = $document->getMtoImpVenta() - $document->getDetraccion()->getMount();
                    ?>
                    <div class="notice-card">
                        <div class="title">DETRACCION</div>
                        <div class="body">
                            Monto neto de pago: <strong><?php echo e($currencySymbol); ?> <?php echo e(number_format($netPayment, 2, '.', ',')); ?></strong>
                            <table class="notice-table">
                                <tbody>
                                    <tr>
                                        <td>Cta. Banco de la Nación</td>
                                        <td><?php echo e($document->getDetraccion()->getCtaBanco()); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Código de bien o servicio</td>
                                        <td><?php echo e($document->getDetraccion()->getCodBienDetraccion()); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Monto</td>
                                        <td><?php echo e(number_format($document->getDetraccion()->getMount(), 2, '.', ',')); ?></td>
                                    </tr>
                                    <tr>
                                        <td>Porcentaje</td>
                                        <td><?php echo e($document->getDetraccion()->getPercent()); ?></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>

                <?php if($document->getObservacion()): ?>
                    <div class="notice-card">
                        <div class="title">OBSERVACIONES</div>
                        <div class="body"><?php echo e($document->getObservacion()); ?></div>
                    </div>
                <?php endif; ?>

                <?php if(count($bankAccounts) > 0): ?>
                    <div class="notice-card">
                        <div class="title">CUENTAS BANCARIAS</div>
                        <div class="body">
                            <table class="notice-table">
                                <thead>
                                    <tr>
                                        <th>Cuenta</th>
                                        <th>Banco</th>
                                        <th>Número</th>
                                        <th>CCI</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $__currentLoopData = $bankAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <tr>
                                            <td><?php echo e($account->description); ?></td>
                                            <td><?php echo e($account->bank->full_name); ?></td>
                                            <td><?php echo e($account->number); ?></td>
                                            <td><?php echo e($account->cci); ?></td>
                                        </tr>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </main>

        <div class="document-footer">
            <?php echo e($document->getCompany()->getNombreComercial()); ?>

            <span class="sep">|</span>
            <?php echo e($document->getCompany()->getEmail()); ?>

            <span class="sep">|</span>
            <?php echo e($document->getCompany()->getTelephone()); ?>

        </div>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\globalcpa\Modules\Sales\Resources\views\sales\invoice_a4_v2.blade.php ENDPATH**/ ?>