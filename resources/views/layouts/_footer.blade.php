<footer class="pt-13 pt-lg-20 pb-16 footer">
    <div class="container container-xxl pt-4">
        <div class="row">
            <div class="col-lg col-md-4 col-12 mb-11 mb-lg-0">
                <h3 class="fs-5 mb-6">Công ty</h3>
                <p class="pe-xl-18 lh-2">
                    {{ config('settings.address') }}
                </p>
                <p class="mb-0 lh-2">
                    <strong class="text-body-emphasis">  {{ config('settings.phone') }}</strong>
                    <br />
                    {{ config('settings.email') }}
                </p>
            </div>
            <div class="col-lg col-md-4 col-12 mb-11 mb-lg-0">
                <h3 class="fs-5 mb-6">Danh mục sản phẩm</h3>
                <ul class="list-unstyled mb-0 fw-medium">
                    @foreach($categories as $item)
                        <li class="pt-3 mb-4">
                            <a href="{{ route('product-category.list', $item->slug) }}" title="New Products" class="text-body"
                            >{{ $item->name }}</a
                            >
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-lg col-md-4 col-12 mb-11 mb-lg-0">
                <h3 class="fs-5 mb-6">Thông tin</h3>
                <ul class="list-unstyled mb-0 fw-medium">
                    <li class="pt-3 mb-4">
                        <a href="#" title="Start a Return" class="text-body"
                        >Start a Return</a
                        >
                    </li>
                    <li class="pt-3 mb-4">
                        <a href="#" title="Contact Us" class="text-body">Contact Us</a>
                    </li>
                    <li class="pt-3 mb-4">
                        <a href="#" title="Shipping FAQ" class="text-body"
                        >Shipping FAQ</a
                        >
                    </li>
                    <li class="pt-3 mb-4">
                        <a href="#" title="Terms &amp; Conditions" class="text-body"
                        >Terms &amp; Conditions</a
                        >
                    </li>
                    <li class="pt-3 mb-4">
                        <a href="#" title="Privacy Policy" class="text-body"
                        >Privacy Policy</a
                        >
                    </li>
                </ul>
            </div>
            <div class="col-lg-5 col-12 mb-11 mb-lg-0">
                <h3 class="mb-4">Nhập email.</h3>
                <p class="lh-2">
                    Nhập email của bạn bên dưới để là người đầu tiên biết về các bộ sưu tập mới và ra mắt sản phẩm.
                </p>
                <form class="pt-8">
                    <div class="input-group position-relative">
                        <input
                            type="email"
                            class="form-control bg-body rounded-left"
                            placeholder="Nhập email của bạn"
                        />
                        <button
                            type="submit"
                            class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary ms-0"
                        >
                            Đăng ký
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="row align-items-center mt-0 mt-lg-20 pt-lg-4">
            <div
                class="col-sm-12 col-md-6 col-lg-4 d-flex align-items-center order-2 order-lg-1 fs-6 mt-11 mt-lg-0"
            >
                <p class="mb-0">© Glowing 2023</p>
                <ul class="list-inline fs-18px ms-6 mb-0">
                    <li class="list-inline-item me-8">
                        <a href="#"><i class="fab fa-twitter"></i></a>
                    </li>
                    <li class="list-inline-item me-8">
                        <a href="#"><i class="fab fa-facebook-f"></i></a>
                    </li>
                    <li class="list-inline-item me-8">
                        <a href="#"><i class="fab fa-instagram"></i></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="#"><i class="fab fa-youtube"></i></a>
                    </li>
                </ul>
            </div>
            <div class="col-sm-12 col-lg-4 text-md-center order-1 order-lg-2">
                <a class="d-inline-block" href="index.html">
                    <img
                        class="lazy-image img-fluid light-mode-img"
                        src="#"
                        data-src="./assets/images/others/logo.png"
                        width="179"
                        height="26"
                        alt="Glowing - Bootstrap 5 HTML Templates"
                    />
                    <img
                        class="lazy-image dark-mode-img img-fluid"
                        src="#"
                        data-src="./assets/images/others/logo-white.png"
                        width="179"
                        height="26"
                        alt="Glowing - Bootstrap 5 HTML Templates"
                    />
                </a>
            </div>
            <div
                class="col-sm-12 col-md-6 col-lg-4 order-3 text-sm-start text-lg-end mt-11 mt-lg-0"
            >
                <img
                    src="#"
                    data-src="./assets/images/footer/img_1.png"
                    width="313"
                    height="28"
                    alt="Paypal"
                    class="img-fluid lazy-image"
                />
            </div>
        </div>
    </div>
</footer>
