@extends('backend.layouts.app')

@section('style')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
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
        @include('backend.components.message')
        <form action="{{ route('admin.products.update', $product->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card">
                <div class="card-body">
                    <h4>{{ $subtitle ?? '' }}</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control mb-3" id="formGroupExampleInput"
                                       placeholder="Tên sản phẩm" value="{{ old('name', $product->name) }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Mã sản phẩm</label>
                                <input type="text" name="sku" class="form-control mb-3" id="formGroupExampleInput2"
                                       placeholder="Mã sản phẩm" value="{{ old('sku',$product->sku) }}">
                                @error('sku')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <label for="formGroupExampleInput2">Danh mục</label>
                            <select name="category_id" id="" class="form-control mb-3">
                                <option value="">--- Chọn ---</option>
                                @foreach ($categories as $parent)
                                    @php($each = '')
                                    @include('backend.category.nest', [
                                        'category' => $parent,
                                        'each' => $each,
                                        'selectedCategoryId' => old('category_id', $product->category_id)
                                    ])
                                @endforeach
                            </select>
                            @error('category_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-md-6">
                            <label for="formGroupExampleInput2">Thương hiệu</label>
                            <select name="brand_id" id="" class="form-control mb-3">
                                <option value="">--- Chọn ---</option>
                                @foreach($brands as $item)
                                    <option
                                        {{ old('brand_id', $product->brand_id) == $item->id ? 'selected' : '' }} value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            @error('brand_id')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Giá bán thường</label>
                                <input type="text" name="price_regular" class="form-control mb-3"
                                       placeholder="Giá bán thường"
                                       value="{{ old('price_regular', $product->price_regular) }}">
                                @error('price_regular')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Giảm giá</label>
                                <input type="text" name="price_sale" class="form-control mb-3"
                                       placeholder="Giá bán thường"
                                       value="{{ old('price_sale', $product->price_sale ?? 0) }}">
                                @error('price_sale')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Ảnh đại diện</label>
                        <input type="file" name="thumbnail_image" class="form-control mb-3">
                        @error('thumbnail_image')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <div class="mt-3">
                            <img style="width: 200px" src="{{ Storage::url($product->thumbnail_image) }}" alt="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Mô tả ngắn</label>
                        <textarea name="description"
                                  class="form-control mb-3">{{ old('description',$product->description) }}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Nội dung</label>
                        <textarea name="content" class="form-control mb-3"
                                  id="summernote">{{ old('content',$product->content) }}</textarea>
                        @error('content')
                        <span class="text-danger ">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Ảnh sản phẩm</h4>
                        <div class="btn btn-primary add-gallery" style="cursor: pointer">
                            <i class="anticon anticon-plus"></i>
                        </div>
                    </div>
                    <div class="form-group mb-3 gallery-wrapper">
                        @if($product->galleries->count())
                            <div class="d-flex" id="sortable">
                                @foreach($product->galleries as $item)
                                    <div class="mr-4">
                                        <label for="name">Hình ảnh {{ $loop->iteration }}</label>
                                        <div class="mb-3 sortable_image" id="{{ $item->id }}">
                                            <img style="width: 200px; height: 300px; object-fit: cover"
                                                 src="{{ Storage::url($item->image) }}" alt="">
                                        </div>
                                        <a style="cursor: pointer"
                                           href="{{ route('admin.products.gallery.delete',$item->id ) }}"
                                           class="btn btn-sm btn-danger sweet-confirm">Xoá</a>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                    </div>
                    @error('product_gallery')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Biến thể </h4>
                        <div class="btn btn-primary add-variant"><i class="anticon anticon-plus"></i></div>
                    </div>
                    <div class="form-group mb-3 mt-3">
                        <div class="table-responsive">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th scope="col">Kích cỡ</th>
                                    <th scope="col">Màu sắc</th>
                                    <th scope="col">Giá</th>
                                    <th>Số lượng</th>
                                    <th></th>
                                </tr>
                                </thead>
                                <tbody class="variant-wrapper">
                                @if($product->variants->count())
                                    @foreach($product->variants as $item)
                                        <tr id="${id}">
                                            <th scope="row">
                                                <select
                                                    id="size-select" class="form-control ">
                                                    <option value="">--- Chọn ---</option>
                                                    @foreach($sizes as $id => $name)
                                                        <option
                                                            {{ $item->size_id == $id ? 'selected' : '' }} value="{{ $id }}">
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </th>
                                            <td>
                                                <select
                                                    id="color-select" class="form-control">
                                                    <option value="">--- Chọn ---</option>
                                                    @foreach($colors as $id => $name)
                                                        <option
                                                            {{ $item->color_id == $id ? 'selected' : '' }} value="{{ $id }}">
                                                            {{ $name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </td>
                                            <td>
                                                <input
                                                    name="product_variants[{{ $item->size_id }}-{{ $item->color_id }}][price]"
                                                    value="{{ $item->price }}" class="form-control" id="price-input"
                                                    placeholder="Giá" type="number">
                                            </td>
                                            <td>
                                                <input
                                                    name="product_variants[{{ $item->size_id }}-{{ $item->color_id }}][quantity]"
                                                    value="{{ $item->quantity }}" class="form-control"
                                                    id="quantity-input" placeholder="Số lượng" type="number">
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.products.variant.delete', $item->id) }}"
                                                   class="btn btn-danger  sweet-confirm"><i class="fa fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between">
                        <h4>Hiển thị</h4>
                    </div>
                    <div class="form-group mb-3 d-flex ">
                        <div class="checkbox mr-4">
                            <input {{ $product->product_type == 'is_new' ? 'checked' : '' }} name="product_type"  value="is_new" id="checkbox2" type="checkbox">
                            <label for="checkbox2">Sản phẩm mới</label>
                        </div>
                        <div class="checkbox">
                            <input  {{ $product->product_type == 'is_hot' ? 'checked' : '' }} name="product_type" value="is_hot" id="checkbox3" type="checkbox">
                            <label for="checkbox3">Sản phẩm hot</label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="formGroupExampleInput">Lượt xem</label>
                        <input type="text" name="view" class="form-control mb-3"
                               placeholder="Số lượt xem" value="{{ old('view', $product->view ?? 0) }}">
                        @error('view')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Trạng thái</label>
                        <select name="status" id="" class="form-control mb-3">
                            <option value="">--- Chọn ---</option>
                            <option {{ old('status', $product->status) == 'draft' ? 'selected' : '' }} value="draft">
                                Draft
                            </option>
                            <option
                                {{ old('status', $product->status) == 'pending' ? 'selected' : '' }} value="pending">
                                Pending
                            </option>
                            <option
                                {{ old('status', $product->status) == 'publish' ? 'selected' : '' }} value="publish">
                                Publish
                            </option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Cập nhật</button>
                        <button class="btn btn-dark">Nhập lại</button>
                        <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">Danh sách</a>
                    </div>
                </div>
            </div>
        </form>
    </div>

@endsection

@section('script')

    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
    <script src="https://code.jquery.com/ui/1.14.0/jquery-ui.js"></script>

    <script>
        var sizes = @json($sizes);
        var colors = @json($colors);

        $(document).ready(function () {

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('#summernote').summernote({
                placeholder: 'Nội dung',
                height: 200
            });

            $("#sortable").sortable({
                update: function () {
                    var gallery_id = new Array();

                    $('.sortable_image').each(function () {
                        var id = $(this).attr('id');
                        gallery_id.push(id);
                    })

                    $.ajax({
                        type: "POST",
                        url: "{{ route('admin.products.gallery.sort') }}",
                        data: {
                            'gallery_id': gallery_id,
                        },
                        success: function (response) {
                            if (response.status == 'success') {
                                toastr.success(response.message);
                            }else {
                                toastr.error('Có lỗi xảy ra, vui lòng thử lại');
                            }
                        },

                    });
                }
            });
        });

        $(document).ready(function () {
            let generateId = function () {
                return 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            }

            $('.add-gallery').on('click', function () {
                let id = generateId();

                $('.gallery-wrapper').append(`
                    <div id="${id}" class="form-group mb-3 mt-3">
                        <label for="name">Hình ảnh</label>
                      <div class="d-flex align-content-center">
                            <input id="${id}" type="file" class="form-control me-2" name="product_gallery[]" multiple>
                                <button type="button" class="btn btn-danger remove-gallery ml-2">
                                    <i class="fa fa-trash"></i>
                                </button>
                        </div
                    </div>
                `)

            })

            $('.gallery-wrapper').on('click', '.remove-gallery', function () {
                $(this).closest('.form-group').remove()
            })

            $('.add-variant').on('click', function () {
                let id = generateId();

                $('.variant-wrapper').append(`
                    <tr id="${id}">
                      <th scope="row">
                         <select  id="size-select" class="form-control ">
                             <option value="">--- Chọn ---</option>
                               @foreach($sizes as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                </select>
             </th>
             <td>
               <select id="color-select" class="form-control">
                     <option value="">--- Chọn ---</option>
@foreach($colors as $id => $name)
                <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                </select>
              </td>
              <td>
                 <input  class="form-control" id="price-input" placeholder="Giá" type="number">
              </td>
              <td>
                 <input class="form-control" id="quantity-input" placeholder="Số lượng" type="number">
              </td>
              <td><button type="button" class="btn btn-danger remove-variant"><i class="fa fa-trash"></i></button></td>
            </tr>
`)
            })

            $('.variant-wrapper').on('change', '#size-select, #color-select', function () {
                var row = $(this).closest('tr');
                var sizeId = row.find('#size-select').val();
                var colorId = row.find('#color-select').val();
                var quantityInput = row.find('#quantity-input');
                var priceInput = row.find('#price-input');

                if (sizeId && colorId) {
                    quantityInput.attr('name', 'product_variants[' + sizeId + '-' + colorId + '][quantity]');
                    priceInput.attr('name', 'product_variants[' + sizeId + '-' + colorId + '][price]');
                } else {
                    quantityInput.removeAttr('name');
                    priceInput.removeAttr('name');
                }
            })

            $('.variant-wrapper').on('click', '.remove-variant', function () {
                $(this).closest('tr').remove()
            })


        })
    </script>
@endsection
