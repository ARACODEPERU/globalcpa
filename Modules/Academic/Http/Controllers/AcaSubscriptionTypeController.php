<?php

namespace Modules\Academic\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Inertia\Inertia;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;
use Carbon\Carbon;
use Barryvdh\DomPDF\Facade\Pdf;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Modules\Academic\Entities\AcaSubscriptionType;
use Modules\Academic\Services\SubscriptionUtmStatsService;

class AcaSubscriptionTypeController extends Controller
{
    use ValidatesRequests;

    public function __construct(private SubscriptionUtmStatsService $utmStats)
    {
    }

    /**
     * Listado de tipos de suscripcion. La atribucion UTM es compartida por
     * todos los planes, por eso el panel vive aqui.
     */
    public function index()
    {
        $subscriptions = AcaSubscriptionType::orderBy('order_number')->get();

        return Inertia::render('Academic::Subscriptions/List', [
            'subscriptions' => $subscriptions,
            'subscriptionsUrl' => route('web_subscriptions'),
            'utmConfig' => $this->utmStats->configuration(),
            'utmStats' => $this->utmStatsPayload(null, null),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $periods = getEnumValues('aca_subscription_types', 'period');
        return Inertia::render('Academic::Subscriptions/Create', [
            'periods' => $periods
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //dd($request->all());
        $request->merge(['title' => trim((string) $request->get('title'))]);

        $this->validate(
            $request,
            [
                'title' => 'required|unique:aca_subscription_types,title',
                'description_html' => [
                    'required',
                    'string',
                    'max:10000',
                    function (string $attribute, $value, $fail) {
                        if ($this->descriptionLineCount($value) > 3) {
                            $fail('La descripción admite como máximo 3 líneas.');
                        }
                    },
                ],
                'details.*.label' => 'required',
                'price_note' => 'nullable|string|max:2000',
                'price_note_below' => 'nullable|string|max:2000',
                'prices.0.currency' => 'required',
                'prices.0.amount' => 'required',
                'period' => 'required'
            ],
            [
                'title.required' => 'El título del plan es obligatorio.',
                'title.unique' => 'Ya existe un plan con ese título. Los planes no pueden llamarse igual: usa un nombre diferente.',
            ]
        );

        AcaSubscriptionType::create([
            'title' => $request->get('title'),
            'usine' => $request->get('usine'),
            'description' => $this->plainDescription($request->get('description_html')),
            'description_html' => $request->get('description_html'),
            'details' => $request->get('details'),
            'prices' => $request->get('prices'),
            'price_note' => $request->get('price_note'),
            'price_note_below' => $request->get('price_note_below'),
            'status' => $request->get('status') ?? false,
            'show_dollar_price' => $request->has('show_dollar_price')
                ? $request->boolean('show_dollar_price')
                : true,
            'period' => $request->get('period'),
            'order_number' => $request->get('order_number'),
        ] + $this->accessFlagsFromRequest($request));

        return redirect()->route('aca_subscriptions_list')
            ->with('message', __('Creado con éxito'));
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('academic::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $subscription = AcaSubscriptionType::find($id);
        $periods = getEnumValues('aca_subscription_types', 'period');

        return Inertia::render('Academic::Subscriptions/Edit', [
            'subscription' => $subscription,
            'periods' => $periods
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->merge(['title' => trim((string) $request->get('title'))]);

        $this->validate(
            $request,
            [
                'title' => ['required', Rule::unique('aca_subscription_types', 'title')->ignore($id)],
                'description_html' => [
                    'required',
                    'string',
                    'max:10000',
                    function (string $attribute, $value, $fail) {
                        if ($this->descriptionLineCount($value) > 3) {
                            $fail('La descripción admite como máximo 3 líneas.');
                        }
                    },
                ],
                'details.*.label' => 'required',
                'price_note' => 'nullable|string|max:2000',
                'price_note_below' => 'nullable|string|max:2000',
                'prices.0.currency' => 'required',
                'prices.0.amount' => 'required',
                'prices.0.detail' => 'required',
                'period' => 'required'
            ],
            [
                'title.required' => 'El título del plan es obligatorio.',
                'title.unique' => 'Ya existe un plan con ese título. Los planes no pueden llamarse igual: usa un nombre diferente.',
            ]
        );

        AcaSubscriptionType::find($id)->update([
            'title' => $request->get('title'),
            'usine' => $request->get('usine'),
            'description' => $this->plainDescription($request->get('description_html')),
            'description_html' => $request->get('description_html'),
            'details' => $request->get('details'),
            'prices' => $request->get('prices'),
            'price_note' => $request->get('price_note'),
            'price_note_below' => $request->get('price_note_below'),
            'status' => $request->get('status') ?? false,
            'show_dollar_price' => $request->has('show_dollar_price')
                ? $request->boolean('show_dollar_price')
                : true,
            'period' => $request->get('period'),
            'order_number' => $request->get('order_number'),
        ] + $this->accessFlagsFromRequest($request));

        return redirect()->route('aca_subscriptions_list')
            ->with('message', __('Actualizado con éxito'));
    }

    /**
     * Guarda la configuracion UTM compartida (campana y canales).
     */
    public function updateUtmConfig(Request $request)
    {
        $this->validate(
            $request,
            [
                'campaign' => 'nullable|string|max:255',
                'channels' => 'nullable|array',
                'channels.*.id' => 'required|string|max:100',
                'channels.*.term' => 'nullable|string|max:500',
                'channels.*.content' => 'nullable|string|max:500',
                'channels.*.active' => 'nullable|boolean',
            ]
        );

        $channels = collect($request->input('channels', []))
            ->filter(fn ($channel) => is_array($channel) && ! empty($channel['id']))
            ->map(fn ($channel) => [
                'id' => (string) $channel['id'],
                'term' => mb_substr(trim((string) ($channel['term'] ?? '')), 0, 500),
                'content' => mb_substr(trim((string) ($channel['content'] ?? '')), 0, 500),
                'active' => filter_var($channel['active'] ?? true, FILTER_VALIDATE_BOOLEAN),
            ])
            ->values()
            ->all();

        $campaign = trim((string) $request->input('campaign'));

        return response()->json([
            'success' => true,
            'config' => $this->utmStats->saveConfiguration(
                $campaign !== '' ? $campaign : SubscriptionUtmStatsService::DEFAULT_CAMPAIGN,
                $channels
            ),
        ]);
    }

    /**
     * Estadisticas de atribucion compartidas (JSON para el panel).
     */
    public function getUtmStats(Request $request)
    {
        return response()->json($this->utmStatsPayload(
            $request->input('dates'),
            $request->input('month')
        ));
    }

    /**
     * Reporte Excel de vistas, clics y suscripciones atribuidas.
     */
    public function exportUtmStatsExcel(Request $request)
    {
        [$start, $end] = $this->utmStats->range($request->input('dates'), $request->input('month'));
        $payload = $this->utmStatsPayload($request->input('dates'), $request->input('month'));

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Resumen');

        $sheet->fromArray([
            ['Planes de suscripción'],
            ['Campaña', $payload['campaign']],
            ['Rango', $payload['range']['label']],
            ['Generado', now()->format('d/m/Y H:i')],
            [],
            ['Vistas', 'Clics en planes', 'Suscripciones'],
            [$payload['totals']['views'], $payload['totals']['clicks'], $payload['totals']['subscriptions']],
            [],
            ['Origen', 'Vistas', 'Clics', 'Suscripciones'],
        ], null, 'A1');

        $row = 10;
        foreach ($payload['origins'] as $origin) {
            $sheet->fromArray([
                $origin['label'],
                $origin['views'],
                $origin['clicks'],
                $origin['subscriptions'],
            ], null, 'A' . $row);
            $row++;
        }

        $row += 1;
        $sheet->fromArray(['Planes elegidos', 'Suscripciones'], null, 'A' . $row);
        $row++;
        foreach ($payload['plans'] as $chosen) {
            $sheet->fromArray([$chosen['title'], $chosen['total']], null, 'A' . $row);
            $row++;
        }

        $sheet->getStyle('A1')->getFont()->setBold(true)->setSize(13);
        $sheet->getStyle('A6:C6')->getFont()->setBold(true);
        $sheet->getStyle('A9:D9')->getFont()->setBold(true);
        $sheet->getColumnDimension('A')->setWidth(42);
        $sheet->getColumnDimension('B')->setWidth(28);

        $eventsSheet = $spreadsheet->createSheet();
        $eventsSheet->setTitle('Eventos');
        $eventsSheet->fromArray([
            'Fecha', 'Evento', 'Plan', 'Origen', 'utm_source', 'utm_medium',
            'utm_campaign', 'utm_term', 'utm_content', 'landing_url', 'referer',
        ], null, 'A1');

        $row = 2;
        foreach ($this->utmStats->eventRows($start, $end, $payload['campaign']) as $event) {
            $eventsSheet->fromArray([
                $event->created_at ? Carbon::parse($event->created_at)->format('d/m/Y H:i') : '',
                $event->event === 'click' ? 'Clic en plan' : 'Visita',
                $event->plan_title,
                $this->utmStats->label($event->traffic_source),
                $event->utm_source,
                $event->utm_medium,
                $event->utm_campaign,
                $event->utm_term,
                $event->utm_content,
                $event->landing_url,
                $event->referer,
            ], null, 'A' . $row);
            $row++;
        }
        $eventsSheet->getStyle('A1:K1')->getFont()->setBold(true);

        $subsSheet = $spreadsheet->createSheet();
        $subsSheet->setTitle('Suscripciones');
        $subsSheet->fromArray([
            'Fecha', 'Alumno', 'Plan', 'Origen', 'utm_source', 'utm_medium',
            'utm_campaign', 'utm_content', 'landing_url',
        ], null, 'A1');

        $row = 2;
        foreach ($this->utmStats->subscriptionRows($start, $end) as $sub) {
            $subsSheet->fromArray([
                $sub->created_at ? Carbon::parse($sub->created_at)->format('d/m/Y H:i') : '',
                $sub->student_name,
                $sub->plan_title,
                $this->utmStats->label($sub->traffic_source),
                $sub->utm_source,
                $sub->utm_medium,
                $sub->utm_campaign,
                $sub->utm_content,
                $sub->landing_url,
            ], null, 'A' . $row);
            $row++;
        }
        $subsSheet->getStyle('A1:I1')->getFont()->setBold(true);

        $temp = tempnam(sys_get_temp_dir(), 'utm_excel_');
        (new Xlsx($spreadsheet))->save($temp);

        $fileName = 'UTM_SUSCRIPCIONES_' . now()->format('Ymd_His') . '.xlsx';

        return response()->download($temp, $fileName)->deleteFileAfterSend(true);
    }

    /**
     * Reporte PDF (resumen, origenes, planes elegidos y afiliaciones).
     */
    public function exportUtmStatsPdf(Request $request)
    {
        [$start, $end, $label] = $this->utmStats->range($request->input('dates'), $request->input('month'));
        $payload = $this->utmStatsPayload($request->input('dates'), $request->input('month'));
        $subscriptions = $this->utmStats->subscriptionRows($start, $end);

        $pdf = Pdf::loadView('academic::subscriptions.utm_stats_pdf', [
            'campaign' => $payload['campaign'],
            'rangeLabel' => $label,
            'totals' => $payload['totals'],
            'origins' => $payload['origins'],
            'plans' => $payload['plans'],
            'subscriptions' => $subscriptions->take(200),
            'truncated' => $subscriptions->count() > 200,
            'sourceLabels' => SubscriptionUtmStatsService::SOURCE_LABELS,
            'generatedAt' => now()->format('d/m/Y H:i'),
        ]);

        $fileName = 'UTM_SUSCRIPCIONES_' . now()->format('Ymd_His') . '.pdf';

        return $pdf->setPaper('a4', 'landscape')->download($fileName);
    }

    /**
     * @return array<string, mixed>
     */
    private function utmStatsPayload(?string $dates, ?string $month): array
    {
        [$start, $end, $label] = $this->utmStats->range($dates, $month);
        $config = $this->utmStats->configuration();

        return array_merge([
            'campaign' => $config['campaign'],
            'range' => [
                'label' => $label,
                'start' => $start?->toDateString(),
                'end' => $end?->toDateString(),
            ],
        ], $this->utmStats->summary($start, $end, $config['campaign']));
    }

    /**
     * Cuenta las lineas escritas en la descripcion (saltos <br> y bloques del
     * editor). La pagina publica admite como maximo 3.
     */
    private function descriptionLineCount(?string $html): int
    {
        $html = preg_replace('#<(?:div|p|h[1-6]|li|blockquote)\b[^>]*>#i', '<br>', (string) $html);
        $html = preg_replace('#</(?:div|p|h[1-6]|li|blockquote)>#i', '', (string) $html);
        $text = rtrim(strip_tags(preg_replace('#<br\s*/?>#i', "\n", (string) $html)));

        return $text === '' ? 1 : count(explode("\n", $text));
    }

    /**
     * La descripcion larga vive con formato en description_html; description se
     * mantiene como texto plano para listados, comprobantes y webhooks.
     */
    private function plainDescription(?string $html): ?string
    {
        $text = preg_replace('#<br\s*/?>#i', ' ', (string) $html);
        $text = trim((string) preg_replace('/\s+/u', ' ', strip_tags((string) $text)));

        return $text === '' ? null : Str::limit($text, 300, '');
    }

    /**
     * Permisos editables de acceso de una suscripcion. Se guardan siempre como
     * booleanos: marcar o no cada check es lo unico que decide el acceso, de modo
     * que renombrar un plan no cambia su comportamiento.
     *
     * @return array<string, bool>
     */
    private function accessFlagsFromRequest(Request $request): array
    {
        return [
            'allow_all_courses' => $request->boolean('allow_all_courses'),
            'allow_all_specializations' => $request->boolean('allow_all_specializations'),
            'allow_all_webinars' => $request->boolean('allow_all_webinars'),
            'allow_zoom_content' => $request->boolean('allow_zoom_content'),
            'allow_webinar_content' => $request->boolean('allow_webinar_content'),
        ];
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $message = null;
        $success = false;
        try {
            // Usamos una transacción para asegurarnos de que la operación se realice de manera segura.
            DB::beginTransaction();

            // Verificamos si existe.
            $item = AcaSubscriptionType::findOrFail($id);

            // Si no hay detalles asociados, eliminamos.
            $item->delete();

            // Si todo ha sido exitoso, confirmamos la transacción.
            DB::commit();

            $message =  'Eliminado correctamente';
            $success = true;
        } catch (\Exception $e) {
            // Si ocurre alguna excepción durante la transacción, hacemos rollback para deshacer cualquier cambio.
            DB::rollback();
            $success = false;
            $message = $e->getMessage();
        }

        return response()->json([
            'success' => $success,
            'message' => $message
        ]);
    }
}
