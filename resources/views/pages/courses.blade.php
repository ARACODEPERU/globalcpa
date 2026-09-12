@extends('layouts.webpage')

@section('title', ' - Cursos')

@section('etiquetasmeta')
    <x-seo
        title="Cursos y Programas de Especialización - CPA Academy"
        description="Explora los cursos y programas de especialización de CPA Academy en NIIF, auditoría, finanzas, tributación y costos. Modalidad presencial y online con respaldo ACCA."
    />
@endsection

@section('content')

    <style>
        /* =========================================
           HERO DE CURSOS (estilo institucional del sitio)
           ========================================= */
        .crs-hero {
            background: linear-gradient(135deg, #002060 0%, #004080 100%);
            border-radius: 20px;
            border: 0;
            overflow: hidden;
            position: relative;
        }
        .crs-hero::after {
            content: '';
            position: absolute;
            top: -80px;
            right: -80px;
            width: 300px;
            height: 300px;
            background: radial-gradient(circle, rgba(227, 6, 19, 0.25) 0%, rgba(0, 32, 96, 0) 70%);
            pointer-events: none;
        }
        .crs-hero-tag {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
            color: #ffffff;
            font-size: 14px;
            font-weight: 600;
        }
        .crs-hero-btn {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 22px;
            border-radius: 50px;
            background: #ffc107;
            color: #002060;
            font-weight: 700;
            border: 0;
            text-decoration: none;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
        }
        .crs-hero-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(255, 193, 7, 0.35);
            color: #002060;
        }
    </style>

    {{-- Schema markup (JSON-LD): listado de cursos --}}
    @if (!empty($coursesSchema))
        <script type="application/ld+json">
            {!! json_encode($coursesSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) !!}
        </script>
    @endif

    <!-- Loader starts-->
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
            <div class="page-body">
                <div class="container-fluid"></div>
                <div class="container-fluid mt-5">
                    <div class="card crs-hero shadow mb-4" data-aos="fade-in">
                        <div class="card-body p-4 p-lg-5 position-relative">
                            <div class="row align-items-center">
                                <div class="col-lg-8">
                                    <nav aria-label="breadcrumb" class="mb-3">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item">
                                                <a href="{{ route('index_main') }}"
                                                    class="text-white-50 text-decoration-none text-uppercase small fw-bold"
                                                    style="letter-spacing: 1px;">
                                                    <i class="fa fa-home me-1"></i> Inicio
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active text-white text-uppercase small fw-bold"
                                                style="letter-spacing: 1px;" aria-current="page">
                                                Cursos
                                            </li>
                                        </ol>
                                    </nav>

                                    <h1 class="display-4 fw-bold text-white mb-3">
                                        Explora nuestros <span class="text-warning">cursos</span>
                                    </h1>
                                    <p class="lead text-white-50 mb-4" style="max-width: 620px; line-height: 1.6;">
                                        Especializaciones en tributación, NIIF, auditoría, finanzas y costos,
                                        dictadas por docentes en ejercicio y con certificación con respaldo internacional.
                                    </p>

                                    <div class="d-flex flex-wrap gap-3 mb-4">
                                        <span class="crs-hero-tag">
                                            <i class="fa fa-book text-warning"></i>
                                            {{ $courses->count() }} programas disponibles
                                        </span>
                                        <span class="crs-hero-tag">
                                            <i class="fa fa-user-tie text-warning"></i>
                                            Docentes expertos en ejercicio
                                        </span>
                                        <span class="crs-hero-tag">
                                            <i class="fa fa-certificate text-warning"></i>
                                            Certificación con respaldo
                                        </span>
                                    </div>

                                    <button type="button" class="crs-hero-btn"
                                        onclick="document.querySelector('.dashboard_default').scrollIntoView({ behavior: 'smooth', block: 'start' });">
                                        Explorar catálogo <i class="fa fa-arrow-down"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid starts-->
                <div class="container-fluid dashboard_default">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card height-equal" style="min-height: 310.797px; background: none;">
                                <div class="card-body">
                                    <ul class="nav nav-pills nav-primary" id="pills-tab" role="tablist">

                                        <li class="nav-item" role="presentation">
                                            <a class="f-w-600 nav-link active" id="todos-tab" data-bs-toggle="pill"
                                                onclick="show_paginator()" href="#todos" role="tab"
                                                aria-controls="todos" aria-selected="false" tabindex="-1">Todos
                                            </a>
                                        </li>
                                        @foreach ($types as $type)
                                            <li class="nav-item" role="presentation">
                                                <a class="f-w-600 nav-link "
                                                    onclick="unhidden('{{ str_replace(' ', '', $type) }}')"
                                                    id="{{ str_replace(' ', '', $type) }}-tab" data-bs-toggle="pill"
                                                    href="#{{ str_replace(' ', '', $type) }}" role="tab"
                                                    aria-controls="{{ str_replace(' ', '', $type) }}" aria-selected="true">
                                                    {{ $type }}
                                                </a>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="todos" role="tabpanel"
                                            aria-labelledby="todos-tab">

                                            @php
                                                $xx = count($courses);
                                                $yy = $xx / $p; //$p paginacion
                                                $yy = ceil($yy);
                                            @endphp


                                            <br>
                                            @for ($i = 0; $i < $yy; $i++)
                                                <div class="row widget-grid page-group page-{{ $i + 1 }}"
                                                    id="course-list" style="display: {{ $i + 1 == 1 ? '' : 'none' }};">

                                                    @foreach ($courses->skip($p * $i)->take($p) as $item)
                                                        @php
                                                            $courseUrl = filled($item->course?->landing?->url_slug) && ($item->course?->landing?->is_published ?? false)
                                                                ? route('course_url_slug', $item->course->landing->url_slug)
                                                                : route('web_course_description', $item->id);
                                                        @endphp
                                                        <div class="col-xl-4 col-md-6 col-sm-12 box-col-4">
                                                            <div class="card weekend-card">
                                                                <div class="card-body">
                                                                    <a href="{{ $courseUrl }}">
                                                                        @if($item->course?->image)
                                                                        <img class="w-100 mb-3"
                                                                            src="{{ asset('storage/' . $item->course->image) }}"
                                                                            alt="{{ $item->course->name ?? 'Imagen' }}">
                                                                    @endif
                                                                    </a>
                                                                    <br>
                                                                    <span
                                                                        style="color: #e30613;">{{ $item->additional }}</span>
                                                                    <br>
                                                                    <a href="{{ $courseUrl }}"
                                                                        style="text-decoration: none;">
                                                                        <h4 style=" height: 30px;">
                                                                            {{ $item->name }}</h4>
                                                                    </a>
                                                                    <br>
                                                                    <div class="card">
                                                                        <div class="">
                                                                            <div class="btn-showcase">
                                                                                <a href="{{ $courseUrl }}">
                                                                                    <button
                                                                                        class="btn btn-pill btn-light btn-air-light btn-sm"
                                                                                        type="button"
                                                                                        data-bs-original-title="btn btn-pill btn-light btn-air-light btn-sm">
                                                                                        Leer Más
                                                                                    </button>
                                                                                </a>
                                                                                <a
                                                                                    onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                                                                                    <button
                                                                                        class="btn btn-pill btn-primary btn-air-primary btn-sm"
                                                                                        type="button"
                                                                                        data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                                                                        <i class="fa fa-cart-plus"
                                                                                            aria-hidden="true"
                                                                                            style="font-size: 18px;"></i>
                                                                                        &nbsp; {{ (float) $item->price <= 0 ? 'Gratis' : 'S/ ' . $item->price }}
                                                                                    </button>
                                                                                </a>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endfor




                                        </div>


                                        @foreach ($types as $type)
                                            <div hidden class="tab-pane fade show active"
                                                id="{{ str_replace(' ', '', $type) }}" role="tabpanel"
                                                aria-labelledby="{{ str_replace(' ', '', $type) }}-tab">
                                                <br>
                                                <div class="row widget-grid">
                                                    @foreach ($courses as $item)
                                                        @if (strtolower($item->additional) == strtolower($type))
                                                            @php
                                                                $courseUrl = filled($item->course?->landing?->url_slug) && ($item->course?->landing?->is_published ?? false)
                                                                    ? route('course_url_slug', $item->course->landing->url_slug)
                                                                    : route('web_course_description', $item->id);
                                                            @endphp
                                                            <div class="col-xl-4 col-md-6 col-sm-12 box-col-4">
                                                                <div class="card weekend-card">
                                                                    <div class="card-body">
                                                                        <a href="{{ $courseUrl }}">
                                                                            @if($item->course?->image)
                                                                            {{-- Si hay imagen, la mostramos --}}
                                                                            <img class="w-100 mb-3"
                                                                                 src="{{ asset('storage/' . $item->course->image) }}"
                                                                                 alt="{{ $item->course->name }}">
                                                                        @else
                                                                            {{-- Si NO hay imagen (o no hay curso), mandamos el log para investigar --}}
                                                                            <script>
                                                                                console.warn("⚠️ Item sin imagen detectado (ID: {{ $item->id ?? 'N/A' }}):", @json($item));
                                                                            </script>
                                                                        @endif
                                                                        </a>
                                                                        <br>
                                                                        <span
                                                                            style="color: #6a4c93;">{{ $item->additional }}</span>
                                                                        <br>
                                                                        <a href="{{ $courseUrl }}"
                                                                            style="text-decoration: none;">
                                                                            <h4 style=" height: 30px; color: #000;">
                                                                                {{ $item->name }}</h4>
                                                                        </a>
                                                                        <br>
                                                                        <div class="card">
                                                                            <div class="">
                                                                                <div class="btn-showcase">
                                                                                    <a href="{{ $courseUrl }}">
                                                                                        <button
                                                                                            class="btn btn-pill btn-light btn-air-light btn-sm"
                                                                                            type="button"
                                                                                            data-bs-original-title="btn btn-pill btn-light btn-air-light btn-sm">
                                                                                            Leer Más
                                                                                        </button>
                                                                                    </a>
                                                                                    <a
                                                                                        onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                                                                                        <button
                                                                                            class="btn btn-pill btn-primary btn-air-primary btn-sm"
                                                                                            type="button"
                                                                                            data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                                                                            <i class="fa fa-cart-plus"
                                                                                                aria-hidden="true"
                                                                                                style="font-size: 18px;"></i>
                                                                                            &nbsp; {{ (float) $item->price <= 0 ? 'Gratis' : 'S/ ' . $item->price }}
                                                                                        </button>
                                                                                    </a>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>

                                </div>




                                <div class="row" id="paginator">
                                    <div class="col-md-12">
                                        <div class="card-body pagination-container">
                                            <nav aria-label="...">
                                                <ul class="pagination pagination-success pagin-border-success">
                                                    <li class="page-item disabled" id="prev-page">
                                                        <a class="page-link" href="javascript:void(0)"
                                                            tabindex="-1">Previo</a>
                                                    </li>
                                                    @for ($i = 0; $i < $yy; $i++)
                                                        <li class="page-item">
                                                            <a class="pagination-link page-link"
                                                                data-page="{{ $i + 1 }}">{{ $i + 1 }}</a>
                                                        </li>
                                                    @endfor
                                                    <li class="page-item" id="next-page">
                                                        <a class="page-link" href="javascript:void(0)">Siguiente</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer start-->
        <x-footer />
    </div>





    <script>
        // Código legacy del slider que no existe en esta página: deshabilitado para evitar errores
        // let currentIndex = 0;
        // const slides = document.querySelector('.slides');
        // const totalSlides = document.querySelectorAll('.slide').length;
        // function showNextSlide() { /* ... */ }
        // setInterval(showNextSlide, 3000);
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
        // window.onload = function() {
        //     // Espera 1 segundo para mejorar la experiencia de usuario
        //     setTimeout(function() {
        //         // Redirecciona a la misma URL con el fragmento #todos al final
        //         window.location.href = window.location.href.split('#')[0] + '#todos';
        //     }, 500);
        // };

        function unhidden(id) {
            // 1. Obtener el elemento por su ID
            const miElemento = document.getElementById(id);

            // 2. Eliminar el atributo 'hidden'
            miElemento.removeAttribute('hidden');
            document.getElementById('paginator').hidden = true;
        }

        function show_paginator() {
            document.getElementById('paginator').removeAttribute('hidden');
        }
    </script>

    <script>
        //codigo del paginador
        document.addEventListener('DOMContentLoaded', function() {
            // Selectores para todos los elementos necesarios
            const paginationLinks = document.querySelectorAll('.pagination-link');
            const prevPageBtn = document.getElementById('prev-page');
            const nextPageBtn = document.getElementById('next-page');
            const totalPages = paginationLinks.length;
            let currentPage = 1;

            // Función para mostrar la página correcta y actualizar los botones
            function updatePagination(newPage) {
                // Asegurarse de que la página no exceda los límites
                if (newPage < 1) {
                    newPage = 1;
                } else if (newPage > totalPages) {
                    newPage = totalPages;
                }
                currentPage = newPage;

                // Ocultar todas las páginas de contenido
                const allPages = document.querySelectorAll('.page-group');
                allPages.forEach(page => {
                    page.style.display = 'none';
                });

                // Mostrar la página seleccionada
                const selectedPage = document.querySelector(`.page-${currentPage}`);
                if (selectedPage) {
                    selectedPage.style.display = '';
                }

                // Actualizar el estado de los botones de números de página
                paginationLinks.forEach(pLink => {
                    pLink.parentElement.classList.remove('active');
                    if (parseInt(pLink.getAttribute('data-page')) === currentPage) {
                        pLink.parentElement.classList.add('active');
                    }
                });

                // Actualizar el estado de los botones "Previous" y "Next"
                if (currentPage === 1) {
                    prevPageBtn.classList.add('disabled');
                } else {
                    prevPageBtn.classList.remove('disabled');
                }

                if (currentPage === totalPages) {
                    nextPageBtn.classList.add('disabled');
                } else {
                    nextPageBtn.classList.remove('disabled');
                }
            }

            // Event Listeners para los botones de números de página
            paginationLinks.forEach(link => {
                link.addEventListener('click', function(event) {
                    event.preventDefault();
                    const pageNumber = parseInt(this.getAttribute('data-page'));
                    updatePagination(pageNumber);
                });
            });

            // Event Listener para el botón "Previous"
            prevPageBtn.addEventListener('click', function(event) {
                event.preventDefault();
                // Solo si el botón no está deshabilitado
                if (!this.classList.contains('disabled')) {
                    updatePagination(currentPage - 1);
                }
            });

            // Event Listener para el botón "Next"
            nextPageBtn.addEventListener('click', function(event) {
                event.preventDefault();
                // Solo si el botón no está deshabilitado
                if (!this.classList.contains('disabled')) {
                    updatePagination(currentPage + 1);
                }
            });

            // Inicializar la paginación al cargar la página (mostrar la primera página)
            updatePagination(1);
        });
    </script>

    <script>
        $(document).ready(function() {
            // Inicializar AOS para las animaciones del hero y las tarjetas
            if (window.AOS !== undefined) {
                AOS.init({
                    mirror: false,
                    duration: 800,
                    once: true
                });
                AOS.refresh();
            }
        });
    </script>

@stop
