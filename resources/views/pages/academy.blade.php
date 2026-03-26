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
                                    {{-- Animación CSS Propuesta: Ecosistema de Aprendizaje --}}
                                    <style>
                                        .orbit-system {
                                            position: absolute;
                                            top: 50%;
                                            left: 50%;
                                            width: 240px;
                                            height: 240px;
                                            transform: translate(-50%, -50%);
                                            border-radius: 50%;
                                            border: 1px dashed rgba(255, 255, 255, 0.15);
                                            animation: orbit-spin 25s linear infinite;
                                        }

                                        .orbit-item {
                                            position: absolute;
                                            top: 50%;
                                            left: 50%;
                                            width: 44px;
                                            height: 44px;
                                            margin-top: -22px;
                                            margin-left: -22px;
                                            display: flex;
                                            align-items: center;
                                            justify-content: center;
                                            background: rgba(255, 255, 255, 0.1);
                                            border-radius: 50%;
                                            backdrop-filter: blur(2px);
                                        }

                                        /* Contrarrotación para mantener los iconos verticales */
                                        .orbit-item i {
                                            animation: orbit-counter-spin 25s linear infinite;
                                        }

                                        /* Posiciones fijas en la órbita (triángulo equilátero) */
                                        .pos-1 {
                                            transform: rotate(0deg) translate(120px) rotate(0deg);
                                        }

                                        .pos-2 {
                                            transform: rotate(120deg) translate(120px) rotate(-120deg);
                                        }

                                        .pos-3 {
                                            transform: rotate(240deg) translate(120px) rotate(-240deg);
                                        }

                                        .center-pulse {
                                            position: absolute;
                                            top: 50%;
                                            left: 50%;
                                            transform: translate(-50%, -50%);
                                            animation: center-pulse-anim 3s ease-in-out infinite;
                                        }

                                        @keyframes orbit-spin {
                                            100% {
                                                transform: translate(-50%, -50%) rotate(360deg);
                                            }
                                        }

                                        @keyframes orbit-counter-spin {
                                            100% {
                                                transform: rotate(-360deg);
                                            }
                                        }

                                        @keyframes center-pulse-anim {

                                            0%,
                                            100% {
                                                transform: translate(-50%, -50%) scale(1);
                                                opacity: 0.3;
                                            }

                                            50% {
                                                transform: translate(-50%, -50%) scale(1.05);
                                                opacity: 0.7;
                                                text-shadow: 0 0 15px rgba(255, 255, 255, 0.3);
                                            }
                                        }
                                    </style>

                                    {{-- Icono Central --}}
                                    <div class="center-pulse">
                                        <i class="fa fa-laptop fa-5x text-white"></i>
                                    </div>

                                    {{-- Sistema Orbital --}}
                                    <div class="orbit-system">
                                        <div class="orbit-item pos-1" title="Clases en Video">
                                            <i class="fa fa-play text-warning fs-5"></i>
                                        </div>
                                        <div class="orbit-item pos-2" title="Certificación">
                                            <i class="fa fa-certificate text-info fs-5"></i>
                                        </div>
                                        <div class="orbit-item pos-3" title="Recursos Descargables">
                                            <i class="fa fa-file-text-o text-success fs-5"></i>
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
