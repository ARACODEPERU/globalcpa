@props(['landing'])

{{-- Hero Section --}}
<div class="container-fluid mt-4">
    <div class="card border-0 overflow-hidden shadow mb-4"
        style="background: linear-gradient(135deg, #002060 0%, #004080 100%); border-radius: 15px;"
        data-aos="fade-in">
        <div class="card-body  text-white">
            <div class="row align-items-center">
                <div class="col-lg-8 p-4 p-lg-5">
                    <div class="d-flex align-items-center mb-3">
                        <span class="badge bg-warning text-dark me-2">{{ $landing->course->category->description ?? 'Categoría' }}</span>
                        <div class="text-warning small">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star-half-o"></i>
                        </div>
                    </div>
                    <h1 class="display-5 fw-bold mb-3" style="color: #fff;">
                        {{ $landing->course->description ?? 'Curso' }}
                    </h1>

                    @php
                        $startDate = \Carbon\Carbon::parse($landing->banner_start_date);
                        $endDate = \Carbon\Carbon::parse($landing->banner_end_date);
                        $totalDays = $startDate->diffInDays($endDate) + 1; // +1 para incluir el día de inicio

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

                    <div class="d-flex align-items-center text-white-50">
                        <span class="me-3"><i class="fa fa-clock-o me-1"></i>
                           Inicio: {{ \Carbon\Carbon::parse($landing->banner_start_date)->isoFormat('D [de] MMMM', 'es') }} | Duración: {{ $duration }} | Modalidad: {{ $landing->course->modality->description ?? 'Modalidad' }}</span>
                        <span><i class="fa fa-globe me-1"></i> {{ ['es' => 'Español', 'en' => 'Inglés', 'zh' => 'Mandarín'][$landing->banner_language] ?? $landing->banner_language }}</span>
                    </div>
                </div>
                <div class="col-lg-4 text-center d-none d-lg-block position-relative"
                    style="height: auto;">
                    @if($landing->course->image)
                    <img src="{{ asset("storage/".$landing->course->image) }}"
                        alt="{{ $landing->course->description ?? 'Curso' }}" class="img-fluid"
                        style="height: 100%;">
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>