<?php

namespace Database\Seeders;

use App\Models\Unit;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
         $units = [
        ['name'=>'Bottle','short_name'=>'btl'],
        ['name'=>'Shot','short_name'=>'sht'],
        ['name'=>'Glass','short_name'=>'gls'],
        ['name'=>'Plate','short_name'=>'plt'],
        ['name'=>'ML','short_name'=>'ml'],
    ];

    foreach($units as $unit){
        Unit::create([
            'business_id'=>1,
            'name'=>$unit['name'],
            'short_name'=>$unit['short_name']
        ]);
    }
    }
}
