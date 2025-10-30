<div>
    <div class="container-fluid">
        <section class="bg-gray-100 flex items-center justify-center  w-full">
            <div class="slider w-full rounded-lg shadow-lg">
                <div class="slides">
                    @foreach ($sliders as $k => $slide)
                        <div class="slide">
                            <a href="{{ $slide->item->items[1]->content }}">
                                <img src="{{ asset('storage/' . $slide->item->items[0]->content) }}" alt="Imagen"
                                    class="w-full">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    </div>
</div>
