@props(['landing'])

@if (filled($landing->investment_section ?? null))
    <style>
        .text-navy-custom {
            color: #002060 !important;
        }

        :is(.dark, .dark-only) .text-navy-custom {
            color: #f6f7fb !important;
        }

        .bg-badge-custom {
            background-color: rgba(0, 32, 96, 0.05) !important;
        }

        :is(.dark, .dark-only) .bg-badge-custom {
            background-color: rgba(246, 247, 251, 0.1) !important;
        }

        /* Ajuste de contraste y forma para botones outline */
        .btn-modern-outline.text-navy-custom {
            border: 1px solid #002060 !important;
            background-color: transparent !important;
            transition: all 0.3s ease;
        }

        .btn-modern-outline.text-navy-custom:hover {
            background-color: #002060 !important;
            color: #ffffff !important;
        }

        :is(.dark, .dark-only) .btn-modern-outline.text-navy-custom {
            border-color: #f6f7fb !important;
        }

        :is(.dark, .dark-only) .btn-modern-outline.text-navy-custom:hover {
            background-color: #f6f7fb !important;
            color: #002060 !important;
        }

        .bg-item-custom {
            background-color: #ffffff !important;
        }

        :is(.dark, .dark-only) .bg-item-custom {
            background-color: #1d273a !important;
            border-color: #374558 !important;
        }
    </style>

    <div class="container-fluid aos-animate mt-5" data-aos="fade-up">
        <div class="row bg-item-custom rounded-4 shadow-sm border dark:border-gray-700">
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-5">

                        <span
                            class="badge rounded-pill bg-badge-custom text-navy-custom px-3 py-2 mb-3 shadow-sm border d-inline-flex align-items-center justify-content-center gap-2"
                            style="font-size: 14px; font-weight: 600;">

                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"
                                style="
                                    width: 18px;
                                    height: 18px;
                                    fill: currentColor;
                                    flex-shrink: 0;
                                ">

                                <path
                                    d="M64 64C28.7 64 0 92.7 0 128L0 384c0 35.3 28.7 64 64 64l384 0c35.3 0 64-28.7 64-64l0-256c0-35.3-28.7-64-64-64L64 64zm192 96a96 96 0 1 1 0 192 96 96 0 1 1 0-192zm192 24c0 4.4-3.6 8.1-8 7.5-29-3.6-51.9-26.6-55.5-55.5-.5-4.4 3.1-8 7.5-8l48 0c4.4 0 8 3.6 8 8l0 48zM64 328c0-4.4 3.6-8.1 8-7.5 29 3.6 51.9 26.6 55.5 55.5 .5 4.4-3.1 8-7.5 8l-48 0c-4.4 0-8-3.6-8-8l0-48zm8-136.5c-4.4 .5-8-3.1-8-7.5l0-48c0-4.4 3.6-8 8-8l48 0c4.4 0 8.1 3.6 7.5 8-3.6 29-26.6 51.9-55.5 55.5zm368 129c4.4-.5 8 3.1 8 7.5l0 48c0 4.4-3.6 8-8 8l-48 0c-4.4 0-8.1-3.6-7.5-8 3.6-29 26.6-51.9 55.5-55.5z" />
                            </svg>

                            <span>
                                {{ $landing->investment_section['name'] }}
                            </span>

                        </span>

                        <h2 class="fw-bold display-6 text-navy-custom">
                            {{ $landing->investment_section['title'] }}
                        </h2>

                        <p class="text-gray-600 dark:text-gray-400 fs-5 mx-auto" style="max-width: 800px;">
                            {{ $landing->investment_section['description'] }}
                        </p>

                    </div>

                    <div class="row g-4 justify-content-center">
                        <!-- Plan Regular (Pronto pago)  [0] -->
                        @if (filled($landing->investment_section['items'][0] ?? null))
                            @if ($landing->investment_section['items'][0]['price_before_visible'])
                                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200"> {{-- Removed inline style for border-top --}}
                                    <div class="card h-100 border-0 shadow-lg transition-all rounded-4 overflow-hidden bg-item-custom border-t-[5px] border-warning dark:border-orange-600"
                                        style="border-top: 5px solid #f8aa4b !important;">
                                        <div class="p-4 border-bottom bg-yellow-50/50 dark:bg-yellow-900/10"
                                            style="background-color: rgba(255, 193, 7, 0.05);">
                                            <span
                                                class="badge bg-warning text-dark mb-2">{{ $landing->investment_section['items'][0]['tag'] }}</span>
                                            <h4 class="fw-bold mb-0 text-navy-custom text-[22px]">
                                                {{ $landing->investment_section['items'][0]['title'] }}
                                            </h4>
                                            <small class="text-gray-500 dark:text-gray-400 text-[15px]">La más
                                                recomendada</small>
                                        </div>
                                        <div class="card-body p-4 text-center">
                                            <div class="mb-2">
                                                @if ((float) ($landing->investment_section['items'][0]['price_now'] ?? 0) <= 0)
                                                    <span class="display-4 fw-bold text-success">Gratis</span>
                                                @else
                                                    <span class="text-navy-custom text-2xl fw-bold">S/</span>
                                                    <span class="display-4 fw-bold text-navy-custom">
                                                        {{ $landing->investment_section['items'][0]['price_now'] }}</span>
                                                    <span class="text-muted">/
                                                        {{ $landing->investment_section['items'][0]['price_now_text'] ?? '' }}</span>
                                                @endif
                                            </div>

                                            <div class="mb-4"
                                                @if ((float) ($landing->investment_section['items'][0]['price_now'] ?? 0) <= 0) style="display:none;" @endif>
                                                <del class="text-gray-600 dark:text-gray-400 fs-4 fw-semibold">S/
                                                    {{ $landing->investment_section['items'][0]['price_before'] }}</del>
                                                <span class="text-gray-600 dark:text-gray-400 small">/
                                                    {{ $landing->investment_section['items'][0]['price_before_text'] ?? '' }}</span>
                                            </div>
                                            <ul class="list-unstyled text-start mb-4">
                                                @if (filled($landing->investment_section['items'][0]['features'] ?? null))
                                                    @foreach ($landing->investment_section['items'][0]['features'] as $feature)
                                                        <li class="mb-2 text-gray-600 dark:text-gray-400"><i
                                                                class="fa-solid fa-check text-success me-2"></i>
                                                            <b>{{ $feature }}</b>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>
                                            <a href="javascript:void(0)" onclick="procederInscripcion()"
                                                class="btn btn-modern btn-modern-primary w-100 mb-3">
                                                <i class="fa fa-shopping-cart me-2"></i> Inscribirse ahora
                                            </a>
                                            <button type="button" data-bs-toggle="modal"
                                                data-bs-target="#modalFinanciamiento"
                                                class="btn btn-modern btn-modern-outline w-100 text-navy-custom d-flex align-items-center justify-content-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                    width="20" height="20" style="flex-shrink: 0;">
                                                    <path
                                                        d="M380.9 97.1c-41.9-42-97.7-65.1-157-65.1-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480 117.7 449.1c32.4 17.7 68.9 27 106.1 27l.1 0c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.6-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1s56.2 81.2 56.1 130.5c0 101.8-84.9 184.6-186.6 184.6zM325.1 300.5c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8s-14.3 18-17.6 21.8c-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7s-12.5-30.1-17.1-41.2c-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2s-9.7 1.4-14.8 6.9c-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4s4.6-24.1 3.2-26.4c-1.3-2.5-5-3.9-10.5-6.6z" />
                                                </svg>
                                                <span>Asegurar vacante y/o financiamiento</span>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @endif

                        <!-- Plan Corporativo -->
                        @if (filled($landing->investment_section['items'][1] ?? null))
                            @if ($landing->investment_section['items'][1]['price_before_visible'])
                                <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300"> {{-- Removed inline style for border-top --}}
                                    <div class="card h-100 border-0 shadow-sm transition-all rounded-4 overflow-hidden bg-item-custom text-center border dark:border-gray-700"
                                        style="border-top: 5px solid #c8c8c8 !important;">
                                        <div class="p-4 border-bottom bg-yellow-50/50 dark:bg-gray-800/50">
                                            <h4 class="fw-bold mb-0 text-navy-custom text-[22px]">
                                                {{ $landing->investment_section['items'][1]['tag'] }}</h4>
                                            <small class="text-gray-600 dark:text-gray-400 text-[15px]">
                                                {{ $landing->investment_section['items'][1]['title'] }}</small>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="mb-4">
                                                @if ((float) ($landing->investment_section['items'][1]['price_now'] ?? 0) <= 0)
                                                    <span class="display-4 fw-bold text-success">Gratis</span>
                                                @else
                                                    <span class="text-navy-custom text-2xl fw-bold">S/</span>
                                                    <span class="display-4 fw-bold text-navy-custom">
                                                        {{ $landing->investment_section['items'][1]['price_now'] }}</span>
                                                    <span class="text-muted">/
                                                        {{ $landing->investment_section['items'][1]['price_now_text'] }}</span>
                                                @endif
                                            </div>
                                            <ul class="list-unstyled text-start mb-4">
                                                @if (filled($landing->investment_section['items'][1]['features'] ?? null))
                                                    @foreach ($landing->investment_section['items'][1]['features'] as $feature)
                                                        <li class="mb-2 text-gray-600 dark:text-gray-400"><i
                                                                class="fa-solid fa-check text-success me-2"></i>
                                                            <b>{{ $feature }}</b>
                                                        </li>
                                                    @endforeach
                                                @endif
                                            </ul>

                                            <a href="{{ $landing->corporate_contact_link ?? '#pageContactForm' }}"
                                                target="_blank"
                                                class="btn btn-modern btn-modern-outline w-100 text-navy-custom d-flex align-items-center justify-content-center gap-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                                    width="20" height="20" style="flex-shrink: 0;">
                                                    <path
                                                        d="M380.9 97.1c-41.9-42-97.7-65.1-157-65.1-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480 117.7 449.1c32.4 17.7 68.9 27 106.1 27l.1 0c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.6-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1s56.2 81.2 56.1 130.5c0 101.8-84.9 184.6-186.6 184.6zM325.1 300.5c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8s-14.3 18-17.6 21.8c-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7s-12.5-30.1-17.1-41.2c-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2s-9.7 1.4-14.8 6.9c-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4s4.6-24.1 3.2-26.4c-1.3-2.5-5-3.9-10.5-6.6z" />
                                                </svg>
                                                <span>Contactar con un Asesor</span>
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
<div class="modal fade" id="modalFinanciamiento" tabindex="-1" aria-labelledby="modalFinanciamientoLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg"> {{-- Removed inline style for border-radius --}}
        <div class="modal-content border-0 shadow-lg rounded-4 bg-item-custom">
            <div class="modal-header border-0 p-4 pb-0">
                <button type="button" class="btn-close dark:btn-close-white" data-bs-dismiss="modal"
                    aria-label="Close"></button>
            </div>
            <div class="modal-body p-4 p-lg-5 pt-0">
                <div class="text-center mb-4">
                    <svg xmlns="http://www.w3.org/2000/svg"
                        viewBox="0 0 448 512"><!--!Font Awesome Free v7.2.0 by @fontawesome - https://fontawesome.com License - https://fontawesome.com/license/free Copyright 2026 Fonticons, Inc.-->
                        <path
                            d="M380.9 97.1c-41.9-42-97.7-65.1-157-65.1-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480 117.7 449.1c32.4 17.7 68.9 27 106.1 27l.1 0c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.6-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1s56.2 81.2 56.1 130.5c0 101.8-84.9 184.6-186.6 184.6zM325.1 300.5c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8s-14.3 18-17.6 21.8c-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7s-12.5-30.1-17.1-41.2c-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2s-9.7 1.4-14.8 6.9c-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4s4.6-24.1 3.2-26.4c-1.3-2.5-5-3.9-10.5-6.6z" />
                    </svg>
                    <h2 class="fw-bold text-navy-custom text-[24px]">Asegurar vacante y/o financiamiento</h2>
                    <p class="text-muted dark:text-gray-400">Déjanos tus datos para que un asesor te ayude con el
                        proceso de inscripción y opciones de pago.</p>
                </div>
                <form id="modalContactForm">
                    @csrf
                    <input type="hidden" name="subject" value="{{ $landing->course->description ?? 'Curso' }}">
                    <input type="hidden" name="message" value="Desde Landing - Modal Financiamiento">

                    <div class="mb-3">
                        <label class="form-label fw-bold text-navy-custom">Nombres y Apellidos</label>
                        <div class="input-group shadow-sm">
                            <span
                                class="input-group-text bg-gray-50 dark:bg-gray-700 border-end-0 text-muted dark:text-gray-400"><i
                                    class="fa-solid fa-user"></i></span>
                            <input type="text" name="full_name"
                                class="form-control border-start-0 ps-0 dark:bg-gray-700 dark:text-white dark:border-gray-600 bg-white"
                                placeholder="Nombre completo" required>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label class="form-label fw-bold text-navy-custom">País</label>
                        <div class="input-group shadow-sm">
                            <span class="input-group-text bg-white dark:bg-gray-700 border-end-0"><i
                                    class="fa fa-flag text-muted"></i></span>
                            <select name="country_phone" id="modalCountryPhoneSelect"
                                class="form-select border-start-0 ps-0 dark:bg-gray-700 dark:text-white dark:border-gray-600 bg-white"
                                required>
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
                            <label class="form-label fw-bold text-navy-custom">WhatsApp</label>
                            <div class="input-group shadow-sm">
                                <span
                                    class="input-group-text bg-gray-50 dark:bg-gray-700 border-end-0 text-gray-600 dark:text-gray-400">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                        style="width: 16px; height: 16px;" fill="currentColor" class="opacity-75">
                                        <path
                                            d="M380.9 97.1c-41.9-42-97.7-65.1-157-65.1-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480 117.7 449.1c32.4 17.7 68.9 27 106.1 27l.1 0c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.6-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1s56.2 81.2 56.1 130.5c0 101.8-84.9 184.6-186.6 184.6zM325.1 300.5c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8s-14.3 18-17.6 21.8c-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7s-12.5-30.1-17.1-41.2c-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2s-9.7 1.4-14.8 6.9c-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4s4.6-24.1 3.2-26.4c-1.3-2.5-5-3.9-10.5-6.6z" />
                                    </svg>
                                </span>
                                <input type="text" name="phone"
                                    class="form-control border-start-0 ps-0 dark:bg-gray-700 dark:text-white dark:border-gray-600 bg-white"
                                    placeholder="999 888 777" required>
                            </div>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold text-navy-custom">Correo Electrónico</label>
                            <div class="input-group shadow-sm">
                                <span
                                    class="input-group-text bg-gray-50 dark:bg-gray-700 border-end-0 text-muted dark:text-gray-400"><i
                                        class="fa-solid fa-envelope"></i></span>
                                <input type="email" name="email"
                                    class="form-control border-start-0 ps-0 dark:bg-gray-700 dark:text-white dark:border-gray-600 bg-white"
                                    placeholder="ejemplo@correo.com" required>
                            </div>
                        </div>
                    </div>
                    <button type="submit" id="submitModalContactButton"
                        class="btn btn-warning btn-lg w-100 fw-bold shadow-sm py-3 mt-2 text-[#002060] rounded-xl">
                        Conocer beneficios y asegurar mi vacante
                    </button>
                    <div id="messageModalContact" class="mt-3"></div>
                </form>
            </div>
        </div>
    </div>
</div>
