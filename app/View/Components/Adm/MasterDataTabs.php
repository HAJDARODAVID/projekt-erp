<?php

namespace App\View\Components\Adm;

use App\Models\TabItems;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MasterDataTabs extends Component
{
    public $name='master-data-tabs';
    public $items;
    /**
     * Create a new component instance.
     */
    public function __construct()
    {
        $this->items = TabItems::where('comp_name', $this->name)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.adm.master-data-tabs');
    }
}
