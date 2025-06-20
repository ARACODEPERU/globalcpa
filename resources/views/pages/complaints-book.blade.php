@extends('layouts.webpage')

@section('content')

    <!-- App Header Wrapper-->
    <x-nav />

    <!-- Sidebar -->
    <x-slidebar />

    <main class="main-content w-full px-[var(--margin-x)] pb-8">

        <div class="mt-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 lg:mt-6">
            <div style="text-align:center;">
                <h1 class="title_aracode" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                    LIBRO DE RECLAMACIONES
                </h1>
            </div>
            <br>
            <div x-data="{activeTab:'tabPersona'}" class="tabs flex flex-col">
                <div
                  class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200"
                >
                  <div class="tabs-list flex px-1.5 py-1">
                    <button
                      @click="activeTab = 'tabPersona'"
                      :class="activeTab === 'tabPersona' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                      class="btn shrink-0 px-3 py-1.5 font-medium"
                    >
                      Persona
                    </button>
                    <button
                      @click="activeTab = 'tabEmpresa'"
                      :class="activeTab === 'tabEmpresa' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                      class="btn shrink-0 px-3 py-1.5 font-medium"
                    >
                      Empresa
                    </button>
                  </div>
                </div>
                <div class="tab-content pt-4">
                  <div
                    x-show="activeTab === 'tabPersona'"
                    x-transition:enter="transition-all duration-500 easy-in-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                  >
                    <div class="col-span-12 sm:col-span-8">
                        <div class="card p-4 sm:p-5">
                            <div class="mt-4 space-y-4">
                                <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                                1. INFORMACIÓN DEL CONSUMIDOR RECLAMANTE
                                </p>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                                    <label class="block sm:col-span-4">
                                        <span>Tu Nombre *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 
                                                    pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 
                                                    dark:hover:border-navy-400 dark:focus:border-accent" 
                                                    placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Tus Apellidos *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 
                                                    py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary 
                                                    dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                    placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Tipo de Documento *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 
                                                    pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary 
                                                    dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                    placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Número de Documento *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 
                                                    py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary 
                                                    dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                    placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Tu Teléfono *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 
                                                    placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 
                                                    dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Tu Correo Electrónico *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 
                                                    placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 
                                                    dark:focus:border-accent" placeholder="" type="text">
                                        </span>
                                    </label>
                                </div>
                                <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                                    2. IDENTIFICACIÓN DEL BIEN CONTRATADO
                                </p>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                                    <label class="block sm:col-span-4">
                                        <span>Tipo del Producto *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 
                                                    placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary 
                                                    dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                    placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Nombre del Producto *</span>
                                        <span class="relative mt-1.5 flex">
                                            <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 
                                                placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 
                                                dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Monto Reclamado *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 
                                                    bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 
                                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                        placeholder="" type="text">
                                        </span>
                                    </label>
                                </div>
                                <label class="block">
                                <span>Detalle de la Reclamación *</span>
                                <textarea rows="4" placeholder="" class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"></textarea>
                                </label>
                                <div x-data="{sameBillingAddress:true}">
                                    <div class="flex-wrap items-start space-y-2 pt-2 sm:flex sm:space-y-0 sm:space-x-5">
                                        <label class="inline-flex items-center space-x-2">
                                            <input x-model="sameBillingAddress" class="form-checkbox is-basic size-5 rounded border-slate-400/70 
                                                checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 
                                                dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox">
                                            <span>Declaro ser el usuario del servicio o producto y acepto el contenido del presente formulario manifestando bajo Declaración Jurada la veracidad de los hechos descritos</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex justify-end space-x-2">
                                    <button class="boton-degradado-courses">
                                        <b>
                                            <i class="fa fa-paper-plane" aria-hidden="true" style="font-size: 16px;"></i>
                                            &nbsp; Enviar
                                        </b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                  <div
                    x-show="activeTab === 'tabEmpresa'"
                    x-transition:enter="transition-all duration-500 easy-in-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                  >
                    <div class="col-span-12 sm:col-span-8">
                        <div class="card p-4 sm:p-5">
                            <div class="mt-4 space-y-4">
                                <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                                1. INFORMACIÓN DEL CONSUMIDOR RECLAMANTE
                                </p>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                                    <label class="block sm:col-span-4">
                                        <span>Razón Social *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 
                                                    pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 
                                                    dark:hover:border-navy-400 dark:focus:border-accent" 
                                                    placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>R.U.C *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 
                                                    pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 
                                                    dark:hover:border-navy-400 dark:focus:border-accent" 
                                                    placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Tu Nombre *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 
                                                    pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 
                                                    dark:hover:border-navy-400 dark:focus:border-accent" 
                                                    placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Tus Apellidos *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 
                                                    py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary 
                                                    dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                    placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Tipo de Documento *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 
                                                    pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary 
                                                    dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                    placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Número de Documento *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 
                                                    py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary 
                                                    dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                    placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Tu Teléfono *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 
                                                    placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 
                                                    dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Tu Correo Electrónico *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 
                                                    placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 
                                                    dark:focus:border-accent" placeholder="" type="text">
                                        </span>
                                    </label>
                                </div>
                                <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                                    2. IDENTIFICACIÓN DEL BIEN CONTRATADO
                                </p>
                                <div class="grid grid-cols-1 gap-4 sm:grid-cols-12">
                                    <label class="block sm:col-span-4">
                                        <span>Tipo del Producto *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 
                                                    placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary 
                                                    dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                    placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Nombre del Producto *</span>
                                        <span class="relative mt-1.5 flex">
                                            <input class="form-input peer w-full rounded-lg border border-slate-300 bg-transparent px-3 py-2 pl-9 
                                                placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 
                                                dark:hover:border-navy-400 dark:focus:border-accent" placeholder="" type="text">
                                        </span>
                                    </label>
                                    <label class="block sm:col-span-4">
                                        <span>Monto Reclamado *</span>
                                        <span class="relative mt-1.5 flex">
                                        <input class="form-input peer w-full rounded-lg border border-slate-300 
                                                    bg-transparent px-3 py-2 pl-9 placeholder:text-slate-400/70 hover:border-slate-400 
                                                    focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent" 
                                                        placeholder="" type="text">
                                        </span>
                                    </label>
                                </div>
                                <label class="block">
                                <span>Detalle de la Reclamación *</span>
                                <textarea rows="4" placeholder="" class="form-textarea mt-1.5 w-full rounded-lg border border-slate-300 bg-transparent p-2.5 placeholder:text-slate-400/70 hover:border-slate-400 focus:border-primary dark:border-navy-450 dark:hover:border-navy-400 dark:focus:border-accent"></textarea>
                                </label>
                                <div x-data="{sameBillingAddress:true}">
                                    <div class="flex-wrap items-start space-y-2 pt-2 sm:flex sm:space-y-0 sm:space-x-5">
                                        <label class="inline-flex items-center space-x-2">
                                            <input x-model="sameBillingAddress" class="form-checkbox is-basic size-5 rounded border-slate-400/70 
                                                checked:border-primary checked:bg-primary hover:border-primary focus:border-primary dark:border-navy-400 
                                                dark:checked:border-accent dark:checked:bg-accent dark:hover:border-accent dark:focus:border-accent" type="checkbox">
                                            <span>Declaro ser el usuario del servicio o producto y acepto el contenido del presente formulario manifestando bajo Declaración Jurada la veracidad de los hechos descritos</span>
                                        </label>
                                    </div>
                                </div>
                                <div class="flex justify-end space-x-2">
                                    <button class="boton-degradado-courses">
                                        <b>
                                            <i class="fa fa-paper-plane" aria-hidden="true" style="font-size: 16px;"></i>
                                            &nbsp; Enviar
                                        </b>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                  </div>
                </div>
            </div>

        </div> 

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
