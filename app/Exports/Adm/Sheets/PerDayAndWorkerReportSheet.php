<?php

namespace App\Exports\Adm\Sheets;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PerDayAndWorkerReportSheet implements FromArray, ShouldAutoSize, WithTitle, WithHeadings, WithStyles
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
            'Datum',
            '#',
            'Ime',
            'Prezime',
            'Gradilište',
            'Tip terena',
            'Radni sati',
            'BO/GO'
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
        $sheet->getStyle('F')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'wrapText' => true,
            ],
        ]);

        $sheet->getStyle('G')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'wrapText' => true,
            ],
        ]);
        $sheet->getStyle('H')->applyFromArray([
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
                'wrapText' => true,
            ],
        ]);
        return;
    }

    /**
     * @return string
     */
    public function title(): string{
        return 'Pregled mjeseca';
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return $this->data;
    }
}
