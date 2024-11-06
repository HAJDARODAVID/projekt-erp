<?php

namespace App\Livewire\HidroProjekt\Wp;

use App\Models\ConstructionSiteModel;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\IntOrder;
use App\Models\User;

class IntOrdersTable extends DataTableComponent
{
    protected $model = IntOrder::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->sortable(),
            Column::make("Gradilište", "const_id")
                ->hideIf(TRUE),
            Column::make("Naručio", "ordered_by")
                ->hideIf(TRUE),
            Column::make("Gradilište", "const_id")
                ->label(
                    fn($row) => $this->getJobSite($row)
                ),
            Column::make("Naručio")
                ->label(
                    fn($row) => $this->getUserFullName($row)
                ),
            Column::make("Status", "status")
                ->hideIf(TRUE),
            Column::make("Status", "status")
                ->view('hidro-projekt.wp.intOrderStatusSelectBox'),
            Column::make("Napomena", "remark")
                ->sortable(),
        ];
    }

    private function getUserFullName($row){
        $userInfo = User::where('id', $row->ordered_by)->with('getWorker')->first();
        return $userInfo != NULL ? $userInfo->getWorker->fullName : NULL;
    }

    private function getJobSite($row){
        $jobSiteInfo = ConstructionSiteModel::where('id', $row->const_id)->first();
        return $jobSiteInfo != NULL ? $jobSiteInfo->name : NULL;
    }
}
