<div class="side-nav">
    <div class="side-nav-inner">
        <ul class="side-nav-menu scrollable">
            <li class="nav-item ">
                <a class="dropdown-toggle " href="{{ route('admin.dashboard') }}">
                                <span class="icon-holder">
                                    <i class="anticon anticon-dashboard"></i>
                                </span>
                    <span class="title">Dashboard</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-appstore"></i>
                                </span>
                    <span class="title">Quản lý danh mục</span>
                    <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('admin.categories.index') }}">Danh mục sản phẩm</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.blog-categories.index') }}">Danh mục bài viết</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-appstore"></i>
                                </span>
                    <span class="title">Quản lý thương hiệu</span>
                    <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('admin.brands.index') }}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.brands.create') }}">Thêm mới</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="bx bx-store"></i>
                                </span>
                    <span class="title">Quản lý sản phẩm</span>
                    <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('admin.products.index') }}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.products.create') }}">Thêm mới</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-appstore"></i>
                                </span>
                    <span class="title">Quản lý biến thể</span>
                    <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('admin.sizes.index') }}">Size</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.colors.index') }}">Color</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="bx bxs-discount"></i>
                                </span>
                    <span class="title">Quản lý mã giảm giá</span>
                    <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('admin.coupons.index') }}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.coupons.index') }}">Thêm mới</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ route('admin.orders.index') }}">
                                <span class="icon-holder">
                                    <i class="bx bx-data"></i>
                                </span>
                    <span class="title">Quản lý đơn hàng</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="anticon anticon-usergroup-add"></i>
                                </span>
                    <span class="title">Quản lý người dùng</span>
                    <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('admin.users.index') }}">Danh sách</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.users.create') }}">Thêm mới</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item dropdown">
                <a class="dropdown-toggle" href="javascript:void(0);">
                                <span class="icon-holder">
                                    <i class="bx bx-line-chart"></i>
                                </span>
                    <span class="title">Quản lý thống kê</span>
                    <span class="arrow">
                                    <i class="arrow-icon"></i>
                                </span>
                </a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ route('admin.sizes.index') }}">Size</a>
                    </li>
                    <li>
                        <a href="{{ route('admin.colors.index') }}">Color</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ route('admin.banners.index') }}">
                                <span class="icon-holder">
                                    <i class="bx bx-image"></i>
                                </span>
                    <span class="title">Quản lý banner</span>
                </a>
            </li>

            <li class="nav-item dropdown">
                <a href="{{ route('admin.settings.index') }}">
                                <span class="icon-holder">
                                    <i class="bx bx-cog bx-spin"></i>
                                </span>
                    <span class="title">Quản lý cài đặt</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ route('admin.roles.index') }}">
                                <span class="icon-holder">
                                           <i class="bx bx-user-circle"></i>
                                </span>
                    <span class="title">Phân quyền</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ route('admin.contacts.index') }}">
                                <span class="icon-holder">
                                           <i class="bx bx-message"></i>
                                </span>
                    <span class="title">Quản lý liên hệ</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ route('admin.blog-posts.index') }}">
                                <span class="icon-holder">
                                           <i class="bx bx-news"></i>
                                </span>
                    <span class="title">Quản lý bài viết</span>
                </a>
            </li>
            <li class="nav-item dropdown">
                <a href="{{ route('home') }}">
                                <span class="icon-holder">
                                           <i class="bx bx-store"></i>
                                </span>
                    <span class="title">Quay lại cửa hàng</span>
                </a>
            </li>
        </ul>
    </div>
</div>
