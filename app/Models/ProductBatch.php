<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBatch extends Model
{
    protected $fillable = [
        'product_id',
        'business_id',
        'quantity',
        'purchase_price',
        'expires_at'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
