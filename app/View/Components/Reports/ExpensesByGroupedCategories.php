<?php

namespace App\View\Components\Reports;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ExpensesByGroupedCategories extends Component
{
    public $data;
    public $months;
    public $reportData;
    /**
     * Create a new component instance.
     */
    public function __construct($data)
    {
        extract($data, EXTR_REFS);
        foreach ($data as $key => $value) {
          $this->$key = $$key;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.reports.expenses-by-grouped-categories');
    }
}
