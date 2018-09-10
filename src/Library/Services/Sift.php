<?php
namespace Kisiara\Osmose\Library\Services;

class Sift
{
    use MeshTrait;

    protected $builder, $filters;

    protected $callbacks = [
        "meshColumn", "meshColumnWithRelationship", "meshCallback"
    ];

    /*
     * Sifts an entry that has a callback passed
     */
    public function sift($residue)
    {
        foreach($residue as $key => $element)
        {
            foreach($this->callbacks as $callback)
            {
                if(isset($this->filters[$key]))
                    $this->mesh($key, trim($element, ","), $callback);
            }
        }

        return $this->builder;
    }

    /*
     * Aggregated the items to be sifted with their respective filters
     */
    public function aggregate($builder, $filters)
    {
        $this->builder = $builder;
        $this->filters = $filters;
        return $this;
    }
}