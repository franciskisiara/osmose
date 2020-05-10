<?php
namespace Agog\Osmose\Library\Services;

use Agog\Osmose\Library\Services\Traits\OsmoseDatesTrait;
use Agog\Osmose\Library\Services\Traits\OsmoseDriverTrait;
use Illuminate\Support\Facades\DB;

class OsmoseFilterService
{
    use OsmoseDriverTrait, OsmoseDatesTrait;

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
     * @param $column
     * @param $range
     * @param $limits
     */
    public function timeline ($column, $range, $limits)
    {
        $timespan = request()->has($range)
            ? $this->rangeTimespan($range)
            : $this->limitTimespan($limits);

        if (is_array($timespan))
        {
            $this->builder = $this->builder->whereBetween($column, $timespan);
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
