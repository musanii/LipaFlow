<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductBatch extends Model
{
    protected $fillable = [
        'product_id',
        'business_id',
        'batch_code',
        'quantity',
        'purchase_price',
        'expiry_date'
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
