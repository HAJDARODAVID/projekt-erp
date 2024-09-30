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
                'mat_id' => '50125587',
                'qty' => 52,
            ]);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
        dd($service);
    }
}