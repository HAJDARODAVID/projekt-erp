<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Models\Supplier;
use Livewire\Component;

class CreateNewSupplier extends Component
{
    public $supplier;
    public $error;

    public function saveBtn(){
        unset($this->error['supplier']);
        if($this->supplier == ''){
            return $this->error['supplier'] = TRUE;
        }
        $supplier = Supplier::where('name', $this->supplier)->first();
        if(!is_null($supplier)){
            return redirect()->route('hp_suppliers')->with('error', 'Dobavljač: '.$this->supplier.', postoji u bazi');
        }
        if(is_null($supplier)){
            $newSupplier = Supplier::create([
                'name' => $this->supplier,
            ]);
            return redirect()->route('hp_suppliers')->with('success', 'Uspješno kreiran novi dobavljač: '. $newSupplier->name);
        }  
    }
    public function render()
    {
        return view('livewire.hidroprojekt.adm.create-new-supplier');
    }
}
