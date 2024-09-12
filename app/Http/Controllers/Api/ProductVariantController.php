<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ProductVariantController extends Controller
{
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $product = Product::query()
                ->with('variants.size')
                ->where('id', $id)
                ->findOrFail($id);

            return response()->json([
                'status' => 'success',
                'data' => $product
            ], 200);

        } catch (\Exception $e) {

            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }

    public function colorShow(string $productId, string $sizeId) {
        try {
            $color = ProductVariant::query()->with('color')
                ->where('product_id', $productId)
                ->where('size_id', $sizeId)
                ->get();

            return response()->json([
                'status' => 'success',
                'data' => $color
            ], 200);

        } catch (\Exception $e) {

            Log::error(__CLASS__ . '@' . __FUNCTION__, [
                'exception-message' => $e->getMessage(),
            ]);

            return response()->json([
                'message' => $e->getMessage()
            ], 500);
        }
    }
}
