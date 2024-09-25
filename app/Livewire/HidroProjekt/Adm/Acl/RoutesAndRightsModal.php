<?php

namespace App\Livewire\HidroProjekt\Adm\Acl;

use Livewire\Component;
use App\Models\Resources;

class RoutesAndRightsModal extends Component
{
    public $show=FALSE;
    public $title = 'Add route or route resource';
    public $type; //1 --> route || 2 --> resources

    public $new;

    public function updatedNew(){
        return $this->new = $this->formatName();
    }

    public function save(){
        if($this->new == ""){
            return;
        }
        switch ($this->type) {
            case 1:
                return;
                break;
            case 2:
                Resources::create([
                    'resources' => $this->new,
                ]);
                $this->dispatch('refresh-menu-items-table');
                $this->dispatch('refresh-resources-show');
                break;
            
            default:
                # code...
                break;
        }
        $this->type = NULL;
        $this->new = NULL;
        return $this->show=FALSE;
    }

    private function formatName(){
        $string=NULL;
        $string = strtolower($this->new);
        $string = str_replace(" ", "-", $string);

        if(!str_contains($string, 'menu-item-')){
            $string = 'menu-item-' . $string;
        }

        return $string;
    }

    public function openModal($type){
        if($type==0){
            $this->type = NULL;
            $this->new = NULL;
            return $this->show=FALSE;
        }
        switch ($type) {
            case 1:
                $this->title = 'Add new route';
                break;

            case 2:
                $this->title = 'Add new route resource';
                break;
        }
        $this->type = $type;
        return $this->show=TRUE;
    } 

    public function render()
    {
        return view('livewire.hidroprojekt.adm.acl.routes-and-rights-modal');
    }
}
