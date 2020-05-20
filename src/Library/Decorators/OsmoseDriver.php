<?php
namespace Agog\Osmose\Library\Decorators;

class OsmoseDriver
{
    protected $filter, $rule;

    public function __construct($requestFilter, $ruleDefinition)
    {
        $this->filter = $requestFilter;
        $this->rule = $ruleDefinition;
    }
}
