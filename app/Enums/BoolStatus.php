<?php

    namespace App\Enums;

    enum BoolStatus: string {
        const yes = '1';
        const no = '0';

        const All = [
            self::yes,
            self::no
        ];
}
