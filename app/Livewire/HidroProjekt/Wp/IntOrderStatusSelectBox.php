<?php

namespace App\Livewire\HidroProjekt\Wp;

use App\Models\IntOrder;
use App\Services\HidroProjekt\Domain\Order\InternalOrder\InternalOrderService;
use Livewire\Component;

class IntOrderStatusSelectBox extends Component
{
    public $statuses = IntOrder::STATUS_TYPES;   
    public $orderStatus;
    public $saved = '';
    public $row;

    public function mount(){
        $this->orderStatus = $this->row->status;
    }

    public function updatedOrderStatus($key){
        $service = new InternalOrderService();
        $service->getOrderById($this->row->id)->changeOrderStatus($key);
        $this->saved = 'is-valid';
        return;
    }
    public function render()
    {
        return view('livewire.hidroprojekt.wp.int-order-status-select-box');
    }
}
