<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{

public function index()
{
    $products = Product::with('images')
    ->where('business_id', auth()->user()->business_id)
    ->get();

    return response()->json($products);


}
public function store(Request $request) {

$request->validate([
'name'=>'required',
'price'=>'required|numeric'
]);

$product = Product::create([
'business_id'=>auth()->user()->business_id,
'category_id'=>$request->category_id,
'name'=>$request->name,
'price'=>$request->price,
'cost'=>$request->cost

]);
return response()->json($product);

}

public function uploadImage(Request $request, $productId)
{
    $request->validate([
        'image'=>'required||image|max:2048'
    ]);

    $path = $request->file('image')->store('products','public');

    $image = ProductImage::create([
        'product_id'=>$productId,
        'path'=>$path
    ]);
    return response()->json($image);
}


}
