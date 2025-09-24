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
            <div class="page-body">
                <div class="container-fluid"></div>
                <br><br><br>
                <div class="container-fluid crm_dashboard">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="blog-box blog-list row">
                                    <div class="col-sm-7">
                                        <img class="img-fluid sm-100-w"
                                            src="{{ asset('themes/webpage/images/cyber.jpg') }}"alt="">
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="blog-details">
                                            <div class="blog-date">
                                                <span>05</span> January 2023
                                            </div>
                                            <h3>Java Language </h3>
                                            <div class="blog-bottom-content">
                                                <hr>
                                                <p class="mt-0">Java is an object-oriented programming language.
                                                    Sun Microsystems first released Java in the year 1995. It is
                                                    popularly used for developing Java applications in data centers,
                                                    laptops, cell phones, game consoles, and scientific
                                                    supercomputers. There are multiple websites and applications
                                                    which will not work if Java is not installed.</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <br>
                <div class="container-fluid dashboard_default">
                    <div class="row widget-grid">
                        @foreach ($courses->take(12) as $item)
                            <div class="col-xl-4 col-md-6 col-sm-12 box-col-4">
                                <div class="card weekend-card">
                                    <div class="card-body">
                                        <img class="w-100 mb-3" src="{{ asset('storage/' . $item->course->image) }}"
                                            alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                <br>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="card height-equal">
                                <div class="row">
                                    <div class="col-md-3" style="text-align: center; justify-content:center; padding: 0px;">
                                        <img style="width: 100%; heigth: 100%;" src="{{ asset('themes/webpage/images/landingform.jpg') }}"
                                            alt="">
                                    </div>
                                    <div class="col-md-9">
                                        <div class="card-header pb-0">
                                            <h3>Título del formulario</h3>
                                            <p>
                                                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Debitis doloribus
                                                officia officiis totam! Soluta,
                                                velit deserunt sunt veritatis repudiandae quas distinctio officiis, labore
                                                doloribus placeat sint at culpa
                                                eos cupiditate.
                                            </p>
                                        </div>
                                        <div class="card-body custom-input">
                                            <form class="row g-3">
                                                <div class="col-6">
                                                    <label class="form-label" for="first-name">Nombres y Apellidos</label>
                                                    <input class="form-control" id="first-name" type="text"
                                                        placeholder="..." aria-label="First name" required="">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="exampleFormControlInput1">Email
                                                        address</label>
                                                    <input class="form-control" id="exampleFormControlInput1" type="email"
                                                        placeholder="@" required="">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="first-name">Teléfono</label>
                                                    <input class="form-control" id="phone" type="text"
                                                        placeholder="..." aria-label="Phone" required="">
                                                </div>
                                                <div class="col-6">
                                                    <label class="form-label" for="validationDefault04">Pais</label>
                                                    <select class="form-select" id="validationDefault04" required="">
                                                        <option selected="" value="">Perú</option>
                                                        <option>otro pais</option>
                                                        <option>otro pais</option>
                                                        <option>otro pais</option>
                                                    </select>
                                                </div>
                                                <div class="col-4">
                                                    <label class="form-label" for="first-name">Ciudad</label>
                                                    <input class="form-control" id="city" type="text"
                                                        placeholder="..." aria-label="City" required="">
                                                </div>
                                                <div class="col-8">
                                                    <label class="form-label" for="validationDefault04">Programas de
                                                        Formación</label>
                                                    <select class="form-select" id="validationDefault04" required="">
                                                        <option selected="" value="">Seleccionar...</option>
                                                        <option>curos 1</option>
                                                        <option>curos 2</option>
                                                        <option>curos 3</option>
                                                        <option>curos 4</option>
                                                    </select>
                                                </div>
                                                <div class="col-12 checkbox-checked">
                                                    <input class="form-check-input" id="flexCheckDefault" type="checkbox"
                                                        value="">
                                                    <label class="form-check-label" for="flexCheckDefault">
                                                        Estoy de acuerdo con las politicas de privacidad
                                                    </label>
                                                </div>
                                                <div class="col-12">
                                                    <button class="btn btn-primary" type="submit">Enviar</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2"></div>
                    </div>
                </div>
            </div>
            <!-- footer start-->
            <x-footer />
        </div>

    </div>

























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

@stop
