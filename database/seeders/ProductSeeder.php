<?php

namespace Database\Seeders;

use App\Models\Product;
use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder {
    public function run(): void {
        DB::table('products')->insert([
        'name' => Str::random(10),
        'price' => random_int(10, 112),
        'imgSrc' => "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Dell_Inspiron_1525_250618.jpg/220px-Dell_Inspiron_1525_250618.jpg"
        ]);
        DB::table('products')->insert([
        'name' => Str::random(10),
        'price' => random_int(10, 112),
        'imgSrc' => "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Dell_Inspiron_1525_250618.jpg/220px-Dell_Inspiron_1525_250618.jpg"
        ]);
        DB::table('products')->insert([
        'name' => Str::random(10),
        'price' => random_int(10, 112),
        'imgSrc' => "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Dell_Inspiron_1525_250618.jpg/220px-Dell_Inspiron_1525_250618.jpg"
        ]);
        
        //Product::factory()->count(10)->create();
    }
}
