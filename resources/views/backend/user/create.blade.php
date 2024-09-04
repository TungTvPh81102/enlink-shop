@extends('backend.layouts.app')

@section('style')

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
                <form action="{{ route('admin.users.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tên người dùng</label>
                                <input type="text" class="form-control mb-3" name="name" value="{{ old('name') }}"
                                       placeholder="Nhập tên người dùng">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Email</label>
                                <input type="email" class="form-control mb-3" name="email" value="{{ old('email') }}"
                                       placeholder="Nhập email">
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Mật khẩu</label>
                                <input type="password" class="form-control mb-3" name="password"
                                       value="{{ old('password') }}"
                                       placeholder="Nhập mật khẩu">
                                @error('password')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Số điện thoại</label>
                                <input type="text" class="form-control mb-3" name="phone"
                                       value="{{ old('phone') }}"
                                       placeholder="Nhập số điện thoại">
                                @error('phone')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput">Hình ảnh</label>
                        <input type="file" class="form-control mb-3" name="avatar">
                        @error('avatar')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Vai trò</label>
                        <select name="role_id" id="" class="form-control mb-3">
                            <option>--- Chọn ---</option>
                            @foreach($roles as $item)
                                <option value="{{ $item->id }}">{{ ucfirst($item->name) }}</option>
                            @endforeach
                        </select>
                        @error('role')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Trạng thái</label>
                        <select name="status" id="" class="form-control mb-3">
                            <option>--- Chọn ---</option>
                            <option {{ old('status')  }} value="1">Active</option>
                            <option {{ !old('status')  }} value="0">Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Tạo mới</button>
                        <button class="btn btn-dark">Nhập lại</button>
                        <a href="{{ route('admin.sizes.index') }}" class="btn btn-secondary">Danh sách</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
