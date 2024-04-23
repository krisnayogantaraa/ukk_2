<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class menus extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        $menus = [
            [
                'nama' => 'Bala Bala',
                'jenis' => 'Makanan',
                'harga' => 5000,
                'foto' => 'bala_bala.jpg'
            ],
            [
                'nama' => 'Churros',
                'jenis' => 'Makanan',
                'harga' => 10000,
                'foto' => 'churros.jpg'
            ],
            [
                'nama' => 'Donut',
                'jenis' => 'Makanan',
                'harga' => 8000,
                'foto' => 'donut.jpeg'
            ],
            [
                'nama' => 'Tempe Mendoan',
                'jenis' => 'Makanan',
                'harga' => 6000,
                'foto' => 'mendoan.jpg'
            ],
        ];
        // Memasukkan data ke dalam tabel 'users'
        DB::table('menus')->insert($menus);
    }
}
