<?php

namespace App\Livewire\HidroProjekt\Dashboard\Components;

use Livewire\Component;
use App\Models\ToDoList;

class ToDoListItem extends Component
{
    public $priority = [
        10 => NULL,
        20 => NULL,
        30 => 'list-group-item-danger',
    ];

    public $item;
    
    public function changeItemStatus($status){
        if(!key_exists($status, ToDoList::STATUS)){
            return $this->dispatch('show-alert-modal', [
                'title' => 'ERROR',
                'message' => "Invalid ToDo-List status. Status: " .$status,
                'type' => 'danger',
            ]);
        }
        $this->item->update([
            'status' => $status,
        ]);

        return $this->dispatch('refresh-to-do-list');
    }

    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.components.to-do-list-item');
    }
}
