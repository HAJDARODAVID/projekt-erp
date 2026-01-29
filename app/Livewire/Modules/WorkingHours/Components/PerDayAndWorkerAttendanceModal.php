<?php

namespace App\Livewire\Modules\WorkingHours\Components;

use Livewire\Attributes\On;
use App\Livewire\LivewireController;

class PerDayAndWorkerAttendanceModal extends LivewireController
{

    #[On('open-per-day-and-worker-attendance-modal')]
    public function initializeModal($date, $workers)
    {
        try {

            $this->openModal();
        } catch (\Throwable $th) {
            return $this->dispatch('show-exception-modal', $th->getMessage());
        }
    }
    public function render()
    {
        return view('livewire.modules.working-hours.components.per-day-and-worker-attendance-modal');
    }
}
