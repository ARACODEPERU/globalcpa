@props(['landing'])

@if (filled($landing->testimonials_section ?? null))
    <div class="container-fluid card aos-animate mt-5" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <!-- Header de Sección -->
                    <div class="text-center mb-4">
                        <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                            style="background-color: rgba(0, 123, 255, 0.05); color: #007bff; font-size: 14px; font-weight: 600;">
                            <i class="fa fa-quote-right me-1"></i>
                            {{ $landing->testimonials_section['name'] }}
                        </span>
                        <h2 class="fw-bold display-6" style="color: #002060;">
                            {{ $landing->testimonials_section['title'] }}</h2>
                        <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">
                            {{ $landing->testimonials_section['description'] }}
                        </p>
                    </div>

                    <style>
                        .testimonial-carousel-viewport {
                            overflow: hidden;
                            padding: 20px 0;
                            /* Espacio para sombras */
                            position: relative;
                            width: 100%;
                        }

                        .testimonial-carousel-track {
                            display: flex;
                            gap: 30px;
                            width: max-content;
                            animation: scroll-infinite-testimonials 60s linear infinite;
                            /* Velocidad ajustada */
                        }

                        .testimonial-carousel-track:hover {
                            animation-play-state: paused;
                        }

                        @keyframes scroll-infinite-testimonials {
                            0% {
                                transform: translateX(0);
                            }

                            50% {
                                transform: translateX(-50%);
                            }
                        }

                        .testimonial-card {
                            width: 350px;
                            /* Ancho fijo para las tarjetas de testimonio */
                            flex-shrink: 0;
                            background: #fff;
                            border-radius: 15px;
                            padding: 30px;
                            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
                            transition: all 0.3s ease;
                            display: flex;
                            flex-direction: column;
                            justify-content: space-between;
                            min-height: 250px;
                            /* Altura mínima para uniformidad */
                        }

                        .testimonial-card:hover {
                            transform: translateY(-8px);
                            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.12);
                        }

                        .testimonial-quote {
                            font-size: 1.1rem;
                            line-height: 1.6;
                            color: #343a40;
                            margin-bottom: 20px;
                            font-style: italic;
                        }

                        .testimonial-author-info {
                            display: flex;
                            align-items: center;
                            margin-top: auto;
                            /* Empuja la info del autor hacia abajo */
                        }

                        .testimonial-avatar {
                            width: 60px;
                            height: 60px;
                            border-radius: 50%;
                            object-fit: cover;
                            margin-right: 15px;
                            border: 3px solid #007bff;
                        }

                        .testimonial-name {
                            font-weight: 700;
                            color: #002060;
                            font-size: 1rem;
                        }

                        .testimonial-title {
                            font-size: 0.85rem;
                            color: #6c757d;
                        }
                    </style>

                    <div class="testimonial-carousel-viewport">
                        <div class="testimonial-carousel-track">
                            @if (filled($landing->testimonials_section['items'] ?? null))
                                @php
                                    $testimonials = $landing->testimonials_section['items'];
                                @endphp
                                @foreach (array_merge($testimonials, $testimonials) as $testimonial)
                                    <div class="testimonial-carousel-item">
                                        <div class="testimonial-card mx-2">
                                            <p class="testimonial-quote">
                                                "{{ $testimonial['description'] ?? '' }}"</p>
                                            <div class="testimonial-author-info">
                                                @if (isset($testimonial['image']) && !empty($testimonial['image']))
                                                    <img src="{{ asset('storage/' . $testimonial['image']) }}"
                                                        alt="{{ $testimonial['name'] ?? 'Usuario' }}"
                                                        class="testimonial-avatar">
                                                @endif
                                                <div>
                                                    <h5 class="testimonial-name" style="font-size: 20px;">
                                                        {{ $testimonial['name'] ?? '' }}</h5>
                                                    <p class="testimonial-title" style="font-size: 15px;">
                                                        {{ $testimonial['presentation'] ?? '' }}</p>
                                                </div>
                                            </div>
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
@endif