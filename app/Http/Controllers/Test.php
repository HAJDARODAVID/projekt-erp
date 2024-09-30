<?php

namespace App\Http\Controllers;

use App\Services\HidroProjekt\Domain\Material\MaterialConsumptionService;
use Illuminate\Http\Request;

class Test extends Controller
{
    public function index(){
        try {
            $service = new MaterialConsumptionService(501,17);
            $service->addItemToConsumer([
                'mat_id' => "",
                'qty' => "tes",
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        dd($service);
    }
}
