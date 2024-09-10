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
            @if(!empty($cartDetails))
            <form action="{{ route('cart.update-cart') }}" method="post" class="table-responsive-md pb-8 pb-lg-10">
                @csrf
                @method('PUT')
                <table class="table border">
                    <thead class="bg-body-secondary">
                    <tr class="fs-15px letter-spacing-01 fw-semibold text-uppercase text-body-emphasis">
                        <th scope="col" class="fw-semibold border-1 ps-11">Sản phẩm</th>
                        <th scope="col" class="fw-semibold border-1">Số lượng</th>
                        <th colspan="2" class="fw-semibold border-1">Giá</th>
                    </tr>
                    </thead>
                    <tbody>
                        @php
                            $total = 0;
                        @endphp
                        @foreach($cartDetails as $variantId => $item)
                            @php
                                $discountedPrice =  $item['price_sale'] > 0 ? $item['price'] * (1 - ($item['price_sale'] / 100)) : $item['price'];
                                $subTotal = $discountedPrice * $item['qty'];
                                $total += $subTotal;
                            @endphp
                            <tr class="position-relative">
                                <th scope="row" class="pe-5 ps-8 py-7 shop-product">
                                    <div class="d-flex align-items-center">
                                        <div class="form-check">
                                            <input class="form-check-input rounded-0" type="checkbox"
                                                   name="check-product"
                                                   value="checkbox">
                                        </div>
                                        <div class="ms-6 me-7">
                                            <img style="object-fit: cover"
                                                 src="{{ Storage::url($item['thumbnail_image']) }}"
                                                 class="lazy-image" width="75" height="100"
                                                 alt="Natural Coconut Cleansing Oil">
                                        </div>
                                        <div>
                                            <p class="fw-500 mb-1 text-body-emphasis">{{ Str::limit($item['name'], 50, '...') }}</p>
                                            <p class="card-text">
                                                <span
                                                    class="fs-13px fw-bold text-body-emphasis ">Kích cỡ: {{ $item['size']['name'] }}</span>
                                                <span
                                                    class="fs-13px fw-bold text-body-emphasis">Màu sắc: {{ $item['color']['name'] }}</span>
                                            </p>
                                            <p class="card-text">
                                                @if($item['price_sale'] > 0)
                                                    <span
                                                        class="fs-13px fw-500 text-decoration-line-through pe-3">{{ number_format($item['price']) }}đ</span>
                                                    <span class="fs-15px fw-bold text-body-emphasis">{{ number_format($discountedPrice) }}đ</span>
                                                @else
                                                    <span class="fs-15px fw-bold text-body-emphasis">{{ number_format($item['price']) }}đ</span>
                                                @endif
                                            </p>
                                        </div>
                                    </div>
                                </th>
                                <td class="align-middle">
                                        <input name="quantity[{{ $variantId }}][id]" type="hidden" value="{{ $variantId }}">
                                    <div class="input-group position-relative shop-quantity">
                                        <a href="#" class="shop-down position-absolute z-index-2"><i
                                                class="far fa-minus"></i></a>
                                        <input min="1" name="quantity[{{ $variantId }}][qty]" type="number"
                                               class="form-control form-control-sm px-10 py-4 fs-6 text-center border-0"
                                               value="{{ $item['qty'] }}" required>
                                        <a href="#" class="shop-up position-absolute z-index-2"><i
                                                class="far fa-plus"></i>
                                        </a>
                                    </div>
                                </td>
                                <td class="align-middle">
                                    <p class="mb-0 text-body-emphasis fw-bold mr-xl-11">{{ number_format($subTotal) }}</p>
                                </td>
                                <td class="align-middle text-end pe-8">
                                    <a href="{{ route('cart.delete-cart', $variantId) }}"
                                       class="d-block text-secondary ">
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
                                <button id="clear-cart" type="button" value="Clear Shopping Cart"
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
                    </tbody>
                </table>
            </form>
            <div class="row pt-8 pt-lg-11 pb-16 pb-lg-18 justify-content-end">
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
    @else
        <p class="text-center mb-13">Không có sản phẩm nào trong giỏ hàng</p>
    @endif
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#clear-cart').on('click', function () {

                Swal.fire({
                    title: "Bạn có muốn xóa toàn bộ giỏ hàng ?",
                    icon: "warning",
                    showCancelButton: true,
                    confirmButtonColor: "#DD6B55",
                    confirmButtonText: "Đồng ý!!",
                    cancelButtonText: "Huỷ!!"
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            type: "DELETE",
                            url: "{{ route('cart.clear-cart') }}",
                            success: function (data) {
                                console.log(data);
                                Swal.fire({
                                    title: data.message,
                                    icon: 'success'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    } else if (data.status === 'error') {
                                        Swal.fire({
                                            title: data.message,
                                            icon: 'error'
                                        });
                                    }
                                });
                            }, error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }
                });
            })
        });
    </script>
@endsection
