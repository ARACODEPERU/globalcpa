const fs = require('fs');
const path = require('path');

const filePath = path.resolve('resources/views/pages/shop-cart.blade.php');
let content = fs.readFileSync(filePath, 'utf8');

// ============================================================
// 1. Replace renderMercadoPago + withTimeout functions
// ============================================================
const oldRenderBlock = `        async function renderMercadoPago(currentPaymentVersion) {
            const container = document.getElementById('cardPaymentBrick_container');
            parkPaymentPhoneField();
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
                                customVariables: {
                                    theme: 'bootstrap',
                                    baseColor: '#dc2626',
                                    baseColorFirstVariant: '#b91c1c',
                                    baseColorSecondVariant: '#991b1b',
                                    buttonTextColor: '#ffffff',
                                    outlinePrimaryColor: '#dc2626',
                                }
                            }
                        },
                        paymentMethods: { maxInstallments: 12 }
                    },
                    callbacks: {
                        onReady: () => {
                            container.querySelectorAll('.mp-loading-message').forEach(message => message.remove());
                            parkPaymentPhoneField();
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
        }`;

const newRenderBlock = `        async function renderMercadoPago(currentPaymentVersion) {
            const container = document.getElementById('cardPaymentBrick_container');
            parkPaymentPhoneField();
            container.innerHTML = '<div class="mp-loading-message p-4 text-center">Cargando formulario seguro de MercadoPago...</div>';

            if (!window.MercadoPago) {
                throw new Error('No se pudo cargar el SDK de MercadoPago. Revisa la conexion o bloqueadores del navegador.');
            }

            try {
                const mp = new MercadoPago(mercadoPublicKey, { locale: 'es-PE' });

                // Renderizar formulario personalizado
                container.innerHTML = buildCustomCardFormHTML();

                // Configurar eventos del formulario
                setupCardNumberInput(mp);
                setupExpiryInput();
                setupCvvInput();

                // Actualizar total
                document.getElementById('mp-custom-total').textContent = money(checkoutTotal);

                // Manejar submit
                document.getElementById('mp-custom-submit').addEventListener('click', async function(e) {
                    if (currentPaymentVersion !== paymentVersion) return;

                    hideAlert();

                    // Validar teléfono
                    const phoneState = getPaymentPhoneState();
                    if (!phoneState.isComplete) {
                        notifyPaymentPhoneRequired(phoneState, true);
                        return;
                    }

                    // Validar email
                    const email = document.getElementById('mp-payer-email').value.trim().toLowerCase();
                    if (!isValidEmail(email)) {
                        showAlert('Ingresa un correo válido en el formulario de MercadoPago.');
                        return;
                    }

                    // Validar campos de tarjeta
                    const cardNumber = document.getElementById('mp-card-number').value.replace(/\\D/g, '');
                    const expiryRaw = document.getElementById('mp-card-expiry').value.replace(/\\D/g, '');
                    const cvv = document.getElementById('mp-card-cvv').value;
                    const cardholderName = document.getElementById('mp-card-holder').value.trim();

                    if (cardNumber.length < 13 || cardNumber.length > 19) {
                        showAlert('Ingresa un número de tarjeta válido.');
                        return;
                    }
                    if (expiryRaw.length < 4) {
                        showAlert('Ingresa una fecha de vencimiento válida.');
                        return;
                    }
                    if (!cvv || cvv.length < 3) {
                        showAlert('Ingresa el código de seguridad (CVV) de tu tarjeta.');
                        return;
                    }
                    if (!cardholderName) {
                        showAlert('Ingresa el nombre del titular de la tarjeta.');
                        return;
                    }

                    const installments = document.getElementById('mp-installments').value || '1';
                    const expMonth = expiryRaw.substring(0, 2);
                    const expYear = expiryRaw.substring(2, 4);

                    setBusy('mp-custom-submit', true);

                    try {
                        // Crear token de tarjeta con el SDK de MercadoPago
                        const tokenData = await mp.createCardToken({
                            cardNumber: cardNumber,
                            cardExpirationMonth: expMonth,
                            cardExpirationYear: '20' + expYear,
                            securityCode: cvv,
                            cardholderName: cardholderName
                        });

                        const phoneState = getPaymentPhoneState();
                        const cardFormData = {
                            token: tokenData.id,
                            issuer_id: null,
                            payment_method_id: tokenData.payment_method_id,
                            transaction_amount: checkoutTotal,
                            installments: parseInt(installments) || 1,
                            payer: {
                                email: email,
                                first_name: cardholderName.split(' ')[0] || '',
                                last_name: cardholderName.split(' ').slice(1).join(' ') || '',
                                identification: {
                                    type: tokenData.cardholder?.identification?.type || '',
                                    number: tokenData.cardholder?.identification?.number || ''
                                },
                                phone: {
                                    area_code: phoneState.areaCode,
                                    number: phoneState.phone
                                }
                            },
                            cardholderName: cardholderName
                        };

                        lastCardholderName = cardholderName;

                        const data = await requestJson(routes.payment, {
                            method: 'PUT',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': csrfToken
                            },
                            body: JSON.stringify({
                                item_id: cartIds,
                                cardFormData
                            })
                        }, 30000);

                        paidSaleId = data.sale_id;
                        const payer = data.payer || {};
                        if (!payer.names && cardholderName) {
                            payer.names = cardholderName;
                        }
                        if (!payer.email && email) {
                            payer.email = email;
                        }
                        savePendingPaidCheckout(data.sale_id, payer);
                        fillPayerData(payer);
                        showStep('final');
                    } catch (error) {
                        const paymentWarning = paymentWarningFromMercadoPagoError(error.message || error);
                        if (paymentWarning) {
                            showPaymentWarningModal(paymentWarning);
                        } else {
                            showAlert(error.message || 'Error al procesar el pago.');
                        }
                    } finally {
                        setBusy('mp-custom-submit', false);
                    }
                });

                if (currentPaymentVersion !== paymentVersion) return;

                container.querySelectorAll('.mp-loading-message').forEach(msg => msg.remove());
                parkPaymentPhoneField();
                attachMercadoPagoPhoneGuard();
                hideAlert();

            } catch (error) {
                container.innerHTML = '';
                throw error;
            }
        }

        function buildCustomCardFormHTML() {
            return \`
                <div class="custom-mp-form">
                    <div class="checkout-field">
                        <label>Número de tarjeta</label>
                        <input id="mp-card-number" type="text" inputmode="numeric" placeholder="0000 0000 0000 0000" maxlength="19" class="checkout-input" autocomplete="cc-number">
                    </div>
                    <div class="form-row" style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                        <div class="checkout-field">
                            <label>Vencimiento</label>
                            <input id="mp-card-expiry" type="text" placeholder="MM / AA" maxlength="7" class="checkout-input" autocomplete="cc-exp">
                        </div>
                        <div class="checkout-field">
                            <label>CVV</label>
                            <input id="mp-card-cvv" type="text" inputmode="numeric" placeholder="123" maxlength="4" class="checkout-input" autocomplete="cc-csc">
                        </div>
                    </div>
                    <div class="checkout-field">
                        <label>Nombre del titular</label>
                        <input id="mp-card-holder" type="text" placeholder="Como aparece en la tarjeta" class="checkout-input" autocomplete="cc-name">
                    </div>
                    <div class="checkout-field" id="mp-installments-field" style="display:none;">
                        <label>Cuotas</label>
                        <select id="mp-installments" class="checkout-select">
                            <option value="1">1 cuota</option>
                        </select>
                    </div>
                    <div class="checkout-field">
                        <label>Email</label>
                        <input id="mp-payer-email" type="email" placeholder="correo@dominio.com" class="checkout-input" autocomplete="email">
                    </div>
                    <button type="button" id="mp-custom-submit" class="boton-degradado-courses" style="width:100%;margin-top:8px;display:flex;align-items:center;justify-content:center;gap:8px;">
                        <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                            <rect x="1" y="4" width="22" height="16" rx="2" ry="2"/>
                            <line x1="1" y1="10" x2="23" y2="10"/>
                        </svg>
                        <b>PAGAR S/ <span id="mp-custom-total">0.00</span></b>
                    </button>
                </div>
            \`;
        }

        function setupCardNumberInput(mp) {
            const input = document.getElementById('mp-card-number');
            if (!input) return;
            let installmentsTimer = null;
            input.addEventListener('input', function() {
                let value = this.value.replace(/\\D/g, '').substring(0, 16);
                this.value = value.replace(/(\\d{4})(?=\\d)/g, '$1 ');

                const bin = value.substring(0, 6);
                if (bin.length >= 6) {
                    clearTimeout(installmentsTimer);
                    installmentsTimer = setTimeout(() => {
                        fetchInstallments(mp, bin, checkoutTotal);
                    }, 400);
                }
            });
        }

        function setupExpiryInput() {
            const input = document.getElementById('mp-card-expiry');
            if (!input) return;
            input.addEventListener('input', function() {
                let value = this.value.replace(/\\D/g, '').substring(0, 4);
                if (value.length >= 2) {
                    value = value.substring(0, 2) + ' / ' + value.substring(2);
                }
                this.value = value;
            });
        }

        function setupCvvInput() {
            const input = document.getElementById('mp-card-cvv');
            if (!input) return;
            input.addEventListener('input', function() {
                this.value = this.value.replace(/\\D/g, '').substring(0, 4);
            });
        }

        function fetchInstallments(mp, bin, amount) {
            const field = document.getElementById('mp-installments-field');
            const select = document.getElementById('mp-installments');
            if (!field || !select) return;

            select.innerHTML = '<option value="">Cargando cuotas...</option>';
            select.disabled = true;
            field.style.display = 'block';

            mp.getInstallments({
                bin: bin,
                amount: amount
            }).then(function(data) {
                select.innerHTML = '';
                if (data && data.length > 0 && data[0].payer_costs && data[0].payer_costs.length > 0) {
                    const payerCosts = data[0].payer_costs;
                    payerCosts.forEach(function(cost) {
                        const option = document.createElement('option');
                        option.value = cost.installments;
                        const installmentAmount = (cost.installment_amount || (amount / cost.installments)).toFixed(2);
                        let label = cost.installments + ' cuota' + (cost.installments > 1 ? 's' : '') + ' de S/ ' + installmentAmount;
                        if (cost.installments > 1 && cost.interest_rate > 0) {
                            label += ' (con intereses)';
                        } else if (cost.installments > 1) {
                            label += ' (sin intereses)';
                        }
                        option.textContent = label;
                        select.appendChild(option);
                    });
                    select.disabled = false;
                } else {
                    select.innerHTML = '<option value="1">1 cuota (pago de contado)</option>';
                    select.disabled = false;
                }
            }).catch(function() {
                select.innerHTML = '<option value="1">1 cuota</option>';
                select.disabled = false;
            });
        }

        function withTimeout(promise, milliseconds, message) {
            let timer;
            const timeout = new Promise((_, reject) => {
                timer = setTimeout(() => reject(new Error(message)), milliseconds);
            });

            return Promise.race([promise, timeout]).finally(() => clearTimeout(timer));
        }`;

if (content.includes(oldRenderBlock)) {
    content = content.replace(oldRenderBlock, newRenderBlock);
    console.log('✓ Replaced renderMercadoPago + withTimeout functions');
} else {
    console.error('✗ Could not find renderMercadoPago function block');
    process.exit(1);
}

// ============================================================
// 2. Replace unmountMercadoPago
// ============================================================
const oldUnmount = `        function unmountMercadoPago() {
            if (window.cardPaymentBrickController && typeof window.cardPaymentBrickController.unmount === 'function') {
                try {
                    window.cardPaymentBrickController.unmount();
                } catch (error) {
                    console.log(error);
                }
            }

            window.cardPaymentBrickController = null;
        }`;

const newUnmount = `        function unmountMercadoPago() {
            window.cardPaymentBrickController = null;
        }`;

if (content.includes(oldUnmount)) {
    content = content.replace(oldUnmount, newUnmount);
    console.log('✓ Replaced unmountMercadoPago');
} else {
    console.error('✗ Could not find unmountMercadoPago function');
    process.exit(1);
}

// ============================================================
// 3. Replace getCardholderNameFromBrick
// ============================================================
const oldGetCardholder = `        function getCardholderNameFromBrick() {
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
        }`;

const newGetCardholder = `        function getCardholderNameFromBrick() {
            const input = document.getElementById('mp-card-holder');
            return input ? input.value.trim() : '';
        }`;

if (content.includes(oldGetCardholder)) {
    content = content.replace(oldGetCardholder, newGetCardholder);
    console.log('✓ Replaced getCardholderNameFromBrick');
} else {
    console.error('✗ Could not find getCardholderNameFromBrick function');
    process.exit(1);
}

// ============================================================
// 4. Replace attachMercadoPagoPhoneGuard
// ============================================================
const oldAttachGuard = `        function attachMercadoPagoPhoneGuard() {
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
        }`;

const newAttachGuard = `        function attachMercadoPagoPhoneGuard() {
            if (phoneGuardAttached) {
                return;
            }

            const submitBtn = document.getElementById('mp-custom-submit');
            if (!submitBtn) {
                return;
            }

            submitBtn.addEventListener('click', function(e) {
                if (freeCheckout) {
                    return;
                }

                const phoneState = getPaymentPhoneState();
                if (phoneState.isComplete) {
                    return;
                }

                e.preventDefault();
                notifyPaymentPhoneRequired(phoneState, false);
            });

            phoneGuardAttached = true;
        }`;

if (content.includes(oldAttachGuard)) {
    content = content.replace(oldAttachGuard, newAttachGuard);
    console.log('✓ Replaced attachMercadoPagoPhoneGuard');
} else {
    console.error('✗ Could not find attachMercadoPagoPhoneGuard function');
    process.exit(1);
}

// ============================================================
// Write the file
// ============================================================
fs.writeFileSync(filePath, content, 'utf8');
console.log('✓ File written successfully');
