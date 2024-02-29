<?php

namespace App\Http\Controllers\HidroProjekt;

use App\Http\Controllers\Controller;
use App\Models\ConstructionSiteModel;
use App\Services\HidroProjekt\WP\ConstructionSiteService;
use Illuminate\Http\Request;

class ConstructionSiteController extends Controller
{
    private $constSiteService;
    public function __construct()
    {
        $this->constSiteService = new ConstructionSiteService;
    }
    public function constructionSites(){
        return view('hidro-projekt.WP.constructionSites');
    }

    public function addNewConstructionSites(Request $request){
        $validate = $request->validate([
            'name' => 'required',
            'job_description' => 'required',
        ]);
        $request['status']= ConstructionSiteModel::CONSTRUCTION_STATUS_ACTIVE;
        ConstructionSiteService::addNewConstructionSites($request->all());
        return redirect()->route('hp_constructionSites')->with('success', 'Gradilište uspješno dodan!');
    }

    public function showConstructionSite($id){
        return view('hidro-projekt.WP.showConstructionSite', [
            'constructionSite' => $this->constSiteService->getConstructionSite($id),
            'cumulativelyHours' => $this->constSiteService->getHoursCumulatively($id),
            'allLogsForConstructionSite' => $this->constSiteService->getAllLogsForConstructionSiteString($id),
            'perDayHoursAndCost' => $this->constSiteService->getWorkHoursCostPerDayAndConstSite($id),
            'perDayHoursAndCostCoOp' => $this->constSiteService->getWorkHoursCostPerDayAndConstSiteForCoOp($id),
            'carCost' => $this->constSiteService->getCarCostForConstSite($id),
        ]);

    }
}
