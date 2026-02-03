<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportController extends Controller
{
    //**Define the module name */
    protected $module = 'reporting';

    public function moduleConfig()
    {
        $this->setMainTitle('Reporting');
    }

    public function getConstructionSiteReport()
    {
        $this->setMainTitle('Construction site report');
        return $this->module('construction-site-report');
    }
}
