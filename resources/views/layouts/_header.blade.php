<header id="header" class="header header-sticky header-sticky-smart z-index-5">
    <div class="bg-primary bg-opacity-15">
        <div class="container-xxl container d-flex py-4">
            <div class="w-50 d-none d-lg-block">
                <ul class="social-icons list-inline mb-0 fs-14">
                    <li class="list-inline-item">
                        <a href="#" title="Twitter">
                            <svg class="icon">
                                <use xlink:href="#twitter"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="list-inline-item ms-6">
                        <a href="#" title="Facebook">
                            <svg class="icon">
                                <use xlink:href="#facebook"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="list-inline-item ms-6">
                        <a href="#" title="Instagram">
                            <svg class="icon">
                                <use xlink:href="#instagram"></use>
                            </svg>
                        </a>
                    </li>
                    <li class="list-inline-item ms-6">
                        <a href="#" title="Youtube">
                            <svg class="icon">
                                <use xlink:href="#youtube"></use>
                            </svg>
                        </a>
                    </li>
                </ul>
            </div>
            <div class="w-100 text-center">
                <p class="mb-0 fs-14px fw-bold text-primary text-uppercase">
                    Miễn phí vận chuyển cho tất cả các đơn hàng 500,000 đ
                     </p>
            </div>
            <div class="w-50 d-none d-lg-block">
                <div class="d-flex align-items-center justify-content-end">
                    <div class="dropdown me-10">
                        <span class="d-inline-block me-3"><img src="images/header/flag.html" alt=""></span>
                        <button
                            class="btn btn-link dropdown-toggle fw-semibold text-uppercase ls-1 p-0 dropdown-menu-end fs-13px"
                            type="button" data-bs-toggle="dropdown" aria-expanded="false">
                            English
                        </button>
                        <div class="dropdown-menu dropdown-menu-end py-5" style="min-width: unset">
                            <a class="dropdown-item py-1" href="#">Vietnamese</a>
                            <a class="dropdown-item py-1" href="#">Spanish</a>
                            <a class="dropdown-item py-1" href="#">Korean</a>
                            <a class="dropdown-item py-1" href="#">Chinese</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="sticky-area-wrap" style="height: 102.4px;">
        <div class="sticky-area" style="">
            <div class="main-header nav navbar bg-body navbar-light navbar-expand-xl py-6 py-xl-0">
                <div class="container-xxl container">
                    <div class="d-flex d-xl-none w-100">
                        <div class="w-72px d-flex d-xl-none">
                            <button class="navbar-toggler align-self-center border-0 shadow-none px-0 canvas-toggle p-4"
                                    type="button" data-bs-toggle="offcanvas" data-bs-target="#offCanvasNavBar"
                                    aria-controls="offCanvasNavBar" aria-expanded="false"
                                    aria-label="Toggle Navigation">
                                <span class="fs-24 toggle-icon"></span>
                            </button>
                        </div>
                        <div class="d-flex mx-auto">
                            <a href="{{ route('home') }}" class="navbar-brand px-8 py-4 mx-auto" previewlistener="true">
                                <img class="light-mode-img" src="http://localhost/project/assets/client/logo.png"
                                     width="179" height="26" alt="Glowing - Bootstrap 5 HTML Templates">
                                <img class="dark-mode-img" src="http://localhost/project/assets/client/logo.png"
                                     width="179" height="26" alt="Glowing - Bootstrap 5 HTML Templates">
                            </a>
                        </div>
                        <div class="icons-actions d-flex justify-content-end w-xl-50 fs-28px text-body-emphasis">
                            <div class="px-xl-5 d-inline-block">
                                <a class="lh-1 color-inherit text-decoration-none" href="#" data-bs-toggle="offcanvas"
                                   data-bs-target="#searchModal" aria-controls="searchModal" aria-expanded="false">
                                    <svg class="icon icon-magnifying-glass-light">
                                        <use xlink:href="#icon-magnifying-glass-light"></use>
                                    </svg>
                                </a>
                            </div>
                            <div class="color-modes position-relative ps-5">
                                <a class="bd-theme btn btn-link nav-link dropdown-toggle d-inline-flex align-items-center justify-content-center text-primary p-0 position-relative rounded-circle"
                                   href="#" aria-expanded="true" data-bs-toggle="dropdown" data-bs-display="static"
                                   aria-label="Toggle theme (light)">
                                    <svg class="bi my-1 theme-icon-active">
                                        <use href="#moon-stars-fill"></use>
                                    </svg>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end fs-14px" data-bs-popper="static">
                                    <li>
                                        <button type="button" class="dropdown-item d-flex align-items-center"
                                                data-bs-theme-value="light" aria-pressed="false">
                                            <svg class="bi me-4 opacity-50 theme-icon">
                                                <use href="#sun-fill"></use>
                                            </svg>
                                            Light
                                            <svg class="bi ms-auto d-none">
                                                <use href="#check2"></use>
                                            </svg>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item d-flex align-items-center active"
                                                data-bs-theme-value="dark" aria-pressed="true">
                                            <svg class="bi me-4 opacity-50 theme-icon">
                                                <use href="#moon-stars-fill"></use>
                                            </svg>
                                            Dark
                                            <svg class="bi ms-auto d-none">
                                                <use href="#check2"></use>
                                            </svg>
                                        </button>
                                    </li>
                                    <li>
                                        <button type="button" class="dropdown-item d-flex align-items-center"
                                                data-bs-theme-value="auto" aria-pressed="false">
                                            <svg class="bi me-4 opacity-50 theme-icon">
                                                <use href="#circle-half"></use>
                                            </svg>
                                            Auto
                                            <svg class="bi ms-auto d-none">
                                                <use href="#check2"></use>
                                            </svg>
                                        </button>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="d-none d-xl-flex flex-column flex-xl-row w-100">
                        <div class="w-auto w-xl-50 d-flex align-items-center">
                            <div
                                class="icons-actions d-none d-xl-flex justify-content-start me-auto fs-28px text-body-emphasis">
                                <div class="pe-6">
                                    <a class="lh-1 color-inherit text-decoration-none" href="#"
                                       data-bs-toggle="offcanvas" data-bs-target="#searchModal"
                                       aria-controls="searchModal" aria-expanded="false">
                                        <svg class="icon icon-magnifying-glass-light fs-5">
                                            <use xlink:href="#icon-magnifying-glass-light"></use>
                                        </svg>
                                        <span class="fs-15px">Tìm kiếm</span>
                                    </a>
                                </div>
                            </div>
                            <ul class="navbar-nav w-100 w-xl-auto">
                                <li class="nav-item transition-all-xl-1 py-xl-11 py-0 px-xxl-8 px-xl-6 dropdown dropdown-hover dropdown-fullwidth">
                                    <a class="nav-link d-flex justify-content-between position-relative py-xl-0 px-xl-0 text-uppercase fw-semibold ls-1 fs-15px fs-xl-14px"
                                       href="{{ route('home') }}">Trang chủ</a>
                                </li>
                                <li class="nav-item transition-all-xl-1 py-xl-11 py-0 px-xxl-8 px-xl-6 dropdown dropdown-hover">
                                    <a class="nav-link d-flex justify-content-between position-relative py-xl-0 px-xl-0 text-uppercase fw-semibold ls-1 fs-15px fs-xl-14px dropdown-toggle"
                                       href="{{ route('product-category.list') }}" id="menu-item-pages"
                                       aria-haspopup="true"
                                       aria-expanded="false">Sản phẩm</a>
                                    <ul class="dropdown-menu py-6" aria-labelledby="menu-item-pages">
                                        @foreach($categories as $category)
                                            <li class="dropend dropdown-hover" aria-haspopup="true"
                                                aria-expanded="false">
                                                <a class="dropdown-item pe-6 {{ $category->children->count() > 0 ? 'dropdown-toggle' : '' }}  d-flex justify-content-between border-hover"
                                                   href="{{ route('product-category.list', $category->slug) }}"
                                                   id="menu-item-contact-us">
                                                    <span class="border-hover-target">{{ $category->name }}</span>
                                                </a>
                                                @if($category->children->count() > 0)
                                                    <ul class="dropdown-menu py-6"
                                                        aria-labelledby="menu-item-contact-us"
                                                        data-bs-popper="none">
                                                        @foreach($category->children as $child)
                                                            <li>
                                                                <a class="dropdown-item border-hover"
                                                                   href="{{ route('product-category.list', $category->slug.'/'.$child->slug) }}"
                                                                >
                                                                <span
                                                                    class="border-hover-target">{{ $child->name }}</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    </ul>
                                </li>
                            </ul>
                        </div>
                        <div class="px-10 d-none d-xl-flex align-items-center">
                            <a href="{{ route('home') }}" class="navbar-brand px-8 py-4 mx-auto"
                               previewlistener="true">
                                <img class="light-mode-img" src="http://du-an-poly.trihd.id.vn/assets/client/logo.png"
                                     width="179" height="26" alt="Glowing - Bootstrap 5 HTML Templates">
                                <img class="dark-mode-img"
                                     src="http://du-an-poly.trihd.id.vn/assets/client/images/others/logo-white.png"
                                     width="179" height="26" alt="Glowing - Bootstrap 5 HTML Templates"></a>
                        </div>
                        <div class="w-auto w-xl-50 d-flex align-items-center">
                            <div class="w-auto w-xl-50 d-flex align-items-center">

                                <ul class="navbar-nav w-100 w-xl-auto">
                                    <li class="nav-item transition-all-xl-1 py-xl-11 py-0 px-xxl-8 px-xl-6 dropdown dropdown-hover dropdown-fullwidth">
                                        <a class="nav-link d-flex justify-content-between position-relative py-xl-0 px-xl-0 text-uppercase fw-semibold ls-1 fs-15px fs-xl-14px"
                                           href="http://du-an-poly.trihd.id.vn/?action=contact">Bài viết</a>
                                    </li>
                                    <li class="nav-item transition-all-xl-1 py-xl-11 py-0 px-xxl-8 px-xl-6 dropdown dropdown-hover dropdown-fullwidth">
                                        <a class="nav-link d-flex justify-content-between position-relative py-xl-0 px-xl-0 text-uppercase fw-semibold ls-1 fs-15px fs-xl-14px"
                                           href="{{ route('contact.show-form-contact') }}">Liên hệ</a>
                                    </li>
                                </ul>
                            </div>
                            <div
                                class="icons-actions d-none d-xl-flex justify-content-end ms-auto fs-28px text-body-emphasis">
                                <div class="px-5 d-none d-xl-inline-block">
                                    <a class="position-relative lh-1 color-inherit text-decoration-none" href="#"
                                       data-bs-toggle="offcanvas" data-bs-target="#shoppingCart"
                                       aria-controls="shoppingCart" aria-expanded="false">
                                        <svg class="icon icon-star-light">
                                            <use xlink:href="#icon-shopping-bag-open-light"></use>
                                        </svg>
                                        <span
                                            class="badge bg-dark text-white position-absolute top-0 start-100 translate-middle mt-4 rounded-circle fs-13px p-0 square"
                                            style="--square-size: 18px">{{ session()->has('cart') ? count(session()->get('cart')) : 0  }}</span>
                                    </a>
                                </div>
                                @if(Auth::check())
                                    <div class="dropdown me-10">
                                        <div class="px-5 d-none d-xl-inline-block" data-bs-toggle="dropdown"
                                             aria-expanded="false" style="cursor: pointer">
                                            <svg class="icon icon-user-light">
                                                <use xlink:href="#icon-user-light"></use>
                                            </svg>
                                        </div>
                                        <div class="dropdown-menu dropdown-menu-end py-5" style="min-width: unset">
                                            <a class="dropdown-item py-1" href="#">Thông tin cá nhân</a>
                                            <a class="dropdown-item py-1" href="#">Đơn hàng</a>
                                            @if(Auth::check() && Auth::user()->isAdmin())
                                                <a class="dropdown-item py-1" href="{{ route('admin.dashboard') }}">Truy
                                                    cập trang quản trị</a>
                                            @endif
                                            <a class="dropdown-item py-1" href="{{ route('auth.logout') }}">Đăng
                                                xuất</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="px-5 d-none d-xl-inline-block">
                                        <a class="lh-1 color-inherit text-decoration-none"
                                           href="{{ route('auth.login') }}">
                                            <svg class="icon icon-user-light">
                                                <use xlink:href="#icon-user-light"></use>
                                            </svg>
                                        </a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
