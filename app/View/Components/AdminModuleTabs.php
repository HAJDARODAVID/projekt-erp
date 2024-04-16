<?php

namespace App\View\Components;

use Closure;
use App\Models\TabItems;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class AdminModuleTabs extends Component
{
    public $name;
    public $items;
    /**
     * Create a new component instance.
     */
    public function __construct($name)
    {
        $this->name = $name;
        $this->items = TabItems::where('comp_name', $this->name)->get();
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.admin-module-tabs');
    }
}
