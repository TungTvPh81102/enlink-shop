@extends('layouts._app')

@section('content')
    <section class="z-index-2 position-relative pb-2 mb-12" data-animated-id="1">
        <div class="bg-body-secondary mb-3">
            <div class="container">
                <nav class="py-4 lh-30px" aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center py-1 mb-0">
                        <li class="breadcrumb-item"><a title="Home" href="../index.html" previewlistener="true">Trang
                                chủ</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title ?? '' }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="pt-10 pb-16 pb-lg-18" data-animated-id="2">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    <div class="position-sticky top-0">
                        <aside class="primary-sidebar mt-12 pt-2 mt-lg-0 pt-lg-0 pe-xl-9 me-xl-2">
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
                                        <input type="search" name="search" class="form-control ps-11"
                                               placeholder="Search">
                                    </div>
                                </form>
                            </div>
                            @if(!empty($blogCategories))
                                <div class="widget widget-category">
                                <h4 class="widget-title fs-5 mb-6">Danh mục bài viết</h4>
                                    <ul class="navbar-nav navbar-nav-cate" id="widget_category">
                                        @foreach($blogCategories as $item)
                                            <li class="nav-item">
                                                <a href="#" title="Make up"
                                                   class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"><span
                                                        class="text-hover-underline">{{ $item->name }}</span></a>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                        </aside>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class=" text-center mb-13">
                        <a href="#"
                           class="btn btn-light btn-hover-bg-dark btn-hover-border-dark btn-hover-text-light shadow-none py-0 px-6 mb-6">
                            {{ $post->blogCategories->name ?? '' }}
                        </a>
                        <h2 class=" px-6 text-body-emphasis border-0 fw-500 mb-4 fs-3 ">
                            {{ $post->title ?? '' }}
                        </h2>
                        <ul class="list-inline fs-15px fw-semibold letter-spacing-01 d-flex justify-content-center align-items-center">
                            <li class="list-inline-item px-6"> {{ \Carbon\Carbon::parse($post->published_at)->format('Y-m-d') }}</li>
                            <li class="ms-5 list-style-disc">134 views</li>
                        </ul>
                    </div>
                    <div style="overflow: hidden" class="post-content">
                        {!! $post->content ?? '' !!}
                    </div>
                    <div class="row no-gutters pt-11 justify-content-sm-between">
                        @if(!empty($post->tags))
                            <div class="col-sm-6 mb-4 mb-sm-0">
                                <ul class="list-inline fw-semibold">
                                    @foreach($post->tags as $item)
                                        <li class="list-inline-item me-3">
                                            <a href="" class="text-body text-body-emphasis-hover text-decoration-none"
                                               previewlistener="true">#{{ strtolower($item->name) }}</a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="col-sm-6 d-flex justify-content-sm-end">
                            <label class="text-secondary fw-semibold me-7 mb-0">Share:</label>
                            <ul class="list-inline mb-0 lh-1">
                                <li class="list-inline-item me-7">
                                    <a href="" class="fs-18px lh-14 fw-normal" previewlistener="true">
                                        <i class="fa-brands fa-twitter"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item me-7">
                                    <a href="" class="fs-18px lh-14 fw-normal" previewlistener="true">
                                        <i class="fa-brands fa-facebook-f"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item me-7">
                                    <a href="" class="fs-18px lh-14 fw-normal" previewlistener="true">
                                        <i class="fa-brands fa-instagram"></i>
                                    </a>
                                </li>
                                <li class="list-inline-item me-7">
                                    <a href="" class="fs-18px lh-14 fw-normal" previewlistener="true">
                                        <i class="fa-brands fa-youtube"></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-12 mt-5 mb-7">
                            <div class="border-bottom"></div>
                        </div>
                        <div class="col-sm-6">
                            <div class="ml-8">
                                <p class="fs-13px ls-1 text-uppercase mb-5 fw-semibold px-8">
                                    Videos
                                </p>
                                <a href="#" class="fs-15px fw-semibold position-relative px-8">
                                    <i class="far fa-chevron-left mt-2 position-absolute start-0 top-0"></i>How to Plop
                                    Hair for Bouncy, Beautiful Curls
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-6 d-flex justify-content-sm-end">
                            <div class="mr-8 text-right">
                                <p class="fs-13px text-start text-sm-end ls-1 text-uppercase mb-5 fw-semibold px-8">
                                    Life style
                                </p>
                                <a href="#" class="fs-15px text-start text-sm-end fw-semibold position-relative px-8">
                                    <i class="far fa-chevron-right mt-2 position-absolute end-0 top-0"></i>Our Favorite
                                    Multitasking Products
                                </a>
                            </div>
                        </div>
                    </div>
                    @if(!empty($relatedPosts))
                        <div class="pt-14 pb-13 pb-lg-15 pt-lg-18 mx-n5" id="post_related">
                            <div class="container">
                                <div class="text-center"><h2 class="mb-6 fs-3  ">Bài viết liên quan</h2></div>
                            </div>
                            <div class="container container-xxl mt-10 pt-3">
                                <div class="slick-slider slick-initialized"
                                     data-slick-options="{&quot;arrows&quot;:false,&quot;dots&quot;:false,&quot;responsive&quot;:[{&quot;breakpoint&quot;:1200,&quot;settings&quot;:{&quot;slidesToShow&quot;:3}},{&quot;breakpoint&quot;:992,&quot;settings&quot;:{&quot;dots&quot;:true,&quot;slidesToShow&quot;:2}},{&quot;breakpoint&quot;:768,&quot;settings&quot;:{&quot;dots&quot;:true,&quot;slidesToShow&quot;:1}}],&quot;slidesToShow&quot;:3}">
                                    <div class="slick-list draggable" style="height: 387.763px;">
                                        <div class="slick-track"
                                             style="opacity: 1; width: 795px; transform: translate3d(0px, 0px, 0px);">
                                            @foreach($relatedPosts as $item)
                                                <div class="slick-slide slick-current slick-active" data-slick-index="0"
                                                     aria-hidden="false" tabindex="0" style="width: 265px;">
                                                    <article class="card card-post-grid-3 bg-transparent border-0"
                                                             data-animate="fadeInUp">
                                                        <figure class="card-img-top mb-8 position-relative">
                                                            <a href="{{ route('blog.show-detail-blog', $item->slug) }}"
                                                               class="hover-shine hover-zoom-in d-block"
                                                               title="Our Favorite Multitasking Products"
                                                               tabindex="0">
                                                                <img
                                                                    class="img-fluid w-100 loaded"
                                                                    alt="{{ $item->title }}" width="237"
                                                                    height="288"
                                                                    src="{{ Storage::url($item->photo) }}"
                                                                    loading="lazy" data-ll-status="loaded">
                                                            </a></figure>
                                                        <div class="card-body p-0">
                                                            <ul class="post-meta list-inline lh-1 d-flex flex-wrap fs-13px text-uppercase ls-1 fw-semibold m-0">
                                                                <li class="list-inline-item"><a
                                                                        class="text-reset text-decoration-none text-primary-hover"
                                                                        href="#" title="Videos" tabindex="0">
                                                                        {{ $item->blogCategories->name }}
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                            <h4 class="card-title fs-6 lh-base mt-5 pt-2 mb-0">
                                                                <a class="text-decoration-none"
                                                                   href="{{ route('blog.show-detail-blog', $item->slug) }}"
                                                                   title="{{ $item->title }}" tabindex="0"
                                                                >
                                                                    {{ $item->title }}
                                                                </a>
                                                            </h4>
                                                        </div>
                                                    </article>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif

                    <div class="col-12 mt-5 mb-7">
                        <div class="border-bottom"></div>
                    </div>
                    {{--                    <div class="pt-lg-12 pt-10">--}}
                    {{--                        <h2 class=" fw-semibold fs-3 text-center mb-10">5 Comments</h2>--}}
                    {{--                        <div class="pb-9 mb-9 border-bottom">--}}
                    {{--                            <div class="d-flex">--}}
                    {{--                                <div class="avatar-cmt me-9 bg-image"--}}
                    {{--                                     data-bg-src="../assets/images/blog/post-comment-list-avatar.png"--}}
                    {{--                                     style="background-image: url(&quot;..{{ Storage::url('assets/images/blog/post-comment-list-avatar.png') }}&quot;);">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="Cmt-content">--}}
                    {{--                                    <h2 class=" fw-semibold text-uppercase fs-14px mb-3">elizabeth</h2>--}}
                    {{--                                    <p class=" body-color fs-15px mb-6">This skin care gift set is made with potent--}}
                    {{--                                        vitamins, stimulating caffeine, and natural acids. It’s designed to rejuvenate--}}
                    {{--                                        your complexion without the use of harsh chemicals or bleaching agents.</p>--}}
                    {{--                                    <div class="d-flex">--}}
                    {{--                                        <p class="mb-0 text-muted fs-15px pe-4 border-end">02 Dec, 2020 at 2:29 PM</p>--}}
                    {{--                                        <a href="#" title="reply" class="ps-4 fw-semibold text-body-emphasis">Reply</a>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="d-flex mt-10 ms-17 ps-7 border-start reply-comment">--}}
                    {{--                                <div class="avatar-cmt me-9 bg-image"--}}
                    {{--                                     data-bg-src="../assets/images/blog/post-comment-avatar-02.png"--}}
                    {{--                                     style="background-image: url(&quot;../assets/images/blog/post-comment-avatar-02.png&quot;);">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="cmt-content">--}}
                    {{--                                    <h2 class=" fw-semibold text-uppercase fs-14px mb-3">admin</h2>--}}
                    {{--                                    <p class=" body-color fs-15px mb-6">Vitamin C promotes healthy collagen levels,--}}
                    {{--                                        while 3 types of caffeine awaken and rejuvenate the skin and eyes.</p>--}}
                    {{--                                    <div class="d-flex">--}}
                    {{--                                        <p class="mb-0 text-muted fs-15px pe-4 border-end">02 Dec, 2020 at 2:29 PM</p>--}}
                    {{--                                        <a href="#" title="reply" class="ps-4 fw-semibold text-body-emphasis">Reply</a>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                            <div class="d-flex mt-10 ms-17 ps-7 border-start reply-comment">--}}
                    {{--                                <div class="avatar-cmt me-9 bg-image"--}}
                    {{--                                     data-bg-src="../assets/images/blog/post-comment-avatar-03.png"--}}
                    {{--                                     style="background-image: url(&quot;../assets/images/blog/post-comment-avatar-03.png&quot;);">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="cmt-content">--}}
                    {{--                                    <h2 class=" fw-semibold text-uppercase fs-14px mb-3">Jennifer. c</h2>--}}
                    {{--                                    <p class=" body-color fs-15px mb-6">Vitamin C promotes healthy collagen levels,--}}
                    {{--                                        while 3 types of caffeine awaken and rejuvenate the skin and eyes.</p>--}}
                    {{--                                    <div class="d-flex">--}}
                    {{--                                        <p class="mb-0 text-muted fs-15px pe-4 border-end">02 Dec, 2020 at 2:29 PM</p>--}}
                    {{--                                        <a href="#" title="reply" class="ps-4 fw-semibold text-body-emphasis">Reply</a>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="pb-9 mb-9 border-bottom">--}}
                    {{--                            <div class="d-flex">--}}
                    {{--                                <div class="avatar-cmt me-9 bg-image"--}}
                    {{--                                     data-bg-src="../assets/images/blog/post-comment-avatar-04.png"--}}
                    {{--                                     style="background-image: url(&quot;../assets/images/blog/post-comment-avatar-04.png&quot;);">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="Cmt-content">--}}
                    {{--                                    <h2 class=" fw-semibold text-uppercase fs-14px mb-3">Lucille D</h2>--}}
                    {{--                                    <p class=" body-color fs-15px mb-6">We may not be doing the whole ‘get up and go’--}}
                    {{--                                        thing like we used to, especially if the only place we’re going is our couch.--}}
                    {{--                                        But to get up and glow? </p>--}}
                    {{--                                    <div class="d-flex">--}}
                    {{--                                        <p class="mb-0 text-muted fs-15px pe-4 border-end">02 Dec, 2020 at 2:29 PM</p>--}}
                    {{--                                        <a href="#" title="reply" class="ps-4 fw-semibold text-body-emphasis">Reply</a>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                        <div class="pb-9 mb-9 border-bottom">--}}
                    {{--                            <div class="d-flex">--}}
                    {{--                                <div class="avatar-cmt me-9 bg-image"--}}
                    {{--                                     data-bg-src="../assets/images/blog/post-comment-avatar-05.png"--}}
                    {{--                                     style="background-image: url(&quot;../assets/images/blog/post-comment-avatar-05.png&quot;);">--}}
                    {{--                                </div>--}}
                    {{--                                <div class="Cmt-content">--}}
                    {{--                                    <h2 class=" fw-semibold text-uppercase fs-14px mb-3">Jennifer. c</h2>--}}
                    {{--                                    <p class=" body-color fs-15px mb-6">This skin care gift set is made with potent--}}
                    {{--                                        vitamins, stimulating caffeine, and natural acids. It’s designed to rejuvenate--}}
                    {{--                                        your complexion without the use of harsh chemicals or bleaching agents. </p>--}}
                    {{--                                    <div class="d-flex">--}}
                    {{--                                        <p class="mb-0 text-muted fs-15px pe-4 border-end">02 Dec, 2020 at 2:29 PM</p>--}}
                    {{--                                        <a href="#" title="reply" class="ps-4 fw-semibold text-body-emphasis">Reply</a>--}}
                    {{--                                    </div>--}}
                    {{--                                </div>--}}
                    {{--                            </div>--}}
                    {{--                        </div>--}}
                    {{--                    </div>--}}
                    <div class="pt-lg-12 pt-10">
                        <h3 class="text-center mb-11">Để lại bình luận</h3>
                        <form class="row gy-30px">
                            <div class="col-sm-6">
                                <label for="input_comment_name" class="visually-hidden">Name</label>
                                <input type="text" class="form-control" id="input_comment_name"
                                       name="input_comment_name" placeholder="Name">
                            </div>
                            <div class="col-sm-6">
                                <label for="input_comment_email" class="visually-hidden">Email</label>
                                <input type="email" class="form-control" id="input_comment_email"
                                       name="input_comment_email" placeholder="Email">
                            </div>
                            <div class="col-12">
                                <label for="input_comment_message" class="visually-hidden">Email</label>
                                <textarea class="form-control" name="input_comment_message" id="input_comment_message"
                                          placeholder="Message" rows="6"></textarea>
                            </div>
                            <div class="col-12 mt-8">
                                <div class="form-check">
                                    <input type="checkbox" class="form-check-input" id="input_comment_remember">
                                    <label class="form-check-label" for="input_comment_remember">Save my name, email in
                                        this browse for the next time I comment</label>
                                </div>
                            </div>
                            <div class="col-12 text-center">
                                <button type="submit"
                                        class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary">Submit
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
