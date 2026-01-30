<?php

return [
    'views' => [
        'create' => [
            'title' => 'Créer un nouveau membre',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'members' => 'Membres',
                'new-member' => 'Nouveau membre',
            ],
            'label' => [
                'first-name' => 'Prénom',
                'last-name' => 'Nom',
                'email' => 'Courrier',
                'password' => 'Mot de passe',
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
                'delete-member' => 'Supprimer le membre',
            ],
        ],
        'edit' => [
            'title' => 'Modifier le membre',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'members' => 'Membres',
            ],
            'label' => [
                'first-name' => 'Prénom',
                'last-name' => 'Nom',
                'email' => 'Courriel',
            ],
            'button' => [
                'save' => 'Sauvegarder les modifications',
            ],
        ],
        'index' => [
            'title' => 'Membres',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'members' => 'Membres',
            ],
            'button' => [
                'new' => 'Créer un nouveau membre',
            ],
            'table' => [
                'thead' => [
                    'tr' => [
                        'th' => [
                            'no' => 'No',
                            'first-name' => 'Prénom',
                            'last-name' => 'Nom',
                            'email' => 'Courriel',
                            'username' => "Nom d'utilisateur",
                            'actions' => 'Actions',
                        ],
                    ],
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'home' => 'Accueil',
                'members' => 'Membres',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'member-created' => 'Membre créée avec succès.',
            'member-updated' => 'Membre modifié avec succès.',
            'member-deleted' => 'Membre supprimé avec succès.',
        ],
    ],
];
