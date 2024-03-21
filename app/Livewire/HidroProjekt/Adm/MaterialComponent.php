<?php

namespace App\Livewire\HidroProjekt\Adm;

use App\Services\ADM\MaterialService;
use Livewire\Component;

class MaterialComponent extends Component
{
    public $uom; 
    public $error      = [];
    public $save       = [];
    public $mmInfo     = [];
    public $type       = 'new';
    public $mmModal    = NULL;
    public $disabled   = FALSE;
    public $inProgress = FALSE;
    public $required   = ['name', 'uom_1', 'price'];

    public function mount(){
        if($this->type == 'show'){
            $this->mmInfo = $this->mmModal->toArray();
            $this->mmInfo['pricevat'] = number_format(($this->mmModal->price *1.25), 2, '.', '');
        }
        //dd( $this->mmInfo);
    }
    
    public function updatedMmInfo($key, $value){
        if($value == 'price'){
            $this->mmInfo['pricevat'] = number_format($key == '' ? 0 :$key *1.25, 2, '.', '');
        }
        if($this->type=='show'){
            if(in_array($value, $this->required) && $key == ''){
                return $this->error[$value] = TRUE;
            }else{
                if(isset($this->error[$value])){
                    unset($this->error[$value]);
                }
                $this->mmModal->update([
                    $value => $key,
                ]);
                return $this->save[$value] = TRUE;
            }

        }
    }

    public function saveBtn(){
        $this->inProgress = TRUE;
        if(!$this->validation()){
            $this->inProgress = FALSE;
            return;
        }
        if($this->validation()){
            $service = new MaterialService;
            $newMat = $service->createNewMaterial($this->mmInfo);
            return redirect()->route('hp_masterMaterial')->with('success', 'Materijal: '. $newMat->name .', uspješno kreiran!');
        }
    }

    private function validation(){
        $this->error = [];
        foreach ($this->required as $key) {
            if(!isset($this->mmInfo[$key]) || $this->mmInfo[$key]==""){
                $this->error[$key] = TRUE;
            }
        }
        //TRUE --> no errors / FALSE --> errors
        return empty($this->error);
    }

    public function render()
    {
        return view('livewire.hidroprojekt.adm.material-component');
    }
}
