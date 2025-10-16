<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**Define the module name */
    const MODULE = 'app-settings';

    public function __construct()
    {
        $this->setMainTitle('App control center')
            ->setTabLinks([
                'applicationDashboard' => 'Home',
                'getAllApplicationModules' => 'Modules',
            ]);
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        return $this->module();
    }

    /**
     * Show all the application GET routes.
     */
    public function getAllApplicationModules()
    {
        return $this->module('modules');
    }
}
