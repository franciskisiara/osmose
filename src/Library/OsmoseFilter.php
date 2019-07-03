<?php
namespace Agog\Osmose\Library;

use Agog\Osmose\Library\Services\Facades\Osmose;

class OsmoseFilter
{
    /**
     * @param string $model model class that ought to be sieved
     * @return array
     */
    public function sieve($model)
    {
        $filters = $this->residue();

        return Osmose::model($model)->filter($filters);

        // Osmose::filter();
        // dd();
        // return [];
        // Osmose::build($this->residue());


        // $filters = $this->getFilters($this->limit, $this->dates);

        // $filters = $this->initialiseOsmoseFilter();

        // return Residue::aggregate(
        //     $this->getBuilder($model, $filters["date"]), $filters
        // )->sift($this->residue());
    }
}