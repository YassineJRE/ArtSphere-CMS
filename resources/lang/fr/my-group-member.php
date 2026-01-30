<?php

return [
    'views' => [
        'create' => [
            'title' => [
                'add-member' => 'Ajouter un membre',
            ],
            'page-title' => [
                'add-member' => 'Ajouter un membre',
            ],
            'breadcrumbs' => [
                'members' => 'Membres',
                'add-member' => 'Ajouter un membre',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'profile' => 'Profil:',
                        'role' => 'Rôle:',
                        'first-name' => 'Prénom:',
                        'last-name' => 'Nom:',
                        'email' => 'Email:',
                    ],
                    'button' => [
                        'save' => 'Sauvegarder',
                        'send' => 'Envoyer',
                        'add' => 'Ajouter',
                    ],
                    'invitation-text' => 'S\'ils ne sont pas dans le système, vous pouvez les inviter à artolog ici:',
                ],
                'label' => [
                    'send-copy' => 'Envoyez-moi une copie',
                ],
            ],
            'h2' => [
                'invite' => 'Inviter',
            ],
            'h3' => [
                'invite-preview' => 'Aperçu de l\'invitation:',
            ],
            'p' => [
                'hello' => 'Salut',
                'thank' => 'Merci!',
                'text' => ':inviter aimerait vous inviter à artologue afin de vous ajouter à :group_name. Suivez ce lien pour vous créer un compte',
                'artolog' => 'artologue',
            ],
        ],
        'edit' => [
            'breadcrumbs' => [
                'members' => 'Membres',
                'to-edit' => 'Modifier',
            ],
            'form' => [
                'p' => [
                    'label' => [
                        'role' => 'Rôle:',
                    ],
                    'button' => [
                        'save' => 'Sauvegarder',
                    ],
                ],
            ],
        ],
        'show' => [
            'breadcrumbs' => [
                'members' => 'Membres',
            ],
            'content' => [
                'back' => 'Retour à mes membres',
            ],
            'edit-document' => 'Modifier le document',
            'footer' => [
                'name' => 'Nom:',
                'role' => 'Rôle:',
                'artist-name' => 'Nom d\'artiste:',
                'biography' => 'Biographie:',
                'description' => 'Description:',
                'button' => [
                    'edit' => 'Modifier',
                    'delete' => 'Supprimer',
                ],
                'h3' => [
                    'delete-member' => 'Supprimer le membre',
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
        'index' => [
            'title' => [
                'artist-group' => 'Groupe d\'artistes',
            ],
            'breadcrumbs' => [
                'members' => 'Membres',
            ],
            'button' => [
                'span' => [
                    'add-member' => 'Ajouter un membre',
                ],
            ],
            'ul' => [
                'li' => [
                    'administrator' => 'Administrateur',
                    'member' => 'Visiteur',
                    'pending-approval' => 'En attente d\'approbation',
                    'saved' => 'Enregistré',
                    'pending' => 'En attente',
                    'button' => [
                        'resend-invitation' => 'Renvoyer l\'invitation',
                        'edit' => 'Modifier',
                        'remove' => 'Enlever',
                        'delete' => 'Supprimer',
                    ],
                    'h3' => [
                        'remove-member' => 'Enlever ce membre',
                        'delete-invitation' => 'Supprimer cette invitation',
                    ],
                    'p' => [
                        'sure' => 'Êtes vous sûr ?',
                    ],
                    'form' => [
                        'button' => [
                            'remove' => 'Enlever',
                            'delete' => 'Supprimer',
                        ],
                    ],
                ],
            ],
            'h3' => [
                'invitations' => 'Invitations',
            ],
        ],
    ],
    'message' => [
        'success' => [
            'member-added' => 'Membre ajouté avec succès.',
            'member-updated' => 'Rôle du membre modifié avec succès.',
            'member-removed' => 'Membre retiré avec succès.',
            'member-enabled' => 'Membre activé avec succès.',
            'member-disabled' => 'Membre désactivé avec succès.',
            'invitation-sent' => 'Invitation envoyée.',
        ],
        'error' => [
            'email-sending-failed' => 'L\'envoi de l\'e-mail a échoué.',
        ],
    ],
];
