<?php

namespace App\Livewire\Modules\WorkdayDiary;

use App\Models\User;
use App\Models\WorkDayDiaryViewModel;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\On;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class MainTable extends DataTableComponent
{
    //protected $model = WorkDayDiaryViewModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->sortable(),
            Column::make("user_id", "user_id")
                ->hideIf(TRUE),
            Column::make("Korisnik")
                ->label(
                    fn($row, Column $column) => $this->getUserName($row)
                ),
            Column::make("Gradilište", "name")
                ->sortable(),
            Column::make("Datum", "date")
                ->sortable(),
            Column::make("Vrsta terena", "work_type")
                ->sortable(),
            Column::make("Vozilo", "car_plates")
                ->sortable(),
            Column::make("")
                ->label(
                    fn($row, Column $column) => view('components.table.table-actions', ['row' => $row, 'livewire' => 'modules.workday-diary.table-actions'])
                )->html(),
        ];
    }

    public function builder(): Builder
    {
        return WorkDayDiaryViewModel::query()
            ->where('construction_site_id', '!=', NULL)
            ->orderBy('id', 'desc');
    }

    public function getUserName($row)
    {
        $user = User::where('id', $row->user_id)->with('getWorker', 'getCooperator')->first();
        if (!is_null($user->getWorker)) return $user->getWorker->fullName;
        if (!is_null($user->getCooperator)) return $user->getCooperator->fullName;
    }

    #[On('refresh-work-diary-table')]
    public function refreshMe()
    {
        return;
    }
}
