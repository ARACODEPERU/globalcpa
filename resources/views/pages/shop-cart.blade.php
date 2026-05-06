@extends('layouts.webpage')

@section('content')
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <div class="page-wrapper" id="pageWrapper">
        <x-header />
        <div class="page-body-wrapper">
            <x-sidebar />

            <div class="page-body" style="padding: 80px 0;">
                <div class="container-fluid">
                    <div class="card p-4 mb-4">
                        <div class="checkout-steps">
                            <button class="checkout-step active" data-step-label="payment">
                                <span class="checkout-step-number">1</span>
                                <span class="checkout-step-text" id="payment-step-text">Carrito y pago</span>
                            </button>
                            <button class="checkout-step" data-step-label="final">
                                <span class="checkout-step-number">2</span>
                                <span class="checkout-step-text">Cuenta y comprobante</span>
                            </button>
                        </div>
                    </div>

                    <div id="checkout-alert" class="alert alert-danger d-none"></div>

                    <section id="step-payment" class="checkout-panel">
                        <div class="checkout-wide">
                            <div class="security-check-grid">
                                <div class="security-check-card security-check-card-static">
                                    <img class="security-check-logo-wide" src="{{ asset('img/mercadopago.png') }}" alt="Mercado Pago">
                                    <span>
                                        <strong>Mercado Pago</strong>
                                        <small>Pago seguro</small>
                                    </span>
                                </div>
                                <div class="security-check-card security-check-card-static">
                                    <span class="security-check-icon-svg" aria-hidden="true">
                                        <svg viewBox="0 0 64 64" role="img" focusable="false">
                                            <path d="M32 6 52 14v15c0 13.2-7.8 24.8-20 29.4C19.8 53.8 12 42.2 12 29V14L32 6Z" fill="#dc2626"/>
                                            <path d="M27.6 38.6 19.8 30.8l4.2-4.2 3.6 3.6L40 17.8l4.2 4.2-16.6 16.6Z" fill="#fff"/>
                                        </svg>
                                    </span>
                                    <span>
                                        <strong>Pago 100% seguro</strong>
                                        <small>Procesamos tu pago con los mas altos estandares de seguridad.</small>
                                    </span>
                                </div>
                                <div class="security-check-card security-check-card-static">
                                    <span class="security-check-icon-svg" aria-hidden="true">
                                        <svg viewBox="0 0 64 64" role="img" focusable="false">
                                            <circle cx="32" cy="32" r="26" fill="#dc2626"/>
                                            <path d="M30 15h5v18H21l18 16-4 4-25-22h20V15Z" fill="#fff" transform="rotate(180 32 34)"/>
                                        </svg>
                                    </span>
                                    <span>
                                        <strong>Acceso Inmediato</strong>
                                        <small>Apenas se confirme tu pago, recibir&aacute;s tu accesos al campus virtual.</small>
                                    </span>
                                </div>
                                <div class="security-check-card security-check-card-static">
                                    <span class="security-check-icon-svg" aria-hidden="true">
                                        <svg viewBox="0 0 64 64" role="img" focusable="false">
                                            <path d="M18 8h28a4 4 0 0 1 4 4v40a4 4 0 0 1-4 4H18a4 4 0 0 1-4-4V12a4 4 0 0 1 4-4Z" fill="#dc2626"/>
                                            <path d="M22 20h20v4H22v-4Zm0 10h20v4H22v-4Zm0 10h12v4H22v-4Z" fill="#fff"/>
                                            <circle cx="43" cy="43" r="9" fill="#fff"/>
                                            <path d="m39 43 3 3 6-7" fill="none" stroke="#dc2626" stroke-width="3" stroke-linecap="round" stroke-linejoin="round"/>
                                        </svg>
                                    </span>
                                    <span>
                                        <strong>Certificaci&oacute;n incluida</strong>
                                        <small>Al finalizar, obten tu certificado digital de Cpa Academy.</small>
                                    </span>
                                </div>
                                <div class="security-check-card security-check-card-static">
                                    <span class="security-check-icon-svg" aria-hidden="true">
                                        <svg viewBox="0 0 64 64" role="img" focusable="false">
                                            <circle cx="32" cy="32" r="26" fill="#dc2626"/>
                                            <path d="M20 33a12 12 0 0 1 24 0v8h-5v-8a7 7 0 0 0-14 0v8h-5v-8Z" fill="#fff"/>
                                            <path d="M17 36h8v10h-4a4 4 0 0 1-4-4v-6Zm22 0h8v6a4 4 0 0 1-4 4h-4V36Z" fill="#fff"/>
                                            <path d="M36 48h-7a3 3 0 0 1 0-6h7a3 3 0 0 1 0 6Z" fill="#fff"/>
                                        </svg>
                                    </span>
                                    <span>
                                        <strong>Soporte especializado</strong>
                                        <small>Te acompa&ntilde;amos durante toda tu formaci&oacute;n.</small>
                                    </span>
                                </div>
                            </div>

                            <div class="row g-4 align-items-start">
                            <div class="col-xl-7 col-lg-6">
                                <div class="card">
                                    <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                                        <table class="is-hoverable w-full text-left">
                                            <thead>
                                                <tr>
                                                    <th class="cart-product-column bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 lg:px-5">Producto</th>
                                                    <th class="cart-type-column bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 lg:px-5">Tipo</th>
                                                    <th class="cart-price-column bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 lg:px-5">Precio</th>
                                                    <th class="cart-action-column bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 lg:px-5">Accion</th>
                                                </tr>
                                            </thead>
                                            <tbody id="cart">
                                                <tr>
                                                    <td colspan="4" class="px-4 py-5 text-center">Cargando carrito...</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-5 col-lg-6">
                                <div class="card p-4 checkout-payment-card">
                                    <h2 class="font-medium tracking-wide text-slate-700 mb-2" id="payment-card-title">Pago con tarjeta</h2>
                                    <div id="payment-products" class="checkout-products-list"></div>
                                    <hr>
                                    <div class="checkout-total-row d-flex justify-content-between align-items-center mb-4">
                                        <span>Total</span>
                                        <strong id="totalid">S/ 0.00</strong>
                                    </div>
                                    <div class="mercadopago-shell">
                                        <div id="cardPaymentBrick_container"></div>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </div>
                    </section>

                    <section id="step-final" class="checkout-panel d-none">
                        <div class="account-shell">
                            <div class="account-header">
                                <h2 id="account-title">Crea tu cuenta en menos de 30 segundos</h2>
                                <p id="account-subtitle">Completa tus datos para asociar la compra y emitir el comprobante.</p>
                            </div>

                            <div class="account-choice-grid">
                                <button type="button" class="account-tab active" data-account-mode="create">
                                    <span class="account-choice-icon">+</span>
                                    <span>
                                        <strong>Crear cuenta</strong>
                                        <small>Con los datos del pago</small>
                                    </span>
                                </button>
                                <button type="button" class="account-tab" data-account-mode="login">
                                    <span class="account-choice-icon">-&gt;</span>
                                    <span>
                                        <strong>Iniciar sesion</strong>
                                        <small>Usar una cuenta existente</small>
                                    </span>
                                </button>
                            </div>

                            <input type="hidden" id="account_mode" value="create">
                            <input type="hidden" id="invoice_type" value="boleta">

                            <div id="create-account-panel" class="account-form-grid">
                                <div class="checkout-field">
                                    <label>DNI</label>
                                    <input id="create_dni" type="text" placeholder="Numero de documento">
                                </div>
                                <div class="checkout-field">
                                    <label>Email</label>
                                    <input id="create_email" type="email" placeholder="correo@dominio.com">
                                </div>
                                <div class="checkout-field">
                                    <label>Nombres</label>
                                    <input id="create_names" type="text" placeholder="Nombres completos">
                                </div>
                                <div class="checkout-field">
                                    <label>Contraseña</label>
                                    <input id="create_password" type="password" placeholder="Opcional, por defecto tu DNI">
                                </div>
                            </div>

                            <div id="login-account-panel" class="account-form-grid compact d-none">
                                <div class="checkout-field">
                                    <label>Email</label>
                                    <input id="login_email" type="email" placeholder="correo@dominio.com">
                                </div>
                                <div class="checkout-field">
                                    <label>Contraseña</label>
                                    <input id="login_password" type="password" placeholder="Tu contraseña">
                                </div>
                                <div class="mt-2 text-center">
                                    <a href="#" onclick="showPasswordRecovery(); return false;" class="text-sm text-blue-600 hover:underline">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                </div>
                            </div>

                            <div class="invoice-block" id="invoice-block">
                                <h3>Datos de comprobante</h3>
                                <div class="flex border-b mb-4">
                                    <button type="button" class="invoice-tab active" data-invoice-type="boleta">Boleta</button>
                                    <button type="button" class="invoice-tab" data-invoice-type="factura">Factura</button>
                                </div>

                                <div id="boleta-panel" class="invoice-form-grid">
                                    <div class="checkout-field">
                                        <label>Nombre completo</label>
                                        <input id="invoice_name" type="text" placeholder="Nombre completo">
                                    </div>
                                    <div class="checkout-field">
                                        <label>DNI</label>
                                        <input id="invoice_dni" type="text" placeholder="Numero de documento">
                                    </div>
                                    <div class="checkout-field">
                                        <label>Email</label>
                                        <input id="invoice_email" type="email" placeholder="correo@dominio.com">
                                    </div>
                                </div>

                                <div id="factura-panel" class="invoice-form-grid d-none">
                                    <div class="checkout-field">
                                        <label>RUC</label>
                                        <input id="invoice_ruc" type="text" placeholder="Numero de RUC">
                                    </div>
                                    <div class="checkout-field">
                                        <label>Razon social</label>
                                        <input id="invoice_business_name" type="text" placeholder="Razon social">
                                    </div>
                                    <div class="checkout-field">
                                        <label>Direccion</label>
                                        <input id="invoice_address" type="text" placeholder="Direccion fiscal">
                                    </div>
                                </div>
                            </div>

                             <div class="invoice-actions">
                                 <button type="button" id="btn-finalize" class="boton-degradado-courses">
                                     <b id="btn-finalize-text">FINALIZAR COMPRA</b>
                                 </button>
                             </div>
                         </div>
                     </section>

                     <!-- Password Recovery Modal -->
                     <div id="password-recovery-modal" class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
                         <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full">
                             <h3 class="text-lg font-medium mb-4">Recuperar Contraseña</h3>
                             <input type="email" id="recovery-email" placeholder="Tu correo electrónico" class="w-full border rounded p-2 mb-4">
                             <div class="flex gap-2">
                                 <button onclick="sendPasswordRecovery()" class="btn boton-degradado-courses">Enviar</button>
                                 <button onclick="hidePasswordRecovery()" class="btn btn-secondary">Cancelar</button>
                             </div>
                             <div id="recovery-message" class="mt-2 text-sm"></div>
                         </div>
                     </div>
                </div>
            </div>
        </div>
        <x-footer />
    </div>

    <style>
        .checkout-steps {
            position: relative;
            display: flex;
            justify-content: space-between;
            gap: 96px;
            max-width: 560px;
            margin: 0 auto;
        }

        .checkout-steps::before {
            content: "";
            position: absolute;
            top: 23px;
            left: 72px;
            right: 72px;
            height: 2px;
            background: #cbd5e1;
        }

        .checkout-step {
            position: relative;
            z-index: 1;
            display: inline-flex;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            width: 132px;
            border: 0;
            background: transparent;
            color: #475569;
            padding: 0;
            font-weight: 700;
            text-align: center;
        }

        .checkout-step-number {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #dc2626;
            border: 3px solid #fff;
            color: #fff;
            box-shadow: 0 0 0 2px #dc2626, 0 8px 18px rgba(220, 38, 38, 0.24);
            font-size: 18px;
            line-height: 1;
        }

        .checkout-step-text {
            color: #334155;
            font-size: 13px;
            line-height: 1.25;
        }

        .invoice-tab {
            border: 1px solid #d6dee9;
            background: #fff;
            color: #334155;
            padding: 10px 14px;
            font-weight: 600;
        }

        .invoice-tab.active {
            background: #0f766e;
            border-color: #0f766e;
            color: #fff;
        }

        .checkout-step.active .checkout-step-number,
        .checkout-step.done {
            color: #fff;
        }

        .checkout-step.active .checkout-step-text,
        .checkout-step.done .checkout-step-text {
            color: #dc2626;
        }

        .checkout-wide {
            max-width: 1280px;
            margin: 0 auto;
        }

        .security-check-grid {
            display: flex;
            justify-content: flex-end;
            gap: 12px;
            margin-bottom: 18px;
        }

        .security-check-card {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            max-width: 360px;
            min-height: 82px;
            padding: 16px;
            background: #fff;
            border: 1px solid #dce5ef;
            border-radius: 8px;
            color: #334155;
            text-decoration: none;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.06);
            transition: transform .2s ease, border-color .2s ease, box-shadow .2s ease;
        }

        .security-check-card:hover {
            color: #0f766e;
            border-color: #0f766e;
            text-decoration: none;
            transform: translateY(-2px);
            box-shadow: 0 14px 30px rgba(15, 23, 42, 0.1);
        }

        .security-check-card-static:hover {
            color: #334155;
            border-color: #dce5ef;
            transform: none;
        }

        .security-check-card img {
            width: 38px;
            height: 38px;
            object-fit: contain;
            flex: 0 0 auto;
        }

        .security-check-card img.security-check-logo-wide {
            width: 132px;
            height: 64px;
        }

        .security-check-icon-svg {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 64px;
            height: 64px;
            flex: 0 0 auto;
        }

        .security-check-icon-svg svg {
            width: 64px;
            height: 64px;
            display: block;
        }

        .security-check-card strong,
        .security-check-card small {
            display: block;
        }

        .security-check-card strong {
            color: #0f172a;
            font-size: 15px;
            font-weight: 700;
        }

        .security-check-card small {
            margin-top: 3px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.35;
        }

        #step-payment .card:first-child {
            overflow: hidden;
        }

        #cart .avatar {
            flex: 0 0 auto;
        }

        .cart-product-column {
            width: 48%;
            min-width: 320px;
        }

        .cart-type-column {
            width: 24%;
            min-width: 170px;
        }

        .cart-price-column {
            width: 16%;
            min-width: 110px;
            white-space: nowrap;
        }

        .cart-action-column {
            width: 12%;
            min-width: 88px;
            white-space: nowrap;
        }

        .boton-degradado-trash {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 36px;
            height: 36px;
            padding: 0;
            line-height: 1;
            text-align: center;
        }

        .boton-degradado-trash i {
            display: block;
            margin: 0;
            line-height: 1;
        }

        .cart-product-name,
        .cart-type-text {
            display: -webkit-box;
            -webkit-box-orient: vertical;
            overflow: hidden;
            white-space: normal;
            line-height: 1.35;
        }

        .cart-product-name {
            -webkit-line-clamp: 3;
            line-clamp: 3;
            max-width: 100%;
        }

        .cart-type-text {
            -webkit-line-clamp: 3;
            line-clamp: 3;
        }

        .checkout-payment-card {
            position: sticky;
            top: 96px;
        }

        .mercadopago-shell {
            max-width: 480px;
            margin: 0 auto;
        }

        .checkout-products-list {
            max-height: 180px;
            overflow: auto;
        }

        .checkout-total-row {
            padding: 14px 0 2px;
            color: #0f172a;
            font-size: 18px;
            font-weight: 800;
        }

        .checkout-total-row strong {
            color: #dc2626;
            font-size: 24px;
            font-weight: 900;
            line-height: 1;
        }

        .account-shell {
            max-width: 1280px;
            margin: 0 auto;
            padding: 28px;
            background: #fff;
            border: 1px solid #dce5ef;
            border-radius: 8px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        .account-header {
            margin-bottom: 20px;
        }

        .account-header h2 {
            margin: 0;
            color: #0f172a;
            font-size: 24px;
            font-weight: 700;
        }

        .account-header p {
            margin: 6px 0 0;
            color: #64748b;
            font-size: 14px;
        }

        .account-choice-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 22px;
        }

        .account-tab {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            padding: 16px;
            background: #f8fafc;
            border: 1px solid #dce5ef;
            border-radius: 8px;
            color: #334155;
            text-align: left;
            transition: border-color .2s ease, background .2s ease, box-shadow .2s ease;
        }

        .account-tab strong,
        .account-tab small {
            display: block;
        }

        .account-tab strong {
            color: #0f172a;
            font-size: 15px;
        }

        .account-tab small {
            color: #64748b;
            font-size: 12px;
        }

        .account-tab.active {
            background: #eef9f6;
            border-color: #0f766e;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.12);
        }

        .account-choice-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 34px;
            height: 34px;
            border-radius: 50%;
            background: #0f766e;
            color: #fff;
            font-weight: 700;
            flex: 0 0 auto;
        }

        .account-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            padding: 18px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .account-form-grid.compact {
            max-width: 720px;
        }

        .invoice-block {
            margin-top: 24px;
            padding-top: 22px;
            border-top: 1px solid #e2e8f0;
        }

        .invoice-block h3 {
            margin: 0 0 14px;
            color: #0f172a;
            font-size: 18px;
            font-weight: 700;
        }

        .checkout-field label {
            display: block;
            margin-bottom: 7px;
            color: #334155;
            font-size: 13px;
            font-weight: 700;
        }

        .checkout-field input {
            width: 100%;
            height: 44px;
            padding: 10px 12px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #fff;
            color: #0f172a;
            outline: none;
            transition: border-color .2s ease, box-shadow .2s ease;
        }

        .checkout-field input:focus {
            border-color: #0f766e;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.12);
        }

        .account-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .checkout-invoice-card {
            max-width: 860px;
            margin: 0 auto;
            border: 1px solid #dce5ef;
            border-radius: 8px;
            box-shadow: 0 12px 30px rgba(15, 23, 42, 0.08);
        }

        .invoice-form-grid {
            display: grid;
            grid-template-columns: repeat(2, minmax(0, 1fr));
            gap: 16px;
            padding: 18px;
            background: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
        }

        .invoice-form-grid .checkout-field:first-child,
        #factura-panel .checkout-field:nth-child(2) {
            grid-column: span 2;
        }

        .invoice-actions {
            display: flex;
            justify-content: flex-end;
            margin-top: 20px;
        }

        @media (max-width: 768px) {
            .checkout-steps {
                gap: 48px;
                max-width: 420px;
            }

            .checkout-steps::before {
                left: 64px;
                right: 64px;
            }

            .security-check-grid {
                justify-content: flex-end;
                flex-wrap: wrap;
            }

            .security-check-card {
                max-width: 100%;
            }

            .checkout-payment-card {
                position: static;
            }

            .cart-product-column,
            .cart-type-column {
                min-width: 220px;
            }

            .account-shell {
                padding: 18px;
            }

            .account-choice-grid,
            .account-form-grid,
            .invoice-form-grid {
                grid-template-columns: 1fr;
            }

            .invoice-form-grid .checkout-field:first-child,
            #factura-panel .checkout-field:nth-child(2) {
                grid-column: span 1;
            }

            .mercadopago-shell {
                max-width: 100%;
            }
        }
    </style>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        const csrfToken = "{{ csrf_token() }}";
        const routes = {
            items: "{{ route('onlineshop_get_item_carrito') }}",
            preference: "{{ route('web_cart_preference') }}",
            payment: "{{ route('web_cart_process_payment') }}",
            finalize: "{{ route('web_cart_finalize') }}",
            description: "{{ url('curso-descripcion') }}"
        };

        let cartIds = [];
        let cartItems = [];
        let checkoutTotal = 0;
        let preferenceId = null;
        let mercadoPublicKey = null;
        let paidSaleId = null;
        let paymentInitializing = false;
        let paymentVersion = 0;
        let freeCheckout = false;

        document.addEventListener('DOMContentLoaded', () => {
            loadCart();
            document.getElementById('btn-finalize').addEventListener('click', finalizeCheckout);

            document.querySelectorAll('.account-tab').forEach(button => {
                button.addEventListener('click', () => selectAccountMode(button.dataset.accountMode));
            });

            document.querySelectorAll('.invoice-tab').forEach(button => {
                button.addEventListener('click', () => selectInvoiceType(button.dataset.invoiceType));
            });
        });

        function loadCart() {
            const carrito = JSON.parse(localStorage.getItem('carrito')) || [];
            cartIds = carrito.map(item => parseInt(item.id)).filter(Boolean);

            if (!cartIds.length) {
                renderEmptyCart();
                return;
            }

            fetch(routes.items, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ ids: cartIds })
            })
                .then(response => response.json())
                .then(data => {
                    if (!data.items) throw new Error(data.error || 'No se pudo cargar el carrito.');
                    cartItems = data.items;
                    checkoutTotal = cartItems.reduce((sum, item) => sum + Number(item.price), 0);
                    renderCart();
                    resetPaymentState();
                    if (checkoutTotal <= 0) {
                        startFreeCheckout();
                    } else {
                        startCardPayment();
                    }
                })
                .catch(error => showAlert(error.message));
        }

        function renderCart() {
            const tbody = document.getElementById('cart');
            tbody.innerHTML = '';

            cartItems.forEach(item => {
                const row = document.createElement('tr');
                row.className = 'border-y border-transparent border-b-slate-200';
                row.id = `${item.id}_pc`;
                row.innerHTML = `
                    <td class="px-4 py-3 sm:px-5">
                        <div class="flex items-center space-x-4">
                            <div class="avatar"><img class="rounded-full" src="${item.image}" alt="curso"></div>
                            <span class="cart-product-name font-medium text-slate-700">
                                <a href="${routes.description}/${item.id}" target="_blank">${item.name}</a>
                            </span>
                        </div>
                    </td>
                    <td class="px-4 py-3 font-medium text-slate-700 sm:px-5"><b class="cart-type-text">${item.additional || ''}</b></td>
                    <td class="whitespace-nowrap px-4 py-3 font-medium text-slate-700 sm:px-5"><b>${priceLabel(item.price)}</b></td>
                    <td class="whitespace-nowrap px-4 py-3 text-slate-700 sm:px-5">
                        <button class="boton-degradado-trash" type="button" onclick="removeProduct(${item.id})">
                            <i class="fa fa-trash" aria-hidden="true" style="font-size: 16px;"></i>
                        </button>
                    </td>
                `;
                tbody.appendChild(row);
            });

            document.getElementById('totalid').textContent = `S/ ${money(checkoutTotal)}`;
            renderPaymentSummary();
            updateFreeCheckoutView();
        }

        function renderPaymentSummary() {
            document.getElementById('payment-products').innerHTML = cartItems.map(item => `
                <div class="d-flex justify-content-between mb-2">
                    <span>${item.name}</span>
                    <strong>${priceLabel(item.price)}</strong>
                </div>
            `).join('');
        }

        function renderEmptyCart() {
            resetPaymentState();
            document.getElementById('cart').innerHTML = '<tr><td colspan="4" class="px-4 py-5 text-center">No has elegido ningun curso.</td></tr>';
            document.getElementById('payment-products').innerHTML = '';
            document.getElementById('totalid').textContent = 'S/ 0.00';
            document.getElementById('cardPaymentBrick_container').innerHTML = '<div class="mp-loading-message p-4 text-center">Agrega cursos para cargar el pago.</div>';
            updateFreeCheckoutView();
        }

        function removeProduct(id) {
            if (paidSaleId) {
                showAlert('El pago ya fue aprobado. Continua con cuenta y comprobante para finalizar.');
                return;
            }

            const carrito = (JSON.parse(localStorage.getItem('carrito')) || []).filter(item => parseInt(item.id) !== id);
            localStorage.setItem('carrito', JSON.stringify(carrito));
            loadCart();
        }

        function startCardPayment() {
            hideAlert();
            if (paymentInitializing) {
                return;
            }

            if (!cartIds.length) {
                showAlert('No has elegido ningun curso.');
                return;
            }

            paymentInitializing = true;
            const currentPaymentVersion = paymentVersion;
            document.getElementById('cardPaymentBrick_container').innerHTML = '<div class="mp-loading-message p-4 text-center">Preparando pago seguro...</div>';

            requestJson(routes.preference, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({ item_id: cartIds })
            }, 20000)
                .then(async (data) => {
                    if (currentPaymentVersion !== paymentVersion) {
                        return;
                    }

                    preferenceId = data.preference;
                    mercadoPublicKey = data.public_key;
                    checkoutTotal = Number(data.total);
                    cartItems = data.products;
                    document.getElementById('totalid').textContent = `S/ ${money(checkoutTotal)}`;
                    renderPaymentSummary();
                    await renderMercadoPago(currentPaymentVersion);
                })
                .catch(error => {
                    if (currentPaymentVersion === paymentVersion) {
                        showAlert(error.message);
                    }
                })
                .finally(() => {
                    if (currentPaymentVersion !== paymentVersion) {
                        return;
                    }

                    paymentInitializing = false;
                });
        }

        function startFreeCheckout() {
            hideAlert();
            freeCheckout = true;
            paidSaleId = null;
            preferenceId = null;
            mercadoPublicKey = null;
            paymentInitializing = false;
            unmountMercadoPago();
            document.getElementById('cardPaymentBrick_container').innerHTML = '<div class="mp-loading-message p-4 text-center">Este curso es gratis. Completa tus datos para acceder.</div>';
            updateFreeCheckoutView();
            fillPayerData({});
            showStep('final');
        }

        async function renderMercadoPago(currentPaymentVersion) {
            const container = document.getElementById('cardPaymentBrick_container');
            container.innerHTML = '<div class="mp-loading-message p-4 text-center">Cargando formulario seguro de MercadoPago...</div>';

            if (!window.MercadoPago) {
                throw new Error('No se pudo cargar el SDK de MercadoPago. Revisa la conexion o bloqueadores del navegador.');
            }

            try {
                const mp = new MercadoPago(mercadoPublicKey, { locale: 'es-PE' });
                const bricksBuilder = mp.bricks();

                const brickPromise = bricksBuilder.create('cardPayment', 'cardPaymentBrick_container', {
                    initialization: {
                        preferenceId,
                        amount: checkoutTotal,
                    },
                    customization: {
                        visual: {
                            style: {
                                customVariables: { theme: 'bootstrap' }
                            }
                        },
                        paymentMethods: { maxInstallments: 1 }
                    },
                    callbacks: {
                        onReady: () => {
                            container.querySelectorAll('.mp-loading-message').forEach(message => message.remove());
                            hideAlert();
                        },
                        onSubmit: (cardFormData) => {
                            hideAlert();
                            cardFormData = normalizeCardFormData(cardFormData);

                            return requestJson(routes.payment, {
                                method: 'PUT',
                                headers: {
                                    'Content-Type': 'application/json',
                                    'X-CSRF-TOKEN': csrfToken
                                },
                                body: JSON.stringify({
                                    item_id: cartIds,
                                    cardFormData
                                })
                            }, 30000)
                                .then((data) => {
                                    paidSaleId = data.sale_id;
                                    fillPayerData(data.payer || {});
                                    showStep('final');
                                })
                                .catch(error => {
                                    showAlert(error.message);
                                    throw error;
                                });
                        },
                        onError: (error) => {
                            console.log(error);
                            showAlert('MercadoPago no pudo renderizar el formulario. Intenta recargar la pagina.');
                        },
                    },
                });

                const controller = await withTimeout(
                    brickPromise,
                    15000,
                    'MercadoPago esta tardando demasiado en cargar. Intenta nuevamente o recarga la pagina.'
                );

                if (currentPaymentVersion !== paymentVersion) {
                    if (controller && typeof controller.unmount === 'function') {
                        controller.unmount();
                    }
                    return;
                }

                window.cardPaymentBrickController = controller;
            } catch (error) {
                container.innerHTML = '';
                throw error;
            }
        }

        function withTimeout(promise, milliseconds, message) {
            let timer;
            const timeout = new Promise((_, reject) => {
                timer = setTimeout(() => reject(new Error(message)), milliseconds);
            });

            return Promise.race([promise, timeout]).finally(() => clearTimeout(timer));
        }

        function normalizeCardFormData(cardFormData) {
            const payer = cardFormData.payer || {};
            payer.email = (payer.email || '').trim().toLowerCase();

            if (!isValidEmail(payer.email)) {
                throw new Error('Ingresa un correo valido en el formulario de MercadoPago.');
            }

            cardFormData.payer = payer;
            return cardFormData;
        }

        function isValidEmail(email) {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        }

        function fillPayerData(payer) {
            const names = payer.names || '';
            const email = payer.email || '';
            const dni = payer.document_number || '';

            document.getElementById('create_names').value = names;
            document.getElementById('create_email').value = email;
            document.getElementById('create_dni').value = dni;
            document.getElementById('login_email').value = email;
            document.getElementById('invoice_name').value = names;
            document.getElementById('invoice_dni').value = dni;
            document.getElementById('invoice_email').value = email;
        }

        function selectAccountMode(mode) {
            document.getElementById('account_mode').value = mode;
            document.querySelectorAll('.account-tab').forEach(button => button.classList.toggle('active', button.dataset.accountMode === mode));
            document.getElementById('create-account-panel').classList.toggle('d-none', mode !== 'create');
            document.getElementById('login-account-panel').classList.toggle('d-none', mode !== 'login');
        }

        function selectInvoiceType(type) {
            document.getElementById('invoice_type').value = type;
            document.querySelectorAll('.invoice-tab').forEach(button => button.classList.toggle('active', button.dataset.invoiceType === type));
            document.getElementById('boleta-panel').classList.toggle('d-none', type !== 'boleta');
            document.getElementById('factura-panel').classList.toggle('d-none', type !== 'factura');
        }

        function finalizeCheckout() {
            hideAlert();
            if (!freeCheckout && !paidSaleId) {
                showAlert('Primero debes completar el pago con tarjeta.');
                return;
            }

            setBusy('btn-finalize', true);
            const accountMode = document.getElementById('account_mode').value;
            const payload = {
                sale_id: freeCheckout ? null : paidSaleId,
                item_id: freeCheckout ? cartIds : undefined,
                account_mode: accountMode,
                email: accountMode === 'login' ? value('login_email') : value('create_email'),
                password: accountMode === 'login' ? value('login_password') : value('create_password'),
                names: value('create_names'),
                dni: value('create_dni'),
                invoice_type: value('invoice_type'),
                invoice_name: value('invoice_name'),
                invoice_dni: value('invoice_dni'),
                invoice_email: value('invoice_email'),
                invoice_ruc: value('invoice_ruc'),
                invoice_business_name: value('invoice_business_name'),
                invoice_address: value('invoice_address')
            };

            requestJson(routes.finalize, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify(payload)
            }, 30000)
                .then((data) => {
                    // Refresh CSRF token after login/register
                    refreshCsrfToken();

                    localStorage.removeItem('carrito');
                    window.location.href = data.url;
                })
                .catch(error => showAlert(error.message))
                .finally(() => setBusy('btn-finalize', false));
        }

        function showStep(step) {
            document.querySelectorAll('.checkout-panel').forEach(panel => panel.classList.add('d-none'));
            document.getElementById(`step-${step}`).classList.remove('d-none');

            const order = ['payment', 'final'];
            const index = order.indexOf(step);
            document.querySelectorAll('.checkout-step').forEach(button => {
                const buttonIndex = order.indexOf(button.dataset.stepLabel);
                button.classList.toggle('active', buttonIndex === index);
                button.classList.toggle('done', buttonIndex < index);
            });
        }

        function showAlert(message) {
            const alert = document.getElementById('checkout-alert');
            alert.textContent = message;
            alert.classList.remove('d-none');
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function hideAlert() {
            const alert = document.getElementById('checkout-alert');
            alert.textContent = '';
            alert.classList.add('d-none');
        }

        function setBusy(id, busy) {
            const button = document.getElementById(id);
            button.disabled = busy;
            button.classList.toggle('opacity-50', busy);
        }

        function resetPaymentState() {
            paymentVersion += 1;
            paymentInitializing = false;
            paidSaleId = null;
            preferenceId = null;
            mercadoPublicKey = null;
            freeCheckout = false;
            showStep('payment');
            updateFreeCheckoutView();

            unmountMercadoPago();
        }

        function unmountMercadoPago() {
            if (window.cardPaymentBrickController && typeof window.cardPaymentBrickController.unmount === 'function') {
                try {
                    window.cardPaymentBrickController.unmount();
                } catch (error) {
                    console.log(error);
                }
            }

            window.cardPaymentBrickController = null;
        }

        function updateFreeCheckoutView() {
            document.getElementById('payment-step-text').textContent = freeCheckout ? 'Carrito gratis' : 'Carrito y pago';
            document.getElementById('payment-card-title').textContent = freeCheckout ? 'Curso gratuito' : 'Pago con tarjeta';
            document.getElementById('account-title').textContent = freeCheckout ? 'Completa tus datos para acceder' : 'Crea tu cuenta en menos de 30 segundos';
            document.getElementById('account-subtitle').textContent = freeCheckout
                ? 'Crea una cuenta o inicia sesion para registrar el curso en tu dashboard.'
                : 'Completa tus datos para asociar la compra y emitir el comprobante.';
            document.getElementById('invoice-block').classList.toggle('d-none', freeCheckout);
            document.getElementById('btn-finalize-text').textContent = freeCheckout ? 'ACCEDER A TU CUENTA' : 'FINALIZAR COMPRA';
        }

        function requestJson(url, options, timeoutMs) {
            const controller = new AbortController();
            const timer = setTimeout(() => controller.abort(), timeoutMs);
            const headers = {
                'Accept': 'application/json',
                ...(options.headers || {})
            };

            return fetch(url, { ...options, headers, signal: controller.signal })
                .then(async response => {
                    const text = await response.text();
                    let data = {};

                    try {
                        data = text ? JSON.parse(text) : {};
                    } catch (error) {
                        console.log(text);
                        throw new Error('El servidor no devolvio una respuesta valida.');
                    }

                    if (!response.ok) {
                        throw new Error(data.error || data.message || 'No se pudo completar la solicitud.');
                    }

                    return data;
                })
                .catch(error => {
                    if (error.name === 'AbortError') {
                        throw new Error('La solicitud esta tardando demasiado. Intenta nuevamente.');
                    }

                    throw error;
                })
                .finally(() => clearTimeout(timer));
        }

        function value(id) {
            return document.getElementById(id).value.trim();
        }

        function money(value) {
            return Number(value || 0).toFixed(2);
        }

        function priceLabel(value) {
            return Number(value || 0) <=0 ? 'Gratis' : `S/ ${money(value)}`;
        }

        // Refresh CSRF token after login/register
        function refreshCsrfToken() {
            fetch("{{ url('/get-csrf-token') }}", {
                method: "GET",
                headers: { "X-Requested-With": "XMLHttpRequest" }
            })
            .then(res => res.json())
            .then(data => {
                if (data.token) {
                    const meta = document.querySelector('meta[name="csrf-token"]');
                    if (meta) {
                        meta.content = data.token;
                        console.log('CSRF token refreshed');
                    }
                }
            })
            .catch(err => console.error('Failed to refresh CSRF token:', err));
        }

        // ==================== PASSWORD RECOVERY ====================
        function showPasswordRecovery() {
            document.getElementById('password-recovery-modal').classList.remove('hidden');
            document.getElementById('recovery-message').innerHTML = '';
        }

        function hidePasswordRecovery() {
            document.getElementById('password-recovery-modal').classList.add('hidden');
        }

        function sendPasswordRecovery() {
            const email = document.getElementById('recovery-email').value;
            const msgDiv = document.getElementById('recovery-message');

            if (!email) {
                msgDiv.innerHTML = '<span class="text-red-600">Ingresa tu correo</span>';
                return;
            }

            const csrfToken = document.querySelector('meta[name="csrf-token"]')?.content || '';

            fetch("{{ url('/send-password-recovery') }}", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": csrfToken
                },
                body: JSON.stringify({email: email})
            })
            .then(response => {
                if (response.status === 419) {
                    msgDiv.innerHTML = '<span class="text-red-600">Sesión expirada. Recargando página...</span>';
                    setTimeout(() => location.reload(), 2000);
                    throw new Error('Session expired');
                }
                return response.json();
            })
            .then(data => {
                if (data.status === 'success') {
                    msgDiv.innerHTML = '<span class="text-green-600">Correo enviado. Revisa tu bandeja de entrada.</span>';
                    setTimeout(() => hidePasswordRecovery(), 3000);
                } else {
                    msgDiv.innerHTML = '<span class="text-red-600">' + (data.error || 'Error') + '</span>';
                }
            })
            .catch(err => {
                if (err.message !== 'Session expired') {
                    msgDiv.innerHTML = '<span class="text-red-600">Error al enviar correo</span>';
                }
            });
        }
    </script>
@stop
