<?php

return [
    'views' => [
        'create' => [
            'title' => 'Créer une nouvelle notification',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'user-notifications' => 'Notifications',
                'new-user-notification' => 'Nouvelle notification',
            ],
            'label' => [
                'profile-id' => 'ID du profil',
                'ad-id' => "ID de l'annonce",
                'comment-id' => 'ID du commentaire',
                'review-id' => "ID de l'avis",
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
                'delete-user-notification' => 'Supprimer la notification',
            ],
        ],
        'edit' => [
            'title' => 'Modifier la notification',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'user-notifications' => 'Notifications',
            ],
            'label' => [
                'profile-id' => 'ID du profil',
                'ad-id' => "ID de l'annonce",
                'comment-id' => 'ID du commentaire',
                'review-id' => "ID de l'avis",
            ],
            'button' => [
                'save' => 'Sauvegarder',
            ],
        ],
        'index' => [
            'title' => 'Notifications',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'user-notifications' => 'Notifications',
            ],
            'button' => [
                'new' => 'Créer une nouvelle notification',
            ],
            'table' => [
                'thead' => [
                    'tr' => [
                        'th' => [
                            'no' => 'No',
                            'user-id' => "ID de l'utilisateur",
                            'ad-id' => "ID de l'annonce",
                            'comment-id' => 'ID du commentaire',
                            'review-id' => "ID de l'avis",
                            'contact-id' => 'ID du contact',
                            'is-read' => 'Lu',
                            'actions' => 'Actions',
                        ],
                    ],
                ],
            ],
        ],
        'show' => [
            'title' => 'Montrer la notification',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'user-notifications' => 'Notifications',
            ],
            'content' => [
                'id' => 'Identifiant:',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'user-notification-created' => 'Notification créée avec succès.',
            'user-notification-updated' => 'Notification modifiée avec succès.',
            'user-notification-deleted' => 'Notification supprimée avec succès.',
        ],
    ],
];
