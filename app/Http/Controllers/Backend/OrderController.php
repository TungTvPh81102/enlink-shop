<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Addresse;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Province;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function index()
    {
        $title = 'Quản lý đơn hàng';
        $subtitle = 'Danh sách đơn hàng';

        $orders = Order::query()->latest('id')->get();

        return view('backend.order.index', compact([
            'title', 'subtitle', 'orders'
        ]));
    }

    public function edit(string $id)
    {
        $order = Order::query()
            ->with('address', 'order_details')
            ->findOrFail($id);

        $title = 'Quản lý đơn hàng';
        $subtitle = 'Chi tiết đơn hàng: #' . $order->id;

        $products = Product::query()
            ->with('variants')
            ->where('status','publish')
            ->latest('id')
            ->get();

        $provinces = Province::query()->latest('id')->get();
        $districts = District::query()->latest('id')->get();
        $wards = Ward::query()->latest('id')->get();

        return view('backend.order.edit', compact([
            'title',
            'subtitle',
            'order',
            'provinces',
            'districts',
            'wards',
            'products'
        ]));
    }

    public function update(Request $request, string $id)
    {

        $order = Order::query()->findOrFail($id);

        $this->validationRequest($request, $order->is_ship_user_same_user);
        try {
            DB::beginTransaction();

            $dataOrder = $request->except('quantity', 'province_id', 'district_id', 'ward_id', 'street_address');

            $dataAddress = $request->only([
                'province_id',
                'district_id',
                'ward_id',
                'street_address',
            ]);

            $order->update($dataOrder);

            $order->address()->update($dataAddress);

            if (!empty($request->quantity)) {
                foreach ($request->quantity as $key => $value) {
                    $orderDetail = OrderDetail::query()->where([
                        'order_id' => $order->id,
                        'product_variant_id' => $key
                    ])->first();

                    if ($orderDetail) {
                        $oldQuantity = $orderDetail->quantity;
                        $newQuantity = $value['qty'];
                        $orderDetail->update([
                            'quantity' => $newQuantity
                        ]);

                        $priceDifference = $orderDetail->product_price_regular * ($newQuantity - $oldQuantity);
                        $order->total_price += $priceDifference;
                        $order->save();
                    }
                }
            }

            DB::commit();

            return redirect()->back()->with('success', 'Cập nhật đơn hàng thành công');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception_message' => $e->getMessage(),
                'request_data' => $request->all()
            ]);

            return redirect()->back()->with('error', 'Có lỗi xảy ra, vui lòng thử laijF');
        }
    }

    public function orderItemDelete(string $id)
    {
        try {
            DB::beginTransaction();

            $orderDetail = OrderDetail::query()->findOrFail($id);

            $order = Order::query()->findOrFail($orderDetail->order_id);

            $countOrderDetail = OrderDetail::query()->where([
                'order_id' => $order->id,
            ])->count();

            if ($countOrderDetail > 1) {
                $order->total_price = $order->total_price - $orderDetail->product_price_regular;
                $order->save();

                $orderDetail->delete();
            } else {
                return response()->json([
                    'status' => 'error',
                    'message' => 'Đơn hàng phải có tối thiểu 1 sản phẩm'
                ], 500);
            }

            DB::commit();

            return response()->json([
                'status' => 'success',
                'message' => 'Xoá sản phẩm thành công'
            ], 200);
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception_message' => $e->getMessage(),
                'request_data' => request()->all()
            ]);

            return response()->json([
                'status' => 'error',
                'message' => 'Có lỗi xảy ra, vui lòng thử lại'
            ], 500);
        }

    }

    protected function validationRequest($request, $isSameUser)
    {
        if ($isSameUser == 1) {
            $rules = [
                'user_name' => 'required|min:3|max:50',
                'user_email' => 'required|email',
                'user_phone' => 'required|numeric|digits_between:10,11',
                'province_id' => 'required',
                'district_id' => 'required',
                'ward_id' => 'required',
                'payment_method' => 'required|in:cod,online',
                'status_delivery' => 'required|in:1,2,3,4,0',
                'payment_status' => 'required|in:1,0',
            ];
        } else {
            $rules = [
                'user_name' => 'required|min:3|max:50',
                'user_email' => 'required|email',
                'user_phone' => 'required|numeric|digits_between:10,11',
                'province_id' => 'required',
                'district_id' => 'required',
                'ward_id' => 'required',
                'ship_user_name' => 'required|min:3|max:50',
                'ship_user_email' => 'required|email',
                'ship_user_phone' => 'required|numeric|digits_between:10,11',
                'payment_method' => 'required|in:cod,online',
                'status_delivery' => 'required|in:1,2,3,4,0',
                'payment_status' => 'required|in:1,0',
            ];
        }

        $request->validate($rules);
    }
}
