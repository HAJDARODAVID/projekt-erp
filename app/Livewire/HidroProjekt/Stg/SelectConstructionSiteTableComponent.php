<?php

namespace App\Livewire\HidroProjekt\Stg;

use App\Models\ConstructionSiteModel;
use App\Models\StorageStockItem;
use App\Services\HidroProjekt\STG\StorageLocation;
use Livewire\Component;

class SelectConstructionSiteTableComponent extends Component
{
    public $constSite = '*';
    public $allConstSites;

    public function mount(){
        $this->allConstSites = $this->getAllConstructionSitesWithStock();
    }

    public function updatedConstSite($key,$value){
        $this->dispatch('refreshConstructionSiteStockTable',$key);
    }

    private function getAllConstructionSitesWithStock(){
        $constSites = StorageStockItem::all()
            ->where('cons_id', '!=', NULL)
            ->groupBy('cons_id')            
            ->toArray();
        $constSites = array_keys($constSites);
        $constSitesObj = ConstructionSiteModel::whereIn('id', $constSites)
        ->pluck('name','id')
        ->toArray();
        return $constSitesObj;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.stg.select-construction-site-table-component');
    }
}
