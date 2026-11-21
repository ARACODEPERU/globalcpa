<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        html, body { margin: 0; padding: 0; background: transparent !important; }
        body { width: <?php echo e($canvasWidth); ?>px; height: <?php echo e($canvasHeight); ?>px; background: transparent; overflow: hidden; font-family: Arial, sans-serif; color: <?php echo e($color); ?>; }
        .container { position: absolute; left: <?php echo e($posX); ?>px; top: <?php echo e($posY); ?>px; width: <?php echo e($maxWidth); ?>px; max-width: <?php echo e($maxWidth); ?>px; padding: 10px; background: transparent; overflow: hidden; }
        .course-title { font-size: <?php echo e($fontSize + 4); ?>px; font-weight: bold; margin-bottom: 15px; text-align: center; border-bottom: 2px solid <?php echo e($color); ?>; padding-bottom: 8px; }
        .content-table { width: 100%; max-width: 100%; border-collapse: collapse; table-layout: fixed; }
        .content-table th { font-size: <?php echo e($fontSize - 2); ?>px; font-weight: bold; text-align: left; border-bottom: 1px solid <?php echo e($color); ?>; padding: 5px; overflow: hidden; }
        .content-table td { font-size: <?php echo e($fontSize - 2); ?>px; padding: 4px; border-bottom: 1px dotted <?php echo e($color); ?>; vertical-align: top; overflow: hidden; }
        .module-name { font-weight: bold; word-wrap: break-word; }
        .exam-grade { font-weight: bold; color: <?php echo e($examColor); ?>; font-size: <?php echo e($examFontSize); ?>px; }
    </style>
</head>
<body width="<?php echo e($canvasWidth); ?>">
    <div class="container">
        <?php if($courseTitle): ?>
            <div class="course-title"><?php echo e($courseTitle); ?></div>
        <?php endif; ?>

        <table class="content-table">
            <thead>
                <tr>
                    <th>MÓDULO</th>
                    <?php if($showExamGrade): ?>
                    <th width="20%">CALIFICACIÓN OBTENIDA</th>
                    <?php endif; ?>
                    <?php if($showThemes): ?>
                    <th  width="40%">CONTENIDO</th>
                    <?php endif; ?>
                </tr>
            </thead>
            <tbody>
                <?php if($showModuleContent && $moduleName): ?>
                    <tr>
                        <td class="module-name"><?php echo e($moduleName); ?></td>
                        <?php if($showExamGrade): ?>
                        <td class="exam-grade"><?php echo e($examGrade[0] ?? '-'); ?></td>
                        <?php endif; ?>
                        <td>
                            <?php if($showThemes && !empty($content) && count($content) > 0): ?>
                                <ul style="list-style: none; padding: 0; margin: 0;">
                                    <?php $__currentLoopData = $content[0]['themes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <li style="font-size: <?php echo e($fontSize - 4); ?>px;">° <?php echo e($theme); ?></li>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </ul>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php elseif($showCourseContent): ?>
                    <?php $__currentLoopData = $content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <tr>
                            <td class="module-name"><?php echo e($module['name']); ?></td>
                            <?php if($showExamGrade): ?>
                            <td class="exam-grade"><?php echo e($examGrade[$index] ?? '-'); ?></td>
                            <?php endif; ?>
                            <td>
                                <?php if($showThemes && !empty($module['themes'])): ?>
                                    <ul style="list-style: none; padding: 0; margin: 0;">
                                        <?php $__currentLoopData = $module['themes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                            <li style="font-size: <?php echo e($fontSize - 4); ?>px;">° <?php echo e($theme); ?></li>
                                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    </ul>
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\globalcpa\Modules\Academic\Resources\views\certificates\content-table.blade.php ENDPATH**/ ?>