<?php 

namespace App\Services;

class InventoryService {
    public function addStock($productId, $qty, $userId)
    {
        InventoryTransaction::create([
            'business_id'=>auth()->user()->business_id,
            'product_id'=>$productId,
            'type'=>'purchase',
            'quantity'=>$qty,
            'created_by'=>$userId
        ]);
    }


    public function deductStock($productId,$qty,$userId)
    {
        InventoryTransaction::create([
            'business_id'=>auth()->user()->business_id,
            'product_id'=>$productId,
            'type'=>'sale',
            'quantity'=>$qty,
            'created_by'=>$userId
        ]);

    }
}