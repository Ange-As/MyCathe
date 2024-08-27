<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        $admin = [
            'name' => 'Administrateur',
            'email' => 'admin@example.com',
            'password' => bcrypt('admin123')
        ];

        $admin = User::create($admin);
    }
}
