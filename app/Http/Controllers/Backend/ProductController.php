<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductGallery;
use App\Models\ProductVariant;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    const  PATH_UPLOAD_PRODUCT = 'products';
    const  PATH_UPLOAD_GALLERY = 'products/galleries';

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quản lý sản phẩm';
        $subtitle = 'Danh sách';
        $products = Product::query()->latest('id')->get();
        $trash = Product::query()->onlyTrashed()->get();
        return view('backend.product.index', compact([
            'title', 'subtitle', 'products', 'trash'
        ]));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Quản lý sản phẩm';
        $subtitle = 'Thêm mới';
        $categories = Category::query()->where('status', 1)
            ->where('parent_id', 0)
            ->latest('id')->get();
        $brands = Brand::query()->where('status', 1)->latest('id')->get();
        $colors = Color::query()->where('status', 1)->pluck('name', 'id')->all();
        $sizes = Size::query()->where('status', 1)->pluck('name', 'id')->all();

        return view('backend.product.create', compact([
            'title', 'subtitle', 'categories', 'brands', 'colors', 'sizes'
        ]));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
//        $this->validateRequest($request);

        list($dataProduct,
            $dataProductVariants,
            $dataProductGalleries) = $this->handleData($request);
        try {
            DB::beginTransaction();

            $product = Product::create($dataProduct);

            if (!empty($dataProductVariants)) {
                foreach ($dataProductVariants as $item) {
                    $item['product_id'] = $product->id;
                    ProductVariant::create($item);
                }
            }

            if (!empty($dataProductGalleries)) {
                foreach ($dataProductGalleries as $item) {
                    $item['product_id'] = $product->id;
                    ProductGallery::create($item);
                }
            }

            DB::commit();

            Log::info('Product created successfully', [
                'request_data' => $request->all(),
            ]);

            return redirect()->route('admin.products.index')->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error('Error Product', [
                'error_exception' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);

            if (
                !empty($dataProduct['thumb_image'])
                && Storage::exists($dataProduct['thumb_image'])
            ) {
                Storage::delete($dataProduct['thumb_image']);
            }

            if (!empty($dataProductGalleries)) {
                foreach ($dataProductGalleries as $gallery) {
                    if (Storage::exists($gallery['image'])) {
                        Storage::delete($gallery['image']);
                    }
                }
            }

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui này thử lại');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::query()->findOrFail($id);
        $title = 'Quản lý sản phẩm';
        $subtitle = 'Cập nhật sản phẩm: ' . $product->name;
        $categories = Category::query()
            ->where('parent_id', 0)
            ->latest('id')->get();
        $brands = Brand::query()->where('status', 1)->latest('id')->get();
        $colors = Color::query()->where('status', 1)->pluck('name', 'id')->all();
        $sizes = Size::query()->where('status', 1)->pluck('name', 'id')->all();

        return view('backend.product.edit', compact([
            'title', 'subtitle', 'categories', 'brands', 'colors', 'sizes', 'product'
        ]));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::query()->findOrFail($id);

        list($dataProduct,
            $dataProductVariants,
            $dataProductGalleries) = $this->handleData($request);

        try {
            DB::beginTransaction();

            if (!empty($dataProduct['thumbnail_image'])) {
                if ($product->thumbnail_image && Storage::exists($product->thumbnail_image)) {
                    Storage::delete($product->thumbnail_image);
                }
            } else {
                $dataProduct['thumbnail_image'] = $product->thumbnail_image;
            }

            $product->update($dataProduct);

            if (!empty($dataProductVariants)) {
                ProductVariant::query()->where('product_id', $product->id)->delete();
                foreach ($dataProductVariants as $item) {
                    $item['product_id'] = $product->id;
                    ProductVariant::create($item);
                }
            }

            if (!empty($dataProductGalleries)) {
                foreach ($dataProductGalleries as $item) {
                    $item['product_id'] = $product->id;
                    ProductGallery::create($item);
                }
            }

            DB::commit();

            Log::info('Product updated successfully', [
                'request_data' => $request->all(),
            ]);

            return redirect()->back()->with('success', 'Cập nhật dữ liệu thành công');
        } catch (\Exception $e) {
            DB::rollBack();

            if (!empty($dataProduct['thumbnail_image']) && Storage::exists($dataProduct['thumbnail_image'])) {
                Storage::delete($dataProduct['thumbnail_image']);
            }

            if (!empty($dataProductGalleries)) {
                foreach ($dataProductGalleries as $gallery) {
                    if (!empty($gallery['image']) && Storage::exists($gallery['image'])) {
                        Storage::delete($gallery['image']);
                    }
                }
            }

            Log::error('Error Product', [
                'error_exception' => $e->getMessage(),
                'request_data' => $request->all(),
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui này thử lại');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::query()->findOrFail($id);
        try {
            DB::transaction(function () use ($product) {
                $product->status = 'draft';
                $product->save();
                $product->delete();
            });

            Log::info('Product deleted successfully', [
                'product_id' => $product->id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Xoá dữ liệu thành công'
            ]);
        } catch (\Exception $e) {

            Log::error('Error Product', [
                'error_exception' => $e->getMessage(),
                'product_id' => $product->id,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra, vui lòng thử lại'
            ]);
        }
    }

    public function trash()
    {
        $title = 'Quản lý sản phẩm';
        $subtitle = 'Thùng rác';

        $products = Product::query()->onlyTrashed()->latest('id')->get();

        return view('backend.product.trash', compact([
            'title', 'subtitle', 'products'
        ]));
    }

    public function restore($id)
    {
        try {
            $product = Product::query()->withTrashed()->findOrFail($id);

            if ($product->trashed()) {
                $product->status = 'pending';
                $product->save();
                $product->restore();

                Log::info('Product restored successfully', [
                    'product_id' => $product->id,
                ]);

                return redirect()->route('admin.products.index')
                    ->with('success', 'Khôi phục dữ liệu thành công');
            }
        } catch (\Exception $e) {

            Log::error('Error Product', [
                'error_exception' => $e->getMessage(),
                'product_id' => $product->id,
            ]);

            return redirect()->back()
                ->with('success', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function galleryDelete($id)
    {
        $gallery = ProductGallery::query()->findOrFail($id);

        try {
            if (Storage::exists($gallery->image)) {
                Storage::delete($gallery->image);
            }

            $gallery->delete();

            Log::info('Product gallery deleted successfully', [
                'product_id' => $gallery->id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Thao tác thành công'
            ]);

        } catch (\Exception $e) {

            Log::error('Error Product', [
                'error_exception' => $e->getMessage(),
                'product_id' => $gallery->id,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra, vui này thử lại'
            ]);
        }
    }

    public function variantDelete($id)
    {

        $variant = ProductVariant::query()->findOrFail($id);

        try {


            $variant->delete();

            Log::info('Product variant deleted successfully', [
                'product_id' => $variant->id,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Thao tác thành công'
            ]);

        } catch (\Exception $e) {

            Log::error('Error Product', [
                'error_exception' => $e->getMessage(),
                'product_id' => $variant->id,
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra, vui này thử lại'
            ]);
        }
    }

    public function gallerySort(Request $request)
    {
        try {
            if ($request->gallery_id) {
                $i = 1;
                foreach ($request->gallery_id as $id) {
                    $gallery = ProductGallery::query()->findOrFail($id);
                    $gallery->order_by = $i;
                    $gallery->save();
                    $i++;
                }

                Log::info('Product gallery sort successfully');

                return response()->json([
                    'status' => 'success',
                    'message' => 'Thao tác thành công'
                ]);
            }
        } catch (\Exception $e) {
            Log::error('Error Product Gallery Sort', [
                'error_exception' => $e->getMessage(),
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra, vui này thử lại'
            ]);
        }
    }

    public function handleData(Request $request)
    {
        $dataProduct = $request->except('product_variants', 'product_gallery');
        $dataProduct['slug'] = !empty($dataProduct['name']) ? Str::slug($dataProduct['name'], '-') : $dataProduct['slug'];

        if (!empty($dataProduct['thumbnail_image'])) {
            $dataProduct['thumbnail_image'] = Storage::put(self::PATH_UPLOAD_PRODUCT, $dataProduct['thumbnail_image']);
        }

        $dataProductVariantsTmp = $request->product_variants;
        $dataProductVariants = [];

        if (!empty($dataProductVariantsTmp)) {
            foreach ($dataProductVariantsTmp as $key => $value) {
                $tmp = explode('-', $key);
                $sizeId = $tmp[0];
                $colorId = $tmp[1];
                $existingVariant = ProductVariant::query()
                    ->where('size_id', $sizeId)
                    ->where('color_id', $colorId)
                    ->where('product_id', $request->id)
                    ->first();

                if ($existingVariant) {
                    $existingVariant->update([
                        'price' => $value['price'],
                        'quantity' => $value['quantity']
                    ]);
                } else {
                    $dataProductVariants[] = [
                        'size_id' => $sizeId,
                        'color_id' => $colorId,
                        'price' => $value['price'],
                        'quantity' => $value['quantity']
                    ];
                }
            }
        }

        $dataProductGalleriesTmp = $request->product_gallery;
        $dataProductGalleries = [];

        if (!empty($dataProductGalleriesTmp)) {
            foreach ($dataProductGalleriesTmp as $item) {
                $dataProductGalleries[] = [
                    'image' => Storage::put(self::PATH_UPLOAD_GALLERY, $item),
                ];
            }
        }

        return [
            $dataProduct,
            $dataProductVariants,
            $dataProductGalleries
        ];
    }

    protected function validateRequest(Request $request, $id = null)
    {
        $rules = [
            'name' => 'required|string|max:255|unique:products,name,' . $id,
            'sku' => 'required|string|max:255|unique:products,sku,' . $id,
            'catalogue_id' => 'required|in:' . implode(',', Category::pluck('id')->toArray()),
            'brand_id' => 'required|in:' . implode(',', Brand::pluck('id')->toArray()),
            'price_regular' => 'required|numeric',
            'price_sale' => 'nullable|numeric',
            'thumbnail_image' => 'image|mimes:jpeg,png,jpg,webp|max:2048',
            'description' => 'required|string',
            'content' => 'nullable|string',
            'status' => 'required|string|max:255',
        ];

        $request->validate($rules);
    }

}
