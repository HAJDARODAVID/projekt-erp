<?php

namespace App\Livewire\HidroProjekt\Hr;

use App\Models\User;
use App\Models\AttendanceModel;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class WorkerAttendanceTable extends DataTableComponent
{
    public $worker_id;
    //protected $model = AttendanceModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->hideIf(Auth::user()->type != User::USER_TYPE_SUPER_ADMIN),
            Column::make("Datum", "date")
                ->sortable(),
            Column::make("Gradilište", "getWDRInfo.getConstructionSite.name")
                ->sortable(),
            Column::make("Vrsta terena", "type")
                ->label(
                    fn($row, Column $column) => view('components.hr.worker-change-type')->withRow($row)
                ),
            Column::make('Radni sati')
                ->label(
                    fn($row, Column $column) => view('components.hr.worker-attendance-work-hours')->withRow($row)
                ),
            Column::make('Odsutan')
                ->label(
                    fn($row, Column $column) => view('components.hr.worker-attendance-absence-reason')->withRow($row)
                ),
            Column::make('')
                ->label(
                    fn($row, Column $column) => view('components.hr.worker-attendance-action-btn')->withRow($row)
                ),

            Column::make("absence_reason", "absence_reason")
                ->hideIf(true),
            Column::make("Radni sati", "work_hours")
                ->hideIf(true),
            Column::make("Vrsta terena", "type")
                ->hideIf(true),
        ];
    }

    public function builder(): Builder{
        return AttendanceModel::query()
            ->where('worker_id', '=', $this->worker_id)
            ->orderBy('date', 'desc');
    }
}
