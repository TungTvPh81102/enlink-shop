@extends('layouts._app')

@section('content')
    <section class="z-index-2 position-relative pb-2 mb-12">
        <div class="bg-body-secondary mb-3">
            <div class="container">
                <nav class="py-4 lh-30px" aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center py-1 mb-0">
                        <li class="breadcrumb-item"><a title="Home" href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a title="Shop" href="{{ route('product-category.list') }}">Cửa
                                hàng</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Giỏ hàng</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>

    <section class="container">
        <div class="shopping-cart">
            <h2 class="text-center fs-2 mt-12 mb-13">{{ $title }}</h2>
            <form class="table-responsive-md pb-8 pb-lg-10" method="POST">
                @csrf
                <table class="table border">
                    <thead class="bg-body-secondary">
                    <tr class="fs-15px letter-spacing-01 fw-semibold text-uppercase text-body-emphasis">
                        <th scope="col" class="fw-semibold border-1 ps-11">Sản phẩm</th>
                        <th scope="col" class="fw-semibold border-1">Số lượng</th>
                        <th colspan="2" class="fw-semibold border-1">Giá</th>
                    </tr>
                    </thead>
                    <tbody>
                    @if(count($cartDetails) > 0)
                        @php
                            $total = 0;
                        @endphp
                        @foreach($cartDetails as $item)
                            @php
                                $variant = $item->productVariant ?? null;
                                $product = $variant ? $variant->product : null;
                                $discountedPrice = $product->price_sale > 0
                                    ? $variant->price * (1 - ($product->price_sale / 100))
                                    : $variant->price;
                                $subTotal = $discountedPrice * $item->quantity;
                                $total += $subTotal;
                            @endphp
                            <tr class="position-relative">
                                <th scope="row" class="pe-5 ps-8 py-7 shop-product">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input rounded-0" type="checkbox"
                                                   name="check-product[]" value="{{ $item->id }}">
                                        </div>
                                        <div class="ms-6 me-7">
                                            <img style="object-fit: cover"
                                                 src="{{  Storage::url($product->thumbnail_image) }}"
                                                 class="lazy-image" width="75" height="100"
                                                 alt="{{  $product->name }}">
                                        </div>
                                        <div>
                                            <p class="fw-500 mb-1 text-body-emphasis">{{ Str::limit($product->name , 50, '...') }}</p>
                                            <p class="card-text">
                                                    <span class="fs-13px fw-bold text-body-emphasis">
                                                        Kích cỡ: {{  $variant->size->name}}
                                                    </span>
                                                <span class="fs-13px fw-bold text-body-emphasis">
                                                        Màu sắc: {{  $variant->color->name  }}
                                                    </span>
                                            </p>
                                            <p class="card-text">
                                                @if($product->price_sale > 0)
                                                    <span class="fs-13px fw-500 text-decoration-line-through pe-3">{{ number_format($variant->price) }}đ</span>
                                                    <span class="fs-15px fw-bold text-body-emphasis">{{ number_format($discountedPrice) }}đ</span>
                                                @else
                                                    <span class="fs-15px fw-bold text-body-emphasis">{{ number_format($variant->price) }}đ</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </th>
                                <td class="align-middle">
                                    <div class="input-group position-relative shop-quantity">
                                        <a href="#" class="shop-down position-absolute z-index-2"><i
                                                class="far fa-minus"></i></a>
                                        <input name="quantity[{{ $item->id }}]" type="number"
                                               class="form-control form-control-sm px-10 py-4 fs-6 text-center border-0"
                                               value="{{ $item->quantity }}" required>
                                        <a href="#" class="shop-up position-absolute z-index-2"><i
                                                class="far fa-plus"></i></a>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0 text-body-emphasis fw-bold mr-xl-11">{{  number_format($subTotal) }}</p>
                                </td>
                                <td class="align-middle text-end pe-8">
                                    <a href="{{ route('cart.delete-cart', $item->product_variant_id) }}" class="d-block text-secondary">
                                        <i class="fa fa-times"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        <tr>
                            <td class="pt-5 pb-10 position-relative bg-body ps-0 left">
                                <a href="{{ route('product-category.list') }}" title="Countinue Shopping"
                                   class="btn btn-outline-dark me-8 text-nowrap my-5">
                                    Tiếp tục mua sắm
                                </a>
                                <button type="submit" value="Clear Shopping Cart"
                                        class="btn btn-link p-0 border-0 border-bottom border-secondary text-decoration-none rounded-0 my-5 fw-semibold ">
                                    <i class="fa fa-times me-3"></i>
                                    Xoá giỏ hàng
                                </button>
                            </td>
                            <td colspan="3" class="text-end pt-5 pb-10 position-relative bg-body right pe-0">
                                <button type="submit" value="Update Cart" class="btn btn-outline-dark my-5">
                                    Cập nhật
                                </button>
                            </td>
                        </tr>
                    @else
                        <p class="text-center">Không có sản phẩm nào trong giỏ hàng</p>
                    @endif
                    </tbody>
                </table>
            </form>
            <div class="row pt-8 pt-lg-11 pb-16 pb-lg-18">
                <div class="col-lg-4 pt-2">
                    <h4 class="fs-24 mb-6">Coupon Discount</h4>
                    <p class="mb-7">Enter your coupon code if you have one.</p>
                    <form>
                        <input type="text" class="form-control mb-7" placeholder="Enter coupon code here">
                        <button type="submit" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary">
                            Apply coupon
                        </button>
                    </form>
                </div>

                <!-- Shipping Calculator Section -->
                <div class="col-lg-4 pt-lg-2 pt-10">
                    <h4 class="fs-24 mb-6">Shipping Calculator</h4>
                    <form>
                        <div class="d-flex mb-5">
                            <div class="form-check me-6 me-lg-9">
                                <input class="form-check-input form-check-input-body-emphasis" type="radio"
                                       name="flexRadioDefault" id="flexRadioDefault1">
                                <label class="form-check-label" for="flexRadioDefault1">
                                    Free shipping
                                </label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input form-check-input-body-emphasis" type="radio"
                                       name="flexRadioDefault" id="flexRadioDefault2" checked>
                                <label class="form-check-label" for="flexRadioDefault2">
                                    Flat rate: $75
                                </label>
                            </div>
                        </div>
                        <div class="dropdown bg-body-secondary rounded mb-7">
                            <a href="#"
                               class="form-select text-body-emphasis dropdown-toggle d-flex justify-content-between align-items-center text-decoration-none text-secondary position-relative d-block"
                               role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Viet Nam
                            </a>
                            <div class="dropdown-menu w-100 px-0 py-4">
                                <a class="dropdown-item px-6 py-4" href="#">Andorra</a>
                                <a class="dropdown-item px-6 py-4" href="#">San Marino</a>
                                <a class="dropdown-item px-6 py-4" href="#">Tunisia</a>
                                <a class="dropdown-item px-6 py-4" href="#">Micronesia</a>
                                <a class="dropdown-item px-6 py-4" href="#">Solomon Islands</a>
                                <a class="dropdown-item px-6 py-4" href="#">Macedonia</a>
                            </div>
                        </div>
                        <input type="text" class="form-control mb-7" placeholder="State / County" required>
                        <input type="text" class="form-control mb-7" placeholder="City" required>
                        <input type="text" class="form-control mb-7" placeholder="Postcode / Zip">
                        <button type="submit" class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary">
                            Update total
                        </button>
                    </form>
                </div>

                <div class="col-lg-4 pt-lg-0 pt-11">
                    <div class="card border-0" style="box-shadow: 0 0 10px 0 rgba(0,0,0,0.1)">
                        <div class="card-body px-9 pt-6">
                            <div class="d-flex align-items-center justify-content-between mb-5">
                                <span>Subtotal:</span>
                                <span
                                    class="d-block ml-auto text-body-emphasis fw-bold">{{ isset($total) ? number_format($total) : '0' }}  </span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between">
                                <span>Shipping:</span>
                                <span class="d-block ml-auto text-body-emphasis fw-bold">$0</span>
                            </div>
                        </div>
                        <div class="card-footer bg-transparent px-0 pt-5 pb-7 mx-9">
                            <div class="d-flex align-items-center justify-content-between fw-bold mb-7">
                                <span class="text-secondary text-body-emphasis">Total pricre:</span>
                                <span class="d-block ml-auto text-body-emphasis fs-4 fw-bold">$99.00</span>
                            </div>
                            <a href="{{ route('checkout.show-form-checkout') }}"
                               class="btn w-100 btn-dark btn-hover-bg-primary btn-hover-border-primary"
                               title="Check Out">Check Out</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection