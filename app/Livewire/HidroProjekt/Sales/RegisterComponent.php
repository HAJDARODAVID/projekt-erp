<?php

namespace App\Livewire\HidroProjekt\Sales;

use App\Models\MaterialMasterData;
use App\Models\StorageStockItem;
use App\Services\HidroProjekt\STG\StorageLocation;
use Livewire\Component;
use Livewire\Attributes\On;

class RegisterComponent extends Component
{
    public $addMaterialModalShow = FALSE;
    public $receiptItems=[];
    public $matInput;
    public $totalAmount;

    public function mount(){
        $this->calculateTotalAmount();
    }

    public function toggleAddMaterialModal(){
        return $this->addMaterialModalShow= $this->addMaterialModalShow == FALSE ? TRUE : FALSE;
    }

    public function updatedMatInput($key){
        $mmInfo=MaterialMasterData::where('id', $key)->first();
        if(is_null($mmInfo)){
            $this->matInput = NULL;
            return $this->dispatch('show-alert-modal', [
                'title' => 'Materijal: '.$key.' ne postoji!',
                'message' => "U matičnim podacima nema navedenog materijala!",
                'type' => 'danger',
            ]);
        }
        $stock = StorageStockItem::where('str_loc', StorageLocation::MAIN_STORAGE)
            ->where('qty', '>', 0)
            ->where('mat_id', $key)
            ->first();
        if(is_null($stock)){
            $this->matInput = NULL;
            return $this->dispatch('show-alert-modal', [
                'title' => 'Stanje skladišta!',
                'message' => "Materijala: $key nema na stanju skladišta!!",
                'type' => 'danger',
            ]);
        }
        $this->matInput = NULL;
        return $this->addItemToReceiptItems(['mat_id' => $key, 'qty' => $stock->qty]);
    }

    public function updatedReceiptItems($key, $value){
        $newValue = $key;
        list($matId, $colName) = explode('.',$value);
        switch ($colName) {
            case 's_qty':
                if($newValue > $this->receiptItems[$matId]['qty']){
                    $this->receiptItems[$matId]['s_qty'] = $this->receiptItems[$matId]['qty'];
                    return $this->dispatch('show-alert-modal', [
                        'title' => 'UPOZORENJE!',
                        'message' => 'Raspoloživa količina materijala '.$matId.' je '.$this->receiptItems[$matId]['qty'],
                        'type' => 'warning',
                    ]);
                }
                break;
            
            default:
                # code...
                break;
        }
    }

    #[On('check-if-key-is-in-receipt')]
    public function sendIfItemsIsInArray($matID){
        return $this->dispatch('is-mat-in-receipt', [
            'is_set' => array_key_exists($matID, $this->receiptItems),
            'mat_id' => $matID,
        ]);
    }

    #[On('add-new-item-to-register')]
    public function addItemToReceiptItems($row){
        $mmInfo=MaterialMasterData::where('id', $row['mat_id'])->first();
        $this->receiptItems[$row['mat_id']] = [
            'mat_name' => $mmInfo->name,
            'qty' => $row['qty'],
            'price' => $mmInfo->s_price == NULL ? 0 : $mmInfo->s_price,
            's_qty' => 1,
            's_amount' => 0
        ];
        $newItem=$this->receiptItems[$row['mat_id']];
        $this->receiptItems[$row['mat_id']]['s_amount'] = $newItem['s_qty'] * $newItem['price'];
        $this->calculateTotalAmount();
        return;
    }

    private function calculateTotalAmount(){
        $total=0;
        foreach ($this->receiptItems as $item) {
            $total = $total + $item['s_amount'];
        }
        return $this->totalAmount = number_format(($total), 2, '.', '');
    } 

    public function render()
    {
        return view('livewire.hidroprojekt.sales.register-component');
    }
}
