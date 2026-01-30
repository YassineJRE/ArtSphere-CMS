<?php

return [
    'views' => [
        'index' => [
            'title' => [
                'artist-profile' => 'Mon profil d\'artiste',
                'artist-group' => 'Mon groupe d\'artiste',
                'my-websites' => 'Mon groupe de sites web',
            ],
            'page-title' => [
                'my-websites' => 'Mes groupes de sites web',
            ],
            'breadcrumbs' => [
                'my-websites' => 'Mes sites web',
                'my-website-groups' => 'Mes groupes de sites web',
            ],
            'span' => [
                'add-website' => 'Créer un fichier',
                'add-folder' => 'Créer un fichier pour organiser et ajouter vos liens web. Ajouter les sites de vos artistes préférés, vos sites de ventes, etc.',
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
                            'delete-website' => 'Supprimer le groupe de site Web',
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
                'add-website' => 'Créer un fichier',
            ],
            'page-title' => [
                'add-website' => 'Créer un fichier',
            ],
            'breadcrumbs' => [
                'my-websites' => 'Mes sites web',
                'my-website-groups' => 'Mes groupes de sites web',
                'add-website' => 'Créer un fichier',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'type' => 'Type:',
                        'title' => 'Titre:',
                        'description' => 'Description:',
                        'additional-information-title' => 'Ajoutez un titre',
                        'additional-information-content' => 'Ajouter des informations supplémentaires:',
                        'specify' => 'Spécifier:',
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
                'my-websites' => 'Mes sites web',
                'my-website-group' => 'Mes groupes de sites web',
                'to-edit' => 'Modifier',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'type' => 'Type:',
                        'title' => 'Titre:',
                        'description' => 'Description:',
                        'additional-information-title' => 'Ajoutez un titre',
                        'additional-information-content' => 'Ajouter des informations supplémentaires:',
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
            'breadcrumbs' => [
                'my-websites' => 'Mes groupes de sites web',
                'my-website-groups' => 'Mes groupes de sites web',
            ],
            'content' => [
                'back' => 'Retour à mes groupes de sites web',
            ],
            'edit-content' => 'Modifier le contenu',
            'span' => [
                'add-website' => 'Ajouter un site web',
            ],
            'footer' => [
                'name' => 'Nom:',
                'description' => 'Description:',
                'type' => 'Type:',
                'button' => [
                    'edit' => 'Modifier',
                    'unpublish' => 'Masquer',
                    'publish' => 'Publier',
                    'delete' => 'Supprimer',
                    'another-website' => 'Créer un autre fichier',
                    'view' => 'Visualiser',
                ],
                'title' => 'Titre:',
                'owner' => 'Propriétaires:',
                'status' => 'Statut:',
                'additional-information-title' => 'Ajoutez un titre',
                'additional-information-content' => 'Ajoutez des informations supplémentaires:',
                'h3' => [
                    'delete' => 'Supprimer le groupe de site web',
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
            'ul' => [
                'li' => [
                    'button' => [
                        'edit' => 'Modifier',
                        'download' => 'Télécharger',
                        'delete' => 'Supprimer',
                        'h3' => [
                            'delete-website' => 'Supprimer le site web',
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
    ],
    'message' => [
        'success' => [
            'website-group-created' => 'Groupe de site web créée avec succès.',
            'website-group-updated' => 'Groupe de site web modifié avec succès.',
            'website-group-deleted' => 'Groupe de site web supprimé avec succès.',
            'website-group-enabled' => 'Groupe de site web activée avec succès.',
            'website-group-disabled' => 'Groupe de site web désactivée avec succès.',
        ],
    ],
];
