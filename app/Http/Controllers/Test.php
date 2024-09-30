<?php

namespace App\Http\Controllers;

use App\Services\HidroProjekt\Domain\Material\MaterialConsumptionService;
use Illuminate\Http\Request;

class Test extends Controller
{
    public function index(){
        try {
            $mat = 500032;
            $service = new MaterialConsumptionService(501,4);
            for ($i=0; $i < 10; $i++) { 
                $service->addItemToConsumer([
                    'mat_id' => $mat,
                    'qty' => 52+$i,
                ]);
            }
            $service->consume();
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        dd($service);
    }
}
