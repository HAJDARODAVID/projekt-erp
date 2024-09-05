<?php

namespace App\Livewire\HidroProjekt\Costs;

use App\Models\BillProviderModel;
use Livewire\Component;

class AddNewProviderModal extends Component
{
    public $show = FALSE;
    public $showSuccessCard = FALSE;
    public $provider = NULL;
    public $error = [];


    public function modalBtn($status){
        $this->resetAll();
        return $this->show = $status ? TRUE : FALSE;
    }

    public function saveProvider(){
        $this->error = [];
        $this->showSuccessCard = FALSE;
        if($this->provider != NULL || $this->provider != ""){
            $hasEntry = BillProviderModel::where('provider', $this->provider)->first();
            if($hasEntry){
                return $this->error['message'] = 'Poslužitelj: '. $this->provider . ' postoji u tablici!';
            }
            BillProviderModel::create([
                'provider' => $this->provider,
            ]);
            $this->dispatch('refresh-bill-provider-table');
            $this->provider = NULL;
            return $this->showSuccessCard = TRUE;
        }
        return $this->error['message'] = 'Molim upišite naziv poslužitelja';
    }
    private function resetAll():void{
        $this->showSuccessCard = FALSE;
        $this->provider=[];
        $this->error=[];
        return;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.costs.add-new-provider-modal');
    }
}
