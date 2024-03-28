<?php

namespace App\Livewire\HidroProjekt\Stg;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\StorageStockItem;

class StorageStockItemsTable extends DataTableComponent
{
    protected $model = StorageStockItem::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("#", "id")
                ->hideIf(TRUE),
            Column::make("Mat id", "mat_id")
                ->sortable(),
            Column::make("Str loc", "str_loc")
                ->sortable(),
            Column::make("Cons id", "cons_id")
                ->sortable(),
            Column::make("Qty", "qty")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }
}
