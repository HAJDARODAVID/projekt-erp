<?php

namespace App\Livewire\HidroProjekt\Wp;

use Livewire\Component;
use App\Models\MaterialMasterData;
use App\Models\ConstructionSiteModel;
use App\Models\MaterialConsumptionModel;
use App\Models\MaterialConsumptionItemModel;
use App\Models\WorkingDayRecordModel;
use App\Services\HidroProjekt\Domain\WorkReport\DailyWorkReportService;
use App\Services\HidroProjekt\STG\MovementTypes;
use App\Services\HidroProjekt\STG\MovementService;
use App\Services\HidroProjekt\STG\StorageLocation;
use Illuminate\Support\Facades\Auth;

class ManualMaterialConsumptionBtn extends Component
{
    public $modalShow = FALSE;
    public $constructionSiteInfo;
    public $materialInfo;
    public $qty;
    public $row;
    public $noWdr = FALSE;

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
        $dwrObj = new DailyWorkReportService(
            constSite: $this->constructionSiteInfo->id,
        );
        if($this->noWdr){
            //create new daily work report
            $dwrObj= $dwrObj->createNewWorkReportItem(
                    remark: "Potrošnja materijala bez radne evidencije",
                    type: DailyWorkReportService::WDR_TYPE_NO_WD_REPORT
            )->createNewWorkReportLog("Potrošnja materijala bez radne evidencije");
        }
        if($dwrObj->getAllReportsForCs()->isEmpty()){
            return $this->dispatch('show-alert-modal', [
                'title' => 'ERROR!',
                'message' => "Za navedeno gradilište nema zapisa radnog dana na koji bi se material mogao utrošiti.",
                'type' => 'danger',
            ]);
        }
        //Create new consumption item
        $consumption = MaterialConsumptionModel::create([
            'wdr_id' => $dwrObj->getAllReportsForCs()->getLastReport()->id,
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
