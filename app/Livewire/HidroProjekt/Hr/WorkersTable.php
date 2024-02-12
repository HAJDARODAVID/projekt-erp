<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Models\WorkerModel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\BooleanColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class WorkersTable extends DataTableComponent
{
    //protected $model = WorkerModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
        ->setTableRowUrl(function($row) {
            return route('hp_showWorker', $row->id);
            });
        $this->setSearchVisibilityStatus(true);
        $this->setSearchBlur();
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
                ->sortable(),
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
            Column::make('Radnik','is_worker')
                ->view('components.is-worker-checkbox'),

            // Column::make('Actions')
            //     ->label(
            //         fn($row, Column $column) => view('components.worker-table-action-btn')->withRow($row)
            //     )
            //     ->unclickable(),

        ];
    }

    public function builder(): Builder{
        return WorkerModel::query()
            ->where('status', '!=', -1);
    }
}
