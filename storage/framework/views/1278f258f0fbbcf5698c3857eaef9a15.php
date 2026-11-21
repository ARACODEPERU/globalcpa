<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        html, body {
            margin: 0;
            padding: 0;
            background: transparent !important;
        }
        body {
            width: <?php echo e($canvasWidth); ?>px;
            height: <?php echo e($canvasHeight); ?>px;
            background-color: transparent;
            overflow: hidden;
            font-family: <?php echo e($fontFamily); ?>, sans-serif;
            color: <?php echo e($color); ?>;
        }
        .container {
            position: absolute;
            left: <?php echo e($posX); ?>px;
            top: <?php echo e($posY); ?>px;
        }
        .grade-table {
            border-collapse: collapse;
            background-color: transparent;
        }
        .grade-table td {
            vertical-align: middle;
            background-color: transparent;
        }
        .label-cell {
            text-align: center;
            padding-right: 15px;
        }
        .label-text {
            font-size: <?php echo e($fontSize); ?>px;
            font-weight: bold;
            line-height: 1.2;
        }
        .rect-cell {
            text-align: center;
            vertical-align: middle;
        }
        .grade-rect {
            width: <?php echo e($rectWidth); ?>px;
            height: <?php echo e($rectHeight); ?>px;
            border: 2px solid <?php echo e($color); ?>;
            display: flex;
            align-items: center;
            justify-content: center;
        }
        <?php
            $digitCount = strlen($gradeValue);
            $fontScale = $digitCount >= 4 ? 0.30 : ($digitCount == 3 ? 0.40 : 0.50);
            $calculatedFontSize = (int)($rectHeight * $fontScale);
        ?>
        .grade-value {
            font-size: <?php echo e($calculatedFontSize); ?>px;
            font-weight: bold;
            color: <?php echo e($color); ?>;
        }
    </style>
</head>
<body>
    <div class="container">
        <table class="grade-table">
            <tr>
                <td class="label-cell">
                    <div class="label-text">
                        PROMEDIO<br>FINAL
                    </div>
                </td>
                <td class="rect-cell">
                    <div class="grade-rect">
                        <span class="grade-value"><?php echo e($gradeValue); ?></span>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\globalcpa\Modules\Academic\Resources\views\certificates\grade-table.blade.php ENDPATH**/ ?>