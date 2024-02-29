<?php

    namespace App\Enums;

    enum RoleTypes: string {
        const superAdmin = "super_admin";
        const admin = "admin";
        const user = "user";

        const All = [
            self::superAdmin,
            self::admin,
            self::user
        ];
    }
