<?php

namespace App\Http\Controllers\HidroProjekt;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WorkPlanningController extends Controller
{
    public function constructionSites(){
        return view('hidro-projekt.WP.constructionSites');
    }
}
