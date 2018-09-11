<?php
namespace Agog\Osmose\Library\Services\Facades;

use Illuminate\Support\Facades\Facade;

class Residue extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "Agog\Osmose\Library\Services\Sift";
    }
}