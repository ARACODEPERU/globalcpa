@extends('layouts.webpage')

@section('content')
    <x-nav />
    <x-slidebar />

    <main class="main-content w-full px-[var(--margin-x)] pb-8">
        <div class="thanks-wrap">
            <div class="card p-5 thanks-card">
                <h1 class="thanks-title"><b>Felicidades {{ $sale->clie_full_name }}!</b></h1>
                <p class="mt-2">
                    Bienvenido a <b>CPA Academy</b>. Has invertido en tu futuro profesional, y estamos felices de acompanarte.
                </p>
                <p class="mt-2">
                    Tus accesos al campus virtual han sido enviados a <b>{{ $sale->email }}</b>.
                    Revisa tu bandeja de entrada y, si no los ves, busca en correos no deseados.
                </p>
                <p class="mt-2">
                    Si necesitas ayuda, nuestro equipo esta aqui para apoyarte.
                </p>
                <p class="mt-2">
                    Nos vemos en el campus.
                </p>

                <div class="is-scrollbar-hidden min-w-full overflow-x-auto mt-4">
                    <table class="is-hoverable w-full text-left">
                        <thead>
                            <tr>
                                <th class="whitespace-nowrap rounded-tl-lg bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                    Producto
                                </th>
                                <th class="whitespace-nowrap bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 dark:bg-navy-800 dark:text-navy-100 lg:px-5">
                                    Precio
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($courses as $course)
                                <tr class="border-y border-transparent border-b-slate-200 dark:border-b-navy-500">
                                    <td class="thanks-product-cell px-4 py-3 sm:px-5">
                                        <div class="flex items-center space-x-4">
                                            <div class="avatar">
                                                <img
                                                    class="rounded-full"
                                                    src="{{ $course->image ?: asset('themes/webpage/images/object/object-15.jpg') }}"
                                                    alt="curso"
                                                />
                                            </div>

                                            <span class="thanks-product-name font-medium text-slate-700 dark:text-navy-100">
                                                {{ $course->name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 dark:text-navy-100 sm:px-5">
                                        S/ {{ number_format((float) $course->price, 2) }}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="thanks-total">
                    <span>TOTAL:</span>
                    <strong id="totalid">S/ {{ number_format($total ?? $sale->total, 2) }}</strong>
                </div>

                <div class="mt-4 mb-4">
                    <a href="{{ route('login') }}">
                        <button class="boton-degradado-campus">Campus Virtual</button>
                    </a>
                </div>
            </div>
        </div>
    </main>

    <div id="whatsapp">
        <a href="https://wa.link/4bu45u" class="wtsapp" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fa fa-whatsapp" aria-hidden="true"></i>
        </a>
    </div>

    <style type="text/css">
        .thanks-wrap {
            max-width: 920px;
            margin: 32px auto 0;
        }

        .thanks-product-cell {
            min-width: 360px;
            max-width: 580px;
        }

        .thanks-product-cell .avatar {
            flex: 0 0 auto;
        }

        .thanks-product-name {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            -webkit-line-clamp: 3;
            line-clamp: 3;
            overflow: hidden;
            white-space: normal;
            line-height: 1.35;
        }

        .thanks-card {
            border: 1px solid #dce5ef;
            border-radius: 8px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        .thanks-title {
            font-size: 20px;
            color: #0f172a;
        }

        .thanks-total {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 16px;
            margin-top: 12px;
            padding: 12px 18px;
            background: #0f766e;
            color: #fff;
            font-weight: 700;
            border-radius: 8px;
        }

        #whatsapp .wtsapp {
            position: fixed;
            transform: all .5s ease;
            background-color: #25D366;
            display: block;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            border-radius: 50px;
            border-right: none;
            color: #fff;
            font-weight: 700;
            font-size: 30px;
            bottom: 40px;
            right: 20px;
            border: 0;
            z-index: 9999;
            width: 50px;
            height: 50px;
            line-height: 50px;
        }

        #whatsapp .wtsapp:before {
            content: "";
            position: absolute;
            z-index: -1;
            left: 50%;
            top: 50%;
            transform: translateX(-50%) translateY(-50%);
            display: block;
            width: 60px;
            height: 60px;
            background-color: #25D366;
            border-radius: 50%;
            -webkit-animation: pulse-border 1500ms ease-out infinite;
            animation: pulse-border 1500ms ease-out infinite;
        }

        #whatsapp .wtsapp:focus {
            border: none;
            outline: none;
        }

        @keyframes pulse-border {
            0% {
                transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1);
                opacity: 1;
            }
            100% {
                transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1.5);
                opacity: 0;
            }
        }
    </style>
@stop
