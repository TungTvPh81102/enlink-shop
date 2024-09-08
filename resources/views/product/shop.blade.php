@extends('layouts._app')

@section('styles')
    <style>
        .selected-color {
            border: 2px solid black !important;
        }
    </style>
@endsection

@section('content')
    <section class="page-title z-index-2 position-relative">
        <div class="bg-body-secondary">
            <div class="container">
                <nav class="py-4 lh-30px" aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center py-1">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                        @if(!empty($parentCategory))
                            <li class="breadcrumb-item " aria-current="page">{{ $parentCategory->name }}</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $subCategory->name }}</li>
                        @elseif(!empty($category))
                            <li class="breadcrumb-item active"
                                aria-current="page">{{ $category->name  }}</li>
                        @else
                            <li class="breadcrumb-item active" aria-current="page">
                                @if(request('q'))
                                    Tìm kiếm
                                @else
                                    Cửa hàng
                                @endif
                            </li>
                        @endif
                    </ol>
                </nav>
            </div>
        </div>
        <div class="text-center py-13">
            <div class="container">
                @if(!empty($parentCategory))
                    <h2 class="mb-0">{{ $subCategory->name }}</h2>
                @elseif(!empty($category))
                    <h2 class="mb-0">{{ $category->name   }}</h2>
                @else
                    <h2 class="mb-0">
                        @if(request('query'))
                            Kết quả tìm kiếm: {{ request('q') }}
                        @else
                            Cửa hàng
                        @endif
                    </h2>
                @endif
            </div>

        </div>
    </section>
    <section class="container container-xxl">
        <div class="tool-bar mb-11 align-items-center justify-content-between d-lg-flex">
            <div class="tool-bar-left mb-6 mb-lg-0 fs-18px">Có <span
                    class="text-body-emphasis fw-semibold" id="getQuantityProduct">{{ count($products) }}</span> sản
                phẩm dành cho bạn
            </div>
            <form id="fillterForm" action="" method="post">
                @csrf
                <input type="hidden" name="q" id="q" value="{{ request('q') ?? '' }}">
                <input type="hidden" name="brand_id" id="brand_id">
                <input type="hidden" name="color_id" id="color_id">
                <input type="hidden" name="sort_by" id="sort_by">
            </form>
            <div class="tool-bar-right align-items-center d-flex ">
                <ul class="list-unstyled d-flex align-items-center list-inline mb-0 ms-auto">
                    <li class="list-inline-item me-0">
                        <select class="form-select changOrderBy" name="orderby">
                            <option value="" selected="selected">Mặc định</option>
                            <option value="is_hot">Phổ biến</option>
                            <option value="date">Mới nhất</option>
                            <option value="price_sale">Giảm giá sốc</option>
                            <option value="price">Sắp xếp theo giá: thấp đến cao</option>
                            <option value="price-desc">
                                Sắp xếp theo giá: cao xuống thấp
                            </option>
                        </select>
                    </li>
                </ul>
            </div>
        </div>
    </section>
    <div class="container container-xxl pb-16 pb-lg-18">
        <div class="row">
            <div class="col-lg-9 order-lg-1" id="getFilterProduct">
                @include('product._shop', ['products' => $products])
            </div>
            <div class="col-lg-3 d-lg-block d-none">
                <div class="position-sticky top-0">
                    <aside class="primary-sidebar pe-xl-9 me-xl-2 mt-12 pt-2 mt-lg-0 pt-lg-0">
                        <div class="widget widget-product-category">
                            <h4 class="widget-title fs-5 mb-6">Danh mục</h4>
                            @if(!empty($categories))
                                <ul class="navbar-nav navbar-nav-cate" id="widget_product_category">
                                    @foreach($categories as $category)
                                        <li class="nav-item">
                                            <a href="{{ $category->children->count() == 0 ? route('product-category.list', $category->slug) : 'javascript:void(0);' }}"
                                               title="Skin care"
                                               class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center text-uppercase fs-14px fw-semibold letter-spacing-5 active">
                                                <span class="text-hover-underline me-2">{{ $category->name }}</span>
                                                @if($category->children->count() > 0)
                                                    <span data-bs-toggle="collapse"
                                                          data-bs-target="#cat_skin-care-{{ $category->id }}"
                                                          class="caret flex-grow-1 d-flex align-items-center justify-content-end collapsed"><svg
                                                            class="icon"><use xlink:href="#icon-plus"></use></svg>
                                                    </span>
                                                @endif
                                            </a>
                                            <div id="cat_skin-care-{{ $category->id }}" class="collapse show"
                                                 data-bs-parent="#cat_skin-care">
                                                <ul class="navbar-nav nav-submenu ps-8">
                                                    @foreach($category -> children as $child)
                                                        <li class="nav-item">
                                                            <a class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"
                                                               href="{{ route('product-category.list', $category->slug . '/' . $child->slug) }}"><span
                                                                    class="text-hover-underline">{{  $child->name }}</span></a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif

                        </div>
                        @if(!empty($brands))
                            <div class="widget widget-product-hightlight">
                                <h4 class="widget-title fs-5 mb-6">Thương hiệu</h4>
                                <ul class="navbar-nav navbar-nav-cate" id="widget_product_hightlight">
                                    @foreach($brands as $item)
                                        <li class="nav-item d-flex">
                                            <input class="changeBrands" id="changeBrands-{{ $item->id }}"
                                                   type="checkbox"
                                                   value="{{ $item->id }}">
                                            <label style="cursor: pointer" for="changeBrands-{{ $item->id }}"
                                                   title="Best Seller"
                                                   class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center">
                                            <span
                                                style="margin-left: 10px"
                                                class="text-hover-underline">
                                                {{ $item->name }}</span>
                                            </label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="widget widget-product-price">
                            <h4 class="widget-title fs-5 mb-6">Giá</h4>
                            <ul class="navbar-nav navbar-nav-cate" id="widget_product_price">
                                <li class="nav-item">
                                    <a href="#" title="All"
                                       class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"><span
                                            class="text-hover-underline">All</span></a></li>
                                <li class="nav-item">
                                    <a href="#" title="$10 - $50"
                                       class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"><span
                                            class="text-hover-underline">$10 - $50</span></a></li>
                                <li class="nav-item">
                                    <a href="#" title="$50 - $100"
                                       class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"><span
                                            class="text-hover-underline">$50 - $100</span></a></li>
                                <li class="nav-item">
                                    <a href="#" title="$100 - $200"
                                       class="text-reset position-relative d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center"><span
                                            class="text-hover-underline">$100 - $200</span></a></li>
                            </ul>
                        </div>
                        <div class="widget widget-product_colors">
                            <h4 class="widget-title fs-5 mb-6">Màu sắc</h4>
                            <ul class="navbar-nav navbar-nav-cate" id="widget_product_colors">
                                @php
                                    $displayedColors = [];
                                @endphp
                                @foreach($products as $product)
                                    @foreach($product->variants as $variant)
                                        @php
                                            $colorCode = $variant->color->code;
                                        @endphp
                                        @if(!in_array($colorCode, $displayedColors))
                                            @php
                                                $displayedColors[] = $colorCode;
                                            @endphp
                                            <li class="nav-item">
                                                <a href="javascript:void(0)"
                                                   id="{{ $variant->color->id }}"
                                                   data-val="0"
                                                   class="text-reset position-relative changeColor d-block text-decoration-none text-body-emphasis-hover d-flex align-items-center">
                                                    <span class="square rounded-circle me-4 "
                                                          style="background-color: {{ $variant->color->code }}"></span>
                                                    <label style="cursor: pointer"
                                                           class="text-hover-underline">{{ $variant->color->name }}</label>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                @endforeach
                            </ul>
                        </div>
                        <div class="widget widget-tags">
                            <h4 class="widget-title fs-5 mb-6">Tags</h4>
                            <ul class="w-100 mt-n4 list-unstyled d-flex flex-wrap mb-0">
                                <li class="me-6 mt-4">
                                    <a href="#" title="Cleansing"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Cleansing</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="Make up"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Make
                                        up</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="eye cream"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">eye
                                        cream</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="nail"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">nail</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="shampoo"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">shampoo</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="coffee bean"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">coffee
                                        bean</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="healthy"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">healthy</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="skin care"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">skin
                                        care</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="sale"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">sale</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="Cosmetics"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Cosmetics</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="Natural cleansers"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Natural
                                        cleansers</a>
                                </li>
                                <li class="me-6 mt-4">
                                    <a href="#" title="Organic"
                                       class="text-reset d-block text-decoration-none text-body-emphasis-hover text-hover-underline">Organic</a>
                                </li>
                            </ul>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script type="text/javascript">
        $(document).ready(function () {
            $('.changOrderBy').change(function () {
                var id = $(this).val();

                $('#sort_by').val(id);
                fillterForm()
            })

            $('.changeBrands').change(function () {
                var selectedBrands = [];
                $('.changeBrands:checked').each(function () {
                    selectedBrands.push($(this).val());
                });

                $('#brand_id').val(selectedBrands.join(','));
                fillterForm()
            })

            $('.changeColor').click(function () {
                var id = $(this).attr('id');
                var status = $(this).attr('data-val');

                if (status == 0) {
                    $(this).attr('data-val', 1);
                    $(this).find('.square').addClass('selected-color');
                } else {
                    $(this).attr('data-val', 0);
                    $(this).find('.square').removeClass('selected-color');
                }

                var ids = '';
                $('.changeColor').each(function () {
                    var status = $(this).attr('data-val');

                    if (status == 1) {
                        var id = $(this).attr('id');
                        ids += id + ',';
                    }

                })

                $('#color_id').val(ids);
                fillterForm()
            })

            function fillterForm() {
                $.ajax({
                    type: "POST",
                    url: "{{ route('product.filter') }}",
                    data: $('#fillterForm').serialize(),
                    dataType: "json",
                    success: function (response) {
                        if (response.status === true) {
                            $('#getFilterProduct').html(response.data);
                            $('#getQuantityProduct').html(response.total);
                        }
                    },
                    error: function (error) {
                        console.log(error);
                    }
                });
            }
        });
    </script>
@endsection
