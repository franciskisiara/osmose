<?php
namespace Agog\Osmose\Library;

use Agog\Osmose\Library\Services\Facades\Osmose;

class OsmoseFilter extends DateFilter
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
     * @return string
     */
    public function range ()
    {
        return 'range';
    }

    /**
     * Returns the limits to be filtered in a date filter
     *
     * @return array
     */
    public function limits () : array
    {
        return [
            'from'  => 'from',
            'to'    => 'to'
        ];
    }

    /**
     * @param string $model model class that ought to be sieved
     * @return array
     */
    public function sieve ($model)
    {
        $filters = $this->residue();
        $binds = method_exists($this, 'bound') ? $this->bound() : [];

        return Osmose::model($model)
            ->timeline(
                $this->column(),
                $this->range(),
                $this->limits()
            )
            ->bound($binds)
            ->filter($filters);
    }
}
