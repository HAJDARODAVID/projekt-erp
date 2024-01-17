<?php

namespace App\Http\Controllers\HidroProjekt;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\WorkingDayRecordModel;
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
        ]);
    }

}
