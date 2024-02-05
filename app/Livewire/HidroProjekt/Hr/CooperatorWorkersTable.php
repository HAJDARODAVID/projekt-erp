<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Models\CooperatorWorkersModel;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class CooperatorWorkersTable extends DataTableComponent
{
    public $cooperatorId;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("Cooperator id", "cooperator_id")
                ->hideIf(true),
            Column::make("Ime", "firstName")
                ->sortable(),
            Column::make("Prezime", "lastName")
                ->sortable(),
            Column::make('Actions')
                ->label(
                    fn($row, Column $column) => view('components.hr.cooperators-worker-actions')->withRow($row)
                ),
        ];
    }

    public function builder(): Builder{
        return CooperatorWorkersModel::query()
            ->where('cooperator_id','=', $this->cooperatorId)
            ->where('status', '=', 1);
    }
}
