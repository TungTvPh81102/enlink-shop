@extends('backend.layouts.app')

@section('style')
    <link href="{{ asset('assets/backend/vendors/datatables/dataTables.bootstrap.min.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="main-content">
        <div class="page-header">
            <h2 class="header-title">{{ $title ?? '' }}</h2>
            <div class="header-sub-title">
                <nav class="breadcrumb breadcrumb-dash">
                    <a href="{{ route('admin.dashboard') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
                    <a class="breadcrumb-item" href="">{{ $title ?? '' }}</a>
                    <span class="breadcrumb-item active">{{ $subtitle ?? '' }}</span>
                </nav>
            </div>
        </div>
        @include('backend.components.message')
        <div class="card">
            <div class="card-body">
                <div class="row m-b-30">
                    <div class="col-lg-8">
                        <div class="d-md-flex">
                            <div class="m-b-10 m-r-15">
                                <select class="custom-select" style="min-width: 180px;">
                                    <option selected>Catergory</option>
                                    <option value="all">All</option>
                                    <option value="homeDeco">Home Decoration</option>
                                    <option value="eletronic">Eletronic</option>
                                    <option value="jewellery">Jewellery</option>
                                </select>
                            </div>
                            <div class="m-b-10 m-r-15">
                                <select class="custom-select" style="min-width: 180px;">
                                    <option selected>Status</option>
                                    <option value="all">All</option>
                                    <option value="inStock">In Stock</option>
                                    <option value="outOfStock">Out of Stock</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover e-commerce-table">
                        <thead>
                        <tr>
                            <th>
                                <div class="checkbox">
                                    <input id="checkAll" type="checkbox">
                                    <label for="checkAll" class="m-b-0"></label>
                                </div>
                            </th>
                            <th>STT</th>
                            <th>Tên KH </th>
                            <th>SĐT</th>
                            <th>Hình thức TT</th>
                            <th>Trạng thái TT</th>
                            <th>Trạng thái</th>
                            <th>Tổng tiền</th>
                            <th>Ngày đặt hàng</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($orders as $item)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input id="check-item-1" type="checkbox">
                                        <label for="check-item-1" class="m-b-0"></label>
                                    </div>
                                </td>
                                <td>
                                   {{ $loop->iteration }}
                                </td>
                                <td>
                                    {{ $item->user_name }}
                                </td>
                                <td>
                                    {{ $item->user_phone }}
                                </td>
                                <td>
                                    @switch($item->payment_method)
                                        @case('code')
                                            <span class="badge badge-primary">Thanh toán COD</span>
                                            @break
                                        @case('online')
                                            <span class="badge badge-info">Thanh toán Online</span>
                                            @break
                                        @default
                                            <span class="badge badge-primary">Thanh toán COD</span>
                                    @endswitch
                                </td>
                                <td>
                                    {!!   $item->payment_status ?
                                      '<span class="badge badge-success">Đã thanh toán</span>' :
                                      '<span class="badge badge-warning">Chưa thanh toán</span>' !!}
                                </td>
                                <td>
                                    @switch($item->status_delivery)
                                        @case('1')
                                            <span class="badge badge-warning">Đang xử lý</span>
                                            @break
                                        @case('2')
                                            <span class="badge badge-primary">Đang lấy hàng</span>
                                            @break
                                        @case('3')
                                            <span class="badge badge-primary">Đang giao hàng</span>
                                            @break
                                        @case('4')
                                            <span class="badge badge-success">Giao hàng thành công</span>
                                            @break
                                        @case('0')
                                            <span class="badge badge-danger">Đã huỷ</span>
                                            @break
                                        @default
                                            <span class="badge badge-danger">Đã huỷ</span>
                                    @endswitch
                                </td>
                                <td>
                                    {{ number_format($item->total_price) }}
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.orders.edit', $item->id) }}"
                                       class="btn btn-icon btn-hover btn-sm btn-rounded pull-right">
                                        <i class="anticon anticon-edit"></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/vendors/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{ asset('assets/backend/vendors/datatables/dataTables.bootstrap.min.js')}}"></script>
    <script src="{{ asset('assets/backend/js/pages/e-commerce-order-list.js')}}"></script>
@endsection
