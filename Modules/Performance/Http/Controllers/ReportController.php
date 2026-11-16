<?php

namespace Modules\Performance\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Inertia\Response;
use Modules\Performance\Services\Reports\CacheReport;
use Modules\Performance\Services\Reports\CleanupReport;
use Modules\Performance\Services\Reports\DatabaseReport;
use Modules\Performance\Services\Reports\FrontendReport;
use Modules\Performance\Services\Reports\PageReport;
use Modules\Performance\Services\Reports\QueueReport;

class ReportController extends Controller
{
    public function frontend(FrontendReport $report): Response
    {
        return $this->render($report->build());
    }

    public function database(DatabaseReport $report): Response
    {
        return $this->render($report->build());
    }

    public function cache(CacheReport $report): Response
    {
        return $this->render($report->build());
    }

    public function queues(QueueReport $report): Response
    {
        return $this->render($report->build());
    }

    public function pages(Request $request, PageReport $report): Response
    {
        return $this->render($report->build($request->root()));
    }

    public function cleanup(CleanupReport $report): Response
    {
        return $this->render($report->build());
    }

    public function cleanupRun(CleanupReport $report): JsonResponse
    {
        return response()->json($report->run());
    }

    protected function render(array $payload): Response
    {
        return Inertia::render('Performance::Report', [
            'report' => $payload,
        ]);
    }
}
