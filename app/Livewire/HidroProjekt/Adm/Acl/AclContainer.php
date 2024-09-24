<?php

namespace App\Livewire\HidroProjekt\Adm\Acl;

use Livewire\Component;
use Livewire\Attributes\Url;
use Illuminate\Support\Facades\Session;

class AclContainer extends Component
{
    public $tabs=[
        1 => [
            'name'=>'Groups/roles <--> resources',
            'right' => FALSE,
        ],
        2 => [
            'name'=>'Module <--> routes',
            'right' => FALSE,
        ],
    ];

    #[Url(as: 'tab')]
    public $activeTab;

    public function changeActiveTab($tab){
        if($this->tabs[$tab]['right']){
            if(in_array($this->tabs[$tab]['right'], Session::get('user_rights'))){
                return $this->activeTab = $tab;
            }else{
                return $this->activeTab = NULL;
            }
        }
        return $this->activeTab = $tab;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.acl.acl-container');
    }
}
