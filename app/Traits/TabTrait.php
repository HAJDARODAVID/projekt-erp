<?php

namespace App\Traits;

trait TabTrait
{
    public $tabs = [];
    public $activeTab = 0;

    public function setTabs(array $tabs)
    {
        $this->tabs = $tabs;
        $this->activeTab = array_key_first($this->tabs) ?? 0;
        return $this;
    }

    public function selectTab($tabID): void
    {
        $this->activeTab = $tabID;
        return;
    }
}
