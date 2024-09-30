<?php

namespace App\Services\HidroProjekt\Domain\Storage;

class StorageLocation
{
    const MAIN_STORAGE      = 10000;  // Main storage on company complex
    const CONSTRUCTION_SITE = 40000;  // Stock on construction site

    const STOR_LOC = [
        self::MAIN_STORAGE,
        self::CONSTRUCTION_SITE,
    ];

}
