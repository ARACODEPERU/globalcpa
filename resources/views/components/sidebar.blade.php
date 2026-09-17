<div>
    <div class="sidebar-wrapper" data-layout="stroke-svg">
        <div>
            <div class="logo-wrapper">
                <a href="{{ route('index_main') }}">
                    <img class="img-fluid"
                        src="{{ asset('themes/webpage/images/Logo_isotipo_negativo.png') }}" alt="">
                </a>
                <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
            </div>
            <nav class="sidebar-main">
                <div id="sidebar-menu">
                    <ul class="sidebar-links" id="simple-bar">
                        <li class="back-btn">
                            <a href=""></a>
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                    aria-hidden="true"></i></div>
                        </li>
                        <li class="sidebar-main-title">
                            <div></div>
                        </li>
                        <li class="sidebar-list" style="padding: 15px 0px;">
                            <a class="sidebar-link sidebar-title" href="{{ route('index_main') }}">
                                <span class="sb-item">
                                    <span class="sb-icon-box"><i class="fa fa-home" aria-hidden="true"></i></span>
                                    Home
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-list" style="padding: 15px 0px;">
                            <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                <span class="sb-item">
                                    <span class="sb-icon-box"><i class="fa fa-graduation-cap" aria-hidden="true"></i></span>
                                    Formación
                                </span>
                            </a>
                            <ul class="sidebar-submenu custom-scrollbar">
                                <li class="sidebar-head">Formación</li>
                                @foreach ($types as $type)
                                    <li class="main-submenu">
                                        <a class="d-flex sidebar-menu" href="javascript:void(0)">
                                            <svg class="stroke-icon">
                                                <use
                                                    href="{{ asset('themes/webpage/assets/svg/icon-sprite.svg#stroke-others') }}">
                                                </use>
                                            </svg>
                                            <svg class="fill-icon">
                                                <use
                                                    href="{{ asset('themes/webpage/assets/svg/icon-sprite.svg#stroke-others') }}">
                                                </use>
                                            </svg>{{ $type == 'Programas de Especialización' ? 'Especialización' : $type }}
                                            <svg class="arrow">
                                                <use
                                                    href="{{ asset('themes/webpage/assets/svg/icon-sprite.svg#Arrow-right') }}">
                                                </use>
                                            </svg>
                                        </a>
                                        <ul class="submenu-wrapper">
                                            @php
                                                $x = 0;
                                            @endphp
                                            @foreach ($courses as $course)
                                                @if (strtolower($course->additional) == strtolower($type) && $x < $p)
                                                    <li>
                                                        @php
                                                            $landing = $course->course?->landing;
                                                            $hasPublishedLanding = filled($landing?->url_slug) && ($landing?->is_published ?? false);
                                                        @endphp
                                                        <a class="truncated-link"
                                                            href="{{ $hasPublishedLanding ? route('course_url_slug', $landing->url_slug) : route('web_course_description', $course->id) }}"
                                                            title="{{ $course->name }}">{{ $course->name }}</a>
                                                    </li>
                                                    @php
                                                        $x++;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            <li>
                                                <div class="btn-showcase" style="text-align: center;">
                                                    <a href="{{ route('web_courses') }}">
                                                        <button class="btn btn-pill btn-primary btn-air-primary btn-sm"
                                                            type="button"
                                                            data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                                            <i class="fa fa-graduation-cap" aria-hidden="true"
                                                                style="font-size: 18px;"></i>
                                                            &nbsp; Ver Todos
                                                        </button>
                                                    </a>
                                                </div>
                                            </li>
                                        </ul>
                                    </li>
                                @endforeach

                            </ul>
                        </li>
                        {{-- <li class="sidebar-list" style="padding: 15px 0px;">
                            <a class="sidebar-link sidebar-title" href="{{ route('web_subscriptions') }}">
                                <span>
                                    <i class="fa fa-briefcase" aria-hidden="true" style="font-size: 26px;"></i><br>
                                    Empresas
                                </span>
                            </a>
                        </li> --}}

                        {{-- ENLACE DE BLOG --}}
                        <li class="sidebar-list" style="padding: 15px 0px;">
                            <a class="sidebar-link sidebar-title" href="{{ route('blog_principal') }}">
                                <span>
                                    <svg xmlns="http://www.w3.org/2000/svg" width="26" height="26" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"/><line x1="2" y1="10" x2="22" y2="10"/><line x1="8" y1="4" x2="8" y2="8"/><line x1="12" y1="4" x2="12" y2="8"/><line x1="16" y1="4" x2="16" y2="8"/></svg><br>
                                    Blog
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-list" style="padding: 15px 0px;">
                            <a class="sidebar-link sidebar-title" href="{{ route('web_book_amauta') }}">
                                <span class="sb-item">
                                    <span class="sb-icon-box"><i class="fa fa-book" aria-hidden="true"></i></span>
                                    Publicación
                                </span>
                            </a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <style>
        /* Clase principal para truncar el texto */
        .truncated-link:first-letter {
            display: block;
            max-height: {{ 1.2 * $lines }}em;
            /* Altura de 2 líneas (1.2em * 2) */
            line-height: 1.2em;
            overflow: hidden;
            position: relative;
            text-decoration: none;
            color: inherit;
            /* Agrega la transición a la altura máxima para una animación suave */
            transition: max-height 0.2s ease-in-out;
            text-transform: uppercase;
        }

        /* Pseudo-elemento para los puntos suspensivos */
        .truncated-link::after {
            content: "...";
            position: absolute;
            bottom: 0;
            right: 0;
            padding: 0 5px;
            background: transparent;
            color: inherit;
            transition: opacity 0.2s ease-in-out;
            opacity: 1;
        }

        /* Clase para mostrar el texto completo */
        .truncated-link.show-full {
            max-height: 200px;
            /* Un valor lo suficientemente grande para mostrar todo el texto */
            overflow: visible;
        }

        /* Oculta los puntos suspensivos y les da una transición suave cuando el texto se muestra completo */
        .truncated-link.show-full::after {
            content: none;
            opacity: 0;
        }
        /* =========================================
           ICONOS DEL RAIL (Home / Formación / Publicación)
           ========================================= */
        /* El sitio carga Font Awesome desde varios orígenes (CDN 4.7, app.css del
           tema y el bundle de Vite) y todos declaran la familia "FontAwesome"
           apuntando a archivos distintos. Según cuál gane la cascade, el glifo del
           rail se dibuja con FA4 o con FA6 y cambia de forma/tamaño entre páginas.
           Se fija una familia propia con ruta estable para que las 3 tarjetas del
           rail se vean idénticas en todo el sitio. */
        @font-face {
            font-family: 'CpaRailIcons';
            src: url('{{ asset('themes/personalLanding/assets/font/webfonts/fa-solid-900.woff2') }}') format('woff2'),
                 url('{{ asset('themes/personalLanding/assets/font/webfonts/fa-solid-900.ttf') }}') format('truetype');
            font-style: normal;
            font-weight: 400;
            font-display: block;
        }
        .sidebar-list .sb-icon-box i {
            font-family: 'CpaRailIcons' !important;
            font-weight: 400 !important;
        }
        .sidebar-list > a.sidebar-link { text-decoration: none !important; }
        /* El tema (compact-sidebar) deja el enlace y el span como block: se
           fuerza el bloque (tile + texto) a ocupar todo el ancho del rail. */
        .sidebar-list > a.sidebar-link {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding-left: 0;
            padding-right: 0;
        }
        .sidebar-list .sb-item {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            width: 100%;
            gap: 8px;
            text-align: center;
            font-size: 12.5px;
            font-weight: 600;
            letter-spacing: 0.2px;
            color: rgba(255, 255, 255, 0.78) !important; /* el rail es navy en ambos modos */
            transition: color 0.2s ease;
        }
        .sidebar-list .sb-icon-box {
            /* Con el span en block, sin este margen el tile se pega a la
               izquierda del rail en vez de quedar centrado. */
            margin: 0 auto;
            flex: 0 0 auto;
            width: 48px;
            height: 48px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 14px;
            background: #eef2f9;
            border: 1px solid #e2e8f2;
            color: #002060 !important; /* gana al 'span' blanco del tema (.compact-small) */
            font-size: 20px;
            transition: all 0.2s ease;
        }
        .sidebar-list > a.sidebar-link:hover .sb-item { color: #ffc107 !important; }
        /* El tema fuerza blanco sobre los <i>/<svg> del sidebar: el tile manda */
        .sidebar-wrapper .sidebar-list .sb-icon-box i,
        .sidebar-wrapper .sidebar-list .sb-icon-box svg { color: inherit !important; }
        .sidebar-list > a.sidebar-link:hover .sb-icon-box {
            background: #ffc107;
            border-color: #ffc107;
            color: #002060;
            transform: translateY(-3px);
            box-shadow: 0 8px 18px rgba(255, 193, 7, 0.35);
        }

        /* El rail mantiene su navy en ambos modos: mismo tratamiento */
        body.dark-only .sidebar-list .sb-item { color: rgba(255, 255, 255, 0.78) !important; }
        body.dark-only .sidebar-list .sb-icon-box {
            background: rgba(255, 255, 255, 0.08);
            border-color: rgba(255, 255, 255, 0.15);
            color: #ffc107 !important;
        }
        body.dark-only .sidebar-list > a.sidebar-link:hover .sb-item { color: #ffc107 !important; }
        body.dark-only .sidebar-list > a.sidebar-link:hover .sb-icon-box {
            background: rgba(255, 193, 7, 0.15);
            border-color: rgba(255, 193, 7, 0.45);
            color: #ffc107 !important;
            box-shadow: 0 8px 18px rgba(0, 0, 0, 0.35);
        }
    </style>
    <script>
        document.addEventListener('DOMContentLoaded', () => {
            // Selecciona todos los elementos que tengan la clase 'truncated-link'
            const links = document.querySelectorAll('.truncated-link');

            links.forEach(link => {
                link.addEventListener('mouseenter', () => {
                    // Agrega la clase 'show-full' al pasar el mouse
                    link.classList.add('show-full');
                });

                link.addEventListener('mouseleave', () => {
                    // Elimina la clase 'show-full' al salir el mouse
                    link.classList.remove('show-full');
                });
            });
        });
    </script>
</div>
