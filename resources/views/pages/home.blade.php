@extends('layouts.webpage')

@section('content')




    <main class="main-content w-full px-[var(--margin-x)] pb-8">

        <section class="bg-gray-100 flex items-center justify-center h-screen w-full">
                <div class="slider w-full rounded-lg shadow-lg">
                    <div class="slides">
                        <div class="slide">
                            <img src="https://netzun.com/_nuxt/img/banner_desktop.1656de5.webp" alt="Imagen 1" class="w-full">
                        </div>
                        <div class="slide">
                            <img src="https://netzun.com/_nuxt/img/home-new-first.6aa270a.jpg" alt="Imagen 2" class="w-full">
                        </div>
                        <div class="slide">
                            <img src="https://netzun.com/_nuxt/img/banner_desktop.1656de5.webp" alt="Imagen 3" class="w-full">
                        </div>
                    </div>
                </div>
        </section>

        <section style="padding: 20px 10px;">
            <div class="mx-auto grid w-full grid-cols-1 gap-4 sm:grid-cols-1 sm:gap-5 lg:gap-6">
                <div class="card" style="place-items: center; padding: 20px 0px;">
                    <h1 style="font-size: 60px; line-height: 1.1; font-weight: 900; text-align:center; ">
                        CURSO TALLER
                    </h1>
                </div>
            </div>
        </section>
        
        <section style="padding: 20px;">
            <div class="mx-auto mt-8 grid w-full grid-cols-1 gap-4 sm:grid-cols-1 sm:gap-5 lg:gap-6">
                <div class="mx-auto mt-8 grid w-full grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:gap-6">
                    <div style="place-items: center;">
                        <img src="{{ asset('themes/webpage/images/cc.jpg') }}" alt="">
                    </div>
                    <div class="p-4 sm:p-5">
                        <h1 style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                            CIERRE CONTABLE Y TRIBUTARIO
                        </h1>
                        <span style="font-size: 24px; line-height: 1.1; font-weight: 600;">
                            Ejercicio 2024
                        </span>
                        <p class="mt-8" style="font-size: 20px; line-height: 1.5;">
                            Este curso está diseñado para capacitarte y
                            actualizarte en los requerimientos establecidos en las
                            Normas Internacionales de Información Financiera
                            (NIIF) para un adecuado cierre de los estados
                            financieros del año 2024. Asimismo, se abordará lo
                            relacionado a la determinación del impuesto a la
                            renta, considerando los criterios clave para la óptima
                            deducción de los gastos, y de esa manera minimizar
                            riesgos fiscales.
                        </p>
                    </div>
                </div>
            </div>
        </section>

        <section style="padding: 20px 40px;">
            <div class="mx-auto mt-8 grid w-full grid-cols-1 gap-4 sm:grid-cols-3 sm:gap-5 lg:gap-6">
                <div class="card p-4 sm:p-5" style="place-items: center;">
                    <img style="width: 80px;" src="{{ asset ('themes/webpage/images/icons/calendario.png') }}" alt="">
                    <h2 class="mt-5 text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                        DURACIÓN
                    </h2>
                    <p class="mt-1">
                        03 Sesiones: 21, 22 y 23 Enero
                    </p>
                </div>
                <div class="card p-4 sm:p-5" style="place-items: center;">
                    <img style="width: 80px;" src="{{ asset ('themes/webpage/images/icons/horario-de-trabajo.png') }}" alt="">
                    <h2 class="mt-5 text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                      HORARIO
                    </h2>
                    <p class="mt-1">
                      De 07:00 pm a 10:00 pm
                    </p>
                </div>
                <div class="card p-4 sm:p-5" style="place-items: center;">
                    <img style="width: 80px;" src="{{ asset ('themes/webpage/images/icons/educacion-a-distancia.png') }}" alt="">
                    <h2 class="mt-5 text-base font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100">
                      MODALIDAD
                    </h2>
                    <p class="mt-1">
                        Virtual (online) con casuísticas reales.
                    </p>
                </div>
            </div>
        </section>
        
        <section style="padding: 30px 0px;">
            <div class="container card" style="padding: 20px 40px;">
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="font-size: 35px; line-height: 1.5; font-weight: 700; text-align: center; margin-top: 10px; margin-bottom: 60px;">
                            ¿A QUIÉNES ESTÁ DIRIGIDO?
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="padding: 10px;">
                        <p style="font-size: 20px; line-height: 1.5;">
                            Está dirigido a contadores, auditores, consultores contables y tributarios, así como a ejecutivos que toman decisiones
                            financieras.
                        </p>
                    </div>
                    <div class="col-md-6" style="padding: 10px;">
                        <p style="font-size: 20px; line-height: 1.5;">
                            También a quienes desean consolidar sus habilidades en la aplicación de normas contables y tributarias, asegurando un cierre 2024 eficiente, estratégico y libre de contingencias contables,
                            financieras y fiscales.
                        </p>
                    </div>
                </div>
            </div>
        </section>
        
        <section style="padding: 30px 0px;">
            <div class="container card" style="padding: 20px 40px;">
                <div class="row">
                    <div class="col-md-12">
                        <h2 style="font-size: 35px; line-height: 1.5; font-weight: 700; text-align: center; margin-top: 10px; margin-bottom: 60px;">
                            FACILITADORES
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6" style="padding: 10px;">
                        <div class="row">
                            <div class="col-md-2">
                                <img style="width: 100%;" src="{{ asset('themes/webpage/images/alex-cuzcano.jpg') }}" alt="">
                            </div>
                            <div class="col-md-10">
                                <h2 style="font-size: 26px; line-height: 1.5; font-weight: 700;">
                                    MAG. ALEX CUZCANO
                                </h2>
                                <span style="font-size: 20px; line-height: 1.1; font-weight: 600;">
                                    Director Académico de Global CPA Business School
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <p style="font-size: 20px; line-height: 1.5;">
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
                                <span style="font-size: 20px; line-height: 1.1; font-weight: 600;">
                                    21 y 23 de enero | CIERRE CONTABLE BAJO NIIF
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" style="padding: 10px;">
                        <div class="row">
                            <div class="col-md-2">
                                <img style="width: 100%;" src="{{ asset('themes/webpage/images/mario-alva.jpg') }}" alt="">
                            </div>
                            <div class="col-md-10">
                                <h2 style="font-size: 26px; line-height: 1.5; font-weight: 700;">
                                    MAG. MARIO ALVA
                                </h2>
                                <span style="font-size: 20px; line-height: 1.1; font-weight: 600;">
                                    Subdirector de la revista especializada Actualidad Empresarial
                                </span>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-md-12">
                                <p style="font-size: 20px; line-height: 1.5;">
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
                                <span style="font-size: 20px; line-height: 1.1; font-weight: 600;">
                                    22 de enero | CIERRE TRIBUTARIO 2024
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>


    </main>
    
    
    <div id="whatsapp">
        <a href="" class="wtsapp" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa fa-whatsapp"></i>
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

@stop
