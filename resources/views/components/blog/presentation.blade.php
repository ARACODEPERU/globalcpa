<div class="my-3 flex h-8 items-center justify-between">
    <h2 class="text-sm+ font-medium tracking-wide text-slate-700 dark:text-navy-100">
        Articulos Recientes
    </h2>
    <a href="#" class="border-b border-dotted border-current pb-0.5 text-xs+ font-medium text-primary 
                outline-none transition-colors duration-300 hover:text-primary/70 focus:text-primary/70 dark:text-accent-light 
                dark:hover:text-accent-light/70 dark:focus:text-accent-light/70">
                Ver todos
    </a>
</div>

<div class="space-y-4">
    @foreach ($blogs as $blog )
        <a href="{{ route('blog_article_by_url', $blog->url) }}">
            <div class="flex items-center justify-between space-x-2">
                <div class="flex items-center space-x-2">
                <div class="avatar size-10">
                    <img class="mask is-hexagon" src="{{ $blog->imagen }}" alt="avatar">
                </div>
                <div>
                    <p class="font-medium text-slate-600 line-clamp-1 dark:text-navy-100">
                        {{ $blog->title }}
                    </p>
                    <p></p>
                    <p class="text-xs text-slate-400 dark:text-navy-300">
                    Categoria
                    </p>
                </div>
                </div>
                <p class="text-xs">Just Now</p>
            </div>
        </a>
    @endforeach
</div>