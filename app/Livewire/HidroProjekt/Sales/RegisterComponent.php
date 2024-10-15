<?php

namespace App\Livewire\HidroProjekt\Sales;

use App\Models\MaterialMasterData;
use App\Models\SalesOrder;
use App\Models\StorageStockItem;
use App\Services\HidroProjekt\Domain\Order\ORD001DTO;
use App\Services\HidroProjekt\Domain\Order\SalesOrderService;
use App\Services\HidroProjekt\STG\StorageLocation;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;
use Livewire\Attributes\On;

class RegisterComponent extends Component
{
    public $addMaterialModalShow = FALSE;
    public $receiptItems=[];
    public $matInput;
    public $totalAmount;
    public $data=[];
    public $error=[];

    public $p_status = SalesOrder::ORDER_PAYMENT_STATUS;
    public $t_type = SalesOrder::TRANSACTION_TYPES;

    public function mount(){
        $this->calculateTotalAmount();
        $this->data['date']   = date('Y-m-d');
        $this->data['pymt_status'] = SalesOrder::ORDER_PAID;
        $this->data['pymt_method']   = SalesOrder::TRANSACTION_TYPE_CASH;
    }

    public function toggleAddMaterialModal(){
        return $this->addMaterialModalShow= $this->addMaterialModalShow == FALSE ? TRUE : FALSE;
    }

    public function createNewOrder(){
        $this->error = [];
        $validation = $this->validateData();
        if($validation){
            return $this->dispatch('show-alert-modal', [
                'title' => 'Greška!',
                'message' => "Molim popuniti sva polja!",
                'type' => 'danger',
            ]);
        }
        $dto = new ORD001DTO(
            buyer: $this->data['date'],
            pymt_method: $this->data['pymt_method'],
            pymt_status: $this->data['pymt_status'],
            date: $this->data['date'],
            created_by: Auth::user()->id,
            items: $this->receiptItems,
        );
        $service = new SalesOrderService($dto);
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
                $this->receiptItems[$matId]['s_amount'] = $this->receiptItems[$matId]['s_qty']*$this->receiptItems[$matId]['price'];
                $this->formatNumber($matId,'s_amount');
                $this->calculateTotalAmount();
                break;

            case 's_amount':
                    $this->formatNumber($matId,'s_amount');
                    $this->calculateTotalAmount();
                    break;
            
            default:
                # code...
                break;
        }
    }

    public function removeItem($matId){
        unset($this->receiptItems[$matId]);
        $this->calculateTotalAmount();
        return;
    }

    private function formatNumber($mat, $key){
        return $this->receiptItems[$mat][$key] = number_format($this->receiptItems[$mat][$key], 2, '.', '');
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
        $this->formatNumber($row['mat_id'],'s_amount');
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

    private function validateData(){
        $error=[];
        if(!isset($this->data['buyer'])){
            $error['buyer']=TRUE;
        }

        if(isset($this->data['buyer'])){
            if($this->data['buyer'] == "" || $this->data['buyer'] == NULL){
                $error['buyer']=TRUE;
            }
        }

        if(!isset($this->data['date'])){
            $error['date']=TRUE;
        }

        if(isset($this->data['date'])){
            if($this->data['date'] == "" || $this->data['date'] == NULL){
                $error['date']=TRUE;
            }
        }

        $this->error = $error;
        return count($error);
    } 

    public function render()
    {
        return view('livewire.hidroprojekt.sales.register-component');
    }
}
