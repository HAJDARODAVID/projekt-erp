<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportingController extends Controller
{
    public function workLogsBook(){
        return view('hidro-projekt.REPORT.workLogsBook');
    }
}
