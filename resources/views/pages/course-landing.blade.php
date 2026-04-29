@extends('layouts.webpage')

@section('content')
    @php
        // Validar que landing y course existan
        if (!isset($landing) || empty($landing) || !isset($landing->course) || empty($landing->course)) {
            echo '<div class="container-fluid py-5 text-center"><div class="alert alert-warning">Landing o curso no encontrado.</div></div>';
            return;
        }
    @endphp


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
                            title: 'Registro exitoso, estas a un paso de asegurar tu vacante',
                            // text: response.message,
                            text: 'Hemos recibido tu información. Estamos en etapa final de preventa con condiciones preferenciales activas. Elige como deseas continuar:',
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
