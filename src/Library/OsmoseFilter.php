<?php
namespace Agog\Osmose\Library;

use Agog\Osmose\Library\Services\Facades\Osmose;

class OsmoseFilter
{
    /**
     * @todo
     * Implent a withDates method
     * Determines if the queries are to be run with dates
     * Dates will be checked against created at in eloquent
     */
    public function withDates ($limit)
    {
        return $this;
    }

    /**
     * @param string $model model class that ought to be sieved
     * @return array
     */
    public function sieve($model)
    {
        $filters = $this->residue();

        return Osmose::model($model)->filter($filters);
    }
}