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
                <form action="{{ route('admin.blog-categories.update',$blog->id) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Tên danh mục</label>
                        <input type="text" class="form-control mb-3" name="name" value="{{ old('name',$blog->name) }}"
                               placeholder="Nhập tên danh mục">
                        @error('name')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Hình ảnh</label>
                        <input type="file" class="form-control mb-3" name="image">
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror

                        @if(!empty($blog->image))
                            <img class="mt-3" style="width: 200px" src="{{ Storage::url($blog->image) }}">
                        @endif

                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Trạng thái</label>
                        <select name="status" id="" class="form-control mb-3">
                            <option value="">--- Chọn ---</option>
                            <option {{ old('status',$blog->status) ? 'selected' : '' }} value="1">Active</option>
                            <option {{ old('status',!$blog->status) ? 'selected' : '' }} value="0">Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Cập nhật</button>
                        <button class="btn btn-dark">Nhập lại</button>
                        <a href="{{ route('admin.blog-categories.index') }}" class="btn btn-secondary">Danh sách</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
