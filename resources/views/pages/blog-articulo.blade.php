@extends('layouts.webpage')

@section('title', ' - ' . ($article->title ?? 'Artículo'))

@section('content')

@php
    use Illuminate\Support\Facades\Auth;
@endphp

    <style>
        .article-hero {
            background: linear-gradient(135deg, #002060 0%, #1a3a7a 100%);
            color: #fff;
            padding: 50px 0 30px;
        }

        .article-hero .breadcrumb-custom {
            font-size: 0.85rem;
            opacity: 0.8;
        }

        .article-hero .breadcrumb-custom a {
            color: #fff;
            text-decoration: none;
        }

        .article-hero .breadcrumb-custom a:hover {
            text-decoration: underline;
        }

        .article-hero h1 {
            font-size: 1.8rem;
            font-weight: 700;
            margin-top: 10px;
            text-transform: uppercase;
            color: #fff;
        }

        .article-content {
            background: #fff;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 30px;
        }

        .article-content .article-image {
            width: 100%;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .article-content .article-meta {
            display: flex;
            gap: 20px;
            align-items: center;
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #f3f4f6;
            font-size: 0.85rem;
            color: #6b7280;
        }

        .article-content .article-meta .author-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            object-fit: cover;
        }

        .article-content .article-body {
            font-size: 1rem;
            line-height: 1.8;
            color: #374151;
        }

        .article-content .article-body img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
        }

        .sidebar-box {
            background: #f9fafb;
            border: 1px solid #e5e7eb;
            border-radius: 12px;
            padding: 20px;
            margin-bottom: 20px;
        }

        .sidebar-box h5 {
            font-size: 1rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid #e30613;
        }

        .sidebar-box ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .sidebar-box ul li {
            margin-bottom: 8px;
        }

        .sidebar-box ul li a {
            color: #4b5563;
            text-decoration: none;
            font-size: 0.9rem;
        }

        .sidebar-box ul li a:hover {
            color: #e30613;
        }

        .latest-item {
            display: flex;
            gap: 12px;
            margin-bottom: 12px;
            align-items: center;
        }

        .latest-item img {
            width: 60px;
            height: 60px;
            object-fit: cover;
            border-radius: 8px;
            flex-shrink: 0;
        }

        .latest-item .info a {
            font-size: 0.85rem;
            font-weight: 500;
            color: #1f2937;
            text-decoration: none;
            line-height: 1.3;
            display: block;
        }

        .latest-item .info a:hover {
            color: #e30613;
        }

        .latest-item .info span {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        .related-card {
            border: 1px solid #e5e7eb;
            border-radius: 10px;
            overflow: hidden;
            transition: all 0.3s;
        }

        .related-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.08);
        }

        .related-card img {
            width: 100%;
            height: 140px;
            object-fit: cover;
        }

        .related-card .rc-body {
            padding: 12px;
        }

        .related-card .rc-body h6 {
            font-size: 0.9rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 5px;
        }

        .related-card .rc-body h6 a {
            color: inherit;
            text-decoration: none;
        }

        .related-card .rc-body h6 a:hover {
            color: #e30613;
        }

        .related-card .rc-body span {
            font-size: 0.75rem;
            color: #9ca3af;
        }

        body.dark-only .article-content {
            background: #1f2937;
            border-color: #374558;
        }

        body.dark-only .article-content .article-body {
            color: #d1d5db;
        }

        body.dark-only .article-content .article-meta {
            color: #9ca3af;
            border-color: #374558;
        }

        body.dark-only .sidebar-box {
            background: #111827;
            border-color: #374558;
        }

        body.dark-only .sidebar-box h5 {
            color: #f3f4f6;
        }

        body.dark-only .sidebar-box ul li a {
            color: #d1d5db;
        }

        body.dark-only .related-card {
            background: #1f2937;
            border-color: #374558;
        }

        body.dark-only .related-card .rc-body h6 {
            color: #f3f4f6;
        }

        body.dark-only .article-hero {
            background: linear-gradient(135deg, #111827 0%, #1f2937 100%);
        }
    </style>

    <div class="page-wrapper" id="pageWrapper">
        <x-header />

        <div class="page-body-wrapper">
            <x-sidebar />

            <div class="page-body">
                <br><br>

                <!-- Hero -->
                <div class="article-hero" data-aos="fade-in">
                    <div class="container">
                        <div class="breadcrumb-custom">
                            <a href="{{ route('blog_principal') }}">Blog</a>
                            @if ($article->category)
                                <span class="mx-2">/</span>
                                <a
                                    href="{{ route('blog_category_articles_all', $article->category->id) }}">{{ $article->category->description }}</a>
                            @endif
                        </div>
                        <h1>{{ $article->title }}</h1>
                    </div>
                </div>

                <div class="container mt-4">
                    <div class="row g-4">
                        <!-- Contenido del Artículo -->
                        <div class="col-lg-8 col-md-8" data-aos="fade-up">
                            <div class="article-content">
                                <img src="{{ $article->imagen }}" alt="{{ $article->title }}" class="article-image">

                                <div class="article-meta">
                                    @if ($article->author)
                                        <div class="d-flex align-items-center">
                                            @php $userName = $article->author->name; @endphp
                                            @if ($article->author->avatar && Storage::disk('public')->exists($article->author->avatar))
                                                <img src="{{ asset('storage/' . $article->author->avatar) }}"
                                                    class="author-avatar me-2" alt="{{ $userName }}">
                                            @else
                                                <img src="https://ui-avatars.com/api/?name={{ urlencode($userName) }}&size=80&rounded=true"
                                                    class="author-avatar me-2" alt="{{ $userName }}">
                                            @endif
                                            <span class="author">{{ $userName }}</span>
                                        </div>
                                    @endif
                                    <span><i
                                            class="fa fa-calendar me-1"></i>{{ \Carbon\Carbon::parse($article->created_at)->format('d M Y') }}</span>
                                    <span><i class="fa fa-eye me-1"></i>{{ $article->views }} vistas</span>
                                </div>

                                <div class="article-body">
                                    @if(Auth::check())
                                        {!! $article->content_text !!}
                                    @else
                                        @php
                                            $lines = explode("
", strip_tags($article->content_text));
                                            $preview = implode("
", array_slice($lines, 0, 10));
                                        @endphp
                                        {!! nl2br(e($preview)) !!}
                                        
                                        <div class="text-center mt-4 p-4" style="background: linear-gradient(to bottom, rgba(255,255,255,0) 0%, rgba(255,255,255,1) 30%); position: relative;">
                                            <div style="padding-top: 40px;">
                                                <div class="mb-3">
                                                    <i class="fa fa-lock fa-3x text-muted mb-3"></i>
                                                </div>
                                                <h5 class="fw-bold text-navy-custom mb-3">¿Quieres leer el artículo completo?</h5>
                                                <p class="text-muted mb-4">Si quieres leer esta información completa debes loguearte. Si no tienes una cuenta, regístrate.</p>
                                                <div class="d-flex justify-content-center gap-3">
                                                    <button type="button" class="btn btn-primary px-4 py-2" data-bs-toggle="modal" data-bs-target="#loginModalArticle" style="background-color: #002060; border-color: #002060; border-radius: 8px;">
                                                        <i class="fa fa-sign-in-alt me-2"></i>Iniciar Sesión
                                                    </button>
                                                    <a href="{{ url('/register') }}" class="btn btn-outline-primary px-4 py-2" style="color: #002060; border-color: #002060; border-radius: 8px;">
                                                        <i class="fa fa-user-plus me-2"></i>Registrarse
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                </div>

                                @if ($article->keywords && is_array($article->keywords) && count($article->keywords) > 0)
                                    <div class="mt-4 pt-3 border-top">
                                        <strong class="me-2">Tags:</strong>
                                        @foreach ($article->keywords as $keyword)
                                            <span class="badge bg-light text-dark me-1 mb-1">{{ $keyword }}</span>
                                        @endforeach
                                    </div>
                                @endif
                            </div>

                            <!-- Artículos Relacionados -->
                            @if (isset($relatedArticles) && $relatedArticles->count() > 0)
                                <div class="mt-4" data-aos="fade-up">
                                    <h4 class="mb-3" style="font-weight: 600;">Artículos Relacionados</h4>
                                    <div class="row g-3">
                                        @foreach ($relatedArticles as $related)
                                            <div class="col-md-6">
                                                <div class="related-card">
                                                    <a href="{{ route('blog_article_by_url', $related->url) }}">
                                                        <img src="{{ $related->imagen }}" alt="{{ $related->title }}">
                                                    </a>
                                                    <div class="rc-body">
                                                        <h6><a
                                                                href="{{ route('blog_article_by_url', $related->url) }}">{{ Str::limit($related->title, 60) }}</a>
                                                        </h6>
                                                        <span>{{ \Carbon\Carbon::parse($related->created_at)->format('d M Y') }}</span>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endif
                        </div>

                        <!-- Sidebar -->
                        <div class="col-lg-4 col-md-4">
                            <!-- Categorías -->
                            <div class="blog-sidebar-box" data-aos="fade-up">
                                <h5><i class="fa fa-folder-open me-2"></i>Categorías</h5>
                                <style>
                                    details.blog-cat { border-bottom: 1px solid #f3f4f6; }
                                    details.blog-cat summary {
                                        cursor: pointer; padding: 10px 0; font-size: 0.9rem; font-weight: 600;
                                        color: #1f2937; list-style: none; display: flex; align-items: center; justify-content: space-between;
                                    }
                                    details.blog-cat summary::-webkit-details-marker { display: none; }
                                    details.blog-cat summary::after { content: "\25B6"; font-size: 0.6rem; color: #9ca3af; transition: transform 0.2s; }
                                    details.blog-cat[open] summary::after { transform: rotate(90deg); }
                                    details.blog-cat .cat-articles { padding: 5px 0 10px 0; }
                                    details.blog-cat .cat-article-item { display: flex; align-items: start; gap: 10px; margin-bottom: 8px; }
                                    details.blog-cat .cat-article-item img { width: 40px; height: 40px; object-fit: cover; border-radius: 6px; flex-shrink: 0; }
                                    details.blog-cat .cat-article-item a { font-size: 0.8rem; font-weight: 500; color: #1f2937; line-height: 1.3; text-decoration: none; display: block; }
                                    details.blog-cat .cat-article-item a:hover { color: #e30613; }
                                    details.blog-cat .cat-article-item span { font-size: 0.7rem; color: #9ca3af; }
                                    details.blog-cat .ver-mas-btn { display: block; padding: 8px 0 0 0; font-size: 0.8rem; font-weight: 600; color: #e30613; cursor: pointer; border: none; background: none; text-decoration: none; }
                                    details.blog-cat .ver-mas-btn:hover { text-decoration: underline; }
                                    details.blog-cat .cat-badge { font-size: 0.7rem; min-width: 22px; text-align: center; background: #e30613; color: #fff; border-radius: 10px; padding: 1px 6px; }
                                    .blog-sidebar-box { background: #f9fafb; border: 1px solid #e5e7eb; border-radius: 12px; padding: 20px; margin-bottom: 20px; }
                                    .blog-sidebar-box h5 { font-size: 1rem; font-weight: 600; color: #1f2937; margin-bottom: 15px; padding-bottom: 10px; border-bottom: 2px solid #e30613; }
                                </style>
                                @foreach ($categories as $category)
                                    <details class="blog-cat">
                                        <summary>
                                            <span style="flex:1;">{{ $category->description }}</span>
                                            <span class="cat-badge">{{ $articlesByCategory[$category->id]->count() }}</span>
                                        </summary>
                                        <div class="cat-articles">
                                            @php $catArticles = $articlesByCategory[$category->id]; @endphp
                                            @forelse($catArticles as $index => $catArticle)
                                                <div class="cat-article-item cat-article-{{ $category->id }}" @if($index >= 5) style="display:none;" @endif>
                                                    <img src="{{ $catArticle->imagen }}" alt="">
                                                    <div>
                                                        <a href="{{ route('blog_article_by_url', $catArticle->url) }}">{{ Str::limit($catArticle->title, 45) }}</a>
                                                        <span>{{ \Carbon\Carbon::parse($catArticle->created_at)->format('d M Y') }}</span>
                                                    </div>
                                                </div>
                                            @empty
                                                <p class="text-muted" style="font-size:0.8rem;">No hay artículos</p>
                                            @endforelse
                                            @if(count($catArticles) > 5)
                                                <a href="javascript:void(0);" class="ver-mas-btn" onclick="toggleVerMas(this, {{ $category->id }}, {{ count($catArticles) }})">
                                                    Ver más... <span style="font-size:0.7rem; color:#9ca3af;">({{ count($catArticles) - 5 }} más)</span>
                                                </a>
                                            @endif
                                        </div>
                                    </details>
                                @endforeach
                            </div>

                            <!-- Últimos Artículos -->
                            <div class="sidebar-box" data-aos="fade-up" data-aos-delay="100">
                                <h5><i class="fa fa-clock me-2"></i>Últimos Artículos</h5>
                                @foreach ($latest_articles as $latest)
                                    <div class="latest-item">
                                        <a href="{{ route('blog_article_by_url', $latest->url) }}">
                                            <img src="{{ $latest->imagen }}" alt="{{ $latest->title }}">
                                        </a>
                                        <div class="info">
                                            <a
                                                href="{{ route('blog_article_by_url', $latest->url) }}">{{ Str::limit($latest->title, 50) }}</a>
                                            <span>{{ \Carbon\Carbon::parse($latest->created_at)->format('d M Y') }}</span>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <br>
            </div>
        </div>

        <x-footer />
    </div>

<!-- Login Modal -->
<div class="modal fade" id="loginModalArticle" tabindex="-1" aria-labelledby="loginModalArticleLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 12px; border: none;">
            <div class="modal-header" style="border-bottom: 1px solid #e5e7eb; padding: 20px 24px;">
                <h5 class="modal-title fw-bold text-navy-custom" id="loginModalArticleLabel">
                    <i class="fa fa-sign-in-alt me-2"></i>Iniciar Sesion
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" style="padding: 24px;">
                <div id="loginErrorArticle" class="alert alert-danger d-none" role="alert"></div>
                <form id="loginFormArticle" method="POST" action="{{ url('/login') }}">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label fw-bold text-navy-custom">Correo Electronico</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-envelope"></i></span>
                            <input type="email" name="email" class="form-control" placeholder="tu@correo.com" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold text-navy-custom">Contrasena</label>
                        <div class="input-group">
                            <span class="input-group-text"><i class="fa fa-lock"></i></span>
                            <input type="password" name="password" class="form-control" placeholder="Tu contrasena" required>
                        </div>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input type="checkbox" name="remember" class="form-check-input" id="rememberMe">
                            <label class="form-check-label" for="rememberMe">Recordarme</label>
                        </div>
                        <a href="{{ url('/forgot-password') }}" style="font-size: 0.85rem; color: #002060;">Olvidaste tu contrasena?</a>
                    </div>
                    <button type="submit" id="submitLoginArticle" class="btn btn-primary w-100 py-2" style="background-color: #002060; border-color: #002060; border-radius: 8px;">
                        <i class="fa fa-sign-in-alt me-2"></i>Iniciar Sesion
                    </button>
                </form>
                <div class="text-center mt-3">
                    <span class="text-muted">No tienes cuenta?</span>
                    <a href="{{ url('/register') }}" style="color: #002060; font-weight: 600;">Registrate aqui</a>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('loginFormArticle').addEventListener('submit', function(e) {
    e.preventDefault();
    var form = this;
    var btn = document.getElementById('submitLoginArticle');
    var errorDiv = document.getElementById('loginErrorArticle');
    
    btn.disabled = true;
    btn.innerHTML = '<i class="fa fa-spinner fa-spin me-2"></i>Iniciando sesion...';
    errorDiv.classList.add('d-none');
    
    var formData = new FormData(form);
    
    fetch(form.action, {
        method: 'POST',
        body: formData,
        headers: {
            'X-Requested-With': 'XMLHttpRequest'
        }
    })
    .then(function(response) {
        if (response.ok) {
            window.location.reload();
        } else {
            return response.json().then(function(data) {
                throw new Error(data.message || 'Credenciales incorrectas');
            });
        }
    })
    .catch(function(error) {
        errorDiv.textContent = error.message || 'Error al iniciar sesion. Intenta de nuevo.';
        errorDiv.classList.remove('d-none');
        btn.disabled = false;
        btn.innerHTML = '<i class="fa fa-sign-in-alt me-2"></i>Iniciar Sesion';
    });
});
</script>


<script>
function toggleVerMas(btn, catId, total) {
    var items = document.querySelectorAll('.cat-article-' + catId);
    var expanded = btn.dataset.expanded === 'true';
    if (!expanded) {
        items.forEach(function(item) { item.style.display = ''; });
        btn.dataset.expanded = 'true';
        btn.innerHTML = 'Ver menos <span style="font-size:0.7rem; color:#9ca3af;">(ocultar)</span>';
    } else {
        items.forEach(function(item, i) { if (i >= 5) item.style.display = 'none'; });
        btn.dataset.expanded = 'false';
        btn.innerHTML = 'Ver más... <span style="font-size:0.7rem; color:#9ca3af;">(' + (total - 5) + ' más)</span>';
    }
}
</script>

@stop

@section('javascripts')
    <script>
        $(document).ready(function() {
            if (window.AOS !== undefined) {
                AOS.init({
                    mirror: false,
                    duration: 800,
                    once: true
                });
            }
        });
    </script>
@endsection
