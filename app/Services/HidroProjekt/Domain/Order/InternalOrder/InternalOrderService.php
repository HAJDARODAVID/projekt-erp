<?php

namespace App\Services\HidroProjekt\Domain\Order\InternalOrder;

use App\Models\IntOrder;
use App\Models\IntOrderItem;
use App\Services\HidroProjekt\Domain\Notifications\NotificationsService;
use Illuminate\Support\Facades\Auth;


class InternalOrderService
{
    private $user;
    private $csId;
    private $remark;
    private $items;
    private $order;
    private $orderItems;

    public function __construct()
    {
        $this->user = Auth::user();
    }

    public function createNewInternalOrder($csId, $items, $remark = NULL){
        //Set up all necessary data 
        $this->setCsId($csId)->setItems($items)->setRemark($remark);
        //create new order and add items
        $this->makeInternalOrder()->addItemsToTable()->createNewNotification();
        return TRUE;
    }

    public function getOrder(){
        return $this->order;
    }

    public function getOrderItems(){
        return $this->orderItems;
    }

    public function getOrderById($id){
        $this->order = IntOrder::where('id', $id)->first();
        $this->orderItems = IntOrderItem::where('ord_id', $id)->get();
        return $this;
    }

    public function changeOrderStatus($newStatus){
        $this->order->update([
            'status' => $newStatus,
        ]);
        return $this;
    }

    private function setCsId($csId){
        $this->csId = $csId;
        return $this;
    }

    private function setItems($items){
        $this->items = $items;
        return $this;
    }

    private function setRemark($remark){
        $this->remark = $remark;
        return $this;
    }

    private function makeInternalOrder(){
        $this->order = IntOrder::create([
            'const_id' => $this->csId,
            'ordered_by' => $this->user->id,
            'remark' => $this->remark,
        ]);
        return $this;
    }

    private function addItemsToTable(){
        foreach ($this->items as $item) {
            IntOrderItem::create([
                'ord_id' => $this->order->id,
                'mat_id' => $item['mat'],
                'qty'    => $item['qty'],
            ]);
        }
        $this->orderItems = IntOrderItem::where('ord_id', $this->order->id)->get();
        return $this;
    }

    private function createNewNotification(){
        $notification = (new NotificationsService())->createNewIntOrderNotification($this->user->id, $this->csId, $this->order->id);
        return $this;
    }
    
}