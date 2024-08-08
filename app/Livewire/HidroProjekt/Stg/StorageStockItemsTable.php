<?php

namespace App\Livewire\HidroProjekt\Stg;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\StorageStockItem;
use App\Services\HidroProjekt\STG\StorageLocation;
use Illuminate\Database\Eloquent\Builder;

class StorageStockItemsTable extends DataTableComponent
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
            Column::make("Mat id", "mat_id")
                ->sortable(),
            Column::make("Mat name", "getMaterialInfo.name")
                ->sortable(),
            Column::make("Str loc", "str_loc")
                ->hideIf(TRUE),
            Column::make("Cons id", "cons_id")
                ->hideIf(TRUE),
            Column::make("Qty", "qty")
                ->sortable(),
            Column::make("Vrijednost[€]")
                ->label(
                    fn($row, Column $column) => $row->cost
                )
                ->footer(function($rows) {
                    return 'Ukupno: ' . $rows->sum('cost') . '€';
                }),
            Column::make("Created at", "created_at")
                ->sortable(),
            Column::make("Updated at", "updated_at")
                ->sortable(),
        ];
    }

    public function builder(): Builder{
        return StorageStockItem::query()
            ->where('str_loc', StorageLocation::MAIN_STORAGE)
            ->where('qty', '!=', 0);
    }
}
