<?php

namespace App\Livewire\HidroProjekt\Wp;

use Jenssegers\Agent\Facades\Agent;
use Illuminate\Database\Eloquent\Builder;
use App\Models\ConstructionSiteConsumptionModel;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class ConstructionSiteConsumptionTable extends DataTableComponent
{
    public $constSiteId = NULL;
    public $wdrId = NULL;

    protected $model = ConstructionSiteConsumptionModel::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setSearchBlur();

        if($this->wdrId){
            $this->setSearchStatus(false);
            $this->setPerPageAccepted([5,10]);
        }
    }

    public function columns(): array
    {
        return [
            Column::make("const_site_id", "const_site_id")
                ->hideIf(TRUE),
            Column::make("wdr_id", "wdr_id")
                ->hideIf(TRUE),
            Column::make("#", "mat_id")
                ->sortable()
                ->searchable()
                ->hideIf(Agent::isPhone()),
            Column::make("Materijal", "name")
                ->sortable()
                ->searchable(),
            Column::make("Kol", "qty")
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
                ->sortable()
                ->hideIf($this->wdrId),   
        ];
    }

    public function builder(): Builder{
        $query = ConstructionSiteConsumptionModel::query();
        if($this->constSiteId){
            $query->where('const_site_id', $this->constSiteId);
        }
        if($this->wdrId){
            $query->where('wdr_id', $this->wdrId);
        }
            
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
