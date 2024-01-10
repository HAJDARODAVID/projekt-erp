<?php

namespace App\Http\Controllers\HidroProjekt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WorkerModel;
use App\Services\HidroProjekt\HR\TcpdfPayrollLabelsGenerator;
use App\Services\HidroProjekt\HR\WorkerService;

class HumanResourcesController extends Controller
{
    public function index(Request $request){
        return view('hidro-projekt.HR.allWorkers');
    }

    public function allWorkers(Request $request){
        //dd($request->route()->getPrefix());
        return view('hidro-projekt.HR.allWorkers',['workers' => WorkerModel::simplePaginate(20)]);
    }

    public function showWorker($id){
        $worker = WorkerModel::where('id', $id)->first();
        if(is_null(WorkerModel::where('id', $id)->first())){
            return redirect()->route('hp_allWorkers');
        }
        return view('hidro-projekt.HR.showWorker', [
            'worker' => WorkerModel::where('id', $id)->with('getWorkerAddress', 'getWorkerContact')->first(),
        ]);
    }

    public function newWorkerForm(){
        return view('hidro-projekt.HR.newWorker',[
            'todayDate' =>date("Y-m-d"),
        ]);
    }

    public function addNewWorker(Request $request){
        $validated = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
            'working_place' => 'required',
            'OIB' => 'required',
        ]);

        WorkerService::createNewUser($request);
     
        return redirect()->route('hp_allWorkers')->with('success', 'Radnik: uspješno dodan!');
    }

    public function deleteWorker($id){
        $worker = WorkerModel::where('id',$id)->first();
        $worker->delete();
        return redirect()->route('hp_allWorkers')->with('success', 'Radnik: uspješno maknut!');
    }

    public function updateWorker(Request $request, $id){
        $validated = $request->validate([
            'working_place' => 'required',
            'OIB' => 'required',
        ]);
        WorkerService::updateNewUser($request,$id);
        return redirect()->route('hp_showWorker', $id)->with('success', 'Uspješno spremljene promjene!');
    }

    public function payrollLabels(){
        $worker = WorkerModel::where('print_label', 1)->get();
        $pdf = new TcpdfPayrollLabelsGenerator();
        return $pdf->index($worker);
    }



}
