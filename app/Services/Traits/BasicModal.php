<?php

namespace App\Services\Traits;

trait BasicModal{
    public $show = FALSE;
    public function toggleModal(){
        return $this->show = !$this->show;
    }
}