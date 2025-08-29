<?php

namespace App\Traits;

trait ModalTrait
{
    public $modalStatus = FALSE;

    public function openModal(): void
    {
        if (method_exists($this, 'beforeOpenModal')) $this->beforeOpenModal();
        $this->modalStatus = TRUE;
    }

    public function closeModal(): void
    {
        if (method_exists($this, 'beforeCloseModal')) $this->beforeCloseModal();
        $this->modalStatus = FALSE;
    }
}
