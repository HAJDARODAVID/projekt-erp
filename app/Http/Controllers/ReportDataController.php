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
    private $api_key = '$2y$12$jdoVimL5yiR.Rza7LFWdzeknN8j68O4Oj7l7MnBkFQOQ78NvwkMlO';
    private $key_match = NULL;

    public function __construct(Request $request)
    {
        $this->key_match = $this->api_key == $request->header('api-key') ? TRUE : FALSE;
    }

    public function getAllBillsForExpenses(Request $request){
        if($this->key_match){
            $allBills= new BillModel;
            $year = $request->get('year');
            if(!(is_null($year))){
                $allBills = $allBills->whereYear('date', $year);
            }
            return response()->json($allBills->get());
        }
        return;
    }

    public function getAllBillProviders(Request $request){
        if($this->key_match){
            return response()->json(BillProviderModel::get());
        }
        return;
    }

    public function getAllBillCategories(Request $request){
        if($this->key_match){
            return response()->json(BillCategoryModel::get());
        }
        return;
    } 

}
