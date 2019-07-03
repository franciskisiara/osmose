<?php
namespace Agog\Osmose\Library\Drivers;

use Agog\Osmose\Library\Services\Contracts\OsmoseDriverInterface;
use Agog\Osmose\Library\Decorators\OsmoseDriver;

class RelationshipFilter extends OsmoseDriver implements OsmoseDriverInterface
{
    public function filtrate ($builder)
    {
        if ($filter = request()->get($this->filter)) {

            $rules = explode(":", $this->rule)[1];

            $load = explode(",", $rules);

            return $builder->whereHas($load[0], function ($query) use($load, $filter){

                $query->where($load[1], $filter);

            });
        }

        return $builder;
    }
}