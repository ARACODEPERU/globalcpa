<?php

namespace Modules\Academic\Services;

use Carbon\Carbon;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Modules\Academic\Entities\AcaSubscriptionUtmSetting;

/**
 * Atribucion de la pagina publica de suscripciones.
 *
 * El enlace UTM es compartido por todos los planes, asi que:
 * - Vistas:  eventos "view" de aca_subscription_tracking con la campana global.
 * - Clics:   eventos "click" sobre "Suscribirme" (guardan el plan elegido).
 * - Ventas:  filas de aca_student_subscriptions, con el origen de la venta en
 *            linea (onli_sales) y el plan al que se afilio la persona.
 */
class SubscriptionUtmStatsService
{
    public const DEFAULT_CAMPAIGN = 'suscripciones';

    public const SOURCE_LABELS = [
        'facebook_ads' => 'Facebook Ads',
        'google_ads' => 'Google Ads',
        'cpc' => 'CPC',
        'social' => 'Social',
        'organic' => 'Orgánico',
        'email' => 'Email',
        'referrer' => 'Otra página',
        'direct' => 'Directo / manual',
    ];

    /**
     * Configuracion compartida (campana y canales).
     *
     * @return array{campaign: string, channels: array<int, array<string, mixed>>}
     */
    public function configuration(): array
    {
        $setting = AcaSubscriptionUtmSetting::find(1);
        $campaign = trim((string) ($setting->campaign ?? ''));
        $channels = $setting->channels ?? [];

        return [
            'campaign' => $campaign !== '' ? $campaign : self::DEFAULT_CAMPAIGN,
            'channels' => is_array($channels) ? $channels : [],
        ];
    }

    /**
     * @param array<int, array<string, mixed>> $channels
     * @return array{campaign: string, channels: array<int, array<string, mixed>>}
     */
    public function saveConfiguration(string $campaign, array $channels): array
    {
        $setting = AcaSubscriptionUtmSetting::find(1) ?: new AcaSubscriptionUtmSetting();

        $setting->campaign = $campaign !== '' ? $campaign : self::DEFAULT_CAMPAIGN;
        $setting->channels = $channels;
        $setting->save();

        return $this->configuration();
    }

    public function label(?string $source): string
    {
        if (! $source) {
            return self::SOURCE_LABELS['direct'];
        }

        return self::SOURCE_LABELS[$source] ?? Str::title(str_replace('_', ' ', $source));
    }

    /**
     * Interpreta el filtro de la interfaz: rango de fechas ("a" o "to") o mes YYYY-MM.
     *
     * @return array{0: ?Carbon, 1: ?Carbon, 2: string}
     */
    public function range(?string $dates, ?string $month): array
    {
        if ($month && preg_match('/^\d{4}-\d{2}$/', $month)) {
            $start = Carbon::createFromFormat('Y-m-d', $month . '-01')->startOfMonth();

            return [
                $start,
                $start->copy()->endOfMonth(),
                ucfirst($start->copy()->locale('es')->translatedFormat('F Y')),
            ];
        }

        if ($dates) {
            if (str_contains($dates, ' to ') || str_contains($dates, ' a ')) {
                $separator = str_contains($dates, ' to ') ? ' to ' : ' a ';
                [$from, $to] = array_map('trim', explode($separator, $dates, 2));

                try {
                    $start = Carbon::parse($from)->startOfDay();
                    $end = Carbon::parse($to)->endOfDay();

                    return [$start, $end, $start->format('d/m/Y') . ' - ' . $end->format('d/m/Y')];
                } catch (\Throwable $e) {
                    // Fecha invalida: se ignora el filtro.
                }
            } else {
                try {
                    $day = Carbon::parse($dates);

                    return [$day->copy()->startOfDay(), $day->copy()->endOfDay(), $day->format('d/m/Y')];
                } catch (\Throwable $e) {
                    // Fecha invalida: se ignora el filtro.
                }
            }
        }

        return [null, null, 'Todo el historial'];
    }

    /**
     * Resumen para la interfaz y los reportes.
     *
     * @return array{totals: array, origins: array, plans: array, affiliations: array}
     */
    public function summary(?Carbon $start, ?Carbon $end, ?string $campaign = null): array
    {
        $campaign = $campaign ?: $this->configuration()['campaign'];

        $views = $this->viewsQuery($campaign, $start, $end);
        $clicks = $this->clicksQuery($start, $end);
        $subscriptions = $this->subscriptionsQuery($start, $end);

        $totals = [
            'views' => (clone $views)->count(),
            'clicks' => (clone $clicks)->count(),
            'subscriptions' => (clone $subscriptions)->count(),
            'attributed' => (clone $subscriptions)->where('os.utm_campaign', $campaign)->count(),
        ];

        $viewsBy = $this->countBySource($views, "COALESCE(NULLIF(tr.traffic_source, ''), 'direct')");
        $clicksBy = $this->countBySource($clicks, "COALESCE(NULLIF(tr.traffic_source, ''), 'direct')");
        $subscriptionsBy = $this->countBySource($subscriptions, "COALESCE(NULLIF(os.traffic_source, ''), 'direct')");

        $keys = collect($viewsBy->keys())
            ->merge($clicksBy->keys())
            ->merge($subscriptionsBy->keys())
            ->filter()
            ->unique()
            ->values();

        $origins = $keys->map(fn ($key) => [
            'traffic_source' => $key,
            'label' => $this->label($key),
            'views' => (int) ($viewsBy[$key] ?? 0),
            'clicks' => (int) ($clicksBy[$key] ?? 0),
            'subscriptions' => (int) ($subscriptionsBy[$key] ?? 0),
        ])
            ->sortByDesc(fn ($row) => ($row['subscriptions'] * 10000) + ($row['clicks'] * 100) + $row['views'])
            ->values()
            ->all();

        $plans = (clone $subscriptions)
            ->select('s.subscription_id', 't.title', 't.period', DB::raw('COUNT(*) as total'))
            ->groupBy('s.subscription_id', 't.title', 't.period')
            ->orderByDesc('total')
            ->get()
            ->map(function ($row) {
                $title = $row->title ?: 'Plan #' . $row->subscription_id;
                $period = trim((string) $row->period);

                if ($period !== '' && ! str_contains(mb_strtolower($title), mb_strtolower($period))) {
                    $title .= ' (' . $period . ')';
                }

                return [
                    'subscription_id' => (int) $row->subscription_id,
                    'title' => $title,
                    'total' => (int) $row->total,
                ];
            })
            ->values()
            ->all();

        $affiliations = $this->subscriptionRows($start, $end)
            ->take(10)
            ->map(fn ($row) => [
                'date' => $row->created_at ? Carbon::parse($row->created_at)->format('d/m/Y H:i') : '-',
                'student' => $row->student_name ?: 'Sin alumno registrado',
                'plan' => $row->plan_title ?: '-',
                'origin' => $this->label($row->traffic_source),
            ])
            ->values()
            ->all();

        return [
            'totals' => $totals,
            'origins' => $origins,
            'plans' => $plans,
            'affiliations' => $affiliations,
        ];
    }

    /**
     * Detalle de vistas y clics para el Excel.
     */
    public function eventRows(?Carbon $start, ?Carbon $end, ?string $campaign = null): Collection
    {
        $campaign = $campaign ?: $this->configuration()['campaign'];

        return $this->trackingQuery($campaign, $start, $end)
            ->leftJoin('aca_subscription_types as t', 't.id', '=', 'tr.subscription_type_id')
            ->select(
                'tr.created_at',
                'tr.event',
                'tr.subscription_type_id',
                't.title as plan_title',
                'tr.traffic_source',
                'tr.utm_source',
                'tr.utm_medium',
                'tr.utm_campaign',
                'tr.utm_term',
                'tr.utm_content',
                'tr.landing_url',
                'tr.referer'
            )
            ->orderByDesc('tr.created_at')
            ->get();
    }

    /**
     * Detalle de suscripciones (a que plan se afilio cada persona).
     */
    public function subscriptionRows(?Carbon $start, ?Carbon $end): Collection
    {
        return $this->subscriptionsQuery($start, $end)
            ->leftJoin('aca_students as st', 'st.id', '=', 's.student_id')
            ->leftJoin('people as p', 'p.id', '=', 'st.person_id')
            ->select(
                's.created_at',
                's.subscription_id',
                't.title as plan_title',
                'p.full_name as student_name',
                'os.traffic_source',
                'os.utm_source',
                'os.utm_medium',
                'os.utm_campaign',
                'os.utm_content',
                'os.landing_url'
            )
            ->orderByDesc('s.created_at')
            ->get();
    }

    private function trackingQuery(string $campaign, ?Carbon $start, ?Carbon $end): Builder
    {
        return DB::table('aca_subscription_tracking as tr')
            ->where(function ($query) use ($campaign) {
                $query->where(function ($view) use ($campaign) {
                    $view->where('tr.event', 'view')->where('tr.utm_campaign', $campaign);
                })->orWhere('tr.event', 'click');
            })
            ->when($start && $end, fn ($query) => $query->whereBetween('tr.created_at', [$start, $end]));
    }

    private function viewsQuery(string $campaign, ?Carbon $start, ?Carbon $end): Builder
    {
        return DB::table('aca_subscription_tracking as tr')
            ->where('tr.event', 'view')
            ->where('tr.utm_campaign', $campaign)
            ->when($start && $end, fn ($query) => $query->whereBetween('tr.created_at', [$start, $end]));
    }

    private function clicksQuery(?Carbon $start, ?Carbon $end): Builder
    {
        return DB::table('aca_subscription_tracking as tr')
            ->where('tr.event', 'click')
            ->when($start && $end, fn ($query) => $query->whereBetween('tr.created_at', [$start, $end]));
    }

    private function subscriptionsQuery(?Carbon $start, ?Carbon $end): Builder
    {
        return DB::table('aca_student_subscriptions as s')
            ->leftJoin('onli_sales as os', 'os.id', '=', 's.onli_sale_id')
            ->leftJoin('aca_subscription_types as t', 't.id', '=', 's.subscription_id')
            ->when($start && $end, fn ($query) => $query->whereBetween('s.created_at', [$start, $end]));
    }

    /**
     * Agrupa por la expresion calculada dentro de una subconsulta: asi el
     * GROUP BY usa una columna real y funciona igual en MySQL y MariaDB
     * (con ONLY_FULL_GROUP_BY no siempre aceptan agrupar por la expresion).
     */
    private function countBySource(Builder $query, string $expression): Collection
    {
        return DB::query()
            ->fromSub($query->selectRaw($expression . ' as source_key'), 'sources')
            ->selectRaw('source_key, COUNT(*) as total')
            ->groupBy('source_key')
            ->pluck('total', 'source_key');
    }
}
