<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        * {
            margin: 0;
            box-sizing: border-box;
            font-family: "VT323", monospace;
            color: #1f1f1f;
        }

        .bold {
            font-weight: bold;
        }

        .center {
            text-align: center;
        }

        .receipt {
            width: 100%;
            margin: 0 auto;
        }

        .logo {
            text-align: center;
            padding: 20px;
        }

        .barcode {
            font-family: "Libre Barcode 128", cursive;
            font-size: 42px;
            text-align: center;
        }

        .address {
            text-align: center;
            margin-bottom: 10px;
        }

        .transactionDetails {
            display: flex;
            justify-content: space-between;
        }

        .transactionDetails .detail {
            text-transform: uppercase;
        }

        .centerItem {
            display: flex;
            justify-content: center;
            margin-bottom: 8px;
        }

        .survey {
            text-align: center;
            margin-bottom: 12px;
        }

        .survey .surveyID {
            font-size: 14px;
        }

        .paymentDetails {
            display: flex;
            justify-content: space-between;
            margin: 0 auto;
        }

        .creditDetails {
            margin: 10px auto;
            width: 273px;
            font-size: 14px;
            text-transform: uppercase;
        }

        .receiptBarcode {
            margin: 10px 0;
            text-align: center;
        }

        .returnPolicy {
            margin: 10px 20px;
            width: 273px;
            display: flex;
            justify-content: space-between;
        }

        .coupons {
            margin-top: 20px;
        }

        .tripSummary {
            margin: auto;
            width: 273px;
        }

        .tripSummary .item {
            display: flex;
            justify-content: space-between;
            margin: auto;
            width: 273px;
        }

        .feedback {
            margin: 20px auto;
        }

        .feedback h3.clickBait {
            font-size: 14px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
        }

        .feedback h4.web {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            margin: 10px 0;
        }

        .feedback .break {
            text-align: center;
            font-size: 18px;
            font-weight: bold;
            margin: 10px 0;
        }

        .couponContainer {
            border-top: 1px dashed #1f1f1f;
            margin-bottom: 20px;
        }

        .couponContainer .discount {
            font-size: 35px;
            text-align: center;
            margin-bottom: 10px;
        }

        .couponContainer .discountDetails {
            font-size: 20px;
            text-align: center;
            margin-bottom: 15px;
        }

        .couponContainer .barcode {
            margin: 10px 0 0;
        }

        .couponContainer .legal {
            font-size: 12px;
            margin-bottom: 12px;
        }

        .couponContainer .barcodeID {
            margin-bottom: 8px;
        }

        .couponContainer .expiration {
            display: flex;
            justify-content: space-between;
            margin: 10px;
        }

        .couponContainer .couponBottom {
            font-size: 13px;
            text-align: center;
        }

        .centrado {
            text-align: center;
            align-content: center;
        }

        .container {
            padding: 0px 4px 0px 4px
        }

        .watermark {
            position: absolute;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%) rotate(-30deg);
            font-size: 50px;
            font-weight: bold;
            color: rgba(255, 0, 0, 0.2);
            /* Rojo con opacidad */
            white-space: nowrap;
        }
    </style>
</head>
<?php
    $company = \App\Models\Company::first();

    // Simbolo de moneda del comprobante (PEN -> S/, USD -> US$)
    $currencySymbol = ($document->getTipoMoneda() ?? 'PEN') === 'USD' ? 'US$' : 'S/';

    $logo = '';
    if ($company->logo_document == '/img/logo176x32.png') {
        $logo = public_path($company->logo_document);
    } else {
        $logo = public_path('storage' . DIRECTORY_SEPARATOR . $company->logo_document);
    }
    $bankAccounts = \App\Models\BankAccount::with('bank')->where('invoice_show',true)->get();
?>

<body>
    <?php if($status == 3): ?>
        <div class="watermark">ANULADO</div>
    <?php endif; ?>
    <div class="container">
        <div class="receipt">
            <div style="margin-top:36px;width:100%;text-align: center">
                <img src="<?php echo e($logo); ?>" class="centrado" style="width: 70%">
            </div>

            <div class="address">
                <?php echo e($document->getCompany()->getRazonSocial()); ?><br>
                R.U.C.: <?php echo e($document->getCompany()->getRuc()); ?><br>
                Teléfono: <?php echo e($params['user']['header']); ?><br>
                <?php echo e($document->getCompany()->getAddress()->getDireccion()); ?>

            </div>
            <table style="width: 100%">
                <tr>
                    <?php if($document->getTipoDoc() == '01'): ?>
                        <td align="center">
                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:18px" text-align="center">
                                FACTURA
                            </span>
                            <br>
                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:12px" text-align="center">
                                E L E C T R Ó N I C A
                            </span>
                        </td>
                    <?php elseif($document->getTipoDoc() == '03'): ?>
                        <td align="center">
                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:18px" text-align="center">
                                BOLETA DE VENTA
                            </span>
                            <br>
                            <span style="font-family:Tahoma, Geneva, sans-serif; font-size:12px" text-align="center">
                                E L E C T R Ó N I C A
                            </span>
                        </td>
                    <?php endif; ?>
                </tr>
                <tr>
                    <td align="center">
                        <span style="font-size:18px">
                            <?php echo e($document->getSerie()); ?>-<?php echo e($document->getCorrelativo()); ?>

                        </span>
                    </td>
                </tr>
            </table>
            <div class="transactionDetails" style="margin-top: 26px">
                <div class="detail" style="font-size: 12px">
                    <?php if($document->getTipoDoc() == '01'): ?>
                        <strong>RUC:</strong>
                    <?php elseif($document->getTipoDoc() == '03'): ?>
                        <strong>N/D:</strong>
                    <?php endif; ?>
                    <?php echo e($document->getClient()->getNumDoc()); ?>

                </div>
                <div class="detail" style="font-size: 12px">
                    <strong>Razón Social:</strong>
                    <?php echo e($document->getClient()->getRznSocial()); ?>

                </div>
                <div class="detail" style="font-size: 12px">
                    <strong>Dirección: </strong>
                    <?php
                        $clientAddress = $document->getClient()->getAddress();
                        $clientAddressText = is_object($clientAddress) && method_exists($clientAddress, 'getDireccion')
                            ? $clientAddress->getDireccion()
                            : ($clientAddress ?? '');
                    ?>
                    <?php echo e($clientAddressText); ?>

                </div>
                <div class="detail" style="font-size: 12px">
                    <strong>Fecha Emisión: </strong>
                    <?php echo e($document->getFechaEmision()->format('Y-m-d H:i:s')); ?>

                </div>
            </div>
            <div class="transactionDetails" style="font-size: 12px">
                <?php $__currentLoopData = $params['user']['extras']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $extra): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php echo e($extra['name']); ?> : <?php echo e($extra['value']); ?><br />
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
            <?php
                $documentDiscountTotal = 0;
                foreach ($document->getDetails() as $detail) {
                    $documentDiscountTotal += method_exists($detail, 'getDescuento')
                        ? (float) ($detail->getDescuento() ?? 0)
                        : 0;
                }
            ?>
            <table style="font-size: 11px; width: 100%;border: 0px; border-collapse: collapse; ">
                <thead>
                    <tr>
                        <td style="border-bottom: 1px solid black !important; padding: 4px 2px 4px 2px;" align="center"
                            class="bold">Cant.</td>
                        <td style="border-bottom: 1px solid black !important; padding: 4px 2px 4px 2px;" align="center"
                            class="bold">Unidad</td>
                        <td style="border-bottom: 1px solid black !important; padding: 4px 2px 4px 2px;" align="left"
                            class="bold">Descripción</td>
                        <td style="border-bottom: 1px solid black !important; padding: 4px 2px 4px 2px;" align="center"
                            class="bold">Valor Total</td>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $document->getDetails(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $itemDiscount = method_exists($item, 'getDescuento')
                                ? (float) ($item->getDescuento() ?? 0)
                                : 0;
                        ?>
                        <tr>
                            <td align="center" style="padding: 4px 0px 4px 0px">
                                <?php echo e($item->getCantidad()); ?>

                            </td>
                            <td align="center" style="padding: 4px 0px 4px 0px">
                                <?php echo e($item->getUnidad()); ?>

                            </td>
                            <td align="left" style="padding: 4px 0px 4px 0px">
                                <?php echo e($item->getCodProducto()); ?> - <?php echo e($item->getDescripcion()); ?>

                                <?php if($itemDiscount > 0): ?>
                                    <br><span style="font-size: 10px">Desc. SUNAT: <?php echo e($currencySymbol); ?> <?php echo e(number_format($itemDiscount, 2, '.', ',')); ?></span>
                                <?php endif; ?>
                            </td>
                            <td align="right" style="padding: 4px 0px 4px 0px">
                                <?php echo e($currencySymbol); ?> <?php echo e(number_format($item->getMtoPrecioUnitario(), 2, '.', ',')); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
            <table width="100%" border="0" style="font-size: 11px; border-collapse: collapse;">
                <tbody>
                    <tr class="border_bottom">
                        <td style="border-top: 1px solid black !important; padding: 4px 0px 1px 0px;" width="70%"
                            align="right">
                            <strong>Op. Gravadas:</strong>
                        </td>
                        <td style="border-top: 1px solid black !important; padding: 4px 0px 1px 0px;" width="30%"
                            align="right">
                            <?php echo e($currencySymbol); ?> <?php echo e(number_format($document->getMtoOperGravadas(), 2, '.', ',')); ?>

                        </td>
                    </tr>
                    <tr>
                        <td width="70%" align="right"><strong>I.G.V.:</strong></td>
                        <td width="30%" align="right">
                            <?php echo e($currencySymbol); ?> <?php echo e(number_format($document->getMtoIGV(), 2, '.', ',')); ?>

                        </td>
                    </tr>
                    <?php if($documentDiscountTotal > 0): ?>
                        <tr>
                            <td width="70%" align="right"><strong>Descuento:</strong></td>
                            <td width="30%" align="right">
                                <?php echo e($currencySymbol); ?> <?php echo e(number_format($documentDiscountTotal, 2, '.', ',')); ?>

                            </td>
                        </tr>
                    <?php endif; ?>
                    <tr>
                        <td width="70%" align="right"><strong>Precio Venta:</strong></td>
                        <td width="30%" align="right">
                            <?php echo e($currencySymbol); ?> <?php echo e(number_format($document->getMtoImpVenta(), 2, '.', ',')); ?>

                        </td>
                    </tr>
                </tbody>
            </table>
            <div style="align-items: center; ">
                <table>
                    <tr>
                        <td>
                            <table style="font-size: 11px">
                                <tr>
                                    <td>
                                        <p><strong> <?php echo e($document->getLegends()[0]->getValue()); ?></strong></p>
                                        <br />
                                        <br />
                                        <blockquote>
                                            <div>consulte en <a
                                                    href="<?php echo e(route('client_search_electronic_invoice')); ?>"><?php echo e(env('APP_URL')); ?></a>
                                            </div>
                                            
                                            <?php if($document->getTipoDoc() == '01'): ?>
                                                <span>Representación Impresa de la FACTURA ELECTRÓNICA.</span>
                                            <?php elseif($document->getTipoDoc() == '03'): ?>
                                                <span>Representación Impresa de la BOLETA DE VENTA ELECTRÓNICA.</span>
                                            <?php endif; ?>
                                        </blockquote>
                                    </td>
                                </tr>
                            </table>
                        </td>
                        <td>
                            <img src="<?php echo e($qr_path); ?>" width="120" height="120" />
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div>
        <table style="width: 100%; border-collapse: collapse;">
            <tbody>
                
                <?php $__currentLoopData = $bankAccounts; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $account): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        
                        <td style="padding: 8px;"> 
                            <div style="border: 1px solid black;"> 
                                <table style="width: 100%; font-size: 0.75rem; border-collapse: collapse;">
                                    <thead>
                                        <tr>
                                            <td style="border-bottom: 1px solid black; padding-bottom: 8px; padding-left: 12px; font-weight: bold; color: #4a5568;">
                                                
                                                <table>
                                                    <tr>
                                                        <td style="font-size: 0.60rem; vertical-align: top;">
                                                            <?php echo e($account->description); ?>

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td style="vertical-align: top;">
                                                            <?php echo e($account->bank->full_name); ?>

                                                        </td>
                                                    </tr>
                                                </table>
                                            </td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td style="padding-top: 8px; padding-bottom: 4px; padding-left: 12px; text-align: left;">
                                                <b>Número de cuenta:</b> <?php echo e($account->number); ?>

                                            </td>
                                        </tr>
                                        <tr>
                                            <td style="padding-top: 4px; padding-bottom: 8px; padding-left: 12px; text-align: left;">
                                                <b>N° de cuenta interbancario (cci):</b> <?php echo e($account->cci); ?>

                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
    <div style="padding: 8px;text-align:center">
        <br /><br />
        <div class="break">
            *************************************
        </div>
        <br /><br />
        <p class="centrado">¡GRACIAS POR SU COMPRA!</p>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\globalcpa\Modules\Sales\Resources\views\sales\invoice_ticket_pdf.blade.php ENDPATH**/ ?>