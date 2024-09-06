<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Color;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showListProduct($slug, $slugSub = '')
    {
        $title = 'Cửa hàng';

        $categories = Category::query()->where('status', 1)
            ->where('parent_id', 0)
            ->get();

        $brands = Brand::query()->where('status', 1)
            ->get();

        if (!empty($slug) && !empty($slugSub)) {
            $parentCategory = Category::query()
                ->where('status', 1)
                ->where('slug', $slug)
                ->firstOrFail();

            $subCategory = Category::query()
                ->where('status', 1)
                ->where('slug', $slugSub)
                ->where('parent_id', $parentCategory->id)
                ->firstOrFail();

            $products = Product::query()
                ->with(['variants', 'category.parent'])
                ->where('category_id', $subCategory->id)
                ->where('status', 'publish')
                ->paginate(12);

            return view('product.shop', compact([
                'title',
                'parentCategory',
                'subCategory',
                'products',
                'categories',
                'brands'
            ]));
        } else if (!empty($slug)) {
            $category = Category::query()
                ->where('status', 1)
                ->where('slug', $slug)
                ->with(['parent', 'children'])
                ->firstOrFail();

            $categoryIds = $category->children->pluck('id')->push($category->id);

            $products = Product::query()
                ->with(['variants', 'category.parent'])
                ->whereIn('category_id', $categoryIds)
                ->where('status', 'publish')
                ->paginate(12);
            $color = Color::query()->get();

            $size = Size::query()->get();

            return view('product.shop', compact([
                'title',
                'category',
                'products',
                'color',
                'size',
                'categories',
                'brands'
            ]));
        } else {
            $products = Product::query()
                ->with(['variants', 'category.parent'])
                ->where('status', 'publish')
                ->paginate(12);

            return view('product.shop', compact([
                'title',
                'products',
                'categories',
                'brands'
            ]));
        }

    }

    public function showDetailProduct($slug)
    {
        $product = Product::query()
            ->with(['variants', 'galleries', 'category.parent', 'brand'])
            ->where('products.slug', $slug)->firstOrFail();
        $title = $product->name;

        $productRelated = Product::query()
            ->where('category_id', $product->category_id)
            ->where('status', 'publish')
            ->where('id', '!=', $product->id)
            ->limit(6)
            ->get();

        return view('product.detail', compact([
            'product', 'title', 'productRelated'
        ]));
    }

    public function filterProduct(Request $request)
    {
        $products = Product::query()
            ->with(['variants', 'brand', 'category.parent'])
            ->where('status', 'publish');

        if (!empty($request->sort_by)) {
            switch ($request->sort_by) {
                case 'is_hot':
                    $products = $products
                        ->where('product_type', 'is_hot')
                        ->orderBy('id', 'desc');
                    break;
                case 'date':
                    $products = $products->orderBy('created_at', 'desc');
                    break;
                case 'price':
                    $products = $products->orderBy('price_regular', 'asc');
                    break;
                case 'price-desc':
                    $products = $products->orderBy('price_regular', 'desc');
                    break;
                case 'price_sale':
                    $products = $products
                        ->where('price_sale', '!=', 0)
                        ->orderBy('id', 'desc');
                    break;
                default:
                    $products->latest('id');
                    break;
            }
        }

        if (!empty($request->color_id)) {
            $colorID = rtrim($request->color_id, ',');
            $colorArr = explode(',', $colorID);
            $products = $products->whereHas('variants', function ($query) use ($colorArr) {
                $query->whereIn('color_id', $colorArr);
            });
        }

        if (!empty($request->brand_id)) {
            $brandID = rtrim($request->brand_id, ',');
            $brandArr = explode(',', $brandID);
            $products = $products->whereIn('brand_id', $brandArr);
        }

        $products = $products
            ->latest('id')
            ->paginate(12);

        return response()->json([
            'status' => true,
            'total' => $products->total(),
            'data' => view('product._shop', compact('products'))->render()
        ], 200);
    }

}
