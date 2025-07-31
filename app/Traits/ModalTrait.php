<?php

namespace App\Traits;

trait ModalTrait
{
    public $modalStatus = FALSE;

    public function openModal(): void
    {
        $this->modalStatus = TRUE;
    }

    public function closeModal(): void
    {
        $this->modalStatus = FALSE;
    }
}
