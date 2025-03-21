<?php

namespace App\Services\HidroProjekt\Domain\Material;

use App\Services\HidroProjekt\STG\StorageLocation;

class MovementTypes
{
    const BOOK_TO_STORAGE                  = 101;  // Movement when new material comes from supplier
    const BOOK_CORRECTION_ON_STORAGE_UP    = 191;  // Movement when a correction is needed --> positive stock
    const BOOK_CORRECTION_ON_STORAGE_DOWN  = 192;  // Movement when a correction is needed --> negative stock
    const BOOK_FROM_STORAGE_TO_CONST_SITE  = 261;  // Movement where we book material from storage to construction site
    const BOOK_FROM_CONST_SITE_TO_STORAGE  = 262;  // Movement where we book material from construction site to storage
    const BOOK_DIRECT_TO_CONSTRUCTION_SITE = 270;  // Movement where we book material directly to construction site
    const BOOK_TO_CONSUMPTION              = 501;  // Movement where we book material to consumption
    const BOOK_MANUALLY_TO_CONSUMPTION     = 509;  // Movement where we book material to consumption but manually (the group leader did not booked the material)
    const BOOK_SALES_ORDER_MATERIAL        = 601;  // Movement where we book material that has been sold
    
    CONST BOOK_INVENTORY_REMOVE_STOCK     = 701;  // Inventory booking for removing all stock 
    CONST BOOK_INVENTORY_ADD_STOCK        = 702;  // Inventory booking for adding all stock from inventory item list

    const MVT = [
        self::BOOK_TO_STORAGE,
        self::BOOK_CORRECTION_ON_STORAGE_UP,
        self::BOOK_CORRECTION_ON_STORAGE_DOWN,
        self::BOOK_FROM_STORAGE_TO_CONST_SITE,
        self::BOOK_FROM_CONST_SITE_TO_STORAGE,
        self::BOOK_DIRECT_TO_CONSTRUCTION_SITE,
        self::BOOK_TO_CONSUMPTION,
        self::BOOK_MANUALLY_TO_CONSUMPTION,
        self::BOOK_SALES_ORDER_MATERIAL,
        self::BOOK_INVENTORY_REMOVE_STOCK,
        self::BOOK_INVENTORY_ADD_STOCK,
    ];

    const MVT_DESC_HR = [
        self::BOOK_TO_STORAGE                  => NULL,
        self::BOOK_FROM_STORAGE_TO_CONST_SITE  => 'Skladište --> gradilište',
        self::BOOK_FROM_CONST_SITE_TO_STORAGE  => 'Gradilište --> skladište',
        self::BOOK_CORRECTION_ON_STORAGE_DOWN  => NULL,
        self::BOOK_DIRECT_TO_CONSTRUCTION_SITE => 'Dobavljač --> gradilište',
        self::BOOK_SALES_ORDER_MATERIAL        => 'Prodaja'
    ];

    const MVT_FROM_LOCATION = [
        self::BOOK_TO_STORAGE                  => NULL,
        self::BOOK_FROM_STORAGE_TO_CONST_SITE  => StorageLocation::MAIN_STORAGE,
        self::BOOK_CORRECTION_ON_STORAGE_UP    => NULL,
        self::BOOK_CORRECTION_ON_STORAGE_DOWN  => NULL,
        self::BOOK_TO_CONSUMPTION              => StorageLocation::CONSTRUCTION_SITE,
        self::BOOK_MANUALLY_TO_CONSUMPTION     => StorageLocation::CONSTRUCTION_SITE,
        self::BOOK_DIRECT_TO_CONSTRUCTION_SITE => StorageLocation::CONSTRUCTION_SITE,
        self::BOOK_SALES_ORDER_MATERIAL        => NULL,
        self::BOOK_FROM_CONST_SITE_TO_STORAGE  => StorageLocation::CONSTRUCTION_SITE,
    ];
 
    const MVT_TO_LOCATION = [
        self::BOOK_TO_STORAGE                  => StorageLocation::MAIN_STORAGE,
        self::BOOK_FROM_STORAGE_TO_CONST_SITE  => StorageLocation::CONSTRUCTION_SITE,
        self::BOOK_CORRECTION_ON_STORAGE_UP    => NULL,
        self::BOOK_CORRECTION_ON_STORAGE_DOWN  => NULL,
        self::BOOK_TO_CONSUMPTION              => StorageLocation::CONSTRUCTION_SITE,
        self::BOOK_MANUALLY_TO_CONSUMPTION     => StorageLocation::CONSTRUCTION_SITE,
        self::BOOK_DIRECT_TO_CONSTRUCTION_SITE => StorageLocation::CONSTRUCTION_SITE,
        self::BOOK_SALES_ORDER_MATERIAL        => NULL,
        self::BOOK_FROM_CONST_SITE_TO_STORAGE  => StorageLocation::MAIN_STORAGE,
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
        self::BOOK_MANUALLY_TO_CONSUMPTION    => [self::MVT_ACTION_TYPE_REMOVE],
        self::BOOK_FROM_STORAGE_TO_CONST_SITE => [
            self::MVT_ACTION_TYPE_ADD,
            self::MVT_ACTION_TYPE_REMOVE
        ],
        self::BOOK_FROM_CONST_SITE_TO_STORAGE => [
            self::MVT_ACTION_TYPE_ADD,
            self::MVT_ACTION_TYPE_REMOVE
        ],
        self::BOOK_DIRECT_TO_CONSTRUCTION_SITE => [self::MVT_ACTION_TYPE_ADD],
        self::BOOK_SALES_ORDER_MATERIAL        => [self::MVT_ACTION_TYPE_REMOVE],
    ];

    const CONST_SITE_MVT = [self::BOOK_FROM_STORAGE_TO_CONST_SITE, self::BOOK_FROM_CONST_SITE_TO_STORAGE, self::BOOK_DIRECT_TO_CONSTRUCTION_SITE];

}
