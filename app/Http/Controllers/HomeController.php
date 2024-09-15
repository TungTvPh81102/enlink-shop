<?php

namespace App\Http\Controllers;

use App\Models\Banner;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductGallery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function index()
    {
        $title = 'Trang chủ';

        $categories = Category::query()
            ->where('status', 1)
            ->where('parent_id', 0)
            ->latest('id')->get();

        $productHot = Product::query()->where('status', 'publish')
            ->where('product_type', 'is_hot')
            ->latest('id')
            ->limit(6)->get();

        $banners = Banner::query()
            ->where([
                'type' => 'slider',
                'status' => 1,
            ])
            ->limit(3)
            ->latest('id')->get();

        $incentive = Banner::query()
            ->select('title', 'image','btn_title','link')
            ->where([
                'type' => 'incentive',
                'status' => 1,
            ])
            ->limit(2)->get();

        $galleries = DB::table('product_galleries')
            ->join('products', 'product_galleries.product_id', '=', 'products.id')
            ->where('products.status', 'publish')
            ->whereIn('product_galleries.id', function ($query) {
                $query->from('product_galleries')
                    ->select(DB::raw('MAX(id)'))
                    ->groupBy('product_id');
            })
            ->select('product_galleries.id', 'product_galleries.product_id', 'product_galleries.image', 'products.slug')
            ->limit(6)
            ->get();

        return view('home', compact([
            'title',
            'categories',
            'productHot',
            'banners',
            'incentive',
            'galleries',
        ]));
    }
}
