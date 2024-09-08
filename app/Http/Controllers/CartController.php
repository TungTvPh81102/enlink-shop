<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|numeric|min:1'
        ]);

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

            if (Auth::check()) {
                $userId = Auth::user()->id;

                $cart = Cart::firstOrCreate([
                    'user_id' => $userId
                ]);

                $cartDetail = CartDetail::query()
                    ->where([
                        'cart_id' => $cart->id,
                        'product_variant_id' => $productVariant->id
                    ])->first();

                if ($cartDetail) {
                    $cartDetail->quantity += $request->qty;
                    $cartDetail->save();
                } else {
                    CartDetail::create([
                        'cart_id' => $cart->id,
                        'product_variant_id' => $productVariant->id,
                        'quantity' => $request->qty
                    ]);
                }
                session()->forget('cart');
            } else {
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
        $cartDetails = [];

        if (Auth::check()) {
            $userId = Auth::user()->id;

            $cart = Cart::where('user_id', $userId)->first();

            if ($cart) {
                $cartDetails = $cart->cartDetails()->with('productVariant.product')->get();
            }
            return view('cart.view-cart-auth', compact('title', 'cartDetails'));
        } else {
            $cartDetails = session()->get('cart', []);
            return view('cart.view-cart', compact('title', 'cartDetails'));
        }
    }

    public function updateCart(Request $request)
    {
        dd($request->all());
    }

    public function deleteCart(string $id)
    {
        try {
            if (Auth::check()) {
                $userId = Auth::id();

                $cart = Cart::query()->where('user_id', $userId)->first();
                if (!empty($cart)) {
                    $cartItem = CartDetail::query()->where('id', $id)->first();
                    if ($cartItem) {
                        $cartItem->delete();
                        return redirect()->back()->with('success', 'Xoá sản phẩm thành công');
                    } else {
                        return redirect()->back()->with('error', 'Sản phẩm không có trong giỏ hàng.');
                    }
                }

            } else {
                $cart = session()->get('cart', []);

                if (isset($cart[$id])) {
                    unset($cart[$id]);
                    session()->put('cart', $cart);
                    return redirect()->back()->with('success', 'Xoá sản phẩm thành công');
                }
            }

        } catch (\Exception $e) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e,
                'exception-code' => $e->getCode()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại sau');
        }
    }
}


