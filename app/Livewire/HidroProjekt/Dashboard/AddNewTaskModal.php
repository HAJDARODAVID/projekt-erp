<?php

namespace App\Livewire\HidroProjekt\Dashboard;

use Livewire\Component;
use App\Models\ToDoList;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class AddNewTaskModal extends Component
{
    public $data    = [];
    public $userFor = [];
    public $error = [];
    public $fromTo;
    public $show            = FALSE;
    public $priorityOptions = ToDoList::PRIORITY_HR;

    public function toggleModal(){
        if(!$this->show){
            $this->data = $this->setData();
            $this->userFor = $this->getAllUsers();
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
            'deadline' => date('Y-m-d'),
        ];
    }

    public function saveItem(){
        $validate = $this->validateData();
        if(!$validate){
            return;
        }
        $newTask = ToDoList::create($this->data);
        $this->data = $this->setData();
        $this->show = FALSE;
        $this->fromTo = NULL;
        return $this->dispatch('refresh-to-do-list');
    }

    public function updatedFromTo($key){
        if($key == 'NULL'){
            $this->data['user_id'] = Auth::user()->id;
            $this->data['from']    = NULL;
        }
        if($key != 'NULL'){
            $this->data['user_id'] = $key;
            $this->data['from']    = Auth::user()->id;
        }
    }

    private function validateData(){
        $valid = TRUE;
        if($this->data['task'] == NULL || $this->data['task'] == ""){
            $this->error['task'] = TRUE;
            $valid = FALSE;
        }
        return $valid;
    }

    private function getAllUsers(){
        $userObj = User::whereNotIn('type', [4,3])->where('active', 1)->with('getWorker')->get();
        $users=[];
        foreach ($userObj as $user) {
            $users[$user->id] = $user->getWorker->fullName;
        }
        return $users;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.dashboard.add-new-task-modal');
    }
}
