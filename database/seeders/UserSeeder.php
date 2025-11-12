<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
                'name'                  => "Admin",
                'email'                 => "admin@gmail.com",
                'is_admin'              => "1",
                'country_code'          => "+91",
                'phone_no'              => "9730166338",
                'is_verified'           => "1",
                'password'              => Hash::make('admin'),

        ]);
    }
}
