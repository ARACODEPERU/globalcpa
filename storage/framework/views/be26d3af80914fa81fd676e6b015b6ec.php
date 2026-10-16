
<style>
    #cookieNotice {
        position: fixed;
        left: 0;
        right: 0;
        bottom: 0;
        z-index: 1080;
        background-color: #111827;
        color: #d1d5db;
        border-top: 3px solid #e30613;
        box-shadow: 0 -6px 24px rgba(0, 0, 0, 0.25);
        padding: 18px 20px;
        font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        font-size: 0.9rem;
        line-height: 1.55;
    }

    #cookieNotice .cookie-notice__inner {
        max-width: 1140px;
        margin: 0 auto;
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }

    #cookieNotice .cookie-notice__text {
        flex: 1 1 420px;
        min-width: 260px;
        margin: 0;
    }

    #cookieNotice .cookie-notice__text strong {
        color: #ffffff;
    }

    #cookieNotice a.cookie-notice__link {
        color: #ffffff;
        text-decoration: underline;
    }

    #cookieNotice a.cookie-notice__link:hover {
        color: #e30613;
    }

    #cookieNotice .cookie-notice__icon {
        color: #e30613;
        font-size: 1.6rem;
        line-height: 1;
    }

    #cookieNotice .cookie-notice__actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    #cookieNotice button.cookie-notice__accept {
        background-color: #e30613;
        color: #ffffff;
        border: none;
        border-radius: 50px;
        padding: 10px 26px;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.3s ease;
        white-space: nowrap;
        box-shadow: 0 4px 15px rgba(227, 6, 19, 0.3);
    }

    #cookieNotice button.cookie-notice__accept:hover {
        background-color: #c00510;
        transform: translateY(-2px);
    }

    @media (max-width: 575px) {
        #cookieNotice {
            padding: 16px;
        }

        #cookieNotice .cookie-notice__actions {
            width: 100%;
        }

        #cookieNotice button.cookie-notice__accept {
            width: 100%;
        }
    }
</style>

<div id="cookieNotice" role="dialog" aria-live="polite" aria-label="Aviso de cookies" hidden>
    <div class="cookie-notice__inner">
        <span class="cookie-notice__icon fa fa-shield" aria-hidden="true"></span>
        <p class="cookie-notice__text">
            <strong>Usamos cookies.</strong>
            Utilizamos cookies propias y de terceros para el correcto funcionamiento del sitio, analizar el tráfico
            y mejorar tu experiencia. Puedes informarte más en nuestra
            <a href="<?php echo e(route('politicas_cookies')); ?>" class="cookie-notice__link">Política de cookies</a>.
            Al pulsar &laquo;Aceptar&raquo; consientes su uso.
        </p>
        <div class="cookie-notice__actions">
            <button type="button" id="cookieNoticeAccept" class="cookie-notice__accept">Aceptar</button>
        </div>
    </div>
</div>

<script>
    (function () {
        var STORAGE_KEY = 'cpa_cookies_accepted';
        var banner = document.getElementById('cookieNotice');
        var acceptButton = document.getElementById('cookieNoticeAccept');

        if (!banner || !acceptButton) {
            return;
        }

        var alreadyAccepted = false;
        try {
            alreadyAccepted = window.localStorage.getItem(STORAGE_KEY) === 'true';
        } catch (error) {
            // Navegacion privada o almacenamiento bloqueado: se muestra el aviso igualmente.
            alreadyAccepted = false;
        }

        if (!alreadyAccepted) {
            banner.hidden = false;
        }

        acceptButton.addEventListener('click', function () {
            try {
                window.localStorage.setItem(STORAGE_KEY, 'true');
            } catch (error) {
                // Sin almacenamiento disponible el aviso volvera a mostrarse en la proxima visita.
            }

            banner.hidden = true;
        });
    })();
</script>
<?php /**PATH C:\laragon\www\globalcpa\resources\views/components/cookies-notice.blade.php ENDPATH**/ ?>