<?php

namespace App\Services\HidroProjekt\Domain\Material;

use App\Models\MaterialDocModel;
use App\Models\MaterialMvtModel;
use Illuminate\Support\Facades\Auth;

class MovementDocumentService
{
    private $materialDoc;

    public function createNewMovementDoc($mvt_type){
        $this->materialDoc = MaterialDocModel::create([
                                'mvt_type' => $mvt_type,
                                'created_by' => Auth::user()->id,
                            ]);
        return $this->materialDoc;
    }

    public function createNewMovementItem($item, $stg, $jobID){
        return MaterialMvtModel::create([
                    'stg_loc' => $stg, 
                    'const_id' => $jobID, 
                    'mvt' => $this->materialDoc->mvt_type, 
                    'mat_doc_id' => $this->materialDoc->id, 
                    'mat_id' => $item['mat_id'], 
                    'qty' => $item['qty'], 
                ]);
    }
}
