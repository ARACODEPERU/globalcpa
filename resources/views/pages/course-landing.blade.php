@extends('layouts.webpage')

@section('content')
    @php
        // Validar que landing y course existan
        if (!isset($landing) || empty($landing) || !isset($landing->course) || empty($landing->course)) {
            echo '<div class="container-fluid py-5 text-center"><div class="alert alert-warning">Landing o curso no encontrado.</div></div>';
            return;
        }
    @endphp

    {{-- Ideally, this CSS should be in the <head> of your main layout file (e.g., layouts/webpage.blade.php) --}}
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .transition-all {
            transition: all 0.3s ease-in-out !important;
            transition: transform 0.3s ease, box-shadow 0.3s ease, border-color 0.3s ease !important;
        }

        .transition-all:hover {
            transform: translateY(-12px);
            box-shadow: 0 15px 30px rgba(0, 32, 96, 0.15) !important;
            box-shadow: 0 15px 30px rgba(0, 32, 96, 0.15);
            border-color: #ffc107 !important;
            /* Un sutil borde dorado al resaltar */
        }

        /* Estilos del Carrusel Infinito */
        .carousel-viewport {
            overflow: hidden;
            padding: 100px 0 50px 0;
            /* Espacio para que las imágenes y sombras no se corten */
            position: relative;
            width: 100%;
        }

        .carousel-track {
            display: flex;
            gap: 30px;
            width: max-content;
            animation: scroll-infinite 40s linear infinite;
        }

        .carousel-track:hover {
            animation-play-state: paused;
        }

        @keyframes scroll-infinite {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-50%));
            }
        }

        .teacher-carousel-item {
            width: 300px;
            flex-shrink: 0;
        }

        /* Estilos para FAQ Moderna */
        .faq-modern .accordion-item {
            border: 1px solid #edf2f7 !important;
            margin-bottom: 1rem;
            border-radius: 15px !important;
            overflow: hidden;
            transition: all 0.3s ease;
            /* background: #ffffff; */
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
            background: #ffffff;
        }

        .faq-modern .accordion-item:has(.show) {
            border-color: #002060 !important;
            box-shadow: 0 15px 30px rgba(0, 32, 96, 0.08);
        }

        .faq-modern .accordion-button {
            padding: 1.5rem;
            font-weight: 600;
            /* background-color: white !important; */
            background-color: white !important;
            color: #002060;
            font-size: 1.05rem;
        }

        .faq-modern .accordion-button:focus {
            box-shadow: none;
            box-shadow: none !important;
            border-color: transparent;
        }

        .faq-modern .accordion-button:not(.collapsed) {
            background-color: rgba(0, 32, 96, 0.02) !important;
            color: #002060;
            border-bottom: 1px solid #f1f5f9;
        }

        .faq-modern .accordion-button:not(.collapsed) {
            color: #002060;
            box-shadow: none;
        }

        .faq-modern .accordion-button::after {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 16 16' fill='%23002060'%3e%3cpath fill-rule='evenodd' d='M1.646 4.646a.5.5 0 0 1 .708 0L8 10.293l5.646-5.647a.5.5 0 0 1 .708.708l-6 6a.5.5 0 0 1-.708 0l-6-6a.5.5 0 0 1 0-.708z'/%3e%3c/svg%3e");
            transition: transform 0.3s ease;
        }

        /* Ajustes para Select2 y flags SVG */
        .select2-container--default .select2-selection--single {
            border: 1px solid #dee2e6 !important;
            border-left: 0 !important;
            height: 38px !important;
            display: flex;
            align-items: center;
        }

        .select2-container {
            width: 100% !important;
        }

        .select2-selection__arrow {
            top: 6px !important;
        }

        /* Botones Modernos UX */
        .btn-modern {
            padding: 12px 28px;
            font-weight: 700;
            transition: all 0.4s cubic-bezier(0.165, 0.84, 0.44, 1);
            letter-spacing: 0.5px;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            border-radius: 50px !important;
        }

        .btn-modern-primary {
            background: linear-gradient(135deg, #ffc107 0%, #ff9800 100%);
            color: #002060 !important;
            border: none;
            box-shadow: 0 4px 15px rgba(255, 193, 7, 0.3);
        }

        .btn-modern-primary:hover {
            transform: translateY(-3px) scale(1.03);
            box-shadow: 0 8px 25px rgba(255, 193, 7, 0.5);
        }

        .btn-modern-outline {
            background: transparent;
            color: #002060 !important;
            border: 2px solid #002060 !important;
        }

        .btn-modern-outline:hover {
            background: #002060 !important;
            color: #ffffff !important;
            transform: translateY(-2px);
        }
    </style>

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->

    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <x-header />

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <x-sidebar />
            <!-- Page Sidebar Ends-->
            <div class="page-body">

                {{-- Hero Section --}}
                <x-courselanding.hero :landing="$landing" />

                {{-- Professional Development --}}
                <x-courselanding.professional-development :landing="$landing" />

                {{-- The Problem --}}
                <x-courselanding.the-problem :landing="$landing" />

                {{-- Study Plan --}}
                <x-courselanding.study-plan :landing="$landing" />

                {{-- Carrusel de Expertos Premium (Opción 5) --}}
                <x-courselanding.staff :landing="$landing" :teachers-premium="$teachers_premium" />

                {{-- Results --}}  
                <x-courselanding.results :landing="$landing" :colors="$colors" />
                
                {{-- Testimonials --}}
                <x-courselanding.testimonials :landing="$landing" />

                {{-- Nueva Sección: Planes de Inversión --}}
                <x-courselanding.investment :landing="$landing" />

                {{-- Propuesta 2: Preguntas Frecuentes (Diseño Moderno de Tarjetas) --}}
                <x-courselanding.faq :landing="$landing" />

                <x-courselanding.certificate-template />

                {{-- Modal de Financiamiento --}}
                <div class="modal fade" id="modalFinanciamiento" tabindex="-1" aria-labelledby="modalFinanciamientoLabel" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content border-0 shadow-lg" style="border-radius: 20px;">
                            <div class="modal-header border-0 p-4 pb-0">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body p-4 p-lg-5 pt-0">
                                <div class="text-center mb-4">
                                    <h2 class="fw-bold" style="color: #002060; font-size: 24px;">Asegurar vacante y/o financiamiento</h2>
                                    <p class="text-muted">Déjanos tus datos para que un asesor te ayude con el proceso de inscripción y planes de pago.</p>
                                </div>
                                <form id="modalContactForm">
                                    @csrf
                                    <input type="hidden" name="subject" value="{{ $landing->course->description ?? 'Curso' }}">
                                    <input type="hidden" name="message" value="Desde Landing - Modal Financiamiento">
                                    
                                    <div class="mb-3">
                                        <label class="form-label fw-bold" style="color: #002060;">Nombres y Apellidos</label>
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-white border-end-0"><i class="fa fa-user text-muted"></i></span>
                                            <input type="text" name="full_name" class="form-control border-start-0 ps-0" placeholder="Nombre completo" required>
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label fw-bold" style="color: #002060;">País</label>
                                        <div class="input-group shadow-sm">
                                            <span class="input-group-text bg-white border-end-0"><i class="fa fa-flag text-muted"></i></span>
                                            <select name="country_phone" id="modalCountryPhoneSelect" class="form-select border-start-0 ps-0" required>
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
                                            <label class="form-label fw-bold" style="color: #002060;">WhatsApp</label>
                                            <div class="input-group shadow-sm">
                                                <span class="input-group-text bg-white border-end-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" style="width: 16px; height: 16px; fill: #6c757d;">
                                                        <path d="M380.9 97.1c-41.9-42-97.7-65.1-157-65.1-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480 117.7 449.1c32.4 17.7 68.9 27 106.1 27l.1 0c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.6-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1s56.2 81.2 56.1 130.5c0 101.8-84.9 184.6-186.6 184.6zM325.1 300.5c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8s-14.3 18-17.6 21.8c-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7s-12.5-30.1-17.1-41.2c-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2s-9.7 1.4-14.8 6.9c-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4s4.6-24.1 3.2-26.4c-1.3-2.5-5-3.9-10.5-6.6z"/>
                                                    </svg>
                                                </span>
                                                <input type="text" name="phone" class="form-control border-start-0 ps-0" placeholder="999 888 777" required>
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
                                    <button type="submit" id="submitModalContactButton" class="btn btn-warning btn-lg w-100 fw-bold shadow-sm py-3 mt-2" style="color: #002060; border-radius: 12px;">
                                        SOLICITAR INFORMACIÓN DE FINANCIAMIENTO
                                    </button>
                                    <div id="messageModalContact" class="mt-3"></div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <!-- footer start-->
        <x-footer />
    </div>

    {{-- Ideally, this JS should be at the end of your <body> in the main layout file --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

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
        function procederInscripcion() {
            Swal.fire({
                title: '¿Confirmar inscripción?',
                text: '¿Estás seguro de que deseas proceder con la compra?',
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Sí, continuar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    // 1. Limpiar el carrito
                    localStorage.removeItem('carrito');

                    // 2. Crear objeto del producto
                    var producto = {
                        id: {{ $onli_item_id ?? 0 }},
                        nombre: "{{ $landing->course->description ?? 'Curso' }}",
                        precio: {{ isset($landing->investment_section['items'][0]['price_now']) ? $landing->investment_section['items'][0]['price_now'] : 0 }},
                        image: "{{ $landing->course->image ?? '' }}"
                    };

                    // 3. Agregar directamente al localStorage
                    var carrito = [];
                    carrito.push(producto);
                    localStorage.setItem('carrito', JSON.stringify(carrito));

                    // 4. Redireccionar
                    window.location.href = "{{ route('web_carrito') }}";
                }
            });
        }
    </script>

    <script>
        function initContactForm(formId, buttonId, messageId, countrySelectId) {
            let formElement = document.getElementById(formId);
            if(!formElement) return;

            formElement.addEventListener('submit', function(e) {
                e.preventDefault();

                var formData = new FormData(formElement);
                const countrySelect = document.getElementById(countrySelectId);
                const prefix = countrySelect.value;
                formData.set('phone', prefix + formData.get('phone'));

                var submitButton = document.getElementById(buttonId);
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
                            customClass: { container: 'sweet-modal-zindex' }
                        });
                        formElement.reset();
                        // Cerrar modal si existe
                        var modalElement = document.getElementById('modalFinanciamiento');
                        var modalInstance = bootstrap.Modal.getInstance(modalElement);
                        if(modalInstance) modalInstance.hide();
                    } else if (xhr.status === 422) {
                        var errorResponse = JSON.parse(xhr.responseText);
                        var errorMessageContainer = document.getElementById(messageId);
                        errorMessageContainer.innerHTML = 'Errores de validación:<br>';
                        for (var field in errorResponse.errors) {
                            errorMessageContainer.innerHTML += field + ': ' + errorResponse.errors[field].join(', ') + '<br>';
                        }
                    }
                    const downloadUrl = "{{ isset($landing->course->brochure) ? $landing->course->brochure->path_file ?? '' : '' }}";
                    if(downloadUrl) window.open(downloadUrl, '_blank');
                };
                xhr.send(formData);
            });
        }

        // Inicializar ambos formularios
        initContactForm('pageContactForm', 'submitPageContactButton', 'messagePageContact', 'countryPhoneSelect');
        initContactForm('modalContactForm', 'submitModalContactButton', 'messageModalContact', 'modalCountryPhoneSelect');
    </script>

    <script>
        $(document).ready(function() {
            function formatCountry(country) {
                if (!country.id) {
                    return country.text;
                }
                var code = $(country.element).data('code');
                var $country = $(
                    '<span><img src="https://flagcdn.com/w20/' + code.toLowerCase() +
                    '.png" class="me-2" style="vertical-align: middle; border: 1px solid #eee; width: 20px;">' +
                    country.text + '</span>'
                );
                return $country;
            };

            $('#countryPhoneSelect').select2({
                templateResult: formatCountry,
                templateSelection: formatCountry,
                dropdownParent: $('#countryPhoneSelect').parent()
            });

            $('#modalCountryPhoneSelect').select2({
                templateResult: formatCountry,
                templateSelection: formatCountry,
                dropdownParent: $('#modalFinanciamiento')
            });
        });

        // Toggle FAQ Manual - abrir al entrar, cerrar al salir
        function toggleFaq(index) {
            var answer = document.getElementById('faq-answer-' + index);
            var icon = document.getElementById('faq-icon-' + index);

            // Verificar si está oculto o tiene display vacío
            var isHidden = answer.style.display === 'none' || answer.style.display === '';

            if (isHidden) {
                answer.style.display = 'block';
                icon.style.transform = 'rotate(180deg)';
            } else {
                answer.style.display = 'none';
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>


@stop
