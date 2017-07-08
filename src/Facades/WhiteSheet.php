<?php namespace Sukohi\WhiteSheet\Facades;

use Illuminate\Support\Facades\Facade;

class WhiteSheet extends Facade {

    /**
    * Get the registered name of the component.
    *
    * @return string
    */
    protected static function getFacadeAccessor() { return 'white-sheet'; }

}