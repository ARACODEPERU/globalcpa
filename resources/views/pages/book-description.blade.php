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
                            Account Setting
                        </h2>
                        <p class="text-xs+ text-slate-400 dark:text-navy-300">
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

                        <div class="grid grid-cols-1 gap-4  w-full">
                            <div x-data="{ expandedItem: null }" class="flex flex-col space-y-4 sm:space-y-5 lg:space-y-6">
                                <div x-data="accordionItem('item-1')"
                                    class="overflow-hidden rounded-lg border border-slate-150 dark:border-navy-500">
                                    <div
                                        class="flex items-center justify-between bg-slate-150 px-4 py-4 dark:bg-navy-500 sm:px-5">
                                        <div
                                            class="flex items-center space-x-3.5 tracking-wide outline-none transition-all ">
                                            <div class="avatar size-10">
                                                <img class="rounded-full" src="images/avatar/avatar-10.jpg"
                                                    alt="avatar" />
                                            </div>
                                            <div>
                                                <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                    Simon Tods
                                                </p>
                                                <p class="text-xs text-slate-500 dark:text-navy-300">
                                                    Web Developer
                                                </p>
                                            </div>
                                        </div>
                                        <button @click="expanded = !expanded"
                                            class="btn -mr-1.5 size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                            <i :class="expanded && '-rotate-180'"
                                                class="fas fa-chevron-down text-sm transition-transform"></i>
                                        </button>
                                    </div>
                                    <div x-collapse x-show="expanded">
                                        <div class="px-4 py-4 sm:px-5">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi
                                                earum magni officiis possimus repellendus. Accusantium adipisci
                                                aliquid praesentium quaerat voluptate.
                                            </p>
                                            <div class="mt-4 flex justify-between">
                                                <div class="flex flex-wrap -space-x-2">
                                                    <div class="avatar size-7 hover:z-10">
                                                        <img class="rounded-full ring ring-white dark:ring-navy-700"
                                                            src="images/avatar/avatar-16.jpg" alt="avatar" />
                                                    </div>

                                                    <div class="avatar size-7 hover:z-10">
                                                        <div
                                                            class="is-initial rounded-full bg-info text-xs+ uppercase text-white ring ring-white dark:ring-navy-700">
                                                            jd
                                                        </div>
                                                    </div>

                                                    <div class="avatar size-7 hover:z-10">
                                                        <img class="rounded-full ring ring-white dark:ring-navy-700"
                                                            src="images/avatar/avatar-20.jpg" alt="avatar" />
                                                    </div>

                                                    <div class="avatar size-7 hover:z-10">
                                                        <img class="rounded-full ring ring-white dark:ring-navy-700"
                                                            src="images/avatar/avatar-8.jpg" alt="avatar" />
                                                    </div>

                                                    <div class="avatar size-7 hover:z-10">
                                                        <img class="rounded-full ring ring-white dark:ring-navy-700"
                                                            src="images/avatar/avatar-5.jpg" alt="avatar" />
                                                    </div>
                                                </div>
                                                <button
                                                    class="btn size-7 rounded-full bg-slate-150 p-0 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 rotate-45"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div x-data="accordionItem('item-2')"
                                    class="overflow-hidden rounded-lg border border-slate-150 dark:border-navy-500">
                                    <div
                                        class="flex items-center justify-between bg-slate-150 px-4 py-4 dark:bg-navy-500 sm:px-5">
                                        <div
                                            class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                                            <div class="avatar size-10">
                                                <div class="is-initial rounded-full bg-warning uppercase text-white">
                                                    KG
                                                </div>
                                            </div>
                                            <div>
                                                <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                    Konnor Guzman
                                                </p>
                                                <p class="text-xs text-slate-500 dark:text-navy-300">
                                                    Frontend Developer
                                                </p>
                                            </div>
                                        </div>
                                        <button @click="expanded = !expanded"
                                            class="btn -mr-1.5 size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                            <i :class="expanded && '-rotate-180'"
                                                class="fas fa-chevron-down text-sm transition-transform"></i>
                                        </button>
                                    </div>
                                    <div x-collapse x-show="expanded">
                                        <div class="px-4 py-4 sm:px-5">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi
                                                earum magni officiis possimus repellendus. Accusantium adipisci
                                                aliquid praesentium quaerat voluptate.
                                            </p>
                                            <div class="mt-4 flex justify-between">
                                                <div class="flex flex-wrap -space-x-2">
                                                    <div class="avatar size-7 hover:z-10">
                                                        <img class="rounded-full ring ring-white dark:ring-navy-700"
                                                            src="images/avatar/avatar-16.jpg" alt="avatar" />
                                                    </div>

                                                    <div class="avatar size-7 hover:z-10">
                                                        <div
                                                            class="is-initial rounded-full bg-info text-xs+ uppercase text-white ring ring-white dark:ring-navy-700">
                                                            jd
                                                        </div>
                                                    </div>

                                                    <div class="avatar size-7 hover:z-10">
                                                        <img class="rounded-full ring ring-white dark:ring-navy-700"
                                                            src="images/avatar/avatar-20.jpg" alt="avatar" />
                                                    </div>

                                                    <div class="avatar size-7 hover:z-10">
                                                        <img class="rounded-full ring ring-white dark:ring-navy-700"
                                                            src="images/avatar/avatar-8.jpg" alt="avatar" />
                                                    </div>

                                                    <div class="avatar size-7 hover:z-10">
                                                        <img class="rounded-full ring ring-white dark:ring-navy-700"
                                                            src="images/avatar/avatar-5.jpg" alt="avatar" />
                                                    </div>
                                                </div>
                                                <button
                                                    class="btn size-7 rounded-full bg-slate-150 p-0 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 rotate-45"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div x-data="accordionItem('item-3')"
                                    class="overflow-hidden rounded-lg border border-slate-150 dark:border-navy-500">
                                    <div
                                        class="flex items-center justify-between bg-slate-150 px-4 py-4 dark:bg-navy-500 sm:px-5">
                                        <div
                                            class="flex items-center space-x-3.5 tracking-wide outline-none transition-all">
                                            <div class="avatar size-10">
                                                <img class="rounded-full" src="images/avatar/avatar-19.jpg"
                                                    alt="avatar" />
                                            </div>
                                            <div>
                                                <p class="text-slate-700 line-clamp-1 dark:text-navy-100">
                                                    Derrick Simmons
                                                </p>
                                                <p class="text-xs text-slate-500 dark:text-navy-300">
                                                    UI/UX Designer
                                                </p>
                                            </div>
                                        </div>
                                        <button @click="expanded = !expanded"
                                            class="btn -mr-1.5 size-8 rounded-full p-0 hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25">
                                            <i :class="expanded && '-rotate-180'"
                                                class="fas fa-chevron-down text-sm transition-transform"></i>
                                        </button>
                                    </div>
                                    <div x-collapse x-show="expanded">
                                        <div class="px-4 py-4 sm:px-5">
                                            <p>
                                                Lorem ipsum dolor sit amet, consectetur adipisicing elit. Commodi
                                                earum magni officiis possimus repellendus. Accusantium adipisci
                                                aliquid praesentium quaerat voluptate.
                                            </p>
                                            <div class="mt-4 flex justify-between">
                                                <div class="flex flex-wrap -space-x-2">
                                                    <div class="avatar size-7 hover:z-10">
                                                        <img class="rounded-full ring ring-white dark:ring-navy-700"
                                                            src="images/avatar/avatar-16.jpg" alt="avatar" />
                                                    </div>

                                                    <div class="avatar size-7 hover:z-10">
                                                        <div
                                                            class="is-initial rounded-full bg-info text-xs+ uppercase text-white ring ring-white dark:ring-navy-700">
                                                            jd
                                                        </div>
                                                    </div>

                                                    <div class="avatar size-7 hover:z-10">
                                                        <img class="rounded-full ring ring-white dark:ring-navy-700"
                                                            src="images/avatar/avatar-20.jpg" alt="avatar" />
                                                    </div>

                                                    <div class="avatar size-7 hover:z-10">
                                                        <img class="rounded-full ring ring-white dark:ring-navy-700"
                                                            src="images/avatar/avatar-8.jpg" alt="avatar" />
                                                    </div>

                                                    <div class="avatar size-7 hover:z-10">
                                                        <img class="rounded-full ring ring-white dark:ring-navy-700"
                                                            src="images/avatar/avatar-5.jpg" alt="avatar" />
                                                    </div>
                                                </div>
                                                <button
                                                    class="btn size-7 rounded-full bg-slate-150 p-0 font-medium text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                                                    <svg xmlns="http://www.w3.org/2000/svg" class="size-5 rotate-45"
                                                        fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M7 11l5-5m0 0l5 5m-5-5v12" />
                                                    </svg>
                                                </button>
                                            </div>
                                        </div>
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
