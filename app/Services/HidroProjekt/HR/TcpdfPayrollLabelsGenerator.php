<?php

namespace App\Services\HidroProjekt\HR;

use TCPDF;

/**
 * Class TcpdfPayrollLableGenerator.
 */
class TcpdfPayrollLabelsGenerator
{
    //const TD_STYLE = '"border: 1px solid; height: 120.2px;text-align: center"';
    const TD_STYLE = '"height: 120.2px;text-align: center"';
    const TABLE_STYLE = '"vertical-align: middle"';

    private $workers;
    private $workerCount;

    public function index($worker) 
    {   
        $getWorkerArrayData = $this->getWorkerArray($worker);
        $this->workers = $getWorkerArrayData['workers'];
        $this->workerCount = $getWorkerArrayData['workersCount'];

        return $this->pdfGenerator();
    }

    public function pdfGenerator() 
    {   
        $rows = round(ceil($this->workerCount / 3),0);

        $pdf=new TCPDF();

        $pdf->SetMargins(0,0,0,true);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

    	$html = "
            <table style = ".self::TABLE_STYLE.">
            <tbody>";

        $workerIndex = 0;    
        for ($i=0; $i < $rows ; $i++) { 
            $html = $html . "
            <tr>
                <td style = ".self::TD_STYLE.">
                    <table>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td>".$this->workers[$workerIndex]."</td></tr>
                        <tr><td>HIDRO-PROJEKT d.o.o</td></tr>
                    </table>
                </td>";
            if(isset($this->workers[$workerIndex+1])){
                $html = $html . "
                    <td style = ".self::TD_STYLE.">
                        <table>
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <tr><td>".$this->workers[$workerIndex+1]."</td></tr>
                            <tr><td>HIDRO-PROJEKT d.o.o</td></tr>
                        </table>
                    </td>";
            }
            if(isset($this->workers[$workerIndex+2])){
                $html = $html . "
                    <td style = ".self::TD_STYLE.">
                        <table>
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <tr><td></td></tr>
                            <tr><td>".$this->workers[$workerIndex+2]."</td></tr>
                            <tr><td>HIDRO-PROJEKT d.o.o</td></tr>
                        </table>
                    </td>";
            }
            $html = $html ."</tr>";
            $workerIndex= $workerIndex+3;
        }
        $html = $html . "</tbody></table>";

        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->AddPage();
        
        $pdf->writeHTML($html, true, false, true, false, '');

        return $pdf->Output('hello_world.pdf');
    }

    private function getWorkerArray($workers){
        $workerArray=[];
        $i=0;
        foreach ($workers as $worker) {
            $workerArray[$i] =  $worker->firstName." ".  $worker->lastName;
            $i++;
        }
        return ['workers' => $workerArray, 'workersCount' =>$i];
    }
}
