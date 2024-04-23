<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class akun extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'name' => 'Rini Handayani(admin)',
                'email' => 'admin@gmail.com',
                'email_verified_at' => now(),
                'role_id' => 1,
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(10),

            ],
            [
                'name' => 'Dewi Sartika (kasir)',
                'email' => 'kasir@gmail.com',
                'email_verified_at' => now(),
                'role_id' => 2,
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => '01 (meja)',
                'email' => 'meja_01@gmail.com',
                'email_verified_at' => now(),
                'role_id' => 3,
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(10),
            ],
            [
                'name' => 'Gilang Gumilang (manajer)',
                'email' => 'manajer@gmail.com',
                'email_verified_at' => now(),
                'role_id' => 4,
                'password' => bcrypt('12345678'),
                'remember_token' => Str::random(10),
            ],
        ];

        // Memasukkan data ke dalam tabel 'users'
        DB::table('users')->insert($users);
    }
}
