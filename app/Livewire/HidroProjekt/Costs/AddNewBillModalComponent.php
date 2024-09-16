<?php

namespace App\Livewire\HidroProjekt\Costs;

use Livewire\Component;
use App\Models\BillModel;
use App\Models\BillCategoryModel;
use App\Models\BillProviderModel;
use App\Services\ActionLogsService;
use Illuminate\Support\Facades\Auth;

class AddNewBillModalComponent extends Component
{
    public $show = FALSE;
    public $showSuccessCard = FALSE;
    public $data=[];
    public $error=[];
    public $providers=[];
    public $categories=[];
    public $edit=FALSE;
    public $bill=NULL;

    public function saveNewBill(){
        //reset errors
        $this->error = [];
        //validation check
        if($this->validateData()){
            return;
        }
        if ($this->bill) {
            $this->bill->update($this->data);
        } else {
            BillModel::create($this->data);
        }
        $this->refreshTargetTable();
        $this->showSuccessCard = TRUE;
        $this->data=[];
        if ($this->bill) {
            $this->show=FALSE;
        }
    }

    private function refreshTargetTable(){
        return $this->dispatch('refresh-bills-table');
    }

    public function deleteRow(){
        $oldBill = $this->bill;
        $deleteState=$this->bill->delete();
        if($deleteState){
            $log = ActionLogsService::execute([
                'action' => 'delete_bill',
                'user'   => Auth::user()->id,
                'data'   => $oldBill->toArray(),
            ]);
            if(isset($log['error'])){
                $this->dispatch('show-alert-modal',[
                    'message' => $log['message'],
                    'title'   => 'ERROR',
                    'type'    => 'danger'
                ]);
                return;
            }
            $this->refreshTargetTable(); 
        }
    }

    public function trashItAll(){
        return $this->resetAll();
    }

    public function updatedData($key, $value){
        //reset success card
        $this->showSuccessCard = FALSE;
    }

    public function modalBtn($status){
        if($status){
            $this->setProvidersAndCategories();
        }
        $this->resetAll();
        $this->data['inc_pdv'] = TRUE;
        if($this->edit){
            $this->data=$this->bill->toArray();
        }
        return $this->show = $status ? TRUE : FALSE;
    }

    private function validateData(){
        if(!isset($this->data['provider_id'])) $this->error['provider_id'] = TRUE;
        if(isset($this->data['provider_id'])){
            if($this->data['provider_id'] == 0 || $this->data['provider_id'] == ""){
                $this->error['provider_id'] = TRUE;
            }
        }
        if(!isset($this->data['categories_id'])) $this->error['categories_id'] = TRUE;
        if(isset($this->data['categories_id'])){
            if($this->data['categories_id'] == 0 || $this->data['categories_id'] == ""){
                $this->error['categories_id'] = TRUE;
            }
        }

        if(!isset($this->data['amount'])) $this->error['amount'] = TRUE;
        if(isset($this->data['amount'])){
            if($this->data['amount'] == 0 || $this->data['amount'] == ""){
                $this->error['amount'] = TRUE;
            }
        }

        if(!isset($this->data['date'])) $this->error['date'] = TRUE;
        if(isset($this->data['date'])){
            if($this->data['date'] == 0 || $this->data['date'] == ""){
                $this->error['date'] = TRUE;
            }
        }

        return count($this->error);
    }

    private function resetAll():void{
        $this->showSuccessCard = FALSE;
        $this->data=[];
        $this->error=[];
        return;
    }

    private function setProvidersAndCategories(){
        $this->providers = BillProviderModel::get();
        $this->categories = BillCategoryModel::get();
        return;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.costs.add-new-bill-modal-component');
    }
}
