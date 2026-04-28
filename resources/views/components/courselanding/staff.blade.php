@props(['landing', 'teachersPremium' => []])

@if (filled($landing->staff_section ?? null))
    <div class="container-fluid card aos-animate mt-5" data-aos="fade-up">
        <div class="row">
            <div class="col-md-12">
                <div class="card-body p-4 p-lg-5">
                    <!-- Header de Sección -->
                    <div class="text-center mb-4">
                        <span class="badge rounded-pill px-3 py-2 mb-3 shadow-sm border"
                            style="background-color: rgba(0, 32, 96, 0.05); color: #002060;">
                            <i class="fa fa-users me-1"></i> {{ $landing->staff_section['name'] }}
                        </span>
                        <h2 class="fw-bold display-6" style="color: #002060;">
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
                                    <div class="teacher-carousel-item" style="width: 280px;">
                                        <div class="card border-0 shadow-sm h-100 transition-all rounded-4 overflow-hidden bg-white mx-2"
                                            style="cursor: pointer;"
                                            onclick="openTeacherModal({{ $index }})">
                                            <div style="height: 240px; overflow: hidden; position: relative;">
                                                <img src="{{ $teacher['img'] }}" class="card-img-top h-100 w-100"
                                                    style="object-fit: cover;" alt="{{ $teacher['name'] }}">
                                                <div class="position-absolute bottom-0 start-0 w-100 p-3"
                                                    style="background: linear-gradient(transparent, rgba(0,32,96,0.8));">
                                                    <p class="text-white small mb-0 fw-light">Socio Consultor</p>
                                                </div>
                                            </div>
                                            <div class="card-body text-center p-3">
                                                <h5 class="fw-bold mb-1" style="color: #002060; font-size: 1.1rem;">
                                                    {{ $teacher['name'] }}</h5>
                                                <p class="text-warning small fw-bold mb-0" style="font-size: 15px;">
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

    @if (filled($teachersPremium))
        @foreach (array_merge($teachersPremium, $teachersPremium) as $index => $teacher)
            <div id="teacher-modal-{{ $index }}" class="teacher-modal" onclick="closeTeacherModal({{ $index }})">
                <div class="modal-content" onclick="event.stopPropagation()">
                    <button type="button" onclick="closeTeacherModal({{ $index }})"
                        style="position: absolute; top: 15px; right: 15px; border: none; background: none; font-size: 24px; cursor: pointer; z-index: 999999;">&times;</button>
                    <h3 style="color: #002060; margin-bottom: 20px;">{{ $teacher['name'] }}</h3>

                    <div class="image-container">
                        <img src="{{ $teacher['img'] }}" alt="{{ $teacher['name'] }}">
                    </div>

                    <h5 style="color: #ffc107; margin-bottom: 20px;">{{ $teacher['role'] }}</h5>
                    @if (filled($teacher['resumes'] ?? null))
                        @foreach ($teacher['resumes'] as $resume)
                            @if ($resume->type == 'work experience')
                                <div style="margin-bottom: 15px; padding-bottom: 15px; border-bottom: 1px solid #eee;">
                                    <p style="color: #666; margin-bottom: 0;">{{ $resume->description }}</p>
                                </div>
                            @endif
                        @endforeach
                    @else
                        <p style="color: #666;">No hay información de experiencia disponible.</p>
                    @endif
                </div>
            </div>
        @endforeach
    @endif

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
            top: 0; left: 0; width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.8);
            z-index: 999999;
        }
        .teacher-modal.active { display: block; }
        .teacher-modal .modal-content {
            background: white;
            max-width: 1500px; width: 90%; max-height: 90vh;
            border-radius: 15px; padding: 30px;
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            z-index: 999999;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.3);
            overflow-y: auto;
        }
        .teacher-modal .image-container {
            width: 100%; height: 0; padding-bottom: 25%;
            position: relative; margin: 20px 0;
            background-color: #f5f5f5; border-radius: 10px; overflow: hidden;
        }
        .teacher-modal .image-container img {
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
            width: auto; height: 100%; max-width: 100%;
            object-fit: contain; display: block;
        }
        .teacher-modal .image-container.img-full-width img {
            width: 100%; height: auto;
            position: absolute; top: 50%; left: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
@endif