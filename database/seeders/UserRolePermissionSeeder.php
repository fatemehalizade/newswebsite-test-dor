<?php

namespace Database\Seeders;

use App\Enums\RoleTypes;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserRolePermissionSeeder extends Seeder
{
    private $permissions = [
        "لیست-نظرات",
        "لیست-علاقه مندی",
        "ثبت-علاقه مندی",
        "حذف-علاقه مندی"
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role=Role::findByName(RoleTypes::user);
        $role->syncPermissions($this->permissions);
    }
}
