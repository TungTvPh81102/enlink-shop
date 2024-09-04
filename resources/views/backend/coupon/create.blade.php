@extends('backend.layouts.app')

@section('style')
    <link href="{{ asset('assets/backend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.css')}}"
          rel="stylesheet">
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
        <div class="card">
            <div class="card-body">
                <h4>{{ $subtitle ?? '' }}</h4>
                <form action="{{ route('admin.coupons.store') }}" method="post">
                    @csrf
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Tên chương trình</label>
                        <input type="text" class="form-control mb-3" name="name" value="{{ old('name') }}"
                               placeholder="Nhập tên chương trình">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Mã code</label>
                        <input type="text" class="form-control mb-3" name="code"
                               value="{{ old('code', strtoupper(\Illuminate\Support\Str::random(10)) ) }}"
                               placeholder="Nhập mã code">
                        @error('code')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Hình thức giảm giá</label>
                        <select name="type" id="" class="form-control mb-3">
                            <option>--- Chọn ---</option>
                            <option {{ old('type') == 'percent' ? 'selected' : ''   }} value="percent">Giảm theo %
                            </option>
                            <option {{ old('type') == 'fixed' ? 'selected' : '' }} value="fixed">Giảm theo tiền</option>
                        </select>
                        @error('type')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Số tiền hoặc % giảm</label>
                        <input type="number" class="form-control mb-3" name="value"
                               value="{{ old('value') }}"
                               placeholder="Số tiền hoặc % giảm">
                        @error('value')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group" id="max_discount_percentage_group" style="display: none;">
                        <label for="formGroupExampleInput">Số tiền giảm tối đa</label>
                        <input type="number" class="form-control mb-3" id="max_discount_percentage" name="max_discount_percentage"
                               value="{{ old('max_discount_percentage') }}"
                               placeholder="Nhập phần trăm giảm tối đa">
                        @error('max_discount_percentage')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group ">
                        <label for="formGroupExampleInput">Tổng thanh toán được áp dụng</label>
                        <input type="number" class="form-control mb-3" name="min_order_total"
                               value="{{ old('min_order_total',0) }}"
                               placeholder="Nhập tổng thanh toán được áp dụng">
                        @error('min_order_total')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Số lượng mã</label>
                        <input type="number" class="form-control mb-3" name="max_uses" value="{{ old('max_uses') }}"
                               placeholder="Nhập số lượng mã">
                        @error('max_uses')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Ngày hết hạn</label>
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input value="{{ old('expire_date') }}" type="text" name="expire_date"
                                       class="form-control datepicker-input"
                                       placeholder="Ngày hết hạn">
                            </div>
                        </div>
                        @error('expire_date')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Trạng thái</label>
                        <select name="status" id="" class="form-control mb-3">
                            <option>--- Chọn ---</option>
                            <option {{ old('status') ? 'selected' : ''  }} value="1">Active</option>
                            <option {{ !old('status') ? 'selected' : ''  }} value="0">Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Tạo mới</button>
                        <button class="btn btn-dark">Nhập lại</button>
                        <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Danh sách</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="{{ asset('assets/backend/vendors/quill/quill.min.js') }}"></script>
    <script src="{{ asset('assets/backend/js/pages/form-elements.js') }}"></script>
    <script>
        $(document).ready(function () {
            function toggleMaxDiscountPercentage() {
                var type = $('select[name="type"]').val();
                if (type === 'percent') {
                    $('#max_discount_percentage_group').show();
                } else {
                    $('#max_discount_percentage_group').hide();
                    $('#max_discount_percentage').val(0);
                }
            }

            toggleMaxDiscountPercentage();

            $('select[name="type"]').change(function () {
                toggleMaxDiscountPercentage();
            });

            $('.datepicker-input').datepicker({
                format: 'yyyy/mm/dd'
            });
        });
    </script>
@endsection
