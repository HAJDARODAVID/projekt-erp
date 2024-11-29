<?php

namespace App\Livewire\HidroProjekt\Wp;

use App\Models\MaterialDocModel;
use App\Models\MaterialMvtModel;
use App\Models\ConstructionSiteModel;
use App\Models\InternalDeliveryNoteView;
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
                    fn($row, Column $column) => MovementTypes::MVT_DESC_HR[$row->mvt_type],
                ),
            Column::make("Gradilište", 'name')
                ->sortable()
                ->searchable(),
            Column::make("Izdavatelj", "created_by")
                ->sortable(),
            Column::make("Stvoreno", "created_at")
                ->sortable(),
            Column::make("Actions",'id')
                ->view('hidro-projekt.WP.deliveryNoteTableBtn'),
        ];
    }

    public function builder(): Builder{
        return InternalDeliveryNoteView::query()
            ->whereIn('mvt_type', MovementTypes::CONST_SITE_MVT)
            ->orderBy('id', 'DESC');
    }
}
