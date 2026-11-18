<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Registros de la landing</title>
    <style>
        * {
            font-family: DejaVu Sans, sans-serif;
        }

        body {
            font-size: 9px;
            color: #1f2937;
            margin: 0;
            padding: 12px;
        }

        h1 {
            font-size: 15px;
            margin: 0 0 4px;
        }

        p.meta {
            margin: 0 0 10px;
            font-size: 9px;
            color: #6b7280;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        thead th {
            background-color: #3c4a99;
            color: #ffffff;
            text-align: left;
            padding: 5px 4px;
            font-size: 8px;
            text-transform: uppercase;
        }

        tbody td {
            border-bottom: 1px solid #e5e7eb;
            padding: 4px;
            vertical-align: top;
            word-break: break-word;
        }

        tbody tr:nth-child(even) td {
            background-color: #f6f7fb;
        }

        .empty {
            text-align: center;
            padding: 14px;
            color: #9ca3af;
        }
    </style>
</head>

<body>
    <h1>Registros de la landing: <?php echo e($landing->title ?? 'Curso gratis'); ?></h1>
    <p class="meta">
        Total: <?php echo e(count($rows)); ?> registros
        <?php if(!empty($range)): ?>
            &middot; Rango de fechas: <?php echo e($range); ?>

        <?php endif; ?>
        &middot; Generado el <?php echo e(now()->format('d/m/Y H:i')); ?>

    </p>

    <table>
        <thead>
            <tr>
                <?php $__currentLoopData = $headers; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $header): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <th><?php echo e($header); ?></th>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $rows; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <?php $__currentLoopData = array_values($row); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <td><?php echo e($value); ?></td>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td class="empty" colspan="<?php echo e(count($headers)); ?>">Todavía no hay registros desde esta landing.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>

</html>
<?php /**PATH C:\laragon\www\globalcpa\Modules/CMS\Resources/views/landings/free-course-registrations-pdf.blade.php ENDPATH**/ ?>