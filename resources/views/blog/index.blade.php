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
                <nav class="d-flex mt-13 pt-3 justify-content-center animate__fadeInUp animate__animated"
                     aria-label="pagination" data-animate="fadeInUp">
                    <ul class="pagination m-0">
                        <li class="page-item">
                            <a class="page-link rounded-circle d-flex align-items-center justify-content-center"
                               href="#" aria-label="Previous">
                                <svg class="icon">
                                    <use xlink:href="#icon-angle-double-left"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active"><a class="page-link" href="#">2</a></li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link rounded-circle d-flex align-items-center justify-content-center"
                               href="#" aria-label="Next">
                                <svg class="icon">
                                    <use xlink:href="#icon-angle-double-right"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
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
                        <div class="widget widget-post">
                            <h4 class="widget-title fs-5 mb-6">Bài viết gần đây</h4>
                            <ul class="list-unstyled mb-0 row gy-7 gx-0">
                                <li class="col-12">
                                    <div class="card border-0 flex-row">
                                        <figure class="flex-shrink-0 mb-0 me-7">
                                            <a href="#" class="d-block" title="Why You Should Try an Overnight Balm">
                                                <img data-src="../assets/images/blog/post-12-60x80.jpg"
                                                     class="img-fluid loaded" alt="Why You Should Try an Overnight Balm"
                                                     width="60" height="80"
                                                     src="../assets/images/blog/post-12-60x80.jpg" loading="lazy"
                                                     data-ll-status="loaded">
                                            </a>
                                        </figure>
                                        <div class="card-body p-0">
                                            <h5 class="card-text fw-semibold ls-1 text-uppercase fs-13px mb-3 text-body text-primary-hover">
                                                <a class="text-decoration-none text-reset" href="#" title="Skin care">Skin
                                                    care</a></h5>
                                            <h4 class="card-title mb-0 text-body-emphasis fs-15px lh-base text-primary-hover">
                                                <a class="text-decoration-none text-reset"
                                                   href="../blog/details-01.html"
                                                   title="Why You Should Try an Overnight Balm" previewlistener="true">Why
                                                    You Should Try an Overnight Balm</a></h4>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-12">
                                    <div class="card border-0 flex-row">
                                        <figure class="flex-shrink-0 mb-0 me-7">
                                            <a href="#" class="d-block"
                                               title="How to Plop Hair for Bouncy, Beautiful Curls">
                                                <img data-src="../assets/images/blog/post-14-60x80.jpg"
                                                     class="img-fluid loaded"
                                                     alt="How to Plop Hair for Bouncy, Beautiful Curls" width="60"
                                                     height="80" src="../assets/images/blog/post-14-60x80.jpg"
                                                     loading="lazy" data-ll-status="loaded">
                                            </a>
                                        </figure>
                                        <div class="card-body p-0">
                                            <h5 class="card-text fw-semibold ls-1 text-uppercase fs-13px mb-3 text-body text-primary-hover">
                                                <a class="text-decoration-none text-reset" href="#" title="Skin care">Skin
                                                    care</a></h5>
                                            <h4 class="card-title mb-0 text-body-emphasis fs-15px lh-base text-primary-hover">
                                                <a class="text-decoration-none text-reset"
                                                   href="../blog/details-01.html"
                                                   title="How to Plop Hair for Bouncy, Beautiful Curls"
                                                   previewlistener="true">How to Plop Hair for Bouncy, Beautiful
                                                    Curls</a></h4>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-12">
                                    <div class="card border-0 flex-row">
                                        <figure class="flex-shrink-0 mb-0 me-7">
                                            <a href="#" class="d-block"
                                               title="Which foundation formula is right for your skin?">
                                                <img data-src="../assets/images/blog/post-11-60x80.jpg"
                                                     class="img-fluid loaded"
                                                     alt="Which foundation formula is right for your skin?" width="60"
                                                     height="80" src="../assets/images/blog/post-11-60x80.jpg"
                                                     loading="lazy" data-ll-status="loaded">
                                            </a>
                                        </figure>
                                        <div class="card-body p-0">
                                            <h5 class="card-text fw-semibold ls-1 text-uppercase fs-13px mb-3 text-body text-primary-hover">
                                                <a class="text-decoration-none text-reset" href="#" title="Skin care">Skin
                                                    care</a></h5>
                                            <h4 class="card-title mb-0 text-body-emphasis fs-15px lh-base text-primary-hover">
                                                <a class="text-decoration-none text-reset"
                                                   href="../blog/details-01.html"
                                                   title="Which foundation formula is right for your skin?"
                                                   previewlistener="true">Which foundation formula is right for your
                                                    skin?</a></h4>
                                        </div>
                                    </div>
                                </li>
                                <li class="col-12">
                                    <div class="card border-0 flex-row">
                                        <figure class="flex-shrink-0 mb-0 me-7">
                                            <a href="#" class="d-block"
                                               title="A User-Friendly Guide to Natural Cleansers">
                                                <img data-src="../assets/images/blog/post-15-60x80.jpg"
                                                     class="img-fluid loaded"
                                                     alt="A User-Friendly Guide to Natural Cleansers" width="60"
                                                     height="80" src="../assets/images/blog/post-15-60x80.jpg"
                                                     loading="lazy" data-ll-status="loaded">
                                            </a>
                                        </figure>
                                        <div class="card-body p-0">
                                            <h5 class="card-text fw-semibold ls-1 text-uppercase fs-13px mb-3 text-body text-primary-hover">
                                                <a class="text-decoration-none text-reset" href="#" title="Skin care">Skin
                                                    care</a></h5>
                                            <h4 class="card-title mb-0 text-body-emphasis fs-15px lh-base text-primary-hover">
                                                <a class="text-decoration-none text-reset"
                                                   href="../blog/details-01.html"
                                                   title="A User-Friendly Guide to Natural Cleansers"
                                                   previewlistener="true">A User-Friendly Guide to Natural Cleansers</a>
                                            </h4>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                        <div class="widget widget-banner">
                            <div class="card border-0">
                                <img class="card-img img-fluid loaded"
                                     data-src="../assets/images/blog/widget-banner-img.jpg" alt="Be your kind of beauty"
                                     width="340" height="343" src="../assets/images/blog/widget-banner-img.jpg"
                                     loading="lazy" data-ll-status="loaded">
                                <div
                                    class="card-img-overlay pt-8 pb-7 px-xl-14 d-flex flex-column align-items-center justify-content-between">
                                    <h2 class="fw-semibold text-uppercase fs-30px lh-12 text-white text-center">Be your
                                        kind of beauty</h2>
                                    <a href="" target="_blank" class="btn btn-white shadow-none" previewlistener="true">
                                        Explore More
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="widget widget-tags">
                            <h4 class="widget-title fs-5 mb-6">Tags</h4>
                            <ul class="w-100 mt-n4 list-unstyled d-flex flex-wrap mb-0">
                                <li class="me-6 mt-4">
                                    <a href="#" title="Cleansing"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Cleansing</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="Make up"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Make
                                        up</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="eye cream"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">eye
                                        cream</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="nail"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">nail</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="shampoo"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">shampoo</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="coffee bean"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">coffee
                                        bean</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="healthy"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">healthy</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="skin care"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">skin
                                        care</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="sale"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">sale</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="Cosmetics"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Cosmetics</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="Natural cleansers"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Natural
                                        cleansers</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="Organic"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Organic</a>
                                </li>
                            </ul>
                        </div>
                        <div class="widget widget-instagram">
                            <div class="d-flex align-items-baseline justify-content-between">
                                <h4 class="widget-title fs-5 mb-6">Follow us</h4><a href="#"
                                                                                    class="text-primary text-hover-underline">@GRACE</a>
                            </div>
                            <div class="row g-10px">
                                <div class="col-4">
                                    <a class="card-img-overlay-hover hover-zoom-in d-block"
                                       href="../assets/images/instagram/instagram-01.jpg" title="instagram-01"
                                       data-gallery="widget_instagram" previewlistener="true">
                                        <img class="img-fluid w-100 loaded" width="106" height="106"
                                             data-src="../assets/images/instagram/instagram-01-106x106.jpg"
                                             alt="instagram-01"
                                             src="../assets/images/instagram/instagram-01-106x106.jpg" loading="lazy"
                                             data-ll-status="loaded">
                                        <span class="card-img-overlay bg-dark bg-opacity-30"></span>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a class="card-img-overlay-hover hover-zoom-in d-block"
                                       href="../assets/images/instagram/instagram-02.jpg" title="instagram-02"
                                       data-gallery="widget_instagram" previewlistener="true">
                                        <img class="img-fluid w-100 loaded" width="106" height="106"
                                             data-src="../assets/images/instagram/instagram-02-106x106.jpg"
                                             alt="instagram-02"
                                             src="../assets/images/instagram/instagram-02-106x106.jpg" loading="lazy"
                                             data-ll-status="loaded">
                                        <span class="card-img-overlay bg-dark bg-opacity-30"></span>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a class="card-img-overlay-hover hover-zoom-in d-block"
                                       href="../assets/images/instagram/instagram-03.jpg" title="instagram-03"
                                       data-gallery="widget_instagram" previewlistener="true">
                                        <img class="img-fluid w-100 loaded" width="106" height="106"
                                             data-src="../assets/images/instagram/instagram-03-106x106.jpg"
                                             alt="instagram-03"
                                             src="../assets/images/instagram/instagram-03-106x106.jpg" loading="lazy"
                                             data-ll-status="loaded">
                                        <span class="card-img-overlay bg-dark bg-opacity-30"></span>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a class="card-img-overlay-hover hover-zoom-in d-block"
                                       href="../assets/images/instagram/instagram-04.jpg" title="instagram-04"
                                       data-gallery="widget_instagram" previewlistener="true">
                                        <img class="img-fluid w-100 loaded" width="106" height="106"
                                             data-src="../assets/images/instagram/instagram-04-106x106.jpg"
                                             alt="instagram-04"
                                             src="../assets/images/instagram/instagram-04-106x106.jpg" loading="lazy"
                                             data-ll-status="loaded">
                                        <span class="card-img-overlay bg-dark bg-opacity-30"></span>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a class="card-img-overlay-hover hover-zoom-in d-block"
                                       href="../assets/images/instagram/instagram-05.jpg" title="instagram-05"
                                       data-gallery="widget_instagram" previewlistener="true">
                                        <img class="img-fluid w-100 loaded" width="106" height="106"
                                             data-src="../assets/images/instagram/instagram-05-106x106.jpg"
                                             alt="instagram-05"
                                             src="../assets/images/instagram/instagram-05-106x106.jpg" loading="lazy"
                                             data-ll-status="loaded">
                                        <span class="card-img-overlay bg-dark bg-opacity-30"></span>
                                    </a>
                                </div>
                                <div class="col-4">
                                    <a class="card-img-overlay-hover hover-zoom-in d-block"
                                       href="../assets/images/instagram/instagram-06.jpg" title="instagram-06"
                                       data-gallery="widget_instagram" previewlistener="true">
                                        <img class="img-fluid w-100 loaded" width="106" height="106"
                                             data-src="../assets/images/instagram/instagram-06-106x106.jpg"
                                             alt="instagram-06"
                                             src="../assets/images/instagram/instagram-06-106x106.jpg" loading="lazy"
                                             data-ll-status="loaded">
                                        <span class="card-img-overlay bg-dark bg-opacity-30"></span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection
