<?php

namespace App\View\Components\Ui\Module;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Route;
use Illuminate\View\Component;

class TabLinks extends Component
{
    public $routes;
    /**
     * Create a new component instance.
     */
    public function __construct(
        $routes = [],
    ) {
        $this->routes = $this->checkIfRoutesExists($routes);
    }

    /**
     * Check if the given route exists
     * 
     * @return array
     */
    private function checkIfRoutesExists($routes)
    {
        foreach ($routes as $routeName => $title) {
            if (!(Route::has($routeName))) unset($routes[$routeName]);
        }
        return $routes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.ui.module.tab-links');
    }
}
