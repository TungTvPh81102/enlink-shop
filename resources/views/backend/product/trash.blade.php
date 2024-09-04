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
                    <a href="{{ asset('#') }}" class="breadcrumb-item"><i class="anticon anticon-home m-r-5"></i>Dashboard</a>
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
                                    <option value="inStock">Khôi phục</option>
                                    <option value="outOfStock">Xoá tất cả</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-right">
                        <button id="updateStatus" class="btn btn-secondary ">
                            <i class="anticon anticon-sync"></i>
                            <span>Cập nhật </span>
                        </button>
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
                            <th>ID</th>
                            <th>SKU</th>
                            <th>Tên sản phẩm</th>
                            <th>Thời gian xoá</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($products as $item)
                            <tr>
                                <td>
                                    <div class="checkbox">
                                        <input id="check-item-1" type="checkbox">
                                        <label for="check-item-1" class="m-b-0"></label>
                                    </div>
                                </td>
                                <td>
                                    {{$item->id}}
                                </td>
                                <td>
                                    {{$item->sku}}
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <img class="img-fluid rounded" src="{{ Storage::url($item->thumbnail_image)  }}" style="max-width: 60px" alt="">
                                        <h6 class="m-b-0 m-l-10">{{ $item->name }}</h6>
                                    </div>
                                </td>
                                <td>{{ $item->deleted_at ?? 'Đang cập nhật' }}</td>

                                <td class="text-right">
                                    <a class="btn btn-success" href="{{ route('admin.products.restore', $item->id) }}">Khôi phục</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <a class="btn btn-primary mt-4" href="{{ route('admin.products.index') }}">Danh sách</a>
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
