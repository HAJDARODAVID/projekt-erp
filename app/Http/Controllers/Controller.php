<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    const MODULE = null;

    protected function module($component = 'index')
    {
        return view('module-container', [
            'module' => static::MODULE ?? NULL,
            'component' => $component,
        ]);
    }
}
