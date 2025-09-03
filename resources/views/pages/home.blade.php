@extends('layouts.webpage')

@section('content')


    <!-- App Header Wrapper-->
    <x-nav />

    <!-- Sidebar -->
    <x-slidebar />


    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <br>
        <x-slider />

        <div class=" mt-4 w-full transition-all duration-[.25s] sm:mt-5 lg:mt-6">
            <div class="col-span-12 space-y-4 sm:space-y-5 lg:col-span-12 lg:space-y-6 xl:col-span-12">
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
                <br>
                <a href="{{ route('web_courses') }}">
                    <button class="boton-degradado-courses">
                        <b>
                            <i class="fa fa-graduation-cap" aria-hidden="true" style="font-size: 18px;"></i>
                            &nbsp; Webinar / Cursos Taller / Programas de Especialización
                        </b>
                    </button>
                </a>
            </div>
        </div>


        <x-subscriptions /> 


        <x-social-networks />
        
        <x-footer />



    </main>

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
