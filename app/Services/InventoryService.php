<?php 

namespace App\Services;

use App\Models\InventoryTransaction;
use App\Models\ProductBatch;
use Exception;
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


    public function deductStock($productId,$quantity, $user, $referenceId)
    {
        $remainingQty = $quantity;


        $batches = ProductBatch::where('product_id', $productId)
        ->where('quantity','>', 0)
        ->orderBy('created_at', 'asc')
        ->lockForUpdate()
        ->get();

        foreach($batches as $batch)
            {
                if($remainingQty <= 0) break;

                $deductQty = min($batch->quantity, $remainingQty);

                $batch->quantity -= $deductQty;
                $batch->save();

                InventoryTransaction::create([
                'business_id'=>$user->business_id,
                'product_id'=>$productId,
                'type'=>'sale',
                'quantity'=>-$deductQty,
                'reference_type'=>'sale',
                'reference_id'=>$referenceId,
                'created_by'=>$user->id

            ]);
            $remainingQty -= $deductQty;

                
            }
            if($remainingQty > 0)
                {
                    throw new  Exception("Insufficient stock for Product ID {$productId}");
                }

    }
}
