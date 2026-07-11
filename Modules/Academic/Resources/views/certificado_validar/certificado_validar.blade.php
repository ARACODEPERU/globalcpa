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
                <h1 class="title_aracode" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                    Validar Certificado
                </h1>
            </div>
        </div>

        @if ($person=="")

        <div class="max-w-lg mx-auto mt-8">
            <div class="text-center mb-6">
                <p class="text-sm font-medium tracking-wide" style="color: #747682;">Ingresa tu número de DNI para consultar</p>
            </div>

            <form id="search-form" method="get">
                <label for="default-search" class="sr-only">Buscar por DNI</label>

                <div class="relative flex items-center w-full rounded-2xl transition-all duration-300 ease-out"
                     style="background: linear-gradient(135deg, #f5f5f5, #fff); border: 2px solid #d1d5dc; box-shadow: 0 4px 15px rgba(0,0,0,0.08);"
                     onmouseover="this.style.boxShadow='0 8px 25px rgba(87,87,86,0.15)'; this.style.borderColor='#575756';"
                     onmouseout="this.style.boxShadow='0 4px 15px rgba(0,0,0,0.08)'; this.style.borderColor='#d1d5dc';"
                     onfocusin="this.style.borderColor='#e30613'; this.style.boxShadow='0 0 0 3px rgba(227,6,19,0.15), 0 8px 25px rgba(87,87,86,0.12)';"
                     onfocusout="this.style.borderColor='#d1d5dc'; this.style.boxShadow='0 4px 15px rgba(0,0,0,0.08)';">

                    <!-- Icono lupa -->
                    <div class="flex items-center pl-5 pr-2 pointer-events-none shrink-0">

                            <path stroke-linecap="round" stroke-linejoin="round" d="m21 21-5.197-5.197m0 0A7.5 7.5 0 1 0 5.196 5.196a7.5 7.5 0 0 0 10.607 10.607Z"/>
                        </svg>
                    </div>

                    <!-- Input -->
                    <div class="relative flex-1">
                        <input
                            type="text"
                            id="default-search"
                            class="w-full py-4 pr-4 bg-transparent border-0 focus:ring-0 focus:outline-none font-medium tracking-wide text-base"
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
                        <div class="text-2xl">{{ $person->full_name }}</div>
                    <div class="profile-image-container">
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
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
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
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <a href="{{ route('certificado_validar', ['dni'=>$person->number, 'course_id'=>$certificate->course_id]) }}">{{ $certificate->description }}</a>
                                </td>
                                <td class="py-4 px-6 font-medium text-gray-900 whitespace-nowrap dark:text-white">
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

@stop
