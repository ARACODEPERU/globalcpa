<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Inertia\Middleware;
use Modules\Academic\Entities\AcaStudent;
use Modules\Academic\Entities\AcaStudentSubscription;
use Tightenco\Ziggy\Ziggy;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that is loaded on the first page visit.
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determine the current asset version.
     */
    public function version(Request $request): string|null
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'auth' => [
                'user' => $request->user(),
                'roles' => $request->user() ? $request->user()->roles->pluck('name') : [],
                'permissions' => $request->user() ? $request->user()->getPermissionsViaRoles()->pluck('name') : [],
            ],
            'hasActiveSubscription' => function () use ($request) {
                $user = $request->user();
                if (!$user || !$user->person_id) {
                    return false;
                }

                $studentId = AcaStudent::where('person_id', $user->person_id)->value('id');
                if (!$studentId) {
                    return false;
                }

                $today = Carbon::today();

                return AcaStudentSubscription::where('student_id', $studentId)
                    ->where(function ($query) use ($today) {
                        $query->where('status', true)
                            ->orWhere(function ($q) use ($today) {
                                $q->whereDate('date_start', '<=', $today)
                                    ->whereDate('date_end', '>=', $today);
                            });
                    })
                    ->exists();
            },
            'ziggy' => function () use ($request) {
                return array_merge((new Ziggy)->toArray(), [
                    'location' => $request->url(),
                ]);
            },
            'flash' => [
                'message' => fn () => $request->session()->get('message')
            ],
        ]);
    }
}
