<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Cart;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void {
        DB::table('users')->insert([
            'name' => 'Papkin',
            'email' => 'abc@abc.com',
            'password' => Hash::make('12345678'),
        ]);
        Cart::create([
            'user_id' => 1,
            'product_ids' => []
        ]);

        foreach (glob(public_path('images\\*')) as $file) {
            $this->command->info("Deleting file: {$file}");
            unlink($file);
        }
    }
}
