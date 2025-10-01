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
                <div class="container-fluid"></div>
                <br><br><br>
                <div class="container-fluid crm_dashboard">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="card">
                                <div class="blog-box blog-list row">
                                    <div class="col-sm-7">
                                        <img class="img-fluid sm-100-w"
                                            src="{{ asset('storage/'.$landingPage->main_image) }}"alt="">
                                    </div>
                                    <div class="col-sm-5">
                                        <div class="blog-details">
                                            <div class="blog-date">
                                                <span>05</span> January 2023
                                            </div>
                                            <h3>{{ $landingPage->title }} </h3>
                                            <div class="blog-bottom-content">
                                                <hr>
                                                <div>{!! $landingPage->description_long !!}</div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-12">
                            <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>

                            <div class="wrapper">
                                <div class="header">
                                    <ul>
                                        <li class="active form_1_progessbar">
                                            <div>
                                                <p>1</p>
                                            </div>
                                        </li>
                                        <li class="form_2_progessbar">
                                            <div>
                                                <p>2</p>
                                            </div>
                                        </li>
                                        <li class="form_3_progessbar">
                                            <div>
                                                <p>3</p>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                <div class="form_wrap">
                                    <div class="form_1 data_info">
                                        <h2>Seleccionar Formación Gratis</h2>
                                        <form>
                                            <div class="row">
                                                @foreach ($coursesFree as $item)
                                                    <div class="col-md-3 box-col-4">
                                                        <div class="card weekend-card">
                                                            <div class="card-body">
                                                                <img class="w-100 mb-3"
                                                                    src="{{ asset('storage/' . $item->image) }}"
                                                                    alt="{{ $item->description }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </form>
                                    </div>
                                    <div class="form_2 data_info" style="display: none;">
                                        <h2>Seleccionar Areas de Interes</h2>
                                        <form>
                                            <div class="row">
                                                @foreach ($coursesFree as $item)
                                                    <div class="col-md-3 box-col-4">
                                                        <div class="card weekend-card">
                                                            <div class="card-body">
                                                                <img class="w-100 mb-3"
                                                                    src="{{ asset('storage/' . $item->image) }}"
                                                                    alt="{{ $item->description }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </form>
                                    </div>
                                    <div class="form_3 data_info" style="display: none;">
                                        <h2>Professional Info</h2>
                                        <div class="card-body custom-input">
                                            <div class="row">
                                                <div class="col-md-4"></div>
                                                <div class="col-md-4">
                                                    <form class="row g-3">
                                                        <div class="col-6">
                                                            <label class="form-label" for="first-name">Nombres y
                                                                Apellidos</label>
                                                            <input class="form-control" id="first-name" type="text"
                                                                placeholder="..." aria-label="First name" required="">
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label" for="exampleFormControlInput1">Email
                                                                address</label>
                                                            <input class="form-control" id="exampleFormControlInput1"
                                                                type="email" placeholder="@" required="">
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label" for="first-name">Teléfono</label>
                                                            <input class="form-control" id="phone" type="text"
                                                                placeholder="..." aria-label="Phone" required="">
                                                        </div>
                                                        <div class="col-6">
                                                            <label class="form-label" for="validationDefault04">Pais</label>
                                                            <select class="form-select" id="validationDefault04"
                                                                required="">
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
                                                        <div class="col-12 checkbox-checked">
                                                            <input class="form-check-input" id="flexCheckDefault"
                                                                type="checkbox" value="">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                Estoy de acuerdo con las politicas de privacidad
                                                            </label>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="col-md-4"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="btns_wrap">
                                    <div class="common_btns form_1_btns">
                                        <button type="button" class="btn_next">
                                            Siguiente
                                            <span class="icon">
                                                <ion-icon name="arrow-forward-sharp"></ion-icon>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="common_btns form_2_btns" style="display: none;">
                                        <button type="button" class="btn_back">
                                            <span class="icon">
                                                <ion-icon name="arrow-back-sharp"></ion-icon>
                                            </span>
                                            Regresar
                                        </button>
                                        <button type="button" class="btn_next">
                                            Siguiente
                                            <span class="icon">
                                                <ion-icon name="arrow-forward-sharp"></ion-icon>
                                            </span>
                                        </button>
                                    </div>
                                    <div class="common_btns form_3_btns" style="display: none;">
                                        <button type="button" class="btn_back">
                                            <span class="icon">
                                                <ion-icon name="arrow-back-sharp"></ion-icon>
                                            </span>
                                            Regresar
                                        </button>
                                        <button type="button" class="btn_done">Enviar</button>
                                    </div>
                                </div>
                            </div>

                            <div class="modal_wrapper">
                                <div class="shadow"></div>
                                <div class="success_wrap">
                                    <span class="modal_icon"><ion-icon name="checkmark-sharp"></ion-icon></span>
                                    <p>You have successfully completed the process.</p>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <br>
                {{-- <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="card height-equal">
                                <div class="row">
                                    <div class="col-md-3"
                                        style="text-align: center; justify-content:center; padding: 0px;">
                                        <img style="width: 100%; heigth: 100%;"
                                            src="{{ asset('themes/webpage/images/landingform.jpg') }}" alt="">
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
                                                    <input class="form-control" id="exampleFormControlInput1"
                                                        type="email" placeholder="@" required="">
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
                </div> --}}
            </div>
            <!-- footer start-->
            <x-footer />
        </div>

        <style>
            @import url('https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;700&display=swap');

            :root {
                --primary: #6a4c93;
                --secondary: #bfc0c0;
                --white: #fff;
                --text-clr: #5b6475;
                --header-clr: #25273d;
                --next-btn-hover: #6a4c93;
                --back-btn-hover: #8b8c8c;
            }

            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
                list-style: none;
                outline: none;
                font-family: 'Open Sans', sans-serif;
            }

            body {
                background: var(--primary);
                color: var(--text-clr);
                font-size: 16px;
                position: relative;
            }

            .wrapper {
                width: 100%;
                max-width: 100%;
                /* background: var(--white); */
                margin: 50px auto 0;
                padding: 50px;
                border-radius: 5px;
            }

            .wrapper .header {
                margin-bottom: 35px;
                display: flex;
                justify-content: center;
            }

            .wrapper .header ul {
                display: flex;
            }

            .wrapper .header ul li {
                margin-right: 50px;
                position: relative;
            }

            .wrapper .header ul li:last-child {
                margin-right: 0;
            }

            .wrapper .header ul li:before {
                content: "";
                position: absolute;
                top: 50%;
                transform: translateY(-50%);
                left: 55px;
                width: 100%;
                height: 2px;
                background: var(--secondary);
            }

            .wrapper .header ul li:last-child:before {
                display: none;
            }

            .wrapper .header ul li div {
                padding: 5px;
                border-radius: 50%;
            }

            .wrapper .header ul li p {
                width: 50px;
                height: 50px;
                background: var(--secondary);
                color: var(--white);
                text-align: center;
                line-height: 50px;
                border-radius: 50%;
            }

            .wrapper .header ul li.active:before {
                background: var(--primary);
            }

            .wrapper .header ul li.active p {
                background: var(--primary);
            }

            .wrapper .form_wrap {
                margin-bottom: 35px;
            }

            .wrapper .form_wrap h2 {
                color: var(--header-clr);
                text-align: center;
                text-transform: uppercase;
                margin-bottom: 20px;
            }

            .wrapper .form_wrap .input_wrap {
                width: 350px;
                max-width: 100%;
                margin: 0 auto 20px;
            }

            .wrapper .form_wrap .input_wrap:last-child {
                margin-bottom: 0;
            }

            .wrapper .form_wrap .input_wrap label {
                display: block;
                margin-bottom: 5px;
            }

            .wrapper .form_wrap .input_wrap .input {
                border: 2px solid var(--secondary);
                border-radius: 3px;
                padding: 10px;
                display: block;
                width: 100%;
                font-size: 16px;
                transition: 0.5s ease;
            }

            .wrapper .form_wrap .input_wrap .input:focus {
                border-color: var(--primary);
            }

            .wrapper .btns_wrap {
                width: 350px;
                max-width: 100%;
                margin: 0 auto;
            }

            .wrapper .btns_wrap .common_btns {
                display: flex;
                justify-content: space-between;
            }

            .wrapper .btns_wrap .common_btns.form_1_btns {
                justify-content: flex-end;
            }

            .wrapper .btns_wrap .common_btns button {
                border: 0;
                padding: 12px 15px;
                background: var(--primary);
                color: var(--white);
                width: 135px;
                justify-content: center;
                display: flex;
                align-items: center;
                font-size: 16px;
                border-radius: 3px;
                transition: 0.5s ease;
                cursor: pointer;
            }

            .wrapper .btns_wrap .common_btns button.btn_back {
                background: var(--secondary);
            }

            .wrapper .btns_wrap .common_btns button.btn_next .icon {
                display: flex;
                margin-left: 10px;
            }

            .wrapper .btns_wrap .common_btns button.btn_back .icon {
                display: flex;
                margin-right: 10px;
            }

            .wrapper .btns_wrap .common_btns button.btn_next:hover,
            .wrapper .btns_wrap .common_btns button.btn_done:hover {
                background: var(--next-btn-hover);
            }

            .wrapper .btns_wrap .common_btns button.btn_back:hover {
                background: var(--back-btn-hover);
            }

            .modal_wrapper {
                position: fixed;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                visibility: hidden;
            }

            .modal_wrapper .shadow {
                position: absolute;
                top: 0;
                left: 0;
                width: 100%;
                height: 100%;
                background: rgba(0, 0, 0, 0.8);
                opacity: 0;
                transition: 0.2s ease;
            }

            .modal_wrapper .success_wrap {
                position: absolute;
                top: 50%;
                left: 50%;
                transform: translate(-50%, -800px);
                background: var(--white);
                padding: 50px;
                display: flex;
                align-items: center;
                border-radius: 5px;
                transition: 0.5s ease;
            }

            .modal_wrapper .success_wrap .modal_icon {
                margin-right: 20px;
                width: 50px;
                height: 50px;
                background: var(--primary);
                color: var(--white);
                border-radius: 50%;
                display: flex;
                align-items: center;
                justify-content: center;
                font-size: 32px;
                font-weight: 700;
            }

            .modal_wrapper.active {
                visibility: visible;
            }

            .modal_wrapper.active .shadow {
                opacity: 1;
            }

            .modal_wrapper.active .success_wrap {
                transform: translate(-50%, -50%);
            }
        </style>

        <script>
            var form_1 = document.querySelector(".form_1");
            var form_2 = document.querySelector(".form_2");
            var form_3 = document.querySelector(".form_3");


            var form_1_btns = document.querySelector(".form_1_btns");
            var form_2_btns = document.querySelector(".form_2_btns");
            var form_3_btns = document.querySelector(".form_3_btns");


            var form_1_next_btn = document.querySelector(".form_1_btns .btn_next");
            var form_2_back_btn = document.querySelector(".form_2_btns .btn_back");
            var form_2_next_btn = document.querySelector(".form_2_btns .btn_next");
            var form_3_back_btn = document.querySelector(".form_3_btns .btn_back");

            var form_2_progessbar = document.querySelector(".form_2_progessbar");
            var form_3_progessbar = document.querySelector(".form_3_progessbar");

            var btn_done = document.querySelector(".btn_done");
            var modal_wrapper = document.querySelector(".modal_wrapper");
            var shadow = document.querySelector(".shadow");

            form_1_next_btn.addEventListener("click", function() {
                form_1.style.display = "none";
                form_2.style.display = "block";

                form_1_btns.style.display = "none";
                form_2_btns.style.display = "flex";

                form_2_progessbar.classList.add("active");
            });

            form_2_back_btn.addEventListener("click", function() {
                form_1.style.display = "block";
                form_2.style.display = "none";

                form_1_btns.style.display = "flex";
                form_2_btns.style.display = "none";

                form_2_progessbar.classList.remove("active");
            });

            form_2_next_btn.addEventListener("click", function() {
                form_2.style.display = "none";
                form_3.style.display = "block";

                form_3_btns.style.display = "flex";
                form_2_btns.style.display = "none";

                form_3_progessbar.classList.add("active");
            });

            form_3_back_btn.addEventListener("click", function() {
                form_2.style.display = "block";
                form_3.style.display = "none";

                form_3_btns.style.display = "none";
                form_2_btns.style.display = "flex";

                form_3_progessbar.classList.remove("active");
            });

            btn_done.addEventListener("click", function() {
                modal_wrapper.classList.add("active");
            })

            shadow.addEventListener("click", function() {
                modal_wrapper.classList.remove("active");
            })
        </script>

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
