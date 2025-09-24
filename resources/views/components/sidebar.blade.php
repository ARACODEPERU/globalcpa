<div>
    <div class="sidebar-wrapper" data-layout="stroke-svg">
        <div>
            <div class="logo-wrapper"><a href="{{ route('index_main') }}"><img class="img-fluid"
                        src="{{ asset('themes/webpage/images/Logo_isotipo_negativo.png') }}" alt=""></a>
                <div class="back-btn"><i class="fa fa-angle-left"> </i></div>
            </div>
            <nav class="sidebar-main">
                <div id="sidebar-menu">
                    <ul class="sidebar-links" id="simple-bar">
                        <li class="back-btn"><a href=""></a>
                            <div class="mobile-back text-end"><span>Back</span><i class="fa fa-angle-right ps-2"
                                    aria-hidden="true"></i></div>
                        </li>
                        <li class="sidebar-main-title">
                            <div></div>
                        </li>
                        <li class="sidebar-list" style="padding: 15px 0px;">
                            <a class="sidebar-link sidebar-title" href="{{ route('index_main') }}">
                                <span>
                                    <i class="fa fa-home" aria-hidden="true" style="font-size: 26px;"></i><br>
                                    Home
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-list" style="padding: 15px 0px;">
                            <a class="sidebar-link sidebar-title" href="javascript:void(0)">
                                <span>
                                    <i class="fa fa-graduation-cap" aria-hidden="true" style="font-size: 26px;"></i><br>
                                    Formación
                                </span>
                            </a>
                            <ul class="sidebar-submenu custom-scrollbar">
                                <li class="sidebar-head">Formación</li>
                                @foreach ($types as $type)
                                    <li class="main-submenu">
                                        <a class="d-flex sidebar-menu" href="javascript:void(0)">
                                            <svg class="stroke-icon">
                                                <use href="themes/webpage/assets/svg/icon-sprite.svg#stroke-others">
                                                </use>
                                            </svg>
                                            <svg class="fill-icon">
                                                <use href="themes/webpage/assets/svg/icon-sprite.svg#stroke-others">
                                                </use>
                                            </svg>{{ $type=="Programas de Especialización"? 'Especialización' : $type }}
                                            <svg class="arrow">
                                                <use href="themes/webpage/assets/svg/icon-sprite.svg#Arrow-right">
                                                </use>
                                            </svg>
                                        </a>
                                        <ul class="submenu-wrapper">
                                            @php
                                                $x=0;
                                            @endphp
                                            @foreach ($courses as $course)
                                            @if ((strtolower($course->additional) == strtolower($type)) && $x<$p)
                                            <li><a class="truncated-link" href="{{ route('web_course_description', $course->id) }}" title="{{ $course->name }}">{{$course->name}}</a></li>
                                                @php
                                                    $x++;
                                                @endphp
                                                @endif
                                            @endforeach
                                            <li>
                                                <div class="btn-showcase" style="text-align: center;">
                                                    <a href=" ">
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
                        <li class="sidebar-list" style="padding: 15px 0px;">
                            <a class="sidebar-link sidebar-title" href="">
                                <span>
                                    <i class="fa fa-briefcase" aria-hidden="true" style="font-size: 26px;"></i><br>
                                    Empresas
                                </span>
                            </a>
                        </li>
                        <li class="sidebar-list" style="padding: 15px 0px;">
                            <a class="sidebar-link sidebar-title" href="">
                                <span>
                                    <i class="fa fa-book" aria-hidden="true" style="font-size: 26px;"></i><br>
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
        .truncated-link {
            display: block;
            max-height: {{ 1.2*$lines }}em; /* Altura de 2 líneas (1.2em * 2) */
            line-height: 1.2em;
            overflow: hidden;
            position: relative;
            text-decoration: none;
            color: inherit;
            /* Agrega la transición a la altura máxima para una animación suave */
            transition: max-height 0.2s ease-in-out;
        }

        /* Pseudo-elemento para los puntos suspensivos */
        .truncated-link::after {
            content: "...";
            position: absolute;
            bottom: 0;
            right: 0;
            padding: 0 5px;
            background: white; /* Ajusta este color al fondo de tu sitio */
            /* Agrega la transición para que los puntos suspensivos desaparezcan suavemente */
            transition: opacity 0.2s ease-in-out;
            opacity: 1; /* Por defecto, los puntos suspensivos son visibles */
        }

        /* Clase para mostrar el texto completo */
        .truncated-link.show-full {
            max-height: 200px; /* Un valor lo suficientemente grande para mostrar todo el texto */
            overflow: visible;
        }

        /* Oculta los puntos suspensivos y les da una transición suave cuando el texto se muestra completo */
        .truncated-link.show-full::after {
            content: none;
            opacity: 0;
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
