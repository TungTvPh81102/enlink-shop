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
    <div class="container-fluid p-h-0 p-v-20 bg full-height d-flex"
         style="background-image: url('{{asset('assets/backend/images/others/login-3.png') }}')">
        <div class="d-flex flex-column justify-content-between w-100">
            <div class="container d-flex h-100">
                <div class="row align-items-center w-100">
                    <div class="col-md-7 col-lg-5 m-h-auto">
                        <div class="card shadow-lg">
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between m-b-30">
                                    <img class="img-fluid" alt=""
                                         src="{{asset('assets/backend/images/logo/logo.png')}}">
                                    <h2 class="m-b-0">Đổi mật khẩu</h2>
                                </div>
                                <form action="{{ route('auth.reset-password') }}" method="post">
                                    @csrf
                                    <input type="hidden" name="token" value="{{ $token->verification_token }}">
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="password">Mật khẩu mới:</label>
                                        <input type="password" name="password" class="form-control mb-3" id="password"
                                               placeholder="Mật khẩu mới">
                                        @error('password')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label class="font-weight-semibold" for="confirmPassword">Xác nhận mật
                                            khẩu:</label>
                                        <input type="password" name="confirmPassword" class="form-control mb-3"
                                               id="confirmPassword"
                                               placeholder="Xác nhận mật khẩu">
                                        @error('confirmPassword')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group ">
                                        <div class="d-flex align-items-center justify-content-between p-t-15">
                                            <button style="width: 100%" class="btn btn-primary">Đổi mật khẩu</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-none d-md-flex p-h-40 justify-content-between">
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
