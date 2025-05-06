<?php

namespace App\Exports\Domain\Storage;

use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\Support\Responsable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use App\Exports\Domain\Storage\Sheets\StorageStockSheet;

class StorageStockExport implements WithMultipleSheets, Responsable
{
    use Exportable;

    private $data;
    private $type;

    public function __construct($data, $type)
    {
        $this->data = $data;
        $this->type = $type;
    }

    /**
     * @return array
     */
    public function sheets(): array
    {
        $sheets = [];
        $sheets[] = new StorageStockSheet($this->data, $this->type);
        return $sheets;
    }

}
