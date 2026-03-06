<div>
    <!-- Propuesta de Diseño Moderno Opción 3 -->
    <style>
        .teachers-section-opt3 {
            padding: 60px 0;
            /* background-color: #f4f7f9; */
            /* Un fondo ligeramente diferente para la sección */
        }

        .teacher-card-opt3 {
            position: relative;
            background: #fff;
            border-radius: 15px;
            padding: 20px;
            padding-top: 100px;
            /* Espacio para la imagen que sobresale */
            text-align: center;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.08);
            transition: all 0.4s ease;
            overflow: visible;
            /* Permitir que la imagen se salga */
            margin-top: 80px;
            /* Margen para la imagen */
            cursor: pointer;
        }

        .teacher-card-opt3:hover {
            transform: translateY(-10px);
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.12);
        }

        .teacher-img-wrapper-opt3 {
            position: absolute;
            top: -80px;
            /* Posicionar la imagen arriba */
            left: 50%;
            transform: translateX(-50%);
            width: 160px;
            height: 160px;
            border-radius: 50%;
            padding: 7px;
            /* Espacio para el borde degradado */
            background: linear-gradient(45deg,  #004080 0%, #002060 100%);
            /* Degradado */
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.1);
            transition: all 0.4s ease;
        }

        .teacher-card-opt3:hover .teacher-img-wrapper-opt3 {
            transform: translateX(-50%) translateY(-20px) scale(1.05);
            /* Efecto hover para la imagen */
        }

        .teacher-img-opt3 {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 4px solid #fff;
            /* Borde blanco interior */
        }

        .teacher-name-opt3 {
            font-size: 1.3rem;
            font-weight: 700;
            color: #2c3e50;
            margin-top: 10px;
            margin-bottom: 8px;
        }

        .teacher-role-opt3 {
            font-size: 0.8rem;
            /* color: #e30613; */
            color: #575656;
            font-weight: 400;
            text-transform: uppercase;
            letter-spacing: 0.1px;
        }
    </style>

    <section class="teachers-section-opt3">
        <div class="container">
            <div class="row g-4 justify-content-center">
                @foreach ($teachers as $k => $teacher)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="teacher-card-opt3" data-bs-toggle="modal"
                            data-bs-target="#modalOpt2{{ $k }}">
                            <div class="teacher-img-wrapper-opt3">
                                <img src="{{ asset('storage/' . $teacher->item->items[3]->content) }}"
                                    alt="{{ $teacher->item->items[0]->content }}" class="teacher-img-opt3">
                            </div>
                            <div class="teacher-content-opt3">
                                <h4 class="teacher-name-opt3">{{ $teacher->item->items[0]->content }}</h4>
                                <p class="teacher-role-opt3">{{ $teacher->item->items[1]->content }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    {{-- Empujar los modales a un stack para evitar problemas de z-index con AOS --}}
    @push('modals')
        <!-- Modals para la sección de Docentes -->
        @foreach ($teachers as $k => $teacher)
            <div class="modal fade" id="modalOpt2{{ $k }}" tabindex="-1" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered modal-lg">
                    <div class="modal-content border-0 shadow-lg" style="border-radius: 15px; overflow: hidden;">
                        <div class="row g-0">
                            <div class="col-md-5 d-none d-md-block"
                                style="background-image: url('{{ asset('storage/' . $teacher->item->items[3]->content) }}'); background-size: cover; background-position: center;">
                            </div>
                            <div class="col-md-7">
                                <div class="modal-header border-0 pb-0">
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body p-4 p-lg-5">
                                    <h3 class="fw-bold text-gray-900 dark:!text-white mb-1">{{ $teacher->item->items[0]->content }}</h3>
                                    <p class="text-danger fw-bold text-uppercase mb-4">
                                        {{ $teacher->item->items[1]->content }}</p>
                                    <p class="text-gray-600 dark:text-gray-400" style="line-height: 1.8;">
                                        {{ $teacher->item->items[2]->content }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    @endpush
</div>