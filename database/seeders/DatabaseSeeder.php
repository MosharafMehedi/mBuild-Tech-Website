<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // ---- Create Admin User ----
        User::updateOrCreate(
            ['email' => 'admin@mbuildtech.com'],
            [
                'name'     => 'Admin User',
                'email'    => 'admin@mbuildtech.com',
                'password' => Hash::make('Admin@12345'),
                'email_verified_at' => now(),
            ]
        );

        // ---- Seed Settings ----
        // $settings = [
        //     'site_name'    => 'mBuild Tech',
        //     'tagline'      => 'Engineering Trust, Building Legacies.',
        //     'phone'        => '+880 1711-123456',
        //     'email'        => 'info@mbuildtech.com',
        //     'address'      => 'House 12, Road 5, Dhanmondi, Dhaka-1205',
        //     'facebook'     => 'https://facebook.com/mbuildtech',
        //     'linkedin'     => 'https://linkedin.com/company/mbuildtech',
        // ];

        // foreach ($settings as $key => $value) {
        //     \App\Models\Setting::set($key, $value);
        // }

    }
}