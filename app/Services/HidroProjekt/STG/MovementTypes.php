<?php

namespace App\Services\HidroProjekt\STG;

use App\Services\HidroProjekt\STG\StorageLocation;

class MovementTypes
{
    const BOOK_TO_STORAGE            = 101;  // Movement when new material comes from supplier
    const BOOK_CORRECTION_ON_STORAGE = 109;  // Movement when a correction is needed

    const MVT_TO_LOCATION = [
        self::BOOK_TO_STORAGE => StorageLocation::MAIN_STORAGE,
    ];

    const MVT_ACTIONS = [
        self::BOOK_TO_STORAGE => ['add'],
    ];

}
