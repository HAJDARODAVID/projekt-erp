<?php

namespace App\Livewire\HidroProjekt\Bde;

use Illuminate\Support\Facades\Auth;
use App\Models\WorkingDayRecordModel;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class BdeMyEntriesTable extends DataTableComponent
{
    //protected $model = WorkingDayRecordModel::class;

    public $user;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchVisibilityStatus(false);
        $this->setPerPageVisibilityStatus(false);
        $this->setColumnSelectDisabled();
        $this->setTableRowUrl(function($row) {
            return route('hp_workingDayEntry', $row->id);
            });
       
    }

    public function columns(): array
    {
        return [
            Column::make('ID', 'id')
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
