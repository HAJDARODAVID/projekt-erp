<?php

namespace App\Services;

/**
 * Class ModalOpenClose.
 */
trait ModalOpenClose
{
    public $show = FALSE;

    public function openCloseModal(){
        if ($this->show){
            return $this->show = FALSE;
        }else{
            return $this->show = TRUE;
        }
    }

}
