@extends('layouts.webpage')

@section('content')


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
            <div class="page-body" x-data>

                <!-- Propuesta de Diseño Moderno Opción 4 (Más avatares) -->
                <div class="container-fluid mt-5">
                    <div class="card border-0 overflow-hidden shadow mb-4"
                        style="background: linear-gradient(135deg, #002060 0%, #004080 100%); border-radius: 20px;"
                        data-aos="fade-up">

                        <div class="card-body p-4 p-lg-5 position-relative">
                            <div class="row align-items-center">
                                <div class="col-lg-7">
                                    <nav aria-label="breadcrumb" class="mb-3">
                                        <ol class="breadcrumb mb-0">
                                            <li class="breadcrumb-item">
                                                <a href="/"
                                                    class="text-white-50 text-decoration-none text-uppercase small fw-bold"
                                                    style="letter-spacing: 1px;">
                                                    <i class="fa fa-home me-1" aria-hidden="true"></i> Inicio
                                                </a>
                                            </li>
                                            <li class="breadcrumb-item active text-white text-uppercase small fw-bold"
                                                style="letter-spacing: 1px;" aria-current="page">
                                                Suscripciones
                                            </li>
                                        </ol>
                                    </nav>

                                    <h1 class="display-4 fw-bold text-white mb-3">
                                        Planes de Suscripción <span class="text-warning">Exclusivos</span>
                                    </h1>
                                    <p class="lead text-white-50 mb-4" style="max-width: 600px; line-height: 1.6;">
                                        Elige el plan que mejor se adapte a tus necesidades y accede a un universo de
                                        conocimiento, herramientas y una comunidad de profesionales para impulsar tu
                                        carrera.
                                    </p>

                                    <div class="d-flex gap-3">
                                        <div class="d-flex align-items-center text-white-50 small">
                                            <i class="fa fa-check-circle text-success me-2" aria-hidden="true"></i> Acceso Ilimitado
                                        </div>
                                        <div class="d-flex align-items-center text-white-50 small">
                                            <i class="fa fa-check-circle text-success me-2" aria-hidden="true"></i> Contenido Premium
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-5 d-none d-lg-block">
                                    <div class="subscription-icon-cloud position-relative" style="min-height: 280px;">
                                        <!-- Íconos flotantes de beneficios -->
                                        <div
                                            class="icon-item item-1 shadow-lg d-flex align-items-center justify-content-center">
                                            <i class="fa fa-infinity fa-2x text-white" aria-hidden="true"></i>
                                        </div>
                                        <div
                                            class="icon-item item-2 shadow d-flex align-items-center justify-content-center">
                                            <i class="fa fa-certificate fa-2x text-white" aria-hidden="true"></i>
                                        </div>
                                        <div
                                            class="icon-item item-3 shadow d-flex align-items-center justify-content-center">
                                            <i class="fa fa-users fa-2x text-white" aria-hidden="true"></i>
                                        </div>
                                        <div
                                            class="icon-item item-4 shadow d-flex align-items-center justify-content-center">
                                            <i class="fa fa-star fa-2x text-white" aria-hidden="true"></i>
                                        </div>
                                        <div
                                            class="icon-item item-5 shadow d-flex align-items-center justify-content-center">
                                            <i class="fa fa-play-circle fa-2x text-white" aria-hidden="true"></i>
                                        </div>
                                        <div
                                            class="icon-item item-6 shadow d-flex align-items-center justify-content-center">
                                            <i class="fa fa-book-open fa-2x text-white" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <style>
                    .subscription-icon-cloud .icon-item {
                        position: absolute;
                        border-radius: 50%;
                        border: 3px solid rgba(255, 255, 255, 0.5);
                        background-color: rgba(255, 255, 255, 0.1);
                        backdrop-filter: blur(5px);
                        animation: float-icons 8s ease-in-out infinite;
                    }

                    .subscription-icon-cloud .item-1 {
                        width: 100px;
                        height: 100px;
                        top: 50%;
                        left: 50%;
                        z-index: 5;
                        animation-name: float-icons-center;
                        animation-duration: 7s;
                    }

                    .subscription-icon-cloud .item-2 {
                        width: 70px;
                        height: 70px;
                        top: 15%;
                        left: 20%;
                        animation-delay: -1.5s;
                    }

                    .subscription-icon-cloud .item-3 {
                        width: 80px;
                        height: 80px;
                        top: 25%;
                        left: 80%;
                        animation-delay: -3s;
                        animation-duration: 9s;
                    }

                    .subscription-icon-cloud .item-4 {
                        width: 60px;
                        height: 60px;
                        top: 75%;
                        left: 10%;
                        animation-delay: -5s;
                    }

                    .subscription-icon-cloud .item-5 {
                        width: 90px;
                        height: 90px;
                        top: 70%;
                        left: 70%;
                        animation-delay: -0.8s;
                        animation-duration: 10s;
                    }

                    .subscription-icon-cloud .item-6 {
                        width: 55px;
                        height: 55px;
                        top: 8%;
                        left: 55%;
                        animation-delay: -6s;
                        animation-duration: 8s;
                    }

                    @keyframes float-icons {
                        0%, 100% { transform: translateY(0px) rotate(4deg); }
                        50% { transform: translateY(-20px) rotate(-4deg); }
                    }

                    @keyframes float-icons-center {
                        0%, 100% { transform: translate(-50%, -50%) translateY(0px) rotate(4deg); }
                        50% { transform: translate(-50%, -50%) translateY(-20px) rotate(-4deg); }
                    }
                </style>





                {{-- <div class="container-fluid">
                    <div class="grid grid-cols-12 gap-4 mt-4 w-full transition-all duration-[.25s]  sm:gap-5 lg:gap-6">
                        <div class="col-span-12 lg:col-span-4">
                            <div class="card p-4 sm:p-5">
                                <img src="{{ asset('themes/webpage/images/suscripcion.jpg') }}" alt="Imagen promocional de los planes de suscripción de CPA Academy">
                            </div>
                        </div>
                        <div class="col-span-12 lg:col-span-8">
                            <div class="card">
                                <div
                                    class="items-center space-y-4 border-b border-slate-200
                            p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                                    <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                        POTENCIA TU CRECIMIENTO PROFESIONAL Y FORTALECE TU EQUIPO CON FORMACIÓN ESTRATÉGICA.
                                    </h2>
                                    <p>
                                        La suscripción anual de CPA Academy te conecta con conocimientos
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
                                                        con <strong>tarifas preferenciales y acceso prioritario</strong> a programas y
                                                        certificaciones que elevan
                                                        la competitividad de empresas profesionales, a través de:
                                                    </p>
                                                    <br>
                                                    <ul>
                                                        <li>
                                                            <i class="fa fa-circle" aria-hidden="true"
                                                                style="color: red;"></i>&nbsp;
                                                            <strong>Programas de especialización</strong> alineados a los estándares
                                                            de ACCA
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-circle" aria-hidden="true"
                                                                style="color: red;"></i>&nbsp;
                                                            Preparación oficial para obtener la
                                                            <strong>certificación internacional.</strong>
                                                        </li>
                                                        <li>
                                                            <i class="fa fa-circle" aria-hidden="true"
                                                                style="color: red;"></i>&nbsp;
                                                            Acceso a beneficios exclusivos a través de nuestros
                                                            <strong>planes de suscripción anual.</strong>
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
                                                        ACCA es la <strong>Asociación de Contadores Públicos Certificados,</strong>
                                                        presente en
                                                        más de
                                                        <strong>180 países.</strong> Certifica a profesionales destacados por su alta
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
                                                        Formamos parte de la red internacional <strong>SFAI (Santa Fe Associates
                                                            International),</strong> con
                                                        presencia en más de 100 países, lo que nos permite mantener una
                                                        visión global y
                                                        actualizada
                                                        de los negocios.
                                                    </p>
                                                    <p>
                                                        También pertenecemos al Foro de Firmas de la AIC
                                                        <strong>(Asociación Internacional de
                                                            Contabilidad),</strong> una membresía que garantiza nuestro
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
                                        <a href="{{ asset('themes/webpage/suscripcion_global.pdf') }}" download="suscripcion_global" class="boton-degradado-courses">
                                            <strong style="font-size: 15px;">
                                                <i class="fa fa-download" aria-hidden="true"
                                                    style="font-size: 20px;"></i>
                                                &nbsp; Descargar Brochure
                                            </strong>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> --}}

                <div class="container-fluid">
                    <x-subscriptions />
                </div>
            </div>
            <!-- footer start-->
            <x-footer />
        </div>

    </div>
    
@endsection
