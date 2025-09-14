@extends('layouts.webpage')

@section('content')

    <!-- App Header Wrapper-->
    <x-nav />

    <!-- Sidebar -->
    <x-slidebar />

    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">

        <br>
        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12 lg:col-span-8">
                <div class="mt-4 sm:mt-5 lg:mt-6" x-data="{ activeTab: 'tabRecent' }">
                    <div class="flex items-center justify-between space-x-2">
                        <h2 class="text-base font-medium tracking-wide text-slate-700 dark:text-navy-100">

                        </h2>

                        <div
                            class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600
                            dark:bg-navy-800 dark:text-navy-200">
                            <div class="tabs-list flex p-1">
                                <button @click="activeTab = 'tabRecent'"
                                    :class="activeTab === 'tabRecent' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' :
                                        'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                    class="btn shrink-0 px-3 py-1 text-xs+ font-medium">
                                    <span id = "total_productos">0 programas en el carrito.</span>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="card mt-4">
                        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                            <table class="is-hoverable w-full text-left">
                                <thead>
                                    <tr>
                                        <th
                                            class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            Producto
                                        </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            Tipo
                                        </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            Precio
                                        </th>
                                        <th
                                            class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                            Acción
                                        </th>
                                    </tr>
                                </thead>
                                <tbody id="cart">
                                    <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                            <div class="flex items-center space-x-4">
                                                <div class="avatar">
                                                    <img class="rounded-full"
                                                        src="{{ asset('themes/webpage/images/object/object-15.jpg') }}"
                                                        alt="avatar" />
                                                </div>

                                                <span class="font-medium text-slate-700 dark:text-navy-100">
                                                    Título del curso
                                                </span>
                                            </div>
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                            Cursos Taller
                                        </td>
                                        <td
                                            class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                            S/ 590.00
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 text-slate-700 dark:text-navy-100 sm:px-5">
                                            <button class="boton-degradado-trash">
                                                <i class="fa fa-trash" aria-hidden="true" style="font-size: 16px;"></i>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <button
                            class="btn mt-1 h-11 justify-between bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            <span>TOTAL:</span>
                            <span><i class="fa fa-heart" aria-hidden="true"></i>&nbsp; <div id="totalid">S/ 0.00</div>
                                </span>
                        </button>

                    </div>

                    <!-- Inicio FActura o Boleta -->

                    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
                    <div class="max-w mx-auto bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Tabs -->
                        <div class="flex border-b">
                            <button onclick="document_type(2)" id="boleta-tab"
                                class="tab-button active py-4 px-6 font-medium text-sm focus:outline-none bg-blue-50 text-blue-600 border-b-2 border-blue-600">
                                <i class="fas fa-receipt mr-2"></i>Boleta
                            </button>
                            <button onclick="document_type(1)" id="factura-tab"
                                class="tab-button py-4 px-6 font-medium text-sm focus:outline-none text-gray-500 hover:text-gray-700 hover:bg-gray-50">
                                <i class="fas fa-file-invoice mr-2"></i>Factura
                            </button>
                        </div>

                        <!-- Boleta Form -->
                        <div id="boleta-form" class="tab-content p-6">
                            <div class="space-y-4">
                                <div>
                                    <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre
                                        completo</label>
                                    <input oninput="actualizarCamposOcultos(2)" type="text" id="nombre" name="nombre"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label for="dni" class="block text-sm font-medium text-gray-700">DNI</label>
                                    <input oninput="actualizarCamposOcultos(2)" type="text" id="dni" name="dni"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label for="email-boleta" class="block text-sm font-medium text-gray-700">Email</label>
                                    <input oninput="actualizarCamposOcultos(2)" type="email" id="email-dni"
                                        name="email-boleta"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>
                            </div>
                        </div>

                        <!-- Factura Form -->
                        <div id="factura-form" class="tab-content p-6 hidden">
                            <div class="space-y-4">
                                <div>
                                    <label for="ruc" class="block text-sm font-medium text-gray-700">RUC</label>
                                    <div class="flex mt-1">
                                        <input oninput="actualizarCamposOcultos(1)" type="text" id="ruc"
                                            name="ruc"
                                            class="block w-full border border-gray-300 rounded-l-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                        <button onclick="searchPerson(7, document.getElementById('ruc').value)"
                                            id="search-button" type="button"
                                            class="inline-flex items-center px-4 py-2 border border-l-0 border-gray-300 rounded-r-md bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                            <span style="color: black;">Buscar</span>
                                        </button>
                                    </div>
                                </div>

                                <div>
                                    <label for="razon-social" class="block text-sm font-medium text-gray-700">Razón
                                        Social/Nombre</label>
                                    <input oninput="actualizarCamposOcultos(1)" type="text" id="razon-social"
                                        name="razon-social"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <div>
                                    <label for="email-factura"
                                        class="block text-sm font-medium text-gray-700">Email</label>
                                    <input oninput="actualizarCamposOcultos(1)" type="email" id="email-ruc"
                                        name="email-factura"
                                        class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm py-2 px-3 focus:outline-none focus:ring-blue-500 focus:border-blue-500">
                                </div>

                                <!-- Estados -->
                                <div class="p-6 border-t bg-gray-50">
                                    <div class="flex space-x-6">
                                        <div class="flex items-center">
                                            <input oninput="actualizarCamposOcultos(1)" disabled type="checkbox"
                                                id="statusRuc" name="habido"
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded disabled:opacity-100 disabled:cursor-not-allowed appearance-none checked:bg-blue-600 checked:border-blue-600">
                                            <label for="habido" class="ml-2 block text-sm text-gray-700">Habido</label>
                                        </div>
                                        <div class="flex items-center">
                                            <input oninput="actualizarCamposOcultos(1)" disabled type="checkbox"
                                                id="conditionRuc" name="activo"
                                                class="h-4 w-4 text-blue-600 focus:ring-blue-500 border-gray-300 rounded disabled:opacity-100 disabled:cursor-not-allowed appearance-none checked:bg-blue-600 checked:border-blue-600">
                                            <label for="activo" class="ml-2 block text-sm text-gray-700">Activo</label>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                    <script></script>
                    <script>
                        // Tab functionality
                        document.querySelectorAll('.tab-button').forEach(button => {
                            button.addEventListener('click', () => {
                                // Remove active class from all buttons and hide all forms
                                document.querySelectorAll('.tab-button').forEach(btn => {
                                    btn.classList.remove('active', 'bg-blue-50', 'text-blue-600', 'border-b-2',
                                        'border-blue-600');
                                    btn.classList.add('text-gray-500', 'hover:text-gray-700', 'hover:bg-gray-50');
                                });

                                document.querySelectorAll('.tab-content').forEach(content => {
                                    content.classList.add('hidden');
                                });

                                // Add active class to clicked button and show corresponding form
                                button.classList.add('active', 'bg-blue-50', 'text-blue-600', 'border-b-2',
                                    'border-blue-600');
                                button.classList.remove('text-gray-500', 'hover:text-gray-700', 'hover:bg-gray-50');

                                const formId = button.id.replace('-tab', '-form');
                                document.getElementById(formId).classList.remove('hidden');
                            });
                        });
                    </script>

                    <!-- Fin FActura o Boleta -->

                </div>
            </div>

            <div class="col-span-12 grid grid-cols-1 gap-4 sm:gap-5 lg:col-span-4 lg:gap-6">
                <div class="card pb-4">
                    <br>
                    <div class="px-4 sm:px-5">
                        <div class="flex items-center justify-between">
                            <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100 mt-4">
                                Excelente estás a punto de aprender con nosotros, Bienvenido a GlobalCpa Perú.
                            </h2>
                            <br>
                            <button class="mt-8 boton-degradado-info" id="btn-login"
                                onclick="window.location.href='{{ route('login_shop') }}';">
                                <b>YA TENGO UNA CUENTA</b>
                            </button>
                        </div>
                    </div>
                    <br>
                    {{-- Formularios según estado de login --}}
                    <style>
                        .form>* {
                            margin: 1rem;
                        }
                    </style>
                    @auth
                        <div class="card pb-4">
                            <br>
                            <div class="px-4 sm:px-5">
                                <div class="flex items-center justify-between">
                                    <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100 mt-6">
                                        Hola {{ Auth::user()->name }} estas por acceder a la compra de tus cursos, verifica que
                                        los cursos que elegiste sean los correctos y procede a hacer el pago haciendo click en
                                        "Pagar"
                                    </h2>
                                </div>

                            </div>
                        </div>
                        <form class="form" method="POST" action="{{ route('paying_auth') }}" id ="CartForm">
                            @csrf
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" name="recaptcha_token" id="recaptcha_token">
                            <input type="text" name="names" value="{{ Auth::user()->name }}" style="display: none">
                            <div id="divCartHidden" style="display: none"></div>
                            <input type="hidden" name="ruc" id="ruc-d" value="">
                            <input type="hidden" name="dni" id="dni-d" value="">
                            <input type="hidden" name="nombreCompleto" id="nombreCompleto-d" value="">
                            <input type="hidden" name="document_type" id="document_type-d" value="1">
                            <input type="hidden" name="razonSocial" id="razon-social-d" value="">
                            <input type="hidden" name="email" id="email-d" value="">
                            <input type="hidden" name="statusRuc" id="statusRuc-d" value="0">
                            <input type="hidden" name="conditionRuc" id="conditionRuc-d" value="0">

                            <div class="row">
                                <div class="pt-8 col-md-12">
                                    <p class="text-xs+">Correo Electrónico</p>
                                    <div
                                        class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input
                                            class=" h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70"
                                            name="email" value="{{ Auth::user()->email }}" placeholder="" type="text"
                                            disabled>
                                    </div>
                                </div>
                                {{-- <div class="pt-4 col-md-6">
                                        <p class="text-xs+">Contraseña</p>
                                        <div class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                            <input class=" h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70" placeholder="" type="text" disabled>
                                        </div>
                                    </div> --}}
                            </div>

                            <div>
                                <input type="checkbox" class="" id="acepto_terminos" />
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <span class="text-sm text-gray-700">Acepto recibir información sobre futuros cursos,
                                        programas y promociones de Global CPA.</span>
                                </label>

                            </div>

                            <button class="mt-8 boton-degradado-courses" id="btn-crear-cuenta">
                                <b>Pagar con tarjeta</b>
                            </button>
                            <br>
                            <button class="mt-8 boton-degradado-transferencia">
                                <b>TRANSFERENCIA | YAPE ó PLIN</b>
                            </button>
                        </form>
                    @else
                        <form class="form" method="POST" action="{{ route('paying') }}" id="CartForm">
                            @csrf
                            <meta name="csrf-token" content="{{ csrf_token() }}">
                            <input type="hidden" name="recaptcha_token" id="recaptcha_token">
                            <div id="divCartHidden" style="display: none"></div>
                            <div class="row">
                                <!-- Campo Nombres -->
                                <div class="pt-4 col-md-6">
                                    <p class="text-xs+">Nombres</p>
                                    <div
                                        class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input
                                            class="h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70"
                                            name="names" placeholder="" type="text" value="{{ old('names') }}">
                                    </div>
                                    @error('names')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo Apellido Paterno -->
                                <div class="pt-4 col-md-6">
                                    <p class="text-xs+">Apellido Paterno</p>
                                    <div
                                        class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input
                                            class="h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70"
                                            name="app" placeholder="" type="text" value="{{ old('app') }}">
                                    </div>
                                    @error('app')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo Apellido Materno -->
                                <div class="pt-4 col-md-6">
                                    <p class="text-xs+">Apellido Materno</p>
                                    <div
                                        class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input
                                            class="h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70"
                                            name="apm" placeholder="" type="text" value="{{ old('apm') }}">
                                    </div>
                                    @error('apm')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo Tipo de documento -->
                                <div class="pt-4 col-md-6">
                                    <p class="text-xs+">Tipo de documento</p>
                                    <div
                                        class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <select
                                            class="w-full form-select h-8 rounded-2xl border border-transparent bg-white px-4 py-0 pr-9 text-xs+ hover:border-slate-400 focus:border-primary dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent"
                                            name="type">
                                            <option value="DNI" {{ old('type') == 'DNI' ? 'selected' : '' }}>DNI</option>
                                            <option value="RUC" {{ old('type') == 'RUC' ? 'selected' : '' }}>RUC</option>
                                            <option value="Doc.trib.no.dom.sin.ruc"
                                                {{ old('type') == 'Doc.trib.no.dom.sin.ruc' ? 'selected' : '' }}>
                                                Doc.trib.no.dom.sin.ruc</option>
                                        </select>
                                    </div>
                                    @error('type')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo N° Documento -->
                                <div class="pt-4 col-md-6">
                                    <p class="text-xs+">N° Documento</p>
                                    <div
                                        class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input
                                            class="h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70"
                                            name="dni" placeholder="" type="number" min="10000000" max="99999999999"
                                            value="{{ old('dni') }}">
                                    </div>
                                    @error('dni')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo Teléfono -->
                                <div class="pt-4 col-md-6">
                                    <p class="text-xs+">Teléfono</p>
                                    <div
                                        class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input
                                            class="h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70"
                                            name="phone" placeholder="" type="text" value="{{ old('phone') }}">
                                    </div>
                                    @error('phone')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo Correo Electrónico -->
                                <div class="pt-4 col-md-12">
                                    <p class="text-xs+">Correo Electrónico</p>
                                    <div
                                        class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input
                                            class="h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70"
                                            name="email" placeholder="" type="email" value="{{ old('email') }}">
                                    </div>
                                    @error('email')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo Contraseña -->
                                <div class="pt-4 col-md-12">
                                    <p class="text-xs+">Contraseña:</p>
                                    <div
                                        class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input
                                            class="h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70"
                                            name="password" placeholder="" type="password" required>
                                    </div>
                                    @error('password')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Campo Repetir Contraseña -->
                                <div class="pt-4 col-md-12">
                                    <p class="text-xs+">Repetir Contraseña:</p>
                                    <div
                                        class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input
                                            class="h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70"
                                            name="password2" placeholder="" type="password" required>
                                    </div>
                                    @error('password2')
                                        <span class="text-sm text-red-500">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <!-- Botones -->
                            <div>
                                <input type="checkbox" class="" id="acepto_terminos" />
                                <label class="flex items-center space-x-2 cursor-pointer">
                                    <span class="text-sm text-gray-700">Acepto recibir información sobre futuros cursos,
                                        programas y promociones de Global CPA.</span>
                                </label>

                            </div>

                            <div>
                                <button type="submit" class="mt-8 boton-degradado-courses" id="btn-crear-cuenta">
                                    <b>CREAR CUENTA PARA PAGAR</b>
                                </button>
                                <br>
                                <button class="mt-8 boton-degradado-transferencia">
                                    <b>TRANSFERENCIA | YAPE ó PLIN</b>
                                </button>
                            </div>
                        </form>
                    @endauth

                    <script>
                        document.addEventListener('DOMContentLoaded', function() {
                            const checkbox = document.getElementById('acepto_terminos');
                            const buttons = document.querySelectorAll(
                                '#btn-crear-cuenta, .boton-degradado-transferencia');

                            // Función para deshabilitar todos los botones
                            function disableButtons() {
                                buttons.forEach(button => {
                                    button.disabled = true;
                                    button.classList.add('opacity-50', 'cursor-not-allowed');
                                    button.classList.remove('hover:opacity-100');
                                });
                            }

                            // Función para habilitar todos los botones
                            function enableButtons() {
                                buttons.forEach(button => {
                                    button.disabled = false;
                                    button.classList.remove('opacity-50', 'cursor-not-allowed');
                                    button.classList.add('hover:opacity-100');
                                });
                            }

                            // Deshabilita los botones al cargar la página
                            disableButtons();

                            // Agrega un evento 'change' al checkbox
                            checkbox.addEventListener('change', function() {
                                if (this.checked) {
                                    enableButtons();
                                } else {
                                    disableButtons();
                                }
                            });
                        });
                    </script>
                    <div id="loginModal" class="modal">
                        <div class="modal-content">
                            <!-- Aquí se incrustará la vista de la página de inicio de sesión -->
                            <!-- Puedes cargarla utilizando AJAX -->
                        </div>
                    </div>
                    <script>
                        document.getElementById("btn-login").addEventListener("click", function(event) {
                            event.preventDefault(); // Evita la acción predeterminada del botón
                            // Aquí puedes agregar el código para abrir el modal u realizar otras acciones
                        });
                    </script>
                </div>
            </div>

        </div>
        </div>
    </main>

    <br>
    <br>
    <br>



    <script>
        // let currentIndex = 0;
        // const slides = document.querySelector('.slides');
        // const totalSlides = document.querySelectorAll('.slide').length;

        // function showNextSlide() {
        //     currentIndex = (currentIndex + 1) % totalSlides;
        //     const offset = -currentIndex * 100;
        //     slides.style.transform = `translateX(${offset}%)`;
        // }

        // setInterval(showNextSlide, 3000); // Cambia cada 3 segundos
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


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        cargarItemsCarritoBD();

        function cargarItemsCarritoBD() {
            document.getElementById('cart').innerHTML =
                ""; // BORRAR contenido de la vista, antes de cargar de la base de datos
            let carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            myIds = [];
            carrito.forEach(function(item) {
                // Hacer algo con cada elemento del carrito

                myIds.push(parseInt(item.id));
            });

            btnCrear = document.getElementById("btn-crear-cuenta");
            btnCrear.setAttribute("disabled", "disabled");
            realizarConsulta(myIds);
        }

        function realizarConsulta(ids) {
            // Realizar la petición Ajax
            var token_csrf = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: "{{ route('onlineshop_get_item_carrito') }}",
                type: 'POST',
                data: {
                    ids: ids
                },
                dataType: 'json',
                headers: {
                    'X-CSRF-TOKEN': token_csrf
                },
                success: function(respuesta) {
                    // Obtén una referencia al elemento div por su ID
                    var divCartHidden = document.getElementById("divCartHidden");

                    respuesta.items.forEach(function(item) {
                        // Accede a las propiedades del objeto
                        renderProducto(item);
                        // Crea un elemento input oculto
                        let inputHidden = document.createElement("input");
                        // Establece los atributos del input
                        inputHidden.type = "hidden";
                        inputHidden.name = "item_id[]"; // Asigna el nombre que desees
                        inputHidden.value = item.id; // Asigna el valor que desees
                        // Agrega el input al div
                        divCartHidden.appendChild(inputHidden);
                    });

                    btnCrear = document.getElementById("btn-crear-cuenta");
                    btnCrear.removeAttribute("disabled");

                },
                error: function(xhr) {
                    // Ocurrió un error al realizar la consulta
                    console.log(xhr.responseText);
                    // Aquí puedes manejar el error de alguna manera
                }
            });

        }

        function renderProducto(respuesta) {

            var cart = document.getElementById('cart');
            if (cart != null) {
                var id = respuesta.id;
                var teacher = respuesta.teacher;
                var teacher_id = respuesta.teacher_id;
                var avatar = respuesta.avatar;
                var image = respuesta.image;
                var name = respuesta.name;
                var price = respuesta.price;
                var modalidad = respuesta.additional;
                var url_campus = "";
                var url_descripcion_programa = "/curso-descripcion/" +
                id; // esta ruta deberá corregirse si se cambia el el get de la RUTA :S

                /*
               <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500" id="` + id + `_pc">
                                            <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                                <div class="flex items-center space-x-4">
                                                    <div class="avatar">
                                                    <img
                                                        class="rounded-full"
                                                        src="` + image + `"
                                                        alt="avatar"
                                                    />
                                                    </div>

                                                    <span class="font-medium text-slate-700 dark:text-navy-100">
                                                        <a href="`+url_descripcion_programa+`" target="_blank">` + name + `</a>
                                                    </span>
                                                </div>
                                            </td>
                                            <td
                                            class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                            <b>` + modalidad + `</b>
                                            </td>
                                            <td
                                            class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                            <b>S/ ` + price + `</b>
                                            </td>
                                            <td class="whitespace-nowrap px-4 py-3 text-slate-700 dark:text-navy-100 sm:px-5">
                                                <button class="boton-degradado-trash">
                                                        <i class="fa fa-trash" aria-hidden="true" style="font-size: 16px;">
                                                            <a title="Eliminar este Curso" class="remove" onclick="eliminarproducto({ id: ` + id + `, nombre: '` +
                              name + `', precio: ` + price + ` });">X</a>
                                  </i>
                                                </button>
                                            </td>
                                        </tr>
                */

                cart.innerHTML += `
        <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500" id="` + id + `_pc">
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                            <div class="flex items-center space-x-4">
                                                <div class="avatar">
                                                <img
                                                    class="rounded-full"
                                                    src="` + image + `"
                                                    alt="avatar"
                                                />
                                                </div>

                                                <span class="font-medium text-slate-700 dark:text-navy-100">
                                                    <a href="` + url_descripcion_programa + `" target="_blank">` +
                    name + `</a>
                                                </span>
                                            </div>
                                        </td>
                                        <td
                                        class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                        <b>` + modalidad + `</b>
                                        </td>
                                        <td
                                        class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                        <b>S/ ` + price + `</b>
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 text-slate-700 dark:text-navy-100 sm:px-5">
                                            <button class="boton-degradado-trash" onclick="eliminarproducto({ id: ` +
                    id + `, nombre: '` +
                    name + `', precio: ` + price + ` });">
                                                    <i class="fa fa-trash" aria-hidden="true" style="font-size: 16px;">
                                                        <a title="Eliminar este Curso" class="remove"></a>
                              </i>
                                            </button>
                                        </td>
                                    </tr>
                    `;
            }
        }
    </script>

    <script>
        function confirmSubmit(event) {
            event.preventDefault(); // Evita que el formulario se envíe automáticamente
            carrito = JSON.parse(localStorage.getItem("carrito")) || [];
            console.log(carrito);
            if (carrito.length > 0) {
                console.log(event);
                event.target.form.submit();
            } else
                alert("No has elegido ningún curso");

        }
    </script>


    <script>
        function onSubmit(token) {
            document.getElementById("CartForm").submit();
        }
    </script>

    <script src="https://www.google.com/recaptcha/api.js?render=<?php echo config('services.recaptcha.site_key'); ?>"></script>
    <script>
        document.getElementById('CartForm').addEventListener('submit', function(event) {
            event.preventDefault();
            grecaptcha.ready(function() {
                grecaptcha.execute('<?php echo config('services.recaptcha.site_key'); ?>', {
                    action: 'submit'
                }).then(function(token) {
                    document.getElementById('recaptcha_token').value = token;
                    document.getElementById('CartForm').submit();
                });
            });
        });
    </script>

@stop
