<?php

namespace App\Services\HidroProjekt\Domain\Order;

class ORD001DTO
{
    private $ord_type; 
    private $buyer; 
    private $pymt_method;
    private $pymt_status;
    private $date;
    private $created_by;
    private $items;

    public function __construct(
        $ord_type    = OrderTypes::ORDER_MATERIAL_SALES,
        $buyer       = NULL,
        $pymt_method = NULL,
        $pymt_status = NULL,
        $date        = NULL,
        $created_by  = NULL,
        $items       = []
    )
    {
        $this->ord_type    = $ord_type;
        $this->buyer       = $buyer;
        $this->pymt_method = $pymt_method;
        $this->pymt_status = $pymt_status;
        $this->date        = $date;
        $this->created_by  = $created_by;
        $this->items       = $items;
    }

    public function getOrdType(){
        return $this->ord_type;
    }

    public function getBuyer(){
        return $this->buyer;
    }

    public function getPymtMethod(){
        return $this->pymt_method;
    }

    public function getPymtStatus(){
        return $this->pymt_status;
    }

    public function getDate(){
        return $this->date;
    }

    public function getCreatedBy(){
        return $this->created_by;
    }

    public function getItems(){
        return $this->items;
    }

    public function toArray(){
        return [
            'ord_type'    => $this->ord_type,
            'buyer'       => $this->buyer,
            'pymt_method' => $this->pymt_method,
            'pymt_status' => $this->pymt_status,
            'date'        => $this->date,
            'created_by'  => $this->created_by,
        ];
    }
}