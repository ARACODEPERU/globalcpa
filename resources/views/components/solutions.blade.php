<div>
    {{-- <section style="padding: 60px 0px; background: #575756;">
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
                    <img style="width: 100%;" src="{{ asset('themes/webpage/images/soluciones-equipo.jpg') }}"
                        alt="">
                </div>
                <div class="col-md-5">
                    <br><br>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card" style="padding: 20px; display: flex; flex-direction: column;">
                                <div class="row">
                                    <div class="col-md-2">
                                        <i class="fa fa-globe" aria-hidden="true" style="font-size: 60px;"></i>
                                        
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            <b style="color: #e30613">Formación con estándares globales</b> para
                                            contadores, financieros y
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
                                            src="themes/webpage/images/suscripcion.png" alt="">
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            <b style="color: #e30613">Suscripciones de formación y asesoría
                                                especializada,</b> flexibles y
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
                                        <i class="fa fa-handshake-o" aria-hidden="true" style="font-size: 60px;"></i>
                                    </div>
                                    <div class="col-md-10">
                                        <p>
                                            <b style="color: #e30613">Preparación oficial para certificaciones ACCA
                                                –</b> somos la única
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
                                            <b style="color: #e30613">Capacitación in company</b> diseñada a medida para
                                            tu equipo.
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
    </section> --}}

    
<!-- Propuesta de Diseño Moderno -->
<style>
    .solutions-modern-section {
        background-color: #2c3e50;
        padding: 100px 0;
        color: #ffffff;
        overflow: hidden;
        position: relative;
    }

    /* Decoración de fondo */
    .solutions-modern-section::before {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: 600px;
        height: 600px;
        background: radial-gradient(circle, rgba(227, 6, 19, 0.15) 0%, rgba(44, 62, 80, 0) 70%);
        z-index: 0;
        pointer-events: none;
    }

    .solutions-modern-title {
        font-size: 2.5rem;
        font-weight: 800;
        color: #ffffff;
        margin-bottom: 1rem;
        text-transform: uppercase;
        position: relative;
        z-index: 1;
        letter-spacing: -1px;
    }

    .solutions-modern-subtitle {
        font-size: 1.1rem;
        color: #bdc3c7;
        max-width: 700px;
        margin: 0 auto 5rem auto;
        position: relative;
        z-index: 1;
    }

    .solutions-center-image {
        position: relative;
        z-index: 2;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .solutions-center-image img {
        width: 100%;
        max-width: 400px;
        height: 400px;
        object-fit: cover;
        border-radius: 50%;
        border: 10px solid rgba(255, 255, 255, 0.05);
        box-shadow: 0 0 50px rgba(0, 0, 0, 0.5);
        transition: all 0.5s ease;
    }

    .solutions-center-image:hover img {
        transform: scale(1.02);
        border-color: rgba(227, 6, 19, 0.3);
        box-shadow: 0 0 60px rgba(227, 6, 19, 0.2);
    }

    .solution-item-modern {
        display: flex;
        align-items: center;
        gap: 1.5rem;
        padding: 1.5rem;
        border-radius: 20px;
        background-color: rgba(255, 255, 255, 0.03);
        border: 1px solid rgba(255, 255, 255, 0.05);
        transition: all 0.3s ease;
        position: relative;
        z-index: 1;
        backdrop-filter: blur(10px);
        margin-bottom: 2rem;
    }

    .solution-item-modern:hover {
        background-color: rgba(255, 255, 255, 0.1);
        transform: translateY(-5px);
        border-color: rgba(227, 6, 19, 0.5);
        box-shadow: 0 10px 30px rgba(0,0,0,0.2);
    }

    .solution-icon-modern {
        flex-shrink: 0;
        width: 60px;
        height: 60px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: linear-gradient(135deg, #e30613 0%, #a0040d 100%);
        color: #ffffff;
        font-size: 24px;
        box-shadow: 0 5px 15px rgba(227, 6, 19, 0.4);
    }

    .solution-text-modern h3 {
        font-size: 1.25rem;
        font-weight: 700;
        color: #ffffff;
        margin-bottom: 0.5rem;
    }

    .solution-text-modern p {
        font-size: 0.95rem;
        color: #bdc3c7;
        margin-bottom: 0;
        line-height: 1.5;
    }

    /* Estilos específicos para escritorio */
    @media (min-width: 992px) {
        .solution-item-left {
            flex-direction: row-reverse;
            text-align: right;
        }
        
        /* Conectores visuales (líneas) hacia la imagen central */
        .solution-item-modern::after {
            content: '';
            position: absolute;
            top: 50%;
            width: 50px;
            height: 1px;
            background: linear-gradient(90deg, rgba(255,255,255,0.2), transparent);
            pointer-events: none;
            transition: width 0.3s ease;
        }

        .solution-item-left::after {
            right: -50px;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2));
        }
        
        .solution-item-right::after {
            left: -50px;
        }

        .solution-item-modern:hover::after {
            width: 80px;
            background: linear-gradient(90deg, rgba(227, 6, 19, 0.5), transparent);
        }
        
        .solution-item-left:hover::after {
            right: -80px;
            background: linear-gradient(90deg, transparent, rgba(227, 6, 19, 0.5));
        }
        
        .solution-item-right:hover::after {
            left: -80px;
        }
    }
</style>

<section class="solutions-modern-section">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-10 text-center">
                <h2 class="solutions-modern-title">Soluciones que transforman tu equipo</h2>
                <p class="solutions-modern-subtitle">Desde formación con estándares globales hasta consultoría a medida, te convertimos en un líder estratégico.</p>
            </div>
        </div>

        <div class="row align-items-center">
            <!-- Columna Izquierda -->
            <div class="col-lg-4 order-2 order-lg-1">
                <div class="d-flex flex-column justify-content-center h-100">
                    <!-- Item 1 -->
                    <div class="solution-item-modern solution-item-left" data-aos="fade-right" data-aos-delay="100">
                        <div class="solution-icon-modern"><i class="fa fa-globe" aria-hidden="true"></i></div>
                        <div class="solution-text-modern">
                            <h3>Formación Global</h3>
                            <p>Estándares internacionales para contadores, financieros y auditores.</p>
                        </div>
                    </div>
                    <!-- Item 2 -->
                    <div class="solution-item-modern solution-item-left" data-aos="fade-right" data-aos-delay="200">
                        <div class="solution-icon-modern"><i class="fa fa-refresh" aria-hidden="true"></i></div>
                        <div class="solution-text-modern">
                            <h3>Suscripciones Flexibles</h3>
                            <p>Asesoría especializada y formación continua escalable.</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Columna Central (Imagen) -->
            <div class="col-lg-4 order-1 order-lg-2 mb-5 mb-lg-0">
                <div class="solutions-center-image" data-aos="zoom-in">
                    <img src="{{ asset('themes/webpage/images/soluciones-equipo.jpg') }}" alt="Equipo de profesionales colaborando">
                </div>
            </div>

            <!-- Columna Derecha -->
            <div class="col-lg-4 order-3 order-lg-3">
                <div class="d-flex flex-column justify-content-center h-100">
                    <!-- Item 3 -->
                    <div class="solution-item-modern solution-item-right" data-aos="fade-left" data-aos-delay="100">
                        <div class="solution-icon-modern"><i class="fa fa-handshake-o" aria-hidden="true"></i></div>
                        <div class="solution-text-modern">
                            <h3>Certificación ACCA</h3>
                            <p>Único Approved Learning Partner en Perú para tu preparación.</p>
                        </div>
                    </div>
                    <!-- Item 4 -->
                    <div class="solution-item-modern solution-item-right" data-aos="fade-left" data-aos-delay="200">
                        <div class="solution-icon-modern"><i class="fa fa-users" aria-hidden="true"></i></div>
                        <div class="solution-text-modern">
                            <h3>In-Company</h3>
                            <p>Capacitación diseñada a medida para los objetivos de tu empresa.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

</div>
