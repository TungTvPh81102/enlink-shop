<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Enlink - Admin Dashboard Template</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{asset('assets/backend/images/logo/favicon.png') }}">

    <!-- page css -->

    <!-- Core css -->
    <link href="{{asset('assets/backend/css/app.min.css') }}" rel="stylesheet">

</head>

<body>
<div class="app">
    <div class="container-fluid">
        <div class="d-flex full-height p-v-20 flex-column justify-content-between">
            <div class="d-none d-md-flex p-h-40">
                <a href="{{ route('home') }}">
                    <img src="{{ asset('assets/backend/images/logo/logo.png') }}" alt="">
                </a>
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-6 d-none d-md-block">
                        <img class="img-fluid" src="{{asset('assets/backend/images/others/sign-up-2.png')}}" alt="">
                    </div>
                    <div class="m-l-auto col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="m-t-20">Đăng ký</h2>
                                <p class="m-b-30">Chào mừng bạn đến Enlink</p>
                                <form action="{{ route('auth.register') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="name">Tên của bạn:</label>
                                        <input type="text" class="form-control mb-2" id="name" name="name"
                                               value="{{ old('name') }}"
                                               placeholder="Nhập tên của bạn">
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="email">Email:</label>
                                        <input type="email" class="form-control mb-2" name="email" id="email"
                                               value="{{ old('email') }}"
                                               placeholder="Email">
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="password">Mật khẩu:</label>
                                        <input type="password" name="password" class="form-control mb-2" id="password"
                                               placeholder="Mật khẩu">
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="confirmPassword">Xác nhận mật
                                            khẩu:</label>
                                        <input type="password" class="form-control mb-2" name="password_confirmation"
                                               id="confirmPassword"
                                               placeholder="Xác nhận mật khẩu">
                                        @error('password_confirmation')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-between ">
                                            <div>
                                                     <span class="font-size-13 text-muted">
                                                    Bạn đã có tài khoản?
                                                    <a class="small"
                                                       href="{{ route('auth.login') }}"> Đăng nhập</a>
                                                </span>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Đăng ký</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-md-flex  p-h-40 justify-content-between">
                <span class="">© 2019 ThemeNate</span>
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a class="text-dark text-link" href="#">Legal</a>
                    </li>
                    <li class="list-inline-item">
                        <a class="text-dark text-link" href="#">Privacy</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>


<!-- Core Vendors JS -->
<script src="{{asset('assets/backend/js/vendors.min.js') }}"></script>


<script src="{{asset('assets/backend/js/app.min.js') }}"></script>

</body>


</html>
