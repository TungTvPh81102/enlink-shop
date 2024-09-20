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
                        <textarea class="form-control"
                                  name="footer_description">{{ old('footer_description', $settings['footer_description'] ?? '') }}</textarea>
                        @error('footer_description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Url Facebook</label>
                        <input type="text" class="form-control" name="url_facebook"
                               value="{{ old('url_facebook', $settings['url_facebook'] ?? '') }}">
                        @error('url_facebook')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Url Instagram</label>
                        <input type="text" class="form-control" name="icon_instagram"
                               value="{{ old('url_instagram', $settings['url_instagram'] ?? '') }}">
                        @error('url_instagram')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Url Youtube</label>
                        <input type="text" class="form-control" name="url_youtube"
                               value="{{ old('url_youtube', $settings['url_youtube'] ?? '') }}">
                        @error('url_youtube')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Địa chỉ 1</label>
                        <input type="text" class="form-control" name="address"
                               value="{{ old('address', $settings['address'] ?? '') }}">
                        @error('address')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Địa chỉ 2</label>
                        <input type="text" class="form-control" name="address_2"
                               value="{{ old('address_2', $settings['address_2'] ?? '') }}">
                        @error('address_2')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Số điện thoại</label>
                        <input type="text" class="form-control mb-3" name="phone"
                               value="{{ old('phone', $settings['phone'] ?? '') }}">
                        @error('phone')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Hotline</label>
                        <input type="text" class="form-control mb-3" name="hotline"
                               value="{{ old('hotline', $settings['hotline'] ?? '') }}">
                        @error('hotline')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group ">
                        <label for="formGroupExampleInput">Email</label>
                        <input type="email" class="form-control mb-3" name="email"
                               value="{{ old('email', $settings['email'] ?? '') }}">
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
