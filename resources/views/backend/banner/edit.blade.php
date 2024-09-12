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
                <form action="{{ route('admin.banners.update', $banner->id) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Tiêu đề</label>
                        <input type="text" class="form-control mb-3" name="title" value="{{ old('title', $banner->title) }}"
                               placeholder="Nhập tiêu đề">
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Mô tả ngắn</label>
                        <input type="text" class="form-control mb-3" name="subtitle" value="{{ old('subtitle',$banner->subtitle) }}"
                               placeholder="Nhập mô tả ngắn">
                        @error('subtitle')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Hình ảnh</label>
                        <input type="file" class="form-control mb-3" name="image" value="{{ old('image') }}"
                        >
                        @error('image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div>
                            <img class="mt-2" src="{{ Storage::url($banner->image) }}" alt="" width="200px" height="100px">
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Đường dẫn</label>
                        <input type="text" class="form-control mb-3" name="link" value="{{ old('link',$banner->link) }}"
                               placeholder="Đường dẫn">
                        @error('link')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Tiêu đề nút</label>
                        <input type="text" class="form-control mb-3" name="btn_title" value="{{ old('btn_title',$banner->btn_title) }}"
                               placeholder="Tiêu đề nút">
                        @error('btn_title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Trạng thái</label>
                        <select name="status" id="" class="form-control mb-3">
                            <option value="">--- Chọn ---</option>
                            <option {{ old('status',$banner->status) == 1 ? 'selected' : ''  }} value="1">Active</option>
                            <option {{ old('status',$banner->status) == 0 ? 'selected' : '' }} value="0">Inactive</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Cập nhật</button>
                        <button class="btn btn-dark">Nhập lại</button>
                        <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">Danh sách</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
