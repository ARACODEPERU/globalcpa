<div>
    <div class="page-header">
        <div class="header-wrapper row">
            <div class="logo-wrapper"><a href=""><img class="img-fluid"
                        src="{{ asset('themes/webpage/assets/images/logo/logo.png') }}" alt=""></a></div>
            <svg class="stroke-icon toggle-sidebar">
                <use class="status_toggle middle sidebar-toggle"
                    href="{{ asset('themes/webpage/assets/svg/icon-sprite.svg#Grid') }}">
                </use>
            </svg>
            {{-- <form class="col-md-2 form-inline search-full" action="#" method="get">
                <div class="form-group">
                    <div class="Typeahead Typeahead--twitterUsers">
                        <div class="u-posRelative">
                            <input class="demo-input Typeahead-input form-control-plaintext w-100" type="text"
                                placeholder="Type to Search .." name="q" title="" autofocus>
                            <svg class="search-bg svg-color">
                                <use href="{{ asset('themes/webpage/assets/svg/icon-sprite.svg#Search') }}"></use>
                            </svg>
                        </div>
                        <div class="Typeahead-menu"></div>
                    </div>
                </div>
            </form> --}}

            <img class="logo_header" src="{{ asset('themes/webpage/images/Logo_cpa_modificado.png') }}" alt="">
            <div class="nav-right col-auto pull-right right-header p-0 ms-auto">
                <ul class="nav-menus">
                    {{-- <li class="serchinput">
                        <div class="serchbox">
                            <svg>
                                <use href="{{ asset('themes/webpage/assets/svg/icon-sprite.svg#Search') }}"></use>
                            </svg>
                        </div>
                        <div class="form-group search-form">
                            <input type="text" placeholder="Search here...">
                        </div>
                    </li> --}}
                    <li class="cart-nav onhover-dropdown">
                        <div class="cart-box" style="top: 8px;">
                            <a href="{{ route('web_carrito') }}">
                                <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 26px;">
                                    <span class="cart-count contador" id="contadorCarritoWeb">0</span>
                                    <span id="contadorCarritoMovil" hidden
                                        style="color: white; display: none;"></span></i>
                            </a>
                        </div>
                    </li>
                    {{-- <li>
                        <div class="mode">
                            <i class="fa fa-moon" aria-hidden="true" style="font-size: 26px;"></i>
                        </div>
                    </li> --}}
                    @auth
                        <li class="profile-nav onhover-dropdown pe-0 py-0">
                            <div class="d-flex align-items-center profile-media">
                                {{-- Muestra la imagen de perfil del usuario logueado --}}

                                @php
                                    // Obtenemos el nombre y el avatar del usuario
                                    $userName = Auth::user()->name;
                                    $userAvatar = Auth::user()->avatar;
                                    // Verificamos si el archivo de la imagen existe en el disco 'public'
                                    $avatarExists = Storage::disk('public')->exists($userAvatar);
                                @endphp

                                {{-- Si el avatar existe, muestra la imagen --}}
                                @if($avatarExists)
                                    <img class="b-r-25" src="{{ asset('storage' . $userAvatar) }}" alt="" style="max-height: 3rem; max-width: 3rem;">
                                @else
                                    {{-- Si el avatar no existe, muestra el círculo con las iniciales --}}
                                    <div class="initials-circle">
                                        {{-- Obtenemos las iniciales del nombre --}}
                                        <span>{{ substr($userName, 0, 1) }}</span>
                                    </div>
                                @endif
                                <div class="flex-grow-1 user">
                                    {{-- Muestra el nombre del usuario logueado --}}
                                    <span>{{ Auth::user()->name }}</span>
                                    <p class="mb-0 font-nunito">
                                        @if(Auth::user()->role === 'Alumno')
                                            Alumno
                                        @else
                                            Docente
                                        @endif
                                    </p>
                                </div>
                            </div>
                        </li>
                    @endauth
                    <li>
                        <a href="{{ route('login') }}" class="view-pc">
                            <button class="btn btn-pill btn-primary btn-air-primary btn-sm" type="button"
                                data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                Campus Virtual
                            </button>
                        </a>
                        <a href="{{ route('login') }}" class="view-movile">
                            <button class="btn btn-pill btn-primary btn-air-primary btn-sm" type="button"
                                data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                Campus
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
