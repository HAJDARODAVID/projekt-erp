<?php

namespace App\Http\Controllers;

use App\Models\BillCategoryModel;
use App\Models\BillModel;
use App\Models\BillProviderModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ReportDataController extends Controller
{
    //$2y$12$jdoVimL5yiR.Rza7LFWdzeknN8j68O4Oj7l7MnBkFQOQ78NvwkMlO
    private $api_key = 'david';
    private $key_match = TRUE;

    public function __construct(Request $request)
    {
        $this->key_match = $this->api_key == $request->header('api_key') ? TRUE : FALSE;
    }

    public function getAllBillsForExpenses(Request $request){
        //$this->api_key == $request->header('api_key')
        if($this->api_key == $request->header('api_key')){
            $allBills= new BillModel;
            $year = $request->get('year');
            if(!(is_null($year))){
                $allBills = $allBills->whereYear('date', $year);
            }
            return json_encode($allBills->get());

        }
        return;
    }

    public function getAllBillProviders(Request $request){
        if(!($this->checkIfHasKey($request->header('api_key')))){
            return;
        }
        return BillProviderModel::get();
    }

    public function getAllBillCategories(Request $request){
        if(!($this->checkIfHasKey($request->header('api_key')))){
            return;
        }

        return BillCategoryModel::get();
    } 

}
