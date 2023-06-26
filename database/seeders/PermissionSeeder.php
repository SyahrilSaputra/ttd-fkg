<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guardName = 'web';
        $data = [
            [
                'name' => 'sign document',
                'guard_name' => $guardName,
            ],
            [
                'name' => 'upload document',
                'guard_name' => $guardName,
            ],
            [
                'name' => 'create user',
                'guard_name' => $guardName,
            ],
            [
                'name' => 'show user',
                'guard_name' => $guardName,
            ],
            [
                'name' => 'update user',
                'guard_name' => $guardName,
            ],
            [
                'name' => 'delete user',
                'guard_name' => $guardName,
            ],
            [
                'name' => 'create role',
                'guard_name' => $guardName,
            ],
            [
                'name' => 'show role',
                'guard_name' => $guardName,
            ],
            [
                'name' => 'update role',
                'guard_name' => $guardName,
            ],
            [
                'name' => 'delete role',
                'guard_name' => $guardName,
            ],

        ];

        foreach($data as $data){
            Permission::create($data);
        }

        $superadmin = Role::where('name', 'superadmin')->first();
        $superadmin->syncPermissions([2,3,4,5,6,7,8,9,10]);
    }
}
