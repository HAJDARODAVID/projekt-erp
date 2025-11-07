<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    /**Define the module name */
    protected $module = 'app-settings';

    public function moduleConfig()
    {
        $this->setMainTitle('App control center')
            ->setTabLinks();
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
