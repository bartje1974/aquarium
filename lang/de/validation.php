<?php


return [
    'required' => 'Das Feld :attribute ist erforderlich.',
    'numeric' => 'Das Feld :attribute muss eine Zahl sein.',
    'min' => [
        'numeric' => 'Das Feld :attribute muss mindestens :min sein.',
        'string' => 'Das Feld :attribute muss mindestens :min Zeichen lang sein.',
    ],
    'max' => [
        'numeric' => 'Das Feld :attribute darf maximal :max sein.',
        'string' => 'Das Feld :attribute darf maximal :max Zeichen lang sein.',
    ],
    'date' => 'Das Feld :attribute muss ein gültiges Datum sein.',
    'before_or_equal' => 'Das Feld :attribute muss ein Datum vor oder gleich :date sein.',
    'in' => 'Der ausgewählte Wert für :attribute ist ungültig.',
];