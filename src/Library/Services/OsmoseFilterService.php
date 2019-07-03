<?php
namespace Agog\Osmose\Library\Services;

use Agog\Osmose\Library\Services\Traits\OsmoseDriverTrait;

class OsmoseFilterService
{
    use OsmoseDriverTrait;

    protected $model, $builder;

    /**
     * Set the eloquent model that is to be filtered
     * @param $model 
     */
    public function model ($model)
    {
        $this->model = $model;

        $this->builder = $model::query();

        return $this;
    }

    /**
     * Performs the base filtration process to determine
     * the filterable driver that ought to be executed
     * @param $filters
     */
    public function filter ($filters)
    {
        foreach ($filters as $filter => $rule)
        {
            $driver = $this->getOsmoseDriver($filter, $rule);

            $this->builder = $driver->filtrate($this->builder);
        }

        return $this->builder;

    }
}