<?php

namespace App\Services\Traits;

trait BasicTabSelector{
    public $selectedTab = 0;
    public function selectTab($tab){
        return $this->selectedTab = $tab;
    }
}