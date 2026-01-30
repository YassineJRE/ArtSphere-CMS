<?php

return [
    'views' => [
        'create' => [
            'title' => [
                'add-document' => 'Ajouter un document',
            ],
            'page-title' => [
                'add-document' => 'Ajouter un document',
            ],
            'breadcrumbs' => [
                'my-documents' => 'Mes documents',
                'add-document' => 'Ajouter un document',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'file' => 'Fichier:',
                        'name' => 'Nom:',
                        'description' => 'Description:',
                        'status' => 'Statut:',
                        'choose-file' => 'Choisir un fichier',
                    ],
                    'button' => [
                        'save' => 'Sauvegarder',
                    ],
                ],
            ],
        ],
        'edit' => [
            'breadcrumbs' => [
                'my-documents' => 'Mes documents',
                'to-edit' => 'Modifier',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'file' => 'Fichier:',
                        'name' => 'Nom:',
                        'description' => 'Description:',
                        'status' => 'Statut:',
                        'choose-file' => 'Choisir un fichier',
                    ],
                    'button' => [
                        'save' => 'Sauvegarder',
                    ],
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'my-documents' => 'Mes documents',
            ],
            'content' => [
                'back' => 'Retour à mes documents',
            ],
            'edit-document' => 'Modifier le document',
            'footer' => [
                'name' => 'Nom:',
                'description' => 'Description:',
                'status' => 'Statut:',
                'published' => 'Publié',
                'unpublished' => 'Masqué',
                'button' => [
                    'edit' => 'Modifier',
                    'unpublish' => 'Masquer',
                    'publish' => 'Publier',
                    'download' => 'Télécharger',
                    'delete' => 'Supprimer',
                    'another-document' => 'Ajouter un autre document',
                ],
                'h3' => [
                    'delete' => 'Supprimer le document',
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
            'document-created' => 'Document créé avec succès.',
            'document-updated' => 'Document modifié avec succès.',
            'document-deleted' => 'Document supprimé avec succès.',
            'document-enabled' => 'Document activé avec succès.',
            'document-disabled' => 'Document désactivé avec succès.',
        ],
    ],
];
