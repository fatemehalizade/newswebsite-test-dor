<?php

    namespace App\Enums;

    enum GenderTypes: int{
        const female = '1';
        const male = '0';

        const All = [
            self::female,
            self::male
        ];
    }
