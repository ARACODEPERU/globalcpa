<?php

namespace Modules\Performance\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Performance\Services\ImageOptimizer;
use Modules\Performance\Services\ImageRepository;
use Modules\Performance\Services\HeadAudit;
use Modules\Performance\Services\ImageTools;
use Modules\Performance\Services\LazyAudit;

class PerformanceController extends Controller
{
    public function __construct(
        protected ImageRepository $repository
    ) {
    }

    public function images(): Response
    {
        return Inertia::render('Performance::Images/Index', [
            'tabs' => $this->repository->tabs(),
            'thresholds' => config('performance.thresholds'),
            'quality' => config('performance.quality'),
        ]);
    }

    public function data(Request $request): JsonResponse
    {
        $request->validate([
            'tab' => 'required|string',
        ]);

        $tab = (string) $request->query('tab');
        abort_unless(array_key_exists($tab, config('performance.tabs', [])), 422, 'Pestana no valida');

        $items = $this->repository->scan($tab);
        $bytes = array_sum(array_column($items, 'bytes'));

        return response()->json([
            'tab' => $tab,
            'count' => count($items),
            'bytes' => $bytes,
            'items' => $items,
        ]);
    }

    public function duplicates(Request $request, ImageTools $tools): JsonResponse
    {
        $request->validate([
            'tab' => 'required|string',
        ]);

        $tab = (string) $request->query('tab');
        abort_unless(array_key_exists($tab, config('performance.tabs', [])), 422, 'Pestana no valida');

        $groups = $tools->duplicates($tab);

        return response()->json([
            'tab' => $tab,
            'groups' => $groups,
            'wasted_bytes' => array_sum(array_map(
                fn ($group) => $group[0]['bytes'] * (count($group) - 1),
                $groups
            )),
        ]);
    }

    public function lazyAudit(LazyAudit $audit): Response
    {
        $result = $audit->scan();

        $totals = $result['totals'];

        return Inertia::render('Performance::Report', [
            'report' => [
                'key' => 'lazy',
                'title' => 'Auditoria de <img>',
                'description' => 'Etiquetas de imagen en Blade y Vue que no usan carga diferida ni declaran tamano.',
                'cards' => [
                    [
                        'label' => 'Imagenes encontradas',
                        'value' => (string) $totals['images'],
                        'hint' => 'En plantillas .blade.php y .vue',
                        'status' => 'ok',
                    ],
                    [
                        'label' => 'Sin loading="lazy"',
                        'value' => (string) $totals['without_lazy'],
                        'hint' => 'Se descargan aunque no se vean',
                        'status' => $totals['without_lazy'] > 0 ? 'warn' : 'ok',
                    ],
                    [
                        'label' => 'Sin width/height',
                        'value' => (string) $totals['without_sizes'],
                        'hint' => 'Provocan saltos de layout (CLS)',
                        'status' => $totals['without_sizes'] > 0 ? 'warn' : 'ok',
                    ],
                    [
                        'label' => 'Sin alt',
                        'value' => (string) $totals['without_alt'],
                        'hint' => 'Afecta accesibilidad y SEO',
                        'status' => $totals['without_alt'] > 0 ? 'warn' : 'ok',
                    ],
                ],
                'sections' => [
                    [
                        'title' => 'Etiquetas a revisar',
                        'columns' => [
                            ['key' => 'file', 'label' => 'Archivo'],
                            ['key' => 'line', 'label' => 'Linea'],
                            ['key' => 'issues', 'label' => 'Problemas'],
                            ['key' => 'code', 'label' => 'Etiqueta'],
                        ],
                        'rows' => array_map(fn ($row) => [
                            'file' => $row['file'],
                            'line' => (string) $row['line'],
                            'issues' => $row['issues'],
                            'code' => $row['code'],
                        ], $result['rows']),
                        'empty' => 'Todas las etiquetas <img> tienen carga diferida y tamano declarado.',
                    ],
                ],
                'notes' => [
                    'Corrige primero las imagenes que estan sobre el pliegue: ahi no conviene lazy, pero si width/height y alt.',
                    'No se modifico ningun archivo: esta auditoria solo reporta.',
                    $result['truncated'] ? 'Se muestran los primeros 400 resultados.' : 'Se listan todos los resultados encontrados.',
                ],
            ],
        ]);
    }

    public function headAudit(HeadAudit $audit): Response
    {
        $result = $audit->scan();
        $totals = $result['totals'];

        return Inertia::render('Performance::Report', [
            'report' => [
                'key' => 'head',
                'title' => 'Auditoria de <head>',
                'description' => 'Scripts bloqueantes, fuentes externas y metadatos que afectan la primera pintura del sitio.',
                'help' => 'Esta auditoria solo lee archivos .blade.php: no modifica nada. Cada fila indica el archivo y la linea exacta a corregir.',
                'cards' => [
                    [
                        'label' => 'Bloques <head> revisados',
                        'value' => (string) $totals['heads'],
                        'hint' => 'Vistas Blade con etiqueta head',
                        'status' => 'ok',
                    ],
                    [
                        'label' => 'Scripts bloqueantes',
                        'value' => (string) $totals['blocking'],
                        'hint' => 'Retrasan el primer pintado de la pagina',
                        'status' => $totals['blocking'] > 0 ? 'bad' : 'ok',
                    ],
                    [
                        'label' => 'Google Fonts sin preconnect',
                        'value' => (string) $totals['fonts_without_preconnect'],
                        'hint' => 'Agregan una conexion extra antes de pedir las fuentes',
                        'status' => $totals['fonts_without_preconnect'] > 0 ? 'warn' : 'ok',
                    ],
                    [
                        'label' => 'Sin meta viewport',
                        'value' => (string) $totals['without_viewport'],
                        'hint' => 'Rompe la adaptacion a movil',
                        'status' => $totals['without_viewport'] > 0 ? 'warn' : 'ok',
                    ],
                ],
                'sections' => [
                    [
                        'title' => 'Hallazgos por archivo',
                        'columns' => [
                            ['key' => 'file', 'label' => 'Archivo'],
                            ['key' => 'line', 'label' => 'Linea'],
                            ['key' => 'issue', 'label' => 'Problema'],
                            ['key' => 'fix', 'label' => 'Como corregirlo'],
                            ['key' => 'code', 'label' => 'Etiqueta'],
                        ],
                        'rows' => $result['rows'],
                        'empty' => 'No se encontraron scripts bloqueantes ni problemas de metadatos.',
                    ],
                    [
                        'title' => 'Resumen del bloque head',
                        'columns' => [
                            ['key' => 'metric', 'label' => 'Metrica'],
                            ['key' => 'value', 'label' => 'Valor'],
                        ],
                        'rows' => [
                            ['metric' => 'Hojas de estilo enlazadas', 'value' => (string) $totals['stylesheets']],
                            ['metric' => 'Scripts inline en head', 'value' => (string) $totals['inline']],
                            ['metric' => 'Archivos que usan Google Fonts', 'value' => (string) $totals['font_files']],
                            ['metric' => 'Bloques con rel=preload', 'value' => (string) $totals['with_preload']],
                        ],
                        'empty' => 'Sin datos.',
                    ],
                ],
                'notes' => [
                    'Los scripts con defer/async o type="module" no bloquean el render: esos no se reportan.',
                    'Arregla primero las vistas publicas (home, cursos, blog y libro de reclamaciones).',
                    $result['truncated'] ? 'Se muestran los primeros 300 hallazgos.' : 'Se listan todos los hallazgos encontrados.',
                ],
            ],
        ]);
    }

    public function resize(Request $request, ImageOptimizer $optimizer): JsonResponse
    {
        $maxTargets = (int) config('performance.max_targets_per_request', 200);

        $data = $request->validate([
            'targets' => 'required|array|min:1|max:'.$maxTargets,
            'targets.*.root' => 'required|string',
            'targets.*.file' => 'required|string',
            'mode' => 'required|in:percent,width',
            'percent' => 'nullable|integer|min:10|max:99',
            'width' => 'nullable|integer|min:120|max:6000',
            'quality' => 'nullable|integer|min:1|max:100',
        ]);

        $summary = $optimizer->resize($data['targets'], [
            'mode' => $data['mode'],
            'percent' => $data['percent'] ?? 80,
            'width' => $data['width'] ?? 1280,
            'quality' => $data['quality'] ?? config('performance.quality.default', 82),
        ]);

        return response()->json($summary);
    }

    public function webp(Request $request, ImageTools $tools): JsonResponse
    {
        $data = $request->validate([
            'targets' => 'required|array|min:1|max:'.(int) config('performance.max_targets_per_request', 200),
            'targets.*.root' => 'required|string',
            'targets.*.file' => 'required|string',
            'quality' => 'nullable|integer|min:1|max:100',
        ]);

        return response()->json($tools->generateWebp(
            $data['targets'],
            (int) ($data['quality'] ?? config('performance.quality.default', 82))
        ));
    }

    public function quarantine(Request $request, ImageTools $tools): JsonResponse
    {
        $data = $request->validate([
            'targets' => 'required|array|min:1|max:'.(int) config('performance.max_targets_per_request', 200),
            'targets.*.root' => 'required|string',
            'targets.*.file' => 'required|string',
            'password' => 'required|string',
        ], [
            'password.required' => 'Debes escribir tu contraseña para mover archivos a cuarentena.',
        ]);

        // Accion critica: se vuelve a pedir la contraseña del usuario autenticado.
        if (!Hash::check($data['password'], (string) $request->user()->password)) {
            return response()->json([
                'message' => 'La contraseña no es correcta. No se movio ningun archivo.',
            ], 422);
        }

        return response()->json($tools->quarantine($data['targets']));
    }
}
