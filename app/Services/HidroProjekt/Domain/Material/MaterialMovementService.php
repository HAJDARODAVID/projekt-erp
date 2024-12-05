<?php

namespace App\Services\HidroProjekt\Domain\Material;

use App\Models\StorageStockItem;
use App\Exceptions\MovementException;
use App\Models\MaterialConsumptionItemModel;
use App\Models\MaterialConsumptionModel;
use App\Services\HidroProjekt\STG\StorageLocation;

class MaterialMovementService{

    private $mvt;
    private $items;
    private $jobSiteID;
    private $wdrID;
    private $strLocation;

    private $matDoc = NULL;
    private $mvtLocation = NULL;
    private $stockItem;

    public function __construct(
        $mvt = NULL,
        array $items = [],
        $jobSiteID = NULL,
        $wdrID = NULL,
    )
    {
        $this->mvt = $this->setMovement($mvt);
        $this->items = $items;
        $this->jobSiteID = $jobSiteID;
        $this->wdrID = $wdrID;
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
        if($this->mvt = MovementTypes::BOOK_TO_CONSUMPTION){
            $this->createNewConsumption();
        }
    }

    private function createNewConsumption(){
        if($this->wdrID){
            $consDoc = MaterialConsumptionModel::create([
                'wdr_id' => $this->wdrID,
                'mat_doc_id' => $this->matDoc->id,
                'booked' => MaterialConsumptionModel::STATUS_BOOKED,
            ]);
            foreach ($this->items as $item) {
                MaterialConsumptionItemModel::create([
                    'mat_cons_id' => $consDoc->id,
                    'mat_id' => $item['mat_id'],
                    'qty'=> $item['qty'],
                ]);
            }
        }else{
            //throw error if there is no wdrID
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