<?php
namespace Agog\Osmose\Library;

use Agog\Osmose\Library\Services\Facades\Osmose;

class OsmoseFilter
{
    /**
     * @param string $model model class that ought to be sieved
     * @return array
     */
    public function sieve ($model)
    {
        $filters = $this->residue();

        $range = property_exists($this, 'range') ? $this->range : 'range';

        return Osmose::model($model)->range($range)->filter($filters);
    }
}