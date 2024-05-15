<?php

namespace App\Services\HidroProjekt\BDE;

use stdClass;
use App\Models\MaterialConsumptionModel;
use App\Models\MaterialConsumptionItemModel;
use App\Services\HidroProjekt\STG\MovementTypes;
use App\Services\HidroProjekt\STG\MovementService;
use App\Services\HidroProjekt\STG\StorageLocation;

/**
 * Class ConsumptionService.
 */
class ConsumptionService
{
    private $consumption;
    private $items;

    public function addToConsumption($wdr, $mat_id, $qty){
        $consumptionData = $this->getConsumptionDataFromTable($wdr);
        $first = $consumptionData->first();
        $consumption = null;
        if($consumptionData->isEmpty()){
            $consumption = MaterialConsumptionModel::create([
                'wdr_id' => $wdr,
                'booked' => MaterialConsumptionModel::STATUS_UNBOOKED,
            ]);
        }else{
            $consumption = $consumptionData->first();
        }
        
        $this->consumption = $consumption;
        $this->items = $this->consumption->where('wdr_id', $wdr)->where('booked', 0)->with('getConsumptionItems')->first()->getConsumptionItems;

        if(!$this->items->where('mat_id', $mat_id)->isEmpty()){
            $this->updateItemInConsumption(
                $this->items->where('mat_id', $mat_id)->first(),
                $qty
            );
        }else{
            return $this->addNewItemToConsumption(
                $this->consumption->id,
                $mat_id,
                $qty
            );
        }
        return TRUE;
    }

    public static function getAllItemsInConsumption($wdr){
        $data = MaterialConsumptionModel::where('wdr_id',$wdr)->where('booked', 0)->with('getConsumptionItems')->get();
        if(!$data->isEmpty()){
            $items = $data->first()->getConsumptionItems;
            return $items->pluck('qty','mat_id')->toArray();
        }
        return [];
    }

    public function getConsumptionDataFromTable($wdr){
        return MaterialConsumptionModel::where('wdr_id',$wdr)->where('booked', 0)->with('getConsumptionItems')->get();
    }

    private function createNewConsumption($wdr){
        $data = MaterialConsumptionModel::create([
            'wdr_id' => $wdr,
            'booked' => MaterialConsumptionModel::STATUS_UNBOOKED,
        ]);
        return $data;
    }

    private function addNewItemToConsumption($cons_id, $mat_id, $qty){
        return MaterialConsumptionItemModel::create([
            'mat_cons_id' => $cons_id,
            'mat_id'      => $mat_id,
            'qty'         => $qty
        ]);
    }

    private function updateItemInConsumption($item,$qty,$updateItemsOnly=NULL){
        if($qty == 0 || $qty == ""){
            $item->delete();
        }else{
            $item->update([
                'qty' => $qty
            ]);
        }
        if($updateItemsOnly){
            return;
        }
        $this->items = $this->items->fresh();
        if($this->items->isEmpty()){
            return MaterialConsumptionModel::where('id',$this->consumption->id)->delete();
        }
        return;
    }

    public function delete(){
        return MaterialConsumptionModel::where('id',$this->consumption->id)->delete();
    }

    public function sendItemsToConsumption($wdr, $onStock, $consSiteId){
        $consumptionData = $this->getConsumptionDataFromTable($wdr)->first();
        $consumptionItems = $consumptionData->getConsumptionItems;
        $onStock = $onStock->fresh();
        foreach ($consumptionItems as $item){
            $stockItem = $onStock->where('mat_id', $item->mat_id);
            //Delete from cons items if the stock has changed and there is no material available
            if($stockItem->isEmpty() || $stockItem->first()->qty == 0){
                $this->updateItemInConsumption($item, 0, 1);
            }
            //Update items if the stock has changed
            if($stockItem->first()->qty < $item->qty){
                $this->updateItemInConsumption($item, $stockItem->first()->qty, 1);
            }
        }
        $consumptionItems = $consumptionItems->fresh();
        $itemsData=[];
        foreach ($consumptionItems as $item) {
            $itemsData[] = [
                'mat_id' => $item->mat_id,
                'qty'    => $item->qty
            ];
        }
        $mvtService = new MovementService(
            $itemsData,
            MovementTypes::BOOK_TO_CONSUMPTION,
            NULL,
            StorageLocation::CONSTRUCTION_SITE,
            $consSiteId
        );
        $mvtService->execute();
        unset($mvtService);
        $consumptionData->update([
            'booked' => 1
        ]);
        return;
    }

}
