@props(['landing'])

@if (filled($landing->investment_section ?? null))
    <div class="container-fluid card aos-animate mt-5" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-5">
                        <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                            style="background-color: rgba(255, 193, 7, 0.1); color: #002060; font-size: 14px; font-weight: 600;">
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
                                        style="border-top: 5px solid #f8aa4b !important;">
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
                                            <button type="button" data-bs-toggle="modal" data-bs-target="#modalFinanciamiento"
                                                class="btn btn-modern btn-modern-outline w-100">
                                                <i class="fa fa-whatsapp me-2"></i> Asegurar vacante y/o financiamiento
                                            </button>
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

                {{-- Modal de Financiamiento --}}
                <div class="modal fade" id="modalFinanciamiento" tabindex="-1" aria-labelledby="modalFinanciamientoLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                            <div class="modal-header border-0 p-4 pb-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4 p-lg-5 pt-0">
                                <div class="text-center mb-4">
                                    <h2 class="fw-bold" style="color: #002060; font-size: 24px;">Asegurar vacante y/o financiamiento</h2>
                                    <p class="text-muted">Déjanos tus datos para que un asesor te ayude con el proceso de inscripción y opciones de pago.</p>
                                </div>
                                <form id="modalContactForm">
                                    @csrf
                                    <input type="hidden" name="subject" value="{{ $landing->course->description ?? 'Curso' }}">
                                    <input type="hidden" name="message" value="Desde Landing - Modal Financiamiento">
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" style="color: #002060;">Nombres y Apellidos</label>
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-white border-end-0"><i class="fa fa-user text-muted"></i></span>
                                            <input type="text" name="full_name" class="form-control border-start-0 ps-0" placeholder="Nombre completo" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold" style="color: #002060;">País</label>
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-white border-end-0"><i class="fa fa-flag text-muted"></i></span>
                                            <select name="country_phone" id="modalCountryPhoneSelect" class="form-select border-start-0 ps-0" required>
                                                <option value="+51" data-code="pe" selected>Perú (+51)</option>
                                                <option value="+54" data-code="ar">Argentina (+54)</option>
                                                <option value="+591" data-code="bo">Bolivia (+591)</option>
                                                <option value="+56" data-code="cl">Chile (+56)</option>
                                                <option value="+57" data-code="co">Colombia (+57)</option>
                                                <option value="+593" data-code="ec">Ecuador (+593)</option>
                                                <option value="+52" data-code="mx">México (+52)</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold" style="color: #002060;">WhatsApp</label>
                                            <div class="input-group shadow-sm">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width: 16px; height: 16px; fill: #6c757d;">
                                                        <path d="M380.9 97.1c-41.9-42-97.7-65.1-157-65.1-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480 117.7 449.1c32.4 17.7 68.9 27 106.1 27l.1 0c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.6-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1s56.2 81.2 56.1 130.5c0 101.8-84.9 184.6-186.6 184.6zM325.1 300.5c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8s-14.3 18-17.6 21.8c-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7s-12.5-30.1-17.1-41.2c-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2s-9.7 1.4-14.8 6.9c-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4s4.6-24.1 3.2-26.4c-1.3-2.5-5-3.9-10.5-6.6z"/>
                                                    </svg>
                                                </span>
                                                <input type="text" name="phone" class="form-control border-start-0 ps-0" placeholder="999 888 777" required>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold" style="color: #002060;">Correo Electrónico</label>
                                            <div class="input-group shadow-sm">
                                                <span class="input-group-text bg-white border-end-0"><i class="fa fa-envelope text-muted"></i></span>
                                                <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="ejemplo@correo.com" required>
                                            </div>
                                        </div>
                                    </div>
                                    <button type="submit" id="submitModalContactButton" class="btn btn-warning btn-lg w-100 fw-bold shadow-sm py-3 mt-2" style="color: #002060; border-radius: 12px;">
                                        Conocer beneficios y asegurar mi vacante
                                    </button>
                                    <div id="messageModalContact" class="mt-3"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>