<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            background: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .button {
            display: inline-block;
            padding: 10px 20px;
            color: white;
            background-color: #7963e0;
            text-decoration: none;
            border-radius: 5px;
        }

        .footer {
            margin-top: 20px;
            font-size: 12px;
            color: #777;
        }
    </style>
</head>
<?php
    $company = \App\Models\Company::first();
?>

<body>
    <div class="container">
        <?php if($company): ?>
            <div style="margin-bottom: 10px;width: 100%;">
                <?php if($company->logo == '/img/logo176x32.png'): ?>
                    <img src="<?php echo e(asset($company->logo)); ?>" style="width: 300px;" />
                <?php else: ?>
                    <img src="<?php echo e(asset('storage/' . $company->logo)); ?>" style="width: 300px" />
                <?php endif; ?>
            </div>
        <?php endif; ?>
        <h1>Hola, <?php echo e($person->names); ?></h1>
        <p>Recibimos una solicitud para que puedas crear una nueva contraseña de acceso a tu cuenta.</p>
        <p>Para continuar, ingresa con este enlace y confirma tu correo y numero de identificacion.</p>
        <a href="<?php echo e($resetUrl); ?>" class="button" style="color: #fff">Recuperar contraseña</a>
        <p>Este enlace caducara en 60 minutos.</p>
        <p>Si no solicitaste este cambio, puedes ignorar este correo.</p>
        <div class="footer">
            <p>Saludos,<br>El equipo de <?php echo e($company->name ?? config('app.name')); ?></p>
        </div>
    </div>
</body>

</html>
<?php /**PATH C:\laragon\www\globalcpa\resources\views\emails\student_password_recovery.blade.php ENDPATH**/ ?>