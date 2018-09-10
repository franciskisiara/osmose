<?php
namespace Kisiara\Osmose\Library\Templates;

class OsmoseFilter
{
    /*
     * Return the filters as are set in the form submitting the request
     */
    public function getFilters($limit, $dates)
    {
        $exceptions = ["_token"];

        $filteredDates = [];

        if($dates)
        {
            $filteredDates = (new DateFilter($limit, $dates))->filtered();

            $exceptions = ["_token"] + $dates;
        }

        return array_merge([
            "date" => $filteredDates
        ], request()->except($exceptions));
    }
}