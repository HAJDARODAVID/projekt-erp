<?php

namespace App\Services\HidroProjekt\BDE;

use App\Models\MaterialConsumptionItemModel;
use App\Models\MaterialConsumptionModel;

/**
 * Class ConsumptionService.
 */
class ConsumptionService
{
    protected $consumption;
    protected $items;

    public function addToConsumption($wdr, $mat_id, $qty){
        $consumptionData = $this->getConsumptionDataFromTable($wdr);
        if($consumptionData->isEmpty()){
            $consumptionData = $this->createNewConsumption($wdr)->with('getConsumptionItems');
        }
        $this->setConsumption($consumptionData->first());
        $this->setItems($this->consumption->getConsumptionItems);

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
    }

    public static function getAllItemsInConsumption($wdr){
        $data = MaterialConsumptionModel::where('wdr_id',$wdr)->with('getConsumptionItems')->get();
        if(!$data->isEmpty()){
            $items = $data->first()->getConsumptionItems;
            return $items->pluck('qty','mat_id')->toArray();
        }
        return NULL;
    }

    public function getConsumptionDataFromTable($wdr){
        return MaterialConsumptionModel::where('wdr_id',$wdr)->with('getConsumptionItems')->get();
    }

    private function createNewConsumption($wdr){
        return MaterialConsumptionModel::create([
            'wdr_id' => $wdr,
            'booked' => MaterialConsumptionModel::STATUS_UNBOOKED,
        ]);
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

    private function setConsumption($data){
        return $this->consumption = $data;
    }

    private function setItems($data){
        return $this->items = $data;
    }

    public function delete(){
        return MaterialConsumptionModel::where('id',$this->consumption->id)->delete();
    }

}
