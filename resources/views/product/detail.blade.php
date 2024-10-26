@extends('layouts._app')

@section('styles')
    <style>
        .selected-color {
            border: 2px solid black;
        }
    </style>
@endsection

@section('content')
    <section class="z-index-2 position-relative pb-2 mb-12">
        <div class="bg-body-secondary mb-3">
            <div class="container">
                <nav class="py-4 lh-30px" aria-label="breadcrumb">
                    <ol class="breadcrumb justify-content-center py-1 mb-0">
                        <li class="breadcrumb-item">
                            <a title="Home" href="{{ route('home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item">
                            <a title="Shop" href="{{ route('product-category.list') }}">Sản phẩm</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">
                            {{ $product->name }}
                        </li>
                    </ol>
                </nav>
            </div>
        </div>
    </section>
    <section class="container container-xxl pt-6 pb-13 pb-lg-20">
        <div class="row">
            <div class="col-md-6 pe-lg-13">
                <div class="position-sticky top-0">
                    <div class="row">
                        <div class="col-xl-2 pe-xl-0 order-1 order-xl-0 mt-5 mt-xl-0">
                            <div id="slide-thumb-5" class="slick-slider slick-slider-thumb ps-1 ms-n3 me-n4 mx-xl-0"
                                 data-slick-options="{&#34;arrows&#34;:false,&#34;asNavFor&#34;:&#34;#slide-5&#34;,&#34;dots&#34;:false,&#34;focusOnSelect&#34;:true,&#34;responsive&#34;:[{&#34;breakpoint&#34;:1260,&#34;settings&#34;:{&#34;vertical&#34;:false}}],&#34;slidesToShow&#34;:4,&#34;vertical&#34;:true}">
                                @foreach ($product->galleries as $key => $value)
                                    <img src="{{ Storage::url($value->image) }}"
                                         class="
                                            cursor-pointer lazy-image h-auto mx-3 mx-xl-0 px-0 mb-xl-7
                                        "
                                         width="540" height="720" alt/>
                                @endforeach
                            </div>
                        </div>
                        <div class="col-xl-10 ps-xl-8 pe-xl-0 order-0 order-xl-1">
                            <div class="position-relative">
                                <div class="position-absolute z-index-2 w-100 d-flex justify-content-end">
                                    <div class="p-6">
                                        <a href="#"
                                           class="d-flex align-items-center justify-content-center product-gallery-action rounded-circle"
                                           data-bs-toggle="tooltip" data-bs-placement="left"
                                           data-bs-title="Add to wishlist">
                                            <svg class="icon fs-4">
                                                <use xlink:href="#icon-star-light"></use>
                                            </svg>
                                        </a>
                                        <a href="https://www.youtube.com/watch?v=6v2L2UGZJAM"
                                           class="view-video d-flex align-items-center justify-content-center mt-5 product-gallery-action rounded-circle"
                                           data-bs-toggle="tooltip" data-bs-placement="left" data-bs-title="Play Video">
                                            <svg class="icon fs-4">
                                                <use xlink:href="#icon-Play"></use>
                                            </svg>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div id="slide-5"
                                 class="slick-slider slick-slider-arrow-inside slick-slider-dots-inside slick-slider-dots-light g-0"
                                 data-slick-options="{&#34;arrows&#34;:false,&#34;asNavFor&#34;:&#34;#slide-thumb-5&#34;,&#34;dots&#34;:false,&#34;slidesToShow&#34;:1,&#34;vertical&#34;:true}">
                                @foreach ($product->galleries as $key => $value)
                                    <a href="#" data-gallery="gallery5"><img src="{{ Storage::url($value->image) }}"
                                                                             class="h-auto lazy-image" width="540"
                                                                             height="720" alt/>
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 pt-md-0 pt-10">
                <p class="d-flex align-items-center mb-6">
                    @if($product->price_sale > 0)
                        @php
                            $discountedPrice = $product->price_sale > 0
                            ? $product->price_regular * (1 - ($product->price_sale / 100))
                            : $product->price_regular;
                        @endphp
                        <span class="text-decoration-line-through">{{ number_format($product->price_regular) }}</span>
                        <span id="getPriceSale" class="fs-18px text-body-emphasis ps-6 fw-bold">
                            {{ number_format($discountedPrice) }}
                        </span>
                        <span
                            class="badge text-bg-primary fs-6 fw-semibold ms-7 px-6 py-3">{{ $product->price_sale }}%</span>
                    @else
                        <span class="fs-18px text-body-emphasis  fw-bold">
                            {{ number_format($product->price_regular) }}
                        </span>
                    @endif
                </p>
                <h1 class="mb-4 pb-2 fs-4">{{ $product->name ?? '' }}</h1>
                <p class="fs-15px">
                    {{ $product->description ?? '' }}
                </p>
                <form action="{{ route('cart.add-to-cart') }}" method="post" class="pb-8 mb-4">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                    <div class="form-group shop-swatch mb-7 d-flex align-items-center">
                        <span class="fw-semibold text-body-emphasis me-7">Kích cỡ: </span>
                        <ul class="list-inline d-flex justify-content-start mb-0">
                            @php
                                $displayedSizes = [];
                            @endphp
                            @foreach ($product->variants as $key => $value)
                                @php
                                    $sizeName = $value->size->name;
                                @endphp
                                @if (!in_array($sizeName, $displayedSizes))
                                    @php
                                        $displayedSizes[] = $sizeName;
                                    @endphp
                                    <li class="list-inline-item me-4 fw-semibold">
                                        <input type="radio" id="sizeRadio{{ $key }}" name="size_id"
                                               value="{{ $value->size->id }}"
                                               class="product-info-size d-none getSizePrice"
                                               {{ $key == 0 ? 'checked' : '' }} data-size="{{ $sizeName }}"/>
                                        <label for="sizeRadio{{ $key }}"
                                               class="fs-14px p-4 d-block rounded text-decoration-none border">{{ $sizeName }}</label>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group product-color mb-7 mt-3">
                        <label class="mb-2 pb-4">
                            <span class="fw-semibold text-body-emphasis me-2 pe-4">Color:</span>
                        </label>
                        <ul class="list-inline d-flex justify-content-start mb-0">
                            @php
                                $displayedColors = [];
                            @endphp
                            @foreach ($product->variants as $key => $value)
                                @php
                                    $colorCode = $value->color->code;
                                @endphp
                                @if (!in_array($colorCode, $displayedColors))
                                    @php
                                        $displayedColors[] = $colorCode;
                                    @endphp
                                    <li class="list-inline-item me-4 fw-semibold ">
                                        <input  type="radio" id="colorRadio{{ $colorCode }}" name="color_id"
                                               {{ $key == 0 ? 'checked' : '' }} class="product-info-color d-none getSizePrice"
                                               value="{{ $value->color->id }}"
                                               data-color="{{ $colorCode }}"
                                               data-quantity="{{ $value->quantity }} "
                                               data-prices='{{ $product->variants->where('color.code', $colorCode)->pluck('quantity', 'size.name') }}
                                                '/>
                                        <div style="background-color: {{ $colorCode }}">
                                            <label style="cursor: pointer; width: 20px; height: 20px" for="colorRadio{{ $colorCode }}"
                                                   class="fs-14px p-4 d-block rounded text-decoration-none border"></label>
                                        </div>
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="form-group shop-swatch mb-7 d-flex align-items-center">
                        <span class="fw-semibold text-body-emphasis me-7" id="stockStatus"> </span>
                    </div>
                    <div class="row align-items-end">
                        <div class="form-group col-sm-4">
                            <label class="text-body-emphasis fw-semibold fs-15px pb-6" for="number">Số lượng:</label>
                            <div class="input-group position-relative w-100 input-group-lg">
                                <a href="#"
                                   class="shop-down position-absolute translate-middle-y top-50 start-0 ps-7 product-info-2-minus">
                                    <i class="far fa-minus"></i>
                                </a>
                                <input name="qty" type="number" id="number"
                                       class="product-info-2-quantity form-control w-100 px-6 text-center mb-4"
                                       value="1" {{ old('qty') }} required/>
                                <a href="#"
                                   class="shop-up position-absolute translate-middle-y top-50 end-0 pe-7 product-info-2-plus">
                                    <i class="far fa-plus"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-sm-8 pt-9 mt-2 mt-sm-0 pt-sm-0">
                            <button id="addToCart" type="submit"
                                    class="btn-hover-bg-primary btn-hover-border-primary btn btn-lg btn-dark w-100">
                                Thêm vào giỏ hàng
                            </button>
                        </div>
                    </div>
                </form>
                <div class="d-flex align-items-center flex-wrap">
                    <a href="#" class="text-decoration-none fw-semibold fs-6 me-9 pe-2 d-flex align-items-center">
                        <svg class="icon fs-5">
                            <use xlink:href="#icon-star-light"></use>
                        </svg>
                        <span class="ms-4 ps-2">Yêu thích</span>
                    </a>
                    <a href="#" class="text-decoration-none fw-semibold fs-6 me-9 pe-2 d-flex align-items-center">
                        <svg class="icon fs-5">
                            <use xlink:href="#icon-ShareNetwork"></use>
                        </svg>
                        <span class="ms-4 ps-2">Chia sẻ</span>
                    </a>
                </div>
                <ul class=" list-unstyled border-top pt-7 mt-7">
                    <li class="d-flex mb-4 pb-2 align-items-center">
                        <span class="text-body-emphasis fw-semibold fs-14px">Sku:</span>
                        <span class="ps-4">{{ $product->sku }}</span>
                    </li>
                    <li class="d-flex mb-4 pb-2 align-items-center">
                        <span class="text-body-emphasis fw-semibold fs-14px">Danh mục:</span>
                        <span class="ps-4">
                            @if ($product->category->parent)
                                <span class="ps-4">
                                    {{ $product->category->parent->name ?? 'No Parent Category' }},</span>
                            @endif
                            {{ $product->category->name ?? '' }}
                        </span>
                    </li>
                    <li class="d-flex mb-4 pb-2 align-items-center">
                        <span class="text-body-emphasis fw-semibold fs-14px">Thương hiệu:</span>
                        <span class="ps-4">
                            {{ $product->brand->name ?? '' }}
                        </span>
                    </li>
                </ul>
                <div class="mt-13">
                    <div class="accordion accordion-flush" id="accordionFlushExample">
                        <div class="accordion-item pb-4">
                            <h2 class="accordion-header" id="flush-headingOne">
                                <a class="product-info-accordion text-decoration-none" href="#"
                                   data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false"
                                   aria-controls="flush-collapseOne">
                                    <span class="fs-4">Mô tả</span>
                                </a>
                            </h2>
                        </div>
                        <div id="flush-collapseOne" class="accordion-collapse collapse show"
                             aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                            <div class="pt-8 pb-3">
                                <p class="fw-semibold text-body-emphasis mb-2 pb-4">
                                    For Normal, Oily, Combination Skin Types
                                </p>
                                <p class="mb-2 pb-4">
                                    Complexion-perfecting natural foundation enriched with
                                    antioxidant-packed superfruits, vitamins, and other
                                    skin-nourishing nutrients. Creamy liquid formula sets with
                                    a pristine matte finish for soft, velvety smooth skin.
                                </p>
                                <p class="mb-7">
                                    Say hello to flawless, long-lasting foundation that comes
                                    in 7 melt-into-your-skin shades. This lightweight,
                                    innovative formula creates a smooth, natural matte finish
                                    that won’t settle into lines. It’s the perfect fit for
                                    your skin. 1 fl. oz.
                                </p>
                                <p class="fw-semibold text-body-emphasis mb-2 pb-4">
                                    Benefits
                                </p>
                                <ul class="mb-5 ps-6">
                                    <li class="mb-1">Buildable medium-to-full coverage</li>
                                    <li class="mb-1">Weightless, airy feel—no caking!</li>
                                    <li class="mb-1">Long-wearing</li>
                                    <li class="mb-1">Evens skin tone</li>
                                    <li>
                                        Available in 07 shades (all exclusive to Makeaholic!)
                                    </li>
                                </ul>
                                <div class="row">
                                    <div class="col-6 col-md-3 text-center mb-9 pb-2">
                                        <img class="lazy-image light-mode-img" src="#"
                                             data-src="../assets/images/shop/product-info-3-1.png" width="66"
                                             height="77" alt/>
                                        <img class="lazy-image dark-mode-img" src="#"
                                             data-src="../assets/images/shop/product-info-white-3-1.png" width="66"
                                             height="77" alt/>
                                    </div>
                                    <div class="col-6 col-md-3 text-center mb-9 pb-2">
                                        <img class="lazy-image light-mode-img" src="#"
                                             data-src="../assets/images/shop/product-info-3-2.png" width="66"
                                             height="77" alt/>
                                        <img class="lazy-image dark-mode-img" src="#"
                                             data-src="../assets/images/shop/product-info-white-3-2.png" width="66"
                                             height="77" alt/>
                                    </div>
                                    <div class="col-6 col-md-3 text-center mb-9 pb-2">
                                        <img class="lazy-image light-mode-img" src="#"
                                             data-src="../assets/images/shop/product-info-3-3.png" width="66"
                                             height="77" alt/>
                                        <img class="lazy-image dark-mode-img" src="#"
                                             data-src="../assets/images/shop/product-info-white-3-3.png" width="66"
                                             height="77" alt/>
                                    </div>
                                    <div class="col-6 col-md-3 text-center mb-9 pb-2">
                                        <img class="lazy-image light-mode-img" src="#"
                                             data-src="../assets/images/shop/product-info-3-4.png" width="66"
                                             height="77" alt/>
                                        <img class="lazy-image dark-mode-img" src="#"
                                             data-src="../assets/images/shop/product-info-white-3-4.png" width="66"
                                             height="77" alt/>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="accordion-item pb-4 mt-7">
                            <h2 class="accordion-header" id="flush-headingTwo">
                                <a class="product-info-accordion collapsed text-decoration-none" href="#"
                                   data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false"
                                   aria-controls="flush-collapseTwo">
                                    <span class="fs-4">Hướng dẫn sử dụng</span>
                                </a>
                            </h2>
                        </div>
                        <div id="flush-collapseTwo" class="accordion-collapse collapse"
                             aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                            <div class="pt-8 pb-3">
                                {!! $product->content !!}
                            </div>
                        </div>
                        <div class="accordion-item pb-4 mt-7">
                            <h2 class="accordion-header" id="flush-headingThree">
                                <a class="product-info-accordion collapsed text-decoration-none" href="#"
                                   data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false"
                                   aria-controls="flush-collapseThree">
                                    <span class="fs-4">Thành phần</span>
                                </a>
                            </h2>
                        </div>
                        <div id="flush-collapseThree" class="accordion-collapse collapse"
                             aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                            <div class="pt-8 pb-3">
                                <div class="table-responsive mb-5">
                                    <table class="table table-borderless mb-0">
                                        <tbody>
                                        <tr>
                                            <td class="ps-0 py-5 pe-5 text-body-emphasis">
                                                CAS
                                            </td>
                                            <td class="text-end py-5 ps-5 pe-0">
                                                92128-82-0, 9057-02-7
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-0 py-5 pe-5 text-body-emphasis">
                                                INCI
                                            </td>
                                            <td class="text-end py-5 ps-5 pe-0">
                                                Nannochloropsis Oculata (micro algae) extract,
                                                pullulan
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-0 py-5 pe-5 text-body-emphasis">
                                                Composition
                                            </td>
                                            <td class="text-end py-5 ps-5 pe-0">
                                                Nannochloropsis Oculata (micro algae) extract,
                                                pullulan, water, ethanol
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-0 py-5 pe-5 text-body-emphasis">
                                                Appearance
                                            </td>
                                            <td class="text-end py-5 ps-5 pe-0">
                                                Yellow to amber, viscous liquid
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-0 py-5 pe-5 text-body-emphasis">
                                                Solubility
                                            </td>
                                            <td class="text-end py-5 ps-5 pe-0">
                                                Soluble in water &amp; ethanol
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="ps-0 py-5 pe-5 text-body-emphasis">
                                                Storage
                                            </td>
                                            <td class="text-end py-5 ps-5 pe-0">
                                                Store refrigerated (4-8oC / 39-46oF)
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                                <p>
                                    Perfect for Equestrian homes or every horse lover.
                                    Designer premium signature aluminum alloy all Arthur Court
                                    is compliance with FDA regulations. Aluminum Serveware can
                                    be chilled in the freezer or refrigerator and warmed in
                                    the oven to 350. Wash by hand with mild dish soap and dry
                                    immediately – do not put in the dishwasher. Comes in Gift
                                    Box perfect for Equestrian home or Horse lover in your
                                    life.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (!empty($productRelated->count()))
        <div class="border-top w-100 h-1px"></div>
        <section class="container container-xxl pt-15 pb-15 pt-lg-17 pb-lg-20">
            <div class="text-center">
                <h2 class="mb-12">Sản phẩm cùng loại</h2>
            </div>
            <div class="slick-slider"
                 data-slick-options="{&#34;arrows&#34;:true,&#34;centerMode&#34;:true,&#34;centerPadding&#34;:&#34;calc((100% - 1440px) / 2)&#34;,&#34;dots&#34;:true,&#34;infinite&#34;:true,&#34;responsive&#34;:[{&#34;breakpoint&#34;:1200,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:3}},{&#34;breakpoint&#34;:992,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:2}},{&#34;breakpoint&#34;:576,&#34;settings&#34;:{&#34;arrows&#34;:false,&#34;dots&#34;:false,&#34;slidesToShow&#34;:1}}],&#34;slidesToShow&#34;:4}">
                @foreach ($productRelated as $item)
                    <div class="mb-6">
                        <div class="card card-product grid-2 bg-transparent border-0">
                            <figure class="card-img-top position-relative mb-7 overflow-hidden">
                                <a href="{{ route('product.detail', $item->slug) }}" class="hover-zoom-in d-block"
                                   title="Shield Conditioner">
                                    <img src="{{ Storage::url($item->thumbnail_image) }}"
                                         class="img-fluid lazy-image w-100" alt="{{ $item->name }}" width="330"
                                         height="440"/>
                                </a>
                                @if ($item->price_sale > 0)
                                    <div class="position-absolute product-flash z-index-2">
                                        <span
                                            class="badge badge-product-flash on-sale bg-primary">-{{ $item->price_sale }}%</span>
                                    </div>
                                @else
                                    @if ($item->product_type == 'is_new')
                                        <div class="position-absolute product-flash z-index-2">
                                            <span class="badge badge-product-flash on-new">New</span>
                                        </div>
                                    @endif
                                @endif
                            </figure>
                            <div class="card-body text-center p-0">
                                <h4
                                    class="product-title card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                                    <a class="text-decoration-none text-reset"
                                       href="{{ route('product.detail', $item->slug) }}">{{ $item->name }}</a>
                                </h4>
                                <div class="d-flex align-items-center fs-12px justify-content-center">
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach

            </div>
        </section>
    @endif
    <div class="border-top w-100 h-1px"></div>
    <section class="container container-xxl pt-15 pb-15 pt-lg-17 pb-lg-20">
        <div class="text-center">
            <h2 class="mb-16 fs-3">Customer Reviews</h2>
        </div>
        <div class="row">
            <div class="col-xl-3 col-md-5">
                <div class="position-sticky top-0 mb-md-0 mb-12">
                    <div class="card text-center border border-2 rounded product-review-info">
                        <div class="card-body px-4 py-10">
                            <h5 class="card-title fs-1 mb-6">4.86</h5>
                            <div class="d-flex align-items-center fs-15px ls-0 justify-content-center mb-4">
                                <div class="rating">
                                    <div class="empty-stars">
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="filled-stars" style="width: 90%">
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <p class="card-text mb-5 mt-4">2947 Reviews, 18 Q&As</p>
                            <div class="mb-8">
                                <div class="d-flex align-items-center justify-content-center mb-5">
                                    <p class="text-start m-0 review-star">5 stars</p>
                                    <div class="mx-5 d-block mw-160px mw-lg-120px mw-sm-60 w-100">
                                        <div class="progress" style="height: 6px">
                                            <div class="progress-bar" role="progressbar" aria-label="Example 1px high"
                                                 style="width: 78%" aria-valuenow="25" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <p class="text-end m-0 review-percent">78%</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-5">
                                    <p class="text-start m-0 review-star">4 stars</p>
                                    <div class="mx-5 d-block mw-160px mw-lg-120px mw-sm-60 w-100">
                                        <div class="progress" style="height: 6px">
                                            <div class="progress-bar" role="progressbar" aria-label="Example 1px high"
                                                 style="width: 17%" aria-valuenow="25" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <p class="text-end m-0 review-percent">17%</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-5">
                                    <p class="text-start m-0 review-star">3 stars</p>
                                    <div class="mx-5 d-block mw-160px mw-lg-120px mw-sm-60 w-100">
                                        <div class="progress" style="height: 6px">
                                            <div class="progress-bar" role="progressbar" aria-label="Example 1px high"
                                                 style="width: 3%" aria-valuenow="25" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <p class="text-end m-0 review-percent">3%</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-5">
                                    <p class="text-start m-0 review-star">2 stars</p>
                                    <div class="mx-5 d-block mw-160px mw-lg-120px mw-sm-60 w-100">
                                        <div class="progress" style="height: 6px">
                                            <div class="progress-bar" role="progressbar" aria-label="Example 1px high"
                                                 style="width: 2%" aria-valuenow="25" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <p class="text-end m-0 review-percent">2%</p>
                                </div>
                                <div class="d-flex align-items-center justify-content-center mb-5">
                                    <p class="text-start m-0 review-star">1 stars</p>
                                    <div class="mx-5 d-block mw-160px mw-lg-120px mw-sm-60 w-100">
                                        <div class="progress" style="height: 6px">
                                            <div class="progress-bar" role="progressbar" aria-label="Example 1px high"
                                                 style="width: 0%" aria-valuenow="25" aria-valuemin="0"
                                                 aria-valuemax="100"></div>
                                        </div>
                                    </div>
                                    <p class="text-end m-0 review-percent">0%</p>
                                </div>
                            </div>
                            <a href="#customer-review" class="btn btn-outline-dark" data-bs-toggle="collapse"
                               role="button" aria-expanded="false" aria-controls="customer-review">
                                <svg class="icon">
                                    <use xlink:href="#icon-Pencil"></use>
                                </svg>
                                Wire A Review</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ps-lg-12 ps-auto col-xl-9 col-md-7">
                <div class="collapse mb-14" id="customer-review">
                    <form class="product-review-form">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group mb-7">
                                    <label class="mb-4 fs-6 fw-semibold text-body-emphasis"
                                           for="reviewName">Name</label>
                                    <input id="reviewName" class="form-control" type="text" name="name"/>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group mb-4">
                                    <label class="mb-4 fs-6 fw-semibold text-body-emphasis"
                                           for="reviewEmail">Email</label>
                                    <input id="reviewEmail" type="email" name="email" class="form-control"/>
                                </div>
                            </div>
                        </div>
                        <div>
                            <p class="mt-4 mb-5 fs-6 fw-semibold text-body-emphasis">
                                Your Rating*
                            </p>
                            <div class="form-group mb-6 d-flex justify-content-start">
                                <div class="rate-input">
                                    <input type="radio" id="star5" name="rate" value="5" style/>
                                    <label for="star5" title="text" class="mb-0 mr-1 lh-1">
                                        <i class="far fa-star"></i>
                                    </label>
                                    <input type="radio" id="star4" name="rate" value="5" style/>
                                    <label for="star4" title="text" class="mb-0 mr-1 lh-1">
                                        <i class="far fa-star"></i>
                                    </label>
                                    <input type="radio" id="star3" name="rate" value="5" style/>
                                    <label for="star3" title="text" class="mb-0 mr-1 lh-1">
                                        <i class="far fa-star"></i>
                                    </label>
                                    <input type="radio" id="star2" name="rate" value="5" style/>
                                    <label for="star2" title="text" class="mb-0 mr-1 lh-1">
                                        <i class="far fa-star"></i>
                                    </label>
                                    <input type="radio" id="star1" name="rate" value="5" style/>
                                    <label for="star1" title="text" class="mb-0 mr-1 lh-1">
                                        <i class="far fa-star"></i>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group mb-7">
                            <label class="mb-4 fs-6 fw-semibold text-body-emphasis" for="reviewTitle">Title of
                                Review:</label>
                            <input id="reviewTitle" type="text" name="title" class="form-control"/>
                        </div>
                        <div class="form-group mb-10">
                            <label class="mb-4 fs-6 fw-semibold text-body-emphasis" for="reviewMessage">How was your
                                overall experience?</label>
                            <textarea id="reviewMessage" class="form-control" name="message" rows="5"></textarea>
                        </div>
                        <div class="d-flex">
                            <div class="me-4">
                                <div class="input-group align-items-center">
                                    <input type="file" name="img" class="form-control border"
                                           id="reviewrAddPhoto"/>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="product-filter-review">
                    <h3 class="fs-5">Filter Review</h3>
                    <ul class="list-inline mb-8 mx-n3 filter-review">
                        <li class="list-inline-item spacing">
                            <a href="#"
                               class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                Foundation
                            </a>
                        </li>
                        <li class="list-inline-item spacing">
                            <a href="#"
                               class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                Coverage
                            </a>
                        </li>
                        <li class="list-inline-item spacing">
                            <a href="#"
                               class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                Skin
                            </a>
                        </li>
                        <li class="list-inline-item spacing">
                            <a href="#"
                               class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                Color
                            </a>
                        </li>
                        <li class="list-inline-item spacing">
                            <a href="#"
                               class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                Shade
                            </a>
                        </li>
                        <li class="list-inline-item spacing">
                            <a href="#"
                               class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                Make up
                            </a>
                        </li>
                        <li class="list-inline-item spacing">
                            <a href="#"
                               class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                Face
                            </a>
                        </li>
                        <li class="list-inline-item spacing">
                            <a href="#"
                               class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                Ingredients
                            </a>
                        </li>
                        <li class="list-inline-item spacing">
                            <a href="#"
                               class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                Moisturizer
                            </a>
                        </li>
                        <li class="list-inline-item spacing">
                            <a href="#"
                               class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                Pure
                            </a>
                        </li>
                        <li class="list-inline-item spacing">
                            <a href="#"
                               class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                Nature
                            </a>
                        </li>
                        <li class="list-inline-item">
                            <a class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500"
                               data-bs-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false"
                               aria-controls="collapseExample">
                                ...
                            </a>
                        </li>
                        <li class="collapse m-3 list-inline-item collapse" id="collapseExample">
                            <ul class="list-inline list-inline-item">
                                <li class="list-inline-item">
                                    <a href="#"
                                       class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                        Good Value
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-inline list-inline-item">
                                <li class="list-inline-item">
                                    <a href="#"
                                       class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                        Lightweight
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-inline list-inline-item">
                                <li class="list-inline-item">
                                    <a href="#"
                                       class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                        Smells Great
                                    </a>
                                </li>
                            </ul>
                            <ul class="list-inline list-inline-item">
                                <li class="list-inline-item">
                                    <a href="#"
                                       class="btn btn-outline btn-hove-border-body-emphasis-color btn-border-1 py-4 px-6 fw-500">
                                        Easy To Use
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    <div class="row gy-15px align-items-center spacing-02">
                        <div class="col-auto search-review w-100 px-4">
                            <div class="form-group product-review-form">
                                <div class="input-group-prepend position-absolute z-index-10">
                                    <button class="btn btn-link text-secondary fs-15px px-7" type="submit">
                                        <i class="far fa-search"></i>
                                    </button>
                                </div>
                                <input type="text" id="search_reviews" name="search_reviews"
                                       class="form-control fs-15px pe-7 ps-13 rounded" placeholder="Search reviews"/>
                                <label for="search_reviews" class="visually-hidden">Search reviews</label>
                            </div>
                        </div>
                        <div class="col-auto dropdown skin-goal px-4">
                            <label for="skin_goal" class="visually-hidden">Skin goal</label>
                            <select name="skin_goal" id="skin_goal" class="form-select">
                                <option>Skin goal</option>
                                <option>Looking Pores</option>
                                <option>Clear Skin</option>
                                <option>Chicagon</option>
                                <option>Dewy-Looking Skin</option>
                                <option>Radiant</option>
                            </select>
                        </div>
                        <div class="col-auto dropdown skin-goal px-4">
                            <label for="image_video" class="visually-hidden">Image &amp; Video</label>
                            <select name="image_video" id="image_video" class="form-select">
                                <option>Image &amp; Video</option>
                                <option>Newest</option>
                                <option>Oldest</option>
                            </select>
                        </div>
                        <div class="col-auto dropdown skin-goal px-4">
                            <label for="sort_by" class="visually-hidden">Sort by</label>
                            <select name="sort_by" id="sort_by" class="form-select">
                                <option>Sort by</option>
                                <option>Newest</option>
                                <option>Oldest</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="mt-12">
                    <h3 class="fs-5">2947 Reviews</h3>
                    <div class="border-bottom pb-7 pt-10">
                        <div class="d-flex align-items-center mb-6">
                            <div class="d-flex align-items-center fs-15px ls-0">
                                <div class="rating">
                                    <div class="empty-stars">
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="filled-stars" style="width: 100%">
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span class="fs-3px mx-5"><i class="fas fa-circle"></i></span>
                            <span class="fs-14">5 day ago</span>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-5">
                            <img src="#" data-src="../assets/images/others/single-product-01.png"
                                 class="me-6 lazy-image rounded-circle" width="60" height="60" alt="Avatar"/>
                            <div class>
                                <h5 class="mt-0 mb-4 fs-14px text-uppercase ls-1">
                                    JENNIFER C.
                                </h5>
                                <p class="mb-0">/ Orlando, FL</p>
                            </div>
                        </div>
                        <p class="fw-semibold fs-6 text-body-emphasis mb-5">
                            Favorite Foundation
                        </p>
                        <p class="mb-10 fs-6">
                            I order the samples so as not to make mistakes when choosing
                            my color Is a good product as a light shade but the sample
                            doesn&#39;t contain enough product to cover the skin and
                            decide clearly, around my eyes I used the “peach bisque”. I
                            used with primer all mu face and finished texture is good. At
                            the end for my latin tan skin a choose “golden peach” But is
                            out of stock the primer I think is a good match.
                        </p>
                        <div class="d-flex justify-content-end align-items-center">
                            <a href="#" class="fs-14px mb-0 text-secondary">Was This Review Helpful?</a>
                            <p class="mb-0 ms-7 text-body-emphasis">
                                <svg class="icon icon-like align-baseline">
                                    <use xlink:href="#icon-like"></use>
                                </svg>
                                10
                            </p>
                            <p class="mb-0 ms-6 text-body-emphasis">
                                <svg class="icon icon-unlike align-baseline">
                                    <use xlink:href="#icon-unlike"></use>
                                </svg>
                                1
                            </p>
                        </div>
                    </div>
                    <div class="border-bottom pb-7 pt-10">
                        <div class="d-flex align-items-center mb-6">
                            <div class="d-flex align-items-center fs-15px ls-0">
                                <div class="rating">
                                    <div class="empty-stars">
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="filled-stars" style="width: 80%">
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span class="fs-3px mx-5"><i class="fas fa-circle"></i></span>
                            <span class="fs-14">3 day ago</span>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-5">
                            <img src="#" data-src="../assets/images/others/product-review-avatar-01.jpg"
                                 class="me-6 lazy-image rounded-circle" width="60" height="60" alt="Avatar"/>
                            <div class>
                                <h5 class="mt-0 mb-4 fs-14px text-uppercase ls-1">
                                    JENNIFER C.
                                </h5>
                                <p class="mb-0">/ Georgia</p>
                            </div>
                        </div>
                        <p class="fw-semibold fs-6 text-body-emphasis mb-5">
                            Good as light coverage
                        </p>
                        <p class="mb-10 fs-6">
                            The foundation feels light on my face, and the color matches
                            great. Also the customer service is phenomenal. I would
                            purchase again.
                        </p>
                        <div class="mb-10">
                            <img src="#" data-src="../assets/images/others/single-product-03.jpg"
                                 class="mx-3 w-auto lazy-image" alt/>
                            <img src="#" data-src="../assets/images/others/single-product-02.jpg"
                                 class="mx-3 w-auto lazy-image" alt/>
                        </div>
                        <div class="d-flex justify-content-end align-items-center">
                            <a href="#" class="fs-14px mb-0 text-secondary">Was This Review Helpful?</a>
                            <p class="mb-0 ms-7 text-body-emphasis">
                                <svg class="icon icon-like align-baseline">
                                    <use xlink:href="#icon-like"></use>
                                </svg>
                                12
                            </p>
                            <p class="mb-0 ms-6 text-body-emphasis">
                                <svg class="icon icon-unlike align-baseline">
                                    <use xlink:href="#icon-unlike"></use>
                                </svg>
                                4
                            </p>
                        </div>
                    </div>
                    <div class="border-bottom pb-7 pt-10">
                        <div class="d-flex align-items-center mb-6">
                            <div class="d-flex align-items-center fs-15px ls-0">
                                <div class="rating">
                                    <div class="empty-stars">
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="filled-stars" style="width: 100%">
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span class="fs-3px mx-5"><i class="fas fa-circle"></i></span>
                            <span class="fs-14">3 day ago</span>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-5">
                            <img src="#" data-src="../assets/images/others/product-review-avatar-03.jpg"
                                 class="me-6 lazy-image rounded-circle" width="60" height="60" alt="Avatar"/>
                            <div class>
                                <h5 class="mt-0 mb-4 fs-14px text-uppercase ls-1">
                                    JENNIFER C.
                                </h5>
                                <p class="mb-0">/ Orlando, FL</p>
                            </div>
                        </div>
                        <p class="fw-semibold fs-6 text-body-emphasis mb-5">
                            Favorite Foundation
                        </p>
                        <p class="mb-10 fs-6">
                            The foundation feels light on my face, and the color matches
                            great. Also the customer service is phenomenal. I would
                            purchase again.
                        </p>
                        <div class="mb-10">
                            <img src="#" data-src="../assets/images/others/single-product-03.jpg"
                                 class="mx-3 w-auto lazy-image" alt/>
                            <img src="#" data-src="../assets/images/others/single-product-02.jpg"
                                 class="mx-3 w-auto lazy-image" alt/>
                        </div>
                        <div class="d-flex justify-content-end align-items-center">
                            <a href="#" class="fs-14px mb-0 text-secondary">Was This Review Helpful?</a>
                            <p class="mb-0 ms-7 text-body-emphasis">
                                <svg class="icon icon-like align-baseline">
                                    <use xlink:href="#icon-like"></use>
                                </svg>
                                10
                            </p>
                            <p class="mb-0 ms-6 text-body-emphasis">
                                <svg class="icon icon-unlike align-baseline">
                                    <use xlink:href="#icon-unlike"></use>
                                </svg>
                                0
                            </p>
                        </div>
                    </div>
                    <div class="border-bottom pb-7 pt-10">
                        <div class="d-flex align-items-center mb-6">
                            <div class="d-flex align-items-center fs-15px ls-0">
                                <div class="rating">
                                    <div class="empty-stars">
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="filled-stars" style="width: 100%">
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span class="fs-3px mx-5"><i class="fas fa-circle"></i></span>
                            <span class="fs-14">3 day ago</span>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-5">
                            <img src="#" data-src="../assets/images/others/product-review-avatar-02.jpg"
                                 class="me-6 lazy-image rounded-circle" width="60" height="60" alt="Avatar"/>
                            <div class>
                                <h5 class="mt-0 mb-4 fs-14px text-uppercase ls-1">
                                    JENNIFER C.
                                </h5>
                                <p class="mb-0">/ Orlando, FL</p>
                            </div>
                        </div>
                        <p class="fw-semibold fs-6 text-body-emphasis mb-5">
                            Favorite Foundation
                        </p>
                        <p class="mb-10 fs-6">
                            I order the samples so as not to make mistakes when choosing
                            my color Is a good product as a light shade but the sample
                            doesn’t contain enough product to cover the skin and decide
                            clearly, around my eyes I used the “peach bisque”.I used with
                            primer all mu face and finished texture is good. At the end
                            for my latin tan skin a choose “golden peach” But is out of
                            stock the primer I think is a good match.
                        </p>
                        <div class="d-flex justify-content-end align-items-center">
                            <a href="#" class="fs-14px mb-0 text-secondary">Was This Review Helpful?</a>
                            <p class="mb-0 ms-7 text-body-emphasis">
                                <svg class="icon icon-like align-baseline">
                                    <use xlink:href="#icon-like"></use>
                                </svg>
                                10
                            </p>
                            <p class="mb-0 ms-6 text-body-emphasis">
                                <svg class="icon icon-unlike align-baseline">
                                    <use xlink:href="#icon-unlike"></use>
                                </svg>
                                0
                            </p>
                        </div>
                    </div>
                    <div class="border-bottom pb-7 pt-10">
                        <div class="d-flex align-items-center mb-6">
                            <div class="d-flex align-items-center fs-15px ls-0">
                                <div class="rating">
                                    <div class="empty-stars">
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star-o">
                                                <use xlink:href="#star-o"></use>
                                            </svg>
                                        </span>
                                    </div>
                                    <div class="filled-stars" style="width: 100%">
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                        <span class="star">
                                            <svg class="icon star text-primary">
                                                <use xlink:href="#star"></use>
                                            </svg>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            <span class="fs-3px mx-5"><i class="fas fa-circle"></i></span>
                            <span class="fs-14">3 day ago</span>
                        </div>
                        <div class="d-flex justify-content-start align-items-center mb-5">
                            <img src="#" data-src="../assets/images/others/product-review-avatar-03.jpg"
                                 class="me-6 lazy-image rounded-circle" width="60" height="60" alt="Avatar"/>
                            <div class>
                                <h5 class="mt-0 mb-4 fs-14px text-uppercase ls-1">
                                    Lucille D
                                </h5>
                                <p class="mb-0">/ Georgia</p>
                            </div>
                        </div>
                        <p class="fw-semibold fs-6 text-body-emphasis mb-5">
                            Good as light coverage
                        </p>
                        <p class="mb-10 fs-6">
                            The foundation feels light on my face, and the color matches
                            great. Also the customer service is phenomenal. I would
                            purchase again.
                        </p>
                        <div class="mb-10">
                            <img src="#" data-src="../assets/images/others/single-product-03.jpg"
                                 class="mx-3 w-auto lazy-image" alt/>
                            <img src="#" data-src="../assets/images/others/single-product-02.jpg"
                                 class="mx-3 w-auto lazy-image" alt/>
                        </div>
                        <div class="d-flex justify-content-end align-items-center">
                            <a href="#" class="fs-14px mb-0 text-secondary">Was This Review Helpful?</a>
                            <p class="mb-0 ms-7 text-body-emphasis">
                                <svg class="icon icon-like align-baseline">
                                    <use xlink:href="#icon-like"></use>
                                </svg>
                                10
                            </p>
                            <p class="mb-0 ms-6 text-body-emphasis">
                                <svg class="icon icon-unlike align-baseline">
                                    <use xlink:href="#icon-unlike"></use>
                                </svg>
                                0
                            </p>
                        </div>
                    </div>
                </div>
                <nav class="d-flex mt-13 pt-3 justify-content-center" aria-label="pagination">
                    <ul class="pagination m-0">
                        <li class="page-item">
                            <a class="page-link rounded-circle d-flex align-items-center justify-content-center"
                               href="#" aria-label="Previous">
                                <svg class="icon">
                                    <use xlink:href="#icon-angle-double-left"></use>
                                </svg>
                            </a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">1</a></li>
                        <li class="page-item active">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item"><a class="page-link" href="#">3</a></li>
                        <li class="page-item"><a class="page-link" href="#">...</a></li>
                        <li class="page-item"><a class="page-link" href="#">6</a></li>
                        <li class="page-item">
                            <a class="page-link rounded-circle d-flex align-items-center justify-content-center"
                               href="#" aria-label="Next">
                                <svg class="icon">
                                    <use xlink:href="#icon-angle-double-right"></use>
                                </svg>
                            </a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            let selectedSize = document.querySelector('input[name="size_id"]:checked').dataset.size;

            function updateAvailableColors(selectedSize) {
                let firstAvailableColor = null;
                document.querySelectorAll('input[name="color_id"]').forEach(function (colorInput) {
                    let prices = JSON.parse(colorInput.dataset.prices);
                    if (prices[selectedSize]) {
                        colorInput.disabled = false;
                        colorInput.parentNode.style.opacity = 1;
                        if (!firstAvailableColor) {
                            firstAvailableColor = colorInput;
                        }
                    } else {
                        colorInput.disabled = true;
                        colorInput.parentNode.style.opacity = 0.5;
                    }
                });

                if (firstAvailableColor) {
                    firstAvailableColor.checked = true;
                }
            }

            function handleSizeChange(sizeInput) {
                selectedSize = sizeInput.dataset.size;
                sizeInput.checked = true;
                updateAvailableColors(selectedSize);
            }

            function updateSelectedColorBorder() {
                document.querySelectorAll('input[name="color_id"]').forEach(function (colorInput) {
                    let label = document.querySelector(`label[for="${colorInput.id}"]`);
                    if (colorInput.checked) {
                        label.classList.remove('border');
                        label.classList.add('selected-color');
                    } else {
                        label.classList.add('border');
                        label.classList.remove('selected-color');
                    }
                });
            }

            function updateStockStatus() {
                let selectedColorInput = document.querySelector('input[name="color_id"]:checked');
                const stockStatusElement = document.getElementById('stockStatus');

                if (selectedColorInput) {
                    const quantity = selectedColorInput.getAttribute('data-quantity')
                    console.log(quantity);
                    let qty = JSON.parse(quantity);
                    console.log(qty);
                    if (quantity > 0) {
                        stockStatusElement.textContent = 'Tình trạng: Còn hàng';
                        $('#addToCart').prop('disabled', false);
                    } else {
                        $('#addToCart').prop('disabled', true);
                        stockStatusElement.textContent = 'Tình trạng: Hết hàng';
                    }
                }
            }

            updateAvailableColors(selectedSize);
            updateSelectedColorBorder();
            updateStockStatus();

            document.querySelectorAll('input[name="size_id"]').forEach(function (sizeInput) {
                sizeInput.addEventListener('change', function () {
                    handleSizeChange(this);
                    updateSelectedColorBorder();
                    updateStockStatus();
                });
            });

            document.querySelectorAll('input[name="color_id"]').forEach(function (colorInput) {
                colorInput.addEventListener('change', function () {
                    updateSelectedColorBorder();
                    updateStockStatus();
                });
            });
        });
    </script>
@endsection
