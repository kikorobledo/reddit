<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        User::factory([
                'is_admin' => true,
                'email' => 'correo@correo.com',
                'password' => bcrypt('12345678'),
                'email_verified_at' => now()
            ])->create();

        User::factory()->times(100)->create();
    }
}
