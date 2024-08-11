<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin Sipatura',
            'email' => 'admin@sipatura.id',
            'role' => 'admin',
            'email_verified_at' => now(),
            'unhashed_password' => 'password',
            'password' => Hash::make('password'),
        ]);

        User::factory()->create([
            'name' => 'Kepala Kantor',
            'email' => 'kepkan@sipatura.id',
            'role' => 'user',
            'email_verified_at' => now(),
            'unhashed_password' => 'password',
            'password' => Hash::make('password'),
        ]);

        // User::factory(10)->create();
    }
}
