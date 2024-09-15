<section>
    <div
        class="slick-slider hero hero-header-09"
        data-slick-options="{&#34;arrows&#34;:false,&#34;autoplay&#34;:true,&#34;cssEase&#34;:&#34;ease-in-out&#34;,&#34;dots&#34;:false,&#34;fade&#34;:true,&#34;infinite&#34;:true,&#34;slidesToShow&#34;:1,&#34;speed&#34;:600}"
    >
        @foreach($banners as $item)
        <div class="vh-100 d-flex align-items-center">
            <div
                class="lazy-bg bg-overlay position-absolute z-index-1 w-100 h-100 light-mode-img"
                data-bg-src="{{ Storage::url($item->image) }}"
            ></div>
            <div class="position-relative z-index-2 container container-xxl pt-22 pb-15 pt-xl-13 pb-xl-11">
                <div
                    class="border-0 ps-lg-1 mx-md-0 mx-auto hero-card text-center">
                    @if(!empty($item->btn_title))
                        <div class="text-start text-xl-center">
                            <div data-animate="fadeInDown">
                                <p class="text-primary mb-8 hero-title font-primary">
                                    Made for you!
                                </p>
                                <h1 class="mb-7 hero-title">
                                    {{ $item->title }}
                                </h1>
                                <p class="hero-desc fs-18px mb-11 text-body-calculate">
                                    {{ $item->subtitle }}
                                </p>
                            </div>
                            <a
                                href="{{ $item->url }}"
                                data-animate="fadeInUp"
                                class="btn btn-lg btn-dark btn-hover-bg-primary btn-hover-border-primary"
                            >
                                {{ $item->btn_title }}
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        @endforeach

    </div>
</section>
