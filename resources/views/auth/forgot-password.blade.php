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
        <div class="d-flex full-height p-v-15 flex-column justify-content-between">
            <div class="d-none d-md-flex p-h-40">
                <img src="{{ asset('assets/backend/images/logo/logo.png') }}" alt="">
            </div>
            <div class="container">
                <div class="row align-items-center">
                    <div class="col-md-5">
                        <div class="card">
                            <div class="card-body">
                                <h2 class="m-t-20">Quên mật khẩu</h2>
                                <p class="m-b-30">Nhập thông tin xác thực của bạn để có quyền truy cập</p>
                                <form action="{{ route('auth.forgot-password') }}" method="post">
                                    @csrf
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="userName">Email:</label>
                                        <div class="input-affix mb-3">
                                            <i class="prefix-icon anticon anticon-user"></i>
                                            <input type="email" name="email" class="form-control " id="email"
                                                   placeholder="Email">
                                        </div>
                                        @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <div class="d-flex align-items-center justify-content-center ">
                                            <a href="{{ route('auth.login') }}" class="btn btn-danger mr-4">Hủy</a>
                                            <button class="btn btn-primary ">Xác nhận</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="offset-md-1 col-md-6 d-none d-md-block">
                        <img class="img-fluid" src="{{ asset('assets/backend/images/others/login-2.png') }}" alt="">
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
