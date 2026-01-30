<?php

return [
    'views' => [
        'index' => [
            'title' => [
                'artist-group' => 'Mon profil d\'artiste',
                'my-collections' => 'Ma collection',
            ],
            'page-title' => [
                'my-collections' => 'Mes collections',
            ],
            'breadcrumbs' => [
                'my-collections' => 'Mes collections',
            ],
            'span' => [
                'add-collection' => 'Créer un fichier',
            ],
            'ul' => [
                'li' => [
                    'edit' => 'Modifier',
                    'span' => [
                        'published' => 'Publié',
                        'unpublished' => 'Masqué',
                    ],
                    'button' => [
                        'unpublish' => 'Masquer',
                        'publish' => 'Publier',
                        'delete' => 'Supprimer',
                        'h3' => [
                            'delete-collection' => 'Supprimer la collection',
                        ],
                        'p' => [
                            'sure' => 'Êtes vous sûr ?',
                        ],
                        'form' => [
                            'button' => [
                                'delete' => 'Supprimer',
                            ],
                        ],
                    ],
                ],
            ],
        ],
        'create' => [
            'title' => [
                'add-collection' => 'Créer un fichier',
            ],
            'page-title' => [
                'add-collection' => 'Créer un fichier',
            ],
            'breadcrumbs' => [
                'my-collections' => 'Mes collections',
                'add-collection' => 'Créer un fichier',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'type' => 'Type:',
                        'title' => 'Titre:',
                        'description' => 'Description:',
                        'additional-information-title' => 'Ajoutez un titre',
                        'additional-information-content' => 'Contenu des informations complémentaires:',
                        'status' => 'Statut:',
                    ],
                    'button' => [
                        'save' => 'Sauvegarder',
                    ],
                ],
            ],
        ],
        'edit' => [
            'breadcrumbs' => [
                'my-collections' => 'Mes collections',
                'to-edit' => 'Modifier',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'type' => 'Type:',
                        'title' => 'Titre:',
                        'description' => 'Description:',
                        'additional-information-title' => 'Ajoutez un titre',
                        'additional-information-content' => 'Contenu des informations complémentaires:',
                        'status' => 'Statut:',
                    ],
                    'button' => [
                        'save' => 'Sauvegarder',
                    ],
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'my-collections' => 'Mes collections',
            ],
            'content' => [
                'back' => 'Retour à mes collections',
            ],
            'edit-content' => 'Modifier le contenu',
            'footer' => [
                'title' => 'Titre:',
                'description' => 'Description:',
                'status' => 'Statut:',
                'additional-information-title' => 'Ajoutez un titre',
                'additional-information-content' => 'Ajouter des informations supplémentaires:',
                'published' => 'Publié',
                'unpublished' => 'Masqué',
                'button' => [
                    'edit' => 'Modifier',
                    'unpublish' => 'Masquer',
                    'publish' => 'Publier',
                    'delete' => 'Supprimer',
                    'another-collection' => 'Ajouter une autre collection',
                ],
                'h3' => [
                    'delete' => 'Supprimer la collection',
                ],
                'p' => [
                    'sure' => 'Êtes-vous sûr ?',
                ],
                'form' => [
                    'button' => [
                        'delete' => 'Supprimer',
                    ],
                ],
            ],
        ],
    ],
    'message' => [
        'success' => [
            'collection-created' => 'Collection créée avec succès.',
            'collection-updated' => 'Collection modifiée avec succès.',
            'collection-deleted' => 'collection supprimée avec succès.',
            'collection-enabled' => 'Collection activée avec succès.',
            'collection-disabled' => 'Collection désactivée avec succès.',
        ],
    ],
];
