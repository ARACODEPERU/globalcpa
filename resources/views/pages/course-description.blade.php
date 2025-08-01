@extends('layouts.webpage')

@section('content')

    <!-- App Header Wrapper-->
    <x-nav />

    <!-- Sidebar -->
    <x-slidebar />

    <main class="main-content w-full px-[var(--margin-x)] pb-8">

        <section style="padding: 20px;">
            <div class="mx-auto mt-8 grid w-full grid-cols-1 gap-4 sm:grid-cols-1 sm:gap-5 lg:gap-6">
                <div class="mx-auto mt-8 grid w-full grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:gap-6">
                    <div style="place-items: center;">
                        <img src="{{ asset('storage/' . $item->course->image) }}" alt="">
                    </div>
                    <div class="p-4 sm:p-5">
                        <br>
                        {{-- <span style="font-size: 22px; line-height: 1.1; font-weight: 600;">
                            {{ $item->category_description }}
                        </span> --}}
                        <h1 class="title_aracode" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                            {{ $item->name }}
                        </h1>
                        <p class="mt-6" style="font-size: 19px; line-height: 1.3;">
                            {{ $item->description }}
                        </p>
                        <br>
                        @if ($item->price)
                            <h2 style="font-size: 35px; line-height: 1.1; font-weight: 500;">
                                S/ {{ $item->price }}
                            </h2>
                        @else
                            <h2 style="font-size: 35px; line-height: 1.1; font-weight: 500;">
                                Free
                            </h2>
                        @endif
                        <br>
                        <div class="row">
                            @if ($item->price)
                                <div class="col-md-6" style="padding: 10px 0px;">
                                    <a
                                        onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                                        <button class="boton-degradado-courses">
                                            <b>
                                                <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 16px;"></i>
                                                &nbsp; Añadir al Carrito
                                            </b>
                                        </button>
                                    </a>
                                    {{-- <a href="https://wa.link/54k2g9">
                                        <button class="boton-degradado-courses"><b>! Comprar Ahora¡</b></button>
                                    </a> --}}
                                </div>
                            @else
                                <div class="col-md-6" style="padding: 10px 0px;">
                                    <a href="">
                                        <button class="boton-degradado-courses">
                                            <b>
                                                <i class="fa fa-edit" aria-hidden="true" style="font-size: 16px;"></i>
                                                &nbsp; Registrarme
                                            </b>
                                        </button>
                                    </a>
                                </div>
                            @endif
                            @if ($course->brochure->path_file)
                                <div class="col-md-6" style="padding: 10px 0px;">
                                    {{-- <a href="{{ $course->brochure->path_file }}">
                                    <button class="boton-degradado-info">
                                        <b>
                                            <i class="fa fa-edit" aria-hidden="true" style="font-size: 16px;"></i>
                                            &nbsp; Descargar Brochure
                                        </b>
                                    </button>
                                    </a> --}}
                                    <button class="boton-degradado-info" data-bs-target="#exampleModalToggle"
                                        data-bs-toggle="modal">
                                        <b>
                                            <i class="fa fa-edit" aria-hidden="true" style="font-size: 16px;"></i>
                                            &nbsp; Descargar Brochure
                                        </b>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel"
            tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalToggleLabel">{{ $item->name }}</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('apisubscriber') }}" method="post" id="pageContactForm">
                            @csrf
                            <div class="mb-3">
                                <label for="exampleInputName" class="form-label">Nombre Completo</label>
                                <input type="text" class="form-control" id="exampleInputName" name="full_name" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputPhone" class="form-label">Teléfono</label>
                                <input type="text" class="form-control" id="exampleInputPhone" name="phone" required>
                            </div>
                            <div class="mb-3">
                                <label for="exampleInputEmail1" class="form-label">Correo Electrónico</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" name="email" required>
                            </div>
                            <input type="hidden" name="subject" value="{{ $item->name }}">
                            <input type="hidden" name="message" value="Descargué el Brochure">
                            <button type="submit" class="boton-degradado-courses" id="submitPageContactButton">Descargar Brochure</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        {{-- DURACION --}}
        {{-- <section style="padding: 30px 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-4">
                        <div class="card" style="place-items: center; padding: 40px 0px;">
                            <img style="width: 80px;" src="{{ asset ('themes/webpage/images/icons/calendario.png') }}" alt="">
                            <h2 class="title_aracode" style="font-size: 20px; line-height: 1.1; font-weight: 600; margin-top: 10px;">
                                DURACIÓN
                            </h2>
                            <p style="font-size: 17px; line-height: 1.5;">
                                03 Sesiones: 21, 22 y 23 Enero
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="place-items: center; padding: 40px 0px;">
                            <img style="width: 80px;" src="{{ asset ('themes/webpage/images/icons/horario-de-trabajo.png') }}" alt="">
                            <h2 class="title_aracode" style="font-size: 20px; line-height: 1.1; font-weight: 600; margin-top: 10px;">
                              HORARIO
                            </h2>
                            <p style="font-size: 17px; line-height: 1.5;">
                              De 07:00 pm a 10:00 pm
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card" style="place-items: center; padding: 40px 0px;">
                            <img style="width: 80px;" src="{{ asset ('themes/webpage/images/icons/educacion-a-distancia.png') }}" alt="">
                            <h2 class="title_aracode" style="font-size: 20px; line-height: 1.1; font-weight: 600; margin-top: 10px;">
                              MODALIDAD
                            </h2>
                            <p style="font-size: 17px; line-height: 1.5;">
                                Virtual (online) con casuísticas reales.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </section> --}}

        {{-- DIRIGIDO --}}
        {{-- <section style="padding: 30px 0px;">
            <div class="container card" style="padding: 20px 40px;">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title_aracode" style="font-size: 35px; line-height: 1.5; font-weight: 700; text-align: center; margin-top: 10px; margin-bottom: 30px;">
                            ¿A QUIÉNES ESTÁ DIRIGIDO?
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="padding: 10px 30px;">
                        <p style="font-size: 17px; line-height: 1.3; text-align:justify;">
                            Está dirigido a contadores, auditores, consultores contables y tributarios, así como a ejecutivos que toman decisiones
                            financieras.
                        </p>
                    </div>
                    <div class="col-md-6" style="padding: 10px 30px;">
                        <p style="font-size: 17px; line-height: 1.3; text-align:justify;">
                            También a quienes desean consolidar sus habilidades en la aplicación de normas contables y tributarias, asegurando un cierre 2024 eficiente, estratégico y libre de contingencias contables,
                            financieras y fiscales.
                        </p>
                    </div>
                </div>
            </div>
        </section> --}}

        {{-- FACILITADORES --}}
        {{-- <section style="padding: 30px 0px;">
            <div class="container card" style="padding: 20px 40px;">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title_aracode"  style="font-size: 35px; line-height: 1.5; font-weight: 700; text-align: center; margin-top: 10px; margin-bottom: 30px;">
                            FACILITADORES
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="padding: 10px 30px;">
                        <div class="row">
                            <div class="col-md-2">
                                <img style="width: 100%;" src="{{ asset('themes/webpage/images/alex-cuzcano.jpg') }}" alt="">
                            </div>
                            <div class="col-md-10">
                                <br><br>
                                <h2 style="font-size: 26px; line-height: 1.5; font-weight: 700;">
                                    MAG. ALEX CUZCANO
                                </h2>
                                <span style="font-size: 17px; line-height: 1.1; font-weight: 600;">
                                    Director Académico de Global CPA Business School
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <p style="font-size: 17px; line-height: 1.3; text-align:justify;">
                                    Destacado profesional con amplia experiencia en auditoría y asesoría
                                    contable, habiendo sido Exgerente Senior en KPMG Perú y con
                                    experiencia en Deloitte en Perú y España. Actualmente, es docente en
                                    ESANL, la PUCP, la Universidad de Lima, e instructor en el IPAI.
                                    Autor del influyente libro “El Amauta De Las NIIF”, representa al
                                    Consejo Normativo de Contabilidad en el GLENIF y es miembro de
                                    varios comités técnicos de la Junta de Decanos de Colegios de
                                    Contadores Públicos del Perú y la AIC. Reconocido conferencista, ha
                                    participado en convenciones de contabilidad y auditoría en varios
                                    países de América Latina. Su experiencia y liderazgo lo posicionan
                                    como una figura clave en el ámbito contable y financiero.
                                </p>
                                <br>
                                <span style="font-size: 17px; line-height: 1.1; font-weight: 600;">
                                    21 y 23 de enero | CIERRE CONTABLE BAJO NIIF
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding: 10px 30px;">
                        <div class="row">
                            <div class="col-md-2">
                                <img style="width: 100%;" src="{{ asset('themes/webpage/images/mario-alva.jpg') }}" alt="">
                            </div>
                            <div class="col-md-10">
                                <br><br>
                                <h2 style="font-size: 26px; line-height: 1.5; font-weight: 700;">
                                    MAG. MARIO ALVA
                                </h2>
                                <span style="font-size: 17px; line-height: 1.1; font-weight: 600;">
                                    Subdirector de la revista especializada Actualidad Empresarial
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <p style="font-size: 17px; line-height: 1.3; text-align:justify;">
                                    Abogado por la Pontificia Universidad Católica del Perú y Magíster
                                    en Contabilidad con mención en Política y Administración Tributaria
                                    por la Universidad Nacional Mayor de San Marcos. Como asociado
                                    activo del Instituto Peruano de Derecho Tributario (IPDT) y
                                    exmiembro del Consejo Directivo del SAT de Lima (2019-2022).
                                    Actualmente, es profesor en la PUCP y ESAN, donde imparte
                                    cursos especializados en tributación y derecho corporativo. Ha
                                    coescrito y escrito numerosos libros y artículos que son referencia
                                    en el campo tributario, destacando títulos como “Análisis para la
                                    aplicación del Crédito Fiscal” y “Evasión Tributaria”. Su experiencia
                                    y conocimientos lo posicionan como un líder en el sector, siempre a
                                    la vanguardia de las mejores prácticas tributarias.
                                </p>
                                <br>
                                <span style="font-size: 17px; line-height: 1.1; font-weight: 600;">
                                    22 de enero | CIERRE TRIBUTARIO 2024
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        {{-- PLAN CURRICULA --}}
        <section style="padding: 30px 0px;">
            <div class="container">
                {{-- <div class="row">
                    <div class="col-md-12">
                        <h2 class="title_aracode" style="font-size: 35px; line-height: 1.5; font-weight: 700; text-align: center; margin-top: 10px; margin-bottom: 30px;">
                            BUSCANDO TÍTULO
                        </h2>
                    </div>
                </div> --}}
                <div class="row">
                    <div class="col-md-12">
                        <div class="accordion-aracode">
                            <div class="accordion-item-aracode  card">
                                <div class="accordion-header-aracode  active" aria-expanded="true">
                                    <span class="accordion-icon-aracode">►</span>
                                    PRESENTACIÓN
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="false"
                                    style="max-height: 100%; padding: 25px 20px;">
                                    @if ($course->brochure)
                                        <p class="mt-1" style="font-size: 17px; line-height: 1.3;">
                                            {!! $course->brochure->presentation !!}
                                        </p>
                                    @endif
                                    <br>
                                </div>
                            </div>
                            <div class="accordion-item-aracode">
                                <div class="accordion-header-aracode" aria-expanded="false">
                                    <span class="accordion-icon-aracode">►</span>
                                    RUTA DE APRENDIZAJE
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="true">
                                    @if ($course->brochure)
                                        <p class="mt-1" style="font-size: 17px; line-height: 1.3;">
                                            {!! $course->brochure->curriculum_plan !!}
                                        </p>
                                    @endif
                                    <br>
                                </div>
                            </div>
                            <div class="accordion-item-aracode">
                                <div class="accordion-header-aracode" aria-expanded="false">
                                    <span class="accordion-icon-aracode">►</span>
                                    FACILITADORES
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="true">
                                    @if (count($course->teachers) > 0)
                                        @foreach ($course->teachers as $teach)
                                            <div class="row" style="margin-bottom: 20px;">
                                                <div class="col-md-2">
                                                    <a href="">
                                                        <img style="width: 150px; margin-bottom: 10px; margin-left: 10px;"
                                                            src="{{ asset('storage/' . $teach->teacher->person->image) }}"
                                                            alt="img">
                                                    </a>
                                                </div>
                                                <div class="col-md-10">
                                                    <h2 style="font-size: 18px;">
                                                        <b>
                                                            {{ $teach->teacher->person->names . ' ' . $teach->teacher->person->father_lastname . ' ' . $teach->teacher->person->mother_lastname }}
                                                        </b>
                                                    </h2>
                                                    @if (count($teach->teacher->person->resumes))
                                                        @foreach ($teach->teacher->person->resumes as $resume)
                                                            <div class="list-item-aracode" style="font-size: 17px;">
                                                                <span class="list-icon-aracode">•</span>
                                                                {{ $resume->description }}
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                    <br>
                                </div>
                            </div>
                            {{-- <div class="accordion-item-aracode">
                                <div class="accordion-header-aracode" aria-expanded="false">
                                    <span class="accordion-icon-aracode">►</span>
                                    PREGUNTAS FRECUENTES
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="true">
                                    @if ($course->brochure)
                                        {!! $course->brochure->frequent_questions !!}
                                    @endif
                                    <br>
                                </div>
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- INCLUYE --}}
        <section style="padding: 30px 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title_aracode"
                            style="font-size: 35px; line-height: 1.5; font-weight: 700; text-align: center; margin-top: 10px; margin-bottom: 30px;">
                            INCLUYE
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card" style="place-items: center; padding: 40px 10px;">
                            <img x-show="!$store.global.isDarkModeEnabled" style="width: 80px;"
                                src="{{ asset('themes/webpage/images/icons/chat-en-vivo.png') }}" alt="">
                            <img x-show="$store.global.isDarkModeEnabled" style="width: 80px;"
                                src="{{ asset('themes/webpage/images/icons/chat-en-vivo-blanco.png') }}" alt="">
                            <p style="font-size: 17px; line-height: 1.3; text-align:center; margin-top: 10px;">
                                Formación práctica en vivo con atención a tus consultas.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="place-items: center; padding: 40px 10px;">
                            <img x-show="!$store.global.isDarkModeEnabled" style="width: 80px;"
                                src="{{ asset('themes/webpage/images/icons/grabacion.png') }}" alt="">
                            <img x-show="$store.global.isDarkModeEnabled" style="width: 80px;"
                                src="{{ asset('themes/webpage/images/icons/grabacion-blanco.png') }}" alt="">
                            <p style="font-size: 17px; line-height: 1.3; text-align:center; margin-top: 10px;">
                                Acceso permanente a las grabaciones de las sesiones desde nuestra plataforma.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="place-items: center; padding: 40px 10px;">
                            <img x-show="!$store.global.isDarkModeEnabled" style="width: 80px;"
                                src="{{ asset('themes/webpage/images/icons/descarga-de-archivos.png') }}" alt="">
                            <img x-show="$store.global.isDarkModeEnabled" style="width: 80px;"
                                src="{{ asset('themes/webpage/images/icons/descarga-de-archivos-blanco.png') }}"
                                alt="">
                            <p style="font-size: 17px; line-height: 1.3; text-align:center; margin-top: 10px;">
                                Materiales disponibles para descarga inmediata.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="place-items: center; padding: 40px 10px;">
                            <img x-show="!$store.global.isDarkModeEnabled" style="width: 80px;"
                                src="{{ asset('themes/webpage/images/icons/ganador.png') }}" alt="">
                            <img x-show="$store.global.isDarkModeEnabled" style="width: 80px;"
                                src="{{ asset('themes/webpage/images/icons/ganador-blanco.png') }}" alt="">
                            <p style="font-size: 17px; line-height: 1.3; text-align:center; margin-top: 10px;">
                                Certificado de <br>participación.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </section>

        {{-- CERTIFICADO --}}
        <section style="padding: 30px 0px;">
            <div class="container  card">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <br>
                        <div style="padding: 40px 20px;">
                            <h2 class="title_aracode"
                                style="font-size: 30px; line-height: 1.5; font-weight: 700; margin-top: 10px; margin-bottom: 10px;">
                                ¡Comparte tus logros con un certificado!
                            </h2>
                            <p style="font-size: 17px; line-height: 1.3; margin-top: 10px;">
                                Cuando termines el curso tendrás acceso al certificado digital para compartirlo con tu
                                familia, amigos, empleadores y la comunidad.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="place-items: center; padding: 40px 20px;">
                            <img style="width: 100%;" src="{{ asset('themes/webpage/images/certificado.jpeg') }}"
                                alt="">
                            <p style="font-size: 17px; line-height: 1.3; margin-top: 10px;">
                                <b>* IMAGEN REFERENCIAL</b>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </section>

        <section class="padding: 30px 0px;">
            <div class="container">

                <div class="row">
                    @if ($course->price)
                        <div class="col-md-6" style="padding: 10px 0px;">
                            <a
                                onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                                <button class="boton-degradado-courses">
                                    <b>
                                        <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 16px;"></i>
                                        &nbsp; Añadir al Carrito
                                    </b>
                                </button>
                            </a>
                        </div>
                    @else
                        <div class="col-md-6" style="padding: 10px 0px;">
                            <a href="">
                                <button class="boton-degradado-courses">
                                    <b>
                                        <i class="fa fa-edit" aria-hidden="true" style="font-size: 16px;"></i>
                                        &nbsp; Registrarme
                                    </b>
                                </button>
                            </a>
                        </div>
                    @endif
                    @if ($course->brochure->path_file)
                        <div class="col-md-6" style="padding: 10px 0px;">
                            {{-- <a href="{{ $course->brochure->path_file }}">
                                <button class="boton-degradado-info">
                                    <b>
                                        <i class="fa fa-edit" aria-hidden="true" style="font-size: 16px;"></i>
                                        &nbsp; Descargar Brochure
                                    </b>
                                </button>
                            </a> --}}
                            <button class="boton-degradado-info" data-bs-target="#exampleModalToggle" data-bs-toggle="modal">
                                <b>
                                    <i class="fa fa-edit" aria-hidden="true" style="font-size: 16px;"></i>
                                    &nbsp; Descargar brochure
                                </b>
                            </button>
                        </div>
                    @endif

                </div>
            </div>
        </section>
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


    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>

<script>
    let form = document.getElementById('pageContactForm');
    form.addEventListener('submit', function(e) {
        e.preventDefault();

        var formulario = document.getElementById('pageContactForm');
        var formData = new FormData(formulario);

        // Deshabilitar el botón
        var submitButton = document.getElementById('submitPageContactButton');
        submitButton.disabled = true;
        submitButton.style.opacity = 0.25;

        // Crear una nueva solicitud XMLHttpRequest
        var xhr = new XMLHttpRequest();

        // Configurar la solicitud POST al servidor
        xhr.open('POST', "{{ route('apisubscriber') }}", true);

        // Configurar la función de callback para manejar la respuesta
        xhr.onload = function() {
            // Habilitar nuevamente el botón
            submitButton.disabled = false;
            submitButton.style.opacity = 1;
            if (xhr.status === 200) {
                var response = JSON.parse(xhr.responseText);
                Swal.fire({
                    icon: 'success',
                    title: 'Enhorabuena',
                    text: response.message,
                    customClass: {
                        container: 'sweet-modal-zindex' // Clase personalizada para controlar el z-index
                    }
                });
                formulario.reset();
            } else if (xhr.status === 422) {
                var errorResponse = JSON.parse(xhr.responseText);
                // Maneja los errores de validación aquí, por ejemplo, mostrando los mensajes de error en algún lugar de tu página.
                var errorMessages = errorResponse.errors;
                var errorMessageContainer = document.getElementById('messagePageContact');
                errorMessageContainer.innerHTML = 'Errores de validación:<br>';
                for (var field in errorMessages) {
                    if (errorMessages.hasOwnProperty(field)) {
                        errorMessageContainer.innerHTML += field + ': ' + errorMessages[field].join(', ') +
                            '<br>';
                    }
                }
            } else {
                console.error('Error en la solicitud: ' + xhr.status);
            }
            const downloadUrl = "{{ $course->brochure->path_file }}";
            window.open(downloadUrl, '_blank'); // '_blank' abre en nueva pestaña

        };

        // Enviar la solicitud al servidor
        xhr.send(formData);
    });
</script>

@stop
