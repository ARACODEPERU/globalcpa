<div>

    <footer
        style="background: #575756;
                background: linear-gradient(0deg, rgb(19, 19, 19) 0%, rgb(42, 42, 42) 35%, rgba(87, 87, 86, 1) 100%); 
                width: 100%;">
        <div class="container"  style=" padding: 80px 0px; 40px 0px">
            <div class="row">
                <div class="col-md-3" style="padding: 15px;">
                    <h2 style="color: #fff; font-size: 16px; padding-bottom: 10px;"><b>VERIFICA EL <br> CERTIFICADO</b>
                    </h2>
                    <p style="color: #fff;">Valida el certificado GLOBAL CPA ingresando el DNI</p>

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
                    <div style="margin-top: 9px; display:flex;">
                        <a target="_blank" href="https://www.facebook.com/globalcpaperu"
                            style="padding: 0px 5px 0px 0px;">
                            <img  style="width: 30px;" src="{{ asset('themes/webpage/images/logos/facebook-round.svg') }}" alt="flag">
                        </a>
                        <a target="_blank" href="https://www.instagram.com/globalcpaperu?fbclid=IwY2xjawJgP6xleHRuA2FlbQIxMAABHmC56yDiAjSs4BvQSToBjedZ_3TBmwWJVvy1bu2BAk1wlFtAL3aOytzhh9a1_aem_djL_wmqYvY30HkGI5Fpl8w"
                            style="padding: 0px 5px;" >
                            <img style="width: 30px;" src="{{ asset('themes/webpage/images/logos/instagram-round.svg') }}" alt="flag">
                        </a>
                        <a target="_blank" href="https://www.tiktok.com/@globalcpa?fbclid=IwY2xjawJgQIFleHRuA2FlbQIxMAABHiRm71gl0ia3vlL0xGmy3mBrZsuIYuP53Mbwbe3w_OmFqAHpkq0_B3SfUHzj_aem_tGPEL911HtXoOaqpidsq7w"
                            style="padding: 0px 5px;" >
                            <img style="width: 30px;" src="{{ asset('themes/webpage/images/logos/tik_tok-round.svg') }}" alt="flag">
                        </a>
                        <a target="_blank" href="https://www.youtube.com/@globalcpaperu"
                            style="padding: 0px 5px;" >
                            <img style="width: 30px;" src="{{ asset('themes/webpage/images/logos/youtube-round.svg') }}" alt="flag">
                        </a>
                    </div>
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
