<?php

return [
    'list' => [
        'title' => 'Problems',
        'empty' => 'No problems registered.',
        'add' => 'Add Problem',
    ],
    'table' => [
        'type' => 'Type',
        'problem' => 'Problem',
        'start_date' => 'Start Date',
        'status' => 'Status',
        'action' => 'Action',
    ],
    'create' => [
        'title' => 'New Problem',
        'submit' => 'Add Problem',
        'fields' => [
            'type' => [
                'label' => 'Problem Type',
                'placeholder' => 'Select type...',
            ],
            'title' => 'Title',
            'description' => 'Description',
            'started_on' => 'Start Date',
        ],
    ],
    'types' => [
        'ziekte' => 'Disease',
        'algen' => 'Algae',
        'apparatuur' => 'Equipment',
        'overig' => 'Other',
    ],
    'status' => [
        'active' => 'Active',
        'resolved' => 'Resolved',
    ],
    'actions' => [
        'resolve' => 'Resolve',
    ],
    'modal' => [
        'title' => 'Resolve Problem',
        'solution' => 'Solution',
        'resolved_date' => 'Date Resolved',
        'cancel' => 'Cancel',
        'save' => 'Save',
    ],
    'messages' => [
        'resolved' => 'Problem has been marked as resolved.',
    ],
];