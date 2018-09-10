<?php

return [

    /*
     * Sets the default carbon based dates
     */
    "limits" => [
        "d" => [
            now()->startOfDay(), now()->endOfDay()
        ],

        "w" => [
            now()->startOfWeek(), now()->endOfWeek()
        ],

        "m" => [
            now()->startOfMonth(), now()->endOfMonth()
        ]
    ]

];