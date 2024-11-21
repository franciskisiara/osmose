<?php

namespace Agog\Osmose\Library\Services\Traits;

use Carbon\Carbon;

trait OsmoseDatesTrait
{
    /**
     * Returns a timespan based on a range
     */
    public function rangeTimespan ($range)
    {
        return config("osmose.ranges.".request($range));
    }

    /**
     * get the timeline limits
     * @param array $timeLimits
     * @param string $defaultLimit [d,m,w,y]
     */
    public function limitTimespan ($limits, $defaultLimit = 'd')
    {
        $fromDate = request($limits['from'])
            ? Carbon::parse(request($limits['from']))->toDateTimeString()
            : null;

        $toDate = request($limits['to'])
            ? Carbon::parse(request($limits['to']))->endOfDay()->toDateTimeString()
            : today()->endOfDay()->toDateTimeString();

        if (! $fromDate) {

            if(! $defaultLimit)
                return null;

            $defaults = $this->setDefaults($defaultLimit);
            $fromDate = $defaults[0];
            $toDate = $defaults[1];
        }

        return [
            $fromDate, $toDate
        ];
    }
    
    
    /**
     * @param string $limit determines whether blind date is set in a month, week or day
     * @return array
     * Sets the defaults based on carbon's current date
     */
    public function setDefaults($limit)
    {
        if(! in_array($limit, ['d', 'w', 'm', 'y'])) {
            abort(500, 'Unknown Date Filter!');
        }

        if($limit == "d")
        {
            return [
                now()->startOfDay(), 
                now()->endOfDay(),
            ];
        }

        if($limit == "w")
        {
            return [
                now()->startOfWeek(), 
                now()->endOfWeek(),
            ];
        }

        if($limit == "m")
        {
            return [
                now()->startOfMonth(), 
                now()->endOfMonth(),
            ];
        }

        if($limit == "y")
        {
            return [
                now()->startOfYear(), 
                now()->endOfYear(),
            ];
        }
    }
}
