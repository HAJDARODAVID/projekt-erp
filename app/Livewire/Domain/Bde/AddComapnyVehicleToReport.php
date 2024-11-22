<?php

namespace App\Livewire\Domain\Bde;

use App\Services\HidroProjekt\Domain\CompanyFleet\CompanyVanService;
use Livewire\Component;

class AddComapnyVehicleToReport extends Component
{
    public $dailyWorkReport;
    public $cars;
    public $wdr;

    public $mileages = [
        'start_mileage' => NULL,
        'end_mileage' => NULL,
    ];

    public $saveStatus=[]; 

    public function mount(){
        $this->dailyWorkReportToArray()->setCars()->setStartMileage()->setEndMileage();
        //dd($this);
    }

    private function setCars(){
        $service = new CompanyVanService();
        $this->cars = $service->getAllActiveCompanyVans();
        return $this;
    }

    private function dailyWorkReportToArray(){
        $this->wdr = $this->dailyWorkReport->toArray();
        return $this;
    }

    private function setStartMileage(){
        if($this->wdr['car_id']){
            $service = new CompanyVanService($this->wdr['car_id']);
            if($service->hasMilageReport($this->wdr['id'])){
                $this->mileages['start_mileage'] = $service->getMilageReport()->start_mileage;
            }else{
                $this->mileages['start_mileage'] = $service->getLastMileage();
            }
        }
        return $this;
    }

    private function setEndMileage(){
        if($this->wdr['car_id']){
            $service = new CompanyVanService($this->wdr['car_id']);
            $endMileage = $service->getMileageForWorkReport($this->wdr['id']);
            if(is_null($endMileage)){
                return $this;
            }
            if($endMileage){
                $this->mileages['end_mileage'] = $endMileage->end_mileage;
            }
        }
        return $this;
    }

    public function updatedWdr($key, $value){
        /**
         * $key = value
         * $value = key
         */
        $this->reset('saveStatus'); 
        $oldCarId = $this->dailyWorkReport->car_id;
        //If selected is NULL or empty remove from working_day_record table, and car mileage table
        if($key == 'NULL' || $key == ''){
            $this->dailyWorkReport->update([
                $value => NULL,
            ]);
            $this->dailyWorkReport->refresh();
            $this->dailyWorkReportToArray();
            if(!is_null($oldCarId)){
                $service = new CompanyVanService($oldCarId);
                if($service->hasMilageReport($this->wdr['id'])){
                    $service->getMilageReport()->delete();
                }
            }
            $this->mileages = [
                'start_mileage' => NULL,
                'end_mileage' => NULL,
            ];
            return;
        }
        $this->dailyWorkReport->update([
            $value => $key,
        ]);
        $this->dailyWorkReport->refresh();
        $this->dailyWorkReportToArray();
        if(!is_null($oldCarId)){
            $service = new CompanyVanService($oldCarId);
            if($service->hasMilageReport($this->wdr['id'])){
                $service->getMilageReport()->delete();
            }
        }
        $this->mileages['end_mileage'] = NULL;
        $this->saveStatus = [$value => 'true'];
        $this->setStartMileage();
    }

    public function updatedMileages($key, $value){
        /**
         * $key = value
         * $value = key
         */
        $this->reset('saveStatus'); 
        $service = new CompanyVanService($this->wdr['car_id']);

        if($service->hasMilageReport($this->wdr['id'])){
            $service->getMilageReport()->update([
                $value => $key,
            ]);
        }else{
            $newReport = $service->createNewMilageReport($this->wdr['id'], $this->mileages['start_mileage']);
            $newReport->update([
                $value => $key,
            ]);
        }
        $this->saveStatus = [$value => 'true'];
    }

    public function render()
    {
        return view('livewire.domain.bde.add-comapny-vehicle-to-report');
    }
}
