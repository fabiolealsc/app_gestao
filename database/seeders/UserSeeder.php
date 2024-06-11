<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Cria 1 usuário
        User::create([
            'name' => 'Fabio',
            'email' => 'fabio.leal@gmail.com',
            'password' => 'fabiolealsc',
        ]);
    }
}