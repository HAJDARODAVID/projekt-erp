<?php

namespace App\Livewire\HidroProjekt\Report\Config;

use App\Models\BillCategoryModel;
use App\Models\ReportConfig;
use Livewire\Component;
use Livewire\Attributes\On;

class ExpensesByGroupedCategoriesConfigModal extends Component
{
    public $show=FALSE;
    public $configData;
    public $billCat;
    public $groups = [];
    public $selectedGroup=NULL;

    public $newGroupName=NULL;

    public $error=[];

    public function modalBtn($status){
        return $this->show = $status;
    }

    #[On('open-expenses-by-grouped-categories-config-modal')]
    public function openModal(){
        $array=explode('.', $this->__name);
        $report_name = trim($array[3],'-config-modal');
        $this->configData = $this->getReportConfigData($report_name);
        $this->billCat = $this->getAllCategories();
        $this->getAllGroupFromConfig();
        return $this->show=TRUE;
    }

    private function getReportConfigData($report_name){
        $configData = ReportConfig::where('r_name', $report_name)->first();
        if(is_null($configData)){
            return ReportConfig::create([
                'r_name' => $report_name,
            ]);
        }
        $configData = ReportConfig::where('r_name', $report_name)->first();
        return $configData;
    }

    public function saveNewGroup(){
        $this->error=[];
        if($this->newGroupName != NULL || $this->newGroupName != ""){
            $this->newGroupName = strtoupper($this->newGroupName);
            foreach ($this->groups as $groupName => $groupData) {
                if(strtoupper($this->newGroupName) == strtoupper($groupName)){
                    $this->error['message']='Grupa '. $this->newGroupName . ' već postoji!';
                    return $this->newGroupName = NULL;
                }
            }
            $this->groups[$this->newGroupName]=[];
            $jsonData['groups'] = $this->groups;
            $this->configData->update([
                'value_1' => json_encode($jsonData),
            ]);
            return $this->newGroupName=NULL;
        }
    }

    private function getAllCategories(){
        return BillCategoryModel::pluck('category', 'id')->all();
    }

    private function getAllGroupFromConfig(){
        $jsonGroupData= $this->configData->value_1;
        if(is_null(($jsonGroupData))){
            return;
        }
        $jsonGroups = json_decode($jsonGroupData, true);
       return $this->groups = $jsonGroups['groups'];
    }

    public function setSelectedGroup($group){
        $this->selectedGroup = $group;
    }

    

    public function render()
    {
        return view('livewire.hidroprojekt.report.config.expenses-by-grouped-categories-config-modal');
    }
}
