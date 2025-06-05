<?php

return [
    'list' => [
        'title' => 'Problemen',
        'empty' => 'Geen problemen geregistreerd.',
        'add' => 'Probleem Toevoegen',
    ],
    'table' => [
        'type' => 'Type',
        'problem' => 'Probleem',
        'start_date' => 'Start Datum',
        'status' => 'Status',
        'action' => 'Actie',
    ],
    'create' => [
        'title' => 'Nieuw Probleem',
        'submit' => 'Probleem Toevoegen',
        'fields' => [
            'type' => [
                'label' => 'Type Probleem',
                'placeholder' => 'Selecteer type...',
            ],
            'title' => 'Titel',
            'description' => 'Beschrijving',
            'started_on' => 'Start Datum',
        ],
    ],
    'types' => [
        'illness' => 'Ziekte',
        'algae' => 'Algen',
        'equipment' => 'Apparatuur',
        'other' => 'Overig',
    ],
    'status' => [
        'active' => 'Actief',
        'resolved' => 'Opgelost',
    ],
    'actions' => [
        'resolve' => 'Oplossen',
    ],
    'modal' => [
        'title' => 'Probleem Oplossen',
        'solution' => 'Oplossing',
        'resolved_date' => 'Datum Opgelost',
        'cancel' => 'Annuleren',
        'save' => 'Opslaan',
    ],
    'messages' => [
        'created' => 'Probleem succesvol geregistreerd.',
        'updated' => 'Probleem succesvol bijgewerkt.',
        'resolved' => 'Probleem gemarkeerd als opgelost.',
        'deleted' => 'Probleem succesvol verwijderd.',
    ],
];