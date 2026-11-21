<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <title>Atribución UTM - Planes de suscripción</title>
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

        h2 {
            font-size: 11px;
            margin: 14px 0 5px;
            color: #3c4a99;
        }

        p.meta {
            margin: 0 0 10px;
            font-size: 9px;
            color: #6b7280;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 6px;
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

        .totals td {
            font-weight: bold;
            background-color: #eef1f9;
        }

        .empty {
            text-align: center;
            padding: 12px;
            color: #9ca3af;
        }

        .num {
            text-align: right;
        }
    </style>
</head>

<body>
    <h1>Atribución UTM: Planes de suscripción</h1>
    <p class="meta">
        Campaña: <strong><?php echo e($campaign); ?></strong>
        &middot; Rango: <?php echo e($rangeLabel); ?>

        &middot; Generado el <?php echo e($generatedAt); ?>

    </p>

    <h2>Resumen</h2>
    <table>
        <thead>
            <tr>
                <th>Vistas</th>
                <th>Clics en planes</th>
                <th>Suscripciones</th>
            </tr>
        </thead>
        <tbody>
            <tr class="totals">
                <td><?php echo e($totals['views']); ?></td>
                <td><?php echo e($totals['clicks']); ?></td>
                <td><?php echo e($totals['subscriptions']); ?></td>
            </tr>
        </tbody>
    </table>

    <h2>¿De dónde llegaron?</h2>
    <table>
        <thead>
            <tr>
                <th>Origen</th>
                <th class="num">Vistas</th>
                <th class="num">Clics</th>
                <th class="num">Suscripciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $origins; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $origin): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($origin['label']); ?></td>
                    <td class="num"><?php echo e($origin['views']); ?></td>
                    <td class="num"><?php echo e($origin['clicks']); ?></td>
                    <td class="num"><?php echo e($origin['subscriptions']); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td class="empty" colspan="4">Todavía no hay tráfico registrado para esta campaña.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>¿Qué planes eligieron?</h2>
    <table>
        <thead>
            <tr>
                <th>Plan</th>
                <th class="num">Suscripciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $plans; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($row['title']); ?></td>
                    <td class="num"><?php echo e($row['total']); ?></td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td class="empty" colspan="2">Sin suscripciones en el rango seleccionado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <h2>Afiliaciones al detalle</h2>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Alumno</th>
                <th>Plan al que se afilió</th>
                <th>Origen</th>
                <th>UTM</th>
            </tr>
        </thead>
        <tbody>
            <?php $__empty_1 = true; $__currentLoopData = $subscriptions; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($row->created_at ? \Carbon\Carbon::parse($row->created_at)->format('d/m/Y') : '-'); ?></td>
                    <td><?php echo e($row->student_name ?: '-'); ?></td>
                    <td><?php echo e($row->plan_title ?: '-'); ?></td>
                    <td><?php echo e($sourceLabels[$row->traffic_source ?? 'direct'] ?? ($row->traffic_source ?: 'Directo / manual')); ?></td>
                    <td>
                        <?php
                            $utm = array_filter([
                                $row->utm_source ? 'source=' . $row->utm_source : null,
                                $row->utm_medium ? 'medium=' . $row->utm_medium : null,
                                $row->utm_campaign ? 'campaign=' . $row->utm_campaign : null,
                                $row->utm_content ? 'content=' . $row->utm_content : null,
                            ]);
                        ?>
                        <?php echo e($utm ? implode(' · ', $utm) : '-'); ?>

                    </td>
                </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td class="empty" colspan="5">Sin suscripciones en el rango seleccionado.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <?php if($truncated): ?>
        <p class="meta">Se muestran las primeras <?php echo e(count($subscriptions)); ?> suscripciones. El Excel incluye el detalle completo.</p>
    <?php endif; ?>
</body>

</html>
<?php /**PATH C:\laragon\www\globalcpa\Modules\Academic\Resources\views\subscriptions\utm_stats_pdf.blade.php ENDPATH**/ ?>