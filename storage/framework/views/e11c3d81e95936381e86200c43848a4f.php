<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Código de Barras</title>
    <style>
        @page {
            margin-top: 0;
            margin-bottom: 0;
            margin-left: 0;
            margin-right: 0;
        }

        body {
            margin: 0px;
            font-family: monospace;
            font-size: 10px;
            padding-top: 4px
        }

        .barcode-image {
            width: 138px;
            /* Ajusta el ancho según sea necesario */
            height: 40px;

        }
    </style>
</head>

<body>
    <?php
        $textSize = 15;
        $textSizeP = 12;
        $generator = new \Picqer\Barcode\BarcodeGeneratorPNG();

        $company = \App\Models\Company::first();

        $logo = public_path('storage' . DIRECTORY_SEPARATOR . $company->logo_document);

        $stringCode = $product->interne;

        $generator->useGd();

        $image = base64_encode($generator->getBarcode($stringCode, $generator::TYPE_CODE_39));
    ?>
    <table style="margin: auto; width: 302px;">
        <?php if($product->sizes): ?>
            <?php $__currentLoopData = json_decode($product->sizes); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php if($item->quantity > 0): ?>
                    <tr>
                        <td style="padding: 0px; text-align: left;">
                            <img src="<?php echo e($logo); ?>" height='32px' />
                        </td>
                        <td style="width: 40px"></td>
                        <td style="padding: 0px; text-align: left;">
                            <img src="<?php echo e($logo); ?>" height='32px' />
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px">
                            <img src="data:image/png;base64,<?php echo e($image); ?>" class="barcode-image"
                                alt="Código de barras">
                        </td>
                        <td style="width: 40px"></td>
                        <td style="padding: 0px">
                            <img src="data:image/png;base64,<?php echo e($image); ?>" class="barcode-image"
                                alt="Código de barras">
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px">
                            <p style="font-size: <?php echo e($textSizeP); ?>px; padding: 0px;margin: 1px;">PRECIO: S/
                                <?php echo e(number_format(json_decode($product->sale_prices)->high, 2, ',', ' ')); ?>

                            </p>
                        </td>
                        <td style="width: 40px"></td>
                        <td style="padding: 0px">
                            <p style="font-size: <?php echo e($textSizeP); ?>px; padding: 0px;margin: 1px;">PRECIO: S/
                                <?php echo e(number_format(json_decode($product->sale_prices)->high, 2, ',', ' ')); ?>

                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding: 0px">
                            <p style="font-size: <?php echo e($textSize); ?>px; padding: 0px;margin: 1px;">CÓDIGO:
                                <?php echo e($stringCode); ?></p>
                        </td>
                        <td style="width: 40px"></td>
                        <td style="padding: 0px">
                            <p style="font-size: <?php echo e($textSize); ?>px; padding: 0px;margin: 1px;">CÓDIGO:
                                <?php echo e($stringCode); ?></p>
                        </td>
                    </tr>
                    
                <?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <tr>
                <td style="padding: 0px; text-align: left;">
                    <img src="<?php echo e($logo); ?>" height='32px' />
                </td>
                <td style="width: 40px"></td>
                <td style="padding: 0px; text-align: left;">
                    <img src="<?php echo e($logo); ?>" height='32px' />
                </td>
            </tr>
            <tr>
                <td style="padding: 0px">
                    <img src="data:image/png;base64,<?php echo e($image); ?>" class="barcode-image" alt="Código de barras">
                </td>
                <td style="width: 40px"></td>
                <td style="padding: 0px">
                    <img src="data:image/png;base64,<?php echo e($image); ?>" class="barcode-image" alt="Código de barras">
                </td>
            </tr>
            <tr>
                <td style="padding: 0px">
                    <p style="font-size: <?php echo e($textSizeP); ?>px;">PRECIO: S/
                        <?php echo e(number_format(json_decode($product->sale_prices)->high, 2, ',', ' ')); ?>

                    </p>
                </td>
                <td style="width: 40px"></td>
                <td style="padding: 0px">
                    <p style="font-size: <?php echo e($textSizeP); ?>px;">PRECIO: S/
                        <?php echo e(number_format(json_decode($product->sale_prices)->high, 2, ',', ' ')); ?>

                    </p>
                </td>
            </tr>
            <tr>
                <td style="padding: 0px">
                    <p style="font-size: <?php echo e($textSize); ?>px; padding: 0px;margin: 1px;">CÓDIGO:
                        <?php echo e($stringCode); ?></p>
                </td>
                <td style="width: 40px"></td>
                <td style="padding: 0px">
                    <p style="font-size: <?php echo e($textSize); ?>px; padding: 0px;margin: 1px;">CÓDIGO:
                        <?php echo e($stringCode); ?></p>
                </td>
            </tr>
        <?php endif; ?>
    </table>
</body>

</html>
<?php /**PATH C:\laragon\www\globalcpa\Modules\Sales\Resources\views\products\barcode_f1.blade.php ENDPATH**/ ?>