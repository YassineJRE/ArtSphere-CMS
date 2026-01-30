<?php

return [
    'views' => [
        'create' => [
            'title' => 'Créer un nouvelle galerie',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'galleries' => 'Galeries',
                'new-gallery' => 'Nouvelle galerie',
            ],
            'label' => [
                'name' => 'Nom',
                'institution-type' => 'Type d\'institution',
            ],
            'button' => [
                'save' => 'Sauvegarder',
            ],
        ],
        'datatable-actions' => [
            'button' => [
                'edit' => 'Modifier',
                'delete' => 'Supprimer',
                'view' => 'Voir',
                'unpublish' => 'Dépublier',
                'publish' => 'Publier',
                'approve' => 'Approuver',
            ],
            'paragraph' => [
                'sure' => 'Êtes vous sûr?',
            ],
            'h3' => [
                'delete-gallery' => 'Supprimer la galerie',
            ],
        ],
        'edit' => [
            'title' => 'Modifier la galerie',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'galleries' => 'Galeries',
            ],
            'label' => [
                'name' => 'Nom',
                'institution-type' => 'Type d\'institution',
            ],
            'button' => [
                'save' => 'Sauvegarder les modifications',
            ],
        ],
        'index' => [
            'title' => 'Galeries',
            'breadcrumbs' => [
                'home' => 'Accueil',
                'galleries' => 'Galeries',
            ],
            'button' => [
                'new' => 'Créer un nouvelle galerie',
            ],
            'table' => [
                'thead' => [
                    'tr' => [
                        'th' => [
                            'no' => 'No',
                            'name' => 'Nom',
                            'institution-type' => 'Type d\'institution',
                            'actions' => 'Actions',
                            'status' => 'Statut',
                        ],
                    ],
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'home' => 'Accueil',
                'galleries' => 'Galeries',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'gallery-created' => 'Galerie créée avec succès.',
            'gallery-updated' => 'Galerie modifiée avec succès.',
            'gallery-deleted' => 'Galerie supprimée avec succès.',
        ],
    ],
];
