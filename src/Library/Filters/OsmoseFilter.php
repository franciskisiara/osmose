<?php
namespace Agog\Osmose\Library\Filters;

class OsmoseFilter
{
    /*
     * Disabled date filtration on the result set
     */
    public function withoutDates ()
    {

    }
}



// /*
//      * Return the filters as are set in the form submitting the request
//      */
//     public function getFilters($limit, $dates)
//     {
//         $exceptions = ["_token"];

//         $filteredDates = [];

//         if(is_array($dates))
//         {
//             $filteredDates = (new DateFilter($limit, $dates))->filtered();

//             $exceptions = ["_token"] + $dates;
//         }

//         return array_merge([
//             "date" => $filteredDates
//         ], request()->except($exceptions));
//     }

//     /*
//      * Return the intital builder given the date parameters
//      */
//     public function getBuilder($model, $dates)
//     {
//         $builder = $model::query();

//         if(!empty($dates))
//         {
//             $builder = $builder->whereBetween("created_at", $dates);
//         }

//         return $builder;
//     }