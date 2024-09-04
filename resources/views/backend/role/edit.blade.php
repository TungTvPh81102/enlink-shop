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
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h4>{{ $subtitle ?? '' }}</h4>
                        <form action="{{ route('admin.roles.update', $role->id) }}" method="post">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="name">Vai trò</label>
                                <input type="text" class="form-control mb-3" id="name" name="name"
                                       value="{{ old('name', $role->name) }}"
                                       placeholder="Nhập tên vai trò">
                                @error('name')
                                <span class="text-danger ">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="name">Trạng thái</label>
                                <select name="status" id="" class="form-control mb-3">
                                    <option>--- Chọn ---</option>
                                    <option {{ old('status', $role->status) ? 'selected' : ''  }} value="1">Active
                                    </option>
                                    <option {{ !old('status', $role->status) ? 'selected' : ''  }} value="0">Inactive
                                    </option>
                                </select>
                                @error('status')
                                <span class="text-danger ">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật</button>
                            <button type="reset" class="btn btn-dark">Nhập lại</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-hover e-commerce-table">
                                <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Vai trò</th>
                                    <th>Trạng thái</th>
                                    <th>Ngày tạo</th>
                                    <th>Ngày cập nhât</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($roles as $item)
                                    <tr>
                                        <td>
                                            {{$item->id}}
                                        </td>
                                        <td>
                                            {{ $item->name }}
                                        </td>
                                        <td>
                                            {!!   $item->status ?
                                                '<span class="badge badge-success">Hoạt động</span>' :
                                                '<span class="badge badge-danger">Không hoạt động</span>' !!}
                                        </td>
                                        <td>{{ $item->created_at }}</td>
                                        <td>{{ $item->updated_at }}</td>
                                        <td class="text-right">
                                            <a href="{{ route('admin.roles.edit', $item->id) }}"
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
        </div>

    </div>
@endsection

@section('script')

@endsection
