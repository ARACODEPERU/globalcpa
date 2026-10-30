<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo e(config('app.name', 'Global CPA')); ?> - Negociacion confirmada</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 720px;
            margin: 0 auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
        }
        h1 {
            text-align: center;
            color: #333;
        }
        p {
            line-height: 22px;
            text-align: justify;
            color: #555;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            font-family: Arial, sans-serif;
            margin: 20px 0;
        }
        table th {
            padding: 12px 15px;
            text-align: left;
            border: 1px solid #3498db;
            color: #ffffff;
            font-weight: bold;
            background-color: #3498db;
        }
        table td {
            padding: 12px 15px;
            border: 1px solid #e5e7eb;
        }
        .btn {
            display: inline-block;
            padding: 14px 28px;
            border-radius: 5px;
            background-color: #ff8607;
            color: #ffffff;
            text-decoration: none;
        }
        .btn:hover {
            background: #010101;
        }
        footer {
            padding: 2px 15px;
            text-align: center;
            background: #000;
            color: #fff;
        }
        footer a {
            text-decoration: none;
            color: yellow;
        }
    </style>
</head>

<body>
    <br>
    <div class="container">
        <img style="width: 100%;" src="<?php echo e(asset('img/banner-email.jpg')); ?>" alt="Encabezado">
        <h1>Nueva negociacion confirmada</h1>
        <p>
            El cliente <b><?php echo e($client->full_name ?? 'Sin nombre'); ?></b>
            (<?php echo e($client->document_type_id == 1 ? 'DNI' : 'Doc.'); ?> <?php echo e($client->number); ?>)
            confirmo el acuerdo <b><?php echo e($negotiation->title); ?></b> y envio su voucher de pago.
        </p>

        <?php
            $presentationMode = \App\Helpers\Invoice\DocumentPresentation::modeForCount($negotiation->items->count());
            $presentationNames = \App\Helpers\Invoice\DocumentPresentation::names($negotiation->items);
            $presentationTotal = number_format((float) $negotiation->total_price, 2);
        ?>

        <?php if($presentationMode === 'list'): ?>
            <p style="text-align: left; font-weight: bold; font-size: 16px; color: #333; margin: 20px 0 10px;">
                Cursos adquiridos
            </p>
            <ul style="padding-left: 20px; margin: 0 0 20px; color: #555;">
                <?php $__currentLoopData = $presentationNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li style="margin-bottom: 6px;"><?php echo e($name); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
            <p style="text-align: right; font-weight: bold; font-size: 16px; color: #333; margin: 20px 0 0;">
                TOTAL A PAGAR
            </p>
            <p style="text-align: right; font-weight: bold; font-size: 20px; color: #2c3e50; margin: 0;">
                <?php echo e($negotiation->currency); ?> <?php echo e($presentationTotal); ?>

            </p>
        <?php elseif($presentationMode === 'summary'): ?>
            <p style="text-align: left; font-weight: bold; font-size: 16px; color: #333; margin: 20px 0 10px;">
                Compra de Cursos de Capacitacion
            </p>
            <p style="text-align: left; color: #555; margin: 0 0 20px;">
                Cantidad de cursos: <strong><?php echo e($negotiation->items->count()); ?></strong>
            </p>
            <p style="text-align: right; font-weight: bold; font-size: 16px; color: #333; margin: 20px 0 0;">
                TOTAL A PAGAR
            </p>
            <p style="text-align: right; font-weight: bold; font-size: 20px; color: #2c3e50; margin: 0;">
                <?php echo e($negotiation->currency); ?> <?php echo e($presentationTotal); ?>

            </p>
        <?php else: ?>
            <table>
                <thead>
                    <tr>
                        <th>Item</th>
                        <th style="text-align: right;">Precio</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $__currentLoopData = $negotiation->items; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td><?php echo e($item->title); ?></td>
                            <td style="text-align: right;">
                                S/ <?php echo e(number_format((float) $item->price, 2)); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
                <tfoot>
                    <tr style="background-color: #2c3e50;">
                        <td style="padding: 15px; text-align: right; color: white; font-weight: bold; font-size: 16px;">TOTAL:</td>
                        <td style="padding: 15px; text-align: right; color: white; font-weight: bold; font-size: 18px;">
                            <?php echo e($negotiation->currency); ?> <?php echo e($presentationTotal); ?>

                        </td>
                    </tr>
                </tfoot>
            </table>
        <?php endif; ?>

        <p>
            <b>Correo del cliente:</b> <?php echo e($client->email ?: 'No registrado'); ?><br>
            <b>Telefono del cliente:</b> <?php echo e($client->telephone ?: 'No registrado'); ?><br>
            <b>Comprobante:</b> <?php echo e(($negotiation->invoice->invoice_type ?? 'boleta') === 'factura' ? 'Factura electronica' : 'Boleta electronica'); ?><br>
            <?php if(($negotiation->invoice->invoice_type ?? null) === 'factura'): ?>
                <b>RUC:</b> <?php echo e($negotiation->invoice->ruc ?? 'No registrado'); ?><br>
            <?php endif; ?>
            <b>Fecha de confirmacion:</b> <?php echo e(now()->format('d/m/Y H:i')); ?>

        </p>

        <p style="text-align: center; margin-top: 20px;">
            <a href="<?php echo e($reviewUrl); ?>" class="btn">
                Revisar la negociacion
            </a>
        </p>
        <br>
        <p style="text-align: center; font-size: 14px;">
            <?php echo e(config('app.name', 'Global CPA')); ?>

        </p>
        <footer>
            <p style="text-align: center; font-size: 15px;">
                &copy; Derechos Reservados <?php echo e(config('app.name')); ?> | Desarrollado por
                <a href="https://aracodeperu.com/">Aracode Smart Solutions</a>
            </p>
        </footer>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\globalcpa\resources\views/emails/commercial_negotiation_confirmed.blade.php ENDPATH**/ ?>