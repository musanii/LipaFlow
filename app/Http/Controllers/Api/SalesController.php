<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\SalesService;
use Illuminate\Http\Request;

class SalesController extends Controller
{
    protected $salesService;

    public function __construct(SalesService $salesService){
        $this->salesService = $salesService;

    }

    public function store(Request $request)
    {
        $request->validate([
            'items' => 'required|array',
            'items.*.product_id'=>'required',
            'items.*.quantity'=>'required',
            'items.*.price'=>'required',
            'total'=>'required'
        ]);

        $sale = $this->salesService->createSale(auth()->user(), $request->all());

        return response()->json([
            'status'=>true,
            'sale'=>$sale
        ]);
    }
}
