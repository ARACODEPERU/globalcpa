@extends('layouts.webpage')

@section('title', ' - ' . ($article->title ?? 'Artículo'))

@section('content')

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
                                    {!! $article->content_text !!}
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
                            <div class="sidebar-box" data-aos="fade-up">
                                <h5><i class="fa fa-folder-open me-2"></i>Categorías</h5>
                                <ul>
                                    @foreach ($categories as $category)
                                        <li>
                                            <a href="{{ route('blog_category_articles_all', $category->id) }}">
                                                <i class="fa fa-angle-right me-2"></i>{{ $category->description }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
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
