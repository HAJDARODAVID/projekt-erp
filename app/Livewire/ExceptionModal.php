<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\Attributes\On;

class ExceptionModal extends Component
{
    public $error = NULL;
    public $showModal = FALSE;

    #[On('show-exception-modal')]
    public function openErrorModal($e=NULL):void{
        $this->showModal=TRUE;
        $this->error = $e;
        return;
    }

    public function closeModal(){
        $this->showModal=FALSE;
        $this->error = NULL;
    }

    public function render()
    {
        return view('livewire.exception-modal');
    }
}
