<?php

namespace App\Services\HidroProjekt\HR;

use TCPDF;

/**
 * Class TcpdfPayrollLableGenerator.
 */
class TcpdfPayrollLabelsGenerator
{
    const TD_STYLE = '"border: 1px solid; height: 120.2px;text-align: center"';
    const TABLE_STYLE = '"vertical-align: middle"';

    public function index() 
    {   
        return $this->pdfGenerator();
    }

    public function pdfGenerator() 
    {   
        $pdf=new TCPDF();

        $pdf->SetMargins(0,0,0,true);
        $pdf->SetPrintHeader(false);
        $pdf->SetPrintFooter(false);

    	$html = "
            <table style = ".self::TABLE_STYLE.">
            <tbody>";

        for ($i=0; $i < 7; $i++) { 
            $html = $html . "
            <tr>
                <td style = ".self::TD_STYLE.">
                    <table>
                        <tr><td></td></tr>
                        <tr><td></td></tr>
                        <tr><td>David Hajdarovic</td></tr>
                        <tr><td>HIDRO-PROJEKT</td></tr>
                        <tr><td>Plitvicka 33, Semovec</td></tr>
                    </table>
                </td>
                <td style = ".self::TD_STYLE.">
                    
                
                </td>
                <td style = ".self::TD_STYLE.">
                    
                
                </td>

            </tr>";
        }
        $html = $html . "</tbody></table>";

        $pdf->SetAutoPageBreak(TRUE, 0);
        $pdf->AddPage();
        
        $pdf->writeHTML($html, true, false, true, false, '');

        return $pdf->Output('hello_world.pdf');
    }
}
