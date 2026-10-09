<?php

namespace App\Services;

use Carbon\Carbon;
use Cron\CronExpression as BaseCronExpression;
use DateTimeInterface;
use InvalidArgumentException;

/**
 * Envoltura mínima sobre dragonmantank/cron-expression para el módulo
 * Integrationhub.
 *
 * El comando `integrationhub:run-scheduled` decide si una programación "toca
 * ahora" (`isDue`) y cuándo será la próxima (`nextRunDate`); el controlador
 * valida la expresión al guardarla (`isValid`). Tener un único servicio evita
 * que cada punto interprete la expresión a su manera.
 */
class IntegrationhubCronExpression
{
    /**
     * ¿La expresión cron es válida?
     */
    public function isValid(string $expression): bool
    {
        return BaseCronExpression::isValidExpression(trim($expression));
    }

    /**
     * ¿La expresión toca en el minuto indicado (por defecto, ahora)?
     */
    public function isDue(string $expression, DateTimeInterface|string|null $now = null): bool
    {
        return $this->make($expression)->isDue($now ?? 'now', config('app.timezone'));
    }

    /**
     * Siguiente ejecución estrictamente posterior al momento indicado.
     */
    public function nextRunDate(string $expression, DateTimeInterface|string|null $from = null): Carbon
    {
        $next = $this->make($expression)->getNextRunDate(
            $from ?? 'now',
            0,
            false,
            config('app.timezone')
        );

        return Carbon::instance($next);
    }

    /**
     * @throws InvalidArgumentException si la expresión no es válida.
     */
    private function make(string $expression): BaseCronExpression
    {
        $expression = trim($expression);

        if (! $this->isValid($expression)) {
            throw new InvalidArgumentException("Expresión cron no válida: {$expression}");
        }

        return new BaseCronExpression($expression);
    }
}
