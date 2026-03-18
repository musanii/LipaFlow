<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable =[
        'business_id',
        'user_id',
        'table_number',
        'total_amount',
        'payment_method',
        'status'
    ];

    public function items()
    {
        return $this->hasMany(SaleItem::class);
    }
}
