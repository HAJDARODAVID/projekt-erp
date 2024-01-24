<?php

namespace App\Livewire\HidroProjekt\Wp;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\ConstructionSiteModel;

class ConstructionSitesTable extends DataTableComponent
{
    protected $model = ConstructionSiteModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setTableRowUrl(function($row) {
            return route('hp_showConstructionSite', $row->id);
        });
        $this->setSearchBlur();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Street", "street")
                ->sortable(),
            Column::make("Town", "town")
                ->sortable(),
            Column::make("Start date", "start_date")
                ->sortable(),
            Column::make("End date", "end_date")
                ->sortable(),
            Column::make("Job description", "job_description")
                ->sortable(),
            Column::make("Status", "status")
                ->sortable(),
        ];
    }
}
