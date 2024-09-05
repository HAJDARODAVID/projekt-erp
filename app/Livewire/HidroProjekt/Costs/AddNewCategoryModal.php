<?php

namespace App\Livewire\HidroProjekt\Costs;

use App\Models\BillCategoryModel;
use Livewire\Component;

class AddNewCategoryModal extends Component
{
    public $show = FALSE;
    public $showSuccessCard = FALSE;
    public $category = NULL;
    public $error = [];

    public function modalBtn($status){
        $this->resetAll();
        return $this->show = $status ? TRUE : FALSE;
    }

    public function saveCategory(){
        $this->error = [];
        $this->showSuccessCard = FALSE;
        if($this->category != NULL || $this->category != ""){
            $hasEntry = BillCategoryModel::where('category', $this->category)->first();
            if($hasEntry){
                return $this->error['message'] = 'Kategorija: '. $this->category . ' postoji u tablici!';
            }
            BillCategoryModel::create([
                'category' => $this->category,
            ]);
            $this->dispatch('refresh-bill-categories-table');
            $this->category = NULL;
            return $this->showSuccessCard = TRUE;
        }
        return $this->error['message'] = 'Molim upišite naziv kategorije';
    }
    private function resetAll():void{
        $this->showSuccessCard = FALSE;
        $this->category=[];
        $this->error=[];
        return;
    }

    public function render()
    {
        return view('livewire.hidroprojekt.costs.add-new-category-modal');
    }
}
