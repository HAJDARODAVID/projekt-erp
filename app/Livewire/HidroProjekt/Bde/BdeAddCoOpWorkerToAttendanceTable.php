<?php

namespace App\Livewire\HidroProjekt\Bde;

use App\Models\CooperatorsModel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class BdeAddCoOpWorkerToAttendanceTable extends DataTableComponent
{
    //protected $model = CooperatorsModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setPerPageAccepted([5]);
        $this->setPerPage(5);
        $this->setPerPageVisibilityDisabled();
        $this->setColumnSelectDisabled();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("Name", "name")
                ->searchable(),
            Column::make('')
                ->label(
                    fn($row, Column $column) => view('components.bde.add-co-op-to-attendance-comp')->withRow($row)
                ),
        ];
    }

    public function builder(): Builder{
        return CooperatorsModel::query()
            ->where('status', '=', 1);
    }
}

/**
 * bde-add-co-op-worker-to-attendance-table
 */
