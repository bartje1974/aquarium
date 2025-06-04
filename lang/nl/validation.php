<?php

return [
    'required' => ':Attribute is verplicht',
    'numeric' => ':Attribute moet een getal zijn',
    'min' => [
        'numeric' => ':Attribute moet minimaal :min zijn',
        'string' => ':Attribute moet minimaal :min tekens bevatten',
    ],
    'max' => [
        'numeric' => ':Attribute mag maximaal :max zijn',
        'string' => ':Attribute mag maximaal :max tekens bevatten',
    ],
    'date' => ':Attribute moet een geldige datum zijn',
    'before_or_equal' => ':Attribute mag niet in de toekomst liggen',
    'in' => ':Attribute moet één van de volgende waardes zijn: :values',

    'attributes' => [
        'name' => 'naam',
        'volume_liters' => 'volume',
        'type' => 'type',
        'started_at' => 'startdatum',
        'description' => 'beschrijving',
        'measured_on' => 'meetdatum',
        'water_refresh_liters' => 'ververst water',
        'notes' => 'notities',
    ],
];