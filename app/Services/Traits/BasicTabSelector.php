<?php

namespace App\Services\Traits;

/**
 * This trait will give you the basic functionality for the tab selector.
 */
trait BasicTabSelector{
    public $selectedTab = 0;
    public function selectTab($tab){
        return $this->selectedTab = $tab;
    }
}