<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\MaterialMasterData;
use App\Services\HidroProjekt\ADM\MainInventoryService;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class AddToInvListQrReaderModal extends Component
{
    public $showModal = FALSE;
    public $matInfo;
    public $activeInventory;

    public $invalid = FALSE;

    public $qty;

    #[On('open-qr-inventory-modal')]
    public function initializeModal($mat_id, $qr_data){
        $this->invalid = FALSE;
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
        if($this->qty == 0 || $this->qty == ""){
            return $this->invalid = TRUE;
        }
        if($this->qty != 0 || $this->qty != ""){
            $data=[];
            $data[]=[
                'mat_id' => $this->matInfo->id,
                'qty' => $this->qty,
            ];
            $service = new MainInventoryService;
            $addItems = $service->addItemsToInventoryList($data, 'main_storage', Auth::user()->id,$this->activeInventory);
            if($addItems){
                $this->showModal = FALSE;
                return $this->dispatch('show-alert-modal', [
                        'title' => 'Materijal evidentiran!',
                        'message' => "Naziv: ".$this->matInfo->name." <br>Količina: $this->qty",
                        'type' => 'success',
                    ]);
            }
        }
        

    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.add-to-inv-list-qr-reader-modal');
    }
}
