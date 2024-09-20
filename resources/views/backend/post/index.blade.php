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
                                    <option value="all">All</option>
                                    <option value="inStock">In Stock</option>
                                    <option value="outOfStock">Out of Stock</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 text-right">
                        <a href="{{ route('admin.blog-posts.create') }}" class="btn btn-primary">
                            <i class="anticon anticon-plus-circle m-r-5"></i>
                            <span>Thêm mới</span>
                        </a>
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
                            <th>#</th>
                            <th>Tiêu đề</th>
                            <th>Hình ảnh</th>
                            <th>Danh mục</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhât</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($posts as $item)
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
                                    {{ $item->title }}
                                </td>
                                <td>
                                    <h6 class="m-b-0 m-l-10">
                                        <img class=" rounded" style="width: 100px; height: 100px; object-fit: cover"
                                             src="{{ Storage::url($item->photo)  }}" alt=" {{ $item->title }}">
                                    </h6>
                                </td>
                                <td>
                                    {{ $item->blogCategories->name }}
                                </td>
                                <td>
                                    @switch($item->status)
                                        @case('draft')
                                            <span class="badge badge-danger">Bản nháp</span>
                                        @break
                                        @case('pending')
                                            <span class="badge badge-warning">Đang xử lý</span>
                                            @break
                                        @case('published')
                                            <span class="badge badge-success">Được xuất bản</span>
                                            @break
                                    @endswitch
                                </td>
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                                <td class="text-right">
                                    <a href="{{ route('admin.blog-posts.edit', $item->id) }}"
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