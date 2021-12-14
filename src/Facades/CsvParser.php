<?php

namespace Elanode\FileParsers\Facades;

use Illuminate\Support\Facades\Facade;

class CsvParser extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'csvparser';
    }
}
