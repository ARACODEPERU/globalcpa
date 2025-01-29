@extends('layouts.webpage')

@section('content')




    <!-- Main Content Wrapper -->
    <main class="main-content w-full px-[var(--margin-x)] pb-8">

        <br>
        <div class="grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12 lg:col-span-8">
                <div class="mt-4 sm:mt-5 lg:mt-6" x-data="{activeTab:'tabRecent'}">
                    <div class="flex items-center justify-between space-x-2">
                        <h2 class="text-base font-medium tracking-wide text-slate-700 dark:text-navy-100">
                            
                        </h2>

                        <div class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 
                            dark:bg-navy-800 dark:text-navy-200">
                            <div class="tabs-list flex p-1">
                                <button
                                    @click="activeTab = 'tabRecent'"
                                    :class="activeTab === 'tabRecent' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                    class="btn shrink-0 px-3 py-1 text-xs+ font-medium">
                                    0 productos en el carrito
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
                                        class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                        Producto
                                        </th>
                                        <th
                                        class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                        Tipo
                                        </th>
                                        <th
                                        class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                        Precio
                                        </th>
                                        <th
                                        class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5"
                                        >
                                        Acción
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr
                                        class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"
                                    >
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                            <div class="flex items-center space-x-4">
                                                <div class="avatar">
                                                <img
                                                    class="rounded-full"
                                                    src="{{ asset('themes/webpage/images/object/object-15.jpg') }}"
                                                    alt="avatar"
                                                />
                                                </div>

                                                <span class="font-medium text-slate-700 dark:text-navy-100">
                                                    Título del curso
                                                </span>
                                            </div>
                                        </td>
                                        <td
                                        class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5"
                                        >
                                        Cursos Taller
                                        </td>
                                        <td
                                        class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5"
                                        >
                                        S/ 390.00
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 text-slate-700 dark:text-navy-100 sm:px-5">
                                            <button class="boton-degradado-trash">
                                                    <i class="fa fa-trash" aria-hidden="true" style="font-size: 16px;"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr
                                        class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"
                                    >
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                            <div class="flex items-center space-x-4">
                                                <div class="avatar">
                                                <img
                                                    class="rounded-full"
                                                    src="{{ asset('themes/webpage/images/object/object-15.jpg') }}"
                                                    alt="avatar"
                                                />
                                                </div>

                                                <span class="font-medium text-slate-700 dark:text-navy-100">
                                                    Título del curso
                                                </span>
                                            </div>
                                        </td>
                                        <td
                                        class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5"
                                        >
                                        Programas de Especialización
                                        </td>
                                        <td
                                        class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5"
                                        >
                                        S/ 390.00
                                        </td>
                                        <td class="whitespace-nowrap px-4 py-3 text-slate-700 dark:text-navy-100 sm:px-5">
                                            <button class="boton-degradado-trash">
                                                    <i class="fa fa-trash" aria-hidden="true" style="font-size: 16px;"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <tr
                                        class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500"
                                    >
                                        <td class="whitespace-nowrap px-4 py-3 sm:px-5">
                                        <div class="flex items-center space-x-4">
                                            <div class="avatar">
                                            <img
                                                class="rounded-full"
                                                src="{{ asset('themes/webpage/images/object/object-15.jpg') }}"
                                                alt="avatar"
                                            />
                                            </div>

                                            <span class="font-medium text-slate-700 dark:text-navy-100">
                                                Título del curso
                                            </span>
                                        </div>
                                        </td>
                                        <td
                                        class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5"
                                        >
                                        Programas de Especialización
                                        </td>
                                        <td
                                        class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5"
                                        >
                                        S/ 390.00
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
                        
                        <button class="btn mt-1 h-11 justify-between bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            <span>TOTAL:</span>
                            <span><i class="fa fa-heart" aria-hidden="true"></i>&nbsp; S/. 188.00</span>
                        </button>
                    
                    </div>


                </div>
            </div>

            <div class="col-span-12 grid grid-cols-1 gap-4 sm:gap-5 lg:col-span-4 lg:gap-6">
                <div class="card pb-4">
                    <br>
                    <div class="px-4 sm:px-5">
                        <div class="flex items-center justify-between">
                            <h2 class="font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                Datos del comprador
                            </h2>
                        </div>
                        <form class="form" method="POST" action="{{ route('onlineshop_client_account_store') }}" id ="CartForm">
                            <div class="row">
                                <div class="pt-4 col-md-6">
                                    <p class="text-xs+">Nombres</p>
                                    <div class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input class=" h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70" placeholder="" type="text">
                                    </div>
                                </div>
                                <div class="pt-4 col-md-6">
                                    <p class="text-xs+">Apellido Paterno</p>
                                    <div class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input class=" h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70" placeholder="" type="text">
                                    </div>
                                </div>
                                <div class="pt-4 col-md-6">
                                    <p class="text-xs+">Apellido Materno</p>
                                    <div class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input class=" h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70" placeholder="" type="text">
                                    </div>
                                </div>
                                <div class="pt-4 col-md-6">
                                    <p class="text-xs+">Tipo de documento</p>
                                    <div class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <select class="w-full form-select h-8 rounded-2xl border border-transparent bg-white px-4 py-0 pr-9 text-xs+ hover:border-slate-400 focus:border-primary dark:bg-navy-700 dark:hover:border-navy-400 dark:focus:border-accent">
                                            <option>DNI</option>
                                            <option>RUC</option>
                                            <option>Doc.trib.no.dom.sin.ruc</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="pt-4 col-md-6">
                                    <p class="text-xs+">N° Documento</p>
                                    <div class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input class=" h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70" placeholder="" type="text">
                                    </div>
                                </div>
                                <div class="pt-4 col-md-6">
                                    <p class="text-xs+">Teléfono</p>
                                    <div class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input class=" h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70" placeholder="" type="text">
                                    </div>
                                </div>
                                <div class="pt-4 col-md-12">
                                    <p class="text-xs+">Correo Electrónico</p>
                                    <div class="mt-1 flex justify-between space-x-2 rounded-2xl bg-slate-150 p-1.5 dark:bg-navy-800">
                                        <input class=" h-8 form-input w-full bg-transparent px-2 text-left placeholder:text-slate-400/70" placeholder="" type="text">
                                    </div>
                                </div>
                            </div>
                            <button class="mt-8 boton-degradado-courses">
                                    <b>CREAR CUENTA PARA PAGAR</b>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
    
    <br>
    <br>
    <br>


    
    <div id="whatsapp">
        <a href="https://wa.link/54k2g9" class="wtsapp" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa fa-whatsapp" aria-hidden="true"></i>
        </a>
    </div>

    <style type="text/css">
        #whatsapp .wtsapp{
            position: fixed;
            transform: all .5s ease;
            background-color: #25D366;
            display: block;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            border-radius: 50px;
            border-right: none;
            color: #fff;
            font-weight: 700;
            font-size: 30px;
            bottom: 40px;
            right: 20px;
            border: 0;
            z-index: 9999;
            width: 50px;
            height: 50px;
            line-height: 50px;
        }

        #whatsapp .wtsapp:before{
            content: "";
            position: absolute;
            z-index: -1;
            left: 50%;
            top: 50%;
            transform: translateX(-50%) translateY(-50%);
            display: block;
            width: 60px;
            height: 60px;
            background-color: #25D366;
            border-radius: 50%;
            -webkit-animation: pulse-border 1500ms ease-out infinite;
            animation: pulse-border 1500ms ease-out infinite;
        }

        #whatsapp .wtsapp:focus{
            border: none;
            outline: none;
        }

        @keyframes pulse-border{
            0%{
                transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1);
                opacity: 1;
            }
            100%{
                transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1.5);
                opacity: 0;
            }
        }



        .slider {
            position: relative;
            overflow: hidden;
        }
        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .slide {
            min-width: 100%;
        }

    </style>

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
                h.querySelector('.accordion-icon-aracode').textContent = '►'; // Restablecer icono
                h.setAttribute('aria-expanded', 'false');
            });

            // Mostrar el contenido del header clicado
            if (!isVisible) {
                content.style.maxHeight = content.scrollHeight + "px";
                content.style.padding = '15px';
                this.classList.add('active'); // Añadir clase activa al encabezado clicado
                this.querySelector('.accordion-icon-aracode').textContent = '▼'; // Cambiar icono al expandido
                this.setAttribute('aria-expanded', 'true');
                content.setAttribute('aria-hidden', 'false');
            }
        });
    });
    </script>
    
@stop
