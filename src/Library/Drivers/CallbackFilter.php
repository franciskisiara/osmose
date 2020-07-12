<?php
namespace Agog\Osmose\Library\Drivers;

use Agog\Osmose\Library\Services\Contracts\OsmoseDriverInterface;
use Agog\Osmose\Library\Decorators\OsmoseDriver;

class CallbackFilter extends OsmoseDriver implements OsmoseDriverInterface
{
    public function filtrate ($builder)
    {
        if ($this->rule)
        {
            $filter = $this->filter ? request()->get($this->filter) : null;

            return call_user_func($this->rule, $builder, $filter);
        }

        return $builder;
    }
}
