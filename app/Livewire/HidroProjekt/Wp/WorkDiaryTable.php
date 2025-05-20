<?php

namespace App\Livewire\HidroProjekt\Wp;

use App\Models\User;
use App\Models\WorkDayDiaryViewModel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class WorkDiaryTable extends DataTableComponent
{
    //protected $model = WorkDayDiaryViewModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id')
            ->setTableRowUrl(function($row) {
                return route('hp_showWorkDayDiary', $row->id);
            });
        $this->setSearchBlur();
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
        ];
    }

    public function builder(): Builder{
        return WorkDayDiaryViewModel::query()
            ->where('construction_site_id', '!=', NULL)
            ->orderBy('date', 'desc');
    }

    public function getUserName($row){
        $user = User::where('id', $row->user_id)->with('getWorker', 'getCooperator')->first();
        if(!is_null($user->getWorker)) return $user->getWorker->fullName;
        if(!is_null($user->getCooperator)) return $user->getCooperator->fullName;
    }
}
