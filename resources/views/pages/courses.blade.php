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
                <br>
                <!-- Container-fluid starts-->
                <div class="container-fluid dashboard_default">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card height-equal" style="min-height: 310.797px; background: none;">
                                <div class="card-header card-no-border pb-0" style="background: none;">
                                    <h3>Formación que transforma tu talento en resultados reales</h3>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-pills nav-primary" id="pills-tab" role="tablist">

                                        <li class="nav-item" role="presentation">
                                            <a class="f-w-600 nav-link active" id="pills-aboutus-tab" data-bs-toggle="pill"
                                                href="#pills-aboutus" role="tab" aria-controls="pills-aboutus"
                                                aria-selected="false" tabindex="-1">Todos
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation">
                                            <a class="f-w-600 nav-link" id="pills-contactus-tab" data-bs-toggle="pill"
                                                href="#pills-contactus" role="tab" aria-controls="pills-contactus"
                                                aria-selected="false" tabindex="-1">Tipo
                                            </a>
                                        </li>
                                        <li class="nav-item" role="presentation"><a class="f-w-600 nav-link "
                                                id="pills-blog-tab" data-bs-toggle="pill" href="#pills-blog" role="tab"
                                                aria-controls="pills-blog" aria-selected="true">Tipo </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-aboutus" role="tabpanel"
                                            aria-labelledby="pills-aboutus-tab">
                                            <br>
                                            <div class="row widget-grid">
                                                @foreach ($courses->take(15) as $item)
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
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="pills-contactus" role="tabpanel"
                                            aria-labelledby="pills-contactus-tab">
                                            <ul class="d-flex flex-column gap-1 pt-3">
                                                <li> Create professional web page design. Responsive, fully customizable
                                                    with easy Drag-n-Drop Nicepage editor. Adjust colors, fonts, header and
                                                    footer, layout and other design elements, as well as content and images.
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade " id="pills-blog" role="tabpanel"
                                            aria-labelledby="pills-blog-tab">
                                            <p>
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur similique
                                                at
                                                nostrum? Et sequi repellendus, illum, fuga officiis quos, quaerat provident
                                                iure eos enim maiores
                                                sint suscipit iste? Neque, hic?
                                            </p>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="card-body">
                                                <nav aria-label="...">
                                                    <ul class="pagination pagination-success pagin-border-success">
                                                        <li class="page-item disabled">
                                                            <a class="page-link"
                                                                href="javascript:void(0)" tabindex="-1">
                                                                Previous
                                                            </a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link"
                                                                href="javascript:void(0)">
                                                                1
                                                            </a>
                                                        </li>
                                                        <li class="page-item active">
                                                            <a class="page-link"
                                                                href="javascript:void(0)">
                                                                2 <span class="sr-only">(current)</span>
                                                            </a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link"
                                                                href="javascript:void(0)">
                                                                3
                                                            </a>
                                                        </li>
                                                        <li class="page-item">
                                                            <a class="page-link"
                                                                href="javascript:void(0)">
                                                                Next
                                                            </a>
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
                <!-- Container-fluid Ends-->

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

                        {{-- MOSTRANDO POR CATEGORIAS O Types_description --}}
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
                                                        src="{{ asset('storage/' . $item->course->image) }}"
                                                        alt="image">
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
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0">Copyright 2023 © Cion theme by pixelstrap.</p>
                        </div>
                        <div class="col-md-6">
                            <p class="float-end mb-0">Hand crafted &amp; made with
                                <svg class="footer-icon">
                                    <use href="assets/svg/icon-sprite.svg#heart"></use>
                                </svg>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>
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

@stop
