<?php

use Carbon\Carbon;

return [

    /*
     * Sets the default carbon based date ranges
     */
    "ranges" => [
        "d" => [
            Carbon::now()->startOfDay(), Carbon::now()->endOfDay()
        ],

        "w" => [
            Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()
        ],

        "m" => [
            Carbon::now()->startOfMonth(), Carbon::now()->endOfMonth()
        ],

        "y" => [
            Carbon::now()->startOfYear(), Carbon::now()->endOfYear()
        ]
    ],

    /**
     * For automatically loading of eloquent models using the
     * osmose function, please specify the namespace under
     * which your application models have been defined
     */
    "namespace" => "App\\Models"

];
