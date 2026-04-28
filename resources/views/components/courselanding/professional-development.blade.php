@props(['landing'])

<div class="container-fluid card aos-animate" data-aos="fade-up">
    <div class="row">
        @if (filled($landing->professional_section ?? null))
            <div class="col-md-6">
                <div class="card-body p-4 p-lg-5">
                    <div class="mb-4">
                        <span class="badge rounded-pill bg-light text-primary px-3 py-2 mb-3 shadow-sm border"
                            style="color: #002060 !important;">
                            <i class="fa fa-refresh me-1"></i> {{ $landing->professional_section['name'] }}
                        </span>
                        <h2 class="fw-bold display-6" style="color: #002060;">
                            {{ $landing->professional_section['title'] }}
                        </h2>
                        <p class="text-muted fs-5">
                            {{ $landing->professional_section['description'] }}
                        </p>
                    </div>

                    <div class="row g-4 mt-2">
                        @if ($landing->professional_section['items'][0] ?? null)
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 bg-warning-light p-3 rounded-circle me-3"
                                        style="background-color: rgba(255, 193, 7, 0.1);">
                                        <i class="fa {{ $landing->professional_section['items'][0]['icon'] }} text-warning fs-4"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-0 fw-bold" style="color: #002060; font-size: 18px;">
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
                            <div class="col-sm-6">
                                <div class="d-flex align-items-center">
                                    <div class="flex-shrink-0 bg-info-light p-3 rounded-circle me-3"
                                        style="background-color: rgba(0, 204, 255, 0.1);">
                                        <i class="fa {{ $landing->professional_section['items'][1]['icon'] }} text-info fs-4"></i>
                                    </div>
                                    <div>
                                        <h4 class="mb-0 fw-bold" style="color: #002060; font-size: 18px;">
                                            {{ $landing->professional_section['items'][1]['title'] }}
                                        </h4>
                                        <p style="font-size: 15px;">
                                            {{ $landing->professional_section['items'][1]['description'] }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        @endif
        <div class="col-md-6">
            <div class="card-body p-4 p-lg-5">
                <div class="mb-4">
                    <h2 class="fw-bold" style="color: #002060; font-size: 20px;">¿Listo para empezar?</h2>
                    <p class="text-muted" style="font-size: 15px;">
                        Completa tus datos para descargar el brochure detallado y recibir
                        información sobre promociones exclusivas del programa.
                    </p>
                </div>

                <form id="pageContactForm">
                    @csrf
                    <input type="hidden" name="subject" value="{{ $landing->course->description ?? 'Curso' }}">
                    <input type="hidden" name="message" value="desde Landing - Descargué Brochure">

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #002060; font-size: 15px;">Nombres y Apellidos</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fa fa-user text-muted"></i>
                            </span>
                            <input type="text" name="full_name" class="form-control border-start-0 ps-0" placeholder="Ingresa tu nombre completo" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold" style="color: #002060; font-size: 15px;">País</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-white border-end-0">
                                <i class="fa fa-flag text-muted"></i>
                            </span>
                            <select name="country_phone" id="countryPhoneSelect" class="form-select border-start-0 ps-0" required>
                                <optgroup label="América del Sur">
                                    <option value="+51" data-code="pe" selected>Perú (+51)</option>
                                    <option value="+54" data-code="ar">Argentina (+54)</option>
                                    <option value="+591" data-code="bo">Bolivia (+591)</option>
                                    <option value="+55" data-code="br">Brasil (+55)</option>
                                    <option value="+56" data-code="cl">Chile (+56)</option>
                                    <option value="+57" data-code="co">Colombia (+57)</option>
                                    <option value="+593" data-code="ec">Ecuador (+593)</option>
                                    <option value="+592" data-code="gy">Guyana (+592)</option>
                                    <option value="+595" data-code="py">Paraguay (+595)</option>
                                    <option value="+597" data-code="sr">Surinam (+597)</option>
                                    <option value="+598" data-code="uy">Uruguay (+598)</option>
                                    <option value="+58" data-code="ve">Venezuela (+58)</option>
                                </optgroup>
                                <optgroup label="Norte y Centroamérica">
                                    <option value="+1" data-code="us">Estados Unidos (+1)</option>
                                    <option value="+1" data-code="ca">Canadá (+1)</option>
                                    <option value="+52" data-code="mx">México (+52)</option>
                                    <option value="+502" data-code="gt">Guatemala (+502)</option>
                                    <option value="+503" data-code="sv">El Salvador (+503)</option>
                                    <option value="+504" data-code="hn">Honduras (+504)</option>
                                    <option value="+505" data-code="ni">Nicaragua (+505)</option>
                                    <option value="+506" data-code="cr">Costa Rica (+506)</option>
                                    <option value="+507" data-code="pa">Panamá (+507)</option>
                                    <option value="+53" data-code="cu">Cuba (+53)</option>
                                    <option value="+1" data-code="do">República Dominicana (+1)</option>
                                    <option value="+1" data-code="pr">Puerto Rico (+1)</option>
                                </optgroup>
                            </select>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold" style="color: #002060; font-size: 15px;">WhatsApp</label>
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
                            <label class="form-label fw-bold" style="color: #002060; font-size: 15px;">Correo Electrónico</label>
                            <div class="input-group shadow-sm">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fa fa-envelope text-muted"></i>
                                </span>
                                <input type="email" name="email" class="form-control border-start-0 ps-0" placeholder="ejemplo@correo.com" required>
                            </div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <p>
                            Confirmo mi interés y quedo atento(a) al contacto para avanzar profesionalmente.
                        </p>
                    </div>
                    <div class="mt-1">
                        <button type="submit" id="submitPageContactButton" class="btn btn-warning btn-lg w-100 fw-bold shadow-sm py-3" style="color: #002060; border-radius: 12px;">
                            <i class="fa fa-file-pdf-o me-2"></i> CONOCER BENEFICIOS Y ASEGURAR MI VACANTE
                        </button>
                    </div>
                    <div id="messagePageContact" class="mt-3"></div>
                </form>
            </div>
        </div>
    </div>
</div>