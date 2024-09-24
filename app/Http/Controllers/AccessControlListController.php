<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessControlListController extends Controller
{
    public function accessControlList(Request $request){
        if(!$request['tab']){
            request()->merge(['tab'=> 1]);
        }
        return view('hidro-projekt.ADM.acl.accessControlList');
    }
}
