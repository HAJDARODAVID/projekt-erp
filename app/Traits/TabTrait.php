<?php

namespace App\Traits;

trait TabTrait
{
    public $tabs = [];
    public $activeTab = 0;

    public function setTabs(array $tabs)
    {
        $this->tabs = $tabs;
        return $this;
    }

    public function selectTab($tabID): void
    {
        $this->activeTab = $tabID;
        return;
    }
}
