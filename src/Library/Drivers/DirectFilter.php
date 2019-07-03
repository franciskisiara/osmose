<?php
namespace Agog\Osmose\Library\Drivers;

use Agog\Osmose\Library\Services\Contracts\OsmoseDriverInterface;
use Agog\Osmose\Library\Decorators\OsmoseDriver;

class DirectFilter extends OsmoseDriver implements OsmoseDriverInterface
{
    /*
     * Performs filtration on a table given a column that exists within the passed model
     */
    public function filtrate ($builder)
    {
        if ($filter = request()->get($this->filter)) {

            $column = explode(":", $this->rule)[1];

            return $builder->where($column, $filter);

        }

        return $builder;
    }
}