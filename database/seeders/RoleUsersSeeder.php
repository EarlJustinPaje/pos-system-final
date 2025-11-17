<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;

class RoleUsersSeeder extends Seeder
{
    public function run(): void
    {
        // Create a tenant first
        $tenant = Tenant::create([
            'name' => 'Demo Store',
            'slug' => 'demo-store',
            'business_name' => 'Demo Retail Business',
            'email' => 'demo@store.com',
            'is_active' => true,
        ]);

        // Create main branch
        $mainBranch = Branch::create([
            'tenant_id' => $tenant->id,
            'name' => 'Main Branch',
            'code' => 'DEMO-MAIN',
            'address' => '123 Main Street',
            'is_active' => true,
            'is_main_branch' => true,
        ]);

        // Create second branch for testing
        $branch2 = Branch::create([
            'tenant_id' => $tenant->id,
            'name' => 'Branch 2',
            'code' => 'DEMO-BR2',
            'address' => '456 Second Street',
            'is_active' => true,
            'is_main_branch' => false,
        ]);

        // Create Admin
        User::create([
            'tenant_id' => $tenant->id,
            'branch_id' => $mainBranch->id,
            'name' => 'Admin User',
            'username' => 'admin',
            'email' => 'admin@demo.com',
            'password' => Hash::make('admin123'),
            'role' => 'admin',
            'is_active' => true,
            'is_admin' => true,
        ]);

        // Create Manager for Main Branch
        User::create([
            'tenant_id' => $tenant->id,
            'branch_id' => $mainBranch->id,
            'name' => 'Manager User',
            'username' => 'manager',
            'email' => 'manager@demo.com',
            'password' => Hash::make('manager123'),
            'role' => 'manager',
            'is_active' => true,
            'is_admin' => false,
        ]);

        // Create Cashier for Main Branch
        User::create([
            'tenant_id' => $tenant->id,
            'branch_id' => $mainBranch->id,
            'name' => 'Cashier User',
            'username' => 'cashier',
            'email' => 'cashier@demo.com',
            'password' => Hash::make('cashier123'),
            'role' => 'cashier',
            'is_active' => true,
            'is_admin' => false,
        ]);

        // Create Manager for Branch 2
        User::create([
            'tenant_id' => $tenant->id,
            'branch_id' => $branch2->id,
            'name' => 'Manager Branch 2',
            'username' => 'manager2',
            'email' => 'manager2@demo.com',
            'password' => Hash::make('manager123'),
            'role' => 'manager',
            'is_active' => true,
            'is_admin' => false,
        ]);

        // Create Cashier for Branch 2
        User::create([
            'tenant_id' => $tenant->id,
            'branch_id' => $branch2->id,
            'name' => 'Cashier Branch 2',
            'username' => 'cashier2',
            'email' => 'cashier2@demo.com',
            'password' => Hash::make('cashier123'),
            'role' => 'cashier',
            'is_active' => true,
            'is_admin' => false,
        ]);

        $this->command->info('✅ Demo users created!');
        $this->command->info('');
        $this->command->info('📋 LOGIN CREDENTIALS:');
        $this->command->info('');
        $this->command->info('🔴 SUPER ADMIN:');
        $this->command->info('   Username: superadmin | Password: superadmin123');
        $this->command->info('');
        $this->command->info('🟠 ADMIN:');
        $this->command->info('   Username: admin | Password: admin123');
        $this->command->info('');
        $this->command->info('🟡 MANAGER (Main Branch):');
        $this->command->info('   Username: manager | Password: manager123');
        $this->command->info('');
        $this->command->info('🟢 CASHIER (Main Branch):');
        $this->command->info('   Username: cashier | Password: cashier123');
        $this->command->info('');
        $this->command->info('🔵 MANAGER (Branch 2):');
        $this->command->info('   Username: manager2 | Password: manager123');
        $this->command->info('');
        $this->command->info('🟣 CASHIER (Branch 2):');
        $this->command->info('   Username: cashier2 | Password: cashier123');
    }
}
