@props(['landing'])

{{-- Hero Section --}}
<div class="container-fluid mt-4">
    <div class="card border-0 overflow-hidden shadow mb-4"
        style="background: linear-gradient(135deg, #002060 0%, #004080 100%); border-radius: 15px;"
        data-aos="fade-in">

        <div class="card-body text-white">
            <div class="row align-items-center">

                <div class="col-lg-8 p-4 p-lg-5">

                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-warning text-dark me-2">
                            {{ $landing->course->category->description ?? 'Categoría' }}
                        </span>

                        <div class="text-warning small">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star-half-stroke"></i>
                        </div>
                    </div>

                    <h1 class="display-5 fw-bold mb-3 text-white">
                        {{ $landing->course->description ?? 'Curso' }}
                    </h1>

                    @php
                        $startDate = $landing->banner_start_date
                            ? \Carbon\Carbon::parse($landing->banner_start_date)
                            : now();

                        $endDate = $landing->banner_end_date
                            ? \Carbon\Carbon::parse($landing->banner_end_date)
                            : now()->addMonths(1);

                        $totalDays = $startDate->diffInDays($endDate) + 1;

                        if ($totalDays < 30) {
                            $daysRounded = ceil($totalDays);
                            $duration = $daysRounded . ' día(s)';
                        } elseif ($totalDays < 365) {
                            $totalMonths = $startDate->diffInMonths($endDate);
                            $monthsRounded = ceil($totalMonths);
                            $duration = $monthsRounded . ' mes(es)';
                        } else {
                            $totalYears = floor($totalDays / 365);
                            $remainingMonths = floor(($totalDays % 365) / 30);

                            if ($remainingMonths > 0) {
                                $duration = $totalYears . ' año(s) ' . $remainingMonths . ' mes(es)';
                            } else {
                                $duration = $totalYears . ' año(s)';
                            }
                        }
                    @endphp

                    <div class="d-flex flex-wrap align-items-center text-white-50">

                        <span class="me-3 mb-2">
                            <i class="fa-solid fa-clock me-1"></i>

                            Inicio:
                            {{ $startDate->locale('es')->isoFormat('D [de] MMMM') }}

                            |

                            Duración:
                            {{ $duration }}

                            |

                            Modalidad:
                            {{ $landing->course->modality->description ?? 'Modalidad' }}
                        </span>

                        <span class="mb-2">
                            <i class="fa-solid fa-earth-americas me-1"></i>

                            {{
                                [
                                    'es' => 'Español',
                                    'en' => 'Inglés',
                                    'zh' => 'Mandarín'
                                ][$landing->banner_language] ?? $landing->banner_language
                            }}
                        </span>

                    </div>

                </div>

                <div class="col-lg-4 d-none d-lg-flex align-items-center justify-content-center p-3">

                    @if(filled($landing->banner_video_link ?? null))

                        <div class="w-100">
                            <div class="ratio ratio-16x9 rounded overflow-hidden">
                                {!! $landing->banner_video_link !!}
                            </div>
                        </div>

                    @else

                        <img
                            src="{{ asset('storage/'.$landing->course->image) }}"
                            alt="{{ $landing->course->description ?? 'Curso' }}"
                            class="img-fluid rounded"
                            style="
                                width: 100%;
                                height: auto;
                                max-width: 100%;
                                object-fit: contain;
                                display: block;
                            "
                        >

                    @endif

                </div>

            </div>
        </div>

    </div>
</div>
