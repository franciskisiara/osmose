<?php
namespace Kisiara\Osmose\Library\Services\Facades;

use Illuminate\Support\Facades\Facade;

class Residue extends Facade
{
    protected static function getFacadeAccessor()
    {
        return "Kisiara\Osmose\Library\Services\Sift";
    }
}