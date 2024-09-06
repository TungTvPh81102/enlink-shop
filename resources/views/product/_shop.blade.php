@if(!empty($products->count()))
    <div class="row gy-11">
        @foreach($products as $item)
            <div class="col-sm-6 col-lg-4 col-xl-3">
                <div class="card card-product grid-2 bg-transparent border-0">
                    <figure class="card-img-top position-relative mb-7 overflow-hidden">
                        <a href="{{ route('product.detail',$item->slug) }}"
                           class="hover-zoom-in d-block"
                           title="Enriched Hand &amp; Body Wash">
                            <img style="height: 300px; object-fit: cover"
                                 src="{{ Storage::url($item->thumbnail_image) }}"
                                 class="img-fluid lazy-image w-100" alt="{{$item->name}}"
                                 width="330">
                        </a>
                        @if($item->product_type == 'is_new')
                            <div class="position-absolute product-flash z-index-2 "><span
                                    class="badge badge-product-flash on-new">New</span></div>
                        @endif
                        @if($item->price_sale > 0)
                            <div class="position-absolute product-flash z-index-2 "><span
                                    class="badge badge-product-flash on-sale bg-primary">-{{ $item->price_sale }}%</span>
                            </div>
                        @endif
                    </figure>
                    <div class="card-body text-center p-0">
                        @php
                            $discountedPrice = $item->price_sale > 0 ? $item->price_regular * (1 - ($item->price_sale / 100)) : $item->price_regular;
                        @endphp
                        @if($item->price_sale > 0)
                            <span
                                class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
                                                <del class="text-body fw-500 me-4 fs-13px">{{ number_format($item->price_regular) }}đ</del>
                                                    <span class="text-danger ms-2">{{ number_format($discountedPrice) }}đ</span>
                                            </span>
                        @else
                            <span
                                class="d-flex align-items-center price text-body-emphasis fw-bold justify-content-center mb-3 fs-6">
                                                {{ number_format($item->price_regular) }}đ
                                            </span>
                        @endif
                        <h4 class=" card-title text-primary-hover text-body-emphasis fs-15px fw-500 mb-3">
                            <a class="text-decoration-none text-reset text-truncate w-120 d-block"
                               href="{{ route('product.detail',$item->slug) }}">{{ $item->name }}</a>
                        </h4>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    @if($products->hasPages())
        {{ $products->links('vendor.pagination.custom-pagination', ['products' => $products]) }}
    @endif
@else
    <div class="row gy-11 text-center mt-4">
        <h1>Không có sản phẩm dành cho bạn</h1>
    </div>
@endif

