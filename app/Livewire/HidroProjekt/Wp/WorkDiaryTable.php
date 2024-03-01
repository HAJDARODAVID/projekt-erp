<?php

namespace App\Livewire\HidroProjekt\Wp;

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
            Column::make("Ime", "firstName")
                ->sortable()
                ->searchable(),
            Column::make("Prezime", "lastName")
                ->sortable()
                ->searchable(),
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
}
