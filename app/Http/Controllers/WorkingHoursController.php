<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WorkingHoursController extends Controller
{
    //**Define the module name */
    protected $module = 'working-hours';

    public function moduleConfig()
    {
        $this->setMainTitle('Working hours overview')
            ->setTabLinks();
    }

    /**
     * Get the main(index) working hours module. 
     * Display the hours for the main company for this month/year
     */
    public function index()
    {
        return $this->module();
    }
}
