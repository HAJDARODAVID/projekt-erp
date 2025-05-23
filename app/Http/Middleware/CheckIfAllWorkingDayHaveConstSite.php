<?php

namespace App\Http\Middleware;

use App\Http\Controllers\HidroProjekt\WorkDayRecordController;
use App\Models\WorkingDayRecordModel;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckIfAllWorkingDayHaveConstSite
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $workDayRecord = WorkingDayRecordModel::where('user_id', Auth::user()->id)
            ->where('construction_site_id', NULL)
            ->where('date', date("Y-m-d"))
            ->first();  
        if($request->route()->getName() =='hp_deleteWorkingDayEntry'){
            return $next($request);
        }
        if((Auth::user()->type == 3 || Auth::user()->type == 5) && !is_null($workDayRecord) && $request->route()->getName() !='showBdeWorkReport'){
            return redirect()->route('showBdeWorkReport', $workDayRecord->id);
        }
        return $next($request);
    }
}
