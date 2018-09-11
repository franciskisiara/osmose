<?php
namespace Agog\Osmose\Library\Services;

trait MeshTrait
{
    /*
     * Check the status of an element as it passes throught the sieve
     */
    public function mesh($key, $element, $callback)
    {
        if(method_exists($this, $callback))
        {
            $this->$callback($key, $element);
        }
    }

    /*
     * Filter the elements that have a callback in them
     */
    public function meshCallback($key, $element)
    {
        if(is_callable($element))
        {
            $this->builder = $element($this->filters[$key], $this->builder);
        }
    }

    /*
     * Filter the items that have the column being filtered in the same Eloquent model
     */
    public function meshColumn($key, $element)
    {
        if(strpos($element, 'column') !== false and strpos($element, ',') == false)
        {
            $this->builder = $this->builder->where(
                explode(":", $element)[1], $this->filters[$key]
            );
        }
    }

    /*
     * Filter the items that have the column being filtered in the same Eloquent model
     */
    public function meshColumnWithRelationship($key, $element)
    {
        if(strpos($element, 'column') !== false and strpos($element, ',') !== false)
        {
            $partition = explode(",", explode(":", $element)[1]);

            $this->builder = $this->builder->whereHas($partition[1], function($query) use($partition, $key){

                $query->where($partition[0], $this->filters[$key]);

            });
        }
    }
}