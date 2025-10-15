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

    /**Sets the module title */
    protected $mainTitle = NULL;

    /**Sets tabs links array */
    protected $tabLinks = [];

    /**
     * Method for returning a view where the livewire lives.
     * 
     * @param string $component Set the livewire component name, by default index
     * @return view Livewire module 
     */
    protected function module($component = 'index')
    {
        /**Check if Livewire component for a module exists */
        $livewire = class_exists("App\\Livewire\\Modules\\" . $this->stringConverter(static::MODULE) . '\\' . $this->stringConverter($component));

        return view('module-container', [
            'livewire'  => $livewire,
            'module'    => static::MODULE ?? NULL,
            'component' => $component,
            'mainTitle' => $this->mainTitle,
            'tabLinks'  => $this->tabLinks,
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
     * Use it in a constructor to add to all method, but you can overwrite the links in the method itself 
     * 
     * @param string $mainTitle Name of the overall main title.
     * @return Controller 
     */
    protected function setTabLinks(array $tabLinks)
    {
        $this->tabLinks = $tabLinks;
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
}
