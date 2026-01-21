<div>
    {{-- <section style="padding: 80px 0px;">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-3 pe-0">
                    </div>
                    <div class="col-sm-6 ps-0">
                        <h1 class="ara_title">Profesionales de empresas líderes confían en CPA Academy</h1>
                    </div>
                    <div class="col-sm-3 pe-0">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-1"></div>
                <div class="col-md-10" style="background: #fff; padding: 12px 18px;">
                    <div class="row">
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/alicorp.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/epsel.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/eps-grau.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/eps-maranon.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img style="width: 100%;"
                                src="{{ asset('themes/webpage/images/clients/electro-puno.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/redinter.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/interbank.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/bbva.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/pichincha.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/bcp.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/horizonte.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/antamina.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/minsur.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/entel.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/san-pablo.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/finanty.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                        <div class="col-md-2" style="margin-bottom: 20px;">
                            <img src="{{ asset('themes/webpage/images/clients/prima.jpg') }}" alt=""
                                class="logo_clients">
                        </div>
                    </div>
                </div>
                <div class="col-md-1"></div>
            </div>
        </div>
    </section> --}}

    {{-- <style>
        .logo_clients {
            width: 100%;
        }

        @media (max-width: 480px) {
            .logo_clients {
                width: 220px;
            }
        }
    </style> --}}


    <!-- Propuesta de Diseño Moderno -->
    <style>
        .clients-modern-section {
            padding: 80px 0;
            /* background-color: #f8f9fa; */
        }

        .clients-modern-title {
            font-size: 2.1rem;
            font-weight: 700;
            color: #2c3e50;
            margin-bottom: 1rem;
            text-transform: uppercase;
        }

        .clients-modern-subtitle {
            font-size: 1.1rem;
            color: #7f8c8d;
            margin-bottom: 3rem;
            max-width: 700px;
            margin-left: auto;
            margin-right: auto;
        }

        .clients-grid-wrapper {
            display: grid;
            /* Grid responsivo automático: crea tantas columnas como quepan de mínimo 160px */
            grid-template-columns: repeat(auto-fill, minmax(160px, 1fr));
            gap: 25px;
            justify-items: center;
        }

        .client-logo-card {
            background: #ffffff;
            border-radius: 12px;
            padding: 20px;
            width: 100%;
            height: 100px;
            /* Altura fija para uniformidad */
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid #eef2f7;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.02);
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
        }

        .client-logo-card img {
            max-width: 100%;
            max-height: 100%;
            object-fit: contain;
            /* Efecto visual clave: escala de grises y transparencia inicial */
            filter: grayscale(100%);
            opacity: 0.6;
            transition: all 0.3s ease;
        }

        .client-logo-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.08);
            border-color: transparent;
        }

        .client-logo-card:hover img {
            filter: grayscale(0%);
            opacity: 1;
        }

        /* Estilos para Modo Noche */
    .dark .clients-modern-section,
    .dark-only .clients-modern-section {
            background-color: #111827;
            /* Fondo oscuro profundo */
        }

    .dark .clients-modern-title,
    .dark-only .clients-modern-title {
        color: #ffffff;
        /* Texto blanco */
        }

    .dark .clients-modern-subtitle,
    .dark-only .clients-modern-subtitle {
            color: #d1d5db;
            /* Texto gris claro */
        }

    .dark .client-logo-card,
    .dark-only .client-logo-card {
            /* Mantenemos el fondo blanco para que los logos JPG se integren correctamente */
            background-color: #ffffff;
            border-color: transparent;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.5);
            /* Sombra más pronunciada para contraste */
        }
    </style>

    <section class="clients-modern-section">
        <div class="container">
            <div class="text-center">
                <h2 class="clients-modern-title">Profesionales de empresas líderes confían en CPA Academy</h2>
                <p class="clients-modern-subtitle">Impulsando el crecimiento y la excelencia en las organizaciones más
                    importantes del país.</p>
            </div>

            <div class="clients-grid-wrapper">
                @php
                    $logos = [
                        'alicorp.jpg',
                        'epsel.jpg',
                        'eps-grau.jpg',
                        'eps-maranon.jpg',
                        'electro-puno.jpg',
                        'redinter.jpg',
                        'interbank.jpg',
                        'bbva.jpg',
                        'pichincha.jpg',
                        'bcp.jpg',
                        'horizonte.jpg',
                        'antamina.jpg',
                        'minsur.jpg',
                        'entel.jpg',
                        'san-pablo.jpg',
                        'finanty.jpg',
                        'prima.jpg',
                    ];
                @endphp

                @foreach ($logos as $logo)
                    <div class="client-logo-card" data-aos="fade-up" data-aos-delay="{{ $loop->index * 50 }}">
                        <img src="{{ asset('themes/webpage/images/clients/' . $logo) }}" alt="Cliente CPA Academy"
                            loading="lazy">
                    </div>
                @endforeach
            </div>
        </div>
    </section>

</div>
