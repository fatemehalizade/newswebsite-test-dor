<?php

namespace Database\Seeders;

use App\Enums\DutySystemStatus;
use App\Enums\GenderTypes;
use App\Enums\RoleTypes;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $newUser=User::create([
            "code" => Str::random(5),
            "first_name" => "فاطمه",
            "last_name" => "علیزاده",
            "nationalcode" => 2080911325,
            "gender" => GenderTypes::female,
            "mobile" => "09391295157",
            "email" => "fatemeh.alzd.faz@gmail.com",
            "image" => null,
            "username" => "superadmin",
            "password" => Hash::make("123"),
            "province_id" => null,
            "city_id" => null,
            "duty_system_status" => DutySystemStatus::exempt
        ]);

        $newUser->assignRole(RoleTypes::superAdmin);

    }
}
