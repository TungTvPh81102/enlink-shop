@extends('layouts._app')

@section('content')
    <section class="z-index-2 position-relative pb-2 mb-12">
        <div class="bg-body-secondary mb-3">
            <div class="container">
                <nav class="py-4 lh-30px" aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center py-1 mb-0">
                        <li class="breadcrumb-item"><a title="Home" href="{{ route('home') }}">Trang chủ</a></li>
                        <li class="breadcrumb-item"><a title="Shop" href="{{ route('cart.view') }}">Giỏ hàng</a></li>
                        <li class="breadcrumb-item active" aria-current="page">{{ $title ?? '' }}</li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="container pb-14 pb-lg-19">
        <div class="text-center"><h2 class="mb-6">{{ $title ?? '' }}</h2></div>
        <form class="pt-12" action="{{ route('checkout.handle-checkout') }}" method="post">
            @csrf
            <div class="row">
                @if(Auth::check())
                    @include('checkout.info-order-auth')
                @else
                    @include('checkout.info-order')
                @endif
                <div class="col-lg-8 order-lg-first pe-xl-20 pe-lg-6">
                    <div class="checkout">
                        @if(!Auth::check())
                            <p class="mb-5">Returning customer?
                                <a href="#" data-bs-toggle="modal" data-bs-target="#signInModal">Click here to login</a>
                            </p>
                            <p>Have a coupon?
                                <a data-bs-toggle="collapse" href="#collapsecoupon" role="button" aria-expanded="false"
                                   aria-controls="collapsecoupon">Click here to enter your code</a>
                            </p>
                        @endif
                        <div class="collapse" id="collapsecoupon">
                            <div class="card mw-60 border-0">
                                <div class="card-body py-10 px-8 my-10 border">
                                    <p class="card-text text-body-emphasis mb-8">
                                        If you have a coupon code, please apply it below.</p>
                                    <div class="input-group position-relative">
                                        <input type="email" class="form-control bg-body rounded-end"
                                               placeholder="Your Email*">
                                        <button type="submit"
                                                class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary">
                                            Apply Coupon
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h4 class="fs-4 pt-4 mb-7">Thông tin vận chuyển</h4>
                        <div class="mb-7">
                            <label class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Tên</label>
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" class="form-control mb-6" value="{{ Auth::user()->name ?? '' }}"
                                           id="last-name" name="name"
                                           placeholder="Họ và tên" required>
                                    @error('name')
                                         <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-7">
                            <div class="row">
                                <div class="col-md-8 mb-md-0 mb-7">
                                    <label for="street-address"
                                           class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Email</label>
                                    <input type="text" class="form-control mb-6" value="{{ Auth::user()->email ?? '' }}"
                                           id="street-address" name="email"
                                           required>
                                    @error('email')
                                         <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="apt" class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Số
                                        điện thoại</label>
                                    <input type="text" class="form-control mb-6" value="{{ Auth::user()->phone ?? '' }}"
                                           id="phone" name="phone" required>
                                    @error('phone')
                                         <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="mb-7">
                            <div class="form-group mb-7">
                                <label class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Tỉnh/Thành
                                    phố</label>
                                <select id="province_id" name="province_id" class="form-control mb-6">
                                    <option>Chọn Tỉnh/Thành Phố</option>
                                    @foreach($provinces as $item)
                                        <option value="{{ $item->id }}}">{{ $item->name }}</option>
                                    @endforeach
                                </select>
                                @error('province_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-7">
                                <label class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">
                                    Quận/Huyện
                                </label>
                                <select id="district_id" name="district_id" class="form-control mb-6">
                                    <option>Chọn Quận/Huyện</option>
                                </select>
                                @error('district_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group mb-7">
                                <label class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">
                                    Phường/Xã
                                </label>
                                <select id="ward_id" name="ward_id" class="form-control mb-6">
                                    <option>Chọn Phường/xã</option>
                                </select>
                                @error('ward_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="mb-7">
                            <div class="row">
                                <div class="col-md-12 mb-7">
                                    <label for="street-address"
                                           class="mb-5 fs-13px letter-spacing-01 fw-semibold text-uppercase">Ghi
                                        chú</label>
                                    <textarea placeholder="Nhập ghi chú" class="form-control" id="street-address"
                                              name="street-address"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 mb-5 form-check">
                            <input type="checkbox" class="form-check-input rounded-0 me-4" name="is_ship_user_same_user"
                                   id="customCheck5" value="1">
                            <label class="text-body-emphasis" for="customCheck5">
                                <span class="text-body-emphasis">Địa chỉ thanh toán giống với địa chỉ giao hàng.</span>
                            </label>
                        </div>
                    </div>
                    <div class="checkout mb-7">
                        <div class="mb-7">
                            <h4 class="fs-4 mb-8 mt-12 pt-lg-1">Thông tin thanh toán</h4>
                            <div class="nav nav-tabs border-0">
                                <!-- Thanh toán online -->
                                <label for="payment-online" class="btn btn-payment px-12 mx-2 py-6 me-7 my-3">
                                    <svg class="icon icon-paylay fs-32px text-body-emphasis">
                                        <use xlink:href="#icon-paylay"></use>
                                    </svg>
                                    <span class="ms-3 text-body-emphasis fw-semibold fs-6">Thanh toán online</span>
                                    <input type="radio" name="payment-method" id="payment-online" value="online">
                                </label>

                                <!-- Thanh toán khi nhận hàng -->
                                <label for="payment-code" class="btn btn-payment px-12 mx-2 py-6 me-7 my-3 mb-6">
                                    <svg class="icon icon-paylay fs-32px text-body-emphasis">
                                        <use xlink:href="#icon-card"></use>
                                    </svg>
                                    <span
                                        class="ms-3 text-body-emphasis fw-semibold fs-6">Thanh toán khi nhận hàng</span>
                                    <input type="radio" name="payment-method" id="payment-code" value="cod" checked>
                                </label>

                                @error('payment-method')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <button type="submit"
                                class="btn btn-dark btn-hover-bg-primary btn-hover-border-primary px-11 mt-md-7 mt-4">
                            Thanh toán
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </section>

@endsection

@section('scripts')
    <script>
        $('#province_id').on('change', function () {
            let provinceId = $(this).val();
            console.log(provinceId);
            if (provinceId) {
                $.ajax({
                    url: '{{ route('get-districts', '') }}' + '/' + provinceId,
                    type: "GET",
                    dataType: "json",
                    success: function (res) {
                        $('#district_id').empty().append('<option>Chọn quận/huyện</option>');
                        $.each(res.data, function (key, value) {
                            $('#district_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });

        $('#district_id').on('change', function () {
            let districtId = $(this).val();
            if (districtId) {
                $.ajax({
                    url: '{{ route('get-wards', '') }}' + '/' + districtId,
                    type: "GET",
                    dataType: "json",
                    success: function (res) {
                        $('#ward_id').empty().append('<option>Chọn phường/xã</option>');
                        $.each(res.data, function (key, value) {
                            $('#ward_id').append('<option value="' + value.id + '">' + value.name + '</option>');
                        });
                    }
                });
            }
        });
    </script>
@endsection
