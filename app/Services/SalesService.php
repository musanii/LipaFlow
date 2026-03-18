<?php

namespace App\Services;

use App\Models\InventoryTransaction;
use App\Models\Product;
use App\Models\Sale;
use App\Models\SaleItem;
use Exception;
use Illuminate\Support\Facades\DB;
use App\Services\InventoryService;

class SalesService
{

protected $inventoryService;
public function __construct(InventoryService $inventoryService){
    $this->inventoryService = $inventoryService;

}
    public function createSale($user, $data)
    {
        DB::beginTransaction();

        try {
            $sale = Sale::create([
                'business_id'=>$user->business_id,
                'user_id'=>$user->id,
                'table_number'=>$data['table_number'] ?? null,
                'total_amount'=>$data['total'],
                'payment_method'=>$data['payment_method']
            ]);

            foreach($data['items'] as $item){
                $product = Product::findOrFail($item['product_id']);
                $total = $item['quantity'] * $item['price'];
                $saleItem = SaleItem::create([
                    'sale_id' =>$sale->id,
                    'product_id'=>$product->id,
                    'quantity'=>$item['quantity'],
                    'price'=>$item['price'],
                    'total'=>$total
                ]);

                $this->inventoryService->deductStock(
                    $product->id,
                    $item['quantity'],
                    $user,
                    $sale->id

                );

                // InventoryTransaction::create([
                //     'business_id'=>$user->business_id,
                //     'product_id'=>$product->id,
                //     'type'=>'sale',
                //     'quantity'=> -$item['quantity'],
                //     'reference_type'=>'sale',
                //     'reference_id'=>$sale->id,
                //     'created_by'=>$user->id

                // ]);
            }
            DB::commit();

            return $sale;
        } catch (Exception $e) {
           DB::rollBack();
           throw $e;
        }
    }
}
