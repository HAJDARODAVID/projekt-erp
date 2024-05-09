<?php

namespace App\Services\HidroProjekt\BDE;

use App\Models\MaterialConsumptionModel;
use App\Models\MaterialConsumptionItemModel;
use stdClass;

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
        $this->items = $this->consumption->where('wdr_id', $wdr)->with('getConsumptionItems')->first()->getConsumptionItems;

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
        $data = MaterialConsumptionModel::where('wdr_id',$wdr)->with('getConsumptionItems')->get();
        if(!$data->isEmpty()){
            $items = $data->first()->getConsumptionItems;
            return $items->pluck('qty','mat_id')->toArray();
        }
        return [];
    }

    public function getConsumptionDataFromTable($wdr){
        return MaterialConsumptionModel::where('wdr_id',$wdr)->with('getConsumptionItems')->get();
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

    private function updateItemInConsumption($item,$qty){
        if($qty == 0 || $qty == ""){
            $item->delete();
        }else{
            $item->update([
                'qty' => $qty
            ]);
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

}
