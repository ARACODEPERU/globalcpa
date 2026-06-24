@props(['landing'])

<style>
    .text-navy-custom { color: #002060 !important; }
    :is(.dark, .dark-only) .text-navy-custom:not(button) { color: #f6f7fb !important; }

    /* Estilos para los campos del formulario */
    .input-group-text-custom {
        background-color: #ffffff;
        border-color: #dee2e6;
        color: #6c757d;
    }

    :is(.dark, .dark-only) .input-group-text-custom {
        background-color: #1d273a !important;
        border-color: #374558 !important;
        color: #b4b7c5 !important;
    }

    :is(.dark, .dark-only) .form-control,
    :is(.dark, .dark-only) .form-select {
        background-color: #1d273a !important;
        border-color: #374558 !important;
        color: #f6f7fb !important;
    }

    /* Asegurar renderizado de iconos Font Awesome 6 */
    .fa-solid, .fas {
        font-family: "Font Awesome 6 Free" !important;
        font-weight: 900 !important;
    }
</style>

<div class="container-fluid card aos-animate border-0 shadow-sm" data-aos="fade-up">
    <div class="row">
        @if (filled($landing->professional_section ?? null))
                <div class="card-body p-4 p-lg-5">
                    <div class="row">
                        <div class="col-md-12 text-center mb-5">
                            <span class="badge rounded-pill bg-light text-navy-custom px-3 py-2 mb-3 shadow-sm border"
                                style="font-size: 14px; font-weight: 600;">
                                <i class="fa-solid fa-arrows-rotate me-1"></i> {{ $landing->professional_section['name'] }}
                            </span>
                            <h2 class="fw-bold display-6 text-navy-custom">
                                {{ $landing->professional_section['title'] }}
                            </h2>
                            <p class="text-muted fs-5">
                                {{ $landing->professional_section['description'] }}
                            </p>
                        </div>
                    </div>

                    <div class="row g-4 mt-2">
                        <div class="col-md-2"></div>
                        @if ($landing->professional_section['items'][0] ?? null)
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 bg-warning-light p-3 rounded-circle me-3"
                                        style="background-color: rgba(255, 193, 7, 0.1);">
                                        <i class="fa-solid fa-{{ str_replace('fa-', '', $landing->professional_section['items'][0]['icon']) }} text-warning fs-4"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-0 fw-bold text-navy-custom" style="font-size: 18px;">
                                            {{ $landing->professional_section['items'][0]['title'] }}
                                        </h4>
                                        <p style="font-size: 15px;">
                                            {{ $landing->professional_section['items'][0]['description'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif

                        @if ($landing->professional_section['items'][1] ?? null)
                            <div class="col-md-4">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 bg-info-light p-3 rounded-circle me-3"
                                        style="background-color: rgba(0, 204, 255, 0.1);">
                                        <i class="fa-solid fa-{{ str_replace('fa-', '', $landing->professional_section['items'][1]['icon']) }} text-info fs-4"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-0 fw-bold text-navy-custom" style="font-size: 18px;">
                                            {{ $landing->professional_section['items'][1]['title'] }}
                                        </h4>
                                        <p style="font-size: 15px;">
                                            {{ $landing->professional_section['items'][1]['description'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <div class="col-md-2"></div>
                    </div>
                </div>
        @endif
    </div>
</div>
