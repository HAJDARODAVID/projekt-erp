<?php

namespace App\Livewire\Hidroprojekt\Bde;

use App\Models\ConstructionSiteModel;
use Livewire\Component;

class BdeSelectConstructionSite extends Component
{
    public $constructionSites;
    public $record;
    public $selectedConstructionSite;
    public $address;

    public function mount(){
        $this->constructionSites=ConstructionSiteModel::get();
        $this->selectedConstructionSite = $this->record->construction_site_id;
        $this->address = ConstructionSiteModel::where('id', $this->selectedConstructionSite)->first();
    }

    public function updatedSelectedConstructionSite(){
        $this->address = ConstructionSiteModel::where('id', $this->selectedConstructionSite)->first();
        $this->record->update([
            'construction_site_id' =>$this->selectedConstructionSite,
        ]);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-select-construction-site');
    }
}
