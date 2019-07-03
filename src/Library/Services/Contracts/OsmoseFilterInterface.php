<?php
namespace Agog\Osmose\Library\Services\Contracts;

interface OsmoseFilterInterface
{
    /*
     * Obligates that a mandatory residue method exists
     */
    public function residue () : array;
    
}