<div class="sidebar print:hidden">
    <div class="main-sidebar">
        <div
            class="flex h-full w-full flex-col items-center border-r border-slate-150 bg-white dark:border-navy-700 dark:bg-navy-800">
            <div class="flex pt-4">
                <a href="/">
                    <img x-show="!$store.global.isDarkModeEnabled"
                        class="size-11 transition-transform duration-500 ease-in-out hover:rotate-[360deg]"
                        {{-- src="themes/webpage/images/app-logo.svg" --}} src="{{ asset('storage/' . $logo[3]->content) }}" alt="Logo" />
                    <img x-show="$store.global.isDarkModeEnabled"
                        class="size-11 transition-transform duration-500 ease-in-out hover:rotate-[360deg]"
                        {{-- src="themes/webpage/images/app-logo.svg" --}} src="{{ asset('storage/' . $logo[4]->content) }}" alt="Logo" />
                </a>
            </div>

            <!-- Main Sections Links -->
            <div class="is-scrollbar-hidden flex grow flex-col space-y-4 overflow-y-auto pt-6">
                <a href="{{ route('index_main') }}" style="text-decoration: none;"
                    class="flex size-11 items-center justify-center rounded-lg outline-none transition-colors duration-200
                    hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 {{ Request::routeIs('index_main')? 'bg-primary/10 dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 
                    dark:focus:bg-navy-450 dark:active:bg-navy-450/90' : 'dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25' }}"
                    x-tooltip.placement.right="'Home'">
                    <i class="fa fa-home" aria-hidden="true" style="font-size: 26px;"></i>
                </a>
                <a href="{{ route('web_courses') }}"
                    class="flex size-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 
                    hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 {{ Request::routeIs('web_courses')? 'bg-primary/10 text-primary dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90' : 'dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25' }}"
                    x-tooltip.placement.right="'Formación'">
                    <i class="fa fa-graduation-cap" aria-hidden="true" style="font-size: 26px;"></i>
                </a>
                <a href="{{ route('web_subscriptions') }}"
                    class="flex size-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 
                    hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 {{ Request::routeIs('web_subscriptions')? 'bg-primary/10 text-primary dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90' : 'dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25' }}"
                    x-tooltip.placement.right="'Para Empresas'">
                    <i class="fa fa-briefcase" aria-hidden="true" style="font-size: 26px;"></i>
                </a>
                <a href="{{ route('web_book_amauta') }}"
                    class="flex size-11 items-center justify-center rounded-lg outline-none transition-colors duration-200 
                    hover:bg-primary/20 focus:bg-primary/20 active:bg-primary/25 {{ Request::routeIs('web_book_amauta')? 'bg-primary/10 text-primary dark:bg-navy-600 dark:text-accent-light dark:hover:bg-navy-450 dark:focus:bg-navy-450 dark:active:bg-navy-450/90' : 'dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25' }}"
                    x-tooltip.placement.right="'Publicaciones'">
                    <i class="fa fa-book" aria-hidden="true" style="font-size: 26px;"></i>
                </a>
            </div>

            <!-- Bottom Links -->
            <div class="flex flex-col items-center space-y-3 py-3">
            </div>
        </div>
    </div>

    <div class="sidebar-panel">
        <div class="flex h-full grow flex-col bg-white pl-[var(--main-sidebar-width)] dark:bg-navy-750">
            <div class="flex h-18 w-full items-center justify-between pl-4 pr-1">
                <p class="text-base tracking-wider text-slate-800 dark:text-navy-100">
                    Global CPA - Business School
                </p>
                <button @click="$store.global.isSidebarExpanded = false"
                    class="btn size-7 rounded-full p-0 text-primary hover:bg-slate-300/20 focus:bg-slate-300/20 active:bg-slate-300/25 dark:text-accent-light/80 dark:hover:bg-navy-300/20 dark:focus:bg-navy-300/20 dark:active:bg-navy-300/25 xl:hidden">
                    <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24"
                        stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
                    </svg>
                </button>
            </div>

            <div x-data="{ expandedItem: null }" class="h-[calc(100%-4.5rem)] overflow-x-hidden pb-6" x-init="$el._x_simplebar = new SimpleBar($el);">
                <ul class="flex flex-1 flex-col px-4 font-inter">
                    <li>
                        <a x-data="navLink" href="{{ route('index_main') }}"
                            :class="isActive ? 'font-medium text-primary dark:text-accent-light' :
                                'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                            class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                            Home
                        </a>
                    </li>
                    <li>
                        <a x-data="navLink" href="#dashboards"
                            :class="isActive ? 'font-medium text-primary dark:text-accent-light' :
                                'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                            class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                            Nosotros
                        </a>
                    </li>
                    <li>
                        <a x-data="navLink" href="#dashboards"
                            :class="isActive ? 'font-medium text-primary dark:text-accent-light' :
                                'text-slate-600 hover:text-slate-900 dark:text-navy-200 dark:hover:text-navy-50'"
                            class="flex py-2 text-xs+ tracking-wide outline-none transition-colors duration-300 ease-in-out">
                            Contactanos
                        </a>
                    </li>
                </ul>
                <div class="my-3 mx-4 h-px bg-slate-200 dark:bg-navy-500"></div>
                <ul class="flex flex-1 flex-col px-4 font-inter">
                    <li x-data="accordionItem('menu-item-1')">
                        <a :class="expanded ? 'text-slate-800 font-semibold dark:text-navy-50' :
                            'text-slate-600 dark:text-navy-200  hover:text-slate-800  dark:hover:text-navy-50'"
                            @click="expanded = !expanded"
                            class="flex items-center justify-between py-2 text-xs+ tracking-wide outline-none transition-[color,padding-left] duration-300 ease-in-out"
                            href="javascript:void(0);">
                            <span>Formación Académica</span>
                            <svg :class="expanded && 'rotate-90'" xmlns="http://www.w3.org/2000/svg"
                                class="size-4 text-slate-400 transition-transform ease-in-out" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7" />
                            </svg>
                        </a>
                        <ul x-collapse x-show="expanded">
                            @foreach ($courses as $item)
                                <li>
                                    <a x-data="navLink" href="{{ route('web_course_description', $item->id) }}"
                                        class="flex items-center justify-between p-1 text-xs+ tracking-wide transition-[color,padding-left] duration-300 ease-in-out hover:pl-4">
                                        <div class="flex items-center space-x-2">
                                            <div class="size-0.5 opacity-60"</div>
                                                <span>{{ $item->name }}</span>
                                            </div>
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    </li>
                </ul>
                <div class="my-3 mx-4 h-px bg-slate-200 dark:bg-navy-500"></div>
            </div>
        </div>
    </div>
</div>
