<div class="mt-4 grid grid-cols-1 gap-4 sm:grid-cols-2 sm:gap-5 lg:grid-cols-4 lg:gap-6">
    @foreach ($courses as $item )
    <div class="card group p-3">
        <div class="flex items-center justify-between space-x-2 px-1">
            <div class="flex items-center space-x-2">
                <div class="avatar size-9">
                    <img class="rounded-full" src="{{ isset($item->course->teacher->person->image) ? asset('storage/'.$item->course->teacher->person->image) : '' }}" alt="avatar">
                </div>
                <div>
                    <a href="#" class="font-medium text-slate-600 line-clamp-1 dark:text-navy-100">
                        {{ $item->course->teacher->person->names .' ' .$item->course->teacher->person->father_lastname   }}
                    </a>
                    <a href="">
                        <p class="text-xs text-primary dark:text-accent-light">
                            Ver Perfil
                        </p>
                    </a>
                </div>
            </div>
            <a href="">
                <button class="btn size-9 bg-slate-150 p-0 text-slate-800 hover:bg-slate-200 focus:bg-slate-200
                    active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
                    <i class="fa fa-user" aria-hidden="true" style="font-size: 16px;"></i>
                </button>
            </a>
        </div>
        <div class="relative mt-4">
            <img class="rounded-lg object-cover object-center" src="{{ asset('storage/'.$item->course->image) }}" alt="image">
            <div class="absolute top-0 h-full w-full rounded-lg bg-black/20 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
            <div class="absolute top-0 flex h-full w-full items-center justify-center opacity-0 group-hover:opacity-100">
                <a href="{{ route('web_course_description', $item->id) }}">
                    <button class="btn min-w-[7rem] border border-white/10 bg-white/20 text-white backdrop-blur hover:bg-white/30 focus:bg-white/30">
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
            {{-- <p>{{ $item->category_description }}</p> --}}
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
                    <a class="view-pc" onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                        <button class="boton-degradado-courses">
                                <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 18px;"></i>
                                &nbsp; Añadir al Carrito
                        </button>
                    </a>
                    <a class="view-movile" onclick="agregarAlCarrito({ id: {{ $item->id }}, nombre: '{{ $item->name }}', precio: {{ $item->price }} })">
                        <button class="boton-degradado-courses">
                                <i class="fa fa-cart-plus" aria-hidden="true" style="font-size: 18px;"></i>
                                &nbsp; Adquirir
                        </button>
                    </a>
                    {{-- <a href="https://wa.link/54k2g9">
                        <button class="boton-degradado-courses"><b>! Comprar Ahora¡</b></button>
                    </a> --}}
                </div>
            </div>
        </div>
    </div>
    @endforeach

    {{-- <div class="card group p-3">
        <div class="flex items-center justify-between space-x-2 px-1">
        <div class="flex items-center space-x-2">
            <div class="avatar size-9">
            <img class="rounded-full" src="images/avatar/avatar-11.jpg" alt="avatar">
            </div>
            <div>
            <a href="#" class="font-medium text-slate-600 line-clamp-1 dark:text-navy-100">Katrina West</a>
            <p class="text-xs text-primary dark:text-accent-light">
                896 items
            </p>
            </div>
        </div>
        <button x-data="{isLiked:false}" @click="isLiked = !isLiked" class="btn size-9 bg-slate-150 p-0 text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
            <i x-show="!isLiked" class="fa-regular fa-heart text-lg"></i>
            <i x-show="isLiked" class="fa-solid fa-heart text-lg text-error" style="display: none;"></i>
        </button>
        </div>
        <div class="relative mt-4">
        <img class="h-56 w-full rounded-lg object-cover object-center" src="images/object/object-11.jpg" alt="image">
        <div class="absolute top-0 h-full w-full rounded-lg bg-black/20 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
        <div class="absolute top-0 flex h-full w-full items-center justify-center opacity-0 group-hover:opacity-100">
            <button class="btn min-w-[7rem] border border-white/10 bg-white/20 text-white backdrop-blur hover:bg-white/30 focus:bg-white/30">
            Place a Bid
            </button>
        </div>
        </div>
        <div class="mt-3 px-1">
        <a href="#" class="text-base font-medium text-slate-700 line-clamp-1 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
            Punkiber #015
        </a>
        <div class="my-3 h-px bg-slate-200 dark:bg-navy-500"></div>
        <div class="flex justify-between">
            <div>
            <p class="text-xs text-slate-400 dark:text-navy-300">
                Ending in
            </p>
            <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                2h 48m 18s
            </p>
            </div>
            <div class="text-right">
            <p class="text-xs text-slate-400 dark:text-navy-300">
                Highest bid
            </p>
            <p class="text-base font-medium text-primary dark:text-accent-light">
                11.06 ETH
            </p>
            </div>
        </div>
        </div>
    </div>
    <div class="card group p-3">
        <div class="flex items-center justify-between space-x-2 px-1">
        <div class="flex items-center space-x-2">
            <div class="avatar size-9">
            <img class="rounded-full" src="images/avatar/avatar-19.jpg" alt="avatar">
            </div>
            <div>
            <a href="#" class="font-medium text-slate-600 line-clamp-1 dark:text-navy-100">Raul Bradley</a>
            <p class="text-xs text-primary dark:text-accent-light">
                1,643 items
            </p>
            </div>
        </div>
        <button x-data="{isLiked:true}" @click="isLiked = !isLiked" class="btn size-9 bg-slate-150 p-0 text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
            <i x-show="!isLiked" class="fa-regular fa-heart text-lg" style="display: none;"></i>
            <i x-show="isLiked" class="fa-solid fa-heart text-lg text-error"></i>
        </button>
        </div>
        <div class="relative mt-4">
        <img class="h-56 w-full rounded-lg object-cover object-center" src="images/object/object-19.jpg" alt="image">
        <div class="absolute top-0 h-full w-full rounded-lg bg-black/20 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
        <div class="absolute top-0 flex h-full w-full items-center justify-center opacity-0 group-hover:opacity-100">
            <button class="btn min-w-[7rem] border border-white/10 bg-white/20 text-white backdrop-blur hover:bg-white/30 focus:bg-white/30">
            Place a Bid
            </button>
        </div>
        </div>

        <div class="mt-3 px-1">
        <a href="#" class="text-base font-medium text-slate-700 line-clamp-1 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
            Cube Store #015
        </a>
        <div class="my-3 h-px bg-slate-200 dark:bg-navy-500"></div>
        <div class="flex justify-between">
            <div>
            <p class="text-xs text-slate-400 dark:text-navy-300">
                Ending in
            </p>
            <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                1d 6s 16m
            </p>
            </div>
            <div class="text-right">
            <p class="text-xs text-slate-400 dark:text-navy-300">
                Highest bid
            </p>
            <p class="text-base font-medium text-primary dark:text-accent-light">
                7.23 ETH
            </p>
            </div>
        </div>
        </div>
    </div>
    <div class="card group p-3">
        <div class="flex items-center justify-between space-x-2 px-1">
        <div class="flex items-center space-x-2">
            <div class="avatar size-9">
            <img class="rounded-full" src="images/avatar/avatar-18.jpg" alt="avatar">
            </div>
            <div>
            <a href="#" class="font-medium text-slate-600 line-clamp-1 dark:text-navy-100">Henry Curtis</a>
            <p class="text-xs text-primary dark:text-accent-light">
                163 items
            </p>
            </div>
        </div>
        <button x-data="{isLiked:false}" @click="isLiked = !isLiked" class="btn size-9 bg-slate-150 p-0 text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
            <i x-show="!isLiked" class="fa-regular fa-heart text-lg"></i>
            <i x-show="isLiked" class="fa-solid fa-heart text-lg text-error" style="display: none;"></i>
        </button>
        </div>
        <div class="relative mt-4">
        <img class="h-56 w-full rounded-lg object-cover object-center" src="images/object/object-17.jpg" alt="image">
        <div class="absolute top-0 h-full w-full rounded-lg bg-black/20 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
        <div class="absolute top-0 flex h-full w-full items-center justify-center opacity-0 group-hover:opacity-100">
            <button class="btn min-w-[7rem] border border-white/10 bg-white/20 text-white backdrop-blur hover:bg-white/30 focus:bg-white/30">
            Place a Bid
            </button>
        </div>
        </div>

        <div class="mt-3 px-1">
        <a href="#" class="text-base font-medium text-slate-700 line-clamp-1 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
            Abstraktio #699
        </a>
        <div class="my-3 h-px bg-slate-200 dark:bg-navy-500"></div>
        <div class="flex justify-between">
            <div>
            <p class="text-xs text-slate-400 dark:text-navy-300">
                Ending in
            </p>
            <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                2d 4s 52m
            </p>
            </div>
            <div class="text-right">
            <p class="text-xs text-slate-400 dark:text-navy-300">
                Highest bid
            </p>
            <p class="text-base font-medium text-primary dark:text-accent-light">
                3.09 ETH
            </p>
            </div>
        </div>
        </div>
    </div>
    <div class="card group p-3">
        <div class="flex items-center justify-between space-x-2 px-1">
        <div class="flex items-center space-x-2">
            <div class="avatar size-9">
            <img class="rounded-full" src="images/avatar/avatar-5.jpg" alt="avatar">
            </div>
            <div>
            <a href="#" class="font-medium text-slate-600 line-clamp-1 dark:text-navy-100">Lance Tucker
            </a>
            <p class="text-xs text-primary dark:text-accent-light">
                533 items
            </p>
            </div>
        </div>
        <button x-data="{isLiked:true}" @click="isLiked = !isLiked" class="btn size-9 bg-slate-150 p-0 text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
            <i x-show="!isLiked" class="fa-regular fa-heart text-lg" style="display: none;"></i>
            <i x-show="isLiked" class="fa-solid fa-heart text-lg text-error"></i>
        </button>
        </div>
        <div class="relative mt-4">
        <img class="h-56 w-full rounded-lg object-cover object-center" src="images/object/object-13.jpg" alt="image">
        <div class="absolute top-0 h-full w-full rounded-lg bg-black/20 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
        <div class="absolute top-0 flex h-full w-full items-center justify-center opacity-0 group-hover:opacity-100">
            <button class="btn min-w-[7rem] border border-white/10 bg-white/20 text-white backdrop-blur hover:bg-white/30 focus:bg-white/30">
            Place a Bid
            </button>
        </div>
        </div>
        <div class="mt-3 px-1">
        <a href="#" class="text-base font-medium text-slate-700 line-clamp-1 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
            Galaxy #236
        </a>
        <div class="my-3 h-px bg-slate-200 dark:bg-navy-500"></div>
        <div class="flex justify-between">
            <div>
            <p class="text-xs text-slate-400 dark:text-navy-300">
                Ending in
            </p>
            <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                4d 5s 3m
            </p>
            </div>
            <div class="text-right">
            <p class="text-xs text-slate-400 dark:text-navy-300">
                Highest bid
            </p>
            <p class="text-base font-medium text-primary dark:text-accent-light">
                1.49 ETH
            </p>
            </div>
        </div>
        </div>
    </div>
    <div class="card group p-3">
        <div class="flex items-center justify-between space-x-2 px-1">
        <div class="flex items-center space-x-2">
            <div class="avatar size-9">
            <img class="rounded-full" src="images/avatar/avatar-12.jpg" alt="avatar">
            </div>
            <div>
            <a href="#" class="font-medium text-slate-600 line-clamp-1 dark:text-navy-100">Henry Curtis
            </a>
            <p class="text-xs text-primary dark:text-accent-light">
                669 items
            </p>
            </div>
        </div>
        <button x-data="{isLiked:false}" @click="isLiked = !isLiked" class="btn size-9 bg-slate-150 p-0 text-slate-800 hover:bg-slate-200 focus:bg-slate-200 active:bg-slate-200/80 dark:bg-navy-500 dark:text-navy-50 dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90">
            <i x-show="!isLiked" class="fa-regular fa-heart text-lg"></i>
            <i x-show="isLiked" class="fa-solid fa-heart text-lg text-error" style="display: none;"></i>
        </button>
        </div>
        <div class="relative mt-4">
        <img class="h-56 w-full rounded-lg object-cover object-center" src="images/object/object-2.jpg" alt="image">
        <div class="absolute top-0 h-full w-full rounded-lg bg-black/20 opacity-0 transition-opacity duration-300 group-hover:opacity-100"></div>
        <div class="absolute top-0 flex h-full w-full items-center justify-center opacity-0 group-hover:opacity-100">
            <button class="btn min-w-[7rem] border border-white/10 bg-white/20 text-white backdrop-blur hover:bg-white/30 focus:bg-white/30">
            Place a Bid
            </button>
        </div>
        </div>
        <div class="mt-3 px-1">
        <a href="#" class="text-base font-medium text-slate-700 line-clamp-1 hover:text-primary focus:text-primary dark:text-navy-100 dark:hover:text-accent-light dark:focus:text-accent-light">
            Avrang #965
        </a>
        <div class="my-3 h-px bg-slate-200 dark:bg-navy-500"></div>
        <div class="flex justify-between">
            <div>
            <p class="text-xs text-slate-400 dark:text-navy-300">
                Ending in
            </p>
            <p class="text-base font-medium text-slate-700 dark:text-navy-100">
                6d 2s 11m
            </p>
            </div>
            <div class="text-right">
            <p class="text-xs text-slate-400 dark:text-navy-300">
                Highest bid
            </p>
            <p class="text-base font-medium text-primary dark:text-accent-light">
                3.63 ETH
            </p>
            </div>
        </div>
        </div>
    </div> --}}
</div>
