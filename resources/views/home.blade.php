@extends('layouts._app')

@section('content')
    @include('home.session.slider')

    @include('home.session.feature-product')

    @include('home.session.favorite')

    @if(!empty($smallSlider))
        <section class="py-lg-20 py-15">
            <div class="container-fluid px-9">
                <div class="row gy-30px gx-30px">
                    @foreach($smallSlider as $item)
                        <div class="col-12 col-md-4" data-animate="fadeInUp">
                            <div class="card border-0 rounded-0 hover-zoom-in hover-shine">
                                <img
                                    class="lazy-image card-img object-fit-cover lazy-image"
                                    src="{{ Storage::url($item->image) }}"
                                    width="468"
                                    height="468"
                                    alt="Autumn Skincare"
                                />
                                <div
                                    class="card-img-overlay d-inline-flex flex-column p-8 justify-content-end text-center"
                                >
                                    <h3 class="card-title text-white lh-45px">{{ $item->title }}</h3>
                                    <div>
                                        <a
                                            href="{{ route('product-category.list') }}"
                                            class="btn btn-link p-0 fw-semibold text-white text-decoration-none"
                                        >
                                            {{ $item->btn_title }}
                                            <svg class="icon">
                                                <use xlink:href="#icon-arrow-right"></use>
                                            </svg
                                            >
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

    @if(!empty($galleries))
        <section class="bg-section-2 pb-lg-18 pb-16 pt-lg-17 pt-15 mb-4">
            <div class="container container-xxl">
                <div class="row align-items-center">
                    <div class="col-md-6 mb-md-9" data-animate="fadeInUp">
                        <h2 class="fs-3 mb-0">Gallery</h2>
                    </div>
                    <div class="col-md-6 mb-10 mb-md-9" data-animate="fadeInUp">
                        <p class="fs-18px fw-semibold text-primary text-md-end mb-0">
                            @Glowing_cosmetics
                        </p>
                    </div>
                </div>
                <div
                    class="mx-n6 slick-slider"
                    data-slick-options='{"slidesToShow": 5,"infinite":false,"autoplay":false,"dots":false,"arrows":false,"responsive":[{"breakpoint": 1366,"settings": {"slidesToShow":5 }},{"breakpoint": 992,"settings": {"slidesToShow":3}},{"breakpoint": 768,"settings": {"slidesToShow": 2}},{"breakpoint": 576,"settings": {"slidesToShow": 2}}]}'
                >
                    @foreach($galleries as $item)
                        <div class="px-6">
                            <a
                                href="{{ route('product.detail', $item->slug) }}"
                                title="instagram-01"
                                class="hover-zoom-in hover-shine card-img-overlay-hover hover-zoom-in hover-shine d-block"
                            >
                                <img
                                    style="width: 314px; height: 314px;"
                                    class="lazy-image img-fluid w-100"
                                    alt="instagram-01"
                                    src="{{ Storage::url($item->image) }}"
                                />
                                <span class="card-img-overlay bg-dark bg-opacity-30"></span>
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif

@endsection


