<!DOCTYPE html>
<html lang="en" data-bs-theme="light">
<meta
    http-equiv="content-type"
    content="text/html;charset=utf-8"
/>
<head>
    <meta charset="UTF-8"/>
    <meta
        name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
    <title>Enlink - {{  !empty($title) ? $title : ''}}</title>
    <link rel="icon" href="assets/images/others/favicon.ico"/>

    @include('layouts.styles.styles')

    @yield('styles')

</head>
<body>

@include('layouts._header')

<main id="content" class="wrapper layout-page">

    @yield('content')

</main>

@include('layouts._footer')

@include('components.icon-header')

@include('components.modal.search')

@include('components.modal.shopping-cart')

<div class="position-fixed z-index-10 bottom-0 end-0 p-10">
    <a
        href="#"
        class="gtf-back-to-top text-decoration-none bg-body text-primary bg-primary-hover text-light-hover shadow square p-0 rounded-circle d-flex align-items-center justify-content-center"
        title="Back To Top"
        style="--square-size: 48px"
    ><i class="fa-solid fa-arrow-up"></i
        ></a>
</div>

@include('layouts.scripts.scripts')

@yield('scripts')
</body>
</html>
