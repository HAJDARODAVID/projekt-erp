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
            ->where('construction_site_id', NULL)->first();  
        if(Auth::user()->type == 3 && !is_null($workDayRecord) && $request->route()->getName() !='hp_workingDayEntry'){
            return redirect()->route('hp_workingDayEntry', $workDayRecord->id);
        }
        return $next($request);
    }
}
