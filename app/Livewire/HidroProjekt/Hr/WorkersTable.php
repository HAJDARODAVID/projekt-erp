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
            Column::make("Id", "id")
                ->hideIf(true),
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
            Column::make("Istek ugovora", "ced")
                ->sortable(),
            Column::make('Print naljepnice','print_label')
                ->view('components.print-label-checkbox'),
            Column::make("Komentar", "comment")

        ];
    }
}
