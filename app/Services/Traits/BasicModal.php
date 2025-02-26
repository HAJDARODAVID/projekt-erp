<?php

namespace App\Services\Traits;

/**
 * This trait will give you the basic functionality for the modal toggling.
 */
trait BasicModal{
    public $show = FALSE;
    public function toggleModal(){
        return $this->show = !$this->show;
    }
}