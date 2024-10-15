<?php

namespace App\Services\HidroProjekt\Domain\Order;


class SalesOrderService
{
    private $data;

    public function __construct($data)
    {
        $this->data = $data;
        dd($this->data->getOrdType());
    }
}