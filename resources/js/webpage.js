import "./bootstrap";
import "@Public/themes/webpage/css/aracode.css";
import "../css/webpage-custom.css";

// Importación de Iconos Modernos para la Web Pública
import '@fortawesome/fontawesome-free/css/all.css';

// Nota: No importamos Vristo CSS aquí para evitar conflictos.
// Si necesitas interactividad con Alpine.js, asegúrate de que esté disponible
// ya sea por CDN o importándolo aquí si prefieres compilarlo.

document.addEventListener("DOMContentLoaded", function () {
    // Inicializar Alpine si está disponible globalmente
    if (window.Alpine) {
        window.Alpine.start();
    }

    // Lógica del Slider
    const slides = document.querySelector(".slides");
    if (slides) {
        let currentIndex = 0;
        const totalSlides = document.querySelectorAll(".slide").length;

        function showNextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            const offset = -currentIndex * 100;
            slides.style.transform = `translateX(${offset}%)`;
        }
        setInterval(showNextSlide, 3000);
    }

    // Lógica del Acordeón
    const headers = document.querySelectorAll(".accordion-header-aracode");
    if (headers.length > 0) {
        headers.forEach((header) => {
            header.addEventListener("click", function () {
                const content = this.nextElementSibling;
                const isVisible = content.style.maxHeight;

                // Ocultar todos los contenidos y resetear iconos
                document.querySelectorAll(".accordion-content-aracode").forEach((item) => {
                    item.style.maxHeight = null;
                    item.style.padding = "0";
                    item.setAttribute("aria-hidden", "true");
                });
                headers.forEach((h) => {
                    h.classList.remove("active");
                    const icon = h.querySelector(".accordion-icon-aracode");
                    if (icon) icon.textContent = "►";
                    h.setAttribute("aria-expanded", "false");
                });

                // Mostrar el contenido del header clicado
                if (!isVisible) {
                    content.style.maxHeight = content.scrollHeight + "px";
                    content.style.padding = "15px";
                    this.classList.add("active");
                    const icon = this.querySelector(".accordion-icon-aracode");
                    if (icon) icon.textContent = "▼";
                    this.setAttribute("aria-expanded", "true");
                    content.setAttribute("aria-hidden", "false");
                }
            });
        });
    }

    // Manejo de foco en modales de Bootstrap
    const myModal = document.getElementById('myModal');
    if (myModal) {
        myModal.addEventListener('shown.bs.modal', function () {
            const myInput = document.getElementById('myInput');
            if (myInput) myInput.focus();
        });
    }
});