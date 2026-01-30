<?php

return [
    'views' => [
        'index' => [
            'title' => [
                'add-curator-group' => 'Groupe de commissaires',
            ],
            'page-title' => [
                'add-curator-group' => 'Groupe de commissaires',
            ],
            'breadcrumbs' => [
                'add-curator-group' => 'Groupe de commissaires',
            ],
            'p' => [
                'text' => 'Collectif ou groupe de commissaires d\'expositions pour galeries, évènements ou galeries commerciales.',
                'button' => [
                    'create' => 'Créer',
                ],
            ],
        ],
        'create' => [
            'title' => [
                'add-curator-group' => 'Créer un profil - Groupe - Collectif de commissaires',
            ],
            'page-title' => [
                'add-curator-group' => 'Créer un profil - Groupe - Collectif de commissaires:',
            ],
            'breadcrumbs' => [
                'my-account' => 'Mon compte',
                'add-curator-group' => 'Créer un profil - Groupe - Collectif de commissaires',
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
                'my-curator-group' => 'Mon groupe de commissaires',
            ],
            'breadcrumbs' => [
                'my-curator-groups' => 'Mon groupe de commissaires',
            ],
            'p' => [
                'add-exhibit' => 'Tranférez vos expositions, sites Web et gérez toutes les informations de votre compte.',
                'make-account-private' => 'Rendre votre compte privé ou accessible au public.',
                'delete-the-account' => 'Supprimer le compte et tout son contenu - Vous devez d\'abord supprimer ou transférer vos comptes de groupe si vous en êtes l\'administrateur.',
                'sure' => 'Êtes-vous sûr ?',
                'button' => [
                    'go-to-account' => 'Accéder à mon Compte',
                    'unpublish' => 'Masquer',
                    'publish' => 'Publier',
                    'delete-account' => 'Supprimer le compte',
                ],
            ],
            'h3' => [
                'delete-group' => 'Supprimer le groupe de commissaires',
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
            'curator-group-created' => 'Groupe de commissaires créé avec succès.',
            'curator-group-updated' => 'Groupe de commissaires mis à jour avec succès.',
            'curator-group-deleted' => 'Groupe de commissaires supprimé avec succès.',
            'curator-group-enabled' => 'Groupe de commissaires activé avec succès.',
            'curator-group-disabled' => 'Groupe de commissaires désactivé avec succès.',
        ],
    ],
];
