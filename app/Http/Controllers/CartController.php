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

            $cart = session('cart', []);
            $key = $productVariant->id;

            if (isset($cart[$key])) {
                $cart[$key]['qty'] += $request->qty;
            } else {
                $cart[$key] = $product->toArray() + $productVariant->toArray() + ['qty' => $request->qty];
            }

            session(['cart' => $cart]);

            if (Auth::check()) {
                $userId = Auth::id();
                $dbCart = Cart::firstOrCreate(['user_id' => $userId]);

                foreach ($cart as $key => $item) {
                    CartDetail::updateOrCreate(
                        [
                            'cart_id' => $dbCart->id,
                            'product_variant_id' => $key
                        ],
                        ['quantity' => $item['qty']]
                    );
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
//        session()->forget('cart');
        $title = 'Giỏ hàng';

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
        $request->validate([
            'quantity' => 'required|min:1'
        ]);

        try {
            if (Auth::check()) {
                $userId = Auth::id();
                $cart = Cart::query()->where('user_id', $userId)->first();
                if (!empty($cart)) {
                    foreach ($request->quantity as $key => $item) {
                        $cartItem = CartDetail::query()
                            ->where('cart_id', $cart->id)
                            ->where('product_variant_id', $key)
                            ->first();
                        if ($cartItem) {
                            $cartItem->update(['quantity' => $item['qty']]);
                        }
                    }
                }
            } else {
                $carts = session()->get('cart', []);
                foreach ($carts as $key => $item) {
                    if (isset($request->quantity[$key])) {
                        $quantity = $request->quantity[$key]['qty'];
                        $carts[$key]['qty'] = $quantity;
                    } else {
                        unset($carts[$key]);
                    }
                }
                session()->put('cart', $carts);
            }

            return redirect()->back()->with('success', 'Cập nhật giỏ hàng thành công.');
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e,
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại.');
        }
    }

    public function deleteCart(string $id)
    {
        try {
            if (Auth::check()) {
                $userId = Auth::id();

                $cart = Cart::query()->where('user_id', $userId)->first();
                if (!empty($cart)) {
                    $cartItem = CartDetail::query()
                        ->where('product_variant_id', $id)
                        ->first();
                    if ($cartItem) {
                        $cartItem->delete();
                        $sessionCart = session()->get('cart', []);
                        if (isset($sessionCart[$cartItem->product_variant_id])) {
                            unset($sessionCart[$cartItem->product_variant_id]);
                            session()->put('cart', $sessionCart);
                        }

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


