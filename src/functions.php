<?php

if (!function_exists('osmose'))
{
    /**
     * Sieves an eloquent model against a specified osmose filter class
     *
     * @param  string  $filter
     * @param  \Illuminate\Database\Eloquent\Model  $model optional
     * @return \Illuminate\Database\Eloquent\Builder
     */
    function osmose (string $filter, $model = null): \Illuminate\Database\Eloquent\Builder
    {
        if (is_null($model))
        {
            $namespace = config('osmose.namespace');

            $namespace = $namespace ? trim($namespace, "/") : "App\\Models";

            $filterName = substr($filter, strrpos($filter, "\\") + 1);

            $model =  "$namespace\\" . str_replace("Filter", "", $filterName);
        }

        return (new $filter)->sieve($model);
    }
}

