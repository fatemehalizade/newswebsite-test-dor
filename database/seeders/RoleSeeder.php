<?php

namespace Database\Seeders;

use App\Enums\RoleTypes;
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
        Role::create(["name" => RoleTypes::superAdmin]);
        Role::create(["name" => RoleTypes::admin]);
        Role::create(["name" => RoleTypes::user]);
    }
}
