<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $guardName = 'web';
        $data = [
            [
                'name' => 'superadmin',
                'guard_name' => $guardName, 
            ],
            [
                'name' => 'admin',
                'guard_name' => $guardName, 
            ],
            [
                'name' => 'rektor',
                'guard_name' => $guardName, 
            ],
            [
                'name' => 'dekan',
                'guard_name' => $guardName, 
            ],
        ];
        foreach($data as $data){
            Role::create($data);
        }
    }
}
