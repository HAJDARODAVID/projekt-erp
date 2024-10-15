<?php

namespace App\Http\Controllers;

use App\Models\BillModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ReportDataController extends Controller
{
    private $api_key = '$2y$12$jdoVimL5yiR.Rza7LFWdzeknN8j68O4Oj7l7MnBkFQOQ78NvwkMlO';

    public function getAllBillsForExpenses(Request $request){
        if(!($this->checkIfHasKey($request->header('api_key')))){
            return;
        }
        $allBills= new BillModel;
        $year = $request->get('year');
        if(!(is_null($year))){
            $allBills = $allBills->whereYear('date', $year);
        }
        return $allBills->get();
    }

    
    private function checkIfHasKey($key):bool{
        return $key == $this->api_key;
    }

}
