@extends('layouts.webpage')

@section('content')




    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <br>
        <x-slider /> 

        <div class=" mt-4 w-full transition-all duration-[.25s] sm:mt-5 lg:mt-6">

            <div class="col-span-12 space-y-4 sm:space-y-5 lg:col-span-12 lg:space-y-6 xl:col-span-12">
                <div>
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-medium text-slate-800 dark:text-navy-50">
                            Global CPA Business School | Formación:
                        </h3>
                        {{-- <div class="hidden w-full max-w-xs justify-between space-x-4 text-slate-700 dark:text-navy-100 sm:flex" x-data="{activeTab:'tabAll'}">
                            <button @click="activeTab = 'tabAll'" class="font-medium tracking-wide text-primary dark:text-accent-light" :class="activeTab === 'tabAll' &amp;&amp; 'text-primary dark:text-accent-light' ">
                            Todos
                            </button>
                            <button @click="activeTab = 'tabArt'" class="font-medium tracking-wide" :class="activeTab === 'tabArt' &amp;&amp; 'text-primary dark:text-accent-light' ">
                            Cursos
                            </button>
                            <button @click="activeTab = 'tabSport'" class="font-medium tracking-wide" :class="activeTab === 'tabSport' &amp;&amp; 'text-primary dark:text-accent-light' ">
                            Programas
                            </button>
                        </div> --}}
                    </div>
                    <!--Courses One Start-->
                    <x-courses.list-card /> 
                    <!--Courses One End-->
              </div>
            </div>

        </div>

        <br>
        <div class="mt-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 lg:mt-6">
            <div style="text-align:center;">
                <h1 class="title_aracode" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                    NUESTRAS SUSCRIPCIONES
                </h1>
            </div>
            <br>
            <div x-data="{activeTab:'tabMensual'}" class="tabs flex flex-col">
                <div
                  class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200"
                >
                  <div class="tabs-list flex px-1.5 py-1">
                    <button
                      @click="activeTab = 'tabMensual'"
                      :class="activeTab === 'tabMensual' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                      class="btn shrink-0 px-3 py-1.5 font-medium"
                    >
                      Mensual
                    </button>
                    <button
                      @click="activeTab = 'tabAnual'"
                      :class="activeTab === 'tabAnual' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                      class="btn shrink-0 px-3 py-1.5 font-medium"
                    >
                      Anual
                    </button>
                  </div>
                </div>
                <div class="tab-content pt-4">
                  <div
                    x-show="activeTab === 'tabMensual'"
                    x-transition:enter="transition-all duration-500 easy-in-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                  >
                    <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6 xl:grid-cols-4">
                        <div class="flex flex-col">
                        <img class="h-44 w-full rounded-2xl object-cover object-center" 
                                src="{{ asset('themes/webpage/images/object/object-2.jpg') }}" 
                                alt="image"
                        >
                        <div class="card -mt-8 grow rounded-2xl p-4">
                            <a href="#" class="text-sm+ font-medium text-slate-700 line-clamp-1 
                                        hover:text-primary focus:text-primary dark:text-navy-100 
                                        dark:hover:text-accent-light dark:focus:text-accent-light">
                                        <h3 style="font-size: 20px;">Título del plan</h3>
                            </a>
                            <p class="mt-2 grow line-clamp-3">
                                <ul>
                                    <li><i class="fa fa-circle"></i> items 01</li>
                                    <li><i class="fa fa-circle"></i> items 02</li>
                                    <li><i class="fa fa-circle"></i> items 03</li>
                                    <li><i class="fa fa-circle"></i> items 04</li>
                                </ul>
                            </p>
                            <br>
                            <p>
                                S/ 250.00
                            </p>
                            <div class="mt-4">
                                <a>
                                    <button class="boton-degradado-courses">
                                        <b style="font-size: 18px;">
                                            <i class="fa fa-edit" aria-hidden="true" style="font-size: 20px;"></i>
                                            &nbsp; Suscribirme
                                        </b>
                                    </button>
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                  </div>
                  <div
                    x-show="activeTab === 'tabAnual'"
                    x-transition:enter="transition-all duration-500 easy-in-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                  >
                    <div class="mt-5 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6 xl:grid-cols-4">
                        <div class="flex flex-col">
                        <img class="h-44 w-full rounded-2xl object-cover object-center" 
                                src="{{ asset('themes/webpage/images/object/object-2.jpg') }}" 
                                alt="image"
                        >
                        <div class="card -mt-8 grow rounded-2xl p-4">
                            <a href="#" class="text-sm+ font-medium text-slate-700 line-clamp-1 
                                        hover:text-primary focus:text-primary dark:text-navy-100 
                                        dark:hover:text-accent-light dark:focus:text-accent-light">
                                        <h3 style="font-size: 20px;">Título del plan</h3>
                            </a>
                            <p class="mt-2 grow line-clamp-3">
                                <ul>
                                    <li><i class="fa fa-circle"></i> items 01</li>
                                    <li><i class="fa fa-circle"></i> items 02</li>
                                    <li><i class="fa fa-circle"></i> items 03</li>
                                    <li><i class="fa fa-circle"></i> items 04</li>
                                </ul>
                            </p>
                            <br>
                            <p>
                                S/ 180.00
                            </p>
                            <div class="mt-4">
                                <a>
                                    <button class="boton-degradado-courses">
                                        <b style="font-size: 18px;">
                                            <i class="fa fa-edit" aria-hidden="true" style="font-size: 20px;"></i>
                                            &nbsp; Suscribirme
                                        </b>
                                    </button>
                                </a>
                            </div>
                        </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>
        </div> 
            
        <x-social-networks /> 

        
    </main>
    
    <br>
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
