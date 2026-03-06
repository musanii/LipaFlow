<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InventoryTransaction extends Model
{
    protected $fillable = [
        'business_id',
        'product_id',
        'batch_id',
        'type',
        'quantity',
        'reference_id'
    ];
}
