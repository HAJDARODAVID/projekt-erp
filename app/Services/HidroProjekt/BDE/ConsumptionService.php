<?php

namespace App\Services\HidroProjekt\BDE;

use stdClass;
use App\Models\MaterialConsumptionModel;
use App\Models\MaterialConsumptionItemModel;

/**
 * Class ConsumptionService.
 */
class ConsumptionService
{
    protected $consumption;
    protected $items;
    protected $newConsumption;

    public function __construct()
    {
        $this->consumption = new stdClass();
    }

    public function addToConsumption($wdr, $mat_id, $qty){
        $consumptionData = $this->getConsumptionDataFromTable($wdr);
        $first = $consumptionData;
        if($consumptionData->isEmpty()){
            $this->createNewConsumption($wdr);
            // $consumptionData = $this->newConsumption->with('getConsumptionItems');
            // $sec = $consumptionData;
            $this->setConsumption($this->newConsumption->with('getConsumptionItems')->first());
            $this->setItems($this->consumption->getConsumptionItems);
        }else{
            $this->setConsumption($consumptionData->first());
            $this->setItems($this->consumption->getConsumptionItems);
        }
        
        dd([
            'wdr'            => $wdr,
            'consumption'    => $this->consumption,
            'items'          => $this->items,
            'newConsumption' => $this->newConsumption
        ]);

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
        $this->newConsumption = $data;
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

    private function setConsumption($data){
        $this->consumption = $data;
    }

    private function setItems($data){
        $this->items = $data;
    }

    public function delete(){
        return MaterialConsumptionModel::where('id',$this->consumption->id)->delete();
    }

}
