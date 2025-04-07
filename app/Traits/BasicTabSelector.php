<?php

namespace App\Traits;

use Livewire\Attributes\On;
/**
 * This trait will give you the basic functionality for the tab selector.
 */
trait BasicTabSelector{
    public $tabs = [];
    public $selectedTab = 0;

    #[On('select-tab')]
    public function selectTab($tab){
        return $this->selectedTab = $tab;
    }

    public function setTabs(array $tabs){
        return $this->tabs = array_merge($this->tabs, $tabs);
    }

    public function addNewTab($tabName=NULL){
        if($tabName != NULL){
            $this->tabs[] = $tabName; 
        }else{
            $this->tabs[] = 'New-tab-' . count($this->tabs)+1;
        }
        return $this->selectedTab = array_key_last($this->tabs);
    }

    #[On('rename-tab')]
    public function renameTab($tabKey, $newTitle){
        return $this->tabs[$tabKey] = $newTitle;
    }

    public function removeTab($tabKey){
        unset($this->tabs[$tabKey]);
        return $this->selectTab(0);
    }

    public function getTabName($tabKey){
        return $this->tabs[$tabKey];
    }
}