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
        h2 {
            margin: 24px 0 8px;
            font-size: 18px;
            color: #1e293b;
        }
        p {
            line-height: 22px;
            color: #555;
        }
        ul {
            padding-left: 20px;
            margin: 0 0 16px;
            color: #555;
        }
        li {
            line-height: 22px;
            margin-bottom: 6px;
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
            color: #555;
            line-height: 20px;
        }
        .data-table th {
            width: 34%;
            background-color: #f1f5f9;
            color: #1e293b;
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
        .total {
            text-align: right;
            font-weight: bold;
            font-size: 18px;
            color: #2c3e50;
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

        <h1>El cliente confirmo su negociacion</h1>

        <?php
            $clientName = $client?->full_name
                ?: trim(($client?->father_lastname ?? '') . ' ' . ($client?->mother_lastname ?? '') . ' ' . ($client?->names ?? ''))
                ?: 'Cliente sin nombre registrado';

            $presentationMode = \App\Helpers\Invoice\DocumentPresentation::modeForCount($negotiation->items->count());
            $presentationNames = \App\Helpers\Invoice\DocumentPresentation::names($negotiation->items);
            $presentationTotal = number_format((float) $negotiation->total_price, 2);
            $advisorName = $negotiation->creator?->name ?: ($negotiation->contact_detail ?: 'No registrado');
            $isFree = $negotiation->isFree();
        ?>

        <p>
            <b><?php echo e($clientName); ?></b> ingreso al enlace de su cotizacion <b><?php echo e($negotiation->title); ?></b>,
            la acepto y envio sus datos de registro. El siguiente paso es continuar con el proceso
            de verificacion de la negociacion.
        </p>

        <p style="text-align: center; margin-top: 24px;">
            <a href="<?php echo e($reviewUrl); ?>" class="btn">
                Continuar con el proceso
            </a>
        </p>
        <p style="text-align: center; font-size: 13px; color: #888;">
            Si el boton no funciona, copia y pega este enlace en tu navegador:
        </p>
        <p style="text-align: center; font-size: 12px; color: #555; word-break: break-all;">
            <?php echo e($reviewUrl); ?>

        </p>

        <h2>Datos del cliente</h2>
        <table class="data-table">
            <tr>
                <th>Nombre</th>
                <td><?php echo e($clientName); ?></td>
            </tr>
            <tr>
                <th>Documento</th>
                <td><?php echo e($client?->number ?: 'No registrado'); ?></td>
            </tr>
            <tr>
                <th>Correo</th>
                <td><?php echo e($client?->email ?: 'No registrado'); ?></td>
            </tr>
            <tr>
                <th>Telefono</th>
                <td><?php echo e($client?->telephone ?: 'No registrado'); ?></td>
            </tr>
            <?php if($client?->ubigeo_description): ?>
                <tr>
                    <th>Ubicacion</th>
                    <td><?php echo e($client->ubigeo_description); ?></td>
                </tr>
            <?php endif; ?>
            <?php if($client?->address): ?>
                <tr>
                    <th>Direccion</th>
                    <td><?php echo e($client->address); ?></td>
                </tr>
            <?php endif; ?>
        </table>

        <h2>Resumen de la negociacion</h2>

        <?php if($presentationMode === 'list'): ?>
            <p style="font-weight: bold; color: #333; margin: 20px 0 10px;">
                Cursos adquiridos
            </p>
            <ul>
                <?php $__currentLoopData = $presentationNames; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $name): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <li><?php echo e($name); ?></li>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </ul>
        <?php elseif($presentationMode === 'summary'): ?>
            <p style="font-weight: bold; color: #333; margin: 20px 0 10px;">
                Compra de Cursos de Capacitacion
            </p>
            <p style="margin: 0 0 16px;">
                Cantidad de cursos: <strong><?php echo e($negotiation->items->count()); ?></strong>
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
                                <?php echo e($negotiation->currency); ?> <?php echo e(number_format((float) $item->price, 2)); ?>

                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tbody>
            </table>
        <?php endif; ?>

        <?php if($isFree): ?>
            <p class="total">INSCRIPCION GRATUITA</p>
            <p style="text-align: center; margin: 0 0 16px;">No necesitas pagar ni enviar comprobante.</p>
        <?php else: ?>
            <p class="total">TOTAL A PAGAR</p>
            <p class="total"><?php echo e($negotiation->currency); ?> <?php echo e($presentationTotal); ?></p>
        <?php endif; ?>

        <table class="data-table">
            <tr>
                <th>Asesor de la negociacion</th>
                <td><?php echo e($advisorName); ?></td>
            </tr>
            <?php if (! ($isFree)): ?>
            <tr>
                <th>Medio de pago</th>
                <td><?php echo e(\Modules\Commercial\Entities\CommercialNegotiation::paymentMethodLabel($negotiation->payment_method) ?: 'Por definir'); ?></td>
            </tr>
            <?php endif; ?>
            <?php if($negotiation->single_payment_days && ! $isFree): ?>
                <tr>
                    <th>Plazo de pago</th>
                    <td><?php echo e($negotiation->single_payment_days); ?> dias</td>
                </tr>
            <?php endif; ?>
            <tr>
                <th>Estado</th>
                <td>Confirmada por el cliente</td>
            </tr>
            <tr>
                <th>Fecha de confirmacion</th>
                <td><?php echo e(now()->format('d/m/Y H:i')); ?></td>
            </tr>
        </table>

        <p style="font-size: 13px; color: #888;">
            Recibes este correo porque eres el asesor de esta negociacion o tienes un rol de
            administrador. Cualquiera de ellos puede continuar con el proceso.
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
<?php /**PATH C:\laragon\www\globalcpa\Modules\Commercial\Resources\views\emails\commercial-negotiation-confirmed.blade.php ENDPATH**/ ?>