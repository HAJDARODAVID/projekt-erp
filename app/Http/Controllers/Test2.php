<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Router;
use App\Exports\Domain\Workers\Cooperators\CoOpWorkHoursExport;
use App\Services\HidroProjekt\Domain\Api\WeatherForecastService;
use App\Services\HidroProjekt\Domain\Workers\Cooperators\CooperatorsExportWorkHoursService;

class Test2 extends Controller
{
    public function index()
    {
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
        $data = $service->toArray()->formatArray()->town('Varazdin')->getTownData();
        dd($service->toArray()->formatArray()->town('Varazdin')->forDashboard()->getTownData());
    }

    public function newLayout()
    {
        return view('module-container');
    }

    public function changeLog()
    {
        // Get the last released tag. This command finds the most recent tag.
        $lastTag = exec('git describe --tags --abbrev=0');



        // **CORRECTED**
        // Using single quotes around the format string to prevent the bash syntax error.
        $changelog = exec("git log --pretty=format:'- %s (%h)' --no-merges");

        dd($changelog);
        return 'im in';
    }

    public function getGetRouts(Router $router)
    {
        // Get the entire collection of routes registered in the application.
        $allRoutes = $router->getRoutes();

        // Initialize an array to store the filtered GET routes.
        $getRoutes = [];

        // Iterate over the entire route collection.
        foreach ($allRoutes as $route) {
            //dd($route->methods());
            // Check if the route's methods include 'GET'.
            // The `getMethods()` method returns an array of HTTP verbs for the route.
            if (in_array('GET', $route->methods())) {
                // For each route, add key information to our array.
                $getRoutes[] = [
                    'uri'       => $route->uri,
                    'name'      => $route->getName(),
                    'action'    => $route->getActionName(),
                    'methods'   => $route->methods()[0],
                ];
            }
        }

        // Return the array of GET routes as a JSON response.
        return response()->json([
            'get_routes' => $getRoutes
        ]);
    }
}
