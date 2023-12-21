<?php

namespace App\Http\Controllers\HidroProjekt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Services\HidroProjekt\HR\TcpdfPayrollLabelsGenerator;

class HumanResourcesController extends Controller
{
    public function index(){
        return view('hidro-projekt.hr');
    }

    public function payrollLabels(){
        $pdf = new TcpdfPayrollLabelsGenerator();
        return $pdf->index();

    }

}
