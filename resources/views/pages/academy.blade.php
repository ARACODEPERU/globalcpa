@extends('layouts.webpage')

@section('content')
    {{-- Ideally, this CSS should be in the <head> of your main layout file (e.g., layouts/webpage.blade.php) --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">


    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->


    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <x-header />
        <!-- Page Header Ends-->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <x-sidebar />
            <!-- Page Sidebar Ends-->
            <div class="page-body" x-data>

                <div class="container-fluid mt-4">
                    {{-- Hero Section --}}
                    <div class="card border-0 overflow-hidden shadow mb-4"
                        style="background: linear-gradient(135deg, #002060 0%, #004080 100%); border-radius: 15px;"
                        data-aos="fade-in">
                        <div class="card-body p-4 p-lg-5 text-white">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <div class="d-flex align-items-center mb-3">
                                        <span class="badge bg-warning text-dark me-2">Texto</span>
                                        <div class="text-warning small">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>

                                            <span class="text-white ms-1">(4.8/5 de {{ rand(30, 120) }} alumnos activos)</span>
                                        </div>
                                    </div>
                                    <h1 class="display-5 fw-bold mb-3" style="color: #fff;">Especialización en Inteligencia Artificial aplicada a la Contabilidad y Finanzas</h1>
                                    
                                    <div class="d-flex align-items-center text-white-50">
                                        <span class="me-3"><i class="fa fa-clock-o me-1"></i>
                                            Inicio: 17 abril | Duración: 3 meses | Modalidad: En vivo</span>
                                        <span><i class="fa fa-globe me-1"></i> Español</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-center d-none d-lg-block position-relative"
                                    style="min-height: 250px;">
                                    <img src="{{ asset('themes/molde.jpeg') }}"
                                        alt="Especialización en IA para Contabilidad" class="img-fluid" style="max-height: 250px;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid card aos-animate" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-body p-4 p-lg-5">
                                <div class="mb-4">
                                    <span class="badge rounded-pill bg-light text-primary px-3 py-2 mb-3 shadow-sm border" style="color: #002060 !important;">
                                        <i class="fa fa-refresh me-1"></i> ACTUALIZACIÓN PROFESIONAL
                                    </span>
                                    <h2 class="fw-bold display-6" style="color: #002060;">Lidera la era de la Contabilidad Inteligente</h2>
                                    <p class="text-muted fs-5">No solo aprendas a usar herramientas; domina la estrategia detrás de la Inteligencia Artificial para convertirte en un asesor financiero de alto valor.</p>
                                </div>

                                <div class="row g-4 mt-2">
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 bg-warning-light p-3 rounded-circle me-3" style="background-color: rgba(255, 193, 7, 0.1);">
                                                <i class="fa fa-line-chart text-warning fs-4"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-0 fw-bold" style="color: #002060;">Eficiencia</h5>
                                                <small class="text-muted">Automatiza tareas repetitivas.</small>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="d-flex align-items-center">
                                            <div class="flex-shrink-0 bg-info-light p-3 rounded-circle me-3" style="background-color: rgba(0, 204, 255, 0.1);">
                                                <i class="fa fa-database text-info fs-4"></i>
                                            </div>
                                            <div>
                                                <h5 class="mb-0 fw-bold" style="color: #002060;">Data Driven</h5>
                                                <small class="text-muted">Análisis predictivo financiero.</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="card-body p-4 p-lg-5">
                                <div class="mb-4">
                                    <h2 class="fw-bold" style="color: #002060;">¿Listo para empezar?</h2>
                                    <p class="text-muted">Completa tus datos para descargar el brochure detallado y recibir información sobre promociones exclusivas del programa.</p>
                                </div>

                                <form id="pageContactForm">
                                    @csrf
                                    <input type="hidden" name="subject" value="Solicitud de Brochure - Especialización IA">
                                    <input type="hidden" name="message" value="El usuario ha solicitado el temario desde la landing de Academy.">
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" style="color: #002060;">Nombres y Apellidos</label>
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-white border-end-0"><i class="fa fa-user text-muted"></i></span>
                                            <input type="text" name="full_name" class="form-control border-start-0 ps-0" placeholder="Ingresa tu nombre completo" required>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <label class="form-label fw-bold" style="color: #002060;">WhatsApp</label>
                                            <div class="input-group shadow-sm">
                                                <span class="input-group-text bg-white border-end-0"><i class="fa fa-whatsapp text-muted"></i></span>
                                                <input type="text" name="phone" class="form-control border-start-0 ps-0" placeholder="Ej: 999 888 777" required>
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

                                    <div class="mt-4">
                                        <button type="submit" id="submitPageContactButton" class="btn btn-warning btn-lg w-100 fw-bold shadow-sm py-3" style="color: #002060; border-radius: 12px; transition: all 0.3s ease;">
                                            <i class="fa fa-file-pdf-o me-2"></i> DESCARGAR BROCHURE
                                        </button>
                                    </div>
                                    <div id="messagePageContact" class="mt-3"></div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
                
                <div class="container-fluid card aos-animate" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-body p-4 p-lg-5">
                                <div class="text-center mb-5">
                                    <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border" style="background-color: rgba(220, 53, 69, 0.1); color: #dc3545;">
                                        <i class="fa fa-exclamation-triangle me-1"></i> EL PROBLEMA
                                    </span>
                                    <h2 class="fw-bold display-6" style="color: #002060;">Tu equipo está saturado y pierdes ventas todos los días</h2>
                                    <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">No es solo traer tráfico, es atender rápido sin multiplicar tu equipo.</p>
                                </div>

                                <div class="row g-4">
                                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="100">
                                        <div class="h-100 p-4 rounded-4 border shadow-sm text-center bg-white transition-all">
                                            <div class="mb-4">
                                                <i class="fa fa-clock-o text-warning" style="font-size: 3.5rem;"></i>
                                            </div>
                                            <h4 class="fw-bold mb-3" style="color: #002060;">No ofreces atención 24/7</h4>
                                            <p class="text-muted mb-0">en canales como WhatsApp e Instagram y eso te hace perder ventas todos los días</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="200">
                                        <div class="h-100 p-4 rounded-4 border shadow-sm text-center bg-white transition-all">
                                            <div class="mb-4">
                                                <i class="fa fa-users text-warning" style="font-size: 3.5rem;"></i>
                                            </div>
                                            <h4 class="fw-bold mb-3" style="color: #002060;">Equipo saturado en post-venta</h4>
                                            <p class="text-muted mb-0">y eso consume el 70% de su tiempo</p>
                                        </div>
                                    </div>
                                    <div class="col-md-4" data-aos="zoom-in" data-aos-delay="300">
                                        <div class="h-100 p-4 rounded-4 border shadow-sm text-center bg-white transition-all">
                                            <div class="mb-4">
                                                <i class="fa fa-commenting-o text-warning" style="font-size: 3.5rem;"></i>
                                            </div>
                                            <h4 class="fw-bold mb-3" style="color: #002060;">Tu Chatbot no vende</h4>
                                            <p class="text-muted mb-0">Chatbots básicos que responden, pero no convierten ni miden impacto.</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid card aos-init aos-animate" data-aos="fade-up">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-4">
                            <div style="padding: 20px 20px;">
                                <div class="page-title">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h1 class="ara_title">¡Comparte tus logros con un certificado!</h1>
                                        </div>
                                    </div>
                                </div>
                                <p style="font-size: 17px; line-height: 1.3; margin-top: 10px;">
                                    Cuando termines el curso tendrás acceso al certificado digital para
                                    compartirlo con tu
                                    familia, amigos, empleadores y la comunidad.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div style="place-items: center; padding: 40px 20px;">
                                <img style="width: 100%;"
                                    src="https://academy.globalcpaperu.com/themes/webpage/images/certificado.jpg"
                                    alt="">
                                <p style="font-size: 17px; line-height: 1.3; margin-top: 10px;">
                                    <b>* IMAGEN REFERENCIAL</b>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer start-->
        <x-footer />
    </div>

    {{-- Ideally, this JS should be at the end of your <body> in the main layout file --}}
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init({
            mirror: true, // This makes animations trigger on scroll up as well
            duration: 800, // Animation duration
            once: false // Ensures animation happens every time you scroll to it
        });
    </script>



    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>

    <script>
        let form = document.getElementById('pageContactForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            var formulario = document.getElementById('pageContactForm');
            var formData = new FormData(formulario);

            var submitButton = document.getElementById('submitPageContactButton');
            submitButton.disabled = true;
            submitButton.style.opacity = 0.25;

            var xhr = new XMLHttpRequest();

            xhr.open('POST', "{{ route('apisubscriber') }}", true);

            xhr.onload = function() {
                submitButton.disabled = false;
                submitButton.style.opacity = 1;
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    Swal.fire({
                        icon: 'success',
                        title: 'Enhorabuena',
                        text: response.message,
                        customClass: {
                            container: 'sweet-modal-zindex'
                        }
                    });
                    formulario.reset();
                } else if (xhr.status === 422) {
                    var errorResponse = JSON.parse(xhr.responseText);
                    var errorMessages = errorResponse.errors;
                    var errorMessageContainer = document.getElementById('messagePageContact');
                    errorMessageContainer.innerHTML = 'Errores de validación:<br>';
                    for (var field in errorMessages) {
                        if (errorMessages.hasOwnProperty(field)) {
                            errorMessageContainer.innerHTML += field + ': ' + errorMessages[field].join(', ') +
                                '<br>';
                        }
                    }
                } else {
                    console.error('Error en la solicitud: ' + xhr.status);
                }
                const downloadUrl = "";
                window.open(downloadUrl, '_blank');

            };

            xhr.send(formData);
        });
    </script>



@stop
