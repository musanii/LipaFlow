<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Business extends Model
{
    protected $fillable = [
        'name',
        'type',
        'phone',
        'email',
        'kra_pin',
        'etims_enabled'

    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
