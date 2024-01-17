<?php

namespace App\Livewire\HidroProjekt\Bde;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\WorkersOnlyViewModel;

class BdeSelectWorkerForAttendanceTable extends DataTableComponent
{
    protected $model = WorkersOnlyViewModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(true),
            Column::make("Name at", "firstName")
                ->searchable(),
            Column::make("Last name", "lastName")
                ->searchable(),
        ];
    }
}
