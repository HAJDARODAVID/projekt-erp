<?php

namespace App\Http\Controllers\HidroProjekt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AppParametersModel;
use App\Models\WorkingDayRecordModel;
use App\Services\HidroProjekt\BDE\WorkingDayRecordService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class WorkDayRecordController extends Controller
{
    public function index(){
        return "test";
    }

    public function newWorkingDayEntry(){
        if(Auth::user()->type == 3){
            $newRecord=WorkingDayRecordModel::create([
                'user_id' => Auth::user()->id,
                'date' => date('Y-m-d'),
            ]);
            return redirect()->route('hp_workingDayEntry', $newRecord->id);
        }else{
            return redirect()->route('home');
        }
    }

    public function workingDayEntry($id){
        $modules['bde-mc'] = AppParametersModel::where('param_name_srt', 'bde-mc')->pluck('value')->first();
        $record = WorkingDayRecordModel::where('id', $id)->first();
        if(is_null($record)){
            return redirect()->route('home');   
        }
        if($record->user_id != Auth::user()->id){
            return redirect()->route('home');
        }
        Session::put('entryID', $record->id);
        return view('hidro-projekt.BDE.workDayRecord',[
            'record' => $record,
            'modules' => $modules,
        ]);
    }

    public function deleteWorkingDayEntry($id){
        WorkingDayRecordService::deleteEntry($id);
        return redirect()->route('home');
    }

    public function myEntries(){
        return view('hidro-projekt.BDE.myEntries',[
            'user'=>Auth::user()->id,
        ]);
    }

    public function materialConsumption($wd_id, $cs_id){
        return view('hidro-projekt.BDE.bdeConsumption',[
            'wd_id' => $wd_id,
        ]);
    }

}
