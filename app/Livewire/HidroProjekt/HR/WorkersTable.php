<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Models\WorkerModel;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;

class WorkersTable extends DataTableComponent
{
    protected $model = WorkerModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchVisibilityStatus(true);
    }

    public function columns(): array
    {
        return [
            // Column::make("Id", "id")
            //     ->sortable(),
            Column::make("Ime", "firstName")
                ->sortable()
                ->searchable(),
            Column::make("Prezime", "lastName")
                ->sortable()
                ->searchable(),
            Column::make("OIB", "oib")
                ->sortable(),
            Column::make("Radno Mjesto", "working_place")
                ->sortable(),
            Column::make("Datum zapošljavanja", "doe")
                ->sortable(),
            BooleanColumn::make('Print naljepnice', 'print_label'),
            Column::make("Komentar", "comment")

        ];
    }
}
