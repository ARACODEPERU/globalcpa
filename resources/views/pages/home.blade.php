@extends('layouts.webpage')

@section('content')




    <main class="main-content w-full px-[var(--margin-x)] pb-8">

        <section class="bg-gray-100 flex items-center justify-center h-screen w-full">
                <div class="slider w-full rounded-lg shadow-lg">
                    <div class="slides">
                        <div class="slide">
                            <img src="https://netzun.com/_nuxt/img/banner_desktop.1656de5.webp" alt="Imagen 1" class="w-full">
                        </div>
                        <div class="slide">
                            <img src="https://netzun.com/_nuxt/img/home-new-first.6aa270a.jpg" alt="Imagen 2" class="w-full">
                        </div>
                        <div class="slide">
                            <img src="https://netzun.com/_nuxt/img/banner_desktop.1656de5.webp" alt="Imagen 3" class="w-full">
                        </div>
                    </div>
                </div>
        </section>
        <br>
        <div class="grid grid-cols-1 gap-4 sm:gap-5 lg:gap-6">
              <!-- Rounded Avatar -->
              <div class="card px-4 pb-4 sm:px-5">
                <div class="my-3 flex h-8 items-center justify-between">
                  <h2 class="font-medium tracking-wide text-slate-700 line-clamp-1 dark:text-navy-100 lg:text-base">
                    Rounded Avatar
                  </h2>
                  <label class="flex items-center space-x-2">
                    <span class="text-xs text-slate-400 dark:text-navy-300">Code</span>
                    <input @change="helpers.toggleCode" class="form-switch h-5 w-10 rounded-full bg-slate-300 before:rounded-full before:bg-slate-50 checked:bg-primary checked:before:bg-white dark:bg-navy-900 dark:before:bg-navy-300 dark:checked:bg-accent dark:checked:before:bg-white" type="checkbox">
                  </label>
                </div>
                <div class="max-w-2xl">
                  <p>
                    The Avatar component creates a scalable, colorable element that
                    can have text, icon or image within its shape. Check out code
                    for detail of usage.
                  </p>
                </div>
              </div>
    
        </div>
    </main>
    
    
    <div id="whatsapp">
        <a href="" class="wtsapp" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <i class="fab fa-whatsapp"></i>
        </a>
    </div>

    <style type="text/css">
        #whatsapp .wtsapp{
            position: fixed;
            transform: all .5s ease;
            background-color: #25D366;
            display: block;
            text-align: center;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            border-radius: 50px;
            border-right: none;
            color: #fff;
            font-weight: 700;
            font-size: 30px;
            bottom: 40px;
            right: 20px;
            border: 0;
            z-index: 9999;
            width: 50px;
            height: 50px;
            line-height: 50px;
        }

        #whatsapp .wtsapp:before{
            content: "";
            position: absolute;
            z-index: -1;
            left: 50%;
            top: 50%;
            transform: translateX(-50%) translateY(-50%);
            display: block;
            width: 60px;
            height: 60px;
            background-color: #25D366;
            border-radius: 50%;
            -webkit-animation: pulse-border 1500ms ease-out infinite;
            animation: pulse-border 1500ms ease-out infinite;
        }

        #whatsapp .wtsapp:focus{
            border: none;
            outline: none;
        }

        @keyframes pulse-border{
            0%{
                transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1);
                opacity: 1;
            }
            100%{
                transform: translateX(-50%) translateY(-50%) translateZ(0) scale(1.5);
                opacity: 0;
            }
        }



        .slider {
            position: relative;
            overflow: hidden;
        }
        .slides {
            display: flex;
            transition: transform 0.5s ease-in-out;
        }
        .slide {
            min-width: 100%;
        }

    </style>

    <script>

        let currentIndex = 0;
        const slides = document.querySelector('.slides');
        const totalSlides = document.querySelectorAll('.slide').length;

        function showNextSlide() {
            currentIndex = (currentIndex + 1) % totalSlides;
            const offset = -currentIndex * 100;
            slides.style.transform = `translateX(${offset}%)`;
        }

        setInterval(showNextSlide, 3000); // Cambia cada 3 segundos

    </script>

@stop
