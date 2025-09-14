@extends('layouts.webpage')

@section('content')


    <!-- App Header Wrapper-->
    <x-nav />

    <!-- Sidebar -->
    <x-slidebar />

    <main class="main-content w-full px-[var(--margin-x)] pb-8">
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
                                                    <i class="fa fa-user" aria-hidden="true" style="font-size: 16px;"></i>
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
                                                        <button class="boton-degradado-info"><b>Más Información</b></button>
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
                        <div x-show="activeTab === '{{ $type }}'" x-transition:enter="transition-all duration-500 easy-in-out"
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
                                                        <i class="fa fa-user" aria-hidden="true" style="font-size: 16px;"></i>
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
                                                            <button class="boton-degradado-info"><b>Más Información</b></button>
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
                                                                <button><b> <a href="{{ route('register') }}">Registrate Gratis</a> </b></button>
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




        {{-- <div class="mt-1 grid lg:grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12 space-y-4 sm:space-y-5 lg:col-span-8 lg:space-y-6 xl:col-span-9">
                <div>
                    <div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6">
                        @foreach ($courses as $item)
                        <div class="card group p-3">
                            <div class="flex items-center justify-between space-x-2 px-1">
                                <div class="flex items-center space-x-2">
                                    <div class="avatar size-9">
                                        <img class="rounded-full" src="{{ isset($item->course->teacher->person->image) ? asset('storage/'.$item->course->teacher->person->image) : '' }}" alt="avatar">
                                    </div>
                                    <div>
                                        <a href="#" class="font-medium text-slate-600 line-clamp-1 dark:text-navy-100">
                                            {{ $item->course->teacher->person->names .' ' .$item->course->teacher->person->father_lastname   }}
                                        </a>
                                        <a href="">
                                            <p class="text-xs text-primary dark:text-accent-light">
                                                Ver Perfil
                                            </p>
                                        </a>
                                    </div>
                                </div>
                                <a href="">
                                    <button class="btn size-9 bg-slate-150 p-0 text-slate-800 hover:bg-slate-200 focus:bg-slate-200
                                        active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                        <i class="fa fa-user" aria-hidden="true" style="font-size: 16px;"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="relative mt-4">
                                <img class="rounded-lg object-cover object-center" src="{{ asset('storage/'.$item->course->image) }}" alt="image">
                                <div class="absolute top-0 h-full w-full rounded-lg bg-black/20 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
                                <div class="absolute top-0 flex h-full w-full items-center justify-center opacity-0 group-hover:opacity-100">
                                    <a href="{{ route('web_course_description', $item->id) }}">
                                        <button class="btn min-w-[7rem] border border-white/10 bg-white/20 text-white backdrop-blur hover:bg-white/30 focus:bg-white/30">
                                            Más Información
                                        </button>
                                    </a>
                                </div>
                            </div>
                            <div class="mt-3 px-1">
                                <p class="text-xs text-primary dark:text-accent-light">
                                    {{ $item->additional }}
                                </p>
                                <a href="{{ route('web_course_description', $item->id) }}" class="text-base font-medium text-slate-700 line-clamp-1 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
                                    {{ $item->name }}
                                </a>
                                <div class="my-3 h-px bg-slate-200 dark:bg-navy-500"></div>
                                <div class="flex justify-between">
                                    <div>
                                        <a href="{{ route('web_course_description', $item->id) }}">
                                            <button class="boton-degradado-info"><b>Más Información</b></button>
                                        </a>
                                    </div>
                                    <div class="text-right">
                                        <a  onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                                            <button class="boton-degradado-courses">
                                                <b>
                                                    <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 16px;"></i>
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
        </div> --}}


        <br>
        <div class="mt-4 w-full transition-all duration-[.25s] sm:mt-5 lg:mt-6">
            <x-social-networks />
        </div>

        <x-footer />

    </main>


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
