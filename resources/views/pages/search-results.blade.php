@extends('layouts.webpage')

@section('title', ' - Buscar cursos')

@section('etiquetasmeta')
    <meta name="description" content="Busca cursos de contabilidad, tributaria y más en CPA Academy." />
@endsection

@section('styles')
    <style>
        /* Paginación - Modo Claro */
        .tst-pagination .page-item .page-link {
            color: #002060;
            border: 1px solid #d1d5db;
            margin: 0 3px;
            border-radius: 10px;
            padding: 8px 14px;
            font-weight: 600;
            font-size: 0.9rem;
            transition: all 0.25s ease;
            background: #ffffff;
        }
        .tst-pagination .page-item .page-link:hover {
            background: #002060;
            color: #ffffff;
            border-color: #002060;
        }
        .tst-pagination .page-item.active .page-link {
            background: #e30613;
            color: #ffffff;
            border-color: #e30613;
            box-shadow: 0 4px 12px rgba(227, 6, 19, 0.3);
        }
        .tst-pagination .page-item.disabled .page-link {
            color: #9ca3af;
            background: #f3f4f6;
            border-color: #e5e7eb;
            cursor: not-allowed;
        }

        /* Paginación - Modo Oscuro */
        body.dark-only .tst-pagination .page-item .page-link {
            color: #d1d5db;
            background: #1f2937;
            border-color: #374558;
        }
        body.dark-only .tst-pagination .page-item .page-link:hover {
            background: #e30613;
            color: #ffffff;
            border-color: #e30613;
        }
        body.dark-only .tst-pagination .page-item.active .page-link {
            background: #e30613;
            color: #ffffff;
            border-color: #e30613;
            box-shadow: 0 4px 12px rgba(227, 6, 19, 0.4);
        }
        body.dark-only .tst-pagination .page-item.disabled .page-link {
            color: #4b5563;
            background: #111827;
            border-color: #1f2937;
        }
    </style>
@endsection

@section('content')

    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on top ends-->

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
                <div class="container-fluid">
                    <br><br><br>

                    {{-- Hero de búsqueda --}}
                    <div class="row mb-4">
                        <div class="col-12">
                            <div class="card" style="background: linear-gradient(135deg, #002060 0%, #004080 100%); border-radius: 16px; border: none;">
                                <div class="card-body p-4 p-lg-5">
                                    <nav aria-label="breadcrumb" class="mb-3">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item">
                                                <a href="{{ route('index_main') }}" class="text-white-50 text-decoration-none">
                                                    <i class="fa fa-home me-1"></i> Inicio
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active text-white" aria-current="page">
                                                Resultados de búsqueda
                                            </li>
                                        </ol>
                                    </nav>

                                    <h1 class="h3 fw-bold text-white mb-2">
                                        <i class="fa-solid fa-magnifying-glass me-2"></i>
                                        Resultados de búsqueda
                                    </h1>

                                    @if ($query)
                                        <p class="text-white-50 mb-3" style="font-size: 1.05rem;">
                                            Se encontraron <strong class="text-white">{{ $total }}</strong>
                                            {{ Str::plural('resultado', $total) }}
                                            para "<em class="text-warning">{{ $query }}</em>"
                                        </p>
                                    @else
                                        <p class="text-white-50 mb-3" style="font-size: 1.05rem;">
                                            Mostrando todos los cursos disponibles
                                        </p>
                                    @endif

                                    {{-- Barra de búsqueda repetida en el hero --}}
                                    <form action="{{ route('web_search_courses') }}" method="GET" class="d-flex" style="max-width: 500px;">
                                        <div class="input-group">
                                            <input type="text" name="q" value="{{ $query }}"
                                                   class="form-control form-control-lg"
                                                   placeholder="Buscar por nombre, categoría..."
                                                   style="border-radius: 25px 0 0 25px; border: none;"
                                                   autocomplete="off">
                                            <button class="btn btn-warning btn-lg" type="submit"
                                                    style="border-radius: 0 25px 25px 0; color: #002060; font-weight: 700;">
                                                <i class="fa-solid fa-magnifying-glass me-1"></i> Buscar
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Resultados --}}
                    @if ($courses->count() > 0)
                        <div class="row widget-grid">
                            @foreach ($courses as $item)
                                @php
                                    $courseUrl = route('course_url_slug', $item->course->landing->url_slug);
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
                                            <span style="color: #e30613;">{{ $item->additional }}</span>
                                            @if ($item->course?->category?->description)
                                                <span class="ms-1" style="font-size: 0.72rem; font-weight: 600; padding: 3px 10px; border-radius: 20px; background: #002060; color: #ffffff; display: inline-block;">
                                                    {{ $item->course->category->description }}
                                                </span>
                                            @endif
                                            <br>
                                            <a href="{{ $courseUrl }}" style="text-decoration: none;">
                                                <h4 style="height: 30px;">{{ $item->name }}</h4>
                                            </a>
                                            <br>
                                            <div class="card">
                                                <div class="">
                                                    <div class="btn-showcase">
                                                        <a href="{{ $courseUrl }}">
                                                            <button class="btn btn-pill btn-light btn-air-light btn-sm" type="button">
                                                                Leer Más
                                                            </button>
                                                        </a>
                                                        <a onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                                                            <button class="btn btn-pill btn-primary btn-air-primary btn-sm" type="button">
                                                                <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 18px;"></i>
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

                        {{-- Paginación --}}
                        <div class="row mt-4">
                            <div class="col-12 d-flex justify-content-center">
                                <div class="tst-pagination">
                                    {{ $courses->links() }}
                                </div>
                            </div>
                        </div>
                    @else
                        {{-- Sin resultados --}}
                        <div class="row">
                            <div class="col-12">
                                <div class="card" style="border-radius: 16px;">
                                    <div class="card-body text-center py-5">
                                        <i class="fa-solid fa-search" style="font-size: 3.5rem; color: #cbd5e1;"></i>
                                        <h3 class="h5 fw-bold mt-3" style="color: #374151;">
                                            No se encontraron cursos
                                        </h3>
                                        <p style="color: #6b7280; max-width: 400px; margin: 0 auto;">
                                            @if ($query)
                                                No hay resultados para "<strong>{{ $query }}</strong>".
                                                Intenta con otros términos de búsqueda.
                                            @else
                                                Escribe un término de búsqueda para encontrar cursos.
                                            @endif
                                        </p>
                                        <a href="{{ route('web_courses') }}" class="btn btn-primary mt-3" style="border-radius: 25px;">
                                            <i class="fa-solid fa-arrow-left me-1"></i> Ver todos los cursos
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
        </div>
        <!-- footer start-->
        <x-footer />
    </div>
@endsection
