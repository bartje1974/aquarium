<?php

return [
    'required' => 'The :attribute is required',
    'numeric' => 'The :attribute must be a number',
    'min' => [
        'numeric' => 'The :attribute must be at least :min',
        'string' => 'The :attribute must be at least :min characters',
    ],
    'max' => [
        'numeric' => 'The :attribute must not exceed :max',
        'string' => 'The :attribute must not exceed :max characters',
    ],
    'date' => 'The :attribute must be a valid date',
    'before_or_equal' => 'The :attribute cannot be in the future',
    'in' => 'The selected :attribute is invalid',

    'attributes' => [
        'name' => 'name',
        'volume_liters' => 'volume',
        'type' => 'type',
        'started_at' => 'start date',
        'description' => 'description',
        'measured_on' => 'measurement date',
        'water_refresh_liters' => 'refreshed water',
        'notes' => 'notes',
    ],
];