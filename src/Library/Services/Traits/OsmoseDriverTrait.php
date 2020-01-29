<?php

namespace Agog\Osmose\Library\Services\Traits;

use Illuminate\Support\Str;

trait OsmoseDriverTrait
{
    /*
     * Get the osmose driver to execute filtration
     */
    public function getOsmoseDriver ($filter, $rule)
    {
        if (is_callable($rule)) {

            return new \Agog\Osmose\Library\Drivers\CallbackFilter($filter, $rule);

        }

        if (Str::startsWith($rule, 'column')) {

            return new \Agog\Osmose\Library\Drivers\DirectFilter($filter, $rule);

        }

        if (Str::startsWith($rule, 'relationship')) {

            return new \Agog\Osmose\Library\Drivers\RelationshipFilter($filter, $rule);

        }

        return die("We couldn't find a driver for your filter rules");
    }
}
