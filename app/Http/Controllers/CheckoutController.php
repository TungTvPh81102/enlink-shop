<?php

namespace App\Http\Controllers;

use App\Models\Addresse;
use App\Models\Cart;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderCoupon;
use App\Models\OrderDetail;
use App\Models\ProductVariant;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
    // [GET]: Giao diện trang thanh toán
    public function showFormCheckout()
    {
        $title = 'Thanh toán';

        $provinces = Province::query()->get();

        if (Auth::check()) {
            $userId = Auth::user()->id;

            $cart = Cart::where('user_id', $userId)->first();

            if ($cart) {
                $cartDetails = $cart->cartDetails()->with('productVariant.product')->get();
            }

            return view('checkout.index', compact('title', 'provinces', 'cartDetails'));
        }

        return view('checkout.index', compact([
            'title',
            'provinces'
        ]));
    }

    // [POST]: Xử lý thành toán
    public function handleCheckout(Request $request)
    {
        $this->validateRequest($request);

        try {
            // User đã login vào hệ thống
            if (Auth::check()) {
                DB::beginTransaction();
                $user = User::query()->where('id', Auth::user()->id)->first();

                $cart = Cart::where('user_id', $user->id)->first();

                if ($cart) {
                    $cartDetails = $cart->cartDetails()->with('productVariant.product')->get();
                }

                $dataItem = [];
                $totalPrice = 0;
                foreach ($cartDetails as $cartDetail) {
                    $product = $cartDetail->productVariant->product;
                    $productVariant = $cartDetail->productVariant;

                    $discountPrice = $product->price_sale > 0 ?
                        $product->price_regular * (1 - ($product->price_sale / 100)) :
                        $product->price_regular;

                    $totalPrice += $discountPrice * $cartDetail->quantity;

                    $dataItem[] = [
                        'product_variant_id' => $productVariant->id,
                        'quantity' => $cartDetail->quantity,
                        'product_name' => $product->name,
                        'product_sku' => $product->sku,
                        'product_image_thumbnail' => $product->thumbnail_image,
                        'product_price_regular' => $discountPrice,
                        'product_price_sale' => $productVariant->price_sale,
                        'variant_size_name' => $cartDetail->productVariant->size->name,
                        'variant_color_name' => $cartDetail->productVariant->color->name,
                    ];
                }

                $coupon = session()->get('coupon');
                $discount = 0;

                if ($coupon) {
                    $discount = $coupon['reduce'];
                    $totalPrice -= $discount;
                }

                if ($request->is_ship_user_same_user == 1) {
                    $dataOrder = [
                        'user_id' => $user->id,
                        'user_name' => $user->name ?? $request->user_name,
                        'user_email' => $user->email ?? $request->user_email,
                        'user_phone' => $user->phone ?? $request->user_phone,
                        'payment_method' => $request->payment_method,
                        'payment_status' => 0,
                        'total_price' => $totalPrice,
                    ];
                } else {
                    $dataOrder = [
                        'user_id' => $user->id,
                        'user_name' => $user->name,
                        'user_email' => $user->email,
                        'user_phone' => $user->phone,
                        'ship_user_name' => $request->user_name,
                        'ship_user_email' => $request->user_email,
                        'ship_user_phone' => $request->user_phone,
                        'payment_method' => $request->payment_method,
                        'is_ship_user_same_user' => 0,
                        'payment_status' => 0,
                        'total_price' => $totalPrice,
                    ];
                }

                $orders = Order::create($dataOrder);

                Addresse::create([
                    'order_id' => $orders->id,
                    'province_id' => $request->province_id,
                    'district_id' => $request->district_id,
                    'ward_id' => $request->ward_id,
                    'street_address' => $request->street_address
                ]);

                foreach ($dataItem as $item) {
                    $item['order_id'] = $orders->id;
                    OrderDetail::create($item);
                }

                if ($coupon) {
                    OrderCoupon::create([
                        'order_id' => $orders->id,
                        'coupon_id' => $coupon['id'],
                        'reduce' => $discount,
                        'discount_percent' => $coupon['discount_percent'] ?? 0,
                        'applied_at' => date('Y-m-d H:i:s')
                    ]);
                    $checkCoupon = Coupon::checkCoupon($coupon['code']);
                    $checkCoupon->decrement('max_uses');
                }

                foreach ($cartDetails as $cartDetail) {
                    $cartDetail->delete();
                    $productVariant = ProductVariant::find($cartDetail->product_variant_id);
                    $productVariant->update([
                        'quantity' => $productVariant->quantity - $cartDetail->quantity
                    ]);
                }

                DB::commit();

                session()->forget('cart');
                session()->forget('coupon');
                return redirect()->route('home')->with('success', 'Đặt hàng thành công');

            } else {
                dd('Đăng nhập');
            }

        } catch (\Exception $e) {
            DB::rollBack();

            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e,
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'Đặt hàng không thành công, vui lòng thử lại sau');
        }
    }

    // Validation request
    public function validateRequest($request)
    {
        $request->validate([
            'user_name' => 'required|min:3|max:50',
            'user_email' => 'required|email',
            'user_phone' => 'required|numeric|digits_between:10,11',
            'province_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'payment_method' => 'required'
        ]);
    }
}
