<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\MaterialMasterData;
use Livewire\Component;
use Livewire\Attributes\On;

class AddToInvListQrReaderModal extends Component
{
    public $showModal = FALSE;

    #[On('open-qr-inventory-modal')]
    public function testing($mat_id){
        $mat = MaterialMasterData::where('id', $mat_id)->first();
        dd($mat);
        return $this->showModal = TRUE;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.add-to-inv-list-qr-reader-modal');
    }
}
