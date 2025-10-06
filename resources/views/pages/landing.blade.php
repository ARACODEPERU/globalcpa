@extends('layouts.webpage')
@section('etiquetasmeta')
<meta name="description" content="{{ $landingPage->description_short }}" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
@stop
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
                            <form method="POST" action="{{ route('landing_store_course_free') }}">
                                 @csrf
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
                                            <div class="row">
                                                @foreach ($coursesFree as $item)
                                                    <div class="col-md-3 box-col-4">
                                                        <div class="card weekend-card">
                                                            <!-- From Uiverse.io by Praashoo7 -->
                                                            <label class="c-container">
                                                                <input value="{{ $item->id }}" type="radio" name="courseFree">
                                                                <div class="c-checkmark">
                                                                    <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" class="c-icon">
                                                                        <path d="M 24.10 6.29 Q 28.34 7.56 28.00 12.00 Q 27.56 15.10 27.13 18.19 A 0.45 0.45 4.5 0 0 27.57 18.70 Q 33.16 18.79 38.75 18.75 Q 42.13 18.97 43.23 21.45 Q 43.91 22.98 43.27 26.05 Q 40.33 40.08 40.19 40.44 Q 38.85 43.75 35.50 43.75 Q 21.75 43.75 7.29 43.75 A 1.03 1.02 0.0 0 1 6.26 42.73 L 6.42 19.43 A 0.54 0.51 -89.4 0 1 6.93 18.90 L 14.74 18.79 A 2.52 2.31 11.6 0 0 16.91 17.49 L 22.04 7.17 A 1.74 1.73 21.6 0 1 24.10 6.29 Z M 21.92 14.42 Q 20.76 16.58 19.74 18.79 Q 18.74 20.93 18.72 23.43 Q 18.65 31.75 18.92 40.06 A 0.52 0.52 88.9 0 0 19.44 40.56 L 35.51 40.50 A 1.87 1.83 5.9 0 0 37.33 39.05 L 40.51 23.94 Q 40.92 22.03 38.96 21.97 L 23.95 21.57 A 0.49 0.47 2.8 0 1 23.47 21.06 Q 23.76 17.64 25.00 12.00 Q 25.58 9.36 24.28 10.12 Q 23.80 10.40 23.50 11.09 Q 22.79 12.80 21.92 14.42 Z M 15.57 22.41 A 0.62 0.62 0 0 0 14.95 21.79 L 10.01 21.79 A 0.62 0.62 0 0 0 9.39 22.41 L 9.39 40.07 A 0.62 0.62 0 0 0 10.01 40.69 L 14.95 40.69 A 0.62 0.62 0 0 0 15.57 40.07 L 15.57 22.41 Z" fill-opacity="1.000"></path>
                                                                        <circle r="1.51" cy="37.50" cx="12.49" fill-opacity="1.000"></circle>
                                                                    </svg>
                                                                </div>
                                                            </label>
                                                            <div class="card-body">
                                                                <img class="w-100 mb-3"
                                                                    src="{{ asset('storage/' . $item->image) }}"
                                                                    alt="{{ $item->description }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form_2 data_info" style="display: none;">
                                            <h2>Seleccionar Areas de Interes</h2>
                                            <div class="row">
                                                @foreach ($coursesFree as $item)
                                                    <div class="col-md-3 box-col-4">
                                                        <div class="card weekend-card">
                                                            <!-- From Uiverse.io by Praashoo7 -->
                                                            <label class="c-container">
                                                                <input value="{{ $item->id }}" type="radio" name="courseInterest">
                                                                <div class="c-checkmark">
                                                                    <svg viewBox="0 0 50 50" version="1.1" xmlns="http://www.w3.org/2000/svg" class="c-icon">
                                                                        <path d="M 24.10 6.29 Q 28.34 7.56 28.00 12.00 Q 27.56 15.10 27.13 18.19 A 0.45 0.45 4.5 0 0 27.57 18.70 Q 33.16 18.79 38.75 18.75 Q 42.13 18.97 43.23 21.45 Q 43.91 22.98 43.27 26.05 Q 40.33 40.08 40.19 40.44 Q 38.85 43.75 35.50 43.75 Q 21.75 43.75 7.29 43.75 A 1.03 1.02 0.0 0 1 6.26 42.73 L 6.42 19.43 A 0.54 0.51 -89.4 0 1 6.93 18.90 L 14.74 18.79 A 2.52 2.31 11.6 0 0 16.91 17.49 L 22.04 7.17 A 1.74 1.73 21.6 0 1 24.10 6.29 Z M 21.92 14.42 Q 20.76 16.58 19.74 18.79 Q 18.74 20.93 18.72 23.43 Q 18.65 31.75 18.92 40.06 A 0.52 0.52 88.9 0 0 19.44 40.56 L 35.51 40.50 A 1.87 1.83 5.9 0 0 37.33 39.05 L 40.51 23.94 Q 40.92 22.03 38.96 21.97 L 23.95 21.57 A 0.49 0.47 2.8 0 1 23.47 21.06 Q 23.76 17.64 25.00 12.00 Q 25.58 9.36 24.28 10.12 Q 23.80 10.40 23.50 11.09 Q 22.79 12.80 21.92 14.42 Z M 15.57 22.41 A 0.62 0.62 0 0 0 14.95 21.79 L 10.01 21.79 A 0.62 0.62 0 0 0 9.39 22.41 L 9.39 40.07 A 0.62 0.62 0 0 0 10.01 40.69 L 14.95 40.69 A 0.62 0.62 0 0 0 15.57 40.07 L 15.57 22.41 Z" fill-opacity="1.000"></path>
                                                                        <circle r="1.51" cy="37.50" cx="12.49" fill-opacity="1.000"></circle>
                                                                    </svg>
                                                                </div>
                                                            </label>
                                                            <div class="card-body">
                                                                <img class="w-100 mb-3"
                                                                    src="{{ asset('storage/' . $item->image) }}"
                                                                    alt="{{ $item->description }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <div class="form_3 data_info" style="display: none;">
                                            <div class="p-6">
                                                <h2 class="text-center">Professional Info</h2>
                                                <div class="card-body custom-input">
                                                    <div class="row">
                                                        <div class="col-md-6 col-lg-4 mx-auto">
                                                            <div class="row g-3">
                                                                <div class="col-12">
                                                                    <label class="form-label" for="nombres">Nombres</label>
                                                                    <input class="form-control" id="nombres" name="nombres" type="text" required="">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="form-label" for="apaterno">Apellido Paterno</label>
                                                                    <input class="form-control" id="apaterno"  name="apaterno" type="text" required="">
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="form-label" for="amaterno">Apellido Materno</label>
                                                                    <input class="form-control" id="amaterno" name="amaterno" type="text" required="">
                                                                </div>
                                                                <div class="col-6">
                                                                    <label class="form-label" for="tidocumento">Tipo Identificación</label>
                                                                    <select class="form-control" id="tidocumento" name="tidocumento">
                                                                        @foreach($documentTypes as $documentType)
                                                                            <option value="{{ $documentType->id }}" {{ $documentType->id == 1 ? 'selected' : '' }} >{{ $documentType->description }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="col-6">
                                                                    <label class="form-label" for="numero">Número</label>
                                                                    <input class="form-control" id="numero" name="numero" type="number" />
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="form-label" for="email">Dirección de correo electrónico</label>
                                                                    <input class="form-control" id="email" name="email" type="email" />
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="form-label" for="phone">Teléfono</label>
                                                                    <input class="form-control" id="phone" name="phone" type="text" />
                                                                </div>
                                                                <div class="col-12">
                                                                    <label class="form-label" for="select-countries">Pais</label>
                                                                    <select class="form-select" id="select-countries" name="pais">
                                                                        @foreach ($countries as $country)
                                                                           <option value="{{ $country->id }}" {{ $country->country_code == 'PE' ? 'selected' : '' }}>{{ $country->description }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div id="divSelectCity" class="col-12">
                                                                    <label class="form-label" for="select-city">Ciudad</label>
                                                                    <select class="form-select" id="select-city" name="pais">
                                                                        @foreach ($ubigeo as $city)
                                                                           <option value="{{ $city->id }}">{{ $city->department->name }}-{{ $city->province->name }}-{{ $city->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div id="divInputCity" class="col-12">
                                                                    <label class="form-label" for="ciudad">Ciudad</label>
                                                                    <input class="form-control" id="ciudad" name="ciudad" type="text" />
                                                                </div>
                                                                <div class="col-12 checkbox-checked">
                                                                    <input class="form-check-input" id="politicas" name="politicas" type="checkbox">
                                                                    <label class="form-check-label" for="politicas">
                                                                        Estoy de acuerdo con las <a target="_blank" href="{{ 'politicas_privacidad' }}"> políticas de privacidad</a>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
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
                                            <button type="submit" class="btn_done">Enviar</button>
                                        </div>
                                        <div>
                                            @if ($errors->any())
                                                <div class="alert alert-danger">
                                                    <ul class="mb-0">
                                                        @foreach ($errors->all() as $error)
                                                            <li>{{ $error }}</li>
                                                        @endforeach
                                                    </ul>
                                                </div>
                                            @endif

                                            @if (session('success'))
                                                <div class="alert alert-success">
                                                    {{ session('success') }}
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
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

            /* From Uiverse.io by Praashoo7 */
            /* Hide the default checkbox */
            .c-container input {
                opacity: 0;
                cursor: pointer;
                height: 0;
                width: 0;
            }

            .c-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center; /* ✅ centra vertical y horizontal */
                gap: 0.5em;              /* espacio entre icono y texto */
                position: absolute;
                inset: 0;
                cursor: pointer;
                font-size: 20px;
                user-select: none;
                opacity: 0;
                pointer-events: none;
                transition: opacity .3s ease;
                z-index: 2;
            }

            /* Caja del check */
            .c-checkmark {
                height: 3em;
                width: 3em;
                background-color: #171717;
                border-radius: 10px;
                transition: .2s ease-in-out;
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .c-like {
                font-size: 0.8em;
                text-align: center;
                color: white;
                opacity: 0; /* oculto hasta check */
                margin-top: 0; /* ✅ eliminamos el empuje hacia arriba */
            }

            .c-icon {
                fill: white;
                transition: .4s ease-in-out;
            }

            /* Hover animaciones */
            .c-checkmark:hover {
                background-color: white;
            }
            .c-checkmark:hover .c-icon {
                fill: black;
                transform: rotate(-8deg);
                transform-origin: bottom left;
            }

            /* Si está marcado */
            .c-container input:checked ~ .c-checkmark {
                background-color: limegreen;
            }
            .c-container input:checked ~ .c-like {
                opacity: 1;
                animation: 0.6s up_3951;
            }
            .c-container input:checked ~ .c-checkmark .c-icon {
                fill: white;
                transform: none;
                animation: 0.5s jump_3951;
            }

            @keyframes up_3951 {
                100% {
                    transform: translateY(-2em);
                }
            }
            @keyframes jump_3951 {
                50% {
                    transform-origin: center;
                    transform: translateY(-0.5em) rotate(-8deg);
                }
                100% {
                    transform-origin: center;
                    transform: translateY(0em);
                }
            }

            /* Card con overlay */
            .weekend-card {
                position: relative;
                overflow: hidden;
            }
            .weekend-card::before {
                content: "";
                position: absolute;
                inset: 0;
                background: rgba(0,0,0,0.5);
                opacity: 0;
                transition: opacity .3s ease;
                z-index: 1;
            }

            /* Mostrar al hacer hover */
            .weekend-card:hover::before,
            .weekend-card:hover .c-container {
                opacity: 1;
                pointer-events: auto;
            }

            /* ✅ Mantener visible si el input está checked */
            .c-container input:checked ~ .c-checkmark,
            .c-container input:checked ~ .c-like,
            .c-container input:checked ~ .c-icon {
                opacity: 1;
            }
            .weekend-card:has(.c-container input:checked)::before,
            .weekend-card:has(.c-container input:checked) .c-container {
                opacity: 1 !important;
                pointer-events: auto;
            }

        </style>
    </div>
@stop
@section('javascripts')
    <script>
        $('#divSelectCity').css('display', 'block');
        $('#divInputCity').css('display', 'none');


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

        // btn_done.addEventListener("click", function() {
        //     modal_wrapper.classList.add("active");
        // })

        shadow.addEventListener("click", function() {
            modal_wrapper.classList.remove("active");
        })
    </script>

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


    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $('#select-countries').select2({
            theme: 'bootstrap-5'
        });

        $('#select-countries').on('change', function () {
            let valor = $(this).val();

            if (valor == 1) {
                // Mostrar divSelectCity y ocultar divInputCity
                $('#divSelectCity').css('display', 'block');
                $('#divInputCity').css('display', 'none');
            } else {
                // Mostrar divInputCity y ocultar divSelectCity
                $('#divSelectCity').css('display', 'none');
                $('#divInputCity').css('display', 'block');
            }
        });

        $('#select-city').select2({
            theme: 'bootstrap-5'
        });
    </script>

@stop
