@props(['landing'])

<div class="container-fluid card aos-animate" data-aos="fade-up">
    <div class="row">
        @if (filled($landing->problem_section ?? null))
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-5">
                        <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                            style="background-color: rgba(220, 53, 69, 0.1); color: #dc3545;">
                            <i class="fa fa-exclamation-triangle me-1"></i> {{ $landing->problem_section['name'] }}
                        </span>
                        <h2 class="fw-bold display-6" style="color: #002060;">{{ $landing->problem_section['title'] }}</h2>
                        <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">{{ $landing->problem_section['description'] }}</p>
                    </div>

                    <div class="row g-4 justify-content-center">
                        @if (filled($landing->problem_section['items'][0] ?? null))
                            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                                <div
                                    class="h-100 p-4 rounded-4 border shadow-sm text-center bg-white transition-all">
                                    <div class="mb-4">
                                        <i class="fa {{ $landing->problem_section['items'][0]['icon']  }} text-warning" style="font-size: 3.5rem;"></i>
                                    </div>
                                    <h4 class="fw-bold mb-1" style="color: #002060; font-size: 20px;">{{ $landing->problem_section['items'][0]['title']  }}</h4>
                                    <p class="text-muted mb-0" style="font-size: 15px;">{{ $landing->problem_section['items'][0]['description']  }}</p>
                                </div>
                            </div>
                        @endif

                        @if (filled($landing->problem_section['items'][1] ?? null))
                            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                                <div
                                    class="h-100 p-4 rounded-4 border shadow-sm text-center bg-white transition-all">
                                    <div class="mb-4">
                                        <i class="fa {{ $landing->problem_section['items'][1]['icon']  }} text-warning" style="font-size: 3.5rem;"></i>
                                    </div>
                                    <h4 class="fw-bold mb-1" style="color: #002060; font-size: 20px;">{{ $landing->problem_section['items'][1]['title']  }}
                                    </h4>
                                    <p class="text-muted mb-0" style="font-size: 15px;">{{ $landing->problem_section['items'][1]['description']  }}</p>
                                </div>
                            </div>
                        @endif

                        @if (filled($landing->problem_section['items'][2] ?? null))
                            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                                <div
                                    class="h-100 p-4 rounded-4 border shadow-sm text-center bg-white transition-all">
                                    <div class="mb-4">
                                        <i class="fa {{ $landing->problem_section['items'][2]['icon']  }} text-warning" style="font-size: 3.5rem;"></i>
                                    </div>
                                    <h4 class="fw-bold mb-1" style="color: #002060; font-size: 20px;">{{ $landing->problem_section['items'][2]['title']  }}</h4>
                                    <p class="text-muted mb-0" style="font-size: 15px;">{{ $landing->problem_section['items'][2]['description']  }}</p>
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        @endif
    </div>
</div>