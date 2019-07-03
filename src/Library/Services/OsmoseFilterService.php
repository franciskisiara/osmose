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
            $driver = $this->getOsmoseDriver($rule);

            $this->builder = $driver->filtrate($this->builder, $filter, $rule);
        }

        return $this->builder;

    }

    // use MeshTrait;

    // protected $builder, $filters;

    // protected $callbacks = [
    //     "meshColumn", "meshColumnWithRelationship", "meshCallback"
    // ];

    // /*
    //  * Sifts an entry that has a callback passed
    //  */
    // public function sift($residue)
    // {
    //     foreach($residue as $key => $element)
    //     {
    //         foreach($this->callbacks as $callback)
    //         {
    //             if(isset($this->filters[$key]))
    //                 $this->mesh($key, trim($element, ","), $callback);
    //         }
    //     }

    //     return $this->builder;
    // }

    // /*
    //  * Aggregated the items to be sifted with their respective filters
    //  */
    // public function aggregate($builder, $filters)
    // {
    //     $this->builder = $builder;
    //     $this->filters = $filters;
    //     return $this;
    // }
}