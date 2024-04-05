<?php

namespace App\Models;

class UnitOfMeasure
{
    const UOM_SET           = 'SET';
    const UOM_LITERS        = 'L';
    const UOM_PIECE         = 'PC';
    const UOM_METERS        = 'M';
    const UOM_KILOGRAMS     = 'KG';
    const UOM_SQUARE_METERS = 'SM';

    const UOM = [
        self::UOM_SET           => 'Set',
        self::UOM_LITERS        => 'Litra',
        self::UOM_PIECE         => 'Komad',
        self::UOM_METERS        => 'Metar',
        self::UOM_KILOGRAMS     => 'Kilogram',
        self::UOM_SQUARE_METERS => 'Kvadratni metar',
    ];

}