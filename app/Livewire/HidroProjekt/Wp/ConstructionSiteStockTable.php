<?php

namespace App\Livewire\HidroProjekt\Wp;

use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Column;
use App\Models\StorageStockItem;

class ConstructionSiteStockTable extends DataTableComponent
{
    protected $model = StorageStockItem::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchBlur();
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->hideIf(TRUE),
            Column::make("#mat", "mat_id")
                ->sortable()
                ->searchable(),
            Column::make("Material", "getMaterialInfo.name")
                ->sortable()
                ->searchable(),
            Column::make("Str loc", "str_loc")
                ->hideIf(TRUE),
            Column::make("Cons id", "cons_id")
                ->hideIf(TRUE),
            Column::make("Qty", "qty")
                ->sortable(),
            Column::make('Iznos[€]')
                ->label(
                    fn($row) => number_format((float)$row->cost, 2, ',', '.')
                )
                ->footer(
                    fn($rows) => '<strong>' . $this->getStockOverAllCostSum($rows) . '</strong>'
                )
                ->html(),
            Column::make("Prvo izdavanje", "created_at")
                ->sortable(),
            Column::make("Zadnja kretnja", "updated_at")
                ->sortable(),
        ];
    }

    private function getStockOverAllCostSum($rows){
        $amount = 0;
        foreach ($rows as $row) {
            $amount += $row->cost;
        }
        return number_format((float)$amount, 2, ',', '.');
    }
}
