<?php

namespace App\Http\Controllers\HidroProjekt;

use App\Http\Controllers\Controller;
use App\Services\HidroProjekt\WP\ConstructionSiteService;
use Illuminate\Http\Request;

class WorkPlanningController extends Controller
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

        ConstructionSiteService::addNewConstructionSites($request->all());
        return redirect()->route('hp_constructionSites')->with('success', 'Gradilište uspješno dodan!');
    }

    public function showConstructionSite($id){
        return view('hidro-projekt.WP.showConstructionSite', [
            'constructionSite' => $this->constSiteService->getConstructionSite($id),
        ]);

    }
}
