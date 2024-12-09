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
        'name' => 'Dell Inspiron 1525',
        'price' => random_int(10, 112),
        'description' => 'Dell desc',
        'imgSrc' => "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Dell_Inspiron_1525_250618.jpg/220px-Dell_Inspiron_1525_250618.jpg",
        'user_id' => 1, //Papkin
        'category_id' => 1, //Laptops
        "category" => "laptops",
        "units" => random_int(1, 6)
        ]);
        DB::table('products')->insert([
        'name' => 'Dell Inspiron 1526',
        'price' => random_int(10, 112),
        'description' => 'Dell desc',
        'imgSrc' => "https://upload.wikimedia.org/wikipedia/commons/thumb/b/b4/Dell_Inspiron_1525_250618.jpg/220px-Dell_Inspiron_1525_250618.jpg",
        'user_id' => 1, //Papkin
        'category_id' => 1, //Laptops
        "category" => "laptops",
        "units" => random_int(1, 6)
        ]);
        
        //Product::factory()->count(10)->create();
    }
}
