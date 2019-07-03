<?php
namespace Agog\Osmose\Library\Services\Contracts;

interface OsmoseDriverInterface
{
    /*
     * The filtrate method performs necessary filtration processes
     */
    public function filtrate ($builder);
}