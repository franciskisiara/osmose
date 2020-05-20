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
        if ($this->rule)
        {
            $filter = $this->filter ? request()->get($this->filter) : null;

            if ($filter)
            {
                $column = explode(":", $this->rule)[1];

                return $builder->where($column, $filter);
            }
            else
            {
                $details = explode(',', substr($this->rule, strpos($this->rule, ":") + 1));

                $column = $details[0];

                array_splice($details, 0, 1);

                return $builder->whereIn($column, $details);
            }
        }

        return $builder;
    }
}
