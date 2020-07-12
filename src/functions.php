<?php

if (!function_exists('osmose'))
{
    /**
     * Sieves an eloquent model against a specified osmose filter
     *
     * @param  \Agog\Osmose\Library\OsmoseFilter $filter
     * @param  \Illuminate\Database\Eloquent\Model $model optional
     * @return \Illuminate\Http\Response
     */
    function osmose ($filter, $model = null)
    {
        if (is_null($model))
        {
            $namespace = config('osmose.namespace');

            $namespace = $namespace ? trim($namespace, "/") : "App";

            $filterName = substr($filter, strrpos($filter, "\\") + 1);

            $model =  "$namespace\\" . str_replace("Filter", "", $filterName);
        }

        return (new $filter)->sieve($model);
    }
}

