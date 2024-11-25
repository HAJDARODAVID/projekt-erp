<?php

namespace App\Livewire\Domain\Bde\MainWorkReportModules\Attendance;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\Views\WorkersOnlyViewModel;
use Livewire\Attributes\On;

class WorkersForAttendanceTable extends DataTableComponent
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
                ->hideIf(true)
                ->searchable(),
            Column::make("Prezime", "lastName")
                ->hideIf(true)
                ->searchable(),
            Column::make("Radnik")
                ->label(
                    fn($row, Column $column) => $row->firstName .' '. $row->lastName
                ),
            Column::make("", "id")
                ->view('table-actions.add-worker-to-attendance')
        ];
    }

    #[On('refresh-this')]
    public function refreshMe(){
        return;
    }
}
