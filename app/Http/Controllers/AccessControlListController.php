<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AccessControlListController extends Controller
{
    public function accessControlList(){
        return view('hidro-projekt.ADM.acl.accessControlList');
    }
}
