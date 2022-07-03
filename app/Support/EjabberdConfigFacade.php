<?php
namespace App\Support;

use Illuminate\Support\Facades\Facade;

namespace App\Support;

class EjabberdConfigFacade extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'EjabberdConfig';
    }
}