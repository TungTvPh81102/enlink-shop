@extends('layouts._app')

@section('content')
    <section class="page-title z-index-2 position-relative" data-animated-id="1">
        <div class="bg-body-secondary">
            <div class="container">
                <nav class="py-4 lh-30px" aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center py-1">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}" previewlistener="true">Trang chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $title ??'' }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
        <div class="text-center py-13">
            <div class="container">
                <h2 class="mb-0">
                    {{ $title ?? '' }}
                </h2></div>
        </div>
    </section>
    <div class="container mb-lg-18 mb-16 pb-3" data-animated-id="2">
        <div class="row">
            <div class="col-lg-8">
                <div class="row gy-50px">
                    @foreach($posts as $item)
                        <div class="col-sm-6">
                            <article
                                class="card card-post-grid-2 bg-transparent border-0 animate__fadeInUp animate__animated"
                                data-animate="fadeInUp">
                                <figure class="card-img-top mb-7 position-relative">
                                    <a href="{{ route('blog.show-detail-blog', $item->slug ?? '') }}"
                                                                                       class="hover-shine hover-zoom-in d-block"
                                                                                       title="How to Plop Hair for Bouncy, Beautiful Curls">
                                        <img
                                            style="object-fit: cover"
                                            width="370" height="370"
                                             alt=" {{ $item->title }}"
                                             src="{{ Storage::url($item->photo) }}"
                                             >
                                    </a></figure>
                                <div class="card-body p-0">
                                    <ul class="post-meta list-inline lh-1 d-flex flex-wrap fs-13px text-uppercase ls-1 fw-semibold m-0">
                                        <li class="list-inline-item border-end pe-5 me-5"><a
                                                class="text-reset text-decoration-none text-primary-hover" href="#"
                                                title="Life style">{{ $item->blogCategories->name }}</a></li>
                                        <li class="list-inline-item">{{ $item->created_at }}</li>
                                    </ul>
                                    <h4 class="card-title fs-5 lh-base mt-5 pt-2 mb-0">
                                        <a class="text-decoration-none" href="{{ route('blog.show-detail-blog', $item->slug ?? '') }}"
                                           title="How to Plop Hair for Bouncy, Beautiful Curls">
                                            {{ $item->title }}
                                        </a>
                                    </h4>
                                </div>
                            </article>
                        </div>
                    @endforeach
                </div>
                @if($posts->hasPages())
                    {{ $posts->links('vendor.pagination.custom-pagination', ['posts' => $posts]) }}
                @endif
            </div>
            <div class="col-lg-4">
                <div class="position-sticky top-0">
                    <aside class="primary-sidebar mt-12 pt-2 mt-lg-0 pt-lg-0 ps-xl-9 ms-xl-2">
                        <div class="widget widget-search">
                            <h4 class="widget-title fs-5 mb-6">Tìm kiếm</h4>
                            <form action="#">
                                <div class="input-group">
                                    <button type="submit"
                                            class="input-group-text bg-transparent px-4 border-0 position-absolute z-index-4 text-body-emphasis fs-5 start-0 top-0 bottom-0 m-auto">
                                        <svg class="icon icon-magnifying-glass-light">
                                            <use xlink:href="#icon-magnifying-glass-light"></use>
                                        </svg>
                                    </button>
                                    <input type="search" name="search" class="form-control ps-11" placeholder="Search">
                                </div>
                            </form>
                        </div>
                        <div class="widget widget-category">
                            <h4 class="widget-title fs-5 mb-6">Danh mục bài viết</h4>
                            <ul class="navbar-nav navbar-nav-cate" id="widget_category">
                                @foreach($blogCategories as $item)
                                    <li class="nav-item">
                                        <a href="{{ $item->slug }}" title="{{ $item->name }}"
                                           class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"><span
                                                class="text-hover-underline">{{ $item->name }}</span></a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                        @if(!empty($recentPosts))
                            @foreach($recentPosts as $item)
                                <div class="widget widget-post">
                                    <h4 class="widget-title fs-5 mb-6">Bài viết gần đây</h4>
                                    <ul class="list-unstyled mb-0 row gy-7 gx-0">
                                        <li class="col-12">
                                            <div class="card border-0 flex-row">
                                                <figure class="flex-shrink-0 mb-0 me-7">
                                                    <a href="{{ route('blog.show-detail-blog', $item->slug) }}" class="d-block" title="Why You Should Try an Overnight Balm">
                                                        <img
                                                             class="img-fluid loaded" alt="  {{ $item->title }}"
                                                             width="60" height="80"
                                                             src="{{ Storage::url($item->photo) }}" loading="lazy"
                                                             data-ll-status="loaded">
                                                    </a>
                                                </figure>
                                                <div class="card-body p-0">
                                                    <h5 class="card-text fw-semibold ls-1 text-uppercase fs-13px mb-3 text-body text-primary-hover">
                                                        <a class="text-decoration-none text-reset" href="#" title="Skin care">
                                                            {{ $item->blogCategories->name }}
                                                        </a></h5>
                                                    <h4 class="card-title mb-0 text-body-emphasis fs-15px lh-base text-primary-hover">
                                                        <a class="text-decoration-none text-reset"
                                                           href="{{ route('blog.show-detail-blog', $item->slug) }}"
                                                           title="Why You Should Try an Overnight Balm" previewlistener="true">
                                                            {{ $item->title }}
                                                        </a></h4>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            @endforeach
                        @endif
                        @if(!empty($tags))
                            <div class="widget widget-tags">
                                <h4 class="widget-title fs-5 mb-6">Tags</h4>
                                <ul class="w-100 mt-n4 list-unstyled d-flex flex-wrap mb-0">
                                    @foreach($tags as $item)
                                        <li class="me-6 mt-4">
                                            <a href="#" title="Cleansing"
                                               class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">
                                                {{ $item->name }}
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
