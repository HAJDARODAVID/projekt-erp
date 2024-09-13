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
    public $groupOrder = [];
    public $selectedGroup=NULL;
    public $newGroupName=NULL;
    public $error=[];

    public $edit=[];

    public $categories =[];
    public $selectedCategories = [];

    public function modalBtn($status){
        if($status==0){
            $this->selectedGroup=NULL;
            $this->error=NULL;
            $this->show = $status;
            return $this->dispatch('refresh-expenses-report');
        }
        return $this->show = $status;
    }

    #[On('open-expenses-by-grouped-categories-config-modal')]
    public function openModal(){
        $array=explode('.', $this->__name);
        $report_name = trim($array[3],'-config-modal');
        $this->configData = $this->getReportConfigData($report_name);
        $this->billCat = $this->getAllCategories();
        $this->getAllGroupFromConfig();
        $this->setGroupOrder();
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
        $this->configData->fresh();
        $jsonGroupData= $this->configData->value_1;
        if(is_null(($jsonGroupData))){
            return;
        }
        $jsonGroups = json_decode($jsonGroupData, true);
       return $this->groups = $jsonGroups['groups'];
    }

    public function setSelectedGroup($group){
        $this->selectedGroup = $group;
        $this->setCategories();
    }

    public function updatedSelectedCategories($key, $value){
        //key == TRUE or FALSE | value == array key
        if(!$key && isset($this->selectedCategories[$value])){
            unset($this->selectedCategories[$value]);
        }

        //save new json
        $json_array = json_decode($this->configData->value_1,true);
        $json_array['groups'][$this->selectedGroup] = $this->selectedCategories;
        $this->configData->update([
            'value_1' => json_encode($json_array),
        ]);
        return $this->getAllGroupFromConfig();
    }

    public function setCategories(){
        if(!$this->selectedGroup){
            return;
        }
        $this->selectedCategories=[];
        foreach ($this->billCat as $key => $value) {
            $id=$key*1;
            $this->categories[$id] = NULL;
            $this->categories[$id]['name'] = $value; 
        }
        
        foreach ($this->groups as $g_name => $g_data) {
            if($g_name == $this->selectedGroup){
                $this->selectedCategories = $g_data;
            }
            if($g_name != $this->selectedGroup){
                foreach ($g_data as $catId => $value) {
                    $this->categories[$catId]['disabled'] = TRUE;
                }
            }
        }
    }

    public function enableEdit($gName){
        if(isset($this->edit['oldValue'])){
            if($this->edit['oldValue'] == $gName){
                return $this->edit=[];
            }
        }
        
        return $this->edit['oldValue'] = $this->edit['newValue']= $gName;
    }

    public function updatedEditNewValue($key, $value){
        $json_array = json_decode($this->configData->value_1,true);
        $json_array['groups'][$this->selectedGroup] = $this->selectedCategories;
        $json_array['groups'][$key] = $json_array['groups'][$this->edit['oldValue']];
        unset($json_array['groups'][$this->edit['oldValue']]);
        $this->configData->update([
            'value_1' => json_encode($json_array),
        ]);
        $this->selectedGroup=$key;
        $this->edit=[];
        return $this->getAllGroupFromConfig();
    }

    public function deleteGroup($gName){
        $json_array = json_decode($this->configData->value_1,true);
        unset($json_array['groups'][$gName]);
        $this->configData->update([
            'value_1' => json_encode($json_array),
        ]);
        $this->selectedGroup=NULL;
        return $this->getAllGroupFromConfig();
    }

    private function setGroupOrder(){
        $groupOrder=[];
        $json_array = json_decode($this->configData->value_1,true);
        if(!isset($json_array['group_order'])){
            $json_array['group_order']=[];
            $this->configData->update([
                'value_1' => json_encode($json_array),
            ]);
        }
        if(empty($json_array['group_order'])){
            foreach($this->group as $g_name => $g_data){
                $groupOrder[] = $g_name;
                $json_array['group_order'] = $groupOrder;
                $this->configData->update([
                    'value_1' => json_encode($json_array),
                ]);
            }
        }else{
            $groupOrder = $json_array['group_order'];
        }
        dd();
    }
    

    public function render()
    {
        return view('livewire.hidroprojekt.report.config.expenses-by-grouped-categories-config-modal');
    }
}
