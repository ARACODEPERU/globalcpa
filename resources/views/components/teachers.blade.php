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
                                <div class="card" style="cursor: pointer; padding: 10px 5px; text-align: center; width: 320px;" data-bs-toggle="modal"
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
            background-color: #ffffff;
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
