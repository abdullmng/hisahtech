<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Admin::create([
            'name' => 'Muhammad Abdullahi',
            'email' => 'inoniceagain@gmail.com',
            'role' => 'super_admin',
            'password' => Hash::make('12345'),
        ]);
    }
}
