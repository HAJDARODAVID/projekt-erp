<?php

namespace App\Livewire\Modules\ReaperErp;

use App\Livewire\LivewireController;
use Livewire\Attributes\Url;

class MonthlyInstallments extends LivewireController
{
    #[Url('installement')]
    public $selectedInstallment = NULL;
    public function render()
    {
        return view('livewire.modules.reaper-erp.monthly-installments');
    }
}
