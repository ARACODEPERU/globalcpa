@extends('layouts.webpage')

@section('content')




    <!-- Loader starts-->
    <!-- <div class="loader-wrapper">
                                                                  <div class="loader"></div>
                                                                </div> -->
    <!-- Loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->




    <!-- page-wrapper Start-->
    <div class="page-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <x-header />
        <!-- Page Header Ends-->
        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <x-sidebar />

            <!-- Page Sidebar Ends-->
            <div class="page-body" style="padding: 80px 0px;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="title_aracode" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                                PLANES DE SUSCRIPCIÓN
                            </h1>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">

                    <div class="grid grid-cols-12 gap-4 mt-4 w-full transition-all duration-[.25s]  sm:gap-5 lg:gap-6">
                        <div class="col-span-12 lg:col-span-4">
                            <div class="card p-4 sm:p-5">
                                <img src="{{ asset('themes/webpage/images/suscripcion.jpg') }}" alt="">
                            </div>
                        </div>
                        <div class="col-span-12 lg:col-span-8">
                            <div class="card">
                                <div
                                    class="items-center space-y-4 border-b border-slate-200 
                            p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                        POTENCIA TU CRECIMIENTO PROFESIONAL Y FORTAMECE TU EQUIPO CON FORMACIÓN ESTRATÉGICA.
                                    </h2>
                                    <p>
                                        La suscripción anual de Global CPA Business School te conecta con conocimientos
                                        de alto nivel, asesoría especializada y una comunidad de expertos que impulsan
                                        tu desarrollo.
                                    </p>
                                </div>
                                <div class="p-4 sm:p-5">

                                    <div x-data="{ activeTab: 'tabHome' }" class="tabs flex flex-col">
                                        <div
                                            class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200">
                                            <div class="tabs-list flex px-1.5 py-1">
                                                <button @click="activeTab = 'tabHome'"
                                                    :class="activeTab === 'tabHome' ?
                                                        'bg-white shadow dark:bg-navy-500 dark:text-navy-100' :
                                                        'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                                    class="btn shrink-0 px-3 py-1.5 font-medium">
                                                    Experiencia que genera confianza
                                                </button>
                                                <button @click="activeTab = 'tabProfile'"
                                                    :class="activeTab === 'tabProfile' ?
                                                        'bg-white shadow dark:bg-navy-500 dark:text-navy-100' :
                                                        'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                                    class="btn shrink-0 px-3 py-1.5 font-medium">
                                                    Red Global de Excelencia
                                                </button>
                                                {{-- <button @click="activeTab = 'tabMessages'"
                                        :class="activeTab === 'tabMessages' ?
                                            'bg-white shadow dark:bg-navy-500 dark:text-navy-100' :
                                            'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                        class="btn shrink-0 px-3 py-1.5 font-medium">
                                        Sobre su autor
                                    </button>
                                    <button @click="activeTab = 'tabSettings'"
                                        :class="activeTab === 'tabSettings' ?
                                            'bg-white shadow dark:bg-navy-500 dark:text-navy-100' :
                                            'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                        class="btn shrink-0 px-3 py-1.5 font-medium">
                                        Estructura de la obra
                                    </button> --}}
                                            </div>
                                        </div>
                                        <div class="tab-content pt-4">
                                            <div x-show="activeTab === 'tabHome'"
                                                x-transition:enter="transition-all duration-500 easy-in-out"
                                                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                                                <div>
                                                    <h2
                                                        class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                                        Único ACCA Approved Learning Partener en Perú
                                                    </h2>
                                                    <br>
                                                    <p>
                                                        Brindamos formación oficial hacia la certificación contable líder en
                                                        el mundo,
                                                        con <b>tarifas preferenciales y acceso prioritario</b> a programas y
                                                        certificaciones que elevan
                                                        la competitividad de empresas profesionales, a través de:
                                                    </p>
                                                    <br>
                                                    <ul>
                                                        <li>
                                                            <i class="fa fa-circle" aria-hidden="true"
                                                                style="color: red;"></i>&nbsp;
                                                            <b>Programas de especialización</b> alineados a los estándares
                                                            de ACCA
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-circle" aria-hidden="true"
                                                                style="color: red;"></i>&nbsp;
                                                            Preparación oficial para obtener la
                                                            <b>certificación internacional.</b>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-circle" aria-hidden="true"
                                                                style="color: red;"></i>&nbsp;
                                                            Acceso a beneficios exclusivos a través de nuestros
                                                            <b>planes de suscripción anual.</b>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-circle" aria-hidden="true"
                                                                style="color: red;"></i>&nbsp;
                                                            Acompañamiento académico respaldado por una red global
                                                        </li>
                                                    </ul>
                                                    <br>
                                                    <h2
                                                        class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                                        ¿Y QUÉ ES ACCA?
                                                    </h2>
                                                    <p>
                                                        ACCA es la <b>Asociación de Contadores Públicos Certificados,</b>
                                                        presente en
                                                        más de
                                                        <b>180 países.</b> Certifica a profesionales destacados por su alta
                                                        preparación
                                                        en contabilidad,
                                                        finanzas y ética.
                                                    </p>
                                                </div>
                                            </div>
                                            <div x-show="activeTab === 'tabProfile'"
                                                x-transition:enter="transition-all duration-500 easy-in-out"
                                                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                                                <div>
                                                    <h2
                                                        class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                                        Somos parte de una red global de excelencia
                                                    </h2>
                                                    <br>
                                                    <p>
                                                        Formamos parte de la red internacional <b>SFAI (Santa Fe Associates
                                                            International),</b> con
                                                        presencia en más de 100 países, lo que nos permite mantener una
                                                        visión global y
                                                        actualizada
                                                        de los negocios.
                                                    </p>
                                                    <p>
                                                        También pertenecemos al Foro de Firmas de la AIC
                                                        <b>(Asociación Internacional de
                                                            Contabilidad),</b> una membresía que garantiza nuestro
                                                        compromiso con los
                                                        más altos estándares técnicos, éticos y profesionales a nivel
                                                        mundial.
                                                    </p>
                                                </div>
                                            </div>
                                            <div x-show="activeTab === 'tabMessages'"
                                                x-transition:enter="transition-all duration-500 easy-in-out"
                                                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                                                <div>
                                                    <h2
                                                        class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                                        ALEX CUZCANO
                                                    </h2>
                                                    <br>
                                                    <p>
                                                        La trayectoria profesional de Alex Cuzcano como
                                                        Contador Público es impresionante. Con Maestría
                                                        en Finanzas por EADA Business School (Barcelona,
                                                        España); Maestría en Dirección de Finanzas
                                                        Corporativas y Riesgo Financiero por la Pontificia
                                                        Universidad Católica del Perú (PUCP); Maestría en
                                                        Auditoría por la Universidad del Pacífico; Posgrado
                                                        en Normas Internacionales de Información
                                                        Financiera (NIIF) por la Universidad de Lima.
                                                    </p>
                                                    <br>
                                                    <p>
                                                        Actualmente es Socio de Auditoría y Consultoría
                                                        Contable en Global CPA. Y anteriormente se desempeñó
                                                        en los siguientes cargos: Consultor del
                                                        Banco Interamericano de Desarrollo (BID) para
                                                        el MEF sobre proceso de implementación de
                                                        las NICSP; Gerente Senior en el área de AAS (Accounting
                                                        Advisory Services) para KPMG en Perú,
                                                        siendo responsable de los servicios de consultoría
                                                        contable, principalmente relacionados a NIIF,
                                                        luego de su paso como Gerente de Auditoría;
                                                        Gerente de Auditoría en Deloitte Perú y auditor
                                                        externo en Deloitte España (Barcelona); Gerente
                                                        de Contabilidad y Control de Gestión en el Banco
                                                        BCI Perú.
                                                    </p>
                                                    <br>
                                                    <p>
                                                        Es experto en supervisión de auditorías financieras
                                                        y presupuestales realizadas de conformidad
                                                        con el Manual de Auditoría Financiera Gubernamental
                                                        aplicable a empresas supervisadas por la
                                                        Contraloría General de la República del Perú.
                                                    </p>
                                                    <br>
                                                    <p>
                                                        Ha realizado el acompañamiento a cooperativas
                                                        de ahorro y crédito en la implementación del
                                                        Manual de Contabilidad (SBS) y reexpresión de
                                                        estados financieros y a las entidades financieras
                                                        en su proceso de implementación del Nuevo
                                                        Manual de Contabilidad (SBS) y reexpresión de
                                                        estados financieros, durante sus procesos.
                                                    </p>
                                                    <br>
                                                    <p>
                                                        En el campo gremial contable, es Representante
                                                        del Consejo Normativo de Contabilidad en el GLENIF;
                                                        Miembro del Comité Técnico Permanente de
                                                        la JDCCPP (2022-2024); Coordinador General de
                                                        las DOM ante la IFAC (2023-2026); Miembro de la
                                                        Comisión Técnica de Control de Calidad ante la
                                                        Asociación Interamericana de Contabilidad (AIC)
                                                        (2020–2023); y fue Miembro del Comité Técnico
                                                        de Auditoría de la Junta de Decanos de Colegio
                                                        de Contadores Públicos del Perú (2018–2020).
                                                    </p>
                                                    <br>
                                                    <p>
                                                        Docente de pregrado y posgrado en la Pontificia
                                                        Universidad Católica del Perú (PUCP) y en la
                                                        Universidad ESAN. Fue docente de pregrado y
                                                        posgrado en la Universidad de Lima y de la División
                                                        Ejecutiva de la Universidad del Pacífico. Fue
                                                        instructor en el Instituto Peruano de Auditores
                                                        Independientes (IPAI). Participa como docente
                                                        invitado en universidades y escuelas de posgrado
                                                        del interior del Perú y en los colegios de contadores
                                                        públicos del país.
                                                    </p>
                                                    <br>
                                                    <p>
                                                        Colabora como conferencista en eventos de Contabilidad
                                                        y Auditoría a nivel nacional (CONANIIF,
                                                        Audita, Congreso Nacional de Contadores) e internacional,
                                                        participando en los países de México,
                                                        Chile, Colombia, Ecuador, Bolivia y Guatemala.
                                                    </p>
                                                </div>
                                            </div>
                                            <div x-show="activeTab === 'tabSettings'"
                                                x-transition:enter="transition-all duration-500 easy-in-out"
                                                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                                                <div>
                                                    <h2
                                                        class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                                        I. INFORMACIÓN FINANCIERA DE CALIDAD
                                                    </h2>
                                                    <br>
                                                    <h2
                                                        class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                                        II. EL MARCO CONCEPTUAL COMO BASE
                                                        PARA EL APRENDIZAJE DE LAS NIIF
                                                    </h2>
                                                    <br>
                                                    <h2
                                                        class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                                        III.- FINANZAS PARA DOMINAR LAS NIIF
                                                    </h2>
                                                    <br>
                                                    <h2
                                                        class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                                        IV.- NIIF 13 “DETERMINACIÓN DEL VALOR
                                                        RAZONABLE”
                                                    </h2>
                                                    <br>
                                                    <h2
                                                        class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                                        V.- NIIF RELACIONADAS A LOS ACTIVOS NO
                                                        FINANCIEROS
                                                    </h2>
                                                    <br>
                                                    <h2
                                                        class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                                        VI.- NIIF RELACIONADA A LOS PASIVOS NO
                                                        FINANCIEROS
                                                    </h2>
                                                    <br>
                                                    <h2
                                                        class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                                        VII.- NIIF RELACIONADAS A LA PRESENTACIÓN
                                                        DE ESTADOS FINANCIEROS
                                                    </h2>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>

                                    <div class="flex items-center justify-between pt-4">
                                        <a href="{{ asset('themes/webpage/suscripcion_global.pdf') }}"
                                            download="suscripcion_global">
                                            <button class="boton-degradado-courses">
                                                <b style="font-size: 15px;">
                                                    <i class="fa fa-download" aria-hidden="true"
                                                        style="font-size: 20px;"></i>
                                                    &nbsp; Descargar Brochure
                                                </b>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                     <x-subscriptions />
                </div>
            </div>
            <!-- footer start-->
            <x-footer />
        </div>

    </div>


@stop
