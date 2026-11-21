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
            width: <?php echo e($maxWidth); ?>px;
            padding: 10px;
            background-color: transparent;
        }

        .description-text {
            font-size: <?php echo e($fontSize); ?>px;
            line-height: <?php echo e($lineHeight); ?>px;
            text-align: <?php echo e($textAlign); ?>;
        }

        .description-text.text-justify {
            text-align: justify;
        }

        .description-text.text-center {
            text-align: center;
        }

        .description-text.text-left {
            text-align: left;
        }

        .description-text.text-right {
            text-align: right;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="description-text text-<?php echo e($textAlign); ?>">
            <?php echo nl2br(e($text)); ?>

        </div>
    </div>
</body>
</html>
<?php /**PATH C:\laragon\www\globalcpa\Modules\Academic\Resources\views\certificates\text-description-front.blade.php ENDPATH**/ ?>