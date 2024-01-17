<?php

namespace App\Livewire\HidroProjekt\Assets;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\CompanyCarsModel;

class CompanyCarsTable extends DataTableComponent
{
    protected $model = CompanyCarsModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
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
        ];
    }
}
