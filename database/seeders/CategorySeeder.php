<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
        'Beer',
        'Whiskey',
        'Vodka',
        'Gin',
        'Cocktails',
        'Food',
        'Soft Drinks'
    ];

    foreach($categories as $cat){
        Category::create([
            'business_id'=>1,
            'name'=>$cat
        ]);
    }
    }
}
