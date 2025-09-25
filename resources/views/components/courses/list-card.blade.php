<div class="container-fluid dashboard_default">
    <div class="row">
        <div class="col-xl-12">
            <div class="card height-equal" style="min-height: 310.797px; background: none;">
                <div class="card-header card-no-border pb-0" style="background: none;">
                    <h3 style="text-transform: uppercase;">Formación que transforma tu talento en resultados reales</h3>
                </div>
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
                            <br>
                            <div class="row widget-grid">
                                @foreach ($courses->take($p) as $item)
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
                                                    <h4 style=" height: 30px; color: #000;">{{ $item->name }}</h4>
                                                </a>
                                                <br>
                                                <div class="card">
                                                    <div class="">
                                                        <div class="btn-showcase">
                                                            <a href="{{ route('web_course_description', $item->id) }}">
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
                                                                    <i class="fa fa-cart-plus" aria-hidden="true"
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
                        @foreach ($types as $type)
                                <div hidden class="tab-pane fade show active" id="{{ str_replace(' ', '', $type) }}" role="tabpanel"
                                aria-labelledby="{{ str_replace(' ', '', $type) }}-tab">
                                <br>
                                <div class="row widget-grid">
                                    @foreach ($courses as $item)
                                        @if (strtolower($item->additional) == strtolower($type))
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
                                                            <h4 style=" height: 30px; color: #000;">{{ $item->name }}</h4>
                                                        </a>
                                                        <br>
                                                        <div class="card">
                                                            <div class="">
                                                                <div class="btn-showcase">
                                                                    <a href="{{ route('web_course_description', $item->id) }}">
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
                                                                            <i class="fa fa-cart-plus" aria-hidden="true"
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
                        <div class="tab-pane fade " id="pills-blog" role="tabpanel" aria-labelledby="pills-blog-tab">
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
                        <div class="col-md-4"></div>
                        <div class="col-md-4">
                            <div class="btn-showcase" style="text-align: center;">
                                <a href="{{ route('web_courses') }}">
                                    <button class="btn btn-pill btn-primary btn-air-primary btn-sm" type="button"
                                        data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                        <i class="fa fa-graduation-cap" aria-hidden="true" style="font-size: 18px;"></i>
                                        &nbsp; Ver Toda Nuestra Formación
                                    </button>
                                </a>
                            </div>
                        </div>
                        <div class="col-md-4"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
</div>



{{--
<div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6">
    @foreach ($courses->take(12) as $item)
        <div class="card group p-3">
            <div class="flex items-center justify-between space-x-2 px-1">
                <div class="flex items-center space-x-2">
                    <div class="avatar size-9">
                        <img class="rounded-full"
                            src="{{ isset($item->course->teacher->person->image) ? asset('storage/' . $item->course->teacher->person->image) : '' }}"
                            alt="avatar">
                    </div>
                    <div>
                        <a href="#" class="font-medium text-slate-600 line-clamp-1 dark:text-navy-100">
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
                <img class="rounded-lg object-cover object-center" src="{{ asset('storage/' . $item->course->image) }}"
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
                    class="text-base font-medium text-slate-700 line-clamp-1 hover:text-primary
                focus:text-primary dark:text-navy-100 dark:hover:text-accent-light
                dark:focus:text-accent-light">
                    {{ $item->name }}
                </a>
                <div class="my-3 h-px bg-slate-200 dark:bg-navy-500"></div>
                <div class="flex justify-between">
                    <div>
                        <a class="view-pc" href="{{ route('web_course_description', $item->id) }}">
                            <button class="boton-degradado-info">
                                <b>Más Información</b>
                            </button>
                        </a>
                        <a class="view-movile" href="{{ route('web_course_description', $item->id) }}">
                            <button class="boton-degradado-info">
                                <b> Leer más </b>
                            </button>
                        </a>
                    </div>
                    <div class="text-right">
                        <a
                            onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                            <button class="boton-degradado-courses">
                                <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 18px;"></i>
                                &nbsp; S/ {{ $item->price }}
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div> --}}
