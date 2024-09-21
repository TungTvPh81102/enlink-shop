@extends('backend.layouts.app')

@section('style')
    <link rel="stylesheet" href="{{ asset('vendor/laraberg/css/laraberg.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet"/>

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
                <form action="{{ route('admin.blog-posts.update', $post->id) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Danh mục bài viết</label>
                        <select name="blog_categories_id" id="" class="form-control mb-3">
                            <option value="">--- Chọn ---</option>
                            @foreach($blogCategories as $item)
                                <option
                                    {{ old('blog_categories_id', $post->blog_categories_id) == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                            @endforeach
                        </select>
                        @error('blog_categories_id')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Tiêu đề</label>
                        <input type="text" class="form-control mb-3" name="title"
                               value="{{ old('title',$post->title) }}"
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
                        @if(!empty($post->photo))
                            <img class="mt-3" style="width: 200px" src="{{ Storage::url($post->photo) }}">
                        @endif
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Nội dung</label>
                        <textarea class="mb-3" id="laraberg" name="content"
                                  hidden>{{ old('content', $post->content ?? '') }}</textarea>
                        @error('content')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <div class="form-group">
                            <label for="formGroupExampleInput">Ngày phát hành</label>
                            <div class="input-affix m-b-10">
                                <i class="prefix-icon anticon anticon-calendar"></i>
                                <input value="{{ old('published_at', $post->published_at) }}" type="text"
                                       name="published_at"
                                       class="form-control datepicker-input"
                                       placeholder="Ngày phát hành">
                            </div>
                            @error('published_at')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="tags">Tags</label>
                        <select class="form-control select2-tags" name="tags[]" id="tags" multiple="multiple">
                            @foreach($tags as $tag)
                                <option {{ in_array($tag->name, $post->tags->pluck('name')->toArray()) ? 'selected' : '' }} value="{{ $tag->name }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Trạng thái</label>
                        <select name="status" id="" class="form-control mb-3">
                            <option value="">--- Chọn ---</option>
                            <option {{ old('status', $post->status) == 'draft' ? 'selected' : '' }} value="draft">Bản
                                nháp
                            </option>
                            <option {{ old('status',$post->status) == 'pending' ? 'selected' : '' }} value="pending">Chờ
                                xử lý
                            </option>
                            <option
                                {{ old('status',$post->status) == 'published' ? 'selected' : '' }} value="published">
                                Xuất bản
                            </option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Cập nhật</button>
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
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="https://unpkg.com/react@17.0.2/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@17.0.2/umd/react-dom.production.min.js"></script>

    <script src="{{ asset('vendor/laraberg/js/laraberg.js') }}"></script>
    <script>
        Laraberg.init('laraberg', {
            localStorage: false
        });

        $(document).ready(function () {
            $('.datepicker-input').datepicker({
                format: 'yyyy/mm/dd'
            });

            $('form').on('submit', function () {
                var content = Laraberg.getContent('laraberg');
                $('textarea[name="content"]').val(content);
            });

            $('.select2-tags').select2({
                tags: true,
                tokenSeparators: [','],
                placeholder: 'Chọn hoặc nhập thẻ mới'
            });
        });

    </script>
@endsection
