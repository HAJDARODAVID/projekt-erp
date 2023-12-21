<?php

namespace App\Http\Controllers\HidroProjekt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WorkerModel;
use App\Services\HidroProjekt\HR\TcpdfPayrollLabelsGenerator;

class HumanResourcesController extends Controller
{
    public function index(){
        return view('hidro-projekt.HR.allWorkers');
    }

    public function allWorkers(){
        return view('hidro-projekt.HR.allWorkers',['workers' => WorkerModel::simplePaginate(20)]);
    }

    public function payrollLabels(){
        $worker = WorkerModel::get();
        $pdf = new TcpdfPayrollLabelsGenerator();
        return $pdf->index($worker);

    }

}
