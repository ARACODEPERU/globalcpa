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
            <form class="col-md-2 form-inline search-full" action="#" method="get">
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
            </form>

            <img style="width: 280px;" src="{{ asset('themes/webpage/images/Logo_cpa_modificado.png') }}"
                alt="">
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
                        <div class="cart-box" style="top: 12px;">
                            <a href="{{ route('web_carrito') }}">
                                <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 26px;">
                                    <span class="cart-count contador" id="contadorCarritoWeb">0</span>
                                    <span id="contadorCarritoMovil" hidden
                                        style="color: white; display: none;"></span></i>
                            </a>
                            <svg>
                                {{-- <use href="themes/webpage/assets/svg/icon-sprite.svg#Buy"></use> --}}
                            </svg>
                        </div>
                    </li>
                    <li>
                        <div class="mode">
                            <i class="fa fa-moon" aria-hidden="true" style="font-size: 26px;"></i>
                            {{-- <svg>
                                <use href="themes/webpage/assets/svg/icon-sprite.svg#moon"></use>
                            </svg> --}}
                        </div>
                    </li>
                    <li class="profile-nav onhover-dropdown pe-0 py-0">
                        <div class="d-flex align-items-center profile-media">
                            <img class="b-r-25" src="{{ asset('themes/webpage/assets/images/dashboard/profile.png') }}"
                                alt="">
                            <div class="flex-grow-1 user"><span>Helen Walter</span>
                                <p class="mb-0 font-nunito">Estudiante
                                </p>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="">
                            <button class="btn btn-pill btn-primary btn-air-primary btn-sm" type="button"
                                data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 18px;"></i>
                                Campus Virtual
                            </button>
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>


    {{-- <header class="header">
        <div class="header__container">
            <img src="{{ asset('themes/webpage/slidebar/img/perfil.jpg') }}" alt="" class="header__img">
            <a href="#" class="header__logo"></a>

            <div class="header__search">
                <input type="search" placeholder="Search" class="header__input">
                <i class='bx bx-search header__icon'></i>
            </div>

            <div class="header__toggle">
                <i class='bx bx-menu' id="header-toggle"></i>
            </div>
        </div>
    </header> --}}


    <style>
        .cart-icon {
            position: relative;
            display: inline-block;
        }

        .cart-count {
            position: absolute;
            top: -7px;
            left: 15px;
            background-color: #6a4c93;
            /* Color celeste */
            color: #ffffff;
            /* Color negro */
            border-radius: 50%;
            /* Para hacer un círculo */
            width: 22px;
            height: 22px;
            line-height: 22px;
            text-align: center;
            font-size: 14px;
            font-weight: 700;
        }
    </style>

</div>
