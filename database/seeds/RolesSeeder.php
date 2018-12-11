<?php

use Illuminate\Database\Seeder;
use App\Role;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create([
            'name'=>'Admin',
            'slug'=>'admin',
            'permissions'=>json_encode([
                'create-property'=>true,
                'edit-property'=>true,
                'delete-property'=>true,
                'view-property'=>true,
                'create-property-unit'=>true,
                'edit-property-unit'=>true,
                'delete-property-unit'=>true,
                'view-property-unit'=>true,
                'create-issue'=>true,
                'update-issue'=>true,
                'view-issue'=>true,
                'create-payment'=>true,
                'update-payment'=>true,
                'view-payment'=>true,
                'create-invite'=>true,
                'invite-tenant'=>true,
            ])
        ]);

        Role::create([
            'name'=>'Landlord',
            'slug'=>'landlord',
            'permissions'=>json_encode([
                'create-property'=>true,
                'edit-property'=>true,
                'delete-property'=>true,
                'view-property'=>true,
                'create-property-unit'=>true,
                'edit-property-unit'=>true,
                'delete-property-unit'=>true,
                'view-property-unit'=>true,
                'update-issue'=>true,
                'view-issue'=>true,
                'update-payment'=>true,
                'view-payment'=>true,
                'create-invite'=>true,
                'invite-tenant'=>true,
            ])
        ]);

        Role::create([
            'name'=>'Tenant',
            'slug'=>'tenant',
            'permissions'=>json_encode([
                'view-property'=>true,
                'view-property-unit'=>true,
                'create-issue'=>true,
                'update-issue'=>true,
                'view-issue'=>true,
                'create-payment'=>true,
                'update-payment'=>true,
                'view-payment'=>true,
                'forum'=>true,
            ])
        ]);
    }
}
