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
        let form = document.getElementById('pageContactForm');
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            var formulario = document.getElementById('pageContactForm');
            var formData = new FormData(formulario);

            // Obtener el código del país del select y concatenarlo al número sin punto
            const countrySelect = document.getElementById('countryPhoneSelect');
            const prefix = countrySelect.value;
            const phoneValue = formData.get('phone');
            // Concatenar sin punto: +51943781600
            formData.set('phone', prefix + phoneValue);

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
                const downloadUrl =
                    "{{ isset($landing->course->brochure) ? $landing->course->brochure->path_file ?? '' : '' }}";
                window.open(downloadUrl, '_blank');

            };

            xhr.send(formData);
        });
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
