<?php

return [
    'views' => [
        'create' => [
            'title' => 'Écrire un nouvel avis',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'reviews' => 'Avis',
                'new-review' => 'Nouvel avis',
            ],
            'label' => [
                'from' => 'De',
                'to' => 'À',
                'message' => 'Message',
                'is-positive' => 'Est-ce positif?',
                'processed' => 'Traité',
                'is-sent' => 'Envoyé',
                'is-read' => 'Lu',
                'status' => 'Statut',
            ],
            'button' => [
                'save' => 'Sauvegarder',
            ],
        ],
        'datatable-actions' => [
            'button' => [
                'edit' => 'Modifier',
                'delete' => 'Supprimer',
            ],
            'paragraph' => [
                'sure' => 'Êtes vous sûr?',
            ],
            'h3' => [
                'delete-review' => "Supprimer l'avis",
            ],
        ],
        'edit' => [
            'title' => "Modifier l'avis",
            'breadcrumbs' => [
                'home' => 'Accueil',
                'reviews' => 'Avis',
            ],
            'label' => [
                'from' => 'De',
                'to' => 'À',
                'message' => 'Message',
                'is-positive' => 'Est-ce positif?',
                'processed' => 'Traité',
                'is-sent' => 'Envoyé',
                'is-read' => 'Lu',
                'status' => 'Statut',
            ],
            'button' => [
                'save' => 'Sauvegarder les modifications',
            ],
        ],
        'index' => [
            'title' => 'Avis',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'reviews' => 'Avis',
            ],
            'button' => [
                'new' => 'Créer un nouvel avis',
            ],
            'table' => [
                'thead' => [
                    'tr' => [
                        'th' => [
                            'no' => 'No',
                            'from' => 'De',
                            'to' => 'À',
                            'ad-id' => "Identifiant de l'annonce",
                            'message' => 'Message',
                            'is-positive' => 'Est-ce positif?',
                            'actions' => 'Actions',
                        ],
                    ],
                ],
            ],
        ],
        'show' => [
            'title' => "Montrer l'avis",
            'breadcrumbs' => [
                'home' => 'Accueil',
                'reviews' => 'Avis',
            ],
            'content' => [
                'id' => 'Identifiant:',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'review-created' => 'Avis créée avec succès.',
            'review-updated' => 'Avis modifié avec succès.',
            'review-deleted' => 'Avis supprimé avec succès.',
        ],
    ],
];
