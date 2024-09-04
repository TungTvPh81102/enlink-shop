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
        <form action="{{ route('admin.products.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-body">
                    <h4>{{ $subtitle ?? '' }}</h4>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Tên sản phẩm</label>
                                <input type="text" name="name" class="form-control mb-3" id="formGroupExampleInput"
                                       placeholder="Tên sản phẩm" value="{{ old('name') }}">
                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput2">Mã sản phẩm</label>
                                <input type="text" name="sku" class="form-control mb-3" id="formGroupExampleInput2"
                                       placeholder="Mã sản phẩm" value="{{ old('sku') }}">
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
                                    @include('backend.category.nest', ['category' => $parent, 'each' => $each])
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
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
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
                                       placeholder="Giá bán thường" value="{{ old('price_regular') }}">
                                @error('price_regular')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Giảm giá</label>
                                <input type="text" name="price_sale" class="form-control mb-3"
                                       placeholder="Giá bán thường" value="{{ old('price_sale', 0) }}">
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
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Mô tả ngắn</label>
                        <textarea name="description" class="form-control mb-3">{{ old('description') }}</textarea>
                        @error('description')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Nội dung</label>
                        <textarea name="content" class="form-control mb-3" id="summernote">{{ old('content') }}</textarea>
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
                        <label for="name">Hình ảnh</label>
                        <input type="file" class="form-control " name="product_gallery[]" multiple>
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
                        <div class="btn btn-primary add-variant"> <i class="anticon anticon-plus"></i></div>
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

                                </tbody>
                            </table>
                        </div>
                    </div>
                    @error('product_gallery')
                    <div class="text-danger mt-2">{{ $message }}</div>
                    @enderror
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="form-group">
                        <label for="formGroupExampleInput2">Trạng thái</label>
                        <select name="status" id="" class="form-control mb-3">
                            <option value="">--- Chọn ---</option>
                            <option {{ old('status') == 'draft' ? 'selected' : '' }} value="draft">Draft</option>
                            <option {{ old('status') == 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                            <option {{ old('status') == 'publish' ? 'selected' : '' }} value="publish">Publish</option>
                        </select>
                        @error('status')
                        <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary">Tạo mới</button>
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

    <script >
        var  sizes = @json($sizes);
        var  colors = @json($colors);
        console.log(sizes);
        console.log(colors);

        $(document).ready(function() {
            $('#summernote').summernote({
                placeholder: 'Nội dung',
                height: 200
            });
        });

        $(document).ready(function () {
            let generateId = function() {
                return 'gen' + '_' + Math.random().toString(36).substring(2, 15).toLowerCase();
            }

            $('.add-gallery').on('click',function() {
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

            $('.gallery-wrapper').on('click','.remove-gallery',function() {
                $(this).closest('.form-group').remove()
            })

            $('.add-variant').on('click',function() {
                let id = generateId();

                $('.variant-wrapper').append(`
                    <tr id="${id}">
                      <th scope="row">
                         <select name="size_id" id="size-select" class="form-control ">
                             <option value="">--- Chọn ---</option>
                               @foreach($sizes as $id => $name)
                                    <option value="{{ $id }}">{{ $name }}</option>
                                @endforeach
                         </select>
                      </th>
                      <td>
                        <select name="color_id" id="color-select" class="form-control">
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

            $('.variant-wrapper').on('change', '#size-select, #color-select',function() {
                var row = $(this).closest('tr');
                var sizeId = row.find('#size-select').val();
                var colorId = row.find('#color-select').val();
                var quantityInput = row.find('#quantity-input');
                var priceInput = row.find('#price-input');

                if(sizeId && colorId) {
                    quantityInput.attr('name', 'product_variants[' + sizeId + '-' + colorId + '][quantity]');
                    priceInput.attr('name', 'product_variants[' + sizeId + '-' + colorId + '][price]');
                }else {
                    quantityInput.removeAttr('name');
                    priceInput.removeAttr('name');
                }
            })

            $('.variant-wrapper').on('click', '.remove-variant',function() {
                $(this).closest('tr').remove()
            })


        })
    </script>
@endsection
