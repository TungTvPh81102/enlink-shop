<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
//        $request->validate([
//            'product_id' => 'required|exists:products,id,' . $request->product_id,
//            'qty' => 'required|numeric|min:1'
//        ]);
        $product = Product::query()->findOrFail($request->product_id);

        $productVariant = ProductVariant::with(['color', 'size'])
            ->where([
                'product_id' => $request->product_id,
                'size_id' => $request->size_id,
                'color_id' => $request->color_id,
            ])
            ->firstOrFail();

        try {
            DB::beginTransaction();

            if (!isset(session('cart')[$productVariant->id])) {
                $data = $product->toArray()
                    + $productVariant->toArray()
                    + ['qty' => $request->qty];
                session()->put('cart.' . $productVariant->id, $data);
            } else {
                $data = session('cart')[$productVariant->id];
                $data['qty'] += $request->qty;
                session()->put('cart.' . $productVariant->id, $data);
            }

            DB::commit();
            return redirect()->route('cart.view')->with('success', 'Thêm vào giỏ hàng thành công');
        } catch (\Exception $e) {
            DB::rollBack();

            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e,
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    public function viewCart()
    {
        $title = 'Giỏ hàng';
//dd(session('cart'));
        return view('cart.view-list', compact([
            'title',
        ]));
    }
}


//            $cart = $request->user()->carts()->where('product_variant_id', $request->product_variant_id)->first();
//
//            if (!$cart) {
//                $cart = $request->user()->carts()->create([
//                    'product_variant_id' => $request->product_variant_id,
//                    'quantity' => $request->quantity
//                ]);
//            } else {
//                $cart->quantity += $request->quantity;
//                $cart->save();
//            }
