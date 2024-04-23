<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {

        Role::create([
            'role_name' => 'admin',
        ]);

        Role::create([
            'role_name' => 'kasir',
        ]);

        Role::create([
            'role_name' => 'meja',
        ]);

        Role::create([
            'role_name' => 'manajer',
        ]);
        

        $this->call(menus::class);
        $this->call(akun::class);

    }
}