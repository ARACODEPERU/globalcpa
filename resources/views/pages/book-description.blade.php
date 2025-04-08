@extends('layouts.webpage')

@section('content')

    <main class="main-content w-full px-[var(--margin-x)] pb-8">


        <div class="mt-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 lg:mt-6">

            <div style="text-align:center;">
                <h1 class="title_aracode" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                    LAS NIIF COMO NUNCA TE LO EXPLICARON
                </h1>
            </div>

        </div>

        <br>

        <div class="grid grid-cols-12 gap-4 mt-4 px-[var(--margin-x)] transition-all duration-[.25s]  sm:gap-5 lg:gap-6">
            <div class="col-span-12 lg:col-span-4">
                <div class="card p-4 sm:p-5">
                    <img src="{{ asset('themes/webpage/images/amauta-book.jpeg') }}" alt="">
                </div>
            </div>
            <div class="col-span-12 lg:col-span-8">
                <div class="card">
                    <div class="items-center space-y-4 border-b border-slate-200 
                            p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                            EL AMAUTA DE LAS NIIF
                        </h2>
                        <p>
                            Dirigida a los contadores públicos, auditores,
                            consultores, directivos y gerentes financieros de
                            grandes empresas obligadas a aplicar las NIIF
                            Plenas, de pequeñas y medianas empresas (NIIF
                            para PYMES), contadores públicos y funcionarios
                            públicos de la alta dirección de empresas del
                            Estado sujetas a las NICSP y estudiantes de las
                            facultades de Contabilidad.
                        </p>
                    </div>
                    <div class="p-4 sm:p-5">

                        <div x-data="{activeTab:'tabHome'}" class="tabs flex flex-col">
                            <div
                              class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200"
                            >
                              <div class="tabs-list flex px-1.5 py-1">
                                <button
                                  @click="activeTab = 'tabHome'"
                                  :class="activeTab === 'tabHome' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                  class="btn shrink-0 px-3 py-1.5 font-medium"
                                >
                                    Obligación
                                </button>
                                <button
                                  @click="activeTab = 'tabProfile'"
                                  :class="activeTab === 'tabProfile' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                  class="btn shrink-0 px-3 py-1.5 font-medium"
                                >
                                  Profile
                                </button>
                                <button
                                  @click="activeTab = 'tabMessages'"
                                  :class="activeTab === 'tabMessages' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                  class="btn shrink-0 px-3 py-1.5 font-medium"
                                >
                                  Messages
                                </button>
                                <button
                                  @click="activeTab = 'tabSettings'"
                                  :class="activeTab === 'tabSettings' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                  class="btn shrink-0 px-3 py-1.5 font-medium"
                                >
                                  Settings
                                </button>
                              </div>
                            </div>
                            <div class="tab-content pt-4">
                              <div
                                x-show="activeTab === 'tabHome'"
                                x-transition:enter="transition-all duration-500 easy-in-out"
                                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                              >
                                <div>
                                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                        "Piensa en NIIF y existirás contablemente"
                                    </h2>
                                    <p>
                                        La adopción de las NIIF en el Perú de modo
                                        obligatorio, con el objetivo de estandarizar la
                                        información financiera y mejorar la comparabilidad
                                        y transparencia de los estados financieros a nivel
                                        nacional e internacional, ha sido un proceso
                                        gradual, con diferentes fechas de implementación
                                        según el tipo y tamaño de las empresas.
                                    </p>
                                    <br>
                                    <p>
                                        Si se discutiera la obligatoriedad de la aplicación
                                        de las NIIF Plenas o para las PYMES y de las NICSP,
                                        el Decreto Legislativo N° 1525 (18/02/2022), en
                                        su artículo 4 referido al Sistema Nacional de
                                        Contabilidad, pone punto final a tal controversia.
                                    </p>
                                </div>
                              </div>
                              <div
                                x-show="activeTab === 'tabProfile'"
                                x-transition:enter="transition-all duration-500 easy-in-out"
                                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                              >
                                <div>
                                  <p>
                                    Pellentesque pulvinar, sapien eget fermentum sodales, felis lacus
                                    viverra magna, id pulvinar odio metus non enim. Ut id augue
                                    interdum, ultrices felis eu, tincidunt libero.
                                  </p>
                                  <div class="flex space-x-2 pt-3">
                                    <a
                                      href="#"
                                      class="tag rounded-full border border-primary text-primary dark:border-accent-light dark:text-accent-light"
                                    >
                                      Tag 1
                                    </a>
                                    <a
                                      href="#"
                                      class="tag rounded-full border border-primary text-primary dark:border-accent-light dark:text-accent-light"
                                    >
                                      Tag 2
                                    </a>
                                  </div>
                        
                                  <p class="pt-3 text-xs text-slate-400 dark:text-navy-300">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore
                                    dolore non atque?
                                  </p>
                                </div>
                              </div>
                              <div
                                x-show="activeTab === 'tabMessages'"
                                x-transition:enter="transition-all duration-500 easy-in-out"
                                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                              >
                                <div>
                                  <p>
                                    Cras iaculis ipsum quis lectus faucibus, in mattis nulla molestie.
                                    Vestibulum vel tristique libero. Morbi vulputate odio at viverra
                                    sodales. Curabitur accumsan justo eu libero porta ultrices vitae eu
                                    leo.
                                  </p>
                                  <div class="flex space-x-2 pt-3">
                                    <a
                                      href="#"
                                      class="tag rounded-full border border-primary text-primary dark:border-accent-light dark:text-accent-light"
                                    >
                                      Tag 1
                                    </a>
                                    <a
                                      href="#"
                                      class="tag rounded-full border border-primary text-primary dark:border-accent-light dark:text-accent-light"
                                    >
                                      Tag 2
                                    </a>
                                  </div>
                        
                                  <p class="pt-3 text-xs text-slate-400 dark:text-navy-300">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore
                                    dolore non atque?
                                  </p>
                                </div>
                              </div>
                              <div
                                x-show="activeTab === 'tabSettings'"
                                x-transition:enter="transition-all duration-500 easy-in-out"
                                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                              >
                                <div>
                                  <p>
                                    Etiam nec ante eget lacus vulputate egestas non iaculis tellus.
                                    Suspendisse tempus ex in tortor venenatis malesuada. Aenean
                                    consequat dui vitae nibh lobortis condimentum. Duis vel risus est.
                                  </p>
                                  <div class="flex space-x-2 pt-3">
                                    <a
                                      href="#"
                                      class="tag rounded-full border border-primary text-primary dark:border-accent-light dark:text-accent-light"
                                    >
                                      Tag 1
                                    </a>
                                    <a
                                      href="#"
                                      class="tag rounded-full border border-primary text-primary dark:border-accent-light dark:text-accent-light"
                                    >
                                      Tag 2
                                    </a>
                                  </div>
                        
                                  <p class="pt-3 text-xs text-slate-400 dark:text-navy-300">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore
                                    dolore non atque?
                                  </p>
                                </div>
                              </div>
                            </div>
                          </div>
                        <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>

                        <div class="flex items-center justify-between pt-4">
                            <button
                                class="btn h-8 rounded-full border border-slate-200 px-3 text-xs+ font-medium text-primary hover:bg-slate-150 focus:bg-slate-150 active:bg-slate-150/80 dark:border-navy-500 dark:text-accent-light dark:hover:bg-navy-500 dark:focus:bg-navy-500 dark:active:bg-navy-500/90">
                                Descargar Brochure
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <br>

        <div class="mt-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 lg:mt-6">
            <x-social-networks />
        </div>


    </main>

@stop
