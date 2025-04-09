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
                            EL AMAUTA DE LAS NIIF
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

                        <div x-data="{activeTab:'tabHome'}" class="tabs flex flex-col">
                            <div
                              class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200"
                            >
                              <div class="tabs-list flex px-1.5 py-1">
                                <button
                                  @click="activeTab = 'tabHome'"
                                  :class="activeTab === 'tabHome' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                  class="btn shrink-0 px-3 py-1.5 font-medium"
                                >
                                    Obligación
                                </button>
                                <button
                                  @click="activeTab = 'tabProfile'"
                                  :class="activeTab === 'tabProfile' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                  class="btn shrink-0 px-3 py-1.5 font-medium"
                                >
                                  ¿Qué hace a esta obra única y útil?
                                </button>
                                <button
                                  @click="activeTab = 'tabMessages'"
                                  :class="activeTab === 'tabMessages' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                  class="btn shrink-0 px-3 py-1.5 font-medium"
                                >
                                  Messages
                                </button>
                                <button
                                  @click="activeTab = 'tabSettings'"
                                  :class="activeTab === 'tabSettings' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' : 'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                                  class="btn shrink-0 px-3 py-1.5 font-medium"
                                >
                                  Settings
                                </button>
                              </div>
                            </div>
                            <div class="tab-content pt-4">
                              <div
                                x-show="activeTab === 'tabHome'"
                                x-transition:enter="transition-all duration-500 easy-in-out"
                                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                              >
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
                              <div
                                x-show="activeTab === 'tabProfile'"
                                x-transition:enter="transition-all duration-500 easy-in-out"
                                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                              >
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
                                    3.- Su metodología
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
                              <div
                                x-show="activeTab === 'tabMessages'"
                                x-transition:enter="transition-all duration-500 easy-in-out"
                                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                              >
                                <div>
                                  <p>
                                    Cras iaculis ipsum quis lectus faucibus, in mattis nulla molestie.
                                    Vestibulum vel tristique libero. Morbi vulputate odio at viverra
                                    sodales. Curabitur accumsan justo eu libero porta ultrices vitae eu
                                    leo.
                                  </p>
                                  <div class="flex space-x-2 pt-3">
                                    <a
                                      href="#"
                                      class="tag rounded-full border border-primary text-primary dark:border-accent-light dark:text-accent-light"
                                    >
                                      Tag 1
                                    </a>
                                    <a
                                      href="#"
                                      class="tag rounded-full border border-primary text-primary dark:border-accent-light dark:text-accent-light"
                                    >
                                      Tag 2
                                    </a>
                                  </div>
                        
                                  <p class="pt-3 text-xs text-slate-400 dark:text-navy-300">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore
                                    dolore non atque?
                                  </p>
                                </div>
                              </div>
                              <div
                                x-show="activeTab === 'tabSettings'"
                                x-transition:enter="transition-all duration-500 easy-in-out"
                                x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                                x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]"
                              >
                                <div>
                                  <p>
                                    Etiam nec ante eget lacus vulputate egestas non iaculis tellus.
                                    Suspendisse tempus ex in tortor venenatis malesuada. Aenean
                                    consequat dui vitae nibh lobortis condimentum. Duis vel risus est.
                                  </p>
                                  <div class="flex space-x-2 pt-3">
                                    <a
                                      href="#"
                                      class="tag rounded-full border border-primary text-primary dark:border-accent-light dark:text-accent-light"
                                    >
                                      Tag 1
                                    </a>
                                    <a
                                      href="#"
                                      class="tag rounded-full border border-primary text-primary dark:border-accent-light dark:text-accent-light"
                                    >
                                      Tag 2
                                    </a>
                                  </div>
                        
                                  <p class="pt-3 text-xs text-slate-400 dark:text-navy-300">
                                    Lorem ipsum dolor sit amet consectetur adipisicing elit. Tempore
                                    dolore non atque?
                                  </p>
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
