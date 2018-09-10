<?php
namespace Kisiara\Osmose\Library;

use Kisiara\Osmose\Library\Templates\OsmoseFilter;

class FormFilter extends OsmoseFilter
{
    /**
     * @var string $limit determines the range of the dates being passed
     */
    protected $limit = "m";

    /**
     * @var array|boolean $dates determines the input name for dates
     */
//    protected $dates = [
//        "start-date", "end-date"
//    ];

    protected $dates = false;

    protected $residue = [

    ];

    /**
     * @param string $model model class that ought to be sieved
     * @return array
     */
    public function sieve($model)
    {
        $filters = $this->getFilters($this->limit, $this->dates);

        $builder = $this->dates ? $model::whereBetween("created_at", $filters["date"]) : $model::query();

        foreach($this->residue as $filter => $elements)
        {
            if(isset($filters[$filter]) and $filters[$filter])
            {
                if(is_callable($elements))
                {
                    $builder = $elements($filters[$filter], $builder);
                }
                else
                {
                    $partition = explode("|", $elements);

                    if(count($partition) > 1)
                    {
                        $builder = $builder->whereHas($partition[1], function($query) use($partition, $filters, $filter){

                            $query->where($partition[0], $filters[$filter]);

                        });
                    }
                    else
                    {
                        $builder = $builder->where($partition[0], $filters[$filter]);
                    }
                }
            }
        }

        return $builder;
    }

    /*
     * Return the date filters
     */
//    public function dates()
//    {
//        return session("filters")["date"];
//    }
}