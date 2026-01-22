<div>
    <style>
        /* =========================================
           ESTILOS PERSONALIZADOS HEADER (RESPONSIVE)
           ========================================= */
        
        /* Contenedor Principal: Flexbox para alinear extremos */
        .custom-page-header {
            display: flex !important;
            align-items: center;
            justify-content: space-between;
            padding: 10px 20px;
            width: 100%;
            box-sizing: border-box;
            background-color: #ffffff;
        }

        /* Sección Izquierda: Logo + Toggle */
        .header-left-group {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        /* Logo: Control estricto de tamaño */
        .custom-logo-wrapper {
            display: block !important; /* Sobrescribe ocultamiento del tema */
            line-height: 0;
        }
        .custom-logo-img {
            height: 40px;
            width: auto;
            object-fit: contain;
        }

        /* Sección Derecha: Menú */
        .header-right-group {
            display: flex;
            align-items: center;
        }

        .custom-nav-list {
            display: flex;
            align-items: center;
            gap: 15px; /* Espaciado base */
            list-style: none;
            margin: 0;
            padding: 0;
        }

        /* Iconos Generales */
        .custom-nav-icon {
            font-size: 22px;
            color: #2c323f;
            cursor: pointer;
        }

        /* Carrito */
        .custom-cart-box {
            position: relative;
            display: flex;
            align-items: center;
        }
        .custom-cart-count {
            position: absolute;
            top: -8px;
            right: -8px;
            background-color: #e22454;
            color: #fff;
            font-size: 10px;
            font-weight: bold;
            padding: 2px 5px;
            border-radius: 10px;
            min-width: 16px;
            text-align: center;
        }

        /* Perfil / Avatar */
        .custom-profile-media {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
        }
        .custom-avatar-img, .custom-initials-box {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            object-fit: cover;
        }
        .custom-initials-box {
            background-color: #7366ff;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }
        .custom-user-info {
            display: flex;
            flex-direction: column;
            line-height: 1.2;
        }

        /* Botones Login */
        .btn-login-text { display: inline-block; }
        .btn-login-icon { display: none; }

        /* =========================================
           MODO OSCURO (DARK MODE)
           ========================================= */
        body.dark-only .custom-page-header {
            background-color: #111827 !important;
            /* border-bottom: 1px solid #374558; */
            border-bottom: 1px solid #e30613;
        }
        
        body.dark-only .custom-nav-icon {
            color: #b4b7c5;
        }
        
        body.dark-only .custom-user-info span {
            color: #f6f7fb !important;
        }
        
        body.dark-only .toggle-sidebar svg {
            stroke: #b4b7c5 !important;
        }

        /* =========================================
           MEDIA QUERIES (RESPONSIVE)
           ========================================= */

        /* Tablet y Móvil (< 991px) */
        @media only screen and (max-width: 991px) {
            .custom-user-info { display: none; } /* Ocultar nombre */
        }

        /* Móvil (< 575px) */
        @media only screen and (max-width: 575px) {
            .custom-page-header { padding: 10px 15px; }
            .header-left-group { gap: 10px; }
            .custom-nav-list { gap: 10px; }
            
            .custom-logo-img { height: 30px; } /* Logo más pequeño */
            .custom-nav-icon { font-size: 20px; }

            /* Login: Cambiar a icono */
            .btn-login-text { display: none; }
            .btn-login-icon { display: inline-block; }
        }

        /* Móvil Pequeño (< 450px) - Rango crítico 320px */
        @media only screen and (max-width: 450px) {
            .custom-page-header { padding: 8px 10px; }
            .header-left-group { gap: 5px; }
            .custom-nav-list { gap: 8px; }

            .custom-logo-img { 
                height: 26px; 
                max-width: 100px; 
            }
            
            .custom-nav-icon { font-size: 18px; }
            
            .custom-avatar-img, .custom-initials-box {
                width: 30px;
                height: 30px;
            }
            
            /* Ajuste fino para botón login icono */
            .btn-pill.px-2 { padding-left: 0.5rem !important; padding-right: 0.5rem !important; }
        }
    </style>

    <div class="page-header custom-page-header">
        
        <!-- IZQUIERDA: Logo y Toggle -->
        <div class="header-left-group">
            <div class="toggle-sidebar" style="cursor: pointer;">
                <svg class="stroke-icon" style="width: 24px; height: 24px;">
                    <use href="{{ asset('themes/webpage/assets/svg/icon-sprite.svg#Grid') }}"></use>
                </svg>
            </div>
            <div class="logo-wrapper custom-logo-wrapper">
                <a href="{{ route('index_main') }}">
                    <img class="custom-logo-img" src="{{ asset('themes/webpage/images/Logo_cpa_modificado.png') }}" alt="Logo">
                </a>
            </div>
        </div>

        <!-- DERECHA: Menú de Iconos -->
        <div class="header-right-group">
            <ul class="nav-menus custom-nav-list">
                
                <!-- Modo Oscuro -->
                <li class="mode-nav">
                    <div class="mode">
                        <i class="fa fa-toggle-on custom-nav-icon"></i>
                    </div>
                </li>

                <!-- Carrito -->
                <li class="cart-nav onhover-dropdown">
                    <div class="cart-box custom-cart-box">
                        <a href="{{ route('web_carrito') }}">
                            <i class="fa fa-cart-plus custom-nav-icon"></i>
                            <span class="cart-count custom-cart-count contador" id="contadorCarritoWeb">0</span>
                            <span id="contadorCarritoMovil" hidden style="display: none;"></span>
                        </a>
                    </div>
                </li>

                <!-- Usuario / Login -->
                @auth
                    <li class="profile-nav onhover-dropdown pe-0 py-0">
                        <div class="custom-profile-media">
                            @php
                                $userName = Auth::user()->name;
                                $userAvatar = Auth::user()->avatar;
                            @endphp

                            @if ($userAvatar && Storage::disk('public')->exists($userAvatar))
                                <img class="custom-avatar-img" src="{{ asset('storage/' . $userAvatar) }}" alt="Avatar">
                            @else
                                <div class="custom-initials-box">
                                    <span>{{ substr($userName, 0, 1) }}</span>
                                </div>
                            @endif
                            
                            <div class="custom-user-info">
                                <span style="font-weight: 600; font-size: 14px;">{{ $userName }}</span>
                                <span style="font-size: 12px; color: #898989;">
                                    {{ Auth::user()->hasRole(['Alumno']) ? 'Alumno' : 'Docente' }}
                                </span>
                            </div>
                        </div>
                    </li>
                @endauth

                @guest
                    <li>
                        <a href="{{ route('login') }}">
                            <!-- Botón Texto (Escritorio) -->
                            <button class="btn btn-pill btn-primary btn-air-primary btn-sm btn-login-text" type="button">
                                Iniciar sesión
                            </button>
                            <!-- Botón Icono (Móvil) -->
                            <button class="btn btn-pill btn-primary btn-air-primary btn-sm px-2 btn-login-icon" type="button">
                                <i class="fa fa-key"></i>
                            </button>
                        </a>
                    </li>
                @endguest

            </ul>
        </div>
                        
    </div>





    {{-- RESPALDO --}}
    {{-- <div class="page-header view-pc">
        <div class="header-wrapper row">
            <div class="logo-wrapper">
                <a href="{{ route('index_main') }}">
                    <img class="img-fluid" src="{{ asset('themes/webpage/assets/images/logo/logo.png') }}" alt="Logo">
                </a>
            </div>
            <svg class="stroke-icon toggle-sidebar">
                <use class="status_toggle middle sidebar-toggle"
                    href="{{ asset('themes/webpage/assets/svg/icon-sprite.svg#Grid') }}">
                </use>
            </svg>

            <img class="logo_header" src="{{ asset('themes/webpage/images/Logo_cpa_modificado.png') }}" alt="">
            <div class="nav-right col-auto pull-right right-header p-0 ms-auto">
                <ul class="nav-menus">
                    <li>
                        <div class="mode">
                            <i class="fa fa-toggle-on" aria-hidden="true" style="font-size: 26px;"></i>
                        </div>
                    </li>
                    <li class="cart-nav onhover-dropdown">
                        <div class="cart-box" style="top: 0px;">
                            <a href="{{ route('web_carrito') }}">
                                <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 26px;">
                                    <span class="cart-count contador" id="contadorCarritoWeb">0</span>
                                    <span id="contadorCarritoMovil" hidden
                                        style="color: white; display: none;"></span></i>
                            </a>
                        </div>
                    </li>
                    @auth
                        <li class="profile-nav onhover-dropdown pe-0 py-0 view-pc">
                            <div class="d-flex align-items-center profile-media">

                                @php
                                    $userName = Auth::user()->name;
                                    $userAvatar = Auth::user()->avatar;
                                @endphp

                                @if ($userAvatar && Storage::disk('public')->exists($userAvatar))
                                    <img class="b-r-25" src="{{ asset('storage/' . $userAvatar) }}" alt=""
                                        style="max-height: 3rem; max-width: 3rem;">
                                @else
                                    <div class="initials-circle">
                                        <span>{{ substr($userName, 0, 1) }}</span>
                                    </div>
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($userName) }}&size=150&rounded=true"
                                        alt="{{ $userName }}" class="b-r-25" style="max-height: 3rem; max-width: 3rem;">
                                @endif
                                <div class="flex-grow-1 user">
                                    <span>{{ $userName }}</span>

                                    <p class="mb-0 font-nunito">
                                        @if (Auth::user()->hasRole(['Alumno']))
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
                                Iniciar sesión
                            </button>
                        </a>
                        <a href="{{ route('login') }}" class="view-movile">
                            <button class="view-movile btn btn-pill btn-primary btn-air-primary btn-sm" type="button">
                                <i class="fa fa-key"></i>
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="page-header view-movile">
        <div class="header-wrapper row">
            <div class="logo-wrapper">
                <a href="{{ route('index_main') }}">
                    <img class="img-fluid" src="{{ asset('themes/webpage/assets/images/logo/logo.png') }}"
                        alt="Logo">
                </a>
            </div>
            <svg class="stroke-icon toggle-sidebar">
                <use class="status_toggle middle sidebar-toggle"
                    href="{{ asset('themes/webpage/assets/svg/icon-sprite.svg#Grid') }}">
                </use>
            </svg>

            <img class="logo_header" src="{{ asset('themes/webpage/images/Logo_cpa_modificado.png') }}" alt="">

            <div class="nav-right col-auto p-0 ms-auto">

                <ul class="" style="width: 100%">
                    <li class="cart-nav">
                        <div class="cart-box" style="top: 0px; padding: 0px 10px;">
                            <a href="{{ route('web_carrito') }}">
                                <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 46px;">
                                    <span class="cart-count contador" id="contadorCarritoWeb">0</span>
                                    <span id="contadorCarritoMovil" hidden
                                        style="color: white; display: none;"></span></i>
                            </a>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('login') }}">
                            <button class="btn btn-pill btn-primary btn-air-primary btn-sm" type="button"
                                data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                Login
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div> --}}




</div>
