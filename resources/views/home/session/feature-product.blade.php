<section id="shop_our_feature_products">
    @if(!empty($productHot->count()))
        <div class="container-xxl py-lg-18 pt-14 pb-15 mb-3 mt-1">
            <div class="mb-12 pb-3 text-center" data-animate="fadeInUp">
                <h2 class="mb-5">Sản phẩm nổi bật</h2>
            </div>
            <div class="row">
                <div class="col-lg-5 mb-10 mb-lg-0" data-animate="fadeInUp">
                    <div class="card border-0 rounded-0 hover-zoom-in hover-shine">
                        <img
                            class="lazy-image w-100 img-fluid card-img object-fit-cover banner-02"
                            src="{{ asset('assets/frontend/assets/images/products/product-03-75x100.jpg') }}"
                            width="570"
                            height="913"
                            alt="Empower Yourself"
                        />
                        <div
                            class="card-img-overlay p-12 m-2 d-inline-flex flex-column justify-content-end"
                        >
                            <h5
                                class="card-subtitle fw-normal font-primary text-white fs-1 mb-5"
                            >
                                Essenstial Items
                            </h5>
                            <h3 class="card-title mb-0 fs-2 text-white">
                                Empower Yourself
                            </h3>
                            <div class="mt-10 pt-2">
                                <a href="#" class="btn btn-white">Explore More</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="row gy-11">
                        @foreach($productHot as $item)
                            <div class="col-md-4 col-sm-6 col-12">
                                <div
                                    class="card card-product grid-1 bg-transparent border-0"
                                    data-animate="fadeInUp"
                                >
                                    <figure
                                        class="card-img-top position-relative mb-7 overflow-hidden"
                                    >
                                        <a
                                            href="{{ route('product.detail', $item->slug) }}"
                                            class="hover-zoom-in d-block"
                                        >
                                            <img
                                                style="height: 290px; object-fit: cover"
                                                src="{{ Storage::url($item->thumbnail_image) }}"
                                                class="img-fluid lazy-image w-100"
                                                alt="{{ $item->name }}"
                                                width="330"
                                            />
                                        </a>
                                    </figure>
                                    <div class="card-body text-center p-0">
                                        @php
                                            $discountedPrice = $item->price_sale > 0 ? $item->price_regular * (1 - ($item->price_sale / 100)) : $item->price_regular;
                                        @endphp
                                        @if($item->price_sale > 0)
                                            <span
                                                class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
                                                <del class="text-body fw-500 me-4 fs-13px">{{ number_format($item->price_regular) }}đ</del>
                                                    <span class="text-danger ms-2">{{ number_format($discountedPrice) }}đ</span>
                                            </span>
                                        @else
                                            <span
                                                class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
                                                {{ number_format($item->price_regular) }}đ
                                            </span>
                                        @endif

                                        <h4
                                            class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3"
                                        >
                                            <a
                                                class="text-decoration-none text-reset text-truncate w-100 d-block  "
                                                href="{{ route('product.detail', $item->slug) }}"
                                            >{{ $item->name }}</a
                                            >
                                        </h4>

                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif

</section>
