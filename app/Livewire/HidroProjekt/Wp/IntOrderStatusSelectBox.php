<?php

namespace App\Livewire\HidroProjekt\Wp;

use App\Models\IntOrder;
use Livewire\Component;

class IntOrderStatusSelectBox extends Component
{
    public $statuses = IntOrder::STATUS_TYPES;   
    public function render()
    {
        return view('livewire.hidroprojekt.wp.int-order-status-select-box');
    }
}
