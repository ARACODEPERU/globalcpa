@props(['landing'])

<style>
    .text-navy-custom { color: #002060 !important; }
    :is(.dark, .dark-only) .text-navy-custom { color: #f6f7fb !important; }

    .bg-item-custom { background-color: #ffffff !important; }
    :is(.dark, .dark-only) .bg-item-custom {
        background-color: #1d273a !important;
        border-color: #374558 !important;
    }

    .fa-solid, .fas {
        font-family: "Font Awesome 6 Free" !important;
        font-weight: 900 !important;
    }
</style>

<div class="container-fluid card aos-animate border-0 shadow-sm" data-aos="fade-up">
    <div class="row">
        @if (filled($landing->problem_section ?? null))
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-5">
                        <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                            style="background-color: rgba(220, 53, 69, 0.1); color: #dc3545; font-size: 14px; font-weight: 600;">
                            <i class="fa-solid fa-triangle-exclamation me-1"></i> {{ $landing->problem_section['name'] }}
                        </span>
                        <h2 class="fw-bold display-6 text-navy-custom">{{ $landing->problem_section['title'] }}</h2>
                        <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">{{ $landing->problem_section['description'] }}</p>
                    </div>

                    <div class="row g-4 justify-content-center">
                        @if (filled($landing->problem_section['items'][0] ?? null))
                            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                                <div
                                    class="h-100 p-4 rounded-4 border shadow-sm text-center bg-item-custom transition-all">
                                    <div class="mb-4">
                                        <i class="fa-solid fa-{{ str_replace('fa-', '', $landing->problem_section['items'][0]['icon']) }}" 
                                           style="font-size: 3.5rem; color: #f8aa4b;"></i>
                                    </div>
                                    <h4 class="fw-bold mb-1 text-navy-custom" style="font-size: 20px;">{{ $landing->problem_section['items'][0]['title']  }}</h4>
                                    <p class="text-muted mb-0" style="font-size: 15px;">{{ $landing->problem_section['items'][0]['description']  }}</p>
                                </div>
                            </div>
                        @endif

                        @if (filled($landing->problem_section['items'][1] ?? null))
                            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                                <div
                                    class="h-100 p-4 rounded-4 border shadow-sm text-center bg-item-custom transition-all">
                                    <div class="mb-4">
                                        <i class="fa-solid fa-{{ str_replace('fa-', '', $landing->problem_section['items'][1]['icon']) }}" 
                                           style="font-size: 3.5rem; color: #f8aa4b;"></i>
                                    </div>
                                    <h4 class="fw-bold mb-1 text-navy-custom" style="font-size: 20px;">{{ $landing->problem_section['items'][1]['title']  }}
                                    </h4>
                                    <p class="text-muted mb-0" style="font-size: 15px;">{{ $landing->problem_section['items'][1]['description']  }}</p>
                                </div>
                            </div>
                        @endif

                        @if (filled($landing->problem_section['items'][2] ?? null))
                            <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                                <div
                                    class="h-100 p-4 rounded-4 border shadow-sm text-center bg-item-custom transition-all">
                                    <div class="mb-4">
                                        <i class="fa-solid fa-{{ str_replace('fa-', '', $landing->problem_section['items'][2]['icon']) }}" 
                                           style="font-size: 3.5rem; color: #f8aa4b;"></i>
                                    </div>
                                    <h4 class="fw-bold mb-1 text-navy-custom" style="font-size: 20px;">{{ $landing->problem_section['items'][2]['title']  }}</h4>
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