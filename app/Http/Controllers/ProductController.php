<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showDetailProduct($slug)
    {
        $product = Product::query()
            ->with(['variants', 'galleries','category.parent','brand'])
            ->where('products.slug', $slug)->firstOrFail();
        $title = $product->name;

        return view('product.detail', compact('product', 'title'));
    }
}
