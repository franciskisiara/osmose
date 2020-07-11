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
            ? Carbon::parse(request($limits['from']))->toDateTimeString()
            : null;

        $toDate = request($limits['to'])
            ? Carbon::parse(request($limits['to']))->endOfDay()->toDateTimeString()
            : today()->endOfDay()->toDateTimeString();

        if (!$fromDate) return null;

        return [
            $fromDate, $toDate
        ];
    }
}
