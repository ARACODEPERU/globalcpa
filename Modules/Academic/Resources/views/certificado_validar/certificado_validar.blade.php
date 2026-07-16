@extends('layouts.webpage')
{{-- @section('title', '- Validar Certificado') <-- Agrega esta línea --}}
@section('content')


    <div class="tap-top"><i data-feather="chevrons-up"></i></div>

    <div class="page-wrapper" id="pageWrapper">
        <x-header />

        <div class="page-body-wrapper">
            <x-sidebar />

            <div class="page-body" x-data>
                <div class="container-fluid pb-5">

        <div class="mt-5 w-full transition-all duration-[.25s] sm:mt-5 lg:mt-6">
            <div style="text-align:center;">
                <h1 class="title_aracode cv-title" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                    Validar Certificado
                </h1>
            </div>
        </div>

        @if ($person=="")

        <div class="max-w-lg mx-auto mt-8">
            <div class="text-center mb-6">
                <p class="cv-subtitle text-sm font-medium tracking-wide" style="color: #747682;">Ingresa tu número de DNI para consultar</p>
            </div>

            <form id="search-form" method="get">
                <label for="default-search" class="sr-only">Buscar por DNI</label>

                <div class="cv-search-box relative flex items-center w-full rounded-2xl transition-all duration-300 ease-out"
                     style="background: linear-gradient(135deg, #f5f5f5, #fff); border: 2px solid #d1d5dc; box-shadow: 0 4px 15px rgba(0,0,0,0.08);"
                     onmouseover="this.style.boxShadow='0 8px 25px rgba(87,87,86,0.15)'; this.style.borderColor='#575756';"
                     onmouseout="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.08)'; this.style.borderColor='#d1d5dc';"
                     onfocusin="this.style.borderColor='#e30613'; this.style.boxShadow='0 0 0 3px rgba(227,6,19,0.15), 0 8px 25px rgba(87,87,86,0.12)';"
                     onfocusout="this.style.borderColor='#d1d5dc'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.08)';">

                    <!-- Icono lupa -->
                    <div class="flex items-center pl-5 pr-2 pointer-events-none shrink-0">
                        <svg class="cv-search-icon w-6 h-6" style="color: #575756;" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                        </svg>
                    </div>

                    <!-- Input -->
                    <div class="relative flex-1">
                        <input
                            type="text"
                            id="default-search"
                            class="cv-search-input w-full py-4 pr-4 bg-transparent border-0 focus:ring-0 focus:outline-none font-medium tracking-wide text-base"
                            style="color: #575756;"
                            placeholder="Ingresa Número DNI"
                            required
                            name="dni"
                            autocomplete="off"
                            inputmode="numeric"
                            pattern="[0-9]*"
                        />
                    </div>

                    <!-- Botón de envío -->
                    <div class="pr-2">
                        <button type="submit" class="relative flex items-center gap-2 px-6 py-3 text-white font-semibold text-sm rounded-xl transition-all duration-300 ease-out active:scale-95"
                                style="background: linear-gradient(45deg, #575756, #e30613); box-shadow: 0 4px 12px rgba(87,87,86,0.25);"
                                onmouseover="this.style.background='linear-gradient(45deg, #e30613, #575756)'; this.style.transform='translateY(-1px)'; this.style.boxShadow='0 6px 20px rgba(227,6,19,0.3)';"
                                onmouseout="this.style.background='linear-gradient(45deg, #575756, #e30613)'; this.style.transform='translateY(0)'; this.style.boxShadow='0 4px 12px rgba(87,87,86,0.25)';">
                            <svg class="w-4 h-4" fill="none" viewBox="0 0 24 24" stroke-width="2.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                            </svg>
                            <span>Buscar</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <script>
            document.getElementById('search-form').addEventListener('submit', function(event) {
                event.preventDefault(); // Detiene el envío normal del formulario

                const dniInput = document.getElementById('default-search');
                const dniValue = dniInput.value;

                // Construye la URL usando el valor del input
                const newAction = `{{ route('certificado_validar', ['dni' => '__DNI__']) }}`.replace('__DNI__', dniValue);

                // Redirige al usuario a la nueva URL
                window.location.href = newAction;
            });
        </script>

        @else
                    <div>
                        <div class="cv-person-name text-2xl">{{ $person->full_name }}</div>
                    <div class="profile-image-container cv-profile-border">
                        @if(!empty(trim($person->image ?? '')))
                            <img src="{{ asset('storage/'.$person->image)}}" alt="{{ $person->full_name }}" class="profile-image">
                        @else
                            @php
                                $nameParts = explode(' ', $person->full_name);
                                $initials = strtoupper(mb_substr($nameParts[0], 0, 1));
                                if (count($nameParts) > 1) {
                                    $initials .= strtoupper(mb_substr(end($nameParts), 0, 1));
                                }
                            @endphp
                            <span class="profile-initials">{{ $initials }}</span>
                        @endif
                    </div>
                </div>

                <style>
                .profile-image-container {
                    width: 64px;
                    height: 64px;
                    border-radius: 50%;
                    overflow: hidden;
                    display: flex;
                    align-items: center;
                    justify-content: center;
                    border: 3px solid #575756;
                    background: linear-gradient(45deg, #575756, #e30613);
                    flex-shrink: 0;
                }
                .profile-image {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                }
                .profile-initials {
                    color: #ffffff;
                    font-weight: 700;
                    font-size: 1.25rem;
                    line-height: 1;
                    user-select: none;
                }
                </style>
                <br><hr>
                <div class="overflow-x-auto relative shadow-md sm:rounded-lg">
                    <table class="cv-table w-full text-sm text-left">
                        <thead class="text-xs uppercase">
                            <tr class="text-2xl">
                                <th scope="col" class="py-3 px-6">
                                    Curso
                                </th>
                                <th scope="col" class="py-3 px-6">
                                    Fecha entregado
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($certificates as $certificate)
                            <tr>
                                <td class="py-4 px-6 font-medium whitespace-nowrap">
                                    <a href="{{ route('certificado_validar', ['dni'=>$person->number, 'course_id'=>$certificate->course_id]) }}">{{ $certificate->description }}</a>
                                </td>
                                <td class="py-4 px-6 font-medium whitespace-nowrap">
                                    {{ explode(' ', $certificate->fecha)[0] }}
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
        @endif
        <hr>
        @if ($course != "")
        <div class="card group p-5"><p class="">
            {!! $certificate->curriculum_plan ?? 'No existe Registro, Verifica el curso y el número del Alumno.' !!}
          </p>
        </div>
        @endif

                    <x-courses.list-card />
                    <x-social-networks />

                    <x-footer />
                </div>
            </div>
        </div>
    </div>

    <br>
    <br>


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

    <style>
        /* ========== VALIDAR CERTIFICADO - ESTILOS ========== */

        /* Tabla - Modo claro */
        .cv-table thead {
            background-color: #f9fafb;
        }

        .cv-table thead th {
            color: #374151;
            border-bottom: 1px solid #e5e7eb;
        }

        .cv-table tbody tr {
            background-color: #fff;
            border-bottom: 1px solid #e5e7eb;
        }

        .cv-table tbody tr:hover {
            background-color: #f9fafb;
        }

        .cv-table tbody td {
            color: #111827;
        }

        .cv-table tbody td a {
            color: #111827;
            text-decoration: none;
        }

        .cv-table tbody td a:hover {
            color: #e30613;
        }

        /* ========== DARK MODE - Validar Certificado ========== */

        /* Título */
        .dark .cv-title,
        body.dark-only .cv-title {
            color: #e0e0e0 !important;
        }

        /* Subtítulo "Ingresa tu número de DNI" */
        .dark .cv-subtitle,
        body.dark-only .cv-subtitle {
            color: rgba(255, 255, 255, 0.6) !important;
        }

        /* Input de búsqueda */
        .dark .cv-search-box,
        body.dark-only .cv-search-box {
            background: linear-gradient(135deg, #1f2f3e, #262932) !important;
            border-color: #374558 !important;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.3) !important;
        }

        .dark .cv-search-box:hover,
        body.dark-only .cv-search-box:hover {
            border-color: #4a5568 !important;
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.4) !important;
        }

        .dark .cv-search-box:focus-within,
        body.dark-only .cv-search-box:focus-within {
            border-color: #e30613 !important;
            box-shadow: 0 0 0 3px rgba(227, 6, 19, 0.2), 0 8px 25px rgba(0, 0, 0, 0.4) !important;
        }

        .dark .cv-search-icon,
        body.dark-only .cv-search-icon {
            color: rgba(255, 255, 255, 0.5) !important;
        }

        .dark .cv-search-input,
        body.dark-only .cv-search-input {
            color: #e0e0e0 !important;
        }

        .dark .cv-search-input::placeholder,
        body.dark-only .cv-search-input::placeholder {
            color: rgba(255, 255, 255, 0.4) !important;
        }

        /* Nombre del alumno */
        .dark .cv-person-name,
        body.dark-only .cv-person-name {
            color: #e0e0e0 !important;
        }

        /* Borde del círculo de perfil */
        .dark .cv-profile-border,
        body.dark-only .cv-profile-border {
            border-color: #374558 !important;
        }

        /* Tabla de cursos */
        .dark .cv-table,
        body.dark-only .cv-table {
            background-color: transparent !important;
        }

        .dark .cv-table thead,
        body.dark-only .cv-table thead {
            background-color: #1f2f3e !important;
        }

        .dark .cv-table thead th,
        body.dark-only .cv-table thead th {
            color: rgba(255, 255, 255, 0.7) !important;
            border-bottom-color: #374558 !important;
        }

        .dark .cv-table tbody tr,
        body.dark-only .cv-table tbody tr {
            background-color: #15202b !important;
            border-bottom-color: #374558 !important;
        }

        .dark .cv-table tbody tr:hover,
        body.dark-only .cv-table tbody tr:hover {
            background-color: #1f2f3e !important;
        }

        .dark .cv-table tbody td,
        body.dark-only .cv-table tbody td {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .dark .cv-table tbody td a,
        body.dark-only .cv-table tbody td a {
            color: #e0e0e0 !important;
        }

        .dark .cv-table tbody td a:hover,
        body.dark-only .cv-table tbody td a:hover {
            color: #e30613 !important;
        }

        /* HR */
        .dark .cv-hr,
        body.dark-only .cv-hr {
            border-top-color: rgba(255, 255, 255, 0.15) !important;
        }

        /* Card de plan curricular */
        .dark .cv-card,
        body.dark-only .cv-card {
            background-color: #1f2f3e !important;
            border-color: #374558 !important;
            color: rgba(255, 255, 255, 0.8) !important;
        }
    </style>

@stop
