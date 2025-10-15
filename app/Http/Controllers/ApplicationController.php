<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApplicationController extends Controller
{
    public function __construct()
    {
        $this->setMainTitle('Application settings')
            ->setTabLinks([
                'applicationDashboard' => 'Home',
                'getAllApplicationRoutes' => 'Routes',
            ]);
    }

    public function index()
    {
        return $this->module();
    }

    public function getAllApplicationRoutes()
    {
        return $this->module();
    }
}
