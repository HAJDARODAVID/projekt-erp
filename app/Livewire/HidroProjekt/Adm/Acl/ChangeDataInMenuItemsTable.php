<?php

namespace App\Livewire\HidroProjekt\Adm\Acl;

use App\Models\ModuleItemModel;
use Livewire\Component;

class ChangeDataInMenuItemsTable extends Component
{
    public $row;
    public $for;
    public $width;
    public $type;

    public $dropDownItems;
    public $data;

    public function mount(){
        $this->dropDownItems = $this->setDropDowData();
        $this->data = $this->setData();
    }

    public function updatedData($key, $value){
        if($key != ""){
            $this->row->update([
                $value => $key,
            ]);
        }
        
    }

    private function setDropDowData(){
        switch ($this->for) {
            case 'module_id':
                return ModuleItemModel::all();
                break;
            
            default:
                # code...
                break;
        }
    }

    private function setData(){
        return [
            'name' => $this->row->name,
            'route_name' => $this->row->route_name,
            'module_id' => $this->row->module_id,
        ];
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.acl.change-data-in-menu-items-table');
    }
}
