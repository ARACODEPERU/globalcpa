@extends('layouts.webpage')
@vite('resources/css/website/shop-cart.css')
@section('content')

    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <div class="tap-top"><i data-feather="chevrons-up"></i></div>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />


    <div class="page-wrapper" id="pageWrapper">
        <x-header />
        <div class="page-body-wrapper">
            <x-sidebar />

            <div class="page-body checkout-page-body">
                <div class="container-fluid checkout-container">
                    <div class="checkout-page-heading">
                        <span>Compra segura</span>
                        <h1>Finaliza tu inscripcion</h1>
                        <p>Revisa tus cursos, completa el pago y activa tu acceso en pocos pasos.</p>
                    </div>

                    <div id="checkout-alert" class="alert alert-danger d-none"></div>

                    <section id="step-payment" class="checkout-panel">
                        <div class="checkout-wide">
                            <div class="row g-4 align-items-start checkout-main-grid">
                                <div class="col-xl-7 col-lg-6">
                                    <div class="card checkout-progress-card">
                                        <div class="checkout-steps">
                                            <button class="checkout-step active" data-step-label="payment">
                                                <span class="checkout-step-number">1</span>
                                                <span class="checkout-step-text" id="payment-step-text">Comprar</span>
                                            </button>
                                            <button class="checkout-step" data-step-label="final">
                                                <span class="checkout-step-number">2</span>
                                                <span class="checkout-step-text">Crear cuenta y comprobante</span>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="card cart-table-card">
                                        <div class="cart-table-header">
                                            <div>
                                                <span>Resumen</span>
                                                <h2>Tu carrito</h2>
                                            </div>
                                            <small id="total_productos">Cursos seleccionados</small>
                                        </div>
                                        <div class="is-scrollbar-hidden min-w-full overflow-x-auto">
                                            <table class="is-hoverable w-full text-left">
                                                <thead>
                                                    <tr>
                                                        <th
                                                            class="cart-product-column bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 lg:px-5">
                                                            Producto</th>
                                                        <th
                                                            class="cart-type-column bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 lg:px-5">
                                                            Tipo</th>
                                                        <th
                                                            class="cart-price-column bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 lg:px-5">
                                                            Precio</th>
                                                        <th
                                                            class="cart-action-column bg-slate-200 px-4 py-3 font-semibold uppercase text-slate-800 lg:px-5">
                                                            Accion</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="cart">
                                                    <tr>
                                                        <td colspan="4" class="px-4 py-5 text-center">Cargando carrito...
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-5 col-lg-6">
                                    <div class="card p-4 checkout-payment-card">
                                        <div class="checkout-payment-header">
                                            <span class="secure-payment-icon" aria-hidden="true">
                                                <svg viewBox="0 0 24 24" fill="none" role="img" focusable="false"
                                                    xmlns="http://www.w3.org/2000/svg">
                                                    <path opacity="0.5"
                                                        d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z"
                                                        fill="#1C274C" />
                                                    <path
                                                        d="M12.75 14C12.75 13.5858 12.4142 13.25 12 13.25C11.5858 13.25 11.25 13.5858 11.25 14V18C11.25 18.4142 11.5858 18.75 12 18.75C12.4142 18.75 12.75 18.4142 12.75 18V14Z"
                                                        fill="#1C274C" />
                                                    <path
                                                        d="M6.75 8C6.75 5.10051 9.10051 2.75 12 2.75C14.8995 2.75 17.25 5.10051 17.25 8V10.0036C17.8174 10.0089 18.3135 10.022 18.75 10.0546V8C18.75 4.27208 15.7279 1.25 12 1.25C8.27208 1.25 5.25 4.27208 5.25 8V10.0546C5.68651 10.022 6.18264 10.0089 6.75 10.0036V8Z"
                                                        fill="#1C274C" />
                                                </svg>
                                            </span>
                                            <span class="secure-payment-copy">
                                                <strong>Finaliza tu Inscripci&oacute;n</strong>
                                                <small>Pago 100% seguro con Mercado Pago</small>
                                            </span>
                                        </div>
                                        <div
                                            class="checkout-total-row d-flex justify-content-between align-items-center mb-4">
                                            <span>Total</span>
                                            <strong id="totalid">S/ 0.00</strong>
                                        </div>
                                        <div class="mercadopago-shell">
                                            <div id="payment-phone-field" class="checkout-field mb-3">
                                                <label>Telefono</label>
                                                <div class="phone-input-group">
                                                    <select id="payment_phone_country" aria-label="Codigo de pais">
                                                        <option value="" data-area-code="" selected>Selecciona codigo
                                                        </option>
                                                            <option value="+51" data-code="pe">Perú (+51)</option>
                                                            <option value="+54" data-code="ar">Argentina (+54)</option>
                                                            <option value="+591" data-code="bo">Bolivia (+591)</option>
                                                            <option value="+55" data-code="br">Brasil (+55)</option>
                                                            <option value="+56" data-code="cl">Chile (+56)</option>
                                                            <option value="+57" data-code="co">Colombia (+57)</option>
                                                            <option value="+506" data-code="cr">Costa Rica (+506)</option>
                                                            <option value="+53" data-code="cu">Cuba (+53)</option>
                                                            <option value="+593" data-code="ec">Ecuador (+593)</option>
                                                            <option value="+503" data-code="sv">El Salvador (+503)</option>
                                                            <option value="+34" data-code="es">España (+34)</option>
                                                            <option value="+1" data-code="us">Estados Unidos (+1)</option>
                                                            <option value="+1" data-code="ca">Canadá (+1)</option>
                                                            <option value="+502" data-code="gt">Guatemala (+502)</option>
                                                            <option value="+504" data-code="hn">Honduras (+504)</option>
                                                            <option value="+52" data-code="mx">México (+52)</option>
                                                            <option value="+505" data-code="ni">Nicaragua (+505)</option>
                                                            <option value="+507" data-code="pa">Panamá (+507)</option>
                                                            <option value="+595" data-code="py">Paraguay (+595)</option>
                                                            <option value="+1" data-code="pr">Puerto Rico (+1)</option>
                                                            <option value="+1" data-code="do">República Dominicana (+1)</option>
                                                            <option value="+598" data-code="uy">Uruguay (+598)</option>
                                                            <option value="+58" data-code="ve">Venezuela (+58)</option>
                                                            <option value="+49" data-code="de">Alemania (+49)</option>
                                                            <option value="+376" data-code="ad">Andorra (+376)</option>
                                                            <option value="+244" data-code="ao">Angola (+244)</option>
                                                            <option value="+966" data-code="sa">Arabia Saudita (+966)</option>
                                                            <option value="+213" data-code="dz">Argelia (+213)</option>
                                                            <option value="+61" data-code="au">Australia (+61)</option>
                                                            <option value="+43" data-code="at">Austria (+43)</option>
                                                            <option value="+32" data-code="be">Bélgica (+32)</option>
                                                            <option value="+501" data-code="bz">Belice (+501)</option>
                                                            <option value="+229" data-code="bj">Benín (+229)</option>
                                                            <option value="+359" data-code="bg">Bulgaria (+359)</option>
                                                            <option value="+237" data-code="cm">Camerún (+237)</option>
                                                            <option value="+86" data-code="cn">China (+86)</option>
                                                            <option value="+357" data-code="cy">Chipre (+357)</option>
                                                            <option value="+82" data-code="kr">Corea del Sur (+82)</option>
                                                            <option value="+225" data-code="ci">Costa de Marfil (+225)</option>
                                                            <option value="+385" data-code="hr">Croacia (+385)</option>
                                                            <option value="+45" data-code="dk">Dinamarca (+45)</option>
                                                            <option value="+971" data-code="ae">Emiratos Árabes Unidos (+971)</option>
                                                            <option value="+421" data-code="sk">Eslovaquia (+421)</option>
                                                            <option value="+386" data-code="si">Eslovenia (+386)</option>
                                                            <option value="+372" data-code="ee">Estonia (+372)</option>
                                                            <option value="+63" data-code="ph">Filipinas (+63)</option>
                                                            <option value="+358" data-code="fi">Finlandia (+358)</option>
                                                            <option value="+33" data-code="fr">Francia (+33)</option>
                                                            <option value="+30" data-code="gr">Grecia (+30)</option>
                                                            <option value="+852" data-code="hk">Hong Kong (+852)</option>
                                                            <option value="+36" data-code="hu">Hungría (+36)</option>
                                                            <option value="+91" data-code="in">India (+91)</option>
                                                            <option value="+62" data-code="id">Indonesia (+62)</option>
                                                            <option value="+353" data-code="ie">Irlanda (+353)</option>
                                                            <option value="+354" data-code="is">Islandia (+354)</option>
                                                            <option value="+972" data-code="il">Israel (+972)</option>
                                                            <option value="+39" data-code="it">Italia (+39)</option>
                                                            <option value="+81" data-code="jp">Japón (+81)</option>
                                                            <option value="+371" data-code="lv">Letonia (+371)</option>
                                                            <option value="+370" data-code="lt">Lituania (+370)</option>
                                                            <option value="+352" data-code="lu">Luxemburgo (+352)</option>
                                                            <option value="+60" data-code="my">Malasia (+60)</option>
                                                            <option value="+212" data-code="ma">Marruecos (+212)</option>
                                                            <option value="+31" data-code="nl">Países Bajos (+31)</option>
                                                            <option value="+64" data-code="nz">Nueva Zelanda (+64)</option>
                                                            <option value="+47" data-code="no">Noruega (+47)</option>
                                                            <option value="+48" data-code="pl">Polonia (+48)</option>
                                                            <option value="+351" data-code="pt">Portugal (+351)</option>
                                                            <option value="+44" data-code="gb">Reino Unido (+44)</option>
                                                            <option value="+420" data-code="cz">República Checa (+420)</option>
                                                            <option value="+40" data-code="ro">Rumanía (+40)</option>
                                                            <option value="+7" data-code="ru">Rusia (+7)</option>
                                                            <option value="+65" data-code="sg">Singapur (+65)</option>
                                                            <option value="+27" data-code="za">Sudáfrica (+27)</option>
                                                            <option value="+46" data-code="se">Suecia (+46)</option>
                                                            <option value="+41" data-code="ch">Suiza (+41)</option>
                                                            <option value="+66" data-code="th">Tailandia (+66)</option>
                                                            <option value="+90" data-code="tr">Turquía (+90)</option>
                                                    </select>
                                                    <input id="payment_phone" type="tel"
                                                        placeholder="Numero de telefono">
                                                </div>
                                            </div>
                                            <div id="cardPaymentBrick_container"></div>
                                            <div class="secure-payment-note">
                                                <span class="secure-payment-icon" aria-hidden="true">
                                                    <svg viewBox="0 0 24 24" fill="none" role="img"
                                                        focusable="false" xmlns="http://www.w3.org/2000/svg">
                                                        <path opacity="0.5"
                                                            d="M2 16C2 13.1716 2 11.7574 2.87868 10.8787C3.75736 10 5.17157 10 8 10H16C18.8284 10 20.2426 10 21.1213 10.8787C22 11.7574 22 13.1716 22 16C22 18.8284 22 20.2426 21.1213 21.1213C20.2426 22 18.8284 22 16 22H8C5.17157 22 3.75736 22 2.87868 21.1213C2 20.2426 2 18.8284 2 16Z"
                                                            fill="#1C274C" />
                                                        <path
                                                            d="M12.75 14C12.75 13.5858 12.4142 13.25 12 13.25C11.5858 13.25 11.25 13.5858 11.25 14V18C11.25 18.4142 11.5858 18.75 12 18.75C12.4142 18.75 12.75 18.4142 12.75 18V14Z"
                                                            fill="#1C274C" />
                                                        <path
                                                            d="M6.75 8C6.75 5.10051 9.10051 2.75 12 2.75C14.8995 2.75 17.25 5.10051 17.25 8V10.0036C17.8174 10.0089 18.3135 10.022 18.75 10.0546V8C18.75 4.27208 15.7279 1.25 12 1.25C8.27208 1.25 5.25 4.27208 5.25 8V10.0546C5.68651 10.022 6.18264 10.0089 6.75 10.0036V8Z"
                                                            fill="#1C274C" />
                                                    </svg>
                                                </span>
                                                <span>Al continuar, aceptas nuestros <a href="{{ route('terms_main') }}"
                                                        target="_blank" rel="noopener noreferrer">t&eacute;rminos y
                                                        condiciones</a> y confirmas que los datos ingresados son
                                                    correctos.</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="security-check-grid">
                                <div class="security-check-card security-check-card-static">
                                    <span class="security-check-icon-svg" aria-hidden="true">
                                        <svg viewBox="0 0 64 64" role="img" focusable="false">
                                            <path
                                                d="M32 6 52 14v15c0 13.2-7.8 24.8-20 29.4C19.8 53.8 12 42.2 12 29V14L32 6Z"
                                                fill="#dc2626" />
                                            <path d="M27.6 38.6 19.8 30.8l4.2-4.2 3.6 3.6L40 17.8l4.2 4.2-16.6 16.6Z"
                                                fill="#fff" />
                                        </svg>
                                    </span>
                                    <span>
                                        <strong>Pago 100% seguro</strong>
                                        <small>Tu informaci&oacute;n est&aacute; protegida</small>
                                    </span>
                                </div>
                                <div class="security-check-card security-check-card-static security-check-card-mercado">
                                    <span>
                                        <strong>Con el respaldo de</strong>
                                        <img class="security-check-logo-wide" src="{{ asset('img/mercadopago.png') }}"
                                            alt="Mercado Pago">
                                    </span>
                                </div>
                                <div class="security-check-card security-check-card-static">
                                    <span class="security-check-icon-svg security-check-icon-whatsapp" aria-hidden="true">
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" role="img"
                                            focusable="false">
                                            <path
                                                d="M380.9 97.1c-41.9-42-97.7-65.1-157-65.1-122.4 0-222 99.6-222 222 0 39.1 10.2 77.3 29.6 111L0 480 117.7 449.1c32.4 17.7 68.9 27 106.1 27l.1 0c122.3 0 224.1-99.6 224.1-222 0-59.3-25.2-115-67.1-157zm-157 341.6c-33.2 0-65.7-8.9-94-25.7l-6.7-4-69.8 18.3 18.6-68.1-4.4-7c-18.5-29.4-28.2-63.3-28.2-98.2 0-101.7 82.8-184.5 184.6-184.5 49.3 0 95.6 19.2 130.4 54.1s56.2 81.2 56.1 130.5c0 101.8-84.9 184.6-186.6 184.6zM325.1 300.5c-5.5-2.8-32.8-16.2-37.9-18-5.1-1.9-8.8-2.8-12.5 2.8s-14.3 18-17.6 21.8c-3.2 3.7-6.5 4.2-12 1.4-32.6-16.3-54-29.1-75.5-66-5.7-9.8 5.7-9.1 16.3-30.3 1.8-3.7 .9-6.9-.5-9.7s-12.5-30.1-17.1-41.2c-4.5-10.8-9.1-9.3-12.5-9.5-3.2-.2-6.9-.2-10.6-.2s-9.7 1.4-14.8 6.9c-5.1 5.6-19.4 19-19.4 46.3s19.9 53.7 22.6 57.4c2.8 3.7 39.1 59.7 94.8 83.8 35.2 15.2 49 16.5 66.6 13.9 10.7-1.6 32.8-13.4 37.4-26.4s4.6-24.1 3.2-26.4c-1.3-2.5-5-3.9-10.5-6.6z" />
                                        </svg>
                                    </span>
                                    <span>
                                        <strong>Asistencia Inmediata</strong>
                                        <small>Te ayudamos en todo el proceso</small>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </section>

                    <section id="step-final" class="checkout-panel d-none">
                        <div class="checkout-wide">
                            <div class="card checkout-progress-card">
                                <div class="checkout-steps">
                                    <button class="checkout-step done" data-step-label="payment">
                                        <span class="checkout-step-number">1</span>
                                        <span class="checkout-step-text">Comprar</span>
                                    </button>
                                    <button class="checkout-step active" data-step-label="final">
                                        <span class="checkout-step-number">2</span>
                                        <span class="checkout-step-text">Crear cuenta y comprobante</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="account-shell">
                            <div class="account-header">
                                <h2 id="account-title">Crea tu cuenta en menos de 30 segundos</h2>
                                <p id="account-subtitle">Completa tus datos para asociar la compra y emitir el comprobante.
                                </p>
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
                                    <input id="create_password" type="password"
                                        placeholder="Opcional, por defecto tu DNI">
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
                                    <a href="#" onclick="showPasswordRecovery(); return false;"
                                        class="text-sm text-blue-600 hover:underline">
                                        ¿Olvidaste tu contraseña?
                                    </a>
                                </div>
                            </div>

                            <div class="invoice-block" id="invoice-block">
                                <h3>Datos de comprobante</h3>
                                <div class="flex border-b mb-4">
                                    <button type="button" class="invoice-tab active"
                                        data-invoice-type="boleta">Boleta</button>
                                    <button type="button" class="invoice-tab"
                                        data-invoice-type="factura">Factura</button>
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
                                <button type="button" id="btn-finalize" class="shop-action-pay-red mt-4">
                                    <b id="btn-finalize-text"><i class="fa fa-check-circle me-2"></i> FINALIZAR COMPRA</b>
                                </button>
                            </div>
                        </div>
                    </section>

                    <!-- Password Recovery Modal -->
                    <div id="password-recovery-modal"
                        class="hidden fixed inset-0 bg-gray-600 bg-opacity-50 flex items-center justify-center z-50">
                        <div class="bg-white p-6 rounded-lg shadow-xl max-w-md w-full">
                            <h3 class="text-lg font-medium mb-4">Recuperar Contraseña</h3>
                            <input type="email" id="recovery-email" placeholder="Tu correo electrónico"
                                class="w-full border rounded p-2 mb-4">
                            <div class="flex gap-2">
                                <button onclick="sendPasswordRecovery()"
                                    class="btn boton-degradado-courses">Enviar</button>
                                <button onclick="hidePasswordRecovery()" class="btn btn-secondary">Cancelar</button>
                            </div>
                            <div id="recovery-message" class="mt-2 text-sm"></div>
                        </div>
                    </div>

                    <div id="payment-warning-modal"
                        class="hidden payment-warning-backdrop fixed inset-0 flex items-center justify-center z-50">
                        <div class="payment-warning-dialog">
                            <div class="payment-warning-icon">!</div>
                            <h3>Pago no aprobado</h3>
                            <p id="payment-warning-message"></p>
                            <div class="payment-warning-actions">
                                <button type="button" onclick="hidePaymentWarningModal()"
                                    class="payment-warning-button">Entendido</button>
                            </div>
                            <small class="payment-warning-note">*descuida tus datos estan protegidos y ningun cobro se ha
                                realizado.</small>
                        </div>
                    </div>

                    <div id="phone-required-modal"
                        class="hidden phone-required-backdrop fixed inset-0 flex items-center justify-center z-50">
                        <div class="phone-required-dialog">
                            <button type="button" onclick="hidePhoneRequiredModal()" class="phone-required-close"
                                aria-label="Cerrar">x</button>
                            <div class="phone-required-icon">!</div>
                            <span class="phone-required-kicker">Dato requerido por seguridad</span>
                            <h3>Ingresa tu numero de telefono</h3>
                            <p id="phone-required-message">Para continuar con el pago necesitamos que selecciones el codigo
                                de pais e ingreses tu numero de telefono. Esto nos ayuda a proteger tu compra y contactarte
                                si hubiera algun inconveniente.</p>
                            <button type="button" onclick="hidePhoneRequiredModal()"
                                class="phone-required-primary">Entendido</button>
                        </div>
                    </div>

                    <div id="account-conflict-modal"
                        class="hidden account-conflict-backdrop fixed inset-0 flex items-center justify-center z-50">
                        <div class="account-conflict-dialog">
                            <button type="button" onclick="hideAccountConflictModal()" class="account-conflict-close"
                                aria-label="Cerrar">x</button>
                            <div class="account-conflict-icon">!</div>
                            <span class="account-conflict-kicker">Tu compra esta protegida</span>
                            <h3 id="account-conflict-title">Revisemos tus datos</h3>
                            <p id="account-conflict-message"></p>
                            <div class="account-conflict-support">
                                <a href="mailto:informes@globalcpaperu.com">informes@globalcpaperu.com</a>
                                <a href="tel:+51967052506">+51 967052506</a>
                            </div>
                            <div class="account-conflict-actions">
                                <button type="button" onclick="hideAccountConflictModal()"
                                    class="account-conflict-secondary">Cerrar</button>
                                <button type="button" onclick="goToLoginFromConflictModal()"
                                    class="account-conflict-primary">Iniciar sesion</button>
                            </div>
                        </div>
                    </div>

                    <div id="pending-paid-modal"
                        class="hidden pending-paid-backdrop fixed inset-0 flex items-center justify-center z-50">
                        <div class="pending-paid-dialog">
                            <button type="button" onclick="hidePendingPaidModal()" class="pending-paid-close"
                                aria-label="Cerrar">x</button>
                            <div class="pending-paid-icon">✓</div>
                            <span class="pending-paid-kicker">Tu pago esta protegido</span>
                            <h3>Tus cursos estan esperando por ti</h3>
                            <p>Tranquilo, encontramos una compra aprobada por MercadoPago que aun falta finalizar. Completa
                                el proceso creando tu cuenta o iniciando sesion para activar tus cursos.</p>
                            <div id="pending-paid-courses" class="pending-paid-courses"></div>
                            <button type="button" onclick="hidePendingPaidModal()"
                                class="pending-paid-primary">Completar ahora</button>
                        </div>
                    </div>
                </div>
            </div> 
            
            <div class="page-body">

                {{-- NUEVO DISEÑO DE CHECKOUT - SOLO FRONTEND, FALTA CONECTAR CON BACKEND Y MERCADOPAGO --}}
                <div style="width: 95%; margin: 0 auto; padding: 40px 20px;">
                    <div class="checkout-grid">

                        <!-- LEFT -->
                        <div class="card">
                            <div class="d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4">
                                <div class="logo d-flex align-items-center gap-3">
                                    <div class="logo-icon fs-3">🛡️</div>
                                    <div>
                                        <h2 class="mb-0 fw-bolder" style="font-size: 1.15rem;">CPA ACADEMY</h2>
                                        <p class="mb-0 small text-muted" style="font-size: 0.8rem;">Formación que impulsa tu futuro</p>
                                    </div>
                                </div>

                                <div class="steps d-flex align-items-center gap-2">
                                    <div class="step-circle">1</div>
                                    <div class="step-line" style="width: 150px; height: 2px; background: #cbd5e1;"></div>
                                    <div class="step-circle gray">2</div>
                                </div>
                            </div>

                            <div class="small-text">Paso 1 de 2</div>

                            <h1 class="title-pago">Finaliza tu inscripción</h1>

                            <div class="subtitle">
                                Pago 100% seguro con Mercado Pago
                            </div>

                            <div class="course-box d-flex align-items-center justify-content-between gap-4 p-4 mb-1 rounded-3 border bg-light shadow-sm">
                                <div class="course-left d-flex align-items-center gap-4 flex-grow-1">
                                    <div class="course-image rounded flex-shrink-0 shadow-sm" style="width: 100px; height: 75px; background: #cbd5e1; background-size: cover; background-position: center;"></div>
                                    <div class="flex-grow-1">
                                        <div class="course-title fw-bolder mb-1" style="font-size: 1.15rem; color: #0f172a; line-height: 1.3;">
                                            Inteligencia Artificial Aplicada
                                            a la Gestión Contable y Financiera
                                        </div>
                                        <div class="course-meta small text-muted d-flex gap-3 flex-wrap fw-bold">
                                            <span class="d-flex align-items-center gap-1">📅 Modalidad: En vivo</span>
                                            <span class="d-flex align-items-center gap-1">⏱️ Duración: 3 meses</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="price text-end flex-shrink-0 ms-sm-auto">
                                    <small class="d-block fw-bold text-muted text-uppercase" style="font-size: 0.5rem; margin-bottom: 2px;">Total a pagar</small>
                                    <h2 class="mb-0 fw-bolder" style="color: #dc2626; font-size: 1.25rem; line-height: 1;">S/ 2773.00</h2>
                                </div>
                            </div>

                            <div class="section-title">
                                Ingresa los datos de tu tarjeta
                            </div>

                            <div class="section-sub">
                                Usamos esta información para procesar tu pago y contactarte.
                            </div>

                            <div class="form-grid">
                                
                                <div class="input-group full">
                                    <label>Número de tarjeta</label>
                                    <div class="input-with-icon">
                                        <i class="fa fa-credit-card"></i>
                                        <input type="text" placeholder="1234 1234 1234 1234">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <label>Vencimiento</label>
                                    <div class="input-with-icon">
                                        <i class="fa fa-calendar"></i>
                                        <input type="text" placeholder="MM / AA">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <label>Código de seguridad</label>
                                    <div class="input-with-icon">
                                        <i class="fa fa-lock"></i>
                                        <input type="text" placeholder="CVV">
                                    </div>
                                </div>

                                <div class="input-group full">
                                    <label>Nombre del titular (como aparece en la tarjeta)</label>
                                    <div class="input-with-icon">
                                        <i class="fa fa-user"></i>
                                        <input type="text" placeholder="Nombre completo">
                                    </div>
                                </div>

                                <div class="input-group">
                                    <label>Documento de identidad</label>
                                    <div class="document-group">
                                        <select>
                                            <option value="1">DNI</option>
                                            <option value="6">RUC</option>
                                            <option value="4">C.E.</option>
                                            <option value="7">PASAPORTE</option>
                                        </select>
                                        <div class="input-with-icon flex-grow-1">
                                            <i class="fa fa-id-card-o"></i>
                                            <input type="text" placeholder="99999999">
                                        </div>
                                    </div>
                                </div>

                                <div class="input-group">
                                    <label>E-mail</label>
                                    <div class="input-with-icon">
                                        <i class="fa fa-envelope"></i>
                                        <input type="email" placeholder="ejemplo@email.com">
                                    </div>
                                </div>

                                <div class="input-group full">
                                    <label>Teléfono / WhatsApp</label>
                                    <div class="phone-group">
                                        <select id="checkout_phone_country_code">
                                            <option value="+51" data-code="pe">Perú (+51)</option>
                                            <option value="+52" data-code="mx">México (+52)</option>
                                            <option value="+57" data-code="co">Colombia (+57)</option>
                                        </select>
                                        <div class="input-with-icon flex-grow-1">
                                            <i class="fa fa-whatsapp"></i>
                                            <input type="text" placeholder="987 654 321">
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="info-boxes">

                                <div class="mini-box d-flex align-items-center gap-3">
                                    <div class="mini-box-icon">
                                        <i class="fa fa-shield"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="mini-box-title">Pago 100% seguro</span>
                                        <span class="mini-box-text">Tu información está <br> protegida</span>
                                    </div>
                                </div>

                                <div class="mini-box d-flex align-items-center">
                                    <div class="d-flex flex-column">
                                        <span class="mini-box-text" style="font-size: 0.7rem;">Con el respaldo de</span>
                                        <img src="{{ asset('img/mercadopago.png') }}" alt="Mercado Pago" class="mini-box-logo">
                                    </div>
                                </div>

                               
                                <div class="mini-box d-flex align-items-center gap-3">
                                    <div class="mini-box-icon">
                                        <i class="fab fa-whatsapp"></i>
                                    </div>
                                    <div class="d-flex flex-column">
                                        <span class="mini-box-title">Asistencia inmediata</span>
                                        <span class="mini-box-text">Te ayudamos en todo <br> el proceso.</span>
                                    </div>
                                </div>

                            </div>

                            <button class="shop-action-pay-red mt-4">
                                <i class="fa fa-lock me-2"></i> Pagar ahora
                            </button>

                            <div class="terms">
                                Al continuar, aceptas nuestros Términos y Condiciones.
                            </div>

                        </div>

                        <!-- RIGHT -->
                        <div class="card">

                            <div class="small-text">Paso 2 de 2</div>

                            <h1 class="title-pago">
                                Crea tu cuenta y elige tu comprobante
                            </h1>

                            <div class="success-box d-flex align-items-center gap-3">
                                <div class="success-icon-circle">
                                    <i class="fa fa-check"></i>
                                </div>
                                <div class="d-flex flex-column">
                                    <span class="success-title">¡Pago recibido con éxito!</span>
                                    <span class="success-text">Ahora solo falta crear tu cuenta y generar tu comprobante.</span>
                                </div>
                            </div>

                            <div class="section-title d-flex align-items-center gap-2">
                                <i class="fa fa-user text-primary"></i> 1. Crea tu cuenta
                            </div>

                            <div class="section-sub">
                                Usaremos estos datos para tu acceso al campus virtual.
                            </div>

                            {{-- Campos de control para el envío del formulario --}}
                            <input type="hidden" id="account_mode" value="create">
                            <input type="hidden" id="invoice_type" value="boleta">

                            <div class="account-box">
                                <div class="account-item">
                                    <div class="account-item-icon"><i class="fa fa-user"></i></div>
                                    <div class="account-item-info">
                                        <span class="account-label">Nombre completo</span>
                                        <span class="account-value">Mario López</span>
                                        <input type="text" id="create_names" class="edit-input-field d-none" value="Mario López">
                                    </div>
                                    <button type="button" class="btn-edit-inline" onclick="toggleEditField(this)">
                                        <i class="fa fa-pencil me-1"></i> Editar datos
                                    </button>
                                </div>

                                <div class="account-item">
                                    <div class="account-item-icon"><i class="fa fa-envelope"></i></div>
                                    <div class="account-item-info">
                                        <span class="account-label">E-mail</span>
                                        <span class="account-value">ejemplo@email.com</span>
                                        <input type="email" id="create_email" class="edit-input-field d-none" value="ejemplo@email.com">
                                    </div>
                                    <button type="button" class="btn-edit-inline" onclick="toggleEditField(this)">
                                        <i class="fa fa-pencil me-1"></i> Editar datos
                                    </button>
                                </div>

                                <div class="account-item">
                                    <div class="account-item-icon"><i class="fa fa-id-card"></i></div>
                                    <div class="account-item-info">
                                        <span class="account-label">DNI</span>
                                        <span class="account-value">99999999</span>
                                        <input type="text" id="create_dni" class="edit-input-field d-none" value="99999999">
                                    </div>
                                    <button type="button" class="btn-edit-inline" onclick="toggleEditField(this)">
                                        <i class="fa fa-pencil me-1"></i> Editar datos
                                    </button>
                                </div>

                            </div>
                            <br>

                            <div class="section-title d-flex align-items-center gap-2">
                                <i class="fa fa-file-text text-primary"></i> 2. Elige tu comprobante
                            </div>

                            <div class="section-sub">
                                Selecciona el tipo de comprobante que deseas.
                            </div>

                            <div class="voucher-grid">

                                <div class="voucher active" data-invoice-type="boleta" onclick="selectInvoiceType('boleta')">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h3 class="mb-1" style="font-size: 1rem;">📄 Boleta de venta</h3>
                                            <p class="mb-0 text-muted" style="font-size: 0.8rem;">Para personas naturales</p>
                                        </div>
                                        <div class="voucher-selector"></div>
                                    </div>
                                </div>

                                <div class="voucher" data-invoice-type="factura" onclick="selectInvoiceType('factura')">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <h3 class="mb-1" style="font-size: 1rem;">🧾 Factura</h3>
                                            <p class="mb-0 text-muted" style="font-size: 0.8rem;">Para empresas</p>
                                        </div>
                                        <div class="voucher-selector"></div>
                                    </div>
                                </div>

                            </div>
                            
                            {{-- Paneles de datos adicionales para el comprobante --}}
                            <div id="boleta-panel" class="d-none">
                                <input type="hidden" id="invoice_name">
                                <input type="hidden" id="invoice_dni">
                                <input type="hidden" id="invoice_email">
                            </div>

                            <div id="factura-panel" class="invoice-form-grid d-none mt-3">
                                <div class="checkout-field">
                                    <label class="small-text">RUC para la factura</label>
                                    <div class="input-with-icon">
                                        <i class="fa fa-building"></i>
                                        <input id="invoice_ruc" type="text" class="form-control" placeholder="Ingresa el RUC de tu empresa">
                                    </div>
                                </div>
                                <input type="hidden" id="invoice_business_name">
                                <input type="hidden" id="invoice_address">
                            </div>

                            <div class="notice">
                                <div class="notice-icon-stack">
                                    <i class="fa fa-shield"></i>
                                    <i class="fa fa-check" style="position: absolute; font-size: 0.6rem; color: #f1f5f9; margin-top: 1px;"></i>
                                </div>
                                <span>Al finalizar te enviaremos tu comprobante de pago por correo.</span>
                            </div>

                            <button type="button" id="btn-finalize" class="shop-action-pay-red mt-4">
                                <i class="fa fa-check-circle me-2"></i> Finalizar compra
                            </button>

                            <div class="secure">
                                🔒 Tu información está protegida y solo será utilizada para tu acceso al campus.
                            </div>

                        </div>

                    </div>
                </div>
            </div>
        </div>
        <x-footer />

    </div>


    
    











    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script>
        $(document).ready(function() {
            // Function to format the option with a flag
            function formatCountry(country) {
                if (!country.id) {
                    return country.text;
                }
                var code = $(country.element).data('code');
                if (!code) {
                    return country.text;
                }
                var $country = $(
                    '<span><img src="https://flagcdn.com/w20/' + code.toLowerCase() + '.png" class="select2-flag-img">' + country.text + '</span>'
                );
                return $country;
            };

            // Initialize Select2 for the new phone select
            $('#checkout_phone_country_code').select2({
                templateResult: formatCountry,
                templateSelection: formatCountry,
                minimumResultsForSearch: Infinity, // Hide search box for small lists
                theme: 'bootstrap-5',
                width: '140px'
            });

            // Initialize Select2 for the Mercado Pago phone select
            $('#payment_phone_country').select2({
                templateResult: formatCountry,
                templateSelection: formatCountry,
                minimumResultsForSearch: Infinity,
                theme: 'bootstrap-5',
                width: '140px'
            });
        });
    </script>
    <script>
        const csrfToken = "{{ csrf_token() }}";
        const routes = {
            items: "{{ route('onlineshop_get_item_carrito') }}",
            preference: "{{ route('web_cart_preference') }}",
            payment: "{{ route('web_cart_process_payment') }}",
            finalize: "{{ route('web_cart_finalize') }}",
            searchPerson: "{{ route('sales_search_person_apies') }}",
            description: "{{ url('curso-descripcion') }}"
        };
        const pendingPaidCartKey = 'pending_paid_cart_checkout';

        let cartIds = [];
        let cartItems = [];
        let checkoutTotal = 0;
        let preferenceId = null;
        let mercadoPublicKey = null;
        let paidSaleId = null;
        let paymentInitializing = false;
        let paymentVersion = 0;
        let freeCheckout = false;
        let lastCardholderName = '';
        let phoneGuardAttached = false;
        let accountLookupTimer = null;
        let invoiceLookupTimer = null;
        let lastAccountLookupKey = '';
        let lastInvoiceLookupKey = '';

        document.addEventListener('DOMContentLoaded', () => {
            loadCart();
            document.getElementById('btn-finalize').addEventListener('click', finalizeCheckout);
            attachInvoiceLookupEvents();

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
                    body: JSON.stringify({
                        ids: cartIds
                    })
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
                    } else if (restorePendingPaidCheckout()) {
                        return;
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
            updateFreeCheckoutView();
        }

        function renderEmptyCart() {
            resetPaymentState();
            document.getElementById('cart').innerHTML =
                '<tr><td colspan="4" class="px-4 py-5 text-center">No has elegido ningun curso.</td></tr>';
            document.getElementById('totalid').textContent = 'S/ 0.00';
            document.getElementById('cardPaymentBrick_container').innerHTML =
                '<div class="mp-loading-message p-4 text-center">Agrega cursos para cargar el pago.</div>';
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
            document.getElementById('cardPaymentBrick_container').innerHTML =
                '<div class="mp-loading-message p-4 text-center">Preparando pago seguro...</div>';

            requestJson(routes.preference, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        item_id: cartIds
                    })
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
            document.getElementById('cardPaymentBrick_container').innerHTML = `
                <div class="free-checkout-message">
                    <div class="free-checkout-icon">0</div>
                    <h3>Tus cursos son gratis</h3>
                    <p>El o los cursos que escogiste no requieren pago. Haz click en continuar para crear tu cuenta o iniciar sesion y registrarlos en tu dashboard.</p>
                    <button type="button" class="free-checkout-button" onclick="continueFreeCheckout()">Continuar</button>
                </div>
            `;
            updateFreeCheckoutView();
        }

        function continueFreeCheckout() {
            fillPayerData({});
            showStep('final');
        }

        async function renderMercadoPago(currentPaymentVersion) {
            const container = document.getElementById('cardPaymentBrick_container');
            container.innerHTML =
                '<div class="mp-loading-message p-4 text-center">Cargando formulario seguro de MercadoPago...</div>';

            if (!window.MercadoPago) {
                throw new Error(
                    'No se pudo cargar el SDK de MercadoPago. Revisa la conexion o bloqueadores del navegador.');
            }

            try {
                const mp = new MercadoPago(mercadoPublicKey, {
                    locale: 'es-PE'
                });
                const bricksBuilder = mp.bricks();

                const brickPromise = bricksBuilder.create('cardPayment', 'cardPaymentBrick_container', {
                    initialization: {
                        preferenceId,
                        amount: checkoutTotal,
                    },
                    customization: {
                        visual: {
                            style: {
                                customVariables: {
                                    theme: 'bootstrap'
                                }
                            }
                        },
                        paymentMethods: {
                            maxInstallments: 1
                        }
                    },
                    callbacks: {
                        onReady: () => {
                            container.querySelectorAll('.mp-loading-message').forEach(message => message
                                .remove());
                            attachMercadoPagoPhoneGuard();
                            hideAlert();
                        },
                        onSubmit: (cardFormData) => {
                            hideAlert();
                            cardFormData = normalizeCardFormData(cardFormData);
                            lastCardholderName = getCardholderName(cardFormData);

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
                                    const payer = data.payer || {};
                                    if (!payer.names && lastCardholderName) {
                                        payer.names = lastCardholderName;
                                    }
                                    savePendingPaidCheckout(data.sale_id, payer);
                                    fillPayerData(payer);
                                    showStep('final');
                                })
                                .catch(error => {
                                    const paymentWarning = paymentWarningFromMercadoPagoError(error
                                        .message);
                                    if (paymentWarning) {
                                        showPaymentWarningModal(paymentWarning);
                                    } else {
                                        showAlert(error.message);
                                    }
                                    throw error;
                                });
                        },
                        onError: (error) => {
                            console.log(error);
                            const paymentWarning = paymentWarningFromMercadoPagoError(error);
                            if (paymentWarning) {
                                showPaymentWarningModal(paymentWarning);
                            } else {
                                showAlert(
                                    'MercadoPago no pudo renderizar el formulario. Intenta recargar la pagina.'
                                );
                            }
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
            const phoneState = getPaymentPhoneState();
            const cardholderName = getCardholderName(cardFormData);
            payer.email = (payer.email || '').trim().toLowerCase();

            if (!isValidEmail(payer.email)) {
                throw new Error('Ingresa un correo valido en el formulario de MercadoPago.');
            }

            if (!phoneState.isComplete) {
                notifyPaymentPhoneRequired(phoneState, true);
                throw new Error('Ingresa tu codigo de pais y numero de telefono.');
            }

            payer.phone = {
                ...(payer.phone || {}),
                area_code: phoneState.areaCode,
                number: phoneState.phone
            };

            if (cardholderName) {
                const nameParts = cardholderName.split(/\s+/);
                payer.first_name = payer.first_name || nameParts.shift() || '';
                payer.last_name = payer.last_name || nameParts.join(' ');
                cardFormData.cardholderName = cardholderName;
            }

            cardFormData.payer = payer;
            return cardFormData;
        }

        function getCardholderName(cardFormData) {
            const possibleNames = [
                cardFormData.cardholderName,
                cardFormData.cardholder_name,
                cardFormData.cardholder?.name,
                cardFormData.cardholder?.cardholderName,
                cardFormData.payer?.names,
                `${cardFormData.payer?.first_name || ''} ${cardFormData.payer?.last_name || ''}`,
                getCardholderNameFromBrick()
            ];

            return (possibleNames.find(name => String(name || '').trim()) || '').trim();
        }

        function getCardholderNameFromBrick() {
            const container = document.getElementById('cardPaymentBrick_container');
            if (!container) {
                return '';
            }

            const inputs = Array.from(container.querySelectorAll('input'));
            const holderInput = inputs.find(input => {
                const attributes = [
                    input.id,
                    input.name,
                    input.getAttribute('aria-label'),
                    input.getAttribute('placeholder'),
                    input.closest('label')?.textContent,
                    input.parentElement?.textContent
                ].join(' ').toLowerCase();

                return attributes.includes('titular') ||
                    attributes.includes('cardholder') ||
                    attributes.includes('nombre') ||
                    attributes.includes('name');
            });

            return holderInput ? holderInput.value.trim() : '';
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
        }

        function selectAccountMode(mode) {
            document.getElementById('account_mode').value = mode;
            document.querySelectorAll('.account-tab').forEach(button => button.classList.toggle('active', button.dataset
                .accountMode === mode));
            document.getElementById('create-account-panel').classList.toggle('d-none', mode !== 'create');
            document.getElementById('login-account-panel').classList.toggle('d-none', mode !== 'login');
        }

        function selectInvoiceType(type) {
            document.getElementById('invoice_type').value = type;
            document.querySelectorAll('.invoice-tab').forEach(button => button.classList.toggle('active', button.dataset
                .invoiceType === type));
            document.getElementById('boleta-panel').classList.toggle('d-none', type !== 'boleta');
            document.getElementById('factura-panel').classList.toggle('d-none', type !== 'factura');

            if (type === 'boleta') {
                lookupInvoicePerson('boleta', value('invoice_dni'), false);
            } else {
                document.getElementById('invoice_ruc').focus();
                lookupInvoicePerson('factura', value('invoice_ruc'), false);
            }
        }

        function attachInvoiceLookupEvents() {
            const createDni = document.getElementById('create_dni');
            const invoiceDni = document.getElementById('invoice_dni');
            const invoiceRuc = document.getElementById('invoice_ruc');

            createDni.maxLength = 8;
            createDni.addEventListener('input', () => {
                createDni.value = onlyDigits(createDni.value).slice(0, 8);
                queueAccountLookup(createDni.value);
            });

            invoiceDni.maxLength = 8;
            invoiceDni.addEventListener('input', () => {
                invoiceDni.value = onlyDigits(invoiceDni.value).slice(0, 8);
                queueInvoiceLookup('boleta', invoiceDni.value);
            });

            invoiceRuc.maxLength = 11;
            invoiceRuc.addEventListener('input', () => {
                invoiceRuc.value = onlyDigits(invoiceRuc.value).slice(0, 11);
                queueInvoiceLookup('factura', invoiceRuc.value);
            });
        }

        function queueAccountLookup(number) {
            clearTimeout(accountLookupTimer);
            accountLookupTimer = setTimeout(() => lookupAccountPerson(number, true), 450);
        }

        function queueInvoiceLookup(type, number) {
            clearTimeout(invoiceLookupTimer);
            invoiceLookupTimer = setTimeout(() => lookupInvoicePerson(type, number, true), 450);
        }

        function lookupAccountPerson(number, showErrors = true) {
            const cleanNumber = onlyDigits(number);
            const lookupKey = `account:${cleanNumber}`;

            if (cleanNumber.length !== 8 || lookupKey === lastAccountLookupKey) {
                return;
            }

            lastAccountLookupKey = lookupKey;

            requestJson(routes.searchPerson, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        document_type: 1,
                        number: cleanNumber
                    })
                }, 15000)
                .then((data) => {
                    if (!data.success) {
                        throw new Error(data.error || 'No se encontraron datos para el documento ingresado.');
                    }

                    fillAccountPerson(data.person || {}, cleanNumber);
                })
                .catch(error => {
                    lastAccountLookupKey = '';
                    if (showErrors) {
                        showAlert(error.message);
                    }
                });
        }

        function lookupInvoicePerson(type, number, showErrors = true) {
            const cleanNumber = onlyDigits(number);
            const expectedLength = type === 'factura' ? 11 : 8;
            const lookupKey = `${type}:${cleanNumber}`;

            if (cleanNumber.length !== expectedLength || lookupKey === lastInvoiceLookupKey) {
                return;
            }

            lastInvoiceLookupKey = lookupKey;

            requestJson(routes.searchPerson, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: JSON.stringify({
                        document_type: type === 'factura' ? 6 : 1,
                        number: cleanNumber
                    })
                }, 15000)
                .then((data) => {
                    if (!data.success) {
                        throw new Error(data.error || 'No se encontraron datos para el documento ingresado.');
                    }

                    fillInvoicePerson(type, data.person || {}, cleanNumber);
                })
                .catch(error => {
                    lastInvoiceLookupKey = '';
                    if (showErrors) {
                        showAlert(error.message);
                    }
                });
        }

        function fillInvoicePerson(type, person, number) {
            hideAlert();

            if (type === 'factura') {
                document.getElementById('invoice_ruc').value = person.numero_documento || number;
                document.getElementById('invoice_business_name').value = person.razon_social || '';
                document.getElementById('invoice_address').value = person.direccion === '-' ? '' : (person.direccion || '');
                return;
            }

            const fullName = person.razon_social || [
                person.names,
                person.father_lastname,
                person.mother_lastname
            ].filter(Boolean).join(' ');
            const dni = person.document_number || number;

            document.getElementById('invoice_dni').value = dni;
            document.getElementById('invoice_name').value = fullName;
        }

        function fillAccountPerson(person, number) {
            hideAlert();

            const fullName = person.razon_social || [
                person.names,
                person.father_lastname,
                person.mother_lastname
            ].filter(Boolean).join(' ');

            document.getElementById('create_dni').value = person.document_number || number;
            document.getElementById('create_names').value = fullName;
        }

        function onlyDigits(value) {
            return String(value || '').replace(/\D/g, '');
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

                    clearPendingPaidCheckout();
                    localStorage.removeItem('carrito');
                    window.location.href = data.url;
                })
                .catch(error => {
                    if (error.conflictType === 'dni' || error.conflictType === 'email') {
                        showAccountConflictModal(error.message, error.conflictType);
                        return;
                    }

                    showAlert(error.message);
                })
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
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function hideAlert() {
            const alert = document.getElementById('checkout-alert');
            alert.textContent = '';
            alert.classList.add('d-none');
        }

        function showAccountConflictModal(message, conflictType) {
            const title = conflictType === 'email' ?
                'Este email ya esta registrado' :
                'Este numero de identificacion ya esta registrado';

            document.getElementById('account-conflict-title').textContent = title;
            document.getElementById('account-conflict-message').textContent = message;
            document.getElementById('account-conflict-modal').classList.remove('hidden');
        }

        function hideAccountConflictModal() {
            document.getElementById('account-conflict-modal').classList.add('hidden');
            document.getElementById('account-conflict-message').textContent = '';
        }

        function goToLoginFromConflictModal() {
            hideAccountConflictModal();
            selectAccountMode('login');
            document.getElementById('login_email').focus();
        }

        function showPaymentWarningModal(message) {
            document.getElementById('payment-warning-message').textContent = message;
            document.getElementById('payment-warning-modal').classList.remove('hidden');
        }

        function hidePaymentWarningModal() {
            document.getElementById('payment-warning-modal').classList.add('hidden');
            document.getElementById('payment-warning-message').textContent = '';
        }

        function attachMercadoPagoPhoneGuard() {
            const container = document.getElementById('cardPaymentBrick_container');

            if (phoneGuardAttached || !container) {
                return;
            }

            container.addEventListener('click', (event) => {
                if (freeCheckout) {
                    return;
                }

                const submitControl = event.target?.closest?.('button, [role="button"], input[type="submit"]');

                if (!submitControl) {
                    return;
                }

                const phoneState = getPaymentPhoneState();

                if (phoneState.isComplete) {
                    return;
                }

                event.preventDefault();
                event.stopPropagation();
                event.stopImmediatePropagation();
                notifyPaymentPhoneRequired(phoneState, false);
            }, true);

            phoneGuardAttached = true;
        }

        function getPaymentPhoneState() {
            const phoneCountry = document.getElementById('payment_phone_country');
            const phone = value('payment_phone');
            const areaCode = phoneCountry?.selectedOptions[0]?.dataset.areaCode || phoneCountry?.value.replace(/\D/g, '') ||
                '';

            return {
                areaCode,
                phone,
                isComplete: Boolean(areaCode && phone),
                focusTargetId: !areaCode ? 'payment_phone_country' : 'payment_phone'
            };
        }

        function notifyPaymentPhoneRequired(phoneState, reloadOnClose = false) {
            const phoneMessage = !phoneState.areaCode && !phoneState.phone ?
                'Por seguridad necesitamos validar tu telefono antes de procesar el pago. Selecciona el codigo de pais e ingresa tu numero de telefono para continuar con tranquilidad.' :
                (!phoneState.areaCode ?
                    'Por seguridad necesitamos que selecciones el codigo de pais de tu telefono antes de continuar con el pago.' :
                    'Por seguridad necesitamos que ingreses tu numero de telefono antes de continuar con el pago.');

            showPhoneRequiredModal(phoneMessage, phoneState.focusTargetId, reloadOnClose);
        }

        function showPhoneRequiredModal(message, focusTargetId = 'payment_phone_country', reloadOnClose = false) {
            const messageElement = document.getElementById('phone-required-message');
            messageElement.textContent = message ||
                'Para continuar con el pago necesitamos que selecciones el codigo de pais e ingreses tu numero de telefono. Esto nos ayuda a proteger tu compra y contactarte si hubiera algun inconveniente.';
            messageElement.dataset.focusTarget = focusTargetId;
            messageElement.dataset.reloadOnClose = reloadOnClose ? '1' : '0';
            document.getElementById('phone-required-modal').classList.remove('hidden');
        }

        function hidePhoneRequiredModal() {
            const messageElement = document.getElementById('phone-required-message');
            const focusTarget = document.getElementById(messageElement.dataset.focusTarget || 'payment_phone_country');
            const shouldReload = messageElement.dataset.reloadOnClose === '1';
            document.getElementById('phone-required-modal').classList.add('hidden');

            if (shouldReload) {
                window.location.reload();
                return;
            }

            if (focusTarget) {
                focusTarget.focus();
            }
        }

        function paymentWarningFromMercadoPagoError(error) {
            let detail = '';

            try {
                detail = typeof error === 'string' ? error : JSON.stringify(error || {});
            } catch (exception) {
                detail = String(error || '');
            }

            const normalized = detail.toLowerCase();

            if (normalized.includes('cc_rejected_insufficient_amount')) {
                return 'Tu Tarjeta no cuenta con saldo suficiente';
            }

            if (normalized.includes('cc_rejected_bad_filled_date')) {
                return 'Rechazado debido a un problema de fecha de vencimiento';
            }

            if (normalized.includes('cc_rejected_card_disabled')) {
                return 'Pago rechazado por Tarjeta Bloqueada/Apagada';
            }

            if (
                normalized.includes('cc_rejected_bad_filled_security_code') ||
                normalized.includes('cc_rejected_bad_filled_date') ||
                normalized.includes('expiration') ||
                normalized.includes('security_code') ||
                normalized.includes('cvv')
            ) {
                return 'Algun dato es erroneo en su tarjeta';
            }

            if (
                normalized.includes('cc_rejected_bad_filled_card_number') ||
                normalized.includes('invalid_card') ||
                normalized.includes('invalid card') ||
                normalized.includes('invalid_card_number') ||
                normalized.includes('invalid card_token_id')
            ) {
                return 'Tarjeta invalida';
            }

            return null;
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

        function savePendingPaidCheckout(saleId, payer) {
            localStorage.setItem(pendingPaidCartKey, JSON.stringify({
                sale_id: saleId,
                payer: payer || {},
                cart_ids: cartIds,
                total: checkoutTotal,
                saved_at: Date.now()
            }));
        }

        function getPendingPaidCheckout() {
            try {
                return JSON.parse(localStorage.getItem(pendingPaidCartKey)) || null;
            } catch (error) {
                clearPendingPaidCheckout();
                return null;
            }
        }

        function clearPendingPaidCheckout() {
            localStorage.removeItem(pendingPaidCartKey);
        }

        function restorePendingPaidCheckout() {
            const pending = getPendingPaidCheckout();

            if (!pending || !pending.sale_id || !Array.isArray(pending.cart_ids)) {
                return false;
            }

            const currentIds = cartIds.map(Number).sort((a, b) => a - b).join(',');
            const pendingIds = pending.cart_ids.map(Number).sort((a, b) => a - b).join(',');

            if (currentIds !== pendingIds) {
                clearPendingPaidCheckout();
                return false;
            }

            hideAlert();
            freeCheckout = false;
            paidSaleId = pending.sale_id;
            preferenceId = null;
            mercadoPublicKey = null;
            paymentInitializing = false;
            unmountMercadoPago();
            updateFreeCheckoutView();
            document.getElementById('cardPaymentBrick_container').innerHTML =
                '<div class="mp-loading-message p-4 text-center">Tu pago ya fue aprobado. Completa tu cuenta o inicia sesion para finalizar tu compra.</div>';
            fillPayerData(pending.payer || {});
            showStep('final');
            showPendingPaidModal();

            return true;
        }

        function showPendingPaidModal() {
            const coursesContainer = document.getElementById('pending-paid-courses');
            coursesContainer.innerHTML = cartItems.map(item => `
                <div class="pending-paid-course">
                    <div>
                        <strong>${item.name}</strong>
                        <small>${item.additional || 'Curso seleccionado'}</small>
                    </div>
                    <span class="pending-paid-course-price">${priceLabel(item.price)}</span>
                </div>
            `).join('');

            document.getElementById('pending-paid-modal').classList.remove('hidden');
        }

        function hidePendingPaidModal() {
            document.getElementById('pending-paid-modal').classList.add('hidden');
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
            document.getElementById('payment-step-text').textContent = 'Comprar';
            document.getElementById('account-title').textContent = freeCheckout ? 'Completa tus datos para acceder' :
                'Crea tu cuenta en menos de 30 segundos';
            document.getElementById('account-subtitle').textContent = freeCheckout ?
                'Crea una cuenta o inicia sesion para registrar el curso en tu dashboard.' :
                'Completa tus datos para asociar la compra y emitir el comprobante.';
            document.getElementById('invoice-block').classList.toggle('d-none', freeCheckout);
            document.getElementById('payment-phone-field').classList.toggle('d-none', freeCheckout);
            document.getElementById('btn-finalize-text').textContent = freeCheckout ? 'ACCEDER A TU CUENTA' :
                'FINALIZAR COMPRA';
        }

        function requestJson(url, options, timeoutMs) {
            const controller = new AbortController();
            const timer = setTimeout(() => controller.abort(), timeoutMs);
            const headers = {
                'Accept': 'application/json',
                ...(options.headers || {})
            };

            return fetch(url, {
                    ...options,
                    headers,
                    signal: controller.signal
                })
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
                        const requestError = new Error(data.error || data.message ||
                            'No se pudo completar la solicitud.');
                        requestError.conflictType = data.conflict_type || null;
                        throw requestError;
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
            return Number(value || 0) <= 0 ? 'Gratis' : `S/ ${money(value)}`;
        }

        // Refresh CSRF token after login/register
        function refreshCsrfToken() {
            fetch("{{ url('/get-csrf-token') }}", {
                    method: "GET",
                    headers: {
                        "X-Requested-With": "XMLHttpRequest"
                    }
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
                    body: JSON.stringify({
                        email: email
                    })
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
                        msgDiv.innerHTML =
                            '<span class="text-green-600">Correo enviado. Revisa tu bandeja de entrada.</span>';
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
    <script>
        function toggleEditField(btn) {
            const itemInfo = btn.closest('.account-item').querySelector('.account-item-info');
            const displayValue = itemInfo.querySelector('.account-value');
            const inputField = itemInfo.querySelector('.edit-input-field');
            
            if (inputField.classList.contains('d-none')) {
                displayValue.classList.add('d-none');
                inputField.classList.remove('d-none');
                inputField.focus();
                btn.innerHTML = '<i class="fa fa-save me-1"></i> Listo';
            } else {
                displayValue.textContent = inputField.value;
                displayValue.classList.remove('d-none');
                inputField.classList.add('d-none');
                btn.innerHTML = '<i class="fa fa-pencil me-1"></i> Editar';
            }
        }
    </script>
@stop
