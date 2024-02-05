<?php

namespace App\Livewire\HidroProjekt\Wp;

use App\Models\ConstructionSiteModel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Filters\SelectFilter;

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
        $this->setFilter('status', '1');
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

    public function filters(): array{
    return [
        SelectFilter::make('Status', 'status')
            ->options(ConstructionSiteModel::CONSTRUCTION_STATUS)
            ->filter(function(Builder $builder, string $value) {
                $builder->where('status', $value);
            }),

        ];
    }
}
