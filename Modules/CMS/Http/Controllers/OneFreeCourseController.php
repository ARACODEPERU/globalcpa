<?php

namespace Modules\CMS\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Parameter;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Inertia\Inertia;
use Modules\Academic\Entities\AcaCourse;
use Modules\CMS\Entities\CmsLanding;
use Modules\CMS\Entities\CmsLandingLead;
use Modules\CMS\Http\Requests\CmsLandingRequest;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class OneFreeCourseController extends Controller
{
    protected $P000010; ///token Tiny

    public function __construct()
    {
        $this->P000010  = Parameter::where('parameter_code', 'P000010')->value('value_default');
    }

    public function index($id)
    {
        $courses = AcaCourse::where('type_description','<>','Programas de Especialización')->get();

        $landingPage = CmsLanding::where('menu_id', $id)->first();

        return Inertia::render('CMS::Landings/CourseFree',[
            'courses' => $courses,
            'tinykey' => $this->P000010,
            'landingPage' => $landingPage
        ]);
    }

    public function store(CmsLandingRequest $request): RedirectResponse
    {
        $menu = $request->get('menu_id');
        // $menu = '01';
        try {
            // Verificamos si viene una imagen
            $mainImagePath = null;
            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = date('YmdHis') . '.' . $extension;

                // lo guarda en storage/app/public/uploads/cmsLanding con el nombre personalizado
                $mainImagePath = $file->storeAs('uploads/cmsLanding', $filename, 'public');
            }
            //dd($request->get('landing_id'));
            if (!$request->filled('landing_id')) {

                // === CREAR NUEVO ===
                CmsLanding::create([
                    'title'             => $request->get('title'),
                    'slug'              => $request->get('slug'),
                    'description_short' => $request->get('description_short'),
                    'description_long'  => $request->get('description_long'),
                    'main_image'        => $mainImagePath,
                    'data_related'      => $request->get('data_related') ?? null,
                    'data_related2'     => $request->get('data_related2') ?? null,
                    'additional_field1' => $request->get('additional_field1'),
                    'additional_field2' => $request->get('additional_field2'),
                    'additional_field3' => $request->get('additional_field3'),
                    'date_start'        => $request->get('date_start') ?? null,
                    'date_end'          => $request->get('date_end') ?? null,
                    'free_courses_count' => $this->freeCoursesCount($request),
                    'status'            => $request->get('status', 1),
                    'menu_id'           => $menu
                ]);

                return to_route('cms_landing_course_free', $menu)
                    ->with('success', 'Landing creada correctamente.');
            } else {
                // === ACTUALIZAR ===
                $landing = CmsLanding::findOrFail($request->get('landing_id'));

                if ($mainImagePath && $landing->main_image) {
                    Storage::disk('public')->delete($landing->main_image);
                }

                $landing->update([
                    'title'             => $request->get('title'),
                    'slug'              => $request->get('slug'),
                    'description_short' => $request->get('description_short'),
                    'description_long'  => $request->get('description_long'),
                    'main_image'        => $mainImagePath ?? $landing->main_image,
                    'data_related'      => $request->get('data_related') ?? null,
                    'data_related2'     => $request->get('data_related2') ?? null,
                    'additional_field1' => $request->get('additional_field1'),
                    'additional_field2' => $request->get('additional_field2'),
                    'additional_field3' => $request->get('additional_field3'),
                    'date_start'        => $request->get('date_start') ?? null,
                    'date_end'          => $request->get('date_end') ?? null,
                    'free_courses_count' => $this->freeCoursesCount($request),
                    'status'            => $request->get('status', 1),
                ]);

                return to_route('cms_landing_course_free', $menu)
                    ->with('success', 'Landing actualizada correctamente.');
            }

        } catch (\Exception $e) {
            return to_route('cms_landing_course_free', $menu)
                ->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Cantidad de cursos gratis que puede elegir el usuario (1 a 3).
     */
    private function freeCoursesCount(Request $request): int
    {
        $count = (int) $request->get('free_courses_count', 1);

        return max(1, min(3, $count ?: 1));
    }

    /**
     * Guarda la configuracion de enlaces UTM de la landing de curso gratis.
     */
    public function updateUtmConfig(Request $request, $menu_id)
    {
        $request->validate([
            'campaign' => 'nullable|string|max:255',
            'channels' => 'nullable|array',
            'channels.*.id' => 'required|string|max:100',
            'channels.*.term' => 'nullable|string|max:500',
            'channels.*.content' => 'nullable|string|max:500',
            'channels.*.active' => 'nullable|boolean',
        ]);

        $landing = CmsLanding::where('menu_id', $menu_id)->firstOrFail();

        $campaign = trim((string) $request->campaign) ?: $this->defaultUtmCampaign($landing);

        $landing->update([
            'utm_config' => [
                'campaign' => $campaign,
                'channels' => $request->channels ?? [],
            ],
        ]);

        return response()->json(['success' => true, 'campaign' => $campaign]);
    }

    /**
     * Llegadas (registros) de la landing agrupadas por origen de campana.
     */
    public function utmStats(Request $request, $menu_id)
    {
        $landing = CmsLanding::where('menu_id', $menu_id)->first();

        if (!$landing) {
            return response()->json($this->emptyUtmStats());
        }

        [$start, $end] = $this->parseDateRange($request->get('dates'));

        $leadsQuery = CmsLandingLead::where('landing_id', $landing->id);

        if ($start && $end) {
            $leadsQuery->whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end);
        }

        $bySource = (clone $leadsQuery)
            ->select('traffic_source', DB::raw('COUNT(*) as total'))
            ->groupBy('traffic_source')
            ->orderByDesc('total')
            ->get();

        $socialDetail = (clone $leadsQuery)
            ->where('traffic_source', 'social')
            ->select('utm_source', 'utm_medium', DB::raw('COUNT(*) as total'))
            ->groupBy('utm_source', 'utm_medium')
            ->orderByDesc('total')
            ->get();

        $campaigns = (clone $leadsQuery)
            ->select('utm_campaign', DB::raw('COUNT(*) as total'))
            ->groupBy('utm_campaign')
            ->orderByDesc('total')
            ->get();

        $referrers = $this->groupLeadsByRefererHost(
            (clone $leadsQuery)
                ->where('traffic_source', 'referrer')
                ->whereNotNull('referer')
                ->where('referer', '!=', '')
                ->select('referer')
                ->get()
        );

        $leads = (clone $leadsQuery)
            ->orderByDesc('id')
            ->limit(15)
            ->get([
                'name', 'email', 'phone', 'utm_source', 'utm_medium', 'utm_campaign',
                'traffic_source', 'referer', 'created_at',
            ]);

        return response()->json([
            'total' => (clone $leadsQuery)->count(),
            'by_source' => $bySource,
            'social_detail' => $socialDetail,
            'campaigns' => $campaigns,
            'referrers' => $referrers,
            'leads' => $leads,
        ]);
    }

    /**
     * Registros (llegadas) obtenidos desde la landing de curso gratis, paginados.
     */
    public function freeCourseRegistrations(Request $request, $menu_id)
    {
        $landing = CmsLanding::where('menu_id', $menu_id)->first();
        $perPage = max(5, min(100, (int) $request->get('per_page', 20)));

        if (!$landing) {
            return response()->json([
                'total' => 0,
                'current_page' => 1,
                'last_page' => 1,
                'per_page' => $perPage,
                'rows' => [],
            ]);
        }

        $leads = $this->freeCourseLeadsQuery($landing, $request->get('dates'))
            ->orderByDesc('id')
            ->paginate($perPage, $this->freeCourseRegistrationsColumns(), 'page', (int) $request->get('page', 1));

        return response()->json([
            'total' => $leads->total(),
            'current_page' => $leads->currentPage(),
            'last_page' => $leads->lastPage(),
            'per_page' => $leads->perPage(),
            'rows' => collect($leads->items())->map(fn ($lead) => $this->freeCourseRegistrationRow($lead))->values(),
        ]);
    }

    /**
     * Exporta los registros de la landing en Excel (xlsx) o PDF.
     */
    public function exportFreeCourseRegistrations(Request $request, $menu_id, $format)
    {
        $landing = CmsLanding::where('menu_id', $menu_id)->first();
        $format = $format === 'pdf' ? 'pdf' : 'excel';
        $dates = $request->get('dates');

        $rows = $landing
            ? $this->freeCourseLeadsQuery($landing, $dates)
                ->orderByDesc('id')
                ->get($this->freeCourseRegistrationsColumns())
                ->map(fn ($lead) => $this->freeCourseRegistrationRow($lead))
                ->all()
            : [];

        $headers = [
            'Fecha', 'Nombre', 'Correo', 'Teléfono', 'Origen',
            'utm_source', 'utm_medium', 'utm_campaign', 'Referer', 'URL de la landing',
        ];

        $fileName = 'registros-' . ($landing->slug ?: 'curso-gratis') . '-' . now()->format('Ymd-His');

        if ($format === 'pdf') {
            return Pdf::loadView('cms::landings.free-course-registrations-pdf', [
                'landing' => $landing,
                'headers' => $headers,
                'rows' => $rows,
                'range' => $dates,
            ])->setPaper('a4', 'landscape')->download($fileName . '.pdf');
        }

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setTitle('Registros');
        $sheet->fromArray($headers, null, 'A1');
        $sheet->getStyle('A1:J1')->getFont()->setBold(true);

        $rowNumber = 2;
        foreach ($rows as $row) {
            $column = 'A';
            foreach (array_values($row) as $value) {
                $sheet->setCellValueExplicit($column . $rowNumber, (string) $value, DataType::TYPE_STRING);
                $column++;
            }
            $rowNumber++;
        }

        foreach (range('A', 'J') as $column) {
            $sheet->getColumnDimension($column)->setAutoSize(true);
        }

        return response()->streamDownload(function () use ($spreadsheet) {
            (new Xlsx($spreadsheet))->save('php://output');
        }, $fileName . '.xlsx', [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
        ]);
    }

    /**
     * Consulta base de registros de la landing, con filtro opcional de fechas.
     */
    private function freeCourseLeadsQuery(CmsLanding $landing, $dates = null)
    {
        [$start, $end] = $this->parseDateRange($dates);

        $query = CmsLandingLead::where('landing_id', $landing->id);

        if ($start && $end) {
            $query->whereDate('created_at', '>=', $start)
                ->whereDate('created_at', '<=', $end);
        }

        return $query;
    }

    private function freeCourseRegistrationsColumns(): array
    {
        return [
            'name', 'email', 'phone', 'traffic_source', 'utm_source', 'utm_medium',
            'utm_campaign', 'referer', 'landing_url', 'created_at',
        ];
    }

    /**
     * Fila de registro con el mismo orden que las columnas de la tabla y la exportacion.
     */
    private function freeCourseRegistrationRow($lead): array
    {
        return [
            'fecha' => optional($lead->created_at)->format('d/m/Y H:i') ?: '',
            'nombre' => $lead->name ?: '',
            'email' => $lead->email ?: '',
            'telefono' => $lead->phone ?: '',
            'origen' => $lead->traffic_source ?: 'organic',
            'utm_source' => $lead->utm_source ?: '',
            'utm_medium' => $lead->utm_medium ?: '',
            'utm_campaign' => $lead->utm_campaign ?: '',
            'referer' => $lead->referer ?: '',
            'landing_url' => $lead->landing_url ?: '',
        ];
    }

    /**
     * Nombre de campana por defecto para la landing.
     */
    private function defaultUtmCampaign(CmsLanding $landing): string
    {
        $slug = $landing->slug ?: 'curso_gratis';

        return 'gratis_' . str_replace('-', '_', $slug);
    }

    private function emptyUtmStats(): array
    {
        return [
            'total' => 0,
            'by_source' => [],
            'social_detail' => [],
            'campaigns' => [],
            'referrers' => [],
            'leads' => [],
        ];
    }

    /**
     * Acepta "YYYY-MM-DD" o "inicio to fin" / "inicio a fin" como en el panel de cursos.
     */
    private function parseDateRange($dates): array
    {
        if (!$dates) {
            return [null, null];
        }

        if (str_contains($dates, ' to ') || str_contains($dates, ' a ')) {
            $separator = str_contains($dates, ' to ') ? ' to ' : ' a ';

            return explode($separator, $dates, 2);
        }

        return [$dates, $dates];
    }

    /**
     * Agrupa referers (URL completa) por dominio de origen, de mayor a menor.
     */
    private function groupLeadsByRefererHost($rows)
    {
        $hosts = [];

        foreach ($rows as $row) {
            $host = $row->referer ? parse_url($row->referer, PHP_URL_HOST) : null;
            $host = $host ?: (str_contains($row->referer ?? '', '.') ? $row->referer : 'Desconocido');
            $hosts[$host] = ($hosts[$host] ?? 0) + 1;
        }

        arsort($hosts);

        return collect($hosts)
            ->map(fn ($total, $host) => ['host' => $host, 'total' => $total])
            ->values();
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('cms::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('cms::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id): RedirectResponse
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
