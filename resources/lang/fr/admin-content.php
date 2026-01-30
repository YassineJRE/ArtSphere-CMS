<?php

return [
    'views' => [
        'create' => [
            'title' => 'Créer un nouveau contenu',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'contents' => 'Contenu',
                'new-content' => 'Nouveau contenu',
            ],
            'label' => [
                'key' => 'Clé',
                'type' => 'Type',
                'status' => 'Statut',
                'content' => 'Contenu',
            ],
            'button' => [
                'save' => 'Sauvegarder',
            ],
        ],
        'datatable-actions' => [
            'button' => [
                'edit' => 'Modifier',
                'delete' => 'Supprimer',
                'restore' => 'Restaurer',
            ],
            'paragraph' => [
                'sure' => 'Êtes vous sûr?',
            ],
            'h3' => [
                'delete-content' => 'Supprimer le contenu',
            ],
        ],
        'edit' => [
            'title' => 'Modifier le contenu',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'contents' => 'Contenu',
            ],
            'label' => [
                'key' => 'Clé',
                'type' => 'Type',
                'status' => 'Statut',
                'content' => 'Contenu',
            ],
            'button' => [
                'save' => 'Sauvegarder',
            ],
        ],
        'index' => [
            'title' => 'Contenu',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'contents' => 'Contenu',
            ],
            'button' => [
                'new' => 'Créer un nouveau contenu',
            ],
            'table' => [
                'thead' => [
                    'tr' => [
                        'th' => [
                            'no' => 'No',
                            'key' => 'Clé',
                            'type' => 'Type',
                            'content' => 'Contenu',
                            'status' => 'Statut',
                            'actions' => 'Actions',
                        ],
                    ],
                ],
            ],
        ],
        'show' => [
            'title' => 'Montrer le contenu',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'contents' => 'Contenu',
            ],
            'content' => [
                'id' => 'Identifiant:',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'content-created' => 'Contenu créée avec succès.',
            'content-updated' => 'Contenu modifié avec succès.',
            'content-deleted' => 'Contenu supprimé avec succès.',
        ],
    ],
];
