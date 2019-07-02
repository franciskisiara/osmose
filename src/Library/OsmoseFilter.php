<?php
namespace Agog\Osmose\Library;

use Agog\Osmose\Library\Services\Facades\Residue;

class OsmoseFilter
{
    // /**
    //  * @var string $limit determines the range of the dates being passed
    //  */
    // protected $limit = "m";

    // /**
    //  * @var array|boolean $dates determines the input name for dates
    //  */
    // protected $dates = [
    //     "start-date", "end-date"
    // ];

    /**
     * @param string $model model class that ought to be sieved
     * @return array
     */
    public function sieve($model)
    {
        // $filters = $this->getFilters($this->limit, $this->dates);

        $filters = $this->initialiseOsmoseFilter();

        // return Residue::aggregate(
        //     $this->getBuilder($model, $filters["date"]), $filters
        // )->sift($this->residue());
    }

    /*
     * Initilaise the filter method that will be used to get the eloqeunt collection
     */
    public function initialiseOsmoseFilter ()
    {

    }




     /*
     * Return the filters as are set in the form submitting the request
     */
    public function getFilters($limit, $dates)
    {
        $exceptions = ["_token"];

        $filteredDates = [];

        if(is_array($dates))
        {
            $filteredDates = (new DateFilter($limit, $dates))->filtered();

            $exceptions = ["_token"] + $dates;
        }

        return array_merge([
            "date" => $filteredDates
        ], request()->except($exceptions));
    }

    // /*
    //  * Return the intital builder given the date parameters
    //  */
    // public function getBuilder($model, $dates)
    // {
    //     $builder = $model::query();

    //     if(!empty($dates))
    //     {
    //         $builder = $builder->whereBetween("created_at", $dates);
    //     }

    //     return $builder;
    // }
}