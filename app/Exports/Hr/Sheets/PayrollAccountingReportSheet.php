<?php

namespace App\Exports\Hr\Sheets;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class PayrollAccountingReportSheet implements FromArray, WithHeadings, ShouldAutoSize, WithTitle, WithStyles
{
    protected $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Ime i prezime',
            'Fiksna isplata',
            'Satnica',
            'OS',
            'GO',
            'BO',
            'Teren doma [Dani]',
            'Teren more [Dani]',
            'Osnovica',
            'Teren doma [€]',
            'Teren more [€]',
            'Bonus',
            'Putni troškovi',
            'Troškovi mobitela',
            'Ukupna isplata',
        ];
    }

    // public function columnWidths(): array
    // {
    //     return [
    //         'D' => 5,
    //         'E' => 7,  
    //         'F' => 7,
    //         'G' => 5, 
    //         'H' => 5,             
    //     ];
    // }WithColumnWidths

    public function title(): string
    {
        return 'Sumirani izvještaj';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
        $sheet->getStyle('D')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        $sheet->getStyle('E')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'wrapText' => true,
            ],
        ]);
        $sheet->getStyle('F')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'wrapText' => true,
            ],
        ]);
        return;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return $this->data;
    }
}
