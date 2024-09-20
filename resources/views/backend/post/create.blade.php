@extends('backend.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/laraberg/css/laraberg.css') }}">

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
                <form action="{{ route('admin.blog-posts.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Danh mục bài viết</label>
                        <select name="blog_categories_id" id="" class="form-control mb-3">
                            <option value="">--- Chọn ---</option>
                            @foreach($blogCategories as $item)
                                <option
                                    {{ old('blog_categories_id') == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('blog_categories_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Tiêu đề</label>
                        <input type="text" class="form-control mb-3" name="title" value="{{ old('title') }}"
                               placeholder="Nhập tiêu đề">
                        @error('title')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Photo</label>
                        <input type="file" class="form-control mb-3" name="photo">
                        @error('photo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Nội dung</label>
                        <textarea class="mb-3" id="laraberg" name="content"
                                  hidden>{{ old('content') }}</textarea>
                        @error('content')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Ngày phát hành</label>
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input value="{{ old('published_at') }}" type="text" name="published_at"
                                       class="form-control datepicker-input"
                                       placeholder="Ngày phát hành">
                            </div>
                            @error('published_at')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Trạng thái</label>
                        <select name="status" id="" class="form-control mb-3">
                            <option value="">--- Chọn ---</option>
                            <option {{ old('status') == 'draft' ? 'selected' : '' }} value="draft">Bản nháp</option>
                            <option {{ old('status') == 'pending' ? 'selected' : '' }} value="pending">Chờ xử lý
                            </option>
                            <option {{ old('status') == 'published' ? 'selected' : '' }} value="published">Xuất bản
                            </option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Tạo mới</button>
                        <button class="btn btn-dark">Nhập lại</button>
                        <a href="{{ route('admin.blog-posts.index') }}" class="btn btn-secondary">Danh sách</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="{{ asset('assets/backend/vendors/bootstrap-datepicker/bootstrap-datepicker.min.js') }}"></script>
    <script src="https://unpkg.com/react@17.0.2/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@17.0.2/umd/react-dom.production.min.js"></script>

    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
    <script>
        Laraberg.init('laraberg');

        $(document).ready(function () {
            $('.datepicker-input').datepicker({
                format: 'yyyy/mm/dd'
            });

        });


    </script>
@endsection
