@props(['landing'])

@if (filled($landing->study_plan_section ?? null))
    <div class="container-fluid card aos-animate" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <!-- Header de Sección -->
                    <div class="text-center mb-5">
                        <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                            style="background-color: rgba(0, 32, 96, 0.1); color: #002060;">
                            <i class="fa fa-list-ul me-1"></i> {{ $landing->study_plan_section['name'] }}
                        </span>
                        <h2 class="fw-bold display-6" style="color: #002060;">{{ $landing->study_plan_section['title'] }}</h2>
                        <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">{{ $landing->study_plan_section['description'] }}</p>
                    </div>

                    <div class="row align-items-center">
                        <!-- Columna de Imagen -->
                        <div class="col-lg-5 mb-4 mb-lg-0" data-aos="fade-right">
                            <div class="position-relative">
                                <img src="{{ asset("storage/".$landing->study_plan_section['image']) }}"
                                    alt="Temario Especializado" class="img-fluid rounded-4 shadow-lg"
                                    style="border: 8px solid #f8f9fa;">
                                <div
                                    class="position-absolute bottom-0 start-0 m-3 p-3 bg-warning rounded-3 shadow d-none d-sm-block">
                                    <span class="fw-bold text-dark">Módulos 100% Actualizados</span>
                                </div>
                            </div>
                        </div>

                        <!-- Columna de Temas -->
                        <div class="col-lg-7" data-aos="fade-left">
                            <div class="ps-lg-4">

                                @if (filled($landing->study_plan_section['items'] ?? null))
                                    @foreach ($landing->study_plan_section['items'] as $item)
                                        <div class="d-flex mb-4">
                                            <div class="flex-shrink-0">
                                                <span
                                                    class="badge rounded-circle bg-primary d-flex align-items-center justify-content-center shadow"
                                                    style="width: 45px; height: 45px; background-color: #002060 !important; font-size: 1.1rem;">{{ $loop->iteration }}</span>
                                            </div>
                                            <div class="ms-3">
                                                <h5 class="fw-bold" style="color: #002060;">{{ $item['title'] }}</h5>
                                                <p class="text-muted">{{ $item['description'] }}</p>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif