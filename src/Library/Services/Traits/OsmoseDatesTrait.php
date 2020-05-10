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

    public function limitTimespan ($limits)
    {
        $fromDate = request($limits['from'])
            ? Carbon::parse(request($limits['from']))
            : null;

        $toDate = request($limits['to']) ?? now();

        if (!$fromDate) return null;

        return [
            $fromDate, $toDate
        ];
    }
}
