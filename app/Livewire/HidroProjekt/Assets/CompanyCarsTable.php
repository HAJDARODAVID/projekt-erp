<?php

namespace App\Livewire\HidroProjekt\Assets;

use App\Models\CompanyCarsModel;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class CompanyCarsTable extends DataTableComponent
{
    protected $model = CompanyCarsModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('hp_showCompanyCar', $row->car_plates);
            });
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("Car plates", "car_plates")
                ->sortable()
                ->searchable(),
            Column::make("Brand", "brand")
                ->sortable(),
            Column::make("Model", "model")
                ->sortable(),
            Column::make("Valid to", "valid_to")
                ->sortable(),
            Column::make("Id", "id")
                ->view('components.assets.company-cars-table-action-btn')
                ->unclickable(),
        ];
    }

    public function builder(): Builder{
        return CompanyCarsModel::query()
            ->where('active', '!=', -1);
    }
}
