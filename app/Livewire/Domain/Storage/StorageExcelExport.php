<?php

namespace App\Livewire\Domain\Storage;

use App\Models\StorageStockItem;
use App\Services\HidroProjekt\STG\StorageLocation;
use Livewire\Component;

class StorageExcelExport extends Component
{
    /**
     * There can only be two types.
     * STG  --> storage within the company,
     * CONS --> materials on the job site
     */
    public $type = NULL; 

    /**
     * Define available types.
     */
    private $typesAvailable = ['STG', 'CONS'];

    public function getExportData(){
        /**If there is no type defined, return empty */
        if(is_null($this->type) || !in_array($this->type, $this->typesAvailable)) return;

        /**Get all the stock where the qty is not 0 */
        $allStock = StorageStockItem::where('qty', '>', 0)->with('getMaterialInfo','getConstructionSiteInfo')->get();

        /**Define the array for the data */
        $array = [];
        
        switch ($this->type) {
            /**Prepare data for the main storage export */
            case 'STG':
                foreach($allStock as $stock){
                    if($stock->str_loc == StorageLocation::MAIN_STORAGE){
                        $array[] = $this->getStockToArray($stock);
                    }
                }
                break;
            /**Prepare data for the job site storage export */
            case 'CONS':
                foreach($allStock as $stock){
                    if($stock->str_loc == StorageLocation::CONSTRUCTION_SITE){
                        $array[] = $this->getStockToArray($stock);
                    }
                }
                break;
            
            default:
                return;
                break;
        }
        dd($array);
        return;
    }

    private function getStockToArray($stock){
        return [
                'mat_id'          => $stock->mat_id,
                'mat_name'        => $stock->getMaterialInfo->name,
                'mat_job_site'    => $stock->cons_id == NULL ? NULL : $stock->getConstructionSiteInfo->name,
                'mat_qty'         => $stock->qty,
                'mat_value'       => $stock->cost,
                'mat_last_update' => $stock->updated_at->format('Y-m-d H:i:s'),
            ];
    }

    public function render()
    {
        return view('livewire.domain.storage.storage-excel-export');
    }
}
