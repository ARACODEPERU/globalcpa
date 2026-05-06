@extends('layouts.webpage')

@section('content')
    <script src="https://sdk.mercadopago.com/js/v2"></script>

    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
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

                    <div class="card p-4 mb-4 checkout-progress-card">
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
                                        <small>Al finalizar, obten tu certificado digital de CPA Academy.</small>
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

                            <div class="row g-4 align-items-start checkout-main-grid">
                            <div class="col-xl-7 col-lg-6">
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
                                    <div class="checkout-payment-header">
                                        <span>Metodo de pago</span>
                                        <h2 id="payment-card-title">Pago con tarjeta</h2>
                                    </div>
                                    <div class="checkout-total-row d-flex justify-content-between align-items-center mb-4">
                                        <span>Total</span>
                                        <strong id="totalid">S/ 0.00</strong>
                                    </div>
                                    <div class="mercadopago-shell">
                                        <div id="payment-phone-field" class="checkout-field mb-3">
                                            <label>Telefono</label>
                                            <div class="phone-input-group">
                                                <select id="payment_phone_country" aria-label="Codigo de pais">
                                                    <option value="" data-area-code="" selected>Selecciona codigo</option>
                                                    <option value="+51" data-area-code="51">Peru +51</option>
                                                    <option value="+54" data-area-code="54">Argentina +54</option>
                                                    <option value="+591" data-area-code="591">Bolivia +591</option>
                                                    <option value="+55" data-area-code="55">Brasil +55</option>
                                                    <option value="+56" data-area-code="56">Chile +56</option>
                                                    <option value="+57" data-area-code="57">Colombia +57</option>
                                                    <option value="+506" data-area-code="506">Costa Rica +506</option>
                                                    <option value="+53" data-area-code="53">Cuba +53</option>
                                                    <option value="+593" data-area-code="593">Ecuador +593</option>
                                                    <option value="+503" data-area-code="503">El Salvador +503</option>
                                                    <option value="+34" data-area-code="34">Espana +34</option>
                                                    <option value="+1" data-area-code="1">Estados Unidos +1</option>
                                                    <option value="+1" data-area-code="1">Canada +1</option>
                                                    <option value="+502" data-area-code="502">Guatemala +502</option>
                                                    <option value="+504" data-area-code="504">Honduras +504</option>
                                                    <option value="+52" data-area-code="52">Mexico +52</option>
                                                    <option value="+505" data-area-code="505">Nicaragua +505</option>
                                                    <option value="+507" data-area-code="507">Panama +507</option>
                                                    <option value="+595" data-area-code="595">Paraguay +595</option>
                                                    <option value="+1" data-area-code="1">Puerto Rico +1</option>
                                                    <option value="+1" data-area-code="1">Republica Dominicana +1</option>
                                                    <option value="+598" data-area-code="598">Uruguay +598</option>
                                                    <option value="+58" data-area-code="58">Venezuela +58</option>
                                                    <option value="+49" data-area-code="49">Alemania +49</option>
                                                    <option value="+376" data-area-code="376">Andorra +376</option>
                                                    <option value="+244" data-area-code="244">Angola +244</option>
                                                    <option value="+966" data-area-code="966">Arabia Saudita +966</option>
                                                    <option value="+213" data-area-code="213">Argelia +213</option>
                                                    <option value="+61" data-area-code="61">Australia +61</option>
                                                    <option value="+43" data-area-code="43">Austria +43</option>
                                                    <option value="+32" data-area-code="32">Belgica +32</option>
                                                    <option value="+501" data-area-code="501">Belice +501</option>
                                                    <option value="+229" data-area-code="229">Benin +229</option>
                                                    <option value="+359" data-area-code="359">Bulgaria +359</option>
                                                    <option value="+237" data-area-code="237">Camerun +237</option>
                                                    <option value="+86" data-area-code="86">China +86</option>
                                                    <option value="+357" data-area-code="357">Chipre +357</option>
                                                    <option value="+82" data-area-code="82">Corea del Sur +82</option>
                                                    <option value="+225" data-area-code="225">Costa de Marfil +225</option>
                                                    <option value="+385" data-area-code="385">Croacia +385</option>
                                                    <option value="+45" data-area-code="45">Dinamarca +45</option>
                                                    <option value="+971" data-area-code="971">Emiratos Arabes Unidos +971</option>
                                                    <option value="+421" data-area-code="421">Eslovaquia +421</option>
                                                    <option value="+386" data-area-code="386">Eslovenia +386</option>
                                                    <option value="+372" data-area-code="372">Estonia +372</option>
                                                    <option value="+63" data-area-code="63">Filipinas +63</option>
                                                    <option value="+358" data-area-code="358">Finlandia +358</option>
                                                    <option value="+33" data-area-code="33">Francia +33</option>
                                                    <option value="+30" data-area-code="30">Grecia +30</option>
                                                    <option value="+852" data-area-code="852">Hong Kong +852</option>
                                                    <option value="+36" data-area-code="36">Hungria +36</option>
                                                    <option value="+91" data-area-code="91">India +91</option>
                                                    <option value="+62" data-area-code="62">Indonesia +62</option>
                                                    <option value="+353" data-area-code="353">Irlanda +353</option>
                                                    <option value="+354" data-area-code="354">Islandia +354</option>
                                                    <option value="+972" data-area-code="972">Israel +972</option>
                                                    <option value="+39" data-area-code="39">Italia +39</option>
                                                    <option value="+81" data-area-code="81">Japon +81</option>
                                                    <option value="+371" data-area-code="371">Letonia +371</option>
                                                    <option value="+370" data-area-code="370">Lituania +370</option>
                                                    <option value="+352" data-area-code="352">Luxemburgo +352</option>
                                                    <option value="+60" data-area-code="60">Malasia +60</option>
                                                    <option value="+212" data-area-code="212">Marruecos +212</option>
                                                    <option value="+31" data-area-code="31">Paises Bajos +31</option>
                                                    <option value="+64" data-area-code="64">Nueva Zelanda +64</option>
                                                    <option value="+47" data-area-code="47">Noruega +47</option>
                                                    <option value="+48" data-area-code="48">Polonia +48</option>
                                                    <option value="+351" data-area-code="351">Portugal +351</option>
                                                    <option value="+44" data-area-code="44">Reino Unido +44</option>
                                                    <option value="+420" data-area-code="420">Republica Checa +420</option>
                                                    <option value="+40" data-area-code="40">Rumania +40</option>
                                                    <option value="+7" data-area-code="7">Rusia +7</option>
                                                    <option value="+65" data-area-code="65">Singapur +65</option>
                                                    <option value="+27" data-area-code="27">Sudafrica +27</option>
                                                    <option value="+46" data-area-code="46">Suecia +46</option>
                                                    <option value="+41" data-area-code="41">Suiza +41</option>
                                                    <option value="+66" data-area-code="66">Tailandia +66</option>
                                                    <option value="+90" data-area-code="90">Turquia +90</option>
                                                </select>
                                                <input id="payment_phone" type="tel" placeholder="Numero de telefono">
                                            </div>
                                        </div>
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
                                    <small id="create_dni_lookup_status" class="document-lookup-status"></small>
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
                                    <small id="invoice_dni_lookup_status" class="document-lookup-status"></small>
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
                                    <small id="invoice_ruc_lookup_status" class="document-lookup-status"></small>
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

                     <div id="payment-warning-modal" class="hidden payment-warning-backdrop fixed inset-0 flex items-center justify-center z-50">
                         <div class="payment-warning-dialog">
                             <div class="payment-warning-icon">!</div>
                             <h3>Pago no aprobado</h3>
                             <p id="payment-warning-message"></p>
                             <div class="payment-warning-actions">
                                 <button type="button" onclick="hidePaymentWarningModal()" class="payment-warning-button">Entendido</button>
                             </div>
                             <small class="payment-warning-note">*descuida tus datos estan protegidos y ningun cobro se ha realizado.</small>
                         </div>
                     </div>

                     <div id="phone-required-modal" class="hidden phone-required-backdrop fixed inset-0 flex items-center justify-center z-50">
                         <div class="phone-required-dialog">
                             <button type="button" onclick="hidePhoneRequiredModal()" class="phone-required-close" aria-label="Cerrar">x</button>
                             <div class="phone-required-icon">!</div>
                             <span class="phone-required-kicker">Dato requerido por seguridad</span>
                             <h3>Ingresa tu numero de telefono</h3>
                             <p id="phone-required-message">Para continuar con el pago necesitamos que selecciones el codigo de pais e ingreses tu numero de telefono. Esto nos ayuda a proteger tu compra y contactarte si hubiera algun inconveniente.</p>
                             <button type="button" onclick="hidePhoneRequiredModal()" class="phone-required-primary">Entendido</button>
                         </div>
                     </div>

                     <div id="account-conflict-modal" class="hidden account-conflict-backdrop fixed inset-0 flex items-center justify-center z-50">
                         <div class="account-conflict-dialog">
                             <button type="button" onclick="hideAccountConflictModal()" class="account-conflict-close" aria-label="Cerrar">x</button>
                             <div class="account-conflict-icon">!</div>
                             <span class="account-conflict-kicker">Tu compra esta protegida</span>
                             <h3 id="account-conflict-title">Revisemos tus datos</h3>
                             <p id="account-conflict-message"></p>
                             <div class="account-conflict-support">
                                 <a href="mailto:informes@globalcpaperu.com">informes@globalcpaperu.com</a>
                                 <a href="tel:+51967052506">+51 967052506</a>
                             </div>
                             <div class="account-conflict-actions">
                                 <button type="button" onclick="hideAccountConflictModal()" class="account-conflict-secondary">Cerrar</button>
                                 <button type="button" onclick="goToLoginFromConflictModal()" class="account-conflict-primary">Iniciar sesion</button>
                             </div>
                         </div>
                     </div>

                     <div id="pending-paid-modal" class="hidden pending-paid-backdrop fixed inset-0 flex items-center justify-center z-50">
                         <div class="pending-paid-dialog">
                             <button type="button" onclick="hidePendingPaidModal()" class="pending-paid-close" aria-label="Cerrar">x</button>
                             <div class="pending-paid-icon">✓</div>
                             <span class="pending-paid-kicker">Tu pago esta protegido</span>
                             <h3>Tus cursos estan esperando por ti</h3>
                             <p>Tranquilo, encontramos una compra aprobada por MercadoPago que aun falta finalizar. Completa el proceso creando tu cuenta o iniciando sesion para activar tus cursos.</p>
                             <div id="pending-paid-courses" class="pending-paid-courses"></div>
                             <button type="button" onclick="hidePendingPaidModal()" class="pending-paid-primary">Completar ahora</button>
                         </div>
                     </div>
                </div>
            </div>
        </div>
        <x-footer />
    </div>

    <style>
        .checkout-page-body {
            padding: 88px 0 64px;
            background: #f6f8fb;
        }

        .checkout-container {
            max-width: 1360px;
        }

        .checkout-page-heading {
            margin: 0 auto 18px;
            max-width: 1280px;
        }

        .checkout-page-heading span,
        .cart-table-header span,
        .checkout-payment-header span {
            display: block;
            margin-bottom: 5px;
            color: #dc2626;
            font-size: 12px;
            font-weight: 800;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .checkout-page-heading h1 {
            margin: 0;
            color: #0f172a;
            font-size: 30px;
            font-weight: 900;
            line-height: 1.15;
        }

        .checkout-page-heading p {
            margin: 8px 0 0;
            color: #64748b;
            font-size: 15px;
        }

        .checkout-progress-card,
        .cart-table-card,
        .checkout-payment-card,
        .account-shell {
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            box-shadow: 0 16px 40px rgba(15, 23, 42, 0.07);
        }

        .checkout-progress-card {
            background: #fff;
        }

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
            background: #e2e8f0;
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
            display: grid;
            grid-template-columns: repeat(5, minmax(0, 1fr));
            gap: 12px;
            margin-bottom: 22px;
        }

        .security-check-card {
            display: flex;
            align-items: center;
            gap: 12px;
            width: 100%;
            min-height: 96px;
            padding: 14px;
            background: #fff;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            color: #334155;
            text-decoration: none;
            box-shadow: 0 10px 24px rgba(15, 23, 42, 0.05);
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
            width: 116px;
            height: 54px;
        }

        .security-check-icon-svg {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            flex: 0 0 auto;
        }

        .security-check-icon-svg svg {
            width: 48px;
            height: 48px;
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

        .checkout-main-grid {
            align-items: flex-start;
        }

        .cart-table-card {
            overflow: hidden;
            background: #fff;
        }

        .cart-table-header {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 16px;
            padding: 22px 24px 16px;
            border-bottom: 1px solid #e2e8f0;
        }

        .cart-table-header h2,
        .checkout-payment-header h2 {
            margin: 0;
            color: #0f172a;
            font-size: 22px;
            font-weight: 900;
            line-height: 1.2;
        }

        .cart-table-header small {
            display: inline-flex;
            align-items: center;
            min-height: 34px;
            padding: 8px 12px;
            border-radius: 999px;
            background: #fef2f2;
            color: #b91c1c;
            font-size: 12px;
            font-weight: 800;
            white-space: nowrap;
        }

        .cart-table-card table {
            border-collapse: separate;
            border-spacing: 0;
        }

        .cart-table-card thead th {
            border-bottom: 1px solid #e2e8f0;
            background: #f8fafc !important;
            color: #475569 !important;
            font-size: 12px;
            letter-spacing: .03em;
        }

        .cart-table-card tbody tr {
            transition: background .18s ease;
        }

        .cart-table-card tbody tr:hover {
            background: #fff7f7;
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
            overflow: hidden;
            background: #fff;
        }

        .checkout-payment-card::before {
            content: "";
            display: block;
            height: 4px;
            margin: -24px -24px 20px;
            background: #dc2626;
        }

        .checkout-payment-header {
            margin-bottom: 14px;
        }

        .checkout-payment-header h2 {
            font-size: 24px;
        }

        .payment-warning-backdrop {
            padding: 20px;
            background: rgba(15, 23, 42, 0.72);
            backdrop-filter: blur(5px);
        }

        .payment-warning-dialog {
            width: min(430px, 100%);
            padding: 28px;
            border: 2px solid #fca5a5;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 24px 70px rgba(15, 23, 42, 0.34);
            text-align: center;
        }

        .payment-warning-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 68px;
            height: 68px;
            margin-bottom: 16px;
            border-radius: 50%;
            background: #dc2626;
            color: #fff;
            font-size: 42px;
            font-weight: 800;
            line-height: 1;
            box-shadow: 0 10px 24px rgba(220, 38, 38, 0.28);
        }

        .payment-warning-dialog h3 {
            margin: 0 0 10px;
            color: #991b1b;
            font-size: 22px;
            font-weight: 800;
        }

        .payment-warning-dialog p {
            margin: 0 0 22px;
            color: #334155;
            font-size: 16px;
            font-weight: 600;
        }

        .payment-warning-actions {
            display: flex;
            justify-content: center;
        }

        .payment-warning-button {
            min-width: 150px;
            padding: 11px 22px;
            border: 0;
            border-radius: 8px;
            background: #dc2626;
            color: #fff;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 10px 22px rgba(220, 38, 38, 0.22);
        }

        .payment-warning-button:hover {
            background: #b91c1c;
        }

        .payment-warning-note {
            display: block;
            margin-top: 16px;
            color: #64748b;
            font-size: 12px;
            line-height: 1.4;
        }

        .phone-required-backdrop {
            padding: 20px;
            background: rgba(15, 23, 42, 0.72);
            backdrop-filter: blur(5px);
        }

        .phone-required-dialog {
            position: relative;
            width: min(500px, 100%);
            padding: 34px;
            border: 2px solid #bfdbfe;
            border-top: 6px solid #2563eb;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 26px 80px rgba(15, 23, 42, 0.35);
            text-align: center;
        }

        .phone-required-close {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 34px;
            height: 34px;
            border: 0;
            border-radius: 50%;
            background: #eff6ff;
            color: #1d4ed8;
            font-weight: 800;
            cursor: pointer;
        }

        .phone-required-icon {
            display: inline-flex;
            width: 58px;
            height: 58px;
            margin-bottom: 14px;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            background: #dbeafe;
            color: #1d4ed8;
            font-size: 30px;
            font-weight: 900;
        }

        .phone-required-kicker {
            display: block;
            margin-bottom: 8px;
            color: #2563eb;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .phone-required-dialog h3 {
            margin: 0 28px 12px;
            color: #0f172a;
            font-size: 24px;
            font-weight: 800;
        }

        .phone-required-dialog p {
            margin: 0 0 24px;
            color: #334155;
            font-size: 16px;
            line-height: 1.7;
        }

        .phone-required-primary {
            width: 100%;
            border: 0;
            border-radius: 8px;
            padding: 13px 18px;
            background: #2563eb;
            color: #fff;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 12px 28px rgba(37, 99, 235, 0.24);
        }

        .account-conflict-backdrop {
            padding: 20px;
            background: rgba(15, 23, 42, 0.72);
            backdrop-filter: blur(5px);
        }

        .account-conflict-dialog {
            position: relative;
            width: min(540px, 100%);
            padding: 34px;
            border: 2px solid #fecaca;
            border-top: 6px solid #dc2626;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 28px 76px rgba(15, 23, 42, 0.36);
            text-align: center;
        }

        .account-conflict-close {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 32px;
            height: 32px;
            border: 0;
            border-radius: 50%;
            background: #f1f5f9;
            color: #475569;
            font-size: 20px;
            line-height: 1;
            cursor: pointer;
        }

        .account-conflict-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 68px;
            height: 68px;
            margin-bottom: 16px;
            border-radius: 50%;
            background: #dc2626;
            color: #fff;
            font-size: 36px;
            font-weight: 900;
            box-shadow: 0 0 0 9px #fee2e2;
        }

        .account-conflict-kicker {
            display: block;
            margin-bottom: 8px;
            color: #15803d;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .account-conflict-dialog h3 {
            margin: 0 28px 12px;
            color: #0f172a;
            font-size: 24px;
            font-weight: 800;
        }

        .account-conflict-dialog p {
            margin: 0;
            color: #334155;
            font-size: 16px;
            line-height: 1.7;
        }

        .account-conflict-support {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 10px;
            margin-top: 20px;
        }

        .account-conflict-support a {
            display: inline-flex;
            align-items: center;
            min-height: 36px;
            padding: 8px 12px;
            border: 1px solid #fecaca;
            border-radius: 8px;
            background: #fff7f7;
            color: #b91c1c;
            font-size: 14px;
            font-weight: 800;
        }

        .account-conflict-actions {
            display: grid;
            grid-template-columns: minmax(0, 1fr) minmax(0, 1.35fr);
            gap: 12px;
            margin-top: 24px;
        }

        .account-conflict-secondary,
        .account-conflict-primary {
            min-height: 46px;
            border-radius: 8px;
            font-weight: 800;
            cursor: pointer;
        }

        .account-conflict-secondary {
            border: 1px solid #cbd5e1;
            background: #fff;
            color: #334155;
        }

        .account-conflict-primary {
            border: 0;
            background: #dc2626;
            color: #fff;
        }

        .account-conflict-primary:hover {
            background: #b91c1c;
        }

        .pending-paid-backdrop {
            padding: 20px;
            background: rgba(15, 23, 42, 0.72);
            backdrop-filter: blur(5px);
        }

        .pending-paid-dialog {
            position: relative;
            width: min(620px, 100%);
            max-height: calc(100vh - 40px);
            overflow-y: auto;
            padding: 34px;
            border: 2px solid #bbf7d0;
            border-top: 6px solid #16a34a;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 28px 76px rgba(15, 23, 42, 0.36);
            text-align: center;
        }

        .pending-paid-close {
            position: absolute;
            top: 14px;
            right: 14px;
            width: 32px;
            height: 32px;
            border: 0;
            border-radius: 50%;
            background: #f1f5f9;
            color: #475569;
            font-size: 20px;
            line-height: 1;
            cursor: pointer;
        }

        .pending-paid-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 68px;
            height: 68px;
            margin-bottom: 16px;
            border-radius: 50%;
            background: #16a34a;
            color: #fff;
            font-size: 34px;
            font-weight: 900;
            box-shadow: 0 0 0 9px #dcfce7;
        }

        .pending-paid-kicker {
            display: block;
            margin-bottom: 8px;
            color: #15803d;
            font-size: 13px;
            font-weight: 800;
            letter-spacing: .04em;
            text-transform: uppercase;
        }

        .pending-paid-dialog h3 {
            margin: 0 28px 12px;
            color: #0f172a;
            font-size: 24px;
            font-weight: 900;
        }

        .pending-paid-dialog p {
            margin: 0 auto;
            max-width: 500px;
            color: #334155;
            font-size: 15px;
            line-height: 1.7;
        }

        .pending-paid-courses {
            display: grid;
            gap: 10px;
            margin-top: 22px;
            text-align: left;
        }

        .pending-paid-course {
            display: grid;
            grid-template-columns: minmax(0, 1fr) auto;
            gap: 12px;
            align-items: center;
            padding: 12px 14px;
            border: 1px solid #e2e8f0;
            border-radius: 8px;
            background: #f8fafc;
        }

        .pending-paid-course strong {
            display: block;
            color: #0f172a;
            font-size: 14px;
            line-height: 1.35;
        }

        .pending-paid-course small {
            display: block;
            margin-top: 3px;
            color: #64748b;
            font-size: 12px;
        }

        .pending-paid-course-price {
            color: #16a34a;
            font-size: 13px;
            font-weight: 900;
            white-space: nowrap;
        }

        .pending-paid-primary {
            width: 100%;
            min-height: 46px;
            margin-top: 24px;
            border: 0;
            border-radius: 8px;
            background: #dc2626;
            color: #fff;
            font-weight: 900;
            cursor: pointer;
            box-shadow: 0 10px 22px rgba(220, 38, 38, 0.22);
        }

        .pending-paid-primary:hover {
            background: #b91c1c;
        }

        .mercadopago-shell {
            max-width: 480px;
            margin: 0 auto;
        }

        .checkout-total-row {
            padding: 16px;
            border: 1px solid #fecaca;
            border-radius: 8px;
            background: #fff7f7;
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
            padding: 30px;
            background: #fff;
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

        .document-lookup-status {
            display: block;
            min-height: 17px;
            margin-top: 6px;
            color: #64748b;
            font-size: 12px;
            font-weight: 700;
            line-height: 1.35;
        }

        .document-lookup-status.success {
            color: #15803d;
        }

        .document-lookup-status.error {
            color: #b91c1c;
        }

        .phone-input-group {
            display: grid;
            grid-template-columns: minmax(142px, 170px) minmax(0, 1fr);
            gap: 8px;
        }

        .phone-input-group select {
            width: 100%;
            height: 44px;
            padding: 10px 10px;
            border: 1px solid #cbd5e1;
            border-radius: 8px;
            background: #fff;
            color: #0f172a;
            outline: none;
            font-weight: 700;
        }

        .phone-input-group select:focus {
            border-color: #0f766e;
            box-shadow: 0 0 0 3px rgba(15, 118, 110, 0.12);
        }

        .free-checkout-message {
            padding: 24px;
            border: 1px solid #bbf7d0;
            border-radius: 8px;
            background: #f0fdf4;
            text-align: center;
        }

        .free-checkout-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 58px;
            height: 58px;
            margin-bottom: 14px;
            border-radius: 50%;
            background: #16a34a;
            color: #fff;
            font-size: 30px;
            font-weight: 900;
            box-shadow: 0 0 0 8px #dcfce7;
        }

        .free-checkout-message h3 {
            margin: 0 0 8px;
            color: #14532d;
            font-size: 21px;
            font-weight: 900;
        }

        .free-checkout-message p {
            margin: 0 auto 18px;
            max-width: 360px;
            color: #166534;
            font-size: 14px;
            line-height: 1.6;
        }

        .free-checkout-button {
            min-height: 44px;
            padding: 11px 22px;
            border: 0;
            border-radius: 8px;
            background: #dc2626;
            color: #fff;
            font-weight: 800;
            cursor: pointer;
            box-shadow: 0 10px 22px rgba(220, 38, 38, 0.22);
        }

        .free-checkout-button:hover {
            background: #b91c1c;
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

        @media (max-width: 1199px) {
            .security-check-grid {
                grid-template-columns: repeat(3, minmax(0, 1fr));
            }

            .checkout-payment-card {
                position: static;
            }
        }

        @media (max-width: 768px) {
            .checkout-page-body {
                padding-top: 76px;
            }

            .checkout-page-heading h1 {
                font-size: 25px;
            }

            .checkout-page-heading p {
                font-size: 14px;
            }

            .checkout-steps {
                gap: 48px;
                max-width: 420px;
            }

            .checkout-steps::before {
                left: 64px;
                right: 64px;
            }

            .security-check-grid {
                grid-template-columns: repeat(2, minmax(0, 1fr));
            }

            .security-check-card {
                min-height: 88px;
            }

            .cart-table-header {
                align-items: flex-start;
                flex-direction: column;
                padding: 20px;
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

            .phone-input-group {
                grid-template-columns: 1fr;
            }

            .account-conflict-dialog {
                padding: 28px 20px;
            }

            .phone-required-dialog {
                padding: 28px 20px;
            }

            .account-conflict-actions {
                grid-template-columns: 1fr;
            }

            .pending-paid-dialog {
                padding: 28px 20px;
            }

            .pending-paid-course {
                grid-template-columns: 1fr;
            }
        }

        @media (max-width: 575px) {
            .checkout-container {
                padding-left: 14px;
                padding-right: 14px;
            }

            .checkout-progress-card {
                padding: 18px !important;
            }

            .checkout-steps {
                gap: 24px;
            }

            .checkout-steps::before {
                left: 56px;
                right: 56px;
            }

            .checkout-step {
                width: 112px;
            }

            .checkout-step-number {
                width: 42px;
                height: 42px;
                font-size: 16px;
            }

            .security-check-grid {
                grid-template-columns: 1fr;
            }

            .checkout-payment-card {
                padding: 20px !important;
            }

            .checkout-payment-card::before {
                margin: -20px -20px 18px;
            }

            .checkout-total-row {
                align-items: flex-start !important;
                flex-direction: column;
                gap: 6px;
            }

            .invoice-actions {
                justify-content: stretch;
            }

            .invoice-actions .boton-degradado-courses {
                width: 100%;
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
            documentLookup: "{{ route('web_cart_document_lookup') }}",
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
        let documentLookupTimers = {};
        let documentLookupCache = {};

        document.addEventListener('DOMContentLoaded', () => {
            loadCart();
            document.getElementById('btn-finalize').addEventListener('click', finalizeCheckout);

            document.querySelectorAll('.account-tab').forEach(button => {
                button.addEventListener('click', () => selectAccountMode(button.dataset.accountMode));
            });

            document.querySelectorAll('.invoice-tab').forEach(button => {
                button.addEventListener('click', () => selectInvoiceType(button.dataset.invoiceType));
            });

            attachDocumentLookupHandlers();
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
            document.getElementById('cart').innerHTML = '<tr><td colspan="4" class="px-4 py-5 text-center">No has elegido ningun curso.</td></tr>';
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
                                    const paymentWarning = paymentWarningFromMercadoPagoError(error.message);
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
                                showAlert('MercadoPago no pudo renderizar el formulario. Intenta recargar la pagina.');
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

        function attachDocumentLookupHandlers() {
            bindDocumentLookup('create_dni', 1, 8, (person) => {
                const fullName = person.razon_social || [person.names, person.father_lastname, person.mother_lastname].filter(Boolean).join(' ');

                if (fullName) {
                    document.getElementById('create_names').value = fullName;

                    if (!value('invoice_name') || value('invoice_dni') === value('create_dni')) {
                        document.getElementById('invoice_name').value = fullName;
                    }
                }

                if (!value('invoice_dni')) {
                    document.getElementById('invoice_dni').value = value('create_dni');
                }
            });

            bindDocumentLookup('invoice_dni', 1, 8, (person) => {
                const fullName = person.razon_social || [person.names, person.father_lastname, person.mother_lastname].filter(Boolean).join(' ');

                if (fullName) {
                    document.getElementById('invoice_name').value = fullName;
                }
            });

            bindDocumentLookup('invoice_ruc', 6, 11, (person) => {
                document.getElementById('invoice_business_name').value = person.razon_social || '';
                document.getElementById('invoice_address').value = person.direccion || '';
            });
        }

        function bindDocumentLookup(inputId, documentType, expectedLength, onSuccess) {
            const input = document.getElementById(inputId);

            if (!input) {
                return;
            }

            input.addEventListener('input', () => {
                input.value = input.value.replace(/\D/g, '').slice(0, expectedLength);
                scheduleDocumentLookup(inputId, documentType, expectedLength, onSuccess);
            });

            input.addEventListener('blur', () => lookupDocumentFromInput(inputId, documentType, expectedLength, onSuccess));
        }

        function scheduleDocumentLookup(inputId, documentType, expectedLength, onSuccess) {
            clearTimeout(documentLookupTimers[inputId]);
            documentLookupTimers[inputId] = setTimeout(() => {
                lookupDocumentFromInput(inputId, documentType, expectedLength, onSuccess);
            }, 550);
        }

        function lookupDocumentFromInput(inputId, documentType, expectedLength, onSuccess) {
            const number = value(inputId).replace(/\D/g, '');
            const statusId = `${inputId}_lookup_status`;

            if (number.length === 0) {
                setDocumentLookupStatus(statusId, '');
                return;
            }

            if (number.length !== expectedLength) {
                setDocumentLookupStatus(statusId, documentType === 6 ? 'Ingresa un RUC valido de 11 digitos.' : 'Ingresa un DNI valido de 8 digitos.', 'error');
                return;
            }

            const cacheKey = `${documentType}:${number}`;

            if (documentLookupCache[cacheKey]) {
                onSuccess(documentLookupCache[cacheKey]);
                setDocumentLookupStatus(statusId, 'Datos encontrados correctamente.', 'success');
                return;
            }

            setDocumentLookupStatus(statusId, 'Consultando datos...');

            requestJson(routes.documentLookup, {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken
                },
                body: JSON.stringify({
                    document_type: documentType,
                    number
                })
            }, 10000)
                .then((data) => {
                    if (!data.success || !data.person) {
                        throw new Error(data.error || 'No encontramos datos para ese documento.');
                    }

                    documentLookupCache[cacheKey] = data.person;
                    onSuccess(data.person);
                    setDocumentLookupStatus(statusId, 'Datos encontrados correctamente.', 'success');
                })
                .catch((error) => {
                    setDocumentLookupStatus(statusId, error.message || 'No pudimos consultar el documento en este momento.', 'error');
                });
        }

        function setDocumentLookupStatus(statusId, message, type = '') {
            const status = document.getElementById(statusId);

            if (!status) {
                return;
            }

            status.textContent = message;
            status.classList.toggle('success', type === 'success');
            status.classList.toggle('error', type === 'error');
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
            window.scrollTo({ top: 0, behavior: 'smooth' });
        }

        function hideAlert() {
            const alert = document.getElementById('checkout-alert');
            alert.textContent = '';
            alert.classList.add('d-none');
        }

        function showAccountConflictModal(message, conflictType) {
            const title = conflictType === 'email'
                ? 'Este email ya esta registrado'
                : 'Este numero de identificacion ya esta registrado';

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
            const areaCode = phoneCountry?.selectedOptions[0]?.dataset.areaCode || phoneCountry?.value.replace(/\D/g, '') || '';

            return {
                areaCode,
                phone,
                isComplete: Boolean(areaCode && phone),
                focusTargetId: !areaCode ? 'payment_phone_country' : 'payment_phone'
            };
        }

        function notifyPaymentPhoneRequired(phoneState, reloadOnClose = false) {
            const phoneMessage = !phoneState.areaCode && !phoneState.phone
                ? 'Por seguridad necesitamos validar tu telefono antes de procesar el pago. Selecciona el codigo de pais e ingresa tu numero de telefono para continuar con tranquilidad.'
                : (!phoneState.areaCode
                    ? 'Por seguridad necesitamos que selecciones el codigo de pais de tu telefono antes de continuar con el pago.'
                    : 'Por seguridad necesitamos que ingreses tu numero de telefono antes de continuar con el pago.');

            showPhoneRequiredModal(phoneMessage, phoneState.focusTargetId, reloadOnClose);
        }

        function showPhoneRequiredModal(message, focusTargetId = 'payment_phone_country', reloadOnClose = false) {
            const messageElement = document.getElementById('phone-required-message');
            messageElement.textContent = message || 'Para continuar con el pago necesitamos que selecciones el codigo de pais e ingreses tu numero de telefono. Esto nos ayuda a proteger tu compra y contactarte si hubiera algun inconveniente.';
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
            document.getElementById('cardPaymentBrick_container').innerHTML = '<div class="mp-loading-message p-4 text-center">Tu pago ya fue aprobado. Completa tu cuenta o inicia sesion para finalizar tu compra.</div>';
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
            document.getElementById('payment-step-text').textContent = freeCheckout ? 'Carrito gratis' : 'Carrito y pago';
            document.getElementById('payment-card-title').textContent = freeCheckout ? 'Cursos gratuitos' : 'Pago con tarjeta';
            document.getElementById('account-title').textContent = freeCheckout ? 'Completa tus datos para acceder' : 'Crea tu cuenta en menos de 30 segundos';
            document.getElementById('account-subtitle').textContent = freeCheckout
                ? 'Crea una cuenta o inicia sesion para registrar el curso en tu dashboard.'
                : 'Completa tus datos para asociar la compra y emitir el comprobante.';
            document.getElementById('invoice-block').classList.toggle('d-none', freeCheckout);
            document.getElementById('payment-phone-field').classList.toggle('d-none', freeCheckout);
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
                        const requestError = new Error(data.error || data.message || 'No se pudo completar la solicitud.');
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
