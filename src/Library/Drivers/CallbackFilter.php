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
            $argsCount = (new \ReflectionFunction($this->rule))->getNumberOfParameters();

            $filter = $this->filter ? request()->get($this->filter) : null;

            if ($argsCount == 1 || ($argsCount == 2 && !is_null($filter)))
            {
                return call_user_func_array($this->rule, [$builder, $filter]);
            }
        }

        return $builder;
    }
}
