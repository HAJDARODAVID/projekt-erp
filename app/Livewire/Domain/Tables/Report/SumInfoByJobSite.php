<?php

namespace App\Livewire\Domain\Tables\Report;

use Livewire\Component;
use Livewire\Attributes\Url;
use App\Services\HidroProjekt\Domain\Reports\SumByJobSiteService;
use App\Services\HidroProjekt\Domain\Reports\Tables\Column;

class SumInfoByJobSite extends Component
{
    public $data;
    public $columns;

    #[Url(as: 'search')]
    public $search;

    public function mount(){
        $service = new SumByJobSiteService();
        $this->data = $service->execute();
        $this->columns = json_encode($this->makeColumns());
        //dd($this->columns);
    }

    private function makeColumns(){
        return [
            Column::make('Gradilište', 'name'),
            Column::make('Zalihe na stanju', 'on_stock'),
            Column::make('Potrošnja', 'consumption'),
            Column::make('Radni sati[H-P]', 'work_hours_h'),
            Column::make('Radni sati[CoOp]', 'work_hours_c'),
        ];
    }

    public function render()
    {
        return view('livewire.domain.tables.report.sum-info-by-job-site');
    }
}
