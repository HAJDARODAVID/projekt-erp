<?php

namespace App\Livewire\HidroProjekt\Dashboard;

use Livewire\Component;
use App\Models\ToDoList;
use Illuminate\Support\Facades\Auth;

class AddNewTaskModal extends Component
{
    public $data = [];
    public $show = FALSE;
    public $priorityOptions = ToDoList::PRIORITY_HR;

    public function toggleModal(){
        if(!$this->show){
            $this->data = $this->setData();
        }
        return $this->show = $this->show ? FALSE : TRUE;
    }

    private function setData(){
        return [
            'user_id' => Auth::user()->id,
            'from' => NULL,
            'task' => NULL,
            'status' => ToDoList::STATUS_ACTIVE,
            'priority' => ToDoList::PRIORITY_MEDIUM,
            'deadline' => NULL,
        ];
    }

    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.add-new-task-modal');
    }
}
