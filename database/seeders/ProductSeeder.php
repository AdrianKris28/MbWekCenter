<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product')->insert([
            'category' => 'Food & Beverages',
            'title' => 'Es Teh',
            'description' => 'Es Teh segar murni dari pegunungan',
            'price' => 10000,
            'stock' => 25,
            'image' => 'images/1642340669.jpg'
        ]);
        DB::table('product')->insert([
            'category' => 'Animal',
            'title' => 'Kucing',
            'description' => 'Kucing berkaki 4 dan punya ekor',
            'price' => 134000,
            'stock' => 15,
            'image' => 'images/1642340689.jpg'
        ]);
        DB::table('product')->insert([
            'category' => 'Furniture',
            'title' => 'Meja',
            'description' => 'Meja lipat dengan kualitas tinggi',
            'price' => 50000,
            'stock' => 124,
            'image' => 'images/1642340970.jpg'
        ]);
        DB::table('product')->insert([
            'category' => 'Animal',
            'title' => 'Anjing',
            'description' => 'Anjing yang setia dan penyabar',
            'price' => 200000,
            'stock' => 10,
            'image' => 'images/1642340700.jpeg'
        ]);
        DB::table('product')->insert([
            'category' => 'Food & Beverages',
            'title' => 'Burger',
            'description' => 'Burger dengan daging lezat',
            'price' => 24500,
            'stock' => 47,
            'image' => 'images/1642340711.jpg'
        ]);
        DB::table('product')->insert([
            'category' => 'Food & Beverages',
            'title' => 'Jus Mangga',
            'description' => 'Jus segar dengan rasa mangga',
            'price' => 12000,
            'stock' => 87,
            'image' => 'images/1642340737.jpg'
        ]);
        DB::table('product')->insert([
            'category' => 'Furniture',
            'title' => 'Pintu Rumah',
            'description' => 'Pintu rumah yang kokoh dan antik',
            'price' => 85000,
            'stock' => 24,
            'image' => 'images/1642340747.jpg'
        ]);
    }
}
