<?php

namespace App\Exports\Domain\Storage\Sheets;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithTitle;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Style\Border;
use Maatwebsite\Excel\Concerns\WithHeadings;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StorageStockSheet implements FromArray, WithHeadings, ShouldAutoSize, WithTitle, WithStyles
{
    protected $data;
    protected $type;

    public function __construct($data, $type)
    {
        $this->data = $data;
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return $this->data;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return array_keys($this->data[0]);
    }

    public function title(): string
    {
        return 'Pregled stanja materijala';
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getDefaultRowDimension()->setRowHeight(18);
     
        $sheet->getStyle('E')->getNumberFormat()->setFormatCode(
            '#,##0.00 €' // Example: Euro with two decimals
        );
        $sheet->getStyle('A:F')->applyFromArray([
            'font'  => [
                'name'  => 'Arial'
            ],
            'alignment' => [
                'horizontal' => Alignment::HORIZONTAL_CENTER,
            ],
        ]);
        $sheet->getStyle('1')->applyFromArray([
            'font' => [
                'bold' => true,
            ],
        ]);
        $sheet->getStyle('A1:F1')->applyFromArray([
            'borders' => [
                'bottom' => [
                    'borderStyle' => Border::BORDER_THIN
                ],
            ],
        ]);
        
        if($this->type != 'CONS'){
            $sheet->removeColumnByIndex(3);
        }
        $sheet->getCell('A1');
        return;
    }
}
