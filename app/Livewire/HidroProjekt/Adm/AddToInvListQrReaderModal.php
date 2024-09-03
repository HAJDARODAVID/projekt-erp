<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\MaterialMasterData;
use Livewire\Component;
use Livewire\Attributes\On;

class AddToInvListQrReaderModal extends Component
{
    public $showModal = FALSE;
    public $matInfo;

    public $qty;

    #[On('open-qr-inventory-modal')]
    public function initializeModal($mat_id, $qr_data){
        $this->matInfo = MaterialMasterData::where('id', $mat_id)->first();
        if(is_null($this->matInfo)){
            return $this->dispatch('show-alert-modal', [
                    'title' => 'Materijal: '.$qr_data.' ne postoji!',
                    'message' => "U matičnim podacima nema navedenog materijala!",
                    'type' => 'danger',
                ]);
        }
        $this->dispatch('focus-this-input');
        return $this->showModal = TRUE;
    }

    public function modalBtn($status){
        return $this->showModal = $status;
    }

    public function addItemToInventoryList(){
        //dd('testing');
        $this->dispatch('focus-this-input');
        
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.add-to-inv-list-qr-reader-modal');
    }
}
