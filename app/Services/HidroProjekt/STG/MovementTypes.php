<?php

namespace App\Services\HidroProjekt\STG;

use App\Services\HidroProjekt\STG\StorageLocation;

class MovementTypes
{
    const BOOK_TO_STORAGE                 = 101;  // Movement when new material comes from supplier
    const BOOK_CORRECTION_ON_STORAGE_UP   = 191;  // Movement when a correction is needed --> positive stock
    const BOOK_CORRECTION_ON_STORAGE_DOWN = 192;  // Movement when a correction is needed --> negative stock
    const BOOK_FROM_STORAGE_TO_CONST_SITE = 261;  // Movement where we book material from storage to construction site
    const BOOK_FROM_CONST_SITE_TO_STORAGE = 262;  // Movement where we book material from construction site to storage
    const BOOK_TO_CONSUMPTION             = 501;  // Movement where we book material to consumption

    const MVT_DESC_HR = [
        self::BOOK_TO_STORAGE                 => NULL,
        self::BOOK_FROM_STORAGE_TO_CONST_SITE => 'Skladište --> gradilište',
        self::BOOK_FROM_CONST_SITE_TO_STORAGE   => 'Gradilište --> skladište',
        self::BOOK_CORRECTION_ON_STORAGE_DOWN => NULL,
    ];
 
    const MVT_TO_LOCATION = [
        self::BOOK_TO_STORAGE                 => StorageLocation::MAIN_STORAGE,
        self::BOOK_FROM_STORAGE_TO_CONST_SITE => StorageLocation::CONSTRUCTION_SITE,
        self::BOOK_CORRECTION_ON_STORAGE_UP   => NULL,
        self::BOOK_CORRECTION_ON_STORAGE_DOWN => NULL,
        self::BOOK_TO_CONSUMPTION             => StorageLocation::CONSTRUCTION_SITE,
    ];

    const MVT_ACTION_TYPE_ADD    = 1;
    const MVT_ACTION_TYPE_REMOVE = -1;

    const MVT_ACTION_TYPE = [
        self::MVT_ACTION_TYPE_ADD    => 'add',
        self::MVT_ACTION_TYPE_REMOVE => 'remove',
    ];

    const MVT_ACTIONS = [
        self::BOOK_TO_STORAGE                 => [self::MVT_ACTION_TYPE_ADD],
        self::BOOK_CORRECTION_ON_STORAGE_UP   => [self::MVT_ACTION_TYPE_ADD],
        self::BOOK_CORRECTION_ON_STORAGE_DOWN => [self::MVT_ACTION_TYPE_REMOVE],
        self::BOOK_TO_CONSUMPTION             => [self::MVT_ACTION_TYPE_REMOVE],
        self::BOOK_FROM_STORAGE_TO_CONST_SITE => [
            self::MVT_ACTION_TYPE_ADD,
            self::MVT_ACTION_TYPE_REMOVE
        ],
        self::BOOK_FROM_CONST_SITE_TO_STORAGE => [
            self::MVT_ACTION_TYPE_ADD,
            self::MVT_ACTION_TYPE_REMOVE
        ],
    ];

    const CONST_SITE_MVT = [self::BOOK_FROM_STORAGE_TO_CONST_SITE, self::BOOK_FROM_CONST_SITE_TO_STORAGE];

}
