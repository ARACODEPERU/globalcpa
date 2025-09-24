<div>

    <footer
        style="background: #020024;
                background: linear-gradient(0deg, rgba(2, 0, 36, 1) 0%, rgb(80, 57, 112) 35%, rgba(106, 76, 147, 1) 100%); 
                width: 100%;">
        <div class="container">
            <div class="row" style=" padding: 80px 0px;">
                <div class="col-md-3" style="padding: 15px;">
                    <h2 style="color: #fff; font-size: 16px; padding-bottom: 10px;"><b>VERIFICA EL <br> CERTIFICADO</b>
                    </h2>
                    <p style="color: #fff;">Valida el certificado GLOBAL CPA ingresando el código único</p>

                    <div class="card">
                        <div class="">
                            <div class="btn-showcase">
                                <a href="{{ route('certificado_validar') }}">
                                    <button class="btn btn-pill btn-light btn-air-light btn-sm" type="button"
                                        data-bs-original-title="btn btn-pill btn-light btn-air-light btn-sm">
                                        <i class="fa fa-certificate"></i>
                                        Validar Certificado
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="padding: 15px;">
                    <h2 style="color: #fff; font-size: 16px; padding-bottom: 10px;"><b>LEGAL</b></h2>
                    <ul>
                        <li class="font-medium line-clamp-1 dark:text-navy-100">
                            <a href="{{ route('politicas_privacidad') }}" style="color: #fff;">Políticas de
                                privacidad</a>
                        </li>
                        <li class="font-medium line-clamp-1 dark:text-navy-100">
                            <a href="{{ route('politicas_devoluciones') }}" style="color: #fff;">Políticas de
                                devoluciones</a>
                        </li>
                        <li class="font-medium line-clamp-1 dark:text-navy-100">
                            <a href="{{ route('terms_main') }}" style="color: #fff;">Terminos y condiciones</a>
                        {{-- </li>
                        <li class="font-medium line-clamp-1 dark:text-navy-100">
                            <a href="{{ route('certificado_validar') }}" style="color: #fff;">Validar Certificado<i
                                    class="fa fa-certificate"></i></a>
                        </li> --}}
                    </ul>
                </div>
                <div class="col-md-3" style="padding: 15px;">
                    <h2 style="color: #fff; font-size: 16px; padding-bottom: 10px;"><b>CONTÁCTANOS</b></h2>
                    <ul>
                        <li style="color: #fff; font-size: 16px;"><i class="fa fa-phone-square" aria-hidden="true"></i>
                            967 052 506</li>
                        <li style="color: #fff; font-size: 16px;"><i class="fa fa-envelope" aria-hidden="true"></i>
                            informes@globalcpaperu.com</li>
                    </ul>
                </div>
                <div class="col-md-3" style="padding: 15px;">
                    <a href="{{ route('complaints_book') }}">
                        <img style="width: 180px;" src="{{ asset('themes/webpage/images/libroReclamaciones.png') }}"
                            alt="" style="margin-top: -10px;">
                    </a>
                </div>
            </div>
        </div>
    </footer>
</div>
