<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
protected $fillable = [
    'business_id',
    'category_id',
    'name',
    'sku',
    'barcode',
    'price',
    'cost',
    'track_inventory',
    'is_recipe'

];

public function images()
{
    return $this->hasMany(ProductImage::class);
}
}
