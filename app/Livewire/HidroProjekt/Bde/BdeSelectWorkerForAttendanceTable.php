<?php

namespace App\Livewire\HidroProjekt\Bde;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Views\WorkersOnlyViewModel;

class BdeSelectWorkerForAttendanceTable extends DataTableComponent
{

    protected $model = WorkersOnlyViewModel::class;

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
            Column::make("Ime", "firstName")
                ->searchable(),
            Column::make("Prezime", "lastName")
                ->searchable(),
            Column::make("", "id")
                ->view('components.bde.add-worker-to-attendance')
        ];
    }
}
