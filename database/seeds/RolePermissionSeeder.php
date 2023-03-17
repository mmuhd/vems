<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::create(['name' => 'admin']);
        $supervisorRole = Role::create(['name' => 'supervisor']);
        $operatorRole = Role::create(['name' => 'operator']);
        $universalPermission = [
            ['name' => 'collection.store'],
            ['name' => 'collection.index'],
            ['name' => 'collection.create'],
            ['name' => 'collection.show'],
            ['name' => 'customer.index'],
            ['name' => 'customer.store'],
            ['name' => 'customer.create'],
            ['name' => 'customer.show'],
            ['name' => 'landlord.index'],
            ['name' => 'landlord.store'],
            ['name' => 'landlord.create'],
            ['name' => 'landlord.show'],
            ['name' => 'user.dashboard'],
            ['name' => 'expense.index'],
            ['name' => 'expense.store'],
            ['name' => 'expense.create'],
            ['name' => 'expense.show'],
            ['name' => 'flat.index'],
            ['name' => 'flat.store'],
            ['name' => 'flat.create'],
            ['name' => 'flat.show'],
            ['name' => 'user.lock'],
            ['name' => 'user.login'],
            ['name' => 'user.logout'],
            ['name' => 'user.profile'],
            ['name' => 'user.update'],
            ['name' => 'project.index'],
            ['name' => 'project.create'],
            ['name' => 'project.store'],
            ['name' => 'project.show'],
            ['name' => 'rent.index'],
            ['name' => 'rent.store'],
            ['name' => 'rent.create'],
            ['name' => 'rent.show'],
            ['name' => 'rent.update'],
            ['name' => 'rent.edit'],
            ['name' => 'renew.index'],
            ['name' => 'renew.store'],
            ['name' => 'renew.create'],
            ['name' => 'renew.show'],
            ['name' => 'renew.update'],
            ['name' => 'renew.edit'],
            ['name' => 'renew.destroy'],
            ['name' => 'area.index'],
            ['name' => 'area.store'],
            ['name' => 'notice.create'],
            ['name' => 'notice.edit'],
            ['name' => 'notice.send'],
            ['name' => 'notice.update'],
            ['name' => 'notice.show'],
            ['name' => 'notice.logshow'],
            ['name' => 'notice.log'],
            ['name' => 'notice.index'],
            ['name' => 'notice.logindex'],
            ['name' => 'notice.ajax'],
            ['name' => 'notice.store'],
            ['name' => 'notice.destroy']
        ];

        $adminAndSupervisorPermissions = [
            ['name' => 'collection.edit'],
            ['name' => 'collection.update'],
            ['name' => 'customer.update'],
            ['name' => 'customer.ajax'],
            ['name' => 'customer.edit'],
            ['name' => 'landlord.update'],
            ['name' => 'landlord.ajax'],
            ['name' => 'landlord.edit'],
            ['name' => 'landlord.byproject'],
            ['name' => 'expense.update'],
            ['name' => 'expense.edit'],
            ['name' => 'flat.update'],
            ['name' => 'flat.edit'],
            ['name' => 'flat.byproject'],
            ['name' => 'project.bytype'],
            ['name' => 'project.update'],
            ['name' => 'project.edit'],
            ['name' => 'customer.byproject'],
            ['name' => 'flat.bycustomer'],
            
            ['name' => 'report.balance'],
            ['name' => 'report.collections'],
            ['name' => 'report.collectionSummary'],
            ['name' => 'report.customers'],
            ['name' => 'report.landlords'],
            ['name' => 'report.landlord_properties'],
            ['name' => 'report.expenses'],
            ['name' => 'report.remittances'],
            ['name' => 'report.flats'],
            ['name' => 'report.projects'],
            ['name' => 'report.rents'],
            ['name' => 'report.rentalStatus'],
            ['name' => 'report.dues']

        ];

        $adminOnlyPermissions = [
            ['name' => 'user.index'],
            ['name' => 'user.store'],
            ['name' => 'user.create'],
            ['name' => 'user.destroy'],
            ['name' => 'user.show'],
            ['name' => 'user.edit'],
            ['name' => 'collection.destroy'],
            ['name' => 'customer.destroy'],
            ['name' => 'landlord.destroy'],
            ['name' => 'expense.destroy'],
            ['name' => 'remittance.destroy'],
            ['name' => 'flat.destroy'],
            ['name' => 'project.destroy'],
            ['name' => 'rent.destroy'],
            ['name' => 'mail.compose'],
            ['name' => 'mail.send'],
            
            ['name' => 'area.destroy'],
            ['name' => 'remittance.index'],
            ['name' => 'remittance.store'],
            ['name' => 'remittance.create'],
            ['name' => 'remittance.show']
            
        ];

        foreach ($universalPermission as $permission){
            Permission::create($permission);
        }

        foreach ($adminAndSupervisorPermissions as $permission){
            Permission::create($permission);
        }

        foreach ($adminOnlyPermissions as $permission){
            Permission::create($permission);
        }

        foreach ($universalPermission as $permission){
            $adminRole->givePermissionTo($permission['name']);
            $supervisorRole->givePermissionTo($permission['name']);
            $operatorRole->givePermissionTo($permission['name']);

        }

        foreach ($adminAndSupervisorPermissions as $permission){
            $adminRole->givePermissionTo($permission['name']);
            $supervisorRole->givePermissionTo($permission['name']);
        }

        foreach ($adminOnlyPermissions as $permission){
            $adminRole->givePermissionTo($permission['name']);
        }

        $adminUser = User::create(
            [
                'name' => 'admin',
                'email' => 'admin@vems.com',
                'password' => 'vannia123',
                'description' => '',
                'remember_token' => null,
            ]);

        $adminUser->assignRole($adminRole->name);
    }
}
