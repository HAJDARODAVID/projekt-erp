<?php

namespace App\Services\HidroProjekt\Domain\Material;

use App\Models\MaterialMasterData;
use Illuminate\Support\Facades\Auth;
use App\Models\ConstructionSiteModel;
use App\Exceptions\MustBeArrayException;
use App\Exceptions\NotAllowedMvtException;
use App\Exceptions\MissingArgumentException;
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
        //Check if $item is array
        if(!is_array($item)){
            return throw new MustBeArrayException;
        }

        //Check if the necessary keys are set
        if(!isset($item['mat_id']) || !isset($item['qty'])){
            return throw new MissingArgumentException('mat_id/qty[ERROR#001]');
        }

        //Check if the keys are not empty
        if($item['mat_id'] == "" || $item['qty'] == ""){
            return throw new MissingArgumentException('mat_id/qty[ERROR#002]');
        }

        //Check if material is valid
        $mat = MaterialMasterData::where('id', $item['mat_id'])->where('active', TRUE)->get();
        if($mat->isEmpty()){
            return throw new MaterialDoesNotExistsException(['id' => $item['mat_id']]);
        }

        //Check if material is available on construction site stock

        
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
    
}