<?php

namespace App\Livewire\HidroProjekt\Dashboard\Components;

use Livewire\Component;

class ToDoListItem extends Component
{
    public $priority = [
        10 => NULL,
        20 => NULL,
        30 => 'list-group-item-danger',
    ];

    public $item;

    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.components.to-do-list-item');
    }
}
