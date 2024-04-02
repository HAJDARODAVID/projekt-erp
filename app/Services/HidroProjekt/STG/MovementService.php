<?php

namespace App\Services\HidroProjekt\STG;

use App\Models\MaterialDocModel;
use Illuminate\Support\Facades\Auth;

/**
 * Class MovementService.
 */
class MovementService
{
    protected $matDocNr;

    protected $data;

    protected $mvt;

    protected $toLoc;

    protected $fromLoc;

    protected $mvtType;

    public function __construct(
        $data,
        $mvt,
        $toLoc = NULL,
        $fromLoc = NULL,
    )
    {
        $this->data = $data;
        $this->mvt = $mvt;
        $this->toLoc = $toLoc == NULL ? MovementTypes::MVT_TO_LOCATION[$this->mvt] : $toLoc;
        $this->fromLoc = $fromLoc;
        
        $this->matDocNr = $this->createNewMaterialDoc();
        $this->mvtType = MovementTypes::MVT_ACTIONS[$this->mvt];
    }

    public function execute(){
        dd($this);
    }

    private function createNewMaterialDoc(){
        return MaterialDocModel::create([
            'mvt_type' => $this->mvt,
            'created_by' => Auth::user()->id,
        ]);
    }

}
