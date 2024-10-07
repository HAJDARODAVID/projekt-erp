<?php

namespace App\Livewire\HidroProjekt\Dashboard;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\ToDoList as ToDoListModel;

class ToDoList extends Component
{
    public $items;

    public function mount(){
        $this->items = ToDoListModel::where('user_id', Auth::user()->id)
            ->where('status', ToDoListModel::STATUS_ACTIVE)
            ->orderBy('priority', 'desc')
            ->orderBy('deadline', 'asc')->get();
    }

    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.to-do-list');
    }
}
