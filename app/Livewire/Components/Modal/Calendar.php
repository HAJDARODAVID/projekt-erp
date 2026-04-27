<?php

namespace App\Livewire\Components\Modal;

use App\Livewire\LivewireController;

class Calendar extends LivewireController
{
    public $icon = NULL;
    public $displayIcon = TRUE;
    public function mount()
    {
        $this->openModal();
    }
    public function render()
    {
        return view('livewire.components.modal.calendar');
    }
}
