<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Addresse;
use App\Models\District;
use App\Models\Order;
use App\Models\OrderDetail;
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
        ]));
    }

    public function update(Request $request, string $id) {
        dd($request->all());
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
}
