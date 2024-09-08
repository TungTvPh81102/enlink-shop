<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CheckoutController extends Controller
{
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

    public function handleCheckout(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:50',
            'email' => 'required|email',
            'phone' => 'required|numeric|digits_between:10,11',
            'province_id' => 'required',
            'district_id' => 'required',
            'ward_id' => 'required',
            'payment-method' => 'required'
        ]);

        try {
            if (Auth::check()) {
                $userID = User::query()->where('id', Auth::user()->id)->first();

                $cart = Cart::where('user_id', $userID->id)->first();

            } else {
                dd('Đăng nhập');
            }

            return redirect()->back()->with('success', 'Đặt hàng thành công');
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e,
                'exception-code' => $e->getCode(),
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'Đặt hàng không thành công, vui lòng thử lại sau');
        }
    }
}
