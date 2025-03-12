@extends('layouts.webpage')

@section('content')




    <main class="main-content w-full px-[var(--margin-x)] pb-8">
    <br>
        <section class="bg-gray-100 flex items-center justify-center  w-full">
                <div class="slider w-full rounded-lg shadow-lg">
                    <div class="slides">
                        <div class="slide">
                            <img src="{{ asset('themes/webpage/images/slider_01.jpeg') }}" alt="Imagen 1" class="w-full">
                        </div>
                        <div class="slide">
                            <img src="{{ asset('themes/webpage/images/slider_02.jpeg') }}" alt="Imagen 2" class="w-full">
                        </div>
                        <div class="slide">
                            <img src="{{ asset('themes/webpage/images/slider_03.jpeg') }}" alt="Imagen 3" class="w-full">
                        </div>
                        <div class="slide">
                            <img src="{{ asset('themes/webpage/images/slider_04.jpeg') }}" alt="Imagen 3" class="w-full">
                        </div>
                        <div class="slide">
                            <img src="{{ asset('themes/webpage/images/slider_05.jpeg') }}" alt="Imagen 3" class="w-full">
                        </div>
                    </div>
                </div>
        </section>

        {{-- <section style="padding: 20px 10px;">
            <div class="mx-auto grid w-full grid-cols-1 gap-4 sm:grid-cols-1 sm:gap-5 lg:gap-6">
                <div class="card" style="place-items: center; padding: 20px 0px;">
                    <h1 class="title_aracode" style="font-size: 60px; line-height: 1.1; font-weight: 900; text-align:center; ">
                        CURSO TALLER
                    </h1>
                </div>
            </div>
        </section> --}}

        <div class="mt-3 grid grid-cols-12 gap-4 sm:gap-5 lg:gap-6">
            <div class="col-span-12 space-y-4 sm:space-y-5 lg:col-span-12 lg:space-y-6 xl:col-span-12">
                <div>
                    <div class="flex items-center justify-between">
                        <h3 class="text-xl font-medium text-slate-800 dark:text-navy-50">
                            Global CPA Business School | Formación:
                        </h3>
                        <div class="hidden w-full max-w-xs justify-between space-x-4 text-slate-700 dark:text-navy-100 sm:flex" x-data="{activeTab:'tabAll'}">
                            <button @click="activeTab = 'tabAll'" class="font-medium tracking-wide text-primary dark:text-accent-light" :class="activeTab === 'tabAll' &amp;&amp; 'text-primary dark:text-accent-light' ">
                            Todos
                            </button>
                            <button @click="activeTab = 'tabArt'" class="font-medium tracking-wide" :class="activeTab === 'tabArt' &amp;&amp; 'text-primary dark:text-accent-light' ">
                            Cursos
                            </button>
                            <button @click="activeTab = 'tabSport'" class="font-medium tracking-wide" :class="activeTab === 'tabSport' &amp;&amp; 'text-primary dark:text-accent-light' ">
                            Programas
                            </button>
                        </div>
                    </div>
                    <!--Courses One Start-->
                    <x-courses.list-card /> 
                    <!--Courses One End-->
              </div>
            </div>
            {{-- <div class="col-span-12 space-y-4 sm:space-y-5 lg:col-span-4 lg:space-y-6 xl:col-span-3">
              <div class="card bg-gradient-to-br from-info to-info-focus p-4">
                <div class="mt-10">
                  <div class="flex justify-between">
                    <p class="text-2xl font-semibold text-white">Banner promocion</p>
                    <br>
                    <br>
                    <br>
                  </div>
                </div>
              </div>
                  
              <div class="card p-3">
                <img class="h-56 w-full rounded-lg object-cover object-center" src="images/object/object-18.jpg" alt="image">
                <div class="mt-3 p-1">
                  <div class="flex items-center justify-between space-x-1">
                    <a href="#" class="text-base font-medium text-slate-700 line-clamp-1 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
                      The Runner #033
                    </a>
                    <button x-data="{isLiked:true}" @click="isLiked = !isLiked" class="btn size-7 rounded-full bg-slate-150 p-0 text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                      <i x-show="!isLiked" class="fa-regular fa-heart" style="display: none;"></i>
                      <i x-show="isLiked" class="fa-solid fa-heart text-error"></i>
                    </button>
                  </div>
                  <p class="mt-2 text-xs+">
                    Lorem ipsum, dolor sit amet consectetur adipisicing elit.
                    Perferendis optio laudantium
                  </p>
                  <div class="mt-5 flex items-center justify-between space-x-2">
                    <div class="flex items-center space-x-2">
                      <div class="avatar size-10">
                        <img class="rounded-full" src="images/avatar/avatar-20.jpg" alt="avatar">
                      </div>
                      <div>
                        <a href="#" class="font-medium text-slate-600 line-clamp-1 dark:text-navy-100">Travis Fuller</a>
                        <p class="text-xs text-slate-400 dark:text-navy-300">
                          952 items
                        </p>
                      </div>
                    </div>
                    <button class="btn h-7 rounded-full bg-primary/10 px-2.5 text-xs font-medium text-primary hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 dark:bg-accent-light/10 dark:text-accent-light dark:hover:bg-accent-light/20 dark:focus:bg-accent-light/20 dark:active:bg-accent-light/25">
                      Follow
                    </button>
                  </div>
                  <p class="mt-6 font-medium">Action End in</p>
                  <div class="mt-3 grid grid-cols-3 gap-3 text-center font-inter text-4xl font-semibold text-primary dark:text-accent-light">
                    <div class="grid grid-cols-2 gap-1">
                      <div class="rounded-lg bg-primary/10 py-3 dark:bg-accent-light/10">
                        1
                      </div>
                      <div class="rounded-lg bg-primary/10 py-3 dark:bg-accent-light/10">
                        4
                      </div>
                    </div>
                    <div class="grid grid-cols-2 gap-1">
                      <div class="rounded-lg bg-primary/10 py-3 dark:bg-accent-light/10">
                        3
                      </div>
                      <div class="rounded-lg bg-primary/10 py-3 dark:bg-accent-light/10">
                        5
                      </div>
                    </div>
                    <div class="grid grid-cols-2 gap-1">
                      <div class="rounded-lg bg-primary/10 py-3 dark:bg-accent-light/10">
                        4
                      </div>
                      <div class="rounded-lg bg-primary/10 py-3 dark:bg-accent-light/10">
                        5
                      </div>
                    </div>
                  </div>
                  <div class="mt-2 grid grid-cols-3 gap-3 text-center text-xs+">
                    <p>hours</p>
                    <p>minutes</p>
                    <p>seconds</p>
                  </div>
                  <div class="my-5 h-px bg-slate-200 dark:bg-navy-500"></div>
                  <div class="flex items-center justify-between">
                    <p class="text-lg font-medium text-slate-700 dark:text-navy-100">
                      156 ETH
                    </p>
                    <button class="btn h-9 min-w-[7rem] rounded-full bg-primary font-medium text-white hover:bg-primary-focus focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus dark:focus:bg-accent-focus dark:active:bg-accent/90">
                      Place a Bid
                    </button>
                  </div>
                </div>
              </div>  
  
              <div class="card px-4 pb-4">
                <x-blog.presentation /> 
              </div> 
            </div> --}}
        </div>
        
        {{-- <section style="padding: 20px;">
            <div class="mx-auto mt-8 grid w-full grid-cols-1 gap-4 sm:grid-cols-1 sm:gap-5 lg:gap-6">
                <div class="mx-auto mt-8 grid w-full grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:gap-6">
                    <div style="place-items: center;">
                        <img src="{{ asset('themes/webpage/images/cc.jpg') }}" alt="">
                    </div>
                    <div class="p-4 sm:p-5">
                        <br>
                        <h1 class="title_aracode" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                            CIERRE CONTABLE Y TRIBUTARIO
                        </h1>
                        <span style="font-size: 22px; line-height: 1.1; font-weight: 600;">
                            Ejercicio 2024
                        </span>
                        <p class="mt-8" style="font-size: 17px; line-height: 1.3;">
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
                        <br>
                        <h2 style="font-size: 35px; line-height: 1.1; font-weight: 500;">
                            S/ 395.00
                        </h2>
                        <br><br>
                        <div class="row">
                            <div class="col-md-6" style="padding: 10px 0px;">
                                <a href="https://wa.link/54k2g9">
                                    <button class="boton-degradado-primary"><b>! Comprar Ahora ¡</b></button>
                                </a>
                            </div>
                            <div class="col-md-6" style="padding: 10px 0px;">
                                <a href="">
                                    <button class="boton-degradado-secundary"><b>Descargar Brochure</b></button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

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
        {{-- <section style="padding: 30px 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title_aracode" style="font-size: 35px; line-height: 1.5; font-weight: 700; text-align: center; margin-top: 10px; margin-bottom: 30px;">
                            RUTA DE APRENDIZAJE
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="accordion-aracode">
                            <div class="accordion-item-aracode  card">
                                <div class="accordion-header-aracode  active" aria-expanded="true">
                                    <span class="accordion-icon-aracode">►</span>
                                    INVENTARIOS: NIC 8 Y NIC 2
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="false" style="max-height: 100%; padding: 15px;">
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Determinación del valor neto de realización.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Como sustentar el precio estimado de venta y los costos estimados para
                                        llevar a cabo la venta.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Registro de la desvalorización de inventarios.
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="accordion-item-aracode">
                                <div class="accordion-header-aracode" aria-expanded="false">
                                    <span class="accordion-icon-aracode">►</span>
                                    PROPIEDAD, PLANTA Y EQUIPOS: NIC 8, NIC 16, NIC 36, NIC 23 Y NIIF 13
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="true">
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Medición de las partidas de propiedad, planta y equipos bajo el método del
                                        costo o revaluación.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Tratamiento de las revaluaciones y el impacto en los impuestos diferidos.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Activación de los costos de financiamiento para activos aptos.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Activos totalmente depreciados.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Participación del Auditor externo.
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="accordion-item-aracode">
                                <div class="accordion-header-aracode" aria-expanded="false">
                                    <span class="accordion-icon-aracode">►</span>
                                    DETERIORO DEL VALOR DE LOS ACTIVOS DE LARGA DURACIÓN: NIC 16, NIC 38 Y NIC 36
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="true">
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Analizando los eventos y fenómenos ocurridos al cierre de 2024
                                        (Coyuntura política, económica, conflictos en el medio oriente).
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Activos que se encuentran bajo el alcance de la norma.
                                        Como identificar si los activos se encuentran deteriorados.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Deterioro del valor de los activos en forma individual o de la unidad
                                        generadora de efectivo.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Consideraciones específicas cuando la Compañía mantiene activos
                                        intangibles de vida útil indefinida y plusvalía mercantil (Goodwill).
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Registro contable de las pérdidas por deterioro.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Calculando el valor en uso de los activos: Metodología de flujos de caja
                                        descontados.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        La estimación de la tasa de descuento WACC.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Reversión de pérdidas por deterioro.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Participación del Auditor externo.
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="accordion-item-aracode">
                                <div class="accordion-header-aracode" aria-expanded="false">
                                    <span class="accordion-icon-aracode">►</span>
                                    CUESTIONES GENERALES PARA EL CIERRE TRIBUTARIO 2024
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="true">
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Medición de las partidas de propiedad, planta y equipos bajo el método del
                                        costo o revaluación.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Tratamiento de las revaluaciones y el impacto en los impuestos diferidos.
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="accordion-item-aracode">
                                <div class="accordion-header-aracode" aria-expanded="false">
                                    <span class="accordion-icon-aracode">►</span>
                                    GASTOS DEDUCIBLES 2024
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="true">
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Intereses por préstamos.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Tributos: Impuestos, tasas y contribuciones.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Primas de seguro.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Pérdidas extraordinarias.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Depreciaciones de los bienes del activo fijo (desgasto u obsolescencia), mermas y desmedro de existencias.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Estimaciones y castigos de deudas incobrables.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Beneficios sociales.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Aguinaldos, bonificaciones, gratificaciones y retribuciones que se acuerden al personal.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Gastos y contribuciones destinados a prestar al personal servicios de salud, recreativos, culturales y educativos.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Dietas al directorio – Utilidad comercial.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Remuneración a accionistas y parientes.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Regalías.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Gastos de representación.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Gastos de viaje (al interior y al exterior del país).
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Arrendamientos.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Pagos por rentas de segunda, cuarta y quinta categoría para su perceptor.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Gastos de vehículos automotores.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Donaciones.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Gasto de movilidad.
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="accordion-item-aracode">
                                <div class="accordion-header-aracode" aria-expanded="false">
                                    <span class="accordion-icon-aracode">►</span>
                                    GASTOS PROHIBIDOS
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="true">
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Gastos personales.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Impuesto a la Renta.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Multas, recargos e intereses moratorios.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Las donaciones y actos de liberalidad.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        IGV, el IPM y el ISC que graven el retiro de bienes.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Revaluaciones voluntarias de los activos.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Gastos provenientes de paraísos fiscales.
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="accordion-item-aracode">
                                <div class="accordion-header-aracode" aria-expanded="false">
                                    <span class="accordion-icon-aracode">►</span>
                                    VALOR RAZONABLE: NIIF 13
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="true">
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Cómo se determinan los valores razonables de diferentes activos financieros y 
                                        no financieros.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Técnicas de valoración estandarizadas.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Como soportar los valores razonables.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Participación del Auditor externo.
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="accordion-item-aracode">
                                <div class="accordion-header-aracode" aria-expanded="false">
                                    <span class="accordion-icon-aracode">►</span>
                                    HECHOS POSTERIORES: NIC 8 Y NIC 10
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="true">
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Identificando la fecha en que los estados financieros son autorizados para su 
                                        emisión por la gerencia.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Hechos que requieren ajustes y/o revelación en los estados financieros.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Hechos que resultan de eventos externos (mercado).
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Participación del Auditor externo.
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="accordion-item-aracode">
                                <div class="accordion-header-aracode" aria-expanded="false">
                                    <span class="accordion-icon-aracode">►</span>
                                    INSTRUMENTOS FINANCIEROS E INVERSIONES EN ACCIONES: NIC 27, NIC 28, NIIF 9, NIIF 7 Y NIIF 13
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="true">
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        NIIF relacionadas a los instrumentos financieros e inversiones en acciones.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Medición posterior de los activos financieros: aplicación del método del costo amortizado y del valor razonable.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Como medir activos financieros que se cotizan en la BVL. ¿Qué hacer cuando 
                                        los valores no se cotizan en bolsa?
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        El método de participación patrimonial para la medición posterior de las
                                        Inversiones en Asociadas, Negocios Conjuntos e Inversiones en Subsidiarias en
                                        los Estados Financieros Separados.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Participación del Auditor externo.
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="accordion-item-aracode">
                                <div class="accordion-header-aracode" aria-expanded="false">
                                    <span class="accordion-icon-aracode">►</span>
                                    IMPUESTOS DIFERIDOS: NIC 12 Y CINIIF 23
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="true">
                                    
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        La lógica de los impuestos diferidos.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Determinación del impuesto a las ganancias diferidos.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Cálculo de la línea del impuesto a las ganancias que se reporta en el Estado de 
                                        Resultados.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Determinación de la tasa efectiva del impuesto a las ganancias.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Presentación del movimiento del impuesto a las ganancias diferidos.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Aplicación de la CINIIF 23.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Participación del Auditor externo.
                                    </div>
                                    <br>
                                </div>
                            </div>
                            <div class="accordion-item-aracode">
                                <div class="accordion-header-aracode" aria-expanded="false">
                                    <span class="accordion-icon-aracode">►</span>
                                    PROVISIONES, PASIVOS Y ACTIVOS CONTINGENTES: NIC 37 Y NIC 8
                                </div>
                                <div class="accordion-content-aracode" aria-hidden="true">
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        ¿Cuándo y cómo se registran las provisiones, los pasivos y activos contingentes?
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Planeamiento financiero relacionado a las provisiones y pasivos contingentes.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Presentación de las acotaciones tributarias, multas e intereses de períodos 
                                        anteriores en los estados financieros.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Reconocimiento de las provisiones por desmantelamiento y/o retiro de activos.
                                    </div>
                                    <div class="list-item-aracode" style="font-size: 17px;">
                                        <span class="list-icon-aracode">•</span>
                                        Participación del Auditor externo.
                                    </div>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> --}}

        {{-- INCLUYE --}}
        {{-- <section style="padding: 30px 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="title_aracode" style="font-size: 35px; line-height: 1.5; font-weight: 700; text-align: center; margin-top: 10px; margin-bottom: 30px;">
                            INCLUYE
                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <div class="card" style="place-items: center; padding: 40px 10px;">
                            <img style="width: 80px;" src="{{ asset ('themes/webpage/images/icons/chat-en-vivo.png') }}" alt="">
                            <p style="font-size: 17px; line-height: 1.3; text-align:center; margin-top: 10px;">
                                Formación práctica en vivo con atención a tus consultas.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="place-items: center; padding: 40px 10px;">
                            <img style="width: 80px;" src="{{ asset ('themes/webpage/images/icons/grabacion.png') }}" alt="">
                            <p style="font-size: 17px; line-height: 1.3; text-align:center; margin-top: 10px;">
                                Acceso permanente a las grabaciones de las sesiones desde nuestra plataforma.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="place-items: center; padding: 40px 10px;">
                            <img style="width: 80px;" src="{{ asset ('themes/webpage/images/icons/descarga-de-archivos.png') }}" alt="">
                            <p style="font-size: 17px; line-height: 1.3; text-align:center; margin-top: 10px;">
                                Materiales disponibles para descarga inmediata.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="card" style="place-items: center; padding: 40px 10px;">
                            <img style="width: 80px;" src="{{ asset ('themes/webpage/images/icons/ganador.png') }}" alt="">
                            <p style="font-size: 17px; line-height: 1.3; text-align:center; margin-top: 10px;">
                                Certificado de participación por 12 horas académicas.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </section> --}}

        {{-- CERTIFICADO --}}
        {{-- <section style="padding: 30px 0px;">
            <div class="container  card">
                <div class="row">
                    <div class="col-md-2"></div>
                    <div class="col-md-4">
                        <br>
                        <div style="padding: 40px 20px;">
                            <h2 class="title_aracode" style="font-size: 30px; line-height: 1.5; font-weight: 700; margin-top: 10px; margin-bottom: 10px;">
                                ¡Comparte tus logros con un certificado!
                            </h2>
                            <p style="font-size: 17px; line-height: 1.3; margin-top: 10px;">
                                Cuando termines el curso tendrás acceso al certificado digital para compartirlo con tu familia, amigos, empleadores y la comunidad.
                            </p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div style="place-items: center; padding: 40px 20px;">
                            <img style="width: 100%;" src="{{ asset('themes/webpage/images/certificado.jpeg') }}" alt="">
                            <p style="font-size: 17px; line-height: 1.3; margin-top: 10px;">
                                <b>* IMAGEN REFERENCIAL</b>
                            </p>
                        </div>
                    </div>
                    <div class="col-md-2"></div>
                </div>
            </div>
        </section> --}}

        {{-- <section class="padding: 30px 0px;">
            <div class="container">
                <div class="row">
                    <div class="col-md-6" style="padding: 10px 0px;">
                        <a href="https://wa.link/54k2g9">
                            <button class="boton-degradado-primary"><b>! Comprar Ahora ¡</b></button>
                        </a>
                    </div>
                    <div class="col-md-6" style="padding: 10px 0px;">
                        <a href="">
                            <button class="boton-degradado-secundary"><b>Descargar Brochure</b></button>
                        </a>
                    </div>
                </div>
            </div>
        </section> --}}
        
    </main>
    
    <br>
    <br>
    <br>


    
    <div id="whatsapp">
        <a href="https://wa.link/4bu45u" class="wtsapp" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
