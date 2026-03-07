<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
protected $fillable = [
    'business_id',
    'category_id',
    'unit_id',
    'name',
    'sku',
    'barcode',
    'price',
    'cost_price',
    'track_inventory',
    'low_stock_alert'

];

 public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }

    public function units()
    {
        return $this->hasMany(ProductUnit::class);
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class);
    }

    public function batches()
    {
        return $this->hasMany(ProductBatch::class);
    }

    public function transactions()
    {
        return $this->hasMany(InventoryTransaction::class);
    }
}
