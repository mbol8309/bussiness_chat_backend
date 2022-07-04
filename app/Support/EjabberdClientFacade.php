<?php
namespace App\Support;

use Illuminate\Support\Facades\Facade;

class EjabberdClientFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'EjabberdClient';
    }
}