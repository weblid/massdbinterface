<?php

return [

    'models' => [
        
        App\Location::class => [
            'name' => 'Locations',
            'unique' => 'slug',
        ],

        App\Sector::class => [
            'name' => 'Sector',
            'unique' => 'slug',
        ]
    ],

];
