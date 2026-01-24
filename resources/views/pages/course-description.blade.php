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
                                        <span class="badge bg-warning text-dark me-2">Curso Online</span>
                                        <div class="text-warning small">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star-half-o"></i>
                                            {{-- <span class="text-white ms-1">(4.8/5 de 120 alumnos)</span> --}}
                                            <span class="text-white ms-1">(4.8/5 de 120 alumnos)</span>
                                        </div>
                                    </div>
                                    <h1 class="display-5 fw-bold mb-3" style="color: #fff;">{{ $item->name }}</h1>
                                    <p class="lead text-white-50 mb-4">{{ $item->description }}</p>
                                    <div class="d-flex align-items-center text-white-50 small">
                                        <span class="me-3"><i class="fa fa-clock-o me-1"></i> Actualizado:
                                            {{ \Carbon\Carbon::now()->format('M Y') }}</span>
                                        <span><i class="fa fa-globe me-1"></i> Español</span>
                                    </div>
                                </div>
                                <div class="col-lg-4 text-center d-none d-lg-block position-relative" style="min-height: 250px;">
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
                                        .orbit-item i { animation: orbit-counter-spin 25s linear infinite; }
                                        
                                        /* Posiciones fijas en la órbita (triángulo equilátero) */
                                        .pos-1 { transform: rotate(0deg) translate(120px) rotate(0deg); }
                                        .pos-2 { transform: rotate(120deg) translate(120px) rotate(-120deg); }
                                        .pos-3 { transform: rotate(240deg) translate(120px) rotate(-240deg); }

                                        .center-pulse {
                                            position: absolute;
                                            top: 50%;
                                            left: 50%;
                                            transform: translate(-50%, -50%);
                                            animation: center-pulse-anim 3s ease-in-out infinite;
                                        }

                                        @keyframes orbit-spin { 100% { transform: translate(-50%, -50%) rotate(360deg); } }
                                        @keyframes orbit-counter-spin { 100% { transform: rotate(-360deg); } }
                                        @keyframes center-pulse-anim {
                                            0%, 100% { transform: translate(-50%, -50%) scale(1); opacity: 0.3; }
                                            50% { transform: translate(-50%, -50%) scale(1.05); opacity: 0.7; text-shadow: 0 0 15px rgba(255,255,255,0.3); }
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

                    <div class="row">
                        {{-- Columna Izquierda --}}
                        <div class="col-lg-8">
                            {{-- Presentación --}}
                            <div class="card shadow-sm border-0 mb-4" data-aos="fade-up">
                                <div class="card-body p-4">
                                    <h3 class="fw-bold mb-4 border-bottom pb-2"
                                        :class="$store.global.isDarkModeEnabled ? 'text-gray-100' : 'text-gray-800'">
                                        Descripción del Curso</h3>
                                    @if ($course->brochure)
                                        <div class="course-content" style="font-size: 1.05rem; line-height: 1.7;"
                                            :class="$store.global.isDarkModeEnabled ? 'text-gray-300' : 'text-gray-600'">
                                            {!! $course->brochure->presentation !!}
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Facilitadores Propuesta 2 --}}
                            <div class="card shadow-sm border-0 mb-4" data-aos="fade-up">
                                <div class="card-body p-4">
                                    <h3 class="fw-bold mb-4 border-bottom pb-2"
                                        :class="$store.global.isDarkModeEnabled ? 'text-gray-100' : 'text-gray-800'">
                                        Tus Instructores
                                    </h3>
                                    
                                    @if (count($course->teachers) > 0)
                                        <div class="d-flex flex-column gap-4">
                                            @foreach ($course->teachers as $teach)
                                                <div class="d-flex flex-column flex-md-row p-4 rounded border"
                                                    :class="$store.global.isDarkModeEnabled ? 'bg-dark border-secondary' : 'bg-light shadow-sm'">
                                                    
                                                    <div class="flex-shrink-0 mb-3 mb-md-0 me-md-4 text-center">
                                                        <img class="rounded-circle shadow-sm"
                                                            style="width: 100px; height: 100px; object-fit: cover;"
                                                            src="{{ asset('storage/' . $teach->teacher->person->image) }}"
                                                            alt="{{ $teach->teacher->person->names }}">
                                                        <div class="mt-2">
                                                            <span class="badge bg-primary bg-opacity-10 text-[#fff]">Facilitador Experto</span>
                                                        </div>
                                                    </div>

                                                    <div class="flex-grow-1">
                                                        <h5 class="fw-bold mb-1"
                                                            :class="$store.global.isDarkModeEnabled ? 'text-gray-100' : 'text-gray-800'">
                                                            {{ $teach->teacher->person->names }} {{ $teach->teacher->person->father_lastname }}
                                                        </h5>
                                                        
                                                        <div class="mt-3">
                                                            @if (count($teach->teacher->person->resumes))
                                                                <ul class="list-unstyled mb-0">
                                                                    @foreach ($teach->teacher->person->resumes as $resume)
                                                                        <li class="d-flex align-items-start mb-2"
                                                                            :class="$store.global.isDarkModeEnabled ? 'text-gray-300' : 'text-muted'">
                                                                            <i class="fa fa-check-circle text-success mt-1 me-2 flex-shrink-0"></i>
                                                                            <span>{{ $resume->description }}</span>
                                                                        </li>
                                                                    @endforeach
                                                                </ul>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    @endif
                                </div>
                            </div>

                            {{-- Reviews Section --}}
                            <div class="card shadow-sm border-0 mb-4" data-aos="fade-up">
                                <div class="card-body p-4">
                                    <h3 class="fw-bold mb-4 border-bottom pb-2"
                                        :class="$store.global.isDarkModeEnabled ? 'text-gray-100' : 'text-gray-800'">
                                        Opiniones de Estudiantes</h3>
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="p-3 rounded"
                                                :class="$store.global.isDarkModeEnabled ? 'bg-dark border border-secondary' :
                                                    'bg-light'">
                                                <div class="text-warning mb-2"><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                                <p class="mb-2 fst-italic"
                                                    :class="$store.global.isDarkModeEnabled ? 'text-gray-100' : 'text-muted'">
                                                    "Excelente curso, muy completo y práctico."</p>
                                                <small class="fw-bold"
                                                    :class="$store.global.isDarkModeEnabled ? 'text-gray-400' : 'text-muted'">-
                                                    Juan Pérez</small>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="p-3 rounded"
                                                :class="$store.global.isDarkModeEnabled ? 'bg-dark border border-secondary' :
                                                    'bg-light'">
                                                <div class="text-warning mb-2"><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i><i
                                                        class="fa fa-star"></i><i class="fa fa-star"></i></div>
                                                <p class="mb-2 fst-italic"
                                                    :class="$store.global.isDarkModeEnabled ? 'text-gray-100' : 'text-muted'">
                                                    "Los instructores explican muy bien."</p>
                                                <small class="fw-bold"
                                                    :class="$store.global.isDarkModeEnabled ? 'text-gray-400' : 'text-muted'">-
                                                    Maria Rodriguez</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        {{-- Columna Derecha (Sticky Sidebar) --}}
                        <div class="col-lg-4">
                            <div class="sticky-top" style="top: 100px; z-index: 1;">
                                <div class="card shadow border-0" data-aos="fade-left">
                                <div class="position-relative">
                                    <img src="{{ asset('storage/' . $item->course->image) }}" class="card-img-top"
                                        alt="portada_curso">
                                </div>
                                <div class="card-body p-4">
                                    <div class="mb-4">
                                        @if ($item->price)
                                            <h2 class="fw-bold mb-0 display-6"
                                                :class="$store.global.isDarkModeEnabled ? 'text-gray-100' : 'text-gray-800'">
                                                S/ {{ $item->price }}</h2>
                                        @else
                                            <h2 class="fw-bold text-success mb-0 display-6">Gratis</h2>
                                        @endif
                                        <span class="small"
                                            :class="$store.global.isDarkModeEnabled ? 'text-gray-400' : 'text-muted'"><i
                                                class="fa fa-clock-o"></i> Oferta por tiempo limitado</span>
                                    </div>

                                    <div class="d-grid gap-2 mb-4">
                                        @if ($item->price)
                                            <button class="btn btn-primary btn-lg fw-bold shadow-sm py-3"
                                                onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                                                Añadir al Carrito
                                            </button>
                                        @else
                                            <a href="" class="btn btn-primary btn-lg fw-bold shadow-sm py-3">
                                                Inscribirme Gratis
                                            </a>
                                        @endif
                                    </div>

                                    <div class="mb-4">
                                        <h6 class="fw-bold mb-3"
                                            :class="$store.global.isDarkModeEnabled ? 'text-gray-100' : 'text-gray-800'">
                                            Este curso incluye:</h6>
                                        <ul class="list-unstyled mb-0">
                                            <li class="mb-2 d-flex align-items-center"
                                                :class="$store.global.isDarkModeEnabled ? 'text-gray-300' : 'text-muted'">
                                                <i class="fa fa-video-camera text-secondary me-3"
                                                    style="width: 20px; text-align:center;"></i> <span>Acceso de por
                                                    vida</span>
                                            </li>
                                            <li class="mb-2 d-flex align-items-center"
                                                :class="$store.global.isDarkModeEnabled ? 'text-gray-300' : 'text-muted'">
                                                <i class="fa fa-mobile text-secondary me-3"
                                                    style="width: 20px; text-align:center;"></i> <span>Acceso en móviles y
                                                    TV</span>
                                            </li>
                                            <li class="mb-2 d-flex align-items-center"
                                                :class="$store.global.isDarkModeEnabled ? 'text-gray-300' : 'text-muted'">
                                                <i class="fa fa-certificate text-secondary me-3"
                                                    style="width: 20px; text-align:center;"></i> <span>Certificado de
                                                    finalización</span>
                                            </li>
                                            @if ($course->brochure->path_file)
                                                <li class="mb-2 d-flex align-items-center"
                                                    :class="$store.global.isDarkModeEnabled ? 'text-gray-300' : 'text-muted'">
                                                    <i class="fa fa-file-pdf-o text-secondary me-3"
                                                        style="width: 20px; text-align:center;"></i> <span>Recursos
                                                        descargables</span>
                                                </li>
                                            @endif
                                        </ul>
                                    </div>

                                    @if ($course->brochure->path_file)
                                        <div class="text-center border-top pt-3">
                                            <a href="#" class="text-decoration-none fw-bold text-primary"
                                                data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                                                <i class="fa fa-download me-1"></i> Descargar Temario (PDF)
                                            </a>
                                        </div>
                                    @endif
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

                {{-- Mobile Sticky CTA Bar --}}
                <div class="d-block d-lg-none fixed-bottom border-top shadow p-3" style="z-index: 1050;"
                    :class="$store.global.isDarkModeEnabled ? 'bg-dark' : 'bg-white'">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <span class="d-block small"
                                :class="$store.global.isDarkModeEnabled ? 'text-gray-400' : 'text-muted'">Precio:</span>
                            @if ($item->price)
                                <span class="fw-bold fs-4"
                                    :class="$store.global.isDarkModeEnabled ? 'text-white' : 'text-dark'">S/
                                    {{ $item->price }}</span>
                            @else
                                <span class="fw-bold text-success fs-4">Gratis</span>
                            @endif
                        </div>
                        <div>
                            @if ($item->price)
                                <button class="btn btn-primary fw-bold px-4"
                                    onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                                    Comprar
                                </button>
                            @else
                                <a href="" class="btn btn-primary fw-bold px-4">
                                    Inscribirme
                                </a>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Modal for Brochure --}}
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
