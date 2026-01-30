<?php

return [
    'views' => [
        'create' => [
            'title' => 'Créer un nouvel utilisateur',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'users' => 'Utilisateurs',
                'new-user' => 'Nouvel utilisateur',
            ],
            'label' => [
                'first-name' => 'Prénom',
                'last-name' => 'Nom',
                'email' => 'Courriel',
                'roles' => 'Rôles',
                'can-access-admin' => [
                    'question' => 'Accès administrateur ?',
                    'yes' => 'Oui',
                ],
            ],
            'button' => [
                'save' => 'Sauvegarder',
            ],
        ],
        'datatable-actions' => [
            'button' => [
                'edit' => 'Modifier',
                'delete' => 'Supprimer',
                'destroy' => 'Détruire',
                'link' => "Envoyer le lien d'activation",
                'restore' => 'Restaurer',
            ],
            'paragraph' => [
                'sure' => 'Êtes vous sûr?',
            ],
            'h3' => [
                'delete-user' => "Supprimer l'utilisateur",
                'destroy-user' => "Détruire l'utilisateur",
            ],
        ],
        'edit' => [
            'title' => 'Utilisateurs',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'users' => 'Utilisateurs',
            ],
            'label' => [
                'first-name' => 'Prénom',
                'last-name' => 'Nom',
                'email' => 'Courriel',
                'roles' => 'Rôles',
            ],
            'button' => [
                'save' => 'Sauvegarder les modifications',
            ],
        ],
        'index' => [
            'title' => 'Utilisateurs',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'users' => 'Utilisateurs',
            ],
            'button' => [
                'new' => 'Créer un nouvel utilisateur',
            ],
            'table' => [
                'thead' => [
                    'tr' => [
                        'th' => [
                            'no' => 'No',
                            'first-name' => 'Prénom',
                            'last-name' => 'Nom',
                            'email' => 'Courriel',
                            'roles' => 'Rôles',
                            'actions' => 'Actions',
                        ],
                    ],
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'home' => 'Accueil',
                'users' => 'Utilisateurs',
            ],
            'h4' => [
                'profile-details' => 'Détails du profil',
                'roles' => 'Rôles',
                'recent-activities' => 'Activités récentes',
            ],
            'button' => [
                'edit' => 'Modifier',
            ],
            'label' => [
                'first-name' => 'Prénom',
                'last-name' => 'Nom',
                'email' => 'Courriel',
                'username' => "Nom d'utilisateur",
                'registered-at' => 'Enregistré à',
                'last-updated' => 'Dernière mise à jour',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'user-created' => 'Utilisateur créé avec succès.',
            'user-updated' => 'Utilisateur modifié avec succès.',
            'user-deleted' => 'Utilisateur supprimé avec succès.',
        ],
    ],
];
