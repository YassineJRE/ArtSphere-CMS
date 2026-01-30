<?php

return [
    'views' => [
        'index' => [
            'title' => [
                'add-artist-group' => 'Groupe d\'artistes',
            ],
            'page-title' => [
                'add-artist-group' => 'Groupe d\'artistes',
            ],
            'breadcrumbs' => [
                'account' => 'Mon compte',
                'add-artist-group' => 'Groupe d\'artistes',
            ],
            'p' => [
                'text' => 'Collectif ou groupe d\'artistes ayant des expositions à présenter ou de la documentation artistique à archiver.',
                'button' => [
                    'create' => 'Créer',
                ],
            ],
        ],
        'create' => [
            'title' => [
                'add-artist-group' => 'Créer un profil - Groupe - Collectif d\'artistes',
            ],
            'page-title' => [
                'add-artist-group' => 'Créer un profil - Groupe - Collectif d\'artistes:',
            ],
            'breadcrumbs' => [
                'my-account' => 'Mon compte',
                'add-artist-group' => 'Créer un profil - Groupe - Collectif d\'artistes',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'group-name' => 'Nom du groupe - collectif:',
                        'address' => 'Adresse:',
                        'city' => 'Ville:',
                        'country' => 'Pays:',
                        'member-of' => 'Membre de:',
                        'biography' => 'Biographie:',
                        'additional-information-title' => 'Ajoutez un titre',
                        'additional-information-content' => 'Ajouter des informations supplémentaires:',
                        'art-practice-type' => 'Type de pratique artistique:',
                        'specify' => 'Spécifier:',
                        'status' => 'Statut:',
                    ],
                    'button' => [
                        'create' => 'Créer',
                    ],
                ],
            ],
        ],
        'edit' => [
            'breadcrumbs' => [
                'my-artist-groups' => 'My artist-groups',
                'edit' => 'Modifier',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'group-name' => 'Nom du groupe - collectif:',
                        'address' => 'Adresse:',
                        'city' => 'Ville:',
                        'country' => 'Pays:',
                        'member-of' => 'Membre de:',
                        'biography' => 'Biographie:',
                        'additional-information-title' => 'Ajoutez un titre',
                        'additional-information-content' => 'Ajouter des informations supplémentaires:',
                        'art-practice-type' => 'Type de pratique artistique:',
                        'specify' => 'Spécifier:',
                        'status' => 'Statut:',
                    ],
                    'button' => [
                        'save' => 'Sauvegarder',
                    ],
                ],
            ],
        ],
        'show' => [
            'title' => [
                'my-artist-group' => 'Mon groupe d\'artistes',
            ],
            'breadcrumbs' => [
                'my-artist-groups' => 'Mon groupe d\'artistes',
            ],
            'p' => [
                'add-exhibit' => 'Ajoutez vos expositions, sites Web et gérez toutes les informations de votre compte',
                'make-account-private' => 'Rendre votre compte privé ou accessible au public',
                'delete-the-account' => 'Supprimer le compte et tout son contenu. Si vous êtes un administrateur, vous pouvez transférer le compte sinon vous devrez d\'abord supprimer les membres du groupe.',
                'sure' => 'Êtes-vous sûr ?',
                'button' => [
                    'go-to-account' => 'Accéder à mon Compte',
                    'unpublish' => 'Masquer',
                    'publish' => 'Publier',
                    'delete-account' => 'Supprimer le compte',
                ],
            ],
            'h3' => [
                'delete-group' => 'Supprimer le groupe d\'artistes',
            ],
            'form' => [
                'button' => [
                    'delete' => 'Supprimer',
                ],
            ],
        ],
    ],
    'message' => [
        'success' => [
            'artist-group-created' => 'Groupe d\'artistes créé avec succès.',
            'artist-group-updated' => 'Groupe d\'artistes mis à jour avec succès.',
            'artist-group-deleted' => 'Groupe d\'artistes supprimé avec succès.',
            'artist-group-enabled' => 'Groupe d\'artistes activé avec succès.',
            'artist-group-disabled' => 'Groupe d\'artistes désactivé avec succès.',
        ],
    ],
];
