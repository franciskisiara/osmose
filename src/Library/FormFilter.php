<?php
namespace Agog\Osmose\Library;

use Agog\Osmose\Library\Services\Facades\Residue;
use Agog\Osmose\Library\Templates\OsmoseFilter;

class FormFilter extends OsmoseFilter
{
    /**
     * @var string $limit determines the range of the dates being passed
     */
    protected $limit = "m";

    /**
     * @var array|boolean $dates determines the input name for dates
     */
    protected $dates = [
        "start-date", "end-date"
    ];

    /**
     * @param string $model model class that ought to be sieved
     * @return array
     */
    public function sieve($model)
    {
        $filters = $this->getFilters($this->limit, $this->dates);

        return Residue::aggregate(
            $this->getBuilder($model, $filters["date"]), $filters
        )->sift($this->residue());
    }
}