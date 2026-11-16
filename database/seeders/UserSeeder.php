<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Création d'un utilisateur de test conforme à votre migration
        User::updateOrCreate(
            ['email' => 'admin@solidarite.com'],
            [
                'name' => 'sudo admin',
                'phone' => '+243999999999',
                'photo' => 'storage/users/avatar-male.png',
                'gender' => 'm',
                'type' => 'admin',
                'accred' => '1',
                'status' => 'on',
                'password' => Hash::make('password123'), 
            ]
        );
    }
}
