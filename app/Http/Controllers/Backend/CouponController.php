<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CouponController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Quản lý mã giảm giá';
        $subtitle = 'Danh sách';
        $coupons = Coupon::query()->latest('id')->get();

        return view('backend.coupon.index',
            compact(
                [
                    'title', 'subtitle', 'coupons'
                ]
            ));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Quản lý mã giảm giá';
        $subtitle = 'Thêm mới';

        return view('backend.coupon.create',
            compact(
                [
                    'title', 'subtitle'
                ]
            ));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:3|max:255',
            'code' => 'required|min:3|max:255|unique:coupons',
            'value' => 'required|numeric',
            'type' => 'required|in:fixed,percent',
            'max_discount_percentage' => 'numeric|min:0',
            'min_order_total' => 'numeric|min:0',
            'max_uses' => 'required|numeric',
            'expire_date' => 'required',
            'status' => 'required|in:0,1',
        ]);

        try {
            Coupon::create($request->all());

            Log::info(__CLASS__ . '@' . __FUNCTION__, [
                'request_data' => $request->all()
            ]);

            return redirect()->route('admin.coupons.index')
                ->with('success', 'Thêm mới thành công');
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e,
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $coupon = Coupon::query()->findOrFail($id);

        $title = 'Quản lý mã giảm giá';
        $subtitle = 'Cập nhật mã giảm giá: ' . $coupon->name;

        return view('backend.coupon.edit',
            compact(
                [
                    'title', 'subtitle', 'coupon'
                ]
            ));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $coupon = Coupon::query()->findOrFail($id);

        $request->validate([
            'name' => 'required|min:3|max:255',
            'code' => 'required|min:3|max:255|unique:coupons,code,' . $coupon->id,
            'value' => 'required|numeric',
            'type' => 'required|in:fixed,percent',
            'max_discount_percentage' => 'numeric|min:0',
            'min_order_total' => 'numeric|min:0',
            'max_uses' => 'required|numeric',
            'expire_date' => 'required',
            'status' => 'required|in:0,1',
        ]);

        try {
            $coupon->update($request->all());

            Log::info(__CLASS__ . '@' . __FUNCTION__, [
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('success', 'Cập nhật thành công!');
        } catch (\Exception $e) {
            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e,
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử lại');
        }
    }

}
