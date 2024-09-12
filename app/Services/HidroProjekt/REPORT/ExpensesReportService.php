<?php

namespace App\Services\HidroProjekt\REPORT;

use App\Services\Months;
use App\Models\BillModel;
use App\Models\BillProviderModel;
use App\Models\ReportConfig;

/**
 * Class ExoensesReportService.
 */
class ExpensesReportService
{
    private $reportInfo;

    private $months = Months::MONTHS_HR;

    public function execute($report, $year){
        $this->reportInfo = $report;
        switch ($this->reportInfo['comp_id']) {
            case 1:
                return $this->getDataForProviderExpensesReport($year);
                break;

            case 2:
                    return $this->getDataForGroupedCategoriesReport($year);
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

    private function getDataForGroupedCategoriesReport($year){
        $rConfigObj=ReportConfig::where('r_name', 'expenses-by-grouped-categories')->first();
        $rConfig = json_decode($rConfigObj->value_1,true);
        $groupsConfig = $rConfig['groups'];
        $data=[];
        //Create the report structure
        foreach ($groupsConfig as $g_name => $g_data) {
            $data[$g_name] = Months::MONTHS_HR;
        }

        $monthlyOverall = Months::MONTHS_HR;
        foreach ($monthlyOverall as $key => $month) {
            $monthlyOverall[$key] = 0;
        }
        foreach ($data as $g_name => $months) {
            $groupCategories = NULL;
            $groupCategories = array_keys($groupsConfig[$g_name]);
            $yearAmount = 0;
            foreach ($months as $key => $month) {
                $data[$g_name][$key] = BillModel::whereYear('date', $year)
                    ->whereMonth('date', $key)
                    ->whereIn('categories_id', $groupCategories)
                    ->get()
                    ->sum('amount');
                    $yearAmount = $yearAmount + $data[$g_name][$key];
                    $monthlyOverall[$key] = $monthlyOverall[$key] + $data[$g_name][$key];
            }
            $data[$g_name][$year] = $yearAmount;
        }
        $monthlyOverall[$year] = array_sum($monthlyOverall);
        $data['overall'] = $monthlyOverall;
        return $data;
    }

}
