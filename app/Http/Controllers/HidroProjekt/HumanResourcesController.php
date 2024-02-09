<?php

namespace App\Http\Controllers\HidroProjekt;

use App\Models\WorkerModel;
use Illuminate\Http\Request;
use App\Models\CooperatorsModel;
use App\Http\Controllers\Controller;
use App\Models\CooperatorWorkersModel;
use Illuminate\Support\Facades\Session;
use App\Services\HidroProjekt\HR\WorkerService;
use App\Services\HidroProjekt\HR\WorkHoursService;
use App\Services\HidroProjekt\HR\TcpdfPayrollLabelsGenerator;

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

    public function disableWorker($id){
        $worker = WorkerModel::where('id',$id)->first();
        $worker->update([
            'status' => WorkerModel::WORKER_STATUS_EX_EMPLOYEE,
        ]);
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

    public function allWorkHours(){
        $workHoursService = new WorkHoursService;
        //dd($workHoursService);
        return view('hidro-projekt.HR.allWorkHours',[
            'workHoursService' =>  $workHoursService,
        ]);
    }

    public function cooperators(){
        return view('hidro-projekt.HR.cooperators');
    }

    public function newCooperators(Request $request){
        $validated = $request->validate([
            'name' => 'required',
        ]);
        $request['status'] = CooperatorsModel::COOPERATORS_STATUS_ACTIVE;
        $newCooperator=CooperatorsModel::create([
            'name' => $request['name'],
            'status' => $request['status'],
        ]);
        return redirect()->route('hp_showCooperators', $newCooperator->id)->with('success', 'Uspješno kreiran novi kooperant! Dodijeli radnike u ovu grupu!');
    }

    public function showCooperators($id){
        $cooperator = CooperatorsModel::where('id', $id)->with('getAllWorkers')->first();
        return view('hidro-projekt.HR.showCooperator', [
            'cooperator' => $cooperator,
        ]);
    }

    public function newCooperatorWorker(Request $request){
        $validated = $request->validate([
            'firstName' => 'required',
            'lastName' => 'required',
        ]);
        $request['status'] = 1;
        CooperatorWorkersModel::create($request->all());
        return redirect()->route('hp_showCooperators', $request['cooperator_id'])->with('success', 'Uspješno dodan novi radnik kooperantu!');
    }

    public function deactivateCooperatorWorker($id){
        $worker = CooperatorWorkersModel::where('id', $id);
        $worker->update([
            'status' => 0,
        ]);
        return redirect()->back()->with('success', 'Uspješno uklonjen radnik!');
    }

    public function updateCooperatorWorker(Request $request, $id){
        $error = [];
        $error['workerId'] = $id;
        if ($request['firstName'] == "" || $request['lastName'] == "") {
            if($request['firstName'] == ""){
                $error['firstName'] = 'Obavezno upisati ime!!';
            }
            if($request['lastName'] == ""){
                $error['lastName'] = 'Obavezno upisati prezime!!';
            }
            Session::flash('error', $error);
            return redirect()->back();
        }
        $worker = CooperatorWorkersModel::where('id', $id);
        $worker->update([
            'firstName' => $request['firstName'],
            'lastName' => $request['lastName'],
        ]);
        return redirect()->back()->with('success', 'Uspješno spremljen radnik!');
    }

}
