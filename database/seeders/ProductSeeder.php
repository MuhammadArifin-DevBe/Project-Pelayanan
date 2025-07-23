<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    product::create([
        'nama' => 'Paket Cuci Mobil',
        'harga' => 50000
    ]);

    product::create([
        'nama' => 'Paket Cuci Motor',
        'harga' => 20000
    ]);
}
}
