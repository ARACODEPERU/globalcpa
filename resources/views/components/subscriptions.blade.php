<div>

    <br>
    <div class="mt-4 px-[var(--margin-x)] transition-all duration-[.25s] sm:mt-5 lg:mt-6">
        <div style="text-align:center;">
            <h1 class="title_aracode" style="font-size: 45px; line-height: 1.1; font-weight: 700;">
                NUESTRAS SUSCRIPCIONES
            </h1>
        </div>
        <br>
        <div x-data="{ activeTab: 'tabMensual' }" class="tabs flex flex-col">
            <div
                class="is-scrollbar-hidden overflow-x-auto rounded-lg bg-slate-200 text-slate-600 dark:bg-navy-800 dark:text-navy-200">
                <div class="tabs-list flex px-1.5 py-1">
                    <button @click="activeTab = 'tabMensual'"
                        :class="activeTab === 'tabMensual' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' :
                            'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                        class="btn shrink-0 px-3 py-1.5 font-medium">
                        Mensual
                    </button>
                    <button @click="activeTab = 'tabAnual'"
                        :class="activeTab === 'tabAnual' ? 'bg-white shadow dark:bg-navy-500 dark:text-navy-100' :
                            'hover:text-slate-800 focus:text-slate-800 dark:hover:text-navy-100 dark:focus:text-navy-100'"
                        class="btn shrink-0 px-3 py-1.5 font-medium">
                        Anual
                    </button>
                </div>
            </div>

            <div class="container">
                <br>
                <div class="row" x-show="activeTab === 'tabMensual'"
                    x-transition:enter="transition-all duration-500 easy-in-out"
                    x-transition:enter-start="opacity-0 [transform:translate3d(1rem,0,0)]"
                    x-transition:enter-end="opacity-100 [transform:translate3d(0,0,0)]">
                    @foreach ($subscriptions as $subscription)
                        @if ($subscription->period == 'Mensual')
                            @php
                                // Decodificar el JSON a un array de PHP
                                $prices = json_decode($subscription->prices, true);
                                $details = json_decode($subscription->details, true);
                            @endphp
                            <div class="col-md-4">
                                <div class="card" style="width: 90%; padding: 10px 15px;">
                                    <div class="card-body">
                                        <h3 class="title_aracode"
                                            style="font-size: 25px; line-height: 1.1; font-weight: 700; padding: 10px;">
                                            {{ $subscription->title }}
                                        </h3>
                                        <h4 style="text-align: center; font-weight: 500;">
                                            {{ $subscription->description }}<br>
                                            <b>{{ $subscription->period }}</b>
                                        </h4>
                                        <br>
                                        <ul style="height: auto;">
                                            @foreach ($details as $detail)
                                                <li style="padding: 3px 0px;">
                                                    <i class="fa fa-circle" style="font-size: 12px;"></i>
                                                    &nbsp;{{ $detail['label'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        <br>
                                        <h2 style="text-align: center;">
                                            <b  class="title_aracode"
                                            style="font-size: 35px; line-height: 1.1; font-weight: 700; padding: 10px;">
                                            S/ {{ $prices[0]['amount'] }}
                                            </b> 
                                            / {{ $prices[0]['detail'] }}
                                        </h2>
                                        {{-- <p style="text-align: center;">ó</p>
                                        <h2 class="dolartitle_aracode"
                                            style="font-size: 25px; line-height: 1.1; font-weight: 500; padding: 10px;">
                                            $ {{ $prices[1]['amount'] }}
                                        </h2> --}}
                                        <br>
                                        <a href="{{ route('academic_step_account', $subscription->id) }}">
                                            <button class="boton-degradado-courses">
                                                <b style="font-size: 18px;">
                                                    <i class="fa fa-edit" aria-hidden="true"
                                                        style="font-size: 20px;"></i>
                                                    &nbsp; Suscribirme
                                                </b>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
                <br>
                <div class="row" x-show="activeTab === 'tabAnual'">
                    @foreach ($subscriptions as $subscription)
                        @if ($subscription->period == 'Anual')
                            @php
                                // Decodificar el JSON a un array de PHP
                                $prices = json_decode($subscription->prices, true);
                                $details = json_decode($subscription->details, true);
                            @endphp
                            <div class="col-md-4">
                                <div class="card" style="width: 90%; padding: 10px 15px;">
                                    <div class="card-body">
                                        <h3 class="title_aracode"
                                            style="font-size: 25px; line-height: 1.1; font-weight: 700; padding: 10px;">
                                            {{ $subscription->title }}
                                        </h3>
                                        <h4 style="text-align: center; font-weight: 500;">
                                            {{ $subscription->description }}<br>
                                            <b>{{ $subscription->period }}</b>
                                        </h4>
                                        <br>
                                        <ul style="height: auto;">
                                            @foreach ($details as $detail)
                                                <li style="padding: 3px 0px;">
                                                    <i class="fa fa-circle" style="font-size: 12px;"></i>
                                                    &nbsp;{{ $detail['label'] }}
                                                </li>
                                            @endforeach
                                        </ul>
                                        <br>
                                        <h2 style="text-align: center;">
                                            <b  class="title_aracode"
                                            style="font-size: 35px; line-height: 1.1; font-weight: 700; padding: 10px;">
                                            S/ {{ $prices[0]['amount'] }}
                                            </b> 
                                            / {{ $prices[0]['detail'] }}
                                        </h2>
                                        {{-- <p style="text-align: center;">ó</p>
                                        <h2 class="dolartitle_aracode"
                                            style="font-size: 25px; line-height: 1.1; font-weight: 500; padding: 10px;">
                                            $ {{ $prices[1]['amount'] }}
                                        </h2> --}}
                                        <br>
                                        <a href="{{ route('academic_step_account', $subscription->id) }}">
                                            <button class="boton-degradado-courses">
                                                <b style="font-size: 18px;">
                                                    <i class="fa fa-edit" aria-hidden="true"
                                                        style="font-size: 20px;"></i>
                                                    &nbsp; Suscribirme
                                                </b>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

            <br>
            <br>
        </div>
    </div>
</div>
