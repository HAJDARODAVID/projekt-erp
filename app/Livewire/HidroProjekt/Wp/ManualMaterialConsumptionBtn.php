<?php

namespace App\Livewire\HidroProjekt\Wp;

use Livewire\Component;
use App\Models\MaterialMasterData;
use App\Models\ConstructionSiteModel;
use App\Models\MaterialConsumptionModel;
use App\Models\MaterialConsumptionItemModel;
use App\Models\WorkingDayRecordModel;
use App\Services\HidroProjekt\STG\MovementTypes;
use App\Services\HidroProjekt\STG\MovementService;
use App\Services\HidroProjekt\STG\StorageLocation;

class ManualMaterialConsumptionBtn extends Component
{
    public $modalShow = FALSE;
    public $constructionSiteInfo;
    public $materialInfo;
    public $qty;
    public $row;

    public function mount(){
        $this->constructionSiteInfo = ConstructionSiteModel::where('id', $this->row->cons_id)->first();
        $this->materialInfo = MaterialMasterData::where('id', $this->row->mat_id)->first();
        $this->qty = $this->row->qty;
    }

    public function updatedQty($key, $value){
        if($key > $this->row->qty){
            return $this->qty = $this->row->qty;
        }
    }

    public function sendMaterialToConsumption(){
        $itemsData=[];
        $itemsData[]=[
            'mat_id' => $this->materialInfo->id,
            'qty'    => $this->qty
        ];
        //Get last WDR for construction site
        $wdr = WorkingDayRecordModel::where('construction_site_id', $this->constructionSiteInfo->id)->orderBy('id', 'desc')->get();
        if($wdr->isEmpty()){
            return $this->dispatch('show-alert-modal', [
                'title' => 'ERROR!',
                'message' => "Za navedeno gradilište nema zapisa radnog dana na koji bi se material mogao utrošiti.",
                'type' => 'danger',
            ]);
        }
        //Create new consumption item
        $consumption = MaterialConsumptionModel::create([
            'wdr_id' => $wdr->first()->id,
            'booked' => MaterialConsumptionModel::STATUS_BOOKED,
        ]);
        $consumptionItems = MaterialConsumptionItemModel::create([
            'mat_cons_id' => $consumption->id,
            'mat_id'      => $this->materialInfo->id,
            'qty'         => $this->qty
        ]);
        $mvtService = new MovementService(
            $itemsData,
            MovementTypes::BOOK_MANUALLY_TO_CONSUMPTION,
            NULL,
            StorageLocation::CONSTRUCTION_SITE,
            $this->constructionSiteInfo->id
        );
        $booked = $mvtService->execute();
        if($booked){
            $this->dispatch('show-alert-modal', [
                'title' => 'Uspješno!',
                'message' => "Material: " . $this->materialInfo->name . ', uspješno potrošen sa gradilišta: '. $this->constructionSiteInfo->name,
                'type' => 'success',
            ]);
            return $this->modalShow = FALSE;
        }
    }

    public function modalToggle(){
        if($this->modalShow){
            return $this->modalShow = FALSE;
        }else{
            return $this->modalShow = TRUE;
        }
    }
    public function render()
    {
        return view('livewire.hidroprojekt.wp.manual-material-consumption-btn');
    }
}
