<?php

namespace App\Livewire\HidroProjekt\Adm;

use Livewire\Component;
use Livewire\Attributes\On;

class AddToInvListQrReaderModal extends Component
{
    public $showModal = FALSE;

    #[On('open-qr-inventory-modal')]
    public function testing(){
        return $this->showModal = TRUE;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.add-to-inv-list-qr-reader-modal');
    }
}
