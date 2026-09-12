
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
            z-index: 1000 !important;
            box-sizing: border-box;
            background-color: #ffffff !important;
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

        /* Swap de logo claro/blanco según modo: por defecto solo el claro */
        .custom-logo-img--dark { display: none; }

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
            font-size: 26px !important; /* Aumentado para mayor visibilidad */
            width: 30px;
            text-align: center;
            color: #2c323f;
            cursor: pointer;
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
        }

        /* Carrito */
        .custom-cart-box {
            position: relative;
            display: flex;
            align-items: center;
        }
        .custom-cart-count {
            position: absolute;
            top: -14px;
            right: -12px;
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

        /* En modo oscuro: mostrar el logo 100% blanco y ocultar el claro */
        html.dark .custom-logo-img--light,
        body.dark-only .custom-logo-img--light { display: none !important; }
        html.dark .custom-logo-img--dark,
        body.dark-only .custom-logo-img--dark { display: inline-block !important; }

        /* BLOQUE DE FUERZA BRUTA: Evita que el tema oculte el botón */
        .custom-nav-list li.custom-item-darkmode {
            display: flex !important;
            align-items: center !important;
            visibility: visible !important;
            opacity: 1 !important;
            position: relative !important;
            min-width: 45px !important; /* Evita que colapse en Home */
            justify-content: center !important;
            z-index: 1001 !important;
        }

        /* Estilos para el intercambio de iconos Sol/Luna */
        #darkModeToggle .sun-icon { display: none !important; }
        #darkModeToggle .moon-icon { display: inline-block !important; }

        /* Cuando está en modo oscuro (detectando clase en HTML o BODY) */
        html.dark #darkModeToggle .sun-icon,
        body.dark-only #darkModeToggle .sun-icon { 
            display: inline-block !important;
            color: #ffc107 !important; /* Sol amarillo */
        }

        html.dark #darkModeToggle .moon-icon,
        body.dark-only #darkModeToggle .moon-icon { 
            display: none !important; 
        }
        
        html.dark .custom-nav-icon,
        body.dark-only .custom-nav-icon {
            color: #b4b7c5;
        }
        
        .dark .custom-user-info span,
        body.dark-only .custom-user-info span {
            color: #f6f7fb !important;
        }
        
        .dark .toggle-sidebar svg,
        .dark .toggle-sidebar svg,
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
            .custom-page-header { 
                padding: 10px 15px; 
                flex-wrap: wrap !important;
                height: auto !important;
            }
            .header-left-group { gap: 10px; }
            .custom-nav-list { gap: 20px; }
            
            .custom-logo-img { height: 30px; } /* Logo más pequeño */
            .custom-nav-icon { font-size: 22px !important; }

            /* Login: Cambiar a icono */
            .btn-login-text { display: none; }
            .btn-login-icon { display: inline-block; }
        }

        /* Dropdown menu for user */
        .user-dropdown-menu {
            display: none;
            position: absolute;
            top: 100%;
            right: 0;
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            min-width: 180px;
            z-index: 1000;
            padding: 8px 0;
        }
        .onhover-dropdown:hover .user-dropdown-menu {
            display: block;
        }
        .user-dropdown-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 16px;
            color: #374151;
            text-decoration: none;
            font-size: 14px;
            transition: background 0.2s;
        }
        .user-dropdown-menu a:hover {
            background: #f3f4f6;
            color: #e30613;
        }
        .user-dropdown-menu .dropdown-divider {
            height: 1px;
            background: #e5e7eb;
            margin: 4px 0;
        }
        body.dark-only .user-dropdown-menu {
            background: #1f2937;
            border-color: #374558;
        }
        body.dark-only .user-dropdown-menu a {
            color: #d1d5db;
        }
        body.dark-only .user-dropdown-menu a:hover {
            background: #374558;
            color: #e30613;
        }
        body.dark-only .user-dropdown-menu .dropdown-divider {
            background: #374558;
        }


        /* Móvil Pequeño (< 450px) - Rango crítico 320px */
        @media only screen and (max-width: 450px) {
            .custom-page-header { padding: 8px 10px; }
            .header-left-group { gap: 5px; }
            .custom-nav-list { gap: 17px; }

            .custom-logo-img { 
                height: 26px; 
                max-width: 100px; 
            }
            
            .custom-nav-icon { font-size: 20px !important; }
            
            .custom-avatar-img, .custom-initials-box {
                width: 30px;
                height: 30px;
            }
            
            /* Ajuste fino para botón login icono */
            .btn-pill.px-2 { padding-left: 0.5rem !important; padding-right: 0.5rem !important; }
            .header-search-wrap .header-search-input { width: 0; padding: 0; opacity: 0; }
        }

        /* =========================================
           BUSCADOR EXPANDIBLE EN HEADER
           ========================================= */
        .header-search-wrap {
            display: flex;
            align-items: center;
            gap: 0;
            position: relative;
            list-style: none;
        }
        .header-search-wrap .search-toggle {
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            border: none;
            background: transparent;
            transition: background 0.25s;
        }
        .header-search-wrap .search-toggle:hover {
            background: rgba(0, 32, 96, 0.08);
        }
        body.dark-only .header-search-wrap .search-toggle:hover {
            background: rgba(255, 255, 255, 0.08);
        }
        .header-search-wrap .search-toggle svg {
            color: #2c323f;
            transition: color 0.25s;
        }
        body.dark-only .header-search-wrap .search-toggle svg {
            color: #b4b7c5;
        }
        .header-search-wrap .search-toggle:hover svg {
            color: #e30613;
        }
        .header-search-form {
            display: flex;
            align-items: center;
            overflow: hidden;
            width: 0;
            opacity: 0;
            transition: width 0.35s ease, opacity 0.25s ease, margin 0.35s ease;
            margin-left: 0;
        }
        .header-search-wrap.is-open .header-search-form,
        .header-search-wrap:hover .header-search-form {
            width: 220px;
            opacity: 1;
            margin-left: 4px;
        }
        .header-search-form input {
            width: 100%;
            padding: 7px 12px;
            border: 1px solid #d1d5db;
            border-radius: 20px 0 0 20px;
            font-size: 13px;
            outline: none;
            background: #ffffff;
            color: #1f2937;
            transition: border-color 0.25s;
        }
        .header-search-form input::placeholder { color: #9ca3af; }
        .header-search-form input:focus { border-color: #002060; }
        body.dark-only .header-search-form input {
            background: #1f2937;
            border-color: #374558;
            color: #f6f7fb;
        }
        body.dark-only .header-search-form input::placeholder { color: #6b7280; }
        body.dark-only .header-search-form input:focus { border-color: #e30613; }
        .header-search-form button {
            padding: 7px 14px;
            border: 1px solid #002060;
            border-left: none;
            border-radius: 0 20px 20px 0;
            background: #002060;
            color: #ffffff;
            cursor: pointer;
            font-size: 14px;
            transition: background 0.25s;
            white-space: nowrap;
            display: flex;
            align-items: center;
        }
        .header-search-form button svg {
            color: #ffffff;
        }
        .header-search-form button:hover { background: #004080; }
        body.dark-only .header-search-form button {
            background: #e30613;
            border-color: #e30613;
        }
        body.dark-only .header-search-form button:hover { background: #c00511; }
        @media only screen and (max-width: 575px) {
            .header-search-wrap:hover .header-search-form,
            .header-search-wrap.is-open .header-search-form {
                width: 160px;
            }
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
                    <img class="custom-logo-img custom-logo-img--light" src="{{ asset('themes/webpage/images/Logo_cpa_modificado.png') }}" alt="Logo">
                    <img class="custom-logo-img custom-logo-img--dark" src="{{ asset('themes/webpage/images/Logo_cpa_blanco.png') }}" alt="Logo">
                </a>
            </div>
        </div>

        <!-- DERECHA: Menú de Iconos -->
        <div class="header-right-group">
            <ul class="nav-menus custom-nav-list">

            @if(Route::is(['course_url_slug', 'landing_preview']))
                <li class="d-none d-md-block">
                    <button type="button" data-bs-toggle="modal" 
                            data-bs-target="#modalFinanciamiento"
                            class="btn btn-warning btn-lg w-100 fw-bold shadow-sm py-1 mt-2 btn-sm btn-pill"
                            style="color: #002060; border-radius: 12px;">
                            Hablar con un experto
                    </button>
                </li>
            @endif
                
                <!-- Buscador (SVG de svgrepo.com/svg/414914) -->
                <li class="header-search-wrap" id="headerSearchWrap">
                    <button type="button" class="search-toggle" id="headerSearchToggle" title="Buscar cursos">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M16.66,10.08c0,3.63-2.95,6.58-6.58,6.58s-6.58-2.95-6.58-6.58S6.45,3.5,10.08,3.5s6.58,2.95,6.58,6.58Z"/>
                            <line x1="14.76" y1="14.71" x2="20.49" y2="20.49"/>
                        </svg>
                    </button>
                    <form class="header-search-form" id="headerSearchForm" action="{{ route('web_search_courses') }}" method="GET">
                        <input type="text" name="q" id="headerSearchInput" placeholder="Buscar cursos..." autocomplete="off">
                        <button type="submit">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16.66,10.08c0,3.63-2.95,6.58-6.58,6.58s-6.58-2.95-6.58-6.58S6.45,3.5,10.08,3.5s6.58,2.95,6.58,6.58Z"/>
                                <line x1="14.76" y1="14.71" x2="20.49" y2="20.49"/>
                            </svg>
                        </button>
                    </form>
                </li>
                <script>
                    (function() {
                        const wrap = document.getElementById('headerSearchWrap');
                        const toggle = document.getElementById('headerSearchToggle');
                        const form = document.getElementById('headerSearchForm');
                        const input = document.getElementById('headerSearchInput');
                        let closeTimer = null;

                        toggle.addEventListener('click', function(e) {
                            e.stopPropagation();
                            wrap.classList.toggle('is-open');
                            if (wrap.classList.contains('is-open')) {
                                setTimeout(function() { input.focus(); }, 100);
                            }
                        });

                        wrap.addEventListener('mouseenter', function() { clearTimeout(closeTimer); });
                        wrap.addEventListener('mouseleave', function() {
                            closeTimer = setTimeout(function() {
                                if (!wrap.classList.contains('is-open')) {
                                    wrap.classList.remove('is-open');
                                }
                            }, 300);
                        });

                        document.addEventListener('click', function(e) {
                            if (!wrap.contains(e.target)) {
                                wrap.classList.remove('is-open');
                            }
                        });

                        input.addEventListener('keydown', function(e) {
                            if (e.key === 'Escape') {
                                wrap.classList.remove('is-open');
                            }
                        });
                    })();
                </script>

                <!-- Modo Oscuro -->
                <li class="custom-item-darkmode">
                    <div style="cursor: pointer;" id="darkModeToggle">
                        <!-- Luna para modo claro -->
                        <i class="fa-solid fa-moon custom-nav-icon moon-icon"></i>
                        <!-- Sol amarillo para modo oscuro -->
                        <i class="fa-solid fa-sun custom-nav-icon sun-icon"></i>
                    </div>
                </li>

                <script>
                    (function() {
                        const htmlEl = document.documentElement;
                        const bodyEl = document.body;

                        const syncUI = (isDark) => {
                            htmlEl.classList.toggle('dark', isDark);
                            bodyEl.classList.toggle('dark-only', isDark);
                        };

                        const initToggle = () => {
                            const toggle = document.getElementById('darkModeToggle');
                            // Evitar múltiples inicializaciones
                            if (!toggle || toggle.dataset.initialized) return;
                            
                            toggle.dataset.initialized = "true";

                            toggle.addEventListener('click', function() {
                                const currentlyDark = htmlEl.classList.contains('dark');
                                const nextState = !currentlyDark;
                                
                                syncUI(nextState);
                                localStorage.setItem("_x_darkMode_on", nextState);
                                localStorage.setItem("cion_mode", nextState ? 'dark-only' : 'light');
                            });
                        };

                        // 1. Aplicar estado visual inmediatamente (evita parpadeo)
                        const savedState = localStorage.getItem("_x_darkMode_on") === "true";
                        syncUI(savedState);

                        // 2. Inicializar listeners cuando el DOM esté listo
                        if (document.readyState === 'loading') {
                            document.addEventListener('DOMContentLoaded', initToggle);
                        } else {
                            initToggle();
                        }

                        // 3. Refuerzo final en window.load por si el tema sobreescribe clases
                        window.addEventListener('load', () => {
                            syncUI(localStorage.getItem("_x_darkMode_on") === "true");
                            initToggle();
                        });
                    })();
                </script>

                <!-- Carrito -->
                <li class="cart-nav onhover-dropdown">
                    <div class="cart-box custom-cart-box">
                        <a href="{{ route('web_carrito') }}">
                            <i class="fa-solid fa-cart-plus custom-nav-icon"></i>
                            <span class="cart-count custom-cart-count contador" id="contadorCarritoWeb">0</span>
                            <span id="contadorCarritoMovil" hidden style="display: none;"></span>
                        </a>
                    </div>
                </li>

                <!-- Usuario / Login -->
                @auth
                    <li class="profile-nav onhover-dropdown pe-0 py-0" style="position: relative;">
                        <div class="custom-profile-media" style="cursor: pointer;">
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
                        <div class="user-dropdown-menu">
                            <a href="{{ url('/dashboard') }}">
                                <i class="fa-solid fa-gauge-high"></i> Ir a Academy
                            </a>
                            <div class="dropdown-divider"></div>
                            <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                @csrf
                                <button type="submit" style="background: none; border: none; width: 100%; text-align: left; padding: 10px 16px; color: #e30613; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                                    <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesion
                                </button>
                            </form>
                        </div>
                    </li>
                @endauth

                @guest
                    <li>
                        <a href="{{ route('login') }}">
                            <!-- Botón Texto (Escritorio) -->
                            <button class="btn btn-pill btn-primary btn-air-primary btn-sm btn-login-text d-none d-md-inline-block" type="button">
                                Iniciar sesión
                            </button>
                            <!-- Botón Icono (Móvil) -->
                            <button class="btn btn-pill btn-primary btn-air-primary btn-sm px-2 btn-login-icon d-md-none" type="button">
                                <i class="fa-solid fa-key"></i>
                            </button>
                        </a>
                    </li>
                @endguest

            </ul>
        </div>

        {{-- Botón Móvil: Se muestra solo en Landing y debajo del contenido principal del header --}}
        @if(Route::is(['course_url_slug', 'landing_preview']))
            <div class="d-md-none w-100 pt-2 pb-1">
                <button type="button" data-bs-toggle="modal" 
                        data-bs-target="#modalFinanciamiento"
                        class="btn btn-warning btn-sm w-100 fw-bold shadow-sm py-2 btn-pill"
                        style="color: #002060; border-radius: 12px; font-size: 14px;">
                        <i class="fa-solid fa-headset me-2"></i> Hablar con un experto
                </button>
            </div>
        @endif

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
                        <li class="profile-nav onhover-dropdown pe-0 py-0 view-pc" style="position: relative;">
                            <div class="d-flex align-items-center profile-media" style="cursor: pointer;">

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
                            <div class="user-dropdown-menu">
                                <a href="{{ url('/dashboard') }}">
                                    <i class="fa-solid fa-gauge-high"></i> Ir a Academy
                                </a>
                                <div class="dropdown-divider"></div>
                                <form method="POST" action="{{ route('logout') }}" style="margin: 0;">
                                    @csrf
                                    <button type="submit" style="background: none; border: none; width: 100%; text-align: left; padding: 10px 16px; color: #e30613; cursor: pointer; font-size: 14px; display: flex; align-items: center; gap: 10px;">
                                        <i class="fa-solid fa-right-from-bracket"></i> Cerrar sesion
                                    </button>
                                </form>
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
