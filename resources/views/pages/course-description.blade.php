@extends('layouts.webpage')

@section('content')
{{-- Ideally, this CSS should be in the <head> of your main layout file (e.g., layouts/webpage.blade.php) --}}
<link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">



    <!-- Loader starts-->
    <!-- <div class="loader-wrapper">
                                                              <div class="loader"></div>
                                                            </div> -->
    <!-- Loader ends-->
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
                {{-- <div class="container-fluid">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-12 ps-0">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item">
                                        <a href="">
                                            <svg class="stroke-icon">
                                                <use
                                                    href="{{ asset('themes/webpage/assets/svg/icon-sprite.svg#stroke-home') }}">
                                                </use>
                                            </svg>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item">Learning</li>
                                    <li class="breadcrumb-item active">Detailed Course</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div> --}}
                <br><br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" data-aos="fade-in">
                            <div class="card">
                                {{-- <div class="card-header pb-0">
                                    <h3><i class="icofont icofont-library me-2"></i> Icon In Heading</h3>
                                    <p class="f-m-light mt-1">Use the any icons for heading.
                                        <code>[font-awesome/ico-font/feather]</code>.
                                    </p>
                                </div> --}}
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col-md-8">
                                            <img src="{{ asset('storage/' . $item->course->image) }}" alt="portada_curso">
                                        </div>
                                        <div class="col-md-4">
                                            <div style="padding: 0px;">
                                                <div class="row">
                                                    <div class="col-sm-12 ps-0">
                                                        <h1 class="ara_title">{{ $item->name }}</h1>
                                                    </div>
                                                </div>
                                            </div>
                                            <p style="font-size: 19px; line-height: 1.3;">
                                                {{ $item->description }}
                                            </p>
                                            @if ($item->price)
                                                <h2 style="font-size: 35px; line-height: 1.1; font-weight: 500;">
                                                    S/ {{ $item->price }}
                                                </h2>
                                            @else
                                                <h2 style="font-size: 35px; line-height: 1.1; font-weight: 500;">
                                                    Free
                                                </h2>
                                            @endif
                                            <div class="row">
                                                @if ($item->price)
                                                    <div class="col-md-6" style="padding: 10px 0px;">
                                                        <a
                                                            onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                                                            <button class="boton-degradado-courses">
                                                                <b>
                                                                    <i class="fa fa-cart-plus" aria-hidden="true"
                                                                        style="font-size: 16px;"></i>
                                                                    &nbsp; Añadir al Carrito
                                                                </b>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="col-md-6" style="padding: 10px 0px;">
                                                        <a href="">
                                                            <button class="boton-degradado-courses">
                                                                <b>
                                                                    <i class="fa fa-edit" aria-hidden="true"
                                                                        style="font-size: 16px;"></i>
                                                                    &nbsp; Registrarme
                                                                </b>
                                                            </button>
                                                        </a>
                                                    </div>
                                                @endif
                                                @if ($course->brochure->path_file)
                                                    <div class="col-md-6" style="padding: 10px 0px;">
                                                        <button class="boton-degradado-info"
                                                            data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                                                            <b>
                                                                <i class="fa fa-edit" aria-hidden="true"
                                                                    style="font-size: 16px;"></i>
                                                                &nbsp; Descargar Brochure
                                                            </b>
                                                        </button>
                                                    </div>
                                                @endif
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="modal fade" id="exampleModalToggle" aria-hidden="true"
                        aria-labelledby="exampleModalToggleLabel" tabindex="-1">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="exampleModalToggleLabel">{{ $item->name }}</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form action="{{ route('apisubscriber') }}" method="post" id="pageContactForm">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="exampleInputName" class="form-label">Nombre Completo</label>
                                            <input type="text" class="form-control" id="exampleInputName"
                                                name="full_name" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputPhone" class="form-label">Teléfono</label>
                                            <input type="text" class="form-control" id="exampleInputPhone" name="phone"
                                                required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleInputEmail1" class="form-label">Correo
                                                Electrónico</label>
                                            <input type="email" class="form-control" id="exampleInputEmail1"
                                                name="email" required>
                                        </div>
                                        <input type="hidden" name="subject" value="{{ $item->name }}">
                                        <input type="hidden" name="message" value="Descargué el Brochure">
                                        <button type="submit" class="boton-degradado-courses"
                                            id="submitPageContactButton">Descargar Brochure</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12" data-aos="fade-up">
                            <div class="accordion-aracode">
                                <div class="accordion-item-aracode  card">
                                    <div class="accordion-header-aracode  active" aria-expanded="true">
                                        <span class="accordion-icon-aracode">►</span>
                                        PRESENTACIÓN
                                    </div>
                                    <div class="accordion-content-aracode" aria-hidden="false"
                                        style="max-height: 100%; padding: 25px 20px;">
                                        @if ($course->brochure)
                                            <p class="mt-1" style="font-size: 17px; line-height: 1.3;">
                                                {!! $course->brochure->presentation !!}
                                            </p>
                                        @endif
                                        <br>
                                    </div>
                                </div>
                                {{-- <div class="accordion-item-aracode">
                                                <div class="accordion-header-aracode" aria-expanded="false">
                                                    <span class="accordion-icon-aracode">►</span>
                                                    RUTA DE APRENDIZAJE
                                                </div>
                                                <div class="accordion-content-aracode" aria-hidden="true">
                                                    @if ($course->brochure)
                                                        <p class="mt-1" style="font-size: 17px; line-height: 1.3;">
                                                            {!! $course->brochure->curriculum_plan !!}
                                                        </p>
                                                    @endif
                                                    <br>
                                                </div>
                                            </div> --}}
                                <div class="accordion-item-aracode">
                                    <div class="accordion-header-aracode" aria-expanded="false">
                                        <span class="accordion-icon-aracode">►</span>
                                        FACILITADORES
                                    </div>
                                    <div class="accordion-content-aracode" aria-hidden="true">
                                        @if (count($course->teachers) > 0)
                                            @foreach ($course->teachers as $teach)
                                                <div class="row" style="margin-bottom: 20px;">
                                                    <div class="col-md-2">
                                                        <a href="">
                                                            <img style="width: 150px; margin-bottom: 10px; margin-left: 10px;"
                                                                src="{{ asset('storage/' . $teach->teacher->person->image) }}"
                                                                alt="img">
                                                        </a>
                                                    </div>
                                                    <div class="col-md-10">
                                                        <h2 style="font-size: 18px;">
                                                            <b>
                                                                {{ $teach->teacher->person->names . ' ' . $teach->teacher->person->father_lastname . ' ' . $teach->teacher->person->mother_lastname }}
                                                            </b>
                                                        </h2>
                                                        @if (count($teach->teacher->person->resumes))
                                                            @foreach ($teach->teacher->person->resumes as $resume)
                                                                <div class="list-item-aracode" style="font-size: 17px;">
                                                                    <span class="list-icon-aracode">•</span>
                                                                    {{ $resume->description }}
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                        <br>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid" data-aos="fade-up">
                    <div class="page-title">
                        <div class="row">
                            <div class="col-sm-3 pe-0">
                            </div>
                            <div class="col-sm-6 ps-0">
                                <h1 class="ara_title">INCLUYE</h1>
                            </div>
                            <div class="col-sm-3 pe-0">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3" data-aos="fade-up" data-aos-delay="0">
                            <div class="card" style="place-items: center; padding: 40px 10px;">
                                <i style="font-size: 90px;" class="fa fa-chalkboard-teacher mb-1" :class="$store.global.isDarkModeEnabled ? 'text-gray-100' : 'text-gray-800'"></i>
                                <p style="font-size: 17px; line-height: 1.3; text-align:center; margin-top: 0px;">
                                    Formación práctica en vivo con atención a tus consultas.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3" data-aos="fade-up" data-aos-delay="100">
                            <div class="card" style="place-items: center; padding: 40px 10px;">
                                <i style="font-size: 90px;"  class="fa fa-video-camera mb-1" :class="$store.global.isDarkModeEnabled ? 'text-gray-100' : 'text-gray-800'"></i>
                                <p style="font-size: 17px; line-height: 1.3; text-align:center; margin-top: 0px;">
                                    Acceso permanente a las grabaciones de las sesiones desde nuestra
                                    plataforma.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3" data-aos="fade-up" data-aos-delay="200">
                            <div class="card" style="place-items: center; padding: 40px 10px;">
                                <i style="font-size: 90px;" class="fa fa-download mb-1" :class="$store.global.isDarkModeEnabled ? 'text-gray-100' : 'text-gray-800'"></i>
                                <p style="font-size: 17px; line-height: 1.3; text-align:center; margin-top: 10px;">
                                    Materiales disponibles para descarga inmediata.
                                </p>
                            </div>
                        </div>
                        <div class="col-md-3" data-aos="fade-up" data-aos-delay="300">
                            <div class="card" style="place-items: center; padding: 40px 10px;">
                                <i style="font-size: 90px;"  class="fa fa-certificate mb-1" :class="$store.global.isDarkModeEnabled ? 'text-gray-100' : 'text-gray-800'"></i>
                                <p style="font-size: 17px; line-height: 1.3; text-align:center; margin-top: 10px;">
                                    Certificado de <br>participación.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="container-fluid  card" data-aos="fade-up">
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
                                <img style="width: 100%;" src="{{ asset('themes/webpage/images/certificado.jpg') }}"
                                    alt="">
                                <p style="font-size: 17px; line-height: 1.3; margin-top: 10px;">
                                    <b>* IMAGEN REFERENCIAL</b>
                                </p>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>

                <main class="main-content w-full px-[var(--margin-x)] pb-8" data-aos="fade-up">
                    <section class="padding: 30px 0px;">
                        <div class="container">

                            <div class="row">
                                @if ($course->price)
                                    <div class="col-md-6" style="padding: 10px 0px;">
                                        <a
                                            onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                                            <button class="boton-degradado-courses">
                                                <b>
                                                    <i class="fa fa-cart-plus" aria-hidden="true"
                                                        style="font-size: 16px;"></i>
                                                    &nbsp; Añadir al Carrito
                                                </b>
                                            </button>
                                        </a>
                                    </div>
                                @else
                                    <div class="col-md-6" style="padding: 10px 0px;">
                                        <a href="">
                                            <button class="boton-degradado-courses">
                                                <b>
                                                    <i class="fa fa-edit" aria-hidden="true"
                                                        style="font-size: 16px;"></i>
                                                    &nbsp; Registrarme
                                                </b>
                                            </button>
                                        </a>
                                    </div>
                                @endif
                                @if ($course->brochure->path_file)
                                    <div class="col-md-6" style="padding: 10px 0px;">
                                        <button class="boton-degradado-info" data-bs-target="#exampleModalToggle"
                                            data-bs-toggle="modal">
                                            <b>
                                                <i class="fa fa-edit" aria-hidden="true" style="font-size: 16px;"></i>
                                                &nbsp; Descargar brochure
                                            </b>
                                        </button>
                                    </div>
                                @endif

                            </div>
                        </div>
                    </section>

                </main>
            </div>
        </div>
        <!-- footer start-->
        <x-footer />
    </div>


    <!-- App Header Wrapper-->
    {{-- <x-nav /> --}}

    <!-- Sidebar -->
    {{-- <x-slidebar /> --}}

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
        let currentIndex = 0;
        const slides = document.querySelector('.slides');
        const totalSlides = document.querySelectorAll('.slide').length;

        function showNextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            const offset = -currentIndex * 100;
            slides.style.transform = `translateX(${offset}%)`;
        }

        setInterval(showNextSlide, 3000); // Cambia cada 3 segundos
    </script>


    <script>
        const headers = document.querySelectorAll('.accordion-header-aracode');
        headers.forEach(header => {
            header.addEventListener('click', function() {
                const content = this.nextElementSibling;
                const isVisible = content.style.maxHeight;

                // Ocultar todos los contenidos y resetear iconos
                document.querySelectorAll('.accordion-content-aracode').forEach(item => {
                    item.style.maxHeight = null;
                    item.style.padding = '0';
                    item.setAttribute('aria-hidden', 'true');
                });
                headers.forEach(h => {
                    h.classList.remove('active');
                    h.querySelector('.accordion-icon-aracode').textContent =
                        '►'; // Restablecer icono
                    h.setAttribute('aria-expanded', 'false');
                });

                // Mostrar el contenido del header clicado
                if (!isVisible) {
                    content.style.maxHeight = content.scrollHeight + "px";
                    content.style.padding = '15px';
                    this.classList.add('active'); // Añadir clase activa al encabezado clicado
                    this.querySelector('.accordion-icon-aracode').textContent =
                        '▼'; // Cambiar icono al expandido
                    this.setAttribute('aria-expanded', 'true');
                    content.setAttribute('aria-hidden', 'false');
                }
            });
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

            // Deshabilitar el botón
            var submitButton = document.getElementById('submitPageContactButton');
            submitButton.disabled = true;
            submitButton.style.opacity = 0.25;

            // Crear una nueva solicitud XMLHttpRequest
            var xhr = new XMLHttpRequest();

            // Configurar la solicitud POST al servidor
            xhr.open('POST', "{{ route('apisubscriber') }}", true);

            // Configurar la función de callback para manejar la respuesta
            xhr.onload = function() {
                // Habilitar nuevamente el botón
                submitButton.disabled = false;
                submitButton.style.opacity = 1;
                if (xhr.status === 200) {
                    var response = JSON.parse(xhr.responseText);
                    Swal.fire({
                        icon: 'success',
                        title: 'Enhorabuena',
                        text: response.message,
                        customClass: {
                            container: 'sweet-modal-zindex' // Clase personalizada para controlar el z-index
                        }
                    });
                    formulario.reset();
                } else if (xhr.status === 422) {
                    var errorResponse = JSON.parse(xhr.responseText);
                    // Maneja los errores de validación aquí, por ejemplo, mostrando los mensajes de error en algún lugar de tu página.
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
                const downloadUrl = "{{ $course->brochure->path_file }}";
                window.open(downloadUrl, '_blank'); // '_blank' abre en nueva pestaña

            };

            // Enviar la solicitud al servidor
            xhr.send(formData);
        });
    </script>

@stop
