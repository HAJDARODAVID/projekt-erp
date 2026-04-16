<?php

namespace App\Http\Controllers;

class ReaperErpController  extends Controller
{
    /**Define the module name */
    protected $module = 'reaper-erp';

    public function moduleConfig()
    {
        $this->setMainTitle('Reaper ERP')
            ->setTabLinks()
            ->middlewareAttributes('s-admin-access-only');
    }

    /**
     * Show the application dashboard.
     */
    public function index()
    {
        return $this->module();
    }

    public function monthlyInstallments()
    {
        return $this->module('monthly-installments');
    }
}
