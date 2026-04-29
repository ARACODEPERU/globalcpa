@props(['landing'])

@if (filled($landing->faq_section ?? null))
    <div class="container-fluid card aos-animate mt-5" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <div class="text-center mb-5">
                        <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                            style="background-color: rgba(111, 66, 193, 0.1); color: #6f42c1; font-size: 14px; font-weight: 600;">
                            <i class="fa fa-magic me-1"></i> {{ $landing->faq_section['name'] }}
                        </span>
                        <h2 class="fw-bold display-6" style="color: #002060; font-size: 28px;">
                            {{ $landing->faq_section['title'] }}</h2>
                        <p class="text-muted fs-5 mx-auto" style="max-width: 700px; font-size: 16px; line-height: 1.7;">
                            {{ $landing->faq_section['description'] }}
                        </p>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-lg-10">
                            <div class="faq-manual" id="faqManual">
                                @if (filled($landing->faq_section['items'] ?? null))
                                    @foreach ($landing->faq_section['items'] as $faq)
                                        @if ($faq['visible'])
                                            <div class="faq-item-card shadow-sm mb-3"
                                                style="border: 1px solid #edf2f7; border-radius: 15px; overflow: hidden;"
                                                onmouseenter="toggleFaq({{ $loop->index }})"
                                                onmouseleave="toggleFaq({{ $loop->index }})">
                                                <div class="faq-question p-3"
                                                    style="cursor: pointer; background: #fff; color: #002060; font-weight: 600; display: flex; justify-content: space-between; align-items: center;">
                                                    <span>{{ $faq['question'] }}</span>
                                                    <i id="faq-icon-{{ $loop->index }}"
                                                        class="fa fa-chevron-down"
                                                        style="transition: transform 0.3s;"></i>
                                                </div>
                                                <div id="faq-answer-{{ $loop->index }}"
                                                    class="faq-answer p-3"
                                                    style="display: none; color: #334155; line-height: 1.7; font-size: 0.95rem; background: #f8f9fa;">
                                                    {!! $faq['answer'] !!}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif
                            </div>

                            <div class="text-center mt-5 p-4 rounded-4"
                                style="background-color: #f8f9fa; border: 1px dashed #dee2e6;">
                                <p class="mb-3 fw-bold" style="color: #002060; font-size: 20px;">¿Aún tienes dudas
                                    específicas?</p>
                                <a href="{{ $landing->whatsapp_link }}"
                                    class="btn rounded-pill px-4 shadow-sm d-inline-flex align-items-center transition-all hover:scale-105"
                                    style="background-color: #25D366; color: white; border: none; font-weight: 600; padding: 12px 30px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"
                                        style="width: 18px; height: 18px; fill: white;" class="me-2">
                                        <path
                                            d="M380.9 97.1c-41.9-42-97.7-65.1-157-65.1-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480 117.7 449.1c32.4 17.7 68.9 27 106.1 27l.1 0c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.6-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1s56.2 81.2 56.1 130.5c0 101.8-84.9 184.6-186.6 184.6zM325.1 300.5c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8s-14.3 18-17.6 21.8c-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7s-12.5-30.1-17.1-41.2c-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2s-9.7 1.4-14.8 6.9c-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4s4.6-24.1 3.2-26.4c-1.3-2.5-5-3.9-10.5-6.6z" />
                                    </svg>
                                    Hablar con un Asesor
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif