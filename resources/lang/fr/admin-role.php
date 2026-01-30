<?php

return [
    'views' => [
        'create' => [
            'title' => 'Créer un nouveau rôle',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'roles' => 'Rôles',
                'new-role' => 'Nouveau rôle',
            ],
            'label' => [
                'name' => 'Nom',
                'permission' => 'Autorisations',
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
                'delete-role' => 'Supprimer le rôle',
            ],
        ],
        'edit' => [
            'breadcrumbs' => [
                'home' => 'Accueil',
                'roles' => 'Rôles',
            ],
            'label' => [
                'name' => 'Nom',
                'permission' => 'Autorisations',
            ],
            'button' => [
                'save' => 'Sauvegarder les modifications',
            ],
        ],
        'index' => [
            'title' => 'Rôles',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'roles' => 'Rôles',
            ],
            'button' => [
                'new' => 'Créer un nouveau rôle',
            ],
            'table' => [
                'thead' => [
                    'tr' => [
                        'th' => [
                            'no' => 'No',
                            'name' => 'Nom',
                            'guard-name' => 'Nom du gardien',
                            'actions' => 'Actions',
                        ],
                    ],
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'home' => 'Accueil',
                'roles' => 'Rôles',
            ],
            'h2' => [
                'name' => 'Nom',
                'guard-name' => 'Nom du gardien',
                'permission' => 'Autorisations',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'role-created' => 'Rôle créée avec succès.',
            'role-updated' => 'Rôle modifié avec succès.',
            'role-deleted' => 'Rôle supprimé avec succès.',
        ],
    ],
];
