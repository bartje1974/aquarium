<?php

return [
    'list' => [
        'title' => 'Problèmes',
        'empty' => 'Aucun problème enregistré.',
        'add' => 'Ajouter un problème',
    ],
    'table' => [
        'type' => 'Type',
        'problem' => 'Problème',
        'start_date' => 'Date de début',
        'status' => 'Statut',
        'action' => 'Action',
    ],
    'create' => [
        'title' => 'Nouveau problème',
        'submit' => 'Ajouter un problème',
        'fields' => [
            'type' => [
                'label' => 'Type de problème',
                'placeholder' => 'Sélectionnez le type...',
            ],
            'title' => 'Titre',
            'description' => 'Description',
            'started_on' => 'Date de début',
        ],
    ],
    'types' => [
        'ziekte' => 'Maladie',
        'algen' => 'Algues',
        'apparatuur' => 'Équipement',
        'overig' => 'Autre',
    ],
    'status' => [
        'active' => 'Actif',
        'resolved' => 'Résolu',
    ],
    'actions' => [
        'resolve' => 'Résoudre',
    ],
    'modal' => [
        'title' => 'Résoudre le problème',
        'solution' => 'Solution',
        'resolved_date' => 'Date de résolution',
        'cancel' => 'Annuler',
        'save' => 'Enregistrer',
    ],
    'messages' => [
        'resolved' => 'Le problème a été marqué comme résolu.',
    ],
];