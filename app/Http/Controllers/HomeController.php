<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Trang chủ';

        $categories = Category::query()
            ->where('status', 1)
            ->where('parent_id', 0)
            ->latest('id')->get();

        $productHot =  Product::query()->where('status', 'publish')
            ->where('product_type', 'is_hot')
            ->latest('id')
            ->limit(6)->get();

        return view('home', compact([
            'title',
            'categories',
            'productHot'
        ]));
    }
}
