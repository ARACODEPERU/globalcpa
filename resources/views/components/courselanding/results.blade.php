@props(['landing', 'colors'])

@if (filled($landing->results_section ?? null))
    <div class="container-fluid card aos-animate" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-5">
                        <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                            style="background-color: rgba(40, 167, 69, 0.1); color: #28a745;">
                            <i class="fa fa-check-circle me-1"></i> {{ $landing->results_section['name'] }}
                        </span>
                        <h2 class="fw-bold display-6" style="color: #002060;">
                            {{ $landing->results_section['title'] }}
                        </h2>
                        <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">
                            {{ $landing->results_section['description'] }}
                        </p>
                    </div>

                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-4 g-4 justify-center">

                        @if (filled($landing->results_section['items'] ?? null))
                            @foreach ($landing->results_section['items'] as $item)
                                <div class="col" data-aos="fade-up"
                                    data-aos-delay="{{ 100 * ($loop->index + 1) }}">
                                    <div class="h-100 p-4 rounded-4 border-0 shadow-sm text-center bg-white transition-all position-relative overflow-hidden"
                                        style="border-top: 5px solid {{ $colors[$loop->index] }} !important;">

                                        {{-- Círculo decorativo de fondo --}}
                                        <div class="position-absolute opacity-0 transition-all"
                                            style="width: 100px; height: 100px; background-color: {{ $colors[$loop->index] }}; border-radius: 50%; top: -20px; right: -20px; opacity: 0.05 !important;">
                                        </div>

                                        <div class="mb-4 d-inline-flex align-items-center justify-content-center rounded-circle shadow-sm"
                                            style="width: 70px; height: 70px; background-color: white; border: 1px solid #f1f1f1;">
                                            <i class="fa {{ $item['icon'] }}"
                                                style="font-size: 2rem; color: {{ $colors[$loop->index] }};"></i>
                                        </div>

                                        <h4 class="fw-bold mb-3" style="color: #002060;">
                                            {{ $item['title'] }}</h4>
                                        <p class="text-muted mb-0 small" style="line-height: 1.6;">
                                            {{ $item['description'] }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif