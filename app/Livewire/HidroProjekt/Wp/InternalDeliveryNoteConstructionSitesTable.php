<?php

namespace App\Livewire\HidroProjekt\Wp;

use App\Models\MaterialDocModel;
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
            Column::make("Izdavatelj", "getUserInfo.name")
                ->sortable(),
            Column::make("Stvoreno", "created_at")
                ->sortable(),
            Column::make("Ažurirano", "updated_at")
                ->sortable(),
            Column::make("Actions",'id')
                ->view('hidroprojekt.wp.deliveryNoteTableBtn'),
        ];
    }

    public function builder(): Builder{
        return MaterialDocModel::query()
            ->whereIn('mvt_type', MovementTypes::CONST_SITE_MVT);
    }
}
