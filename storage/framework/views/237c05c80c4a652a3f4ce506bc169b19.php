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
        .module-item { margin-bottom: 15px; overflow: hidden; }
        .module-name { font-size: <?php echo e($fontSize); ?>px; font-weight: bold; margin-bottom: 5px; display: flex; align-items: center; flex-wrap: wrap; }
        .module-number { margin-right: 8px; }
        .exam-grade { font-weight: bold; color: <?php echo e($examColor); ?>; font-size: <?php echo e($fontSize); ?>px; margin-left: 15px; }
        .themes-list { padding-left: 20px; margin-top: 5px; }
        .theme-item { font-size: <?php echo e($fontSize - 2); ?>px; margin-bottom: 2px; }
    </style>
</head>
<body>
    <div class="container">
        <?php if($courseTitle): ?>
            <div class="course-title"><?php echo e($courseTitle); ?></div>
        <?php endif; ?>

        <?php if($showModuleContent && $moduleName): ?>
            <div class="module-item">
                <div class="module-name">
                    <span class="module-number">1.</span>
                    <span><?php echo e($moduleName); ?></span>
                    <?php if($showExamGrade): ?>
                    <span class="exam-grade"> CALIFICACIÓN OBTENIDA: <?php echo e($examGrade[0] ?? '-'); ?></span>
                    <?php endif; ?>
                </div>
                <?php if($showThemes && !empty($content) && count($content) > 0): ?>
                    <div class="themes-list">
                        <?php $__currentLoopData = $content[0]['themes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <div class="theme-item">° <?php echo e($theme); ?></div>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                <?php endif; ?>
            </div>
        <?php elseif($showCourseContent): ?>
            <?php $__currentLoopData = $content; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $module): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <div class="module-item">
                    <div class="module-name">
                        <span class="module-number"><?php echo e($index + 1); ?>.</span>
                        <span><?php echo e($module['name']); ?></span>
                        <?php if($showExamGrade): ?>
                        <span class="exam-grade"> CALIFICACIÓN OBTENIDA: <?php echo e($examGrade[$index] ?? '-'); ?></span>
                        <?php endif; ?>
                    </div>
                    <?php if($showThemes && !empty($module['themes'])): ?>
                        <div class="themes-list">
                            <?php $__currentLoopData = $module['themes']; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $theme): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <div class="theme-item">° <?php echo e($theme); ?></div>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\globalcpa\Modules\Academic\Resources\views\certificates\content-list.blade.php ENDPATH**/ ?>