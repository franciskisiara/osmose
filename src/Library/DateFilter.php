<?php
namespace Agog\Osmose\Library;

class DateFilter
{
    /**
     * Return the column name to be filtered
     *
     * @return string
     */
    public function column () : string
    {
        return 'created_at';
    }

    /**
     * Return the range to be used in filter
     *
     * @return null|string null disables range filters, string indicates request parameter
     */
    public function range ()
    {
        return null;
    }

    /**
     * Returns the limits to be filtered in a date filter
     *
     * @return array
     */
    public function limits () : array
    {
        return [

        ];
    }
}
