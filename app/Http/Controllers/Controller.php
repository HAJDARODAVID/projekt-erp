<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**Define the module name */
    const MODULE = null;

    /**
     * Method for returning a view where the livewire lives.
     * 
     * @param string $component Set the livewire component name, by default index
     * @return view Livewire module 
     */
    protected function module($component = 'index')
    {
        return view('module-container', [
            'module' => static::MODULE ?? NULL,
            'component' => $component,
        ]);
    }
}
