<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\CartDetail;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    // [POST]: Xử lý thêm sản phẩm vào giỏ hàng
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

    // [GET]: Xem giỏ hàng
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

    // [PUT]: Cập nhật giỏ han
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
                    $sessionCarts = session()->get('cart', []);
                    foreach ($request->quantity as $key => $item) {
                        $cartItem = CartDetail::query()
                            ->where('cart_id', $cart->id)
                            ->where('product_variant_id', $key)
                            ->first();

                        if ($cartItem) {
                            $cartItem->update(['quantity' => $item['qty']]);
                            if (isset($sessionCarts[$key])) {
                                $sessionCarts[$key]['qty'] = $item['qty'];
                            }
                        }
                    }

                    session()->put('cart', $sessionCarts);
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

    // [DELETE]:  Xoá sản phẩm trong giỏ hàng
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

                        session()->forget('coupon');
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
                    session()->forget('coupon');
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

    // [DELETE]: Xoá toàn bộ giỏ hàng
    public function clearCart()
    {
        try {
            if (Auth::check()) {
                $userId = Auth::id();
                $cart = Cart::query()->where('user_id', $userId)->first();

                if (!empty($cart)) {
                    $cart->cartDetails()->delete();
                } else {
                    return response()->json([
                        'message' => 'Không tìm thấy giỏ hangfF'
                    ], 404);
                }
                session()->forget('cart');
                session()->forget('coupon');
            } else {
                session()->forget('coupon');
                session()->forget('cart');
            }

            return response()->json([
                'message' => 'Xoá giỏ hàng thành công!'
            ], 200);
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e,
                'exception-code' => $e->getCode()
            ]);

            return response()->json([
                'message' => 'Có lỗi xảy ra, vui lòng thử lại!'
            ], 500);
        }
    }

    // [POST]: Apply mã giảm giá
    public function applyCoupon(Request $request)
    {
        try {
            $couponCode = $request->coupon_code;

            if ($couponCode) {
                $existingCoupon = session()->get('coupon');

                if ($existingCoupon) {
                    return redirect()->back()->with('warning', 'Mã đang được sử dụng.');
                }

                $coupon = Coupon::checkCoupon($couponCode);
                $cart = session()->get('cart', []);
                $total = 0;

                if (!empty($cart)) {
                    foreach ($cart as $item) {
                        $discountedPrice = $item['price_sale'] > 0
                            ? $item['price_regular'] * (1 - ($item['price_sale'] / 100))
                            : $item['price_regular'];

                        $subTotal = $discountedPrice * $item['qty'];
                        $total += $subTotal;
                    }
                }

                if (empty($coupon)) {
                    throw new \Exception('Mã không hợp lệ hoặc đã hết hạn, vui lòng thử lại');
                }

                if ($coupon->min_order_total > $total) {
                    $conditionAplly = $coupon->min_order_total - $total;
                    throw new \Exception('Cần thêm ' . number_format($conditionAplly) . 'đ để áp dụng mã giảm giá');
                }

                $reduce = 0;
                if ($coupon->type === Coupon::TYPE_PERCENT) {
                    $reduce = ($total * $coupon->value) / 100;
                    if (isset($coupon->max_discount_percentage) && $reduce > $coupon->max_discount_percentage) {
                        $reduce = $coupon->max_discount_percentage;
                    }

                } else if ($coupon->type === Coupon::TYPE_FIXED) {
                    $reduce = $coupon->value;
                }

                session()->put('coupon', [
                    'id' => $coupon->id,
                    'code' => $coupon->code,
                    'type' => $coupon->type,
                    'value' => $coupon->value,
                    'reduce' => $reduce,
                    'discount_percent' => $coupon->type === Coupon::TYPE_PERCENT ? $coupon->value : 0
                ]);

                return redirect()->back()->with('success', 'Áp dụng mã giảm giá thành công');
            }

        } catch (\Exception $e) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e,
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('warning', $e->getMessage());
        }
    }
}


