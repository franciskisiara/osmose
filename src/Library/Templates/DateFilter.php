<?php
namespace Agog\Osmose\Library\Templates;

use Carbon\Carbon;

class DateFilter
{
    protected $limit, $dates;

    protected $filteredDates = [];

    public function __construct($limit, $dates)
    {
        $this->limit = $limit;

        $this->dates = $dates;
    }

    /*
     * Return the dates in a filtered manner
     */
    public function filtered()
    {
        $defaults = config("osmose.limits")[ $this->limit];

        foreach($this->dates as $index => $date)
        {
            $presence = request($date);

            $this->filteredDates[$date] = $presence ? Carbon::parse($presence) : $defaults[$index];
        }

        return $this->filteredDates;
    }
}