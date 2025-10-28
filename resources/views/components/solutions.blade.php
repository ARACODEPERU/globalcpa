<div>
    <section style="padding: 60px 0px; background: #575756;">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-8">
                    <h1 class="ara_title_white">
                        Soluciones de formación y consultoría que transforman tu equipo en líderes estratégicos
                    </h1>
                </div>
                <div class="col-md-2"></div>
            </div>
            <br>
            <div class="row">
                <div class="col-md-2"></div>
                <div class="col-md-3">
                    <img style="width: 100%;" src="{{ asset('themes/webpage/images/soluciones-equipo.jpg') }}" alt="">
                </div>
                <div class="col-md-5">
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="padding: 20px; display: flex; flex-direction: column;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img style="width: 60px;"
                                            src="themes/webpage/images/capacitacion.png" alt="">
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            <b style="color: #e30613">Formación con estándares globales</b> para contadores, financieros y
                                            auditores.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card" style="padding: 20px; display: flex; flex-direction: column;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img style="width: 60px; text-align:center;"
                                            src="themes/webpage/images/capacitacion.png" alt="">
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            <b style="color: #e30613">Suscripciones de formación y asesoría especializada,</b> flexibles y
                                            escalables.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card" style="padding: 20px; display: flex; flex-direction: column;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img style="width: 60px; text-align:center;"
                                            src="themes/webpage/images/capacitacion.png" alt="">
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            <b style="color: #e30613">Preparación oficial para certificaciones ACCA –</b> somos la única
                                            escuela en
                                            Perú con el sello Approved Learning Partner.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="card" style="padding: 20px; display: flex; flex-direction: column;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <img style="width: 60px; text-align:center;"
                                            src="themes/webpage/images/capacitacion.png" alt="">
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            <b style="color: #e30613">Capacitación in company</b> diseñada a medida para tu equipo.
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2"></div>
            </div>
        </div>
    </section>


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
