<div>
    
    <section style="padding: 60px 0px;">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-3 pe-0">
                    </div>
                    <div class="col-sm-6 ps-0">
                        <h1 class="ara_title">Aprende de quienes lideran en las firmas más reconocidas</h1>
                    </div>
                    <div class="col-sm-3 pe-0">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10">
                    <div class="slider-container">
                        <div class="team-slider">
                            @foreach ($teachers as $k => $teacher)
                                <div class="card team-member" style="cursor: pointer; padding: 10px 5px; text-align: center; width: 320px;" data-bs-toggle="modal"
                                    data-bs-target="#staticBackdrop{{ str_replace(' ', '', $teacher->item->items[0]->content) }}">
                                    <img src="{{ asset('storage/' . $teacher->item->items[3]->content) }}"
                                        alt="photo">
                                        <div class="card-header pb-0">
                                    <h3>{{ $teacher->item->items[0]->content }}</h3>
                                </div>
                                    <p>{{ $teacher->item->items[1]->content }}</p>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section>

    @foreach ($teachers as $k => $teacher)
        <div class="modal fade" id="staticBackdrop{{ str_replace(' ', '', $teacher->item->items[0]->content) }}"
            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Nuestros Docentes</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <img src="{{ asset('storage/' . $teacher->item->items[3]->content) }}" alt="">
                        <h3>{{ $teacher->item->items[0]->content }}</h3>
                        <p>{{ $teacher->item->items[1]->content }}</p>
                        <p>
                            {{ $teacher->item->items[2]->content }}
                        </p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <style>
        .slider-container {
            width: 100%;
            overflow: hidden;
            /* Oculta el contenido que se desborda del contenedor */
            position: relative;
            padding: 20px 0;
        }

        .team-slider {
            display: flex;
            gap: 20px;
            animation: slide-animation 10s linear infinite;
            /* Animación de desplazamiento infinito */

        }

        /* Detener la animación al pasar el ratón */
        .team-slider:hover {
            animation-play-state: paused;
        }

        .team-member {
            flex: 0 0 250px;
            /* Tamaño fijo para cada tarjeta */
            
            border-radius: 10px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            text-align: center;
            padding: 20px;
            transition: transform 0.3s ease-in-out;

            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center
        }

        .team-member:hover {
            transform: translateY(-10px);
            /* Efecto de elevación al pasar el ratón */
        }

        .team-member img {
            width: 150px;
            height: 150px;
            border-radius: 50%;
            /* Imágenes circulares */
            object-fit: cover;
            margin-bottom: 15px;
            border: 4px solid #f0f2f5;
        }

        .team-member h3 {
            margin: 0 0 5px;
            color: #333;
            font-size: 1.2em;
        }

        .team-member p {
            margin: 0;
            color: #777;
            font-size: 0.9em;
        }

        /* Animación de desplazamiento */
        @keyframes slide-animation {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(-50%);
                /* Desplaza el 50% para que se repita el bucle */
            }
        }

        /* Media Queries para la adaptabilidad */
        @media (max-width: 768px) {
            .team-slider {
                animation: slide-animation-tablet 10s linear infinite;
            }

            @keyframes slide-animation-tablet {
                0% {
                    transform: translateX(0);
                }

                100% {
                    transform: translateX(calc(-100% / 2));
                    /* Ajuste para mostrar menos elementos */
                }
            }

            .team-member {
                flex: 0 0 calc(50% - 10px);
                /* 2 tarjetas por fila en tablet */
            }
        }

        @media (max-width: 480px) {
            .team-slider {
                animation: slide-animation-mobile 8s linear infinite;
            }

            @keyframes slide-animation-mobile {
                0% {
                    transform: translateX(0);
                }

                100% {
                    transform: translateX(calc(-100% / 1));
                    /* Ajuste para mostrar 1 elemento */
                }
            }

            .team-member {
                flex: 0 0 100%;
                /* 1 tarjeta por fila en móvil */
            }
        }
    </style>

</div>

<hr>
<div class="container my-5">
    <div class="row">
        <div class="col text-center">
            <h2>Propuesta de Diseño Moderno</h2>
            <p>A continuación se presenta una versión modernizada del componente de docentes para comparación.</p>
        </div>
    </div>
</div>
<hr>

<!-- Propuesta de Diseño Moderno -->
<style>
    .teachers-section-modern {
        padding: 80px 0;
        background-color: #ffffff;
        overflow: hidden;
    }

    .teachers-title-modern {
        font-size: 2.5rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 3rem;
        text-align: center;
    }

    .modern-slider-container {
        width: 100%;
        overflow: hidden;
        position: relative;
        padding: 20px 0;
    }

    .modern-team-slider {
        display: flex;
        gap: 30px;
        animation: modern-slide 30s linear infinite;
        width: max-content;
    }

    .modern-team-slider:hover {
        animation-play-state: paused;
    }

    @keyframes modern-slide {
        0% { transform: translateX(0); }
        100% { transform: translateX(-50%); }
    }

    .teacher-card-modern {
        width: 300px;
        background: #fff;
        border-radius: 20px;
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.05);
        padding: 30px 20px;
        text-align: center;
        transition: all 0.3s ease;
        border: 1px solid #f0f0f0;
        cursor: pointer;
        flex-shrink: 0;
    }

    .teacher-card-modern:hover {
        transform: translateY(-10px);
        box-shadow: 0 20px 40px rgba(0, 0, 0, 0.1);
        border-color: transparent;
    }

    .teacher-img-wrapper {
        width: 120px;
        height: 120px;
        margin: 0 auto 20px;
        position: relative;
    }

    .teacher-img-modern {
        width: 100%;
        height: 100%;
        border-radius: 50%;
        object-fit: cover;
        border: 3px solid #fff;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .teacher-name-modern {
        font-size: 1.25rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 8px;
    }

    .teacher-role-modern {
        font-size: 0.9rem;
        color: #e30613;
        font-weight: 600;
        margin-bottom: 0;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .modal-modern-header {
        border-bottom: none;
        padding-bottom: 0;
    }

    .modal-modern-body {
        text-align: center;
        padding: 2rem;
    }

    .modal-modern-img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        object-fit: cover;
        margin-bottom: 1.5rem;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
    }
</style>

<section class="teachers-section-modern">
    <div class="container">
        <h2 class="teachers-title-modern">Aprende de quienes lideran en las firmas más reconocidas</h2>

        <div class="modern-slider-container">
            <div class="modern-team-slider">
                {{-- Duplicamos el loop para asegurar que el efecto infinito (translateX -50%) funcione visualmente lleno --}}
                @for ($i = 0; $i < 2; $i++)
                    @foreach ($teachers as $k => $teacher)
                        <div class="teacher-card-modern" data-bs-toggle="modal" data-bs-target="#modalModern{{ $k }}">
                            <div class="teacher-img-wrapper">
                                <img src="{{ asset('storage/' . $teacher->item->items[3]->content) }}"
                                     alt="{{ $teacher->item->items[0]->content }}" class="teacher-img-modern">
                            </div>
                            <h3 class="teacher-name-modern">{{ $teacher->item->items[0]->content }}</h3>
                            <p class="teacher-role-modern">{{ $teacher->item->items[1]->content }}</p>
                        </div>
                    @endforeach
                @endfor
            </div>
        </div>
    </div>
</section>

<!-- Modals for Modern Version -->
@foreach ($teachers as $k => $teacher)
    <div class="modal fade" id="modalModern{{ $k }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 15px; border: none;">
                <div class="modal-header modal-modern-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body modal-modern-body">
                    <img src="{{ asset('storage/' . $teacher->item->items[3]->content) }}" alt="" class="modal-modern-img">
                    <h3 class="teacher-name-modern">{{ $teacher->item->items[0]->content }}</h3>
                    <p class="teacher-role-modern mb-3">{{ $teacher->item->items[1]->content }}</p>
                    <p class="text-muted">
                        {{ $teacher->item->items[2]->content }}
                    </p>
                </div>
            </div>
        </div>
    </div>
@endforeach

<hr class="my-5">
<div class="container">
    <div class="row">
        <div class="col text-center">
            <h2>Propuesta de Diseño Moderno - Opción 2</h2>
            <p>Diseño en cuadrícula (Grid) con tarjetas elegantes y modal detallado.</p>
        </div>
    </div>
</div>
<hr>

<!-- Propuesta de Diseño Moderno Opción 2 -->
<style>
    .teachers-section-opt2 {
        padding: 80px 0;
        background-color: #f8f9fa;
    }
    .teacher-card-opt2 {
        background: #fff;
        border-radius: 12px;
        overflow: hidden;
        box-shadow: 0 6px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
        border: none;
        cursor: pointer;
        position: relative;
        top: 0;
    }
    .teacher-card-opt2:hover {
        top: -10px;
        box-shadow: 0 15px 30px rgba(0,0,0,0.1);
    }
    .teacher-img-opt2-wrapper {
        height: 300px; /* Altura fija para uniformidad */
        overflow: hidden;
        position: relative;
    }
    .teacher-img-opt2 {
        width: 100%;
        height: 100%;
        object-fit: cover;
        object-position: top center;
        transition: transform 0.5s ease;
    }
    .teacher-card-opt2:hover .teacher-img-opt2 {
        transform: scale(1.05);
    }
    .teacher-content-opt2 {
        padding: 25px;
        text-align: center;
        position: relative;
    }
    .teacher-name-opt2 {
        font-size: 1.2rem;
        font-weight: 700;
        color: #2c3e50;
        margin-bottom: 5px;
    }
    .teacher-role-opt2 {
        font-size: 0.9rem;
        color: #e30613;
        font-weight: 600;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-bottom: 15px;
    }
    .teacher-divider {
        width: 40px;
        height: 3px;
        background: #e30613;
        margin: 0 auto;
        border-radius: 2px;
    }
</style>

<section class="teachers-section-opt2">
    <div class="container">
        <div class="row g-4 justify-content-center">
            @foreach ($teachers as $k => $teacher)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="teacher-card-opt2" data-bs-toggle="modal" data-bs-target="#modalOpt2{{ $k }}">
                        <div class="teacher-img-opt2-wrapper">
                            <img src="{{ asset('storage/' . $teacher->item->items[3]->content) }}" 
                                 alt="{{ $teacher->item->items[0]->content }}" 
                                 class="teacher-img-opt2">
                        </div>
                        <div class="teacher-content-opt2">
                            <h4 class="teacher-name-opt2">{{ $teacher->item->items[0]->content }}</h4>
                            <p class="teacher-role-opt2">{{ $teacher->item->items[1]->content }}</p>
                            <div class="teacher-divider"></div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>

<!-- Modals Opción 2 -->
@foreach ($teachers as $k => $teacher)
    <div class="modal fade" id="modalOpt2{{ $k }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                <div class="row g-0">
                    <div class="col-md-5 d-none d-md-block" style="background-image: url('{{ asset('storage/' . $teacher->item->items[3]->content) }}'); background-size: cover; background-position: center;">
                    </div>
                    <div class="col-md-7">
                        <div class="modal-header border-0 pb-0">
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body p-4 p-lg-5">
                            <h3 class="fw-bold text-dark mb-1">{{ $teacher->item->items[0]->content }}</h3>
                            <p class="text-danger fw-bold text-uppercase mb-4">{{ $teacher->item->items[1]->content }}</p>
                            <p class="text-muted" style="line-height: 1.8;">
                                {{ $teacher->item->items[2]->content }}
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endforeach
