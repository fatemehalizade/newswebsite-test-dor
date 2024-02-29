<?php

    namespace App\Enums;

    enum DutySystemStatus: int {
        const end = '2';
        const serving = '1';
        const exempt = '0';

        const All = [
            self::end,
            self::serving,
            self::exempt
        ];
    }
