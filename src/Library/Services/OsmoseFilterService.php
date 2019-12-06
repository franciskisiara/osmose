<?php
namespace Agog\Osmose\Library\Services;

use Agog\Osmose\Library\Services\Traits\OsmoseDriverTrait;

class OsmoseFilterService
{
    use OsmoseDriverTrait;

    protected $model, $builder;

    /**
     * Set the eloquent model that is to be filtered
     *
     * @param $model
     */
    public function model ($model)
    {
        $this->model = $model;

        $this->builder = $model::query();

        return $this;
    }

    /**
     * Set the range of values that are to be filtered against
     * Supports the created_at column on the table to be filtered
     *
     * @param $range
     */
    public function range ($range)
    {
        if (request()->has($range))
        {
            $timespan = config("osmose.ranges.".request($range));

            $this->builder = $this->builder->whereBetween(
                'created_at', $timespan
            );
        }

        return $this;
    }

    /**
     * Performs the base filtration process to determine
     * the filterable driver that ought to be executed
     *
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
