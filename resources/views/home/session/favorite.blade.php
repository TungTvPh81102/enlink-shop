<section class="container container-xxl ">
    <div class="mb-12 pb-3 text-center" data-animate="fadeInUp">
        <h2 class="mb-5">Customer Favorite Beauty Essentials</h2>
        <p class="fs-18px mb-0 mw-xl-30 mw-lg-50 mw-md-75 ms-auto me-auto">
            Made using clean, non-toxic ingredients, our products are designed
            for everyone.
        </p>
    </div>
    <div class="row">
        <div
            class="col-lg-5 mb-12 mb-xl-0 order-lg-1"
            data-animate="fadeInUp"
        >
            <div class="card border-0 rounded-0 hover-zoom-in hover-shine">
                <img
                    class="lazy-image w-100 img-fluid card-img object-fit-cover banner-02"
                    src="{{ Storage::url($incentive[1]->image) }}"
                    width="570"
                    height="913"
                    alt="Pamper Your Skin"
                />
                <div
                    class="card-img-overlay p-12 m-2 d-inline-flex flex-column justify-content-end"
                >
                    <h5
                        class="card-subtitle fw-normal font-primary text-white fs-1 mb-5"
                    >
                        Get the Glow
                    </h5>
                    <h3 class="card-title mb-0 fs-2 text-white">
                       {{ $incentive[1]->title }}
                    </h3>
                    <div class="mt-10 pt-2">
                        <a href="{{ $incentive[1]->link }}" class="btn btn-white">{{ $incentive[1]->btn_title }}</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="row gy-11">
                <div class="col-md-4 col-sm-6 col-12">
                    <div
                        class="card card-product grid-1 bg-transparent border-0"
                        data-animate="fadeInUp"
                    >
                        <figure
                            class="card-img-top position-relative mb-7 overflow-hidden"
                        >
                            <a
                                href="shop/product-details-v1.html"
                                class="hover-zoom-in d-block"
                                title="Enriched Duo"
                            >
                                <img
                                    src="#"
                                    data-src="./assets/images/products/product-01-330x440.jpg"
                                    class="img-fluid lazy-image w-100"
                                    alt="Enriched Duo"
                                    width="330"
                                    height="440"
                                />
                            </a>
                            <div
                                class="position-absolute d-flex z-index-2 product-actions horizontal"
                            >
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Add To Cart"
                                >
                                    <svg class="icon icon-shopping-bag-open-light">
                                        <use xlink:href="#icon-shopping-bag-open-light"></use>
                                    </svg>
                                </a
                                ><a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Quick View"
                                >
                        <span
                            data-bs-toggle="modal"
                            data-bs-target="#quickViewModal"
                            class="d-flex align-items-center justify-content-center"
                        >
                          <svg class="icon icon-eye-light">
                            <use xlink:href="#icon-eye-light"></use>
                          </svg>
                        </span>
                                </a>
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Add To Wishlist"
                                >
                                    <svg class="icon icon-star-light">
                                        <use xlink:href="#icon-star-light"></use>
                                    </svg>
                                </a>
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
                                    href="shop/compare.html"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Compare"
                                >
                                    <svg class="icon icon-arrows-left-right-light">
                                        <use xlink:href="#icon-arrows-left-right-light"></use>
                                    </svg>
                                </a>
                            </div>
                        </figure>
                        <div class="card-body text-center p-0">
                    <span
                        class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6"
                    >$29.00</span
                    >
                            <h4
                                class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3"
                            >
                                <a
                                    class="text-decoration-none text-reset"
                                    href="shop/product-details-v1.html"
                                >Enriched Duo</a
                                >
                            </h4>
                            <div
                                class="d-flex align-items-center fs-12px justify-content-center"
                            >
                                <div class="rating">
                                    <div class="empty-stars">
                          <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                    </div>
                                    <div class="filled-stars" style="width: 100%">
                          <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                    </div>
                                </div>
                                <span class="reviews ms-4 pt-3 fs-14px"
                                >2947 reviews</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div
                        class="card card-product grid-1 bg-transparent border-0"
                        data-animate="fadeInUp"
                    >
                        <figure
                            class="card-img-top position-relative mb-7 overflow-hidden"
                        >
                            <a
                                href="shop/product-details-v1.html"
                                class="hover-zoom-in d-block"
                                title="Shield Spray"
                            >
                                <img
                                    src="#"
                                    data-src="./assets/images/products/product-02-330x440.jpg"
                                    class="img-fluid lazy-image w-100"
                                    alt="Shield Spray"
                                    width="330"
                                    height="440"
                                />
                            </a>
                            <div
                                class="position-absolute d-flex z-index-2 product-actions horizontal"
                            >
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Add To Cart"
                                >
                                    <svg class="icon icon-shopping-bag-open-light">
                                        <use xlink:href="#icon-shopping-bag-open-light"></use>
                                    </svg>
                                </a
                                ><a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Quick View"
                                >
                        <span
                            data-bs-toggle="modal"
                            data-bs-target="#quickViewModal"
                            class="d-flex align-items-center justify-content-center"
                        >
                          <svg class="icon icon-eye-light">
                            <use xlink:href="#icon-eye-light"></use>
                          </svg>
                        </span>
                                </a>
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Add To Wishlist"
                                >
                                    <svg class="icon icon-star-light">
                                        <use xlink:href="#icon-star-light"></use>
                                    </svg>
                                </a>
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
                                    href="shop/compare.html"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Compare"
                                >
                                    <svg class="icon icon-arrows-left-right-light">
                                        <use xlink:href="#icon-arrows-left-right-light"></use>
                                    </svg>
                                </a>
                            </div>
                        </figure>
                        <div class="card-body text-center p-0">
                    <span
                        class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6"
                    >$29.00</span
                    >
                            <h4
                                class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3"
                            >
                                <a
                                    class="text-decoration-none text-reset"
                                    href="shop/product-details-v1.html"
                                >Shield Spray</a
                                >
                            </h4>
                            <div
                                class="d-flex align-items-center fs-12px justify-content-center"
                            >
                                <div class="rating">
                                    <div class="empty-stars">
                          <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                    </div>
                                    <div class="filled-stars" style="width: 100%">
                          <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                    </div>
                                </div>
                                <span class="reviews ms-4 pt-3 fs-14px"
                                >2947 reviews</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div
                        class="card card-product grid-1 bg-transparent border-0"
                        data-animate="fadeInUp"
                    >
                        <figure
                            class="card-img-top position-relative mb-7 overflow-hidden"
                        >
                            <a
                                href="shop/product-details-v1.html"
                                class="hover-zoom-in d-block"
                                title="Vital Eye Cream"
                            >
                                <img
                                    src="#"
                                    data-src="./assets/images/products/product-05-330x440.jpg"
                                    class="img-fluid lazy-image w-100"
                                    alt="Vital Eye Cream"
                                    width="330"
                                    height="440"
                                />
                            </a>
                            <div class="position-absolute product-flash z-index-2">
                      <span class="badge badge-product-flash on-sale bg-primary"
                      >-26%</span
                      >
                            </div>
                            <div
                                class="position-absolute d-flex z-index-2 product-actions horizontal"
                            >
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Add To Cart"
                                >
                                    <svg class="icon icon-shopping-bag-open-light">
                                        <use xlink:href="#icon-shopping-bag-open-light"></use>
                                    </svg>
                                </a
                                ><a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Quick View"
                                >
                        <span
                            data-bs-toggle="modal"
                            data-bs-target="#quickViewModal"
                            class="d-flex align-items-center justify-content-center"
                        >
                          <svg class="icon icon-eye-light">
                            <use xlink:href="#icon-eye-light"></use>
                          </svg>
                        </span>
                                </a>
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Add To Wishlist"
                                >
                                    <svg class="icon icon-star-light">
                                        <use xlink:href="#icon-star-light"></use>
                                    </svg>
                                </a>
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
                                    href="shop/compare.html"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Compare"
                                >
                                    <svg class="icon icon-arrows-left-right-light">
                                        <use xlink:href="#icon-arrows-left-right-light"></use>
                                    </svg>
                                </a>
                            </div>
                        </figure>
                        <div class="card-body text-center p-0">
                    <span
                        class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6"
                    >
                      <del class="text-body fw-500 me-4 fs-13px">$39.00</del>
                      <ins class="text-decoration-none">$29.00</ins></span
                    >
                            <h4
                                class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3"
                            >
                                <a
                                    class="text-decoration-none text-reset"
                                    href="shop/product-details-v1.html"
                                >Vital Eye Cream</a
                                >
                            </h4>
                            <div
                                class="d-flex align-items-center fs-12px justify-content-center"
                            >
                                <div class="rating">
                                    <div class="empty-stars">
                          <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                    </div>
                                    <div class="filled-stars" style="width: 80%">
                          <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                    </div>
                                </div>
                                <span class="reviews ms-4 pt-3 fs-14px"
                                >2947 reviews</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div
                        class="card card-product grid-1 bg-transparent border-0"
                        data-animate="fadeInUp"
                    >
                        <figure
                            class="card-img-top position-relative mb-7 overflow-hidden"
                        >
                            <a
                                href="shop/product-details-v1.html"
                                class="hover-zoom-in d-block"
                                title="Supreme Moisture Mask"
                            >
                                <img
                                    src="#"
                                    data-src="./assets/images/products/product-03-330x440.jpg"
                                    class="img-fluid lazy-image w-100"
                                    alt="Supreme Moisture Mask"
                                    width="330"
                                    height="440"
                                />
                            </a>
                            <div class="position-absolute product-flash z-index-2">
                      <span class="badge badge-product-flash on-sale bg-primary"
                      >-26%</span
                      >
                            </div>
                            <div
                                class="position-absolute d-flex z-index-2 product-actions horizontal"
                            >
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Add To Cart"
                                >
                                    <svg class="icon icon-shopping-bag-open-light">
                                        <use xlink:href="#icon-shopping-bag-open-light"></use>
                                    </svg>
                                </a
                                ><a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Quick View"
                                >
                        <span
                            data-bs-toggle="modal"
                            data-bs-target="#quickViewModal"
                            class="d-flex align-items-center justify-content-center"
                        >
                          <svg class="icon icon-eye-light">
                            <use xlink:href="#icon-eye-light"></use>
                          </svg>
                        </span>
                                </a>
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Add To Wishlist"
                                >
                                    <svg class="icon icon-star-light">
                                        <use xlink:href="#icon-star-light"></use>
                                    </svg>
                                </a>
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
                                    href="shop/compare.html"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Compare"
                                >
                                    <svg class="icon icon-arrows-left-right-light">
                                        <use xlink:href="#icon-arrows-left-right-light"></use>
                                    </svg>
                                </a>
                            </div>
                        </figure>
                        <div class="card-body text-center p-0">
                    <span
                        class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6"
                    >
                      <del class="text-body fw-500 me-4 fs-13px">$39.00</del>
                      <ins class="text-decoration-none">$29.00</ins></span
                    >
                            <h4
                                class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3"
                            >
                                <a
                                    class="text-decoration-none text-reset"
                                    href="shop/product-details-v1.html"
                                >Supreme Moisture Mask</a
                                >
                            </h4>
                            <div
                                class="d-flex align-items-center fs-12px justify-content-center"
                            >
                                <div class="rating">
                                    <div class="empty-stars">
                          <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                    </div>
                                    <div class="filled-stars" style="width: 80%">
                          <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                    </div>
                                </div>
                                <span class="reviews ms-4 pt-3 fs-14px"
                                >2947 reviews</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div
                        class="card card-product grid-1 bg-transparent border-0"
                        data-animate="fadeInUp"
                    >
                        <figure
                            class="card-img-top position-relative mb-7 overflow-hidden"
                        >
                            <a
                                href="shop/product-details-v1.html"
                                class="hover-zoom-in d-block"
                                title="Supreme Polishing Treatment"
                            >
                                <img
                                    src="#"
                                    data-src="./assets/images/products/product-15-330x440.jpg"
                                    class="img-fluid lazy-image w-100"
                                    alt="Supreme Polishing Treatment"
                                    width="330"
                                    height="440"
                                />
                            </a>
                            <div
                                class="position-absolute d-flex z-index-2 product-actions horizontal"
                            >
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Add To Cart"
                                >
                                    <svg class="icon icon-shopping-bag-open-light">
                                        <use xlink:href="#icon-shopping-bag-open-light"></use>
                                    </svg>
                                </a
                                ><a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Quick View"
                                >
                        <span
                            data-bs-toggle="modal"
                            data-bs-target="#quickViewModal"
                            class="d-flex align-items-center justify-content-center"
                        >
                          <svg class="icon icon-eye-light">
                            <use xlink:href="#icon-eye-light"></use>
                          </svg>
                        </span>
                                </a>
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Add To Wishlist"
                                >
                                    <svg class="icon icon-star-light">
                                        <use xlink:href="#icon-star-light"></use>
                                    </svg>
                                </a>
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
                                    href="shop/compare.html"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Compare"
                                >
                                    <svg class="icon icon-arrows-left-right-light">
                                        <use xlink:href="#icon-arrows-left-right-light"></use>
                                    </svg>
                                </a>
                            </div>
                        </figure>
                        <div class="card-body text-center p-0">
                    <span
                        class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6"
                    >$29.00</span
                    >
                            <h4
                                class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3"
                            >
                                <a
                                    class="text-decoration-none text-reset"
                                    href="shop/product-details-v1.html"
                                >Supreme Polishing Treatment</a
                                >
                            </h4>
                            <div
                                class="d-flex align-items-center fs-12px justify-content-center"
                            >
                                <div class="rating">
                                    <div class="empty-stars">
                          <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                    </div>
                                    <div class="filled-stars" style="width: 100%">
                          <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                    </div>
                                </div>
                                <span class="reviews ms-4 pt-3 fs-14px"
                                >2947 reviews</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 col-sm-6 col-12">
                    <div
                        class="card card-product grid-1 bg-transparent border-0"
                        data-animate="fadeInUp"
                    >
                        <figure
                            class="card-img-top position-relative mb-7 overflow-hidden"
                        >
                            <a
                                href="shop/product-details-v1.html"
                                class="hover-zoom-in d-block"
                                title="Scalp Moisturizing Cream"
                            >
                                <img
                                    src="#"
                                    data-src="./assets/images/products/product-06-330x440.jpg"
                                    class="img-fluid lazy-image w-100"
                                    alt="Scalp Moisturizing Cream"
                                    width="330"
                                    height="440"
                                />
                            </a>
                            <div
                                class="position-absolute d-flex z-index-2 product-actions horizontal"
                            >
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm add_to_cart"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Add To Cart"
                                >
                                    <svg class="icon icon-shopping-bag-open-light">
                                        <use xlink:href="#icon-shopping-bag-open-light"></use>
                                    </svg>
                                </a
                                ><a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm quick-view"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Quick View"
                                >
                        <span
                            data-bs-toggle="modal"
                            data-bs-target="#quickViewModal"
                            class="d-flex align-items-center justify-content-center"
                        >
                          <svg class="icon icon-eye-light">
                            <use xlink:href="#icon-eye-light"></use>
                          </svg>
                        </span>
                                </a>
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm wishlist"
                                    href="#"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Add To Wishlist"
                                >
                                    <svg class="icon icon-star-light">
                                        <use xlink:href="#icon-star-light"></use>
                                    </svg>
                                </a>
                                <a
                                    class="text-body-emphasis bg-body bg-dark-hover text-light-hover rounded-circle square product-action shadow-sm compare"
                                    href="shop/compare.html"
                                    data-bs-toggle="tooltip"
                                    data-bs-placement="top"
                                    data-bs-title="Compare"
                                >
                                    <svg class="icon icon-arrows-left-right-light">
                                        <use xlink:href="#icon-arrows-left-right-light"></use>
                                    </svg>
                                </a>
                            </div>
                        </figure>
                        <div class="card-body text-center p-0">
                    <span
                        class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6"
                    >$29.00</span
                    >
                            <h4
                                class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3"
                            >
                                <a
                                    class="text-decoration-none text-reset"
                                    href="shop/product-details-v1.html"
                                >Scalp Moisturizing Cream</a
                                >
                            </h4>
                            <div
                                class="d-flex align-items-center fs-12px justify-content-center"
                            >
                                <div class="rating">
                                    <div class="empty-stars">
                          <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star-o">
                              <use xlink:href="#star-o"></use>
                            </svg>
                          </span>
                                    </div>
                                    <div class="filled-stars" style="width: 100%">
                          <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                        <span class="star">
                            <svg class="icon star text-primary">
                              <use xlink:href="#star"></use>
                            </svg>
                          </span>
                                    </div>
                                </div>
                                <span class="reviews ms-4 pt-3 fs-14px"
                                >2947 reviews</span
                                >
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
