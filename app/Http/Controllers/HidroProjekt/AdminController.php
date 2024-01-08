<?php

namespace App\Http\Controllers\HidroProjekt;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

class AdminController extends Controller
{

    public function users(){
        return view('hidro-projekt.ADM.users');
    }
}
