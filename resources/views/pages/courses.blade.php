@extends('layouts.webpage')

@section('content')



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
            <div class="page-body">
                <div class="container-fluid"></div>
                <div class="container-fluid">
                    <br><br><br>
                    <img style="
                    width: 100%;"
                        src="{{ asset('themes/webpage/images/courses-page.jpg') }}" alt="">
                </div>
                <br>
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
                                        {{-- <li class="nav-item" role="presentation"><a class="f-w-600 nav-link "
                                                id="pills-blog-tab" data-bs-toggle="pill" href="#pills-blog" role="tab"
                                                aria-controls="pills-blog" aria-selected="true">Tipo </a>
                                        </li> --}}
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
                                                        {{-- <div class="col-xl-4 col-md-6 col-sm-12 course-card"> --}}
                                                        <div class="col-xl-4 col-md-6 col-sm-12 box-col-4">
                                                            <div class="card weekend-card">
                                                                <div class="card-body">
                                                                    <a
                                                                        href="{{ route('web_course_description', $item->id) }}">
                                                                        <img class="w-100 mb-3"
                                                                            src="{{ asset('storage/' . $item->course->image) }}"
                                                                            alt="">
                                                                    </a>
                                                                    <br>
                                                                    <span
                                                                        style="color: #6a4c93;">{{ $item->additional }}</span>
                                                                    <br>
                                                                    <a href="{{ route('web_course_description', $item->id) }}"
                                                                        style="text-decoration: none;">
                                                                        <h4 style=" height: 30px; color: #000;">
                                                                            {{ $item->name }}</h4>
                                                                    </a>
                                                                    <br>
                                                                    <div class="card">
                                                                        <div class="">
                                                                            <div class="btn-showcase">
                                                                                <a
                                                                                    href="{{ route('web_course_description', $item->id) }}">
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
                                                                                        &nbsp; S/ {{ $item->price }}
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



                                            {{-- <br>
                                            <div class="row widget-grid">
                                                @foreach ($courses->take(12) as $item)
                                                    <div class="col-xl-4 col-md-6 col-sm-12 box-col-4">
                                                        <div class="card weekend-card">
                                                            <div class="card-body">
                                                                <a href="{{ route('web_course_description', $item->id) }}">
                                                                    <img class="w-100 mb-3"
                                                                        src="{{ asset('storage/' . $item->course->image) }}"
                                                                        alt="">
                                                                </a>
                                                                <br>
                                                                <span style="color: #6a4c93;">{{ $item->additional }}</span>
                                                                <br>
                                                                <a href="{{ route('web_course_description', $item->id) }}"
                                                                    style="text-decoration: none;">
                                                                    <h4 style=" height: 30px; color: #000;">
                                                                        {{ $item->name }}</h4>
                                                                </a>
                                                                <br>
                                                                <div class="card">
                                                                    <div class="">
                                                                        <div class="btn-showcase">
                                                                            <a
                                                                                href="{{ route('web_course_description', $item->id) }}">
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
                                                                                    &nbsp; S/ {{ $item->price }}
                                                                                </button>
                                                                            </a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div> --}}

                                        </div>

                                        {{-- <div class="tab-pane fade " id="pills-blog" role="tabpanel"
                                            aria-labelledby="pills-blog-tab">
                                            <p>
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur similique
                                                at
                                                nostrum? Et sequi repellendus, illum, fuga officiis quos, quaerat provident
                                                iure eos enim maiores
                                                sint suscipit iste? Neque, hic?
                                            </p>
                                        </div> --}}

                                        @foreach ($types as $type)
                                            <div hidden class="tab-pane fade show active"
                                                id="{{ str_replace(' ', '', $type) }}" role="tabpanel"
                                                aria-labelledby="{{ str_replace(' ', '', $type) }}-tab">
                                                <br>
                                                <div class="row widget-grid">
                                                    @foreach ($courses as $item)
                                                        @if (strtolower($item->additional) == strtolower($type))
                                                            <div class="col-xl-4 col-md-6 col-sm-12 box-col-4">
                                                                <div class="card weekend-card">
                                                                    <div class="card-body">
                                                                        <a
                                                                            href="{{ route('web_course_description', $item->id) }}">
                                                                            <img class="w-100 mb-3"
                                                                                src="{{ asset('storage/' . $item->course->image) }}"
                                                                                alt="">
                                                                        </a>
                                                                        <br>
                                                                        <span
                                                                            style="color: #6a4c93;">{{ $item->additional }}</span>
                                                                        <br>
                                                                        <a href="{{ route('web_course_description', $item->id) }}"
                                                                            style="text-decoration: none;">
                                                                            <h4 style=" height: 30px; color: #000;">
                                                                                {{ $item->name }}</h4>
                                                                        </a>
                                                                        <br>
                                                                        <div class="card">
                                                                            <div class="">
                                                                                <div class="btn-showcase">
                                                                                    <a
                                                                                        href="{{ route('web_course_description', $item->id) }}">
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
                                                                                            &nbsp; S/ {{ $item->price }}
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



    <!-- App Header Wrapper-->
    {{-- <x-nav /> --}}

    <!-- Sidebar -->
    {{-- <x-slidebar /> --}}

    {{-- <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="mt-5 w-full transition-all duration-[.25s] sm:mt-5 lg:mt-6">
            <div style="text-align:center;">
                <h1 class="title_aracode" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                    FORMACIÓN QUE TRANSFORMA TU TALENTO <br>EN RESULTADOS REALES
                </h1>
            </div>
            <br>
            <div x-data="{ activeTab: 'tabAll' }" class="tabs flex flex-col">
                <div
                    class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200">
                    <div class="tabs-list flex px-1.5 py-1">
                        <button @click="activeTab = 'tabAll'"
                            :class="activeTab === 'tabAll' ?
                                'bg-white shadow dark:bg-navy-500 dark:text-navy-100' :
                                'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                            class="btn shrink-0 px-3 py-1.5 font-medium">
                            Todos
                        </button>

                        @foreach ($types as $type)
                            <button @click="activeTab = '{{ $type }}'"
                                :class="activeTab === '{{ $type }}' ?
                                    'bg-white shadow dark:bg-navy-500 dark:text-navy-100' :
                                    'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                class="btn shrink-0 px-3 py-1.5 font-medium">
                                {{ $type }}
                            </button>
                        @endforeach
                    </div>
                </div>
                <div class="tab-content pt-4">
                    <div x-show="activeTab === 'tabAll'" x-transition:enter="transition-all duration-500 easy-in-out"
                        x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                        x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                        <div>
                            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6">
                                @foreach ($courses as $item)
                                    <div class="card group p-3">
                                        <div class="flex items-center justify-between space-x-2 px-1">
                                            <div class="flex items-center space-x-2">
                                                <div class="avatar size-9">
                                                    <img class="rounded-full"
                                                        src="{{ isset($item->course->teacher->person->image) ? asset('storage/' . $item->course->teacher->person->image) : '' }}"
                                                        alt="avatar">
                                                </div>
                                                <div>
                                                    <a href="#"
                                                        class="font-medium text-slate-600 line-clamp-1 dark:text-navy-100">
                                                        {{ $item->course->teacher->person->names . ' ' . $item->course->teacher->person->father_lastname }}
                                                    </a>
                                                    <a href="">
                                                        <p class="text-xs text-primary dark:text-accent-light">
                                                            Ver Perfil
                                                        </p>
                                                    </a>
                                                </div>
                                            </div>
                                            <a href="">
                                                <button
                                                    class="btn size-9 bg-slate-150 p-0 text-slate-800 hover:bg-slate-200 focus:bg-slate-200
                                        active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                                    <i class="fa fa-user" aria-hidden="true"
                                                        style="font-size: 16px;"></i>
                                                </button>
                                            </a>
                                        </div>
                                        <div class="relative mt-4">
                                            <img class="rounded-lg object-cover object-center"
                                                src="{{ asset('storage/' . $item->course->image) }}" alt="image">
                                            <div
                                                class="absolute top-0 h-full w-full rounded-lg bg-black/20 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                            </div>
                                            <div
                                                class="absolute top-0 flex h-full w-full items-center justify-center opacity-0 group-hover:opacity-100">
                                                <a href="{{ route('web_course_description', $item->id) }}">
                                                    <button
                                                        class="btn min-w-[7rem] border border-white/10 bg-white/20 text-white backdrop-blur hover:bg-white/30 focus:bg-white/30">
                                                        Más Información
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                        <div class="mt-3 px-1">
                                            <p class="text-xs text-primary dark:text-accent-light">
                                                {{ $item->additional }}
                                            </p>
                                            <a href="{{ route('web_course_description', $item->id) }}"
                                                class="text-base font-medium text-slate-700 line-clamp-1 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
                                                {{ $item->name }}
                                            </a>
                                            <div class="my-3 h-px bg-slate-200 dark:bg-navy-500"></div>
                                            <div class="flex justify-between">
                                                <div>
                                                    <a href="{{ route('web_course_description', $item->id) }}">
                                                        <button class="boton-degradado-info"><b>Más
                                                                Información</b></button>
                                                    </a>
                                                </div>
                                                <div class="text-right">
                                                    <a
                                                        onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                                                        <button class="boton-degradado-courses">
                                                            <b>
                                                                <i class="fa fa-cart-plus" aria-hidden="true"
                                                                    style="font-size: 16px;"></i>
                                                                &nbsp; S/ {{ $item->price }}
                                                            </b>
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    @foreach ($types as $type)
                        <div x-show="activeTab === '{{ $type }}'"
                            x-transition:enter="transition-all duration-500 easy-in-out"
                            x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                            x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                            <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6">
                                @foreach ($courses as $item)
                                    @if (strtolower($item->additional) == strtolower($type))
                                        <div class="card group p-3">
                                            <div class="flex items-center justify-between space-x-2 px-1">
                                                <div class="flex items-center space-x-2">
                                                    <div class="avatar size-9">
                                                        <img class="rounded-full"
                                                            src="{{ isset($item->course->teacher->person->image) ? asset('storage/' . $item->course->teacher->person->image) : '' }}"
                                                            alt="avatar">
                                                    </div>
                                                    <div>
                                                        <a href="#"
                                                            class="font-medium text-slate-600 line-clamp-1 dark:text-navy-100">
                                                            {{ $item->course->teacher->person->names . ' ' . $item->course->teacher->person->father_lastname }}
                                                        </a>
                                                        <a href="">
                                                            <p class="text-xs text-primary dark:text-accent-light">
                                                                Ver Perfil
                                                            </p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <a href="">
                                                    <button
                                                        class="btn size-9 bg-slate-150 p-0 text-slate-800 hover:bg-slate-200 focus:bg-slate-200
                                            active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                                        <i class="fa fa-user" aria-hidden="true"
                                                            style="font-size: 16px;"></i>
                                                    </button>
                                                </a>
                                            </div>
                                            <div class="relative mt-4">
                                                <img class="rounded-lg object-cover object-center"
                                                    src="{{ asset('storage/' . $item->course->image) }}" alt="image">
                                                <div
                                                    class="absolute top-0 h-full w-full rounded-lg bg-black/20 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                                                </div>
                                                <div
                                                    class="absolute top-0 flex h-full w-full items-center justify-center opacity-0 group-hover:opacity-100">
                                                    <a href="{{ route('web_course_description', $item->id) }}">
                                                        <button
                                                            class="btn min-w-[7rem] border border-white/10 bg-white/20 text-white backdrop-blur hover:bg-white/30 focus:bg-white/30">
                                                            Más Información
                                                        </button>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="mt-3 px-1">
                                                <p class="text-xs text-primary dark:text-accent-light">
                                                    {{ $item->additional }}
                                                </p>
                                                <a href="{{ route('web_course_description', $item->id) }}"
                                                    class="text-base font-medium text-slate-700 line-clamp-1 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
                                                    {{ $item->name }}
                                                </a>
                                                <div class="my-3 h-px bg-slate-200 dark:bg-navy-500"></div>
                                                <div class="flex justify-between">
                                                    <div>
                                                        <a href="{{ route('web_course_description', $item->id) }}">
                                                            <button class="boton-degradado-info"><b>Más
                                                                    Información</b></button>
                                                        </a>
                                                    </div>
                                                    <div class="text-right">
                                                        <a
                                                            onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                                                            <button class="boton-degradado-courses">
                                                                <b>
                                                                    <i class="fa fa-cart-plus" aria-hidden="true"
                                                                        style="font-size: 16px;"></i>
                                                                    &nbsp; S/ {{ $item->price }}
                                                                </b>
                                                                @if ($item->price < 1)
                                                                    <button><b> <a
                                                                                href="{{ route('register') }}">Registrate
                                                                                Gratis</a> </b></button>
                                                                @endif
                                                            </button>
                                                        </a>
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
        </div>
        <br>
        <div class="mt-4 w-full transition-all duration-[.25s] sm:mt-5 lg:mt-6">
            <x-social-networks />
        </div>

        <x-footer />

    </main> --}}


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
        window.onload = function() {
            // Espera 1 segundo para mejorar la experiencia de usuario
            setTimeout(function() {
                // Redirecciona a la misma URL con el fragmento #todos al final
                window.location.href = window.location.href.split('#')[0] + '#todos';
            }, 500);
        };

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

@stop
