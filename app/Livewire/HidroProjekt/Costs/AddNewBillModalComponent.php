<?php

namespace App\Livewire\HidroProjekt\Costs;

use Livewire\Component;

class AddNewBillModalComponent extends Component
{
    public $show = TRUE;
    public $showSuccessCard = FALSE;

    public $data=[];

    public $error=[];

    public function saveNewBill(){
        //reset errors
        $this->error = [];
        //validation check
        if($this->validateData()){
            return;
        }
        $this->showSuccessCard = TRUE;
        $this->data=[];
    }

    public function trashItAll(){
        return $this->resetAll();
    }

    public function updatedData($key, $value){
        //reset success card
        $this->showSuccessCard = FALSE;
    }

    public function modalBtn($status){
        $this->resetAll();
        return $this->show = $status ? TRUE : FALSE;
    }

    private function validateData(){
        if(!isset($this->data['provider'])) $this->error['provider'] = TRUE;
        if(isset($this->data['provider'])){
            if($this->data['provider'] == 0 || $this->data['provider'] == ""){
                $this->error['provider'] = TRUE;
            }
        }
        if(!isset($this->data['category'])) $this->error['category'] = TRUE;
        if(isset($this->data['category'])){
            if($this->data['category'] == 0 || $this->data['category'] == ""){
                $this->error['category'] = TRUE;
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

    public function render()
    {
        return view('livewire.hidroprojekt.costs.add-new-bill-modal-component');
    }
}
