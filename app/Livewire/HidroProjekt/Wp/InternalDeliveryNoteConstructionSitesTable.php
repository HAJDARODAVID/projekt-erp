<?php

namespace App\Livewire\HidroProjekt\Wp;

use App\Models\ConstructionSiteModel;
use App\Models\MaterialDocModel;
use App\Models\MaterialMvtModel;
use Illuminate\Database\Eloquent\Builder;
use App\Services\HidroProjekt\STG\MovementTypes;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class InternalDeliveryNoteConstructionSitesTable extends DataTableComponent
{
    //protected $model = MaterialDocModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->sortable(),
            Column::make("Vrsta knjiženja",'mvt_type')
                ->hideIf(TRUE),
            Column::make("Vrsta knjiženja")
                ->label(
                    fn($row, Column $column) => $row->fullName
                ),
            Column::make("Gradilište")
                ->label(
                    fn($row, Column $column) => $this->getConstructionSite($row)
                ),
            Column::make("Izdavatelj", "getUserInfo.name")
                ->sortable(),
            Column::make("Stvoreno", "created_at")
                ->sortable(),
            Column::make("Ažurirano", "updated_at")
                ->hideIf(TRUE),
            Column::make("Actions",'id')
                ->view('hidro-projekt.WP.deliveryNoteTableBtn'),
        ];
    }

    private function getConstructionSite($row){
        $constSite = MaterialMvtModel::where('mat_doc_id', $row->id)->where('const_id', '!=', NULL)->pluck('const_id')->toArray();
        if(empty($constSite)){
            dd('imam');
        }
        $constSiteInfo = ConstructionSiteModel::where('id',$constSite[0])->first();
        return $constSiteInfo->name;
    }

    public function builder(): Builder{
        return MaterialDocModel::query()
            ->whereIn('mvt_type', MovementTypes::CONST_SITE_MVT)
            ->orderBy('id', 'DESC');
    }
}
