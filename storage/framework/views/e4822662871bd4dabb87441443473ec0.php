<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <style>
        @page {
            margin: 4px 6px;
        }

        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 8px;
            color: #000;
            line-height: 1.25;
            margin: 0;
            padding: 0;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .w-full { width: 100%; }

        .text-center { text-align: center; }
        .text-right { text-align: right; }
        .text-left { text-align: left; }
        .bold { font-weight: bold; }

        .line-dashed td {
            border-top: 1px dashed #999;
            padding: 0;
            height: 1px;
            line-height: 1px;
            font-size: 1px;
        }

        .line-solid td {
            border-top: 1px solid #000;
            padding: 0;
            height: 1px;
            line-height: 1px;
            font-size: 1px;
        }

        .sp-4 td { height: 4px; font-size: 1px; line-height: 1px; }
        .sp-6 td { height: 6px; font-size: 1px; line-height: 1px; }

        .logo-cell {
            text-align: center;
            padding-bottom: 2px;
        }

        .logo-cell img {
            width: 130px;
            max-width: 130px;
        }

        .company-cell {
            text-align: center;
            font-size: 8px;
            font-weight: bold;
            padding: 1px 0;
        }

        .local-cell {
            text-align: center;
            font-size: 7px;
            color: #444;
            padding-bottom: 2px;
        }

        .doc-type-cell {
            text-align: center;
            font-size: 10px;
            font-weight: bold;
            border: 1px solid #000;
            padding: 3px 2px;
        }

        .doc-num-cell {
            text-align: center;
            font-size: 9px;
            font-weight: bold;
            padding: 3px 0 2px;
        }

        .meta-label {
            width: 28%;
            font-size: 7px;
            color: #444;
            text-transform: uppercase;
            padding: 1px 0;
            vertical-align: top;
        }

        .meta-value {
            width: 72%;
            font-size: 8px;
            font-weight: bold;
            padding: 1px 0;
            vertical-align: top;
            text-align: right;
        }

        .section-head td {
            font-size: 7px;
            font-weight: bold;
            text-transform: uppercase;
            color: #444;
            padding: 4px 0 2px;
        }

        .th-qty {
            width: 18px;
            font-size: 7px;
            text-align: center;
            border-bottom: 1px solid #000;
            padding: 2px 0;
        }

        .th-desc {
            font-size: 7px;
            text-align: left;
            border-bottom: 1px solid #000;
            padding: 2px 0;
        }

        .th-amt {
            width: 38px;
            font-size: 7px;
            text-align: right;
            border-bottom: 1px solid #000;
            padding: 2px 0;
        }

        .item-qty {
            width: 18px;
            text-align: center;
            font-weight: bold;
            font-size: 8px;
            padding: 3px 0;
            vertical-align: top;
        }

        .item-desc {
            font-size: 7.5px;
            padding: 3px 2px 3px 0;
            vertical-align: top;
            word-wrap: break-word;
        }

        .item-code {
            font-size: 7px;
            color: #444;
        }

        .item-amt {
            width: 38px;
            text-align: right;
            font-size: 8px;
            font-weight: bold;
            padding: 3px 0;
            vertical-align: top;
        }

        .item-row td {
            border-bottom: 1px dotted #bbb;
        }

        .total-label-cell {
            text-align: right;
            font-size: 9px;
            font-weight: bold;
            padding: 5px 4px 2px 0;
        }

        .total-amt-cell {
            text-align: right;
            font-size: 10px;
            font-weight: bold;
            padding: 5px 0 2px;
        }

        .footer-label {
            width: 32%;
            font-size: 7px;
            color: #444;
            text-transform: uppercase;
            padding: 2px 0;
        }

        .footer-value {
            font-size: 8px;
            font-weight: bold;
            padding: 2px 0;
            text-align: right;
        }

        .pay-name {
            font-size: 8px;
            font-weight: bold;
            padding: 2px 0;
        }

        .pay-ref {
            font-size: 7px;
            color: #444;
        }

        .pay-amt {
            font-size: 8px;
            font-weight: bold;
            text-align: right;
            padding: 2px 0;
        }

        .thanks-cell {
            text-align: center;
            font-size: 9px;
            font-weight: bold;
            padding: 8px 0 2px;
        }

        .thanks-sub {
            text-align: center;
            font-size: 7px;
            color: #555;
            padding-bottom: 4px;
        }
    </style>
</head>

<?php
    $methodsById = isset($paymentMethods) ? $paymentMethods : collect($payments ?? [])->keyBy('id');
    $paymentsList = $salePayments ?? json_decode($sale->payments ?? '[]', true) ?: [];
    $issuedAt = \Carbon\Carbon::parse($document->created_at ?? $sale->sale_date);
    $sellerName = $seller->name ?? '—';
    $clientName = $client?->full_name ?? ($client?->names ?? null);
    $clientDoc = $client?->number ?? null;
    $localName = $local->description ?? null;
?>

<body>
    <table class="w-full">
        <?php if(!empty($logoSrc)): ?>
            <tr>
                <td class="logo-cell">
                    <img src="<?php echo e($logoSrc); ?>" alt="Logo" width="120">
                </td>
            </tr>
        <?php endif; ?>
        <?php if(!empty($company->name)): ?>
            <tr>
                <td class="company-cell"><?php echo e($company->name); ?></td>
            </tr>
        <?php endif; ?>
        <?php if($localName): ?>
            <tr>
                <td class="local-cell"><?php echo e($localName); ?></td>
            </tr>
        <?php endif; ?>

        <tr class="line-dashed"><td colspan="1"></td></tr>
        <tr class="sp-4"><td></td></tr>

        
        <tr>
            <td class="doc-type-cell">NOTA DE VENTA</td>
        </tr>
        <tr>
            <td class="doc-num-cell"><?php echo e($document->description ?? ''); ?> - <?php echo e($document->number ?? ''); ?></td>
        </tr>

        <tr class="sp-4"><td></td></tr>

        
        <tr>
            <td>
                <table class="w-full">
                    <tr>
                        <td class="meta-label">Fecha</td>
                        <td class="meta-value"><?php echo e($issuedAt->format('d/m/Y H:i')); ?></td>
                    </tr>
                    <?php if($clientName): ?>
                        <tr>
                            <td class="meta-label">Cliente</td>
                            <td class="meta-value"><?php echo e($clientName); ?></td>
                        </tr>
                    <?php endif; ?>
                    <?php if($clientDoc): ?>
                        <tr>
                            <td class="meta-label">Doc.</td>
                            <td class="meta-value"><?php echo e($clientDoc); ?></td>
                        </tr>
                    <?php endif; ?>
                </table>
            </td>
        </tr>

        <tr class="line-solid"><td></td></tr>
        <tr class="sp-4"><td></td></tr>

        
        <tr>
            <td>
                <table class="w-full">
                    <tr class="section-head">
                        <td colspan="3">Detalle</td>
                    </tr>
                    <tr>
                        <th class="th-qty">Cant</th>
                        <th class="th-desc">Descripción</th>
                        <th class="th-amt">Importe</th>
                    </tr>
                    <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $json = json_decode($item->product ?? '{}', true);
                            $json = is_array($json) ? $json : [];
                            $saleJson = json_decode($item->saleProduct ?? '{}', true);
                            $saleJson = is_array($saleJson) ? $saleJson : [];
                            $interne = $json['interne'] ?? $saleJson['interne'] ?? '';
                            $description = $json['description'] ?? $saleJson['description'] ?? 'Ítem';
                            $size = $json['size'] ?? $saleJson['size'] ?? null;
                            $lineTotal = number_format((float) $item->total, 2);
                        ?>
                        <tr class="item-row">
                            <td class="item-qty"><?php echo e((int) $item->quantity); ?></td>
                            <td class="item-desc">
                                <?php if($item->entity_name_product == 'App\Models\Product'): ?>
                                    <?php if($interne): ?>
                                        <span class="item-code"><?php echo e($interne); ?></span><br>
                                    <?php endif; ?>
                                    <?php echo e($description); ?><?php echo e($size ? ' / ' . $size : ''); ?>

                                <?php elseif($item->entity_name_product == 'Modules\Socialevents\Entities\EventEditionMatchSanction'): ?>
                                    <?php $type = $json['type'] ?? ''; ?>
                                    <?php if($type == 'double_yellow'): ?> Roja por doble amarilla
                                    <?php elseif($type == 'yellow'): ?> Amarilla
                                    <?php elseif($type == 'red'): ?> Roja directa
                                    <?php else: ?> Por sanciones
                                    <?php endif; ?>
                                <?php else: ?>
                                    <?php echo e($description); ?>

                                <?php endif; ?>
                            </td>
                            <td class="item-amt">S/ <?php echo e($lineTotal); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <td colspan="2" class="total-label-cell">TOTAL A PAGAR</td>
                        <td class="total-amt-cell">S/ <?php echo e(number_format((float) $sale->total, 2)); ?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="line-dashed"><td></td></tr>
        <tr class="sp-4"><td></td></tr>

        
        <?php if(count($paymentsList) > 0): ?>
            <tr>
                <td>
                    <table class="w-full">
                        <tr class="section-head">
                            <td colspan="2">Forma de pago</td>
                        </tr>
                        <?php $__currentLoopData = $paymentsList; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <?php
                                $pay = is_array($payment) ? $payment : (array) $payment;
                                $methodId = $pay['type'] ?? null;
                                $amount = (float) ($pay['amount'] ?? 0);
                                $reference = $pay['reference'] ?? null;
                                $method = $methodsById->get((int) $methodId) ?? $methodsById->get($methodId);
                                $methodName = $method->description ?? 'Pago';
                            ?>
                            <tr>
                                <td class="pay-name">
                                    <?php echo e($methodName); ?>

                                    <?php if(!empty($reference)): ?>
                                        <br><span class="pay-ref">Ref: <?php echo e($reference); ?></span>
                                    <?php endif; ?>
                                </td>
                                <td class="pay-amt">S/ <?php echo e(number_format($amount, 2)); ?></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </table>
                </td>
            </tr>
            <tr class="sp-4"><td></td></tr>
        <?php endif; ?>

        
        <tr>
            <td>
                <table class="w-full">
                    <tr>
                        <td class="footer-label">Vendedor</td>
                        <td class="footer-value"><?php echo e($sellerName); ?></td>
                    </tr>
                </table>
            </td>
        </tr>

        <tr class="line-dashed"><td></td></tr>

        <tr>
            <td class="thanks-cell">¡GRACIAS POR SU COMPRA!</td>
        </tr>
        <?php if(!empty($company->tradename) || !empty($company->name)): ?>
            <tr>
                <td class="thanks-sub"><?php echo e($company->tradename ?? $company->name); ?></td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>
<?php /**PATH C:\laragon\www\globalcpa\Modules\Sales\Resources\views\sales\ticket_pdf.blade.php ENDPATH**/ ?>