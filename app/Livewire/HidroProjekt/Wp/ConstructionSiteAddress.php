<?php

namespace App\Livewire\HidroProjekt\Wp;

use Livewire\Component;
use App\Services\HidroProjekt\WP\ConstructionSiteService;

class ConstructionSiteAddress extends Component
{
    public $street;
    public $town;
    public $constId;
    public $address;
    private $constSiteService;

    public function mount(){
        $this->address=[
            'street' =>$this->street,
            'town' =>$this->town,
        ];
    }

    public function updatedAddress($value, $key){
        if($value == ""){
            $value= NULL;
        }
        $this->constSiteService = new ConstructionSiteService;
        $this->constSiteService->updateConstructionSite($this->constId,[
            $key => $value,
        ]);

    }

    public function render()
    {
        return view('livewire.hidroprojekt.wp.construction-site-address');
    }
}
