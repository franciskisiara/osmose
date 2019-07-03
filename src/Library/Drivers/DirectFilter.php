<?php
namespace Agog\Osmose\Library\Drivers;

use Agog\Osmose\Library\Services\Contracts\OsmoseDriverInterface;

class DirectFilter implements OsmoseDriverInterface
{
    /*
     * Performs filtration on a table given a column that exists within the passed model
     */
    public function filtrate ($builder, $filter, $rule)
    {
        if (request()->has($filter)) {

            $rules = explode(":", $rule);

            $column = $rules[1];

            return $builder->where($column, request($filter));

        }
    }
}