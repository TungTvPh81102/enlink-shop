<div
    id="searchModal"
    data-bs-scroll="false"
    class="offcanvas offcanvas-top"
    style="--bs-offcanvas-height: auto"
>
    <div class="container-wide container-xxl">
        <nav
            class="navbar navbar-expand-xl px-0 py-6 py-xl-12 row align-items-start"
        >
            <div
                class="col-xl-3 d-flex justify-content-center justify-content-xl-start"
            >
                <a href="{{ route('home') }}" class="navbar-brand py-4 d-lg-inline-block">
                    <img
                        src="http://du-an-poly.trihd.id.vn/assets/client/logo.png"
                        height="26"
                        alt="Glowing - Bootstrap 5 HTML Templates"
                    />
                </a>
            </div>
            <div class="col-xl-6 d-flex justify-content-center">
                <form action="{{ route('product.search') }}" method="get"
                      class="w-xl-100 w-sm-75 w-100 mt-6 mt-xl-0 px-6 px-xl-0">
                    <div class="input-group mx-auto">
                        <input
                            type="text"
                            name="q"
                            class="form-control form-control bg-transparent border-primary"
                            placeholder="Tìm kiếm sản phẩm"
                            value="{{ request('q') ?? '' }}"
                        />
                        <div
                            class="form-control-append position-absolute end-0 top-0 bottom-0 d-flex align-items-center"
                        >
                            <button
                                class="input-group-text bg-transparent border-0 px-0 me-6"
                                type="submit"
                            >
                                <i class="far fa-search fs-5"></i>
                            </button>
                        </div>
                    </div>
                    <div
                        class="d-flex align-items-center justify-content-center mt-6"
                    >
                        <p class="text-muted mb-0 mr-3">Tìm kiếm phổ biến</p>
                        <nav class="nav">
                            @foreach($categories as $item)

                                <a
                                    class="nav-link text-decoration-underline py-0 px-4"
                                    href="{{ route('product-category.list', $item->slug) }}"
                                >{{ $item->name }}</a
                                >
                            @endforeach
                        </nav>
                    </div>
                </form>
            </div>
            <div
                class="icons-actions col-xl-3 d-flex justify-content-end fs-28px text-body-emphasis"
            >
                <div class="px-5 d-none d-xl-inline-block">
                    <a
                        class="position-relative lh-1 color-inherit text-decoration-none"
                        href="#"
                        data-bs-toggle="offcanvas"
                        data-bs-target="#shoppingCart"
                        aria-controls="shoppingCart"
                        aria-expanded="false"
                    >
                        <svg class="icon icon-star-light">
                            <use xlink:href="#icon-shopping-bag-open-light"></use>
                        </svg>
                        <span
                            class="badge bg-dark text-white position-absolute top-0 start-100 translate-middle mt-4 rounded-circle fs-13px p-0 square"
                            style="--square-size: 18px"
                        >3</span
                        >
                    </a>
                </div>
                <div class="px-5 d-none d-xl-inline-block">
                    <a
                        class="lh-1 color-inherit text-decoration-none"
                        href="#"
                        data-bs-toggle="modal"
                        data-bs-target="#signInModal"
                    >
                        <svg class="icon icon-user-light">
                            <use xlink:href="#icon-user-light"></use>
                        </svg>
                    </a>
                </div>

            </div>
        </nav>
    </div>
</div>
