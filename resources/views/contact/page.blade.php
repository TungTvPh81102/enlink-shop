@extends('layouts._app')

@section('content')
    <section data-animated-id="1">
        <div class="bg-body-secondary py-5">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb breadcrumb-site py-0 d-flex justify-content-center">
                    <li class="breadcrumb-item"><a class="text-decoration-none text-body" href="{{ route('home') }}">Trang
                            chủ</a>
                    </li>
                    <li class="breadcrumb-item active pl-0 d-flex align-items-center" aria-current="page">
                        {{ $title ?? '' }}
                    </li>
                </ol>
            </nav>
        </div>
    </section>
    <section class="py-11 py-lg-18" data-animated-id="2">
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <h2 class="mb-11 fs-3">Hãy liên hệ với chúng tôi</h2>
                    <form class="contact-form" method="post" action="{{ route('contact.handle-contact') }}">
                        @csrf
                        <div class="row mb-8 mb-md-10">
                            <div class="col-md-6 col-12 mb-8 mb-md-0">
                                <input type="text" name="full_name" class="form-control input-focus"
                                       placeholder="Tên của bạn" required
                                       value="{{ Auth::check() ? Auth::user()->name : old('full_name') }}">
                            </div>
                            <div class="col-md-6 col-12">
                                <input type="email" name="email" class="form-control input-focus" placeholder="Email"
                                       required value="{{ Auth::check() ? Auth::user()->email : old('email') }}">
                            </div>
                        </div>
                        <textarea name="message" class="form-control mb-6 input-focus" placeholder="Ghi chú"
                                  rows="7" required>{{ old('message') }}</textarea>
                        <button type="submit" class=" btn btn-dark btn-hover-bg-primary btn-hover-border-primary px-11">
                            Gửi yêu cầu
                        </button>
                    </form>
                </div>
                <div class="col-lg-5 ps-lg-18 ps-xl-21 mt-13 mt-lg-0">
                    <div class="d-flex align-items-start mb-11 me-15">
                        <div class="d-none">
                            <svg class="icon fs-2">
                                <use xlink:href="#"></use>
                            </svg>
                        </div>
                        <div>
                            <h3 class="fs-5 mb-6">Địa chỉ</h3>
                            <div class="fs-6">
                                <p class="mb-5 fs-6">{{ config('settings.address') }}</p>
                                <p class="mb-5">{{ config('settings.address_2') }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex align-items-start">
                        <div class="d-none">
                            <svg class="icon fs-2">
                                <use xlink:href="#"></use>
                            </svg>
                        </div>
                        <div>
                            <h3 class="fs-5 mb-6">Liên hệ</h3>
                            <div class="fs-6">
                                <p class="mb-3 fs-6">Mobile:<span
                                        class="text-body-emphasis"> {{ config('settings.phone') }}</span></p>
                                <p class="mb-3 fs-6">Hotline:<span
                                        class="text-body-emphasis"> {{ config('settings.hotline') }}</span></p>
                                <p class="mb-0 fs-6">E-mail: {{ config('settings.email') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection


