<?php

namespace App\Services\HidroProjekt\REPORT;

use App\Services\Months;
use App\Models\BillModel;
use App\Models\BillProviderModel;

/**
 * Class ExoensesReportService.
 */
class ExpensesReportService
{
    private $months = Months::MONTHS_HR;

    public function execute($report, $year){
        switch ($report) {
            case 1:
                return $this->getDataForProviderExpensesReport($year);
                break;
            
            default:
                return NULL;
                break;
        }
    }

    private function getDataForProviderExpensesReport($year){
        $providers = BillProviderModel::get();
        $bills = BillModel::whereYear('date', $year);
        $billsByProviders = $bills->get()
            ->groupBy('provider_id');   
        $reportData=[];
        $overAllData=[];
        foreach ($billsByProviders as $provider => $data) {
            $providerObj = $providers;
            $providerInfo = $providerObj->where('id', $provider)->first()->provider;
            $fullYear=0;
            foreach ($this->months as $month => $monthName) {
                $amount = BillModel::whereYear('date', $year)->whereMonth('date', $month)->where('provider_id', $provider)->get()->sum('amount');
                $reportData[$providerInfo][$month] = $amount;
                $fullYear = $fullYear + $amount;
            }
            $reportData[$providerInfo][$year]=$fullYear;
        }
        $fullYear=0;
        foreach ($this->months as $month => $monthName) {
            $amount=BillModel::whereYear('date', $year)->whereMonth('date', $month)->get()->sum('amount');
            $overAllData[$month]= $amount;
            $fullYear = $fullYear + $amount;
        }
        $overAllData[$year]= $fullYear;
        $reportData['overall']=$overAllData;
        return $reportData;
    }

}
