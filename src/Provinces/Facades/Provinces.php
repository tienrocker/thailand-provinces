<?php

namespace Tienrocker\ThProvinces\Provinces\Facades;

use Illuminate\Support\Facades\Facade;

class Provinces extends Facade {

    protected static function getFacadeAccessor()
    {
        // return name of what bind as app['thprovinces'] in ProvincesServiceProvider
        return 'thprovinces';
    }

}
