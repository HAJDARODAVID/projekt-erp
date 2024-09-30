<?php

namespace App\Services\HidroProjekt\Domain\Material;

use App\Models\StorageStockItem;
use App\Models\MaterialMasterData;
use Illuminate\Support\Facades\Auth;
use App\Models\ConstructionSiteModel;
use App\Exceptions\MustBeArrayException;
use App\Exceptions\NotAllowedMvtException;
use App\Exceptions\MissingArgumentException;
use App\Exceptions\MaterialNotOnStockException;
use App\Exceptions\MaterialDoesNotExistsException;
use App\Exceptions\ConstructionSiteDoesNotExistsException;
use App\Services\HidroProjekt\Domain\Movement\MovementTypes;

class MaterialConsumptionService{

    const ALLOWED_MVT = [
        MovementTypes::BOOK_TO_CONSUMPTION,
        MovementTypes::BOOK_MANUALLY_TO_CONSUMPTION,
    ];

    private $mvt;
    private $site;
    private $user;
    private $data=[];
    private $newItem = NULL;

    public function __construct(
        $mvt = NULL,
        $site_id = NULL,
    )
    {
        $this->mvt = $this->setMvt($mvt);
        $this->site = $this->setSite($site_id);
        $this->user = Auth::user();
    }

    public function addItemToConsumer($item){
        $this->newItem = $item;
        $validation = $this->isItemArray()
            ->areItemKeysSet()
            ->areItemKeysNotEmpty()
            ->isMaterialValid()
            ->isMaterialOnConstructionSite();        
    }

    private function setMvt($mvt){
        if(in_array($mvt, self::ALLOWED_MVT)){
            return $mvt;
        }
        return throw new NotAllowedMvtException([
            'mvt' => $mvt,
            'class' => get_class($this),
        ]);
    }

    private function setSite($site_id){
        $site = ConstructionSiteModel::where('id', $site_id)->get();
        if($site->isEmpty()){
            return throw new ConstructionSiteDoesNotExistsException(['id' => $site_id]);
        }
        return $site->first();
    }

    private function isItemArray(){
        //Check if $item is array
        if(!is_array($this->newItem)){
            $this->newItem = NULL;
            return throw new MustBeArrayException;
        }
        return $this;
    }

    private function areItemKeysSet(){
        //Check if the necessary keys are set
        if(!isset($this->newItem['mat_id']) || !isset($this->newItem['qty'])){
            $this->newItem = NULL;
            return throw new MissingArgumentException('mat_id/qty[ERROR#001]');
        }
        return $this;
    }

    private function areItemKeysNotEmpty(){
        //Check if the keys are not empty
        if($this->newItem['mat_id'] == "" || $this->newItem['qty'] == ""){
            $this->newItem = NULL;
            return throw new MissingArgumentException('mat_id/qty[ERROR#002]');
        }
        return $this;
    }

    private function isMaterialValid(){
        //Check if material is valid
        $mat = MaterialMasterData::where('id', $this->newItem['mat_id'])->where('active', TRUE)->get();
        if($mat->isEmpty()){
            $mat_id = $this->newItem['mat_id'];
            $this->newItem = NULL;
            return throw new MaterialDoesNotExistsException(['id' => $mat_id]);
        }
        return $this;
    }

    private function isMaterialOnConstructionSite(){
        //Check if material is available on construction site stock
        $stock = StorageStockItem::where('cons_id', $this->site->id)->where('mat_id', $this->newItem['mat_id'])->get();
        if($stock->isEmpty()){
            $mat_id = $this->newItem['mat_id'];
            $this->newItem = NULL;
            return throw new MaterialNotOnStockException(['id' => $mat_id]);
        }
        return $this;
    }
    
}