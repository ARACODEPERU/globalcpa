<!DOCTYPE html>
<html lang="es">
<head>
    <title>Suscripción Expirada</title>
</head>
    <body>
        <p>¡Hola <?php echo e($studentName); ?>!</p>

        <p>Te escribimos para informarte que tu suscripción académica ha **expirado**.</p>
        <p>Estos son los detalles de tu suscripción:</p>
        <ul>
            <li>**ID de Suscripción:** <?php echo e($subscription->subscription_id); ?></li>
            <li>**Fecha de Inicio:** <?php echo e(\Carbon\Carbon::parse($subscription->date_start)->format('d/m/Y')); ?></li>
            <li>**Fecha de Fin:** <?php echo e(\Carbon\Carbon::parse($subscription->date_end)->format('d/m/Y')); ?></li>
        </ul>

        <p>Para renovar tu acceso y continuar disfrutando de nuestros contenidos, por favor, visita nuestra plataforma o ponte en contacto con nuestro equipo de soporte.</p>

        <p>¡Esperamos verte de vuelta pronto!</p>
        <p>Saludos cordiales,</p>
        <p>El Equipo Académico.</p>
    </body>
</html>
<?php /**PATH C:\laragon\www\globalcpa\Modules\Academic\Resources\views\emails\subscription-expired.blade.php ENDPATH**/ ?>