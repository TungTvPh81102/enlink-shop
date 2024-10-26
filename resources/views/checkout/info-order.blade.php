<div class="col-lg-4 pb-lg-0 pb-14 order-lg-last">
    <div class="card border-0 rounded-0 shadow">
        <div class="card-header px-0 mx-10 bg-transparent py-8">
            <h4 class="fs-4 mb-8">Thông tin đơn hàng</h4>
            @if(session()->has('cart'))
                @php
                    $total = 0;
                @endphp
                @foreach(session()->get('cart') as $key => $item)
                    @php
                        $subTotal = $item['price_sale'] > 0 ? $item['price_regular'] * (1 - ($item['price_sale'] / 100)) : $item['price_regular'];
                        $total += $subTotal;
                    @endphp
                    <div class="d-flex w-100 mb-7">
                        <div class="me-6">
                            <img src="{{ Storage::url($item['thumbnail_image']) }}"
                                 class="lazy-image" width="70" height="80" alt="Natural Coconut Cleansing Oil">
                        </div>
                        <div class="d-flex flex-grow-1">
                            <div class="pe-6">
                                <a href="{{ route('product.detail', $item['slug'] ?? '') }}"
                                   class>{{ Str::limit($item['name'], 20, '...') }}<span
                                        class="text-body"> x{{ $item['qty'] }}</span></a>
                                <p class="fs-14px text-body-emphasis mb-0 mt-1">Kích cỡ:
                                    <span class="text-body">{{ $item['size']['name'] }}</span>
                                </p>
                                <p class="fs-14px text-body-emphasis mb-0 mt-1">Màu:
                                    <span class="text-body">{{ $item['color']['name'] }}</span>
                                </p>
                            </div>
                            <div class="ms-auto">
                                <p class="fs-14px text-body-emphasis mb-0 fw-bold">{{ number_format($subTotal) }}đ</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <p class="fs-14px text-body-emphasis mb-0">Bạn chưa chọn sản phẩm nào.</p>
            @endif
        </div>
        <div class="card-body px-10 py-8">
            <div class="d-flex align-items-center mb-2">
                <span>Tạm tính:</span>
                <span
                    class="d-block ms-auto text-body-emphasis fw-bold">{{ $total ? number_format($total) : '0' }}đ</span>
            </div>
            <div class="d-flex align-items-center">
                <span>Vận chuyển:</span>
                <span class="d-block ms-auto text-body-emphasis fw-bold">Free</span>
            </div>
        </div>
        <div class="card-footer bg-transparent py-5 px-0 mx-10">
            <div class="d-flex align-items-center fw-bold mb-6">
                <span class="text-body-emphasis p-0">Tổng thanh toán:</span>
                @if(session()->has('coupon'))
                    @php
                        $finalTotal = $total - session()->get('coupon')['reduce'];
                    @endphp
                    <span id="final_total"
                          class="d-block ms-auto text-body-emphasis fs-4 fw-bold">{{ number_format($finalTotal)  }}đ</span>
                    <input type="hidden" name="total_price" value="{{ $finalTotal }}">
                @else
                    <span id="final_total"
                          class="d-block ms-auto text-body-emphasis fs-4 fw-bold">{{ isset($total) ? number_format($total) : '0' }}đ</span>
                    <input type="hidden" name="total_price" value="{{ $total }}">
                @endif
            </div>
        </div>
        <input type="text" id="total" name="total_price" value="{{ $total }}">
    </div>
</div>
