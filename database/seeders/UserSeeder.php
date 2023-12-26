<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory(20)->create();
        User::create([
            'name' => 'Akmal Aqil',
            'email' => 'akmalaqilwahyu@gmail.com',
            'password' => Hash::make('admin'),
            'email_verified_at' => now(),
            'roles' => 'mahasiswa',
        ]);
    }
}
