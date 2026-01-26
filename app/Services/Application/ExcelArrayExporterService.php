<?php

namespace App\Services\Application;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;
use App\Services\Application\ExcelDataMapper;

class ExcelArrayExporterService implements FromArray, WithHeadings
{
    /**
     * Data for exporting
     */
    protected ExcelDataMapper $excelDataMapper;

    public function __construct(ExcelDataMapper $excelDataMapper)
    {
        $this->excelDataMapper = $excelDataMapper;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        $header = $this->excelDataMapper->getHeaders();
        return $header;
    }

    /**
     * @return array
     */
    public function array(): array
    {
        return $this->excelDataMapper->getArrayData();
    }
}
