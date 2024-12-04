<?php

namespace App\Livewire\Domain\Bde;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Illuminate\Database\Eloquent\Builder;
use App\Models\WorkingDayRecordModel;

class MyReportsTable extends DataTableComponent
{
    //protected $model = WorkingDayRecordModel::class;
    public $user;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchVisibilityStatus(false);
        $this->setPerPageVisibilityStatus(false);
        $this->setTableRowUrl(function($row) {
                return route('showBdeWorkReport', $row->id);
            });
       
    }

    public function columns(): array
    {
        return [
            Column::make('#', 'id')
                ->hideIf(true),
            Column::make("Datum", "date")
                ->sortable(),
            Column::make("Gradilište", "getConstructionSite.name")
                ->sortable(),
        ];
    }

    public function builder(): Builder{
        return WorkingDayRecordModel::query()
            ->where('user_id', $this->user)
            ->orderBy('date', 'desc');
    }
}
