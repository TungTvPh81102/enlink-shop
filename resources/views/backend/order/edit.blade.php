@extends('backend.layouts.app')

@section('style')
    <style>
        .status-info {
            position: relative;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }

        .status-info .status {
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 4px;
            background-color: #f9f9f9;
        }

        .status-info .arrow {
            position: absolute;
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid #ddd;
        }

        .status-info .arrow-up {
            border-top-color: #fff;
            top: -10px;
            left: 10px;
        }

        .orderstatus {
            color: #939393;
            display: block;
            padding: 1em 0;
            position: relative;
            text-align: center;
            min-height: 150px;
        }

        .orderstatus.done:before {
            background: #32841f;

        }

        .orderstatus:before {
            content: '';
            height: 100%;
            position: absolute;
            left: 50%;
            width: 2px;
            background: #939393;
            margin: 0 25px;
        }

        .orderstatus:last-child:before {
            height: 0;
        }

        .orderstatus.done {
            color: #333;
        }

        @media only screen and (max-width: 40em) {
            .orderstatus {
                text-align: left;
            }

            .orderstatus:before {
                left: 0;
            }

            .orderstatus .orderstatus-text {
                left: 0;
                width: 100%;
            }
        }

        .orderstatus-text {
            position: relative;
            width: 50%;
            left: 50%;
            text-align: left;
            padding-left: 60px;
        }

        @media only screen and (min-width: 40em) {
            .orderstatus:nth-child(2n) .orderstatus-text {
                left: 10px;
                text-align: right;
                padding-right: 20px;
            }
        }

        .orderstatus-container {
            padding: 2em 0;
        }

        .orderstatus time {
            display: block;
            font-size: 1em;
            color: #939393;
        }

        .orderstatus.done time {
            color: #368d22;
        }

        @media only screen and (max-width: 40em) {
            .orderstatus-container {
                text-align: center;
            }
        }

        .orderstatus-check {
            font-family: "Helvetica", Arial, sans-serif;
            border: 2px solid #939393;
            width: 50px;
            height: 50px;
            display: inline-block;
            text-align: center;
            line-height: 48px;
            border-radius: 50%;
            margin-bottom: 0.5em;
            background: #fff;
            z-index: 2;
            position: absolute;
            color: #939393;
            left: 50%;
        }

        .done .orderstatus-check {
            color: #368d22;
            border-color: #368d22;
        }

        @media only screen and (max-width: 40em) {
            .orderstatus-check {
                left: 0;
            }
        }

        .orderstatus-active {
            text-align: center;
            position: relative;
            left: 25px;
            top: 20px;
            color: #939393;
        }

        @media only screen and (max-width: 40em) {
            .orderstatus-active {
                display: none;
            }
        }

    </style>
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">{{ $title ?? '' }}</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="{{ asset('#') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
                    <a class="breadcrumb-item" href="">{{ $title ?? '' }}</a>
                    <span class="breadcrumb-item active">{{ $subtitle ?? '' }}</span>
                </nav>
            </div>
        </div>
        @include('backend.components.message')
        <form action="{{ route('admin.orders.update', $order->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <h4> {{ $order->is_ship_user_same_user ? 'Thông tin khách hàng' : 'Thông tin người đặt hàng' }}  </h4>
                    <div class="row mt-4">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tên khách hàng</label>
                                <input type="text" name="user_name" class="form-control mb-3"
                                       id="formGroupExampleInput"
                                       placeholder="Tên khách hàng"
                                       value="{{ old('user_name', $order->user_name) }}">
                                @error('user_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Email</label>
                                <input type="text" name="user_email" class="form-control mb-3"
                                       id="formGroupExampleInput2"
                                       placeholder="Email" value="{{ old('user_email',$order->user_email) }}">
                                @error('user_email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Số điện thoại</label>
                                <input type="text" name="user_phone" class="form-control mb-3"
                                       placeholder="Số điện thoại"
                                       value="{{ old('user_phone', $order->user_phone) }}">
                                @error('user_phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            @if($order->is_ship_user_same_user !== 1)
                <div class="card">
                    <div class="card-body">
                        <h4>Thông tin người nhận hàng</h4>
                        <div class="row mt-4">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Tên khách hàng</label>
                                    <input type="text" name="ship_user_name" class="form-control mb-3"
                                           id="formGroupExampleInput"
                                           placeholder="Tên người nhận hàng"
                                           value="{{ old('ship_user_name', $order->ship_user_name) }}">
                                    @error('ship_user_name')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput2">Email</label>
                                    <input type="text" name="ship_user_email" class="form-control mb-3"
                                           id="formGroupExampleInput2"
                                           placeholder="Email"
                                           value="{{ old('ship_user_email',$order->ship_user_email) }}">
                                    @error('ship_user_email')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Số điện thoại</label>
                                    <input type="text" name="ship_user_phone" class="form-control mb-3"
                                           placeholder="Số điện thoại người nhận"
                                           value="{{ old('ship_user_phone', $order->ship_user_phone) }}">
                                    @error('ship_user_phone')
                                    <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="card">
                <div class="card-body">
                    <h4>Địa chỉ nhận hàng</h4>
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tỉnh/Thành phố</label>
                                <select id="province_id" name="province_id" id="" class="form-control mb-3">
                                    <option>Chọn Tỉnh/Thành phố</option>
                                    @foreach($provinces as $item)
                                        <option
                                            {{ old('province_id', $order->address->province_id) == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('province_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Quận/Huyện</label>
                                <select id="district_id" name="district_id" id="" class="form-control mb-3">
                                    <option>Chọn Quận/Huyện</option>
                                    @foreach($districts as $item)
                                        <option
                                            {{ old('district_id', $order->address->district_id) == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('district_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Quận/Huyện</label>
                                <select id="ward_id" name="ward_id" id="" class="form-control mb-3">
                                    <option>Chọn Quận/Huyện</option>
                                    @foreach($wards as $item)
                                        <option
                                            {{ old('ward_id', $order->address->ward_id) == $item->id ? 'selected' : '' }} value="{{ $item->id }}">
                                            {{ $item->name }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('ward_id')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Ghi chú</label>
                                <textarea name="street_address"
                                          class="form-control">{{ old('street_address', $order->address->street_address) }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Thông tin sản phẩm</h4>
                        <div style="cursor: pointer" class="btn btn-primary add-product-order"  data-toggle="modal" data-target="#modelProductOrder">
                            <i class="anticon anticon-plus"></i>
                        </div>
                    </div>
                    <div class="form-group mb-3 mt-3">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>STT</th>
                                    <th scope="col">SKU</th>
                                    <th scope="col">Sản phẩm</th>
                                    <th scope="col">Giá</th>
                                    <th>Số lượng</th>
                                    <th>Thành tiền</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody class="variant-wrapper">
                                @php
                                    $total = 0;
                                @endphp
                                @foreach($order->order_details as $item)
                                    @php
                                        $subTotal = $item->product_price_regular * $item->quantity;
                                        $total = $order->total_price;
                                    @endphp
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->product_sku }}</td>
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img class="img-fluid rounded"
                                                     src="{{ Storage::url($item->product_image_thumbnail)  }}"
                                                     style="max-width: 60px" alt="">
                                                <div class="d-flex flex-column">
                                                    <h6 class="text-truncate m-b-0 m-l-10"
                                                        style="max-width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                                        {{ $item->product_name }}
                                                    </h6>
                                                    <h6 class="m-b-0 m-l-10">Kích
                                                        cỡ: {{ $item->variant_size_name }}</h6>
                                                    <h6 class="m-b-0 m-l-10">Màu: {{ $item->variant_color_name }}</h6>
                                                </div>
                                            </div>
                                        </td>
                                        <td>{{ number_format($item->product_price_regular) }}</td>
                                        <td>
                                            <input style="width: 80px; text-align: center" min="1" type="number"
                                                   name="quantity[{{ $item->product_variant_id }}][qty]"
                                                   class="form-control" value="{{ $item->quantity }}">
                                        </td>
                                        <td>{{ number_format($subTotal) }}</td>
                                        <td>
                                            <a href="{{ route('admin.orders.order-item.delete', $item->id) }}"
                                               class="btn btn-icon btn-hover btn-sm btn-rounded sweet-confirm">
                                                <i class="anticon anticon-delete"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                                @if($order->order_coupons)
                                    <tr>
                                        <td colspan="5">Giảm giá</td>
                                        <td colspan="2">- {{ number_format($order->order_coupons->reduce) }}</td>
                                    </tr>
                                @endif
                                <tr>
                                    <td colspan="5">Tổng thanh toán</td>
                                    <td colspan="2">{{ number_format($total) }}</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4>Thanh toán</h4>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Phương thức thanh toán</label>
                                <select name="payment_method" id="" class="form-control mb-3">
                                    <option
                                        {{ old('payment_method', $order->payment_method) == 'cod' ? 'selected' : '' }} value="cod">
                                        Thanh toán COD
                                    </option>
                                    <option
                                        {{ old('payment_method', $order->payment_method) == 'online' ? 'selected' : '' }} value="online">
                                        Thanh toán Online
                                    </option>
                                </select>
                                @error('payment_method')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Trạng thái thanh toán</label>
                                <select name="payment_status" id="" class="form-control mb-3">
                                    <option
                                        {{ old('payment_status', $order->payment_status)  ? 'selected' : '' }} value="1">
                                        Đã thanh toán
                                    </option>
                                    <option
                                        {{ old('payment_status', !$order->payment_status) ? 'selected' : '' }} value="0">
                                        Chưa thanh toán
                                    </option>
                                </select>
                                @error('payment_status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4>Trạng thái đơn hàng</h4>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Trạng thái</label>
                                <select name="status_delivery" id="status_delivery" class="form-control mb-3">
                                    @switch($order->status_delivery)
                                        @case(1)
                                            <option
                                                {{ old('status_delivery', $order->status_delivery) == 1 ? 'selected' : '' }}
                                                value="1">
                                                Đang xử lý
                                            </option>
                                        @case(2)
                                            <option
                                                {{ old('status_delivery', $order->status_delivery) == 2 ? 'selected' : '' }}
                                                value="2">
                                                Đang chuẩn bị hàng
                                            </option>
                                            <option
                                                {{ old('status_delivery', $order->status_delivery) == 3 ? 'selected' : '' }}
                                                value="3">
                                                Đang vận chuyển
                                            </option>
                                            <option
                                                {{ old('status_delivery', $order->status_delivery) == 4 ? 'selected' : '' }}
                                                value="4">
                                                Giao hàng thành công
                                            </option>
                                            @break
                                        @case(3)
                                            <option
                                                {{ old('status_delivery', $order->status_delivery) == 3 ? 'selected' : '' }}
                                                value="3">
                                                Đang vận chuyển
                                            </option>
                                            <option
                                                {{ old('status_delivery', $order->status_delivery) == 4 ? 'selected' : '' }}
                                                value="4">
                                                Giao hàng thành công
                                            </option>
                                            @break
                                        @case(4)
                                            <option
                                                {{ old('status_delivery', $order->status_delivery) == 4 ? 'selected' : '' }}
                                                value="4">
                                                Giao hàng thành công
                                            </option>
                                            @break
                                        @case(0)
                                            <option
                                                {{ old('status_delivery', $order->status_delivery) == 0 ? 'selected' : '' }}
                                                value="0">
                                                Huỷ đơn
                                            </option>
                                            @break
                                        @default
                                            <option
                                                {{ old('status_delivery', $order->status_delivery) == 0 ? 'selected' : '' }}
                                                value="0">
                                                Huỷ đơn
                                            </option>
                                    @endswitch
                                </select>
                                @error('status')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-8">
                            <label for="formGroupExampleInput2">Thông tin</label>
                            <div id="status-info" class="status-info">
                            </div>
                            {{--                            <section>--}}
                            {{--                                <div class="row orderstatus-container">--}}
                            {{--                                    <div class="medium-12 columns">--}}
                            {{--                                        <div class="orderstatus">--}}
                            {{--                                            <div class="orderstatus-check"><span class="orderstatus-number">4</span></div>--}}
                            {{--                                            <div class="orderstatus-text">--}}
                            {{--                                                <time>17 Aug</time>--}}
                            {{--                                                <p>Your order is delivered</p>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="orderstatus done">--}}
                            {{--                                            <div class="orderstatus-check"><span class="orderstatus-number">3</span></div>--}}
                            {{--                                            <div class="orderstatus-text">--}}
                            {{--                                                <time>17 Dec</time>--}}
                            {{--                                                <p>Order created</p>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="orderstatus done">--}}
                            {{--                                            <div class="orderstatus-check"><span class="orderstatus-number">2</span></div>--}}
                            {{--                                            <div class="orderstatus-text">--}}
                            {{--                                                <time>17 Dec</time>--}}
                            {{--                                                <p>Your order is placed</p>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}
                            {{--                                        <div class="orderstatus done">--}}
                            {{--                                            <div class="orderstatus-check"><span class="orderstatus-number">1</span></div>--}}
                            {{--                                            <div class="orderstatus-text">--}}
                            {{--                                                <time>17 Dec</time>--}}
                            {{--                                                <p>Your order is placed</p>--}}
                            {{--                                            </div>--}}
                            {{--                                        </div>--}}


                            {{--                                    </div>--}}
                            {{--                                </div>--}}
                            {{--                            </section>--}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-primary">Cập nhật</button>
                <a href="{{ route('admin.orders.index') }}" class="btn btn-secondary">Danh sách</a>
            </div>
        </form>
    </div>
    <div class="modal fade" id="modelProductOrder">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Thêm sản phẩm cho đơn hàng</h5>
                    <button type="button" class="close" data-dismiss="modal">
                        <i class="anticon anticon-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="product_id">Sản phẩm</label>
                        <select id="product_id" name="product_id" class="form-control">
                            <option value="">-- Chọn sản phẩm --</option>
                            @foreach($products as $item)
                                <option value="{{ $item->id }}">{{ Str::limit($item->name,30) }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="size_id">Kích cỡ</label>
                        <select id="size_id" name="size_id" class="form-control">
                            <option value="">-- Chọn kích cỡ --</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="color_id">Màu </label>
                        <select id="color_id" name="color_id" class="form-control">
                            <option value="">-- Chọn màu --</option>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="quantity">Giá</label>
                        <input id="price" type="text" name="price" class="form-control" placeholder="Chọn sản phẩm...">
                    </div>
                    <div class="form-group">
                        <label for="quantity">Số lượng</label>
                        <input type="number" id="quantity" name="quantity" class="form-control" value="1">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Huỷ</button>
                    <button type="button" class="btn btn-primary">Thêm vào đơn hàng</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const statusMapping = {
                0: 'Huỷ đơn',
                1: 'Đang xử lý',
                2: 'Đang chuẩn bị hàng',
                3: 'Đang vận chuyển',
                4: 'Giao hàng thành công'
            };

            const statusInfoElement = document.getElementById('status-info');
            const selectedStatus = parseInt(document.getElementById('status_delivery').value);

            let statusHTML = '';
            for (let i = 1; i <= 4; i++) {
                if (i <= selectedStatus) {
                    const status = statusMapping[i];
                    statusHTML += `<div class="status">${status}</div>`;
                    if (i < selectedStatus) {
                        statusHTML += `<div class="arrow arrow-up"></div>`;
                    }
                }
            }

            // Handle the case where status is 0 (Cancelled)
            if (selectedStatus === 0) {
                statusHTML = `<div class="status">${statusMapping[0]}</div>`;
            }

            statusInfoElement.innerHTML = statusHTML;
        });

        $(document).ready(function () {
            $('#province_id').on('change', function () {
                let provinceId = $(this).val();
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


            $('#product_id').on('change', function () {
                let productId = $(this).val();
                if (productId) {
                    $.ajax({
                        url: '{{ route('product-variants.show', '') }}' + '/' + productId,
                        type: "GET",
                        dataType: "json",
                        success: function (res) {
                            let sizes = res.data.variants;
                            let seenSizes = new Set(); // Tập hợp để lưu các kích cỡ đã thấy

                            $('#size_id').empty();
                            $('#size_id').append('<option value="">-- Chọn kích cỡ --</option>');

                            $.each(sizes, function (key, value) {
                                // Chỉ thêm kích cỡ nếu chưa có trong tập hợp
                                if (!seenSizes.has(value.size.name)) {
                                    seenSizes.add(value.size.name); // Thêm kích cỡ vào tập hợp
                                    $('#size_id').append('<option value="' + value.size.id + '">' + value.size.name + '</option>');
                                }
                            });
                        }
                    });
                }
            });

            $('#size_id').on('change', function () {
                let sizeId = $(this).val();
                let productId = $('#product_id').val();

                if (sizeId && productId) {
                    $.ajax({
                        url: '{{ route("color-variants.show", ["product_id" => "product_id_placeholder", "size_id" => "size_id_placeholder"]) }}'
                            .replace('product_id_placeholder', productId)
                            .replace('size_id_placeholder', sizeId),
                        type: "GET",
                        dataType: "json",
                        success: function (res) {
                            $('#color_id').empty();
                            $('#color_id').append('<option value="">-- Chọn màu --</option>');
                            $.each(res.data, function (key, value) {
                                $('#color_id').append('<option value="' + value.color.id + '">' + value.color.name + '</option>');
                                $('#price').val('');
                            });
                        }
                    });
                }
            });

            $('#color_id').on('change', function () {
                let colorId = $(this).val();
                let sizeId = $('#size_id').val();
                let productId = $('#product_id').val();

                if (colorId && sizeId && productId) {
                    $.ajax({
                        url: '{{ route("color-variants.show", ["product_id" => "product_id_placeholder", "size_id" => "size_id_placeholder"]) }}'
                            .replace('product_id_placeholder', productId)
                            .replace('size_id_placeholder', sizeId),
                        type: "GET",
                        dataType: "json",
                        success: function (res) {
                            let selectedColor = res.data.find(color => color.color.id == colorId);
                            if (selectedColor) {
                                $('#price').val(selectedColor.price);
                            }
                        }
                    });
                }
            });

        })
    </script>
@endsection
