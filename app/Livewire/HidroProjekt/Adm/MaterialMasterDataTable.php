<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\MaterialMasterData;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class MaterialMasterDataTable extends DataTableComponent
{
    protected $model = MaterialMasterData::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchBlur();
        $this->setTableRowUrl(function($row) {
            return route('hp_showMaterial', $row->id);
        });
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->sortable(),
            Column::make("Naziv materijala", "name")
                ->sortable()
                ->searchable(),
            Column::make("Proizvođač", "oem")
                ->sortable(),
            Column::make("Dobavljač", "getSupplier.name")
                ->sortable(),
            Column::make("Mjerna jedinica", "uom_1")
                ->sortable(),
            Column::make("Cijena", "price")
                ->sortable(),
        ];
    }

    public function builder(): Builder{
        return MaterialMasterData::query()
            ->where('active', TRUE);
    }
}
