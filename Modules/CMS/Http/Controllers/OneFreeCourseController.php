<?php

namespace Modules\CMS\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Parameter;
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
