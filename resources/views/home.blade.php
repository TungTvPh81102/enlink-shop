@extends('layouts._app')

@section('content')
    @include('home.session.slider')

    @include('home.session.feature-product')

    <section id="with_client_logo_3" class="bg-section-2">
        <div class="container py-lg-20 pt-14 pb-16">
            <div class="row mt-5 mb-15">
                <div class="col-lg-9 offset-lg-1 col-xl-8 offset-xl-2">
                    <div
                        class="slick-slider main"
                        data-slick-options='{"slidesToShow": 1,"dots":false,"arrows":false, "asNavFor": "#with_client_logo_3 .thumb"}'
                    >
                        <div class="text-center" data-animate="fadeInUp">
                            <h4 class="mb-0">
                                "Millions of combinations, meaning you get a totally unique
                                piece of furniture exactly the way you want it."
                            </h4>
                        </div>
                        <div class="text-center" data-animate="fadeInUp">
                            <h4 class="mb-0">
                                "Great tags, Millie has got used to it, nothing like the old
                                tin tags of years gone by. Light weight and great colours
                                available."
                            </h4>
                        </div>
                        <div class="text-center" data-animate="fadeInUp">
                            <h4 class="mb-0">
                                "Amazing product. The results are so transformative in
                                texture and my face feels plump and healthy. Highly
                                recommend!"
                            </h4>
                        </div>
                        <div class="text-center" data-animate="fadeInUp">
                            <h4 class="mb-0">
                                "Millions of combinations, meaning you get a totally unique
                                piece of furniture exactly the way you want it."
                            </h4>
                        </div>
                        <div class="text-center" data-animate="fadeInUp">
                            <h4 class="mb-0">
                                "Great tags, Millie has got used to it, nothing like the old
                                tin tags of years gone by. Light weight and great colours
                                available."
                            </h4>
                        </div>
                        <div class="text-center" data-animate="fadeInUp">
                            <h4 class="mb-0">
                                "Millions of combinations, meaning you get a totally unique
                                piece of furniture exactly the way you want it."
                            </h4>
                        </div>
                        <div class="text-center" data-animate="fadeInUp">
                            <h4 class="mb-0">
                                "Millions of combinations, meaning you get a totally unique
                                piece of furniture exactly the way you want it."
                            </h4>
                        </div>
                    </div>
                </div>
            </div>
            <div
                class="slick-slider thumb"
                data-slick-options='{"slidesToShow": 6,"focusOnSelect": true,"arrows": false, "dots": false, "asNavFor": "#with_client_logo_3 .main", "responsive":[{"breakpoint":992,"settings":{"dots":true,"slidesToShow":4}},{"breakpoint":768,"settings":{"dots":true,"slidesToShow":3}},{"breakpoint":576,"settings":{"dots":true,"slidesToShow":2}}] }'
            >
                <div class="client-logo-item" data-animate="fadeInUp">
                    <img
                        class="lazy-image w-auto mx-auto opacity-30 light-mode-img"
                        src="#"
                        data-src="./assets/images/client-logo/client-logo-01.png"
                        width="150"
                        height="82"
                        alt="goodness"
                    />
                    <img
                        class="lazy-image dark-mode-img w-auto mx-auto opacity-30"
                        src="#"
                        data-src="./assets/images/client-logo/client-logo-white-01.png"
                        width="150"
                        height="82"
                        alt="goodness"
                    />
                </div>
                <div class="client-logo-item" data-animate="fadeInUp">
                    <img
                        class="lazy-image w-auto mx-auto opacity-30 light-mode-img"
                        src="#"
                        data-src="./assets/images/client-logo/client-logo-02.png"
                        width="150"
                        height="82"
                        alt="grandgolden"
                    />
                    <img
                        class="lazy-image dark-mode-img w-auto mx-auto opacity-30"
                        src="#"
                        data-src="./assets/images/client-logo/client-logo-white-02.png"
                        width="150"
                        height="82"
                        alt="grandgolden"
                    />
                </div>
                <div class="client-logo-item" data-animate="fadeInUp">
                    <img
                        class="lazy-image w-auto mx-auto opacity-30 light-mode-img"
                        src="#"
                        data-src="./assets/images/client-logo/client-logo-03.png"
                        width="150"
                        height="82"
                        alt="parker"
                    />
                    <img
                        class="lazy-image dark-mode-img w-auto mx-auto opacity-30"
                        src="#"
                        data-src="./assets/images/client-logo/client-logo-white-03.png"
                        width="150"
                        height="82"
                        alt="parker"
                    />
                </div>
                <div class="client-logo-item" data-animate="fadeInUp">
                    <img
                        class="lazy-image w-auto mx-auto opacity-30 light-mode-img"
                        src="#"
                        data-src="./assets/images/client-logo/client-logo-04.png"
                        width="150"
                        height="82"
                        alt="thebeast"
                    />
                    <img
                        class="lazy-image dark-mode-img w-auto mx-auto opacity-30"
                        src="#"
                        data-src="./assets/images/client-logo/client-logo-white-04.png"
                        width="150"
                        height="82"
                        alt="thebeast"
                    />
                </div>
                <div class="client-logo-item" data-animate="fadeInUp">
                    <img
                        class="lazy-image w-auto mx-auto opacity-30 light-mode-img"
                        src="#"
                        data-src="./assets/images/client-logo/client-logo-05.png"
                        width="150"
                        height="82"
                        alt="hayden"
                    />
                    <img
                        class="lazy-image dark-mode-img w-auto mx-auto opacity-30"
                        src="#"
                        data-src="./assets/images/client-logo/client-logo-white-05.png"
                        width="150"
                        height="82"
                        alt="hayden"
                    />
                </div>
                <div class="client-logo-item" data-animate="fadeInUp">
                    <img
                        class="lazy-image w-auto mx-auto opacity-30 light-mode-img"
                        src="#"
                        data-src="./assets/images/client-logo/client-logo-06.png"
                        width="150"
                        height="82"
                        alt="goodmood"
                    />
                    <img
                        class="lazy-image dark-mode-img w-auto mx-auto opacity-30"
                        src="#"
                        data-src="./assets/images/client-logo/client-logo-white-06.png"
                        width="150"
                        height="82"
                        alt="goodmood"
                    />
                </div>
                <div class="client-logo-item" data-animate="fadeInUp">
                    <img
                        class="lazy-image w-auto mx-auto opacity-30 light-mode-img"
                        src="#"
                        data-src="./assets/images/client-logo/client-logo-01.png"
                        width="150"
                        height="82"
                        alt="goodness"
                    />
                    <img
                        class="lazy-image dark-mode-img w-auto mx-auto opacity-30"
                        src="#"
                        data-src="./assets/images/client-logo/client-logo-white-01.png"
                        width="150"
                        height="82"
                        alt="goodness"
                    />
                </div>
            </div>
        </div>
    </section>

    @include('home.session.favorite')

    <section class="py-lg-20 py-15">
        <div class="container container-xxl">
            <div class="row gx-30px gy-30px">
                <div class="col-lg-4" data-animate="fadeInUp">
                    <div class="d-flex">
                        <div class="me-9">
                            <img
                                data-src="./assets/images/image-box/image-box-18.png"
                                alt="Guaranteed PURE"
                                width="90"
                                height="90"
                                class="lazy-image"
                                src="#"
                            />
                        </div>
                        <div>
                            <h3 class="fs-4 mb-6">Guaranteed PURE</h3>
                            <p class="mb-0 pe-lg-12">
                                All Grace formulations adhere to strict purity standards and
                                will never contain harsh or toxic ingredients
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-animate="fadeInUp">
                    <div class="d-flex">
                        <div class="me-9">
                            <img
                                data-src="./assets/images/image-box/image-box-19.png"
                                alt="Completely Cruelty-Free"
                                width="90"
                                height="90"
                                class="lazy-image"
                                src="#"
                            />
                        </div>
                        <div>
                            <h3 class="fs-4 mb-6">Completely Cruelty-Free</h3>
                            <p class="mb-0 pe-lg-12">
                                All Grace formulations adhere to strict purity standards and
                                will never contain harsh or toxic ingredients
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4" data-animate="fadeInUp">
                    <div class="d-flex">
                        <div class="me-9">
                            <img
                                data-src="./assets/images/image-box/image-box-20.png"
                                alt="Ingredient Sourcing"
                                width="90"
                                height="90"
                                class="lazy-image"
                                src="#"
                            />
                        </div>
                        <div>
                            <h3 class="fs-4 mb-6">Ingredient Sourcing</h3>
                            <p class="mb-0 pe-lg-12">
                                All Grace formulations adhere to strict purity standards and
                                will never contain harsh or toxic ingredients
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section>
        <div class="container-fluid px-9">
            <div class="row gy-30px gx-30px">
                <div class="col-12 col-md-4" data-animate="fadeInUp">
                    <div class="card border-0 rounded-0 hover-zoom-in hover-shine">
                        <img
                            class="lazy-image card-img object-fit-cover lazy-image"
                            src="#"
                            data-src="./assets/images/banner/banner-28.jpg"
                            width="468"
                            height="468"
                            alt="Autumn Skincare"
                        />
                        <div
                            class="card-img-overlay d-inline-flex flex-column p-8 justify-content-end text-center"
                        >
                            <h3 class="card-title text-white lh-45px">Autumn Skincare</h3>
                            <div>
                                <a
                                    href="#"
                                    class="btn btn-link p-0 fw-semibold text-white text-decoration-none"
                                >Disvover Now
                                    <svg class="icon">
                                        <use xlink:href="#icon-arrow-right"></use>
                                    </svg
                                    >
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4" data-animate="fadeInUp">
                    <div class="card border-0 rounded-0 hover-zoom-in hover-shine">
                        <img
                            class="lazy-image card-img object-fit-cover lazy-image"
                            src="#"
                            data-src="./assets/images/banner/banner-26.jpg"
                            width="468"
                            height="468"
                            alt="Sale 40% Off"
                        />
                        <div
                            class="card-img-overlay d-inline-flex flex-column p-8 justify-content-end text-center"
                        >
                            <h3 class="card-title text-white lh-45px">Sale 40% Off</h3>
                            <div>
                                <a
                                    href="#"
                                    class="btn btn-link p-0 fw-semibold text-white text-decoration-none"
                                >Shop Sale
                                    <svg class="icon">
                                        <use xlink:href="#icon-arrow-right"></use>
                                    </svg
                                    >
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4" data-animate="fadeInUp">
                    <div class="card border-0 rounded-0 hover-zoom-in hover-shine">
                        <img
                            class="lazy-image card-img object-fit-cover lazy-image"
                            src="#"
                            data-src="./assets/images/banner/banner-27.jpg"
                            width="468"
                            height="468"
                            alt="Save on Sets"
                        />
                        <div
                            class="card-img-overlay d-inline-flex flex-column p-8 justify-content-end text-center"
                        >
                            <h3 class="card-title text-white lh-45px">Save on Sets</h3>
                            <div>
                                <a
                                    href="#"
                                    class="btn btn-link p-0 fw-semibold text-white text-decoration-none"
                                >Disvover Now
                                    <svg class="icon">
                                        <use xlink:href="#icon-arrow-right"></use>
                                    </svg
                                    >
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section
        class="pt-lg-18 pt-15 mt-3 pb-lg-17 pb-16"
        data-animate="fadeInUp"
    >
        <div class="container container-xxl">
            <div class="col-lg-6 offset-lg-3">
                <div
                    class="slick-slider custom-arrow dot-lg-0"
                    data-slick-options='{"slidesToShow": 1,"infinite":true,"autoplay":true,"dots":false,"arrows":true,"fade":false,"cssEase":"ease-in-out","speed":600, "responsive":[{"breakpoint": 992,"settings": {"slidesToShow":1,"dots":true, "arrows":false }}]}'
                >
                    <div class="px-6 text-center">
                        <img
                            src="#"
                            data-src="./assets/images/testimonial/testimonial-10.png"
                            alt="Amazing product. The results are so transformative in texture."
                            class="lazy-image mx-auto mb-11"
                            style="width: 80px; height: 80px"
                        />
                        <p class="text-primary fs-3 mb-12 pb-2">
                            “Amazing product. The results are so transformative in texture
                            and my face feels plump and healthy.“
                        </p>
                        <h4 class="fs-15px fw-bold text-uppercase mb-4">Kathleen C.</h4>
                    </div>
                    <div class="px-6 text-center">
                        <img
                            src="#"
                            data-src="./assets/images/testimonial/testimonial-11.png"
                            alt="Amazing product. The results are so transformative in texture."
                            class="lazy-image mx-auto mb-11"
                            style="width: 80px; height: 80px"
                        />
                        <p class="text-primary fs-3 mb-12 pb-2">
                            “Amazing product. The results are so transformative in texture
                            and my face feels plump and healthy.“
                        </p>
                        <h4 class="fs-15px fw-bold text-uppercase mb-4">Kathleen C.</h4>
                    </div>
                    <div class="px-6 text-center">
                        <img
                            src="#"
                            data-src="./assets/images/testimonial/testimonial-12.png"
                            alt="Amazing product. The results are so transformative in texture."
                            class="lazy-image mx-auto mb-11"
                            style="width: 80px; height: 80px"
                        />
                        <p class="text-primary fs-3 mb-12 pb-2">
                            “Amazing product. The results are so transformative in texture
                            and my face feels plump and healthy.“
                        </p>
                        <h4 class="fs-15px fw-bold text-uppercase mb-4">Kathleen C.</h4>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="bg-section-2 pb-lg-18 pb-16 pt-lg-17 pt-15 mb-4">
        <div class="container container-xxl">
            <div class="row align-items-center">
                <div class="col-md-6 mb-md-9" data-animate="fadeInUp">
                    <h2 class="fs-3 mb-0">On the Gram</h2>
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
                <div class="px-6" data-animate="fadeInUp">
                    <a
                        href="assets/images/instagram/instagram-01.jpg"
                        title="instagram-01"
                        data-gallery="instagram"
                        class="hover-zoom-in hover-shine card-img-overlay-hover hover-zoom-in hover-shine d-block"
                    >
                        <img
                            class="lazy-image img-fluid w-100"
                            width="314"
                            height="314"
                            data-src="./assets/images/instagram/instagram-01-320x320.jpg"
                            alt="instagram-01"
                            src="#"
                        />
                        <span class="card-img-overlay bg-dark bg-opacity-30"></span>
                    </a>
                </div>
                <div class="px-6" data-animate="fadeInUp">
                    <a
                        href="assets/images/instagram/instagram-02.jpg"
                        title="instagram-02"
                        data-gallery="instagram"
                        class="hover-zoom-in hover-shine card-img-overlay-hover hover-zoom-in hover-shine d-block"
                    >
                        <img
                            class="lazy-image img-fluid w-100"
                            width="314"
                            height="314"
                            data-src="./assets/images/instagram/instagram-02-320x320.jpg"
                            alt="instagram-02"
                            src="#"
                        />
                        <span class="card-img-overlay bg-dark bg-opacity-30"></span>
                    </a>
                </div>
                <div class="px-6" data-animate="fadeInUp">
                    <a
                        href="assets/images/instagram/instagram-03.jpg"
                        title="instagram-03"
                        data-gallery="instagram"
                        class="hover-zoom-in hover-shine card-img-overlay-hover hover-zoom-in hover-shine d-block"
                    >
                        <img
                            class="lazy-image img-fluid w-100"
                            width="314"
                            height="314"
                            data-src="./assets/images/instagram/instagram-03-320x320.jpg"
                            alt="instagram-03"
                            src="#"
                        />
                        <span class="card-img-overlay bg-dark bg-opacity-30"></span>
                    </a>
                </div>
                <div class="px-6" data-animate="fadeInUp">
                    <a
                        href="assets/images/instagram/instagram-04.jpg"
                        title="instagram-04"
                        data-gallery="instagram"
                        class="hover-zoom-in hover-shine card-img-overlay-hover hover-zoom-in hover-shine d-block"
                    >
                        <img
                            class="lazy-image img-fluid w-100"
                            width="314"
                            height="314"
                            data-src="./assets/images/instagram/instagram-04-320x320.jpg"
                            alt="instagram-04"
                            src="#"
                        />
                        <span class="card-img-overlay bg-dark bg-opacity-30"></span>
                    </a>
                </div>
                <div class="px-6" data-animate="fadeInUp">
                    <a
                        href="assets/images/instagram/instagram-05.jpg"
                        title="instagram-05"
                        data-gallery="instagram"
                        class="hover-zoom-in hover-shine card-img-overlay-hover hover-zoom-in hover-shine d-block"
                    >
                        <img
                            class="lazy-image img-fluid w-100"
                            width="314"
                            height="314"
                            data-src="./assets/images/instagram/instagram-05-320x320.jpg"
                            alt="instagram-05"
                            src="#"
                        />
                        <span class="card-img-overlay bg-dark bg-opacity-30"></span>
                    </a>
                </div>
                <div class="px-6" data-animate="fadeInUp">
                    <a
                        href="assets/images/instagram/instagram-06.jpg"
                        title="instagram-06"
                        data-gallery="instagram"
                        class="hover-zoom-in hover-shine card-img-overlay-hover hover-zoom-in hover-shine d-block"
                    >
                        <img
                            class="lazy-image img-fluid w-100"
                            width="314"
                            height="314"
                            data-src="./assets/images/instagram/instagram-06-320x320.jpg"
                            alt="instagram-06"
                            src="#"
                        />
                        <span class="card-img-overlay bg-dark bg-opacity-30"></span>
                    </a>
                </div>
            </div>
        </div>
    </section>

@endsection


