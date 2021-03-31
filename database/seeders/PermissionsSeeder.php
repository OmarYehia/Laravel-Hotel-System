<?php

namespace Database\Seeders;

use \App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class PermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Create permissions
       Permission::create(['name' => 'approve clients']); // for receptionists and above
       Permission::create(['name' => 'manage receptionists']); // for managers and above
       Permission::create(['name' => 'manage floors']); // for managers and above
       Permission::create(['name' => 'manage rooms']); // for managers and above
       Permission::create(['name' => 'manage managers']); // for admins

       // Create roles and assigning permissions
        $adminRole = Role::create(['name' => ' admin']);
        $adminRole->givePermissionTo('approve clients');
        $adminRole->givePermissionTo('manage receptionists');
        $adminRole->givePermissionTo('manage floors');
        $adminRole->givePermissionTo('manage rooms');
        $adminRole->givePermissionTo('manage managers');

        $managerRole = Role::create(['name' => 'manager']);
        $managerRole->givePermissionTo('approve clients');
        $managerRole->givePermissionTo('manage receptionists');
        $managerRole->givePermissionTo('manage floors');
        $managerRole->givePermissionTo('manage rooms');

        $receptionistRole = Role::create(['name' => 'receptionist']);
        $receptionistRole->givePermissionTo('approve clients');

        // Creating the main admin
        $user = User::factory()->create([
            'name' => 'Super Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456'),
            'role' => 'admin',
            'created_by' => 1,
        ]);
        $user->assignRole($adminRole);
    }
}
