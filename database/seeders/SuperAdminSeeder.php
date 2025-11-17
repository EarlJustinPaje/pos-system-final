<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class SuperAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Super Administrator',
            'username' => 'superadmin',
            'email' => 'superadmin@pos.com',
            'password' => Hash::make('superadmin123'),
            'role' => 'super_admin',
            'is_active' => true,
            'is_admin' => true,
        ]);

        $this->command->info('✅ Super Admin created!');
        $this->command->info('Username: superadmin');
        $this->command->info('Password: superadmin123');
    }
}
