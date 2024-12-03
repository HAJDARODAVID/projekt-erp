<?php

namespace App\Services\HidroProjekt\Domain\Material;

use App\Exceptions\MovementException;
use App\Models\StorageStockItem;
use App\Services\HidroProjekt\STG\StorageLocation;

class MaterialMovementService{

    private $mvt;
    private $items;
    private $jobSiteID;
    private $strLocation;

    private $matDoc = NULL;
    private $mvtLocation = NULL;
    private $stockItem;

    public function __construct(
        $mvt = NULL,
        array $items = [],
        $jobSiteID = NULL,
    )
    {
        $this->mvt = $this->setMovement($mvt);
        $this->items = $items;
        $this->jobSiteID = $jobSiteID;
    }

    public function consumer(){
        if(is_null($this->mvt)){
            return throw new MovementException();
        }
        $movementService = new MovementDocumentService();
        $this->matDoc = $movementService->createNewMovementDoc($this->mvt);
        foreach ($this->items as $item) {
            foreach (MovementTypes::MVT_ACTIONS[$this->mvt] as $action) {
                if($action == MovementTypes::MVT_ACTION_TYPE_ADD){
                    $this->mvtLocation = MovementTypes::MVT_TO_LOCATION[$this->mvt];
                    $movementService->createNewMovementItem(
                        ['mat_id' => $item['mat_id'], 'qty' => $item['qty']*$action],
                        $this->mvtLocation,
                        $this->mvtLocation == StorageLocation::CONSTRUCTION_SITE ? $this->jobSiteID : NULL
                    );
                    $this->getStockItem($item['mat_id'])->addToStock($item);
                }

                if($action == MovementTypes::MVT_ACTION_TYPE_REMOVE){
                    $this->mvtLocation = MovementTypes::MVT_FROM_LOCATION[$this->mvt];
                    $movementService->createNewMovementItem(
                        ['mat_id' => $item['mat_id'], 'qty' => $item['qty']*$action],
                        $this->mvtLocation,
                        $this->mvtLocation == StorageLocation::CONSTRUCTION_SITE ? $this->jobSiteID : NULL
                    );
                    $this->getStockItem($item['mat_id'])->removeFromStock($item);
                }
            }
        }
    }

    private function removeFromStock($item){
        if($this->stockItem){
            if($this->stockItem->qty >= $item['qty']){
                $this->stockItem->update([
                    'qty' => $this->stockItem->qty - $item['qty'],
                ]);
            }else{
                //throw error if there is not enough qty
            }
        }
    }

    private function addToStock($item){
        if(is_null($this->stockItem)){
            return StorageStockItem::create([
                'mat_id' => $item['mat_id'],
                'str_loc' => $this->mvtLocation,
                'cons_id' => $this->mvtLocation == StorageLocation::CONSTRUCTION_SITE ? $this->jobSiteID : NULL,
                'qty' => $item['qty'],
            ]);
        }
        $this->stockItem->update([
            'qty' => $this->stockItem->qty + $item['qty'],
        ]);
    }

    private function getStockItem($matID){
        $stockItem = StorageStockItem::where('mat_id', $matID)->where('str_loc', $this->mvtLocation);
        if($this->mvtLocation == StorageLocation::CONSTRUCTION_SITE){
            $stockItem = $stockItem->where('cons_id', $this->jobSiteID);
        }
        $this->stockItem = $stockItem->first();
        return $this;
    }

    private function setMovement($mvt){
        return in_array($mvt, MovementTypes::MVT) ? $mvt : NULL;
    }
}