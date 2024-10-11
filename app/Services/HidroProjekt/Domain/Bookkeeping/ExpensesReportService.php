<?php

namespace App\Services\HidroProjekt\Domain\Bookkeeping;

use App\Models\BillModel;

class ExpensesReportService
{

    public function getDataForExportByMonth($month){
        $expenses = BillModel::whereMonth('date', $month)->with('getProvider', 'getCategory')->get()->toArray();
        foreach ($expenses as $key => $bill) {
            unset($expenses[$key]);
            $expenses[$key]=[
                'Datum'          => $bill['date'],
                'Poslužitelj'    => $bill['get_provider']['provider'],
                'Kategorija'     => $bill['get_category']['category'],
                'Iznos'          => $bill['amount'],
                'Uklj.PDV'       => $bill['inc_pdv'] == TRUE ? '1' : '0',
                'Iznos bezPDV-a' => NULL,
                'PDV'            => NULL,
                'Napomena'       => $bill['remark'],
            ];
            if($bill['inc_pdv']){
                $expenses[$key]['Iznos bezPDV-a'] = $bill['amount']*0.8;
            }else{
                $expenses[$key]['Iznos bezPDV-a'] = $bill['amount'];
            }
            $expenses[$key]['PDV'] = $expenses[$key]['Iznos'] - $expenses[$key]['Iznos bezPDV-a'];
        }
        return $expenses;  
    }

}