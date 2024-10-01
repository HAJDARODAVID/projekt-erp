<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Exports\Domain\Workers\Cooperators\CoOpWorkHoursExport;
use App\Services\HidroProjekt\Domain\Workers\Cooperators\CooperatorsExportWorkHoursAction;
use App\Services\HidroProjekt\Domain\Workers\Cooperators\CooperatorsExportWorkHoursTransformer;

class Test2 extends Controller
{
    public function index(){
        try {
            $workHoursDto = new CooperatorsExportWorkHoursTransformer(2,6,2024);
            dd($workHoursDto);
        } catch (\Exception $e) {
            dd($e->getMessage());
        }
    }
}
