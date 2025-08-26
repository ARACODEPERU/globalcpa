@extends('layouts.webpage')

@section('content')


    <!-- App Header Wrapper-->
    <x-nav />

    <!-- Sidebar -->
    <x-slidebar />

    <main class="main-content w-full px-[var(--margin-x)] pb-8">
      <br>
        <div class="mt-4 w-full transition-all duration-[.25s] sm:mt-5 lg:mt-6">
            <div style="text-align:center;">
                <h1 class="title_aracode" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                    LAS NIIF COMO NUNCA TE LO EXPLICARON
                </h1>
            </div>
        </div>

        <br>

        <div class="grid grid-cols-12 gap-4 mt-4 w-full transition-all duration-[.25s]  sm:gap-5 lg:gap-6">
            <div class="col-span-12 lg:col-span-4">
                <div class="card p-4 sm:p-5">
                    <img src="{{ asset('themes/webpage/images/amauta-book.jpeg') }}" alt="">
                </div>
            </div>
            <div class="col-span-12 lg:col-span-8">
                <div class="card">
                    <div
                        class="items-center space-y-4 border-b border-slate-200 
                            p-4 dark:border-navy-500 sm:flex-row sm:justify-between sm:space-y-0 sm:px-5">
                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                            EL AMAUTA DE LAS NIIF | Edición 2025
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

                        <div x-data="{ activeTab: 'tabHome' }" class="tabs flex flex-col">
                            <div
                                class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200">
                                <div class="tabs-list flex px-1.5 py-1">
                                    <button @click="activeTab = 'tabHome'"
                                        :class="activeTab === 'tabHome' ?
                                            'bg-white shadow dark:bg-navy-500 dark:text-navy-100' :
                                            'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                        class="btn shrink-0 px-3 py-1.5 font-medium">
                                        Obligación
                                    </button>
                                    <button @click="activeTab = 'tabProfile'"
                                        :class="activeTab === 'tabProfile' ?
                                            'bg-white shadow dark:bg-navy-500 dark:text-navy-100' :
                                            'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                        class="btn shrink-0 px-3 py-1.5 font-medium">
                                        ¿Qué hace a esta obra única y útil?
                                    </button>
                                    <button @click="activeTab = 'tabMessages'"
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
                                    </button>
                                </div>
                            </div>
                            <div class="tab-content pt-4">
                                <div x-show="activeTab === 'tabHome'"
                                    x-transition:enter="transition-all duration-500 easy-in-out"
                                    x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                                    <div>
                                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                            "Piensa en NIIF y existirás contablemente"
                                        </h2>
                                        <br>
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
                                        <br>
                                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                            Obligación de las grandes empresas y PYMES de aplicar las NIIF
                                        </h2>
                                        <br>
                                        <h3>
                                            <b>Sector privado.</b>
                                        </h3>
                                        <br>
                                        <p>
                                            Según resolución del Consejo Normativo de
                                            Contabilidad (CNC), las empresas con ingresos
                                            anuales mayores a 2,300 UIT deben aplicar las
                                            NIIF Plenas. Y las empresas con ingresos anuales
                                            mayores a 150 e inferiores a 2,300 UIT deben
                                            aplicar las NIIF para PYMES en la preparación e
                                            informe de sus estados financieros.
                                        </p>
                                        <br>
                                        <p>
                                            Las NIIF son reconocidas y exigidas por los
                                            diversos organismos supervisores, tales como
                                            el Consejo Normativo de Contabilidad (CNC), la
                                            Superintendencia del Mercado de Valores (SMV),
                                            la Dirección General de Contabilidad Pública del
                                            MEF (DGCP), la Superintendencia Nacional de
                                            Aduanas y Administración Tributaria (SUNAT)
                                        </p>
                                        <br>
                                        <h3>
                                            <b>Sector público.</b>
                                        </h3>
                                        <br>
                                        <p>
                                            Las empresas del sector público deben aplicar las
                                            normas y regulaciones emitidas por la DGCP para
                                            la preparación y presentación de su información
                                            financiera (EEFF y estados presupuestarios). La
                                            Directiva n.º 002-2013-EF/51.01, numeral 7, establece
                                            lo siguiente:
                                        </p>
                                        <br>
                                        <ul>
                                            <li>
                                                A.- Los estados financieros de las empresas no
                                                financieras del Estado deben ser preparados
                                                y presentados de acuerdo a las NIIF y demás
                                                disposiciones legales sobre la materia. En
                                                el caso de las empresas financieras del
                                                Estado, las normas para la preparación y
                                                presentación de información financiera
                                                deben estar armonizadas a las NIIF con
                                                los diferimientos y excepciones según lo
                                                dispuesto por la SBS.
                                            </li>
                                            <br>
                                            <li>
                                                B.- Los estados financieros de las entidades
                                                de carácter empresarial de los gobiernos
                                                nacional, regional y locales comprendidos
                                                en la citada directiva, deben ser preparados
                                                y presentados con sujeción a las Normas
                                                Internacionales de Contabilidad del Sector
                                                Público (NICSP).
                                            </li>
                                        </ul>
                                        <p>
                                            Las NICSP están en camino a ser adoptadas
                                            plenamente. La DGCP inició en 2021 el plan de
                                            implementación de estos estándares; las entidades
                                            del estado han presentado sus primeros estados
                                            financieros bajo NICSP Plenas al 31 de diciembre
                                            de 2024.
                                        </p>
                                    </div>
                                </div>
                                <div x-show="activeTab === 'tabProfile'"
                                    x-transition:enter="transition-all duration-500 easy-in-out"
                                    x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                                    <div>
                                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                            1.- Su enfoque analítico y explicativo
                                        </h2>
                                        <br>
                                        <p>
                                            El Amauta de las NIIF refleja una aspiración:
                                            traducir lo complejo en simple. Su objetivo es
                                            explicar cada norma con precisión, revelando
                                            su lógica funcional subyacente y ofreciendo
                                            una metodología práctica para su aplicación.
                                        </p>
                                        <br>
                                        <p>
                                            <b>LOS ANÁLISIS Y COMENTARIOS EXHAUSTIVOS: </b><br>
                                            Que explican la lógica, el sentido y alcance
                                            de cada norma NIIF (la filosofía contable de
                                            las NIIF).
                                        </p>
                                        <br>
                                        <p>
                                            <b>SUS HERRAMIENTAS VISUALES:</b><br>
                                            Innumerables cuadros sinópticos que facilitan
                                            la comprensión y retención de la información.
                                        </p>
                                        <br>
                                        <p>
                                            <b>SU ENFOQUE DIDÁCTICO Y PRÁCTICO:</b><br>
                                            La incorporación de 300 casos que le dan al
                                            libro un carácter práctico, utilitario y enfáticamente
                                            pedagógico.
                                        </p>
                                        <br>
                                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                            2.- Su autor
                                        </h2>
                                        <br>
                                        <p>
                                            <b>Alex Cuzcano</b> es uno de los mayores expertos
                                            en las NIIF en el Perú.
                                        </p>
                                        <p>
                                            La vasta experiencia profesional del autor en
                                            materia de NIIF, ocupando cargos directivos
                                            clave en consultoras e instituciones de gran
                                            prestigio internacional, hace que el libro sea
                                            un referente de consulta confiable entre los
                                            operadores de las normas.
                                        </p>
                                        <br>
                                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                            3.- A quiénes está dirigido:
                                        </h2>
                                        <br>
                                        <p>
                                            <b>Profesionales de la Contabilidad.</b><br>
                                            Que requieren aplicar sin errores las NIIF en función
                                            a las situaciones reales de las organizaciones
                                            empresariales, lo que exige un conocimiento
                                            profundo no solo de la contabilidad sino también
                                            de las finanzas.
                                        </p>
                                        <br>
                                        <p>
                                            <b>Directivos y Gerentes
                                                Financieros.</b> <br>
                                            Existe una necesidad de comprender las NIIF por
                                            parte del personal directivo de las empresas; que
                                            pueden tener un perfil financiero, pero que no han
                                            profundizado en el aspecto contable-financiero de
                                            este tipo de normas, y que requieren conocerlas
                                            para el cumplimiento de la presentación de estados
                                            financieros.
                                        </p>
                                        <br>
                                        <p>
                                            <b>Pequeñas y Medianas Empresas
                                                (PYMEs).</b><br>
                                            Es imperativo que las pequeñas y medianas
                                            empresas con ingresos anuales mayores a 150
                                            UIT y menores a 2,300 UIT sepan cómo adaptar
                                            la información de sus estados financieros bajo
                                            los parámetros normativos de las NIIF.
                                        </p>
                                        <br>
                                        <p>
                                            <b>Contadores y funcionarios de la
                                                alta dirección de entidades del
                                                sector público.</b><br>
                                            A.- Es obligatorio que los estados financieros
                                            de las empresas no financieras del Estado
                                            sean preparados y presentados de acuerdo
                                            a las NIIF y otras disposiciones legales sobre
                                            la materia.
                                            <br>
                                            B.- En el caso de las empresas financieras del
                                            Estado, la presentación de información
                                            financiera debe estar armonizada a las NIIF
                                            con los diferimientos y excepciones según
                                            lo dispuesto por la Superintendencia de
                                            Banca, Seguros y AFP.
                                            <br>
                                            C.- Los estados financieros de las empresas del
                                            Estado –del gobierno nacional, gobiernos
                                            regionales y locales– deben ser preparados
                                            y presentados con sujeción a las Normas
                                            Internacionales de Contabilidad del Sector
                                            Público (NICSP).
                                        </p>
                                        <br>
                                        <p>
                                            <b>Auditores y Consultores.</b><br>
                                            Estos profesionales requieren tener fuentes de
                                            consultas confiables que afinen sus criterios
                                            en la evaluación y auditoría con respecto a la
                                            aplicación adecuada de los estados financieros
                                            conforme a las NIIF.
                                        </p>
                                        <br>
                                        <p>
                                            <b>Estudiantes universitarios de
                                                Contabilidad.</b><br>
                                            La obra les permitirá a los estudiantes de pregrado
                                            a orientar su aprendizaje hacia un conocimiento
                                            más especializado en las NIIF que les abrirá las
                                            puertas de las empresas de mayor nivel.
                                        </p>
                                    </div>
                                </div>
                                <div x-show="activeTab === 'tabMessages'"
                                    x-transition:enter="transition-all duration-500 easy-in-out"
                                    x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                                    <div>
                                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
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
                                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                            I. INFORMACIÓN FINANCIERA DE CALIDAD
                                        </h2>
                                        <br>
                                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                            II. EL MARCO CONCEPTUAL COMO BASE
                                            PARA EL APRENDIZAJE DE LAS NIIF
                                        </h2>
                                        <br>
                                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                            III.- FINANZAS PARA DOMINAR LAS NIIF
                                        </h2>
                                        <br>
                                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                            IV.- NIIF 13 “DETERMINACIÓN DEL VALOR
                                            RAZONABLE”
                                        </h2>
                                        <br>
                                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                            V.- NIIF RELACIONADAS A LOS ACTIVOS NO
                                            FINANCIEROS
                                        </h2>
                                        <br>
                                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                            VI.- NIIF RELACIONADA A LOS PASIVOS NO
                                            FINANCIEROS
                                        </h2>
                                        <br>
                                        <h2 class="text-lg font-medium tracking-wide text-slate-700 dark:text-navy-100">
                                            VII.- NIIF RELACIONADAS A LA PRESENTACIÓN
                                            DE ESTADOS FINANCIEROS
                                        </h2>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="my-7 h-px bg-slate-200 dark:bg-navy-500"></div>

                        <div class="flex items-center justify-between pt-4">
                            <a href="{{ asset('themes/webpage/El_Amauta_de_las_NIIF.pdf') }}" download="El_Amauta_de_las_NIIF">
                                <button style="width: 100%;"
                                    class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus 
                                    focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus 
                                    dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                    <span>Descargar Brochure</span>
                                </button>
                            </a>
                            <a href="https://wa.link/yibjj7">
                                <button style="width: 100%;"
                                    class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus 
                                    focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus 
                                    dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                    <span>Comprar versión impresa</span>
                                </button>
                            </a>
                            <a href="https://www.amazon.com/-/es/dp/B0DVTBXPCF?binding=kindle_edition&ref=dbs_dp_rwt_sb_pc_tkin">
                                <button style="width: 100%;"
                                    class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus 
                                    focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus 
                                    dark:focus:bg-accent-focus dark:active:bg-accent/90">
                                    <span>Comprar ebook</span>
                                </button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <br>
        <br>

        <div class="mt-4 w-full transition-all duration-[.25s] sm:mt-5 lg:mt-6">
            <br>
            <div style="text-align:center;">
                <h1 class="title_aracode" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                    EDICIONES ANTERIORES
                </h1>
                <br>
            </div>
        </div>

        <br><br>

        <div class="grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6 xl:grid-cols-4">
            <div class="card">
                <div class="flex grow flex-col items-center px-4 pb-4 sm:px-5">
                    <img style="width: 100%; margin-top: 20px;" src="{{ asset('themes/webpage/images/amauta_2020.jpg') }}" alt="">
                    <h3 class="pt-3 text-lg font-medium text-slate-700 dark:text-navy-100">
                      EL AMAUTA DE LAS NIIF
                    </h3>
                    <p class="text-xs+">EDICIÓN 2020</p>
                    <div class="mt-6 grid w-full grid-cols-1 gap-1">
                      <a href="https://isbn.bnp.gob.pe/catalogo.php?mode=busqueda_menu&id_autor=64814&pagina=2">
                        <button style="width: 100%;"
                            class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus 
                            focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus 
                            dark:focus:bg-accent-focus dark:active:bg-accent/90">
                            <span>Información</span>
                        </button>
                      </a>
                    </div>
                </div>
            </div>
            <div class="card">
              <div class="flex grow flex-col items-center px-4 pb-4 sm:px-5">
                  <img style="width: 100%; margin-top: 20px;" src="{{ asset('themes/webpage/images/amauta_2021.jpg') }}" alt="">
                  <h3 class="pt-3 text-lg font-medium text-slate-700 dark:text-navy-100">
                    EL AMAUTA DE LAS NIIF
                  </h3>
                  <p class="text-xs+">EDICIÓN 2021</p>
                  <div class="mt-6 grid w-full grid-cols-1 gap-1">
                    <a href="https://isbn.bnp.gob.pe/catalogo.php?mode=detalle&nt=122583">
                      <button style="width: 100%;"
                          class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus 
                          focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus 
                          dark:focus:bg-accent-focus dark:active:bg-accent/90">
                          <span>Información</span>
                      </button>
                    </a>
                  </div>
              </div>
            </div>
            <div class="card">
              <div class="flex grow flex-col items-center px-4 pb-4 sm:px-5">
                  <img style="width: 100%; margin-top: 20px;" src="{{ asset('themes/webpage/images/amauta_2023.jpg') }}" alt="">
                  <h3 class="pt-3 text-lg font-medium text-slate-700 dark:text-navy-100">
                    EL AMAUTA DE LAS NIIF
                  </h3>
                  <p class="text-xs+">EDICIÓN 2023</p>
                  <div class="mt-6 grid w-full grid-cols-1 gap-1">
                    <a href="https://isbn.bnp.gob.pe/catalogo.php?mode=detalle&nt=131181">
                      <button style="width: 100%;"
                          class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus 
                          focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus 
                          dark:focus:bg-accent-focus dark:active:bg-accent/90">
                          <span>Información</span>
                      </button>
                    </a>
                  </div>
              </div>
            </div>
            {{-- <div class="card">
              <div class="flex grow flex-col items-center px-4 pb-4 sm:px-5">
                  <img style="width: 100%; margin-top: 20px;" src="{{ asset('themes/webpage/images/amauta_2024.jpg') }}" alt="">
                  <h3 class="pt-3 text-lg font-medium text-slate-700 dark:text-navy-100">
                    EL AMAUTA DE LAS NIIF
                  </h3>
                  <p class="text-xs+">EDICIÓN 2024</p>
                  <div class="mt-6 grid w-full grid-cols-1 gap-1">
                    <a href="https://isbn.bnp.gob.pe/catalogo.php?mode=detalle&nt=149323">
                      <button style="width: 100%;"
                          class="btn space-x-2 bg-primary font-medium text-white hover:bg-primary-focus 
                          focus:bg-primary-focus active:bg-primary-focus/90 dark:bg-accent dark:hover:bg-accent-focus 
                          dark:focus:bg-accent-focus dark:active:bg-accent/90">
                          <span>Información</span>
                      </button>
                    </a>
                  </div>
              </div>
            </div> --}}
        </div>

        <x-social-networks />
        
        <x-footer />


    </main>

@stop
