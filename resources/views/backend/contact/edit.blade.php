@extends('backend.layouts.app')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
        <form action="{{ route('admin.contacts.update', $contact->id) }}" method="post">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Thông tin liên hệ</h4>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="formGroupExampleInput">Tên khách hàng</label>
                                <input type="text" class="form-control mb-3" name="full_name"
                                       value="{{ old('name', $contact->full_name) }}"
                                       disabled
                                >
                                @error('full_name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group ">
                                <label for="formGroupExampleInput">Email</label>
                                <input type="text" class="form-control mb-3" name="email"
                                       value="{{ old('email', $contact->email) }}"
                                       disabled
                                >
                                @error('email')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Vấn đề</label>
                        <textarea class="form-control" disabled>{{ $contact->message }}</textarea>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Phản hồi</h4>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Nội dung xử lý</label>
                        <textarea class="form-control" name="response"
                                  id="summernote">{{ $contact->response }}</textarea>
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput2">Trạng thái phản hồi</label>
                        <select name="response_status" id="" class="form-control mb-3">
                            <option>--- Chọn ---</option>
                            <option {{ old('response_status', $contact->response_status) ? 'selected' : '' }} value="1">
                                Đã phản hồi
                            </option>
                            <option
                                {{ !old('response_status', $contact->response_status) ? 'selected' : '' }} value="0">
                                Chưa phản hồi
                            </option>
                        </select>
                        @error('response_status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="formGroupExampleInput2">Trạng thái</label>
                        <select name="status" id="" class="form-control mb-3">
                            <option>--- Chọn ---</option>
                            <option {{ old('status', $contact->status === 'pending') ? 'selected' : '' }} value="pending">Đang chờ xử lý</option>
                            <option {{ old('status', $contact->status === 'in_progress') ? 'selected' : '' }} value="in_progress">Đang xử lý</option>
                            <option {{ old('status', $contact->status === 'resolved') ? 'selected' : '' }} value="resolved">Xử lý thành công</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Phản hồi</button>
                        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">Danh sách</a>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script>
        $(document).ready(function () {
            $(document).ready(function () {
                $('#summernote').summernote({
                    placeholder: 'Nội dung xử lý',
                    height: 200
                });
            });

        });
    </script>
@endsection
