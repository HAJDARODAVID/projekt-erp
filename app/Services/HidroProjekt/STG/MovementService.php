<?php

namespace App\Services\HidroProjekt\STG;

use App\Models\MaterialDocModel;
use App\Models\MaterialMvtModel;
use App\Models\StorageStockItem;
use Illuminate\Support\Facades\Auth;

/**
 * Class MovementService.
 */
class MovementService
{
    protected $matDocNr;

    protected $data;

    protected $mvt;

    protected $toLoc;

    protected $fromLoc;

    protected $mvtType;

    protected $constSite;

    public function __construct(
        $data,
        $mvt,
        $toLoc = NULL,
        $fromLoc = NULL,
        $constSite = NULL,
    )
    {
        $this->data = $data;
        $this->mvt = $mvt;
        $this->toLoc = $toLoc == NULL && isset(MovementTypes::MVT_TO_LOCATION[$this->mvt]) ? MovementTypes::MVT_TO_LOCATION[$this->mvt] : $toLoc;
        $this->fromLoc = $fromLoc;
        $this->constSite = $constSite;
        
        $this->matDocNr = $this->createNewMaterialDoc();
        $this->mvtType = MovementTypes::MVT_ACTIONS[$this->mvt];
    }

    public function execute(){
        foreach ($this->mvtType as $mvt) {
            $this->createNewMovement($mvt);
            $this->updateStockItems($mvt);
        }
        return true;
    }

    private function createNewMaterialDoc(){
        return MaterialDocModel::create([
            'mvt_type' => $this->mvt,
            'created_by' => Auth::user()->id,
        ]);
    }

    private function createNewMovement($mvt){
        foreach ($this->data as $data) {
            $stgLoc = $mvt>0 ? $this->toLoc : $this->fromLoc;
            MaterialMvtModel::create([
                'stg_loc'    => $stgLoc,
                'const_id'   => $stgLoc == StorageLocation::CONSTRUCTION_SITE ? $this->constSite : NULL,
                'mvt'        => $this->mvt,
                'mat_doc_id' => $this->matDocNr->id,
                'mat_id'     => $data['mat_id'],
                'qty'        => $data['qty'] * $mvt,
            ]);
        }
        return;
    }

    private function updateStockItems($mvt){
        foreach ($this->data as $data) {
            $stgLoc = $mvt>0 ? $this->toLoc : $this->fromLoc;
            $qty = $data['qty'] * $mvt;
            $onStock = StorageStockItem::where('mat_id', $data['mat_id'])->where('str_loc', $stgLoc)->get();
            if(!is_null($this->constSite) && $stgLoc != StorageLocation::MAIN_STORAGE){
                $onStock = $onStock->where('cons_id', $this->constSite);
            }
            $onStock = $onStock->first();
            if(is_null($onStock)){
                StorageStockItem::create([
                    'mat_id'  => $data['mat_id'],
                    'str_loc' => $stgLoc,
                    'cons_id' => $this->constSite,
                    'qty'     => $qty,
                ]);
            }else{
                $onStock->update([
                    'qty' => $onStock->qty + $qty,
                ]);
            }
        }
        return;
    }

}
