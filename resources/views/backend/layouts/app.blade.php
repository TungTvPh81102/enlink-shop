<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}"/>
    <title>Enlink - {{ !empty($title) ? $title : 'Dashboard' }}</title>

    <link rel="shortcut icon" href="{{ asset('assets/backend/images/logo/favicon.png') }}">
    <link rel="stylesheet"
          href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <!-- or -->
    <link rel="stylesheet"
          href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!-- page css -->
    @yield('style')

    <!-- Core css -->
    <link href="{{ asset('assets/backend/css/app.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

</head>

<body>
<div class="app">
    <div class="layout">
        <!-- Header START -->
        @include('backend.layouts.header')
        <!-- Header END -->

        <!-- Side Nav START -->
        @include('backend.layouts.side-nav')
        <!-- Side Nav END -->

        <!-- Page Container START -->
        <div class="page-container">
            <!-- Content Wrapper START -->
            @yield('content')
            <!-- Content Wrapper END -->

            <!-- Footer START -->
            @include('backend.layouts.footer')
            <!-- Footer END -->

        </div>
        <!-- Page Container END -->

        <!-- Search Start-->
        @include('backend.components.model-search')
        <!-- Search End-->

        <!-- Quick View START -->
        @include('backend.components.view-config')
        <!-- Quick View END -->
    </div>
</div>


<!-- Core Vendors JS -->
<script src="{{ asset('assets/backend/js/vendors.min.js')}}"></script>

<!-- page js -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

{{--@if (session('success'))--}}
{{--    <script>--}}
{{--        toastr.success("{{ session('success') }}");--}}
{{--    </script>--}}
{{--@endif--}}

@yield('script')

<!-- Core JS -->
<script !src="">
    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $(".sweet-confirm").click(function (event) {
            event.preventDefault();

            let deleteUrl = $(this).attr("href");

            Swal.fire({
                title: "Bạn có muốn xóa ?",
                text: "Bạn sẽ không thể khôi phục dữ liệu khi xoá!!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Đồng ý!!",
                cancelButtonText: "Huỷ!!"
            }).then((result) => {
                if (result.isConfirmed) {
                    $.ajax({
                        type: "DELETE",
                        url: deleteUrl,
                        success: function (data) {
                            if (data.status === 'success') {
                                Swal.fire({
                                    title: 'Thao tác thành công!',
                                    text: data.message,
                                    icon: 'success'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        location.reload();
                                    }
                                });
                            } else if (data.status === 'error') {
                                Swal.fire({
                                    title: "Thao tác thất bại!",
                                    text: data.message,
                                    icon: 'error'
                                });
                            }
                        },
                        error: function (data) {
                            console.log('Error:', data);
                        }
                    });
                }
            });
        });
    });
</script>

<script src="{{ asset('assets/backend/js/app.min.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://unpkg.com/boxicons@2.1.3/dist/boxicons.js"></script>
</body>

</html>
