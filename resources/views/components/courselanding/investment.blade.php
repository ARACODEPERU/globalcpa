@props(['landing'])

@if (filled($landing->investment_section ?? null))
    <div class="container-fluid card aos-animate mt-5" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-5">
                        <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                            style="background-color: rgba(255, 193, 7, 0.1); color: #002060;">
                            <i class="fa fa-money me-1"></i> {{ $landing->investment_section['name'] }}
                        </span>
                        <h2 class="fw-bold display-6" style="color: #002060;">
                            {{ $landing->investment_section['title'] }}</h2>
                        <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">
                            {{ $landing->investment_section['description'] }}
                        </p>
                    </div>

                    <div class="row g-4 justify-content-center">
                        <!-- Plan Regular (Pronto pago)  [0] -->
                        @if (filled($landing->investment_section['items'][0] ?? null))
                            @if ($landing->investment_section['items'][0]['price_before_visible'])
                                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                                    <div class="card h-100 border-0 shadow-lg transition-all rounded-4 overflow-hidden bg-white border-top border-warning border-5"
                                        style="border-top: 5px solid #ffc107 !important;">
                                        <div class="p-4 border-bottom"
                                            style="background-color: rgba(255, 193, 7, 0.05);">
                                            <span
                                                class="badge bg-warning text-dark mb-2">{{ $landing->investment_section['items'][0]['tag'] }}</span>
                                            <h4 class="fw-bold mb-0" style="color: #002060; font-size: 22px;">
                                                {{ $landing->investment_section['items'][0]['title'] }}
                                            </h4>
                                            <small class="text-muted" style="font-size: 15px;">La mas recomendada</small>
                                        </div>
                                        <div class="card-body p-4 text-center">
                                            <div class="mb-2">
                                                <span class="display-4 fw-bold" style="color: #002060;">S/
                                                    {{ $landing->investment_section['items'][0]['price_now'] }}</span>
                                                <span class="text-muted">/
                                                    {{ $landing->investment_section['items'][0]['price_now_text'] ?? '' }}</span>
                                            </div>

                                            <div class="mb-4">
                                                <del class="text-muted fs-4 fw-semibold"
                                                    style="color: #2d374b;">S/
                                                    {{ $landing->investment_section['items'][0]['price_before'] }}</del>
                                                <span class="text-muted small">/
                                                    {{ $landing->investment_section['items'][0]['price_before_text'] ?? '' }}</span>
                                            </div>
                                            <ul class="list-unstyled text-start mb-4">
                                                @if (filled($landing->investment_section['items'][0]['features'] ?? null))
                                                    @foreach ($landing->investment_section['items'][0]['features'] as $feature)
                                                        <li class="mb-2"><i
                                                                class="fa fa-check text-success me-2"></i>
                                                            <b>{{ $feature }}</b></li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                            <a href="javascript:void(0)" onclick="procederInscripcion()"
                                                class="btn btn-modern btn-modern-primary w-100 mb-3">
                                                <i class="fa fa-shopping-cart me-2"></i> Inscribirse ahora
                                            </a>
                                            <a href="{{ $landing->payment_facilities_link }}" target="_blank"
                                                class="btn btn-modern btn-modern-outline w-100">
                                                <i class="fa fa-whatsapp me-2"></i> Asegurar vacante y/o financiamiento
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <!-- Plan Corporativo -->
                        @if (filled($landing->investment_section['items'][1] ?? null))
                            @if ($landing->investment_section['items'][1]['price_before_visible'])
                                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                                    <div
                                        class="card h-100 border-0 shadow-sm transition-all rounded-4 overflow-hidden bg-white text-center">
                                        <div class="p-4 border-bottom bg-light">
                                            <h4 class="fw-bold mb-0" style="color: #002060; font-size: 22px;">
                                                {{ $landing->investment_section['items'][1]['tag'] }}</h4>
                                            <small
                                                class="text-muted" style="font-size: 15px;">
                                                {{ $landing->investment_section['items'][1]['title'] }}</small>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="mb-4">
                                                <span class="display-4 fw-bold" style="color: #002060;">S/
                                                    {{ $landing->investment_section['items'][1]['price_now'] }}</span>
                                                <span class="text-muted">/
                                                    {{ $landing->investment_section['items'][1]['price_now_text'] }}</span>
                                            </div>
                                            <ul class="list-unstyled text-start mb-4">
                                                @if (filled($landing->investment_section['items'][1]['features'] ?? null))
                                                    @foreach ($landing->investment_section['items'][1]['features'] as $feature)
                                                        <li class="mb-2"><i
                                                                class="fa fa-check text-success me-2"></i>
                                                            <b>{{ $feature }}</b></li>
                                                    @endforeach
                                                @endif
                                            </ul>

                                            <a href="{{ $landing->corporate_contact_link ?? "#pageContactForm" }}" target="_blank"
                                                class="btn btn-modern btn-modern-outline w-100">
                                                <i class="fa fa-whatsapp me-2"></i> Contactar con un Asesor
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
