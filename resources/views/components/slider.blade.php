<div>
    <section class="bg-gray-100 flex items-center justify-center  w-full">
        <div class="slider w-full rounded-lg shadow-lg">
            <div class="slides">
                @foreach ($sliders as $k => $slide)
                <div class="slide">
                    <a href="{{ $slide->item->items[1]->content }}">
                        <img src="{{ asset('storage/'.$slide->item->items[0]->content) }}" alt="Imagen 1" class="w-full">
                    </a>
                </div>
                @endforeach
                {{-- <div class="slide">
                    <img src="{{ asset('themes/webpage/images/slider_02.jpeg') }}" alt="Imagen 2" class="w-full">
                </div>
                <div class="slide">
                    <img src="{{ asset('themes/webpage/images/slider_03.jpeg') }}" alt="Imagen 3" class="w-full">
                </div>
                <div class="slide">
                    <img src="{{ asset('themes/webpage/images/slider_04.jpeg') }}" alt="Imagen 3" class="w-full">
                </div>
                <div class="slide">
                    <img src="{{ asset('themes/webpage/images/slider_05.jpeg') }}" alt="Imagen 3" class="w-full">
                </div> --}}
            </div>
        </div>
    </section>
</div>