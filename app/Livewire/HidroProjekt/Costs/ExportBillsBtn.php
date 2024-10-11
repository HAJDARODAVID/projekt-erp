<?php

namespace App\Livewire\HidroProjekt\Costs;

use Livewire\Component;
use App\Services\Months;
use App\Exports\Domain\Expenses\ExpensesByMonthExport;

class ExportBillsBtn extends Component
{
    public $show=FALSE;
    public $months = Months::MONTHS_HR;

    public $month;

    public function mount(){
        $this->month = date('m');
    }

    public function exportReport(){
        $this->show = FALSE;
        return (new ExpensesByMonthExport($this->month))->download($this->month.'mj - troškovi.xlsx');
    }   

    public function toggleModal(){
        return $this->show = $this->show == FALSE ? TRUE : FALSE; 
    }

    public function render()
    {
        return view('livewire.hidro-projekt.costs.export-bills-btn');
    }
}
