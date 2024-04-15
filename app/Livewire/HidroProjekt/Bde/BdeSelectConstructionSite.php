<?php

namespace App\Livewire\HidroProjekt\Bde;

use App\Models\ConstructionSiteModel;
use Livewire\Component;

class BdeSelectConstructionSite extends Component
{
    public $constructionSites;
    public $record;
    public $selectedConstructionSite;
    public $address;

    public function mount(){
        $this->constructionSites=ConstructionSiteModel::where('status', ConstructionSiteModel::CONSTRUCTION_STATUS_ACTIVE)->get();
        $this->selectedConstructionSite = $this->record->construction_site_id;
        $this->address = ConstructionSiteModel::where('id', $this->selectedConstructionSite)->first();
    }

    public function updatedSelectedConstructionSite(){
        $this->address = ConstructionSiteModel::where('id', $this->selectedConstructionSite)->first();
        if($this->selectedConstructionSite==0){
            $this->selectedConstructionSite=NULL;
            $this->record->update([
                'construction_site_id' =>$this->selectedConstructionSite,
            ]);
            return redirect()->route('hp_workingDayEntry',$this->record->id);
        } 
        $this->record->update([
            'construction_site_id' =>$this->selectedConstructionSite,
        ]);
        return redirect()->route('hp_workingDayEntry',$this->record->id);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.bde.bde-select-construction-site');
    }
}
