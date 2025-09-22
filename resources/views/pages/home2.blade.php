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
                <div class="container-fluid">
                    <br><br><br>
                    <x-slider />
                </div>
                <br>
                <!-- Container-fluid starts-->
                <div class="container-fluid dashboard_default">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card height-equal" style="min-height: 310.797px; background: none;">
                                <div class="card-header card-no-border pb-0" style="background: none;">
                                    <h3>Formación que transforma tu talento en resultados reales</h3>
                                </div>
                                <div class="card-body">
                                    <ul class="nav nav-pills nav-primary" id="pills-tab" role="tablist">
                                        <li class="nav-item" role="presentation"><a class="f-w-600 nav-link active"
                                                id="pills-aboutus-tab" data-bs-toggle="pill" href="#pills-aboutus"
                                                role="tab" aria-controls="pills-aboutus" aria-selected="false"
                                                tabindex="-1">Todos</a></li>
                                        <li class="nav-item" role="presentation"><a class="f-w-600 nav-link"
                                                id="pills-contactus-tab" data-bs-toggle="pill" href="#pills-contactus"
                                                role="tab" aria-controls="pills-contactus" aria-selected="false"
                                                tabindex="-1">Tipo</a></li>
                                        <li class="nav-item" role="presentation"><a class="f-w-600 nav-link "
                                                id="pills-blog-tab" data-bs-toggle="pill" href="#pills-blog"
                                                role="tab" aria-controls="pills-blog" aria-selected="true">Tipo </a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="pills-tabContent">
                                        <div class="tab-pane fade show active" id="pills-aboutus" role="tabpanel"
                                            aria-labelledby="pills-aboutus-tab">
                                            <x-courses.list-card />
                                        </div>
                                        <div class="tab-pane fade" id="pills-contactus" role="tabpanel"
                                            aria-labelledby="pills-contactus-tab">
                                            <ul class="d-flex flex-column gap-1 pt-3">
                                                <li> Create professional web page design. Responsive, fully customizable
                                                    with easy Drag-n-Drop Nicepage editor. Adjust colors, fonts, header and
                                                    footer, layout and other design elements, as well as content and images.
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="tab-pane fade " id="pills-blog" role="tabpanel"
                                            aria-labelledby="pills-blog-tab">
                                            <p>
                                                Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur similique
                                                at
                                                nostrum? Et sequi repellendus, illum, fuga officiis quos, quaerat provident
                                                iure eos enim maiores
                                                sint suscipit iste? Neque, hic?
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
            </div>
            <!-- footer start-->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 footer-copyright">
                            <p class="mb-0">Copyright 2023 © Cion theme by pixelstrap.</p>
                        </div>
                        <div class="col-md-6">
                            <p class="float-end mb-0">Hand crafted &amp; made with
                                <svg class="footer-icon">
                                    <use href="assets/svg/icon-sprite.svg#heart"></use>
                                </svg>
                            </p>
                        </div>
                    </div>
                </div>
            </footer>
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
