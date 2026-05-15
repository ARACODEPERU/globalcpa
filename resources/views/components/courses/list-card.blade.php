<div>
    <section style="padding: 10px 0px;">
        <div class="container-fluid">
            <div class="page-title">
                <div class="row">
                    <div class="col-sm-3 pe-0">
                    </div>
                    <div class="col-sm-6 ps-0">
                        <h1 class="ara_title">Formación que transforma tu talento en resultados reales</h1>
                    </div>
                    <div class="col-sm-3 pe-0">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="card height-equal" style="background: none;">
                        <div class="card-body">
                            <ul class="nav nav-pills nav-primary" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="f-w-600 nav-link active" id="todos-tab" data-bs-toggle="pill"
                                        onclick="show_paginator()" href="#todos" role="tab" aria-controls="todos"
                                        aria-selected="false" tabindex="-1">Todos
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
                                                        @if (filled( $item->url_slug ?? null))
                                                            <a href="{{ route('course_url_slug', $item->url_slug) }}">
                                                                <img class="w-100 mb-3"
                                                                    src="{{ asset('storage/' . $item->course->image) }}"
                                                                    alt="">
                                                            </a>
                                                        @else
                                                            <a href="{{ route('web_course_description', $item->id) }}">
                                                                <img class="w-100 mb-3"
                                                                    src="{{ asset('storage/' . $item->course->image) }}"
                                                                    alt="">
                                                            </a>
                                                        @endif

                                                        <span style="color: #e30613;">{{ $item->additional }}</span>
                                                        <br>
                                                        @if (filled( $item->url_slug ?? null))
                                                        <a href="{{ route('course_url_slug', $item->url_slug) }}"
                                                            style="text-decoration: none;">
                                                            <h4 style=" height: 30px;">{{ $item->name }}
                                                            </h4>
                                                        </a>
                                                        @else
                                                        <a href="{{ route('web_course_description', $item->id) }}"
                                                            style="text-decoration: none;">
                                                            <h4 style=" height: 30px;">{{ $item->name }}
                                                            </h4>
                                                        </a>
                                                        @endif
                                                        <br>
                                                        <div class="card">
                                                            <div class="">
                                                                <div class="btn-showcase">
                                                                    @if (filled( $item->url_slug ?? null))
                                                                        <a
                                                                            href="{{ route('course_url_slug', $item->url_slug) }}">
                                                                            <button
                                                                                class="btn btn-pill btn-light btn-air-light btn-sm"
                                                                                type="button"
                                                                                data-bs-original-title="btn btn-pill btn-light btn-air-light btn-sm">
                                                                                Leer Más
                                                                            </button>
                                                                        </a>
                                                                @else
                                                                        <a
                                                                            href="{{ route('web_course_description', $item->id) }}">
                                                                            <button
                                                                                class="btn btn-pill btn-light btn-air-light btn-sm"
                                                                                type="button"
                                                                                data-bs-original-title="btn btn-pill btn-light btn-air-light btn-sm">
                                                                                Leer Más
                                                                            </button>
                                                                        </a>
                                                                @endif

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
                                </div>
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
                                                                @if (filled( $item->url_slug ?? null))
                                                                <a
                                                                    href="{{ route('course_url_slug', $item->url_slug) }}">
                                                                    @if($item->course?->image)
                                                                        <img class="w-100 mb-3" src="{{ asset('storage/' . $item->course->image) }}" alt="">
                                                                    @endif
                                                                </a>
                                                                @else
                                                                    <a
                                                                        href="{{ route('web_course_description', $item->id) }}">
                                                                        @if($item->course?->image)
                                                                            <img class="w-100 mb-3" src="{{ asset('storage/' . $item->course->image) }}" alt="">
                                                                        @endif
                                                                    </a>
                                                                @endif

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
                                                                            @if (filled( $item->url_slug ?? null))
                                                                                <a
                                                                                    href="{{ route('course_url_slug', $item->url_slug) }}">
                                                                                    <button
                                                                                        class="btn btn-pill btn-light btn-air-light btn-sm"
                                                                                        type="button"
                                                                                        data-bs-original-title="btn btn-pill btn-light btn-air-light btn-sm">
                                                                                        Leer Más
                                                                                    </button>
                                                                                </a>
                                                                            @else
                                                                            <a
                                                                                href="{{ route('web_course_description', $item->id) }}">
                                                                                <button
                                                                                    class="btn btn-pill btn-light btn-air-light btn-sm"
                                                                                    type="button"
                                                                                    data-bs-original-title="btn btn-pill btn-light btn-air-light btn-sm">
                                                                                    Leer Más
                                                                                </button>
                                                                            </a>
                                                                            @endif

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

                            <div class="row">
                                <div class="col-md-4"></div>
                                <div class="col-md-4">
                                    <div class="btn-showcase" style="text-align: center;">
                                        <a href="{{ route('web_courses') }}">
                                            <button class="btn btn-pill btn-primary btn-air-primary btn-sm"
                                                type="button"
                                                data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                                <i class="fa fa-graduation-cap" aria-hidden="true"
                                                    style="font-size: 18px;"></i>
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
    </section>
</div>
