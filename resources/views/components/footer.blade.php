<div>


    <!-- Propuesta de Diseño Moderno -->
    <style>
        .footer-modern {
            background-color: #111827;
            /* Fondo oscuro sólido y elegante */
            color: #9ca3af;
            /* Texto gris suave para reducir fatiga visual */
            padding: 80px 0 30px;
            font-family: system-ui, -apple-system, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        }

        .footer-modern h3 {
            color: #ffffff;
            font-size: 1.1rem;
            font-weight: 700;
            margin-bottom: 1.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .footer-modern p {
            font-size: 0.95rem;
            line-height: 1.6;
            margin-bottom: 1.5rem;
        }

        .footer-modern ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .footer-modern ul li {
            margin-bottom: 0.75rem;
        }

        .footer-modern a {
            color: #9ca3af;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .footer-modern a:hover {
            color: #ffffff;
            padding-left: 5px;
            /* Micro-interacción de desplazamiento */
        }

        .footer-cta-btn {
            display: inline-flex;
            align-items: center;
            gap: 10px;
            background-color: #e30613;
            color: #ffffff !important;
            padding: 12px 25px;
            border-radius: 50px;
            font-weight: 600;
            border: none;
            transition: all 0.3s ease;
            box-shadow: 0 4px 15px rgba(227, 6, 19, 0.3);
        }

        .footer-cta-btn:hover {
            background-color: #c00510;
            transform: translateY(-3px);
            box-shadow: 0 6px 20px rgba(227, 6, 19, 0.4);
            padding-left: 25px;
            /* Override del efecto general de enlaces */
        }

        .contact-item {
            display: flex;
            align-items: center;
            gap: 12px;
            margin-bottom: 1rem;
        }

        .contact-item i {
            color: #e30613;
            font-size: 1.1rem;
        }

        .social-icons-modern {
            display: flex;
            gap: 15px;
            margin-top: 2rem;
        }

        .social-icon-link img {
            width: 32px;
            height: 32px;
            transition: transform 0.3s ease;
        }

        .social-icon-link:hover img {
            transform: scale(1.2);
        }

        .complaints-book-wrapper {
            background-color: #ffffff;
            padding: 15px;
            border-radius: 12px;
            display: inline-block;
            transition: transform 0.3s ease;
        }

        .complaints-book-wrapper:hover {
            transform: translateY(-5px);
        }

        .footer-bottom {
            margin-top: 60px;
            padding-top: 30px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            font-size: 0.85rem;
            color: #6b7280;
        }
    </style>

    <footer class="footer-modern">
        <br>
        <div class="container">
            <div class="row gy-5">
                <!-- Columna 1: Certificado -->
                <div class="col-lg-4 col-md-6">
                    <h3>Verifica el Certificado</h3>
                    <p>Garantiza la autenticidad de tus logros académicos. Valida el certificado CPA Academy ingresando
                        el código correspondiente.</p>
                    <a href="{{ route('certificado_validar') }}" class="footer-cta-btn">
                        <i class="fa fa-certificate"></i>
                        Validar Certificado
                    </a>
                </div>

                <!-- Columna 2: Legal -->
                <div class="col-lg-2 col-md-6">
                    <h3>Legal</h3>
                    <ul>
                        <li><a href="{{ route('politicas_privacidad') }}">Políticas de privacidad</a></li>
                        <li><a href="{{ route('politicas_devoluciones') }}">Políticas de devoluciones</a></li>
                        <li><a href="{{ route('terms_main') }}">Términos y condiciones</a></li>
                    </ul>
                </div>

                <!-- Columna 3: Contacto -->
                <div class="col-lg-3 col-md-6">
                    <h3>Contáctanos</h3>
                    <div class="contact-item">
                        <i class="fa fa-phone-square"></i>
                        <span>967 052 506</span>
                    </div>
                    <div class="contact-item">
                        <i class="fa fa-envelope"></i>
                        <span>informes@globalcpaperu.com</span>
                    </div>

                    <div class="social-icons-modern">
                        <a href="https://www.facebook.com/globalcpaperu" target="_blank" class="social-icon-link"
                            aria-label="Facebook">
                            <img src="{{ asset('themes/webpage/images/logos/facebook-round.svg') }}" alt="Facebook">
                        </a>
                        <a href="https://www.instagram.com/globalcpaperu" target="_blank" class="social-icon-link"
                            aria-label="Instagram">
                            <img src="{{ asset('themes/webpage/images/logos/instagram-round.svg') }}" alt="Instagram">
                        </a>
                        <a href="https://www.tiktok.com/@globalcpa" target="_blank" class="social-icon-link"
                            aria-label="TikTok">
                            <img src="{{ asset('themes/webpage/images/logos/tik_tok-round.svg') }}" alt="TikTok">
                        </a>
                        <a href="https://www.youtube.com/@globalcpaperu" target="_blank" class="social-icon-link"
                            aria-label="YouTube">
                            <img src="{{ asset('themes/webpage/images/logos/youtube-round.svg') }}" alt="YouTube">
                        </a>
                    </div>
                </div>

                <!-- Columna 4: Libro de Reclamaciones -->
                <div class="col-lg-3 col-md-6 text-lg-end text-start">
                    <a href="{{ route('complaints_book') }}" class="complaints-book-wrapper">
                        <img src="{{ asset('themes/webpage/images/libroReclamaciones2.png') }}"
                            alt="Libro de Reclamaciones" class="img-fluid" style="max-width: 150px;">
                    </a>
                </div>
            </div>

            <div class="footer-bottom">
                <p class="mb-0">&copy; {{ date('Y') }} CPA Academy. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
</div>
