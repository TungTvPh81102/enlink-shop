<div
    id="shoppingCart"
    data-bs-scroll="false"
    class="offcanvas offcanvas-end"
>
    <div class="offcanvas-header fs-4">
        <h4 class="offcanvas-title fw-semibold">Giỏ hàng</h4>
        <button
            type="button"
            class="btn-close btn-close-bg-none"
            data-bs-dismiss="offcanvas"
            aria-label="Close"
        >
            <i class="far fa-times"></i>
        </button>
    </div>
    <div class="offcanvas-body me-xl-auto pt-0 mb-2 mb-xl-0">
        <form class="table-responsive-md shopping-cart pb-8 pb-lg-10">
            <table class="table table-borderless">
                <thead>
                <tr class="fw-500">
                    <td colspan="3" class="border-bottom pb-6">
                        <i
                            class="far fa-check fs-12px border me-4 px-2 py-1 text-body-emphasis border-dark rounded-circle"
                        ></i>
                        Your cart is saved for the next
                        <span class="text-body-emphasis">4m34s</span>
                    </td>
                </tr>
                </thead>
                <tbody>
                @php
                    $total = 0;
                @endphp
                @if(!empty(session()->get('cart')))
                    @foreach(session()->get('cart') as $key => $item)
                        @php
                            $discountPrice = $item['price_sale'] > 0 ? $item['price'] * (1 - ($item['price_sale'] / 100)) : $item['price'];
                            $total += $discountPrice * $item['qty'];
                        @endphp
                        <tr class="position-relative">
                            <td class="align-middle text-center">
                                <a href="{{ route('cart.delete-cart', $key) }}" class="d-block clear-product">
                                    <i class="far fa-times"></i>
                                </a>
                            </td>
                            <td class="shop-product">
                                <div class="d-flex align-items-center">
                                    <div class="me-6">
                                        <img
                                            src="{{ Storage::url($item['thumbnail_image']) }}"
                                            width="60"
                                            height="80"
                                            alt="{{ $item['name'] }}"
                                        />
                                    </div>
                                    <div class>
                                        <p class="card-text mb-1">
                                            @if($item['price_sale'] > 0)
                                                <span
                                                    class="fs-13px fw-500 text-decoration-line-through pe-3">{{ number_format( $item['price'])  }}</span>
                                                <span
                                                    class="fs-15px fw-bold text-body-emphasis">{{ number_format($discountPrice) }}</span>
                                            @else
                                                <span
                                                    class="fs-15px fw-bold text-body-emphasis">{{ number_format($item['price']) }}</span>
                                            @endif

                                        </p>
                                        <p class="fw-500 text-body-emphasis">{{ Str::limit($item['name'], 20, '...') }}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="align-middle p-0">
                                <div class="input-group position-relative shop-quantity">
                                    <a href="#" class="shop-down position-absolute z-index-2">
                                        <i class="far fa-minus"></i>
                                    </a>
                                    <input
                                        name="number[]"
                                        type="number"
                                        class="form-control form-control-sm px-6 py-4 fs-6 text-center border-0"
                                        value="1"
                                        required
                                    />
                                    <a href="#" class="shop-up position-absolute z-index-2"
                                    ><i class="far fa-plus"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="3" class="align-middle text-center">
                            Không có sản phẩm nào trong giỏ hàng
                            <a href="{{ route('product-category.list') }}" class="text-body-emphasis">Đến cửa hàng</a>
                        </td>
                    </tr>
                @endif
                </tbody>
            </table>
        </form>
    </div>
    @if(!empty(session()->get('cart')))
        <div class="offcanvas-footer flex-wrap">
            <div
                class="d-flex align-items-center justify-content-between w-100 mb-5"
            >
                <span class="text-body-emphasis">Tổng tiền:</span>
                <span class="cart-total fw-bold text-body-emphasis">{{ $total ? number_format($total) : '0' }}</span>
            </div>
            <a
                href="{{ route('checkout.show-form-checkout') }}"
                class="btn btn-dark w-100 mb-7"
                title="Check Out"
            >Thanh toán</a
            >
            <a
                href="{{ route('cart.view') }}"
                class="btn btn-outline-dark w-100"
                title="View shopping cart"
            >Xem giỏ hàng</a
            >
        </div>
    @endif
</div>
