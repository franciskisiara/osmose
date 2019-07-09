<?php
namespace Agog\Osmose\Library;

use Agog\Osmose\Library\Services\Facades\Osmose;

class OsmoseFilter
{
    protected $range = "range";

    /**
     * @param string $model model class that ought to be sieved
     * @return array
     */
    public function sieve ($model)
    {
        $filters = $this->residue();

        return Osmose::model($model)->range($this->range)->filter($filters);
    }
}