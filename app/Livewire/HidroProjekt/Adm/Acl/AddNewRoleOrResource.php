<?php

namespace App\Livewire\HidroProjekt\Adm\Acl;

use App\Models\Resources;
use App\Models\RoleGroup;
use Livewire\Component;

class AddNewRoleOrResource extends Component
{
    public $show=FALSE;
    public $title;
    public $type; //1 --> role group || 2 --> resources

    public $new;

    public function save(){
        if($this->new == ""){
            return;
        }
        switch ($this->type) {
            case 1:
                RoleGroup::create([
                    'name' => $this->new,
                ]);
                $this->dispatch('refresh-roles-grouping');
                break;
            case 2:
                Resources::create([
                    'resources' => $this->new,
                ]);
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

    public function updatedNew(){
        return $this->new = $this->formatName();
    }

    private function formatName(){
        $string=NULL;
        switch ($this->type) {
            case 1:
                $string = strtoupper($this->new);
                $string = str_replace(" ", "_", $string);
                break;
            case 2:
                $string = strtolower($this->new);
                $string = str_replace(" ", "-", $string);
                break;
            
            default:
                # code...
                break;
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
                $this->title = 'Add new role group';
                break;

            case 2:
                $this->title = 'Add new resource';
                break;
        }
        $this->type = $type;
        return $this->show=TRUE;
    } 

    public function render()
    {
        return view('livewire.hidroprojekt.adm.acl.add-new-role-or-resource');
    }
}
