<?php

namespace App\Http\Controllers;

use App\Services\HidroProjekt\Domain\Workers\Cooperators\CooperatorsExportWorkHoursService;

class Test2 extends Controller
{
    public function index(){
        try {
            $workHoursDto = new CooperatorsExportWorkHoursService(2,6,2024);
            dd($workHoursDto);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
