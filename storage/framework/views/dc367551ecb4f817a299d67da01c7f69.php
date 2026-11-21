<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div>
        <div>
            <div style="text-align: center">
                <h1>Reporte ventas del Día</h1>
            </div>
            <p><strong>Fecha:</strong> <?php echo e($header['date']); ?> </p>
            <p><strong>Usuario:</strong> <?php echo e($header['user_name']); ?> </p>
            <p><strong>Tienda:</strong> <?php echo e($header['local_name']); ?> </p>
        </div>
        <br>
        <div style="text-align: center">
            <h1>Productos Vendidos</h1>
        </div>
        <table style="width: 100%;border: 1px solid #000;border-collapse: collapse;">
            <tr>
                <td
                    style="text-align: center;
                vertical-align: top;
                border: 1px solid #000;
                border-collapse: collapse;
                padding: 0.3em;
                caption-side: bottom;">
                    Imagen</td>
                <td
                    style="text-align: left;
                vertical-align: top;
                border: 1px solid #000;
                border-collapse: collapse;
                padding: 0.3em;
                caption-side: bottom;">
                    Producto</td>
                <td
                    style="text-align: center;
                vertical-align: top;
                border: 1px solid #000;
                border-collapse: collapse;
                padding: 0.3em;
                caption-side: bottom;">
                    Cantidad</td>
                <td
                    style="text-align: center;
                vertical-align: top;
                border: 1px solid #000;
                border-collapse: collapse;
                padding: 0.3em;
                caption-side: bottom;">
                    Precio</td>
                <td
                    style="text-align: center;
                vertical-align: top;
                border: 1px solid #000;
                border-collapse: collapse;
                padding: 0.3em;
                caption-side: bottom;">
                    Descuento</td>
                <td
                    style="text-align: center;
                vertical-align: top;
                border: 1px solid #000;
                border-collapse: collapse;
                padding: 0.3em;
                caption-side: bottom;">
                    Importe</td>
            </tr>
            <?php
                $total_p = 0;
            ?>
            <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td
                        style="text-align: center;vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">
                        <img src="<?php echo e(asset('storage/' . $product->image)); ?>" width="80px" />
                    </td>
                    <td
                        style="vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">
                        <?php if($product->presentations): ?>
                            <?php echo e($product->interne . ' - ' . $product->description . ' / ' . json_decode($product->product, true)['size']); ?>

                        <?php else: ?>
                            <?php echo e($product->interne . ' - ' . $product->description); ?>

                        <?php endif; ?>
                    </td>
                    <td
                        style="text-align: right;vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">
                        <?php echo e($product->quantity); ?></td>
                    <td
                        style="text-align: right;vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">
                        <?php echo e($product->price); ?></td>
                    <td
                        style="text-align: right;vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">
                        <?php echo e($product->discount); ?></td>
                    <td
                        style="text-align: right;vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">
                        <?php echo e($product->total); ?></td>
                </tr>
                <?php
                    $total_p = $total_p + $product->total;
                ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <tr>
                <td colspan="5"
                    style="text-align: right;vertical-align: top;
                border: 1px solid #000;
                border-collapse: collapse;
                padding: 0.3em;
                caption-side: bottom;">
                    Total Vendido</td>
                <td
                    style="text-align: right;vertical-align: top;
                border: 1px solid #000;
                border-collapse: collapse;
                padding: 0.3em;
                caption-side: bottom;">
                    <?php echo e(number_format($total_p, 2, '.', ',')); ?></td>

            </tr>
        </table>
        <br>
        <div style="text-align: center">
            <h1>Documentos Emitidos</h1>
        </div>

        <?php
            $total = 0;
            $ssale = '';
        ?>
        <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $k => $sale): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php if($ssale != $sale->id): ?>
                <table style="width: 100%;border: 1px solid #000;border-collapse: collapse;background:#D5D6D1">
                    <tr>
                        <td
                            style="text-align: left;
                    vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">
                            Documento</td>
                        <td
                            style="text-align: left;
                    vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">
                            Cliente</td>
                        <td
                            style="text-align: left;
                    vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">
                            Vendedor</td>
                        <td
                            style="text-align: left;
                    vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">
                            Total</td>
                    </tr>
                    <tr>
                        <td
                            style="vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">
                            <?php echo e($sale->description); ?> - <?php echo e($sale->number); ?></td>
                        <td
                            style="vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">
                            <?php echo e($sale->full_name); ?></td>
                        <td
                            style="vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">
                            <?php if($sale->seller_name): ?>
                                <?php echo e($sale->seller_name); ?>

                            <?php else: ?>
                                <?php echo e($sale->user_name); ?>

                            <?php endif; ?>
                        </td>
                        <td
                            style="text-align: right;vertical-align: top;
                    border: 1px solid #000;
                    border-collapse: collapse;
                    padding: 0.3em;
                    caption-side: bottom;">
                            <?php echo e($sale->total); ?></td>
                    </tr>
                    <tr>
                        <th colspan="4" style="padding: 0.3em;text-align: center">Detalles De Venta</th>
                    </tr>
                    <?php $__currentLoopData = $sales; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $products): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php if($sale->id == $products->id): ?>
                            <tr>
                                <td colspan="2" style="padding: 0.3em;text-align: left">Producto: </td>
                                <td style="padding: 0.3em;text-align: center"><?php echo e($products->interne); ?>

                                    <p> <?php echo e($products->product_description); ?>

                                        <?php if($product->presentations): ?>
                                            / <?php echo e(json_decode($products->product, true)['size']); ?>

                                        <?php endif; ?>
                                    </p>
                                </td>
                                <td style="padding: 0.3em;text-align: right"><?php echo e($products->product_total); ?></td>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <tr>
                        <th colspan="4" style="padding: 0.3em;text-align: center">Pagos</th>
                    </tr>
                    <?php $__currentLoopData = json_decode($sale->payments); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $payment): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td colspan="2" style="padding: 0.3em;text-align: left">
                                <?php $__currentLoopData = $payments; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $rr): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($payment->type == $rr->id): ?>
                                        <b><?php echo e($rr->description); ?></b>
                                    <?php endif; ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </td>
                            <td style="padding: 0.3em;text-align: left"><?php echo e($payment->reference ?? ''); ?></td>
                            <td style="padding: 0.3em;text-align: right">
                                <?php echo e(number_format($payment->amount, 2, '.', ',')); ?></td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php
                        $total = $total + $sale->total;
                    ?>
            <?php endif; ?>
            <?php
                $ssale = $sale->id;

            ?>
            </table>
            <br>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <table style="width: 100%;border: 1px solid #000;border-collapse: collapse;">
            <tr>
                <td
                    style="text-align: right;vertical-align: top;
                border: 1px solid #000;
                border-collapse: collapse;
                padding: 0.3em;
                caption-side: bottom;">
                    Total venta del dia</td>
                <td
                    style="text-align: right;vertical-align: top;
                border: 1px solid #000;
                border-collapse: collapse;
                padding: 0.3em;
                caption-side: bottom;">
                    <?php echo e(number_format($total, 2, '.', ',')); ?></td>
            </tr>
        </table>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\globalcpa\Modules\Sales\Resources\views\sales\sale_day.blade.php ENDPATH**/ ?>