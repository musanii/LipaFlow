<?php 

namespace App\Services;

use App\Models\InventoryTransaction;
use App\Models\ProductBatch;
use Log;

class InventoryService {
   
public function addStock($productId, $quantity, $cost)
{

Logger($cost);
    return ProductBatch::create([
        'product_id' => $productId,
        'business_id' => auth()->user()->business_id,
        'quantity' => $quantity,
        'purchase_price' => $cost
    ]);

    }


    public function deductStock($productId,$quantity)
    {
        $batches = ProductBatch::where('product_id', $productId)
        ->where('quantity','>', 0)
        ->orderBy('created_at')
        ->get();

        foreach($batches as $batch)
            {
                if($quantity <= 0){
                    break;
                }
            }
            $deduct = min($batch->quantity,$quantity);
            $batch->decrement('quantity',$deduct);

            InventoryTransaction::create([
                'business_id'=>auth()->user()->business_id,
                'product_id'=>$productId,
                'batch_id'=>$batch->id,
                'type'=>'sale',
                'quantity'=>$deduct

            ]);
            $quantity -= $deduct;

    }
}
