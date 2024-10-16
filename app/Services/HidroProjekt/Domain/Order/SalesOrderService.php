<?php

namespace App\Services\HidroProjekt\Domain\Order;

use App\Models\SalesOrder;
use App\Models\SalesOrderItem;
use App\Services\HidroProjekt\STG\MovementService;
use App\Services\HidroProjekt\STG\MovementTypes;
use App\Services\HidroProjekt\STG\StorageLocation;

class SalesOrderService
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function execute(){
        //Create a new order in DB
        $salesOrder = SalesOrder::create($this->data->toArray());

        $data=[];
        //Create a new order items in DB, and fill data
        $items = $this->data->getItems();
        foreach ($items as $matId => $item) {
            SalesOrderItem::create([
                'order_id' => $salesOrder->id,
                'mat_id'   => $matId,
                'qty'      => $item['s_qty'],
                'amount'   => $item['s_amount'],
            ]);
            $data[]=[
                'mat_id' => $matId,
                'qty'    => $item['s_qty'],
            ];
        }
        //Consume materials
        $consumer = new MovementService(
            $data,
            MovementTypes::BOOK_SALES_ORDER_MATERIAL,
            fromLoc: StorageLocation::MAIN_STORAGE
        );
        $consumer->execute();
        return [
            'success' => TRUE,
            'order' => $salesOrder,
        ];
    }
}