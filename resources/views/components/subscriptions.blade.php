<div>

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
    
</div>