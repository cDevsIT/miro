<?php

namespace Database\Seeders;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Meem',
            'email' => 'intrends.meem@gmail.com',
            'password' => bcrypt('Miro@2025'),
        ]);
    }
}


// php artisan db:seed --class=AdminSeedercv b 