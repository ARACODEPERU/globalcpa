<?php

namespace Modules\Academic\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Inertia\Inertia;
use Modules\Academic\Entities\AcaCourse;
use Modules\Academic\Entities\AcaCourseLanding;

class AcaCourseLandingController extends Controller
{
    use ValidatesRequests;

    public function edit($courseId)
    {
        $course = AcaCourse::with('category', 'modality')->findOrFail($courseId);

        $landing = AcaCourseLanding::where('course_id', $courseId)->first();

        if (! $landing) {
            $landing = AcaCourseLanding::create([
                'course_id' => $courseId,
                'url_slug' => AcaCourseLanding::generateSlug($course->description),
                'banner_language' => 'es',
                'is_published' => false,
            ]);
        }

        return Inertia::render('Academic::Courses/Landing', [
            'course' => $course,
            'landing' => $landing,
            'languageOptions' => AcaCourseLanding::getLanguageOptions(),
        ]);
    }

    public function updateGeneral(Request $request, $courseId)
    {
        $this->validate(
            $request,
            [
                'url_slug' => 'required|string|max:500|unique:aca_course_landings,url_slug,'.$courseId.',course_id',
                'is_published' => 'boolean',
            ]
        );

        $landing = AcaCourseLanding::where('course_id', $courseId)->firstOrFail();

        // Limpiar url_slug: eliminar espacios y caracteres especiales
        $slug = trim($request->url_slug);
        $slug = strtolower($slug);
        $slug = preg_replace('/[^a-z0-9-]/', '', $slug);
        $slug = preg_replace('/-+/', '-', $slug);
        $slug = trim($slug, '-');

        $landing->update([
            'url_slug' => $slug,
            'is_published' => $request->is_published ?? false,
        ]);
    }

    public function updateBanner(Request $request, $courseId)
    {
        $this->validate(
            $request,
            [
                'banner_start_date' => 'required|date',
                'banner_end_date' => 'required|date|after_or_equal:banner_start_date',
                'banner_language' => 'required|in:es,en,zh',
            ]
        );

        $landing = AcaCourseLanding::where('course_id', $courseId)->firstOrFail();

        $startDate = Carbon::parse($request->banner_start_date);
        $endDate = Carbon::parse($request->banner_end_date);
        $duration = $startDate->diffInDays($endDate) + 1;

        $landing->update([
            'banner_start_date' => $request->banner_start_date,
            'banner_end_date' => $request->banner_end_date,
            'banner_duration' => $duration,
            'banner_language' => $request->banner_language,
        ]);
    }

    public function updateProfessional(Request $request, $courseId)
    {
        $this->validate(
            $request,
            [
                'name' => 'nullable|string|max:255',
                'title' => 'nullable|string|max:255',
                'description' => 'nullable|string',
                'items' => 'nullable|array',
                'items.*.icon' => 'nullable|string|max:100',
                'items.*.title' => 'nullable|string|max:255',
                'items.*.description' => 'nullable|string',
            ]
        );

        $landing = AcaCourseLanding::where('course_id', $courseId)->firstOrFail();

        $professionalUpdate = [
            'name' => $request->name ?? '',
            'title' => $request->title ?? '',
            'description' => $request->description ?? '',
            'items' => $request->items ?? [
                ['icon' => '', 'title' => '', 'description' => ''],
                ['icon' => '', 'title' => '', 'description' => ''],
            ],
        ];

        $landing->update([
            'professional_section' => $professionalUpdate,
        ]);
    }

    public function show($slug)
    {
        $landing = AcaCourseLanding::where('url_slug', $slug)
            ->where('is_published', true)
            ->with('course.category', 'course.modality')
            ->firstOrFail();

        return Inertia::render('Academic::Courses/PublicLanding', [
            'landing' => $landing,
        ]);
    }
}
