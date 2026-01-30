<?php

return [
    'views' => [
        'index' => [
            'title' => [
                'artist-profile' => 'Mon profil d\'artiste',
                'artist-group' => 'Mon groupe d\'artiste',
                'my-websites' => 'Mon site web',
            ],
            'page-title' => [
                'my-websites' => 'Mes sites web',
            ],
            'breadcrumbs' => [
                'my-websites' => 'Mes sites web',
                'my-website-groups' => 'Mes groupes de sites web',
            ],
            'span' => [
                'add-website' => 'Ajouter un site Web',
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
                            'delete-website' => 'Supprimer le site Web',
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
                'add-website' => 'Ajouter un site Web',
            ],
            'page-title' => [
                'add-website' => 'Ajouter un site Web',
            ],
            'breadcrumbs' => [
                'my-websites' => 'Mes sites web',
                'my-website-groups' => 'Mes groupes de sites web',
                'add-website' => 'Ajouter un site Web',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'type' => 'Type:',
                        'title' => 'Titre:',
                        'description' => 'Description:',
                        'additional-information-title' => 'Ajoutez un titre',
                        'additional-information-content' => 'Ajoutez des informations supplémentaires:',
                        'status' => 'Statut:',
                        'image' => 'Image:',
                        'owner' => 'Nom du propriétaire:',
                        'owner-link' => 'Lien au site du propriétaire:',
                        'url' => 'Url:',
                        'choose-file' => 'Choisir un fichier',
                        'image-text' => 'Choisissez votre propre image pour représenter le lien de votre site.',
                    ],
                    'button' => [
                        'save' => 'Sauvegarder',
                    ],
                ],
                'span' => [
                    'not-valid' => 'Url non valide',
                ],
                'button' => [
                    'remove-file' => 'Effacer le fichier',
                ],
            ],
        ],
        'edit' => [
            'breadcrumbs' => [
                'my-websites' => 'Mes sites web',
                'my-website-groups' => 'Mes groupes de sites web',
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
                        'additional-information-content' => 'Ajoutez des informations supplémentaires:',
                        'status' => 'Statut:',
                        'image' => 'Image:',
                        'owner' => 'Nom du propriétaire:',
                        'owner-link' => 'Lien au site du propriétaire:',
                        'url' => 'Url:',
                        'choose-file' => 'Choisir un fichier',
                        'image-text' => 'Choisissez votre propre image pour représenter le lien de votre site.',
                    ],
                    'button' => [
                        'save' => 'Sauvegarder',
                    ],
                ],
                'span' => [
                    'not-valid' => 'Url non valide',
                ],
                'button' => [
                    'remove-file' => 'Effacer le fichier',
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'my-websites' => 'Mes sites web',
                'my-website-group' => 'Mes groupes de sites web',
            ],
            'content' => [
                'back' => 'Retour à mes sites web',
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
                    'download' => 'Télécharger',
                    'another-website' => 'Ajouter un autre site web',
                    'view' => 'Visualiser',
                ],
                'title' => 'Titre:',
                'owner' => 'Propriétaire:',
                'status' => 'Statut:',
                'additional-information-title' => 'Ajoutez un titre',
                'additional-information-content' => 'Ajouter des informations supplémentaires:',
                'url' => 'Url:',
                'h3' => [
                    'delete' => 'Supprimer le site web',
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
                        'delete' => 'Supprimer',
                    ],
                ],
            ],
        ],
    ],
    'message' => [
        'success' => [
            'website-created' => 'Site web créée avec succès.',
            'website-updated' => 'Site web modifié avec succès.',
            'website-deleted' => 'Site web supprimé avec succès.',
            'website-enabled' => 'Site web activée avec succès.',
            'website-disabled' => 'Site web désactivée avec succès.',
        ],
    ],
];
