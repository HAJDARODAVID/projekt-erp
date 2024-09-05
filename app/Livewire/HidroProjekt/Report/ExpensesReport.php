<?php

namespace App\Livewire\HidroProjekt\Report;

use App\Services\Months;
use Livewire\Component;


class ExpensesReport extends Component
{
    public $months = Months::MONTHS_HR;
    public function render()
    {
        return view('livewire.hidroprojekt.report.expenses-report');
    }
}
