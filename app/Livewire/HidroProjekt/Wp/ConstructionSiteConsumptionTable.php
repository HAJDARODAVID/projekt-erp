<?php

namespace App\Livewire\HidroProjekt\Wp;

use Illuminate\Database\Eloquent\Builder;
use App\Models\ConstructionSiteConsumptionModel;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class ConstructionSiteConsumptionTable extends DataTableComponent
{
    public $constSiteId;

    protected $model = ConstructionSiteConsumptionModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchBlur();
    }

    public function columns(): array
    {
        return [
            Column::make("const_site_id", "const_site_id")
                ->hideIf(TRUE),
            Column::make("#mat", "mat_id")
                ->sortable()
                ->searchable(),
            Column::make("Material", "name")
                ->sortable()
                ->searchable(),
            Column::make("Qty", "qty")
                ->sortable(),
            Column::make("UOM", "uom_1")
                ->sortable(),
            Column::make("Iznos[€]")
                ->label(
                    fn($row) => number_format((float)$row->cost, 2, ',', '.')
                )
                ->footer(
                    fn($rows) => '<strong>' . $this->getStockOverAllCostSum($rows) . '</strong>'
                )
                ->html(),
            Column::make("Datum potrošnje", "consumption_date")
                ->sortable(),   
        ];
    }

    public function builder(): Builder{
        $query = ConstructionSiteConsumptionModel::query()
            ->where('const_site_id', $this->constSiteId);
        return $query;
    }

    private function getStockOverAllCostSum($rows){
        $amount = 0;
        foreach ($rows as $row) {
            $amount += $row->cost;
        }
        return number_format((float)$amount, 2, ',', '.');
    }
}
