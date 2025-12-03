<div>
    <div class="page-header">
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
                        <li class="profile-nav onhover-dropdown pe-0 py-0">
                            <div class="d-flex align-items-center profile-media">

                                @php
                                    $userName = Auth::user()->name;
                                    $userAvatar = Auth::user()->avatar;
                                @endphp

                                {{-- Si el avatar existe, muestra la imagen --}}
                                @if ($userAvatar && Storage::disk('public')->exists($userAvatar))
                                    <img class="b-r-25" src="{{ asset('storage/' . $userAvatar) }}" alt=""
                                        style="max-height: 3rem; max-width: 3rem;">
                                @else
                                    {{-- Si el avatar no existe, muestra el círculo con las iniciales --}}
                                    <div class="initials-circle">
                                        <span>{{ substr($userName, 0, 1) }}</span>
                                    </div>
                                    <img src="https://ui-avatars.com/api/?name={{ urlencode($userName) }}&size=150&rounded=true"
                                        alt="{{ $userName }}" class="b-r-25" style="max-height: 3rem; max-width: 3rem;">
                                @endif
                                <div class="flex-grow-1 user">
                                    {{-- Muestra el nombre del usuario logueado --}}
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
                            <button class="btn btn-pill btn-primary btn-air-primary btn-sm" type="button"
                                data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                Login
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
