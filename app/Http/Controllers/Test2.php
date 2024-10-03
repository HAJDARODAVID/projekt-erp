<?php

namespace App\Http\Controllers;

use App\Exports\Domain\Workers\Cooperators\CoOpWorkHoursExport;
use App\Services\HidroProjekt\Domain\Api\WeatherForecastService;
use App\Services\HidroProjekt\Domain\Workers\Cooperators\CooperatorsExportWorkHoursService;

class Test2 extends Controller
{
    public function index(){
        // $url = "https://prognoza.hr/tri/3d_graf_i_simboli.xml";
        // $xml = simplexml_load_file($url, "SimpleXMLElement", LIBXML_NOCDATA);
        // $json = json_encode($xml);
        // $array = json_decode($json,TRUE);
        // foreach ($array['grad'] as $key => $town) {
        //     $array[$town["@attributes"]['ime']] = $town['dan'];
        //     unset($array['grad'][$key]);
        // }
        // dd($array['Varazdin']);
        $service = new WeatherForecastService;
        $data=$service->toArray()->formatArray()->town('Varazdin')->getTownData();
        dd($service->toArray()->formatArray()->town('Varazdin')->forDashboard()->getTownData());
    }
}
