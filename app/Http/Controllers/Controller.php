<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\Services\Application\GetModuleRoutesForTabLinks;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**Define the module name */
    protected $module = NULL;

    /**Sets the module title */
    protected $mainTitle = NULL;

    /**Sets tabs links array */
    protected $tabLinks = [];

    /**Store the request */
    protected $request;

    /**Sets the index tab icon  */
    protected $specialIndexIcon = NULL;

    public function __construct(Request $request)
    {
        $this->request = $request;
        if (method_exists(get_class($this), 'moduleConfig')) $this->moduleConfig();
    }

    /**
     * Method for returning a view where the livewire lives.
     * 
     * @param string $component Set the livewire component name, by default index
     * @return view Livewire module 
     */
    protected function module($component = 'index')
    {
        /**Check if Livewire component for a module exists */
        $livewire = class_exists("App\\Livewire\\Modules\\" . $this->stringConverter($this->module) . '\\' . $this->stringConverter($component));

        return view('module-container', [
            'livewire'         => $livewire,
            'module'           => $this->module ?? NULL,
            'component'        => $component,
            'mainTitle'        => $this->mainTitle,
            'tabLinks'         => $this->tabLinks,
            'specialIndexIcon' => $this->specialIndexIcon,
        ]);
    }

    /**
     * Sets the main module title. The title will be displayed no matter of the Livewire component.
     * 
     * @param string $mainTitle Name of the overall main title.
     * @return Controller 
     */
    protected function setMainTitle(string $mainTitle)
    {
        $this->mainTitle = $mainTitle;
        return $this;
    }

    /**
     * Sets the main module tab links component data.
     * The array has to be a a key value pair where the key is the route name and the value the displayed name.
     * Exp: home => Home (Good example right?)
     * Use it in moduleConfig() to add to all methods, but you can overwrite the links in the method itself.
     * If the $tabLinks array is empty it will check if there are registered routes for this module. 
     * 
     * @param array $tabLinks Pass here custom routes.
     * @return Controller 
     */
    protected function setTabLinks(array $tabLinks = [])
    {
        $controller = $this->getRequestControllerName();
        if ($controller == 'Livewire') return $this;
        if (empty($tabLinks)) $tabLinks = GetModuleRoutesForTabLinks::byController($controller)->getRouteLinksArray();

        $this->tabLinks = $tabLinks;
        return $this;
    }

    /**
     * When setting the tabs with a index page if you want a special icon set it here.
     * 
     * @param string $icon Pass here the Bootstrap icon 
     * @return Controller
     */
    protected function specialIndexIcon($icon)
    {
        $this->specialIndexIcon = $icon;
        return $this;
    }

    /**
     * StringConverter is a helping method for converting string from first-test to FirstTest
     * 
     * @param string $string String to be converted.
     * @return string The converted string Exp: FirstTest
     */
    private function stringConverter(string|NULL $string)
    {
        $output = '';
        $explosion = explode('-', $string);
        foreach ($explosion as $value) {
            $output .= ucfirst($value);
        }
        return $output;
    }

    /**
     * Get the controller name from the request.
     */
    private function getRequestControllerName()
    {
        $action = $this->request->route()->getActionName();
        $explodedAction = explode("@", $action);
        /**Check if Livewire */
        $livewireCheck = explode('\\', $explodedAction[0]);
        if ($livewireCheck[0] == 'Livewire') return 'Livewire';
        return class_basename($explodedAction[0]);
    }
}
