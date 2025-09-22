<br>
<div class="row widget-grid">
    @foreach ($courses->take(9) as $item)
        <div class="col-xl-4 col-md-6 col-sm-12 box-col-4">
            <div class="card weekend-card">
                <div class="card-body">
                    <a href="{{ route('web_course_description', $item->id) }}">
                        <img class="w-100 mb-3" src="{{ asset('storage/' . $item->course->image) }}" alt="">
                    </a>
                    <div class="d-flex align-items-center">
                        <div class="flex-shrink-0">
                            <span>{{ $item->additional }}</span>
                            <a href="{{ route('web_course_description', $item->id) }}">
                                <p>{{ $item->name }}</p>
                            </a>
                        </div>
                    </div>
                    <br>
                    <div class="card">
                        <div class="">
                            <div class="btn-showcase">
                                <a href="{{ route('web_course_description', $item->id) }}">
                                    <button class="btn btn-pill btn-light btn-air-light btn-sm" type="button"
                                        data-bs-original-title="btn btn-pill btn-light btn-air-light btn-sm">
                                        Leer Más
                                    </button>
                                </a>
                                <a onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                                    <button class="btn btn-pill btn-primary btn-air-primary btn-sm" type="button"
                                        data-bs-original-title="btn btn-pill btn-primary btn-air-primary btn-sm">
                                        <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 18px;"></i>
                                        &nbsp; S/ {{ $item->price }}
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div>

{{-- 
<div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-3 lg:gap-6">
    @foreach ($courses->take(12) as $item)
        <div class="card group p-3">
            <div class="flex items-center justify-between space-x-2 px-1">
                <div class="flex items-center space-x-2">
                    <div class="avatar size-9">
                        <img class="rounded-full"
                            src="{{ isset($item->course->teacher->person->image) ? asset('storage/' . $item->course->teacher->person->image) : '' }}"
                            alt="avatar">
                    </div>
                    <div>
                        <a href="#" class="font-medium text-slate-600 line-clamp-1 dark:text-navy-100">
                            {{ $item->course->teacher->person->names . ' ' . $item->course->teacher->person->father_lastname }}
                        </a>
                        <a href="">
                            <p class="text-xs text-primary dark:text-accent-light">
                                Ver Perfil
                            </p>
                        </a>
                    </div>
                </div>
                <a href="">
                    <button
                        class="btn size-9 bg-slate-150 p-0 text-slate-800 hover:bg-slate-200 focus:bg-slate-200
                    active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                        <i class="fa fa-user" aria-hidden="true" style="font-size: 16px;"></i>
                    </button>
                </a>
            </div>
            <div class="relative mt-4">
                <img class="rounded-lg object-cover object-center" src="{{ asset('storage/' . $item->course->image) }}"
                    alt="image">
                <div
                    class="absolute top-0 h-full w-full rounded-lg bg-black/20 opacity-0 transition-opacity duration-300 group-hover:opacity-100">
                </div>
                <div
                    class="absolute top-0 flex h-full w-full items-center justify-center opacity-0 group-hover:opacity-100">
                    <a href="{{ route('web_course_description', $item->id) }}">
                        <button
                            class="btn min-w-[7rem] border border-white/10 bg-white/20 text-white backdrop-blur hover:bg-white/30 focus:bg-white/30">
                            Más Información
                        </button>
                    </a>
                </div>
            </div>
            <div class="mt-3 px-1">
                <p class="text-xs text-primary dark:text-accent-light">
                    {{ $item->additional }}
                </p>
                <a href="{{ route('web_course_description', $item->id) }}"
                    class="text-base font-medium text-slate-700 line-clamp-1 hover:text-primary
                focus:text-primary dark:text-navy-100 dark:hover:text-accent-light
                dark:focus:text-accent-light">
                    {{ $item->name }}
                </a>
                <div class="my-3 h-px bg-slate-200 dark:bg-navy-500"></div>
                <div class="flex justify-between">
                    <div>
                        <a class="view-pc" href="{{ route('web_course_description', $item->id) }}">
                            <button class="boton-degradado-info">
                                <b>Más Información</b>
                            </button>
                        </a>
                        <a class="view-movile" href="{{ route('web_course_description', $item->id) }}">
                            <button class="boton-degradado-info">
                                <b> Leer más </b>
                            </button>
                        </a>
                    </div>
                    <div class="text-right">
                        <a
                            onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                            <button class="boton-degradado-courses">
                                <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 18px;"></i>
                                &nbsp; S/ {{ $item->price }}
                            </button>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</div> --}}
