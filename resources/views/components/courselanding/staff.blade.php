@props(['landing', 'teachersPremium' => []])

@if (filled($landing->staff_section ?? null))
    <style>
        .text-navy-custom { color: #002060 !important; }
        :is(.dark, .dark-only) .text-navy-custom { color: #f6f7fb !important; }

        .bg-item-custom { background-color: #ffffff !important; }
        :is(.dark, .dark-only) .bg-item-custom {
            background-color: #1d273a !important;
            border-color: #374558 !important;
        }

        .bg-badge-custom { background-color: rgba(0, 32, 96, 0.05) !important; }
        :is(.dark, .dark-only) .bg-badge-custom { background-color: rgba(246, 247, 251, 0.1) !important; }

        /* Asegurar renderizado de iconos Font Awesome 6 */
        .fa-solid, .fas {
            font-family: "Font Awesome 6 Free" !important;
            font-weight: 900 !important;
        }

        :is(.dark, .dark-only) #teacherDetailsModal .modal-content-custom {
            background-color: #1d273a !important;
            color: #f6f7fb !important;
        }
    </style>

    <div class="container-fluid card aos-animate mt-5 border-0 shadow-sm" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <!-- Header de Sección -->
                    <div class="text-center mb-4">
                        <span class="badge rounded-pill bg-badge-custom text-navy-custom px-3 py-2 mb-3 shadow-sm border"
                            style="font-size: 14px; font-weight: 600;">
                            <i class="fa-solid fa-users me-1"></i> {{ $landing->staff_section['name'] }}
                        </span>
                        <h2 class="fw-bold display-6 text-navy-custom">
                            {{ $landing->staff_section['title'] }}</h2>
                        <p class="text-muted fs-5 mx-auto" style="max-width: 800px;">
                            {{ $landing->staff_section['description'] }}
                        </p>
                    </div>

                    
                    <div class="carousel-viewport" style="padding: 40px 0;">
                        <div class="carousel-track" style="animation-duration: 50s;">
                            {{-- Se duplica el contenido para el loop infinito --}}
                            @if (filled($teachersPremium))
                                @foreach (array_merge($teachersPremium, $teachersPremium) as $index => $teacher)
                                    <div class="teacher-carousel-item w-[280px]">
                                        <div class="card border shadow-sm h-full transition-all rounded-4 overflow-hidden bg-item-custom mx-2 cursor-pointer"
                                            onclick="showTeacherDetails({{ json_encode($teacher) }})">
                                            <div style="height: 240px; overflow: hidden; position: relative;">
                                                <img src="{{ $teacher['img'] }}" class="card-img-top h-100 w-100"
                                                    style="object-fit: cover;" alt="{{ $teacher['name'] }}">
                                                <div class="position-absolute bottom-0 start-0 w-100 p-3"
                                                    style="background: linear-gradient(transparent, rgba(0,32,96,0.8));">
                                                    <p class="text-white small mb-0 fw-light">{{ "" }}</p>
                                                </div>
                                            </div>
                                            <div class="card-body text-center p-3">
                                                <h5 class="fw-bold mb-1 text-navy-custom" style="font-size: 1.1rem;">
                                                    {{ $teacher['name'] }}</h5>
                                                <p class="text-[#f8aa4b] small fw-bold mb-0" style="font-size: 15px;">
                                                    {{ $teacher['role'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal de Detalles del Docente (Único y Dinámico) -->
    <div id="teacherDetailsModal"
        class="fixed inset-0 z-[999999] hidden bg-black bg-opacity-70 opacity-0 transition-opacity duration-300 ease-out">
        <div class="relative modal-content-custom w-full max-w-3xl mx-auto my-8 p-6 bg-white rounded-xl shadow-2xl transform translate-y-4 opacity-0 transition-all duration-300 ease-out"
            onclick="event.stopPropagation()">
            <button type="button" class="absolute top-4 right-4 text-gray-500 hover:text-gray-800 text-2xl"
                onclick="closeTeacherDetailsModal()">&times;</button>
            <h3 id="modalTeacherName" class="text-2xl font-bold text-navy-custom mb-2"></h3>
            <h5 id="modalTeacherRole" class="text-lg font-semibold text-[#f8aa4b] mb-4"></h5>

            <div id="modalTeacherImageContainer"
                class="w-full h-48 relative mb-6 rounded-lg overflow-hidden bg-gray-100 flex items-center justify-center">
                <img id="modalTeacherImage" src="" alt="" class="max-h-full max-w-full object-contain">
            </div>

            <div id="modalTeacherResumes" class="space-y-4">
                <!-- Resumes will be dynamically inserted here -->
            </div>
            <p id="modalNoExperience" class="text-gray-600 mt-4 hidden">No hay información de experiencia disponible.
            </p>
        </div>
    </div>

    <style>
        /* Estilos para el modal */
        #teacherDetailsModal.opacity-100 .relative {
            transform: translateY(0);
            opacity: 1;
        }

        /* Estilos para el carrusel (si no están ya en el CSS global) */
        .carousel-viewport {
            overflow: hidden;
            padding: 40px 0;
            /* Ajustado para el carrusel */
            position: relative;
            width: 100%;
        }

        .carousel-track {
            display: flex;
            gap: 30px;
            width: max-content;
            animation: scroll-infinite 50s linear infinite;
            /* Duración de la animación */
        }

        .carousel-track:hover {
            animation-play-state: paused;
        }

        @keyframes scroll-infinite {
            0% {
                transform: translateX(0);
            }

            100% {
                transform: translateX(calc(-50% - 15px));
            }

            /* Ajuste para el gap */
        }

        .teacher-carousel-item {
            flex-shrink: 0;
        }
    </style>

    <script>
        const teacherDetailsModal = document.getElementById('teacherDetailsModal');
        const modalContent = teacherDetailsModal.querySelector('.relative'); // El div interno del modal

        function showTeacherDetails(teacher) {
            document.getElementById('modalTeacherName').textContent = teacher.name;
            document.getElementById('modalTeacherRole').textContent = teacher.role;

            const imgElement = document.getElementById('modalTeacherImage');
            imgElement.src = teacher.img;
            imgElement.alt = teacher.name;

            const resumesContainer = document.getElementById('modalTeacherResumes');
            resumesContainer.innerHTML = ''; // Limpiar resumes anteriores

            if (teacher.resumes && teacher.resumes.length > 0) {
                document.getElementById('modalNoExperience').classList.add('hidden');
                teacher.resumes.forEach(resume => {
                    if (resume.type === 'work experience') {
                        const resumeDiv = document.createElement('div');
                        resumeDiv.className = 'mb-3 pb-3 border-b border-gray-200 flex items-start';
                        resumeDiv.innerHTML = `
                            <i class="fa-solid fa-briefcase text-blue-600 text-xl mr-3 mt-1"></i>
                            <p class="text-gray-700 leading-relaxed flex-1">${resume.description}</p>
                        `;
                        resumesContainer.appendChild(resumeDiv);
                    }
                });
            } else {
                document.getElementById('modalNoExperience').classList.remove('hidden');
            }

            teacherDetailsModal.classList.remove('hidden');
            // Forzar un reflow para asegurar que las transiciones CSS se apliquen
            void teacherDetailsModal.offsetWidth;
            teacherDetailsModal.classList.add('opacity-100');
            modalContent.classList.remove('translate-y-4', 'opacity-0');
            document.body.style.overflow = 'hidden'; // Bloquear scroll del body
        }

        function closeTeacherDetailsModal() {
            teacherDetailsModal.classList.remove('opacity-100');
            modalContent.classList.add('translate-y-4', 'opacity-0');
            // Esperar a que termine la transición de opacidad antes de ocultar completamente
            teacherDetailsModal.addEventListener('transitionend', function handler() {
                teacherDetailsModal.classList.add('hidden');
                teacherDetailsModal.removeEventListener('transitionend', handler);
            });
            document.body.style.overflow = ''; // Restaurar scroll del body
        }

        // Cerrar modal con la tecla Escape
        document.addEventListener('keydown', function(event) {
            if (event.key === 'Escape' && !teacherDetailsModal.classList.contains('hidden')) {
                closeTeacherDetailsModal();
            }
        });

        // Cerrar modal al hacer clic en el overlay
        teacherDetailsModal.addEventListener('click', function(event) {
            if (event.target === teacherDetailsModal) {
                closeTeacherDetailsModal();
            }
        });
    </script>


<script>
    function openTeacherModal(index) {
        document.querySelectorAll('.teacher-modal').forEach(modal => {
            modal.classList.remove('active');
        });
        const modal = document.getElementById(`teacher-modal-${index}`);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    }

    function closeTeacherModal(index) {
        const modal = document.getElementById(`teacher-modal-${index}`);
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    }

    document.addEventListener('keydown', function(event) {
        if (event.key === 'Escape') {
            const activeModal = document.querySelector('.teacher-modal.active');
            if (activeModal) {
                activeModal.classList.remove('active');
                document.body.style.overflow = '';
            }
        }
    });
</script>

<style>
    .teacher-modal {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.8);
        z-index: 999999;
    }

    .teacher-modal.active {
        display: block;
    }

    .teacher-modal .modal-content {
        background: white;
        max-width: 1500px;
        width: 90%;
        max-height: 90vh;
        border-radius: 15px;
        padding: 30px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        z-index: 999999;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
        overflow-y: auto;
    }

    .teacher-modal .image-container {
        width: 100%;
        height: 0;
        padding-bottom: 25%;
        position: relative;
        margin: 20px 0;
        background-color: #f5f5f5;
        border-radius: 10px;
        overflow: hidden;
    }

    .teacher-modal .image-container img {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        width: auto;
        height: 100%;
        max-width: 100%;
        object-fit: contain;
        display: block;
    }

    .teacher-modal .image-container.img-full-width img {
        width: 100%;
        height: auto;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }
</style>
@endif
