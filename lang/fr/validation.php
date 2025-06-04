<?php

return [
    'required' => 'Le champ :attribute est obligatoire.',
    'numeric' => 'Le champ :attribute doit être un nombre.',
    'min' => [
        'numeric' => 'Le champ :attribute doit être au moins :min.',
        'string' => 'Le champ :attribute doit contenir au moins :min caractères.',
    ],
    'max' => [
        'numeric' => 'Le champ :attribute ne peut pas être supérieur à :max.',
        'string' => 'Le champ :attribute ne peut pas contenir plus de :max caractères.',
    ],
    'date' => 'Le champ :attribute doit être une date valide.',
    'before_or_equal' => 'Le champ :attribute doit être une date antérieure ou égale à :date.',
    'in' => 'La valeur sélectionnée pour :attribute est invalide.',

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