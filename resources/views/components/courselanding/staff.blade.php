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

        #teacherDetailsModal .modal-content-custom {
            background-color: #ffffff;
            color: #334155;
        }

        :is(.dark, .dark-only) #teacherDetailsModal .modal-content-custom {
            background-color: #1d273a !important;
            color: #cbd5e1 !important;
            border: 1px solid #374558;
        }

        /* Scrollbar personalizado para el modal */
        .modal-content-custom::-webkit-scrollbar { width: 6px; }
        .modal-content-custom::-webkit-scrollbar-thumb {
            background: #cbd5e1; border-radius: 10px;
        }
    </style>

    <div class="container-fluid card aos-animate mt-5 border-0 shadow-none bg-transparent" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <!-- Header de Sección -->
                    <div class="text-center mb-4">
                        <span class="badge rounded-pill bg-badge-custom text-navy-custom px-3 py-2 mb-3 shadow-sm border"
                            style="font-size: 14px; font-weight: 600;">
                            <i class="fa-solid fa-users me-1"></i> {{ $landing->staff_section['name'] }}
                        </span>
                        <h2 class="fw-bold display-6 text-navy-custom dark:text-white">
                            {{ $landing->staff_section['title'] }}</h2>
                        <p class="text-gray-600 dark:text-gray-400 fs-5 mx-auto" style="max-width: 800px;">
                            {{ $landing->staff_section['description'] }}
                        </p>
                    </div>


                    <div class="carousel-viewport" style="padding: 40px 0;">
                        <div class="carousel-track" style="animation-duration: 50s;">
                            {{-- Se duplica el contenido solo si hay menos de 6 docentes --}}
                            @php
                            $teachersToShow = count($teachersPremium) < 6
                                ? $teachersPremium
                                : array_merge($teachersPremium, $teachersPremium);
                            @endphp

                            @if (filled($teachersPremium))
                            @foreach ($teachersToShow as $index => $teacher)
                                <div class="teacher-carousel-item w-[280px]">
                                    <div class="card teacher-card border shadow-sm h-full transition-all rounded-4 overflow-hidden bg-item-custom mx-2 cursor-pointer"
                                        data-teacher="{{ base64_encode(json_encode($teacher)) }}"
                                        onclick="openTeacherModal(this)">

                                        <div style="height: 240px; overflow: hidden; position: relative;">
                                            <img src="{{ $teacher['img'] }}"
                                                class="card-img-top h-100 w-100"
                                                style="object-fit: cover;"
                                                alt="{{ $teacher['name'] }}">

                                            <div class="position-absolute bottom-0 start-0 w-100 p-3"
                                                style="background: linear-gradient(transparent, rgba(0,32,96,0.8));">
                                                <p class="text-white small mb-0 fw-light">{{ "" }}</p>
                                            </div>
                                        </div>

                                        <div class="card-body text-center p-3">
                                            <h5 class="fw-bold mb-1 text-navy-custom" style="font-size: 1.1rem;">
                                                {{ $teacher['name'] }}
                                            </h5>

                                            <p class="text-[#f8aa4b] small fw-bold mb-0" style="font-size: 15px;">
                                                {{ $teacher['role'] }}
                                            </p>
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

    {{-- Usamos @push para enviar el modal al final del layout y evitar problemas de stacking context --}}
    @push('content_after')
    <div id="teacherDetailsModal"
        class="fixed inset-0 z-[10000000] hidden bg-gray-900/60 backdrop-blur-[2px] opacity-0 transition-opacity duration-300 ease-out flex items-center justify-center p-4"
        style="z-index: 10000000 !important;">
        <div class="relative modal-content-custom w-full max-w-4xl max-h-[90vh] overflow-y-auto rounded-2xl shadow-2xl transform translate-y-4 opacity-0 transition-all duration-300 ease-out"
            onclick="event.stopPropagation()">

            <button type="button" class="absolute top-4 right-4 text-gray-400 hover:text-navy-custom dark:hover:text-white text-3xl z-10"
                onclick="closeTeacherDetailsModal()">&times;</button>

            <div class="grid grid-cols-1 md:grid-cols-12 gap-0">
                <!-- Imagen del Docente -->
                <div class="md:col-span-5 bg-gray-50 dark:bg-slate-800/50 flex items-center justify-center p-4">
                    <img id="modalTeacherImage" src="" alt="" class="w-full h-auto max-h-[70vh] object-contain rounded-lg">
                </div>

                <!-- Información -->
                <div class="md:col-span-7 p-6 md:p-8 overflow-y-auto max-h-[80vh]">
                    <h3 id="modalTeacherName" class="text-3xl font-bold text-navy-custom dark:text-white mb-1"></h3>
                    <h5 id="modalTeacherRole" class="text-xl font-semibold text-[#f8aa4b] mb-6"></h5>

                    <div id="modalTeacherResumes" class="space-y-4"></div>
                    <p id="modalNoExperience" class="text-gray-500 italic mt-4 hidden">No hay información disponible.</p>
                </div>
            </div>
        </div>
    </div>
    @endpush

    <style>
        #teacherDetailsModal.opacity-100 .modal-content-custom { transform: translateY(0); opacity: 1; }
        .carousel-viewport { overflow: hidden; padding: 40px 0; position: relative; width: 100%; }
        .carousel-track { display: flex; gap: 30px; width: max-content; animation: scroll-infinite 50s linear infinite; }
        .carousel-track:hover { animation-play-state: paused; }
        @keyframes scroll-infinite { 0% { transform: translateX(0); } 100% { transform: translateX(calc(-50% - 15px)); } }
        .teacher-carousel-item { flex-shrink: 0; }
    </style>

    <script>
        function openTeacherModal(element) {
            const teacherData = JSON.parse(atob(element.getAttribute('data-teacher')));
            showTeacherDetails(teacherData);
        }

        function showTeacherDetails(teacher) {
            const teacherDetailsModal = document.getElementById('teacherDetailsModal');
            if(!teacherDetailsModal) return;

            const modalContent = teacherDetailsModal.querySelector('.modal-content-custom');

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
                        resumeDiv.className = 'flex items-start bg-gray-50 dark:bg-white/5 p-3 rounded-lg border border-gray-100 dark:border-gray-700';
                        resumeDiv.innerHTML = `
                            <i class="fa-solid fa-circle-check text-blue-500 mt-1 mr-3"></i>
                            <p class="text-sm md:text-base leading-relaxed flex-1">${resume.description}</p>
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
            const teacherDetailsModal = document.getElementById('teacherDetailsModal');
            if(!teacherDetailsModal) return;
            const modalContent = teacherDetailsModal.querySelector('.modal-content-custom');

            teacherDetailsModal.classList.remove('opacity-100');
            if(modalContent) modalContent.classList.add('translate-y-4', 'opacity-0');

            // Esperar a que termine la transición de opacidad antes de ocultar completamente
            teacherDetailsModal.addEventListener('transitionend', function handler() {
                teacherDetailsModal.classList.add('hidden');
                teacherDetailsModal.removeEventListener('transitionend', handler);
            }, { once: true });
            document.body.style.overflow = ''; // Restaurar scroll del body
        }

        // Cerrar modal con la tecla Escape
        document.addEventListener('keydown', function(event) {
            const modal = document.getElementById('teacherDetailsModal');
            if (event.key === 'Escape' && modal && !modal.classList.contains('hidden')) {
                closeTeacherDetailsModal();
            }
        });

        // Cerrar modal al hacer clic en el overlay
        document.addEventListener('click', function(event) {
            const modal = document.getElementById('teacherDetailsModal');
            if (event.target === modal) {
                closeTeacherDetailsModal();
            }
        });
    </script>
@endif
