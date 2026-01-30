<?php

return [
    'views' => [
        'index' => [
            'title' => [
                'artist-profile' => 'Mon profil d\'artiste',
                'artist-group' => 'Mon groupe d\'artiste',
                'my-exhibits' => 'Mon exposition',
            ],
            'page-title' => [
                'my-exhibits' => 'Mes expositions',
            ],
            'breadcrumbs' => [
                'my-exhibits' => 'Mes expositions',
            ],
            'span' => [
                'add-exhibit' => 'Ajouter une exposition',
                'add-documentation' => 'Ajouter votre documentation artistique, vos photos, liens à vos vidéos, etc.',
                'add-documentation-and-transfer' => 'Ajouter de la documentation artistique à transférer aux artistes',
            ],
            'ul' => [
                'li' => [
                    'edit' => 'Modifier',
                    'download' => 'Télécharger',
                    'span' => [
                        'published' => 'Publié',
                        'unpublished' => 'Masqué',
                    ],
                    'button' => [
                        'unpublish' => 'Masquer',
                        'publish' => 'Publier',
                        'delete' => 'Supprimer',
                        'h3' => [
                            'delete-exhibit' => 'Supprimer l\'exposition',
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
                'add-exhibit' => 'Ajouter une exposition',
            ],
            'page-title' => [
                'add-exhibit' => 'Ajouter une exposition',
            ],
            'breadcrumbs' => [
                'my-exhibits' => 'Mes expositions',
                'add-exhibit' => 'Ajouter une exposition',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'exhibit-name' => 'Titre de l\'exposition:',
                        'type' => 'Type:',
                        'description' => 'Description:',
                        'description-text' => 'Les dates, les reconnaissances de subventions et autres seront puisés des informations indiquées lors de l\'ajout des œuvres.',
                        'location' => 'Indiquer la galerie ou l\'adresse où cette exposition aura lieu prochainement: (Le cas échéant)',
                        'upcoming-date' => 'Indiquer la date planifiée de cet expo:',
                        'open-at' => 'Indiquer la date et l\'heure de son vernissage:',
                        'thanks' => 'Remerciement spécial:',
                        'additional-information-title' => 'Ajoutez un titre',
                        'additional-information-content' => 'Ajoutez des informations supplémentaires:',
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
                'my-exhibits' => 'Mes expositions',
                'to-edit' => 'Modifier',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'name' => 'Nom:',
                        'type' => 'Type:',
                        'description' => 'Description:',
                        'location' => 'Location:',
                        'date' => 'Date:',
                        'upcoming-date' => 'Date à venir:',
                        'open-at' => 'Ouvert à:',
                        'thanks' => 'Remerciement spécial:',
                        'grant-acknowledgement' => 'Remerciement:',
                        'other-acknowledgement' => 'Autre remerciement:',
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
                'my-exhibits' => 'Mes expositions',
            ],
            'content' => [
                'back' => 'Retour à mes expositions',
            ],
            'edit-content' => 'Modifier le contenu',
            'h2' => [
                'artworks' => 'Œuvres',
            ],
            'span' => [
                'add-artwork' => 'Ajouter une œuvre',
            ],
            'ul' => [
                'li' => [
                    'button' => [
                        'edit' => 'Modifier',
                        'download' => 'Télécharger',
                        'delete' => 'Supprimer',
                        'h3' => [
                            'delete-artwork' => 'Supprimer l\'œuvre',
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
                    'span' => [
                        'add-upcoming' => 'Ajouter la galerie à venir et/ou l\'emplacement',
                    ],
                ],
            ],
            'footer' => [
                'exhibit-name' => 'Titre de l\'exposition:',
                'description' => 'Description:',
                'location' => 'Galeries ou lieux:',
                'date' => 'Date:',
                'special-thanks' => 'Remerciement spécial:',
                'additional-information-title' => 'Ajoutez un titre',
                'grant-acknowledgement' => 'Remerciements pour les subventions:',
                'type' => 'Type:',
                'other-acknowledgement' => 'Autres remerciements:',
                'upcoming-date' => 'Date à venir:',
                'upcoming-exhibit' => 'Exposition(s) à venir:',
                'opening' => 'Vernissage:',
                'opening-time' => 'Heure du vernissage:',
                'additional-information-content' => 'Ajouter des informations supplémentaires:',
                'status' => 'Statut:',
                'button' => [
                    'edit' => 'Modifier',
                    'unpublish' => 'Masquer',
                    'publish' => 'Publier',
                    'delete' => 'Supprimer',
                    'another-exhibit' => 'Ajouter une autre exposition',
                    'transfer' => 'Transférer',
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
        'transfer-to' => [
            'title' => [
                'transfer-to-artist' => 'Transférer à un artiste',
            ],
            'page-title' => [
                'transfer-to-artist' => 'Transférer à un artiste',
            ],
            'breadcrumbs' => [
                'my-exhibits' => 'Mes expositions',
                'transfer-to-artist' => 'Transférer à un artiste',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'profile' => 'Profil:',
                        'type' => 'Type:',
                        'text-invite' => 'S\'ils ne sont pas dans le système, vous pouvez les inviter à artolog ici:',
                        'first-name' => 'Prénom:',
                        'last-name' => 'Nom:',
                        'email' => 'Email:',
                    ],
                    'button' => [
                        'save' => 'Sauvegarder',
                        'send' => 'Envoyer',
                        'transfer' => 'Transférer',
                    ],
                ],
                'label' => [
                    'send-copy' => 'Envoyez-moi une copie',
                ],
            ],
            'h2' => [
                'invite' => 'Invitation',
            ],
            'h3' => [
                'invite-preview' => 'Aperçu de l\'invitation:',
            ],
            'p' => [
                'hi' => 'Bonjour',
                'text' => 'a de votre documentation artistique à vous envoyer. Connectez-vous ou inscrivez-vous pour la télécharger, la modifier ou la publier.',
                'thank' => 'Merci,',
                'artolog' => 'artologue',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'exhibit-created' => 'Exposition créée avec succès.',
            'exhibit-updated' => 'Exposition modifiée avec succès.',
            'exhibit-deleted' => 'Exposition supprimée avec succès.',
            'exhibit-enabled' => 'Exposition activée avec succès.',
            'exhibit-disabled' => 'Exposition désactivée avec succès.',
            'exhibit-has-been-transfered' => 'L\'exposition a été transférée.',
            'exhibit-has-not-been-transfered' => 'L\'exposition n\'a pas été transférée.',
            'invitation-sent' => 'Invitation envoyée.',
        ],
        'error' => [
            'email-sending-failed' => 'L\'envoi de l\'e-mail a échoué.',
        ],
    ],
];
