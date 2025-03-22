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
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        //     'name' => 'assem aloui',
        //     'email' => 'assem@email.com',
        //     'password' => Hash::make('password'),
        // ]); 
        User::firstOrCreate(
            ['email' => 'assem@email.com'],
            [
                'name' => 'assem aloui',
                'password' => Hash::make('password'),
            ]
        );

    }
}
