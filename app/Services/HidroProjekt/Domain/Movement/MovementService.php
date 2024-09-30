<?php

namespace App\Services\HidroProjekt\Domain\Movement;

use Illuminate\Support\Facades\Auth;
use App\Exceptions\StorageDoesNotExists;
use App\Exceptions\MovementDoesNotExists;
use App\Services\HidroProjekt\Domain\Storage\StorageLocation;

class MovementService
{
    private $mvt;
    private $from;
    private $to;
    private $mvtAction;
    private $user;
    
    public function __construct(
        $mvt,
        $from,
        $to = NULL,
    )
    {
        $this->mvt = $this->setMvt($mvt);
        $this->from = $this->setLocation($from);
        $this->to = $this->setLocation($to, TRUE);
        $this->user = Auth::user();
    }

    private function setMvt($mvt){
        //Set movement actions
        if(!isset(MovementTypes::MVT_ACTIONS[$mvt])){
            return throw new MovementDoesNotExists(['mvt' => $mvt]);
        }
        $this->mvtAction = MovementTypes::MVT_ACTIONS[$mvt];
        return $mvt;
    }

    private function setLocation($loc, $nullable=FALSE){
        if($nullable && is_null($loc)){
            return NULL;
        }
        if($this->isStorageLocationValid($loc)){
            return $loc;
        }
        return throw new StorageDoesNotExists(['str' => $loc]);
    }

    private function isStorageLocationValid($str){
        return in_array($str,StorageLocation::STOR_LOC);
    }

}