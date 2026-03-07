<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\ProductBatch;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Log;

class ProductBatchController extends Controller
{
    public function store(Request $request, Product $product)
    {
        $request->validate([
            'purchase_price' =>'required|numeric|min:0',
            'quantity' => 'required|numeric|min:0.01',
            'expiry_date' => 'nullable|date',
            'batch_code' => 'nullable|string'
        ]);
        $user = auth()->user();

        DB::beginTransaction();

        try {
            $batch = ProductBatch::create([
                'product_id' => $product->id,
                'business_id' => $user->business_id,
                'batch_code' => $request->batch_code,
                'purchase_price' => $request->purchase_price,
                'quantity' => $request->quantity,
                'expiry_date' => $request->expiry_date
            ]);

            InventoryTransaction::create([
                'business_id' => $user->business_id,
                'product_id' => $product->id,
                'type' => 'purchase',
                'quantity' => $request->quantity,
                'reference_type' => 'batch',
                'reference_id' => $batch->id,
                'created_by' => $user->id
            ]);

            DB::commit();

            return response()->json([
                'status'=>true,
                'message'=>'Stock added successfully',
                'batch'=>$batch
            ]);

        } catch (Exception $e) {
            DB::rollBack();
            Log::error("Registration failed: " . $e->getMessage());

            return response()->json([
                'status'=>false,
                'message'=>$e->getMessage()
            ], 500);
        }
    }
}
