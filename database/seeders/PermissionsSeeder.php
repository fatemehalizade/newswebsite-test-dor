<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionsSeeder extends Seeder
{
    private $permissions = [
        "لیست-کاربران",
        "ثبت-کاربران",
        "ویرایش-کاربران",
        "حذف-کاربران",
        "لیست-ادمین",
        "ثبت-ادمین",
        "ویرایش-ادمین",
        "حذف-ادمین",
        "لیست-مجوز",
        "ویرایش-مجوز",
        "حذف-مجوز",
        "لیست-دسته بندی",
        "ثبت-دسته بندی",
        "ویرایش-دسته بندی",
        "حذف-دسته بندی",
        "لیست-استان",
        "ثبت-استان",
        "ویرایش-استان",
        "حذف-استان",
        "لیست-شهرستان",
        "ثبت-شهرستان",
        "ویرایش-شهرستان",
        "حذف-شهرستان",
        "لیست-اخبار",
        "ثبت-اخبار",
        "ویرایش-اخبار",
        "حذف-اخبار",
        "لیست-لاگ",
        "لیست-بازدید",
        "لیست-نظرات",
        "ثبت-نظرات",
        "لیست-علاقه مندی",
        "ثبت-علاقه مندی",
        "حذف-علاقه مندی",
        "داشبورد"
    ];
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        foreach ($this->permissions as $permission){
            Permission::create(["name" => $permission]);
        }
    }
}
