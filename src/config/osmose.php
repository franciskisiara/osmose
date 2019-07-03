<?php

use Carbon\Carbon;

return [

    /*
     * Sets the default carbon based dates
     */
    "limits" => [
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
    ]

];