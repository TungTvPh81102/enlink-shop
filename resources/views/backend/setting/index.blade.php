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
                <form action="{{ route('admin.settings.update') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Logo</label>
                        <input type="file" class="form-control mb-3" name="logo">
                        @error('logo')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if(!empty($settings['logo']))
                            <div class="mb-3">
                                <img src="{{ Storage::url($settings['logo']) }}" width="100" height="100%" alt="">
                            </div>
                        @endif
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Favicon</label>
                        <input type="file" class="form-control mb-3" name="favicon">
                        @error('favicon')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        @if(!empty($settings['favicon']))
                            <div class="mb-3">
                                <img src="{{ Storage::url($settings['favicon']) }}" width="100" height="100%" alt="">
                            </div>
                        @endif
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Footer description</label>
                        <textarea class="form-control" name="footer_description">{{ old('footer_description', $settings['footer_description'] ?? '') }}</textarea>
                        @error('footer_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Icon Facebook</label>
                        <input type="text" class="form-control" name="icon_facebook" value="{{ old('icon_facebook', $settings['icon_facebook'] ?? '') }}">
                        @error('icon_facebook')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Icon Instagram</label>
                        <input type="text" class="form-control" name="icon_instagram" value="{{ old('icon_instagram', $settings['icon_instagram'] ?? '') }}">
                        @error('icon_instagram')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Icon Youtube</label>
                        <input type="text" class="form-control" name="icon_youtube" value="{{ old('icon_youtube', $settings['icon_youtube'] ?? '') }}">
                        @error('icon_youtube')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Địa chỉ</label>
                        <input type="text" class="form-control" name="address" value="{{ old('address', $settings['address'] ?? '') }}">
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Số điện thoại</label>
                        <input type="text" class="form-control" name="phone" value="{{ old('phone', $settings['phone'] ?? '') }}">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Email</label>
                        <input type="email" class="form-control" name="email" value="{{ old('email', $settings['email'] ?? '') }}">
                        @error('email')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Lưu</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')

@endsection
