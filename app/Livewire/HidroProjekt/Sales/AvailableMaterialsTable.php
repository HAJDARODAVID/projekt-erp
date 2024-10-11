<?php

namespace App\Livewire\HidroProjekt\Sales;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\StorageStockItem;
use App\Services\HidroProjekt\STG\StorageLocation;
use Illuminate\Database\Eloquent\Builder;

class AvailableMaterialsTable extends DataTableComponent
{
    //protected $model = StorageStockItem::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->hideIf(TRUE),
            Column::make("#", "mat_id")
                ->sortable()
                ->searchable(),
            Column::make("Materijal", "getMaterialInfo.name")
                ->sortable()
                ->searchable(),
            Column::make("Kol.", "qty"),
            Column::make('','id')
                ->view('hidro-projekt.SALES.availableMaterialsTableActionBtn'),
        ];
    }

    public function builder(): Builder{
        return StorageStockItem::query()
            ->where('str_loc', StorageLocation::MAIN_STORAGE)
            ->where('qty', '!=', 0);
    }
}
