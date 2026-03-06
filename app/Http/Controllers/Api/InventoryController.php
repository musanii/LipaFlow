<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\InventoryService;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    protected $inventory;
    public function __construct(InventoryService $inventory)
    {
        $this->inventory = $inventory;

    }

    public function addStock(Request $request)
    {
      
        $data = $request->validate([
            'product_id'=>'required',
            'quantity'=>'required|numeric',
            'purchase_price'=>'required|numeric'

        ]);

        $batch = $this->inventory->addStock(
            $data['product_id'],
            $data['quantity'],
            $data['purchase_price']

        );

        return response()->json($batch);
    }
}
